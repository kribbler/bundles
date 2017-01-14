<?php
/**
 * WPEC PCF MetaBox
 *
 * Table Of Contents
 *
 * add_meta_boxes()
 * the_meta_forms()
 * save_meta_boxes()
 */
class WC_Email_Inquiry_MetaBox
{
	
	public static function add_meta_boxes(){
		global $post;
		$pagename = 'product';
		add_meta_box( 'wc_email_inquiry_meta', __('Email & Cart', 'wc_email_inquiry'), array('WC_Email_Inquiry_MetaBox', 'the_meta_forms'), $pagename, 'normal', 'high' );
	}
	
	public static function the_meta_forms() {
		global $post;
		global $wc_email_inquiry_rules_roles_settings;
		global $wc_email_inquiry_global_settings;
		global $wc_email_inquiry_email_options;
		global $wc_email_inquiry_customize_email_button;
		add_action('admin_footer', array('WC_Email_Inquiry_Hook_Filter', 'admin_footer_scripts'), 10);
		global $wp_roles;
		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new WP_Roles();
		}
		$roles = $wp_roles->get_names();
		
		$wc_email_inquiry_settings_custom = get_post_meta( $post->ID, '_wc_email_inquiry_settings_custom', true);
		if (is_array($wc_email_inquiry_settings_custom)) extract($wc_email_inquiry_settings_custom);
		
		if (!isset($wc_email_inquiry_hide_addcartbt)) $wc_email_inquiry_hide_addcartbt = $wc_email_inquiry_rules_roles_settings['hide_addcartbt'];
		else $wc_email_inquiry_hide_addcartbt = esc_attr($wc_email_inquiry_hide_addcartbt);
		
		if (!isset($wc_email_inquiry_show_button)) $wc_email_inquiry_show_button = $wc_email_inquiry_rules_roles_settings['show_button'];
		else $wc_email_inquiry_show_button = esc_attr($wc_email_inquiry_show_button);
		
		if (!isset($wc_email_inquiry_hide_price)) $wc_email_inquiry_hide_price = $wc_email_inquiry_rules_roles_settings['hide_price'];
		else $wc_email_inquiry_hide_price = esc_attr($wc_email_inquiry_hide_price);
		
		if (!isset($role_apply_hide_cart)) $role_apply_hide_cart = (array) $wc_email_inquiry_rules_roles_settings['role_apply_hide_cart'];
		if (!isset($role_apply_hide_price)) $role_apply_hide_price = (array) $wc_email_inquiry_rules_roles_settings['role_apply_hide_price'];
		if (!isset($role_apply_show_inquiry_button)) $role_apply_show_inquiry_button = (array) $wc_email_inquiry_rules_roles_settings['role_apply_show_inquiry_button'];
				
		if (!isset($wc_email_inquiry_email_to)) $wc_email_inquiry_email_to = $wc_email_inquiry_email_options['inquiry_email_to'];
		else $wc_email_inquiry_email_to = esc_attr($wc_email_inquiry_email_to);
		
		if (!isset($wc_email_inquiry_email_cc)) $wc_email_inquiry_email_cc = $wc_email_inquiry_email_options['inquiry_email_cc'];
		else $wc_email_inquiry_email_cc = esc_attr($wc_email_inquiry_email_cc);
		
		if (!isset($wc_email_inquiry_button_type)) $wc_email_inquiry_button_type = $wc_email_inquiry_global_settings['inquiry_button_type'];
		else $wc_email_inquiry_button_type = esc_attr($wc_email_inquiry_button_type);
		
		if (!isset($wc_email_inquiry_text_before)) $wc_email_inquiry_text_before = $wc_email_inquiry_customize_email_button['inquiry_text_before'];
		else $wc_email_inquiry_text_before = esc_attr($wc_email_inquiry_text_before);
		
		if (!isset($wc_email_inquiry_hyperlink_text)) $wc_email_inquiry_hyperlink_text = $wc_email_inquiry_customize_email_button['inquiry_hyperlink_text'];
		else $wc_email_inquiry_hyperlink_text = esc_attr($wc_email_inquiry_hyperlink_text);
		
		if (!isset($wc_email_inquiry_trailing_text)) $wc_email_inquiry_trailing_text = $wc_email_inquiry_customize_email_button['inquiry_trailing_text'];
		else $wc_email_inquiry_trailing_text = esc_attr($wc_email_inquiry_trailing_text);
		
		if (!isset($wc_email_inquiry_button_title)) $wc_email_inquiry_button_title = $wc_email_inquiry_customize_email_button['inquiry_button_title'];
		else $wc_email_inquiry_button_title = esc_attr($wc_email_inquiry_button_title);
		
		
		if (!isset($wc_email_inquiry_single_only)) $wc_email_inquiry_single_only = $wc_email_inquiry_global_settings['inquiry_single_only'];
		else $wc_email_inquiry_single_only = esc_attr($wc_email_inquiry_single_only);
		
		?>
        <table cellspacing="0" class="form-table">
			<tbody>
            	<tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_reset_product_options"><?php _e('Reset Product Options','wc_email_inquiry'); ?></label></th>
                    <td class="forminp">
                        <fieldset><label><input type="checkbox" value="1" id="wc_email_inquiry_reset_product_options" name="wc_email_inquiry_reset_product_options" /> <?php _e('Check to reset this product setting to the Global Settings', 'wc_email_inquiry'); ?></label></fieldset>
                    </td>
                </tr>
            	<tr valign="top">
                    <th class="titledesc" scope="rpw" colspan="2"><strong><?php _e('Customize setting for this product', 'wc_email_inquiry'); ?></strong></th>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_hide_addcartbt"><?php _e("Rule: Hide 'Add to Cart'",'wc_email_inquiry'); ?></label></th>
                    <td class="forminp"><label><input type="checkbox" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_hide_addcartbt]" id="wc_email_inquiry_hide_addcartbt" value="yes" <?php checked( $wc_email_inquiry_hide_addcartbt, 'yes' ); ?> /> <?php _e('Yes. Applies to all users who are not logged in.', 'wc_email_inquiry'); ?></label>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="role_apply_hide_cart"><?php _e('Apply Rule to logged in roles','wc_email_inquiry'); ?></label></th>
                    <td class="forminp">
                    	<select multiple="multiple" id="role_apply_hide_cart" name="_wc_email_inquiry_settings_custom[role_apply_hide_cart][]" data-placeholder="<?php _e( 'Choose Roles', 'wc_email_inquiry' ); ?>" style="display:none; width:300px;" class="chzn-select">
						<?php foreach ($roles as $key => $val) { ?>
                        	<?php if ( in_array( $key, array('manual_quote', 'auto_quote') ) ) continue; ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( in_array($key, (array) $role_apply_hide_cart), true ); ?>><?php echo $val ?></option>
                        <?php } ?>
                        </select>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_show_button"><?php _e('Rule: Show Email Inquiry Button','wc_email_inquiry'); ?></label></th>
                    <td class="forminp">
                    <label><input type="checkbox" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_show_button]" id="wc_email_inquiry_show_button" value="yes" <?php checked( $wc_email_inquiry_show_button, 'yes' ); ?> /> <?php _e('Yes. Applies to all users who are not logged in.', 'wc_email_inquiry'); ?></label>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="role_apply_show_inquiry_button"><?php _e('Apply Rule to logged in roles','wc_email_inquiry'); ?></label></th>
                    <td class="forminp">
                    	<select multiple="multiple" id="role_apply_show_inquiry_button" name="_wc_email_inquiry_settings_custom[role_apply_show_inquiry_button][]" data-placeholder="<?php _e( 'Choose Roles', 'wc_email_inquiry' ); ?>" style="display:none; width:300px;" class="chzn-select">
						<?php foreach ($roles as $key => $val) { ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( in_array($key, (array) $role_apply_show_inquiry_button), true ); ?>><?php echo $val ?></option>
                        <?php } ?>
                        </select>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_hide_price"><?php _e("Rule: Hide Price",'wc_email_inquiry'); ?></label></th>
                    <td class="forminp"><label><input type="checkbox" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_hide_price]" id="wc_email_inquiry_hide_price" value="yes" <?php checked( $wc_email_inquiry_hide_price, 'yes' ); ?> /> <?php _e('Yes. Applies to all users who are not logged in.', 'wc_email_inquiry'); ?></label>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="role_apply_hide_price"><?php _e('Apply Rule to logged in roles','wc_email_inquiry'); ?></label></th>
                    <td class="forminp">
                    	<select multiple="multiple" id="role_apply_hide_price" name="_wc_email_inquiry_settings_custom[role_apply_hide_price][]" data-placeholder="<?php _e( 'Choose Roles', 'wc_email_inquiry' ); ?>" style="display:none; width:300px;" class="chzn-select">
						<?php foreach ($roles as $key => $val) { ?>
                        	<?php if ( in_array( $key, array('manual_quote', 'auto_quote') ) ) continue; ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( in_array($key, (array) $role_apply_hide_price), true ); ?>><?php echo $val ?></option>
                        <?php } ?>
                        </select>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_email_to"><?php _e('Inquiry Email goes to','wc_email_inquiry'); ?></label></th>
                    <td class="forminp"><input type="text" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_email_to]" id="wc_email_inquiry_email_to" value="<?php echo $wc_email_inquiry_email_to;?>" style="min-width:300px" /> 
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_email_cc"><?php _e('Copy to','wc_email_inquiry'); ?></label></th>
                    <td class="forminp"><input type="text" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_email_cc]" id="wc_email_inquiry_email_cc" value="<?php echo $wc_email_inquiry_email_cc;?>" style="min-width:300px" /> 
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label><?php _e('Button or Hyperlink Text','wc_email_inquiry'); ?></label></th>
                    <td class="forminp">
                    <label><input type="radio" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_button_type]" id="wc_email_inquiry_button" class="wc_email_inquiry_button_type" value="" checked="checked" /> <?php _e('Button', 'wc_email_inquiry'); ?></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label><input type="radio" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_button_type]" id="wc_email_inquiry_link" class="wc_email_inquiry_button_type" value="link" <?php checked( $wc_email_inquiry_button_type, 'link' ); ?> /> <?php _e('Link', 'wc_email_inquiry'); ?></label>
                    </td>
               	</tr>
                <tr valign="top" class="button_type_link" style=" <?php if($wc_email_inquiry_button_type != 'link') { echo 'display:none'; } ?>">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_text_before"><?php _e('Text before','wc_email_inquiry'); ?></label></th>
                    <td class="forminp"><input type="text" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_text_before]" id="wc_email_inquiry_text_before" value="<?php echo $wc_email_inquiry_text_before;?>" style="min-width:300px" /> 
                    </td>
               	</tr>
                <tr valign="top" class="button_type_link" style=" <?php if($wc_email_inquiry_button_type != 'link') { echo 'display:none'; } ?>">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_hyperlink_text"><?php _e('Hyperlink text','wc_email_inquiry'); ?></label></th>
                    <td class="forminp"><input type="text" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_hyperlink_text]" id="wc_email_inquiry_hyperlink_text" value="<?php echo $wc_email_inquiry_hyperlink_text;?>" style="min-width:300px" /> 
                    </td>
               	</tr>
                <tr valign="top" class="button_type_link" style=" <?php if($wc_email_inquiry_button_type != 'link') { echo 'display:none'; } ?>">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_trailing_text"><?php _e('Trailing text','wc_email_inquiry'); ?></label></th>
                    <td class="forminp"><input type="text" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_trailing_text]" id="wc_email_inquiry_trailing_text" value="<?php echo $wc_email_inquiry_trailing_text;?>" style="min-width:300px" /> 
                    </td>
               	</tr>
                <tr valign="top" class="button_type_button" style=" <?php if($wc_email_inquiry_button_type == 'link') { echo 'display:none'; } ?>">
                    <th class="titledesc" scope="rpw"><label for="wc_email_inquiry_button_title"><?php _e('Button Title','wc_email_inquiry'); ?></label></th>
                    <td class="forminp"><input type="text" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_button_title]" id="wc_email_inquiry_button_title" value="<?php echo $wc_email_inquiry_button_title;?>" style="min-width:300px" /> 
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label><?php _e('Single Product Page only','wc_email_inquiry'); ?></label></th>
                    <td class="forminp"><label><input type="radio" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_single_only]" id="wc_email_inquiry_single_only_yes" value="yes" <?php checked( $wc_email_inquiry_single_only, 'yes' ); ?> /> <?php _e('Yes', 'wc_email_inquiry'); ?></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label><input type="radio" name="_wc_email_inquiry_settings_custom[wc_email_inquiry_single_only]" id="wc_email_inquiry_single_only_no" value="no" <?php if ($wc_email_inquiry_single_only != 'yes' ) echo 'checked="checked"'; ?> /> <?php _e('No', 'wc_email_inquiry'); ?></label>
                    </td>
               	</tr>
			</tbody>
		</table>
		<script type="text/javascript">
			(function($){		
				$(function(){	
					$('.wc_email_inquiry_button_type').click(function(){
						if ($("input[name='_wc_email_inquiry_settings_custom[wc_email_inquiry_button_type]']:checked").val() == '') {
							$(".button_type_button").show();
							$(".button_type_link").hide();
						} else {
							$(".button_type_link").show();
							$(".button_type_button").hide();
						}
					});
				});		  
			})(jQuery);
		</script>
		<?php
	}
	
	public static function save_meta_boxes($post_id){
		$post_status = get_post_status($post_id);
		$post_type = get_post_type($post_id);
		if ($post_type == 'product' && isset($_REQUEST['_wc_email_inquiry_settings_custom']) && $post_status != false  && $post_status != 'inherit') {
			if (isset($_REQUEST['wc_email_inquiry_reset_product_options']) && $_REQUEST['wc_email_inquiry_reset_product_options'] == 1) {
				delete_post_meta($post_id, '_wc_email_inquiry_settings_custom');
				return;	
			}
			
			$wc_email_inquiry_settings_custom = $_REQUEST['_wc_email_inquiry_settings_custom'];
			if ( !isset($wc_email_inquiry_settings_custom['wc_email_inquiry_hide_addcartbt'] ) ) {
				$wc_email_inquiry_settings_custom['wc_email_inquiry_hide_addcartbt'] = 'no' ;
			}
			if ( !isset($wc_email_inquiry_settings_custom['role_apply_hide_cart'] ) ) {
				$wc_email_inquiry_settings_custom['role_apply_hide_cart'] = array() ;
			}
			if ( !isset($wc_email_inquiry_settings_custom['wc_email_inquiry_show_button'] ) ) {
				$wc_email_inquiry_settings_custom['wc_email_inquiry_show_button'] = 'no' ;
			}
			if ( !isset($wc_email_inquiry_settings_custom['role_apply_show_inquiry_button'] ) ) {
				$wc_email_inquiry_settings_custom['role_apply_show_inquiry_button'] = array() ;
			}
			if ( !isset($wc_email_inquiry_settings_custom['wc_email_inquiry_hide_price'] ) ) {
				$wc_email_inquiry_settings_custom['wc_email_inquiry_hide_price'] = 'no' ;
			}
			if ( !isset($wc_email_inquiry_settings_custom['role_apply_hide_price'] ) ) {
				$wc_email_inquiry_settings_custom['role_apply_hide_price'] = array() ;
			}
			if ( !isset($wc_email_inquiry_settings_custom['wc_email_inquiry_button'] ) ) {
				$wc_email_inquiry_settings_custom['wc_email_inquiry_button'] = 'button' ;
			}
			if ( !isset($wc_email_inquiry_settings_custom['wc_email_inquiry_single_only'] ) ) {
				$wc_email_inquiry_settings_custom['wc_email_inquiry_single_only'] = 'no' ;
			}
			update_post_meta($post_id, '_wc_email_inquiry_settings_custom', $wc_email_inquiry_settings_custom);
		}
	}
}
?>