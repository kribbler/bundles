<?php
/**
 * Shortcode Title: Teaser
 * Shortcode: teaser
 * Usage: [teaser animation="bounceInUp" style="horizontal" icon="icon-glass" title="Your title"]Your content here[/teaser]
 */
add_shortcode('teaser', 'ts_teaser_func');

function ts_teaser_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		"style" => 'horizontal',
		"icon" => '',
		"title" => ''
		),
	$atts));

	switch ($style) {

		case 'vertical':
			$class_style = 'two';
			$icon_size = 'icon-2x';
			break;

		case 'horizontal':
		default:
			$class_style = '';
			$icon_size = 'icon-3x';
	}

	$html_content = '
		<ul class="lirc_section '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<li class="left '.$class_style.'"><i class="'.$icon.' '.$icon_size.'"></i></li>
			<li class="right '.$class_style.'"><h3><i>'.$title.'</i></h3></li>
			<li class="right '.$class_style.'">'.$content.'</li>
		</ul>';

	return $html_content;
}