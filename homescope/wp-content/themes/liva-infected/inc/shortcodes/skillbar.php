<?php
/**
 * Shortcode Title: Skillbar
 * Shortcode: skillbar
 * Usage: [skillbar animation="bounceInUp"][skillbar_item percentage="80" title="Cooking"][skillbar_item percentage="99" title="Sleeping"][/skillbar]
 */
add_shortcode('skillbar', 'ts_skillbar_func');
function ts_skillbar_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => ''
	), $atts));

	return '<div '.ts_get_animation_class($animation, true).' data-animation="'.$animation.'">'.do_shortcode($content).'</div>';
}

/**
 * Shortcode Title: Skill Bar
 * Shortcode: bar
 * Usage: [skillbar_item percentage="80" title="Cooking"][skillbar_item percentage="99" title="Sleeping"]
 */
add_shortcode('skillbar_item', 'ts_skillbar_item_func');
function ts_skillbar_item_func( $atts, $content = null ) {
	extract(shortcode_atts(array(
	    'percentage' => 0,
	    'title' => '',
	    'height' => 0,
		'color' => ''
    ), $atts));

	if ((int)$percentage > 100)
	{
		$percentage = 100;
	}
	else if ((int)$percentage < 1)
	{
		$percentage = 1;
	}

	return '
		<div class="ui-progress-bar ui-container">
			<div class="ui-progress">
			  <span class="ui-label">'.$title.'  <b class="value" data-value="'.(int)$percentage.'">'.(int)$percentage.'%</b></span>
			</div>
		  </div>';
}