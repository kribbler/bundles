<?php
/**
 * Shortcode Title: Call to action 4
 * Shortcode: call_to_action_4
 * Usage: [call_to_action_4 animation="bounceInUp" title="Your title" subtitle="Your subtitle" buttton_text="Click me!" url="http://..." target="_self"]
 */
add_shortcode('call_to_action_4', 'ts_call_to_action_4_func');

function ts_call_to_action_4_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		"title" => "",
		"subtitle" => "",
		"buttton_text" => "",
		"url" => "",
		"target" => ""
		),
	$atts));

	$content = '
	  <div class="call-to-action2 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<h2>'.$title.'</h2>
			<h3>'.$subtitle.'</h3>
			<div class="clearfix mar_top3"></div>
			<a href="'.$url.'" target="'.$target.'" class="but_transp">'.html_entity_decode($buttton_text).'</a>
		</div>
	  <div class="clear"></div>';

	return $content;
}