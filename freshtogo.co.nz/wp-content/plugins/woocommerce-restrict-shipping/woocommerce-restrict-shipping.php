<?php
/*
Plugin Name: WooCommerce Restrict Shipping
Plugin URI: http://ignitewoo.com
Description: Prevents customers from purchasing items that cannot be shipped to selected countries / states
Version: 1.6.6
Author: IgniteWoo
Author URI: http://ignitewoo.com
*/


// Add the plugin settings interface
add_action( 'admin_init', 'ign_restrict_shipping_admin_init', 99 );

function ign_restrict_shipping_admin_init() {
	global $ignitewoo_integrations;
	
	if ( !class_exists( 'Woocommerce' ) && !class_exists( 'WC' ) )
		return;

	// Add the primary tab
	add_action( 'woocommerce_settings_tabs', 'ignitewoo_add_tab', 10 );
	
	// Add the integration sections
	add_action( 'woocommerce_settings_tabs_ignitewoo', 'ignitewoo_settings_tab_action', 10 );
	
	if ( !class_exists( 'IGN_Integration' ) || !class_exists( 'IGN_Integrations' ) ) { 

		require_once( dirname( __FILE__ ) . '/classes/class-ignitewoo-integration.php' );
			
		require_once( dirname( __FILE__ ) . '/classes/class-ignitewoo-integrations.php' );
		
	}
	
	require_once( dirname( __FILE__ ) . '/classes/class-ignitewoo-restrict-shipping-integration.php' );

	$ignitewoo_integrations->init();
	
	if ( !function_exists( 'ignitewoo_add_tab' ) ) { 
	
		function ignitewoo_add_tab() {
			global $ignitewoo_integrations; 

			$current_tab = ( isset($_GET['tab'] ) ) ? $_GET['tab'] : 'general';
			
			$ignitewoo_integrations->ignitewoo_integrations_tab( $current_tab );

		}
	}

	if ( !function_exists( 'ignitewoo_settings_tab_action' ) ) { 
	
		function ignitewoo_settings_tab_action() {
			global $ignitewoo_integrations; 

			$ignitewoo_integrations->ignitewoo_integrations_sections();

		}
	}
}


class IgniteWoo_Restrict_Shipping {


	function __construct() {

		add_action( 'add_meta_boxes', array( &$this, 'add_meta_box' ) );
		add_action( 'save_post', array( &$this, 'save_post' ), 1, 1 );
		add_action( 'edit_post', array( &$this, 'save_post' ), 1, 1 );
		add_action( 'woocommerce_after_checkout_validation', array( &$this, 'check_restricted_states' ) );

	}

	
	function load_plugin_textdomain() {

		$locale = apply_filters( 'plugin_locale', get_locale(), 'ignitewoo_restrict_shipping' );

		load_textdomain( 'ignitewoo_restrict_shipping', WP_LANG_DIR.'/woocommerce/ignitewoo_restrict_shipping-'.$locale.'.mo' );

		$plugin_rel_path = apply_filters( 'ignitewoo_translation_file_rel_path', dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		load_plugin_textdomain( 'ignitewoo_restrict_shipping', false, $plugin_rel_path );

	}
	
	function add_meta_box() {
	
		add_meta_box( 'woocommerce-restrict-shipping', __( 'Restricted Countries / States', 'ignitewoo_restrict_shipping' ), array( &$this, 'meta_box_content' ), 'product', 'side', 'default' );

	}

	
	function meta_box_content() {
		global $woocommerce, $post;

		$c = new WC_Countries();

		$s = get_post_meta( $post->ID, 'restrict_states', true );

		if ( !isset( $s ) )
			$s = array();

		?>
		
		<style>
			.restrict_states_box .chzn-container { width: 230px !important; }
		</style>
		
		<div style="height: 450px; overflow: auto" class="restrict_states_box">
			<p>
				<?php _e( 'Select areas where this product cannot be shipped. Leave this blank to allow shipping to anywhere', 'ignitewoo_restrict_shipping' )?>
			</p>
			<p>
			<select name="restrict_states[]" multiple="multiple" class="chosen_select">
			<?php
			
			$state_groups = array();
			
			foreach( $c->countries as $k => $v ) {

				if ( !empty( $c->states[ $k ] ) && count( $c->states[ $k ] ) > 0 ) { 
				
					echo '<optgroup label="' . $v . '">'; 
					
					foreach( $c->states[ $k ] as $kk => $vv ) { 

						if ( in_array( $k . ':' . $kk, (array)$s ) )
							$selected = ' selected="selected"';
						else
							$selected = '';
							
						echo '<option value="' . $k . ':' . $kk . '" ' . $selected . '>' . $vv . '</option>';
					}
					
					echo '</optgroup>';
					
					if ( 'US' !== $k )
						$state_groups[] = array( 'name' => $k, 'label' => $v, 'states' => $c->states[ $k ] );
				
				} else { 
				
					if ( in_array( $k, (array)$s ) )
						$selected = ' selected="selected"';
					else
						$selected = '';
						
					echo '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
					
				}
			
			}
		
			$setting = get_post_meta( $post->ID, 'apply_global_shipping_restrictions', true );

			if ( empty( $setting ) )
				$setting = 'override';

			?>
			</select>
			</p>

			<p><button class="select_all button"><?php _e('All', 'ignitewoo_table_rate'); ?></button><button class="select_none button"><?php _e('None', 'ignitewoo_table_rate'); ?></button>
			<?php for ( $i = 0; $i < count( $state_groups ); $i++ )  { ?>
			
				<button id="<?php echo str_replace( ' ', '-', $state_groups[$i]['label'] )?>" class="select_all_states button"><?php _e( $state_groups[ $i ]['label'], 'ignitewoo_table_rate'); ?></button>
			
			<?php } ?>
			<button class="button select_us_states"><?php _e('US States', 'ignitewoo_table_rate'); ?></button>
			<button class="button select_europe"><?php _e('EU States', 'ignitewoo_table_rate'); ?></button>
			</p>
			
			<?php /*
			<p><button class="select_all button"><?php _e('All', 'ignitewoo_table_rate'); ?></button><button class="select_none button"><?php _e('None', 'ignitewoo_table_rate'); ?></button><button class="button select_us_states"><?php _e('US States', 'ignitewoo_table_rate'); ?></button><button class="button select_europe"><?php _e('EU States', 'ignitewoo_table_rate'); ?></button><button class="button select_aus"><?php _e('AUS States', 'ignitewoo_table_rate'); ?></button></p>
			*/ ?>

			
			<p style="line-height: 1.2em">
				<input type="radio" name="apply_global_shipping_restrictions" value="override" <?php checked( $setting, 'override', true ) ?>> <?php _e( 'Override global restrictions', 'ignitewoo_restrict_shipping' )?>
			</p>
			<p>
				<input type="radio" name="apply_global_shipping_restrictions" value="merge" <?php checked( $setting, 'merge', true ) ?>> <?php _e( 'Merge with global restrictions', 'ignitewoo_restrict_shipping' )?>
			</p>
		</div>
		
		<?php
		
		$this->add_inline_js();
	}

	
	function add_inline_js() { 
		global $woocommerce;
				 
		$js = "
		
			jQuery( '.select_all_states' ).click( function() { 

				var id = jQuery( this ).attr( 'id' );	
				
				ids = id.replace( /-/g, ' ' );

				jQuery( '#' + id ).closest('div').find('select').find( 'optgroup[label=\"' + ids + '\"]' ).find('option').each( function() { 
					jQuery( this ).attr(\"selected\",\"selected\");
				})
				jQuery(this).closest('div').find('select').trigger('chosen:updated');
				return false;
			})
		
			jQuery('.select_all').live('click', function(){
				jQuery(this).closest('div').find('select option').attr(\"selected\",\"selected\");
				jQuery(this).closest('div').find('select').trigger('chosen:updated');
				return false;
			});

			jQuery('.select_none').live('click', function(){
				jQuery(this).closest('div').find('select option').removeAttr(\"selected\");
				jQuery(this).closest('div').find('select').trigger('chosen:updated');
				return false;
			});
			
			
			jQuery('.select_europe').live('click', function(){
				jQuery(this).closest('div').find('option[value=\"AL\"], option[value=\"AD\"], option[value=\"AM\"], option[value=\"AT\"], option[value=\"BY\"], option[value=\"BE\"], option[value=\"BA\"], option[value=\"BG\"], option[value=\"CH\"], option[value=\"CY\"], option[value=\"CZ\"], option[value=\"DE\"], option[value=\"DK\"], option[value=\"EE\"], option[value=\"ES\"], option[value=\"FO\"], option[value=\"FI\"], option[value=\"FR\"], option[value=\"GB\"], option[value=\"GE\"], option[value=\"GI\"], option[value=\"GR\"], option[value=\"HU\"], option[value=\"HR\"], option[value=\"IE\"], option[value=\"IS\"], option[value=\"IT\"], option[value=\"LT\"], option[value=\"LU\"], option[value=\"LV\"], option[value=\"MC\"], option[value=\"MK\"], option[value=\"MT\"], option[value=\"NO\"], option[value=\"NL\"], option[value=\"PO\"], option[value=\"PT\"], option[value=\"RO\"], option[value=\"RU\"], option[value=\"SE\"], option[value=\"SI\"], option[value=\"SK\"], option[value=\"SM\"], option[value=\"TR\"], option[value=\"UA\"], option[value=\"VA\"]').attr(\"selected\",\"selected\");
				jQuery(this).closest('div').find('select').trigger('chosen:updated');
				return false;
			});

			jQuery('.select_us_states').live('click', function(){
				jQuery(this).closest('div').find('option[value=\"US:AK\"], option[value=\"US:AL\"], option[value=\"US:AZ\"], option[value=\"US:AR\"], option[value=\"US:CA\"], option[value=\"US:CO\"], option[value=\"US:CT\"], option[value=\"US:DE\"], option[value=\"US:DC\"], option[value=\"US:FL\"], option[value=\"US:GA\"], option[value=\"US:HI\"], option[value=\"US:ID\"], option[value=\"US:IL\"], option[value=\"US:IN\"], option[value=\"US:IA\"], option[value=\"US:KS\"], option[value=\"US:KY\"], option[value=\"US:LA\"], option[value=\"US:ME\"], option[value=\"US:MD\"], option[value=\"US:MA\"], option[value=\"US:MI\"], option[value=\"US:MN\"], option[value=\"US:MS\"], option[value=\"US:MO\"], option[value=\"US:MT\"], option[value=\"US:NE\"], option[value=\"US:NV\"], option[value=\"US:NH\"], option[value=\"US:NJ\"], option[value=\"US:NM\"], option[value=\"US:NY\"], option[value=\"US:NC\"], option[value=\"US:ND\"], option[value=\"US:OH\"], option[value=\"US:OK\"], option[value=\"US:OR\"], option[value=\"US:PA\"], option[value=\"US:RI\"], option[value=\"US:SC\"], option[value=\"US:SD\"], option[value=\"US:TN\"], option[value=\"US:TX\"], option[value=\"US:UT\"], option[value=\"US:VT\"], option[value=\"US:VA\"], option[value=\"US:WA\"], option[value=\"US:WV\"], option[value=\"US:WI\"], option[value=\"US:WY\"]').attr(\"selected\",\"selected\");
				jQuery(this).closest('div').find('select').trigger('chosen:updated');
				return false;
			});

			/*
			jQuery('.select_aus').live('click', function(){
				jQuery(this).closest('div').find('option[value=\"AU:ACT\"], option[value=\"AU:NSW\"], option[value=\"AU:NT\"], option[value=\"AU:QLD\"], option[value=\"AU:VIC\"]').attr(\"selected\",\"selected\");
				jQuery(this).closest('div').find('select').trigger('chosen:updated');
				return false;
			});
			*/
		";

		
		if ( function_exists( 'wc_enqueue_js' ) )
			wc_enqueue_js( $js );
		else 
			$woocommerce->add_inline_js( $js );
	}
	
	function save_post( $post_id ) {
		global $post;
		
		if ( empty( $post ) )
			return;

		if ( !$_POST ) return $post_id;
		if ( is_int( wp_is_post_revision( $post_id ) ) ) return;
		if ( is_int( wp_is_post_autosave( $post_id ) ) ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
		if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		if ( $post->post_type != 'product' ) return $post_id;

		update_post_meta( $post_id, 'restrict_states', $_POST['restrict_states'] );
		update_post_meta( $post_id, 'apply_global_shipping_restrictions', $_POST['apply_global_shipping_restrictions'] );
	}

	
	function check_restricted_states( $posted ) {
		global $woocommerce;

		if ( 0 == sizeof( $woocommerce->cart->get_cart() ) )
			return;

		if ( !isset( $posted['billing_state'] ) )
			return;

		$opts = get_option( 'woocommerce_ign_restrict_shipping_settings', false );

		if ( empty( $opts['enable'] ) || 'yes' != $opts['enable'] )
			return;
			
		$cart = $woocommerce->cart->get_cart();

		if ( count( $cart ) <= 0 )
			return;
			
		$location = '';

		$c = new WC_Countries();

		if ( 'yes' == get_option( 'woocommerce_ship_to_billing_address_only' ) ) { 
		
			if ( isset( $posted['billing_country'] ) && !empty( $posted['billing_country'] ) ) 
				$location = $posted['billing_country'];
				
			$location_name = $c->countries[ $location ];
				
			if ( isset( $posted['billing_state'] ) && !empty( $posted['billing_state'] ) ) {
				
				if ( count( $c->states[ $location ] ) > 0 ) { 
					$location .= ':' . $posted['billing_state'];
					$location_name = $c->states[ $posted['billing_country'] ][ $posted['billing_state'] ] . ', ' . $location_name;
				} else 
				$location_name = $c->states[ $posted['billing_country'] ][ $posted['billing_state'] ] . $location_name;
				
			}
		
		} else if ( ( isset( $posted['shiptobilling'] ) && '1' == $posted['shiptobilling'] ) ||  isset( $posted['ship_to_different_address'] ) && empty( $posted['ship_to_different_address'] ) ) {
			
			if ( isset( $posted['billing_country'] ) && !empty( $posted['billing_country'] ) ) 
				$location = $posted['billing_country'];
				
			$location_name = $c->countries[ $location ];
				
			if ( isset( $posted['billing_state'] ) && !empty( $posted['billing_state'] ) ) {
				
				if ( count( $c->states[ $location ] ) > 0 ) { 
					$location .= ':' . $posted['billing_state'];
					$location_name = $c->states[ $posted['billing_country'] ][ $posted['billing_state'] ] . ', ' . $location_name;
				} else
					$location_name = $c->states[ $posted['billing_country'] ][ $posted['billing_state'] ] . $location_name;
				
			}

			
		} else if ( isset( $posted['shipping_state'] ) && !empty( $posted['shipping_state'] ) ) {

			if ( isset( $posted['shipping_country'] ) && !empty( $posted['shipping_country'] ) ) 
				$location = $posted['shipping_country'];
//var_dump( $location ); die;
			$location_name = $c->countries[ $location ];
			
			if ( isset( $posted['shipping_state'] ) && !empty( $posted['shipping_state'] ) ) {
			
				if ( count( $c->states[ $location ] ) > 0 ) { 
					$location .= ':' . $posted['shipping_state'];
					$location_name = $c->states[ $posted['shipping_country'] ][ $posted['shipping_state'] ] . ', ' . $location_name;
				} else 
					$location_name = $c->states[ $posted['shipping_country'] ][ $posted['shipping_state'] ] . $location_name;
				
			}

		}

		$global_restrictions = get_option( 'woocommerce_ign_restrict_shipping_settings', array() );

		foreach( $cart as $k => $i ) {
			
			// action setting for product restrictions
			$setting = get_post_meta( $i['product_id'], 'apply_global_shipping_restrictions', true );

			if ( empty( $setting ) )
				$setting = 'override';
				
			// product restrictions
			$restricted_states = get_post_meta( $i['product_id'], 'restrict_states', true );

			// If override is set and the product settings are empty, then do not process restriction checking
			if ( 'override' == $setting && empty( $restricted_states ) )
				continue;
	
			if ( empty( $restricted_states ) )
				$restricted_states = array();
				
			// If merge is set then merge global restrictions ( if any ) with the product restrictions, and process if not empty			
			if ( 'merge' == $setting ) { 
			
				// Merge with global settings				
				$restricted_areas = (array)$global_restrictions[ 'restricted_areas' ];
			
				$restricted_states = array_unique( array_merge( $restricted_areas, $restricted_states ) );
			}

			// No restriction at all?  Continue to next product in the cart
			if ( empty( $restricted_states ) )
				continue;

			$show_message = false;
			
			// if there are no product based restrictions check the global restricted categories
			// but only if there are categories set, otherwise the global restrictions apply to all products
			// If there are restricted cats then restrictions ONLY apply to products in those categories
			
			$r = get_post_meta( $i['product_id'], 'restrict_states', true );
			
			if ( !empty( $global_restrictions['product_categories'] ) && empty( $r ) ) {
			
				// Is the product in a restricted category? 
				if ( empty( $i['product_id'] ) )
					continue;
					
				$terms = wp_get_post_terms( $i['product_id'], 'product_cat' );
				
				if ( empty( $terms ) || is_wp_error( $terms ) )
					continue;
				
				$restricted_cat = false;
				
				foreach( $terms as $t ) {

					if ( !in_array( $t->term_id, $global_restrictions['product_categories' ] ) )
						continue;

					$restricted_cat = true;
					
					break;
				}
				
				if ( $restricted_cat && in_array( $location, $restricted_states ) )
					$show_message = true;
				
			}


			if ( in_array( $location, $restricted_states ) ) {
			
				$show_message = true;
				
			}
			
			
			if ( $show_message ) {

				$title = get_the_title( $i['product_id'] );

				$cpid = woocommerce_get_page_id( 'cart' );

				$cpid = get_permalink( $cpid );

				$settings = get_option( 'woocommerce_ign_restrict_shipping_settings' );
		
				if ( empty( $settings['message'] ) )
					$msg = '<strong>We cannot ship "%p" to %d. Please <a href="%u">return to your cart</a> and remove the item, or change your shipping address</strong>';
				else
					$msg = $settings['message'];
					
				$msg = str_replace( '%p', $title, $msg );
				$msg = str_replace( '%d', $location_name, $msg );
				$msg = str_replace( '%u', $cpid, $msg );
				
				if ( function_exists( 'wc_add_notice' ) ) 
					wc_add_notice( $msg, 'error' );
				else 
					$woocommerce->add_error( $msg );
					
				$this->error_msg = $msg;
			}

		}
	
	}

}

$GLOBALS['ignitewoo_restrict_shipping'] = new IgniteWoo_Restrict_Shipping();


if ( ! function_exists( 'ignitewoo_queue_update' ) )
	require_once( dirname( __FILE__ ) . '/ignitewoo_updater/ignitewoo_update_api.php' );

$this_plugin_base = plugin_basename( __FILE__ );

add_action( "after_plugin_row_" . $this_plugin_base, 'ignite_plugin_update_row', 1, 2 );

ignitewoo_queue_update( plugin_basename( __FILE__ ), 'e4e2a2d0d047af189cda5e026c318eb4', '4867' );