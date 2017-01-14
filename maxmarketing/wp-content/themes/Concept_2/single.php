<?php global $concept7_data; ?>
<?php get_header(); 
	$post_heading = get_post_meta( $post->ID, 'post-heading', true );
?>
<div id="single-post-wrapper" class="wrapper boxed-wrapper">
	<?php echo do_shortcode('[clear size="50"]') ?>
	<div class="single-post-container">
    	
        <div class="container">
        	<div class="row">
				<?php if($concept7_data['single_left']){?>
                    <!-- Get sidebar here -->
                <div id="sidebar-wrapper" class="span4">
                    
                    <?php get_sidebar(); ?>
                </div>
                <?php }?>
            
                <?php if (have_posts()) : ?>                
                <?php while (have_posts()) : the_post(); ?>
                <?php $format = get_post_format();?>
                <div id="single-post" class="span8">
                <div class="single-post-container-wrapper">
                	<div class="meta-date hidden-phone hidden-tablet">
                    	<h5><?php the_time('M')?></h5>
                        <h4><?php the_time('jS')?></h4>
                    </div>
                	<h2 class="classic-post-title"><?php the_title(); ?></h2>
                    <?php if($post_heading) echo '<p class="post-headline">'.$post_heading.'</p>'; ?>
                    <div class="clearfix"></div>
                    <div class="top-post">
                        <?php if($concept7_data['top_image']) {?>
                            <?php if ( has_post_thumbnail() && $format != 'gallery' ){ ?>
                                <div id="image-top" class="image-overlay">
                                    <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                                        <img src="<?php echo aq_resize($thumbnail, 660, 270, true) ?>" alt="<?php the_title(); ?>"/>
                                        <div class="slide-shadow"></div>
                                    </a>
                                </div>
                            <?php }elseif ($format == 'gallery'){ ?>
                                <div id="image-top" class="flexslider flexslider_m">
                                    <ul class="slides">
                                        <?php if(trim(get_post_meta($post->ID, 'post-image-1', true)) != ""){ ?>
                                        <li>
                                            <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-1', true ), 660, 270, true ) ?>"/>
                                        </li>
                                        <?php }?>
                                        
                                        <?php if(trim(get_post_meta($post->ID, 'post-image-2', true)) != ""){ ?>
                                        <li>
                                            <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-2', true ), 660,270, true ) ?>"/>
                                        </li>
                                        <?php }?>
                                        
                                        <?php if(trim(get_post_meta($post->ID, 'post-image-3', true)) != ""){ ?>
                                        <li>
                                            <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-3', true ), 660,270, true ) ?>"/>
                                        </li>
                                        <?php }?>
                                        
                                        <?php if(trim(get_post_meta($post->ID, 'post-image-4', true)) != ""){ ?>
                                        <li>
                                            <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-4', true ), 660,270, true ) ?>"/>
                                        </li>
                                        <?php }?>
                                        
                                        <?php if(trim(get_post_meta($post->ID, 'post-image-5', true)) != ""){ ?>
                                        <li>
                                            <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'post-image-5', true ), 660,270, true ) ?>"/>
                                        </li>
                                        <?php }?>
                                                      
                                    </ul>
                                </div>
                            <?php }?>
                        <?php }?> 
                        
                        <div class="post-content" style="text-align:justify;">
                            <div class="meta clearfix">
                                <span class="meta-author">
                                    <?php _e('Posted by ', 'concept7') . the_author_posts_link(); ?>
                                </span>
                                <span class="meta-divider">&rsaquo;</span>
                                <span class="meta-comments">
                                    <?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?>
                                </span>
                                <span class="meta-divider">&rsaquo;</span>
                                <span class="meta-category">
                                    <?php the_category(', '); ?>
                                </span>														
                            </div>
                        
                            <p><?php the_content(); ?><!--?php wp_link_pages();?--></p>
                            <div class="clear"></div>
                            
                            <div class="tag-wrapper">
                                <!-- BEGIN .tag -->
                                <?php if ( has_tag()) : ?>
                                    <h4 class="h4-tags"><?php _e( 'Tagged with: ', 'concept7'); ?></h4>
                                    <?php the_tags('&nbsp;','&nbsp;', '&nbsp;'); ?>
                                <?php endif; ?>
                                <!-- END .tag -->
                            </div>  
                                        
                        </div>
                    </div>
                    <div class="about-author">
                    	<?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
                        <div class="author-content">
                            <h3><?php the_author_posts_link(); ?></h3>
                            <div class="line"></div>
                            <p><?php the_author_meta('description'); ?></p>
                            <p class="author-link"><i class="icon-edit"></i><?php _e('View all posts by&nbsp; &rsaquo;&nbsp; ', 'concept7') ?><?php the_author_posts_link(); ?></p>
                            <p class="author-link"><i class="icon-home"></i><?php _e('Author URL&nbsp; &rsaquo;&nbsp; ', 'concept7') ?><a href="<?php the_author_meta('user_url') ?>" target="_blank"><?php the_author_meta('user_url') ?></a></p>
                       	</div>
                    </div>
                    <h3 class="related-post"><?php _e('Related Posts', 'concept7') ?></h3>
                    <div class="line"></div>
                    <div class="related-blog-posts">
                        <?php
                            $catid = '';
                            foreach((get_the_category()) as $category){
                                $catid = $catid . $category->cat_ID . ',';
                            }
                            $catid = substr($catid,0,-1);
                            $this_post = $post->ID; // get ID of current post
                            $posts = get_posts('numberposts=3&category='. $catid .'&exclude=' . $this_post);
                            ?>
                        <ul class="row-fluid" style="margin-left:0;">	
                        <?php foreach($posts as $post) {?>
                        <li class="portfolio-item span4 not-status">                	
                            <div class="portfolio-item-wrapper related-post-wrapper">
                                <span class="da-t">
                                <?php
                                // check if post has a thumbnail
                                if ( has_post_thumbnail() ) { ?>
                                    <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <a href="<?php echo $thumbnail; ?>" class="post-image" title="<?php the_title(); ?>" rel="prettyPhoto">
                                        <img class="raised raised-3" src="<?php echo aq_resize($thumbnail, 360, 280, true) ?>" alt="<?php the_title(); ?>" class="small-post-img image-deco" alt=""/>
                                    </a>
                                <?php }else { //show this if post doesn't have thumbnail ?>
                                <?php $format = get_post_format();?>
                                    <?php if($format == 'quote'){ ?>
                                    <span class="quote left image-deco" style="width:51px;height:51px;margin-right:15px;"></span>
                                    <?php }elseif($format == 'status'){ ?>
                                    <span class="status left image-deco" style="width:51px;height:51px;margin-right:15px;"></span>
                                    <?php }elseif($format == 'gallery'){ ?>
                                    <span class="gallery left image-deco" style="width:51px;height:51px;margin-right:15px;"></span>
                                    <?php }elseif($format == 'link'){ ?>
                                    <span class="link left image-deco" style="width:51px;height:51px;margin-right:15px;"></span>
                                    <?php }elseif($format == 'video'){ ?>
                                    <span class="video left image-deco" style="width:51px;height:51px;margin-right:15px;"></span>
                                    <?php }else{ ?>
                                    <span class="normal left image-deco" style="width:51px;height:51px;margin-right:15px;"></span>
                                    <?php }?>
                                
                                <?php } ?>
                                <div class="hover-dir">
                                    <p class="portfolio-preview-time"><?php the_time('F j, Y'); ?></p>
                                	<p class="portfolio-preview-content"><?php echo excerpt('10'); ?></p>    
                                </div>
                                </span>
                                <div class="related-post-title">
                                    <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title() ?></a></h4>
                                    <p class="sidebar-item-category"><?php the_category(', '); ?></p>
                                    <div class="sidebar-item-cmt">
                                     	<?php comments_popup_link('0', '1', '%'); ?>
                                    	<i class="icon-comments"></i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php } wp_reset_postdata(); ?>
                        </ul>
                    </div>
                    </div>
                    <div class="line margin-line"></div>
                    <?php comments_template(); ?>
                </div>
                
                <?php endwhile; ?>
                <?php endif; ?>
                
                <?php if(!$concept7_data['single_left']){?>
                <!-- Get sidebar here -->
                <div id="sidebar-wrapper" class="span4">
                    <?php get_sidebar(); ?>
                </div>
                <?php }?>
      		</div>
    	</div>
        <?php echo do_shortcode('[clear size="50"]') ?>
    </div>
    
</div>

<?php get_footer(' '); ?>