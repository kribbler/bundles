<?php /*
    Plugin Name: Woo BIL Importer
    Plugin URI: http://hagenmedia.no
    Description: Free CSV import utility for WooCommerce
    Version: 1.1
    Author: Hagen Media
    Author URI: 
    Text Domain: wobil-importer
    Domain Path: /languages/
*/

    class Wobil_Importer {
        
        public function __construct() {
            add_action( 'init', array( 'Wobil_Importer', 'translations' ), 1 );
            add_action('admin_menu', array('Wobil_Importer', 'admin_menu'));
            add_action('wp_ajax_wobil-importer-ajax', array('Wobil_Importer', 'render_ajax_action'));
			add_action('wp_ajax_wobil-importer-check-duplicate', array('Wobil_Importer', 'render_ajax_action_check_duplicate'));
        }

        public function translations() {
            load_plugin_textdomain( 'wobil-importer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        public function admin_menu() {
            add_management_page( __( 'WoBIL Product Importer', 'wobil-importer' ), __( 'WoBIL Importer', 'wobil-importer' ), 'manage_options', 'wobil-importer', array('Wobil_Importer', 'render_admin_action'));
        }
        
        public function render_admin_action() {
            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'upload';
            require_once(plugin_dir_path(__FILE__).'wobil-importer-common.php');
            require_once(plugin_dir_path(__FILE__)."wobil-importer-{$action}.php");
        }
        
        public function render_ajax_action() {
            require_once(plugin_dir_path(__FILE__)."wobil-importer-ajax.php");
            die(); // this is required to return a proper result
        }

		public function render_ajax_action_check_duplicate(){
			require_once(plugin_dir_path(__FILE__)."check_duplicate.php");
			die();
		}
    }
    
    $Wobil_importer = new Wobil_Importer();
