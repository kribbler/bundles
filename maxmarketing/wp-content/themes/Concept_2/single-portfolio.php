<?php global $concept7_data; ?>
<?php get_header(); ?>
<?php
	$port = get_post_meta( $post->ID, 'port', true );
	if(!empty($port)){
		$port_type = $port['only'][0];
	}else{
		$port_type = 'slider';
	}
?>
<div id="single-post-wrapper" class="wrapper boxed-wrapper">
	<div class="single-post-container">
    <?php echo do_shortcode('[clear size="55"]') ?>
        <div class="container">
        <div class="row">
        	<?php if (have_posts()) : ?>                
            <?php while (have_posts()) : the_post(); ?>
            <?php 
					if($port_type == 'none'){
						echo '<div id="single-portfolio-post"><p>';
						the_content();
						echo '</p></div>';
						}else{
				?>
						
            <div id="single-portfolio-post" class="span8">
            	<div class="wrapper-left">
					<?php if($port_type == 'vimeo'){ ?>
                    <div id="image-top" class="portfolio-top raised">  
                        <div class="portfolio-video-embbed">
                            <?php 
                                $video_embed_code = get_post_meta( $post->ID, 'portfolio-video-embed', true );
                                $vimeoID = preg_replace('/^(.*)vimeo.com\/([0-9]*)(.*)$/', '$2', $video_embed_code);
                                echo '<iframe src="http://player.vimeo.com/video/'.$vimeoID.'?title=0&amp;byline=0&amp;portrait=0&amp;color='.$concept7_data['color_scheme'].'" width="800" height="450" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                            ?>
                        </div>
                    </div>
                    <?php }elseif($port_type == 'youtube'){?>
                    <div id="image-top" class="portfolio-top raised">  
                        <div class="portfolio-video-embbed">
                            <?php 
                                $video_embed_code = get_post_meta( $post->ID, 'portfolio-video-embed', true );
                                $youtubeID = explode("?v=", $video_embed_code);
                                echo '<iframe width="853" height="480" src="http://www.youtube.com/embed/'.$youtubeID[1].'" frameborder="0" allowfullscreen></iframe>';
                            ?>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div id="image-top" class="portfolio-top flexslider flexslider_m raised">
                        <ul class="slides">
                            <?php if(trim(get_post_meta($post->ID, 'portfolio-image-1', true)) != ""){ ?>
                            <li>
                                <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'portfolio-image-1', true ), 620,470, true ) ?>"/>
                            </li>
                            <?php }?>
                            
                            <?php if(trim(get_post_meta($post->ID, 'portfolio-image-2', true)) != ""){ ?>
                            <li>
                                <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'portfolio-image-2', true ), 620,470, true ) ?>"/>
                            </li>
                            <?php }?>
                            
                            <?php if(trim(get_post_meta($post->ID, 'portfolio-image-3', true)) != ""){ ?>
                            <li>
                                <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'portfolio-image-3', true ), 620,470, true ) ?>"/>
                            </li>
                            <?php }?>
                            
                            <?php if(trim(get_post_meta($post->ID, 'portfolio-image-4', true)) != ""){ ?>
                            <li>
                                <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'portfolio-image-4', true ), 620,470, true ) ?>"/>
                            </li>
                            <?php }?>
                            
                            <?php if(trim(get_post_meta($post->ID, 'portfolio-image-5', true)) != ""){ ?>
                            <li>
                                <img src="<?php echo aq_resize( get_post_meta( $post->ID, 'portfolio-image-5', true ), 620,470, true ) ?>"/>
                            </li>
                            <?php }?>
                            
                        </ul>
                        
                        
                    </div>
                    <?php } ?>
               	</div>
            </div>
            <?php }?>
            <?php endwhile; ?>
			<?php endif; ?>
            
            <?php if($port_type != 'none'){?>
            <!-- Get sidebar here -->
            <div class="sidebar-wrapper span4">
            	<div class="wrapper-right">
                    <div class="sidebar-info">
                        <h3 class="blog-sidebar-title">
                            <?php _e('Information', 'concept7'); ?>
                        </h3>
                        
                        <div class="sidebar-launch">
                            <p><?php the_content() ?></p>
                        </div>
                        
                        <div class="sidebar-cat">
                            <p><?php _e('In category: ', 'concept7'); the_terms('','portfolio_cats','&nbsp;',' | ','&nbsp;'); ?></p>
                        </div>
                        
                        <div class="sidebar-social">
                            <span class="hidden-phone hidden-tablet"><?php _e('Share our work:','concept7') ?></span>
                            <div class="sb-social-icon">
                                <a class="sb-twitter" href="http://twitter.com/share?url=<?php the_permalink() ?>&amp;lang=en&amp;text=Check out this awesome project:&amp;" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=620');return false;" data-count="none" data-via=" "><img src="<?php echo get_template_directory_uri();?>/images/social/twitter.png" /></a>
                                <a class="sb-facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=660');return false;" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/social/facebook.png" /></a>
                                <a class="sb-google" href="https://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php wp_title('') ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=500');return false;"><img src="<?php echo get_template_directory_uri();?>/images/social/google.png" /></a>
                            </div>
                            
                        </div>
                        <div class="sidebar-comment">
                            <?php 
                                if(trim(get_post_meta($post->ID, 'project-url', true)) != ""){
                            ?>
                            <p><a href="<?php echo get_post_meta($post->ID, 'project-url', true)?>" target="_blank" class="btn no_colored_bg  white_color"><?php _e('Launch project','concept7') ?></a></p>
                            <?php }?>
                        
                        </div>
                        
                    </div> 
               	</div> 
            </div>
            <?php }?>
            </div>
            <div class="clear"></div>
            <?php echo do_shortcode('[block_title_3 margin="60" margin_b="35" subtitle="" title="'.__('Related works','concept7').'"]'); ?>
            
        </div>
    </div>
    <?php if($concept7_data['related_portfolio']){?>
    <div class="portfolio-container">
    	<div class="container">
        	<?php
			$terms = get_the_terms (get_the_ID(), 'portfolio_cats');
			$termid = '';
			foreach($terms as $term){
				$termid = $termid . $term->slug . ',';
			}
			$termid = substr($termid,0,-1);
			$this_post = $post->ID; // get ID of current post
			$posts = get_posts('post_type=portfolio&numberposts=4&portfolio_cats='. $termid .'&exclude=' . $this_post);
			?>
			
            <section>
				<ul id="da-thumbs" class="row">
                <?php foreach($posts as $post) {?>
                	<?php 
						$terms = get_the_terms (get_the_ID(), 'portfolio_cats');
					?>
					<li class="portfolio-item span3 not-status <?php if($terms) {  foreach ($terms as $term) { echo $term->slug . ' '; } } ?>">
                    	<div class="portfolio-item-wrapper">
                            <span class="da-t">
                            <?php if ( has_post_thumbnail()) : ?>
                            
                                <?php if($concept7_data['port_resize']){
                                    $wr = $concept7_data['resize_option_1']; $hr = $concept7_data['resize_option_2'];
                                }else{
                                    $wr = 460; $hr = 300;
                                } ?>
                                <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                
                                <img src="<?php echo aq_resize($thumbnail, $wr, $hr, true) ?>"/>
                                
                            <?php endif; ?>
                                <?php 
                                    $port = get_post_meta( $post->ID, 'port', true );
                                    if(!empty($port)){
                                        $port_type = $port['only'][0];
                                    }else{
                                        $port_type = 'slider';
                                    }
                                    $video_embed_code = get_post_meta( $post->ID, 'portfolio-video-embed', true );
                                ?>
                                <div class="hover-dir">
									<?php if($port_type == 'vimeo'){ ?>
                                    <div class="portfolio-preview">
                                        <p class="portfolio-preview-time"><?php the_time('F j, Y'); ?></p>
                                        <p class="portfolio-preview-content"><?php echo excerpt('10'); ?></p>
                                        <a  href="<?php echo $video_embed_code ?>" rel="prettyPhoto"><h2><i class="icon-play"></i></h2></a>
                                    </div>
                                    <?php }elseif($port_type == 'youtube'){ ?>
                                    <div class="portfolio-preview">
                                        <p class="portfolio-preview-time"><?php the_time('F j, Y'); ?></p>
                                        <p class="portfolio-preview-content"><?php echo excerpt('10'); ?></p>
                                        <a  href="<?php echo $video_embed_code ?>" rel="prettyPhoto"><h2><i class="icon-play"></i></h2></a>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="portfolio-preview">
                                        <p class="portfolio-preview-time"><?php the_time('F j, Y'); ?></p>
                                        <p class="portfolio-preview-content"><?php echo excerpt('10'); ?></p>
                                        <a href="<?php echo $thumbnail ?>" rel="prettyPhoto"><h2><i class="icon-eye-open"></i></h2></a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </span>
                            <div class="portfolio-item-title">
                                <h4><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h4>
                                <p class="terms"><?php the_terms($post->ID, 'portfolio_cats', '', ' | ', ''); ?></p>
                            </div>
                        </div>        
                    </li>
                    <?php }wp_reset_postdata(); ?>
				</ul>
			</section>
            
        </div>
    </div>
    <?php }?>
    <?php echo do_shortcode('[clear size="40"]') ?>
</div>
	
<?php get_footer(' '); ?>