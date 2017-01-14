<?php
/**
 * Plugins settings
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPL_Admin_Settings {

	protected $settings;

	/**
	 * Initialize settings
	 *
	 * @since     1.1.0
	 */
	public function __construct()
	{	
		global $woocommerce;
	
		$settings = $this->initialise_settings();		
		$this->settings = $settings;		
		
		//Settings
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_tab' ), 30 );
		add_action( 'woocommerce_update_options_purchase_limits', array( $this, 'save_settings' ) );
		if( version_compare( $woocommerce->version, 2.1, '<' ) ){ //Pre Woo 2.1
			add_action( 'woocommerce_settings_tabs_purchase_limits', array( $this, 'woo20_output_tabs_settings' ) );
			foreach( $settings as $section => $settings ){
				add_action( 'woocommerce_update_options_purchase_limits_' . $section, array( $this, 'save_settings' ) );
			}
		} else { //Woo 2.1
			add_action( 'woocommerce_sections_purchase_limits', array( $this, 'output_tabs_sections' ) );
			add_action( 'woocommerce_settings_purchase_limits', array( $this, 'output_tabs_settings' ) );
		}
		
		//Custom quantity limit field
		add_action( 'woocommerce_admin_field_wpl_quantity_limit',  array( $this, 'quantity_limit_field_output' ) );
		add_action( 'woocommerce_update_option_wpl_quantity_limit', array( $this, 'limit_field_save' ) );
		//Custom value limit field
        add_action( 'woocommerce_admin_field_wpl_value_limit',  array( $this, 'value_limit_field_output' ) );
		add_action( 'woocommerce_update_option_wpl_value_limit', array( $this, 'limit_field_save' ) );
	}
	
	/**
	 * Add purchase limits settings tab
	 *
	 * @filter	woocommerce_settings_tabs_array
	 * @since	1.2
	 */
	public function add_settings_tab( $tabs )
	{
		$tabs['purchase_limits'] = 'Purchase Limits';
		return $tabs;
	}
	
	public function output_tabs_sections()
	{ 	
		global $woocommerce;
	
		reset($this->settings);
		$current_section = ( empty( $_REQUEST['section'] ) ) ? key( $this->settings ) : sanitize_text_field( urldecode( $_REQUEST['section'] ) );
		
		//output section links
		$admin_url = ( version_compare( $woocommerce->version, 2.1, '<' ) ) ? admin_url('admin.php?page=woocommerce_settings&tab=purchase_limits') : admin_url('admin.php?page=wc-settings&tab=purchase_limits');
		$section_links = array();
		foreach( $this->settings as $section => $settings ){
			$title = ucwords( str_replace( '_', ' ', $section ) );
			$current = ( $section == $current_section ) ? 'class="current"' : '';
			$section_links[] = '<a href="' . add_query_arg( 'section', $section, $admin_url ) . '"' . $current . '>' . esc_html( $title ) . '</a>';
		}
		echo '<ul class="subsubsub"><li>' . implode( ' | </li><li>', $section_links ) . '</li></ul><br class="clear" /><hr />';
	}
	
	public function output_tabs_settings()
	{	
		reset($this->settings);
		$current_section = ( empty( $_REQUEST['section'] ) ) ? key( $this->settings ) : sanitize_text_field( urldecode( $_REQUEST['section'] ) );
		
		woocommerce_admin_fields( $this->settings[$current_section] );
	}
	
	/**
	 * Wrapper function for Woocommerce 2.0 to output tabs content - Sections and settings
	 *
	 * @action	woocommerce_settings_tabs_purchase_limits
	 * @since	1.2
	 */
	public function woo20_output_tabs_settings()
	{
		//output sections
		$this->output_tabs_sections();
		
		//output settings for current section
		$this->output_tabs_settings();
			
	}
	
	/**
	 * Save sections settings
	 *
	 * @action	woocommerce_update_options_purchase_limits
	 * @action	woocommerce_update_options_purchase_limits_$section
	 * @since	1.2
	 */
	public function save_settings()
	{	
		if( !function_exists( 'woocommerce_update_options' ) ) include trailingslashit( WP_PLUGIN_DIR ) . 'woocommerce/admin/settings/settings-save.php';
		
		$current_section = ( empty( $_REQUEST['section'] ) ) ? key( $this->settings ) : sanitize_text_field( urldecode( $_REQUEST['section'] ) );
		woocommerce_update_options( $this->settings[ $current_section ] );
	}
	
	/**
	 * Plugins settings options
	 *
	 * @since 1.0.0
 	 */
	private function initialise_settings()
	{
		// General settings
		$general_settings = array(
			array( 'title' => __( 'Cart page settings', 'woocommerce' ), 'type' => 'title','desc' => '', 'id' => 'cart_page_settings' ),
			
			array(
				'title'     => __( '', 'woocommerce' ),
                'desc'      => __( 'Show <img src="'.WPL_URI.'/assets/images/icon-exclamation.png" style="margin: 0 0 -3px 0;" /> next to each products name?', 'woocommerce' ),
                'desc_tip'  => __( 'Set whether to show the exclamation icon next to each product name that has an error.', 'woocommerce' ),
				'id'        => 'wpl_cart_page_show_product_error_icon',
				'default'   => 'yes',
				'type'      => 'checkbox'
            ),
            
            array(
                'title'     => __( 'Error message display', 'woocommerce' ),
                'desc'      => __( 'Use [error_list] to display the list of error. The text for each individual error type can be specified in the relevant limit section.', 'woocommerce' ),
                'desc_tip'  => __( 'Set how the error messages will be displayed.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_error_display',
                'css'       => 'width:100%; height: 65px;',
                'type'      => 'textarea',
                'default'   => sprintf( 'Please rectify the following errors before checking out:%s[error_list]', PHP_EOL )
            ),
			
			array( 'type' => 'sectionend', 'id' => 'cart_page_settings' ),
			
			/* Deprecated - 1.2
			array( 'title' => __( 'Cart widget settings', 'woocommerce' ), 'type' => 'title','desc' => '', 'id' => 'cart_widget_settings' ),
			
			array(
                'title'     => __( 'Cart widget error message', 'woocommerce' ),
                'desc'      => __( 'You can use HTML to add CSS classes to style the message. Leave blank to not display anything.', 'woocommerce' ),
                'desc_tip'  => __( 'This message will be shown at the bottom of the cart just above the cart buttons.', 'woocommerce' ),
                'id'        => 'wpl_cart_widget_error',
                'css'       => 'width:100%; height: 65px;',
                'type'      => 'textarea',
                'default'   => sprintf( 'Some parts of your cart do not meet the order limits set.  Please go to the cart page to rectify these errors.', PHP_EOL )
            ),
			
			array( 'type' => 'sectionend', 'id' => 'cart_widget_settings' ),
			*/
			
		);
		
		//Product limits settings
		$product_limits_settings = array(
			
			array( 'title' => __( 'Product quantity limits', 'woocommerce' ), 'type' => 'title','desc' => '', 'id' => 'product_quantity_limits' ),
            
			array(
				'title'     => __( '', 'woocommerce' ),
                'desc'      => __( 'Enable product quantity limits', 'woocommerce' ),
                'desc_tip'  => __( 'Select this to enable product quantity purchase limits for products in your store.', 'woocommerce' ),
				'id'        => 'wpl_product_quantity_limit_enabled',
				'default'   => 'no',
				'type'      => 'checkbox'
            ),
			
            array(
				'title'     => __( 'Global quantity limit setting', 'woocommerce' ),
				'id'        => 'wpl_product_quantity_limit_type',
				'type'      => 'radio',
                'default'   => 'global',
				'desc_tip'  =>  __( 'Select whether to use the global limit (below) or the individual product limit. <br />If set to \'global\' the limit can still be overridden in each products edit page.', 'woocommerce' ),
				'options'   => array(
					'global'        => __( 'Use global quantity limit (below) for all products', 'woocommerce' ),
					'individual'    => __( 'Use quantity limit defined in each individual product', 'woocommerce' )
				),
            ),
            
            array(
                'title'     => __( 'Global quantity limit', 'woocommerce' ),
                'desc_tip'  =>  __( 'This limit will be used if no limit is set in each individual product if the global setting is set to use the global limit.', 'woocommerce' ),
                'id'        => 'wpl_product_quantity_limit',
				'type'      => 'wpl_quantity_limit',
				'default'	=> array( 'min' => 0, 'max' => 0 )
            ),
            
            array( 'type' => 'sectionend', 'id' => 'product_quantity_limits' ),
			
			array( 'title' => __( 'Add to cart messages', 'woocommerce' ), 'type' => 'title','desc' => 'These message will be shown when a user adds a product to the cart but the limits set have not been satisfied.', 'id' => 'add_to_cart_messages' ),
			
			array(
				'title'     => __( '', 'woocommerce' ),
                'desc'      => __( 'Show \'<strong>Add remaining amount</strong>\' button with minimum product quantity not reached message', 'woocommerce' ),
                'desc_tip'  => __( 'This button will give the user the option of adding the remaining quantity for them to reach the minimum purchase limit to their cart.', 'woocommerce' ),
				'id'        => 'wpl_add_to_cart_min_product_quantity_error_show_button',
				'default'   => 'yes',
				'type'      => 'checkbox'
            ),
            
            array(
				'title'     => __( '\'Add remaining amount\' button text', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[product_name]</strong> to show the product name, <strong>[min_limit]</strong> to show the minimum purchase amount of this product or <strong>[needed_qty]</strong> to show the quantity needed to reach the limit.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The text of the \'Add remaining amount\' button.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_min_product_quantity_error_button_text',
                'default'   => __( 'Add [needed_qty] more?', 'woocommerce' ),
                'type'      => 'text',
                'css'       => 'width:40%;',
            ),
            
            array(
				'title'     => __( 'Product minimum quantity limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[product_name]</strong> to show the product name, <strong>[min_limit]</strong> to show the minimum purchase amount of this product or <strong>[needed_qty]</strong> to show the quantity needed to reach the limit.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when a product is added to the cart but the minimum purchase limit has not yet been reached.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_min_product_quantity_error',
                'default'   => __( 'Product successfully added to your cart but the minimum purchase amount ([min_limit]) has not yet been reached for this product.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
            
            array(
				'title'     => __( 'Product maximum quantity limit reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[product_name]</strong> to show the product name or <strong>[max_limit]</strong> to show the maximum purchase amount of this product.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when the user tries to add a product to the cart but has already reached the maximum purchase limit for his product.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_max_product_quantity_error',
                'default'   => __( 'You cannot add any more of this product to your cart because you have reached the maximum purchase limit ([max_limit]) for this product', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array( 'type' => 'sectionend', 'id' => 'add_to_cart_messages' ),
			
			array( 'title' => __( 'Cart page messages', 'woocommerce' ), 'type' => 'title','desc' => 'These messages will be shown on the cart page as a list at the top of the page. Use the settings below to specify the text of each error message. The actual display of the list can be set in the General settings section', 'id' => 'cart_page_messages' ),
			
			array(
				'title'     => __( 'Required product not in cart', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[product_name]</strong> to show the product name. The product name will be output as a link to the product page.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if a required product is not currently in the cart.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_product_required_error',
                'default'   => __( '[product_name] must be in your cart before you can checkout.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array(
				'title'     => __( 'Products minimum quantity limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[product_name]</strong> to show the product name, <strong>[min_limit]</strong> to show the minimum purchase amount of this product or <strong>[needed_qty]</strong> to show the quantity needed to reach the limit.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the quantity is below the products minimum purchase limit.<br /><br />[product_name] tag will be output as a link to the product page.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_min_product_quantity_error',
                'default'   => __( 'You must purchase a minimum of [min_limit] of [product_name].', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
            
            array(
				'title'     => __( 'Products maximum quantity limit reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[product_name]</strong> to show the product name or <strong>[max_limit]</strong> to show the maximum purchase amount of this product.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the quantity is above the products maximum purchase limit.<br /><br />[product_name] tag will be output as a link to the product page.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_max_product_quantity_error',
                'default'   => __( 'You cannot purchase more than [max_limit] of [product_name].', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array( 'type' => 'sectionend', 'id' => 'cart_page_messages' ),
			
		);
		
		//Cart limits settings
		$cart_limits_settings = array(
		
			array( 'title' => __( 'Cart quantity limits', 'woocommerce' ), 'type' => 'title','desc' => '', 'id' => 'cart_quantity_limits' ),
		
			array(
				'title'     => __( '', 'woocommerce' ),
                'desc'      => __( 'Enable cart quantity limits', 'woocommerce' ),
                'desc_tip'  => __( 'Select this to enable cart quantity limits for your store.', 'woocommerce' ),
				'id'        => 'wpl_cart_quantity_limit_enabled',
				'default'   => 'no',
				'type'      => 'checkbox'
			),
			
			array(
                'title'     => __( 'Cart quantity limit', 'woocommerce' ),
                'desc_tip'  =>  __( 'The limit for the total quantity of products in the cart.', 'woocommerce' ),
                'id'        => 'wpl_cart_quantity_limit',
				'type'      => 'wpl_quantity_limit',
				'default'	=> array( 'min' => 0, 'max' => 0 )
            ),
			
			array( 'type' => 'sectionend', 'id' => 'cart_quantity_limits' ),
		
			array( 'title' => __( 'Cart value limits', 'woocommerce' ), 'type' => 'title','desc' => '', 'id' => 'cart_value_limits' ),
            
            array(
				'title'     => __( '', 'woocommerce' ),
                'desc'      => __( 'Enable cart value limits', 'woocommerce' ),
                'desc_tip'  => __( 'Select this to enable cart value limits for your store.', 'woocommerce' ),
				'id'        => 'wpl_cart_value_limit_enabled',
				'default'   => 'no',
				'type'      => 'checkbox'
			),
			
			array(
                'title'     => __( 'Cart value limit', 'woocommerce' ),
                'desc_tip'  =>  __( 'This limit range the cart needs to be before the user can checkout.', 'woocommerce' ),
                'id'        => 'wpl_cart_value_limit',
                'type'      => 'wpl_value_limit',
				'default'	=> array( 'min' => 0, 'max' => 0 )
            ),
            
            array(
				'title'     => __( 'Apply cart value limit to', 'woocommerce' ),
				'id'        => 'wpl_cart_value_limit_type',
				'type'      => 'radio',
                'default'   => 'subtotal_exc_tax',
				'desc_tip'  =>  __( 'Select which cart value you want to apply the limit to.', 'woocommerce' ),
				'options'   => array(
							'subtotal_exc_tax'  => __( 'Subtotal excluding tax', 'woocommerce' ),
							'subtotal_inc_tax'  => __( 'Subtotal including tax', 'woocommerce' ),
							'cart_total'        => __( 'Total cart value', 'woocommerce' )
				),	
			),
            
            array( 'type' => 'sectionend', 'id' => 'cart_value_limits' ),
			
			array( 'title' => __( 'Add to cart messages', 'woocommerce' ), 'type' => 'title','desc' => 'These message will be shown when a user adds a product to the cart but the limits set have not been satisfied.', 'id' => 'add_to_cart_messages' ),
			
			array(
				'title'     => __( 'Quantity limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[min_limit]</strong> to show the minimum quantity limit that has been set or <strong>[needed_qty]</strong> to show the quantity needed to reach the limit</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when a product is added to the cart but the minimum cart quantity limit has not yet been reached.<br />This message will only show if there are no errors with the product quantity limits.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_min_cart_quantity_error',
                'default'   => __( 'Product successfully added to your cart but the minimum cart quantity limit ([min_limit]) has not yet been reached.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array(
				'title'     => __( 'Quantity limit reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[max_limit]</strong> to show the maximum quantity limit that has been set</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when the user tries to add a product to the cart but has already reached the maximum quantity limit for the cart.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_max_cart_quantity_error',
                'default'   => __( 'You cannot add any more of this product to your cart because you have reached the maximum cart quantity limit ([max_limit]) allowed.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array(
				'title'     => __( 'Value limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[min_limit]</strong> to show the minimum cart value limit that has been set.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when a product is added to the cart but the minimum cart value limit has not yet been reached.<br />This message will only show if there are no errors with the product quantity limits.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_min_cart_value_error',
                'default'   => __( 'Product successfully added to your cart but the minimum cart value limit ([min_limit]) has not yet been reached.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
            
            array(
				'title'     => __( 'Value limit reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[max_limit]</strong> to show the maximum cart value limit that has been set.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when the user tries to add products whoch value will cause the cart value to exceed the maximum cart value limit set.<br />This message will only show if there are no errors with the product quantity limits.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_max_cart_value_error',
                'default'   => __( 'You cannot add this product to your cart because it will exceed the maximum cart value limit ([max_limit]).', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array( 'type' => 'sectionend', 'id' => 'add_to_cart_messages' ),
			
			array( 'title' => __( 'Cart page messages', 'woocommerce' ), 'type' => 'title','desc' => 'These messages will be shown on the cart page as a list at the top of the page. Use the settings below to specify the text of each error message. The actual display of the list can be set in the General settings section', 'id' => 'cart_page_messages' ),
			
			array(
				'title'     => __( 'Quantity limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[min_limit]</strong> to show the minimum quantity limit that has been set or <strong>[needed_qty]</strong> to show the quantity needed to reach the limit</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the total quantity in the cart is less than the minimum cart quantity limit set.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_min_cart_quantity_error',
                'default'   => __( 'You must purchase a minimum of [min_limit] products.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array(
				'title'     => __( 'Quantity limit exceeded', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[max_limit]</strong> to show the maximum cart quantity limit that has been set.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the total quantity in the cart is greater than the maximum cart quantity limit set.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_max_cart_quantity_error',
                'default'   => __( 'You cannot purchase more than [max_limit] products.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array(
				'title'     => __( 'Value limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[min_limit]</strong> to show the minimum cart value limit that has been set.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the cart value is less than the minimum cart value limit set.<br />The minimum limit value will be diplayed using the currency display settings in Catalog & Pricing > Pricing Options.<br /><br />Remember to take into account which total you are applying the limits too i.e. subtotal with/without tax etc.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_min_cart_value_error',
                'default'   => __( 'You must purchase at least [min_limit] worth of products.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
            
            array(
				'title'     => __( 'Value limit exceeded', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[max_limit]</strong> to show the maximum cart value limit that has been set.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the cart value is greater than the maximum cart value limit set.<br />Note: The maximum limit value will be diplayed using the currency display settings in Catalog & Pricing > Pricing Options.<br /><br />Remember to take into account which total you are applying the limits too i.e. subtotal with/without tax etc.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_max_cart_value_error',
                'default'   => __( 'You cannot purchase more than [max_limit] worth of products.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array( 'type' => 'sectionend', 'id' => 'cart_page_messages' ),
		
		);
		
		$category_limits_settings = array(
		
			array( 'title' => __( 'Category quantity limits', 'woocommerce' ), 'type' => 'title','desc' => '', 'id' => 'category_quantity_limits' ),
			
			array(
				'title'     => __( '', 'woocommerce' ),
                'desc'      => __( 'Enable category quantity limits', 'woocommerce' ),
                'desc_tip'  => __( 'Select this to enable category quantity limits for your store.', 'woocommerce' ),
				'id'        => 'wpl_category_quantity_limit_enabled',
				'default'   => 'no',
				'type'      => 'checkbox'
			),
			
			array(
				'title'     => __( 'Global quantity limit setting', 'woocommerce' ),
				'id'        => 'wpl_category_quantity_limit_type',
				'type'      => 'radio',
                'default'   => 'individual',
				'desc_tip'  =>  __( 'Select whether to use the global limit (below) or the individual category limit. <br />If set to \'global\' the limit can still be overridden in each category edit page.', 'woocommerce' ),
				'options'   => array(
					'global'        => __( 'Use global quantity limit (below) for all categories', 'woocommerce' ),
					'individual'    => __( 'Use quantity limit defined in each individual category', 'woocommerce' )
				),
            ),
			
			array(
                'title'     => __( 'Global quantity limit', 'woocommerce' ),
                'desc_tip'  =>  __( 'The limit for the total quantity of products in the cart from each category. This will apply to all categories but can be overridden in each category edit page.', 'woocommerce' ),
                'id'        => 'wpl_category_quantity_limit',
				'type'      => 'wpl_quantity_limit',
				'default'	=> array( 'min' => 0, 'max' => 0 )
            ),
			
			array( 'type' => 'sectionend', 'id' => 'category_quantity_limits' ),
			
			array( 'title' => __( 'Category value limits', 'woocommerce' ), 'type' => 'title','desc' => '', 'id' => 'category_value_limits' ),
			
			array(
				'title'     => __( '', 'woocommerce' ),
                'desc'      => __( 'Enable category value limits', 'woocommerce' ),
                'desc_tip'  => __( 'Select this to enable category value limits for your store.', 'woocommerce' ),
				'id'        => 'wpl_category_value_limit_enabled',
				'default'   => 'no',
				'type'      => 'checkbox'
			),
			
			array(
				'title'     => __( 'Global value limit setting', 'woocommerce' ),
				'id'        => 'wpl_category_value_limit_type',
				'type'      => 'radio',
                'default'   => 'individual',
				'desc_tip'  =>  __( 'Select whether to use the global limit (below) or the individual category limit. <br />If set to \'global\' the limit can still be overridden in each category edit page.', 'woocommerce' ),
				'options'   => array(
					'global'        => __( 'Use global value limit (below) for all categories', 'woocommerce' ),
					'individual'    => __( 'Use value limit defined in each individual category', 'woocommerce' )
				),
            ),
			
			array(
                'title'     => __( 'Category value limit', 'woocommerce' ),
                'desc_tip'  =>  __( 'The value of the products in the cart for each category.', 'woocommerce' ),
                'id'        => 'wpl_category_value_limit',
                'type'      => 'wpl_value_limit',
				'default'	=> array( 'min' => 0, 'max' => 0 )
            ),
			
			array( 'type' => 'sectionend', 'id' => 'category_value_limits' ),
			
			array( 'title' => __( 'Add to cart messages', 'woocommerce' ), 'type' => 'title','desc' => 'These message will be shown when a user adds a product to the cart but the limits set have not been satisfied.', 'id' => 'add_to_cart_messages' ),
			
			array(
				'title'     => __( 'Quantity limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[category_name]</strong> to show the category name or <strong>[min_limit]</strong> to show the minimum quantity limit of this category</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when a product is added to the cart but the minimum quantity limit for the category of this product has not yet been reached.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_min_category_quantity_error',
                'default'   => __( 'Product successfully added to your cart but the minimum quantity limit ([min_limit]) for category [category_name] has not yet been reached.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
            
            array(
				'title'     => __( 'Quantity limit reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[category_name]</strong> to show the category name or <strong>[max_limit]</strong> to show the maximum quantity limit of this category</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when the user tries to add a product to the cart but has already reached the maximum quantity limit for the category of this product.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_max_category_quantity_error',
                'default'   => __( 'You cannot add this product to the cart because you have reached the maximum quantity limit ([max_limit]) for this products category.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array(
				'title'     => __( 'Value limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[category_name]</strong> to show the category name or <strong>[min_limit]</strong> to show the minimum category value limit that has been set.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when a product is added to the cart but the minimum category value limit has not yet been reached.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_min_category_value_error',
                'default'   => __( 'Product successfully added to your cart but the minimum category value limit ([min_limit]) for category [category_name] has not yet been reached.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
            
            array(
				'title'     => __( 'Value limit reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[category_name]</strong> to show the category name or <strong>[max_limit]</strong> to show the maximum category value limit that has been set.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'This message will show when the user tries to add products whose value will cause one of the products categories value to exceed the maximum category value limit set.', 'woocommerce' ),
                'id'        => 'wpl_add_to_cart_max_category_value_error',
                'default'   => __( 'You cannot add this product to your cart because it will exceed the maximum category value limit ([max_limit]) for category: [category_name].', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array( 'type' => 'sectionend', 'id' => 'add_to_cart_messages' ),
			
			array( 'title' => __( 'Cart page messages', 'woocommerce' ), 'type' => 'title','desc' => 'These messages will be shown on the cart page as a list at the top of the page. Use the settings below to specify the text of each error message. The actual display of the list can be set in the General settings section', 'id' => 'cart_page_messages' ),
			
			array(
				'title'     => __( 'Product from required category not in cart', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[category_name]</strong> to show the category name. The category name will be output as a link to the category page.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if there are no products in the cart from a required category.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_category_required_error',
                'default'   => __( 'A product from the [category_name] category must be in your cart before you can checkout.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array(
				'title'     => __( 'Quantity limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[category_name]</strong> to show the category name or <strong>[min_limit]</strong> to show the minimum quantity limit of this category</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the minimum quantity limit for a category has not been reached.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_min_category_quantity_error',
                'default'   => __( 'You must purchase a minimum of [min_limit] products from the [category_name] category.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
            
            array(
				'title'     => __( 'Quantity limit reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[category_name]</strong> to show the product name or <strong>[max_limit]</strong> to show the maximum quantity limit of this category.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the maximum quantity limit for a category has been reached.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_max_category_quantity_error',
                'default'   => __( 'You cannot purchase more than [max_limit] products from the [category_name] category.', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array(
				'title'     => __( 'Value limit not reached', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[category_name]</strong> to show the category name or <strong>[min_limit]</strong> to show the minimum category value limit that has been set.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the category value for products in the cart is less than the minimum category value limit set.<br />The minimum limit value will be displayed using the currency display settings in Catalog & Pricing > Pricing Options.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_min_category_value_error',
                'default'   => __( 'You must purchase at least [min_limit] worth of products from category: [category_name].', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
            
            array(
				'title'     => __( 'Value limit exceeded', 'woocommerce' ),
                'desc'      => __( '<p>Use <strong>[category_name]</strong> to show the category name or <strong>[max_limit]</strong> to show the maximum cart value limit that has been set.</p>', 'woocommerce' ),
                'desc_tip'  => __( 'The error message that will be shown if the category value for products in the cart is greater than the maximum category value limit set.<br />Note: The maximum limit value will be displayed using the currency display settings in Catalog & Pricing > Pricing Options.<br /><br />Used when creating the error list in General Settings > Error message display.', 'woocommerce' ),
                'id'        => 'wpl_cart_page_max_category_value_error',
                'default'   => __( 'You cannot purchase more than [max_limit] worth of products from category: [category_name].', 'woocommerce' ),
                'type'      => 'textarea',
                'css'       => 'width:100%; height: 65px;',
            ),
			
			array( 'type' => 'sectionend', 'id' => 'cart_page_messages' ),
			
		);
		
		//master settings array
		$settings = array(
            'general_settings' => $general_settings,
			'product_limits' => $product_limits_settings,
			'cart_limits' => $cart_limits_settings,
			'category_limits' => $category_limits_settings
        );
		
		return $settings;
	}
	 
	/**
     * Output quantity limit range fields
	 *
     * @global	$woocommerce
     * @param	$value 
	 *
	 * @action	woocommerce_admin_field_wpl_quantity_limit
	 * @since	1.0.0
     */
    public function quantity_limit_field_output( $value )
    {
		extract($value);
        
		global $woocommerce;
        
		$tip = '<img class="help_tip" data-tip="' . esc_attr( $desc_tip ) . '" src="' . $woocommerce->plugin_url() . '/assets/images/help.png" height="16" width="16" />';
        $limit = woocommerce_settings_get_option( $id, $default );
		
		include_once 'views/settings-quantity-limit-field.phtml';
		
    }
	
	/**
     * Output value limit range fields
	 *
     * @global	$woocommerce
     * @param	$value 
	 *
	 * @action	woocommerce_admin_field_wpl_value_limit
	 * @since	1.0.0
     */
	public function value_limit_field_output( $value )
    {
		extract($value);
		
        global $woocommerce;

        $tip = '<img class="help_tip" data-tip="' . esc_attr( $desc_tip ) . '" src="' . $woocommerce->plugin_url() . '/assets/images/help.png" height="16" width="16" />';
        $limit = woocommerce_settings_get_option( $id, $default );

        include_once 'views/settings-value-limit-field.phtml';
		
    }
	
	/**
     * Save quantity and value limit fields
	 *
     * @param	$value 
	 *
	 * @action	woocommerce_update_option_wpl_value_limit
	 * @since	1.0.0
     */
	function limit_field_save( $value ){
		
		if ( empty( $_POST ) ) return false;
		
		extract($value);
		 
		if( $id == 'wpl_product_quantity_limit' ){ //product quantity limit
			
			//make sure values are ints and not negative
			$_POST[ $id ]['min'] = ( (int)$_POST[ $id ]['min'] < 0 ) ? 0 : (int)$_POST[ $id ]['min']; //cast it
			$_POST[ $id ]['max'] = ( (int)$_POST[ $id ]['max'] < 0 ) ? 0 : (int)$_POST[ $id ]['max']; //cast it
			
			if( $_POST[ $id ]['max'] != 0 ) if( $_POST[ $id ]['min'] > $_POST[ $id ]['max'] ) $_POST[ $id ]['max'] = 0;
			
		} elseif( $value['id'] == 'wpl_cart_value_limit' ){ //cart value limit
		
			$num_decimals    = (int) get_option( 'woocommerce_price_num_decimals' );
		
			//make sure values are float and not negative
			$_POST[ $id ]['min'] = ( (float)$_POST[ $id ]['min'] < 0 ) ? 0 : (float)$_POST[ $id ]['min']; //cast it
			$_POST[ $id ]['max'] = ( (float)$_POST[ $id ]['max'] < 0 ) ? 0 : (float)$_POST[ $id ]['max'];
			
			//format to the same number of decimals places as is in settings (catalog -> pricing options)
			$_POST[ $id ]['min'] = (float)preg_replace( '/([\d,]+.\d{'.$num_decimals.'})\d+/', '$1', $_POST[ $id ]['min'] );
			$_POST[ $id ]['max'] = (float)preg_replace( '/([\d,]+.\d{'.$num_decimals.'})\d+/', '$1', $_POST[ $id ]['max'] );

			//if min greater than max, make max 0
			if( $_POST[ $id ]['max'] != 0 ) if( $_POST[ $id ]['min'] > $_POST[ $id ]['max'] ) $_POST[ $id ]['max'] = 0;
			
		}
		
		update_option( $id, $_POST[ $id ] );

	}

}
new WPL_Admin_Settings();