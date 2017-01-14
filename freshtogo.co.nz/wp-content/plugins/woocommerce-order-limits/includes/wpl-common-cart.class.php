<?php
/**
 * Common cart functionality shared between admin and frontend
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */

class WPL_Common_Cart {

	/**
	 * Initialize common cart functionality
	 *
	 * @since     1.1.0
	 */
	public function __construct()
	{
		
	}
	
	/**
	 * When not on cart/checkout page and when updating item quantities from the cart page, 
	 * the cart session doesn't hold the total (only calculated on cart/checkout page)
	 * we'll force the calculations to happen
	 *
	 * @since	1.1.0
	 */
	public static function force_cart_calculations()
	{	
		global $woocommerce;
		if ( ! defined( 'WOOCOMMERCE_CART' ) ) DEFINE( 'WOOCOMMERCE_CART', true );
		$woocommerce->cart->calculate_totals();
	}
	
	/**
	* Return cart quantities for all products in cart or quantity of product id given.
	* 
	* @param int $product_id
	* @return array/int 
	*/
	public static function get_cart_quantity( $product_id = 0, $is_variation = FALSE )
	{
		global $woocommerce;

		$cart = $woocommerce->cart->get_cart();
		
		if($product_id != 0){ //get quantity for this productid
		
			$cart_quantity = 0;
			//variation are separate items in the cart, so if were not looking for a particular variation
			//we'll need to interate through each item in the cart to get the total for the product id
			foreach($cart as $item_id => $item){
				
				if( $is_variation ){
					if( $item['variation_id'] == $product_id ) return $item['quantity'];
				} else {
					if($item['product_id'] == $product_id) $cart_quantity =+ $item['quantity'];
				}
			}
			return $cart_quantity;

		} else { //return all quantities, product_id => quantity pairs.
			$cart_quantity = array();
			foreach($cart as $item_id => $item){
				$cart_quantity[$item['product_id']] = $cart_quantity[$item['product_id']] =+ $item['quantity'];
			}
			return $cart_quantity;
		}

	}
	
	/**
	* Return the total quantity of all products in the cart
	* 
	* @return	int 
	*/
	public static function get_total_cart_quantity()
	{
		global $woocommerce;
		$cart = $woocommerce->cart->get_cart();
			
		$total_quantity = 0;
		foreach($cart as $item){
			$total_quantity += $item['quantity'];
		}
		
		return $total_quantity;
	}
	
	
	
	
	
}
new WPL_Common_Cart();