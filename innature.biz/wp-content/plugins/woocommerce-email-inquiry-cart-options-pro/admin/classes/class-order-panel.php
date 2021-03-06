<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
/**
 * WooCommerce Email Inquiry Order Panel
 *
 * Table Of Contents
 *
 * admin_warning()
 * panel_manager()
 */
class WC_Email_Inquiry_Order_Panel
{	
	public static function admin_warning() {
		global $wc_email_inquiry_rules_roles_settings;
		
		@session_start();
		
		if (isset($_GET['hide-order-admin-warning'])) $_SESSION['hide-order-admin-warning'] = 1 ;
		if (!isset($_SESSION['hide-order-admin-warning'])) {	
			if ($wc_email_inquiry_rules_roles_settings['add_to_order'] == 'yes' || $wc_email_inquiry_rules_roles_settings['activate_order_logged_in'] == 'yes')	$status = __('activated', 'wc_email_inquiry');	
			else $status = __('deactivated', 'wc_email_inquiry');	
		?>
        <div style="position:relative;margin: 5px 0 15px;background-color: #FFFFE0;border-color: #E6DB55;padding: 0 0.6em;border-radius: 3px 3px 3px 3px;border-style: solid;border-width: 1px;outline: 0 none;"><p style="margin: 0.5em 0;padding: 2px;"><strong><?php printf( __( 'Orders mode feature is currently %s.', 'wc_email_inquiry' ), $status ); ?></strong> <a class="hide" href="<?php echo add_query_arg('hide-order-admin-warning', 'true'); ?>" style="color:#FF0808;float:right;text-decoration:none;position:absolute;top:0;right:0;line-height:24px;padding:2px 8px;text-align:center;font-size:16px;" >&times;</a></p></div>
		<?php
		}
	}
	
	public static function panel_manager() {
		$message = '';
		if (isset($_REQUEST['bt_save_settings'])) {
			$message = '<div class="updated" id=""><p>'.__('Add to Order Settings Successfully saved.', 'wc_email_inquiry').'</p></div>';
		}elseif (isset($_REQUEST['bt_reset_settings'])) {
			$message = '<div class="updated" id=""><p>'.__('Add to Order Settings Successfully reseted.', 'wc_email_inquiry').'</p></div>';
		}
		
		?>
        <?php echo $message; ?>
	<form action="" method="post">
    <div id="wc_email_inquiry_panel_container">
    	<div id="wc_email_inquiry_panel_fields" class="a3_subsubsub_section">
        	<ul class="subsubsub">
            	<li><a href="#order-mode-settings" class="current"><?php _e('Settings', 'wc_email_inquiry'); ?></a> | </li>
            	<li><a href="#order-product-page"><?php _e('Product Page', 'wc_email_inquiry'); ?></a> | </li>
                <li><a href="#order-widget-cart"><?php _e('Widget Cart', 'wc_email_inquiry'); ?></a> | </li>
                <li><a href="#order-cart-page"><?php _e('Cart Page', 'wc_email_inquiry'); ?></a> | </li>
                <li><a href="#order-checkout-page"><?php _e('Checkout Page', 'wc_email_inquiry'); ?></a> | </li>
                <li><a href="#order-order-received"><?php _e('Order Received', 'wc_email_inquiry'); ?></a> | </li>
                <li><a href="#order-emails"><?php _e('Orders Emails', 'wc_email_inquiry'); ?></a></li>
			</ul>
            <br class="clear">
            <?php WC_Email_Inquiry_Order_Panel::admin_warning(); ?>
            
            <div class="section" id="order-mode-settings">
            	<div class="pro_feature_fields">
            	<?php WC_Email_Inquiry_Order_Mode_Settings::panel_page(); ?>
                </div>
            </div>
            <div class="section" id="order-product-page">
            	<div class="pro_feature_fields">
            	<?php WC_Email_Inquiry_Order_Product_Page::panel_page(); ?>
                </div>
            </div>
            <div class="section" id="order-widget-cart">
            	<div class="pro_feature_fields">
            	<?php WC_Email_Inquiry_Order_Widget_Cart::panel_page(); ?>
                </div>
            </div>
            <div class="section" id="order-cart-page">
            	<div class="pro_feature_fields">
            	<?php WC_Email_Inquiry_Order_Cart_Page::panel_page(); ?>
                </div>
            </div>
            <div class="section" id="order-checkout-page">
            	<div class="pro_feature_fields">
            	<?php WC_Email_Inquiry_Order_Checkout_Page::panel_page(); ?>
                </div>
            </div>
            <div class="section" id="order-order-received">
            	<div class="pro_feature_fields">
            	<?php WC_Email_Inquiry_Order_Order_Received_Page::panel_page(); ?>
                </div>
            </div>
            <div class="section" id="order-emails">
            	<div class="pro_feature_fields">
            	<?php WC_Email_Inquiry_Order_New_Account_Email_Settings::panel_page(); ?>
                </div>
            </div>
		</div>
        <div id="wc_email_inquiry_upgrade_area"><?php echo WC_Email_Inquiry_Functions::plugin_pro_notice(); ?></div>
    </div>
    <div style="clear:both;"></div>
    		<p class="submit">
                <input type="submit" value="<?php _e('Save changes', 'wc_email_inquiry'); ?>" class="button-primary" name="bt_save_settings" id="bt_save_settings">
				<input type="submit" name="bt_reset_settings" id="bt_reset_settings" class="button" value="<?php _e('Reset Settings', 'wc_email_inquiry'); ?>"  />
        		<input type="hidden" id="last_tab" name="subtab" />
            </p>
    </form>
	<?php
	}
}
?>