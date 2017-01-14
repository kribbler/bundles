<?php
/*
Template Name: Page with Revolution Slider
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
	#footer-wrapper{
		display:none;
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