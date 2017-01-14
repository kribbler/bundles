<?php
/**
 * Shortcode Title: Counters
 * Shortcode: counters
 * Usage: [counters animation="bounceInUp"][counters_item title="Awards" value="123" speed="1500" sign="$" sign_position="before"][/counters]
 */
add_shortcode('counters', 'ts_counters_func');

function ts_counters_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => ''
	), $atts));

	global $shortcode_counters;

	$shortcode_counters = array(); // clear the array
    do_shortcode($content); // execute the '[counters_item]' shortcode first to get the title and content

	$counters_content = '';
	foreach ($shortcode_counters as $counter) {
		
		$before = '';
		$after = '';
		if ($counter['sign_position'] == 'before') {
			$before = $counter['sign'];
		} else {
			$after = $counter['sign'];
		}
		
		$counters_content .= '<li data-quantity="'.$counter['value'].'" data-speed="'.$counter['speed'].'" data-sign="'.$counter['sign'].'" data-sign-position="'.$counter['sign_position'].'"><b>'.$before.$counter['value'].$after.'</b> '.$counter['title'].'</li>';
	}
    $shortcode_counters = array();

	$content = '
		 <ul class="fun_facts '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			'.$counters_content.'
		</ul>
		<div class="clear"></div>';

	return $content;
}

/**
 * Shortcode Title: Counters Item - can be used only with counters shortcode
 * Shortcode: counters_item
 * Usage: [counters_item title="Awards" value="123" speed="1500" sign="$" sign_position="before"]
 */
add_shortcode('counters_item', 'ts_counters_item_func');
function ts_counters_item_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title' => '',
	    'value' => '',
		'speed' => '',
		'sign' => '',
		'sign_position' => '',
    ), $atts));
    global $shortcode_counters;

	$shortcode_counters[] = array(
		'title' => $title,
		'value' => $value,
		'speed' => $speed,
		'sign' => $sign,
		'sign_position' => $sign_position,
	);
}
