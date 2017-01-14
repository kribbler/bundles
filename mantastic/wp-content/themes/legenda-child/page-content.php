<?php
/*
Template Name: Contents Page
*/

?>

<?php 
get_header( 'new' );
?>

<?php
	extract(etheme_get_page_sidebar());
?>

<div class="content-page">

	<?php if ($page_heading != 'disable'): ?>
		<div class="container content-title">
			<h1 class="captureit blueish shadowed"><?php the_title(); ?></h1>
		</div>
	<?php endif ?>


	<div id="inner_page">
		<?php if(have_posts()): while(have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; else: ?>

			<h3><?php _e('No pages were found!', ETHEME_DOMAIN) ?></h3>

		<?php endif; ?>
	</div>
</div>

<?php
	get_footer( 'new' );
?>