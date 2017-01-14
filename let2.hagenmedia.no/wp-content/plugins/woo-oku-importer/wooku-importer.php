<?php /*
    Plugin Name: Woo OKU Importer
    Plugin URI: http://oku.no
    Description: Free CSV import utility for WooCommerce
    Version: 1.1
    Author: Daniel Oraca
    Author URI: 
    Text Domain: wooku-importer
    Domain Path: /languages/
*/

    class Wooku_Importer {
        
        public function __construct() {
            add_action( 'init', array( 'Wooku_Importer', 'translations' ), 1 );
            add_action('admin_menu', array('Wooku_Importer', 'admin_menu'));
            add_action('wp_ajax_wooku-importer-ajax', array('Wooku_Importer', 'render_ajax_action'));
			add_action('wp_ajax_wooku-importer-check-duplicate', array('Wooku_Importer', 'render_ajax_action_check_duplicate'));
        }

        public function translations() {
            load_plugin_textdomain( 'wooku-importer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        public function admin_menu() {
            add_management_page( __( 'WoOKU Product Importer', 'wooku-importer' ), __( 'WoOKU Importer', 'wooku-importer' ), 'manage_options', 'wooku-importer', array('Wooku_Importer', 'render_admin_action'));
        }
        
        public function render_admin_action() {
            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'upload';
            require_once(plugin_dir_path(__FILE__).'wooku-importer-common.php');
            require_once(plugin_dir_path(__FILE__)."wooku-importer-{$action}.php");
        }
        
        public function render_ajax_action() {
            require_once(plugin_dir_path(__FILE__)."wooku-importer-ajax.php");
            die(); // this is required to return a proper result
        }

		public function render_ajax_action_check_duplicate(){
			require_once(plugin_dir_path(__FILE__)."check_duplicate.php");
			die();
		}
    }
    
    $Wooku_importer = new Wooku_Importer();
