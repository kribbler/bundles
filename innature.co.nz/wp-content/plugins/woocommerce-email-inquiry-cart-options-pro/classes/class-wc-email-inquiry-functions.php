<?php
/**
 * WC Email Inquiry Functions
 *
 * Table Of Contents
 *
 * plugins_loaded()
 * check_hide_add_cart_button()
 * check_hide_price()
 * check_add_email_inquiry_button()
 * check_add_email_inquiry_button_on_shoppage()
 * reset_products_to_global_settings()
 * email_inquiry()
 * get_from_address()
 * get_from_name()
 * get_content_type()
 * get_font()
 * plugin_pro_notice()
 * upgrade_version_1_0_3()
 * upgrade_version_1_0_6()
 */
class WC_Email_Inquiry_Functions 
{	
	
	/** 
	 * Set global variable when plugin loaded
	 */
	public static function plugins_loaded() {
		
		WC_Email_Inquiry_Rules_Roles_Panel::get_settings();
		
		WC_Email_Inquiry_Global_Settings::get_settings();
		WC_Email_Inquiry_Email_Options::get_settings();
		WC_Email_Inquiry_Customize_Email_Button::get_settings();
		WC_Email_Inquiry_Customize_Email_Popup::get_settings();
		WC_Email_Inquiry_3RD_ContactForms_Settings::get_settings();
		
	}
	
	public static function check_hide_add_cart_button ($product_id) {
		global $wc_email_inquiry_rules_roles_settings;
		$wc_email_inquiry_settings_custom = get_post_meta( $product_id, '_wc_email_inquiry_settings_custom', true);
			
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_hide_addcartbt'])) $wc_email_inquiry_hide_addcartbt = $wc_email_inquiry_rules_roles_settings['hide_addcartbt'] ;
		else $wc_email_inquiry_hide_addcartbt = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_hide_addcartbt']);
		
		if (!isset($wc_email_inquiry_settings_custom['role_apply_hide_cart'])) $role_apply_hide_cart = (array) $wc_email_inquiry_rules_roles_settings['role_apply_hide_cart'];
		else $role_apply_hide_cart = (array) $wc_email_inquiry_settings_custom['role_apply_hide_cart'];
		// dont hide add to cart button if setting is not checked
		if ($wc_email_inquiry_hide_addcartbt == 'no') return false;
		// alway hide add to cart button if not logged in
		if (!is_user_logged_in()) return true;
		$user_login = wp_get_current_user();
		if (is_array($user_login->roles) && count($user_login->roles) > 0) {
			$user_role = '';
			foreach ($user_login->roles as $role_name) {
				$user_role = $role_name;
				break;
			}
			// hide add to cart button if current user role in list apply role
			if ( in_array($user_role, $role_apply_hide_cart) ) return true;
		}
		return false;
		
	}
	
	public static function check_hide_price ($product_id) {
		global $wc_email_inquiry_rules_roles_settings;
		$wc_email_inquiry_settings_custom = get_post_meta( $product_id, '_wc_email_inquiry_settings_custom', true);
			
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_hide_price'])) $wc_email_inquiry_hide_price = $wc_email_inquiry_rules_roles_settings['hide_price'];
		else $wc_email_inquiry_hide_price = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_hide_price']);
		
		if (!isset($wc_email_inquiry_settings_custom['role_apply_hide_price'])) $role_apply_hide_price = (array) $wc_email_inquiry_rules_roles_settings['role_apply_hide_price'];
		else $role_apply_hide_price = (array) $wc_email_inquiry_settings_custom['role_apply_hide_price'];
			
		// dont hide add to cart button if setting is not checked
		if ($wc_email_inquiry_hide_price == 'no') return false;
		
		// alway hide add to cart button if not logged in
		if (!is_user_logged_in()) return true;
		
		$user_login = wp_get_current_user();		
		if (is_array($user_login->roles) && count($user_login->roles) > 0) {
			$user_role = '';
			foreach ($user_login->roles as $role_name) {
				$user_role = $role_name;
				break;
			}
			// hide add to cart button if current user role in list apply role
			if ( in_array($user_role, $role_apply_hide_price) ) return true;
		}
		
		return false;
	}
	
	public static function check_add_email_inquiry_button ($product_id) {
		global $wc_email_inquiry_rules_roles_settings;
		$wc_email_inquiry_settings_custom = get_post_meta( $product_id, '_wc_email_inquiry_settings_custom', true);
			
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_show_button'])) $wc_email_inquiry_show_button = $wc_email_inquiry_rules_roles_settings['show_button'];
		else $wc_email_inquiry_show_button = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_show_button']);
		
		if (!isset($wc_email_inquiry_settings_custom['role_apply_show_inquiry_button'])) $role_apply_show_inquiry_button = (array) $wc_email_inquiry_rules_roles_settings['role_apply_show_inquiry_button'];
		else $role_apply_show_inquiry_button = (array) $wc_email_inquiry_settings_custom['role_apply_show_inquiry_button'];
			
		// dont hide add to cart button if setting is not checked
		if ($wc_email_inquiry_show_button == 'no') return false;
		
		// alway hide add to cart button if not logged in
		if (!is_user_logged_in()) return true;
		
		$user_login = wp_get_current_user();		
		if (is_array($user_login->roles) && count($user_login->roles) > 0) {
			$user_role = '';
			foreach ($user_login->roles as $role_name) {
				$user_role = $role_name;
				break;
			}
			// hide add to cart button if current user role in list apply role
			if ( in_array($user_role, $role_apply_show_inquiry_button) ) return true;
		}
		
		return false;
		
	}
	
	public static function check_add_email_inquiry_button_on_shoppage ($product_id=0) {
		global $wc_email_inquiry_global_settings;
		$wc_email_inquiry_settings_custom = get_post_meta( $product_id, '_wc_email_inquiry_settings_custom', true);
			
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_single_only'])) $wc_email_inquiry_single_only = $wc_email_inquiry_global_settings['inquiry_single_only'];
		else $wc_email_inquiry_single_only = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_single_only']);
		
		if ($wc_email_inquiry_single_only == 'yes') return false;
		
		return WC_Email_Inquiry_Functions::check_add_email_inquiry_button($product_id);
		
	}
	
	public static function reset_products_to_global_settings() {
		global $wpdb;
		$wpdb->query( "DELETE FROM ".$wpdb->postmeta." WHERE meta_key='_wc_email_inquiry_settings_custom' " );
	}
	
	public static function email_inquiry($product_id, $your_name, $your_email, $your_phone, $your_message, $send_copy_yourself = 1) {
		global $wc_email_inquiry_email_options;
		global $wc_email_inquiry_contact_success;
		$wc_email_inquiry_settings_custom = get_post_meta( $product_id, '_wc_email_inquiry_settings_custom', true);
		
		if ( WC_Email_Inquiry_Functions::check_add_email_inquiry_button($product_id) ) {
			
			if ( trim( $wc_email_inquiry_contact_success ) != '') $wc_email_inquiry_contact_success = wpautop(wptexturize( $wc_email_inquiry_contact_success ));
			else $wc_email_inquiry_contact_success = __("Thanks for your inquiry - we'll be in touch with you as soon as possible!", 'wc_email_inquiry');
		
			if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_email_to']) || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_email_to'])) == '') $to_email = $wc_email_inquiry_email_options['inquiry_email_to'];
			else $to_email = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_email_to']);
			if (trim($to_email) == '') $to_email = get_option('admin_email');
			
			if ( $wc_email_inquiry_email_options['inquiry_email_from_address'] == '' )
				$from_email = get_option('admin_email');
			else
				$from_email = $wc_email_inquiry_email_options['inquiry_email_from_address'];
				
			if ( $wc_email_inquiry_email_options['inquiry_email_from_name'] == '' )
				$from_name = get_option('blogname');
			else
				$from_name = $wc_email_inquiry_email_options['inquiry_email_from_name'];
			
			if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_email_cc']) || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_email_cc'])) == '') $cc_emails = $wc_email_inquiry_email_options['inquiry_email_cc'];
			else $cc_emails = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_email_cc']);
			if (trim($cc_emails) == '') $cc_emails = '';
			
			$headers = array();
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset='. get_option('blog_charset');
			$headers[] = 'From: '.$from_name.' <'.$from_email.'>';
			$headers_yourself = $headers;
			
			if (trim($cc_emails) != '') {
				$cc_emails_a = explode("," , $cc_emails);
				if (is_array($cc_emails_a) && count($cc_emails_a) > 0) {
					foreach ($cc_emails_a as $cc_email) {
						$headers[] = 'Cc: '.$cc_email;
					}
				} else {
					$headers[] = 'Cc: '.$cc_emails;
				}
			}
			
			$product_name = get_the_title($product_id);
			$product_url = get_permalink($product_id);
			$subject = __('Email inquiry for', 'wc_email_inquiry').' '.$product_name;
			$subject_yourself = __('[Copy]: Email inquiry for', 'wc_email_inquiry').' '.$product_name;
			
			$content = '
	<table width="99%" cellspacing="0" cellpadding="1" border="0" bgcolor="#eaeaea"><tbody>
	  <tr>
		<td>
		  <table width="100%" cellspacing="0" cellpadding="5" border="0" bgcolor="#ffffff"><tbody>
			<tr bgcolor="#eaf2fa">
			  <td colspan="2"><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px"><strong>'.__('Name', 'wc_email_inquiry').'</strong></font> 
			  </td></tr>
			<tr bgcolor="#ffffff">
			  <td width="20">&nbsp;</td>
			  <td><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px">[your_name]</font> </td></tr>
			<tr bgcolor="#eaf2fa">
			  <td colspan="2"><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px"><strong>'.__('Email Address', 'wc_email_inquiry').'</strong></font> </td></tr>
			<tr bgcolor="#ffffff">
			  <td width="20">&nbsp;</td>
			  <td><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px"><a target="_blank" href="mailto:[your_email]">[your_email]</a></font> 
			  </td></tr>
			<tr bgcolor="#eaf2fa">
			  <td colspan="2"><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px"><strong>'.__('Phone', 'wc_email_inquiry').'</strong></font> </td></tr>
			<tr bgcolor="#ffffff">
			  <td width="20">&nbsp;</td>
			  <td><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px">[your_phone]</font> </td></tr>
			<tr bgcolor="#eaf2fa">
			  <td colspan="2"><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px"><strong>'.__('Product Name', 'wc_email_inquiry').'</strong></font> </td></tr>
			<tr bgcolor="#ffffff">
			  <td width="20">&nbsp;</td>
			  <td><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px"><a target="_blank" href="[product_url]">[product_name]</a></font> </td></tr>
			<tr bgcolor="#eaf2fa">
			  <td colspan="2"><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px"><strong>'.__('Message', 'wc_email_inquiry').'</strong></font> </td></tr>
			<tr bgcolor="#ffffff">
			  <td width="20">&nbsp;</td>
			  <td><font style="FONT-FAMILY:sans-serif;FONT-SIZE:12px">[your_message]</font> 
		  </td></tr></tbody></table></td></tr></tbody></table>';
		  
			$content = str_replace('[your_name]', $your_name, $content);
			$content = str_replace('[your_email]', $your_email, $content);
			$content = str_replace('[your_phone]', $your_phone, $content);
			$content = str_replace('[product_name]', $product_name, $content);
			$content = str_replace('[product_url]', $product_url, $content);
			$content = str_replace('[your_message]', wpautop($your_message), $content);
			
			$content = apply_filters('wc_email_inquiry_inquiry_content', $content);
			
			// Filters for the email
			add_filter( 'wp_mail_from', array( 'WC_Email_Inquiry_Functions', 'get_from_address' ) );
			add_filter( 'wp_mail_from_name', array( 'WC_Email_Inquiry_Functions', 'get_from_name' ) );
			add_filter( 'wp_mail_content_type', array( 'WC_Email_Inquiry_Functions', 'get_content_type' ) );
			
			wp_mail( $to_email, $subject, $content, $headers, '' );
			
			if ($send_copy_yourself == 1) {
				wp_mail( $your_email, $subject_yourself, $content, $headers_yourself, '' );
			}
			
			// Unhook filters
			remove_filter( 'wp_mail_from', array( 'WC_Email_Inquiry_Functions', 'get_from_address' ) );
			remove_filter( 'wp_mail_from_name', array( 'WC_Email_Inquiry_Functions', 'get_from_name' ) );
			remove_filter( 'wp_mail_content_type', array( 'WC_Email_Inquiry_Functions', 'get_content_type' ) );
			
			return $wc_email_inquiry_contact_success;
		} else {
			return __("Sorry, this product don't enable email inquiry.", 'wc_email_inquiry');
		}
	}
	
	public static function get_from_address() {
		global $wc_email_inquiry_email_options;
		if ( $wc_email_inquiry_email_options['inquiry_email_from_address'] == '' )
			$from_email = get_option('admin_email');
		else
			$from_email = $wc_email_inquiry_email_options['inquiry_email_from_address'];
			
		return $from_email;
	}
	
	public static function get_from_name() {
		global $wc_email_inquiry_email_options;
		if ( $wc_email_inquiry_email_options['inquiry_email_from_name'] == '' )
			$from_name = get_option('blogname');
		else
			$from_name = $wc_email_inquiry_email_options['inquiry_email_from_name'];
			
		return $from_name;
	}
	
	public static function get_content_type() {
		return 'text/html';
	}
	
	public static function get_font() {
		$fonts = array( 
			'Arial, sans-serif'													=> __( 'Arial', 'wc_email_inquiry' ),
			'Verdana, Geneva, sans-serif'										=> __( 'Verdana', 'wc_email_inquiry' ),
			'Trebuchet MS, Tahoma, sans-serif'								=> __( 'Trebuchet', 'wc_email_inquiry' ),
			'Georgia, serif'													=> __( 'Georgia', 'wc_email_inquiry' ),
			'Times New Roman, serif'											=> __( 'Times New Roman', 'wc_email_inquiry' ),
			'Tahoma, Geneva, Verdana, sans-serif'								=> __( 'Tahoma', 'wc_email_inquiry' ),
			'Palatino, Palatino Linotype, serif'								=> __( 'Palatino', 'wc_email_inquiry' ),
			'Helvetica Neue, Helvetica, sans-serif'							=> __( 'Helvetica*', 'wc_email_inquiry' ),
			'Calibri, Candara, Segoe, Optima, sans-serif'						=> __( 'Calibri*', 'wc_email_inquiry' ),
			'Myriad Pro, Myriad, sans-serif'									=> __( 'Myriad Pro*', 'wc_email_inquiry' ),
			'Lucida Grande, Lucida Sans Unicode, Lucida Sans, sans-serif'	=> __( 'Lucida', 'wc_email_inquiry' ),
			'Arial Black, sans-serif'											=> __( 'Arial Black', 'wc_email_inquiry' ),
			'Gill Sans, Gill Sans MT, Calibri, sans-serif'					=> __( 'Gill Sans*', 'wc_email_inquiry' ),
			'Geneva, Tahoma, Verdana, sans-serif'								=> __( 'Geneva*', 'wc_email_inquiry' ),
			'Impact, Charcoal, sans-serif'										=> __( 'Impact', 'wc_email_inquiry' ),
			'Courier, Courier New, monospace'									=> __( 'Courier', 'wc_email_inquiry' ),
			'Century Gothic, sans-serif'										=> __( 'Century Gothic', 'wc_email_inquiry' ),
		);
		
		return apply_filters('wc_compare_fonts_support', $fonts );
	}
	
	public static function get_product_information( $product_id, $show_product_name = 0, $width = 220, $height = 180, $class_image = '' ) {
		$image_src = WC_Email_Inquiry_Functions::get_post_thumbnail( $product_id, $width, $height, $class_image );
		if ( trim($image_src) == '' ) {
			$image_src = '<img alt="" src="'.woocommerce_placeholder_img_src().'" class="'.$class_image.'" style="max-width:'.$width.'px !important; max-height:'.$height.'px !important;" />';
		}
		
		$product_information = '';
		ob_start();
	?>
    	<?php if ($show_product_name == 1) { ?>
        <div style="clear:both; margin-top:10px"></div>
		<div style="float:left; margin-right:10px;"><?php echo $image_src; ?></div>
        <div style="display:block; margin-bottom:10px; padding-left:<?php echo ( $width + 10); ?>px">
        	<h1 class="wc_email_inquiry_custom_form_product_heading"><?php echo esc_html( get_the_title($product_id) ); ?></h1>
			<div class="wc_email_inquiry_custom_form_product_url_div"><a class="wc_email_inquiry_custom_form_product_url" href="<?php echo esc_url( get_permalink($product_id) ); ?>" title=""><?php echo esc_url( get_permalink($product_id) ); ?></a></div>
        </div>
        <div style="clear:both;"></div>
        <?php } else { ?>
        <?php echo $image_src; ?>
        <?php } ?>
	<?php
		$product_information = ob_get_clean();
		
		return $product_information;
	}
	
	public static function get_post_thumbnail( $postid=0, $width=220, $height=180, $class='') {
		$mediumSRC = '';
		// Get the product ID if none was passed
		if ( empty( $postid ) )
			$postid = get_the_ID();

		// Load the product
		$product = get_post( $postid );

		if (has_post_thumbnail($postid)) {
			$thumbid = get_post_thumbnail_id($postid);
			$attachmentArray = wp_get_attachment_image_src($thumbid, array(0 => $width, 1 => $height), false);
			$mediumSRC = $attachmentArray[0];
			if (trim($mediumSRC != '')) {
				return '<img class="'.$class.'" src="'.$mediumSRC.'" style="max-width:'.$width.'px !important; max-height:'.$height.'px !important;" />';
			}
		}
		if (trim($mediumSRC == '')) {
			$args = array( 'post_parent' => $postid , 'numberposts' => 1, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'DESC', 'orderby' => 'ID', 'post_status' => null);
			$attachments = get_posts($args);
			if ($attachments) {
				foreach ( $attachments as $attachment ) {
					$mediumSRC = wp_get_attachment_image( $attachment->ID, array(0 => $width, 1 => $height), true, array('class' => $class, 'style' => 'max-width:'.$width.'px !important; max-height:'.$height.'px !important;' ) );
					break;
				}
			}
		}

		if (trim($mediumSRC == '')) {
			// Get ID of parent product if one exists
			if ( !empty( $product->post_parent ) )
				$postid = $product->post_parent;

			if (has_post_thumbnail($postid)) {
				$thumbid = get_post_thumbnail_id($postid);
				$attachmentArray = wp_get_attachment_image_src($thumbid, array(0 => $width, 1 => $height), false);
				$mediumSRC = $attachmentArray[0];
				if (trim($mediumSRC != '')) {
					return '<img class="'.$class.'" src="'.$mediumSRC.'" style="max-width:'.$width.'px !important; max-height:'.$height.'px !important;" />';
				}
			}
			if (trim($mediumSRC == '')) {
				$args = array( 'post_parent' => $postid , 'numberposts' => 1, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'DESC', 'orderby' => 'ID', 'post_status' => null);
				$attachments = get_posts($args);
				if ($attachments) {
					foreach ( $attachments as $attachment ) {
						$mediumSRC = wp_get_attachment_image( $attachment->ID, array(0 => $width, 1 => $height), true, array('class' => $class, 'style' => 'max-width:'.$width.'px !important; max-height:'.$height.'px !important;' ) );
						break;
					}
				}
			}
		}
		return $mediumSRC;
	}
	
	public static function plugin_pro_notice() {
		$html = '';
		$html .= '<div id="wc_email_inquiry_extensions">';
		$html .= '<a href="http://a3rev.com/shop/" target="_blank" style="float:right;margin-top:5px; margin-left:10px;" ><img src="'.WC_EMAIL_INQUIRY_IMAGES_URL.'/a3logo.png" /></a>';
		$html .= '<h3>'.__('Thanks for purchasing a WooCommerce Email Inquiry and cart Options Pro License.', 'wc_email_inquiry').'</h3>';
		$html .= '<p>'.__("All of the plugins features have been activated and are ready for you to use.", 'wc_email_inquiry').'</p>';
		$html .= '<h3>'.__('Documentation', 'wc_email_inquiry').':</h3>';
		$html .= '<p>'.__('View the', 'wc_email_inquiry').' <a href="http://docs.a3rev.com/user-guides/plugins-extensions/woocommerce/woo-email-inquiry-cart-options/" target="_blank">'.__('plugins docs', 'wc_email_inquiry').'</a> ' . __('for help with plugin set up.', 'wc_email_inquiry') . '</p>';
		$html .= '<h3>'.__('Support', 'wc_email_inquiry').':</h3>';
		$html .= '<p>'.__('Post all support requests to the plugins', 'wc_email_inquiry').' <a href="https://a3rev.com/forums/forum/woocommerce-plugins/email-inquiry-cart-options/" target="_blank">'.__('support forum', 'wc_email_inquiry').'</a>.</p>';
		$html .= '<h3>'.__('Whats this Yellow Section about?', 'wc_email_inquiry').'</h3>';
		$html .= '<p>'.__('There are 2 additional upgrades to this plugin. All the functions inside the Yellow border are the extra functionality added by these to upgrades.', 'wc_email_inquiry').'</p>';
		$html .= '<h3>* <a href="http://a3rev.com/shop/woocommerce-email-inquiry-ultimate/" target="_blank">'.__('WooCommerce Email Inquiry Ultimate', 'wc_email_inquiry').'</a> '.__('Features', 'wc_email_inquiry').':</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>1. '.__("Includes all Email Inquiry and Cart Option Pro features.", 'wc_email_inquiry').'</li>';
		$html .= '<li>2. '.__('Full integration with Gravity Forms, Conatct Form 7.', 'wc_email_inquiry').'</li>';
		$html .= '<li>3. '.__("Custom Inquiry forms with Gravity Forms shortcode.", 'wc_email_inquiry').'</li>';
		$html .= '<li>4. '.__('Custom Inquiry forms using Contact Form 7 shortcode.', 'wc_email_inquiry').'</li>';
		$html .= '<li>5. '.__('Inquiry form opens On Page below button.', 'wc_email_inquiry').'</li>';
		$html .= '<li>6. '.__('Open Email Inquiry form on new page option.', 'wc_email_inquiry').'</li>';
		$html .= '</ul>';
		$html .= '</p>';
		$html .= '<h3>* <a href="http://a3rev.com/shop/woocommerce-quotes-and-orders/" target="_blank">'.__('WooCommerce Quotes and Orders', 'wc_email_inquiry').'</a> '.__('Features', 'wc_email_inquiry').':</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>1. '.__("Includes all features listed above.", 'wc_email_inquiry').'</li>';
		$html .= '<li>2. '.__('Extends WooCommerce add to cart mode to 3 new modes.', 'wc_email_inquiry').'</li>';
		$html .= '<li>3. '.__("Converts add to cart function into an add to Quote function.", 'wc_email_inquiry').'</li>';
		$html .= '<li>4. '.__("Manual' Quote Mode - quote prices off-line after request.", 'wc_email_inquiry').'</li>';
		$html .= '<li>5. '.__('Auto Quote Mode - Auto sends full quote to user.', 'wc_email_inquiry').'</li>';
		$html .= '<li>6. '.__('Converts add to cart function into add to Order function.', 'wc_email_inquiry').'</li>';
		$html .= '<li>7. '.__('Full integration with WooCommerce.', 'wc_email_inquiry').'</li>';
		$html .= '</ul>';
		$html .= '</p>';
		
		$html .= '<h3>'.__('7 Day FREE Trial', 'wc_email_inquiry').'</h3>';
		$html .= '<p>'.__('Try either of the upgrade plugins obigation free for 7 days. If the plugin does not meet your needs you can cancel the trail right from your', 'wc_email_inquiry').' <a href="http://a3rev.com/my-account/" target="_blank">'.__('a3rev dashboard', 'wc_email_inquiry').'</a> '.__("and you won't be charge the annual license subscription fee.", 'wc_email_inquiry').'</p>';
		
		$html .= '<h3>'.__('Money back Upgrade Offer', 'wc_email_inquiry').'</h3>';
		$html .= '<p>'.__("If you upgrade to the WooCommerce Email Inquiry Ultimate or WooCommerce Quotes and Orders annual subscription license within 60 days of purchasing this plugin we will automatically send you a 100% refund for the WooCommerce Email Inquiry and Cart options Pro License you have purchased.", 'wc_email_inquiry').'</p>';
		
		$html .= '<h3>'.__('If you do upgrade ...', 'wc_email_inquiry').'</h3>';
		$html .= '<p>'.__("Please note if you upgrade and are installing it on this site you must deactivate this plugin before you activate the upgrade plugin.", 'wc_email_inquiry').'</p>';
		
		$html .= '<p>&nbsp;</p><p>'.__("Thank you and all the best.", 'wc_email_inquiry').'<br />';
		$html .= __("Steve and the team @ a3rev.", 'wc_email_inquiry').'</p>';
		
		$html .= '</div>';
		return $html;
	}
	
	public static function upgrade_version_1_0_3() {
		global $wpdb, $wp_roles;
		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new WP_Roles();
		}
		$roles = $wp_roles->get_names();
		$wc_email_inquiry_user = esc_attr(get_option('wc_email_inquiry_user'));
		if ($wc_email_inquiry_user == 'yes') {
			update_option('wc_email_inquiry_role_apply_hide_cart', (array) array_keys($roles));
			update_option('wc_email_inquiry_role_apply_hide_price', (array) array_keys($roles));
			update_option('wc_email_inquiry_role_apply_show_inquiry_button', (array) array_keys($roles));
		}
		
		$products_email_inquiry_settings_custom = $wpdb->get_results( "SELECT * FROM ".$wpdb->postmeta." WHERE meta_key='_wc_email_inquiry_settings_custom' AND meta_value != '' " );
		if (is_array($products_email_inquiry_settings_custom) && count($products_email_inquiry_settings_custom) > 0) {
			foreach ($products_email_inquiry_settings_custom as $product_meta) {
				$wc_email_inquiry_settings_custom = unserialize($product_meta->meta_value);
				if (isset($wc_email_inquiry_settings_custom['wc_email_inquiry_user'])) {
					if ($wc_email_inquiry_settings_custom['wc_email_inquiry_user'] == 'yes') {
						$wc_email_inquiry_settings_custom['role_apply_hide_cart'] = (array) array_keys($roles);
						$wc_email_inquiry_settings_custom['role_apply_hide_price'] = (array) array_keys($roles);
						$wc_email_inquiry_settings_custom['role_apply_show_inquiry_button'] = (array) array_keys($roles);
					} else {
						$wc_email_inquiry_settings_custom['role_apply_hide_cart'] = array();
						$wc_email_inquiry_settings_custom['role_apply_hide_price'] = array();
						$wc_email_inquiry_settings_custom['role_apply_show_inquiry_button'] = array();
					}
					
					if ($wc_email_inquiry_settings_custom['wc_email_inquiry_hide_addcartbt'] == 'yes') {
						$wc_email_inquiry_settings_custom['wc_email_inquiry_hide_price'] = 'yes';
					} else {
						$wc_email_inquiry_settings_custom['wc_email_inquiry_hide_price'] = 'no';
					}
					update_post_meta($product_meta->post_id, '_wc_email_inquiry_settings_custom', (array) $wc_email_inquiry_settings_custom);
				}
			}
		}
	}
	
	public static function upgrade_version_1_0_6() {
		global $wc_email_inquiry_rules_roles_settings;
		$wc_email_inquiry_rules_roles_settings = WC_Email_Inquiry_Rules_Roles_Panel::get_settings();
		$old_rules_roles_settings = array(
			'hide_addcartbt'						=> ( get_option('wc_email_inquiry_hide_addcartbt') === false || get_option('wc_email_inquiry_hide_addcartbt') == '' ) ? $wc_email_inquiry_rules_roles_settings['hide_addcartbt'] : get_option('wc_email_inquiry_hide_addcartbt') ,
			'role_apply_hide_cart'					=> (array) get_option('wc_email_inquiry_role_apply_hide_cart'),
			'show_button'							=> ( get_option('wc_email_inquiry_show_button') === false || get_option('wc_email_inquiry_show_button') == '' ) ? $wc_email_inquiry_rules_roles_settings['show_button'] : get_option('wc_email_inquiry_show_button') ,
			'role_apply_show_inquiry_button'		=> (array) get_option('wc_email_inquiry_role_apply_show_inquiry_button'),
			'hide_price'							=> ( get_option('wc_email_inquiry_hide_price') === false || get_option('wc_email_inquiry_hide_price') == '' ) ? $wc_email_inquiry_rules_roles_settings['hide_price'] : get_option('wc_email_inquiry_hide_price') ,
			'role_apply_hide_price'					=> (array) get_option('wc_email_inquiry_role_apply_hide_price'),
		);
		$wc_email_inquiry_rules_roles_settings = array_merge($wc_email_inquiry_rules_roles_settings, $old_rules_roles_settings);
		update_option( 'wc_email_inquiry_rules_roles_settings', $wc_email_inquiry_rules_roles_settings);
		
		$wc_email_inquiry_global_settings = WC_Email_Inquiry_Global_Settings::get_settings();
		$old_email_inquiry_global_settings =  array(
			'inquiry_button_type'					=> ( get_option('wc_email_inquiry_button_type') == '' ) ? $wc_email_inquiry_global_settings['inquiry_button_type'] : get_option('wc_email_inquiry_button_type') ,
			'inquiry_button_position'				=> ( get_option('wc_email_inquiry_button_position') == '' ) ? $wc_email_inquiry_global_settings['inquiry_button_position'] : get_option('wc_email_inquiry_button_position') ,
			'inquiry_button_padding'				=> get_option('wc_email_inquiry_button_padding'),
			'inquiry_single_only'					=> ( get_option('wc_email_inquiry_single_only') == '' ) ? $wc_email_inquiry_global_settings['inquiry_single_only'] : get_option('wc_email_inquiry_single_only') ,
		);
		$wc_email_inquiry_global_settings = array_merge($wc_email_inquiry_global_settings, $old_email_inquiry_global_settings);
		update_option( 'wc_email_inquiry_global_settings', $wc_email_inquiry_global_settings);
		
		$wc_email_inquiry_email_options = WC_Email_Inquiry_Email_Options::get_settings();
		$old_email_inquiry_email_options =  array(
			'inquiry_email_from_name'				=> get_option('wc_email_inquiry_email_from_name'),
			'inquiry_email_from_address'			=> get_option('wc_email_inquiry_email_from_address'),
			'inquiry_send_copy'						=> get_option('wc_email_inquiry_send_copy'),
			'inquiry_email_to'						=> get_option('wc_email_inquiry_email_to'),
			'inquiry_email_cc'						=> get_option('wc_email_inquiry_email_cc'),
		);
		$wc_email_inquiry_email_options = array_merge($wc_email_inquiry_email_options, $old_email_inquiry_email_options);
		update_option( 'wc_email_inquiry_email_options', $wc_email_inquiry_email_options);
		
		$wc_email_inquiry_customize_email_button = WC_Email_Inquiry_Customize_Email_Button::get_settings();
		$old_email_inquiry_customize_email_button =  array(
			'inquiry_text_before'					=> get_option('wc_email_inquiry_text_before'),
			'inquiry_hyperlink_text'				=> get_option('wc_email_inquiry_hyperlink_text'),
			'inquiry_trailing_text'					=> get_option('wc_email_inquiry_trailing_text'),
			
			'inquiry_button_title'					=> get_option('wc_email_inquiry_button_title'),
			'inquiry_button_bg_colour'				=> get_option('wc_email_inquiry_button_bg_colour'),
			'inquiry_button_bg_colour_from'			=> get_option('wc_email_inquiry_button_bg_colour'),
			'inquiry_button_bg_colour_to'			=> get_option('wc_email_inquiry_button_bg_colour'),
			'inquiry_button_border_colour'			=> get_option('wc_email_inquiry_button_border_colour'),
			'inquiry_button_rounded_corner'			=> ( get_option('wc_email_inquiry_border_rounded') == '' ) ? $wc_email_inquiry_customize_email_button['inquiry_button_rounded_corner'] : get_option('wc_email_inquiry_border_rounded') ,
			'inquiry_button_rounded_value'			=> get_option('wc_email_inquiry_rounded_value'),
			
			'inquiry_button_font_size'				=> get_option('wc_email_inquiry_button_text_size'),
			'inquiry_button_font_style'				=> get_option('wc_email_inquiry_button_text_style'),
			'inquiry_button_font_colour'			=> get_option('wc_email_inquiry_button_text_colour'),
			'inquiry_button_class'					=> get_option('wc_email_inquiry_button_class'),
		);
		$wc_email_inquiry_customize_email_button = array_merge($wc_email_inquiry_customize_email_button, $old_email_inquiry_customize_email_button);
		update_option( 'wc_email_inquiry_customize_email_button', $wc_email_inquiry_customize_email_button);
		
		$wc_email_inquiry_customize_email_popup = WC_Email_Inquiry_Customize_Email_Popup::get_settings();
		$old_email_inquiry_customize_email_popup =  array(
			'inquiry_popup_type'					=> get_option('wc_email_inquiry_popup_type'),
			'inquiry_contact_heading'				=> get_option('wc_email_inquiry_contact_heading'),
			
			'inquiry_contact_text_button'			=> get_option('wc_email_inquiry_contact_text_button'),
			'inquiry_contact_button_bg_colour'		=> get_option('wc_email_inquiry_contact_button_bg_colour'),
			'inquiry_contact_button_bg_colour_from'	=> get_option('wc_email_inquiry_contact_button_bg_colour'),
			'inquiry_contact_button_bg_colour_to'	=> get_option('wc_email_inquiry_contact_button_bg_colour'),
			'inquiry_contact_button_border_colour'	=> get_option('wc_email_inquiry_contact_button_border_colour'),
			'inquiry_contact_button_rounded_corner'	=> ( get_option('wc_email_inquiry_contact_border_rounded') == '' ) ? $wc_email_inquiry_customize_email_popup['inquiry_contact_button_rounded_corner'] : get_option('wc_email_inquiry_contact_border_rounded') ,
			'inquiry_contact_button_rounded_value'	=> get_option('wc_email_inquiry_contact_rounded_value'),
			
			'inquiry_contact_button_font_size'		=> get_option('wc_email_inquiry_contact_button_text_size'),
			'inquiry_contact_button_font_style'		=> get_option('wc_email_inquiry_contact_button_text_style'),
			'inquiry_contact_button_font_colour'	=> get_option('wc_email_inquiry_contact_button_text_colour'),
			'inquiry_contact_button_class'			=> get_option('wc_email_inquiry_contact_button_class'),
			
			'inquiry_contact_form_class'			=> get_option('wc_email_inquiry_contact_form_class'),
		);
		$wc_email_inquiry_customize_email_popup = array_merge($wc_email_inquiry_customize_email_popup, $old_email_inquiry_customize_email_popup);
		update_option( 'wc_email_inquiry_customize_email_popup', $wc_email_inquiry_customize_email_popup);
	}
}
?>
