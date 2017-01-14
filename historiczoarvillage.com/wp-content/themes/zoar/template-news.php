<?php
/**
 * Template Name:Template News
 */
get_header(); ?>
		<div id="container">
			<div id="content" role="main">
           <h1 class="entry-title"><?php the_title(); ?></h1>           
          <?php $temp = $wp_query;
    $wp_query= null;
    $wp_query = new WP_Query();
      if(!$paged){
       $paged = (get_query_var('paged')) ? get_query_var('paged') : (get_query_var('page')) ? get_query_var('page') : 1;
      }
    $wp_query->query('cat=1&showposts=10'.'&paged='.$paged); ?>
               <?php while(have_posts()): the_post(); ?>
                  <div class="recent_news">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>  
                    <?php the_excerpt(); ?> 
                  </div>                               
              <?php endwhile; ?>
        
               <?php if(function_exists('wp_paginate')) { wp_paginate(); } ?>
              <?php wp_reset_query(); ?>
               <?php $wp_query = null; $wp_query = $temp; ?> 
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>