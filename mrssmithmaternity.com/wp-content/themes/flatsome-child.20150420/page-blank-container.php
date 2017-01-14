<?php
/*
Template name: Default Template (No title)
*/
get_header(); ?>

<div class="page-header">
<?php if( has_excerpt() ) the_excerpt();?>
</div>

<div  class="page-wrapper">
<div class="row">
<div id="content" class="large-12 left columns" role="main">

		
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>
			
			<?php endwhile; // end of the loop. ?>

</div><!-- end #content large-9 left -->
 <div class="ns_wrapper"><?php dynamic_sidebar('newsle_blk'); ?></div>
 
 
 <div class="static_cont"><?php dynamic_sidebar('staticon1'); ?></div>
 <div class="seller_wrapp">
     <div class="seller_blk"><?php dynamic_sidebar('bst_seller'); ?></div>
     <div class="seller_blk"><?php dynamic_sidebar('late_pro'); ?></div>
     <div class="seller_blk"><?php dynamic_sidebar('on_sale'); ?></div>
     <div class="seller_blk"><?php dynamic_sidebar('most_review'); ?></div>
 </div>
</div><!-- end row -->
<div class="testimo_blk"><?php dynamic_sidebar('testimo_widget'); ?></div>
</div><!-- end page-right-sidebar container -->


<?php get_footer(); ?>
