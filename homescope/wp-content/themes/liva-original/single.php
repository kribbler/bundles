<?php
/**
 * The Template for displaying all single posts.
 *
 * @package liva
 * @since liva 1.0
 */

get_header(); ?>

<div class="container">
	<?php ts_get_single_post_sidebar('left'); ?>
	<div class="<?php echo ts_get_liva_content_class(); ?>">
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'single' ); ?>
			<?php
				if ( comments_open() || '0' != get_comments_number() ):
					comments_template( '', true );
				endif;
			?>
		<?php endwhile; // end of the loop. ?>
	</div>
	<?php ts_get_single_post_sidebar('right'); ?>
</div>
<?php get_footer(); ?>