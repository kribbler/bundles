<?php 
function map($atts, $content = null) {
	extract(shortcode_atts(array('width' => '100%','height' => '', 'zoom' => '', 'center' => '', 'marker' => '', 'marker_color' => ''), $atts));
	global $concept7_data; 
	$output = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>

jQuery(document).ready(function($) {

	//------- Google Maps ---------//
	 
	// Creating a LatLng object containing the coordinate for the center of the map
	var latlng = new google.maps.LatLng('.$center.');
	
		// Creating an object literal containing the properties we want to pass to the map  
	var options = {  
		zoom: '.$zoom.', // This number can be set to define the initial zoom level of the map
		center: latlng,
		scrollwheel: false,
		zoomControl: true,
	    zoomControlOptions: {
	      style: google.maps.ZoomControlStyle.SMALL
	    },
	    mapTypeControl: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP // This value can be set to define the map type ROADMAP/SATELLITE/HYBRID/TERRAIN
	};  
	// Calling the constructor, thereby initializing the map  
	var map = new google.maps.Map(document.getElementById("map_div"), options);  
	var b=new google.maps.StyledMapType([
  {
	"elementType": "labels.text",
    "stylers": [
      { "color": "'.$concept7_data['heading_font']['color'].'" },
      { "invert_lightness": true },
      { "weight": 0.4 }
    ]
  },{
    "elementType": "labels.icon",
    "stylers": [
      { "weight": 0.1 },
      { "visibility": "on" },
      { "hue": "'.$concept7_data['color_scheme'].'" }
    ]
  },{
    "featureType": "road.arterial",
    "stylers": [
      { "color": "#c3cace" }
    ]
  },{
    "featureType": "landscape",
    "elementType": "geometry",
    "stylers": [
      { "color": "#f3f7fa" }
    ]
  },{
    "featureType": "road.highway",
    "stylers": [
      { "color": "#c3cace" }
    ]
  },{
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      { "color": "#dde1e3" }
    ]
  },{
    "featureType": "poi",
    "elementType": "labels.icon",
    "stylers": [
      { "hue": "'.$concept7_data['color_scheme'].'" }
    ]
  },{
    "featureType": "water",
    "stylers": [
      { "color": "#bfc6ca" }
    ]
  },{
    "featureType": "poi"  }
],{name:"greyscale"});

	// Define Marker properties
	map.mapTypes.set("greyscale",b);
	map.setMapTypeId("greyscale");
	// Add Marker
    var pinImage = new google.maps.MarkerImage("http://concept7.vn/marker.png",
        new google.maps.Size(34, 48),
        new google.maps.Point(0,0),
        new google.maps.Point(17, 45));
    var pinShadow = new google.maps.MarkerImage("http://concept7.vn/shadow-marker.png",
        new google.maps.Size(59.0, 48.0),
        new google.maps.Point(0, 0),
        new google.maps.Point(17.0, 45.0));
        
	var marker1 = new google.maps.Marker({
		position: new google.maps.LatLng('.$marker.'), 
		map: map,
		icon: pinImage,
        shadow: pinShadow,
		draggable:true,
		});	
	function toggleBounce() {

	  if (marker1.getAnimation() != null) {
		marker1.setAnimation(null);
	  } else {
		marker1.setAnimation(google.maps.Animation.DROP);
	  }
	}
	google.maps.event.addListener(marker1, "click", toggleBounce());
});	
</script>';
	$output .= '<div class="map">
                <div id="map_div" style="height:'.$height.';"></div>
            </div>';
   	return $output;
}
add_shortcode('map', 'map');

?>