<?php
/**
 * Shortcode Title: Box Text
 * Shortcode: box_text
 * Usage: [box_text animation="bounceInUp" icon="icon-search" title="Your title"]Your content here...[/box_text]

 */
add_shortcode('box_text', 'ts_box_text_func');

function ts_box_text_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'icon' => '',
		'title' => ''
	),
	$atts));

	$content = ts_add_paragraph($content);

	$html = '
		<div class="box_widget_full '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<i class="'.$icon.' icon-4x"></i>
			<h3>'.$title.'</h3>
			'.$content.'
		</div>';
	return $html;

}