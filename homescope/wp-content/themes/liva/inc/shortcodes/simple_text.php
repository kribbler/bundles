<?php
/**
 * Shortcode Title: Simple text
 * Shortcode: simple_text
 * Usage: [simple_text animation="bounceInUp"]Your text here...[/simple_text]
 */
add_shortcode('simple_text', 'simple_text_func');

function simple_text_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => ''
	), $atts));

	$content = ts_add_paragraph($content);

	return '<div class="big_text1 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">'.$content.'</div>';
}