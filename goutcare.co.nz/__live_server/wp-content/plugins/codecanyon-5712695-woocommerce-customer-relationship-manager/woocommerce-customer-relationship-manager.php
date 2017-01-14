<?php
/*
Plugin Name: WooCommerce Customer Relationship Manager
Plugin URI: http://actualityextensions.com/
Description: Allows for better overview of WooCommerce customers, communication with customers, listing amount spent by customers for certain period and more!
Author: Actuality Extensions
Version: 1.3.2
Author URI: http://actualityextensions.com/
Developer: Rene Puchinger
Owner: Ali Razzaq
Designer: Ali Razzaq
License: GPL3


    Copyright (C) 2013  Actuality Extensions

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

 @author   Actuality Extensions
 @package  WooCommerce_Customer_Relationship_Manager
 @since    1.0

*/

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return; // Check if WooCommerce is active

require_once( plugin_dir_path( __FILE__ ) . 'functions.php' );

if ( !class_exists( 'MCAPI_Wc_Crm' ) ) {
	require_once( 'admin/classes/api/MCAPI.class.php' );
}
if ( !class_exists( 'WooCommerce_Customer_Relationship_Manager' ) ) {

	class WooCommerce_Customer_Relationship_Manager {

		public function __construct() {

			$this->current_tab = ( isset( $_GET['tab'] ) ) ? $_GET['tab'] : 'general';

			// settings tab
			$this->settings_tabs = array(
				'customer_relationship' => __( 'Customer Relationship', 'wc_customer_relationship_manager' )
			);

			add_action( 'admin_enqueue_scripts', array($this, 'enqueue_dependencies_admin') );

			add_action( 'woocommerce_settings_tabs', array($this, 'add_tab'), 10 );

			// Run these actions when generating the settings tabs.
			foreach ( $this->settings_tabs as $name => $label ) {
				add_action( 'woocommerce_settings_tabs_' . $name, array($this, 'settings_tab_action'), 10 );
				add_action( 'woocommerce_update_options_' . $name, array($this, 'save_settings'), 10 );
			}

			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array($this, 'action_links') );

			// Add the settings fields to each tab.
			add_action( 'woocommerce_customer_relationship_settings', array($this, 'add_settings_fields'), 10 );

			add_action( 'woocommerce_init', array($this, 'includes') );
			add_action( 'wc_crm_restrict_list_customers', array($this, 'woocommerce_crm_restrict_list_customers') );
			add_action( 'wp_ajax_woocommerce_crm_json_search_customers', array($this, 'woocommerce_crm_json_search_customers') );
			add_filter( 'woocommerce_shop_order_search_fields', array($this, 'woocommerce_crm_search_by_email') );
			add_filter( 'views_edit-shop_order', array($this, 'views_shop_order') );
			add_action( 'admin_post_export_csv', array($this, 'export_csv') );
		}

		/**
		 * The plugin's id
		 * @var string
		 */
		var $id = 'wc-customer-relationship-manager';

		/**
		 * Enqueue admin CSS and JS dependencies
		 */
		public function enqueue_dependencies_admin() {
			wp_enqueue_script( array('jquery', 'editor', 'thickbox', 'media-upload') );
			wp_enqueue_style( 'thickbox' );
			wp_register_script( 'textbox_js', plugins_url( 'assets/js/TextboxList.js', __FILE__ ), array('jquery') );
			wp_enqueue_script( 'textbox_js' );
			wp_register_script( 'growing_input', plugins_url( 'assets/js/GrowingInput.js', __FILE__ ), array('jquery') );
			wp_enqueue_script( 'growing_input' );
			wp_register_style( 'textbox_css', plugins_url( 'assets/css/TextboxList.css', __FILE__ ) );
			wp_enqueue_style( 'textbox_css' );
			wp_register_style( 'woocommerce-customer-relationship-style-admin', plugins_url( 'assets/css/admin.css', __FILE__ ), array('textbox_css') );
			wp_enqueue_style( 'woocommerce-customer-relationship-style-admin' );
			wp_register_script( 'woocommerce-customer-relationship-script-admin', plugins_url( 'assets/js/admin.js', __FILE__ ), array('jquery', 'textbox_js', 'growing_input') );
			wp_enqueue_script( 'woocommerce-customer-relationship-script-admin' );
			wp_register_style( 'woocommerce_frontend_styles', plugins_url() . '/woocommerce/assets/css/admin.css' );
			wp_enqueue_style( 'woocommerce_frontend_styles' );
			wp_register_script( 'woocommerce_admin', plugins_url() . '/woocommerce/assets/js/admin/woocommerce_admin.min.js', array('jquery', 'jquery-blockui', 'jquery-placeholder', 'jquery-ui-sortable', 'jquery-ui-widget', 'jquery-ui-core', 'jquery-tiptip') );
			wp_enqueue_script( 'woocommerce_admin' );
			wp_register_script( 'woocommerce_tiptip_js', plugins_url() . '/woocommerce/assets/js/jquery-tiptip/jquery.tipTip.min.js' );
			wp_enqueue_script( 'woocommerce_tiptip_js' );
			wp_register_script( 'chosen_js', plugins_url( 'assets/js/chosen.jquery.min.js', __FILE__ ), array('jquery') );
			wp_enqueue_script( 'chosen_js' );
			wp_register_script( 'ajax-chosen_js', plugins_url( 'assets/js/ajax-chosen.jquery.min.js', __FILE__ ), array('jquery', 'chosen') );
			wp_enqueue_script( 'ajax-chosen_js' );
			add_thickbox();
		}

		/**
		 * Add action links under WordPress > Plugins
		 *
		 * @param $links
		 * @return array
		 */
		public function action_links( $links ) {

			$plugin_links = array(
				'<a href="' . admin_url( 'admin.php?page=woocommerce&tab=customer_relationship' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>',
			);

			return array_merge( $plugin_links, $links );
		}

		/**
		 * Add the tab under WooCommerce menu.
		 *
		 * @access public
		 * @return void
		 */
		public function add_tab() {
			foreach ( $this->settings_tabs as $name => $label ) {
				$class = 'nav-tab';
				if ( $this->current_tab == $name )
					$class .= ' nav-tab-active';
				echo '<a href="' . admin_url( 'admin.php?page=woocommerce&tab=' . $name ) . '" class="' . $class . '">' . $label . '</a>';
			}
		}

		/**
		 * Action to include the settings.
		 *
		 * @access public
		 * @return void
		 */
		public function settings_tab_action() {
			global $woocommerce_settings;

			// Determine the current tab in effect.
			$current_tab = $this->get_tab_in_view( current_filter(), 'woocommerce_settings_tabs_' );

			// Hook onto this from another function to keep things clean.
			do_action( 'woocommerce_customer_relationship_settings' );

			// Display settings for this tab (make sure to add the settings to the tab).
			woocommerce_admin_fields( $woocommerce_settings[$current_tab] );
		}

		/**
		 * Save settings in a single field in the database for each tab's fields (one field per tab).
		 */
		function save_settings() {
			global $woocommerce_settings;

			// Make sure our settings fields are recognised.
			$this->add_settings_fields();

			$current_tab = $this->get_tab_in_view( current_filter(), 'woocommerce_update_options_' );
			woocommerce_update_options( $woocommerce_settings[$current_tab] );
		}

		/**
		 * Include required files
		 */
		public function includes() {
			if ( is_admin() ) {
				require_once( 'admin/admin-init.php' ); // Admin section
			}
		}

		/**
		 * Handle CSV file download
		 */
		function export_csv() {

			global $orders_data, $order_countries;

			woocommerce_crm_get_orders_data();

			if ( !current_user_can( 'manage_options' ) )
				return;

			header( 'Content-Type: application/csv' );
			header( 'Content-Disposition: attachment; filename=customers_' . date( 'Y-m-d' ) . '.csv' );
			header( 'Pragma: no-cache' );

			echo "customer_name,email,phone,username,first_purchase,last_purchase,number_of_orders,total_value,subscribed_to_newsletter\n";
			foreach ( $orders_data as $email => $item ) {
				$user = @get_userdata( $item['user_id'] );
				echo '"' . $item['name'] . '","' . $email . '","' . $item['phone'] . '","' . ( isset( $user->user_login ) ? $user->user_login : __( 'Guest', 'wc_customer_relationship_manager' ) ) . '","'
					. woocommerce_crm_get_pretty_time( $item['first_purchase_id'], true ) . '","' . woocommerce_crm_get_pretty_time( $item['last_purchase_id'], true ) . '","'
					. $item['num_orders'] . '","' . $item['value'] . '","' . $item['enrolled_plain'] . "\"\n";
			}

		}

		/**
		 * Provides the select boxes to filter Customers, Country and Time Period.
		 *
		 */
		public function woocommerce_crm_restrict_list_customers() {
			global $wp_query, $woocommerce, $orders_data, $order_countries, $order_products;

			woocommerce_crm_get_orders_data();

			?>

			<div class="alignleft actions">
				<select id="dropdown_customers" name="_customer_user">
					<option value=""><?php _e( 'Show all customers', 'wc_customer_relationship_manager' ) ?></option>
					<?php
					if ( !empty( $_POST['_customer_user'] ) ) {
						$user = $_POST['_customer_user'];
						echo '<option value="' . $user . '" ';
						selected( 1, 1 );
						echo '>' . $user . '</option>';
					}
					?>
				</select>

				<select name='_customer_product' id='dropdown_product'>
					<option value=""><?php _e( 'Show all products', 'wc_customer_relationship_manager' ); ?></option>
					<?php

					foreach ( $order_products as $product_id => $count ) {
						$product = get_product($product_id);
						if( empty( $product ) ) {
							continue;
						}
						echo '<option value="' . $product->id . '" ';
						if ( !empty( $_POST['_customer_product'] ) && $_POST['_customer_product'] == $product->id ) {
							echo 'selected';
						}
						echo '>' . esc_html__( $product->get_title() ) . '</option>';
					}
					?>
				</select>

				<select name='_customer_country' id='dropdown_country'>
					<option value=""><?php _e( 'Show all countries', 'wc_customer_relationship_manager' ); ?></option>
					<?php

					foreach ( $order_countries as $country => $count ) {
						echo '<option value="' . $country . '" ';
						if ( !empty( $_POST['_customer_country'] ) && $_POST['_customer_country'] == $country ) {
							echo 'selected';
						}
						echo '>' . esc_html__( $country ) . ' - ' . $woocommerce->countries->countries[$country] . ' (' . absint( $count ) . ')</option>';
					}
					?>
				</select>

				<select name='_customer_date_from' id='dropdown_date_from'>
					<option value=""><?php _e( 'All time results', 'wc_customer_relationship_manager' ); ?></option>
					<option
						value="<?php echo date( 'Y-m-01 00:00:00', strtotime( 'this month' ) ); ?>" <?php if ( !empty( $_POST['_customer_date_from'] ) && date( 'Y-m-01 00:00:00', strtotime( 'this month' ) ) == $_POST['_customer_date_from'] ) {
						echo "selected";
					} ?> ><?php _e( 'This month', 'wc_customer_relationship_manager' ); ?></option>
					<option
						value="<?php echo date( 'Y-m-d 00:00:00', strtotime( '-30 days' ) ); ?>" <?php if ( !empty( $_POST['_customer_date_from'] ) && date( 'Y-m-d 00:00:00', strtotime( '-30 days' ) ) == $_POST['_customer_date_from'] ) {
						echo "selected";
					} ?> ><?php _e( 'Last 30 days', 'wc_customer_relationship_manager' ); ?></option>
					<option
						value="<?php echo date( 'Y-m-d 00:00:00', strtotime( '-6 months' ) ); ?>" <?php if ( !empty( $_POST['_customer_date_from'] ) && date( 'Y-m-d 00:00:00', strtotime( '-6 months' ) ) == $_POST['_customer_date_from'] ) {
						echo "selected";
					} ?> ><?php _e( 'Last 6 months', 'wc_customer_relationship_manager' ); ?></option>
					<option
						value="<?php echo date( 'Y-m-d 00:00:00', strtotime( '-12 months' ) ); ?>" <?php if ( !empty( $_POST['_customer_date_from'] ) && date( 'Y-m-d 00:00:00', strtotime( '-12 months' ) ) == $_POST['_customer_date_from'] ) {
						echo "selected";
					} ?>><?php _e( 'Last 12 months', 'wc_customer_relationship_manager' ); ?></option>
				</select>

				<input type="submit" id="post-query-submit" class="button action" value="Filter"/>

				<?php
				$_customer_user = isset( $_POST['_customer_user'] ) ? $_POST['_customer_user'] : '';
				$_customer_country = isset( $_POST['_customer_country'] ) ? $_POST['_customer_country'] : '';
				$_customer_date_from = isset( $_POST['_customer_date_from'] ) ? $_POST['_customer_date_from'] : '';
				?>

				<a class="button action"
				   href="<?php echo admin_url( "admin-post.php?action=export_csv&_customer_user=$_customer_user&_customer_country=$_customer_country&_customer_date_from=$_customer_date_from" ); ?>"><?php _e( 'Export Contacts', 'wc_customer_relationship_manager' ); ?></a>

			</div>

			<?php

			$js = "

                jQuery('select#dropdown_product').css('width', '260px').chosen();

                jQuery('select#dropdown_country').css('width', '220px').chosen();

                jQuery('select#dropdown_date_from').css('width', '140px').chosen();

                jQuery('select#dropdown_customers').css('width', '250px').ajaxChosen({
                    method: 		'GET',
                    url: 			'" . admin_url( 'admin-ajax.php' ) . "',
                    dataType: 		'json',
                    afterTypeDelay: 100,
                    minTermLength: 	1,
                    data:		{
                        action: 	'woocommerce_crm_json_search_customers',
                        security: 	'" . wp_create_nonce( "search-customers" ) . "',
                        default:	'" . __( 'Show all customers', 'wc_customer_relationship_manager' ) . "',
                    }
                }, function (data) {

                    var terms = {};

                    $.each(data, function (i, val) {
                        terms[i] = val;
                    });

                    return terms;
                });
            ";

			if ( class_exists( 'WC_Inline_Javascript_Helper' ) ) {
				$woocommerce->get_helper( 'inline-javascript' )->add_inline_js( $js );
			} else {
				$woocommerce->add_inline_js( $js );
			}
		}

		/**
		 * AJAX initiated call to obtain list of filtered customers
		 */
		function woocommerce_crm_json_search_customers() {

			global $orders_data;

			check_ajax_referer( 'search-customers', 'security' );

			header( 'Content-Type: application/json; charset=utf-8' );

			$term = urldecode( stripslashes( strip_tags( $_GET['term'] ) ) );

			if ( empty( $term ) )
				die();

			$found_customers = array();

			woocommerce_crm_get_orders_data();

			if ( $orders_data ) {
				foreach ( $orders_data as $email => $item ) {
					if ( strpos( strtoupper( $item['name'] ), strtoupper( $term ) ) !== false || strpos( $item['user_id'], $term ) !== false || strpos( strtoupper( sanitize_email( $email ) ), strtoupper( $term ) ) !== false ) {
						$found_customers[$email] = $item['name'] . ' (' . ( !empty( $item["user_id"] ) ? '#' . $item["user_id"] : __( "Guest", 'wc_customer_relationship_manager' ) ) . ' &ndash; ' . sanitize_email( $email ) . ')';
					}
				}
			}

			echo json_encode( $found_customers );
			die();
		}

		/**
		 * Overrides the WooCommerce search in orders capability if we search by customer.
		 *
		 * @param $fields
		 * @return array
		 */
		public function woocommerce_crm_search_by_email( $fields ) {
			if ( isset( $_GET["search_by_email_only"] ) ) {
				return array('_billing_email');
			}
			return $fields;
		}

		/**
		 * @param $views
		 * @return array
		 */
		public function views_shop_order( $views ) {
			if ( isset( $_GET["search_by_email_only"] ) ) {
				return array();
			}
			return $views;
		}

		/**
		 * get_tab_in_view()
		 *
		 * Get the tab current in view/processing.
		 */
		function get_tab_in_view( $current_filter, $filter_base ) {
			return str_replace( $filter_base, '', $current_filter );
		}


		/**
		 * add_settings_fields()
		 *
		 * Add settings fields for each tab.
		 */
		function add_settings_fields() {
			global $woocommerce_settings;

			// Load the prepared form fields.
			$this->init_form_fields();

			if ( is_array( $this->fields ) )
				foreach ( $this->fields as $k => $v )
					$woocommerce_settings[$k] = $v;
		}

		/**
		 * init_form_fields()
		 *
		 * Prepare form fields to be used in the various tabs.
		 */
		function init_form_fields() {
			global $woocommerce;

			$api_key = get_option( 'woocommerce_crm_mailchimp_api_key' ) ? get_option( 'woocommerce_crm_mailchimp_api_key' ) : get_option( 'woocommerce_mailchimp_api_key', '' );

			if ( $api_key ) {
				$mailchimp_lists = woocommerce_crm_get_mailchimp_lists( $api_key );
				$mailchimp_list = get_option( 'woocommerce_crm_mailchimp_list' ) ? get_option( 'woocommerce_crm_mailchimp_list' ) : get_option( 'woocommerce_mailchimp_list', '' );
			} else {
				$mailchimp_lists = array();
				$mailchimp_list = '';
			}

			// Define settings
			$this->fields['customer_relationship'] = apply_filters( 'woocommerce_customer_relationship_settings_fields', array(

				array('name' => __( 'MailChimp Integration', 'wc_customer_relationship_manager' ), 'type' => 'title', 'desc' => '', 'id' => 'customer_relationship_mailchimp'),

				array(
					'name' => __( 'Integrate with MailChimp', 'wc_customer_relationship_manager' ),
					'desc' => __( 'Specify whether to integrate Customer Relationship Manager with MailChimp to see which customers signed to the newsletter.', 'wc_customer_relationship_manager' ),
					'id' => 'woocommerce_crm_mailchimp',
					'css' => '',
					'std' => 'yes',
					'type' => 'checkbox',
					'default' => 'no'
				),

				array(
					'name' => __( 'MailChimp API Key', 'wc_customer_relationship_manager' ),
					'desc' => __( 'You can obtain your API key by <a href="https://us2.admin.mailchimp.com/account/api/">logging in to your MailChimp account</a>.', 'wc_customer_relationship_manager' ),
					'tip' => '',
					'id' => 'woocommerce_crm_mailchimp_api_key',
					'css' => '',
					'std' => '',
					'type' => 'text',
					'default' => $api_key
				),

				array(
					'name' => __( 'MailChimp List', 'wc_customer_relationship_manager' ),
					'desc' => __( 'Choose a list customers can subscribe to (you must save your API key first).', 'wc_customer_relationship_manager' ),
					'tip' => '',
					'id' => 'woocommerce_crm_mailchimp_list',
					'css' => '',
					'std' => '',
					'type' => 'select',
					'options' => $mailchimp_lists,
					'default' => $mailchimp_list
				),

				array('type' => 'sectionend', 'id' => 'customer_relationship_mailchimp'),

			) ); // End settings

			$js = "
                jQuery('#woocommerce_crm_mailchimp').change(function(){

                jQuery('#woocommerce_crm_mailchimp_api_key, #woocommerce_crm_mailchimp_list').closest('tr').hide();

                if ( jQuery(this).attr('checked') ) {
                    jQuery('#woocommerce_crm_mailchimp_api_key, #woocommerce_crm_mailchimp_list').closest('tr').show();
                }

            }).change();
            ";

			// the following lines make the plugin work with both WooCommerce 2.0 and 2.1
			if ( class_exists( 'WC_Inline_Javascript_Helper' ) ) {
				$woocommerce->get_helper( 'inline-javascript' )->add_inline_js( $js );
			} else {
				$woocommerce->add_inline_js( $js );
			}

		}

	}

	$wc_customer_relationship_manager = new WooCommerce_Customer_Relationship_Manager();

}