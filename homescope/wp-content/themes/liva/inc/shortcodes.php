<?php
/**
 * Shortcodes
 *
 * @package framework
 * @since framework 1.0
 */

require_once get_template_directory().'/inc/shortcodes/accordion.php';
require_once get_template_directory().'/inc/shortcodes/blockquote.php';
require_once get_template_directory().'/inc/shortcodes/box.php';
require_once get_template_directory().'/inc/shortcodes/box_text.php';
require_once get_template_directory().'/inc/shortcodes/button.php';
require_once get_template_directory().'/inc/shortcodes/call_to_action.php';
require_once get_template_directory().'/inc/shortcodes/call_to_action_2.php';
require_once get_template_directory().'/inc/shortcodes/call_to_action_3.php';
require_once get_template_directory().'/inc/shortcodes/call_to_action_4.php';
require_once get_template_directory().'/inc/shortcodes/columns.php';
require_once get_template_directory().'/inc/shortcodes/contact_info.php';
require_once get_template_directory().'/inc/shortcodes/counters.php';
require_once get_template_directory().'/inc/shortcodes/divider.php';
require_once get_template_directory().'/inc/shortcodes/dropcaps.php';
require_once get_template_directory().'/inc/shortcodes/flexslider.php';
require_once get_template_directory().'/inc/shortcodes/framed_box.php';
require_once get_template_directory().'/inc/shortcodes/headers.php';
require_once get_template_directory().'/inc/shortcodes/highlight.php';
require_once get_template_directory().'/inc/shortcodes/icon.php';
require_once get_template_directory().'/inc/shortcodes/icon_2.php';
require_once get_template_directory().'/inc/shortcodes/icon_3.php';
require_once get_template_directory().'/inc/shortcodes/icon_box.php';
require_once get_template_directory().'/inc/shortcodes/image.php';
require_once get_template_directory().'/inc/shortcodes/image_box.php';
require_once get_template_directory().'/inc/shortcodes/latest_works.php';
require_once get_template_directory().'/inc/shortcodes/list.php';
require_once get_template_directory().'/inc/shortcodes/list_modern.php';
require_once get_template_directory().'/inc/shortcodes/mark.php';
require_once get_template_directory().'/inc/shortcodes/message.php';
require_once get_template_directory().'/inc/shortcodes/our_clients.php';
require_once get_template_directory().'/inc/shortcodes/person.php';
require_once get_template_directory().'/inc/shortcodes/pricing_table.php';
require_once get_template_directory().'/inc/shortcodes/promo.php';
require_once get_template_directory().'/inc/shortcodes/recent_projects.php';
require_once get_template_directory().'/inc/shortcodes/simple_text.php';
require_once get_template_directory().'/inc/shortcodes/skillbar.php';
require_once get_template_directory().'/inc/shortcodes/slider.php';
require_once get_template_directory().'/inc/shortcodes/space.php';
require_once get_template_directory().'/inc/shortcodes/steps.php';
require_once get_template_directory().'/inc/shortcodes/social_links.php';
require_once get_template_directory().'/inc/shortcodes/special_text.php';
require_once get_template_directory().'/inc/shortcodes/section.php';
require_once get_template_directory().'/inc/shortcodes/table.php';
require_once get_template_directory().'/inc/shortcodes/tabs.php';
require_once get_template_directory().'/inc/shortcodes/teaser.php';
require_once get_template_directory().'/inc/shortcodes/testimonial.php';
require_once get_template_directory().'/inc/shortcodes/testimonials.php';
require_once get_template_directory().'/inc/shortcodes/text.php';
require_once get_template_directory().'/inc/shortcodes/tweets.php';


/* PLEASE ADD every new shortcode to the get_shortcodes_help function below */

/**
 * Get shortcodes list
 *
 */
function ts_get_shortcodes_list()
{
	$aHelp = array(
		/*
		array(
			'shortcode' => '',
			'name' => 'Title',
			'description' => Description,  can be an array,
			'usage' => 'Example usage, can be an array',
		),
		*/
		array(
			'shortcode' => 'accordion',
			'name' => __('Accordion','framework'),
			'description' => '',
			'usage' => '[accordion animation="bounceInUp" open="yes"][accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle][/accordion]',
			'code' => '[accordion animation="{animation}" open="{open}"]{child}[/accordion]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'open' => array(
					'type' => 'select',
					'label' => __('Open first', 'framework'),
					'desc' => '',
					'values' => array(
						'yes' => __('yes', 'framework'),
						'no' => __('no', 'framework')
					)
				)
			),
			'add_child_button' => __('Add Item', 'framework'),
			'child' => array(
				'fields' => array(
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'content' => array(
						'type' => 'textarea',
						'label' => __('Content', 'framework'),
						'desc' => ''
					),
				),
				'name' => __('Accordion item','framework'),
				'code' => '[accordion_toggle title="{title}"]{content}[/accordion_toggle]',
			)
		),
		array(
			'shortcode' => 'blockquote',
			'name' => __('Blockquote','framework'),
			'description' => '',
			'usage' => '[blockquote animation="bounceInUp"]Your content here...[/blockquote]',
			'code' => '[blockquote animation="{animation}"]{content}[/blockquote]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'content' => array(
					'type' => 'textarea',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'box',
			'name' => __('Box','framework'),
			'description' => '',
			'usage' => '[box animation="bounceInUp" icon="icon-search" title="Your title"]Your content here...[/box]',
			'code' => '[box animation="{animation}" icon="{icon}" title="{title}"]{content}[/box]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'box_text',
			'name' => __('Box text','framework'),
			'description' => '',
			'usage' => '[box_text animation="bounceInUp" icon="icon-search" title="Your title"]Your content here...[/box_text]',
			'code' => '[box_text animation="{animation}" icon="{icon}" title="{title}"]{content}[/box_text]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'button',
			'name' => __('Button','framework'),
			'description' => '',
			'usage' => '[button animation="bounceInUp" color="#555555" background_color="#FF0000" icon="icon-briefcase" icon_upload="" url="http://yourdomain.com" target="_blank" ]Your content here...[/button]',
			'code' => '[button animation="{animation}" color="{color}" background_color="{backgroundcolor}" icon="{icon}" icon_upload="{iconupload}" target="{target}" url="{url}"]{content}[/button]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Text color', 'framework'),
					'desc' => ''
				),
				'backgroundcolor' => array(
					'type' => 'colorpicker',
					'label' => __('Background color', 'framework'),
					'desc' => ''
				),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'iconupload' => array(
					'type' => 'upload',
					'label' => __('Upload icon', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'call_to_action',
			'name' => __('Call To Action','framework'),
			'description' => '',
			'usage' => '[call_to_action animation="bounceInUp" style="1" title="Your title" subtitle="Your subtitle" icon="icon-glass" buttton_text="Click me!" url="http://..." target="_self" first_page="yes" last_page="no"]',
			'code' => '[call_to_action animation="{animation}" style="{style}" title="{title}" subtitle="{subtitle}" icon="{icon}" buttton_text="{butttontext}" url="{url}" target="{target}" first_page="{firstpage}" last_page="{lastpage}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2',
						'3' => '3'
					),
					'default' => '_self',
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'subtitle' => array(
					'type' => 'text',
					'label' => __('Subtitle', 'framework'),
					'desc' => ''
				),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'butttontext' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'firstpage' => array(
					'type' => 'select',
					'label' => __('First element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'lastpage' => array(
					'type' => 'select',
					'label' => __('Last element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'call_to_action_2',
			'name' => __('Call To Action 2','framework'),
			'description' => '',
			'usage' => '[call_to_action_2 animation="bounceInUp" title="Your title" buttton_text="Click me" url="http://...." target="_self" first_page="yes" last_page="no"]',
			'code' => '[call_to_action_2 animation="{animation}" title="{title}" buttton_text="{butttontext}" url="{url}" target="{target}" first_page="{firstpage}" last_page="{lastpage}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'butttontext' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'firstpage' => array(
					'type' => 'select',
					'label' => __('First element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'lastpage' => array(
					'type' => 'select',
					'label' => __('Last element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'call_to_action_3',
			'name' => __('Call To Action 3','framework'),
			'description' => '',
			'usage' => '[call_to_action_3 animation="bounceInUp" title="Your title" subtitle="Your subtitle" buttton_text="Click me!" url="http://..." target="_self"]',
			'code' => '[call_to_action_3 animation="{animation}" title="{title}" subtitle="{subtitle}" buttton_text="{butttontext}" url="{url}" target="{target}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'subtitle' => array(
					'type' => 'text',
					'label' => __('Subtitle', 'framework'),
					'desc' => ''
				),
				'butttontext' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'call_to_action_4',
			'name' => __('Call To Action 4','framework'),
			'description' => '',
			'usage' => '[call_to_action_4 animation="bounceInUp" title="Your title" subtitle="Your subtitle" buttton_text="Click me!" url="http://..." target="_self"]',
			'code' => '[call_to_action_4 animation="{animation}" title="{title}" subtitle="{subtitle}" buttton_text="{butttontext}" url="{url}" target="{target}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'subtitle' => array(
					'type' => 'text',
					'label' => __('Subtitle', 'framework'),
					'desc' => ''
				),
				'butttontext' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'firstpage' => array(
					'type' => 'select',
					'label' => __('First element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'lastpage' => array(
					'type' => 'select',
					'label' => __('Last element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'contact_info',
			'name' => __('Contact info','framework'),
			'description' => '',
			'usage' => '[contact_info animation="bounceInUp" address="123 Wide Road, LA" email="your@email.com" phone="+1 123-4567-8900" fax="+1 123-4567-1200" map=""]',
			'code' => '[contact_info animation="{animation}" address="{address}" email="{email}" phone="{phone}" fax="{fax}" map="{map}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'address' => array(
					'type' => 'text',
					'label' => __('Address', 'framework'),
					'desc' => ''
				),
				'email' => array(
					'type' => 'text',
					'label' => __('Email', 'framework'),
					'desc' => ''
				),
				'phone' => array(
					'type' => 'text',
					'label' => __('Phone', 'framework'),
					'desc' => ''
				),
				'fax' => array(
					'type' => 'text',
					'label' => __('Fax', 'framework'),
					'desc' => ''
				),
				'map' => array(
					'type' => 'text',
					'label' => __('Map (address used to create Google map)', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'counters',
			'name' => __('Counters','framework'),
			'description' => '',
			'usage' => '[counters animation="bounceInUp"][counters_item title="Awards" value="123" speed="1500" sign="$" sign_position="before"][/counters]',
			'code' => '[counters animation="{animation}"]{child}[/counters]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings()
			),
			'add_child_button' => __('Add Item', 'framework'),
			'child' => array(
				'name' => __('Item','framework'),
				'code' => '[counters_item title="{title}" value="{value}" speed="{speed}" sign="{sign}" sign_position="{signposition}"]',
				'fields' => array(
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'value' => array(
						'type' => 'text',
						'label' => __('Value', 'framework'),
						'desc' => ''
					),
					'speed' => array(
						'type' => 'select',
						'label' => __('Speed (seconds)', 'framework'),
						'values' => array(
							'1000' => '1.0',
							'1500' => '1.5',
							'2000' => '2.0',
							'2500' => '2.5',
							'3000' => '3.0',
							'3500' => '3.5',
							'4000' => '4.0',
							'4500' => '4.5',
							'5000' => '5.0',
							'5500' => '5.5',
							'6000' => '6.0',
							'6500' => '6.5',
							'7000' => '7.0',
							'7500' => '7.5',
							'8000' => '8.0',
							'8500' => '8.5',
							'9000' => '9.0',
							'9500' => '9.5',
							'10000' => '10',
							'11000' => '11',
							'12000' => '12',
							'13000' => '13',
							'14000' => '14',
							'15000' => '15',
							'16000' => '16',
							'17000' => '17',
							'18000' => '18',
							'19000' => '19',
							'20000' => '20'

						),
						'default' => '1000',
						'desc' => ''
					),
					'sign' => array(
						'type' => 'text',
						'label' => __('Sign', 'framework'),
						'desc' => ''
					),
					'signposition' => array(
						'type' => 'select',
						'label' => __('Sign position', 'framework'),
						'values' => array(
							'after' => __('After', 'framework'),
							'before' => __('Before', 'framework')
						),
						'default' => 'after',
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'dropcaps',
			'name' => __('Dropcaps','framework'),
			'description' => '',
			'usage' => '[dropcaps animation="bounceInUp" type="circle" color="#C4C4C4"]Your text here...[/dropcaps]',
			'code' => '[dropcaps animation="{animation}" type="{type}" color="{color}"]{content}[/dropcaps]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'type' => array(
					'type' => 'select',
					'label' => __('Type', 'framework'),
					'values' => array(
						'default' => __('default', 'framework'),
						'circle' => __('circle', 'framework'),
						'box' => __('box', 'framework')
					),
					'default' => 'default',
					'desc' => ''
				),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Color', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'textarea',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'divider',
			'name' => __('Divider','framework'),
			'description' => '',
			'usage' => '[divider]',
			'code' => '[divider]',
			'fields' => array(
				'description' => array(
					'type' => 'description',
					'label' => __('No options here', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'framed_box',
			'name' => __('Framed box','framework'),
			'description' => '',
			'usage' => '[framed_box animation="bounceInUp" title="Your title" icon="icon-search" color="#FFFFFF" background_color="#FF0000" button_text="Click me!" url="http://..." target="_self" list_icon="icon-search"][framed_box_item]Your content here...[/framed_box_item][/framed_box]',
			'code' => '[framed_box animation="{animation}" title="{title}" icon="{icon}" color="{color}" background_color="{backgroundcolor}" button_text="{buttontext}" url="{url}" target="{target}" list_icon="{listicon}"]{child}[/framed_box]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Button text color', 'framework'),
					'desc' => ''
				),
				'backgroundcolor' => array(
					'type' => 'colorpicker',
					'label' => __('Button background color', 'framework'),
					'desc' => ''
				),
				'buttontext' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('Url', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'listicon' => array(
					'type' => 'select',
					'label' => __('List icon', 'framework'),
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
			),
			'add_child_button' => __('Add List Item', 'framework'),
			'child' => array(
				'name' => __('List item','framework'),
				'code' => '[framed_box_item]{content}[/framed_box_item]',
				'fields' => array(
					'content' => array(
						'type' => 'text',
						'label' => __('Content', 'framework'),
						'desc' => ''
					)
				)
			)
		),
		array(
			'shortcode' => 'heading',
			'name' => __('Heading','framework'),
			'description' => '',
			'usage' => '[heading animation="bounceInUp" type="1" align="center"]Your text here...[/heading]',
			'code' => '[heading animation="{animation}" type="{type}" align="{align}"]{content}[/heading]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'type' => array(
					'type' => 'select',
					'label' => __('Type', 'framework'),
					'values' => array(
						'1' => 'H1',
						'2' => 'H2',
						'3' => 'H3',
						'4' => 'H4',
						'5' => 'H5'
					),
					'default' => '1',
					'desc' => ''
				),
				'align' => array(
					'type' => 'select',
					'label' => __('Align', 'framework'),
					'values' => array(
						'alignnone' => __('none', 'framework'),
						'alignleft' => __('left', 'framework'),
						'alignright' => __('right', 'framework'),
						'aligncenter' => __('center', 'framework')
					),
					'default' => 'none',
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'highlight',
			'name' => __('Highlight','framework'),
			'description' => '',
			'usage' => '[highlight animation="bounceInUp" color="#ebebeb" color_transparency="0.40" border_color="#dedede" background_image="image.png" background_attachment="scroll" horizontal_position="left" vertical_position="top" background_stretch="no" background_video="video.avi" background_video_format="ogg" background_pattern="grid" background_pattern_color="#FF0000" background_pattern_color_transparency="20" min_height="100" first_page="no" last_page="yes" padding_top="10" padding_bottom="10" margin_bottom="0" fullwidth="yes"]Your text here...[/highlight]',
			'code' => '[highlight animation="{animation}" color="{color}" color_transparency="{colortransparency}" border_color="{bordercolor}" background_image="{backgroundimage}" background_attachment="{backgroundattachment}" background_position="{backgroundposition}" background_stretch="{backgroundstretch}" background_pattern="{backgroundpattern}" background_pattern_color="{backgroundpatterncolor}" background_pattern_color_transparency="{backgroundpatterncolortransparency}" min_height="{minheight}" first_page="{firstpage}" last_page="{lastpage}" padding_top="{paddingtop}" padding_bottom="{paddingbottom}" margin_bottom="{marginbottom}" fullwidth="{fullwidth}"]{content}[/highlight]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Color', 'framework'),
					'desc' => ''
				),
				'colortransparency' => array(
					'type' => 'select',
					'label' => __('Color transparency (%)', 'framework'),
					'desc' => '',
					'values' => ts_get_transparency_select_values(),
				),
				'bordercolor' => array(
					'type' => 'colorpicker',
					'label' => __('Border color', 'framework'),
					'desc' => ''
				),
				'backgroundimage' => array(
					'type' => 'upload',
					'label' => __('Background image', 'framework'),
					'desc' => ''
				),
				'backgroundattachment' => array(
					'type' => 'select',
					'label' => __('Background attachment', 'framework'),
					'values' => array(
						'scroll' => __('scroll', 'framework'),
						'fixed' => __('fixed', 'framework')
					),
					'default' => 'yes',
					'desc' => ''
				),
				'backgroundposition' => array(
					'type' => 'select',
					'label' => __('Background position', 'framework'),
					'values' => array(
						'left top' => __('left top','framework'),
						'left center' => __('left center','framework'),
						'left bottom' => __('left bottom','framework'),
						'right top' => __('right top','framework'),
						'right center' => __('right center','framework'),
						'right bottom' => __('right bottom','framework'),
						'center top' => __('center top','framework'),
						'center center' => __('center center','framework'),
						'center bottom' => __('center bottom','framework')
					),
					'default' => 'left top',
					'desc' => ''
				),
				'backgroundstretch' => array(
					'type' => 'select',
					'label' => __('Background stretch', 'framework'),
					'values' => array(
						'yes' => __('yes', 'framework'),
						'no' => __('no', 'framework')
					),
					'default' => 'yes',
					'desc' => ''
				),
				'backgroundpattern' => array(
					'type' => 'select',
					'label' => __('Background pattern', 'framework'),
					'values' => array(
						'no' => __('No pattern', 'framework'),
						'grid' => __('Grid', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'backgroundpatterncolor' => array(
					'type' => 'colorpicker',
					'label' => __('Background pattern color', 'framework'),
					'desc' => ''
				),
				'backgroundpatterncolortransparency' => array(
					'type' => 'select',
					'label' => __('Background pattern color transparency (%)', 'framework'),
					'values' => ts_get_percentage_select_values(true),
					'default' => 'no',
					'desc' => ''
				),
				'minheight' => array(
					'type' => 'text',
					'label' => __('Minimum height (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'firstpage' => array(
					'type' => 'select',
					'label' => __('First element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'lastpage' => array(
					'type' => 'select',
					'label' => __('Last element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'paddingtop' => array(
					'type' => 'text',
					'label' => __('Padding top (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'paddingbottom' => array(
					'type' => 'text',
					'label' => __('Padding bottom (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'marginbottom' => array(
					'type' => 'text',
					'label' => __('Margin bottom (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'fullwidth' => array(
					'type' => 'select',
					'label' => __('Full width', 'framework'),
					'values' => array(
						'yes' => __('yes', 'framework'),
						'no' => __('no', 'framework')
					),
					'default' => 'yes',
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icon',
			'name' => __('Icon','framework'),
			'description' => '',
			'usage' => '[icon animation="bounceInUp" style="1" icon="icon-glass" title="Your title"]Your content here...[/icon]',
			'code' => '[icon animation="{animation}" style="{style}" icon="{icon}" title="{title}"]{content}[/icon]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5'
					),
					'default' => '1',
					'desc' => ''
				),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icon_2',
			'name' => __('Icon 2','framework'),
			'description' => '',
			'usage' => '[icon_2 animation="bounceInUp" icon="icon-search" icon_upload="" url="http://...." target="_blank" title="Your title" subtitle="Your subtitle"]Your content here...[/icon_2]',
			'code' => '[icon_2 animation="{animation}" icon="{icon}" icon_upload="{iconupload}" title="{title}" subtitle="{subtitle}"]{content}[/icon_2]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon (choose or upload below)', 'framework'),
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'iconupload' => array(
					'type' => 'upload',
					'label' => __('Upload icon', 'framework'),
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'subtitle' => array(
					'type' => 'text',
					'label' => __('Subtitle', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icon_3',
			'name' => __('Icon 3','framework'),
			'description' => '',
			'usage' => '[icon_3 animation="bounceInUp" icon="icon-glass" icon_upload="" title="Your title" button_text="Read more" url="http://..." terget="_self"]Your content here...[/icon_3]',
			'code' => '[icon_3 animation="{animation}" icon="{icon}" icon_upload="{iconupload}" title="{title}" button_text="{buttontext}" url="{url}" terget="{target}"]{content}[/icon_3]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon (choose or upload below)', 'framework'),
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'iconupload' => array(
					'type' => 'upload',
					'label' => __('Upload icon', 'framework'),
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				),
				'buttontext' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icon_box',
			'name' => __('Icon Box','framework'),
			'description' => '',
			'usage' => '[icon_box animation="bounceInUp" style="1" icon="icon-glass" icon_upload="" effect="default" title="Your title" url="http://..." target="_blank" button_text="Click me"]Your content here...[/icon_box]',
			'code' => '[icon_box animation="{animation}" style="{style}" icon="{icon}" icon_upload="{iconupload}" effect="{effect}" title="{title}" url="{url}" target="{target}" button_text="{buttontext}"]{content}[/icon_box]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2',
						'3' => '3'
					),
					'default' => '1',
					'desc' => ''
				),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon (choose or upload below)', 'framework'),
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'iconupload' => array(
					'type' => 'upload',
					'label' => __('Upload icon', 'framework'),
					'desc' => ''
				),
				'effect' => array(
					'type' => 'select',
					'label' => __('Effect', 'framework'),
					'values' => array(
						'default' => __('Default', 'framework'),
						'highlighted' => __('Highlighted (style 1 only)', 'framework')
					),
					'default' => 'default',
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				),
				'buttontext' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('Url', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'image',
			'name' => __('Image','framework'),
			'description' => '',
			'usage' => '[image animation="bounceInUp" size="half" align="alignleft" alt="My image" title=""]image.png[/image]',
			'code' => '[image animation="{animation}" size="{size}" align="{align}" alt="{alt}" title="{title}"]{image}[/image]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'image' => array(
					'type' => 'upload',
					'label' => __('Image', 'framework'),
					'desc' => ''
				),
				'size' => array(
					'type' => 'select',
					'label' => __('Image width', 'framework'),
					'values' => array(
						'dont_scale' => __('dont scale', 'framework'),
						'full' => __('full', 'framework'),
						'half' => __('half', 'framework'),
						'one_third' => __('1/3', 'framework'),
						'one_fourth' => __('1/4', 'framework')
					),
					'default' => 'dont_scale',
					'desc' => ''
				),
				'align' => array(
					'type' => 'select',
					'label' => __('Align', 'framework'),
					'values' => array(
						'alignnone' => __('none', 'framework'),
						'alignleft' => __('left', 'framework'),
						'alignright' => __('right', 'framework'),
						'aligncenter' => __('center', 'framework')
					),
					'default' => 'none',
					'desc' => ''
				),
				'alt' => array(
					'type' => 'text',
					'label' => __('Alternative text', 'framework'),
					'desc' => ''
				),
				
				'title' => array(
					'type' => 'text',
					'label' => __('Title attribute', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'image_box',
			'name' => __('Image box','framework'),
			'description' => '',
			'usage' => '[image_box animation="bounceInUp" style="1" image="image.png" size="half" alt="My image" title=""]Your content[/image_box]',
			'code' => '[image_box animation="{animation}" style="{style}" image="{image}" size="{size}" alt="{alt}" title_attr="{titleattr}" title="{title}"]{content}[/image_box]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2'
					),
					'default' => 'dont_scale',
					'desc' => ''
				),
				'image' => array(
					'type' => 'upload',
					'label' => __('Image', 'framework'),
					'desc' => ''
				),
				'size' => array(
					'type' => 'select',
					'label' => __('Image width', 'framework'),
					'values' => array(
						'dont_scale' => __('dont scale', 'framework'),
						'full' => __('full', 'framework'),
						'half' => __('half', 'framework'),
						'one_third' => __('1/3', 'framework'),
						'one_fourth' => __('1/4', 'framework')
					),
					'default' => 'dont_scale',
					'desc' => ''
				),
				'alt' => array(
					'type' => 'text',
					'label' => __('Alternative text', 'framework'),
					'desc' => ''
				),
				'titleattr' => array(
					'type' => 'text',
					'label' => __('Title attribute', 'framework'),
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'latest_works',
			'name' => __('Latest works','framework'),
			'description' => '',
			'usage' => '[latest_works animation="bounceInUp" limit=10 navigation_color="#FFFFFF" title_color="#FFFFFF" categories_color="#DEDEDE"]',
			'code' => '[latest_works animation="{animation}" limit="{limit}" navigation_color="{navigationcolor}" title_color="{titlecolor}" categories_color="{categoriescolor}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				),
				'navigationcolor' => array(
					'type' => 'colorpicker',
					'label' => __('Navigation color', 'framework'),
					'desc' => ''
				),
				'titlecolor' => array(
					'type' => 'colorpicker',
					'label' => __('Title color', 'framework'),
					'desc' => ''
				),
				'categoriescolor' => array(
					'type' => 'colorpicker',
					'label' => __('Categories color', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'list',
			'name' => __('List','framework'),
			'description' => '',
			'usage' => '[list animation="bounceInUp"]Your UL list here...[/list]',
			'code' => '[list animation="{animation}"]<ul class="list1">{child}</ul>[/list]',
			'add_child_button' => __('Add List Item', 'framework'),
			'fields' => array(
				'animation' => ts_get_animation_effects_settings()
			),
			'child' => array(
				'name' => __('List item','framework'),
				'code' => '<li><i class="{icon}"></i> {content}</li>',
				'fields' => array(
					'icon' => array(
						'type' => 'select',
						'label' => __('Icon', 'framework'),
						'values' => ts_getFontAwesomeArray(true),
						'default' => '',
						'desc' => '',
						'class' => 'icons-dropdown'
					),	
					'content' => array(
						'type' => 'text',
						'label' => __('Content', 'framework'),
						'desc' => ''
					),
				),
			)
		),
		array(
			'shortcode' => 'list_modern',
			'name' => __('List Modern','framework'),
			'description' => '',
			'usage' => '[list_modern animation="bounceInUp" style="1"][list_modern_item title="Test title" icon="icon-glass"]Your text here...[/list_modern_item][/list_modern]',
			'code' => '[list_modern animation="{animation}" style="{style}"]{child}[/list_modern]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2'
					),
					'desc' => ''
				)
			),
			'add_child_button' => __('Add Item', 'framework'),
			'child' => array(
				'name' => __('Item','framework'),
				'code' => '[list_modern_item title="{title}" icon="{icon}"]{content}[/list_modern_item]',
				'fields' => array(
					'icon' => array(
						'type' => 'select',
						'label' => __('Icon', 'framework'),
						'values' => ts_getFontAwesomeArray(true),
						'default' => '',
						'desc' => '',
						'class' => 'icons-dropdown'
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'content' => array(
						'type' => 'textarea',
						'label' => __('Content', 'framework'),
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'mark',
			'name' => __('Mark','framework'),
			'description' => '',
			'usage' => '[mark animation="bounceInUp" background="#FF0000"]Your content here...[/mark]',
			'code' => '[mark animation="{animation}" background="{background}"]{content}[/mark]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'background' => array(
					'type' => 'colorpicker',
					'label' => __('Background color', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'message',
			'name' => __('Message','framework'),
			'description' => '',
			'usage' => '[message animation="bounceInUp" style="1" type="info"]Your content here...[/message]',
			'code' => '[message animation="{animation}" style="{style}" type="{type}"]{content}[/message]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2'
					),
					'desc' => ''
				),
				'type' => array(
					'type' => 'select',
					'label' => __('Type', 'framework'),
					'values' => array(
						'info' => __('info','framework'),
						'notice' => __('notice','framework'),
						'success' => __('success','framework'),
						'error' => __('error','framework')
					),
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'our_clients',
			'name' => __('Our clients','framework'),
			'description' => '',
			'usage' => '[our_clients animation="bounceInUp"][our_clients_item url="http://..." target="_blank"]image.png[/our_clients_item][/our_clients]',
			'code' => '[our_clients animation="{animation}"]{child}[/our_clients]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings()
			),
			'add_child_button' => __('Add Item', 'framework'),
			'child' => array(
				'name' => __('Items','framework'),
				'code' => '[our_clients_item url="{url}" target="{target}"]{image}[/our_clients_item]',
				'fields' => array(
					'url' => array(
						'type' => 'text',
						'label' => __('URL', 'framework'),
						'desc' => ''
					),
					'target' => array(
						'type' => 'select',
						'label' => __('Target', 'framework'),
						'values' => array(
							'_blank' => __('_blank', 'framework'),
							'_parent' => __('_parent', 'framework'),
							'_self' => __('_self', 'framework'),
							'_top' => __('_top', 'framework')
						),
						'default' => '_self',
						'desc' => ''
					),
					'image' => array(
						'type' => 'upload',
						'label' => __('Image', 'framework'),
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'person',
			'name' => __('Person','framework'),
			'description' => '',
			'usage' => '[persons animation="bounceInUp" id=1 align="left"]',
			'code' => '[person animation="{animation}" id="{id}" align="{align}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'id' => array(
					'type' => 'text',
					'label' => __('Person ID', 'framework'),
					'desc' => ''
				),
				'align' => array(
					'type' => 'select',
					'label' => __('Align', 'framework'),
					'values' => array(
						'left' => __('Left', 'framework'),
						'center' => __('Center', 'framework')
					),
					'default' => 'left',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'pricing_table',
			'name' => __('Pricing table','framework'),
			'description' => '',
			'usage' => '[pricing_table animation="bounceInUp"][pricing_table_column]...[/pricing_table_column][/pricing_table]',
			'code' => '[pricing_table animation="{animation}"]{child}[/pricing_table]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings()
			),
			'add_child_button' => __('Add Column', 'framework'),
			'child' => array(
				'name' => __('Column','framework'),
				'code' => '[pricing_table_column featured="{featured}" title="{title}" price="{price}" period="{period}" buttontext="{buttontext}" url="{url}"]{child}[/pricing_table_column]',
				'fields' => array(
					'featured' => array(
						'type' => 'select',
						'label' => __('Featured (only one column should be featured)', 'framework'),
						'values' => array(
							'no' => __('No', 'framework'),
							'yes' => __('Yes', 'framework')
						),
						'default' => 'no',
						'desc' => ''
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'price' => array(
						'type' => 'text',
						'label' => __('Price', 'framework'),
						'desc' => ''
					),
					'period' => array(
						'type' => 'text',
						'label' => __('Period', 'framework'),
						'desc' => ''
					),
					'buttontext' => array(
						'type' => 'text',
						'label' => __('Button Text', 'framework'),
						'desc' => ''
					),
					'url' => array(
						'type' => 'text',
						'label' => __('URL', 'framework'),
						'desc' => ''
					),
				),
				'add_child_button' => __('Add Row', 'framework'),
				'child' => array(
					'name' => __('Row','framework'),
					'code' => '[pricing_table_item text="{text}"]',
					'fields' => array(
						'text' => array(
							'type' => 'text',
							'label' => __('Text', 'framework'),
							'desc' => ''
						)
					)
				)
			)
		),
		array(
			'shortcode' => 'promo',
			'name' => __('Promo','framework'),
			'description' => '',
			'usage' => '[promo animation="bounceInUp" title="Your title" subtitle="Your subtitle" image="image.png" icon1="icon-glass" icontitle1="Icon title" iconsubtitle="Icon subtitle" icon2="ico-glass" icontitle2="Icon title" iconsubtitle2="Icon subtitle" icon3="ico-search" icontitle3="Icon title" iconsubtitle3="Icon subtitle" icon4="" icontitle4="" iconsubtitle4="" icon5="" icontitle5="" iconsubtitle5="" icon6="" icontitle6="" iconsubtitle6=""]',
			'code' => '[promo animation="{animation}" title="{title}" subtitle="{subtitle}" image="{image}" icon1="{icon1}" icontitle1="{icontitle1}" iconsubtitle1="{iconsubtitle1}" icon2="{icon2}" icontitle2="{icontitle2}" iconsubtitle2="{iconsubtitle2}" icon3="{icon3}" icontitle3="{icontitle3}" iconsubtitle3="{iconsubtitle3}" icon4="{icon4}" icontitle4="{icontitle4}" iconsubtitle4="{iconsubtitle4}" icon5="{icon5}" icontitle5="{icontitle5}" iconsubtitle5="{iconsubtitle5}" icon6="{icon6}" icontitle6="{icontitle6}" iconsubtitle6="{iconsubtitle6}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'subtitle' => array(
					'type' => 'text',
					'label' => __('Subtitle', 'framework'),
					'desc' => ''
				),
				'image' => array(
					'type' => 'upload',
					'label' => __('Image', 'framework'),
					'desc' => ''
				),
				'icon1' => array(
					'type' => 'select',
					'label' => __('Icon (1)', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'icontitle1' => array(
					'type' => 'text',
					'label' => __('Icon title (1)', 'framework'),
					'desc' => ''
				),
				'iconsubtitle1' => array(
					'type' => 'text',
					'label' => __('Icon subtitle (1)', 'framework'),
					'desc' => ''
				),
				'icon2' => array(
					'type' => 'select',
					'label' => __('Icon (2)', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'icontitle2' => array(
					'type' => 'text',
					'label' => __('Icon title (2)', 'framework'),
					'desc' => ''
				),
				'iconsubtitle2' => array(
					'type' => 'text',
					'label' => __('Icon subtitle (2)', 'framework'),
					'desc' => ''
				),
				'icon3' => array(
					'type' => 'select',
					'label' => __('Icon (3)', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'icontitle3' => array(
					'type' => 'text',
					'label' => __('Icon title (3)', 'framework'),
					'desc' => ''
				),
				'iconsubtitle3' => array(
					'type' => 'text',
					'label' => __('Icon subtitle (3)', 'framework'),
					'desc' => ''
				),
				'icon4' => array(
					'type' => 'select',
					'label' => __('Icon (4)', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'icontitle4' => array(
					'type' => 'text',
					'label' => __('Icon title (4)', 'framework'),
					'desc' => ''
				),
				'iconsubtitle4' => array(
					'type' => 'text',
					'label' => __('Icon subtitle (4)', 'framework'),
					'desc' => ''
				),
				'icon5' => array(
					'type' => 'select',
					'label' => __('Icon (5)', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'icontitle5' => array(
					'type' => 'text',
					'label' => __('Icon title (5)', 'framework'),
					'desc' => ''
				),
				'iconsubtitle5' => array(
					'type' => 'text',
					'label' => __('Icon subtitle (5)', 'framework'),
					'desc' => ''
				),
				'icon6' => array(
					'type' => 'select',
					'label' => __('Icon (6)', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'icontitle6' => array(
					'type' => 'text',
					'label' => __('Icon title (6)', 'framework'),
					'desc' => ''
				),
				'iconsubtitle6' => array(
					'type' => 'text',
					'label' => __('Icon subtitle (6)', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'recent_projects',
			'name' => __('Recent projects','framework'),
			'description' => '',
			'usage' => '[recent_projects animation="bounceInUp" limit="12" title="Your title" subtitle="Your subtitle"]',
			'code' => '[recent_projects animation="{animation}" limit="{limit}" title="{title}" subtitle="{subtitle}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'subtitle' => array(
					'type' => 'text',
					'label' => __('Subtitle', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'section',
			'name' => __('Section','framework'),
			'description' => '',
			'usage' => '[section id="your-section"]',
			'code' => '[section id="{id}"]',
			'fields' => array(
				'id' => array(
					'type' => 'text',
					'label' => __('ID', 'framework'),
					'desc' => '',
				),
			)
		),
		array(
			'shortcode' => 'simple_text',
			'name' => __('Simple text','framework'),
			'description' => '',
			'usage' => '[simple_text animation="bounceInUp"]Your text here...[/simple_text]',
			'code' => '[simple_text animation="{animation}"]{content}[/simple_text]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => __('Italic text is presented in orange', 'framework'),
				),
			)
		),
		array(
			'shortcode' => 'skillbars',
			'name' => __('Skill bars','framework'),
			'description' => '',
			'usage' => '[skillbar animation="bounceInUp"][skillbar_item percentage="80" title="Cooking"][skillbar_item percentage="99" title="Sleeping"][/skillbar]',
			'code' => '[skillbar animation="{animation}"]{child}[/skillbar]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings()
			),
			'add_child_button' => __('Add Skill Bar', 'framework'),
			'child' => array(
				'name' => __('Skill bar','framework'),
				'code' => '[skillbar_item percentage="{percentage}" title="{title}" color="{color}"]',
				'fields' => array(
					'percentage' => array(
						'type' => 'select',
						'label' => __('Percentage', 'framework'),
						'values' => ts_get_percentage_select_values(),
						'desc' => ''
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'color' => array(
						'type' => 'colorpicker',
						'label' => __('Color', 'framework'),
						'desc' => ''
					)
				)
			)
		),
		array(
			'shortcode' => 'slider',
			'name' => __('Slider','framework'),
			'description' => '',
			'usage' => '[slider animation="bounceInUp"][slide]Your text here...[/slide][/slider]',
			'code' => '[slider animation="{animation}"]{child}[/slider]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings()
			),
			'add_child_button' => __('Add Slide', 'framework'),
			'child' => array(
				'name' => __('Slide','framework'),
				'code' => '[slide title="{title}"]{content}[/slide]',
				'fields' => array(
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'content' => array(
						'type' => 'textarea',
						'label' => __('Content', 'framework'),
						'desc' => ''
					)
				)
			)
		),
		array(
			'shortcode' => 'social_links',
			'name' => __('Social Links','framework'),
			'description' => '',
			'usage' => '[social_links animation="bounceInUp"][social_link icon="icon-facebook" title="Facebook" url="http://facebook.com" target="_blank"][/social_links]',
			'code' => '[social_links animation="{animation}"]{child}[/social_links]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings()
			),
			'add_child_button' => __('Add Item', 'framework'),
			'child' => array(
				'name' => __('Item','framework'),
				'code' => '[social_link icon="{icon}" title="{title}" url="{url}" target="{target}"]',
				'fields' => array(
					'icon' => array(
						'type' => 'select',
						'label' => __('Icon', 'framework'),
						'values' => array(
							'icon-facebook' => 'icon-facebook',
							'icon-twitter' => 'icon-twitter',
							'icon-google-plus' => 'icon-google-plus',
							'icon-linkedin' => 'icon-linkedin',
							'icon-skype' => 'icon-skype',
							'icon-flickr' => 'icon-flickr',
							'icon-youtube' => 'icon-youtube',
							'icon-rss' => 'icon-rss',
						),
						'default' => '',
						'desc' => '',
						'class' => 'icons-dropdown'
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'url' => array(
						'type' => 'text',
						'label' => __('Url', 'framework'),
						'desc' => ''
					),
					'target' => array(
						'type' => 'select',
						'label' => __('Target', 'framework'),
						'values' => array(
							'_blank' => __('_blank', 'framework'),
							'_parent' => __('_parent', 'framework'),
							'_self' => __('_self', 'framework'),
							'_top' => __('_top', 'framework')
						),
						'default' => '_self',
						'desc' => ''
					)
				)
			)
		),
		array(
			'shortcode' => 'special_text',
			'name' => __('Special text','framework'),
			'description' => '',
			'usage' => '[special_text animation="bounceInUp" tagname="h2" color="#FF0000" font_size="12" font_weight="bold" font="Arial" margin_top="10" margin_bottom="10" align="left"]Your text here...[/special_text]',
			'code' => '[special_text animation="{animation}" tagname="{tagname}" color="{color}" font_size="{fontsize}" font_weight="{fontweight}" font="{font}" margin_top="{margintop}" margin_bottom="{marginbottom}" align="{align}"]{content}[/special_text]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'tagname' => array(
					'type' => 'select',
					'label' => __('Tag name', 'framework'),
					'values' => array(
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
						'div' => 'div',
					),
					'default' => 'h1',
					'desc' => ''
				),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Font color', 'framework'),
					'desc' => ''
				),
				'fontsize' => array(
					'type' => 'text',
					'label' => __('Font size', 'framework'),
					'desc' => ''
				),
				'fontweight' => array(
					'type' => 'select',
					'label' => __('Font weight', 'framework'),
					'values' => array(
						'default' => __('Default','framework'),
						'normal' => __('Normal', 'framework'),
						'bold' => __('Bold', 'framework'),
						'bolder' => __('Bolder', 'framework'),
						'300' => __('Light', 'framework')
					),
					'default' => 'default',
					'desc' => ''
				),
				'font' => array(
					'type' => 'select',
					'label' => __('Font', 'framework'),
					'desc' => '',
					'values' => ts_get_font_choices(true)
				),
				'margintop' => array(
					'type' => 'text',
					'label' => __('Margin top (px)', 'framework'),
					'desc' => ''
				),
				'marginbottom' => array(
					'type' => 'text',
					'label' => __('Margin bottom (px)', 'framework'),
					'desc' => ''
				),
				'align' => array(
					'type' => 'select',
					'label' => __('Align', 'framework'),
					'values' => array(
						'left' => __('Left','framework'),
						'center' => __('Center', 'framework'),
						'right' => __('Right', 'framework')
					),
					'default' => 'left',
					'desc' => ''
				),
				'content' => array(
					'type' => 'textarea',
					'label' => __('Content', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'space',
			'name' => __('Space','framework'),
			'description' => '',
			'usage' => '[space height="20"]',
			'code' => '[space height="{height}"]',
			'fields' => array(
				'height' => array(
					'type' => 'text',
					'label' => __('Height (px)', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'steps',
			'name' => __('Steps','framework'),
			'description' => '',
			'usage' => '[steps animation="bounceInUp"][step title="Your title"]Your content here[/step][/steps]',
			'code' => '[steps animation="{animation}"]{child}[/steps]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings()
			),
			'add_child_button' => __('Add Step', 'framework'),
			'child' => array(
				'name' => __('Step','framework'),
				'code' => '[step title="{title}"]{content}[/step]',
				'fields' => array(
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'content' => array(
						'type' => 'wp_editor',
						'label' => __('Content', 'framework'),
						'desc' => ''
					)
				)
			)
		),
		array(
			'shortcode' => 'tabs',
			'name' => __('Tabs','framework'),
			'description' => '',
			'usage' => '[tabs animation="bounceInUp" orientation="horizontal"][tab url="http://test.com" target="_blank"]Your text here...[/tab][/tabs]',
			'code' => '[tabs animation="{animation}" orientation="{orientation}"]{child}[/tabs]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'orientation' => array(
					'type' => 'select',
					'label' => __('Orientation', 'framework'),
					'values' => array(
						'horizontal' => __('horizontal','framework'),
						'vertical' => __('vertical','framework')
					),
					'desc' => ''
				)
			),
			'add_child_button' => __('Add Tab', 'framework'),
			'child' => array(
				'name' => __('Tab','framework'),
				'code' => '[tab title="{title}" icon="{icon}" iconsize="{iconsize}"]{content}[/tab]',
				'fields' => array(
					'icon' => array(
						'type' => 'select',
						'label' => __('Icon', 'framework'),
						'values' => ts_getFontAwesomeArray(true),
						'default' => '',
						'desc' => '',
						'class' => 'icons-dropdown'
					),
					'iconsize' => array(
						'type' => 'select',
						'label' => __('Icon size', 'framework'),
						'values' => array(
							'icon-regular' => 'icon-regular',
							'icon-large' => 'icon-large',
							'icon-2x' => 'icon-2x',
							'icon-4x' => 'icon-4x',
						),
						'default' => '',
						'desc' => ''
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'content' => array(
						'type' => 'textarea',
						'label' => __('Content', 'framework'),
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'teaser',
			'name' => __('Teaser','framework'),
			'description' => '',
			'usage' => '[teaser animation="bounceInUp" style="horizontal" icon="icon-glass" title="Your title"]Your content here[/teaser]',
			'code' => '[teaser animation="{animation}" style="{style}" icon="{icon}" title="{title}"]{content}[/teaser]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'horizontal' => __('Horizontal','liva'),
						'vertical' => __('Vertical','liva')
					),
					'desc' => ''
				),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'textarea',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'testimonial',
			'name' => __('Testimonial','framework'),
			'description' => '',
			'usage' => '[testimonial animation="bounceInUp" style="default" id="2"]',
			'code' => '[testimonial animation="{animation}" style="{style}" id="{id}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'default' => __('Default','framework'),
						'boxed' => __('Boxed','framework'),
						'boxed_image' => __('Boxed with image','framework')
					),
					'desc' => ''
				),
				'id' => array(
					'type' => 'text',
					'label' => __('ID', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'testimonials',
			'name' => __('Testimonials','framework'),
			'description' => '',
			'usage' => '[testimonials animation="bounceInUp" style="1" category="3" limit="3"]',
			'code' => '[testimonials animation="{animation}" style="{style}" category="{category}" limit="{limit}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2',
						'3' => '3'
					),
					'desc' => ''
				),
				'category' => array(
					'type' => 'text',
					'label' => __('Category ID', 'framework'),
					'desc' => ''
				),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'text',
			'name' => __('Text','framework'),
			'description' => '',
			'usage' => '[text animation="bounceInUp"]Your text here...[/text]',
			'code' => '[text animation="{animation}"]{text}[/text]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'text' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'tweets',
			'name' => __('Tweets','framework'),
			'description' => '',
			'usage' => '[tweets animation="bounceInUp" limit="10"]',
			'code' => '[tweets animation="{animation}" limit="{limit}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				)
			)
		)
	);
	
	//adding custom items which are not shortcodes but are required for popup.php (eg. nav-menus.php icons)
	if (isset($_GET['custom_popup_items']) && $_GET['custom_popup_items'] == 1 && function_exists('ts_get_custom_popup_items')) {
		$custom_items = ts_get_custom_popup_items();
		if (is_array($custom_items)) {
			$aHelp = array_merge($aHelp,$custom_items);
		}
	}
	
	return $aHelp;
}

/**
 * Get percentage select values
 * @param type $empty_value
 * @return int
 */
function ts_get_percentage_select_values()
{
	$a = array();
	
	for ($i = 1; $i <= 100; $i++)
	{
		$a[$i] = $i;
	}
	return $a;
}

/**
 * Get transparency values
 * @return int
 */
function ts_get_transparency_select_values()
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
		$values[$v] = $i.'%';
	}
	return $values;
}

function ts_get_animation_effects_settings() {
	
	return array(
		'type' => 'select',
		'label' => __('Animation', 'framework'),
		'desc' => '',
		'values' => ts_get_animation_effects_list()
	);
}

function ts_get_animation_effects_list() {
	
	$animations = array(
		'bounce',
		'flash',
		'pulse',
		'shake',
		'swing',
		'tada',
		'wobble',
		'bounceIn',
		'bounceInDown',
		'bounceInLeft',
		'bounceInRight',
		'bounceInUp',
		'bounceOut',
		'bounceOutDown',
		'bounceOutLeft',
		'bounceOutRight',
		'bounceOutUp',
		'fadeIn',
		'fadeInDown',
		'fadeInDownBig',
		'fadeInLeft',
		'fadeInLeftBig',
		'fadeInRight',
		'fadeInRightBig',
		'fadeInUp',
		'fadeInUpBig',
		'fadeOut',
		'fadeOutDown',
		'fadeOutDownBig',
		'fadeOutLeft',
		'fadeOutLeftBig',
		'fadeOutRight',
		'fadeOutRightBig',
		'fadeOutUp',
		'fadeOutUpBig',
		'flip',
		'flipInX',
		'flipInY',
		'flipOutX',
		'flipOutY',
		'lightSpeedIn',
		'lightSpeedOut',
		'rotateIn',
		'rotateInDownLeft',
		'rotateInDownRight',
		'rotateInUpLeft',
		'rotateInUpRight',
		'rotateOut',
		'rotateOutDownLeft',
		'rotateOutDownRight',
		'rotateOutUpLeft',
		'rotateOutUpRight',
		'slideInDown',
		'slideInLeft',
		'slideInRight',
		'slideOutLeft',
		'slideOutRight',
		'slideOutUp',
		'hinge',
		'rollIn',
		'rollOut'
	);
	$animation_effects = array();
	$animation_effects[''] = __('None', 'framework');
	foreach ($animations as $animation) {
		$animation_effects[$animation] = $animation;
	}
	
	return $animation_effects;
}