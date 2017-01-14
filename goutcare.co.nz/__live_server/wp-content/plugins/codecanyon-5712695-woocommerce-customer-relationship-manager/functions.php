<?php
/**
 * General global functions.
 *
 * @author   Rene Puchinger
 * @package  WooCommerce_Customer_Relationship_Manager
 * @since    1.0
 */


// Include MailChimp API class
if ( !class_exists( 'MCAPI_Wc_Crm' ) ) {
	require_once( 'admin/classes/api/MCAPI.class.php' );
}

/**
 * Gets the data about customers by tracking all orders. Obtains list of countries of purchase as well.
 */
function woocommerce_crm_get_orders_data() {

	global $orders_data, $order_countries, $order_products;

	if ( !empty( $orders_data ) && !empty( $order_countries ) ) { // in case we have already obtained the data before, just return them
		return;
	}

	$orders_data = array();
	$order_countries = array();
	$order_products = array();

	$args = array(
		'numberposts' => -1,
		'post_type' => 'shop_order',
		'post_status' => 'publish'
	);

	$orders = get_posts( $args );

	$first_purchase = '';
	$last_purchase = '';

	if ( woocommerce_crm_mailchimp_enabled() ) {
		$members = woocommerce_crm_get_members();
	}

	foreach ( $orders as $order ) {
		$order = new WC_Order( $order->ID );
		if ( $order->status == 'completed' ) {
			$items = $order->get_items();
			foreach ( $items as $item ) {
				$prod_id = $item['item_meta']['_product_id'][0];
				$qty_cnt = 0;
				foreach ( $item['item_meta']['_qty'] as $qty ) {
					$qty_cnt += (int)$qty;
				}
				if ( !in_array( $prod_id, array_keys( $order_products ) ) ) {
					$order_products[$prod_id] = $qty_cnt;
				} else {
					$order_products[$prod_id] += $qty_cnt;
				}
			}
		}
	}

	foreach ( $orders as $order ) {
		$order = new WC_Order( $order->ID );
		if ( !empty( $_POST['_customer_user'] ) && $_POST['_customer_user'] != $order->billing_email ) continue;
		if ( !empty( $_GET['_customer_user'] ) && $_GET['_customer_user'] != $order->billing_email ) continue;
		if ( !empty( $_POST['_customer_country'] ) && $_POST['_customer_country'] != $order->billing_country ) continue;
		if ( !empty( $_GET['_customer_country'] ) && $_GET['_customer_country'] != $order->billing_country ) continue;
		if ( !empty( $_POST['_customer_date_from'] ) && date( 'Y-m-d 00:00:00', strtotime( $_POST['_customer_date_from'] ) ) > date( 'Y-m-d 00:00:00', strtotime( $order->order_date ) ) ) continue;
		if ( !empty( $_GET['_customer_date_from'] ) && date( 'Y-m-d 00:00:00', strtotime( $_GET['_customer_date_from'] ) ) > date( 'Y-m-d 00:00:00', strtotime( $order->order_date ) ) ) continue;
		$items = $order->get_items();
		$is_product_in_order = false;
		$subtotal = 0;
		foreach ( $items as $item ) {
			$prod_id = $item['item_meta']['_product_id'][0];
			if ( ( !empty( $_POST['_customer_product'] ) && $prod_id == $_POST['_customer_product'] ) || ( !empty( $_GET['_customer_product'] ) && $prod_id == $_GET['_customer_product'] ) ) {
				$is_product_in_order = true;
				$subtotal += $item['item_meta']['_line_subtotal'][0];
			}
		}
		if ( ( !empty( $_POST['_customer_product'] ) || !empty( $_GET['_customer_product'] ) ) ) {
			if (!$is_product_in_order) {
				continue;
			}
		} else {
			$subtotal = $order->get_total();
		}
		if ( !isset( $orders_data[$order->billing_email] ) ) { // first occurence of e-mail
			$o = array();
			$o['first_purchase_id'] = $order->id; // id of order of first purchase
			$first_purchase = $order->order_date;
			$o['last_purchase_id'] = $order->id; // id of order of last purchase
			$last_purchase = $order->order_date;
			$o['user_id'] = $order->customer_user;
			$o['id'] = $order->id;
			$o['name'] = $order->billing_first_name . " " . $order->billing_last_name;
			if ( $order->status == 'completed' ) {
				$o['num_orders'] = 1;
			} else {
				$o['num_orders'] = 0;
			}
			$o['date'] = $order->order_date;
			if ( $order->status == 'completed' ) {
				$o['value'] = $subtotal;
			} else {
				$o['value'] = 0.0;
			}
			$o['phone'] = $order->billing_phone;
			if ( woocommerce_crm_mailchimp_enabled() ) {
				$o['enrolled'] = in_array( $order->billing_email, $members ) ? "<span class='enrolled-yes'></span>" : "<span class='enrolled-no'></span>";
				$o['enrolled_plain'] = in_array( $order->billing_email, $members ) ? 'yes' : 'no';
			}
			if ( !in_array( $order->billing_country, array_keys( $order_countries ) ) ) {
				$order_countries[$order->billing_country] = 1;
			} else {
				$order_countries[$order->billing_country]++;
			}
			$o['country'] = $order->billing_country;
			$orders_data[$order->billing_email] = $o;
		} else { // just update user data
			$o = $orders_data[$order->billing_email];
			if ( empty( $first_purchase ) || strtotime( $order->order_date ) < strtotime( $first_purchase ) ) {
				$o['first_purchase_id'] = $order->id;
				$first_purchase = $order->order_date;
			}
			if ( empty( $last_purchase ) || strtotime( $order->order_date ) > strtotime( $last_purchase ) ) {
				$o['last_purchase_id'] = $order->id;
				$last_purchase = $order->order_date;
			}
			if ( $order->status == 'completed' ) {
				$o['num_orders']++;
			}
			if ( $order->status == 'completed' ) {
				$o['value'] += $subtotal;
			}
			if ( strtotime( $order->order_date ) > strtotime( $o['date'] ) ) { // user data should be the last used
				$o['user_id'] = $order->customer_user;
				$o['id'] = $order->id;
				$o['name'] = $order->billing_first_name . " " . $order->billing_last_name;
				if ( woocommerce_crm_mailchimp_enabled() ) {
					$o['enrolled'] = in_array( $order->billing_email, $members ) ? "<span class='enrolled-yes'></span>" : "<span class='enrolled-no'></span>";
				}
			}
			$orders_data[$order->billing_email] = $o;
		}
	}

}

/**
 * Obtains list of MailChimp registered users
 *
 * @return array
 */
function woocommerce_crm_get_members() {
	if ( !$retval = get_transient( 'woocommerce_crm_mailchimp_members' ) ) {
		$mc_api = new MCAPI_Wc_Crm( get_option( 'woocommerce_crm_mailchimp_api_key' ) ); // this assumes Subscribe to newsletter extension is enabled
		$retval = $mc_api->listMembers( get_option( 'woocommerce_crm_mailchimp_list', false ) ); // this assumes Subscribe to newsletter extension is enabled
		set_transient( 'woocommerce_crm_mailchimp_members', $retval, 60 * 60 * 1 );
	}

	$members = array();
	foreach ( $retval['data'] as $item ) {
		array_push( $members, $item['email'] );
	}
	return $members;
}

/**
 * Determine if MailChimp integration is enabled and set up.
 *
 * @return bool
 */
function woocommerce_crm_mailchimp_enabled() {
	return ( get_option( 'woocommerce_crm_mailchimp', 'no' ) == 'yes' && strlen( get_option( 'woocommerce_crm_mailchimp_api_key' ) ) > 0 && strlen( get_option( 'woocommerce_crm_mailchimp_list' ) ) > 0 ) ? true : false;
}

/**
 * Obtain better date/time formatting. Snippet borrowed from WooCommerce plugin.
 *
 * @param $post_id
 * @return string
 */
function woocommerce_crm_get_pretty_time( $post_id, $plain = false ) {
	$post = get_post( $post_id );
	if ( '0000-00-00 00:00:00' == $post->date ) {
		$t_time = $h_time = __( 'Unpublished', 'woocommerce' );
	} else {
		$t_time = get_the_time( __( 'Y/m/d g:i:s A', 'woocommerce' ), $post );

		$gmt_time = strtotime( $post->post_date_gmt . ' UTC' );
		$time_diff = current_time( 'timestamp', 1 ) - $gmt_time;

		if ( $time_diff > 0 && $time_diff < 24 * 60 * 60 )
			$h_time = sprintf( __( '%s ago', 'woocommerce' ), human_time_diff( $gmt_time, current_time( 'timestamp', 1 ) ) );
		else
			$h_time = get_the_time( __( 'Y/m/d', 'woocommerce' ), $post );
	}
	if ( $plain ) {
		return esc_attr( $t_time );
	} else {
		return '<abbr title="' . esc_attr( $t_time ) . '">' . esc_html( apply_filters( 'post_date_column_time', $h_time, $post ) ) . '</abbr>';
	}
}

/**
 * Obtains MailChimp lists for given API key.
 *
 * @param $api_key
 * @return array|bool
 */
function woocommerce_crm_get_mailchimp_lists( $api_key ) {
	$mailchimp_lists = array();
	if ( !$mailchimp_lists = get_transient( 'woocommerce_crm_mailchimp_lists' ) ) {

		$mailchimp = new MCAPI_Wc_Crm( $api_key );
		$retval = $mailchimp->lists();

		if ( $mailchimp->errorCode ) {

			echo '<div class="error"><p>' . sprintf( __( 'Unable to load lists() from MailChimp: (%s) %s', 'wc_customer_relationship_manager' ), $mailchimp->errorCode, $mailchimp->errorMessage ) . '</p></div>';

			return false;

		} else {
			foreach ( $retval['data'] as $list )
				$mailchimp_lists[$list['id']] = $list['name'];

			if ( sizeof( $mailchimp_lists ) > 0 )
				set_transient( 'woocommerce_crm_mailchimp_lists', $mailchimp_lists, 60 * 60 * 1 );
		}
	}

	return $api_key ? array_merge( array( '' => __( 'Select a list...', 'wc_customer_relationship_manager' ) ), $mailchimp_lists ) : array( '' => __( 'Enter your key and save to see your lists', 'wc_customer_relationship_manager' ) );

}
