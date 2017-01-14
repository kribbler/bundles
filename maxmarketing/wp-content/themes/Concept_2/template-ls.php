<?php
/*
Template Name: Page with Layer Slider
*/
?>

<?php 
global $concept7_data; 
global $post; 
get_header();
$ls = get_post_meta($post->ID, 'custom_ls', true);
?>
<div class="slider-wrapper">
	<?php echo do_shortcode('[layerslider id="'.$ls.'"]'); ?>
</div>
<?php if (have_posts()) : ?>                
	<?php
        while(have_posts()) : the_post();
    ?>
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