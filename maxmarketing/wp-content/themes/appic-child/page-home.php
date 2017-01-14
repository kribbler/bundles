<?php
/*
 * Template Name: Home Page Child
 */

// hiding breadcrumbs for this template
ThemeFlags::set('hide_breadcrumbs', true);

get_header();
?>

<div class="container">
	<?php echo do_shortcode( '[rev_slider homepage]' );?>
</div>

<div id="home_block1">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=75 ]');
			else 
				echo do_shortcode('[content_block id=1481 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block2">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=77 ]');
			else 
				echo do_shortcode('[content_block id=1483 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block3">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=79 ]');
			else 
				echo do_shortcode('[content_block id=1485 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block4">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=81 ]');
			else 
				echo do_shortcode('[content_block id=1487 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block5">
	<div class="fancy_bg2">
		<div class="container">
			<?php
				if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
					echo do_shortcode('[content_block id=83 ]');
				else 
					echo do_shortcode('[content_block id=1489 ]'); 
			?>
		</div>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block6">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=85 ]');
			else 
				echo do_shortcode('[content_block id=1491 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block7">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=87 ]');
			else 
				echo do_shortcode('[content_block id=1493 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div id="home_block8">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
				echo do_shortcode('[content_block id=89 ]');
			else 
				echo do_shortcode('[content_block id=1495 ]'); 
		?>
	</div>
</div>

<div class="clearfix"></div>

<div class="white-wrap container page-content" style="display: none">
	<?php if (have_posts()): ?>
		<?php while(have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</div>



<?php get_footer(); ?>