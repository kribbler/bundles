<?php
/**
 * Template Name: Portfolio Template 2
 *
 * @package liva
 * @since liva 1.0
 */
global $wp_query; 

get_header();

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$posts_per_page = get_post_meta(get_the_ID(),'number_of_items',true);
if (!$posts_per_page) {
	$posts_per_page = -1;
}

$args = array(
	'numberposts'     => '',
	'posts_per_page'     => $posts_per_page,
	'offset'          => 0,
	'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
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
	'paged'				=> $paged,
	'post_status'     => 'publish'
);

$portfolio_categories = get_post_meta(get_the_ID(),'portfolio_categories',true);
if (is_array($portfolio_categories) && count($portfolio_categories) > 0) {

	$args['tax_query'] = array(
		array(
			'taxonomy' => 'portfolio-categories',
			'field' => 'id',
			'terms' => $portfolio_categories
		)
	);
}
query_posts( $args );
?>
<div class="container">
	<?php ts_get_single_post_sidebar('left'); ?>
	
	<div class="clearfix mar_top7"></div>
	
	<div class="portfolio_page <?php echo ts_get_liva_content_class(); ?>">
		<?php if ( have_posts() ) : ?>
			<?php $terms = get_terms('portfolio-categories', array('orderby' => 'name')); ?>
			<?php if (count($terms) > 0): ?>
				<div class="portfolioFilter">
					<a href="#" data-filter="*" class="current"><?php _e('All', 'sentiment'); ?></a>
					<?php foreach ($terms as $term): ?>
						<a href="#" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
					<?php endforeach; ?>
				</div>
				<div class="clearfix mar_top5"></div>
			<?php endif; ?>
			
			<?php // Start the Loop  
			$i = 0;
			?>
			<div class="portfolioContainer">
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php
						$terms = wp_get_post_terms($post->ID, 'portfolio-categories', $args);
						$term_slugs = array();
						$term_names = array();
						if (count($terms) > 0):
							foreach ($terms as $term):
								$term_slugs[] = $term->slug;
								$term_names[] = $term->name;
							endforeach;
						endif;
					?>
				
					<?php 
					$content = '';
					switch (get_post_format()):
						case 'video':

							$url = get_post_meta($post -> ID, 'video_url', true);

							if (!empty($url)):
								$embadded_video = ts_get_embaded_video($url);
							elseif (empty($url)):
								$embadded_video = get_post_meta($post -> ID, 'embedded_video',true);
							endif;

							$label = 'portoflio-item-'.$i;
							$link = '#'.$label;
							$content = '<div style="display:none"><div id="'.$label.'">'.$embadded_video.'</div></div>';

							break;

						default:
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', true );
							$link = isset($image[0]) ? $image[0] : '#';
					endswitch;
					?>
					
					<div class="<?php echo implode(' ', $term_slugs); ?>">
						<a class="fancybox" href="<?php echo $link; ?>" data-fancybox-group="gallery" title="<?php echo esc_attr(get_the_title());?>"><div class="imgWrap"><?php ts_the_resized_post_thumbnail('portfolio-2',get_the_title()); ?><p class="imgDescription"><i class="icon-search icon-4x"></i></p><h3><?php the_title(); ?></h3></div></a>
						<?php echo $content; ?>
					</div>	
					<?php $i++ ?>
				<?php endwhile; ?>
			</div>
			<?php ts_the_liva_navi(); ?>
		
		<?php else : //No posts were found ?>
			<?php get_template_part( 'no-results' ); ?>
		<?php endif; //have_posts(); ?>
	</div>
	<?php ts_get_single_post_sidebar('right'); ?>
</div>
<div class="clearfix mar_top7"></div>
<?php get_footer(); ?>