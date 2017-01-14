<?php
/*
 * Template Name: Home Page Child
 */
?>
<?php $sidebar_checkbox = get_post_meta($post->ID, 'sidebar_checkbox', true);?>
<?php get_header(); ?>

<?php //get_template_part('includes/title-breadcrumb' ) ?>



<div id="home_block2" class="greenerx margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') {
				//echo do_shortcode('[content_block id=35 ]');
			}
			else 
				echo do_shortcode('[content_block id=39 ]'); 
		?>
	</div>
</div>

<div id="home_block3" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=38 ]');
			else 
				echo do_shortcode('[content_block id=41 ]'); 
		?>
	</div>
</div>

<div id="home_block4" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=40 ]');
			else 
				echo do_shortcode('[content_block id=43 ]'); 
		?>
	</div>
</div>

<div id="home_block5" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=42 ]');
			else 
				echo do_shortcode('[content_block id=45 ]'); 
		?>
	</div>
</div>

<div id="home_block6" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=44 ]');
			else 
				echo do_shortcode('[content_block id=47 ]'); 
		?>
	</div>
</div>

<div id="home_block7" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=46 ]');
			else 
				echo do_shortcode('[content_block id=49 ]'); 
		?>
	</div>
</div>

<div id="main" class="inner-page <?php if ($sidebar_checkbox){?>left-sidebar-template<?php }?>" style="display:none">
	<div class="container">
		<div class="row">
			<div class="col-md-9 page-content lpd-sidebar-page">			
		        <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
	                <?php $post_thumbnail_id = get_post_thumbnail_id(); ?> 
	                <?php $alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);?>
		            <img class="page-thumbnail img-responsive" alt="<?php echo $alt; ?>" src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'default-sidebar-page' ); echo $image[0];?>" />
		        <?php }?>
	            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	                <?php the_content();?>
	            <?php endwhile; else: ?>
	                <p><?php _e('Sorry, no posts matched your criteria.', GETTEXT_DOMAIN) ?></p>
	            <?php endif; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
        
<?php get_footer(); ?>