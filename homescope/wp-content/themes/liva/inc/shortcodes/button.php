<?php
/**
 * Shortcode Title: Button
 * Shortcode: button
 * Usage: [button animation="bounceInUp" color="#555555" background_color="#FF0000" icon="icon-briefcase" icon_upload="" url="http://yourdomain.com" target="_blank" ]Your content here...[/button]
 */
add_shortcode('button', 'ts_button_func');

function ts_button_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		"color" => '',
		"background_color" => '',
		"url" => '',
		'icon' => '',
		'icon_upload' => '',
		'target' => '_self'
		),
	$atts));

	if (empty($url))
	{
		$url = '#';
	}

	$icon_html = '';
	if (!empty($icon_upload)) {
		$icon_html = '<img src="'.$icon_upload.'" />';
	} else if (!empty($icon) && $icon != 'no') {
		$icon_html = '<i class="'.$icon.' icon-large"></i>';
	}

	return '<a href="'.$url.'" target="'.$target.'" class="but '.ts_get_animation_class($animation).'" data-animation="'.$animation.'" style="'.(!empty($color) ? 'color:'.$color.';': '').''.(!empty($background_color) ? 'background-color:'.$background_color.';': '').'">'.$icon_html.' '.$content.'</a>';
}