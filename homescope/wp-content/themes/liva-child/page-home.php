<?php
/*
Template Name: HOME Page
*/
get_header();

?>

<div class="container">
	<?php echo do_shortcode( '[rev_slider homepage]' );?>
</div>

<div class="container" style="display: none">

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


<!--
<div class="clearfix mar_top7"></div>
-->
<div id="home_block0">
	<div class="container">
		<?php
			echo do_shortcode('[content_block id=182 ]'); 
		?>
	</div>
</div>
<div id="home_block1">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=122 ]');
			else 
				echo do_shortcode('[content_block id=102 ]'); 
		?>
	</div>
</div>

<div class="clearfix mar_top7"></div>

<div id="home_block2">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=139 ]');
			else 
				echo do_shortcode('[content_block id=104 ]'); 
		?>
	</div>
</div>

<!--homescope difference block!!!-->

<div id="home_block3">
	<div class="container">
		<?php 
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=141 ]');
			else  
				echo do_shortcode('[content_block id=106 ]');
		?>
	</div>	
</div>

<div class="clearfix mar_top7aa"></div>

<div id="home_block4">
	<div class="container">
		<?php 
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=152 ]');
			else  
				echo do_shortcode('[content_block id=108 ]');
		?>
	</div>
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

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#home_block3 .fullimage_box2').after('<div id="blue_arrow_down"></div>');
		console.log('a');
	});
</script>

<?php get_footer(); ?>