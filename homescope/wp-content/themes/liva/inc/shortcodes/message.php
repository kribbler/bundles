<?php
/**
 * Shortcode Title: Message
 * Shortcode: message
 * Usage: [message animation="bounceInUp" style="1" type="info"]Your content here...[/message]
 */
add_shortcode('message', 'ts_message_func');

function ts_message_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'style' => 1,
		'type' => 'info'
		),
	$atts));

	return '
		<div class="'.$type.' '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<div class="message-box-wrap">
				'.($style == 2 ? '<button class="close-but" id="colosebut1">'.__('close','liva').'</button>' : '').$content.'
			</div>
		</div>';
}