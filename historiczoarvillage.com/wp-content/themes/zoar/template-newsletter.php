<?php
/**
 * Template Name:Template Newsletter
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
            <h1 class="entry-title"><?php the_title(); ?></h1>          
               <?php if(have_posts()): while(have_posts()): the_post(); ?>                  
                    <?php the_content(); ?>                                         
                <?php endwhile; ?>
              <?php endif; ?>
             <?php wp_reset_query(); ?>
              <?php include('newsletter-form.php'); ?> 
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>