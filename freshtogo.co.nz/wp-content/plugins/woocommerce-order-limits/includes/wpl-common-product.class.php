<?php
/**
 * Common product functionality shared between admin and frontend
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */

class WPL_Common_Product {

	/**
	 * Initialize common product functionality
	 *
	 * @since     1.1.0
	 */
	public function __construct()
	{
		add_filter( 'woocommerce_add_to_cart_validation', array( $this, 'add_product_to_cart_validate' ), 10, 5 );
	}
	
	/**
	 * Make sure adding to cart is valid and within product/cart limits
	 * Can also be called ajaxly.  Remember ajax calls come from admin hence why were calling this from common
	 *
	 * @param	bool	$return
	 * @param	int		$product_id
	 * @param	int		$quantity
	 * @param	int		$qvariation_id
	 * @param	array	$variation
	 * @return	boolean 
	 *
	 * @since	1.0.0
	 */
	public function add_product_to_cart_validate( $return, $product_id, $quantity, $variation_id = 0, $variation = NULL )
	{ 
		include_once WPL_DIR . '/frontend/wpl-product.class.php';
		$wpl_product = new WPL_Product();
		return $wpl_product->add_product_to_cart_validate( $return, $product_id, $quantity, $variation_id, $variation );
		
	}
	
	/**
	* Get global/individual limits for this product
	* 
	* @param int $product_id
	* @return array min/max limit 
	*/
	public static function get_product_limits( $product_id, $is_variation = false )
	{	
		$limit = array();

		if( $is_variation ){ //if product is a variation
			//get its limits directly
			$limit = get_post_meta( $product_id, 'purchase_limit', true );
			

		} else {

			//check global options and get relevant limit
			//get global setting
			$global_setting = get_option( 'wpl_product_quantity_limit_type' );

			if($global_setting == 'global'){ 
				//check if this product is overridding the global limit
				if( get_post_meta( $product_id, 'override_global_product_limit', true ) == 'yes' ){
					//get products limit
					$limit = get_post_meta( $product_id, 'purchase_limit', true );
				} else {
					//get global limit
					$limit = get_option( 'wpl_product_quantity_limit' );  
				}

			} else{
				$limit = get_post_meta( $product_id, 'purchase_limit', true );
			}

		}  

		//set default incase there is no limit saved
		if( empty( $limit ) ) $limit = array( 'min'=> 0, 'max' => 0 );

		return $limit;
	}
	
	/**
	 * Deprecated - 1.2
	 * Checks current cart quantities with limit
	 * 
	 * @param int $product_id
	 * @param string $limit_type The limit to check i.e. min/max
	 * @return boolean 
	 *
	public static function is_product_limit_valid( $product_id, $limit_type )
	{
		$limit = self::get_product_limits( $product_id );

		if( $limit_type == 'min' ){ //check minimum limit

			if( $limit['min'] != 0 ){ //min limit set is greater than no limit value
				$cart_quantity = WPL_Common_Cart::get_cart_quantity( $product_id );
				if( $cart_quantity < $limit['min'] ) return false;
			} 

			return true;
		}

		if( $limit_type == 'max' ){ //check maximum limit

			if( $limit['max'] != 0 ){ //max limit set less than no limit value
				$cart_quantity = WPL_Common_Cart::get_cart_quantity( $product_id );
				if( $cart_quantity > $limit['max'] ) return false;
			} 

			return true;
		}

	}*/
	
}
return new WPL_Common_Product();