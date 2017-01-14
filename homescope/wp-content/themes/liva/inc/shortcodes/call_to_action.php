<?php
/**
 * Shortcode Title: Call to action
 * Shortcode: call_to_action
 * Usage: [call_to_action animation="bounceInUp" style="1" title="Your title" subtitle="Your subtitle" icon="icon-glass" buttton_text="Click me!" url="http://..." target="_self" first_page="no" last_page="no"]
 */
add_shortcode('call_to_action', 'ts_call_to_action_func');

function ts_call_to_action_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		"style" => 1,
		"title" => "",
		"subtitle" => "",
		"icon" => "",
		"buttton_text" => "",
		"url" => "",
		"target" => "",
		'first_page' => '',
		'last_page' => ''
		),
	$atts));

	$icon_html = '';
	if (!empty($icon) && $icon != 'no') {
		$icon_html = '<i class="'.$icon.' icon-large"></i>';
	}
	
	$classes_array = array();
	if ($first_page == 'yes') {
		$classes_array[] = 'first-page';
	}
	
	if ($last_page == 'yes') {
		$classes_array[] = 'last-page';
	}
	
	$classes = '';
	if (count($classes_array) > 0 ) {
		$classes = implode(' ',$classes_array);
	}
	
	switch ($style) {
		case 2:
			$content = '
				<div class="punch_text03 '.ts_get_animation_class($animation).' '.$classes.'" data-animation="'.$animation.'">
						<div class="left">
							<h1>'.$title.'
							<em>'.$subtitle.'</em></h1>
						</div><!-- end left -->
						<div class="right"><a href="'.$url.'" target="'.$target.'">'.$icon_html.'&nbsp; '.$buttton_text.'</a></div><!-- end right -->
				</div>';
			break;

		case 3:
			$content = '
				<div class="punch_text03 alternative_punch '.ts_get_animation_class($animation).' '.$classes.'" data-animation="'.$animation.'">
						<div class="left">
							<h1>'.$title.'
							<em>'.$subtitle.'</em></h1>
						</div><!-- end left -->
						<div class="right"><a href="'.$url.'" target="'.$target.'">'.$icon_html.'&nbsp; '.$buttton_text.'</a></div><!-- end right -->
				</div>';
			break;

		case 1:
		default:
			$content = '
				<div class="punchline_text_box '.ts_get_animation_class($animation).' '.$classes.'" data-animation="'.$animation.'">
					<div class="left">
						<strong>'.$title.'</strong>
						<p>'.$subtitle.'</p>
					</div>
					<div class="right">
						<a href="'.$url.'" target="'.$target.'" class="knowmore_but">'.$icon_html.' '.$buttton_text.'</a>
					</div>
				</div>';
			break;
	}


	return $content;
}