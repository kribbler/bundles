<?php
/*
Template Name: Inner Page
*/

?>

<?php
	get_header( 'new' );
?>

<?php
	extract(etheme_get_page_sidebar());
?>

<?php if ($page_heading != 'disable' && ($page_slider == 'no_slider' || $page_slider == '')): ?>
	<div class=" page-heading bc-type-<?php etheme_option('breadcrumb_type'); ?>">
		<div class="container transparentish">
			<div class="row-fluid">
				<div class="span12 a-center">
					<h1 class="title"><span><?php the_title(); ?></span></h1>
					<?php //etheme_breadcrumbs(); ?>
					<?php
					if (has_post_thumbnail( $post->ID ) ):
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

						echo '<div id="page_header_image"><img src="'.$image[0].'" /></div>';
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>

<div id="inner_page">
	<?php if(have_posts()): while(have_posts()) : the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; else: ?>

		<h3><?php _e('No pages were found!', ETHEME_DOMAIN) ?></h3>

	<?php endif; ?>
</div>

<?php
	get_footer( 'new' );
?>