<?php
/**
 * Call this function when plugin is deactivated
 */
function wc_email_inquiry_uninstall(){
	
	delete_transient("a3rev_wc_email_inquiry_update_info");
	$respone_api = __('Connection Error! Could not reach the a3API on Amazon Cloud, the network may be busy. Please try again in a few minutes.', 'wc_email_inquiry');
	$options = array(
		'method' 	=> 'POST', 
		'timeout' 	=> 45, 
		'body' 		=> array(
			'act'			=> 'deactivate',
			'ssl'			=> get_option('a3rev_auth_wc_email_inquiry'),
			'plugin' 		=> get_option('a3rev_wc_email_inquiry_plugin'),
			'domain_name'	=> $_SERVER['SERVER_NAME'],
			'address_ip'	=> $_SERVER['SERVER_ADDR'],
		) 
	);
	$server_a3 = base64_decode('aHR0cDovL2EzYXBpLmNvbS9hdXRoYXBpL2luZGV4LnBocA==');
	$raw_response = wp_remote_request($server_a3 , $options);
	if ( !is_wp_error( $raw_response ) && 200 == $raw_response['response']['code']) {
		$respone_api = $raw_response['body'];
	}
	
	delete_option ( 'a3rev_pin_wc_email_inquiry' );
	delete_option ( 'a3rev_auth_wc_email_inquiry' );
}

function wc_email_inquiry_install(){
	update_option('a3rev_wc_email_inquiry_version', '1.1.0');

	WC_Email_Inquiry_Rules_Roles_Panel::set_settings_default();
	
	WC_Email_Inquiry_Global_Settings::set_settings_default();
	WC_Email_Inquiry_Email_Options::set_settings_default();
	WC_Email_Inquiry_Customize_Email_Button::set_settings_default();
	WC_Email_Inquiry_Customize_Email_Popup::set_settings_default();
	WC_Email_Inquiry_3RD_ContactForms_Settings::set_settings_default();
	
	delete_transient("a3rev_wc_email_inquiry_update_info");
	
	update_option('a3rev_wc_email_inquiry_just_installed', true);
}

update_option('a3rev_wc_email_inquiry_plugin', 'wc_email_inquiry');

/**
 * Load languages file
 */
function wc_email_inquiry_init() {
	if ( get_option('a3rev_wc_email_inquiry_just_installed') ) {
		delete_option('a3rev_wc_email_inquiry_just_installed');
		wp_redirect( ( ( is_ssl() || force_ssl_admin() || force_ssl_login() ) ? str_replace( 'http:', 'https:', admin_url( 'admin.php?page=email-cart-options' ) ) : str_replace( 'https:', 'http:', admin_url( 'admin.php?page=email-cart-options' ) ) ) );
		exit;
	}
	load_plugin_textdomain( 'wc_email_inquiry', false, WC_EMAIL_INQUIRY_FOLDER.'/languages' );
}
// Add language
add_action('init', 'wc_email_inquiry_init');

// Plugin loaded
add_action( 'plugins_loaded', array( 'WC_Email_Inquiry_Functions', 'plugins_loaded' ), 8 );

// Add text on right of Visit the plugin on Plugin manager page
add_filter( 'plugin_row_meta', array('WC_Email_Inquiry_Hook_Filter', 'plugin_extra_links'), 10, 2 );

if ( isset($_POST['wc_email_inquiry_pin_submit']) ) {
	wc_email_inquiry_confirm_pin();
}

$check_encryp_file = false;
$str = "THlvTkNsQnNkV2RwYmlCT1lXMWxPaUJYVUMxQ2JHOW5VM1J2Y21VZ1ptOXlJRmR2Y21Sd2NtVnpjdzBLVUd4MVoybHVJRlZTU1RvZ2FIUjBjRG92TDNkM2R5NWlkV2xzWkdGaWJHOW5jM1J2Y21VdVkyOXRMdzBLUkdWelkzSnBjSFJwYjI0NklFRjFkRzl0WVhScFkyRnNiSGtnWjJWdVpYSmhkR1VnWlVKaGVTQmhabVpwYkdsaGRHVWdZbXh2WjNNZ2QybDBhQ0IxYm1seGRXVWdkR2wwYkdWekxDQjBaWGgwTENCbFFtRjVJR0YxWTNScGIyNXpMZzBLVm1WeWMybHZiam9nTXk0d0RRcEVZWFJsT2lCTllYSmphQ0F4TENBeU1EQTVEUXBCZFhSb2IzSTZJRUoxYVd4a1FVSnNiMmRUZEc5eVpRMEtRWFYwYUc5eUlGVlNTVG9nYUhSMGNEb3ZMM2QzZHk1aWRXbHNaR0ZpYkc5bmMzUnZjbVV1WTI5dEx3MEtLaThnRFFvTkNnMEtJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJdzBLSXlBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSXcwS0l5QWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJRmRRTFVKc2IyZFRkRzl5WlNCWGIzSmtjSEpsYzNNZ1VHeDFaMmx1SUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0l3MEtJeUFnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJdzBLSXlBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSXcwS0l5QWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0l3MEtJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJdzBLRFFvTkNpTWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU09";
	if(file_exists(WC_EMAIL_INQUIRY_FILE_PATH."/encryp.inc")){
		$getfile = file_get_contents(WC_EMAIL_INQUIRY_FILE_PATH ."/encryp.inc");
		if(strpos($getfile, $str) !== FALSE){
			$check_encryp_file = true;
		}
}

if ( $check_encryp_file && wc_email_inquiry_check_pin() ) {
	
	// Add Admin Menu
	add_action('admin_menu', array( 'WC_Email_Inquiry_Hook_Filter', 'add_admin_menu'), 11);
				
	// Include style into header
	add_action('get_header', array('WC_Email_Inquiry_Hook_Filter', 'add_style_header') );
	
	// Add Custom style on frontend
	add_action( 'wp_head', array( 'WC_Email_Inquiry_Hook_Filter', 'include_customized_style'), 11);
	
	// Include script into footer
	add_action('get_footer', array('WC_Email_Inquiry_Hook_Filter', 'script_contact_popup'), 2);
	
	// AJAX wc_email_inquiry contact popup
	add_action('wp_ajax_wc_email_inquiry_popup', array('WC_Email_Inquiry_Hook_Filter', 'wc_email_inquiry_popup') );
	add_action('wp_ajax_nopriv_wc_email_inquiry_popup', array('WC_Email_Inquiry_Hook_Filter', 'wc_email_inquiry_popup') );
	
	// AJAX wc_email_inquiry_action
	add_action('wp_ajax_wc_email_inquiry_action', array('WC_Email_Inquiry_Hook_Filter', 'wc_email_inquiry_action') );
	add_action('wp_ajax_nopriv_wc_email_inquiry_action', array('WC_Email_Inquiry_Hook_Filter', 'wc_email_inquiry_action') );
	
	// Hide Add to Cart button on Shop page
	add_action('woocommerce_before_template_part', array('WC_Email_Inquiry_Hook_Filter', 'shop_before_hide_add_to_cart_button'), 100, 3 );
	add_action('woocommerce_after_template_part', array('WC_Email_Inquiry_Hook_Filter', 'shop_after_hide_add_to_cart_button'), 1, 3 );
	
	// Hide Add to Cart button on Details page
	add_action('woocommerce_before_add_to_cart_button', array('WC_Email_Inquiry_Hook_Filter', 'details_before_hide_add_to_cart_button'), 100 );
	add_action('woocommerce_after_add_to_cart_button', array('WC_Email_Inquiry_Hook_Filter', 'details_after_hide_add_to_cart_button'), 1 );
	
	// Hide Price on Shop page and Details page
	add_action('woocommerce_before_template_part', array('WC_Email_Inquiry_Hook_Filter', 'shop_before_hide_price'), 100, 3 );
	add_action('woocommerce_after_template_part', array('WC_Email_Inquiry_Hook_Filter', 'shop_after_hide_price'), 1, 3 );
	
	// Hide Price
	add_filter('woocommerce_get_price_html', array('WC_Email_Inquiry_Hook_Filter', 'global_hide_price'), 100, 2);
	add_filter('woocommerce_variation_sale_price_html', array('WC_Email_Inquiry_Hook_Filter', 'global_hide_price'), 100, 2);
	add_filter('woocommerce_variation_price_html', array('WC_Email_Inquiry_Hook_Filter', 'global_hide_price'), 100, 2);
	add_filter('woocommerce_variation_free_price_html', array('WC_Email_Inquiry_Hook_Filter', 'global_hide_price'), 100, 2);
	add_filter('woocommerce_variation_empty_price_html', array('WC_Email_Inquiry_Hook_Filter', 'global_hide_price'), 100, 2);
	add_filter('woocommerce_cart_item_price_html', array('WC_Email_Inquiry_Hook_Filter', 'hide_price_from_mini_cart'), 100, 3);
	add_filter('woocommerce_widget_cart_item_quantity', array('WC_Email_Inquiry_Hook_Filter', 'remove_x_character_mini_cart'), 100, 3);
	
	// Add Email Inquiry Button on Shop page
	$wc_email_inquiry_global_settings = WC_Email_Inquiry_Global_Settings::get_settings();
	$wc_email_inquiry_button_position = $wc_email_inquiry_global_settings['inquiry_button_position'];
	if ($wc_email_inquiry_button_position == 'above' )
		add_action('woocommerce_before_template_part', array('WC_Email_Inquiry_Hook_Filter', 'shop_add_email_inquiry_button_above'), 9, 3);
	else
		add_action('woocommerce_after_shop_loop_item', array('WC_Email_Inquiry_Hook_Filter', 'shop_add_email_inquiry_button_below'), 12);
	
	// Add Email Inquiry Button on Product Details page
	if ($wc_email_inquiry_button_position == 'above' )
		add_action('woocommerce_before_template_part', array('WC_Email_Inquiry_Hook_Filter', 'details_add_email_inquiry_button_above'), 9, 3 );
	else
		add_action('woocommerce_after_template_part', array('WC_Email_Inquiry_Hook_Filter', 'details_add_email_inquiry_button_below'), 2, 3);
	
	
	// Add meta boxes to product page
	add_action( 'admin_menu', array('WC_Email_Inquiry_MetaBox', 'add_meta_boxes') );
	if(in_array(basename($_SERVER['PHP_SELF']), array('post.php', 'page.php', 'page-new.php', 'post-new.php'))){
		add_action('save_post', array('WC_Email_Inquiry_MetaBox','save_meta_boxes' ) );
	}
	
	// Include script admin plugin
	if ( in_array( basename ($_SERVER['PHP_SELF']), array('admin.php', 'edit.php') ) && isset( $_REQUEST['page'] ) && in_array( $_REQUEST['page'], array('email-cart-options') ) ) {
		add_action('admin_head', array('WC_Email_Inquiry_Hook_Filter', 'admin_header_script'));
		add_action('admin_footer', array('WC_Email_Inquiry_Hook_Filter', 'admin_footer_scripts'));
	}
	
	// Upgrade to 1.0.3
	if(version_compare(get_option('a3rev_wc_email_inquiry_version'), '1.0.3') === -1){
		WC_Email_Inquiry_Functions::upgrade_version_1_0_3();
		update_option('a3rev_wc_email_inquiry_version', '1.0.3');
	}
	
	// Upgrade to 1.1.0
	if(version_compare(get_option('a3rev_wc_email_inquiry_version'), '1.0.6') === -1){
		WC_Email_Inquiry_Functions::upgrade_version_1_0_6();
		update_option('a3rev_wc_email_inquiry_version', '1.0.6');
	}

	update_option('a3rev_wc_email_inquiry_version', '1.1.0');	
} else {
	// Add Predictive Search Activated Menu to Settings Menu 
	add_action('admin_menu', 'wc_email_inquiry_authorization_admin_menu' );
}

function woo_email_cart_options_dashboard() {
?>
	<style>
    .code, code{font-family:inherit;font-size:inherit;}
    .form-table{margin:0;border-collapse:separate;}
    .icon32-email-cart-options {background:url(<?php echo WC_EMAIL_INQUIRY_IMAGES_URL; ?>/a3-plugins.png) no-repeat left top !important;}
    .subsubsub{white-space:normal;}
    .subsubsub li{ white-space:nowrap;}
	img.help_tip{float: right; margin: 0 -10px 0 0;}
	#wc_email_inquiry_panel_container { position:relative; margin-top:10px;}
	#wc_email_inquiry_panel_fields {width:65%; float:left;}
	#wc_email_inquiry_upgrade_area { position:relative; margin-left: 65%; padding-left:10px;}
	#wc_email_inquiry_extensions { border:2px solid #E6DB55;-webkit-border-radius:10px;-moz-border-radius:10px;-o-border-radius:10px; border-radius: 10px; color: #555555; margin: 0px; padding: 5px 10px; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8); background:#FFFBCC; }
	#wc_email_inquiry_extensions h3 { margin-top:20px; }
	.pro_feature_fields { margin-right: -12px; position: relative; z-index: 10; border:2px solid #E6DB55;-webkit-border-radius:10px 0 0 10px;-moz-border-radius:10px 0 0 10px;-o-border-radius:10px 0 0 10px; border-radius: 10px 0 0 10px; border-right: 2px solid #FFFFFF; }
	.pro_feature_fields h3 { margin:8px 5px; }
	.pro_feature_fields p { margin-left:5px; }
	.pro_feature_fields  .form-table td, .pro_feature_fields .form-table th { padding:4px 10px; }
    </style>
    <div class="wrap">
    	<?php if( isset($_POST['wc_email_inquiry_pin_submit']) ) echo '<div id="message" class="updated fade"><p>'.get_option("a3rev_wc_email_inquiry_message").'</p></div>'; ?>
    	<div class="icon32 icon32-email-cart-options" id="icon32-email-cart-options"><br></div>
        <h2 class="nav-tab-wrapper">
		<?php
		$current_tab = (isset($_REQUEST['tab'])) ? $_REQUEST['tab'] : '';
		$tabs = array(
			'rules-roles'			=> __( 'Rules & Roles', 'wc_email_inquiry' ),
			'email-inquiry'			=> __( 'Email Inquiry', 'wc_email_inquiry' ),
			'quotes-mode'			=> __( 'Quotes Mode', 'wc_email_inquiry' ),
			'orders-mode'			=> __( 'Orders Mode', 'wc_email_inquiry' ),
		);
	
		foreach ($tabs as $name => $label) :
			echo '<a href="' . admin_url( 'admin.php?page=email-cart-options&tab=' . $name ) . '" class="nav-tab ';
			if ( $current_tab == '' && $name == 'rules-roles' ) echo 'nav-tab-active';
			if ( $current_tab == $name ) echo 'nav-tab-active';
			echo '">' . $label . '</a>';
		endforeach;
		?>
		</h2>
        <div style="width:100%; float:left;">
		<?php
		switch ($current_tab) :
			case 'email-inquiry':
				WC_Email_Inquiry_Panel::panel_manager();
				break;
			case 'quotes-mode':
				WC_Email_Inquiry_Quote_Panel::panel_manager();
				break;
			case 'orders-mode':
				WC_Email_Inquiry_Order_Panel::panel_manager();
				break;
			default :
				WC_Email_Inquiry_Rules_Roles_Panel::panel_manager();
				break;
		endswitch;
		?>
        </div>
        <div style="clear:both; margin-bottom:20px;"></div>
    </div>
<?php
}

function wc_email_inquiry_confirm_pin() {
	
	/**
	* Check pin for confirm plugin
	*/
	if(isset($_POST['wc_email_inquiry_pin_submit'])){
		$respone_api = __('Connection Error! Could not reach the a3API on Amazon Cloud, the network may be busy. Please try again in a few minutes.', 'wc_email_inquiry');
		$ji = md5(trim($_POST['P_pin']));
		$options = array(
			'method' 	=> 'POST', 
			'timeout' 	=> 45, 
			'sslverify'	=> false,
			'body' 		=> array(
				'act'			=> 'activate',
				'ssl'			=> $ji,
				'plugin' 		=> get_option('a3rev_wc_email_inquiry_plugin'),
				'domain_name'	=> $_SERVER['SERVER_NAME'],
				'address_ip'	=> $_SERVER['SERVER_ADDR'],
			) 
		);
		$server_a3 = base64_decode('aHR0cDovL2EzYXBpLmNvbS9hdXRoYXBpL2luZGV4LnBocA==');
		$raw_response = wp_remote_request($server_a3 , $options);
		if ( !is_wp_error( $raw_response ) && 200 == $raw_response['response']['code']) {
			$respone_api = $raw_response['body'];
		} elseif ( is_wp_error( $raw_response ) ) {
			$respone_api = __('Error Code: ', 'wc_email_inquiry').$raw_response['response']['code'].' | '.$raw_response->get_error_message();
		}
		
		if($respone_api == md5('valid')) {
			update_option( 'a3rev_pin_wc_email_inquiry', sha1(md5('a3rev.com_'.get_option('siteurl').'_wc_email_inquiry')));
			update_option( 'a3rev_auth_wc_email_inquiry', $ji );
			update_option( 'a3rev_wc_email_inquiry_message', __('Thank you. This Authorization Key is valid.', 'wc_email_inquiry') );
		}else{
			delete_option('a3rev_pin_wc_email_inquiry' );
			delete_option('a3rev_auth_wc_email_inquiry' );
			update_option('a3rev_wc_email_inquiry_message', $respone_api );
		}

		delete_transient("a3rev_wc_email_inquiry_update_info");
		if( wc_email_inquiry_check_pin() ){
			update_option('a3rev_wc_email_inquiry_just_confirm', 1);
		}
	}
}

function wc_email_inquiry_check_pin() {
	$domain_name = get_option('siteurl');
	if (function_exists('is_multisite')){
		if (is_multisite()) {
			global $wpdb;
			$domain_name = $wpdb->get_var("SELECT option_value FROM ".$wpdb->options." WHERE option_name = 'siteurl'");
			if ( substr($domain_name, -1) == '/') {
				$domain_name = substr( $domain_name, 0 , -1 );
			}
		}
	}
	if (get_option('a3rev_auth_wc_email_inquiry') != '' && get_option("a3rev_pin_wc_email_inquiry") == sha1(md5('a3rev.com_'.$domain_name.'_wc_email_inquiry'))) return true;
	else return false;
}

function wc_email_inquiry_authorization_admin_menu () {
	$woo_page = 'woocommerce';
	$admin_page = add_submenu_page( $woo_page , __( 'Email & Cart Options', 'wc_email_inquiry' ), __( 'Email & Cart Options', 'wc_email_inquiry' ), 'manage_options', 'email-cart-options', 'wc_email_inquiry_authorization_form' );
}

function wc_email_inquiry_authorization_form() {
	if(isset($_POST['wc_email_inquiry_pin_submit'])){
		echo '<div id="" class="error"><p>'.get_option("a3rev_wc_email_inquiry_message").'</p></div>';
	}
	if(!file_exists(WC_EMAIL_INQUIRY_FILE_PATH."/encryp.inc")){
		echo '<font size="+2" color="#FF0000"> '. __("No find the encryp.inc file. Please copy encryp.inc file to folder", "wc_email_inquiry") .' '.WC_EMAIL_INQUIRY_FILE_PATH.' </font>';
	}else{
		$getfile = file_get_contents(WC_EMAIL_INQUIRY_FILE_PATH ."/encryp.inc");
		$str = "THlvTkNsQnNkV2RwYmlCT1lXMWxPaUJYVUMxQ2JHOW5VM1J2Y21VZ1ptOXlJRmR2Y21Sd2NtVnpjdzBLVUd4MVoybHVJRlZTU1RvZ2FIUjBjRG92TDNkM2R5NWlkV2xzWkdGaWJHOW5jM1J2Y21VdVkyOXRMdzBLUkdWelkzSnBjSFJwYjI0NklFRjFkRzl0WVhScFkyRnNiSGtnWjJWdVpYSmhkR1VnWlVKaGVTQmhabVpwYkdsaGRHVWdZbXh2WjNNZ2QybDBhQ0IxYm1seGRXVWdkR2wwYkdWekxDQjBaWGgwTENCbFFtRjVJR0YxWTNScGIyNXpMZzBLVm1WeWMybHZiam9nTXk0d0RRcEVZWFJsT2lCTllYSmphQ0F4TENBeU1EQTVEUXBCZFhSb2IzSTZJRUoxYVd4a1FVSnNiMmRUZEc5eVpRMEtRWFYwYUc5eUlGVlNTVG9nYUhSMGNEb3ZMM2QzZHk1aWRXbHNaR0ZpYkc5bmMzUnZjbVV1WTI5dEx3MEtLaThnRFFvTkNnMEtJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJdzBLSXlBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSXcwS0l5QWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJRmRRTFVKc2IyZFRkRzl5WlNCWGIzSmtjSEpsYzNNZ1VHeDFaMmx1SUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0l3MEtJeUFnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJdzBLSXlBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSXcwS0l5QWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0l3MEtJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJdzBLRFFvTkNpTWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU09";
		if(strpos($getfile, $str) === FALSE){
			echo '<font size="+2" color="#FF0000"> '.__("encryp.inc was modified. Please keep it by default", "wc_email_inquiry").'. </font>';	
		}else{
	?>
		<style>
		.woocommerce .submit {display:none;}
		</style>
        <div class="wrap">
		<div class="main_title"><div id="icon-ms-admin" class="icon32"><br></div><h2><?php _e("Enter Your Plugin Authorization Key", "wc_email_inquiry") ; ?></h2></div>
		<div style="clear:both;height:30px;"></div>
		<div>
        	<form method="post" action="">
			<p>
				<?php _e("Authorization Key", "wc_email_inquiry"); ?>: <input name="P_pin" type="text" id="P_pin" style="padding:10px; width:250px;" />
				<br/>
				<p>
					<input class="button-primary" type="submit" name="wc_email_inquiry_pin_submit" value="<?php _e("Validate", "wc_email_inquiry"); ?>" />
				</p>
			</p>
            </form>
		</div>
        </div>
	<?php
		}
	}
}
?>