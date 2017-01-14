<?php
/**
 * The Template for displaying all single pages.
 *
 * @package liva
 * @since liva 1.0
 */
 
get_header();
?>
<div class="grayed_bg">
<div class="container">
	<?php ts_get_single_post_sidebar('left'); ?>
	<div class="<?php echo ts_get_liva_content_class(); ?>">
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php if (get_post_meta(get_the_ID(), 'show_page_content',true) != 'no'): ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endif; ?>
		<?php endwhile; // end of the loop. ?>
	</div>
	<?php ts_get_single_post_sidebar('right'); ?>
</div>
<div class="clearfix mar_top7"></div>
</div>
<?php get_footer(); ?>