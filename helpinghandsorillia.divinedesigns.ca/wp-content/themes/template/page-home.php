<?php
/** Template Name: HomePage */
?>


<?php get_header('homepage'); ?>


<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail( $post->ID )) : ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		<?php 
			$h1_title = get_post_meta( $post->ID, 'page_title', true );
			$extra_padding = '260px';
			$header_height = '600px';
			
		?>
  		<div id="header_image" style="margin-top: 14px; height: 532px;background-image: url('<?php echo $image[0]; ?>');">
			<h1 style="padding-top: <?php echo $extra_padding;?>"><?php echo $h1_title;?></h1>
			<h2><?php echo get_post_meta( $post->ID, 'page_subtitle', true );?></h2>
		</div>
		<?php endif;?>
	<div id="header">

			<div id="menu" role="navigation" style="margin-top: 0">
				<div class="page-wrapper___ container">
					<?php /*

					Allow screen readers / text browsers to skip the navigation menu and
					get right to the good stuff. */ ?>

					<div class="skip-link screen-reader-text">
						<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>">
						<?php _e( 'Skip to content', 'twentyten' ); ?></a>
					</div>
					<nav><?php wp_nav_menu(array(
								'theme_location' => 'main',
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 4,
								'fallback_cb' => false,
								'walker' => new Et_Navigation

					)); ?>
					</nav>
					<?php
					/*
						wp_nav_menu( 
							array( 
								'container_class' => 'navigation', 
								'menu_class' => 'nav-menu',
								'theme_location' => 'main',
								'after' => '<li class="menu-divider">//</li>',
								'walker' => new Walker_Nav_Menu(),
								'depth' => 2
						 ) );
					*/
					?>
				</div>

			</div><!-- #menu -->
			
			<!-- Header Goes here-->
		</div>
<div id="post">
<?php the_content(); ?>
</div> <!-- .post -->
<?php endwhile; endif;?>

<?php get_footer();?>