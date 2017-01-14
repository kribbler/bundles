<?php
/**
 * Shortcode Title: Section
 * Shortcode: section
 * Usage: [section id="x"]
 */
add_shortcode('section', 'section_func');

function section_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'id' => ''
	), $atts));
	return '<div id="'.$id.'" class="section"></div>';
}