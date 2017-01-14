<?php

function slider($atts, $content = null) {
   extract(shortcode_atts(array('nav_slider' => '', 'background' => 'none'), $atts));
   $output = "";
   $output .= '<div id="slider-shortcode" class="raised flexslider_m flexslider"><ul class="slides">'. do_shortcode($content) .'</ul></div>';
   return $output;
}
add_shortcode('slider', 'slider');


function slider_item($atts, $content = null) {
	extract(shortcode_atts(array('image_url' => ''), $atts));
   $output = "";
   $output .= '<li><img src="'.$image_url.'" alt=""/></li>';
   return $output;
}
add_shortcode('slider_item', 'slider_item');


?>