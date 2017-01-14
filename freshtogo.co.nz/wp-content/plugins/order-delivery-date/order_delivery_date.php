<?php 
/*
Plugin Name: Order Delivery Date
Plugin URI: http://www.tychesoftwares.com/store/woocommerce/order-delivery-date-for-woocommerce-pro-21
Description: This plugin allows customers to choose their preferred Order Delivery Date & Delivery Time during checkout. The plugin works with <strong>WP e-Commerce & Woocommerce</strong>. To get started: 1) Click the "Activate" link to the left of this description, 2) Go to <strong>Settings -> <a href="admin.php?page=order_delivery_date">Order Delivery Date</a></strong>.
Author: Ashok Rane
Version: 2.5
Author URI: http://www.tychesoftwares.com/about
Contributor: Tyche Softwares, http://www.tychesoftwares.com/
*/

/*require 'plugin-updates/plugin-update-checker.php';
$ExampleUpdateChecker = new PluginUpdateChecker(
		'http://www.tychesoftwares.com/plugin-updates/woocommerce-order-delivery-date/info.json',
		__FILE__
);*/

// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define( 'EDD_SL_STORE_URL_ODD_WOO', 'http://www.tychesoftwares.com/' ); // IMPORTANT: change the name of this constant to something unique to prevent conflicts with other plugins using this system

// the name of your product. This is the title of your product in EDD and should match the download title in EDD exactly
define( 'EDD_SL_ITEM_NAME_ODD_WOO', 'Order Delivery Date Pro for Woocommerce' ); // IMPORTANT: change the name of this constant to something unique to prevent conflicts with other plugins using this system

if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	// load our custom updater if it doesn't already exist
	include( dirname( __FILE__ ) . '/plugin-updates/EDD_SL_Plugin_Updater.php' );
}

// retrieve our license key from the DB
$license_key = trim( get_option( 'edd_sample_license_key_odd_woo' ) );

// setup the updater
$edd_updater = new EDD_SL_Plugin_Updater( EDD_SL_STORE_URL_ODD_WOO, __FILE__, array(
		'version' 	=> '2.5', 		// current version number
		'license' 	=> $license_key, 	// license key (used get_option above to retrieve from DB)
		'item_name' => EDD_SL_ITEM_NAME_ODD_WOO, 	// name of this plugin
		'author' 	=> 'Ashok Rane'  // author of this plugin
)
);

add_action('admin_init', 'edd_sample_register_option');
add_action('admin_init', 'edd_sample_deactivate_license');
add_action('admin_init', 'edd_sample_activate_license');

function edd_sample_activate_license() {
			
	// listen for our activate button to be clicked
	if( isset( $_POST['edd_license_activate'] ) ) {

		// run a quick security check
		if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'edd_sample_license_key_odd_woo' ) );
			

		// data to send in our API request
		$api_params = array(
				'edd_action'=> 'activate_license',
				'license' 	=> $license,
				'item_name' => urlencode( EDD_SL_ITEM_NAME_ODD_WOO ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_STORE_URL_ODD_WOO ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		update_option( 'edd_sample_license_status_odd_woo', $license_data->license );

	}
}


/***********************************************
 * Illustrates how to deactivate a license key.
* This will descrease the site count
***********************************************/

function edd_sample_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_license_deactivate'] ) ) {

		// run a quick security check
		if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'edd_sample_license_key_odd_woo' ) );
			

		// data to send in our API request
		$api_params = array(
				'edd_action'=> 'deactivate_license',
				'license' 	=> $license,
				'item_name' => urlencode( EDD_SL_ITEM_NAME_ODD_WOO ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_STORE_URL_ODD_WOO ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'edd_sample_license_status_odd_woo' );

	}
}



/************************************
 * this illustrates how to check if
* a license key is still valid
* the updater does this for you,
* so this is only needed if you
* want to do something custom
*************************************/

function edd_sample_check_license() {

	global $wp_version;

	$license = trim( get_option( 'edd_sample_license_key_odd_woo' ) );

	$api_params = array(
			'edd_action' => 'check_license',
			'license' => $license,
			'item_name' => urlencode( EDD_SL_ITEM_NAME_ODD_WOO )
	);

	// Call the custom API.
	$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_STORE_URL_ODD_WOO ), array( 'timeout' => 15, 'sslverify' => false ) );


	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		echo 'valid'; exit;
		// this license is still valid
	} else {
		echo 'invalid'; exit;
		// this license is no longer valid
	}
}

function edd_sample_register_option() {
	// creates our settings in the options table
	register_setting('edd_sample_license', 'edd_sample_license_key_odd_woo', 'edd_sanitize_license' );
}


function edd_sanitize_license( $new ) {
	$old = get_option( 'edd_sample_license_key_odd_woo' );
	if( $old && $old != $new ) {
		delete_option( 'edd_sample_license_status_odd_woo' ); // new license has been entered, so must reactivate
	}
	return $new;
}

function edd_sample_license_page() {
	$license 	= get_option( 'edd_sample_license_key_odd_woo' );
	$status 	= get_option( 'edd_sample_license_status_odd_woo' );
	
	?>
	<div class="wrap">
		<h2><?php _e('Plugin License Options'); ?></h2>
		<form method="post" action="options.php">
		
			<?php settings_fields('edd_sample_license'); ?>
			
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('License Key'); ?>
						</th>
						<td>
							<input id="edd_sample_license_key_odd_woo" name="edd_sample_license_key_odd_woo" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
							<label class="description" for="edd_sample_license_key"><?php _e('Enter your license key'); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">	
							<th scope="row" valign="top">
								<?php _e('Activate License'); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color:green;"><?php _e('active'); ?></span>
									<?php wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
								<?php } else {
									wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_license_activate" value="<?php _e('Activate License'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>	
			<?php submit_button(); ?>
		
		</form>
	<?php
}

include_once('lang.php');

$wpefield_version = '2.4';

global $calendar_themes, $weekdays, $calendar_languages;

$date_formats = array('mm/dd/y' => 'm/d/y',
					  'dd/mm/y' => 'd/m/y',
					  'y/mm/dd' => 'y/m/d',
					  'dd.mm.y' => 'd.m.y',
					  'y.mm.dd' => 'y.m.d',
					  'yy-mm-dd' => 'Y-m-d',
					  'dd-mm-y' => 'd-m-y',
					  'd M, y' => 'j M, y',
					  'd M, yy' => 'j M, Y',
					  'd MM, y' => 'j F, y',
					  'd MM, yy' => 'j F, Y',
					  'DD, d MM, yy' => 'l, j F, Y',
					  'D, M d, yy' => 'D, M j, Y',
					  'DD, M d, yy' => 'l, M j, Y',
					  'DD, MM d, yy' => 'l, F j, Y',
					  'D, MM d, yy' => 'D, F j, Y');
$number_of_months = array(1=>1,2=>2);

$time_formats = array(1=>"12 hour",
					 2=>"24 hour");

$calendar_themes = array('smoothness' => 'Smoothness',
						  'ui-lightness' => 'UI lightness',
						  'ui-darkness' => 'UI darkness',
						  'start' => 'Start',
						  'redmond' => 'Redmond',
						  'sunny' => 'Sunny',
						  'overcast' => 'Overcast',
						  'le-frog' => 'Le Frog',
						  'flick' => 'Flick',
						  'pepper-grinder' => 'Pepper Grinder',
						  'eggplant' => 'Eggplant',
						  'dark-hive' => 'Dark Hive',
						  'cupertino' => 'Cupertino',
						  'south-street' => 'South Street',
						  'blitzer' => 'Blitzer',
						  'humanity' => 'Humanity',
						  'hot-sneaks' => 'Hot sneaks',
						  'excite-bike' => 'Excite Bike',
						  'vader' => 'Vader',
						  'dot-luv' => 'Dot Luv',
						  'mint-choc' => 'Mint Choc',
						  'black-tie' => 'Black Tie',
						  'trontastic' => 'Trontastic',
						  'swanky-purse' => 'Swanky Purse'
						  );

$weekdays = array('orddd_weekday_0' => 'Sunday',
				  'orddd_weekday_1' => 'Monday',
				  'orddd_weekday_2' => 'Tuesday',
				  'orddd_weekday_3' => 'Wednesday',
				  'orddd_weekday_4' => 'Thursday',
				  'orddd_weekday_5' => 'Friday',
				  'orddd_weekday_6' => 'Saturday'
				  );

$languages = array(
		'af' => 'Afrikaans',
		'ar' => 'Arabic',
		'ar-DZ' => 'Algerian Arabic',
		'az' => 'Azerbaijani',
		'id' => 'Indonesian',
		'ms' => 'Malaysian',
		'nl-BE' => 'Dutch Belgian',
		'bs' => 'Bosnian',
		'bg' => 'Bulgarian',
		'ca' => 'Catalan',
		'cs' => 'Czech',
		'cy-GB' => 'Welsh',
		'da' => 'Danish',
		'de' => 'German',
		'et' => 'Estonian',
		'el' => 'Greek',
		'en-AU' => 'English Australia',
		'en-NZ' => 'English New Zealand',
		'en-GB' => 'English UK',
		'es' => 'Spanish',
		'eo' => 'Esperanto',
		'eu' => 'Basque',
		'fo' => 'Faroese',
		'fr' => 'French',
		'fr-CH' => 'French Swiss',
		'gl' => 'Galician',
		'sq' => 'Albanian',
		'ko' => 'Korean',
		'hi' =>'Hindi India',
		'hr' => 'Croatian',
		'hy' => 'Armenian',
		'is' => 'Icelandic',
		'it' => 'Italian',
		'ka' => 'Georgian',
		'km' => 'Khmer',
		'lv' => 'Latvian',
		'lt' => 'Lithuanian',
		'mk' => 'Macedonian',
		'hu' => 'Hungarian',
		'ml' => 'Malayam',
		'nl' => 'Dutch',
		'ja'=> 'Japanese',
		'no' => 'Norwegian',
		'th' => 'Thai',
		'pl' => 'Polish',
		'pt' => 'Portuguese',
		'pt-BR' => 'Portuguese Brazil',
		'ro' => 'Romanian',
		'rm' => 'Romansh',
		'ru' => 'Russian',
		'sk' => 'Slovak',
		'sl' => 'Slovenian',
		'sr' => 'Serbian',
		'fi' => 'Finnish',
		'sv' => 'Swedish',
		'ta' => 'Tamil',
		'vi' => 'Vietnamese',
		'tr' => 'Turkish',
		'uk' => 'Ukrainian',
		'zh-HK' => 'Chinese Hong Kong',
		'zh-CN' => 'Chinese Simplified',
		'zh-TW' => 'Chinese Traditional');

define('ORDER_DELIVERY_DATE_TAG', '%order_delivery_date%');
define('DELIVERY_DATE_FIELD_LABEL', 'Delivery Date');
define('DELIVERY_DATE_FIELD_NOTE', 'We will try our best to deliver your order on the specified date.');
define('DELIVERY_DATE_FORMAT', 'd MM, yy');
define('LOCKOUT_DATE_FORMAT', 'n-j-Y');
define('HOLIDAY_DATE_FORMAT', 'n-j-Y');
define('CALENDAR_THEME', 'smoothness');
define('CALENDAR_THEME_NAME', 'Smoothness');
define('DELIVERY_TIMESLOT_FIELD_LABEL', 'Time Slot');
//echo $delivery_date_field_label."<br>";

define('WPECOMMERCE_PLUGIN_NAME','wp-e-commerce');
define('WOOCOMMERCE_PLUGIN_NAME','woocommerce');

detect_plugin();
//echo "Plugin is ".ECOMMERCE_PLUGIN_ACTIVE;

function detect_plugin()
{
	$plugins = get_option('active_plugins');
	$ecomm_plugin = "";
	foreach ($plugins as $key => $plugin_name)
	{
		if (preg_match('/'.WPECOMMERCE_PLUGIN_NAME.'/', $plugin_name))
		{
			$ecomm_plugin = WPECOMMERCE_PLUGIN_NAME;
		}
		elseif (preg_match('/'.WOOCOMMERCE_PLUGIN_NAME.'/', $plugin_name))
		{
			$ecomm_plugin = WOOCOMMERCE_PLUGIN_NAME;
		}
	}
	define('ECOMMERCE_PLUGIN_ACTIVE',$ecomm_plugin);
}

//echo $ecomm_plugin;

// Ajax Calls
    require_once( ABSPATH . "wp-includes/pluggable.php" );
    if ( !is_user_logged_in() )
    {
     add_action('wp_ajax_nopriv_check_for_time_slot_orddd', 'check_for_time_slot_orddd');
    }
    else
    {
     add_action('wp_ajax_check_for_time_slot_orddd', 'check_for_time_slot_orddd');
    }

function wpefield_delivery_date($checkout = "")
{
	global $wpdb, $date_formats,$post;
	
	if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
	{
		$wpefield__TABLE = $wpdb->prefix . 'wpsc_checkout_forms';
		$field_id = '';
		$query = "select * from $wpefield__TABLE where unique_name = 'e_deliverydate'";
		$results = $wpdb->get_row( $query );
		if($results != null)
		{
			if($results->active=='1')
			{
				$field_id = $results->id;
			}
		}
		else
		{
			$max_count = $wpdb->get_var( $wpdb->prepare( "SELECT max(checkout_order)+1 FROM $wpefield__TABLE;" ) );
			$query = "INSERT INTO $wpefield__TABLE (`id`, `name`, `type`, `mandatory`, `display_log`, `default`, `active`, `checkout_order`, `unique_name`, `options`, `checkout_set`) VALUES
	('', '".DELIVERY_DATE_FIELD_LABEL."', 'text', '0', '0', '0', '1', $max_count, 'e_deliverydate', '', '0');";
			$wpdb->query($query);
			$field_id = $wpdb->insert_id;
		}
		
		$field_name = 'wpsc_checkout_form_'.$field_id;
	}
	elseif (ECOMMERCE_PLUGIN_ACTIVE == WOOCOMMERCE_PLUGIN_NAME)
	{
		$field_name = 'e_deliverydate';
	}
	
	
	
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // this has been done for the plugin to work with Bellissima theme
    wp_deregister_script( 'jqueryui');
	wp_enqueue_script( 'jqueryui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js', '', '', false );

    $calendar_theme = get_option('orddd_calendar_theme');
    if ($calendar_theme == '') $calendar_theme = 'base';
    wp_enqueue_style( 'jquery-ui', "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/$calendar_theme/jquery-ui.css" , '', '', false);
    
    wp_enqueue_style( 'datepicker', plugins_url('/css/datepicker.css', __FILE__ ) , '', '', false);
	

	wp_enqueue_script(
		'initialize-datepicker.js',
		plugins_url('/js/initialize-datepicker.js', __FILE__),
		'',
		'',
		false
	);
	
	
	$options = array();
	
	//show delivery time in datepicker
	$show = 'datepicker';
	global $languages;
	$language_selected = get_option('orddd_language_selected');
	
	wp_enqueue_script(
				$language_selected,
				plugins_url("/js/i18n/jquery.ui.datepicker-$language_selected.js", __FILE__),
				'',
				'',
				false);
	
	if (get_option('orddd_enable_delivery_time') == 'on')
	{
		wp_enqueue_script(
			'jquery-ui',
			'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js',
			'',
			'',
			false
		);
		
		wp_enqueue_script(
			'jquery-ui-timepicker-addon',
			plugins_url('/js/jquery-ui-timepicker-addon.js', __FILE__),
			'',
			'',
			false
		);
		
		wp_enqueue_script(
			'jquery-ui-sliderAccess',
			plugins_url('/js/jquery-ui-sliderAccess.js', __FILE__),
			'',
			'',
			false
		);
		
		
		if (get_option('orddd_delivery_from_hours') != '')
		{
			$options[] = "hourMin:".get_option('orddd_delivery_from_hours');
		}
		if (get_option('orddd_delivery_to_hours') != '')
		{
			$options[] = "hourMax:".get_option('orddd_delivery_to_hours');
		}
		$options[] = "stepMinute:1";
		/*if (get_option('orddd_delivery_from_minutes') != '')
		{
			$options[] = "minuteMin:".get_option('orddd_delivery_from_minutes');
		}
		if (get_option('orddd_delivery_to_minutes') != '')
		{
			$options[] = "minuteMax:".get_option('orddd_delivery_to_minutes');
		}*/
		
		if (get_option('orddd_enable_delivery_date') == 'on')
		{
			$show = 'datetimepicker';
		}
		else 
		{
			$show = 'timepicker';
		}
		
		
		if (get_option('orddd_delivery_time_format') == '1')
		{
			$options[] = "ampm: true";
		}
	}

	
	//print('<script type="text/javascript" src="'.plugins_url().'/order-delivery-date/js/available-dates.js"></script>');

	$display = '';
	
	$minDate = 0;
	$disabled_days = array();
	// check if same day delivery is enabled, if enabled - then check the cut-off time for same day delivery orders
	if (get_option('orddd_enable_same_day_delivery') == 'on' && get_option('orddd_enable_delivery_date') == 'on')
	{
		$current_time = current_time('timestamp');
		$current_date = date('d', $current_time);
		$current_month = date('m', $current_time);
		$current_year = date('Y', $current_time);
		
		$cut_off_hour = get_option('orddd_disable_same_day_delivery_after_hours');
		$cut_off_minute = get_option('orddd_disable_same_day_delivery_after_minutes');

		//echo "In this ".$cut_off_hour.' - '.$cut_off_minute;
		
		$cut_off_timestamp = mktime($cut_off_hour,$cut_off_minute,0,$current_month,$current_date,$current_year);
		
		//echo '<br>Current time is '.$current_time.' & Cut off is '.$cut_off_timestamp;
		
		
		if ($cut_off_timestamp > $current_time)
		{
			//$minDate = 0;
		}
		else 
		{
			$disabled_days[] = date(HOLIDAY_DATE_FORMAT, $current_time);
			//$minDate = 1;
		}
		$options[] = "minDate: ".$minDate;
		$options[] = "beforeShow: maxdt";
	}
	
	if ( get_option('orddd_enable_next_day_delivery') == 'on' && get_option('orddd_enable_delivery_date') == 'on')
	{
		$current_time = current_time('timestamp');
		$current_date = date('d', $current_time);
		$current_month = date('m', $current_time);
		$current_year = date('Y', $current_time);
		
		$cut_off_hour = get_option('orddd_disable_next_day_delivery_after_hours');
		$cut_off_minute = get_option('orddd_disable_next_day_delivery_after_minutes');

		//echo "In this ".$cut_off_hour.' - '.$cut_off_minute;
		
		$cut_off_timestamp = mktime($cut_off_hour,$cut_off_minute,0,$current_month,$current_date,$current_year);
		
		//echo '<br>Current time is '.$current_time.' & Cut off is '.$cut_off_timestamp;
		
		if ($cut_off_timestamp > $current_time)
		{
			//$minDate = 1;
			
		}
		else 
		{
			$disabled_days[] = date(HOLIDAY_DATE_FORMAT,$current_time +86400);
			//$minDate = 2;
			
		}
		
			// if same day delivery is disabled, then set minDate here; otherwise past dates are also enabled
		if (get_option('orddd_enable_same_day_delivery') != 'on')
		{
			$options[] = "minDate: 1";
		}
		$options[] = "beforeShow: maxdt";
	}

	if (get_option('orddd_enable_next_day_delivery') != 'on' && get_option('orddd_enable_same_day_delivery') != 'on' 
		&& get_option('orddd_enable_delivery_date') == 'on')
	{
		$options[] = "beforeShow: avd";
	}

	if (get_option('orddd_enable_delivery_date') == 'on')
	{
		$options[] = "dateFormat: \"".get_option('orddd_delivery_date_format')."\"";
	}
	
	$options_str = implode(',',$options);
	//echo "<br>".$options_str."<br>";
	//jQuery( "#wpsc_checkout_form_'.$field_id.'").datepicker( jQuery.datepicker.regional[ "fr" ] );
	$display_datepicker = 'jQuery("#'.$field_name.'").val("").'.$show.'({'.$options_str.', beforeShowDay: chd,
	onClose:function(dateStr,inst){
		var monthValue = inst.selectedMonth+1;
		var dayValue = inst.selectedDay;
		var yearValue = inst.selectedYear;
		var all=dayValue+"-"+monthValue+"-"+yearValue;
		jQuery("#h_deliverydate").val(all);},
		onSelect: show_times
	})
	.focus(function (event){
		jQuery.datepicker.afterShow(event);
	});

	function show_times(date,inst)
	{
	var monthValue = inst.selectedMonth+1;
		var dayValue = inst.selectedDay;
		var yearValue = inst.selectedYear;
		var all=dayValue+"-"+monthValue+"-"+yearValue;
	//jQuery.datepicker.formatDate("d-m-yy", new Date(yearValue, dayValue, monthValue) );
						var data = {
							current_date: all,
							post_id: "'.$post->ID.'",
							action: "check_for_time_slot_orddd"
							};
									
							jQuery.post("'.get_home_url().'/wp-admin/admin-ajax.php", data, function(response)
							{
								jQuery("#time_slot").html(response);
								//alert("Got this from the server: " + response);
							}
	)}

	';

	$disabled_days_var = 'var startDaysDisabled = [];';
	if (count($disabled_days) > 0)
	{
		$disabled_days_str = '"'.implode('","',$disabled_days).'"';
		$disabled_days_var = 'var startDaysDisabled = ['.$disabled_days_str.'];';
	}
	//echo $disabled_days_var;

	// top margin is needed only for Wp ecommerce
	if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
	{
		$display .= '
		<style>
		.'.$field_name.'
		{
			padding-top:20px!important;
		}
		#'.$field_name.'
		{
			margin-top:20px!important;
		}
		</style>';
	}
	
	$display .= '
	<script type="text/javascript">
	jQuery(document).ready(function()
	{
		jQuery("#'.$field_name.'").width("250px");
		jQuery("#'.$field_name.'").attr("readonly", true);
		var formats = ["d.m.y", "d MM, yy","MM d, yy"];
		jQuery.extend(jQuery.datepicker, { afterShow: function(event)
		{
			jQuery.datepicker._getInst(event.target).dpDiv.css("z-index", 99);
		}});
		'.$display_datepicker;
	
	if (get_option('orddd_delivery_date_field_note') != '')
	{
		$display .= 'jQuery("#'.$field_name.'").parent().append("<br><small style=\'font-size:10px;float:left;\'>'.get_option('orddd_delivery_date_field_note').'</small>");';
	}
	$display .= '
	});
	'.$disabled_days_var.'
    </script>';
	echo $display;
	
	
	if (ECOMMERCE_PLUGIN_ACTIVE == WOOCOMMERCE_PLUGIN_NAME)
	{
		if(get_option('orddd_enable_delivery_date') == 'on')
		{
			$validate_wpefield = false;
			if (get_option('orddd_date_field_mandatory') == 'checked')
			{
				$validate_wpefield = true;
			}
			echo '<div id="wpefield_delivery_date_field" style="width: 202%; float: left;">';
			woocommerce_form_field( 'e_deliverydate', array
			(
				'type'          => 'text',
				'label'         => __(get_option('orddd_delivery_date_field_label')),
				'required'  	=> $validate_wpefield,
				'placeholder'       => __(get_option('orddd_delivery_date_field_label')),
				'style'			=> 'cursor:text'
			),
			$checkout->get_value( 'e_deliverydate' ));
			echo '</div>';
			echo '<div  style="width: 202%; float: left; display:none">';
			woocommerce_form_field( 'h_deliverydate', array
			(
				'type'          => 'text',
			),
			$checkout->get_value( 'h_deliverydate' ));
			echo '</div>';
		}
	}
}

function wpefield_time_slot($checkout = "")
{
	if (ECOMMERCE_PLUGIN_ACTIVE == WOOCOMMERCE_PLUGIN_NAME)
	{
		$field_name = 'time_slot';
	}
	if(get_option('orddd_enable_delivery_date') == 'on' && get_option('orddd_enable_time_slot') == 'on')
	{
		$time_slot_str = get_option('orddd_delivery_time_slot_log');
		$time_slots = json_decode($time_slot_str, true);
		$result = array();
		$validate_wpefield=false;
		if(get_option('orddd_time_slot_mandatory')=='checked')
		{
			$validate_wpefield=true;
		}
		woocommerce_form_field( 'time_slot', array(
		'type'          => 'select',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => __(get_option('orddd_delivery_timeslot_field_label')),
		'required'  	=> $validate_wpefield,
		'options' => __($result, 'woocommerce')
		),
		$checkout->get_value( 'time_slot' ));
	}
}	
	/*if(get_option('orddd_enable_time_slot') == 'on')
	{
	woocommerce_form_field( 'time_slot', array(
    'type'          => 'select',
    'class'         => array('my-field-class form-row-wide'),
    'label'         => __('Time Slot'),
	'options' => __($result, 'woocommerce')
    ),
	$checkout->get_value( 'time_slot' ));
}	
}*/

/**
 * Validate delivery date field
 **/
if (ECOMMERCE_PLUGIN_ACTIVE == WOOCOMMERCE_PLUGIN_NAME)
{
	if (get_option('orddd_date_field_mandatory') == 'checked')
	{
		add_action('woocommerce_checkout_process', 'validate_date_wpefield');
	}
	if(get_option('orddd_enable_time_slot') == 'on' && get_option('orddd_time_slot_mandatory') == 'checked')
	{
		add_action('woocommerce_checkout_process', 'validate_time_wpefield');
	}
	function validate_date_wpefield()
	{
	    global $woocommerce;

	    // Check if set, if its not set add an error.
	    if (!$_POST['e_deliverydate'])
	    {
	    	$woocommerce->add_error( __('<strong>'.get_option('orddd_delivery_date_field_label').'</strong> is a required field.') );
	    }
		
	}
	function validate_time_wpefield()
	{
		global $woocommerce;
		$ts = $_POST['time_slot'];
		//print_r($ts);
		if(!$_POST['time_slot'] || $ts=='choose')
	    {
	    	$woocommerce->add_error(__('<strong>'.get_option('orddd_delivery_timeslot_field_label').'</strong> is a required field.'));
	    }
	}

	
}


function check_for_time_slot_orddd()
{
	$current_date = $_POST['current_date'];
	//print_r($current_date);
	$lockout_time = get_option('orddd_lockout_time_slot');
	$existing_timeslots_str = get_option('orddd_delivery_time_slot_log');
	$existing_timeslots_arr = json_decode($existing_timeslots_str);
	$arr1 = array();
	$arr2 = array();
	foreach ($existing_timeslots_arr as $k => $v)
	{
		//print_r($v);
		$key = $v->fh.":".$v->fm." - ".$v->th.":".$v->tm;
		if(get_option('orddd_enable_specific_delivery_dates')=='on')
		{
			$dd = json_decode($v->dd);
			if (count($dd) > 0)
			{
				foreach($dd as $dkey => $dval)
				{
					$arr1[$dval][$key] = $v->lockout;
					
				}
			}
		}
		else if(get_option('orddd_enable_delivery_date')=='on' && get_option('orddd_enable_specific_delivery_dates')== '')
		{
			if($v->dd == "")
			{
				$arr1[$k][$key] = $v->lockout;
			}
			
		}
	}
	$lockout_time_arr = json_decode($lockout_time);
	if(count($lockout_time_arr) > 0)
	{
		foreach ($lockout_time_arr as $k => $v)
		{
			 $arr2[$v->d][$v->t] = $v->o;
		}
	}
	
	if(get_option('orddd_enable_specific_delivery_dates')=='on')
	{
		foreach ($arr1 as $delivery_date => $arr3)
		{
			$a = explode("-",$delivery_date);
			$new_delivery_date = $a[1]."-".$a[0]."-".$a[2];
			if ($new_delivery_date == $current_date)
			{
				foreach($arr3 as $key => $lockout)
				{
					//print_r($arr2);
					if ($arr2[$current_date][$key] >= $lockout )
					{
						//if it comes here, then it means the time slot for the selected date is full
					}
					else 
					{
						$time_arr = explode(" - ",$key);
						$tstamp_from = strtotime(date("d")." ".date("M")." ".date("Y")." ".$time_arr[0]);
						$tstamp_to = strtotime(date("d")." ".date("M")." ".date("Y")." ".$time_arr[1]);
						//$ampm_key = $from_time." - ".$to_time;
						if(count($dd>=0) || $dd=='null')
						{
							$time_slots_to_show[$k] = $key;
						}
						$time_slots_to_show_timestamp[$k] = $tstamp_from;
						
					}
					
				}
			}
		}
	}
	else if(get_option('orddd_enable_delivery_date')=='on' && get_option('orddd_enable_specific_delivery_dates')== '')
	{
		foreach ($arr1 as $tkey => $arr3)
		{
			foreach($arr3 as $key => $lockout)
			{
				if (isset($arr2[$current_date][$key]) && $arr2[$current_date][$key] >= $lockout )
				{
				}
				else 
				{		
					$time_arr = explode(" - ",$key);
					$tstamp_from = strtotime(date("d")." ".date("M")." ".date("Y")." ".$time_arr[0]);
					$tstamp_to = strtotime(date("d")." ".date("M")." ".date("Y")." ".$time_arr[1]);
					//$ampm_key = $from_time." - ".$to_time;
					$time_slots_to_show[$key] = $key;
					$time_slots_to_show_timestamp[$key] = $tstamp_from;
				}
			}
		}
	}
	asort($time_slots_to_show_timestamp);
	echo '<option value="choose">Select</option>';
	foreach ($time_slots_to_show_timestamp as $key => $value)
	{
		echo "<option value='".$time_slots_to_show[$key]."'>".$time_slots_to_show[$key]."</option>";
	}
	die();
}


function wpefield_activate()
{
	global $wpdb, $weekdays;
	
	if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
	{
		$wpefield__TABLE = $wpdb->prefix . 'wpsc_checkout_forms';
		$field_id = '';
		$query = "select * from $wpefield__TABLE where unique_name = 'e_deliverydate'";
		$results = $wpdb->get_row( $query );
		if($results != null)
		{
			// do nothing
		}
		else
		{
			$max_count = $wpdb->get_var( $wpdb->prepare( "SELECT max(checkout_order)+1 FROM $wpefield__TABLE;" ) );
			$query = "INSERT INTO $wpefield__TABLE (`id`, `name`, `type`, `mandatory`, `display_log`, `default`, `active`, `checkout_order`, `unique_name`, `options`, `checkout_set`) VALUES
	('', '".DELIVERY_DATE_FIELD_LABEL."', 'text', '0', '0', '0', '1', $max_count, 'e_deliverydate', '', '0');";
			$wpdb->query($query);
		}
	}

	// date options
	update_option('orddd_enable_delivery_date','on');
	
	foreach ($weekdays as $n => $day_name)
	{
		update_option($n,'checked');
	}
	
	update_option('orddd_minimumOrderDays','0');
	update_option('orddd_number_of_dates','30');
	update_option('orddd_show_delivery_date_in_customer_email','');
	update_option('orddd_date_field_mandatory','');
	update_option('orddd_lockout_date_after_orders','');
	update_option('orddd_lockout_days','');

	// time options
	update_option('orddd_enable_delivery_time','');
	update_option('orddd_delivery_from_hours','');
	//update_option('orddd_delivery_from_minutes','');
	update_option('orddd_delivery_to_hours','');
	//update_option('orddd_delivery_to_minutes','');
	update_option('orddd_delivery_time_format','2');
	
	// same day delivery options
	update_option('orddd_enable_same_day_delivery','');
	update_option('orddd_disable_same_day_delivery_after_hours','');
	update_option('orddd_disable_same_day_delivery_after_minutes','');
	
	// next day delivery options
	update_option('orddd_enable_next_day_delivery','');
	update_option('orddd_disable_next_day_delivery_after_hours','');
	update_option('orddd_disable_next_day_delivery_after_minutes','');

	// appearance options
	update_option('orddd_delivery_date_format',DELIVERY_DATE_FORMAT);
	update_option('orddd_delivery_date_field_label',DELIVERY_DATE_FIELD_LABEL);
	update_option('orddd_delivery_date_field_note',DELIVERY_DATE_FIELD_NOTE);
	update_option('orddd_number_of_months','1');
	update_option('orddd_calendar_theme',CALENDAR_THEME);
	update_option('orddd_calendar_theme_name',CALENDAR_THEME_NAME);
	update_option('orddd_language_selected','en-GB');
	
	// holidays
	update_option('orddd_delivery_date_holidays','');
	
	// specific delivery dates
	update_option('orddd_enable_specific_delivery_dates','');
	update_option('orddd_delivery_dates','');

	//Time slot
	update_option('orddd_time_slot_mandatory','');
	update_option('orddd_delivery_timeslot_field_label',DELIVERY_TIMESLOT_FIELD_LABEL);
}

function wpefield_deactivate()
{
	global $wpdb, $weekdays;
	
	if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
	{
		$wpefield__TABLE = $wpdb->prefix . 'wpsc_checkout_forms';
		$query = "delete from $wpefield__TABLE where unique_name = 'e_deliverydate'";
		$wpdb->query( $query );
	}
	
	foreach ($weekdays as $n => $day_name)
	{
		delete_option($n);
	}
	
	// date options
	delete_option('orddd_enable_delivery_date');
	
	delete_option('orddd_minimumOrderDays');
	delete_option('orddd_number_of_dates');
	delete_option('orddd_show_delivery_date_in_customer_email');
	delete_option('orddd_date_field_mandatory');
	delete_option('orddd_lockout_date_after_orders');
	delete_option('orddd_lockout_days');
	
	// time options
	delete_option('orddd_enable_delivery_time');
	delete_option('orddd_delivery_from_hours');
	//delete_option('orddd_delivery_from_minutes');
	delete_option('orddd_delivery_to_hours');
	//delete_option('orddd_delivery_to_minutes');
	delete_option('orddd_delivery_time_format');
	
	delete_option('orddd_enable_same_day_delivery');
	delete_option('orddd_disable_same_day_delivery_after_hours');
	delete_option('orddd_disable_same_day_delivery_after_minutes');
	
	delete_option('orddd_enable_next_day_delivery');
	delete_option('orddd_disable_next_day_delivery_after_hours');
	delete_option('orddd_disable_next_day_delivery_after_minutes');
	
	// appearance options
	delete_option('orddd_delivery_date_field_label');
	delete_option('orddd_delivery_date_field_note');
	delete_option('orddd_delivery_date_format');
	delete_option('orddd_number_of_months');
	delete_option('orddd_calendar_theme');
	delete_option('orddd_calendar_theme_name');
	delete_option('orddd_language_selected');
	
	// holiday options
	delete_option('orddd_delivery_date_holidays');
	
	// specific delivery dates
	delete_option('orddd_enable_specific_delivery_dates');
	delete_option('orddd_delivery_dates');

	// time slot
	delete_option('orddd_delivery_time_slot_log');
	delete_option('orddd_lockout_time_slot');
	delete_option('orddd_enable_time_slot');
	delete_option('orddd_time_slot_mandatory','');
	delete_option('orddd_delivery_timeslot_field_label','');
}

if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
{
	$shopping_cart_hook = "wpsc_before_form_of_shopping_cart";
}
elseif (ECOMMERCE_PLUGIN_ACTIVE == WOOCOMMERCE_PLUGIN_NAME)
{
	$shopping_cart_hook = "woocommerce_after_checkout_billing_form";
}
add_action($shopping_cart_hook, 'wpefield_delivery_date');
add_action($shopping_cart_hook, 'wpefield_time_slot');
register_activation_hook( __FILE__, 'wpefield_activate' );
register_deactivation_hook( __FILE__, 'wpefield_deactivate' );

//////////////////////////////////////////////////////////////////////////////

if (ECOMMERCE_PLUGIN_ACTIVE == WOOCOMMERCE_PLUGIN_NAME)
{
	add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta');
	add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_time_slot');
	function my_custom_checkout_field_update_order_meta( $order_id )
	{
		if ($_POST['e_deliverydate'])
		{
			update_post_meta( $order_id, get_option('orddd_delivery_date_field_label'), esc_attr($_POST['e_deliverydate']));
			
			if (get_option('orddd_lockout_date_after_orders') > 0)
			{
	//			$delivery_date = str_replace(",","",$_POST['e_deliverydate']);
	//			update_lockout_days($delivery_date);
				update_lockout_days($_POST['h_deliverydate']);
			}
		}
		else 
		{
			update_post_meta( $order_id, get_option('orddd_delivery_date_field_label'), '');
		}
	}
	function my_custom_checkout_field_update_time_slot( $order_id )
	{
		
	    if ($_POST['time_slot'] && $_POST['time_slot']!= 'choose')
		{
			update_post_meta( $order_id, get_option('orddd_delivery_timeslot_field_label'), esc_attr($_POST['time_slot']));
			$timeslt = $_POST['time_slot'];
			//print_r($_POST['h_deliverydate']);exit;
			update_time_slot($timeslt, $_POST['h_deliverydate']);

	    }
	}
}

//update lockout days

if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
{
	if (get_option('orddd_lockout_date_after_orders') > 0)
	{
		add_action('wpsc_save_cart_item','check_lockout');
	}
}

function check_lockout()
{
	global $wpdb;
	$field_id = "";
	$wpefield__TABLE = $wpdb->prefix . 'wpsc_checkout_forms';
	$field_id = '';
	$query = "select * from $wpefield__TABLE where unique_name = 'e_deliverydate'";
	$results = $wpdb->get_row( $query );
	if($results != null)
	{
		if($results->active=='1')
		{
			$field_id = $results->id;
		}
	}

	$values = "";
	$delivery_date = "";
	
	if ( $field_id != "" )
	{
		$delivery_date = $_SESSION['wpsc_checkout_saved_values'][$field_id];
		$delivery_date = str_replace(",","",$delivery_date);
		//echo "Date is $delivery_date";
		update_lockout_days($delivery_date);
	}
}
function my_enqueue($hook)
{
	//echo $hook;
    if( 'toplevel_page_order_delivery_date' != $hook )
        return;

	wp_enqueue_script(
		'jquery-ui',
		'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js',
		'',
		'',
		false
	);
	
	wp_enqueue_style( 'order-delivery-date', plugins_url('/css/order-delivery-date.css', __FILE__ ) , '', '', false);
	
    wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' , '', '', false);
			
	
			
	wp_enqueue_script(
			'jquery-min',
			'http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js',
			'',
			'',
			false
	);
/*	wp_enqueue_script(
			'jquery-ui-min',
			'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js',
			'',
			'',
			false
	);
*/
	wp_enqueue_script(
			'jquery-ui-min',
			'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js',
			'',
			'',
			false
	);
	wp_enqueue_script(
		'themeswitcher',
		plugins_url('/js/jquery.themeswitcher.min.js', __FILE__),
		'',
		'',
		false
	);
	
	global $languages;
	foreach ( $languages as $key => $value )
	{
		wp_enqueue_script(
				$value,
				plugins_url("/js/i18n/jquery.ui.datepicker-$key.js", __FILE__),
				'',
				'',
				false);
	}
	wp_enqueue_script(
						'jquery-tip',
						plugins_url('/js/jquery.tipTip.minified.js', __FILE__),
						'',
						'',
						false
				);
	wp_enqueue_style( 'woocommerce_admin_styles', plugins_url() . '/woocommerce/assets/css/admin.css' );
	wp_register_script( 'woocommerce_admin', plugins_url() . '/woocommerce/assets/js/admin/woocommerce_admin.js', array('jquery', 'jquery-ui-widget', 'jquery-ui-core'));
	wp_enqueue_script( 'woocommerce_admin' );
	
	//<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    //<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>
    //<script type="text/javascript" src="jquery.themeswitcher.js"></script>

}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );

//TO Display Delivery Date on Order Recieved Page

function add_delivery_date_to_order_page_woo( $order )
{
	$order_page_delivery_date = $order->order_custom_fields[get_option('orddd_delivery_date_field_label')][0];
	if ( $order_page_delivery_date != "" )
	{
		echo '<p><strong>'.get_option('orddd_delivery_date_field_label').':</strong> ' . $order_page_delivery_date . '</p>';
	}

}
function add_time_slot_to_order_page_woo( $order )
{
	//print_r($order->order_custom_fields);exit;
	if(array_key_exists(get_option('orddd_delivery_timeslot_field_label'),$order->order_custom_fields))
	{
		$field_label = get_option('orddd_delivery_timeslot_field_label');
		$order_page_time_slot = $order->order_custom_fields[$field_label][0];
		if(get_option('orddd_enable_time_slot') == 'on')
		{
			if($order_page_time_slot != "" && $order_page_time_slot != 'choose')
			{
				echo '<p><strong>'.get_option('orddd_delivery_timeslot_field_label').': </strong>'.$order_page_time_slot;
			}
		}
	}
}

add_filter('woocommerce_order_details_after_order_table','add_delivery_date_to_order_page_woo');
add_filter('woocommerce_order_details_after_order_table','add_time_slot_to_order_page_woo');

// add order delivery date to customer notification email

if (get_option('orddd_show_delivery_date_in_customer_email') == 'checked')
{
	if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
	{
		add_filter('wpsc_transaction_result_message', 'add_delivery_date_to_order_wpec');
		add_filter('wpsc_transaction_result_message_html', 'add_delivery_date_to_order_wpec');
	}
	elseif (ECOMMERCE_PLUGIN_ACTIVE == WOOCOMMERCE_PLUGIN_NAME)
	{
		/**
		 * Add the field to order emails
		 **/
		add_filter('woocommerce_email_order_meta_keys', 'add_delivery_date_to_order_woo');
		add_filter('woocommerce_email_order_meta_keys', 'add_time_slot_to_order_woo');
	}
	function add_time_slot_to_order_woo( $keys )
	{
	$keys[] = get_option('orddd_delivery_timeslot_field_label');
	return $keys;
	}

	// this is the delivery date that gets added in the customer email for woocommerce orders
	function add_delivery_date_to_order_woo( $keys ) {
		$keys[] = get_option('orddd_delivery_date_field_label');
		return $keys;
	}
	
	// this is the message that gets sent to the customer email, as well as that gets displayed on transaction result page
	function add_delivery_date_to_order_wpec($report)
	{
		global $wpdb;
		$field_id = "";
		$wpefield__TABLE = $wpdb->prefix . 'wpsc_checkout_forms';
		$field_id = '';
		$query = "select * from $wpefield__TABLE where unique_name = 'e_deliverydate'";
		$results = $wpdb->get_row( $query );
		if($results != null)
		{
			if($results->active=='1')
			{
				$field_id = $results->id;
			}
		}
		
		$values = "";
		$delivery_date = "";
		
		if ($field_id != "" )
		{
			$delivery_date = $_SESSION['wpsc_checkout_saved_values'][$field_id];
		}
		$report = str_replace(ORDER_DELIVERY_DATE_TAG, $delivery_date, $report);
		
		return $report;
	}
}



//////////////////////////////////////////////
/*add_action('wpsc_sales_log_extra_tablenav', 'my_dashboard_widget_extra_content');
 
function my_dashboard_widget_extra_content($hook)
{
	echo $hook;
	//put whatever you want to display in the sales summary in here!
	//echo "extra content";
	
	$m = isset( $_REQUEST['ordd'] ) ? $_REQUEST['ordd'] : 0;

	//if ( ! $this->month_filter )
	{
		if ( $m !== 0 )
		{
			echo '<input type="hidden" name="m" value="201209" />';
			return false;
		}
	}

	$delivery_filters = array('today'=>'Deliver today',
							  'tomorrow'=>'Delivery tomorrow');
	if ( ! empty( $delivery_filters ) )
	{
		?>
		<select name="ordd">
			<option <?php selected( 0, $m ); ?> value="0">Select</option>
			<?php
			foreach ( $delivery_filters as $key => $value )
			{
				
				printf( "<option %s value='%s'>%s</option>\n",
				//printf( "<option value='%s'>%s</option>\n",
					selected( $key, $m, false ),
					esc_attr( $key ),
					$value
				);
			}
			?>
		</select>
		<?php
		submit_button( _x( 'Filter', 'extra navigation in purchase log page', 'wpsc' ), 'secondary', false, false, array( 'id' => 'post-query-submit' ) );
	}
}*/
//////////////////////////////////////////////

//frontside scripts
add_action ('wp_enqueue_scripts','order_delivery_date_front_scripts');
function order_delivery_date_front_scripts()
{
	global $weekdays;
	
	$alldays = array();
	
	foreach ($weekdays as $n => $day_name) 
	{
		$alldays[$n] = get_option($n);
	}
	
	$alldayskeys = array_keys($alldays);
	
	foreach($alldayskeys as $key)
	{
		print('<input type="hidden" id="'.$key.'" value="'.$alldays[$key].'">');
	}
	print('<div id="dynamic_hidden_vars" style="display:none;"></div>');
	print('<input type="hidden" name="specific_delivery_dates" id="specific_delivery_dates" value="'.get_option('orddd_enable_specific_delivery_dates').'">');
	
	print('<input type="hidden" name="minimumOrderDays" id="minimumOrderDays" value="'.get_option('orddd_minimumOrderDays').'">');
	print('<input type="hidden" name="number_of_dates" id="number_of_dates" value="'.get_option('orddd_number_of_dates').'">');
	print('<input type="hidden" name="number_of_months" id="number_of_months" value="'.get_option('orddd_number_of_months').'">');
	print('<input type="hidden" name="zip_code_settings_arr" id="zip_code_settings_arr" value="">');
	print('<input type="hidden" name="date_field_mandatory" id="date_field_mandatory" value="'.get_option('orddd_date_field_mandatory').'" >');
	// fetch specific delivery dates
	$zipcodes = get_option('woocommerce_local_delivery_settings');
	//$a = implode('","', $zipcodes);
	//print_r($zipcodes);
	$zip_codes_new_arr = $zipcodes['codes'];
	/*foreach ($zip_codes_arr as $key => $value)
	{
		$new_arr[] = '"'.$value.'"';
	}
	$zip_codes_new_arr = implode(',',$new_arr);
	//print_r($new_arr);
	//echo $zip_codes_new_arr;*/
	print('<input type="hidden" name="zip_code_hidden_vars_arr" id="zip_code_hidden_vars_arr" value=\''.$zip_codes_new_arr.'\'>');
	
	// fetch specific delivery dates
	if (get_option('orddd_enable_specific_delivery_dates') == "on")
	{
		$delivery_dates_arr = array();
		$delivery_dates = get_option('orddd_delivery_dates');
		if ($delivery_dates != '' && $delivery_dates != '{}' && $delivery_dates != '[]')
		{
			$delivery_dates_arr = json_decode(get_option('orddd_delivery_dates'));
		}
		$delivery_dates_str = "";
		foreach ($delivery_dates_arr as $k => $v)
		{
			$delivery_dates_str .= '"'.$v.'",';
		}
		$delivery_dates_str = substr($delivery_dates_str,0,strlen($delivery_dates_str)-1);
		//echo "DELIVERY DATES ARE ".$delivery_dates_str;
		print('<input type="hidden" name="delivery_dates" id="delivery_dates" value=\''.$delivery_dates_str.'\'>');
	}
	
	
	// fetch holidays
	$holidays_arr = array();
	$holidays = get_option('orddd_delivery_date_holidays');
	if ($holidays != '' && $holidays != '{}' && $holidays != '[]')
	{
		$holidays_arr = json_decode(get_option('orddd_delivery_date_holidays'));
	}
	$holidays_str = "";
	foreach ($holidays_arr as $k => $v)
	{
		$holidays_str .= '"'.$v->d.'",';
	}
	$holidays_str = substr($holidays_str,0,strlen($holidays_str)-1);
	print('<input type="hidden" name="delivery_date_holidays" id="delivery_date_holidays" value=\''.$holidays_str.'\'>');
	
	// fetch lockout days
	if (get_option('orddd_lockout_date_after_orders') > 0)
	{
		$lockout_days_arr = array();
		$lockout_days = get_option('orddd_lockout_days');
		if ($lockout_days != '' && $lockout_days != '{}' && $lockout_days != '[]')
		{
			$lockout_days_arr = json_decode(get_option('orddd_lockout_days'));
		}
		$lockout_days_str = "";
		foreach ($lockout_days_arr as $k => $v)
		{
			if ($v->o >= get_option('orddd_lockout_date_after_orders'))
			{
				$lockout_days_str .= '"'.$v->d.'",';
			}
		}
		$lockout_days_str = substr($lockout_days_str,0,strlen($lockout_days_str)-1);
		//echo "<br>Lockout is ".$lockout_days_str;
		print('<input type="hidden" name="lockout_days" id="lockout_days" value=\''.$lockout_days_str.'\'>');
	}
	// fetch time slot
	print('<input type="hidden" name="time_slot_field_mandatory" id="time_slot_field_mandatory" value="'.get_option('orddd_slot_time_mandatory').'" >');
}

//Code to create the settings page for the plugin
add_action('admin_menu', 'order_delivery_date_menu');

function order_delivery_date_menu()
{
	add_menu_page( 'Order Delivery Date','Order Delivery Date','administrator', 'order_delivery_date','order_delivery_date_settings');
	//$page = add_submenu_page('order_delivery_date', 'Order Delivery Date', 'Activate License', 'manage_woocommerce', 'edd_sample_license_page', 'edd_sample_license_page' );
	$page = add_submenu_page('order_delivery_date', 'Activate License', 'Activate License', 'manage_woocommerce', 'edd_sample_license_page', 'edd_sample_license_page' );
	remove_submenu_page('order_delivery_date','odd_settings');
}

function order_delivery_date_settings()
{
	global $date_formats, $number_of_months, $time_formats, $calendar_themes, $weekdays, $calendar_languages;
	$plugin_path = plugins_url();
	
	$check_prev = array();
	$action ='';
	if(isset($_GET['action']))
	{
		// get action
		$action = $_GET['action'];
	}
	if ($action == '')
	{
		$action = 'date';
	}

	// form the top links bar
	print('<h2>Order Delivery Date</h2>');
	if(isset($_POST['save'])&& $_POST['save']!= "")
	{
		print('<div id="message" class="updated"><p>All changes have been saved.</p></div>');
	}
	print('<br>');
	$separator = "&nbsp;&nbsp;|&nbsp;&nbsp;";
	$settings_str = '<div class="ord_header_links">';
	if ($action != 'date' && $action != '')
	{
		$settings_str .= "<a href='admin.php?page=order_delivery_date&action=date'>".orddd_t('common.date-settings')."</a>";
	}
	else 
	{
		$settings_str .= orddd_t('common.date-settings');
	}
	$settings_str .= $separator;
	if ($action != 'time')
	{
		$settings_str .= "<a href='admin.php?page=order_delivery_date&action=time'>".orddd_t('common.time-settings')."</a>";
	}
	else 
	{
		$settings_str .= orddd_t('common.time-settings');
	}
	$settings_str .= $separator;
	if ($action != 'holidays')
	{
		$settings_str .= "<a href='admin.php?page=order_delivery_date&action=holidays'>".orddd_t('common.holidays')."</a>";
	}
	else 
	{
		$settings_str .= orddd_t('common.holidays');
	}
	$settings_str .= $separator;
	if ($action != 'appearance')
	{
		$settings_str .= "<a href='admin.php?page=order_delivery_date&action=appearance'>".orddd_t('common.appearance')."</a>";
	}
	else 
	{
		$settings_str .= orddd_t('common.appearance');
	}
	$settings_str .= $separator;
	if ($action != 'delivery_dates')
	{
		$settings_str .= "<a href='admin.php?page=order_delivery_date&action=delivery_dates'>".orddd_t('common.delivery-dates')."</a>";
	}
	else
	{
		$settings_str .= orddd_t('common.delivery-dates');
	}
	$settings_str .= $separator;
	if ($action != 'time_slot')
	{
	    $settings_str .= "<a href='admin.php?page=order_delivery_date&action=time_slot'>".orddd_t('common.time-slot')."</a>";
	}
	else
	{
		$settings_str .= orddd_t('common.time-slot');
	}
	$settings_str .= '</div>';
	
	print($settings_str);
	
	//echo date("d M Y H:i:s", time());
	
	if ($action == 'date' || $action == '')
	{
		$enable_delivery_date = "";
		if (get_option('orddd_enable_delivery_date') == 'on')
		{ 
			$enable_delivery_date = " checked ";
		}
		
		print('<br />
		<div id="order-delivery-date-settings">
			<div class="ino_titlee"><h3 class="ord_h3">Order Delivery Date Settings</h3></div>
				<form id="order-delivery-date-settings-form" name="order-delivery-date-settings" method="post">
					<input type="hidden" name="action" value="'.$action.'">

					<div id="ord_common">
						<label class="ord_label" for="enable-delivery-date">Enable Delivery Date:</label>
							<input type="checkbox" name="enable_delivery_date" id="enable_delivery_date" 
							class="day-checkbox" value="on" '.$enable_delivery_date.' /> 
						<div id="help">');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo 'Uncheck this option if you do not want to capture the delivery date & only want to capture the Delivery Time.';?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
					<?php print('</div></div>');
					
					
				print('<div id="ord_common">
						<label class="ord_label" class="ord_label" for="delivery-days-tf">Delivery Days: </label>
						<fieldset class="days-fieldset">
							<legend><b>Days:</b></legend>');
		
		foreach ($weekdays as $n => $day_name)
		{
			print('<input type="checkbox" name="'.$n.'" id="'.$n.'" class="day-checkbox" value="checked" '.get_option($n).' />
					<label class="ord_label" for="'.$day_name.'">'.$day_name.'</label>
					<br />');
		}
		
		print('</fieldset>
						<div id="help">');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo 'Select the weekdays when the delivery of items takes place. <br>For example, if you deliver only on Tuesday, Wednesday, <br>Thursday & Friday, then select only those days here. The <br>remaining days will not be available for selection to the <br>customer.';?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
						<!--<div id="help">Select the weekdays when the delivery of items takes place. For example, if you deliver only on Tuesday, Wednesday, Thursday & Friday, then select only those days here. The remaining days will not be available for selection to the customer.</div>-->
					</div>

					<div id="ord_common">
						<label class="ord_label" for="order-delay-days-tf">Minimum Delivery time (in days): </label>
						<input type="text" name="minimumOrderDays" id="minimumOrderDays" value="'.get_option('orddd_minimumOrderDays').'"/>
						<div id="help">');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo 'Enter the minimum number of days it takes for you to deliver <br>an order. For example, if it takes 2 days atleast to ship an <br>order, enter 2 here. The customer can select a date that is <br>available only after the minimum days that are entered here.';?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('
						</div>
					</div>
					<div id="ord_common">
						<label class="ord_label" for="number_of_dates">Number of dates to choose: </label>
						<input type="text" name="number_of_dates" id="number_of_dates" value="'.get_option('orddd_number_of_dates').'"/>
						<div id="help">');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo 'Based on the above 2 settings, you can decide how many dates should be made available to the customer to choose from. For example, if you enter 10, then 10 different dates will be made available to the customer to choose.';?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
						<!--<div id="help">Based on the above 2 settings, you can decide how many dates should be made available to the customer to choose from. For example, if you enter 10, then 10 different dates will be made available to the customer to choose.</div>-->
					</div>
					
					<!--<div id="ord_common">
						<label class="ord_label" for="show-on-listing-tf">Show on Orders Listing Page: </label>
							<input type="checkbox" name="show_on_orders_listing_page" id="show_on_orders_listing_page" class="day-checkbox" '.get_option('orddd_show_on_orders_listing_page_check').' />
						<div id="help"><a href="" title="Displays the Delivery Date on the Orders listing page." class="texttip"><img src="'.$plugin_path.'/order-delivery-date/images/help.png"></a></div>
					</div>
					
					<div id="ord_common">
						<label class="ord_label" for="show-filter-on-listing-tf">Show Filter on Orders Listing Page: </label>
							<input type="checkbox" name="show_filter_on_orders_listing_page" id="show_filter_on_orders_listing_page" class="day-checkbox" '.get_option('orddd_show_on_orders_listing_page_check').' />
						<div id="help"><a href="" title="Displays the Delivery Date Filter on the Orders listing page<br> that allows you to view orders to be delivered today, tomorrow <br>or in next 7 days." class="texttip"><img src="'.$plugin_path.'/order-delivery-date/images/help.png"></a></div>
					</div>-->

					<!--<div id="ord_common">
						<label class="ord_label" for="show-date-in-admin-email">Show Delivery Date in Admin <br>Notification Email:</label>
							<input type="checkbox" name="show_delivery_date_in_admin_email" id="show_delivery_date_in_admin_email" class="day-checkbox" '.get_option('orddd_show_delivery_date_in_admin_email').' />
						<div id="help"><a href="" title="Displays the Delivery Date in Admin notification emails sent <br>to admin after every order." class="texttip"><img src="'.$plugin_path.'/order-delivery-date/images/help.png"></a></div>
					</div>-->');

		if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
		{
			print('<div id="ord_common">
						<label class="ord_label" for="show-date-in-customer-email">Show Delivery Date in Customer <br>Notification Email:</label>
							<input type="checkbox" name="show_delivery_date_in_customer_email" id="show_delivery_date_in_customer_email" 
							class="day-checkbox" value="checked" '.get_option('orddd_show_delivery_date_in_customer_email').' 
							onclick="if(this.checked == true){ $(\'#show_ordd_code\').show(); } else { $(\'#show_ordd_code\').hide(); }"/>
							<span id="show_ordd_code" style="display:none;">Use <strong>'.ORDER_DELIVERY_DATE_TAG.'</strong> tag in Purchase Receipt <br>in Settings -> Store -> Admin</span>
						<div id="help">');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo 'Displays the Delivery Date in Customer notification emails sent <br>to customers after every order. You will need to enter the <br><strong>'.ORDER_DELIVERY_DATE_TAG.'</strong> tag in Purchase Receipt in <br>Settings -> Store -> Admin for this setting to work.';?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>');
	
			if (get_option('orddd_show_delivery_date_in_customer_email') == 'checked')
			{
				echo '<script language="javascript" type="text/javascript">$(\'#show_ordd_code\').show();</script>';
			}
		}
		elseif (ECOMMERCE_PLUGIN_ACTIVE == WOOCOMMERCE_PLUGIN_NAME)
		{
			print('<div id="ord_common">
						<label class="ord_label" for="show-date-in-customer-email">Show Delivery Date in Customer <br>Notification Email:</label>
							<input type="checkbox" name="show_delivery_date_in_customer_email" id="show_delivery_date_in_customer_email" 
							class="day-checkbox" value="checked" '.get_option('orddd_show_delivery_date_in_customer_email').'  />
						<div id="help">');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Displays the Delivery Date in Customer notification emails sent to customers after every order.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>');
		}
		
		print('<div id="ord_common">
					<label class="ord_label" for="show-date-in-customer-email">Mandatory field?:</label>
						<input type="checkbox" name="date_field_mandatory" id="date_field_mandatory" 
						class="day-checkbox" value="checked" '.get_option('orddd_date_field_mandatory').' />
					<div id="help">');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Check this option if you want to make the Delivery Date field <br>mandatory on the checkout page. Users will not be able to <br>place their orders unless the date is selected.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
				</div>
				
				<div id="ord_common">
					<label class="ord_label" for="lockout-date">Lockout date after X orders:</label>
					<input type="text" name="lockout_date_after_orders" id="lockout_date_after_orders" value="'.get_option('orddd_lockout_date_after_orders').'"/>
					<div id="help">
					');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Set this field if you want to place a cap on maximum deliveries or bookings in 1 particular day. If you can manage up to 5 <br>deliveries / bookings / appointments in a day, set this value to 5. Once 5 customers have asked for a delivery / appointment on any particular day, then that day will no longer be available for further deliveries or bookings.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
				</div>
				');

		print ('<div class="submit_button"><span class="submit"><input type="submit" value="Save changes" name="save"/></span></div>
				</form>
			</div>');
	}
	elseif ($action == 'time')
	{
		$enable_delivery_time = "";
		if (get_option('orddd_enable_delivery_time') == 'on')
		{ 
			$enable_delivery_time = " checked ";
		}
		
		$enable_same_day_delivery = "";
		if (get_option('orddd_enable_same_day_delivery') == 'on') 
		{ 
			$enable_same_day_delivery = " checked ";
		}
		
		$enable_next_day_delivery = "";
		if (get_option('orddd_enable_next_day_delivery') == 'on') 
		{ 
			$enable_next_day_delivery = " checked ";
		}
		
		
		print('<br>
		<div id="order-delivery-time-settings">
			<div class="ino_titlee"><h3 class="ord_h3">Order Delivery Time Settings</h3></div>
				<form id="order-delivery-time-settings-form" name="order-delivery-time-settings" method="post">
					<input type="hidden" name="action" value="'.$action.'">
					
					<div id="ord_common">
					<div class="ino_subtitle">
						<div class="ord_h4">Time Settings</div>
					</div></div>
					
					<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Enable delivery time capture: </label>
							<input type="checkbox" name="enable_delivery_time" id="enable_delivery_time" class="day-checkbox" '.$enable_delivery_time.'/>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Allows the customer to choose the time for the delivery. This is very useful in cases when your customers are gifting <br>items to their loved ones, especially on birthdays, anniversaries, etc.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Delivery From Hours: </label>
							<select name="delivery_from_hours" id="delivery_from_hours" size="1">');
		
							// time options
							$delivery_from_hours = get_option('orddd_delivery_from_hours');
							$delivery_to_hours = get_option('orddd_delivery_to_hours');

							for ($i = 1 ; $i <= 23 ; $i++)
							{
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $i, get_option('orddd_delivery_from_hours'), false ),
									esc_attr( $i ),
									$i
								);
							}

		print('</select>&nbsp;:&nbsp;00 minutes<!--&nbsp;<select name="delivery_from_minutes" id="delivery_from_minutes" size="1">-->');
							/*for ($i = 1 ; $i <= 59 ; $i++)
							{
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $i, get_option('orddd_delivery_from_minutes'), false ),
									esc_attr( $i ),
									$i
								);
							}*/
		print('<!--</select>-->
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Based on the hours chosen here, the customers will be<br> presented with corresponding hours in the time field on the<br> checkout page. For example, if you choose 10, then the <br>customer can choose a delivery time beginning from <br>10:00 hours.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Delivery To Hours: </label>
							<select name="delivery_to_hours" id="delivery_to_hours" size="1">');
		
							for ($i = 1 ; $i <= 23 ; $i++)
							{
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $i, get_option('orddd_delivery_to_hours'), false ),
									esc_attr( $i ),
									$i
								);
							}

		print('</select>&nbsp;:&nbsp;59 minutes<!--&nbsp;<select name="delivery_to_minutes" id="delivery_to_minutes" size="1">-->');
							/*for ($i = 1 ; $i <= 59 ; $i++)
							{
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $i, get_option('orddd_delivery_to_minutes'), false ),
									esc_attr( $i ),
									$i
								);
							}*/
		print('<!--</select>-->
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Based on the hours chosen here, the customers will be <br>presented with corresponding hours in the time field on the <br>checkout page. For example, if you choose 17, then the <br>customer can choose a delivery time till 17:59 hours, starting <br>from time in Delivery From Hours.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					

					<div id="ord_common">
						<label class="ord_label" for="time-format">Time format: </label>
							<select name="delivery_time_format" id="delivery_time_format" size="1">');
							foreach ($time_formats as $k => $format)
							{
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $k, get_option('orddd_delivery_time_format'), false ),
									esc_attr( $k ),
									$format
								);
							}
		print('</select>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "12 hour or 24 hour format will be displayed on the checkout page. <br>If 12 hour format is chosen, then am/pm will appear for the time.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>

					<div id="ord_common">
					<div class="ino_subtitle">
						<div class="ord_h4">Same Day Delivery</div>
					</div></div>
					
					<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Enable same day delivery: </label>
							<input type="checkbox" name="enable_same_day_delivery" id="enable_same_day_delivery" class="day-checkbox" '.$enable_same_day_delivery.'/>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "If you deliver on the same day, select this option. Once checked, <br>you can specify a cut-off time for same day delivery orders after <br>which the current day selection will be disabled.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					
					
					<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Cut-off time for same day <br>delivery orders: </label>
							Hours:<select name="disable_same_day_delivery_after_hours" id="disable_same_day_delivery_after_hours" size="1">');

							// same day delivery options
							$cut_off_hour = get_option('orddd_disable_same_day_delivery_after_hours');
							$cut_off_minute = get_option('orddd_disable_same_day_delivery_after_minutes');

							
							for ($i = 0 ; $i <= 23 ; $i++)
							{
								$selected = "";
								if ($cut_off_hour == $i)
								{
									$selected = " selected ";
								}
								print '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
							}

		print('</select>&nbsp;&nbsp;Mins:<select name="disable_same_day_delivery_after_minutes" id="disable_same_day_delivery_after_minutes" size="1">');
							for ($i = 0 ; $i <= 59 ; $i++)
							{
								$selected = "";
								if ($cut_off_minute == $i)
								{
									$selected = " selected ";
								}
								print '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
							}
		print('</select>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "All orders placed before the cut-off time will be applicable for <br>same day delivery. Same day delivery will be disabled if an order <br>is placed after the time mentioned in this field. The timezone is <br>taken from the Settings -> General -> Timezone field.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>

					<div id="ord_common">
					<div class="ino_subtitle">
						<div class="ord_h4">Next Day Delivery</div>
					</div></div>

					<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Enable next day delivery: </label>
							<input type="checkbox" name="enable_next_day_delivery" id="enable_next_day_delivery" class="day-checkbox" '.$enable_next_day_delivery.'/>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "If you deliver on the next day, select this option. Once checked, <br>you can specify a cut-off time for next day delivery orders after <br>which the next day selection will be disabled.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					
					
					<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Cut-off time for next day <br>delivery orders: </label>
							Hours:<select name="disable_next_day_delivery_after_hours" id="disable_next_day_delivery_after_hours" size="1">');
		
							// next day delivery options
							$cut_off_hour = get_option('orddd_disable_next_day_delivery_after_hours');
							$cut_off_minute = get_option('orddd_disable_next_day_delivery_after_minutes');

							
							for ($i = 0 ; $i <= 23 ; $i++)
							{
								$selected = "";
								if ($cut_off_hour == $i)
								{
									$selected = " selected ";
								}
								print '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
							}

		print('</select>&nbsp;&nbsp;Mins:<select name="disable_next_day_delivery_after_minutes" id="disable_next_day_delivery_after_minutes" size="1">');
							for ($i = 0 ; $i <= 59 ; $i++)
							{
								$selected = "";
								if ($cut_off_minute == $i)
								{
									$selected = " selected ";
								}
								print '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
							}
		print('</select>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "All orders placed before the cut-off time will be applicable for <br>next day delivery. Next day delivery will be disabled if an order <br>is placed after the time mentioned in this field. The timezone is <br>taken from the Settings -> General -> Timezone field.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					
					<div class="submit_button"><span class="submit"><input type="submit" value="Save changes" name="save"/></span></div>
				</form>
			</div>');
	}
	elseif ($action == 'holidays')
	{
		$current_language = get_option('orddd_language_selected');
		
		print('<script type="text/javascript">
			jQuery(document).ready(function()
			{
				jQuery.datepicker.setDefaults( jQuery.datepicker.regional[ "en-GB" ] );
				jQuery("#holiday_date").width("200px");
				var formats = ["d.m.y", "d M yy","MM d, yy"];
				jQuery("#holiday_date").val("").datepicker({constrainInput: true, dateFormat: formats[1]});
			});
	        </script>');
		print('<br>
		<div id="order-delivery-holiday-settings">
			<div class="ino_titlee"><h3 class="ord_h3">Add Holiday</h3></div>
				<form id="order-delivery-date-settings-form" name="order-delivery-date-settings" method="post">
					<input type="hidden" name="action" value="'.$action.'">
					<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Name: </label>
							<input type="text" name="holiday_name" id="holiday_name" class="day-checkbox" '.stripslashes(get_option('orddd_holiday_name')).'/>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Enter the name of the holiday here. For example, Thanksgiving day, <br>Independence day, etc.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Date: </label>
							<input type="text" name="holiday_date" id="holiday_date" class="day-checkbox" '.get_option('orddd_holiday_date').'/>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Select holiday date here. This day will not be available<br> for delivery selection to the customer.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					
					<div class="submit_button"><span class="submit"><input type="submit" value="Add Holiday" name="save"/></span></div>
				</form>
			</div>
		<div class="clear"><br></div>
		<div id="order-delivery-holiday-list-settings">
			<div class="ino_titlee"><h3 class="ord_h3">Holidays List</h3></div>
			
				<table class="holidays_list">
					<tr>
						<th>Name</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>');
		
		$holidays_arr = array();
		$holidays = get_option('orddd_delivery_date_holidays');
		if ($holidays != '' && $holidays != '{}' && $holidays != '[]')
		{
			$holidays_arr = json_decode($holidays);
		}
		foreach ($holidays_arr as $key => $value)
		{
			echo "<tr>
			<td>$value->n</td>
			<td>$value->d</td>
			<td><a href='admin.php?page=order_delivery_date&action=holidays&mode=delete&d=".urlencode($value->d)."'&n=".urlencode($value->n)."' class='confirmation'>Delete</a></td>
			</tr>";
		}
		print('</table>
			</div>');
		print('<script type="text/javascript">
				jQuery(".confirmation").on("click", function () {
				return confirm("Are you sure you want to delete this holiday?");
				});
				</script>');
	}
	elseif ($action == 'appearance')
	{
		global $languages;
		print('<br>
		<div id="order-delivery-appearance">
			<div class="ino_titlee"><h3 class="ord_h3">Calendar Appearance</h3></div>
				<form id="order-delivery-appearance-settings-form" name="order-delivery-appearance-settings" method="post">
					<input type="hidden" name="action" value="'.$action.'">
					<input type="hidden" name="calendar_theme" id="calendar_theme" value="'.get_option('orddd_calendar_theme_name').'">');
					$language_selected = get_option('orddd_language_selected');
					
					if ($language_selected == "") $language_selected = "en-GB";
					
					print('
					<div id="ord_common">
						
						<label class="ord_label" for="display_delivery_language_field">Calendar Language:</label>
						<select id="localisation_select" name="localisation_select">');
						foreach ( $languages as $key => $value )
						{
							$sel = "";
							if ($key == $language_selected)
							{
								$sel = " selected ";
							}
							echo "<option value='$key' $sel>$value</option>";
						}
						echo "</select>";

						print('<div id="help">');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Choose a language";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
						</div>
						');

					print('<div id="ord_common">
							
						<label class="ord_label" for="date-format">Date Format:</label>
							<select name="delivery_date_format" id="delivery_date_format" size="1">');
							
							foreach ($date_formats as $k => $format)
							{
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $k, get_option('orddd_delivery_date_format'), false ),
									esc_attr( $k ),
									date($format)
								);
								//echo "<option value='$k'>".date($format)."</option>";
							}	
	
					print ('</select>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "The format in which the delivery date appears to the customers<br> on the checkout page once the date is selected.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>

					<div id="ord_common">
						<label class="ord_label" for="number_of_dates">Field Label: </label>
						<input type="text" name="delivery_date_field_label" id="delivery_date_field_label" value="'.get_option('orddd_delivery_date_field_label').'" maxlength="40"/>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Choose the label that is to be displayed for the field on <br>checkout page.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>

					<div id="ord_common">
						<label class="ord_label" for="number_of_dates">Field Note Text: </label>
						<input type="text" name="delivery_date_field_note" id="delivery_date_field_note" value="'.stripslashes(get_option('orddd_delivery_date_field_note')).'" size="40" maxlength="70"/>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Choose the note that is to be displayed for the field on <br>checkout page.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					
					
					<div id="ord_common">
						<label class="ord_label" for="number_of_months">Number of months:</label>
							<select name="number_of_months" id="number_of_months" size="1">');
							
							foreach ($number_of_months as $k => $v)
							{
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $k, get_option('orddd_number_of_months'), false ),
									esc_attr( $k ),
									$v
								);
								//echo "<option value='$k'>".date($format)."</option>";
							}	
	
					print ('</select>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "The number of months to be shown on the calendar. If the <br>delivery date spans across 2 months, then dates of <br>2 months can be shown simultaneously without the need <br>to press the Next or Back buttons.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>');
					
		print('<div id="ord_common">
						<label class="ord_label" for="calendar_theme">Theme:</label>
						
				<div  style="margin-left:242px;">
				<script>
			  $(document).ready(function()
			  {
			    $("#switcher").themeswitcher({
			    	onclose: function()
			    	{
			    		var cookie_name = this.cookiename;
			    		$("input#calendar_theme").val($.cookie(cookie_name));
			    	},
			    	imgpath: "'.plugins_url().'/order-delivery-date/images/",
			    	loadTheme: "'.get_option('orddd_calendar_theme_name').'" 
			    });
			  });
			  </script>
				<div id="switcher"></div>
				<div id="help">
				');
				?>
				<img class="help_tip" width="16" height="16" data-tip="<?php echo "Select the theme for the calendar. You can choose a theme<br> which blends with the design of your website.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
				<?php 
				print('</div> <br><strong>Preview theme:</strong><br>
				<br>
				<script>
				jQuery(function() {
				
			  	jQuery.datepicker.setDefaults( jQuery.datepicker.regional[ "" ] );
				jQuery( "#datepicker" ).datepicker( jQuery.datepicker.regional[ "'.$language_selected.'" ] );
				jQuery( "#localisation_select" ).change(function() {
				jQuery( "#datepicker" ).datepicker( "option",
				jQuery.datepicker.regional[ jQuery(this).val() ] );
				});
			  	
			  	});
				</script>
				<div id="datepicker"></div>
				</div>
				</div>');
		
		print('<div class="submit_button"><span class="submit"><input type="submit" value="Save changes" name="save"/></span></div>');
		
	}
	elseif ($action == 'delivery_dates')
	{
		$enable_delivery_dates = "";
		if (get_option('orddd_enable_specific_delivery_dates') == 'on')
		{
			$enable_delivery_dates = " checked ";
		}

		$current_language = get_option('orddd_language_selected');
		print('<script type="text/javascript">
				jQuery(document).ready(function()
				{
				jQuery.datepicker.setDefaults( jQuery.datepicker.regional[ "en-GB" ] );
				jQuery("#delivery_date_1").width("200px");
				var formats = ["d.m.y", "d M, yy","MM d, yy"];
				jQuery("#delivery_date_1").val("").datepicker({constrainInput: true, dateFormat: formats[1]});
	
				jQuery("#delivery_date_2").width("200px");
				var formats = ["d.m.y", "d M, yy","MM d, yy"];
				jQuery("#delivery_date_2").val("").datepicker({constrainInput: true, dateFormat: formats[1]});
	
				jQuery("#delivery_date_3").width("200px");
				var formats = ["d.m.y", "d M, yy","MM d, yy"];
				jQuery("#delivery_date_3").val("").datepicker({constrainInput: true, dateFormat: formats[1]});
	});
				</script>');
		print('<br>
				<div id="order-delivery-deliverydates-settings">
				<div class="ino_titlee"><h3 class="ord_h3">Add Delivery Date <small>(You can add 3 dates at a time)</small></h3></div>
				<form id="order-delivery-date-settings-form" name="order_delivery_date_settings" method="post" onsubmit="return valid_delivery_date()" >
				<input type="hidden" name="action" value="'.$action.'">');
	
		print ('<div id="ord_common">
				<label class="ord_label" for="delivery-days-tf">Disable Weekdays & Enable Specific Delivery Dates: </label>
				<input type="checkbox" name="enable_specific_delivery_dates" id="enable_specific_delivery_dates" class="day-checkbox" '.$enable_delivery_dates.'/>
				<div id="help">
				');
				?>
				<img class="help_tip" width="16" height="16" data-tip="<?php echo "Enabling this option will allow the customer to choose specific <br>delivery dates that you add here. The weekdays selected in the <br>Date Settings will be ignored if this is enabled.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
				<?php 
				print('</div>
				</div>');
	
		print('<div id="ord_common">
				<label class="ord_label" for="delivery-days-tf">Date: </label>
				<input type="text" name="delivery_date_1" id="delivery_date_1" class="day-checkbox" readonly="readonly" />
				<div id="help">
				');
				?>
				<img class="help_tip" width="16" height="16" data-tip="<?php echo "Choose the delivery date here.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
				<?php 
				print('</div>
				</div>
				<div id="ord_common">
				<label class="ord_label" for="delivery-days-tf">Date: </label>
				<input type="text" name="delivery_date_2" id="delivery_date_2" class="day-checkbox" readonly="readonly" />
				<div id="help">
				');
				?>
				<img class="help_tip" width="16" height="16" data-tip="<?php echo "Choose the delivery date here.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
				<?php 
				print('</div>
				</div>
				<div id="ord_common">
				<label class="ord_label" for="delivery-days-tf">Date: </label>
				<input type="text" name="delivery_date_3" id="delivery_date_3" class="day-checkbox" readonly="readonly" />
				<div id="help">
				');
				?>
				<img class="help_tip" width="16" height="16" data-tip="<?php echo "Choose the delivery date here.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
				<?php 
				print('</div>
				</div>
					
				<div class="submit_button"><span class="submit"><input type="submit" value="Save" name="save"/></span></div>
				</form>
				</div>
				<div class="clear"><br></div>
				<div id="order-delivery-holiday-list-settings">
				<div class="ino_titlee"><h3 class="ord_h3">Delivery Dates</h3></div>
					
				<table class="holidays_list">
				<tr>
				<th>Date</th>
				<th>Actions</th>
				</tr>');
	
		$holidays_arr = array();
		$delivery_dates = get_option('orddd_delivery_dates');
		if ($delivery_dates != '' && $delivery_dates != '{}' && $delivery_dates != '[]' && $delivery_dates != 'null')
		{
			$holidays_arr = json_decode($delivery_dates);
		}
		
		foreach ($holidays_arr as $key => $value)
		{
			$j = 0;
			echo "<tr>
			<td>".$value."</td>
			<td><a href='admin.php?page=order_delivery_date&action=delivery_dates&mode=delete&zipcodegroup=$key&d=".urlencode($value)."' class='confirmation'>Delete</a></td>
			</tr>";
			$j++;
		}
		print('</table>
				</div>');
		print('<script type="text/javascript">
				jQuery(".confirmation").on("click", function () {
				return confirm("Are you sure you want to delete this date?");
				});
				</script>');
	
	}
	elseif ($action == 'time_slot')
	{
		print('<br>
		<div id="order-delivery-time-settings">
			<div class="ino_titlee"><h3 class="ord_h3">Time slot settings</h3></div>
				<form id="order-delivery-time-slot-settings-form" name="order-delivery-time-slot-settings-form" method="post">
					<input type="hidden" name="action" value="'.$action.'">');
				
		$enable_time_slot = '';
		if (get_option('orddd_enable_time_slot') == 'on')
		{
			$enable_time_slot = ' checked ';
		}
				print('<br><div id="ord_common"><label class="ord_label" for="delivery-days-tf">Enable time slot capture: </label>
							<input type="checkbox" name="enable_time_slot" id="enable_time_slot" class="day-checkbox" '.$enable_time_slot.'/>
						<div id="help">
						');
					?>
					<img class="help_tip" width="16" height="16" data-tip="<?php echo "Allows the customer to choose the time slot for the delivery.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
					<?php 
					print('</div>	
					</div>');
					print('<div id="ord_common">
						<label class="ord_label" for="number_of_dates">Field Label: </label>
						<input type="text" name="delivery_timeslot_field_label" id="delivery_timeslot_field_label" value="'.get_option('orddd_delivery_timeslot_field_label').'" maxlength="40"/>
						<div id="help">
						');
						?>
						<img class="help_tip" width="16" height="16" data-tip="<?php echo "Choose the label that is to be displayed for the time slot field on <br>checkout page.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
						<?php print('</div>
					</div>
					<div id="ord_common">
					<label class="ord_label" for="show-date-in-customer-email">Mandatory field?:</label>
						<input type="checkbox" name="time_slot_field_mandatory" id="time_slot_field_mandatory" 
						class="timeslot-checkbox" value="checked"'.get_option('orddd_time_slot_mandatory').' />
					<div id="help">
					');
				?>
				<img class="help_tip" width="16" height="16" data-tip="<?php echo "Check this option if you want to make the Time Slot field <br>mandatory on the checkout page. Users will not be able to <br>place their orders unless the Time slot is selected.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
				<?php 
				print('</div>
				</div>');
				if (get_option('orddd_enable_specific_delivery_dates') == 'on')
				{
					print('<div id="ord_common"><label class="ord_label" for="select-delivery-date">Select your delivery dates: </label>
					<select name="select_delivery_dates[]" id="select_delivery_dates" multiple="multiple"></div>');
					//echo '<option value="choose" selected>Select</option>';
						$delivery_arr = array();
						$delivery_dates_select = get_option('orddd_delivery_dates');
						if ($delivery_dates_select != '' && $delivery_dates_select != '{}' && $delivery_dates_select != '[]' && $delivery_dates_select != 'null')
						{
								$delivery_arr= json_decode($delivery_dates_select);
						}
						foreach($delivery_arr as $key=>$value)
						{
							echo '<option value='.$value.'>'.$value.'</option>\n';
						}	
						print('</select>
					<div id="help">
					');
					?>
					<img class="help_tip" width="16" height="16" data-tip="<?php echo "Select the specific dates for which this time slot should be added. You can select multiple specific dates.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
					<?php 
					print('</div>');
				}
					print('<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Time From: </label>
							<select name="time_from_hours" id="time_from_hours" size="1"></div>');
		
							// time options

							$delivery_from_hours = get_option('orddd_delivery_from_hours');
							$delivery_to_hours = get_option('orddd_delivery_to_hours');

							for ($i = 1 ; $i <= 23 ; $i++)
							{
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $i, get_option('orddd_delivery_from_hours'), false ),
									esc_attr( $i ),
									$i
								);
							}
					print('</select>&nbsp;:Hours &nbsp&nbsp&nbsp;<select name="time_from_minutes" id="time_from_minutes" size="1">');
							for ($i = 0 ; $i <= 59 ; $i++)
							{
								if ($i < 10) $i = '0'.$i;
								
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $i, get_option('orddd_delivery_from_minutes'), false ),
									esc_attr( $i ),
									$i
								);
							}
		print('</select>:Minutes
						<div id="help">');
						?>
				<img class="help_tip" width="16" height="16" data-tip="<?php echo "Starting time range for the time slot.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
				<?php 
				print('</div>
					</div>');
         
		 
		 print('<div id="ord_common">
						<label class="ord_label" for="delivery-days-tf">Time To: </label>
							<select name="time_to_hours" id="time_to_hours" size="1"></div>');
		
							// time options
							$delivery_from_hours = get_option('orddd_delivery_from_hours');
							$delivery_to_hours = get_option('orddd_delivery_to_hours');

							for ($i = 1 ; $i <= 23 ; $i++)
							{
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $i, get_option('orddd_delivery_from_hours'), false ),
									esc_attr( $i ),
									$i
								);
							}
					print('</select>&nbsp;:Hours &nbsp&nbsp&nbsp;<select name="time_to_minutes" id="time_to_minutes" size="1">');
							for ($i = 0 ; $i <= 59 ; $i++)
							{
								if ($i < 10) $i = '0'.$i;
								printf( "<option %s value='%s'>%s</option>\n",
									selected( $i, get_option('orddd_delivery_from_minutes'), false ),
									esc_attr( $i ),
									$i
								);
							}
		print('</select>:Minutes
						<div id="help">');
				?>
				<img class="help_tip" width="16" height="16" data-tip="<?php echo "Ending time range for the time slot.";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
				<?php 
				print('</div>
					</div>');
			    print('<div id="ord_common">
					<label class="ord_label">Lockout time slot after X orders:</label>
					<input type="text" name="lockout_time_after_orders" id="lockout_time_after_orders"/>
					<div id="help">
					');
				?>
				<img class="help_tip" width="16" height="16" data-tip="<?php echo "Set this field if you want to place a cap on maximum deliveries or bookings in the current time slot. If you can manage up to 5 deliveries in a time slot, set this value to 5. Once 5 customers have asked for a delivery in this time slot on a particular day, then that time slot will no longer be available for further deliveries (for that date).";?>" src="<?php echo plugins_url() ;?>/woocommerce/assets/images/help.png" />
				<?php 
				print('</div>
				</div>');
				
		print('<div class="submit_button"><span class="submit"><input type="submit" value="Save changes" name="save"/></span></div>');
		
		print ('<table class="holidays_list">
				<tr>
				<th>Delivery Dates</th>
				<th>Time Slot</th>
				<th>Lockout after X orders</th>
				<th>Actions</th>
				</tr>');
		if(isset($_POST['current_date']))
		{
			$current_date = $_POST['current_date'];
		}
		$lockout_time = get_option('orddd_lockout_time_slot');
		$existing_timeslots_str = get_option('orddd_delivery_time_slot_log');
		$existing_timeslots_arr = json_decode($existing_timeslots_str);
		if (count($existing_timeslots_arr) >0)
		{
			if( $existing_timeslots_arr=='null')
			{
			//echo "Inside";
			$existing_timeslots_arr=array();
			}
			foreach ($existing_timeslots_arr as $k => $v)
			{
				$key = $v->fh.":".$v->fm." - ".$v->th.":".$v->tm;
				$fh = $v->fh;
				$fm = $v->fm;
				$th = $v->th;
	   		    $tm = $v->tm;
				$dd = json_decode($v->dd);
				if (gettype($dd) == 'array' && count($dd) > 0)
				{
					if(get_option('orddd_enable_specific_delivery_dates')=='on' )
						{
							foreach($dd as $dkey => $dval)
							{
									$arr1[$dval][$key] = $v->lockout;
									//echo "First";
									echo "<tr>
									<td>".$dval."</td>
									<td>".$key."</td>
									<td>".$v->lockout."</td>
									<td><a href='admin.php?page=order_delivery_date&action=time_slot&mode=delete&fh=$fh&fm=$fm&th=$th&tm=$tm&dd=$dval' class='confirmation'>Delete</a></td>
									</tr>";
							}
						}
					}
					else if(get_option('orddd_enable_delivery_date')=='on' && get_option('orddd_enable_specific_delivery_dates')== '')
					{
							echo "<tr>
							<td>Not Available</td>
							<td>".$key."</td>
							<td>".$v->lockout."</td>
							<td><a href='admin.php?page=order_delivery_date&action=time_slot&mode=delete&fh=$fh&fm=$fm&th=$th&tm=$tm' class='confirmation'>Delete</a></td>
							</tr>";
					}
				}
		
		
		print('</table>
				</div>');
		print('<script type="text/javascript">
				jQuery(".confirmation").on("click", function () 
				{
					return confirm("Are you sure you want to delete this time slot?");
				});
				</script>');
		}
	}
	}

function removeElementWithValue($array, $key, $value)
{
    // print_r($array);
	 foreach($array as $subKey => $subArray)
     {
        // print_r($subKey);
		 //print_r($value);
		 if($subArray[$key] == $value)
          {
               unset($array[$subKey]);
          }
     }
     return $array;
}


if(isset($_POST['save']))
{
	/*echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit;*/
	
	$action = $_POST['action'];
	
	if ($action == 'time')
	{
		if (isset($_POST['enable_delivery_time']) && $_POST['enable_delivery_time'] == 'on')
		{
			update_option('orddd_enable_delivery_time',$_POST['enable_delivery_time']);
			update_option('orddd_delivery_from_hours',$_POST['delivery_from_hours']);
			//update_option('orddd_delivery_from_minutes',$_POST['delivery_from_minutes']);
			update_option('orddd_delivery_to_hours',$_POST['delivery_to_hours']);
			//update_option('orddd_delivery_to_minutes',$_POST['delivery_to_minutes']);
			update_option('orddd_delivery_time_format',$_POST['delivery_time_format']);
		}
		else 
		{
			update_option('orddd_enable_delivery_time','');
		}

		// same day delivery orders
		if( isset($_POST['enable_same_day_delivery']) && $_POST['enable_same_day_delivery'] == 'on' )
		{
			update_option('orddd_enable_same_day_delivery','on');
			update_option('orddd_disable_same_day_delivery_after_hours',$_POST['disable_same_day_delivery_after_hours']);
			update_option('orddd_disable_same_day_delivery_after_minutes',$_POST['disable_same_day_delivery_after_minutes']);
		}
		else 
		{
			update_option('orddd_enable_same_day_delivery','off');
		}

		// next day delivery orders
		if( isset($_POST['enable_next_day_delivery']) && $_POST['enable_next_day_delivery'] == 'on' )
		{
			update_option('orddd_enable_next_day_delivery','on');
			
			update_option('orddd_disable_next_day_delivery_after_hours',$_POST['disable_next_day_delivery_after_hours']);
			update_option('orddd_disable_next_day_delivery_after_minutes',$_POST['disable_next_day_delivery_after_minutes']);
		}
		else 
		{
			update_option('orddd_enable_next_day_delivery','off');
		}
	}
	elseif($action == 'date') 
	{
		if(isset($_POST['enable_delivery_date']))
		{
			update_option('orddd_enable_delivery_date',$_POST['enable_delivery_date']);
		}
		else
		{
			update_option('orddd_enable_delivery_date','');
		}
	

		foreach ($weekdays as $n => $day_name)
		{
			if(isset($_POST[$n]))
			{
				update_option($n,$_POST[$n]);
			}
			else
			{
				update_option($n,'');
			}
		}
		update_option('orddd_minimumOrderDays',$_POST['minimumOrderDays']);
		update_option('orddd_number_of_dates',$_POST['number_of_dates']);
		if(isset($_POST['show_delivery_date_in_customer_email']))
		{
			update_option('orddd_show_delivery_date_in_customer_email', $_POST['show_delivery_date_in_customer_email']);
		}
		else
		{
			update_option('orddd_show_delivery_date_in_customer_email', '');
		}
		
		//orddd_date_field_mandatory
		if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
		{
			global $wpdb;
			$wpefield__TABLE = $wpdb->prefix . 'wpsc_checkout_forms';
			$query = "select * from $wpefield__TABLE where unique_name = 'e_deliverydate'";
			$results = $wpdb->get_row( $query );
			if($results != null)
			{
				if($results->active=='1')
				{
					$field_id = $results->id;
					$mandatory = 0;
					if ($_POST['date_field_mandatory'] == 'checked')
					{
						$mandatory = 1;
					}
					$qry = "UPDATE $wpefield__TABLE SET `mandatory` = '".$mandatory."' WHERE `id` = '$field_id'";
					$wpdb->query($qry);
				}
			}
		}
		if(isset($_POST['date_field_mandatory']))
		{
			update_option('orddd_date_field_mandatory', $_POST['date_field_mandatory']);
		}
		else
		{
			update_option('orddd_date_field_mandatory', '');
		}
		update_option('orddd_lockout_date_after_orders', $_POST['lockout_date_after_orders']);


	}
	elseif ($action == 'holidays')
	{
		$tstmp = strtotime($_POST['holiday_date']);
		$holiday_date = '';
		if($tstmp != '')
		{
			$holiday_date = date(HOLIDAY_DATE_FORMAT, $tstmp);
		}
		$holidays = get_option('orddd_delivery_date_holidays');
		if ($holidays == '' || $holidays == '{}' || $holidays == '[]')
		{
			$holidays_arr = array();
		}
		else 
		{
			$holidays_arr = json_decode($holidays);
		}
		foreach ($holidays_arr as $k => $v)
		{
			$holidays_new_arr[] = array('n'=>$v->n, 'd'=>$v->d);
		}
		$holiday_name = str_replace("\'","",$_POST['holiday_name']);
		$holiday_name = str_replace('\"','',$holiday_name);
		$holidays_new_arr[] = array('n'=>$holiday_name,
					 			'd'=>$holiday_date);
		$holidays_jarr = json_encode($holidays_new_arr);
		if($holiday_name != '' && $holiday_date != '' || $holiday_date != '')
		{
			update_option('orddd_delivery_date_holidays',$holidays_jarr);
		}
		
	}
	elseif ($action == 'appearance')
	{
		/*echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		exit;*/
		update_option('orddd_delivery_date_format', $_POST['delivery_date_format']);
		update_option('orddd_number_of_months', $_POST['number_of_months']);
		
		// update field label
		if (ECOMMERCE_PLUGIN_ACTIVE == WPECOMMERCE_PLUGIN_NAME)
		{
			global $wpdb;
			$wpefield__TABLE = $wpdb->prefix . 'wpsc_checkout_forms';
			$query = "select * from $wpefield__TABLE where unique_name = 'e_deliverydate'";
			$results = $wpdb->get_row( $query );
			if($results != null)
			{
				if($results->active=='1')
				{
					$field_id = $results->id;
					$qry = "UPDATE $wpefield__TABLE SET `name` = '".$_POST['delivery_date_field_label']."' WHERE `id` = '$field_id'";
					$wpdb->query($qry);
				}
			}
		}
		update_option('orddd_delivery_date_field_label', $_POST['delivery_date_field_label']);
		
		// update field note text
		update_option('orddd_delivery_date_field_note', $_POST['delivery_date_field_note']);
		
		$calendar_theme = trim($_POST['calendar_theme']);
		$calendar_theme_name = $calendar_themes[$calendar_theme];
		
		update_option('orddd_calendar_theme', $calendar_theme);
		update_option('orddd_calendar_theme_name', $calendar_theme_name);
		//echo in_array($calendar_theme, $calendar_themes);
		
		/*if (false !== $key = array_search($calendar_theme_name, $calendar_themes))
		{
			// calendar theme
			update_option('orddd_calendar_theme', $key);
			update_option('orddd_calendar_theme_name', $calendar_theme_name);
		}
		else 
		{
			update_option('orddd_calendar_theme', CALENDAR_THEME);
			update_option('orddd_calendar_theme_name', CALENDAR_THEME_NAME);
		}*/
		update_option('orddd_language_selected',$_POST['localisation_select']);
	}
	elseif ($action == 'delivery_dates')
	{
		/*echo "<pre>";
			print_r($_POST);
		echo "</pre>";*/
		if(isset($_POST['enable_specific_delivery_dates']))
		{
			update_option('orddd_enable_specific_delivery_dates',$_POST['enable_specific_delivery_dates']);
		}
		else
		{
			update_option('orddd_enable_specific_delivery_dates','');
		}
		if (isset($_POST['enable_specific_delivery_dates']) && $_POST['enable_specific_delivery_dates'] == 'on')
		{
			//$holiday_date = date(HOLIDAY_DATE_FORMAT, $tstmp);
			$holidays = get_option('orddd_delivery_dates');
			//print_r($holidays);
			if ($holidays == '' || $holidays == '{}' || $holidays == '[]' || $holidays == 'null')
			{
				$holidays_arr = array();
			}
			else
			{
				$holidays_arr = json_decode($holidays);
			}
			//print_r($holidays_arr);
			$holidays_new_arr = array();
			foreach ($holidays_arr as $k => $v)
			{
				$holidays_new_arr[] = $v;
			}
			//print_r($holidays_new_arr);
			$delivery_dates_arr = array();
				
			if (!isset($holidays_new_arr)) $holidays_new_arr = array();
				
			if ($_POST['delivery_date_1'] != "" )
			{
				$tstmp1 = strtotime($_POST['delivery_date_1']);
				$holiday_date_1 = date(HOLIDAY_DATE_FORMAT, $tstmp1);
				if(!in_array($holiday_date_1,$holidays_new_arr))
				{
					$delivery_dates_arr[] = $holiday_date_1;
					array_push($holidays_new_arr, $holiday_date_1);
				}
			}
				
			if ($_POST['delivery_date_2'] != "")
			{
				$tstmp2 = strtotime($_POST['delivery_date_2']);
				$holiday_date_2 = date(HOLIDAY_DATE_FORMAT, $tstmp2);
				if(!in_array($holiday_date_2,$holidays_new_arr))
				{
					$delivery_dates_arr[] = $holiday_date_2;
					array_push($holidays_new_arr, $holiday_date_2);
				}
			}
	
			if ($_POST['delivery_date_3'] != "")
			{
				$tstmp3 = strtotime($_POST['delivery_date_3']);
				$holiday_date_3 = date(HOLIDAY_DATE_FORMAT, $tstmp3);
				if(!in_array($holiday_date_3,$holidays_new_arr))
				{
					$delivery_dates_arr[] = $holiday_date_3;
					array_push($holidays_new_arr, $holiday_date_3);
				}
			}
			//$zip_code_dates[$zip_code_group_name] = $delivery_dates_arr;
				
			//$delivery_dates_new_arr = array_merge($holidays_new_arr, $zip_code_dates);
			//array_push($holidays_new_arr[$zip_code_group_name], $delivery_dates_arr);
				
			$delivery_dates_str = json_encode($holidays_new_arr);
			/*echo "<pre>";
				print_r($holidays_new_arr);
			echo $delivery_dates_str;
			echo "</pre>";
			exit;*/
			update_option('orddd_delivery_dates',$delivery_dates_str);
		}
	}
	elseif ($action == 'time_slot')
	{
	  	$timeslot = get_option('orddd_delivery_time_slot_log');
		//echo $timeslot."time slot";
		if(isset($_POST['select_delivery_dates']))
		{
			$devel_dates=json_encode($_POST['select_delivery_dates']);
		}
		else
		{
			$devel_dates = '';
		}
	    $from_hour = $_POST['time_from_hours'];
		$from_minute = $_POST['time_from_minutes'];
		$to_hour = $_POST['time_to_hours'];
		$to_minute = $_POST['time_to_minutes'];
		$lockouttime = $_POST['lockout_time_after_orders'];
		$timeslot_new_arr = array();
		if ($timeslot=='null' || $timeslot == '' || $timeslot == '{}' || $timeslot == '[]')
        {
			$timeslot_arr = array();
			
		}
		else 
		{
			$timeslot_arr = json_decode($timeslot);
			
		}
		 if (isset($timeslot_arr) && count($timeslot_arr) > 0)
		{
			foreach ($timeslot_arr as $k => $v)
			{
				$timeslot_new_arr[] = array('dd'=>$v->dd,'lockout'=>$v->lockout,'fh'=>$v->fh, 'fm'=>$v->fm, 'th'=>$v->th, 'tm'=>$v->tm);
			}
		}
		$from_hour_new = date("g" , mktime($from_hour, $from_minute, 0, date("m"), date("d"), date("Y")));
		$from_minute_new = date("i A" , mktime($from_hour, $from_minute, 0, date("m"), date("d"), date("Y")));
		$to_hour_new = date("g" , mktime($to_hour, $to_minute, 0, date("m"), date("d"), date("Y")));
		$to_minute_new = date("i A" , mktime($to_hour, $to_minute, 0, date("m"), date("d"), date("Y")));
		if(get_option('orddd_enable_specific_delivery_dates')=='on')
		{
			if($from_hour_new!=$to_hour_new)
			{
				$timeslot_new_arr[] = array('dd'=>$devel_dates,
									'lockout'=>$lockouttime,
						 			'fh'=>$from_hour_new,
									'fm'=>$from_minute_new,
									'th'=>$to_hour_new,
									'tm'=>$to_minute_new,
									);
			}
		}
		else
		{
			if($from_hour_new!=$to_hour_new)
				{
								$timeslot_new_arr[] = array('dd'=>$devel_dates,
									'lockout'=>$lockouttime,
						 			'fh'=>$from_hour_new,
									'fm'=>$from_minute_new,
									'th'=>$to_hour_new,
									'tm'=>$to_minute_new,
									);
				}
		}
		$timeslot_jarr = json_encode($timeslot_new_arr);
		update_option('orddd_delivery_time_slot_log',$timeslot_jarr);
		if(isset($_POST['enable_time_slot']))
		{
			update_option('orddd_enable_time_slot',$_POST['enable_time_slot']);
		}
		else
		{
			update_option('orddd_enable_time_slot','');
		}
		if(isset($_POST['time_slot_field_mandatory']))
		{
			update_option('orddd_time_slot_mandatory', $_POST['time_slot_field_mandatory']);
		}
		else
		{
			update_option('orddd_time_slot_mandatory','');
		}
			update_option('orddd_delivery_timeslot_field_label', $_POST['delivery_timeslot_field_label']);
		}
	}
if ((isset($_GET['action']) && $_GET['action'] == 'holidays') && (isset($_GET['mode']) && $_GET['mode'] == 'delete') && (!isset($_POST['save'])))
{
	$holidays = get_option('orddd_delivery_date_holidays');
	$holidays_arr = json_decode($holidays);
	$holidays_new_arr = array();
	if(count($holidays_arr) > 0)
	{
		foreach ($holidays_arr as $k => $v)
		{
			$holidays_new_arr[] = array('n'=>$v->n, 'd'=>$v->d);
		}
	}
	$cnt = count($holidays_new_arr);
	if ($_GET['mode'] == 'delete')
	{
		if(isset($_GET['n']))
		{
			$n = $_GET['n'];
			$key = 'n';
		}
		else
		{
			$n = $_GET['d'];
			$key ='d';
		}
		$new_arr = removeElementWithValue($holidays_new_arr,$key,$n);
		$holidays_jarr = json_encode($new_arr);
		update_option('orddd_delivery_date_holidays',$holidays_jarr);
	}
}
elseif ((isset($_GET['action']) && $_GET['action'] == 'time_slot') && (isset($_GET['mode']) && $_GET['mode'] == 'delete') && (!isset($_POST['save'])))
{
	$time_slot_str = get_option('orddd_delivery_time_slot_log');
    $time_slots = json_decode($time_slot_str);
	$timeslot_new_arr = array();
	if($time_slots=='null' || $time_slots=='null' || $time_slots == '' || $time_slots == '{}' || $time_slots == '[]')
	{
		$time_slots=array();
	}
	//print_r($time_slots);exit;
	foreach($time_slots as $key => $v)
	{
			$arr = $v->fh.":".$v->fm." - ".$v->th.":".$v->tm;
			if(get_option('orddd_enable_specific_delivery_dates')=='on')
			{
				
				$dd = json_decode($v->dd);
				$new_dd_str = '[';
				for ($i = 0 ; $i < count($dd) ; $i++)
				{
					if ($_GET['fh'] == $v->fh && $_GET['fm'] == $v->fm && $_GET['th'] == $v->th && $_GET['tm'] == $v->tm && $_GET['dd'] == $dd[$i])
					{
					// do nothing as this time slot needs to be deleted
					}
					else 
					{
						$new_dd_str .= '"'.$dd[$i].'",';
					}
				}
				$new_dd_str = substr($new_dd_str, 0, strlen($new_dd_str)-1);
				if(trim($new_dd_str)!="")
				{
					$new_dd_str .= ']';
					$timeslot_new_arr[] = array('dd'=>$new_dd_str,'lockout'=>$v->lockout, 'fh'=>$v->fh, 'fm'=>$v->fm, 'th'=>$v->th, 'tm'=>$v->tm);
				}
			}
			else if(get_option('orddd_enable_delivery_date')=='on' && get_option('orddd_enable_specific_delivery_dates')== '')
			{
					
					if ($_GET['fh'] == $v->fh && $_GET['fm'] == $v->fm && $_GET['th'] == $v->th && $_GET['tm'] == $v->tm)
					{
							unset($v);
					}
					else
					{
							$timeslot_new_arr[] = array('dd'=>'null','lockout'=>$v->lockout, 'fh'=>$v->fh, 'fm'=>$v->fm, 'th'=>$v->th, 'tm'=>$v->tm);
					}

			}
			
	}
	$timeslot_jarr = json_encode($timeslot_new_arr);
	update_option('orddd_delivery_time_slot_log',$timeslot_jarr);
	
	
}
elseif ((isset($_GET['action']) && $_GET['action'] == 'delivery_dates') && (isset($_GET['mode']) && $_GET['mode'] == 'delete') && (!isset($_POST['save'])))
{
	$date_to_delete = $_GET['d'];
	$time_slot_str = get_option('orddd_delivery_time_slot_log');
	$time_slot = json_decode($time_slot_str);
	$delivery_dates = get_option('orddd_delivery_dates');
	$timeslot_new_arr = array();
	if ($delivery_dates != '' && $delivery_dates != '{}' && $delivery_dates != '[]' && $delivery_dates != 'null')
	{
		$delivery_dates_new_arr = json_decode($delivery_dates,true);
		//print_r($delivery_dates_new_arr);echo "2495";
	}
	$new_arr = array();
	$i = 0;
	foreach ($delivery_dates_new_arr as $key => $value)
	{
		if ($value == $date_to_delete)
		{
			//echo "KEY: $key";
			unset($delivery_dates_new_arr[$key]);
		}
		else
		{
			$new_arr[$i] = $value;
			$i++;
		}
	}
	if($time_slot =='null' || $time_slot =='null' || $time_slot == '' || $time_slot  == '{}' || $time_slot  == '[]')
	{
		$time_slot =array();
	}
	foreach($time_slot as $key => $v)
	{
		$arr = $v->fh.":".$v->fm." - ".$v->th.":".$v->tm;
		$dd = json_decode($v->dd);
		$new_dd_str = '[';
		for ($i = 0 ; $i < count($dd) ; $i++)
		{
			if ($dd[$i] == $date_to_delete)
			{
				// do nothing as this time slot needs to be deleted
			}
			else 
			{
				$new_dd_str .= '"'.$dd[$i].'",';
			}
		}
		$new_dd_str = substr($new_dd_str, 0, strlen($new_dd_str)-1);
		if(trim($new_dd_str)!="")
		{
			$new_dd_str .= ']';
			$timeslot_new_arr[] = array('dd'=>$new_dd_str,'lockout'=>$v->lockout, 'fh'=>$v->fh, 'fm'=>$v->fm, 'th'=>$v->th, 'tm'=>$v->tm);
		}
	}
	$delivery_dates_new_arr = $new_arr;
	
	update_option('orddd_delivery_dates',json_encode($delivery_dates_new_arr));
	$timeslot_jarr = json_encode($timeslot_new_arr);
	update_option('orddd_delivery_time_slot_log',$timeslot_jarr);
}


function update_lockout_days($delivery_date)
{
	$tstmp = strtotime($delivery_date);
	$lockout_date = date(LOCKOUT_DATE_FORMAT, $tstmp);
	$lockout_days = get_option('orddd_lockout_days');
	$timeslot_new_arr = array();
	if ($lockout_days == '' || $lockout_days == '{}' || $lockout_days == '[]')
	{
		$lockout_days_arr = array();
	}
	else 
	{
		$lockout_days_arr = json_decode($lockout_days);
	}
	// existing lockout days
	$existing_days = array();
	foreach ($lockout_days_arr as $k => $v)
	{
		$orders = $v->o;
		if ($lockout_date == $v->d)
		{
			$orders = $v->o + 1;
		}
		$existing_days[] = $v->d;
		$lockout_days_new_arr[] = array('o'=>$orders, 'd'=>$v->d);
	}
	// add the currently selected date if it does not already exist
	if (!in_array($lockout_date, $existing_days))
	{
		$lockout_days_new_arr[] = array('o'=>1,
										'd'=>$lockout_date);
	}
	$lockout_days_jarr = json_encode($lockout_days_new_arr);
	update_option('orddd_lockout_days',$lockout_days_jarr);
}
function update_time_slot($timeslt, $del)
{  
    $lockout_date = $_POST['h_deliverydate'];
	$abc = get_option('orddd_delivery_time_slot_log');
    $abcd = json_decode($abc, true);
	foreach($abcd as $key => $v)
	{
		$arr[] = $v['fh'].":".$v['fm']." - ".$v['th'].":".$v['tm'];
	}
	$result = array_combine($arr, $arr);
	$lockout_time = get_option('orddd_lockout_time_slot');
    
	if ($lockout_time == '' || $lockout_time == '{}' || $lockout_time == '[]')
	{
		$lockout_time_arr = array();
	}
	else 
	{
		$lockout_time_arr = json_decode($lockout_time);
	}
	$existing_timeslots = $existing_days = array();
	foreach ($lockout_time_arr as $k => $v)
	{
		$orders = $v->o;
		if ( $timeslt == $v->t && $lockout_date == $v->d )
		{
			$orders = $v->o + 1;
		}
		$existing_timeslots[] = $v->t;
		$existing_dates[] = $v->d;
		$lockout_time_new_arr[] = array('o'=>$orders, 't'=>$v->t, 'd'=>$v->d);
	}
	
	// add the currently selected date if it does not already exist
	if (!in_array($timeslt, $existing_timeslots) || !in_array($lockout_date, $existing_dates))
	{
		$lockout_time_new_arr[] = array('o'=>1,
										't'=>$timeslt,
										'd'=>$lockout_date);
	}
	$lockout_time_jarr = json_encode($lockout_time_new_arr);
	
	update_option('orddd_lockout_time_slot',$lockout_time_jarr);
	
	
}
/*add_filter( 'woocommerce_checkout_order_review' , 'custom_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields )
{
	if(count($_POST) == '0')
	{?>
	<script type="text/javascript">
	jQuery('input#billing_postcode').live('change',function()
	{
		jQuery('#span1').remove();
		load_delivery_date();
		
	});
	function load_delivery_date()
	{
		
		var postcode = jQuery('input#billing_postcode').val();
		if(postcode != "")
		{
			var hidden_var_obj = jQuery("#zip_code_hidden_vars_arr").val();
			var html_vars_obj = hidden_var_obj.split(",");
			Array.prototype.inArray = function (value)
			{
			// Returns true if the passed value is found in the
			// array. Returns false if it is not.
			var i;
			for (i=0; i < this.length; i++)
			{
				if (this[i].trim() == value.trim())
				{
					return true;
				}
			}
			 return false;
			};
			if(html_vars_obj.inArray(postcode))
			{
				
				jQuery('#zip_code_not_found').html('');	
				jQuery('#span1').remove();
				
			}
			else
			{
				var str = '<a href="mailto:customerservice@cow2door.com">customerservice@cow2door.com</a>';
				jQuery('#billing_postcode_field').after('<span id="span1" style="color:red">"Unfortunately you are outside of our delivery area. Please send an email to '+ str +' with your name, address and desired delivery date to get a delivery quote. Thank you and sorry for the inconvenience."</span>');	
			}
			
				
		}
		
	}

	</script>
	<?php
	}
	return $fields;
}*/

?>