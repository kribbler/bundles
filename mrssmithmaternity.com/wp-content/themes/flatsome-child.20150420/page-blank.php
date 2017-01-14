<?php
/*
Template name: Full Width (100%)
*/
get_header(); ?>

<div class="page-header">
<?php if( has_excerpt() ) the_excerpt();?>
</div>

<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>
			
			<?php endwhile; // end of the loop. ?>
            <div class="row ns_wrapper"><?php dynamic_sidebar('newsle_blk'); ?></div>
            <div class="testimo_blk"><?php dynamic_sidebar('testimo_widget'); ?></div>  
            <div class="row static_cont"><?php dynamic_sidebar('staticon1'); ?></div>
             <div class="row seller_wrapp">
                 <div class="seller_blk"><?php dynamic_sidebar('bst_seller'); ?></div>
                 <div class="seller_blk"><?php dynamic_sidebar('late_pro'); ?></div>
                 <div class="seller_blk"><?php dynamic_sidebar('on_sale'); ?></div>
                 <div class="seller_blk"><?php dynamic_sidebar('most_review'); ?></div>
             </div>
            
             
</div>
        
<?php get_footer(); ?>
