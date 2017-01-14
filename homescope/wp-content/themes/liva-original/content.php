<?php
/**
 * The default template for displaying content
 *
 * @package liva
 * @since liva 1.0
 */

global $template_small; 

$classes = array(
	'post',
	'blog_post',
	(get_post_format() ? 'format-'.get_post_format() : '')
);

if ( $template_small === true ) { ?>
	<div <?php post_class($classes); ?>>	
		<div class="blog_postcontent">
			<?php if ( !is_search() && has_post_thumbnail() ) : // display thumbnail if not Search ?>
				<div class="image_frame small">
					<a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title());?>">
						<?php ts_the_resized_post_thumbnail_sidebar(array('full-small', 'one-sidebar-small', 'two-sidebars-small'),get_the_title()); ?>
					</a>
				</div>
			<?php endif; ?>
			<div class="post_info_content_small">
				<a href="<?php the_permalink();?>" class="date"><strong><?php the_time('j'); ?></strong><i><?php the_time('M'); ?></i></a>
				<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
				<?php get_template_part( 'inc/post-info' ); ?>
				<div class="clearfix"></div>
				<?php ts_the_excerpt_theme('regular'); ?>
			</div>
		</div>
	</div><!-- /# end post -->
	<div class="clearfix divider_line3"></div>
<?php } else { ?>
	<div <?php post_class($classes); ?>>	
		<div class="blog_postcontent">
			<?php if ( !is_search() && has_post_thumbnail() ) : // display thumbnail if not Search ?>
				<div class="image_frame">
					<a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title());?>">
						<?php ts_the_resized_post_thumbnail_sidebar(array('full', 'one-sidebar', 'two-sidebars'),get_the_title()); ?>
					</a>
				</div>
			<?php endif; ?>
			<a href="<?php the_permalink();?>" class="date"><strong><?php the_time('j'); ?></strong><i><?php the_time('M'); ?></i></a>
			<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
			<?php get_template_part( 'inc/post-info' ); ?>
			<div class="post_info_content">
				<?php ts_the_excerpt_theme('regular'); ?>
			</div>
		</div>
	</div><!-- /# end post -->
	<div class="clearfix divider_line"></div>
<?php } 