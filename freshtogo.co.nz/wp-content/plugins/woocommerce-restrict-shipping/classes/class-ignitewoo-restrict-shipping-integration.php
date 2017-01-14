<?php
/**
Copyright (c) 2012 - 2013 - IgniteWoo - ALL RIGHTS RESERVED
*/
if ( !defined( 'ABSPATH' ) )
	die( '404 - Not Found' );
	
add_filter( 'ignitewoo_integrations', 'ignitewoo_ignitewoo_restrict_shipping_integration', 999 );

function ignitewoo_ignitewoo_restrict_shipping_integration( $integrations ) {

	$integrations[] = 'IgniteWoo_Restrict_Shipping_Settings';
	
	return $integrations;
}

class IgniteWoo_Restrict_Shipping_Settings extends IGN_Integration {


	function __construct() {

		$this->id = 'ign_restrict_shipping';

		$this->method_title = __( 'Restrict Shipping', 'ignitewoo_restrict_shipping' );

		$this->method_description = __( 'Adjust the settings before using this plugin. Documentation is on our site at <a href="http://ignitewoo.com" target="_blank">IgniteWoo.com</a>', 'ignitewoo_restrict_shipping' );

		$this->init_form_fields();

		$this->init_settings();

		add_action( 'woocommerce_update_options_ignitewoo_' . $this->id , array( &$this, 'process_admin_options' ), 1 );

		add_action( 'woocommerce_settings_save_ignitewoo', array( &$this, 'process_admin_options' ), 1 );
		
	}
	

	
	function init_form_fields() {
		global $ignitewoo_woo2go;
		
		$opts = get_option( 'woocommerce_ign_restrict_shipping_settings' );
		
		// Options never set so enable automatically
		if ( empty( $opts ) ) { 
		
			$opts['enable'] = 'yes';
			
			$opts['restricted_areas'] = $opts['product_categories'] = array();
		
			update_option( 'woocommerce_ign_restrict_shipping_settings', $opts );
			
		}
		
		$this->form_fields = apply_filters('ign_restrict_shipping_settings_fields', array(
			'enable' => array(
				'title' => __( 'Enable', 'ignitewoo_restrict_shipping' ),
				'desc' => __( 'Enable', 'ignitewoo_restrict_shipping' ),
				'type'  => 'checkbox',
				'default' => 'no'
			),
			'message' => array(
				'title' => __( 'Message Text', 'ignitewoo_restrict_shipping' ),
				'description' => __( 'Enter the message string to show shoppers when an item in the cart cannot be shipped to their location. Use %p for the product name, use %d for the restricted destination, use %u for the cart page URL', 'ignitewoo_restrict_shipping' ),
				'type'  => 'text',
				'default' => '<strong>We cannot ship "%p" to %d. Please <a href="%u">return to your cart</a> and remove the item, or change your shipping address</strong>'
			),
			/*
			'exception' => array(
				'title' => __( 'Exception', 'ignitewoo_restrict_shipping' ),
				'desc' => __( 'Enable', 'ignitewoo_restrict_shipping' ),
				'type'  => 'select',
				'options' => array(
					'all_products_except' => __( 'Apply to ALL products except', 'ignitewoo_restrict_shipping' ),
					'no_products_except' => __( 'Apply to NO products except', 'ignitewoo_restrict_shipping' ),
				)
			)
			*/
		));

	}
	
	
	function admin_options() { 
		?>
		
		<script>
		jQuery( document ).ready( function() { 
			jQuery( '.chosen' ).chosen();
		});
		</script>
		
		<?php
		
		parent::admin_options();
		
		$opts = get_option( 'woocommerce_ign_restrict_shipping_settings', false );

		$restrict_areas = $opts[ 'restricted_areas' ];
		
		if ( empty( $restrict_areas ) )
			$restrict_areas = array();
		
		$c = new WC_Countries();
		
		?>
		
		<table class="form-table">
		<tr valign="top">
			<th class="titledesc" scope="row"><?php _e( 'Select Restricted Locations', 'ignitewoo_restrict_shipping' )?></th>
			<td>
			<select name="restricted_areas[]" multiple="multiple" class="chosen_select">
			<?php
			
			foreach( $c->countries as $k => $v ) {

				if ( count( $c->states[ $k ] ) > 0 ) { 
				
					echo '<optgroup label="' . $v . '">'; 
					
					foreach( $c->states[ $k ] as $kk => $vv ) { 

						if ( in_array( $k . ':' . $kk, (array)$restrict_areas ) )
							$selected = ' selected="selected"';
						else
							$selected = '';
							
						echo '<option value="' . $k . ':' . $kk . '" ' . $selected . '>' . $vv . '</option>';
					}
					
					
					echo '</optgroup>';
					
					if ( 'US' !== $k )
						$state_groups[] = array( 'name' => $k, 'label' => $v, 'states' => $c->states[ $k ] );
				
				} else { 
				
					if ( in_array( $k, (array)$restrict_areas ) )
						$selected = ' selected="selected"';
					else
						$selected = '';
						
					echo '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
					
				}
			
			}
			
			?>
			</select>
			
			<p><button class="select_all button"><?php _e('All', 'ignitewoo_table_rate'); ?></button><button class="select_none button"><?php _e('None', 'ignitewoo_table_rate'); ?></button>
			<?php for ( $i = 0; $i < count( $state_groups ); $i++ )  { ?>
			
				<button id="<?php echo str_replace( ' ', '-', $state_groups[$i]['label'] )?>" class="select_all_states button"><?php _e( $state_groups[ $i ]['label'], 'ignitewoo_table_rate'); ?></button>
			
			<?php } ?>
			<button class="button select_us_states"><?php _e('US States', 'ignitewoo_table_rate'); ?></button>
			<button class="button select_europe"><?php _e('EU States', 'ignitewoo_table_rate'); ?></button>
			</p>
			
			</td>
		</tr>
		<tr>
			<th>
				<label for="product_ids"><?php _e( 'Product categories', 'woocommerce' ); ?></label>
			</th>
			<td>
				<?php 
					$category_ids = isset( $this->settings['product_categories'] ) ?  $this->settings['product_categories'] : array(); 
				?>
				
				<select id="product_categories" name="product_categories[]" class="chosen_select" multiple="multiple" data-placeholder="<?php _e( 'Any category', 'ignitewoo_restrict_shipping' ); ?>">
					<?php

						$categories = get_terms( 'product_cat', 'orderby=name&hide_empty=0' );
						
						if ( $categories ) foreach ( $categories as $cat ) {
							echo '<option value="' . esc_attr( $cat->term_id ) . '"' . selected( in_array( $cat->term_id, $category_ids ), true, false ) . '>' . esc_html( $cat->name ) . '</option>';
						}
					?>
				</select>
				
				<p><?php _e( 'If any products in the cart are in the selected categories then those items cannot be shipped to the global restricted areas. This only applies when none of your products do not have per-product restrictions set!', 'ignitewoo_restrict_shipping' ); ?></p>
			</td>
		</tr>
		</table>

		<?php

		$GLOBALS['ignitewoo_restrict_shipping']->add_inline_js();

	}
	
	
	function process_admin_options() { 
		global $current_section, $current_tab;

		if ( $this->id !== $current_section )
			return;

		parent::process_admin_options();
		
		$opts = get_option( 'woocommerce_ign_restrict_shipping_settings', false );
				
		$opts['product_categories'] = isset( $_POST['product_categories'] ) ? $_POST['product_categories'] : '';
		
		$opts['restricted_areas'] = isset( $_POST['restricted_areas'] ) ? $_POST['restricted_areas'] : '';

		update_option( 'woocommerce_ign_restrict_shipping_settings', $opts );
	
	}
	
}

