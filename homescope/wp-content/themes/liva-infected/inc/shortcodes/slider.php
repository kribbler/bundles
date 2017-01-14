<?php
/**
 * Shortcode Title: Slider
 * Shortcode: Slider
 * Usage: [slider animation="bounceInUp"][slide]Your text here...[/slide][/slider]
 */
add_shortcode('slider', 'ts_slider_func');

function ts_slider_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => ''
	), $atts));

	global $shortcode_slider;
    $shortcode_slider = array(); // clear the array
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content

	$slider_nav = '';
	$slider_content = '';
	$i = 1;
	$count = count($shortcode_slider);
	foreach ($shortcode_slider as $slide) {

		$slider_nav .= '
			<div class = "item '. ($i == 1 ? 'selected' : '') .'">
				<ul class="iosslider-item-list '. ($i == $count ? 'last' : '') .'">
					<li>'.$slide['title'].'</li>
				</ul>
			</div>';

		$slider_content .= '
			<div class = "item item'.$i.'">
				<div class="inner">
					'.$slide['content'].'
				</div>
			</div>';
		$i++;
	}
    $shortcode_slider = array();

	$content = '
		<div class="services_slider_sec '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<div class="container">
				<div class = "fluidHeight">
					<div class = "sliderContainer">
						<div class = "iosSlider">
							<div class = "slider">
								'.$slider_content.'
							</div>
						</div>

						<div class = "slideSelectors">
							<div class="container">
								'.$slider_nav.'
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>';

	return $content;
}

/**
 * Shortcode Title: Slide - can be used only with slider shortcode
 * Shortcode: slide
 * Usage: [slider][slide ]Your text here...[/tab][/tabs]
 * Options: action="url/open"
 */
add_shortcode('slide', 'ts_slide_func');
function ts_slide_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title' => ''
	), $atts));
    global $shortcode_slider;
    $shortcode_slider[] = array(
		'title' => $title,
		'content' => trim(do_shortcode($content)));
}