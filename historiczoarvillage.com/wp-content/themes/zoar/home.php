<?php

/**

 * Template Name:Homepage

 */

get_header(); ?>

		<div id="container" style="width:960px;">
			<div id="content" role="main" style="padding:0;">
			<div id="welcomebox">
            <?php /*?><?php echo do_shortcode('[nits-slider]');?><?php */?>
                       
             <?php query_posts('page_id=33');?>
              <?php if(have_posts()): while(have_posts()): the_post(); ?>
               <?php the_post_thumbnail('full');?>
               <h1 class="entry-title" style="clear:none; letter-spacing:-1px;"><?php the_title(); ?></h1>
               <?php the_content(); ?>
               <div class="clear"></div>
              <?php endwhile; ?>
              <?php endif; ?>
            </div><!-- #welcomebox -->
            

             <div id="grip1">

               <div class="boxes">
                <?php query_posts('page_id=39');?>
                  <?php if(have_posts()): while(have_posts()): the_post(); ?>
                   <h2><?php the_title(); ?></h2>
                   <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(276,276));?>  </a> 
                    <?php the_excerpt(); ?>   
                 <?php endwhile; ?>
                <?php endif; ?>
               </div>               

               <div class="boxes">
                <?php query_posts('page_id=10');?>
                  <?php if(have_posts()): while(have_posts()): the_post(); ?>
                   <h2><?php the_title(); ?></h2>
                     <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(array(276,276));?></a>
                      <?php the_excerpt(); ?>
                 <?php endwhile; ?>
                <?php endif; ?>
               </div>
               
               <div class="boxes"  style="margin-right:0;">
                 <?php query_posts('page_id=555');?>
                  <?php if(have_posts()): while(have_posts()): the_post(); ?>
                   <h2><?php the_title(); ?></h2>  
                   <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(array(276,276));?> </a>                     
                    <?php the_excerpt(); ?>   
                 <?php endwhile; ?>
                <?php endif; ?>
               </div>

               <div class="clear"></div>
             </div><!-- #grip1 -->

			</div><!-- #content -->
		</div><!-- #container -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>