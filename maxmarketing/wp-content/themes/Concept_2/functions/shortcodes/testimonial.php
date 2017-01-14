<?php

function testimonial($atts, $content = null) {
	extract(shortcode_atts(array('margin' => '10', 'margin_b' => '10'), $atts));
	global $concept7_data;
	global $post;
	$output = "";
	$output .= '
	<div id="testimonial" class="testimonial-full flexslider flexslider_t" style="margin-top:'.$margin.'px;margin-bottom:'.$margin_b.'px;"><ul class="testimonial slides">';
		query_posts( array('posts_per_page' => -1, 'post_type' =>'testimonial') );
		if (have_posts()) : while(have_posts()) : the_post();
			$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
			$output .= '<li>';
			if($thumbnail)$output .= ' <div class="testimonial-img-wrapper"><img src="'.aq_resize($thumbnail, 80, 80, true).'" /></div>';
			$output .= ' <div class="testimonial-content-wrapper">
			<p class="radius-5">'.get_the_content().'</p><h6>- ' .get_post_meta( $post->ID, 'client', true ). ' -</h6>
			</div>
			</li>';
		endwhile; endif;wp_reset_query();
		$output .= '</ul>
	</div>';

   	return $output;
}
add_shortcode('testimonial', 'testimonial');

function testimonial_2_wrapper($atts, $content = null) {
	extract(shortcode_atts(array('margin' => '10', 'margin_b' => '10'), $atts));
	global $concept7_data;
	global $post;
	$output = "";
	$output .='<div class="row testimonial-normal-wrapper" style="margin-top:'.$margin.'px;margin-bottom:'.$margin_b.'px;">'. do_shortcode($content) .'</div>';
   	return $output;
}
add_shortcode('testimonial_2_wrapper', 'testimonial_2_wrapper');


function testimonial_2($atts, $content = null) {
	extract(shortcode_atts(array('column' => '', 'image' => '', 'title' => '', 'position' => 'false'), $atts));
	global $concept7_data;
	global $post;
	$output = "";
	$output .='<div class="'.$column.'"><div class="testimonial-normal"><div class="triangle-topleft-backface"></div><div class="triangle-topleft"></div>
										<div class="testimonial-normal-content">
											<i class="icon-quote-left"></i>
											<p>'. do_shortcode($content) .'</p>
										</div>
										<div class="testimonial-normal-author">';
					$output .= '<div class="testimonial-normal-img-wrapper"><img src="'.$image.'" /></div>';
					$output .= '<div class="testimonial-normal-position">
									<h5 class="name">'.$title.'</h5>
									<h5 class="position">'.$position.'</h5>
								</div>';
					$output .='</div></div></div>';
   	return $output;
}
add_shortcode('testimonial_2', 'testimonial_2');

function testimonial_2_slide_wrapper($atts, $content = null) {
	extract(shortcode_atts(array('margin' => '10', 'margin_b' => '10', 'column' => ''), $atts));
	global $concept7_data;
	global $post;
	$output = "";
	$output .='<div class=" testimonial_2_slide_wrapper flexslider flexslider_t" style="margin-top:'.$margin.'px;margin-bottom:'.$margin_b.'px;"><ul class="'.$column.' slides">'. do_shortcode($content) .'</ul></div>';
   	return $output;
}
add_shortcode('testimonial_2_slide_wrapper', 'testimonial_2_slide_wrapper');


function testimonial_2_slide($atts, $content = null) {
	extract(shortcode_atts(array('column' => '', 'image' => '', 'title' => '', 'position' => 'false'), $atts));
	global $concept7_data;
	global $post;
	$output = "";
	$output .='<li class="testimonial-normal">
										<div class="testimonial-normal-content">
											<i class="icon-quote-left"></i>
											<p>'. do_shortcode($content) .'</p>
										</div>
										<div class="testimonial-normal-author">';
					$output .= '<div class="testimonial-normal-img-wrapper"><img src="'.$image.'" /></div>';
					$output .= '<div class="testimonial-normal-position">
									<h5 class="name">'.$title.'</h5>
									<h5 class="position">'.$position.'</h5>
								</div>';
					$output .='</div></li>';
   	return $output;
}
add_shortcode('testimonial_2_slide', 'testimonial_2_slide');


?>