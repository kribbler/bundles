<?php
/**
 * Template Name:Template Checkout
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">  
            <h1 class="entry-title"><?php the_title(); ?></h1>
              <?php if(have_posts()): while(have_posts()): the_post(); ?>                   
                    <?php the_content(); ?>                                         
               <?php endwhile; ?>
             <?php endif; ?>                      
                              
			</div><!-- #content -->
		</div><!-- #container -->

<?php //get_sidebar(); ?>
<?php include (TEMPLATEPATH . '/sidebar-checkout.php'); ?>
<?php get_footer(); ?>