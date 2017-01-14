<?php
/**
 * Shortcode Title: Icon 2
 * Shortcode: icon_2
 * Usage: [icon_2 animation="bounceInUp" icon="icon-search" icon_upload="" url="http://...." target="_blank" title="Your title" subtitle="Your subtitle"]Your content here...[/icon_2]

 */
add_shortcode('icon_2', 'ts_icon_2_func');

function ts_icon_2_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'icon' => '',
		'icon_upload' => '',
		'title' => '',
		'subtitle' => ''
	),
	$atts));

	$icon_html = '';
	if (!empty($icon_upload)) {
		$icon_html = '<img src="'.$icon_upload.'" alt="'.esc_attr($title).'" />';
	} else {
		$icon_html = '<i class="'.$icon.' icon-2x"></i> ';
	}

	$content = ts_add_paragraph($content);

	$html = '
		<div class="icon-box2 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			'.$icon_html.'
			<h2>'.$title.'<br /><em>'.$subtitle.'</em></h2>
			'.$content.'
		</div>';
	return $html;

}