<?php

/*
Plugin Name: Woocommerce SEO
Plugin URI: http://codeninjas.co/plugins/woocommerce-seo
Description: An SEO plugin for Woocommerce
Version: 1.1.3
Author: Code Ninjas
Author URI: http://codeninjas.co
Documentation URI: http://docs.codeninjas.co/woocommerce-seo/
*/

include_once 'classes/base.class.php';

//Constants
DEFINE( 'WOOCOM_CAT_BASE_DEFAULT', 'product-category' );
DEFINE( 'WOOCOM_SEO_BASENAME', plugin_basename( __FILE__ ) );

class Woocommerce_Seo extends Code_Ninjas_Base_Class{
    
    public function __construct() {   
        //required plugins
        $this->add_required_plugin( array(
            'name' => 'Woocommerce',
            'slug' => 'woocommerce/woocommerce.php',
            'min_version' => '1.5'
        ) );
        
        //run the checks
        parent::__construct( plugin_basename(__FILE__) ); 
        
        if($this->everything_ok()){ //if everything is ok with parent, continue with plugin init

            add_action( 'init', array( $this, 'flush_rewrite_rules_check' ), 100 );
            add_action( 'woocommerce_settings_saved', array( $this, 'clear_caches' ) );

            add_action( 'init', array( $this, 'change_category_base' ) );
            add_filter( 'rewrite_rules_array', array( $this, 'create_category_rules' ) );

            //widgets
            include 'woocommerce-seo-widgets.php';
            add_filter( 'init', 'woocommerce_seo_layered_nav_init', 1 );
            add_action( 'widgets_init', 'woocommerce_seo_register_widgets', 100 );
            add_filter( 'rewrite_rules_array', 'woocommerce_seo_add_to_rules_array' );
            add_filter( 'query_vars', 'woocommerce_seo_add_query_vars' );
            add_filter( 'request', 'woocommerce_seo_set_chosen_attributes');
    
            
            if ( is_admin() ){
                include_once( 'admin/admin-init.php' );
            } else {
                //head
                include 'woocommerce-seo-head.php';
                add_filter( 'wp_title', 'woocommerce_seo_filter_page_title', 10, 3 );
                add_action( 'wp_head', 'woocommerce_seo_output_head', 0 );
            
                //breadcrumbs
                include 'woocommerce-seo-breadcrumbs.php';
                add_action('wp', 'woocommerce_seo_enable_breadcrumbs');
                add_action('wp', 'woocommerce_seo_save_selected_filters');
            }
            
        }
    }
    
    
    
    /**
     * Run when plugin is activated 
     */
    function activate_plugin() {
        if($this->everything_ok()){
            //check if woocommerce is active
            //if( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) wp_die( 'Woocommerce is not installed or is inactive.  Please install/activate Woocommerce before activating the Woocommerce SEO Plugin', 'Woocommerce SEO Error', array( 'back_link' => true ) );
            //set some defaults
            add_option( 'woocommerce_seo_flush_rules', 0 );
            self::clear_caches();
            update_option('woocommerce_seo_flush_rules', 1);
        }
    }
    
    /**
     * Removes category base regardless of what its been set as in woocommerce settings
     * 
     * @global object $wp_rewrite Wordpress rewrite object
     * @param string $base Base to manually set
     * 
     * @version 1.1.2 - Removed code to change base to something as not needed/used anywhere anymore and rewrote function
     */
    function change_category_base( $args ){

        if( get_option( 'woocommerce_seo_remove_product_category_base' ) == 'yes' ){
           
            global $wp_rewrite, $wp_taxonomies;
            //change rewrite slug value for the taxonomy
            if( isset( $wp_taxonomies['product_cat'] ) )
                $wp_taxonomies['product_cat']->rewrite['slug'] = '';
                
            if( isset( $wp_rewrite->extra_permastructs['product_cat'] ) ){
                if( array_key_exists( 'struct', $wp_rewrite->extra_permastructs['product_cat'] ) ) $wp_rewrite->extra_permastructs['product_cat']['struct'] = '%product_cat%';
                else $wp_rewrite->extra_permastructs['product_cat']['0'] = '%product_cat%';
            }
           
        }        
    }

    /**
     * Not having any base infront of the category name cause a conflict with pagename (wp searches for pagename as a product category).
     * Function will add spcific rules for each category if the user has chosen to remove the product base AND not prepend shop base.
     * If any of these bases are added, nothing will be changed.
     *
     * @param array $rules Current set of rules
     * @return array
     */
    function create_category_rules($rules){
       
        if( get_option( 'woocommerce_seo_remove_product_category_base' ) == 'yes' ){

            //These rules are generated from changing the product category base to nothing and conflict with wordpress pages
            unset( $rules['(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$'] );
            unset( $rules['(.+?)/(feed|rdf|rss|rss2|atom)/?$'] );
            unset( $rules['(.+?)/page/?([0-9]{1,})/?$'] );
            unset( $rules['(.+?)/?$'] );

            //Generate rules for each product category
            $args = array( 'hide_empty' => 0 );
            $categories = get_terms( 'product_cat', $args );

            $category_rules = array();
            foreach( $categories as $category ){
                
                $link = str_ireplace(site_url("/"), "", rtrim(get_term_link($category), "/"));
                 
                $category_rules["($link)/feed/(feed|rdf|rss|rss2|atom)/?$"] = 'index.php?product_cat=$matches[1]&feed=$matches[2]';
                $category_rules["($link)/(feed|rdf|rss|rss2|atom)/?$"] = 'index.php?product_cat=$matches[1]&feed=$matches[2]';
                $category_rules["($link)/page/?([0-9]{1,})/?$"] = 'index.php?product_cat=$matches[1]&paged=$matches[2]';
                $category_rules["($link)/?$"] = 'index.php?product_cat=$matches[1]';
                
            }

            $rules = $category_rules + $rules;
        }
  
        return $rules;
    }
    
    /**
     * Flush rewrite rules if flag is set 
     */ 
    function flush_rewrite_rules_check(){
        if( get_option( 'woocommerce_seo_flush_rules' ) == 1 ){
            $this->flush_rewrite_rules();
            update_option( 'woocommerce_seo_flush_rules', 0 );
        }
    }
    
    /**
     * Flush rewrite rules
     * 
     * @global object $wp_rewrite Wordpress rewrites object
     */
    function flush_rewrite_rules(){
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }
    
    /**
     * Clears cache and Woocommerce SEO rewrite rules 
     */
    function clear_caches(){
    	//echo 'dan-seo latest';die();
        update_option( 'woocommerce_seo_rewrite_rules', json_encode( array() ) );
        self::flush_rewrite_rules();
    }

}

$woocommerce_seo = new Woocommerce_Seo();
register_activation_hook( __FILE__, array( $woocommerce_seo, 'activate_plugin' ) );

/**
 * Automatic updates for plugin
 * Full credit to Janis Elsts @ http://w-shadow.com/ for this class 
 */
require 'classes/update.class.php';
$woocommerce_seo_updates = new PluginUpdateChecker(
    'http://updates.codeninjas.co?key=65f4e75d-1e89-43cb-945f-924cb61a698f',
    __FILE__
);

?>
