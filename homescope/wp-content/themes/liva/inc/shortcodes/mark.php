<?php
/**
 * Shortcode Title: Mark
 * Shortcode: mark
 * Usage: [mark animation="bounceInUp" background="#FF0000"]Your content here...[/mark]
 */
add_shortcode('mark', 'ts_mark_func');

function ts_mark_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'background' => ''
		),
	$atts));

	if (!empty($background)) {
		$style = 'style="background-color: '.$background.'"';
	}

	return '<span class="highlight-text '.ts_get_animation_class($animation).'" data-animation="'.$animation.'" '.$style.'>'.$content.'</span>';
}