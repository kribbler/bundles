<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Comparison Page Close Window Button Settings

TABLE OF CONTENTS

- var parent_tab
- var subtab_data
- var option_name
- var form_key
- var position
- var form_fields
- var form_messages

- __construct()
- subtab_init()
- set_default_settings()
- get_settings()
- subtab_data()
- add_subtab()
- settings_form()
- init_form_fields()

-----------------------------------------------------------------------------------*/

class WC_Compare_Close_Window_Button_Settings extends WC_Compare_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'comparison-page';
	
	/**
	 * @var array
	 */
	private $subtab_data;
	
	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = 'woo_compare_close_window_button_style';
	
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'woo_compare_close_window_button_style';
	
	/**
	 * @var string
	 * You can change the order show of this sub tab in list sub tabs
	 */
	private $position = 9;
	
	/**
	 * @var array
	 */
	public $form_fields = array();
	
	/**
	 * @var array
	 */
	public $form_messages = array();
	
	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->init_form_fields();
		$this->subtab_init();
		
		$this->form_messages = array(
				'success_message'	=> __( 'Close Window Button Settings successfully saved.', 'woo_cp' ),
				'error_message'		=> __( 'Error: Close Window Button Settings can not save.', 'woo_cp' ),
				'reset_message'		=> __( 'Close Window Button Settings successfully reseted.', 'woo_cp' ),
			);
			
		add_action( $this->plugin_name . '-' . $this->parent_tab . '_tab_end', array( $this, 'include_script' ) );
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* subtab_init() */
	/* Sub Tab Init */
	/*-----------------------------------------------------------------------------------*/
	public function subtab_init() {
		
		add_filter( $this->plugin_name . '-' . $this->parent_tab . '_settings_subtabs_array', array( $this, 'add_subtab' ), $this->position );
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* set_default_settings()
	/* Set default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function set_default_settings() {
		global $wc_compare_admin_interface;
		
		$wc_compare_admin_interface->reset_settings( $this->form_fields, $this->option_name, false );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* get_settings()
	/* Get settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function get_settings() {
		global $wc_compare_admin_interface;
		
		$wc_compare_admin_interface->get_settings( $this->form_fields, $this->option_name );
	}
	
	/**
	 * subtab_data()
	 * Get SubTab Data
	 * =============================================
	 * array ( 
	 *		'name'				=> 'my_subtab_name'				: (required) Enter your subtab name that you want to set for this subtab
	 *		'label'				=> 'My SubTab Name'				: (required) Enter the subtab label
	 * 		'callback_function'	=> 'my_callback_function'		: (required) The callback function is called to show content of this subtab
	 * )
	 *
	 */
	public function subtab_data() {
		
		$subtab_data = array( 
			'name'				=> 'close-window-button',
			'label'				=> __( 'Close Window Button', 'woo_cp' ),
			'callback_function'	=> 'wc_compare_close_window_button_settings_form',
		);
		
		if ( $this->subtab_data ) return $this->subtab_data;
		return $this->subtab_data = $subtab_data;
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* add_subtab() */
	/* Add Subtab to Admin Init
	/*-----------------------------------------------------------------------------------*/
	public function add_subtab( $subtabs_array ) {
	
		if ( ! is_array( $subtabs_array ) ) $subtabs_array = array();
		$subtabs_array[] = $this->subtab_data();
		
		return $subtabs_array;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* settings_form() */
	/* Call the form from Admin Interface
	/*-----------------------------------------------------------------------------------*/
	public function settings_form() {
		global $wc_compare_admin_interface;
		
		$output = '';
		$output .= $wc_compare_admin_interface->admin_forms( $this->form_fields, $this->form_key, $this->option_name, $this->form_messages );
		
		return $output;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {
		
  		// Define settings			
     	$this->form_fields = apply_filters( $this->option_name . '_settings_fields', array(
			
			array(
            	'name' 		=> __( 'Close Window Button / Hyperlink', 'woo_cp' ),
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Button or Hyperlink Type', 'woo_cp' ),
				'id' 		=> 'close_button_type',
				'class' 	=> 'close_button_type',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'button',
				'checked_value'		=> 'button',
				'unchecked_value'	=> 'link',
				'checked_label'		=> __( 'Button', 'woo_cp' ),
				'unchecked_label' 	=> __( 'Hyperlink', 'woo_cp' ),
			),
			
			array(
            	'name' 		=> __( 'Compare Table Close Window Hyperlink Styling', 'woo_cp' ),
                'type' 		=> 'heading',
          		'class'		=> 'comparison_page_close_window_hyperlink_styling_container'
           	),
			array(  
				'name' 		=> __( 'Hyperlink Text', 'woo_cp' ),
				'id' 		=> 'close_link_text',
				'type' 		=> 'text',
				'default'	=> __('Close window', 'woo_cp')
			),
			array(  
				'name' 		=> __( 'Hyperlink Font', 'woo_cp' ),
				'id' 		=> 'close_link_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '14px', 'face' => 'Arial, sans-serif', 'style' => 'bold', 'color' => '#21759B' )
			),
			array(  
				'name' 		=> __( 'Hyperlink Hover Colour', 'woo_cp' ),
				'id' 		=> 'close_link_font_hover_colour',
				'type' 		=> 'color',
				'default'	=> '#D54E21'
			),
			
			array(
            	'name' 		=> __( 'Compare Table Close Window Button Styling', 'woo_cp' ),
                'type' 		=> 'heading',
          		'class' 	=> 'comparison_page_close_window_button_styling_container'
           	),
			array(  
				'name' 		=> __( 'Button Text', 'woo_cp' ),
				'id' 		=> 'button_text',
				'type' 		=> 'text',
				'default'	=> __('Close window', 'woo_cp')
			),
			array(  
				'name' 		=> __( 'Button Padding', 'woo_cp' ),
				'desc' 		=> __( 'Padding from Button text to Button border', 'woo_cp' ),
				'id' 		=> 'close_button_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'close_button_padding_tb',
	 										'name' 		=> __( 'Top/Bottom', 'woo_cp' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '7' ),
	 
	 								array(  'id' 		=> 'close_button_padding_lr',
	 										'name' 		=> __( 'Left/Right', 'woo_cp' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '8' ),
	 							)
			),
			array(  
				'name' 		=> __( 'Background Colour', 'woo_cp' ),
				'desc' 		=> __( 'Default', 'woo_cp' ) . ' [default_value]',
				'id' 		=> 'button_bg_colour',
				'type' 		=> 'color',
				'default'	=> '#476381'
			),
			array(  
				'name' 		=> __( 'Background Colour Gradient From', 'woo_cp' ),
				'desc' 		=> __( 'Default', 'woo_cp' ) . ' [default_value]',
				'id' 		=> 'button_bg_colour_from',
				'type' 		=> 'color',
				'default'	=> '#538bbc'
			),
			
			array(  
				'name' 		=> __( 'Background Colour Gradient To', 'woo_cp' ),
				'desc' 		=> __( 'Default', 'woo_cp' ) . ' [default_value]',
				'id' 		=> 'button_bg_colour_to',
				'type' 		=> 'color',
				'default'	=> '#476381'
			),
			array(  
				'name' 		=> __( 'Button Border', 'woo_cp' ),
				'id' 		=> 'button_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#476381', 'corner' => 'rounded' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(  
				'name' 		=> __( 'Button Font', 'woo_cp' ),
				'id' 		=> 'button_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'face' => 'Arial, sans-serif', 'style' => 'bold', 'color' => '#FFFFFF' )
			),
			array(  
				'name' 		=> __( 'Button Shadow', 'woo_cp' ),
				'id' 		=> 'close_button_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '5px' , 'v_shadow' => '5px', 'blur' => '2px' , 'spread' => '2px', 'color' => '#999999', 'inset' => '' )
			),
			
        ));
	}
	
	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
		
	if ( $("input.close_button_type:checked").val() == 'button') {
		//$(".comparison_page_close_window_button_styling_container").css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} );
		//$(".comparison_page_close_window_hyperlink_styling_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden'} );
		$(".comparison_page_close_window_button_styling_container").slideDown();
		$(".comparison_page_close_window_hyperlink_styling_container").slideUp();
	} else {
		//$(".comparison_page_close_window_button_styling_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden'} );
		//$(".comparison_page_close_window_hyperlink_styling_container").css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} );
		$(".comparison_page_close_window_button_styling_container").slideUp();
		$(".comparison_page_close_window_hyperlink_styling_container").slideDown();
	}
		
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.close_button_type', function( event, value, status ) {
		//$(".comparison_page_close_window_button_styling_container").hide().css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} );
		//$(".comparison_page_close_window_hyperlink_styling_container").hide().css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} );
		if ( status == 'true') {
			$(".comparison_page_close_window_button_styling_container").slideDown();
			$(".comparison_page_close_window_hyperlink_styling_container").slideUp();
		} else {
			$(".comparison_page_close_window_button_styling_container").slideUp();
			$(".comparison_page_close_window_hyperlink_styling_container").slideDown();
		}
	});
});
})(jQuery);
</script>
    <?php	
	}
}

global $wc_compare_close_window_button_settings;
$wc_compare_close_window_button_settings = new WC_Compare_Close_Window_Button_Settings();

/** 
 * wc_compare_close_window_button_settings_form()
 * Define the callback function to show subtab content
 */
function wc_compare_close_window_button_settings_form() {
	global $wc_compare_close_window_button_settings;
	$wc_compare_close_window_button_settings->settings_form();
}

?>