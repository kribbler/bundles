<?php
/**
 * Common category functionality shared between admin and frontend
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */

class WPL_Common_Category {

	/**
	* Get global/individual quantity limits for this category
	* 
	* @param	int		$category_id
	* @return	array	min/max limit 
	*/
	public static function get_category_quantity_limits( $category_id )
	{	
		$limit = array();
		
		//check global options and get relevant limit
		//get global setting
		$global_setting = get_option( 'wpl_category_quantity_limit_type' );

		if($global_setting == 'global'){ 
			//check if this category is overridding the global limit
			if( get_woocommerce_term_meta( $category_id, 'wpl_override_global_quantity_limit', true ) == 'yes' ){
				//get products limit
				$limit = get_woocommerce_term_meta( $category_id, 'wpl_quantity_limit', true );
			} else {
				//get global limit
				$limit = get_option( 'wpl_category_quantity_limit' );  
			}

		} else{
			//individual limit
			$limit = get_woocommerce_term_meta( $category_id, 'wpl_quantity_limit', true );
		}

		//set default incase there is no limit saved
		if( empty( $limit ) ) $limit = array( 'min'=> 0, 'max' => 0 );

		return $limit;
	}
	
	/**
	* Get total quantites for each products categories in the cart
	*
	* @since	1.2
	*/
	public static function get_current_cart_category_quantities()
	{
		global $woocommerce;
			
		//get current cart categories and quantities
		$category_quantities = array();
		foreach($woocommerce->cart->cart_contents as $item_id => $item){
			$product_cats = wp_get_object_terms( $item['product_id'], 'product_cat', array( 'fields' => 'ids' ) );
			foreach($product_cats as $category_id){
				if( array_key_exists( $category_id, $category_quantities ) ) $category_quantities[$category_id] += $item['quantity'];
				else $category_quantities[$category_id] = $item['quantity'];
			}				
		}	
		
		return $category_quantities;
	}
	
	/**
	* Get global/individual value limits for this category
	* 
	* @param	int		$category_id
	* @return	array	min/max limit 
	*/
	public static function get_category_value_limits( $category_id )
	{	
		$limit = array();
		
		//check global options and get relevant limit
		//get global setting
		$global_setting = get_option( 'wpl_category_value_limit_type' );

		if($global_setting == 'global'){ 
			//check if this category is overridding the global limit
			if( get_woocommerce_term_meta( $category_id, 'wpl_override_global_value_limit', true ) == 'yes' ){
				//get products limit
				$limit = get_woocommerce_term_meta( $category_id, 'wpl_value_limit', true );
			} else {
				//get global limit
				$limit = get_option( 'wpl_category_value_limit' );  
			}

		} else{
			//individual limit
			$limit = get_woocommerce_term_meta( $category_id, 'wpl_value_limit', true );
		}

		//set default incase there is no limit saved
		if( empty( $limit ) ) $limit = array( 'min'=> 0, 'max' => 0 );

		return $limit;
	}
	
	/**
	* Get total values for each products categories in the cart
	*
	* @since	1.2
	*/
	public static function get_current_cart_category_values()
	{
		global $woocommerce;
			
		//get current cart categories and values
		$category_values = array();
		foreach($woocommerce->cart->cart_contents as $item_id => $item){
			$product = get_product( $item['product_id'] );
			$product_value = $product->get_price() * $item['quantity'];
			$product_cats = wp_get_object_terms( $item['product_id'], 'product_cat', array( 'fields' => 'ids' ) );
			foreach($product_cats as $category_id){
				if( array_key_exists( $category_id, $category_values ) ) $category_values[$category_id] += $product_value;
				else $category_values[$category_id] = $product_value;
			}				
		}
		
		return $category_values;
	}

}