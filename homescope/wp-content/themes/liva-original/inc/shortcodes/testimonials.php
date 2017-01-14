<?php
/**
 * Shortcode Title: Testimonials
 * Shortcode: testimonials
 * Usage: [testimonials animation="bounceInUp" style="1" category="3" limit="3"]
 */
add_shortcode('testimonials', 'ts_testimonials_func');

function ts_testimonials_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		"style" => '1',
		"category" => '',
		"limit" => "2"
		),
	$atts));

	global $query_string, $post;
	$args = array(
		'posts_per_page'  => $limit,
		'offset'          => 0,
		'cat'			  =>  $category,
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'testimonials-widget',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> 1,
		'post_status'     => 'publish'
	);
	$the_query = new WP_Query( $args );

	$items = '';
	$controls = '';

	$rand = rand(100,10000);

	if ( $the_query->have_posts() )
	{
		global $post;

		$i = 1;
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();

			$widget_title = get_post_meta($post->ID, 'testimonials-widget-title', true);
			$email = get_post_meta($post->ID, 'testimonials-widget-email', true);
			$company = get_post_meta($post->ID, 'testimonials-widget-company', true);
			$url = get_post_meta($post->ID, 'testimonials-widget-url', true);
			$author = get_the_title($post -> ID);

			if (!empty($email))
			{
				$author = '<a href="mailto:'.$email.'">'.$author.'</a>';
			}
			else
			{
				$author = $author;
			}

			if (!empty($company))
			{
				if (!empty($url))
				{
					$company = '<a href="'.$url.'" target="_blank">'.(!empty($widget_title) ? ', ' : '').$company.'</a>';
				}
			}

			$post_content = stripslashes($post -> post_content);

			$image = '';
			if ($style == 1) {
				$image = ts_get_resized_post_thumbnail($post->ID,'testimonials', strip_tags($author));
			}

			$items .= '
				<div id="slide'.$rand.'-'.$i.'" class="faide_slide '.($i == 1 ? 'faide_slide_first' : '').'">
					'.$image.'
					'.$post_content.'
					<b>- '.$widget_title.' <em>&nbsp;&nbsp;'.$company.' '.$author.'</em></b>
				</div>';

			$background = '';
			if ($style == 2 || $style == 3) {
				$background = 'style="background: url('.ts_get_resized_post_thumbnail($post->ID,'testimonials-2', $author, '', true).') no-repeat center top;"';
			}
			$controls .= '<li><a href="#slide'.$rand.'-'.$i.'" '.$background.'></a></li>';
			$i++;
		}
	}
	// Restor original Query & Post Data
	wp_reset_query();
	wp_reset_postdata();

	switch ($style) {
		case 2:
			$html = '
				<div class="faide_slider testimonials-2 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<div id="slider'.$rand.'" class="slider">
						'.$items.'
					</div>
					<div class="arrow_d"></div>
					<div class="clearfix mar_top3"></div>
					<ul class="controlls">
						'.$controls.'
					</ul>
				</div>';
			break;

		case 3:
			$html = '
				<div class="faide_slider testimonials-3 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<div id="slider'.$rand.'" class="slider">
						'.$items.'
					</div>
					<div class="arrow_d"></div>
					<div class="clearfix mar_top3"></div>
					<ul class="controlls">
						'.$controls.'
					</ul>
				</div>';
			break;

		case 1:
		default:
			$html = '
				<div class="peopple_says '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<div class="container">
						<div class="contarea">
							<div class="faide_slider testimonials-1">
								<div id="slider'.$rand.'" class="slider">
									'.$items.'
								</div>
								<div class="clearfix mar_top2"></div>
								<ul class="controlls">
									'.$controls.'
								</ul>
							</div>
						</div>
					</div>
				</div><!-- end people says -->';
			break;
	}

	return $html;
}