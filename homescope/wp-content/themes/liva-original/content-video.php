<?php
/**
 * The default template for displaying content
 *
 * @package liva
 * @since liva 1.0
 */

global $template_small; 

$embedded_video = '';
$url = get_post_meta($post -> ID, 'video_url',true);
if (!empty($url)) {
	$embedded_video = ts_get_embaded_video($url);
} else if (empty($url)) {
	$embedded_video = get_post_meta($post -> ID, 'embedded_video',true);
}

$classes = array(
	'post',
	'blog_post',
	(get_post_format() ? 'format-'.get_post_format() : '')
);

if ( isset($template_small) && $template_small === true ) { ?>
	<div <?php post_class($classes); ?>>	
		<div class="blog_postcontent">
			<?php if ( !is_search() ) : // display thumbnail if not Search ?>
				<div class="video_frame small">
					<?php echo $embedded_video; ?>
				</div>
			<?php endif; ?>
			<div class="post_info_content_small">
				<a href="<?php the_permalink();?>" class="date"><strong><?php the_time('j'); ?></strong><i><?php the_time('M'); ?></i></a>
				<h3><a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title());?>"><?php the_title(); ?></a></h3>
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
			<?php if ( !is_search() ) : // display thumbnail if not Search ?>
				<div class="video_frame">
					<?php echo $embedded_video; ?>
				</div>
			<?php endif; ?>
			<a href="<?php the_permalink();?>" class="date"><strong><?php the_time('j'); ?></strong><i><?php the_time('M'); ?></i></a>
			<h3><a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title());?>"><?php the_title(); ?></a></h3>
			<?php get_template_part( 'inc/post-info' ); ?>
			<div class="post_info_content">
				<?php ts_the_excerpt_theme('regular'); ?>
			</div>
		</div>
	</div><!-- /# end post -->
	<div class="clearfix divider_line"></div>
<?php } ?>