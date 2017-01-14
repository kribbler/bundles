<?php

/**
 * Theme options
 *
 * @package framework
 * @since framework 1.0
 */
/**
 * Initialize the options before anything else.
 */
add_action('admin_init', 'ts_custom_theme_options', 1);

/**
 * Initalize theme options scripts
 */
add_action('admin_enqueue_scripts', 'ts_framework_theme_options_scripts');

function ts_framework_theme_options_scripts() {
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_style('jquery-ui-my-theme', get_template_directory_uri() . "/framework/css/jquery-ui/jquery.ui.my-theme.css", false);
	
	wp_register_script('theme_options', get_template_directory_uri() . '/framework/js/theme-options.js', array('jquery'));
	wp_enqueue_script('theme_options');
	
	wp_register_script('screwdefaultbuttons', get_template_directory_uri() . '/framework/js/jquery.screwdefaultbuttonsV2.min.js', array('jquery'));
	wp_enqueue_script('screwdefaultbuttons');
}

/**
 * Build the custom settings & update OptionTree.
 */
function ts_custom_theme_options() {
	/**
	 * Get a copy of the saved settings array. 
	 */
	$saved_settings = get_option('option_tree_settings', array());
	
	$user_sidebars = ot_get_option('user_sidebars');
	$sidebar_choices = array();
	$sidebar_choices[] = array(
		'label' => __('Main', 'framework'),
		'value' => 'main',
		'src' => ''
	);
	if (is_array($user_sidebars)) {
		foreach ($user_sidebars as $sidebar) {
			$sidebar_choices[] = array(
				'label' => $sidebar['title'],
				'value' => sanitize_title($sidebar['title']),
				'src' => ''
			);
		}
	}
	
	/**
	 * Custom settings array that will eventually be 
	 * passes to the OptionTree Settings API Class.
	 */
	$custom_settings = array(
		'sections' => array(
			array(
				'id' => 'general_settings',
				'title' => __('General Settings', 'framework')
			),
			array(
				'id' => 'fonts',
				'title' => __('Fonts', 'framework')
			),
			array(
				'id' => 'elements_color',
				'title' => __('Elements Color', 'framework')
			),
			array(
				'id' => 'pages',
				'title' => __('Pages', 'framework')
			),
			array(
				'id' => 'sidebars',
				'title' => __('Sidebars', 'framework')
			),
			array(
				'id' => 'integration',
				'title' => __('Integration', 'framework')
			),
			array(
				'id' => 'social',
				'title' => __('Contacts & Social', 'framework')
			),
			array(
				'id' => 'contact_form',
				'title' => __('Contact Form', 'framework')
			),
			array(
				'id' => 'translations',
				'title' => __('Translations', 'framework')
			)
		),
		//general_settings
		'settings' => array(
			array(
				'id' => 'body_class',
				'label' => __('Body class', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'w1170',
						'label' => __('Wide 1170px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'w960',
						'label' => __('Wide 960px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'b1170',
						'label' => __('Boxed 1170px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'b960',
						'label' => __('Boxed 960px', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'logo_url',
				'label' => __('Custom logo', 'framework'),
				'desc' => __('Enter full URL of your logo image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'favicon',
				'label' => __('Favicon', 'framework'),
				'desc' => __('Enter Full URL of your favicon image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'background_color',
				'label' => __('Background color', 'framework'),
				'desc' => __('Enabled only when boxed layout is selected', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'background_pattern',
				'label' => __('Background pattern', 'framework'),
				'desc' => __('Enabled only when boxed layout is selected', 'framework'),
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_background_patterns()
			),
			array(
				'id' => 'background_image',
				'label' => __('Background image', 'framework'),
				'desc' => __('Choose "Image" option on "Background pattern" list and boxed layout to enable background', 'framework'),
				'std' => '',
				'type' => 'Upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'background_repeat',
				'label' => __('Background repeat', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'repeat',
						'label' => __('Repeat horizontally & vertically', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'repeat-x',
						'label' => __('Repeat horizontally', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'repeat-y',
						'label' => __('Repeat vertically', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no-repeat',
						'label' => __('No repeat', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'background_position',
				'label' => __('Background position', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'left',
						'label' => __('Left', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'center',
						'label' => __('Center', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'right',
						'label' => __('Right', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'background_attachment',
				'label' => __('Background attachment', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'scroll',
						'label' => __('Scroll', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'fixed',
						'label' => __('Fixed', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'background_size',
				'label' => __('Background size', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'original',
						'label' => __('Original', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'browser',
						'label' => __('Fits to browser size', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'content_background_pattern',
				'label' => __('Content background pattern', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'no-background',
						'label' => __('No background', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pattern-one',
						'label' => __('Pattern 1', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pattern-two',
						'label' => __('Pattern 2', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pattern-three',
						'label' => __('Pattern 3', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pattern-four',
						'label' => __('Pattern 4', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pattern-five',
						'label' => __('Pattern 5', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pattern-six',
						'label' => __('Pattern 6', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pattern-seven',
						'label' => __('Pattern 7', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pattern-eight',
						'label' => __('Pattern 8', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pattern-nine',
						'label' => __('Pattern 9', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'footer_background_pattern',
				'label' => __('Footer background pattern', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'default-background',
						'label' => __('Default', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'diagmonds',
						'label' => __('Diagmonds', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'color',
						'label' => __('Color (Elements Color tab)', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'footer_text',
				'label' => __('Copyright text', 'framework'),
				'desc' => __('You can add copyright text here.', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'footer_text_centered',
				'label' => __('Copyright text centered', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-off',
				'choices' => array(
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'show_footer',
				'label' => __('Show footer', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'show_footer_arrow',
				'label' => __('Arrow Option of the footer', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'main_menu_style',
				'label' => __('Main menu style', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_header_styles()
			),
			array(
				'id' => 'show_preheader',
				'label' => __('Show preheader', 'framework'),
				'desc' => __('Show or hide preheader', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-off',
				'choices' => array(
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'preheader',
				'label' => __('Preheader items', 'framework'),
				'type' => 'list-item',
				'desc' => __('List of user defined preheader items. Please use "save changes" button after you add or edit items.', 'framework'),
				'settings' => array(
					array(
						'id' => 'float',
						'label' => __('Item float', 'framework'),
						'desc' => '',
						'std' => '',
						'type' => 'Select',
						'choices' => array(
							array(
								'value' => 'left',
								'label' => __('Left', 'framework'),
								'src' => ''
							),
							array(
								'value' => 'right',
								'label' => __('Right', 'framework'),
								'src' => ''
							)
						)
					),
					array(
						'label' => __('Type', 'framework'),
						'id' => 'type',
						'type' => 'select',
						'desc' => '',
						'std' => '',
						'type' => 'Select',
						'choices' => ts_get_preheader_types()
					),
					array(
						'label' => __('Icon (text and date type only)', 'framework'),
						'id' => 'icon',
						'type' => 'select',
						'desc' => '',
						'std' => '',
						'type' => 'Select',
						'choices' => ts_getFontAwesomeArray(true,null,true)
					),
					array(
						'id' => 'text',
						'label' => __('Text (text type only)', 'framework'),
						'desc' => '',
						'std' => '',
						'type' => 'text',
						'rows' => '',
						'post_type' => '',
						'taxonomy' => '',
						'class' => ''
					),
					array(
						'id' => 'url',
						'label' => __('URL (text type only)', 'framework'),
						'desc' => '',
						'std' => '',
						'type' => 'text',
						'rows' => '',
						'post_type' => '',
						'taxonomy' => '',
						'class' => ''
					),
					array(
						'id' => 'target',
						'label' => __('Target (text type only)', 'framework'),
						'desc' => '',
						'std' => '',
						'type' => 'select',
						'rows' => '',
						'post_type' => '',
						'taxonomy' => '',
						'class' => '',
						'choices' => array(
							array(
								'value' => '_blank',
								'label' => __('_blank', 'framework'),
								'src' => ''
							),
							array(
								'value' => '_parent',
								'label' => __('_parent', 'framework'),
								'src' => ''
							),
							array(
								'value' => '_self',
								'label' => __('_self', 'framework'),
								'src' => ''
							),
							array(
								'value' => '_top',
								'label' => __('_top', 'framework'),
								'src' => ''
							)
						)
					),
					
				),
				'std' => '',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'section' => 'general_settings'
			),
			array(
				'id' => 'show_breadcrumbs',
				'label' => __('Show breadcrumbs', 'framework'),
				'desc' => __('Show or hide breadcrumbs', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'show_search_nav',
				'label' => __('Show search icon in navigation', 'framework'),
				'desc' => __('Show or hide search form right to the main navigation', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'retina_support',
				'label' => __('Retina support', 'framework'),
				'desc' => __('If enabled all images should be uploaded 2x larger. Requires more server resources if enabled.', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-off',
				'choices' => array(
					array(
						'value' => 'disabled',
						'label' => __('Disabled', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'enabled',
						'label' => __('Enabled', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'control_panel',
				'label' => __('Show control panel', 'framework'),
				'desc' => __('Shows the Control Panel on your homepage if enabled.', 'framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'disabled',
						'label' => __('Disabled', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'enabled_admin',
						'label' => __('Enabled for administrator', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'enabled_all',
						'label' => __('Enabled for all', 'framework'),
						'src' => ''
					)
				)
			),
			//fonts
			array(
				'id' => 'character_sets',
				'label' => __('Additional character sets', 'framework'),
				'desc' => __('Choose the character sets you want to download from Google Fonts','framework'),
				'std' => '',
				'type' => 'checkbox',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'cyrillic',
						'label' => __('Cyrillic', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'cyrillic-ext',
						'label' => __('Cyrillic Extended', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'greek-ext',
						'label' => __('Greek Extended', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'latin-ext',
						'label' => __('Latin Extended', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'vietnamese',
						'label' => __('Vietnamese', 'framework'),
						'src' => ''
					)					
				)
			),
			array(
				'id' => 'title_font',
				'label' => __('Title font', 'framework'),
				'desc' => __('Font style for page title','framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'title_font_size',
				'label' => __('Title font size', 'framework'),
				'desc' => __('The size of the page title in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'content_font',
				'label' => __('Content font', 'framework'),
				'desc' => __('Font style for content','framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'content_font_size',
				'label' => __('Content font size', 'framework'),
				'desc' => __('The size of the page content in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'menu_font',
				'label' => __('Menu font', 'framework'),
				'desc' => __('Font style for menu items', 'framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'menu_font_size',
				'label' => __('Menu font size', 'framework'),
				'desc' => __('The size of the menu elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'headers_font',
				'label' => __('Header font', 'framework'),
				'desc' => __('Font style for all headers (H1, H2 etc.)','framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'h1_size',
				'label' => __('H1 font size', 'framework'),
				'desc' => __('The size of H1 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h2_size',
				'label' => __('H2 font size', 'framework'),
				'desc' => __('The size of H2 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h3_size',
				'label' => __('H3 font size', 'framework'),
				'desc' => __('The size of H3 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h4_size',
				'label' => __('H4 font size', 'framework'),
				'desc' => __('The size of H4 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h5_size',
				'label' => __('H5 font size', 'framework'),
				'desc' => __('The size of H5 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h6_size',
				'label' => __('H6 font size', 'framework'),
				'desc' => __('The size of H6 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			//elements_color
			array(
				'id' => 'main_color',
				'label' => __('Main color', 'framework'),
				'desc' => __('Main theme color','framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'main_body_text_color',
				'label' => __('Main body text color', 'framework'),
				'desc' => __('Main body text color, used for post content.','framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'preheader_background_color',
				'label' => __('Preheader background color', 'framework'),
				'desc' => __('Choose color or upload image below','framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'preheader_background_image',
				'label' => __('Preheader background image', 'framework'),
				'desc' => __('Enter full URL of your image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'header_text_color',
				'label' => __('Header text color', 'framework'),
				'desc' => __('','framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'header_breadcrumbs_color',
				'label' => __('Header breadcrumbs color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'header_breadcrumbs_active_color',
				'label' => __('Header breadcrumbs active color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'header_background_color',
				'label' => __('Header background color', 'framework'),
				'desc' => __('Choose color or upload image below','framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'header_background_image',
				'label' => __('Header background image', 'framework'),
				'desc' => __('Enter full URL of your image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'headers_text_color',
				'label' => __('Headers text color', 'framework'),
				'desc' => __('Color of all headers','framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'menu_background_color',
				'label' => __('Menu background color', 'framework'),
				'desc' => __('Background color of the menu', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'menu_background_hover_color',
				'label' => __('Menu background hover color', 'framework'),
				'desc' => __('Background color of the menu', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'sub_menu_background_color',
				'label' => __('Sub menu background color', 'framework'),
				'desc' => __('Background color of the sub menu item', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'sub_menu_background_hover_color',
				'label' => __('Sub menu background hover color', 'framework'),
				'desc' => __('Background color of the sub menu item', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'footer_background_color',
				'label' => __('Footer background color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'footer_headers_color',
				'label' => __('Footer headers color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'footer_main_text_color',
				'label' => __('Footer main text color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'copyrights_bar_background',
				'label' => __('Copyrights bar background color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'copyrights_bar_text_color',
				'label' => __('Copyrights bar text color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'copyrights_bar_text_hover_color',
				'label' => __('Copyrights bar text hover color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			//pages
			array(
				'id'          => 'portfolio_page',
				'label'       => __('Portfolio page', 'framework'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'page-select',
				'section'     => 'pages',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id' => 'show_related_projects_on_portfolio_single',
				'label' => __('Related projects', 'framework'),
				'desc' => __('Show related projects on a single post page', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'pages',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id'          => 'portfolio_page_related_projects_header',
				'label'       => __('Portfolio page - related projects header', 'framework'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'pages',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'portfolio_page_related_projects_description',
				'label'       => __('Portfolio page - related projects description', 'framework'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'textarea',
				'section'     => 'pages',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			//integration
			array(
				'id' => 'google_analytics_id',
				'label' => __('Google Analytics ID', 'framework'),
				'desc' => __('Your Google Analytics ID eg. UA-1xxxxx8-1', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'scripts_header',
				'label' => __('Header scripts', 'framework'),
				'desc' => __('Scripts will be added to the header. Don\'t forget to add &lsaquo;script&rsaquo;;...&lsaquo;/script&rsaquo; tags.', 'framework'),
				'std' => '',
				'type' => 'textarea-simple',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'scripts_footer',
				'label' => __('Footer scripts', 'framework'),
				'desc' => __('Scripts will be added to the footer. You can use this for Google Analytics etc. Don\'t forget to add &lsaquo;script&rsaquo;...&lsaquo;/script&rsaquo; tags.', 'framework'),
				'std' => '',
				'type' => 'textarea-simple',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'custom_css',
				'label' => __('Custom CSS', 'framework'),
				'desc' => __('Please add css classes only', 'framework'),
				'std' => '',
				'type' => 'textarea-simple',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'active_social_items',
				'label' => __('Actived items', 'framework'),
				'desc' => __('Items available on your website', 'framework'),
				'std' => '',
				'type' => 'checkbox',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'facebook',
						'label' => __('Facebook', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'twitter',
						'label' => __('Twitter', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'google_plus',
						'label' => __('Google+', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'linkedin',
						'label' => __('LinkedIn', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'flickr',
						'label' => __('Flickr', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'youtube',
						'label' => __('Youtube', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'rss',
						'label' => __('RSS', 'framework'),
						'src' => ''
					)
				),
			),
			array(
				'id' => 'facebook_url',
				'label' => __('Facebook URL', 'framework'),
				'desc' => __('URL to your Facebook account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_url',
				'label' => __('Twitter URL', 'framework'),
				'desc' => __('URL to your Twitter account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'google_plus_url',
				'label' => __('Google+ URL', 'framework'),
				'desc' => __('URL to your Google+ account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'linkedin_url',
				'label' => __('LinkedIn URL', 'framework'),
				'desc' => __('URL to your LinkedIn account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'flickr_url',
				'label' => __('Flickr URL', 'framework'),
				'desc' => __('URL to your Flickr account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'youtube_url',
				'label' => __('Youtube URL', 'framework'),
				'desc' => __('URL to your Youtube account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'rss_url',
				'label' => __('RSS URL', 'framework'),
				'desc' => __('URL to your RSS', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_account_recent_tweets',
				'label' => __('Twitter URL', 'framework'),
				'desc' => __('Your Twitter URL to use in the "tweets" shortcode', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_consumer_key',
				'label' => __('Twitter consumer key', 'framework'),
				'desc' => __("Consumer key from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_consumer_secret',
				'label' => __('Twitter consumer secret', 'framework'),
				'desc' => __("Consumer secret from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_user_token',
				'label' => __('Twitter user token', 'framework'),
				'desc' => __("'User token from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_token_secret',
				'label' => __('Twitter access token secret', 'framework'),
				'desc' => __("'Access token secret from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'contact_form_email',
				'label' => __('Email', 'framework'),
				'desc' => __('Email to receive messages from contact forms', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'contact_form',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'label' => 'Sidebars',
				'id' => 'user_sidebars',
				'type' => 'list-item',
				'desc' => __('List of user defined sidebars. Please use "save changes" button after you add or edit sidebars.', 'framework'),
				'settings' => array(
					array(
						'label' => __('Description', 'framework'),
						'id' => 'user_sidebar_description',
						'type' => 'text',
						'desc' => '',
						'std' => '',
						'rows' => '',
						'post_type' => '',
						'taxonomy' => '',
						'class' => ''
					)
				),
				'std' => '',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'section' => 'sidebars'
			),
			array(
				'id' => 'woocomerce_sidebar',
				'label' => __('WooCommerce sidebar', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'sidebars',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => $sidebar_choices
			),
			array(
				'id' => 'enable_translations',
				'label' => __('Enable translations', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Radio',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-off',
				'choices' => array(
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					)
				)
			)
		)
	);
	
	$traslate_phrases =
		'Comments
		Previous
		Next
		Comments are closed.
		Leave a Comment
		Leave a Comment to %s
		Cancel Comment
		Submit Comment
		You must be <a href=%s>logged in</a> to post a comment.
		Logged in as <a href=%1$s>%2$s</a>. <a href=%3$s title=Log out of this account>Log out?</a>
		You may use these <abbr title=HyperText Markup Language>HTML</abbr> tags and attributes: %s
		Name
		Email
		Page %s
		Pages:
		Fatal error! Please check your email in Theme Options!
		Please fill all required fields.
		Email sent. Thank you for contacting us
		Server error. Pease try again later.
		Your Name
		E-Mail
		Your Message
		SUBMIT
		Find the Address
		Scroll
		404
		Oops... Page Not Found!
		Sorry the Page Could not be Found here.
		Try using the button below to go to main page of the site
		Go Back
		Share this Post
		About the Author
		Posts Tagged %s
		Posts by %s
		Blog
		404 Page Not Found
		Shop
		&laquo; Previous
		Next &raquo;
		Pingback:
		Edit
		Your comment is awaiting moderation.
		Pages
		Home
		Archive by Category "%s"
		Search Results for "%s" Query
		close
		View Project
		All
		Posted about
		Latest Tweets Widget
		Tweets from Twitter account
		Twitter user:
		Show:
		No tweets
		Title:
		Sort by:
		Latest Posts
		Popular
		Recent
		Tags
		Just now
		1 minute ago
		minutes ago
		1 hour ago
		hours ago
		yesterday
		days ago
		weeks ago
		months ago
		1 year ago
		years ago';
	
	$to_translate = explode("\n",$traslate_phrases);
	
	if (is_array($to_translate)) {
		foreach ($to_translate as $item) {
			$item = trim($item);
			$custom_settings['settings'][] = array(
				'id' => 'translator_'.  sanitize_title($item),
				'label' => $item,
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => $item
			);
		}
	}
	
	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters('option_tree_settings_args', $custom_settings);

	/* settings are not the same update the DB */
	if ($saved_settings !== $custom_settings) {
		update_option('option_tree_settings', $custom_settings);
	}
}

/**
 * Get font choices for theme options
 * @param bool $return_string if true returned array is strict, example array item: font_name => font_label
 * @return array
 */
function ts_get_font_choices($return_strict = false) {
	$aFonts = array(
		array(
			'value' => 'default',
			'label' => __('Default', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'Verdana',
			'label' => 'Verdana',
			'src' => ''
		),
		array(
			'value' => 'Geneva',
			'label' => 'Geneva',
			'src' => ''
		),
		array(
			'value' => 'Arial',
			'label' => 'Arial',
			'src' => ''
		),
		array(
			'value' => 'Arial Black',
			'label' => 'Arial Black',
			'src' => ''
		),
		array(
			'value' => 'Trebuchet MS',
			'label' => 'Trebuchet MS',
			'src' => ''
		),
		array(
			'value' => 'Helvetica',
			'label' => 'Helvetica',
			'src' => ''
		),
		array(
			'value' => 'sans-serif',
			'label' => 'sans-serif',
			'src' => ''
		),
		array(
			'value' => 'Georgia',
			'label' => 'Georgia',
			'src' => ''
		),
		array(
			'value' => 'Times New Roman',
			'label' => 'Times New Roman',
			'src' => ''
		),
		array(
			'value' => 'Times',
			'label' => 'Times',
			'src' => ''
		),
		array(
			'value' => 'serif',
			'label' => 'serif',
			'src' => ''
		)
	);

	if (file_exists(get_template_directory() . '/framework/fonts/google-fonts.json')) {
		
//		ts_load_filesystem();
//		WP_Filesystem();
//		global $wp_filesystem;
		
//		$google_fonts = $wp_filesystem->get_contents(get_template_directory() . '/framework/fonts/google-fonts.json');
		$google_fonts = file_get_contents(get_template_directory() . '/framework/fonts/google-fonts.json', true);
		$aGoogleFonts = json_decode($google_fonts, true);
		
		if (isset($aGoogleFonts['items']) && is_array($aGoogleFonts['items'])) {
			$aFonts[] = array(
				'value' => 'google_web_fonts',
				'label' => '---Google Web Fonts---',
				'src' => ''
			);

			foreach ($aGoogleFonts['items'] as $aGoogleFont) {
				$aFonts[] = array(
					'value' => 'google_web_font_' . $aGoogleFont['family'],
					'label' => $aGoogleFont['family'],
					'src' => ''
				);
			}
		}	
	}
	
	if ($return_strict) {
		$aFonts2 = array();
		foreach ($aFonts as $font) {
			$aFonts2[$font['value']] = $font['label'];
		}
		return $aFonts2;
	}
	return $aFonts;
}

/**
 * Get background patterns
 * @param bool $control_panel if true return array for control panel (front end)
 * @return type
 */
function ts_get_background_patterns($control_panel = false)
{
	$patterns = array();
	
	
	if ($control_panel === false)
	{
		$patterns[] = array(
			'value' => 'none',
			'label' => __('None', 'framework'),
			'src' => ''
		);
		
		$patterns[] = array(
			'value' => 'image',
			'label' => __('Image (choose below)', 'framework'),
			'src' => ''
		);
	}
	
	$patterns[] = array(
		'value' => 'cartographer.png',
		'label' => __('Cartographer', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'concrete_wall.png',
		'label' => __('Concrete Wall', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'dark_wall.png',
		'label' => __('Dark Wall', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'dark_wood.png',
		'label' => __('Dark Wood', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'irongrip.png',
		'label' => __('Irongrip', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'purty_wood.png',
		'label' => __('Purty Wood', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'px_by_Gre3g.png',
		'label' => __('PX', 'framework'),
		'src' => ''
	);
	return $patterns;
}

/**
 * Get menu background transparency values
 * @return int
 */
function ts_get_menu_background_transparency_values()
{
	$values = array();
	for ($i = 0; $i <= 100; $i ++)
	{
		$v = $i;
		$v = 100 - $i;
		if ($v == 100)
		{
			$v = 1;
		}
		else
		{
			if ($v < 10)
			{
				$v = '0'.$v;
			}
			$v = '0.'.$v;
		}
		$values[] = array(
			'value' => $v,
			'label' => $i.'%',
			'src' => ''
		);
	}
	return $values;
}

/**
 * Get preheader types
 * @return array
 */
function ts_get_preheader_types() {
	
	$preheader_items = array(
		array(
			'value' => 'text',
			'label' => __('Text', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'date',
			'label' => __('Date', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'social_icons',
			'label' => __('Social icons', 'framework'),
			'src' => ''
		)
	);
	
	$menus = ts_get_user_defined_menus();
	
	if (is_array($menus) && count($menus) > 0) {
		foreach ($menus as $key => $menu) {
			$preheader_items[] = array(
				'value' => 'menu_'.$key,
				'label' => __('Menu', 'framework').' - '.$menu,
				'src' => ''
			);
		}
	}
	return $preheader_items;
}
