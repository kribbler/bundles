<?php
/**
 * The template for displaying gallery post format content
 *
 * @package crystal
 * @since crystal 1.0
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
			<?php $gallery = get_post_meta($post->ID, 'gallery_images',true); ?>
			<?php if (!is_search() && is_array($gallery) && count($gallery) > 0): ?>	
				<div class="image_frame small">
					<div class="flexslider control-nav post-slider one-col">
						<ul class="slides">
							<?php foreach ($gallery as $image): ?>
								<li>
									<?php ts_the_resized_image_sidebar($image['image'], array('full-small', 'one-sidebar-small', 'two-sidebars-small'), $image['title']); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php elseif (!is_search() && has_post_thumbnail()): ?>
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
			<?php $gallery = get_post_meta($post->ID, 'gallery_images',true); ?>
			<?php if (!is_search() && is_array($gallery) && count($gallery) > 0): ?>	
				<div class="image_frame">
					<div class="flexslider control-nav post-slider one-col">
						<ul class="slides">
							<?php foreach ($gallery as $image): ?>
								<li>
									<?php ts_the_resized_image_sidebar($image['image'], array('full', 'one-sidebar', 'two-sidebars'), $image['title']); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php elseif (!is_search() && has_post_thumbnail()): ?>
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