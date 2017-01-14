<?php
/**
 * Shortcode Title: Icon
 * Shortcode: icon
 * Usage: [icon animation="bounceInUp" style="1" icon="icon-glass" title="Your title"]Your content here...[/icon]

 */
add_shortcode('icon', 'ts_icon_func');

function ts_icon_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'style' => '1',
		'icon' => '',
		'title' => ''
	),
	$atts));

	if ($icon == 'none') {
		$icon = '';
	}

	$content = ts_add_paragraph($content);

	switch ($style) {
		case 2:
			$html = '
				<div class="icon-box3 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<div class="icon"><i class="'.$icon.' icon-2x"></i></div>
					<h2>'.$title.'</h2>
					'.$content.'
                </div>
			';
			break;

		case 3:
			$html = '
				<div class="icon-box4 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
                    <i class="'.$icon.' icon-4x"></i>
                    <h2>'.$title.'</h2>
                    '.$content.'
                </div>';
			break;

		case 4:
			$html = '
				<ul class="lirc_section '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<li class="left"><i class="'.$icon.' icon-3x"></i></li>
					<li class="right"><h3><i>'.$title.'</i></h3></li>
					<li class="right">'.$content.'</li>
				</ul>';
			break;

		case 5:
			$html = '
				<ul class="lirc_section '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<li class="left two"><i class="'.$icon.' icon-2x"></i></li>
					<li class="right two"><h3><i>'.$title.'</i></h3></li>
					<li class="right two">'.$content.'</li>
				</ul>';
			break;

		case 1:
		default:
			$html = '
				<ul class="get_features_list '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<li class="left"><i class="'.$icon.' icon-2x"></i></li>
					<li class="right">
						<h5>'.$title.'</h5>
						'.$content.'
					</li>
				</ul>';
	}
	return $html;

}