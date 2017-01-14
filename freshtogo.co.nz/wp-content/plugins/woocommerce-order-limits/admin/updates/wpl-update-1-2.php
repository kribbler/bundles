<?php
/*
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 *
 * Update to Version 1.2
 * - Change option name wpl_cart_enabled to wpl_cart_value_limit_enabled
 * - Change option name wpl_product_enabled to wpl_product_quantity_limit_enabled
 */

global $wpdb;

//Change wpl_cart_enabled to wpl_cart_value_limit_enabled
$set = array( 'option_name' => 'wpl_cart_value_limit_enabled' );
$where = array( 'option_name' => 'wpl_cart_enabled' );
$wpdb->update( $wpdb->options, $set, $where );

//Change wpl_cart_enabled to wpl_cart_value_limit_enabled
$set = array( 'option_name' => 'wpl_product_quantity_limit_enabled' );
$where = array( 'option_name' => 'wpl_product_enabled' );
$wpdb->update( $wpdb->options, $set, $where );
