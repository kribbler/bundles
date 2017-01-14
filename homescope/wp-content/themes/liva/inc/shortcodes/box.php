<?php
/**
 * Shortcode Title: Box
 * Shortcode: box
 * Usage: [box animation="bounceInUp" icon="icon-search" title="Your title"]Your content here...[/box]

 */
add_shortcode('box', 'ts_box_func');

function ts_box_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'icon' => '',
		'title' => ''
	),
	$atts));

	$content = ts_add_paragraph($content);

	$html = '
		<ul class="fullimage_box2 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
        	<li><i class="'.$icon.' icon-3x"></i></li>
            <li><h3>'.$title.'</h3></li>
            <li>'.$content.'</li>
        </ul>';
	return $html;

}