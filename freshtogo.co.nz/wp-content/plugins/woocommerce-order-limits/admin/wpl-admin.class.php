<?php
/**
 * Admin entry class
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */

class WPL_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.1.0
	 */
	protected static $instance = null;

	/**
	 * Initialize Admin
	 *
	 * @since     1.1.0
	 */
	public function __construct()
	{		
		// Includes
		include_once 'updates/wpl-update.class.php';
		include_once 'wpl-admin-settings.class.php';
		include_once 'wpl-admin-product.class.php';
		include_once 'wpl-admin-category.class.php';
		
		// Actions/Filters
		add_action( 'admin_print_styles', array( $this, 'print_admin_styles' ), 99 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
				
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance()
	{

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific stylesheets.
	 *
	 * @since     1.0.0
	 */
	public function print_admin_styles()
	{		
		$screen = get_current_screen();
		
		switch ($screen->id) {
			case 'product':
			case 'edit-product_cat':
				wp_enqueue_style('woocommerce-order-limits-order-edit', WPL_URI . '/admin/assets/css/product-edit.css');
				break;
		}
		
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 */
	public function enqueue_admin_scripts()
	{

		/*$screen = get_current_screen();
		if ( '' == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Woocommerce_Purchase_Limits::VERSION );
		}*/

	}
	
	

}