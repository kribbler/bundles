<?php
/**
 * Plugin frontend entry
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */
class WPL_Frontend{
	
	/**
	 * Instance of this class.
	 *
	 * @since    1.1.0
	 */
	protected static $instance = null;
	
	/**
	 * Initialise frontend functionality
	 *
	 * @since    1.1.0
	 */
	public function __construct(){
		
		//Includes
		include_once 'wpl-cart.class.php';
		include_once 'wpl-product.class.php';
		
	}
	
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.1.0
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
		
}
new WPL_Frontend();