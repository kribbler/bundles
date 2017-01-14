<?php
/**
 * Shortcode Title: Icon 3
 * Shortcode: icon_3
 * Usage: [icon_3 animation="bounceInUp" icon="icon-glass" icon_upload="" title="Your title" button_text="Read more" url="http://..." terget="_self"]Your content here...[/icon_3]

 */
add_shortcode('icon_3', 'ts_icon_3_func');

function ts_icon_3_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'icon' => '',
		'icon_upload' => '',
		'title' => '',
		'button_text' => '',
		'url' => '',
		'target' => ''
	),
	$atts));

	$icon_html = '';
	if (!empty($icon_upload)) {
		$icon_html = '<img src="'.$icon_upload.'" />';
	} else {
		$icon_html = '<i class="'.$icon.' icon-4x"></i>';
	}

	$content = ts_add_paragraph($content);

	$html = '
		<div class="icon-box5 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			'.$icon_html.'
			<h2>'.$title.'</h2>
			'.$content.'
			<br />
			' .(!empty($url) ? '<a href="'.$url.'" target="'.$target.'">'.$button_text.' <i class="icon-angle-right"></i></a> ': ''). '
        </div>';
	return $html;
}