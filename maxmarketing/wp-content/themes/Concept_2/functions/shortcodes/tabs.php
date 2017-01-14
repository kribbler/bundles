<?php
function tabs($atts, $content = null) {
   
   return '<div id="tabsholder">'. do_shortcode($content) .'</div>';
}
add_shortcode('tabs', 'tabs');

function tabs_title($atts, $content = null) {
   return '<ul class="nav nav-tabs" id="myTab">'. do_shortcode($content) .'</ul>';
}
add_shortcode('tabs_title', 'tabs_title');

function title($atts, $content = null) {
	extract(shortcode_atts(array('id'=>'','icon' => ''), $atts));
   return '<li><a href="#'.$id.'" data-toggle="tab">'. do_shortcode($content) .'</a></li>';
}
add_shortcode('title', 'title');

function tabs_content($atts, $content = null) {
   return '<div class="tab-content">'. do_shortcode($content) .'</div>';
}
add_shortcode('tabs_content', 'tabs_content');

function content_tabs($atts, $content = null) {
	extract(shortcode_atts(array('id'=>''), $atts));
   return '<div class="tab-pane fade in" id="'.$id.'">'. do_shortcode($content) .'</div>';
}
add_shortcode('content_tabs', 'content_tabs');

?>