<?php
/**
 * Common functionality shared between admin and frontend
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */

class WPL_Common {

	/**
	 * Message container to be output in place of Woocommerce messages
	 *
	 * @since    1.0.0
	 */
	public static $message_filter = '';

	/**
	 * Initialize common functionality
	 *
	 * @since     1.1.0
	 */
	public function __construct()
	{
		
	}
	
	/**
	 * Set the message to be output by filter_cart_message
	 * 
	 * @param 	string	$message
	 *
	 * @since	1.0.0
	 */
	public static function set_message_filter( $message )
	{
		global $woocommerce;
		self::$message_filter = $message;
		if( version_compare( $woocommerce->version, 2.1, '<' ) )
			add_filter( 'woocommerce_add_to_cart_message', array( 'WPL_Common', 'filter_cart_message' ) );
		else
			add_filter( 'woocommerce_add_message', array( 'WPL_Common', 'filter_cart_message' ) );
	}
		
	/**
	 * Used when adding product to cart so that we can replace the default message with our own
	 * 
	 * @param 	string	$message
	 * @return	string 
	 *
	 * @since	1.0.0
	 */
	public function filter_cart_message( $message ){
	
		if( !empty( self::$message_filter ) ) $message = self::$message_filter;
		return $message;
		
	}
	
}