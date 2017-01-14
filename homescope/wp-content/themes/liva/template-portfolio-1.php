<?php
/**
 * Template Name: Portfolio Template 1
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

$number_of_colums = intval(get_post_meta(get_the_ID(),'number_of_columns',true));

switch ($number_of_colums) {
	case 3:
		$image_size = 'portfolio-1-3';
		$column_class = 'one_third';
		break;
	
	case 4:
		$image_size = 'portfolio-1-4';
		$column_class = 'one_fourth';
		break;
	
	case 2:
	default:
		$image_size = 'portfolio-1';
		$column_class = 'one_half';
		$number_of_colums = 2;
		break;
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
	<div class="<?php echo ts_get_liva_content_class(); ?>">
		<?php if ( have_posts() ) : ?>
			<?php // Start the Loop  
			$i = 0;
			?>
			<?php while ( have_posts() ) : the_post(); ?>

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
				<div class="<?php echo $column_class; ?> <?php echo $i % $number_of_colums == ($number_of_colums - 1) ? 'last' : ''; ?>">
					<div class="portfolio_image">
						<div class="portfolio-thumbnail">
							<div class="portfolio-hover">
								<a href="<?php the_permalink(); ?>"><i class="icon-link icon-4x"></i></a>
								<a class="fancybox" href="<?php echo $link; ?>" data-fancybox-group="gallery" title="<?php echo esc_attr(get_the_title());?>"><i class="icon-search icon-4x"></i></a>
							</div>
						<?php ts_the_resized_post_thumbnail($image_size,get_the_title()); ?>
						</div>
						<div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					</div>
					<?php echo $content; ?>
				</div>
				<?php $i++ ?>
			<?php endwhile; ?>
		
			<?php ts_the_liva_navi(); ?>
		
		<?php else : //No posts were found ?>
			<?php get_template_part( 'no-results' ); ?>
		<?php endif; //have_posts(); ?>
	</div>
	<?php ts_get_single_post_sidebar('right'); ?>
</div>
<div class="clearfix mar_top7"></div>
<?php get_footer(); ?>