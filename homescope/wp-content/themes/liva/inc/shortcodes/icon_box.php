<?php
/**
 * Shortcode Title: Icon Box
 * Shortcode: icon_box
 * Usage: [icon_box animation="bounceInUp" style="1" icon="icon-glass" icon_upload="" effect="default" title="Your title" url="http://..." target="_blank" button_text="Click me"]Your content here...[/icon_box]

 */
add_shortcode('icon_box', 'ts_icon_box_func');

function ts_icon_box_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'style' => '1',
		'icon' => '',
		'icon_upload' => '',
		'effect' => '',
		'title' => '',
		'url' => '',
		'target' => '_self',
		'button_text' => ''
	),
	$atts));

	$icon_html = '';
	if (!empty($icon_upload)) {
		$icon_html = '<img src="'.$icon_upload.'" />';
	} else if ($icon != 'no') {
		$icon_html = '<i class="'.$icon.' icon-4x"></i>';
	}

	$class = '';
	if ($effect == 'highlighted') {
		$class = 'helight';
	}

	$content = ts_add_paragraph($content);

	switch ($style) {
		case '2':
			$html = '
			<div class="icon-box-style2 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
				'.$icon_html.'
				<div class="clearfix"></div>
				<h4>'.$title.'</h4>
				'.$content.'
				<br />
				<a '.(empty($url) ? 'href="#"' : 'href="'.$url.'" target="'.$target.'"').'>'.$button_text.' </a>
			</div>';
			break;
		
		case '3':
			$html = '
				<div class="icon-box-style3 '.$class.' '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					'.$icon_html.'
					<div class="clearfix"></div>
					<h2>'.$title.'</h2>
					'.$content.'
					<a '.(empty($url) ? 'href="#"' : 'href="'.$url.'" target="'.$target.'"').'>'.$button_text.' <i class="icon-angle-right"></i></a>
				</div>';
			break;
		
		case '1':
		default:
			$html = '
				<div class="icon-box '.$class.' '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					'.$icon_html.'
					<div class="clearfix"></div>
					<h2>'.$title.'</h2>
					'.$content.'
					<a '.(empty($url) ? 'href="#"' : 'href="'.$url.'" target="'.$target.'"').'>'.$button_text.' <i class="icon-angle-right"></i></a>
				</div>';
			break;
	}
	return $html;
}