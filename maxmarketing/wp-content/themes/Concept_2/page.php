<?php get_header(); ?>

	<?php if (have_posts()) : ?>                
		<?php
            while(have_posts()) : the_post();
        ?>
    <div id="page-content" class="wrapper boxed-wrapper">
    	<?php get_template_part('subpage'); ?>
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