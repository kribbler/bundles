<?php
/**
 * Shortcode Title: Image
 * Shortcode: image
 * Usage: [image animation="bounceInUp" size="half" align="alignleft" alt="My image" title=""]image.png[/image]
 */
add_shortcode('image', 'image_func');

function image_func( $atts, $content = null ) {
    
	extract(shortcode_atts(array(
		'animation' => '',
		'size' => '',
		'align' => '',
		'alt' => '',
		'title' => '',
		), 
	$atts));
	
	//wordpress is replacing "x" with special character in strings like 1920x1080
	//we have to bring back our "x"
	$content = str_replace('&#215;','x',$content);
		
	$class = 'wp-post-image '.$align.' '.$size;
	switch ($size) {
		case 'full':
			return ts_get_resized_image_sidebar($content,array('full','one-sidebar','two-sidebars'), $alt, $class, $title);
			break;
		
		case 'half':
			return ts_get_resized_image_sidebar($content,array('half-full','half-one-sidebar','half-two-sidebars'), $alt, $class, $title);
			break;
		
		case 'one_third':
			return ts_get_resized_image_sidebar($content,array('third-full','third-one-sidebar','third-two-sidebars'), $alt, $class, $title);
			break;
		
		case 'one_fourth':
			return ts_get_resized_image_sidebar($content,array('fourth-full','fourth-one-sidebar','fourth-two-sidebars'), $alt, $class, $title);
			break;
		
		default:
			return '<img src="'.$content.'" class="'.$class.'" alt="'.$alt.'" '.(!empty($title) ? 'title="'. esc_attr($title) .'"' : '').'>';
			break;
	}
	
	
}