<?php
/**
 * WC Email Inquiry Hook Filter
 *
 * Table Of Contents
 *
 * shop_before_hide_add_to_cart_button()
 * shop_after_hide_add_to_cart_button()
 * details_before_hide_add_to_cart_button()
 * details_after_hide_add_to_cart_button()
 * global_hide_price()
 * hide_price_from_mini_cart()
 * remove_x_character_mini_cart()
 * shop_before_hide_price()
 * shop_after_hide_price()
 * add_email_inquiry_button()
 * shop_add_email_inquiry_button_above()
 * shop_add_email_inquiry_button_below()
 * details_add_email_inquiry_button_above()
 * details_add_email_inquiry_button_below()
 * wc_email_inquiry_popup()
 * wc_email_inquiry_action()
 * add_style_header()
 * footer_print_scripts()
 * script_contact_popup()
 * a3_wp_admin()
 * admin_sidebar_menu_css()
 * plugin_extra_links()
 */
class WC_Email_Inquiry_Hook_Filter
{
		
	public static function shop_before_hide_add_to_cart_button($template_name, $template_path, $located, $args ) {
		global $post;
		global $product;
		if ($template_name == 'loop/add-to-cart.php') {
			$product_id = $product->id;
			
			if (WC_Email_Inquiry_Functions::check_hide_add_cart_button($product_id))
				ob_start();
		}
	}
	
	public static function shop_after_hide_add_to_cart_button($template_name, $template_path, $located, $args ) {
		global $post;
		global $product;
		if ($template_name == 'loop/add-to-cart.php') {
			$product_id = $product->id;
			
			if (WC_Email_Inquiry_Functions::check_hide_add_cart_button($product_id))
				ob_end_clean();
		}
	}
	
	public static function details_before_hide_add_to_cart_button() {
		global $post, $product;
		$product_id = $product->id;
		
		if (WC_Email_Inquiry_Functions::check_hide_add_cart_button($product_id) ) {
			ob_start();
		}
	}
	
	public static function details_after_hide_add_to_cart_button() {
		global $post, $product;
		$product_id = $product->id;
		
		if (WC_Email_Inquiry_Functions::check_hide_add_cart_button($product_id)){
			ob_end_clean();
			
			if ($product->is_type('variable')) {
				?>
					<div class="single_variation_wrap" style="display:none;">
						<div class="single_variation"></div>
						<div class="variations_button"><input type="hidden" name="variation_id" value="" /></div>
					</div>
					<div><input type="hidden" name="product_id" value="<?php echo $post->ID; ?>" /></div>
				<?php
			}
		}
	}
	
	public static function grouped_product_hide_add_to_cart_style() {
		global $product;
		$product_id = $product->id;
		
		if ( $product->product_type == 'grouped' && WC_Email_Inquiry_Functions::check_hide_add_cart_button( $product_id ) ){
			echo '<style>body table.group_table a.button, body table.group_table a.single_add_to_cart_button, body table.group_table .quantity, table.group_table a.button, table.group_table a.single_add_to_cart_button, table.group_table .quantity { display:none !important; } </style>';
		}
	}
	
	public static function grouped_product_hide_add_to_cart( $add_to_cart='', $product_type ) {
		global $product;
		$product_id = $product->id;
		
		if ( WC_Email_Inquiry_Functions::check_hide_add_cart_button( $product_id ) ){
			$add_to_cart = '';
		}
		
		return $add_to_cart;
	}
	
	public static function before_grouped_product_hide_quatity_control( $template_name, $template_path, $located, $args ) {
		global $product;
		if ( $template_name == 'single-product/add-to-cart/quantity.php' ) {
			$product_id = $product->id;
			
			if ( WC_Email_Inquiry_Functions::check_hide_add_cart_button( $product_id ) ) {
				ob_start();
			}
		}
	}
	
	public static function after_grouped_product_hide_quatity_control( $template_name, $template_path, $located, $args ) {
		global $product;
		if ( $template_name == 'single-product/add-to-cart/quantity.php' ) {
			$product_id = $product->id;
			
			if ( WC_Email_Inquiry_Functions::check_hide_add_cart_button( $product_id ) ) {
				ob_end_clean();
			}
		}
	}
	
	public static function global_hide_price($price, $object) {
		$product_id = $object->id;
		if ( ( in_array( basename ($_SERVER['PHP_SELF']), array('admin-ajax.php') ) || !is_admin() ) && WC_Email_Inquiry_Functions::check_hide_price($product_id)) return '';
		
		return $price;
	}
	
	public static function hide_price_from_mini_cart($price, $cart_item, $cart_item_key) {
		$_product = $cart_item['data'];
		$product_id = $_product->id;
		if (WC_Email_Inquiry_Functions::check_hide_price($product_id)) return '';
		
		return $price;
	}
	
	public static function remove_x_character_mini_cart($text_quantity='', $cart_item, $cart_item_key) {
		$_product = $cart_item['data'];
		$product_id = $_product->id;
		if (WC_Email_Inquiry_Functions::check_hide_price($product_id)) $text_quantity = str_replace('&times;', '', $text_quantity);
		
		return $text_quantity;
	}
	
	public static function hide_cart_product_subtotal( $product_subtotal, $_product, $quantity, $cart ) {
		$product_id = $_product->id;
		if ( WC_Email_Inquiry_Functions::check_hide_price( $product_id ) ) return '';
		
		return $product_subtotal;
	}
	
	public static function shop_before_hide_price($template_name, $template_path, $located, $args) {
		global $post;
		global $product;
		if ($template_name == 'loop/price.php' || $template_name == 'single-product/price.php') {
			$product_id = $product->id;
			
			if (WC_Email_Inquiry_Functions::check_hide_price($product_id))
				ob_start();
		}
	}
	
	public static function shop_after_hide_price($template_name, $template_path, $located, $args) {
		global $post;
		global $product;
		if ($template_name == 'loop/price.php' || $template_name == 'single-product/price.php') {
			$product_id = $product->id;
			
			if (WC_Email_Inquiry_Functions::check_hide_price($product_id))
				ob_end_clean();
		}
	}
	
	public static function add_email_inquiry_button($product_id, $page_type= 'single') {
		global $post;
		global $wc_email_inquiry_contact_form_settings;
		global $wc_email_inquiry_customize_email_button;
		//echo "<pre>"; var_dump($wc_email_inquiry_customize_email_button); echo "</pre>";
		$expand_text = '';
		$inner_form = '';
		$email_inquiry_button_class = 'wc_email_inquiry_button wc_email_inquiry_button_closed';
		if ( $page_type == 'single' && $wc_email_inquiry_contact_form_settings['defaul_product_page_open_form_type'] == 'inner_page' ) {
			$expand_text = ' <span id="wc_email_inquiry_expand_text_'.$product_id.'" class="wc_email_inquiry_expand_text"> '.__('+', 'wc_email_inquiry').' </span>';
			$inner_form = '<div id="wc_defaul_inquiry_form_inner_container_'.$product_id.'" class="wc_defaul_inquiry_form_inner_container" style="display:none;">'.WC_Email_Inquiry_Hook_Filter::show_default_inquiry_form($product_id, 0, 'inner_page').'</div>';
		} else {
			$email_inquiry_button_class = 'wc_email_inquiry_popup_button';
		}
			
		$wc_email_inquiry_settings_custom = get_post_meta( $product_id, '_wc_email_inquiry_settings_custom', true);
		
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_button_type'])) $wc_email_inquiry_button_type = $wc_email_inquiry_customize_email_button['inquiry_button_type'];
		else $wc_email_inquiry_button_type = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_button_type']);
		
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_text_before'])  || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_text_before'])) == '') $wc_email_inquiry_text_before = $wc_email_inquiry_customize_email_button['inquiry_text_before'];
		else $wc_email_inquiry_text_before = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_text_before']);
		
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_hyperlink_text'])  || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_hyperlink_text'])) == '') $wc_email_inquiry_hyperlink_text = $wc_email_inquiry_customize_email_button['inquiry_hyperlink_text'];
		else $wc_email_inquiry_hyperlink_text = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_hyperlink_text']);
		if (trim($wc_email_inquiry_hyperlink_text) == '') $wc_email_inquiry_hyperlink_text = __('Click Here', 'wc_email_inquiry');
		
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_trailing_text'])  || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_trailing_text'])) == '') $wc_email_inquiry_trailing_text = $wc_email_inquiry_customize_email_button['inquiry_trailing_text'];
		else $wc_email_inquiry_trailing_text = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_trailing_text']);
		
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_button_title'])  || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_button_title'])) == '') $wc_email_inquiry_button_title = $wc_email_inquiry_customize_email_button['inquiry_button_title'];
		else $wc_email_inquiry_button_title = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_button_title']);
		if (trim($wc_email_inquiry_button_title) == '') $wc_email_inquiry_button_title = __('Product Enquiry', 'wc_email_inquiry');
		//var_dump($wc_email_inquiry_button_title);
		$wc_email_inquiry_button_position = $wc_email_inquiry_customize_email_button['inquiry_button_position'];
		
		$wc_email_inquiry_button_class = '';
		if ( trim( $wc_email_inquiry_customize_email_button['inquiry_button_class'] ) != '') $wc_email_inquiry_button_class = $wc_email_inquiry_customize_email_button['inquiry_button_class'];
		
		$button_link = '';
		if (trim($wc_email_inquiry_text_before) != '') $button_link .= '<span class="wc_email_inquiry_text_before wc_email_inquiry_text_before_'.$product_id.'">'.trim($wc_email_inquiry_text_before).'</span> ';
		$button_link .= '<a class="wc_email_inquiry_hyperlink_text wc_email_inquiry_hyperlink_text_'.$product_id.' '.$email_inquiry_button_class.'" id="wc_email_inquiry_button_'.$product_id.'" product_name="'.addslashes( strip_tags( $post->post_title ) ).'" product_id="'.$product_id.'" form_action="hide">'.$wc_email_inquiry_hyperlink_text.$expand_text.'</a>';
		if (trim($wc_email_inquiry_trailing_text) != '') $button_link .= ' <span class="wc_email_inquiry_trailing_text wc_email_inquiry_trailing_text_'.$product_id.'">'.trim($wc_email_inquiry_trailing_text).'</span>';
		//daniel's code::
		$my_title = $wc_email_inquiry_customize_email_button['inquiry_button_title'];

		$button_button = '<a class="wc_email_inquiry_email_button wc_email_inquiry_button_'.$product_id.' '.$email_inquiry_button_class.' '.$wc_email_inquiry_button_class.'" id="wc_email_inquiry_button_'.$product_id.'" product_name="'.addslashes( strip_tags( get_the_title($product_id) ) ).'" product_id="'.$product_id.'" form_action="hide">'.$my_title.$expand_text.'</a>';

			add_action('wp_footer', array('WC_Email_Inquiry_Hook_Filter', 'footer_print_scripts') );
			$button_ouput = '<span class="wc_email_inquiry_button_container">';
			if ($wc_email_inquiry_button_type == 'link') $button_ouput .= $button_link;
			else $button_ouput .= $button_button;
			
			$button_ouput .= '</span>';
			
		return $button_ouput . $inner_form;
	}
	
	public static function shop_add_email_inquiry_button_above($template_name, $template_path, $located, $args) {
		global $post;
		global $product;
		if ($template_name == 'loop/add-to-cart.php') {
			$product_id = $product->id;
			
			if ( ($post->post_type == 'product' || $post->post_type == 'product_variation') && WC_Email_Inquiry_Functions::check_add_email_inquiry_button_on_shoppage($product_id) ) {
				echo WC_Email_Inquiry_Hook_Filter::add_email_inquiry_button($product_id, 'shop');
			}
		}
	}
	
	public static function shop_add_email_inquiry_button_below() {
		global $post;
		global $product;
		global $wc_email_inquiry_customize_email_button_settings;
		$product_id = $product->id;
		
		if ( $wc_email_inquiry_customize_email_button_settings['inquiry_button_position'] == 'above' ) return;
		 
		if ( ($post->post_type == 'product' || $post->post_type == 'product_variation') && WC_Email_Inquiry_Functions::check_add_email_inquiry_button_on_shoppage($product_id) ) {
			echo WC_Email_Inquiry_Hook_Filter::add_email_inquiry_button($product_id, 'shop');
		}
	}
	
	public static function details_add_email_inquiry_button_above($template_name, $template_path, $located, $args) {
		global $post;
		global $product;
		if (in_array($template_name, array('single-product/add-to-cart/simple.php', 'single-product/add-to-cart/grouped.php', 'single-product/add-to-cart/external.php', 'single-product/add-to-cart/variable.php'))) {
			$product_id = $product->id;
			
			if (($post->post_type == 'product' || $post->post_type == 'product_variation') && WC_Email_Inquiry_Functions::check_add_email_inquiry_button($product_id) ) {
				echo WC_Email_Inquiry_Hook_Filter::add_email_inquiry_button($product_id, 'single');
			}
		}
	}
	
	public static function details_add_email_inquiry_button_below($template_name, $template_path, $located, $args){
		global $post;
		global $product;
		if (in_array($template_name, array('single-product/add-to-cart/simple.php', 'single-product/add-to-cart/grouped.php', 'single-product/add-to-cart/external.php', 'single-product/add-to-cart/variable.php'))) {
			$product_id = $product->id;
			
			if (($post->post_type == 'product' || $post->post_type == 'product_variation') && WC_Email_Inquiry_Functions::check_add_email_inquiry_button($product_id) ) {
				echo WC_Email_Inquiry_Hook_Filter::add_email_inquiry_button($product_id, 'single');
			}
		}
	}
	
	public static function wc_email_inquiry_popup( $show_product_info = 1, $open_type = 'popup' ) {
		check_ajax_referer( 'wc_email_inquiry_popup', 'security' );
				
		$product_id = $_REQUEST['product_id'];
		
		echo WC_Email_Inquiry_Hook_Filter::show_default_inquiry_form( $product_id );
		
		die();
	}
	
	public static function show_default_inquiry_form( $product_id=0, $show_product_info = 1, $open_type = 'popup' ) {
				
		global $wc_email_inquiry_contact_form_settings;
		global $wc_email_inquiry_customize_email_button;
		global $wc_email_inquiry_customize_email_popup;
		
		$wc_email_inquiry_action = wp_create_nonce("wc_email_inquiry_action");
		$product_name = strip_tags( get_the_title( $product_id ) );
		
		$wc_email_inquiry_settings_custom = get_post_meta( $product_id, '_wc_email_inquiry_settings_custom', true);
		
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_button_title'])  || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_button_title'])) == '') $wc_email_inquiry_button_title = $wc_email_inquiry_customize_email_button['inquiry_button_title'];
		else $wc_email_inquiry_button_title = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_button_title']);
		if (trim($wc_email_inquiry_button_title) == '') $wc_email_inquiry_button_title = __('Product Enquiry', 'wc_email_inquiry');
		
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_text_before'])  || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_text_before'])) == '') $wc_email_inquiry_text_before = $wc_email_inquiry_customize_email_button['inquiry_text_before'];
		else $wc_email_inquiry_text_before = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_text_before']);
		
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_hyperlink_text'])  || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_hyperlink_text'])) == '') $wc_email_inquiry_hyperlink_text = $wc_email_inquiry_customize_email_button['inquiry_hyperlink_text'];
		else $wc_email_inquiry_hyperlink_text = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_hyperlink_text']);
		if (trim($wc_email_inquiry_hyperlink_text) == '') $wc_email_inquiry_hyperlink_text = __('Click Here', 'wc_email_inquiry');
		
		if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_trailing_text'])  || trim(esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_trailing_text'])) == '') $wc_email_inquiry_trailing_text = $wc_email_inquiry_customize_email_button['inquiry_trailing_text'];
		else $wc_email_inquiry_trailing_text = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_trailing_text']);
		
		if ( trim( $wc_email_inquiry_customize_email_popup['inquiry_contact_heading'] ) != '') {
			$wc_email_inquiry_contact_heading = $wc_email_inquiry_customize_email_popup['inquiry_contact_heading'];
		} else {
			if (!isset($wc_email_inquiry_settings_custom['wc_email_inquiry_button_type'])) $wc_email_inquiry_button_type = $wc_email_inquiry_customize_email_button['inquiry_button_type'];
			else $wc_email_inquiry_button_type = esc_attr($wc_email_inquiry_settings_custom['wc_email_inquiry_button_type']);
			
			if ($wc_email_inquiry_button_type == 'link') $wc_email_inquiry_contact_heading = $wc_email_inquiry_text_before .' '. $wc_email_inquiry_hyperlink_text .' '.$wc_email_inquiry_trailing_text;
			else $wc_email_inquiry_contact_heading = $wc_email_inquiry_button_title;
		}
		
		if ( trim( $wc_email_inquiry_customize_email_popup['inquiry_contact_text_button'] ) != '') $wc_email_inquiry_contact_text_button = $wc_email_inquiry_customize_email_popup['inquiry_contact_text_button'];
		else $wc_email_inquiry_contact_text_button = __('SEND', 'wc_email_inquiry');
				
		$wc_email_inquiry_contact_button_class = '';
		$wc_email_inquiry_contact_form_class = '';
		if ( trim( $wc_email_inquiry_customize_email_popup['inquiry_contact_button_class'] ) != '') $wc_email_inquiry_contact_button_class = $wc_email_inquiry_customize_email_popup['inquiry_contact_button_class'];
		if ( trim( $wc_email_inquiry_customize_email_popup['inquiry_contact_form_class'] ) != '') $wc_email_inquiry_contact_form_class = $wc_email_inquiry_customize_email_popup['inquiry_contact_form_class'];
		
		$wc_email_inquiry_send_copy = true;
		if ( $wc_email_inquiry_contact_form_settings['inquiry_send_copy'] == 'no') $wc_email_inquiry_send_copy = false;
		
		$wc_email_inquiry_form_class = 'wc_email_inquiry_form';
		if ( $open_type == 'inner_page' ) $wc_email_inquiry_form_class = 'wc_email_inquiry_form_inner';
		
		ob_start();
	?>	
<div class="<?php echo $wc_email_inquiry_form_class; ?> <?php echo $wc_email_inquiry_contact_form_class; ?>">
<div style="padding:10px;">
	<h1 class="wc_email_inquiry_result_heading"><?php echo $wc_email_inquiry_contact_heading; ?></h1>
    <?php if ( $show_product_info == 1 ) echo WC_Email_Inquiry_Functions::get_product_information( $product_id, 1, 100, 100, 'wc_email_inquiry_product_image_small'); ?>
	<div class="wc_email_inquiry_content" id="wc_email_inquiry_content_<?php echo $product_id; ?>">
		<div class="wc_email_inquiry_field">
        	<label class="wc_email_inquiry_label" for="your_name_<?php echo $product_id; ?>"><?php wc_ei_ict_t_e( 'Default Form - Contact Name', __('Name','wc_email_inquiry') ); ?> <span class="wc_email_inquiry_required">*</span></label> 
			<input type="text" class="your_name" name="your_name" id="your_name_<?php echo $product_id; ?>" value="" /></div>
		<div class="wc_email_inquiry_field">
        	<label class="wc_email_inquiry_label" for="your_email_<?php echo $product_id; ?>"><?php wc_ei_ict_t_e( 'Default Form - Contact Email', __('Email','wc_email_inquiry') ); ?> <span class="wc_email_inquiry_required">*</span></label>
			<input type="text" class="your_email" name="your_email" id="your_email_<?php echo $product_id; ?>" value="" /></div>
		<div class="wc_email_inquiry_field">
        	<label class="wc_email_inquiry_label" for="your_phone_<?php echo $product_id; ?>"><?php wc_ei_ict_t_e( 'Default Form - Contact Phone', __('Phone','wc_email_inquiry') ); ?> <span class="wc_email_inquiry_required">*</span></label> 
			<input type="text" class="your_phone" name="your_phone" id="your_phone_<?php echo $product_id; ?>" value="" /></div>
		<div class="wc_email_inquiry_field">
        	<label class="wc_email_inquiry_label"><?php wc_ei_ict_t_e( 'Default Form - Contact Subject', __('Subject','wc_email_inquiry') ); ?> </label> 
			<span class="wc_email_inquiry_subject"><?php echo $product_name; ?></span></div>
		<div class="wc_email_inquiry_field">
        	<label class="wc_email_inquiry_label" for="your_message_<?php echo $product_id; ?>"><?php wc_ei_ict_t_e( 'Default Form - Contact Message', __('Message','wc_email_inquiry') ); ?></label> 
			<textarea class="your_message" name="your_message" id="your_message_<?php echo $product_id; ?>"></textarea></div>
        <div class="wc_email_inquiry_field">
            <?php if ($wc_email_inquiry_send_copy) { ?>
            <label class="wc_email_inquiry_label">&nbsp;</label>
            <label class="wc_email_inquiry_send_copy"><input type="checkbox" name="send_copy" id="send_copy_<?php echo $product_id; ?>" value="1" checked="checked" /> <?php wc_ei_ict_t_e( 'Default Form - Send Copy', __('Send a copy of this email to myself.', 'wc_email_inquiry') ); ?></label>
            <?php } ?>
            <a class="wc_email_inquiry_form_button wc_email_inquiry_bt_<?php echo $product_id; ?> <?php echo $wc_email_inquiry_contact_button_class; ?>" id="wc_email_inquiry_bt_<?php echo $product_id; ?>" product_id="<?php echo $product_id; ?>"><?php echo $wc_email_inquiry_contact_text_button; ?></a> <span class="wc_email_inquiry_loading" id="wc_email_inquiry_loading_<?php echo $product_id; ?>"><img src="<?php echo WC_EMAIL_INQUIRY_IMAGES_URL; ?>/ajax-loader.gif" /></span>
        </div>
        <div style="clear:both"></div>
	</div>
    <div style="clear:both"></div>
</div>
</div>
	<?php
		$default_contact_form = ob_get_clean();
		
		return $default_contact_form;
	}
	
	public static function wc_email_inquiry_action() {
		check_ajax_referer( 'wc_email_inquiry_action', 'security' );
		$product_id 	= esc_attr( stripslashes( $_REQUEST['product_id'] ) );
		$your_name 		= esc_attr( stripslashes( $_REQUEST['your_name'] ) );
		$your_email 	= esc_attr( stripslashes( $_REQUEST['your_email'] ) );
		$your_phone 	= esc_attr( stripslashes( $_REQUEST['your_phone'] ) );
		$your_message 	= esc_attr( stripslashes( strip_tags( $_REQUEST['your_message'] ) ) );
		$send_copy_yourself	= esc_attr( stripslashes( $_REQUEST['send_copy'] ) );
		
		$email_result = WC_Email_Inquiry_Functions::email_inquiry($product_id, $your_name, $your_email, $your_phone, $your_message, $send_copy_yourself);
		echo json_encode($email_result );
		die();
	}
		
	public static function add_style_header() {
		wp_enqueue_style('a3_wc_email_inquiry_style', WC_EMAIL_INQUIRY_CSS_URL . '/wc_email_inquiry_style.css');
	}
	
	public static function footer_print_scripts() {
		global $woocommerce;
		global $wc_email_inquiry_global_settings;
		global $wc_email_inquiry_customize_email_popup;
		global $wc_email_inquiry_contact_form_settings;
		$woocommerce_db_version = get_option( 'woocommerce_db_version', null );
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		
		wp_enqueue_script('jquery');
		$wc_email_inquiry_popup_type = $wc_email_inquiry_global_settings['inquiry_popup_type'];
		if ($wc_email_inquiry_popup_type == 'colorbox') {
			wp_enqueue_style( 'a3_colorbox_style', WC_EMAIL_INQUIRY_JS_URL . '/colorbox/colorbox.css' );
			wp_enqueue_script( 'colorbox_script', WC_EMAIL_INQUIRY_JS_URL . '/colorbox/jquery.colorbox'.$suffix.'.js', array(), false, true );
		} else {
			wp_enqueue_style( 'woocommerce_fancybox_styles', WC_EMAIL_INQUIRY_JS_URL . '/fancybox/fancybox.css' );
			wp_enqueue_script( 'fancybox', WC_EMAIL_INQUIRY_JS_URL . '/fancybox/fancybox'.$suffix.'.js', array(), false, true );
		}
	}
	
	public static function script_contact_popup() {
		global $wc_email_inquiry_global_settings;
		global $wc_email_inquiry_customize_email_popup;
		global $wc_email_inquiry_contact_form_settings;
		global $wc_email_inquiry_fancybox_popup_settings, $wc_email_inquiry_colorbox_popup_settings;
		
		//if ( $wc_email_inquiry_fancybox_popup_settings['fancybox_popup_tool_wide'] == 100 ) $wc_email_inquiry_fancybox_popup_settings['fancybox_popup_tool_wide'] = 90;
		//if ( $wc_email_inquiry_colorbox_popup_settings['colorbox_popup_tool_wide'] == 100 ) $wc_email_inquiry_colorbox_popup_settings['colorbox_popup_tool_wide'] = 90;
		
		$woocommerce_db_version = get_option( 'woocommerce_db_version', null );
		$wc_email_inquiry_popup = wp_create_nonce("wc_email_inquiry_popup");
		$wc_email_inquiry_action = wp_create_nonce("wc_email_inquiry_action");
	?>
<script type="text/javascript">
(function($){
	$(function(){
		var ajax_url = "<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>";
		$(document).on("click", ".wc_email_inquiry_popup_button", function(){
			var product_id = $(this).attr("product_id");
			var product_name = $(this).attr("product_name");
		<?php
			$wc_email_inquiry_popup_type = $wc_email_inquiry_global_settings['inquiry_popup_type'];
			if ($wc_email_inquiry_popup_type == 'colorbox') {
		?>
			var popup_wide = 520;
			if ( ei_getWidth()  <= 568 ) { 
				popup_wide = '100%'; 
			}
			$.colorbox({
				href		: ajax_url+"?action=wc_email_inquiry_popup&product_id="+product_id+"&security=<?php echo $wc_email_inquiry_popup; ?>",
				className	: 'email_inquiry_cb',
				opacity		: 0.85,
				scrolling	: true,
				initialWidth: 100,
				initialHeight: 100,
				innerWidth	: popup_wide,
				//innerHeight	: 500,
				maxWidth  	: '100%',
				maxHeight  	: '90%',
				returnFocus : true,
				transition  : '<?php echo $wc_email_inquiry_colorbox_popup_settings['colorbox_transition'];?>',
				speed		: <?php echo $wc_email_inquiry_colorbox_popup_settings['colorbox_speed'];?>,
				fixed		: <?php echo $wc_email_inquiry_colorbox_popup_settings['colorbox_center_on_scroll'];?>
			});
		<?php } else { ?> 
			var popup_wide = 520;
			if ( ei_getWidth()  <= 568 ) { 
				popup_wide = '95%'; 
			}
			$.fancybox({
				href: ajax_url+"?action=wc_email_inquiry_popup&product_id="+product_id+"&security=<?php echo $wc_email_inquiry_popup; ?>",
				centerOnScroll : <?php echo $wc_email_inquiry_fancybox_popup_settings['fancybox_center_on_scroll'];?>,
				transitionIn : '<?php echo $wc_email_inquiry_fancybox_popup_settings['fancybox_transition_in'];?>', 
				transitionOut: '<?php echo $wc_email_inquiry_fancybox_popup_settings['fancybox_transition_out'];?>',
				easingIn: 'swing',
				easingOut: 'swing',
				speedIn : <?php echo $wc_email_inquiry_fancybox_popup_settings['fancybox_speed_in'];?>,
				speedOut : <?php echo $wc_email_inquiry_fancybox_popup_settings['fancybox_speed_out'];?>,
				width: popup_wide,
				autoScale: true,
				autoDimensions: true,
				height: 460,
				margin: 0,
				maxWidth: "95%",
				maxHeight: "80%",
				padding: 10,
				overlayColor: '<?php echo $wc_email_inquiry_fancybox_popup_settings['fancybox_overlay_color'];?>',
				showCloseButton : true,
				openEffect	: "none",
				closeEffect	: "none"
			});
		<?php } ?>
		});
		
		<?php if ( $wc_email_inquiry_contact_form_settings['defaul_product_page_open_form_type'] == 'inner_page' ) { ?>
		$(document).on("click", ".wc_email_inquiry_button_closed", function(){
			var button_object = $(this);
			var product_id = $(this).attr("product_id");
			var form_action = $(this).attr("form_action");
			$("#wc_defaul_inquiry_form_inner_container_" + product_id).show('normal');
			$("#wc_email_inquiry_expand_text_" + product_id).html('<?php _e('-', 'wc_email_inquiry'); ?>');
			$(this).attr("form_action", "show");
			setTimeout( function() { 
				button_object.removeClass('wc_email_inquiry_button_closed');
				button_object.addClass('wc_email_inquiry_button_opened');
			}, 1000);
			
		});
		$(document).on("click", ".wc_email_inquiry_button_opened", function(){
			var button_object = $(this);
			var product_id = $(this).attr("product_id");
			var form_action = $(this).attr("form_action");
			$("#wc_defaul_inquiry_form_inner_container_" + product_id).hide('normal');
			$("#wc_email_inquiry_expand_text_" + product_id).html('<?php _e('+', 'wc_email_inquiry'); ?>');
			$(this).attr("form_action", "hide");
			setTimeout( function() { 
				button_object.removeClass('wc_email_inquiry_button_opened');
				button_object.addClass('wc_email_inquiry_button_closed');
			}, 1000);
		});
		<?php } ?>
		
		$(document).on("click", ".wc_email_inquiry_form_button", function(){
			if ( $(this).hasClass('wc_email_inquiry_sending') ) {
				return false;
			}
			$(this).addClass('wc_email_inquiry_sending');
			
			var product_id = $(this).attr("product_id");
			var your_name = $("#your_name_"+product_id).val();
			var your_email = $("#your_email_"+product_id).val();
			var your_phone = $("#your_phone_"+product_id).val();
			var your_message = $("#your_message_"+product_id).val();
			var send_copy = 0;
			if ( $("#send_copy_"+product_id).is(':checked') )
				send_copy = 1;
			
			var wc_email_inquiry_error = "";
			var wc_email_inquiry_have_error = false;
			var filter = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			
			if (your_name.replace(/^\s+|\s+$/g, '') == "") {
				wc_email_inquiry_error += "<?php wc_ei_ict_t_e( 'Default Form - Contact Name Error', __('Please enter your Name', 'wc_email_inquiry') ); ?>\n";
				wc_email_inquiry_have_error = true;
			}
			if (your_email == "" || !filter.test(your_email)) {
				wc_email_inquiry_error += "<?php wc_ei_ict_t_e( 'Default Form - Contact Email Error', __('Please enter valid Email address', 'wc_email_inquiry') ); ?>\n";
				wc_email_inquiry_have_error = true;
			}
			if (your_phone.replace(/^\s+|\s+$/g, '') == "") {
				wc_email_inquiry_error += "<?php wc_ei_ict_t_e( 'Default Form - Contact Phone Error', __('Please enter your Phone', 'wc_email_inquiry') ); ?>\n";
				wc_email_inquiry_have_error = true;
			}
			if (wc_email_inquiry_have_error) {
				$(this).removeClass('wc_email_inquiry_sending');
				alert(wc_email_inquiry_error);
				return false;
			}
			$("#wc_email_inquiry_loading_"+product_id).show();
			
			var data = {
				action: 		"wc_email_inquiry_action",
				product_id: 	product_id,
				your_name: 		your_name,
				your_email: 	your_email,
				your_phone: 	your_phone,
				your_message: 	your_message,
				send_copy:		send_copy,
				security: 		"<?php echo $wc_email_inquiry_action; ?>"
			};
			$.post( ajax_url, data, function(response) {
				wc_email_inquiry_response = $.parseJSON( response );
				$("#wc_email_inquiry_loading_"+product_id).hide();
				$("#wc_email_inquiry_content_"+product_id).html(wc_email_inquiry_response);
				<?php if ( $wc_email_inquiry_popup_type == 'colorbox' ) { ?>
				var height_cb = false;
				if ( ei_getWidth()  <= 568 ) { 
					height_cb = '90%';
				}
				$.colorbox.resize({
					height:		height_cb
				});
				<?php } ?>
			});
		});
	});
})(jQuery);
</script>
    <?php
	?>
<script>
function ei_getWidth() {
    xWidth = null;
    if(window.screen != null)
      xWidth = window.screen.availWidth;

    if(window.innerWidth != null)
      xWidth = window.innerWidth;

    if(document.body != null)
      xWidth = document.body.clientWidth;

    return xWidth;
}
</script>
	<?php
	}
	
	public static function add_google_fonts() {
		global $wc_ei_fonts_face;
		global $wc_email_inquiry_customize_email_button, $wc_email_inquiry_customize_email_popup;
		$google_fonts = array( 
							$wc_email_inquiry_customize_email_button['inquiry_button_font']['face'], 
							$wc_email_inquiry_customize_email_button['inquiry_hyperlink_font']['face'], 
							$wc_email_inquiry_customize_email_popup['inquiry_contact_popup_text']['face'], 
							$wc_email_inquiry_customize_email_popup['inquiry_contact_button_font']['face'], 
							$wc_email_inquiry_customize_email_popup['inquiry_contact_heading_font']['face'], 
						);
						
		$google_fonts = apply_filters( 'wc_ei_google_fonts', $google_fonts );
		
		$wc_ei_fonts_face->generate_google_webfonts( $google_fonts );
	}
	
	public static function admin_footer_scripts() {
		global $wc_ei_admin_interface;
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		
		wp_enqueue_script('jquery');
		wp_enqueue_style( 'a3rev-chosen-new-style', $wc_ei_admin_interface->admin_plugin_url() . '/assets/js/chosen/chosen' . $suffix . '.css' );
		wp_enqueue_script( 'a3rev-chosen-new', $wc_ei_admin_interface->admin_plugin_url() . '/assets/js/chosen/chosen.jquery' . $suffix . '.js', array( 'jquery' ), true, false );
	?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery(".chzn-select").chosen(); jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true});
});	
</script>
    <?php
	}
	
	public static function change_order_item_display_meta_value( $meta_value = '' ) {
		if ( stristr( $meta_value, 'http://' ) !== false || stristr( $meta_value, 'https://' ) !== false ) {
			$meta_value = strip_tags( $meta_value );
			$meta_file_name = basename( $meta_value );
			$meta_value = '<a href="'.$meta_value.'">'.$meta_file_name.'</a>';
		}
		
		return $meta_value;
	}
	
	public static function a3_wp_admin() {
		wp_enqueue_style( 'a3rev-wp-admin-style', WC_EMAIL_INQUIRY_CSS_URL . '/a3_wp_admin.css' );
	}
	
	public static function admin_sidebar_menu_css() {
		wp_enqueue_style( 'a3rev-wc-ei-admin-sidebar-menu-style', WC_EMAIL_INQUIRY_CSS_URL . '/admin_sidebar_menu.css' );
	}
			
	public static function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != WC_EMAIL_INQUIRY_NAME) {
			return $links;
		}
		$links[] = '<a href="http://docs.a3rev.com/user-guides/woocommerce/woo-email-inquiry-cart-options/" target="_blank">'.__('Documentation', 'wc_email_inquiry').'</a>';
		$links[] = '<a href="https://a3rev.com/forums/forum/woocommerce-plugins/email-inquiry-cart-options/" target="_blank">'.__('Support', 'wc_email_inquiry').'</a>';
		return $links;
	}
}
?>
