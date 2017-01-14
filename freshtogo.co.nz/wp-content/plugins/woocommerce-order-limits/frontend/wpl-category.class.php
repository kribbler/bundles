<?php
/**
 * Frontend category functionality
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */
class WPL_Category{


	public function validate_category_quantity_limit( $return_message_type = '', $category_id, $quantity )
	{		
		$return = array( 'valid' => TRUE );
			
		$purchase_limit = WPL_Common_Category::get_category_quantity_limits( $category_id ); 
		
		if( (int)$purchase_limit['min'] != 0 AND $quantity < (int)$purchase_limit['min'] ) { //min limit
			$return['valid'] = FALSE;
			$return['limit_type'] = 'min';
			
			if( $return_message_type ){
			
				$category = get_term( $category_id, 'product_cat' );
			
				switch( $return_message_type ){
					case 'cart_page':
						$error = get_option( 'wpl_cart_page_min_category_quantity_error' );
						$category_name = '<a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
						$error = str_ireplace( '[category_name]', $category_name, $error );
						$error = str_ireplace( '[min_limit]', $purchase_limit['min'], $error ) ;
						$return['message'] = $error;
						break;
					
					case 'add_to_cart':
						$error = get_option( 'wpl_add_to_cart_min_category_quantity_error' );
						$error = str_ireplace( '[category_name]', $category->name, $error );
						$error = str_ireplace( '[min_limit]', $purchase_limit['min'], $error ) ;
						$return['message'] = $error;
						break;
				}
			}
		} elseif( (int)$purchase_limit['max'] != 0 AND $quantity > (int)$purchase_limit['max'] ){ //max limit
			$return['valid'] = FALSE;
			$return['limit_type'] = 'max';
		
			if( $return_message_type ){
			
				$category = get_term( $category_id, 'product_cat' ); 
			
				switch( $return_message_type ){
					case 'cart_page':
						$error = get_option( 'wpl_cart_page_max_category_quantity_error' );
						$category_name = '<a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
						$error = str_ireplace( '[category_name]', $category_name, $error );
						$error = str_ireplace( '[max_limit]', $purchase_limit['max'], $error ) ;
						$return['message'] = $error;
						break;
					
					case 'add_to_cart':
						$error = get_option( 'wpl_add_to_cart_max_category_quantity_error' );
						$error = str_ireplace( '[category_name]', $category->name, $error );
						$error = str_ireplace( '[max_limit]', $purchase_limit['max'], $error );
						$return['message'] = $error;
						break;
				}
			}
		}
			
		return $return;
	}
	
	public function validate_category_value_limit( $return_message_type = '', $category_id, $value )
	{		
		$return = array( 'valid' => TRUE );
			
		$value_limit = WPL_Common_Category::get_category_value_limits( $category_id ); 
		
		if( $value_limit['min'] != 0 AND $value < $value_limit['min'] ) { //min limit
			$return['valid'] = FALSE;
			$return['limit_type'] = 'min';
			
			if( $return_message_type ){
			
				$category = get_term( $category_id, 'product_cat' );
			
				switch( $return_message_type ){
					case 'cart_page':
						$error = get_option( 'wpl_cart_page_min_category_value_error' );
						$category_name = '<a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
						$error = str_ireplace( '[category_name]', $category_name, $error );
						$error = str_ireplace( '[min_limit]', woocommerce_price( $value_limit['min'] ), $error ) ;
						$return['message'] = $error;
						break;
					
					case 'add_to_cart':
						$error = get_option( 'wpl_add_to_cart_min_category_value_error' );
						$error = str_ireplace( '[category_name]', $category->name, $error );
						$error = str_ireplace( '[min_limit]', woocommerce_price( $value_limit['min'] ), $error ) ;
						$return['message'] = $error;
						break;
				}
			}
		} elseif( $value_limit['max'] != 0 AND $value > (int)$value_limit['max'] ){ //max limit
			$return['valid'] = FALSE;
			$return['limit_type'] = 'max';
		
			if( $return_message_type ){
			
				$category = get_term( $category_id, 'product_cat' ); 
			
				switch( $return_message_type ){
					case 'cart_page':
						$error = get_option( 'wpl_cart_page_max_category_value_error' );
						$category_name = '<a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
						$error = str_ireplace( '[category_name]', $category_name, $error );
						$error = str_ireplace( '[max_limit]', woocommerce_price( $value_limit['max'] ), $error ) ;
						$return['message'] = $error;
						break;
					
					case 'add_to_cart':
						$error = get_option( 'wpl_add_to_cart_max_category_value_error' );
						$error = str_ireplace( '[category_name]', $category->name, $error );
						$error = str_ireplace( '[max_limit]', woocommerce_price( $value_limit['max'] ), $error ) ;
						$return['message'] = $error;
						break;
				}
			}
		}
			
		return $return;
	}
	
	public function get_required_categories()
	{
		global $wpdb;
		
		$query = "SELECT woocommerce_term_id
				  FROM $wpdb->woocommerce_termmeta
				  WHERE meta_key = 'wpl_product_required' AND meta_value = 'yes'";
				  
		return $wpdb->get_col( $query );
	}

}