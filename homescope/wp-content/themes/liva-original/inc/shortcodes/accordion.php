<?php
/**
 * Shortcode Title: For Sidebar Accordion
 * Shortcode: accordion
 * Usage: [accordion animation="bounceInUp" open="yes"][accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle][/accordion]
 */
add_shortcode('accordion', 'ts_accordion_func');

function ts_accordion_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'animation' => '',
		'open' => 'no'
	), $atts));

	global $single_tab_array;
	$single_tab_array = array(); // clear the array

	do_shortcode($content);
	$i = 0;

	$tabs_nav = '';
	foreach ($single_tab_array as $tab => $tab_attr_array) {

		$open_class = '';
		if ($open == "yes" && $i == 0)
		{
			$open_class = 'active';
		}

		$tabs_nav .= '
			<span class="acc-trigger '.$open_class.'"><a href="#">'.$tab_attr_array['title'].'</a></span>
			<div class="acc-container">
				<div class="content">
					' . $tab_attr_array['content'] . '
				</div>
			</div>';
		$i++;
	}
	$single_tab_array = array();
	return '<div '.ts_get_animation_class($animation,true).' data-animation="'.$animation.'">'.$tabs_nav.'</div>';
}

/**
 * Shortcode Title: For Accordion Sidebar Toggle
 * Shortcode: accordion_toggle
 * Usage: [accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
 */
add_shortcode('accordion_toggle', 'ts_accordion_toggle_func');

function ts_accordion_toggle_func($atts, $content = null) {
	extract(shortcode_atts(array(
				'title' => '',
					), $atts));
	global $single_tab_array;
	$single_tab_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
	return '';
}

