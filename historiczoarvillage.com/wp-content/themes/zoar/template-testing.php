<?php
/**
 * Template Name:Template Testing
 */

get_header(); ?>

		<div id="container" style="width:960px;">
			<div id="content" role="main" style="padding:0;">            
             <?php query_posts('page_id=3003');?>
              <?php if(have_posts()): while(have_posts()): the_post(); ?>              
               <?php the_post_thumbnail('full');?>
               <h1 class="entry-title"><?php the_title(); ?></h1>
               <?php the_content(); ?>
               <a href="<?php the_permalink();?>" class="read_more">MORE ABOUT ZOAR  &raquo;</a>              
              <?php endwhile; ?>
              <?php endif; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
