<?php
/**
 * Shortcode Title: Contact Info
 * Shortcode: contact_info
 * Usage: [contact_info animation="bounceInUp" address="123 Wide Road, LA" email="your@email.com" phone="+1 123-4567-8900" fax="+1 123-4567-1200" map=""]
 */
add_shortcode('contact_info', 'ts_contact_info_func');

function ts_contact_info_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		"address" => "",
		"email" => "",
		"phone" => "",
		"fax" => "",
		"map" => ""
		), 
	$atts));
	
	$content = '
		 <div class="contact_info '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<ul class="address '.(!empty($map) ? 'with-map' : '').'">
				'.(!empty($address) ? '<li><i class="icon-map-marker icon-large"></i> '.$address.'</li>' : '').'
				'.(!empty($email) ? '<li class="last"><i class="icon-envelope"></i> <a href="mailto:'.$email.'">'.$email.'</a></li>' : '').'
				'.(!empty($phone) ? '<li><i class="icon-phone"></i> '.$phone.'</li>' : '').'
				'.(!empty($fax) ? '<li class="last"><i class="icon-print"></i> '.$fax.'</li>' : '').'
			</ul>
			'.(!empty($map) ? '<div class="map"><div id="map-ci"></div></div>' : '').'
			
		</div>
		<div class="clear"></div>';
	
	if (!empty($map)) {
		
		$content .= '
			<script type="text/javascript"> 
				var geocoder = new google.maps.Geocoder();

				var address = "'.esc_js($map).'";

				var mapOptions = { 
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					center: new google.maps.LatLng(54.00, -3.00),
					zoom: 14
				};

				var map = new google.maps.Map(document.getElementById("map-ci"), mapOptions);

				geocoder.geocode({"address": address}, function(results, status) {
					if(status == google.maps.GeocoderStatus.OK) 
					{
						result = results[0].geometry.location;
						map.setCenter(result);
						 
						jQuery(document).ready( function($) {
							$(".map").append("<a target=\'_blank\' href=\'http://maps.google.com/?ie=UTF8&hq=&q=" + result.k + "," + result.A + "&z=16\'>'.__('View Larger Map','liva').'</a>");
						});
						
						var marker = new google.maps.Marker({
							position: result,
							map: map,
							title: "'.esc_js($map).'"
						});
					}
				});
			 </script>';
	}
	return $content;
}