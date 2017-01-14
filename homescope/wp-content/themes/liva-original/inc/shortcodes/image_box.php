<?php
/**
 * Shortcode Title: Image Box
 * Shortcode: image_box
 * Usage: [image_box animation="bounceInUp" style="1" image="image.png" size="half" alt="My image" title=""]Your content[/image_box]
 */
add_shortcode('image_box', 'image_box_func');

function image_box_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'style' => '',
		'image' => '',
		'size' => '',
		'alt' => '',
		'title_attr' => '',
		'title' => ''
		),
	$atts));

	//wordpress is replacing "x" with special character in strings like 1920x1080
	//we have to bring back our "x"
	$image = str_replace('&#215;','x',$image);

	$align = '';
	if ($style == '2') {
		$align = 'image_left';
	}

	$class = 'wp-post-image '.$align;
	$image_html = '';
	switch ($size) {
		case 'full':
			$image_html = ts_get_resized_image_sidebar($image,array('full','one-sidebar','two-sidebars'), $alt, $class, $title_attr);
			break;

		case 'half':
			$image_html = ts_get_resized_image_sidebar($image,array('half-full','half-one-sidebar','half-two-sidebars'), $alt, $class, $title_attr);
			break;

		case 'one_third':
			$image_html = ts_get_resized_image_sidebar($image,array('third-full','third-one-sidebar','third-two-sidebars'), $alt, $class, $title_attr);
			break;

		case 'one_fourth':
			$image_html = ts_get_resized_image_sidebar($image,array('fourth-full','fourth-one-sidebar','fourth-two-sidebars'), $alt, $class, $title_attr);
			break;

		default:
			$image_html = '<img src="'.$image.'" class="'.$class.'" alt="'.$alt.'" '.(!empty($title_attr) ? 'title="'. esc_attr($title_attr) .'"' : '').'>';
			break;
	}

	$content = ts_add_paragraph($content);

	switch ($style) {
		case '2':
			return '
				<ul class="fullimage_box image_box_style2 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<li>'.$image_html.'</li>
					<li><h3><i>'.$title.'</i></h3></li>
					<li>'.$content.'</li>
				</ul><!-- end section -->';
			break;

		case '1':
		default:
			return '
				<ul class="fullimage_box '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<li><h2>'.$title.'</h2></li>
					<li>'.$image_html.'</li>
					<li>'.$content.'</li>
				</ul><!-- end section -->';
			break;
	}


}