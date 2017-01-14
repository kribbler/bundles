<?php
/*
Template Name: Page with white background Revolution Slider
*/
?>

<?php 
global $concept7_data; 
global $post; 
get_header();
$rev = get_post_meta($post->ID, 'custom_rev', true);
?>
<div class="slider-wrapper">
	<?php echo do_shortcode('[rev_slider '.$rev.']'); ?>
</div>
<?php if (have_posts()) : ?>                
	<?php
        while(have_posts()) : the_post();
    ?>
<style type="text/css">
	.page-template-template-white-rev-php .tp-leftarrow.default, .tp-rightarrow.default {
			background-image: url(<?php echo get_template_directory_uri() ?>/images/white_rev_dir.png) !important;
	 }
</style>
<div id="page-content" class="wrapper">
    <div class="container">
        <div class="row">
            <div class="span12">
                <?php the_content(); ?>
            </div>
        </div> 
    </div>
</div>
<?php endwhile; ?>
<?php endif; ?>  
<?php get_footer(); ?>