<?php
/**
 * Shortcode Title: Call to action 3
 * Shortcode: call_to_action_3
 * Usage: [call_to_action_3 animation="bounceInUp" title="Your title" subtitle="Your subtitle" buttton_text="Click me!" url="http://..." target="_self"]
 */
add_shortcode('call_to_action_3', 'ts_call_to_action_3_func');

function ts_call_to_action_3_func( $atts, $content = null ) {
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
		<div class="punch_text02 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
				<b>'.$title.'
				<em>'.$subtitle.'</em></b>
				<a href="'.$url.'" target="'.$target.'" class="icon_but">'.html_entity_decode($buttton_text).'</a>
		</div><!-- end punch text 02 -->
		<div class="clear"></div>';

	return $content;
}