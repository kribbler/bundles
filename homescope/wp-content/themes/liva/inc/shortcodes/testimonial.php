<?php
/**
 * Shortcode Title: Testimonial
 * Shortcode: testimonial
 * Usage: [testimonial animation="bounceInUp" style="default" id="2"]
 */
add_shortcode('testimonial', 'ts_testimonial_func');

function ts_testimonial_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		"id" => 0,
		"style" => "default"
 		),
	$atts));

	$post = get_post($id);



	if ( $post )
	{
		$content = apply_filters('the_content', $post -> post_content);

		$widget_title = get_post_meta($post->ID, 'testimonials-widget-title', true);
		$email = get_post_meta($post->ID, 'testimonials-widget-email', true);
		$company = get_post_meta($post->ID, 'testimonials-widget-company', true);
		$url = get_post_meta($post->ID, 'testimonials-widget-url', true);
		$author = apply_filters( 'the_title', $post -> post_title, $post -> ID);

		if (!empty($url)) {
			$a1 = '<a href="'.$url.'" target="_blank">';
			$a2 = '</a>';

			if (empty($company)) {
				$company = $a1.$url.$a2;
			} else {
				$company = $a1.$company.$a2;
			}
		}

		switch ($style) {
			case 'boxed':
				return '
					<div class="testimonials-2 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
						<div><i class="icon-quote-left icon-2x"></i>&nbsp; '.$content.'
						<strong>- '.$author.' '.$widget_title.(!empty($company) ? ', ' : '').$company.'</strong></div>
					</div><!-- end client says -->
				';
				break;

			case 'boxed_image':
				return '
					<div class="testimonials-4 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
						<div class="content">
							'.ts_get_resized_post_thumbnail($post->ID,'testimonial', $author, 'image_left1').'
							'.$content.'
							<strong>- '.$author.' '.$widget_title.(!empty($company) ? ', ' : '').$company.'</strong>
						</div>
					</div>
				';
				break;


			default:
				return '
					<div class="testimonials-5 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
						<div><i class="icon-quote-left icon-2x"></i>&nbsp; '.$content.'
						<strong>- '.$author.' '.$widget_title.(!empty($company) ? ', ' : '').$company.'</strong></div>
					</div><!-- end client says -->	';
		}

		return '
			<article class="sc-testimonial sc-testimonial-style2 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			'.ts_get_resized_post_thumbnail($post->ID,'testimonial', $author).'
			'.$content.'
			<span><b>'. $author.'</b> '.$widget_title.(!empty($company) ? ', ' : '').$company.'</span>
		  </article>
		';
	}
}