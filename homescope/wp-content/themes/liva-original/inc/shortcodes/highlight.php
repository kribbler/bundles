<?php
/**
 * Shortcode Title: Highlight
 * Shortcode: highlight
 * Usage: [highlight animation="bounceInUp" color="#ebebeb" color_transparency="0.40" border_color="#dedede" background_image="image.png" background_attachment="scroll" horizontal_position="left" vertical_position="top" background_stretch="no" background_video="video.avi" background_video_format="ogg" background_pattern="grid" min_height="100" first_page="no" last_page="yes" padding_top="10" padding_bottom="10" margin_bottom="0" fullwidth="yes"]Your text here...[/highlight]
 */
add_shortcode('highlight', 'highlight_func');

function highlight_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'fullwidth' => 'yes',
		'color' => '',
		'color_transparency' => '',
		'border_color' => '',
		'background_image' => '',
		'background_attachment' => '',
		'background_position' => '',
		'background_stretch' => '',
		'background_pattern' => '',
		'background_pattern_color' => '',
		'background_pattern_color_transparency' => '',
		'min_height' => '',
		'first_page' => '',
		'last_page' => '',
		'padding_top' => '',
		'padding_bottom' => '',
		'margin_bottom' => ''
		),
	$atts));

	$classes = array();
	$styles = array();

	if ($fullwidth == 'yes')
	{
		$classes[] = 'sc-highlight-full-width';
	}
	else
	{
		$classes[] = 'sc-highlight-standard';
	}

	$background_color_style = '';
	if (!empty($color)) {
		if (!empty($color_transparency)) {
			$styles[] = $background_color_style = 'background-color: '.ts_hex_to_rgb($color,$color_transparency).';';
		} else {
			$styles[] = $background_color_style = 'background-color: '.$color.';';
		}
	}

	if (!empty($border_color)) {
		$styles[] = 'border: 1px solid '.$border_color.';';
	}

	if (!empty($background_image)) {
		$styles[] = 'background-image: url('.$background_image.');';
	}

	if (!empty($background_attachment)) {
		$styles[] = 'background-attachment: '.$background_attachment.';';
	}

	if (intval($min_height)) {
		$styles[] = 'min-height: '.intval($min_height).'px;';
	}

	if (!empty($background_position)) {
		$styles[] = 'background-position: '.$background_position.';';
	}

	if ($background_stretch == 'yes') {
		$styles[] = 'background-size: 100% 100%;';
	}

	if (intval($padding_top)) {
		$styles[] = 'padding-top: '.intval($padding_top).'px;';
	}

	if (intval($padding_bottom)) {
		$styles[] = 'padding-bottom: '.intval($padding_bottom).'px;';
	}

	if ($first_page == 'yes') {
		$styles[] = 'margin-top: -50px;';
	}

	if ($last_page == 'yes') {
		$styles[] = 'margin-bottom: -70px;';
	}

	if (intval($margin_bottom)) {
		$styles[] = 'margin-bottom: '.intval($margin_bottom).'px;';
	}

	$background_pattern_html = '';
	if (!empty($background_pattern) && $background_pattern != 'no') {
		
		$transparency = round((100 - $background_pattern_color_transparency)/100,2);
		
		$bcp = '';
		if (!empty($background_pattern_color)) {
			$bcp = 'style="background-color: '.ts_hex_to_rgb($background_pattern_color,$transparency).'"';
		}
		
		switch ($background_pattern) {
			case 'grid':
			default:
				$background_pattern_html = '<div class="video-pattern" '.$bcp.'></div>';
		}
	}
	
	return '
		<div class="'.implode(' ',$classes).' '.ts_get_animation_class($animation).'" data-animation="'.$animation.'" style="'.implode(' ',$styles).'">
			'.$background_pattern_html.'
			<div class="sc-highlight">'.do_shortcode(ts_add_paragraph($content)).'<div class="clear"></div></div>
		</div>';
}