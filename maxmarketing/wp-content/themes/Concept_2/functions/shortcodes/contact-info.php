<?php

function contact_info($atts, $content = null) {
   return '
   	<div class="clear"></div>
	<div id="contact-info">
							
		<ul class="contact-info">
		
			'. do_shortcode($content) .'
		
		</ul>
	 
	</div>
   ';
}
add_shortcode('contact_info', 'contact_info');



function contact_name($atts, $content = null) {
   return '
   	
		<li class="contact-info-name">
			<i class="icon-home"></i><span>'. do_shortcode($content) .'</span>
		</li>
			
   ';
}
add_shortcode('contact_name', 'contact_name');



function contact_email($atts, $content = null) {
   return '
   	
		<li class="contact-info-email">
		<i class="icon-envelope"></i><a href="mailto:'. do_shortcode($content) .'"><span>'. do_shortcode($content) .'</span></a>
		</li>
		
			
   ';
}
add_shortcode('contact_email', 'contact_email');



function contact_phone($atts, $content = null) {
   return '
   	
		<li class="contact-info-phone">
			<i class="icon-phone"></i><span>'. do_shortcode($content) .'</span>
		</li>
			
   ';
}
add_shortcode('contact_phone', 'contact_phone');



function contact_address($atts, $content = null) {
   return '
   	
		<li class="contact-info-address">
			<i class="icon-map-marker"></i><span>'. do_shortcode($content) .'</span>
		</li>
			
   ';
}
add_shortcode('contact_address', 'contact_address');


function contact_speech($atts, $content = null) {
   return '
   	
		<li class="contact-info-speech">
			<i class="icon-comments-alt"></i><span>'. do_shortcode($content) .'</span>
		</li>
			
   ';
}
add_shortcode('contact_speech', 'contact_speech');

?>