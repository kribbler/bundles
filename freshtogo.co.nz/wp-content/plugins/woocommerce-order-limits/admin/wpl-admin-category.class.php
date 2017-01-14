<?php
/**
 * Admin category functionality
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */
class WPL_Admin_Category {

	/**
	 * Initialize product settings
	 *
	 * @since     1.2
	 */
	public function __construct()
	{
		add_action( 'product_cat_edit_form_fields', array( $this, 'output_limit_fields' ), 99 );
		add_action( 'edited_product_cat', array( $this, 'save_limit_fields' ) );
	}
	
	/**
	 * Output quantity limit fields in category edit screen
	 *
	 * @param	$category
	 *
	 * @since	1.2
	 */
	public function output_limit_fields( $category )
	{ 	
		//quantity limit
		if( get_option( 'wpl_category_quantity_limit_enabled' ) == 'yes' ){
			
			$quantity_limit = get_woocommerce_term_meta( $category->term_id, 'wpl_quantity_limit', true );
			if( empty( $quantity_limit ) ) $quantity_limit = array( 'min' => 0, 'max' => 0 );
	
			include 'views/category-quantity-limit-field.phtml';
			
		}
		
		//value limit
		if( get_option( 'wpl_category_value_limit_enabled' ) == 'yes' ){
		
			$value_limit = get_woocommerce_term_meta( $category->term_id, 'wpl_value_limit', true );
			if( empty( $value_limit ) ) $value_limit = array( 'min' => 0, 'max' => 0 );
			
			include 'views/category-value-limit-field.phtml';
		
		}
	}
	
	public function save_limit_fields( $category_id )
	{
		if( !$category_id ) return;
		
		//quantity limit
		if( isset( $_POST['wpl_quantity_limit'] ) ){
			//some error checking
			$quantity_min_limit = ( $_POST['wpl_quantity_limit']['min'] < 0 ) ? 0 : (int)$_POST['wpl_quantity_limit']['min']; //cast it
			$quantity_max_limit = ( $_POST['wpl_quantity_limit']['max'] < 0 ) ? 0 : (int)$_POST['wpl_quantity_limit']['max'];
			
			//if min greater than max, make max 0
			if( $quantity_max_limit != 0 ) if( $quantity_min_limit > $quantity_max_limit ) $quantity_max_limit = 0;
		
			update_woocommerce_term_meta( $category_id, 'wpl_quantity_limit', array( 'min' => $quantity_min_limit, 'max' => $quantity_max_limit ) );
		}
		
		//override global quantity limit
		if( isset( $_POST['wpl_override_global_quantity_limit'] ) ) update_woocommerce_term_meta( $category_id, 'wpl_override_global_quantity_limit', 'yes' );
		else update_woocommerce_term_meta( $category_id, 'wpl_override_global_quantity_limit', 'no' );
		
		//product required
		if( isset( $_POST['wpl_product_required'] ) ) update_woocommerce_term_meta( $category_id, 'wpl_product_required', 'yes' );
		else update_woocommerce_term_meta( $category_id, 'wpl_product_required', 'no' );
		
		//value limit
		if( isset( $_POST['wpl_value_limit'] ) ){
			//some error checking
			$value_min_limit = ( $_POST['wpl_value_limit']['min'] < 0 ) ? 0 : (int)$_POST['wpl_value_limit']['min']; //cast it
			$value_max_limit = ( $_POST['wpl_value_limit']['max'] < 0 ) ? 0 : (int)$_POST['wpl_value_limit']['max'];
			
			//if min greater than max, make max 0
			if( $value_max_limit != 0 ) if( $value_min_limit > $value_max_limit ) $value_max_limit = 0;
		
			update_woocommerce_term_meta( $category_id, 'wpl_value_limit', array( 'min' => $value_min_limit, 'max' => $value_max_limit ) );
		}
		
		//override global value limit
		if( isset( $_POST['wpl_override_global_value_limit'] ) ) update_woocommerce_term_meta( $category_id, 'wpl_override_global_value_limit', 'yes' );
		else update_woocommerce_term_meta( $category_id, 'wpl_override_global_value_limit', 'no' );
		
	}
	
}

return new WPL_Admin_Category();