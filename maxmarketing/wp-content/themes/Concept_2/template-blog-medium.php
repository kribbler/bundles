<?php
/*
Template Name: Blog with medium thumbnail
*/
?>

<?php global $concept7_data; ?>
<?php get_header(); ?>
<?php

	$sidebar_choice = get_post_meta($post->ID, 'custom_sidebar', true);

?>

<div id="medium-post-wrapper" class="wrapper boxed-wrapper">
	<?php get_template_part('subpage'); ?>
	<div class="container">
    	
        <?php query_posts( array( 'paged'=>$paged, 'post_type' =>'post') ); ?>
        <div class="row">
        	<div id="medium-posts" class="span8">
        		<?php $format = get_post_format();?>
				<?php if (have_posts()) : ?>                
                    <?php
                        while(have_posts()) : the_post();
                    ?>
                <div id="medium-post" <?php post_class(); ?>><div class="medium-post-content">
                	<div class="meta-date hidden-tablet hidden-phone">
                    	<h5><?php the_time('M')?></h5>
                        <h4><?php the_time('jS')?></h4>
                    </div>
                	
                <?php $format = get_post_format();?>
                	
                    <?php if ( has_post_thumbnail() && $format != 'gallery' && $format != 'video'){ ?>
                    	<div id="image-top">
                            <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                            <?php $image_src = aq_resize( $thumbnail_src, 500, 360, true ); ?>
                            <a href="<?php echo $thumbnail_src; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                                <img src="<?php echo $image_src ?>" alt="<?php the_title(); ?>"/>
                            </a>
                    	</div>
                    <?php }elseif ($format == 'gallery'){ ?>
                    	<div id="image-top" class="flexslider flexslider_m">
                            <ul class="slides">
                            	<?php if(trim(get_post_meta($post->ID, 'post-image-1', true)) != ""){ ?>
                                <li class="1">
                                    <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-1', true ), 500, 360, true ) ?>"/>
                                </li>
                                <?php }?>
                                
                                <?php if(trim(get_post_meta($post->ID, 'post-image-2', true)) != ""){ ?>
                                <li class="2">
                                    <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-2', true ), 500,360, true ) ?>"/>
                                </li>
                                <?php }?>
                                
                                <?php if(trim(get_post_meta($post->ID, 'post-image-3', true)) != ""){ ?>
                                <li class="3">
                                    <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-3', true ), 500,360, true ) ?>"/>
                                </li>
                                <?php }?>
                                
                                <?php if(trim(get_post_meta($post->ID, 'post-image-4', true)) != ""){ ?>
                                <li class="4">
                                    <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-4', true ), 500,360, true ) ?>"/>
                                </li>
                                <?php }?>
                                
                                <?php if(trim(get_post_meta($post->ID, 'post-image-5', true)) != ""){ ?>
                                <li class="5">
                                    <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-5', true ), 500,360, true ) ?>"/>
                                </li>
                                <?php }?>
                                
                            </ul>
                      	</div>
                    <?php }elseif($format == 'video'){?>
                    	<div id="image-top">
                        	<?php echo stripslashes(htmlspecialchars_decode(get_post_meta( $post->ID, 'post-video-embed', true ))); ?>
                        </div>
                    <?php }?>
                    <h2 class="medium-post-title">
						<?php if($format == 'quote'){ ?>
                        <blockquote><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></blockquote>
                        <?php }elseif($format == 'link' && trim(get_post_meta($post->ID, 'post_link', true)) != ""){ ?>
                        <a href="<?php echo get_post_meta($post->ID, 'post_link', true) ?>" target="_blank"><?php the_title(); ?></a>
                        <?php }else {?>
                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        <?php }?>
                    </h2>
                    <div class="meta">
                        <span class="meta-author">
                            <?php _e('Posted by ', 'concept7') . the_author_posts_link(); ?>
                        </span>
                        <span class="meta-divider">&rsaquo;</span>
                        <span class="meta-category">
                            <?php the_category(', '); ?>
                        </span>														
                    </div>   
                    <div class="blog-bottom">
                    	
                    	<?php if($format == 'status'){
							echo the_content();
						}else{
						?>
                        
                        <div class="post-excerpt">
                            <p><?php $excerpt = get_the_excerpt();
							  echo string_limit_words($excerpt,18) .' ...'; 
							  ?></p> 
                      		<h6 class="post-more medium-more">- <a style="font-style:italic; font-size:14px;" href="<?php the_permalink()?>"><?php _e('Read more','concept7')?></a></h6>  
                        </div>
                        <?php }?>
                  	</div>
                    </div>
                </div>
                <div class="line" style="margin:35px 0 38px; height:6px;"></div>
                <?php endwhile; ?>
                <?php endif; ?>
                
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