<?php
/**
 * Shortcode Title: List
 * Shortcode: list
 * Usage: [list animation="bounceInUp"]Your UL list here...[/list]
 */
add_shortcode('list', 'ts_list_func');

function ts_list_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => ''
	), $atts));

	return '<div '.ts_get_animation_class($animation, true).' data-animation="'.$animation.'">'.do_shortcode($content).'</div>';
}