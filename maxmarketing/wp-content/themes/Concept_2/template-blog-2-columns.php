<?php
/*
Template Name: Blog Two Columns
*/
?>

<?php global $concept7_data; ?>
<?php get_header(); ?>
<?php
	$sidebar_choice = get_post_meta($post->ID, 'custom_sidebar', true);
?>

<div id="blog-2-columns-wrapper" class="wrapper boxed-wrapper">
	<?php get_template_part('subpage'); ?>
	<div class="container">
    	
        <?php query_posts( array( 'paged'=>$paged, 'post_type' =>'post') ); ?>
        <div class="row">
        	<div id="classic-posts" class="span8">
            	<div class="clear" style="margin-top:40px"></div>
            	<div id="da-thumbs" class="row">
					<?php $format = get_post_format();?>
                    <?php if (have_posts()) : ?>                
                        <?php
                            while(have_posts()) : the_post();
                        ?>
                        
                    <div id="classsic-post-2" class="span4">
                        <div class="recent-post-wrapper-2 not-status">
                          <?php $format = get_post_format();?>
                          <?php if ( has_post_thumbnail() && $format != 'gallery' && $format != 'video'){ ?>
                        	<span class="da-t">
                            	<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                <?php $image_src = aq_resize( $thumbnail_src, 720, '', true ); ?>
                                <img class="radius" src="<?php echo $image_src ?>" alt="<?php the_title(); ?>">
                                <div class="hover-dir">
                                	<p class="time"><?php the_time('F j, Y'); ?></p>
                                    <?php $post_heading = get_post_meta( $post->ID, 'post-heading', true );
									if($post_heading) echo '<p class="hover-text">'.$post_heading.'</p>'; 
									?>
                                </div>
                            </span>
                        	<?php }elseif ($format == 'gallery'){ ?>
                            
                            <?php if ( has_post_thumbnail()){ ?>
								<span class="da-t">
									<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <?php $image_src = aq_resize( $thumbnail_src, 720, '', true ); ?>
                                    <img class="radius" src="<?php echo $image_src ?>" alt="<?php the_title(); ?>">
                                    <div class="hover-dir">
                                        <p class="time"><?php the_time('F j, Y'); ?></p>
                                        <?php $post_heading = get_post_meta( $post->ID, 'post-heading', true );
                                        if($post_heading) echo '<p class="hover-text">'.$post_heading.'</p>'; 
                                        ?>
                                    </div>
                                </span>
							<?php }elseif(!has_post_thumbnail()){?>
                            <div class="flexslider flexslider_m">
                                <ul class="slides">
                                    <?php if(trim(get_post_meta($post->ID, 'post-image-1', true)) != ""){ ?>
                                    <li class="1">
                                        <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-1', true ), 720, '', true ) ?>"/>
                                    </li>
                                    <?php }?>
                                    
                                    <?php if(trim(get_post_meta($post->ID, 'post-image-2', true)) != ""){ ?>
                                    <li class="2">
                                        <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-2', true ), 720,'', true ) ?>"/>
                                    </li>
                                    <?php }?>
                                    
                                    <?php if(trim(get_post_meta($post->ID, 'post-image-3', true)) != ""){ ?>
                                    <li class="3">
                                        <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-3', true ), 720,'', true ) ?>"/>
                                    </li>
                                    <?php }?>
                                    
                                    <?php if(trim(get_post_meta($post->ID, 'post-image-4', true)) != ""){ ?>
                                    <li class="4">
                                        <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-4', true ), 720,'', true ) ?>"/>
                                    </li>
                                    <?php }?>
                                    
                                    <?php if(trim(get_post_meta($post->ID, 'post-image-5', true)) != ""){ ?>
                                    <li class="5">
                                        <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-5', true ), 720,'', true ) ?>"/>
                                    </li>
                                    <?php }?>
                                    
                                </ul>
                            </div>
                        	<?php }?>
							<?php }elseif($format == 'video'){?>
                                <span class="da-t">
                                    <?php echo stripslashes(htmlspecialchars_decode(get_post_meta( $post->ID, 'post-video-embed', true ))); ?>
                                </span>
                            <?php }?>
                            	<h4>
                                	<?php if($format == 'quote'){ ?>
                                    <blockquote><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></blockquote>
                                    <?php }elseif($format == 'link' && trim(get_post_meta($post->ID, 'post_link', true)) != ""){ ?>
                                    <a href="<?php echo get_post_meta($post->ID, 'post_link', true) ?>" target="_blank"><?php the_title(); ?></a>
                                    <?php }else {?>
                                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                    <?php }?>
                                </h4>
                                <span class="clear"></span>
                                <div class="recent-post-meta">
                                	<div class="meta-category"><?php the_category(', '); ?></div>
                                	<div class="meta-cmt-2">
                                     	<?php comments_popup_link('0', '1', '%'); ?>
                                    	<i class="icon-comments"></i>
                                     </div>
                                 </div>
                         </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <!-- Pagination -->
                <?php if (function_exists("pagination")) { ?>
                <div class="pagination pagination-centered">
                    <ul>
                        <?php pagination(); ?>
                    </ul>
                 </div> 
                 <?php } ?>  
                 
            </div>
           
            <!-- Get sidebar here -->
            <?php
            if($sidebar_choice != "default")
			{
				echo'<div id="sidebar-wrapper" class="span4">';
				echo do_shortcode('[clear size="30"]');
				get_sidebar('custom');
				echo'</div>';
			}
			else
			{
				echo'<div id="sidebar-wrapper" class="span4">';
				echo do_shortcode('[clear size="30"]');
				get_sidebar();
				echo'</div>';
			}
			?>
        </div>
        <div class="clear" style="height:30px;"></div>
    </div>
    
</div>


<?php get_footer(); ?>