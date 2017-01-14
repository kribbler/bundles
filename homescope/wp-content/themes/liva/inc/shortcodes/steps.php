<?php
/**
 * Shortcode Title: Steps
 * Shortcode: steps
 * Usage: [steps animation="bounceInUp"][step title="Your title"]Your content here[/step][/steps]
 */
add_shortcode('steps', 'ts_steps_func');

function ts_steps_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => ''
	), $atts));

	global $shortcode_steps;
    $shortcode_steps = array();
    do_shortcode($content);

	$steps_content = '';
	$i = 1;
	$steps_count = count($shortcode_steps);
	foreach ($shortcode_steps as $step) {

		$steps_content .= '
			<ul class="lirt_section">
            	<li class="left">'.$i.'</li>
                <li><strong>'.$step['title'].'</strong> '.$step['content'].'</li>
            </ul><!-- end section -->

            <div class="clearfix mar_top2"></div>';

		$i++;
	}
	//reset array for another steps shortcode
    $shortcode_steps = array();

	$content = $steps_content;

	return '<div '.ts_get_animation_class($animation, true).' data-animation="'.$animation.'">'.$content.'</div>';
}

/**
 * Shortcode Title: Step - can be used only with steps shortcode
 * Shortcode: step
 * Usage: [step title="Your title"]Your content here[/step]
 */
add_shortcode('step', 'ts_step_func');
function ts_step_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title' => ''
    ), $atts));
    global $shortcode_steps;
	$content = ts_add_paragraph($content);
    $shortcode_steps[] = array(
		'title' => $title,
		'content' => $content
	);
}