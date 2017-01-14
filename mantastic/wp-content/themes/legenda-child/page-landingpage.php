<?php 
/*
Template Name: Landing Page
*/
get_header( 'landingpage' );
?>
<div class="content <?php echo $content_span; ?>">
				<?php if(have_posts()): while(have_posts()) : the_post(); ?>
					<?php the_content(); ?>					
					<?php if ($post->ID != 0 && current_user_can('edit_post', $post->ID)): ?>
						<?php edit_post_link( __('Edit this', ETHEME_DOMAIN), '<p class="edit-link">', '</p>' ); ?>
					<?php endif ?>
				<?php endwhile; else: ?>
					<h3><?php _e('No pages were found!', ETHEME_DOMAIN) ?></h3>
				<?php endif; ?>
</div>
<?php
	get_footer( 'new' );
?>