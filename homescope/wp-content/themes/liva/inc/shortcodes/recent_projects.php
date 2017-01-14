<?php
/**
 * Shortcode Title: Recent projects
 * Shortcode: recent_projects
 * Usage: [recent_projects animation="bounceInUp" limit="12" title="Your title" subtitle="Your subtitle"]
 */
add_shortcode('recent_projects', 'ts_recent_projects_func');

function ts_recent_projects_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		'limit' => 9,
		'title' => '',
		'subtitle' => ''
		),
	$atts));

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
		$list = '';
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();
			if (has_post_thumbnail($post->ID))
			{
				$image = ts_get_resized_post_thumbnail($post->ID,'recent-projects',get_the_title());
				$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

				if (!isset($image_src[0]))
				{
					$image_src = array();
					$image_src[0] = '#';
				}
			}
			else
			{
				continue;
			}

			$terms = wp_get_post_terms( $post -> ID, 'portfolio-categories', $args );
			$term_slugs = array();
			
			if (count($terms) > 0) {
				foreach ($terms as $term) {
					$term_slugs[] = $term -> slug;
				}
			}
			
			$item_title = get_the_title();
			
			$list .= '
				<div class="'.implode(' ',$term_slugs).'">
					<div class="imgWrap recent-projects-image">'.$image.'<h3>'.$item_title.'</h3>						
						<div class="portfolio-hover">
							<a href="'.get_permalink().'"><i class="icon-link icon-4x"></i></a>
							<a class="fancybox" href="'.$image_src[0].'" data-fancybox-group="gallery" title="'.esc_attr($item_title).'"><i class="icon-search icon-4x"></i></a>
						</div>
					</div>
					
				</div>';
		}
		if (!empty($list))
		{
			$terms = get_terms( 'portfolio-categories', array('orderby' => 'name') );
			$terms_html = '';
			foreach ($terms as $term) {
				
				$terms_html .= '<a href="#" data-filter=".'.$term -> slug.'">'.$term -> name.'</a>';
			}
			
			if (!empty($terms_html)) {
				$terms_html = '
					<div class="portfolioFilter">
						<a href="#" data-filter="*" class="current">'.__('All','liva').'</a>'.
						$terms_html.'
					</div>';
			}
			
			$content = '
				<div class="portfolio_page '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					<h1>'.$title.'
					<br />
					<i>'.$subtitle.'</i>
					</h1>
					'.$terms_html.'
					<div class="clearfix mar_top5"></div>
					<div class="portfolioContainer">
						'.$list.'
					</div>
				</div>';
		}
		// Restor original Query & Post Data
		wp_reset_query();
		wp_reset_postdata();
	}
	return $content;
}