<?php

function service($atts, $content = null) {
	extract(shortcode_atts(array('icon' => '', 'title' => '', 'link' => '#', 'link_text' => 'Learn more', 'show_button' => '', 'border_left' => '', 'class' => ''), $atts));
	if($border_left == '1') $border = ' border'; else $border = '';
	$output = "";
	$output .= '<div class="service-1'.$border.$class.'">';
	$output .= '<div class="service-content"><h2>' .htmlspecialchars_decode($title). '</h2>
			<img class="service-icon" src="'.$icon. '" alt="'.$title.'"/>
			<p>' .do_shortcode(htmlspecialchars_decode($content)). '</p>';
	if($link_text) $output .= '<p class="btn-wrapper">-&nbsp;&nbsp;<a href="' .$link. '">'.$link_text.'</a></p>';
	$output .= '</div></div>';
   	return $output;
}
add_shortcode('service', 'service');

function service_2($atts, $content = null) {
	extract(shortcode_atts(array('icon' => '', 'title' => '', 'link' => '#', 'shadow' => '', 'link_text' => 'Learn more', 'show_button' => '', 'class' => ''), $atts));
	$output = "";
	$output .= '<div class="service-2 '.$class.'">';
	$output .= '<div class="service-img-wrapper">
					<div class="service-icon-effect"></div>
					<img class="service-icon" src="'.$icon.'" alt="'.$title.'"/>
				</div>
				<div class="service-content-2">
					<h2>' .htmlspecialchars_decode($title). '</h2>
					<p>' .do_shortcode($content) .'</p>';
	if($link_text) $output .= '<p class="btn-wrapper">-&nbsp;&nbsp;<a href="' .$link. '">'.$link_text.'</a></p>';
	$output .= '</div></div>';
   	return $output;
}
add_shortcode('service_2', 'service_2');

function service_2_2($atts, $content = null) {
	extract(shortcode_atts(array('icon' => '', 'title' => '', 'link' => '#', 'link_text' => 'Learn more', 'show_button' => '', 'class' => ''), $atts));
	$output = "";
	$output .= '<div class="service-2-2">';
	$output .= '<div class="service-icon-wrapper"><div class="service-icon-container"><img class="service-icon" src="'.$icon. '" alt="'.$title.'"/></div></div><div class="service-content"><h2><a href="'.$link.'">' .htmlspecialchars_decode($title). '</a></h2><p>' .do_shortcode(htmlspecialchars_decode($content)). '</p>';
	if($link_text) $output .= '<p class="btn-wrapper">-&nbsp;&nbsp;<a href="' .$link. '">'.$link_text.'</a></p>';
	$output .= '</div></div>';
   	return $output;
}
add_shortcode('service_2_2', 'service_2_2');

function service_3($atts, $content = null) {
	extract(shortcode_atts(array('icon' => '', 'title' => '', 'link' => '#', 'link_text' => 'Learn more', 'show_button' => '', 'class' => ''), $atts));
	$output = "";
	
	$output .= '<div class="span4 image-mi"><div class="service-3">';
	$output .= '<div class="service-icon-wrapper">
					<div class="service-icon-effect"></div>
					<div class="service-icon-container">
						<img class="service-icon" src="'.$icon. '" alt="'.$title.'"/>
					</div>
				</div>
				<h2>' .htmlspecialchars_decode($title). '</h2>
				<div class="service-content"><p>' .do_shortcode(htmlspecialchars_decode($content)). '</p>';
	if($link_text) $output .= '<p class="btn-wrapper">-&nbsp;&nbsp;<a href="' .$link. '">'.$link_text.'</a></p>';
	$output .= '</div></div></div>';
   	return $output;
}
add_shortcode('service_3', 'service_3');


function service_4($atts, $content = null) {
	extract(shortcode_atts(array('icon' => '', 'title' => '', 'link' => '#', 'link_text' => 'Learn more', 'show_button' => '', 'class' => ''), $atts));
	$output = "";
	$output .= '<div class="service-4">';
	$output .= '<div class="service-icon-wrapper"><div class="service-icon-container"><img class="service-icon" src="'.$icon. '" alt="'.$title.'"/></div></div><div class="service-content"><h2>' .htmlspecialchars_decode($title). '</h2><p>' .do_shortcode(htmlspecialchars_decode($content)). '</p>';
	if($link_text) $output .= '<p class="btn-wrapper">-&nbsp;&nbsp;<a href="' .$link. '">'.$link_text.'</a></p>';
	$output .= '</div></div>';
   	return $output;
}
add_shortcode('service_4', 'service_4');

function service_5($atts, $content = null) {
	extract(shortcode_atts(array('icon' => '', 'title' => '', 'link' => '#', 'link_text' => 'Learn more', 'show_button' => '', 'class' => '', 'background' => ''), $atts));
	$output = "";
	$output .= '<div class="service-5" style="background-color:'.$background.'">';
	$output .= '<h2><a href="'.$link.'">' .htmlspecialchars_decode($title). '</a></h2><div class="service-icon-wrapper"><div class="service-icon-container"><img class="service-icon" src="'.$icon. '" alt="'.$title.'"/></div></div><div class="service-content"><p>' .do_shortcode(htmlspecialchars_decode($content)). '</p>';
	if($link_text) $output .= '<p class="btn-wrapper">-&nbsp;&nbsp;<a href="' .$link. '">'.$link_text.'</a></p>';
	$output .= '</div></div>';
   	return $output;
}
add_shortcode('service_5', 'service_5');

?>