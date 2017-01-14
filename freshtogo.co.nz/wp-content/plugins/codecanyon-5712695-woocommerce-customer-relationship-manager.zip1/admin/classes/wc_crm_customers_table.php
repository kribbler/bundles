<?php
/**
 * Table with list of customers.
 *
 * @author   Actuality Extensions
 * @package  WooCommerce_Customer_Relationship_Manager
 * @since    1.0
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

require_once( plugin_dir_path( __FILE__ ) . '../../functions.php' );

class WC_Crm_Customers_Table extends WP_List_Table {

	var $data = array();

	function __construct() {
		global $status, $page;

		parent::__construct( array(
			'singular' => __( 'customer', 'wc_customer_relationship_manager' ), //singular name of the listed records
			'plural' => __( 'customers', 'wc_customer_relationship_manager' ), //plural name of the listed records
			'ajax' => false //does this table support ajax?

		) );

		add_action( 'admin_head', array(&$this, 'admin_header') );

	}

	function admin_header() {
		global $wc_customer_relationship_manager;
		$page = ( isset( $_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
		if ( $wc_customer_relationship_manager->id != $page )
			return;
		echo '<style type="text/css">';
		if ( woocommerce_crm_mailchimp_enabled() ) {
			echo '.wp-list-table .column-id { width: 2.2em;}';
			echo '.wp-list-table .column-customer_name { width: 12%;}';
			echo '.wp-list-table .column-email { width: 15%;}';
			echo '.wp-list-table .column-phone { width: 11%;}';
			echo '.wp-list-table .column-user { width: 10%;}';
			echo '.wp-list-table .column-first_purchase { width: 11%;}';
			echo '.wp-list-table .column-last_purchase { width: 11%;}';
			echo '.wp-list-table .column-num_orders { width: 46px; left: 10%;}';
			echo '.wp-list-table .column-order_value { width: 99px;}';
			echo '.wp-list-table .column-enrolled { width: 47px;}';
			echo '.wp-list-table .column-crm_actions { width: 90px;}';
		} else {
			echo '.wp-list-table .column-id { width: 2.2em;}';
			echo '.wp-list-table .column-customer_name { width: 12%;}';
			echo '.wp-list-table .column-email { width: 15%;}';
			echo '.wp-list-table .column-phone { width: 11%;}';
			echo '.wp-list-table .column-user { width: 10%;}';
			echo '.wp-list-table .column-first_purchase { width: 11%;}';
			echo '.wp-list-table .column-last_purchase { width: 11%;}';
			echo '.wp-list-table .column-num_orders { width: 46px; left: 10%;}';
			echo '.wp-list-table .column-order_value { width: 99px;}';
			echo '.wp-list-table .column-crm_actions { width: 90px;}';
		}
		echo '</style>';
	}

	function no_items() {
		_e( 'No customers data found. Try to adjust the filter.', 'wc_customer_relationship_manager' );
	}

	function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'customer_name':
			case 'email':
			case 'phone':
			case 'user':
			case 'first_purchase':
			case 'last_purchase':
			case 'num_orders':
			case 'order_value':
			case 'enrolled':
			case 'crm_actions':
				return $item[$column_name];
			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

	function get_sortable_columns() {
		$sortable_columns = array(
			'customer_name' => array('customer_name', false),
			'email' => array('email', false),
			'phone' => array('phone', false),
			'user' => array('user', false),
			'first_purchase' => array('first_purchase', false),
			'last_purchase' => array('last_purchase', false),
			'num_orders' => array('num_orders', false),
			'order_value' => array('order_value', false),
		);
		if ( woocommerce_crm_mailchimp_enabled() ) {
			$sortable_columns['enrolled'] = array('enrolled', false);
		};
		return $sortable_columns;
	}

	function get_columns() {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'customer_name' => __( 'Customer Name', 'wc_customer_relationship_manager' ),
			'email' => __( 'E-mail', 'wc_customer_relationship_manager' ),
			'phone' => __( 'Phone', 'wc_customer_relationship_manager' ),
			'user' => '<img alt="' . __( 'Username', 'wc_customer_relationship_manager' ) . '" data-tip="' . __( 'Username', 'wc_customer_relationship_manager' ) . '" src="' . plugins_url( 'assets/img/user.png', dirname( dirname( __FILE__ ) ) ) . '" class="tips" width="auto" height="12">',
			'first_purchase' => __( 'First Purchase', 'wc_customer_relationship_manager' ),
			'last_purchase' => __( 'Last Purchase', 'wc_customer_relationship_manager' ),
			'num_orders' => '<img alt="' . __( 'Number of Completed Orders', 'wc_customer_relationship_manager' ) . '" data-tip="' . __( 'Number of Completed Orders', 'wc_customer_relationship_manager' ) . '" src="' . plugins_url( 'assets/img/number-orders.png', dirname( dirname( __FILE__ ) ) ) . '" class="tips" width="auto" height="12">',
			'order_value' => __( 'Total Value', 'wc_customer_relationship_manager' ),
		);
		if ( woocommerce_crm_mailchimp_enabled() ) {
			$columns['enrolled'] = '<img alt="' . __( 'Subscribed To Newsletter', 'wc_customer_relationship_manager' ) . '" data-tip="' . __( 'Subscribed To Newsletter', 'wc_customer_relationship_manager' ) . '" src="' . plugins_url( 'assets/img/newsletter.png', dirname( dirname( __FILE__ ) ) ) . '" class="tips" width="auto" height="15">';
		};
		$columns['crm_actions'] = __( 'Actions', 'wc_customer_relationship_manager' );
		return $columns;
	}

	function usort_reorder( $a, $b ) {
		// If no sort, default to last purchase
		$orderby = ( !empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'last_purchase';
		// If no order, default to desc
		$order = ( !empty( $_GET['order'] ) ) ? $_GET['order'] : 'desc';
		// Determine sort order
		if ( $orderby == 'order_value' ) {
			$result = $a[$orderby] - $b[$orderby];
		} else {
			$result = strcmp( $a[$orderby], $b[$orderby] );
		}
		// Send final sort direction to usort
		return ( $order === 'asc' ) ? $result : -$result;
	}

	function column_customer_name( $item ) {
		return sprintf( '<strong>%1$s</strong>', $item['customer_name'] );
	}

	function get_bulk_actions() {
		$actions = array(
			'email' => __( 'Send E-mail', 'wc_customer_relationship_manager' )
		);
		return $actions;
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="order_id[]" value="%s" />', $item['ID']
		);
	}

	function column_crm_actions( $item ) {
		global $woocommerce;
		$actions = array(
			'orders' => array(
				'url' => sprintf( 'edit.php?s=%s&post_status=%s&post_type=%s&shop_order_status&_customer_user&paged=1&mode=list&search_by_email_only', urlencode( $item['email_plain'] ), 'all', 'shop_order' ),
				'action' => 'view',
				'name' => __( 'View Orders', 'wc_customer_relationship_manager' )
			),
			'email' => array(
				'url' => sprintf( '?page=%s&action=%s&order_id=%s', $_REQUEST['page'], 'email', $item['ID'] ),
				'name' => __( 'Send E-mail', 'wc_customer_relationship_manager' ),
				'image_url' => plugins_url( 'assets/img/email.png', dirname( dirname( __FILE__ ) ) )
			),
			'phone' => array(
				'url' => sprintf( 'tel:%s', $item['phone'] ),
				'name' => __( 'Call Customer', 'wc_customer_relationship_manager' ),
				'image_url' => plugins_url( 'assets/img/call.png', dirname( dirname( __FILE__ ) ) )
			)
		);

		echo '<p>';
		foreach ( $actions as $action ) {
			$image = ( isset( $action['image_url'] ) ) ? $action['image_url'] : $woocommerce->plugin_url() . '/assets/images/icons/' . $action['action'] . '.png';
			printf( '<a class="button tips" href="%s" data-tip="%s"><img src="%s" alt="%s" width="14" /></a>', esc_url( $action['url'] ), esc_attr( $action['name'] ), esc_attr( $image ), esc_attr( $action['name'] ) );
		}
		echo '</p>';

	}

	function column_order_value( $item ) {
		return woocommerce_price( $item['order_value'] );
	}

	function prepare_items() {

		$this->data = array();
		global $orders_data, $order_countries;
		woocommerce_crm_get_orders_data();
		foreach ( $orders_data as $email => $order ) {
			$item = array();
			$item['ID'] = $order['id'];
			if ( $order['user_id'] ) {
				$item['customer_name'] = "<a href='user-edit.php?user_id=" . $order['user_id'] . "'>" . $order['name'] . "<a>";
			} else {
				$item['customer_name'] = $order['name'];
			}
			$item['first_purchase'] = woocommerce_crm_get_pretty_time( $order['first_purchase_id'] );
			$item['last_purchase'] = woocommerce_crm_get_pretty_time( $order['last_purchase_id'] );
			$item['email'] = "<a href='mailto:" . $email . "'>" . $email . "<a>";
			$item['email_plain'] = $email;
			$item['phone'] = $order['phone'];
			$login = __( 'Guest', 'wc_customer_relationship_manager' );
			if ( isset( $order['user_id'] ) && $order['user_id'] > 0 ) {
				$user = get_userdata( $order['user_id'] );
				$login = '<a href="user-edit.php?user_id=' . $user->ID . '">' . $user->user_login . '</a>';
			}
			$item['user'] = $login;
			$item['num_orders'] = $order['num_orders'];
			$item['order_value'] = $order['value'];
			if ( woocommerce_crm_mailchimp_enabled() ) {
				$item['enrolled'] = $order['enrolled'];
			}
			array_push( $this->data, $item );
		}

		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		usort( $this->data, array(&$this, 'usort_reorder') );

		$per_page = 20;
		$current_page = $this->get_pagenum();
		$total_items = count( $this->data );


		$this->found_data = array_slice( $this->data, ( ( $current_page - 1 ) * $per_page ), $per_page );


		$this->set_pagination_args( array(
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page' => $per_page //WE have to determine how many items to show on a page
		) );
		$this->items = $this->found_data;
	}

	function extra_tablenav( $which ) {
		if ( $which == 'top' ) {
			do_action( 'wc_crm_restrict_list_customers' );
		}
	}

}