<?php
/**
 * Shortcode Title: Divider
 * Shortcode: divider
 * Usage: [divider]
 */
add_shortcode('divider', 'ts_divider_func');

function ts_divider_func( $atts, $content = null ) {
    
//	extract(shortcode_atts(array(
//		), 
//	$atts));
	return '<div class="clearfix divider_line2"></div>';
}