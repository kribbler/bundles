<?php /*
    Plugin Name: Woo BIL Checker
    Plugin URI: http://bil.no
    Description: Woo Oku Checker
    Version: 1
    Author: Daniel Oraca
    Author URI: 
    Text Domain: wobil-checker
    
*/

	class Wobil_Checker {
        
        public function __construct() {
            add_action( 'init', array( 'Wobil_Checker', 'translations' ), 1 );
            add_action('admin_menu', array('Wobil_Checker', 'admin_menu'));
            add_action('wp_ajax_wobil-checker-ajax', array('Wobil_Checker', 'render_ajax_action'));
            add_action('wp_ajax_wobil-checker-ajax-delete', array('Wobil_Checker', 'render_ajax_action_delete'));
        }

		public function translations() {
            load_plugin_textdomain( 'wobil-checker', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }
        
        public function admin_menu() {
            add_management_page( __( 'WoBIL Product Checker', 'wobil-checker' ), __( 'WoBIL Checker', 'wobil-checker' ), 'manage_options', 'wobil-checker', array('Wobil_Checker', 'render_admin_action'));
        }
        
        public function render_admin_action() {
			$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'init';
			require_once(plugin_dir_path(__FILE__).'wobil-checker-common.php');
			require_once(plugin_dir_path(__FILE__)."wobil-checker-{$action}.php");
        }
        
        public function render_ajax_action() {
        	require_once(plugin_dir_path(__FILE__).'wobil-checker-common.php');
            require_once(plugin_dir_path(__FILE__)."wobil-checker-ajax.php");
            die(); // this is required to return a proper result
        }
        
		public function render_ajax_action_delete() {
        	require_once(plugin_dir_path(__FILE__).'wobil-checker-common.php');
            require_once(plugin_dir_path(__FILE__)."wobil-checker-ajax-delete.php");
            die(); // this is required to return a proper result
        }
    }
    
    $Wobil_checker = new Wobil_Checker();