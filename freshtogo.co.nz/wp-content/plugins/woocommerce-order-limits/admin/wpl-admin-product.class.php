<?php
/**
 * Admin product functionality
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */
class WPL_Admin_Product {

	/**
	 * Initialize product settings
	 *
	 * @since     1.0.0
	 */
	public function __construct()
	{
		add_action( 'woocommerce_product_options_sold_individually', array( $this, 'output_quantity_limit_field' ) );
		//add_action( 'save_post', array( $this, 'save_quantity_limit_field' ) );
		add_action( 'woocommerce_process_product_meta_simple', array( $this, 'save_quantity_limit_field' ) );
		add_action( 'woocommerce_process_product_meta_grouped', array( $this, 'save_quantity_limit_field' ) );
		add_action( 'woocommerce_process_product_meta_variable', array( $this, 'save_quantity_limit_field' ) );
		
		//variations
		add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'output_variation_quantity_limit_field'), 10, 3 );
		add_action( 'woocommerce_save_product_variation', array( $this, 'save_variation_quantity_limit_field' ) );
		
	}
	
	/**
	 * Output quantity limit fields in product edit screen
	 *
	 * @since     1.0.0
	 */
	public function output_quantity_limit_field(){
	
		if( get_option( 'wpl_product_quantity_limit_enabled', 'no' ) == 'yes' ){
		
			global $post, $woocommerce;
			
			$purchase_limit = get_post_meta( $post->ID, 'purchase_limit', true );
			if( empty( $purchase_limit) ) $purchase_limit = array( 'min' => 0, 'max' => 0 );
			
			include 'views/product-quantity-limit-field.phtml';
			
		}
	
	}

	/**
	 * Save quantity limit fields in product edit screen
	 *
	 * @param	$post_id
	 *
	 * @since   1.0.0
	 */
	public function save_quantity_limit_field( $post_id ){    
		
		if( !$post_id ) return;        
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		//global override checkbox
		if( array_key_exists( 'override_global_product_limit', $_POST ) ) update_post_meta( $post_id, 'override_global_product_limit', 'yes' );
		else update_post_meta( $post_id, 'override_global_product_limit', 'no' );
		
		//save min/max
		//some error checking
		$min_limit = ( $_POST['purchase_limit']['min'] < 0 ) ? 0 : (int)$_POST['purchase_limit']['min']; //cast it
		$max_limit = ( $_POST['purchase_limit']['max'] < 0 ) ? 0 : (int)$_POST['purchase_limit']['max'];
		
		//if min greater than max, make max 0
		if( $max_limit != 0 ) if( $min_limit > $max_limit ) $max_limit = 0;

		update_post_meta ( $post_id, 'purchase_limit', array( 'min' => $min_limit, 'max' => $max_limit ) );
		
		//product required checkbox
		if( array_key_exists( 'wpl_product_required', $_POST ) ) update_post_meta( $post_id, 'wpl_product_required', 'yes' );
		else update_post_meta( $post_id, 'wpl_product_required', 'no' );
		
	}
	
	/**
	 * Output quantity limit fields in product edit screen for each variation
	 *
	 * @param	$post_id
	 *
	 * @since   1.0.0
	 */
	public function output_variation_quantity_limit_field( $loop, $variation_data, $variation ){
		
		if( get_option( 'wpl_product_quantity_limit_enabled', 'no' ) == 'yes' ){
		
			if( array_key_exists( 'purchase_limit', $variation_data ) ) $purchase_limit = unserialize( $variation_data['purchase_limit'][0] );
			else $purchase_limit = array( 'min' => 0, 'max' => 0 );
			
			include 'views/product-variation-quantity-limit-field.phtml';
			
		}
	
	}
	
	/**
	 * Save quantity limit fields for variations in product edit screen
	 *
	 * @param	$post_id
	 *
	 * @since   1.0.0
	 */
	public function save_variation_quantity_limit_field( $variation_id ){    
		
		//we dont have access to the loop so take top element of purchase limits array everytime   
		$purchase_limit = array_shift( $_POST['variable_purchase_limit'] ); 
		
		//cast it and default to 0 if minus number given
		$min_limit = (int) ( (int)$purchase_limit['min'] < 0 ) ? 0 : $purchase_limit['min']; 
		$max_limit = (int) ( (int)$purchase_limit['max'] < 0 ) ? 0 : $purchase_limit['max'];
		
		//error checking (min cant be higher than max, unless max is zero)
		if( $max_limit != 0 ) if( $min_limit > $max_limit ) $max_limit = 0;
		
		//save it
		update_post_meta( $variation_id, 'purchase_limit', array( 'min' => $min_limit, 'max' => $max_limit ) );
		
	}
		
}
new WPL_Admin_Product();