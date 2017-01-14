<?php
/**
 * Admin init logic
 *
 * @author   Actuality Extensions
 * @package  WooCommerce_Customer_Relationship_Manager
 * @since    1.0
 */


if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( 'customers.php' );

add_action( 'admin_menu', 'wc_customer_relationship_manager_add_menu' );

/**
 * Add the menu item
 */
function wc_customer_relationship_manager_add_menu() {

	global $wc_customer_relationship_manager;

	$hook = add_submenu_page( 'woocommerce', // parent menu
		__( 'Customer Relationship Manager', 'wc_customer_relationship_manager' ), // page title
		__( 'Customer Relationship Manager', 'wc_customer_relationship_manager' ), // menu title
		'manage_woocommerce', // capability
		$wc_customer_relationship_manager->id, // unique menu slug
		'wc_customer_relationship_manager_render_list_page' ); // callback

	add_action( "load-$hook", 'wc_customer_relationship_manager_add_options' );

}

