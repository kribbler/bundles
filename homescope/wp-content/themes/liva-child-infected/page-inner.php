<?php
/*
Template Name: Inner Page
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
<div class="clearfix" mar_top7></div>
</div>

<div class="clearfix mar_top7"></div>

<div class="container">
	<?php 
		if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
			echo do_shortcode('[content_block id=166 ]');
		else
			echo do_shortcode('[content_block id=110 ]');
	?>
</div>


<?php get_footer(); ?>