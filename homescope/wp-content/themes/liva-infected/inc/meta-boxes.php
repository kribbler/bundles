<?php

/**
 * Meta boxes definitions
 *
 * @package framework
 * @since framework 1.0
 */

/**
 * Enque scripts for post options metaboxes
 *
 */
add_action("admin_head-post.php", 'ts_framework_post_scripts');
add_action("admin_head-post-new.php", 'ts_framework_post_scripts');

function ts_framework_post_scripts() {
	wp_register_script('screwdefaultbuttons', get_template_directory_uri() . '/framework/js/jquery.screwdefaultbuttonsV2.min.js', array('jquery'));
	wp_enqueue_script('screwdefaultbuttons');

	wp_register_script('metaboxes_options', get_template_directory_uri() . '/framework/js/meta-boxes-options.js', array('jquery'));
	wp_enqueue_script('metaboxes_options');

	wp_register_script('page_builder', get_template_directory_uri() . '/framework/js/page-builder.js', array('jquery'));
	wp_enqueue_script('page_builder');
}

/**
 * Updating map field, label was changed with WP 3.9 upgrade (old one wasn't working fine)
 * 
 */
function ts_update_map_field() {
	
	$id = isset($_GET['post']) ? intval($_GET['post']) : null; 
	
	if (!$id) {
		return false;
	}
	
	$template = get_page_template_slug($id);
	
	//check for specific template only
	if (in_array($template, array('template-contact-form-1.php'))) {
		$old_map = get_post_meta($id,'map', true);
		
		if (!$old_map) {
			return false;
		}
		$new_map = get_post_meta($id,'maparea', true);
		//update new field name maparea with value from previous field
		if ($old_map && !$new_map) {
			update_post_meta($id,'maparea', $old_map);
		}
		delete_post_meta($id,'map');
	}
}
add_action("load-post.php",'ts_update_map_field');

/**
 * Get script which replaces sidebar radio buttons with images
 * 
 */
function ts_get_sidebar_radio_buttons_replacement_script() {
	return '
		<script type="text/javascript">
			jQuery(document).ready(function() {
			
				var $radios = jQuery("input:radio[name=sidebar_position_single]");
				if($radios.is(":checked") === false) {
					$radios.filter("[value=no]").prop("checked", true);
				}

				jQuery(\'input:radio[name="sidebar_position_single"][value="left"]\').screwDefaultButtons({ 
					image: "url(' . get_template_directory_uri() . '/framework/images/sidebar-left.png)",
					width:	 100,
					height:	 64
				});
				
				jQuery(\'input:radio[name="sidebar_position_single"][value="right"]\').screwDefaultButtons({ 
					image: "url(' . get_template_directory_uri() . '/framework/images/sidebar-right.png)",
					width:	 100,
					height:	 64
				});
				
				jQuery(\'input:radio[name="sidebar_position_single"][value="no"]\').screwDefaultButtons({ 
					image: "url(' . get_template_directory_uri() . '/framework/images/sidebar-no.png)",
					width:	 100,
					height:	 64
				});
			});
		</script>';
}

/**
 * Get shortcodes meta box content
 *
 */
function ts_get_shortcodes_meta_box_cotent() {
	$content = __('Available shortcodes:', 'framework');

	$aHelp = ts_get_shortcodes_list();

	if (is_array($aHelp)) {
		$iCount = count($aHelp);
		$i = 0;
		$col1 = '';
		$col2 = '';
		foreach ($aHelp as $aShortcode) {
			$col = '
				<div class="framework-box">
					<div class="toggle-shortcode" title="' . __('Click to toggle', 'framework') . '"><br></div>
					<h3><span>' . $aShortcode['name'] . '</span></h3>
					<div class="box-description">';

			$usage = $aShortcode['usage'];
			if (!is_array($aShortcode['usage'])) {
				$usage = array();
				$usage[] = $aShortcode['usage'];
			}
			foreach ($usage as $item) {
				$col .= '<div class="shortcode-usage">' . $item . '</div>';
			}
			$description = $aShortcode['description'];
			if (!is_array($aShortcode['description'])) {
				$description = array();
				$description[] = $aShortcode['description'];
			}
			foreach ($description as $item) {
				$col .= '<p>' . $item . '</p>';
			}
			$col .= '
					</div>
				</div>';

			if ($iCount / 2 > $i) {
				$col1 .= $col;
			} else {
				$col2 .= $col;
			}
			$i++;
		}
	}

	$content .= '
		<div id="framework-shortcodes-help">
			<div class="col">
				<div class="colpad1">
					' . $col1 . '
				</div>
			</div>
			<div class="col">
				<div class="colpad2">
					' . $col2 . '
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		';

	return $content;
}

/**
 * Meta boxes definition
 *
 */
add_action('admin_init', 'ts_custom_meta_boxes');

function ts_custom_meta_boxes() {
	$sidebar_choices = array();
	$sidebar_choices[] = array(
		'label' => __('Main', 'framework'),
		'value' => 'main',
		'src' => ''
	);

	$user_sidebars = ot_get_option('user_sidebars');

	if (is_array($user_sidebars)) {
		foreach ($user_sidebars as $sidebar) {
			$sidebar_choices[] = array(
				'label' => $sidebar['title'],
				'value' => sanitize_title($sidebar['title']),
				'src' => ''
			);
		}
	}

	//Shortcodes Help
	$shortcodes_options_boxes = array(
		'id' => 'shortcodes_options_boxes',
		'title' => __('Shortcodes', 'framework'),
		'desc' => ts_get_shortcodes_meta_box_cotent(),
		'pages' => array('post', 'page'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
		)
	);
	ot_register_meta_box($shortcodes_options_boxes);

	//post options
	$post_options_boxes = array(
		'id' => 'post_options_boxes',
		'title' => __('Post Options', 'framework'),
		'desc' => ts_get_sidebar_radio_buttons_replacement_script(),
		'pages' => array('post'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'id' => 'video_url',
				'label' => __('Video URL', 'framework'),
				'desc' => __('YouTube or Vimeo video URL', 'framework'),
				'std' => '',
				'type' => 'Text',
				'class' => 'video',
				'choices' => ''
			),
			array(
				'id' => 'embedded_video',
				'label' => __('Embadded Video', 'framework'),
				'desc' => __('Please use this option when the video does not come from YouTube or Vimeo', 'framework'),
				'std' => '',
				'type' => 'Textarea_Simple',
				'class' => 'video',
				'choices' => ''
			),
			array(
				'id' => 'gallery_images',
				'label' => __('Gallery', 'framework'),
				'desc' => __('Slider gallery images', 'framework'),
				'std' => '',
				'type' => 'list-item',
				'section' => 'general',
				'rows' => '',
				'post_type' => 'post',
				'taxonomy' => '',
				'class' => 'gallery',
				'settings' => array(
					array(
						'id' => 'image',
						'label' => __('Image', 'framework'),
						'desc' => '',
						'std' => '',
						'type' => 'upload',
						'rows' => '',
						'post_type' => '',
						'taxonomy' => '',
						'class' => ''
					)
				)
			),
			array(
				'id' => 'post_slider',
				'label' => __('Slider', 'framework'),
				'desc' => __('Select a slider for this post', 'framework'),
				'std' => '',
				'type' => 'select',
				'class' => '',
				'choices' => ts_get_slider_items_for_theme_options()
			),
			array(
				'id' => 'parallax_effect',
				'label' => __('Parallax Effect', 'framework'),
				'desc' => __('Adds parallax effect to the slider', 'framework'),
				'std' => '',
				'type' => 'radio',
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
				'id' => 'sidebar_position_single',
				'label' => __('Sidebar position', 'framework'),
				'desc' => __('Select a sidebar position', 'framework'),
				'std' => '',
				'type' => 'radio',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					),
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
				'id' => 'left_sidebar',
				'label' => __('Left sidebar', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'select',
				'class' => '',
				'choices' => $sidebar_choices
			),
			array(
				'id' => 'right_sidebar',
				'label' => __('Right sidebar', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'select',
				'class' => '',
				'choices' => $sidebar_choices
			)
		)
	);
	ot_register_meta_box($post_options_boxes);

	$page_options_boxes = array(
		'id' => 'page_options_boxes',
		'title' => __('Page Options', 'framework'),
		'desc' => ts_get_sidebar_radio_buttons_replacement_script(),
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'id' => 'page_builder',
				'label' => __('Page Builder', 'framework'),
				'desc' => '<div id="page-builder" data-post="'.(isset($_GET['post']) ? $_GET['post'] : '').'"></div>',
				'std' => '',
				'type' => 'textblock',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'maparea',
				'label' => __('Map', 'framework'),
				'desc' => __('Please insert map into editor below', 'framework'),
				'std' => '',
				'type' => 'Textarea',
				'class' => 'template-contact-form-1',
				'choices' => ''
			),
			array(
				'id' => 'contact_form_box',
				'label' => __('Right column box', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Textarea',
				'class' => 'template-contact-form-1',
				'choices' => ''
			),
			array(
				'id' => 'number_of_items',
				'label' => __('Number of items', 'framework'),
				'desc' => __('Number of blog or portfolio items to show', 'framework'),
				'std' => '',
				'type' => 'text',
				'class' => 'template-blog-1 template-blog-2 template-portfolio-1 template-portfolio-2',
				'choices' => ''
			),
			array(
				'id' => 'number_of_columns',
				'label' => __('Number of columns', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'select',
				'class' => 'template-portfolio-1',
				'choices' => array(
					array(
						'value' => '2',
						'label' => '2',
						'src' => ''
					),
					array(
						'value' => '3',
						'label' => '3',
						'src' => ''
					),
					array(
						'value' => '4',
						'label' => '4',
						'src' => ''
					)
				)
			),
//			array(
//				'id' => 'portfolio_categories',
//				'label' => __('Portfolio categories', 'framework'),
//				'desc' => __('Limit portfolio to selected categories only', 'framework'),
//				'std' => '',
//				'type' => 'checkbox',
//				'class' => 'template-portfolio-1-2-col template-portfolio-1-3-col template-portfolio-1-4-col',
//				'choices' => ts_get_portfolio_categories()
//			),
			
//			array(
//				'id' => 'portfolio_filter',
//				'label' => __('Portfolio category filter', 'framework'),
//				'desc' => '',
//				'std' => '',
//				'type' => 'Radio',
//				'rows' => '',
//				'post_type' => '',
//				'taxonomy' => '',
//				'class' => 'switcher-on',
//				'choices' => array(
//					array(
//						'value' => 'yes',
//						'label' => __('Yes', 'framework'),
//						'src' => ''
//					),
//					array(
//						'value' => 'no',
//						'label' => __('No', 'framework'),
//						'src' => ''
//					),
//				)
//			),
			array(
				'id' => 'show_preheader',
				'label' => __('Show preheader', 'framework'),
				'desc' => __('Overrides global preheader settings', 'framework'),
				'std' => '',
				'type' => 'Select',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'default',
						'label' => __('Default', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
				)
			),
			array(
				'id' => 'main_menu_style',
				'label' => __('Main menu style', 'framework'),
				'desc' => __('Overrides global style settings', 'framework'),
				'std' => '',
				'type' => 'Select',
				'class' => '',
				'choices' => ts_get_header_styles(true)
			),
			array(
				'id' => 'header_text_color',
				'label' => __('Header text color', 'framework'),
				'desc' => __('','framework'),
				'std' => '',
				'type' => 'colorpicker',
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
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'titlebar',
				'label' => __('Titlebar', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'select',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'default',
						'label' => __('Default', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'title',
						'label' => __('Only title', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'breadcrumbs',
						'label' => __('Only breadcrumbs', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no_titlebar',
						'label' => __('No titlebar', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'post_slider',
				'label' => __('Slider', 'framework'),
				'desc' => __('Header and title are hidden where slider is selected', 'framework'),
				'std' => '',
				'type' => 'select',
				'class' => '',
				'choices' => ts_get_slider_items_for_theme_options()
			),
			array(
				'id' => 'sidebar_position_single',
				'label' => __('Sidebar position', 'framework'),
				'desc' => __('Select a sidebar position', 'framework'),
				'std' => '',
				'type' => 'radio',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					),
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
				'id' => 'left_sidebar',
				'label' => __('Left sidebar', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'select',
				'class' => '',
				'choices' => $sidebar_choices
			),
			array(
				'id' => 'right_sidebar',
				'label' => __('Right sidebar', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'select',
				'class' => '',
				'choices' => $sidebar_choices
			),
			array(
				'id' => 'show_page_content',
				'label' => __('Show page content', 'framework'),
				'desc' => __('Show the content from the page editor', 'framework'),
				'std' => '',
				'type' => 'radio',
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
			)
		)
	);
	ot_register_meta_box($page_options_boxes);

	//Portfolio
	$portfolio_options_boxes = array(
		'id' => 'portfolio_options_boxes',
		'title' => __('Portfolio Options', 'framework'),
		'desc' => '',
		'pages' => array('portfolio'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'id' => 'video_url',
				'label' => __('Video URL', 'framework'),
				'desc' => __('YouTube or Vimeo video URL', 'framework'),
				'std' => '',
				'type' => 'Text',
				'class' => 'video',
				'choices' => ''
			),
			array(
				'id' => 'embedded_video',
				'label' => __('Embadded Video', 'framework'),
				'desc' => __('Please use this option when the video does not come from YouTube or Vimeo', 'framework'),
				'std' => '',
				'type' => 'Textarea_Simple',
				'class' => 'video',
				'choices' => ''
			),
			array(
				'id' => 'gallery_images',
				'label' => __('Gallery', 'framework'),
				'desc' => __('Slider gallery images', 'framework'),
				'std' => '',
				'type' => 'list-item',
				'section' => 'general',
				'rows' => '',
				'taxonomy' => '',
				'class' => 'gallery',
				'settings' => array(
					array(
						'id' => 'image',
						'label' => __('Image', 'framework'),
						'desc' => '',
						'std' => '',
						'type' => 'upload',
						'rows' => '',
						'post_type' => '',
						'taxonomy' => '',
						'class' => ''
					)
				)
			),
			array(
				'id' => 'url',
				'label' => __('URL', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Text',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'project_info',
				'label' => __('Project info', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Textarea',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'project_details',
				'label' => __('Project details', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Textarea',
				'class' => '',
				'choices' => ''
			)
		)
	);
	ot_register_meta_box($portfolio_options_boxes);

	//Team
	$team_options_boxes = array(
		'id' => 'team_options_boxes',
		'title' => __('Team Options', 'framework'),
		'desc' => '',
		'pages' => array('team'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'id' => 'team_position',
				'label' => __('Position', 'framework'),
				'desc' => '',
				'type' => 'Text',
				'class' => '',
			),
			array(
				'id' => 'short_description',
				'label' => __('Short description', 'framework'),
				'desc' => '',
				'type' => 'textarea',
				'class' => '',
			),
			array(
				'id' => 'facebook_url',
				'label' => __('Facebook URL', 'framework'),
				'desc' => __('Icon appers if not empty', 'framework'),
				'type' => 'Text',
				'class' => '',
			),
			array(
				'id' => 'twitter_url',
				'label' => __('Twitter URL', 'framework'),
				'desc' => __('Icon appers if not empty', 'framework'),
				'type' => 'Text',
				'class' => '',
			),
			array(
				'id' => 'google_plus_url',
				'label' => __('Google+ URL', 'framework'),
				'desc' => __('Icon appers if not empty', 'framework'),
				'type' => 'Text',
				'class' => '',
			),
			array(
				'id' => 'youtube_url',
				'label' => __('Youtube URL', 'framework'),
				'desc' => __('Icon appers if not empty', 'framework'),
				'type' => 'Text',
				'class' => '',
			),
			array(
				'id' => 'rss_url',
				'label' => __('RSS URL', 'framework'),
				'desc' => __('Icon appers if not empty', 'framework'),
				'type' => 'Text',
				'class' => '',
			)	
		)
	);
	ot_register_meta_box($team_options_boxes);
	
	//Banner builder
	$banner_builder_options_boxes = array(
		'id' => 'banner_builder_options_boxes',
		'title' => __('Banner Options', 'framework'),
		'desc' => '',
		'pages' => array('banner-builder'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'id' => 'height',
				'label' => __('Banner height', 'framework'),
				'desc' => __('Banner height in pixels', 'framework'),
				'std' => '',
				'type' => 'text',
				'class' => ''
			),
			array(
				'id' => 'padding_top',
				'label' => __('Padding top', 'framework'),
				'desc' => __('Container top padding', 'framework'),
				'std' => '',
				'type' => 'text',
				'class' => ''
			),
			array(
				'id' => 'padding_bottom',
				'label' => __('Padding bottom', 'framework'),
				'desc' => __('Container bottom padding', 'framework'),
				'std' => '',
				'type' => 'text',
				'class' => ''
			),
			array(
				'id' => 'padding_left',
				'label' => __('Padding left', 'framework'),
				'desc' => __('Container left padding', 'framework'),
				'std' => '',
				'type' => 'text',
				'class' => ''
			),
			array(
				'id' => 'padding_right',
				'label' => __('Padding right', 'framework'),
				'desc' => __('Container right padding', 'framework'),
				'std' => '',
				'type' => 'text',
				'class' => ''
			),
			array(
				'id' => 'padding_unit',
				'label' => __('Padding unit', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'select',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'pixels',
						'label' => __('px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'percentage',
						'label' => __('%', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'background_image',
				'label' => __('Background image', 'framework'),
				'desc' => __('Choose "Image" option on "Background pattern" list and boxed layout to enable background', 'framework'),
				'std' => '',
				'type' => 'Upload',
				'class' => ''
			),
			array(
				'id' => 'background_repeat',
				'label' => __('Background repeat', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
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
				'class' => '',
				'choices' => array(
					array(
						'value' => 'left top',
						'label' => __('left top', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'left center',
						'label' => __('left center', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'left bottom',
						'label' => __('left bottom', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'right top',
						'label' => __('right top', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'right center',
						'label' => __('right center', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'right bottom',
						'label' => __('right bottom', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'center top',
						'label' => __('center top', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'center center',
						'label' => __('center center', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'center bottom',
						'label' => __('center bottom', 'framework'),
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
				'class' => '',
				'choices' => array(
					array(
						'value' => 'original',
						'label' => __('Original', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'fit',
						'label' => __('Fits the container', 'framework'),
						'src' => ''
					)
				)
			)
		)
	);
	ot_register_meta_box($banner_builder_options_boxes);
}

/**
 * Get slider items for theme options
 * @global type $wpdb
 * @return string
 */
function ts_get_slider_items_for_theme_options() {
	global $wpdb;

	$slider_items[] = array(
		'value' => '',
		'label' => __('Choose', 'framework'),
		'src' => ''
	);
	//FlexSlider
	$sliders = $wpdb->get_results($q = "
		SELECT
			*
		FROM
			" . $wpdb->prefix . "fs_sliders
		ORDER BY
			name
		LIMIT
			100");

	// Iterate over the sliders
	foreach ($sliders as $key => $item) {

		$slider_items[] = array(
			'value' => 'flexslider-' . $item->slider_id,
			'label' => 'FlexSlider - ' . stripslashes($item->name),
			'src' => ''
		);
	}

	//LayerSlider
	if (function_exists('ts_get_layer_slider_items_for_theme_options'))
	{
		$a = ts_get_layer_slider_items_for_theme_options();
		if (is_array($a)) {
			foreach ($a as $val) {
				$slider_items[] = $val;
			}
		}
	}

	//Revolution Slider
	if (is_plugin_active('revslider/revslider.php')) {
		$sliders = $wpdb->get_results($q = "
			SELECT
				*
			FROM
				" . $wpdb->prefix . "revslider_sliders
			ORDER BY
				id
			LIMIT
				100");

		// Iterate over the sliders
		foreach ($sliders as $key => $item) {

			$slider_items[] = array(
				'value' => 'revslider-' . $item->alias,
				'label' => 'Revolution Slider - ' . stripslashes($item->title),
				'src' => ''
			);
		}
	}
	
	//Banner builder
	if (function_exists('ts_get_banners_list')) {
		$banners = ts_get_banners_list();
		if ($banners) {
			// Iterate over the sliders
			foreach ($banners as $key => $item) {

				$slider_items[] = array(
					'value' => 'banner-builder-' . $item['id'],
					'label' => __('Banner Builder', 'framework').' - ' . $item['title'],
					'src' => ''
				);
			}
		}
	}
	return $slider_items;
}

/**
 * Get percentage meta box select values
 * @return int
 */
function ts_get_percentage_meta_box_select_values()
{
	$a = array();
	for ($i = 1; $i <= 100; $i++)
	{
		$a[] = array(
			'value' => $i,
			'label' => $i,
			'src' => ''
		);
	}
	return $a;
}

/**
 * Gets portfolio categories for meta box
 * @return type
 */
function ts_get_portfolio_categories() {
	
	$categories = get_terms("portfolio-categories");
	$categories_output = array();
	if ($categories && !is_wp_error($categories)) {
		foreach ($categories as $category) {
			$categories_output[] = array(
				'value' => $category -> term_id,
				'label' => $category -> name,
				'src' => ''
			);
		}
	}
	return $categories_output;
}

function ts_get_menus() {
	
	$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
	
	$menu_items[] = array();
	$menu_items[] = array(
		'value' => 0,
		'label' => __('Choose','framework'),
		'src' => ''
	);
	
	if (is_array($menus) && !is_wp_error($menus)) {
		foreach ($menus as $item) {
			$menu_items[] = array(
				'value' => $item -> term_id,
				'label' => $item -> name,
				'src' => ''
			);
		}
	}
	return $menu_items;
}