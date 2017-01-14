<?php
/**
 * Plugin Name: ILC Product Slider
 * Plugin URI: http://goo.gl/Kotx0
 * Description: Creates a carousel to display products from WooCommerce. Downloaded from <a href="http://www.96down.com">96DoWn.com</a>
 * Author: Elio Rivero
 * Author URI: http://themesrobot.com/
 * Version: 1.0.5
 */

/**
 * 1.0.5 Jul 11 2013 	Added woocommerce CSS class on carousel to obtain default WC styles.
 * 						Added options in admin and shortcode to control the pause and number of items to scroll.
 * 1.0.4 Jul 08 2013 	Handles products on Sale.
 * 1.0.3 Jun 06 2013 	Fixed issue with checkboxes in settings page when they were unchecked and saved.
 * 1.0.2 Feb 20 2013 	Added code for upcoming Woocommerce 2.0.
 * 1.0.1 Jul 29 2012 	Changed hardcoded parameter so it grabs dynamic attribute from shortcode.
 * 						Removed trailing slash where it wasn't really needed.
 * 1.0.0 Jul 24 2012 	First Release
 */
// Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	class ILC_Product_Slider{
		
		static $version = '1.0.5';
		
		function __construct(){
			
			$basefile = plugin_dir_path(__FILE__) . '/' . basename(__FILE__);
			
			//Load localization file
			add_action('plugins_loaded', array(&$this, 'localization'));
			
			//Create Settings Page
			require_once ('ilc-admin.php');
			global $ilc_ps;
			$ilc_ps = new ILCPSAdmin( array(
				'basefile' => $basefile
			) );
			
			//Create shortcode
			require_once ('ilc-shortcode.php');
			new ILCPSShortcode(  array(
				'version' => self::$version
			));
			
		}
		
		function localization() {
			load_plugin_textdomain( 'ilc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
		}
		
		function get_base_file(){
			return self::$basefile;
		}
	}
	
	// Initialize product slider
	new ILC_Product_Slider();
	
	// Include debugging utility.
	require_once ('ilc-utils.php');
	
} else {
	add_action( 'admin_notices', create_function('', "echo '<div class=\"update-nag fade-out\">You must have <strong>WooCommerce installed and activated</strong> for Product Slider to work.</div>';") );
}


?>