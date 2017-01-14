<?php
/**
 * Frontend cart functionality
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */
class WPL_Cart{

	/**
	 * Initialise cart
	 *
	 * @since	1.1.0
	 */
	public function __construct(){
	
		//add_action( 'woocommerce_widget_shopping_cart_before_buttons', array( $this, 'output_cart_widget_message' ) ); Deprecated - 2.1
		add_action( 'wp', array( $this, 'validate_cart' ) );
		
	}
	
	/**
	* Output exclamation icon next to product name if outside of limits
	* 
	* @param	string	$title
	* @param	array	$value
	* @param	string	$cart_item_id
	* @return	string
	*
	* @since    1.1.0
	*/
	function cart_product_title_display($title, $values, $cart_item_id){

		if( isset( $values['purchase_limit_valid'] ) AND $values['purchase_limit_valid'] == FALSE )
			$title = '<img src="' . WPL_URI . '/assets/images/icon-exclamation.png" style="margin: 0 5px -4px 0; width:auto; height: auto;" />'.$title;

		return $title;

	}
		
	/**
	* Validates cart on checkout page.
	* Redirects to cart with error if cart is not valid.
	*
	* @since 1.0.0
	*/
	function validate_cart() 
	{
		global $woocommerce;            
	
		$is_cart = is_cart();
		$is_checkout = is_checkout();
		
		if( $is_checkout || $is_cart ){

			if( $woocommerce->cart->cart_contents ){
		
			//Woocommerce 2.1+
			//checkout endpoints as shown on the checkout page too so check if were on an endpoint and only try and validate if not
			if( version_compare( $woocommerce->version, 2.1, '>=' ) ){
				$request_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$order_received_endpoint = str_ireplace( array( 'http://', 'https://' ), '' , wc_get_endpoint_url( 'order-received' ) );
				$order_pay_endpoint = str_ireplace( array( 'http://', 'https://' ), '' , wc_get_endpoint_url( 'order-pay' ) );
				if( stripos( $request_url, $order_received_endpoint ) !== FALSE || stripos( $request_url, $order_pay_endpoint ) !== FALSE )
					return;
			}
			
			$valid = TRUE;
			if( $is_cart ) $return_message_type = 'cart_page';
			else $return_message_type = '';
			$messages = array();
			
			$wpl_product = new WPL_Product();
			
			//Product quantity limit
			$required_products = array();
			if( get_option( 'wpl_product_quantity_limit_enabled' ) == 'yes' ){
			
				//get required products
				$required_products = $wpl_product->get_required_products();
				
				$parent_products = array();
				foreach( $woocommerce->cart->cart_contents as $key => $item ){ 
					
					//save parent id so we can check total variation limits
					if( $item['variation_id'] ){
						if( array_key_exists( $item['product_id'], $parent_products ) ) $parent_products[$item['product_id']]['quantity'] += $item['quantity'];
						else $parent_products[$item['product_id']]['quantity'] = $item['quantity'];
						$parent_products[$item['product_id']]['cart_item_ids'][] = $key; //save the cart item id to display exclamation error
					}
					
					$data = $wpl_product->validate_product_quantity_limit( $item, $return_message_type );  
					if( !$data['valid'] ){
						$valid = FALSE;
						if( $is_cart ){
							$messages[] = $data['message'];
							$woocommerce->cart->cart_contents[$key]['purchase_limit_valid'] = FALSE;
						} else {
							//redirect to cart page if error
							wp_safe_redirect( $woocommerce->cart->get_cart_url(), 302 ); //redirect to cart
							exit;
						}
					}
					
					//check if in required product array
					$required_product_key = array_search( $item['product_id'], $required_products );
					if( $required_product_key !== FALSE ) unset( $required_products[$required_product_key] ); //if found, remove it
					
				}
			
				//check variation parent products
				if( !empty( $parent_products ) ){ 
					foreach( $parent_products as $parent_id => $info ){
					
						$data = $wpl_product->validate_product_quantity_limit( array( 'product_id' => $parent_id, 'quantity' => $info['quantity'] ), $return_message_type ); 
						if( !$data['valid'] ){
							$valid = FALSE;
							if( $is_cart ){
								$messages[] = $data['message'];
								foreach( $info['cart_item_ids'] as $cart_item_id ){
									$woocommerce->cart->cart_contents[$cart_item_id]['purchase_limit_valid'] = FALSE;
								}
							} else {
								//redirect to cart page if error
								wp_safe_redirect( $woocommerce->cart->get_cart_url(), 302 ); //redirect to cart
								exit;
							}
						}

					}
				}
				
			}

			//Cart quantity limits					
			$data = $this->validate_cart_quantity_limit( $return_message_type );
			if( !$data['valid'] ){
				$valid = FALSE;
				if( $is_cart ){
					$messages[] = $data['message'];
				} else {
					//redirect to cart page if error
					wp_safe_redirect( $woocommerce->cart->get_cart_url(), 302 ); //redirect to cart
					exit;
				}
			}			
			
			//Cart value limit			
			$data = $this->validate_cart_value_limit( $return_message_type );
			if( !$data['valid'] ){
				$valid = FALSE;
				if( $is_cart ){
					$messages[] = $data['message'];
				} else {
					//redirect to cart page if error
					wp_safe_redirect( $woocommerce->cart->get_cart_url(), 302 ); //redirect to cart
					exit;
				}
			}
			
			//Category quantity limits
			$required_categories = array();
			if( get_option( 'wpl_category_quantity_limit_enabled' ) == 'yes' ){
			
				include_once 'wpl-category.class.php';
				$wpl_category = new WPL_Category();
				
				//get required categories
				$required_categories = $wpl_category->get_required_categories(); 
				
				$cart_category_quantities = WPL_Common_Category::get_current_cart_category_quantities(); //current cart categories and quantities
				foreach($cart_category_quantities as $category_id => $quantity){
					$data = $wpl_category->validate_category_quantity_limit( $return_message_type, $category_id, $quantity );
					if( !$data['valid'] ){
						$valid = FALSE;
						if( $is_cart ){
							$messages[] = $data['message'];
						} else {
							//redirect to cart page if error
							wp_safe_redirect( $woocommerce->cart->get_cart_url(), 302 ); //redirect to cart
							exit;
						}
					}
					
					//check if in required product array
					$required_category_key = array_search( $category_id, $required_categories );
					if( $required_category_key !== FALSE ) unset( $required_categories[$required_category_key] ); //if found, remove it
					
				}
			}
			
			//Category value limits
			if( get_option( 'wpl_category_value_limit_enabled' ) == 'yes' ){
				include_once 'wpl-category.class.php';
				$wpl_category = new WPL_Category();
				
				$cart_category_values = WPL_Common_Category::get_current_cart_category_values(); //current cart categories and values
				foreach($cart_category_values as $category_id => $value){
					$data = $wpl_category->validate_category_value_limit( $return_message_type, $category_id, $value );
					if( !$data['valid'] ){
						$valid = FALSE;
						if( $is_cart ){
							$messages[] = $data['message'];
						} else {
							//redirect to cart page if error
							wp_safe_redirect( $woocommerce->cart->get_cart_url(), 302 ); //redirect to cart
							exit;
						}
					}
				}
			}
			
			//Have we got all required products? $required_products should be empty
			if( !empty( $required_products ) ){
				if( $is_cart ){
					foreach( $required_products as $product_id ){
						$product = get_product( $product_id );
						$error = get_option( 'wpl_cart_page_product_required_error' );	
						$product_name = '<a href="' . get_permalink( $product_id ) . '">' . $product->get_title() . '</a>';
						$error = str_replace( '[product_name]', $product_name, $error  );
						$messages[] = $error;
					}
				} else {
					//redirect to cart page if error
					wp_safe_redirect( $woocommerce->cart->get_cart_url(), 302 ); //redirect to cart
					exit;
				}
			}
			
			//Have we got all required categories? $required_categories should be empty
			if( !empty( $required_categories ) ){
				if( $is_cart ){
					foreach( $required_categories as $category_id ){
						$category = get_term( $category_id, 'product_cat' );
						$error = get_option( 'wpl_cart_page_category_required_error' );	
						$category_name = '<a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
						$error = str_replace( '[category_name]', $category_name, $error );
						$messages[] = $error;
					}
				} else {
					//redirect to cart page if error
					wp_safe_redirect( $woocommerce->cart->get_cart_url(), 302 ); //redirect to cart
					exit;
				}
			}

			//output messages if any
			if( $messages ){
			
				$error_list = "<ul>";
					foreach( $messages as $message ){
					$error_list .= "<li>$message</li>";
				}
				$error_list .= "</ul>";
				//get cart error display setting
				$error = get_option( 'wpl_cart_page_error_display' );
				$error = str_replace( '[error_list]', $error_list, $error );

				if( function_exists( 'wc_clear_notices' ) ) wc_clear_notices();
				else $woocommerce->clear_messages();
				
				if( function_exists( 'wc_add_notice' ) ) wc_add_notice( $error, 'error' );
				else $woocommerce->add_error( $error );
				
				if( get_option( 'wpl_cart_page_show_product_error_icon' ) == 'yes' ){	
					if( version_compare( $woocommerce->version, 2.1, '<' ) )
						add_filter( 'woocommerce_in_cart_product_title', array( $this, 'cart_product_title_display' ), 10, 3 ); //cart quantity field display
					else 
						add_filter( 'woocommerce_cart_item_name', array( $this, 'cart_product_title_display' ), 10, 3 ); //cart quantity field display
				}
			
			}
			
			} /* if $woocommerce->cart->cart_contents > 0 */
			
		}

	}
	
	/**
	* Validate the cart quantity limit and return error messages
	* 
	* @param	bool
	* @return	array 
	*/
	public function validate_cart_quantity_limit( $return_message_type = '', $add_to_cart_qty = 0 )
	{
		$return = array( 'valid' => TRUE );
	
		if( get_option( 'wpl_cart_quantity_limit_enabled' ) == 'yes' ){
		
			$cart_quantity_limit = get_option( 'wpl_cart_quantity_limit' );
			$total_cart_quantity = WPL_Common_Cart::get_total_cart_quantity();
			$total_cart_quantity += $add_to_cart_qty; //add quantity being added to the cart to get potential total cart quantity to check
		
			if( (int)$cart_quantity_limit['min'] != 0 AND $total_cart_quantity < (int)$cart_quantity_limit['min'] ){ //min limit
				$return['valid'] = FALSE;
				$return['limit_type'] = 'min';
				
				if( $return_message_type ){
				
					switch( $return_message_type ){
					
						case 'cart_page':
							$message = get_option( 'wpl_cart_page_min_cart_quantity_error' );
							$needed_qty = (int)$cart_quantity_limit['min'] - $total_cart_quantity;
							
							$message = str_replace( '[min_limit]', $cart_quantity_limit['min'], $message );
							$message = str_replace( '[needed_qty]', $needed_qty, $message );
							$return['message'] = $message;
							break;
						
						case 'add_to_cart':
							$message = get_option( 'wpl_add_to_cart_min_cart_quantity_error' );
							$needed_qty = (int)$cart_quantity_limit['min'] - $total_cart_quantity;
							
							$message = str_ireplace( '[min_limit]', $cart_quantity_limit['min'], $message ) ;
							$message = str_replace( '[needed_qty]', $needed_qty, $message );
							$return['message'] = $message;
							break;
					}
					
				}
				
			} elseif( (int)$cart_quantity_limit['max'] != 0 AND $total_cart_quantity > (int)$cart_quantity_limit['max'] ){
				$return['valid'] = FALSE;
				$return['limit_type'] = 'max';
				
				if( $return_message_type ){
				
					switch( $return_message_type ){
					
						case 'cart_page':
							$message = get_option( 'wpl_cart_page_max_cart_quantity_error' );
							$message = str_replace( '[max_limit]', $cart_quantity_limit['max'], $message );
							$return['message'] = $message;
							break;
						
						case 'add_to_cart':
							$message = get_option( 'wpl_add_to_cart_max_cart_quantity_error' );
							$message = str_ireplace( '[max_limit]', $cart_quantity_limit['max'], $message );
							$return['message'] = $message;
							break;
					
					}
					
				}
			
			}
			
		}
		
		return $return;
	}
	
	/**
	* Validate the cart value limit and return error messages
	* 
	* @param	bool
	* @return	array 
	*/
	public function validate_cart_value_limit( $return_message_type = '', $add_to_cart_value = 0 )
	{
		$return = array( 'valid' => TRUE );
		
		if( get_option( 'wpl_cart_value_limit_enabled' ) == 'yes' ){
		
			global $woocommerce;
			
			$cart_value_limit = get_option( 'wpl_cart_value_limit' );
			
			//Cart value limits
			if( $cart_value_limit['min'] != 0 || $cart_value_limit['max'] != 0 ){
			
				//which total are we checking???
				$total_type = get_option('wpl_cart_value_limit_type'); 
				
				WPL_Common_Cart::force_cart_calculations(); //calculate cart totals
				
				if( $total_type == 'subtotal_exc_tax' ) $current_cart_value = (float)$woocommerce->cart->subtotal_ex_tax;
				elseif( $total_type == 'subtotal_inc_tax' ) $current_cart_value = (float)$woocommerce->cart->subtotal_ex_tax + $woocommerce->cart->tax_total;
				else $current_cart_value = (float)$woocommerce->cart->total;
				
				$current_cart_value += $add_to_cart_value; //add value of product being added to the cart to get potential total cart value to check
				
				//check cart value limit
				if( $cart_value_limit['min'] != 0 AND $current_cart_value < $cart_value_limit['min'] ){
					$return['valid'] = FALSE;
					$return['limit_type'] = 'min';
					
					if( $return_message_type ){
						
						switch( $return_message_type ){
						
							case 'cart_page':
								$message = get_option( 'wpl_cart_page_min_cart_value_error' );
								$message = str_replace( '[min_limit]', woocommerce_price( $cart_value_limit['min']  ), $message );
								$return['message'] = $message;
								break;
								
							case 'add_to_cart':
								$message = get_option( 'wpl_add_to_cart_min_cart_value_error' );
								$message = str_replace( '[min_limit]', woocommerce_price( $cart_value_limit['min'] ), $message );
								$return['message'] = $message;
								break;
						
						}
						
					}
				} elseif( $cart_value_limit['max'] != 0 AND $current_cart_value > $cart_value_limit['max'] ){
					$return['valid'] = FALSE;
					$return['limit_type'] = 'max';
					
					if( $return_message_type ){
					
						switch( $return_message_type ){
						
							case 'cart_page':
								$message = get_option( 'wpl_cart_page_max_cart_value_error' );
								$message = str_replace( '[max_limit]', woocommerce_price( $cart_value_limit['max'] ), $message );
								$return['message'] = $message;
								break;
								
							case 'add_to_cart':
								$message = get_option( 'wpl_add_to_cart_max_cart_value_error' );
								$message = str_replace( '[max_limit]', woocommerce_price( $cart_value_limit['max'] ), $message );					
								$return['message'] = $message;
								break;
						
						}
						
					}
				}
			
			}

		}
		
		return $return;
	}
	
	/**
	 * Deprecated - 1.2
	 * Check if current cart value is within the limits set
	 *
	 * @param	string	$limit_type
	 *
	 * @since	1.0.0
	 *
	public function is_cart_limit_valid( $limit_type )
	{
		global $woocommerce;

		$cart_limit = get_option( 'wpl_cart_value_limit' );

		//which total are we checking???
		$total_type = get_option( 'wpl_cart_value_limit_type' );

		WPL_Common_Cart::force_cart_calculations(); //calculate cart totals

		if( $total_type == 'subtotal_exc_tax' ) $current_cart_value = $woocommerce->cart->subtotal_ex_tax;
		elseif( $total_type == 'subtotal_inc_tax' ) $current_cart_value = $woocommerce->cart->subtotal_ex_tax + $woocommerce->cart->tax_total;
		else $current_cart_value = (float)$woocommerce->cart->total;

		if( $limit_type == 'min' ){ //check min limit
			if( $current_cart_value < $cart_limit['min'] ) return false;
		}

		if( $limit_type == 'max' ){ //check max limit
			if( $current_cart_value > $cart_limit['max'] ) return false;
		}
		
		return true;
	}*/
	
	/** 
	 * Deprecated - 1.2
	 * Output error message in cart widget if cart if invalid 
	 *
	 * @since	1.0.0
	 *
	public function output_cart_widget_message(){
				
		$content = get_option( 'wpl_cart_widget_error' );
		
		$cart_valid = true;

		if( get_option( 'wpl_product_quantity_limit_enabled' ) == 'yes' ){

			$cart_contents = WPL_Common_Cart::get_cart_quantity();

			foreach( $cart_contents as $product_id => $quantity ){ 

				if( WPL_Product::is_product_limit_valid( $product_id, 'min' ) == false || WPL_Product::is_product_limit_valid( $product_id, 'max' ) == false)
						$cart_valid = false;
			}
		}

		if( $cart_valid ){ //no point in checking if cart already invalid
			if( $woocommerce_order_limits->settings['cart_enabled'] == 'yes' ){

				if( WPL_Common_Cart::is_cart_limit_valid( 'min' ) == false || WPL_Common_Cart::is_cart_limit_valid( 'max' ) == false )
					$cart_valid = false; 
			}
		}

		if( $cart_valid == false ) echo $content;
	}*/

}
new WPL_Cart(); 