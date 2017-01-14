<?php
/**
 * The Template for displaying single portfolio.
 *
 * @package crystal
 * @since crystal 1.0
 */
global $post;

get_header(); ?>
<?php if ( have_posts() ) : the_post();
	$categories_list = wp_get_object_terms($post->ID, 'portfolio-categories',array('fields' => 'names'));
	$categories = '';
	
	if (is_array($categories_list))
	{
		$categories = '<span class="cat">'.implode('</span><span class="cat">',$categories_list).'</span>';
	}
	
	$image_src = '';
	if (has_post_thumbnail())
	{
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
		$image_src = $image[0];
	}
	?>

	<div class="container">

		<div class="content_fullwidth">

			<div class="portfolio_area">

				<?php
					$media = null;

					if (get_post_format() == 'video'):
						$url = get_post_meta($post -> ID, 'video_url',true);
						if (!empty($url)):
							$embadded_video = ts_get_embaded_video($url);
						elseif (empty($url)):
							$embadded_video = get_post_meta($post -> ID, 'embedded_video',true);
						endif;
					elseif (get_post_format() == 'gallery'):
						$gallery = get_post_meta($post->ID, 'gallery_images',true);
						$gallery_html = '';
						if (is_array($gallery)):
							foreach ($gallery as $image):
								$gallery_html .= '<li>'.ts_get_resized_image_by_size($image['image'], 'portfolio-single', $image['title']).'</li>';
							endforeach;
						endif;
					endif;

					if (isset($embadded_video)):
						$media = '<div class="video-wrapper">'.$embadded_video.'</div>';
					elseif (isset($gallery_html)):
						$media = '<div class="flexslider one-col control-nav control-nav-style2"><ul class="slides">'.$gallery_html.'</ul></div>';
					else:
						$media = ts_get_resized_post_thumbnail($post -> ID, 'portfolio-single', get_the_title());
					endif; 
				?>

				<div class="portfolio_area_left"><?php echo $media; ?></div>

				<div class="portfolio_area_right">

					<h3><i><?php _e('Project Description' , 'liva'); ?></i></h3>
					<?php the_content(); ?>

					<ul class="small_social_links">
						<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">&nbsp;<i class="icon-facebook"></i>&nbsp;</a></li>
						<li><a target="_blank" class="twitter-share-button" href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="icon-twitter"></i></a></li>
						<?php 
						$pin_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'pinterest' );
						if ($pin_image): ?>
						<li><a target="_blank" href="http://pinterest.com/pin/create%2Fbutton/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode($pin_image[0]); ?>&description=<?php echo urlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="icon-pinterest"></i></a></li>
						<?php endif; ?>
						<li><a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="icon-google-plus"></i></a></li>
						<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>&summary=<?php echo urlencode(ts_get_the_excerpt_theme(10)); ?>&source=<?php echo get_bloginfo( 'name' );?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=531,width=545');return false;"><i class="icon-linkedin"></i></a></li>
					</ul>

					<div class="project_details"> 
						<h4><b><?php _e('Project Details', 'liva');?></b></h4>
						<span class="item"><strong><?php _e('Date', 'liva'); ?></strong> <em><?php the_time(get_option('date_format'));?></em></span>

						<?php if ($categories): ?>
							<span class="item"><strong><?php _e('Categories', 'liva'); ?></strong> <em><?php echo $categories; ?> </em></span> 
						<?php endif; ?>
						<span class="item"><strong><?php _e('Author', 'liva'); ?></strong> <em><?php the_author_link(); ?></em></span>
						<div class="clearfix mar_top3"></div>

						<?php $url = get_post_meta($post -> ID, 'url', true); ?>
						<?php if ($url): ?>
							<a href="<?php echo $url; ?>" class="but_goback" target="_blank"><i class="icon-hand-right icon-large"></i> <?php _e('Visit Site', 'liva'); ?></a>
						<?php endif; ?>
					</div>  

				</div>

			</div><!-- end section -->

		</div>

	</div><!-- end content area -->
	<div class="clearfix mar_top5"></div>
<?php endif; ?>
<?php get_footer(); ?>