<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
/**
 * WooCommerce Email Inquiry Order Checkout Page
 *
 * Table Of Contents
 *
 * get_settings_default()
 * set_settings_default()
 * get_settings()
 * panel_page()
 */
class WC_Email_Inquiry_Order_Checkout_Page
{
	public static function get_settings_default() {
		$default_settings = array(
			'order_checkout_page_name'				=> __('Send Order', 'wc_email_inquiry'),
			'order_place_order_button'				=> __('Send Order Request', 'wc_email_inquiry'),
		);
		
		return $default_settings;
	}
	
	public static function set_settings_default($reset=false) {
		$option_name = 'wc_email_inquiry_order_checkout_page';
		
		$default_settings = WC_Email_Inquiry_Order_Checkout_Page::get_settings_default();
		
		
		if ($reset) {
			update_option($option_name, $default_settings);
			update_option('wc_email_inquiry_order_checkout_top_message', '');
			update_option('wc_email_inquiry_order_checkout_bottom_message', '');
		} else {
			update_option($option_name, $default_settings);
			update_option('wc_email_inquiry_order_checkout_top_message', '');
			update_option('wc_email_inquiry_order_checkout_bottom_message', '');
		}
				
	}
	
	public static function get_settings() {
		global $wc_email_inquiry_order_checkout_page;
		global $wc_email_inquiry_order_checkout_top_message;
		global $wc_email_inquiry_order_checkout_bottom_message;
		$wc_email_inquiry_order_checkout_page = WC_Email_Inquiry_Order_Checkout_Page::get_settings_default();
		
		$wc_email_inquiry_order_checkout_top_message = get_option('wc_email_inquiry_order_checkout_top_message');
		if ($wc_email_inquiry_order_checkout_top_message === false) $wc_email_inquiry_order_checkout_top_message = '';
		
		$wc_email_inquiry_order_checkout_bottom_message = get_option('wc_email_inquiry_order_checkout_bottom_message');
		if ($wc_email_inquiry_order_checkout_bottom_message === false) $wc_email_inquiry_order_checkout_bottom_message = '';
		
		return $wc_email_inquiry_order_checkout_page;
	}
	
	public static function panel_page() {
		$option_name = 'wc_email_inquiry_order_checkout_page';
		if (isset($_REQUEST['bt_save_settings'])) {
			WC_Email_Inquiry_Order_Checkout_Page::set_settings_default(true);
		}elseif (isset($_REQUEST['bt_reset_settings'])) {
			WC_Email_Inquiry_Order_Checkout_Page::set_settings_default(true);
		}
		
		$customized_settings = $default_settings = WC_Email_Inquiry_Order_Checkout_Page::get_settings_default();
		
		extract($customized_settings);
				
		?>
        <h3><?php _e('Customize the Add Details and Send (Checkout) Page', 'wc_email_inquiry'); ?></h3>
        <p><?php _e("Order Mode creates its own template that replaces the WooCommerce Checkout page.", 'wc_email_inquiry'); ?></p>
		<table class="form-table">
            <tr valign="top">
		    	<th class="titledesc" scope="row"><label for="order_checkout_page_name"><?php _e( 'Order Checkout Page Title', 'wc_email_inquiry' );?></label></th>
		    	<td class="forminp">                    
                    <input type="text" value="<?php esc_attr_e( stripslashes( $order_checkout_page_name ) ); ?>" name="<?php echo $option_name; ?>[order_checkout_page_name]" id="order_checkout_page_name" style="width:300px;"  /> <div class="description"><?php _e("Replace Checkout page name", 'wc_email_inquiry');?></div>
				</td>
			</tr>
            <tr valign="top">
		    	<th class="titledesc" scope="row"><label for="order_place_order_button"><?php _e( 'Send Order Request', 'wc_email_inquiry' );?></label></th>
		    	<td class="forminp">                    
                    <input type="text" value="<?php esc_attr_e( stripslashes( $order_place_order_button ) ); ?>" name="<?php echo $option_name; ?>[order_place_order_button]" id="order_place_order_button" style="width:300px;"  /> <div class="description"><?php _e("Text that displays instead of 'Place order' on the button.", 'wc_email_inquiry');?></div>
				</td>
			</tr>
            <tr valign="top">
				<th class="titledesc" scope="rpw"><label for="wc_email_inquiry_order_checkout_top_message"><?php _e('Top of page Message','wc_email_inquiry'); ?></label></th>
				<td class="forminp">
					<?php wp_editor(get_option('wc_email_inquiry_order_checkout_top_message'), 'wc_email_inquiry_order_checkout_top_message', array('textarea_name' => 'wc_email_inquiry_order_checkout_top_message', 'wpautop' => true, 'textarea_rows' => 2 ) ); ?>
					<div class="description"><?php _e('Message that user sees on top of checkout page', 'wc_email_inquiry'); ?></div>
				</td>
			</tr>
            <tr valign="top">
				<th class="titledesc" scope="rpw"><label for="wc_email_inquiry_order_checkout_bottom_message"><?php _e('Bottom of page Message','wc_email_inquiry'); ?></label></th>
				<td class="forminp">
					<?php wp_editor(get_option('wc_email_inquiry_order_checkout_bottom_message'), 'wc_email_inquiry_order_checkout_bottom_message', array('textarea_name' => 'wc_email_inquiry_order_checkout_bottom_message', 'wpautop' => true, 'textarea_rows' => 2 ) ); ?>
					<div class="description"><?php _e('Message that user sees on bottom of checkout page', 'wc_email_inquiry'); ?></div>
				</td>
			</tr>
		</table>
	<?php
	}
}
?>