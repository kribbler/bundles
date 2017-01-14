<?php
/*
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 *
 * Update to Version 1.1
 * - Change option name format to wpl_option_name
 * - Change some option name to be more meaningful
 * - Remove hard upper limit for products (global and individual)
 * - Remove hard upper limit to cart value
 */

global $wpdb;

//change option name to 'purchase limits' from 'order limits'
$options = $wpdb->get_results( "
	SELECT *
	FROM $wpdb->options
	WHERE option_name LIKE 'woocommerce_order_limits%'");

foreach( $options as $option ){

	//delete the original option
	delete_option( $option->option_name );
	
	//remove 'order limits' from option name
	$option->option_name = str_replace( 'woocommerce_order_limits_', '', $option->option_name );
	
	//rename some options to be more descriptive and remove upper limits
	switch( $option->option_name ){
		case 'product_global_settings':
			$option->option_name = 'product_quantity_limit_type';
			break;
		
		case 'product_limit_range':
			$option->option_name = 'product_quantity_limit';
			//remove upper limit (101) while were here
			$limit = !empty( $option->option_value ) ? unserialize( $option->option_value ) : array( 'min' => 0, 'max' => 0 );
			$limit['min'] = (int) $limit['min'];
			$limit['max'] = ( $limit['max'] == '101' ) ? 0 : (int) $limit['max'];
			$option->option_value = $limit;
			break;
		
		case 'cart_limit_value_type':
			$option->option_name = 'cart_value_limit_type';
			break;
		
		case 'cart_limit_range':
			$option->option_name = 'cart_value_limit';
			//remove upper limit (10001) while were here
			$limit = !empty( $option->option_value ) ? unserialize($option->option_value) : array( 'min' => 0, 'max' => 0 );
			$limit['min'] = (int) $limit['min'];
			$limit['max'] = ( $limit['max'] == '10001' ) ? 0 : (int) $limit['max'];
			$option->option_value = $limit;
			break;
		
		case 'show_min_limit_message_button':
			$option->option_name = 'add_to_cart_min_product_quantity_error_show_button';
			break;
		
		case 'min_limit_message_button_text':
			$option->option_name = 'add_to_cart_min_product_quantity_error_button_text';
			break;
		
		case 'product_min_limit_message':
			$option->option_name = 'add_to_cart_min_product_quantity_error';
			break;
		
		case 'product_max_limit_message':
			$option->option_name = 'add_to_cart_max_product_quantity_error';
			break;
		
		case 'add_product_cart_limit_min_error':
			$option->option_name = 'add_to_cart_min_cart_value_error';
			break;
		
		case 'add_product_cart_limit_max_error':
			$option->option_name = 'add_to_cart_max_cart_value_error';
			break;
		
		case 'product_limit_show_product_error_icon':
			$option->option_name = 'cart_page_show_product_error_icon';
			break;
		
		case 'product_limit_min_error':
			$option->option_name = 'cart_page_min_product_quantity_error';
			break;
		
		case 'product_limit_max_error':
			$option->option_name = 'cart_page_max_product_quantity_error';
			break;
		
		case 'cart_limit_min_error':
			$option->option_name = 'cart_page_min_cart_value_error';
			break;
		
		case 'cart_limit_max_error':
			$option->option_name = 'cart_page_max_cart_value_error';
			break;
			
			
	}
	
	//save new option
	update_option( 'wpl_'.$option->option_name, $option->option_value );
	
}

//Change post meta name of products limit
$set = array( 'meta_key' => 'purchase_limit' );
$where = array( 'meta_key' => 'product_limit' );
$wpdb->update( $wpdb->postmeta, $set, $where );


//Remove the upper limit for all product limits
$product_metas = $wpdb->get_results( "
	SELECT * 
	FROM $wpdb->postmeta 
	WHERE meta_key = 'purchase_limit'");
	
foreach( $product_metas as $product_meta ){
	$limit = unserialize( $product_meta->meta_value );
	if( $limit['max'] == '101' ) $limit['max'] = 0;
	$limit['min'] = (int)$limit['min'];
			
	$set = array( 'meta_value' => serialize( $limit ) );
	$where = array( 'meta_id' => $product_meta->meta_id );
	$wpdb->update( $wpdb->postmeta, $set, $where );	
}

?>