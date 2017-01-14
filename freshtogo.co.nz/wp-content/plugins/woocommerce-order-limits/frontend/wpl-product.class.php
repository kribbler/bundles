<?php
/**
 * Frontend product functionality
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */
class WPL_Product{

	public function __construct()
	{
			
	}	
	
	/**
	* Validate the products quantity limit and return requested error messages
	* 
	* @param	$cart_item		array
	* @param	$return_message	string
	* @return	array 
	*/
	public function validate_product_quantity_limit( $item, $return_message_type = '' )
	{
		global $woocommerce;

		$return = array( 'valid' => TRUE );
		
		if( !isset( $item['variation_id'] ) ) $item['variation_id'] = 0;
		
		if( $item['variation_id'] ){
			$purchase_limit = WPL_Common_Product::get_product_limits( $item['variation_id'], TRUE );
		} else {
			$purchase_limit = WPL_Common_Product::get_product_limits( $item['product_id'] );
		}
		
		if( (int)$purchase_limit['min'] != 0 AND $item['quantity'] < (int)$purchase_limit['min'] ) { //min limit
			$return['valid'] = FALSE;
			$return['limit_type'] = 'min';
			
			if( $return_message_type ){
			
				$product = ( $item['variation_id'] ) ? get_product( $item['variation_id'] ) : get_product( $item['product_id'] ); 
			
				switch( $return_message_type ){
					case 'cart_page':
					
						$error = get_option( 'wpl_cart_page_min_product_quantity_error' );
						//$needed_qty = $purchase_limit['min'] - $product['quantity'];
						
						$product_title = '<a href="' . get_permalink( $item['product_id'] ) . '">' . $product->get_title() . '</a>';
						if( $item['variation_id'] ){
							$variation_data = trim( $woocommerce->cart->get_item_data( $item, TRUE ) );
							$product_title .= ' (' . $variation_data . ')';
						}

						$error = str_replace( '[product_name]', $product_title, $error );
						$error = str_replace( '[min_limit]', $purchase_limit['min'], $error );
						//$error = str_replace( '[needed_qty]', $needed_qty, $error );
						$return['message'] = $error;
						break;
						
					case 'add_to_cart':

						//create the output message
						$needed_qty = $purchase_limit['min'] - $item['quantity'];
						$error = get_option( 'wpl_add_to_cart_min_product_quantity_error' );
						//very simple search and replace for [product_name], [min_limit] and [needed_qty]
						$error = str_ireplace( '[product_name]', $product->get_title(), $error );
						$error = str_ireplace( '[min_limit]', $purchase_limit['min'], $error ) ;
						$error = str_ireplace( '[needed_qty]', $needed_qty, $error );
						
						//check if we need to add needed quantity button
						if( get_option( 'wpl_add_to_cart_min_product_quantity_error_show_button' ) == 'yes' ){
							//get button text
							$button_text = get_option( 'wpl_add_to_cart_min_product_quantity_error_button_text' );
							$button_text = str_ireplace( '[product_name]', $product->get_title(), $button_text );
							$button_text = str_ireplace( '[min_limit]', $purchase_limit['min'], $button_text );      
							$button_text = str_ireplace( '[needed_qty]', $needed_qty, $button_text );
							//create the add to cart URL
							$add_to_cart_url = $product->add_to_cart_url();
							
							$add_to_cart_url = add_query_arg( 'quantity', $needed_qty, $add_to_cart_url );
							
							if( version_compare( $woocommerce->version, 2.1, '<' ) ){ //Woo 2.0
								//add variation id and attributes to url
								if( $item['variation_id'] ){ //add the variation attributes to the URL
									$add_to_cart_url = add_query_arg( 'variation_id', $item['variation_id'], $add_to_cart_url );
									foreach( $item['variation'] as $att_name => $att_value ){
										$add_to_cart_url = add_query_arg( 'attribute_'.$att_name, $att_value, $add_to_cart_url );
									}
								}
							}	
	
							$error .= '<a type="submit" class="button" href="' . esc_url( $add_to_cart_url ) . '">' . $button_text . '</a>';
						}
						$return['message'] = $error;
						break;
				}
			
			}
			
		} elseif( (int)$purchase_limit['max'] != 0 AND $item['quantity'] > (int)$purchase_limit['max'] ){ //max limit
			$return['valid'] = FALSE;
			$return['limit_type'] = 'max';
			
			if( $return_message_type ){

				$product = get_product( $item['product_id'] );
			
				switch( $return_message_type ){
					case 'cart_page':
						$error = get_option( 'wpl_cart_page_max_product_quantity_error' );
						
						$product_title = '<a href="' . get_permalink( $item['product_id'] ) . '">' . $product->get_title() . '</a>';
						if( $item['variation_id'] ){
							$variation_data = trim( $woocommerce->cart->get_item_data( $item, TRUE ) );
							$product_title .= ' (' . $variation_data . ')';
						}

						$error = str_replace( '[product_name]', $product_title, $error );
						$error = str_replace( '[max_limit]', $purchase_limit['max'], $error );
						$return['message'] = $error;
						break;
						
					case 'add_to_cart':
						
						$error = get_option( 'wpl_add_to_cart_max_product_quantity_error' );
						$error = str_ireplace( '[product_name]', $product->get_title(), $error );
						$error = str_ireplace( '[max_limit]', $purchase_limit['max'], $error );
						$return['message'] = $error;
						break;
				}
			
			}
		
		}
		
		return $return;
	}
	
	/**
	 * Make sure adding to cart is valid and within limits
	 * Can also be called ajaxly.  Wrapper function in WPL_Common_Product for both normal and ajax calls
	 *
	 * @param	bool	$return
	 * @param	int		$product_id
	 * @param	int		$quantity
	 * @param	int		$variation_id
	 * @param	array	$variation
	 * @return	boolean 
	 *
	 * @since	1.0.0
	 */
	public function add_product_to_cart_validate( $add_product_to_cart, $product_id, $quantity, $variation_id = 0, $variation = NULL )
	{
		global $woocommerce;
		$message = '';
		$return_message_type = 'add_to_cart';
		
		// Product quantity limits
		if( get_option( 'wpl_product_quantity_limit_enabled' ) == 'yes' ){
		
			$is_variation = ( $variation_id ) ? TRUE : FALSE;
			
			//get current cart quantities for this product
			if( $variation_id ){
				$cart_quantity = WPL_Common_Cart::get_cart_quantity( $variation_id, TRUE );
			} else {
				$cart_quantity = WPL_Common_Cart::get_cart_quantity( $product_id );
			}
			
		
			$product_data = array(
				'product_id' => $product_id,
				'quantity' => $cart_quantity + $quantity,
				'variation_id' => $variation_id,
				'variation' => $variation
			);
			
			$data = $this->validate_product_quantity_limit( $product_data, $return_message_type );
			if( $data['valid'] == FALSE ){
				$message = $data['message'];
				if( $data['limit_type'] == 'max' ) $add_product_to_cart = FALSE; //If min is invalid, still add to cart 
				
			}
		}
		
		//Cart quantity limit
		if( $add_product_to_cart ){
			include_once 'wpl-cart.class.php';
			$wpl_cart = new WPL_Cart();
			$data = $wpl_cart->validate_cart_quantity_limit( $return_message_type, $quantity ); 
			if( $data['valid'] == FALSE ){
				if( $data['limit_type'] == 'min' ){ //still add to cart if min limit is invalid
					if( empty( $message ) ) $message = $data['message']; //only output message if there is no min limit message from previous limits
				} elseif( $data['limit_type'] == 'max' ) {
					$add_product_to_cart = FALSE;
					$message = $data['message'];
				}
				
			}
			
		}
		
		//Cart value limit
		if( $add_product_to_cart ){
			include_once 'wpl-cart.class.php';
			$wpl_cart = new WPL_Cart();
			
			//get product value being added to the cart
			$product = get_product( $product_id ); 
			$add_to_cart_value = $quantity * $product->get_price();
			
			$data = $wpl_cart->validate_cart_value_limit( $return_message_type, $add_to_cart_value );
			if( $data['valid'] == FALSE ){
				if( $data['limit_type'] == 'min' ){ //still add to cart if min limit is invalid
					if( empty( $message ) ) $message = $data['message']; //only output message if there is no min limit message from previous limits
				} elseif( $data['limit_type'] == 'max' ) {
					$add_product_to_cart = FALSE;
					$message = $data['message'];
				}
				
			} 
		}
		
		//Category quantity limit
		if( $add_product_to_cart ){
			if( get_option( 'wpl_category_quantity_limit_enabled' ) == 'yes' ){
			
				include_once 'wpl-category.class.php';
				$wpl_category = new WPL_Category();
				
				$cart_category_quantities = WPL_Common_Category::get_current_cart_category_quantities(); //current cart categories and quantities
				$product_cats = wp_get_object_terms( $product_id, 'product_cat', array( 'fields' => 'ids' ) ); //products categories
				
				foreach( $product_cats as $category_id ){
					$total_category_quantity = ( array_key_exists( $category_id, $cart_category_quantities ) ) ? $cart_category_quantities[$category_id] + $quantity : $quantity;
					$data = $wpl_category->validate_category_quantity_limit( $return_message_type, $category_id, $total_category_quantity );
					if( $data['valid'] == FALSE ){
						if( $data['limit_type'] == 'min' ){ //still add to cart if min limit is invalid
							if( empty( $message ) ) $message = $data['message']; //only output message if there is no min limit message from previous limits
						} elseif( $data['limit_type'] == 'max' ) {
							$add_product_to_cart = FALSE; 
							$message = $data['message'];
							break; //exit as soon as we find an error
						}
						
					} 
				}			
			}
		}
		
		//Category value limit
		if( $add_product_to_cart ){
			if( get_option( 'wpl_category_value_limit_enabled' ) == 'yes' ){
				
				include_once 'wpl-category.class.php';
				$wpl_category = new WPL_Category();
				
				$cart_category_values = WPL_Common_Category::get_current_cart_category_values(); //current cart categories and 
				$product_cats = wp_get_object_terms( $product_id, 'product_cat', array( 'fields' => 'ids' ) ); //products categories
				$product = get_product( $product_id );
				$product_value = $product->get_price() * $quantity;
				
				foreach( $product_cats as $category_id ){
					$total_category_value = ( array_key_exists( $category_id, $cart_category_values ) ) ? $cart_category_values[$category_id] + $product_value  : $product_value;
					$data = $wpl_category->validate_category_value_limit( $return_message_type, $category_id, $total_category_value );
					if( $data['valid'] == FALSE ){
						if( $data['limit_type'] == 'min' ){ //still add to cart if min limit is invalid
							if( empty( $message ) ) $message = $data['message']; //only output message if there is no min limit message from previous limits
						} elseif( $data['limit_type'] == 'max' ) {
							$add_product_to_cart = FALSE; 
							$message = $data['message'];
							break; //exit as soon as we find an error
						}
						
					} 
				}
			}
		}
		
		//output message and return
		if( !empty( $message ) ){
		
			if( $add_product_to_cart ) WPL_Common::set_message_filter( $message );
			else{
				if( function_exists( 'wc_add_notice' ) ) wc_add_notice( $message, 'error' ); //Woo 2.1+
				else $woocommerce->add_error( $message );
			}
		
		}
		
		return $add_product_to_cart;		
		
	}
	
	/**
	 * Get the IDs of all product marked as required
	 *
	 * @return	array 
	 *
	 * @since	1.2
	 */
	public function get_required_products()
	{
		global $wpdb;
		
		$query = "SELECT post_id
				  FROM $wpdb->postmeta
				  WHERE meta_key = 'wpl_product_required' AND meta_value = 'yes'";
				  
		return $wpdb->get_col( $query );
	}

}
new WPL_Product;