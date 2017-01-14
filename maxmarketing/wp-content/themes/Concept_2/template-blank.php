<?php
/*
Template Name: Blank Page
*/
?>

<?php 
global $concept7_data; 
global $post; 
get_header();
?>
<?php if (have_posts()) : ?>                
	<?php
        while(have_posts()) : the_post();
    ?>
<div id="page-content" class="wrapper boxed-wrapper">
    <div class="container">

                <?php the_content(); ?>
 
    </div>
</div>
<?php endwhile; ?>
<?php endif; ?>  
<?php get_footer(); ?>