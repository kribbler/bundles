<?php 
global $concept7_data; 
global $post; 
get_header();
?>
<div id="portfolio-wrapper" class="wrapper boxed-wrapper">
	<?php get_template_part('subpage'); ?>
    <div class="container">
    <div class="clear" style="height:60px"></div>
    <?php
    // show portfolios only if they exist
    if($wp_query->have_posts()) {
        ?>
        <section>
            <ul id="da-thumbs" class="row" data-liffect="bounceInRight">
            
            <?php
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
            ?>
                <?php 
                    $terms = get_the_terms (get_the_ID(), 'portfolio_cats');
                ?>
                <li class="portfolio-item span3 isotope-item not-status <?php if($terms) {  foreach ($terms as $term) { echo $term->slug . ' '; } } ?>">
                	<div class="portfolio-item-wrapper">
                    <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                        <span class="da-t">
                            <?php if ( has_post_thumbnail()) : ?>
                                <?php if($concept7_data['port_resize']){
                                    $wr = $concept7_data['resize_option_1']; $hr = $concept7_data['resize_option_2'];
                                }else{
                                    $wr = 460; $hr = 340;
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
            <?php endwhile; wp_reset_postdata();?>	
            </ul>
        </section>
        <?php } echo do_shortcode('[clear size="20"]');?>
        <?php if (function_exists("pagination")) { ?>
            <div class="tabs">
                <ul class="tabNavigation">
                    <?php pagination(); ?>
                </ul>
             </div> 
             <?php } ?>
        <div class="clear"></div>
            
    </div>
    	
</div>

<?php get_footer(' '); ?>