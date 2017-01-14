<?php

function block_title($atts, $content = null) {
	extract(shortcode_atts(array('margin' => '5', 'margin_b' => '5', 'title' => ''), $atts));
   return '<div class="block-title" style="margin:'.$margin.'px 0 '.$margin_b.'px;"><h2>'.htmlspecialchars_decode($title).'</h2><div class="bottom-line"></div></div>';
}
add_shortcode('block_title', 'block_title');

function block_title_2($atts, $content = null) {
	extract(shortcode_atts(array('margin' => '5', 'margin_b' => '5', 'title' => '', 'subtitle' => ''), $atts));
	if(!$subtitle) $style = ' style="line-height:1.5; padding:0 120px; font-size:36px;"'; else $style = '';
   return '<div class="block-title-2" style="margin:'.$margin.'px auto '.$margin_b.'px auto;"><h2'.$style.'>'.htmlspecialchars_decode($title).'</h2><p>'.$subtitle.'</p></div>';
}
add_shortcode('block_title_2', 'block_title_2');

function block_title_3($atts, $content = null) {
	extract(shortcode_atts(array('margin' => '5', 'margin_b' => '5', 'title' => '', 'subtitle' => '', 'show_button' => '', 'link_to' => '#', 'link_text' => '', 'text_align' => 'left', 'button_align' => 'left'), $atts));
   $output = '<div class="block-title-3" style="margin:'.$margin.'px auto '.$margin_b.'px auto; text-align: '.$text_align.'"><h2>'.htmlspecialchars_decode($title).'</h2><p>'.$subtitle.'</p>';
   if($show_button == '1') $output .= '<div class="clearfix"></div><div class="block-button" style="text-align:'.$button_align.'"><a href="'.$link_to.'" class="btn no_colored_bg white_color">'.$link_text.'</a></div>';
   $output .= '</div>';
   return $output;
}
add_shortcode('block_title_3', 'block_title_3');

function block_title_4($atts, $content = null) {
	extract(shortcode_atts(array('margin' => '5', 'margin_b' => '5', 'title' => '', 'subtitle' => '', 'show_button' => '', 'link_to' => '#', 'link_text' => '', 'button_align' => 'left'), $atts));
   $output = '<div class="block-title-4" style="margin:'.$margin.'px auto '.$margin_b.'px auto;"><h2>'.htmlspecialchars_decode($title).'</h2><p>'.$subtitle.'</p>';
   if($show_button == '1') $output .= '<div class="clearfix"></div><div class="block-button" style="text-align:'.$button_align.'"><a class="btn btn-nobg btn-style btn-arrow btn-arrow-style icon-angle-right" href="'.$link_to.'">'.$link_text.'</a></div>';
   $output .= '</div>';
   return $output;
}
add_shortcode('block_title_4', 'block_title_4');

?>