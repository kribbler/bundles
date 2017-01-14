<?php
/**
 * Shortcode Title: Call to action 2
 * Shortcode: call_to_action_2
 * Usage: [call_to_action_2 animation="bounceInUp" title="Your title" buttton_text="Click me" url="http://...." target="_self" first_page="no" last_page="no"]
 */
add_shortcode('call_to_action_2', 'ts_call_to_action_2_func');

function ts_call_to_action_2_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		"title" => "",
		"buttton_text" => "",
		"url" => "",
		"target" => "",
		'first_page' => '',
		'last_page' => ''
		),
	$atts));

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
	
	$content = '
		 <div class="sc-highlight-full-width '.ts_get_animation_class($animation).' call-to-action-2 '.$classes.'" data-animation="'.$animation.'">
            <div class="sc-highlight">
                <div class="punch_text">
                    <b>'.$title.'</b> <a href="'.$url.'" target="'.$target.'">'.$buttton_text.'</a>
                </div><!-- end punch text -->
                <div class="clear"></div>
            </div>
        </div>';

	return $content;
}