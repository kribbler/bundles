<?php
/**
 * Shortcode Title: Latest works
 * Shortcode: latest_works
 * Usage: [latest_works animation="bounceInUp" limit=10 navigation_color="#FFFFFF" title_color="#FFFFFF" categories_color="#DEDEDE"]
 */
add_shortcode('latest_works', 'ts_latest_works_func');

function ts_latest_works_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		"limit" => 10,
		"navigation_color" => '',
		"title_color" => '',
		"categories_color" => ''
		),
	$atts));
	$rand = rand(1,1000);
	global $query_string, $post;
	$args = array(
		'numberposts'     => "",
		'posts_per_page'  => $limit,
		'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
		'offset'          => 0,
		'cat'        =>  '',
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'portfolio',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> 1,
		'post_status'     => 'publish'
	);
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() )
	{
		$navigation_color_style = '';
		if (!empty($navigation_color)) {
			$navigation_color_style = 'border-color: '.$navigation_color.'; color: '.$navigation_color;
		}
		
		$title_color_style = '';
		if (!empty($title_color)) {
			$title_color_style = 'style="color: '.$title_color.'"';
		}
		$categories_color_style = '';
		if (!empty($categories_color)) {
			$categories_color_style = 'style="color: '.$categories_color.'"';
		}
		
		$list = '';
		$i = 1;
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();
			$image = '';
			if (has_post_thumbnail($post->ID))
			{
				$image = ts_get_resized_post_thumbnail($post->ID,'latest-works',get_the_title());
			}
			else
			{
				continue;
			}

			$terms = strip_tags(get_the_term_list( $post->ID, 'portfolio-categories', '', ' ', '' ));

			$list .= '
				<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-'.$i.' jcarousel-item-'.$i.'-horizontal" style="float: left; list-style: none;">
					<div class="item">
					<div class="fresh_projects_list">
						<section class="cheapest">
							<div class="display">
								<div class="small-group">
									<div class="small money">
										<a title="'.esc_attr(get_the_title()).'" href="'.get_permalink().'">
											'.$image.'
											<div class="info">
												<h1 '.$title_color_style.'>'.get_the_title().'</h1>
												<h2 '.$categories_color_style.'>'.$terms.'</h2>
												<div class="additionnal">
													 <b>'.__('View Project','liva').'</b>
												</div>
											</div>
											<div class="hover"></div>
										</a>
									</div>
								</div>
							</div>
						</section>
					</div>
					</div>
				</li><!-- end item -->';
			$i++;
		}

		if (!empty($list))
		{
			$rand = rand(1,10000);
			$content = '
				<div class="jcarousel-skin-tango '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
						<div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
							<ul id="mycarousel'.$rand.'" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: -590px; width: 2165px;">
								'.$list.'
							</ul>
						</div>
						<div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block; '.$navigation_color_style.'"></div>
						<div class="jcarousel-next jcarousel-next-horizontal" style="display: block; '.$navigation_color_style.'"></div>
					</div>
				</div>';

			$content .= '
				<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery("#mycarousel'.$rand.'").jcarousel();
					});
				</script>';

		}
		// Restor original Query & Post Data
		wp_reset_query();
		wp_reset_postdata();
	}
	return $content;
}