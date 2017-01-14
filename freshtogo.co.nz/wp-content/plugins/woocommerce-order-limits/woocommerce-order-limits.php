<?php
/**
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 *
 * Plugin Name:       Woocommerce Purchase Limits
 * Plugin URI:        http://codeninjas.co/plugins/woocommerce-purchase-limits
 * Description:       Set limits on what and how much can be bought from your Woocommerce store.
 * Version:           1.2
 * Author:            Code Ninjas
 * Author URI:        http://codeninjas.co
 * Documentation URI: http://docs.codeninjas.co/documentation/woocommerce-pruchase-limits
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'Woocommerce_Purchase_Limits' ) ){

class Woocommerce_Purchase_Limits
{
	/**
	 * Plugin version
	 *
	 * @since   1.0.0
	 */
	public $version = '1.2';
	
	/**
	 * Required version of Wordpress
	 *
	 * @since   1.0.0
	 */
	protected $required_wp_version = '3.5';
	
	/**
	 * Plugins that are required by this plugin
	 *
	 * @since 1.0.0
	 */
	protected $required_plugins = array(
        array(
            'name'    => 'Woocommerce',
            'slug'    => 'woocommerce/woocommerce.php',
            'version' => '2.0'
        )
    );

	/**
	 * Plugin slug
	 *
	 * @since	1.1.0
	 */
	protected $plugin_slug = 'woocommerce-order-limits';

	/**
	 * Instance of this class.
	 *
	 * @since	1.1.0
	 */
	protected static $instance = null;
	
	/**
	 * Admin notice errors
	 *
	 * since 1.0.0
	 */
	protected $errors = array(
        'dependency_not_installed' => 
			'<strong>%2$s</strong> has been deactivated because <strong>%1$s</strong> is not installed.  Please install and activate <strong>%1$s</strong> before activating <strong>%2$s</strong>.',
        'dependency_not_active' => 
			'<strong>%2$s</strong> has been deactivated because <strong>%1$s</strong> is currently inactive.  Please activate <strong>%1$s</strong> before activating <strong>%2$s</strong>.',
        'dependency_wrong_version' => 
			'<strong>%1$s</strong> requires <strong>%2$s %3$s</strong> or greater.  Please update <strong>%2$s</strong> before activating <strong>%1$s</strong>.',
        'wordpress_wrong_version' => 
			'<strong>%1$s</strong> requires <strong>Wordpress %2$s</strong> or greater. Please update Wordpress before activating <strong>%1$s</strong>.'
    );
	
	/**
	 * Admin notices to be output
	 *
	 * since 1.0.0
	 */
    public static $admin_notices = array();

	/**
	 * Initialize the plugin
	 *
	 * @since	1.0.0
	 */
	public function __construct() {
		
		if( !$this->check_requirements() )
			return;
		
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		
		//Constants
		DEFINE( 'WPL_VERSION', $this->version );
		DEFINE( 'WPL_DIR', plugin_dir_path( __FILE__ ) ); 
		DEFINE( 'WPL_BASE', plugin_basename( __FILE__ ) );
		DEFINE( 'WPL_FULL_PATH', __FILE__ ); 
		DEFINE( 'WPL_URI', trailingslashit( WP_PLUGIN_URL ) . $this->plugin_slug );		
		
		//Includes
		include 'includes/wpl-common.class.php';
		include 'includes/wpl-common-product.class.php';
		include 'includes/wpl-common-cart.class.php';
		include 'includes/wpl-common-category.class.php';

		//Initialise frontend/admin
		if ( is_admin() ) {

			require_once( WPL_DIR . 'admin/wpl-admin.class.php' );
			add_action( 'plugins_loaded', array( 'WPL_Admin', 'get_instance' ) );
			
			// Add extra action links 
			add_action( 'extra_plugin_headers', array( $this, 'extra_plugin_headers' ) );
			add_filter( 'plugin_action_links_' . WPL_BASE, array( $this, 'add_action_links' ) );
			
		} else {
		
			require_once( WPL_DIR . 'frontend/wpl.class.php' );
			add_action( 'plugins_loaded', array( 'WPL_Frontend', 'get_instance' ) );
			
		}
		
	}
	
	/**
	 * Return the plugin slug.
	 *
	 * @since   1.0.0
	 *
	 * @return	string	Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return	object	A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	public static function activate( ) {
		
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate( ) {

	}
	
	/**
    * Checks that the WordPress setup meets the plugin requirements
    *
    * @return boolean
	*
	* @since 1.0.0
    */
    public function check_requirements()
    {   
        $return = true;

        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        $plugin = get_plugin_data( __FILE__ );

        //Wordpress version
        global $wp_version;
        if ( ! version_compare( $wp_version, $this->required_wp_version, '>=' ) ) {
            self::$admin_notices[] = array( 'error' => sprintf( $this->errors['wordpress_wrong_version'], $plugin['Name'], $this->required_wp_version ) );
            $return = false;
        }

        //Dependencies
        if( !empty( $this->required_plugins ) ){

            $installed_plugins = get_plugins();     
            foreach( $this->required_plugins as $dependency ){ 
                //dependency installed?
                if( array_key_exists( $dependency['slug'], $installed_plugins ) ){
                    //dependency active?
                    if( is_plugin_active( $dependency['slug'] ) ){
                        //dependency version?
                        if( isset( $dependency['version'] ) ){
                            $dependency_current_version = $installed_plugins[$dependency['slug']]['Version'];
                            if( version_compare( $dependency_current_version, $dependency['version'], '<' ) ){
                                //wrong dependency version
                                self::$admin_notices[] = array( 'error' => sprintf( $this->errors['dependency_wrong_version'], $plugin['Name'], $dependency['name'], $dependency['version'] ) );
                                $return = false;
                            } 
                        }

                    } else { //dependency not active
                        self::$admin_notices[] = array( 'error' => sprintf( $this->errors['dependency_not_active'], $dependency['name'], $plugin['Name'] ) );
                        $return = false;
                    }

                } else { //dependency not installed
                    self::$admin_notices[] = array( 'error' => sprintf( $this->errors['dependency_not_installed'], $dependency['name'], $plugin['Name'] ) );
                    $return = false;
                }

            }

        }
        
        if( $return == false ){
            add_action( 'admin_notices', array( $this, 'display_admin_notices' ) );
            deactivate_plugins( __FILE__ ); //if anything wrong above, deactivate plugin
        }

        return $return;
    }
	
	/**
    * Display the requirement notice
	*
	* @since 1.0.0
    */
    public function display_admin_notices()
    {
        foreach(self::$admin_notices as $notice){
            echo '<div class="'.key($notice).'"><p>'.$notice[key($notice)].'</p></div>';
        }
		self::$admin_notices = array();
    }
	
	/**
    * Add extra plugin header info
	*
    * @param array $headers
    * @return array 
	*
	* @since 1.0.0
    */
    public function extra_plugin_headers($headers){
	
        $headers['Documentation URI'] = 'Documentation URI';
        return $headers;
		
    }
	
	/**
	 * Add action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		$plugin_data = get_plugin_data( __FILE__ );
	
		return array_merge(
			array(
				'documentation' => '<a href="' . $plugin_data['Documentation URI'] . '">' . __( 'Documentation', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

} /* class Woocommerce_Purchase_Limits */

return new Woocommerce_Purchase_Limits();

} /* class_exists Woocommerc_Purchase_Limits */
