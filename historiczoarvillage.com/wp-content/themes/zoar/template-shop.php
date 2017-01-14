<?php
/**
 * Template Name:Template Shop
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
				<?php $cat_args = array('taxonomy' => 'product_cat', 'orderby' => 'id', 'order' => 'desc',);
                $my_artists = get_categories( $cat_args );
                $artists = array();
                foreach($my_artists as $key => $cat){
                $artists[$key]['id'] = $cat->term_id;
                $artists[$key]['name'] = $cat->name;
                $artists[$key]['slug'] = $cat->slug;
                } //end foreach
                echo '<ul class="my-box">';
                foreach($artists as $cat){
                $permalink = get_term_link( $cat['slug'], 'product_cat' );
                echo '<li>';
                echo '<h2 class="cat_title"><a href="'.$permalink.'">'.$cat['name'].'</a></h2>';
                echo do_shortcode('[jigoshop_category slug="'.$cat['slug'].'" per_page="-1" columns="4" pagination="no"]');
                echo '</li>';
                } // end foreach
                echo '</ul>';  ?>            
                              
			</div><!-- #content -->
		</div><!-- #container -->

<?php //get_sidebar(); ?>
<?php include (TEMPLATEPATH . '/sidebar-shop-page.php'); ?>
<?php get_footer(); ?>