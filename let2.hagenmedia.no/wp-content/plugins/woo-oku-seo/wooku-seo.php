<?php /*
    Plugin Name: Woo OKU Seo
    Plugin URI: http://oku.no
    Description: This plugin sends found metaset to Wooku All in One SEO Pack 
    Version: 1
    Author: Daniel Oraca
    Author URI: 
    Text Domain: wooku-seo
    
*/

	class Wooku_Seo {
        
        public function __construct() {
            add_action( 'init', array( 'Wooku_Seo', 'translations' ), 1 );
            add_action('admin_menu', array('Wooku_Seo', 'admin_menu'));
            add_action( 'wooku_check_vars', array( &$this, 'check_seo_query_vars' ) );
            //add_action('wp_ajax_wooku-attributes-ajax', array('Wooku_Attributes', 'render_ajax_action'));
            //add_action('wp_ajax_wooku-attributes-ajax-delete', array('Wooku_Attributes', 'render_ajax_action_delete'));
			require_once(plugin_dir_path(__FILE__).'wooku-seo-common.php');
        }

		public function translations() {
            load_plugin_textdomain( 'wooku-seo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }
        
        public function admin_menu() {
            add_management_page( __( 'WoOKU Seo', 'wooku-seo' ), __( 'WoOKU Seo', 'wooku-seo' ), 'manage_options', 'wooku-seo', array('Wooku_Seo', 'render_admin_action'));
        }
        
        public function render_admin_action() {
			$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'init';
			require_once(plugin_dir_path(__FILE__).'wooku-seo-common.php');
			require_once(plugin_dir_path(__FILE__)."wooku-seo-{$action}.php");
        }
        
        //public function render_ajax_action() {
        //	require_once(plugin_dir_path(__FILE__).'wooku-attributes-common.php');
        //    require_once(plugin_dir_path(__FILE__)."wooku-attributes-ajax.php");
        //    die(); // this is required to return a proper result
        //}
        
		//public function render_ajax_action_delete() {
        //	require_once(plugin_dir_path(__FILE__).'wooku-attributes-common.php');
        //    require_once(plugin_dir_path(__FILE__)."wooku-attributes-ajax-delete.php");
        //    die(); // this is required to return a proper result
        //}
        
        public function check_seo_query_vars($query_vars){
            global $metaset;
            require_once(plugin_dir_path(__FILE__).'wooku-seo-common.php');
            if (isset($query_vars['product_cat'])){

            }

            $cat = "";

            foreach ($query_vars as $key=>$value){
                    if ($key == 'product_cat'){
                            $cat = $value;
                    }
            }

            if ($cat) {
                    $metaset = wp_find_metaset($cat, NULL);
            }

            //pr($query_vars);
            echo 'here on wooku seo';pr($metaset);
        	
        }
    }
    
    $Wooku_seo = new Wooku_Seo();