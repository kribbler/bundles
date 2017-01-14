<?php
/*
Template Name: Portfolio Masonry
*/
?>

<?php 
global $concept7_data; 
global $post; 
get_header();
?>
<div id="portfolio-wrapper" class="wrapper boxed-wrapper">
	<?php get_template_part('subpage'); ?>
    <div class="container">
        <?php
            // get custom post type ==> portfolio
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $port_cat = get_post_meta( $post->ID, 'port_cat', true );
            $args = array( 'post_type'	=>'portfolio', 'showposts' => $concept7_data['portfolio_page'], 'paged' => $paged );
            
            if( $port_cat ) {
                $args['tax_query'] = array(	
                                            array(
                                                'taxonomy'=>'portfolio_cats',
                                                'field'=>'id',
                                                'terms'=>current( $port_cat ),
                                                'operator' => ( 'only' == key($port_cat) )?'IN':'NOT IN',
                                            )
                                        );
            }
        ?>
    <?php
    // show portfolios only if they exist
    $temp = $wp_query;
    $wp_query = new WP_query( $args );
    if($wp_query->have_posts()) {
        ?>
        <?php $hide_filter = get_post_meta( $post->ID, 'hide_filter', true );?>
        <?php if($hide_filter == 'false'){ ?>
        <div id="portfolio-filter">
        
            <ul class="filter-option">
                <li class="filterable current">
                    <a href="#" data-filter="*"><?php _e( 'All', 'concept7'); ?></a>
                </li>
                
                <?php 
                $cats = get_terms('portfolio_cats',array(
                                        'include'    => current( $port_cat )
                                     ));
                foreach ($cats as $cat ) : ?>
                <li class="filterable">
                    /&nbsp;&nbsp;&nbsp;<a href="#" data-filter=".<?php echo $cat->slug; ?>"><?php echo $cat->name;?></a>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <?php } ?>
        <section>
            <ul class="row portfolio-masonry" data-liffect="bounceInRight">
            
            <?php
				$i = 0;
				$j = 1;
				$span = '';
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
            ?>
                <?php 
                    $terms = get_the_terms (get_the_ID(), 'portfolio_cats');
					if($i==0 || $i%6 == 0 || $j%6 == 0) $span = 'span6'; else $span = 'span3';
                ?>
                <li class="portfolio-item <?php echo $span; ?> isotope-item <?php if($terms) {  foreach ($terms as $term) { echo $term->slug . ' '; } } ?>">
                	<div class="portfolio-item-wrapper">
                    <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                        <span class="da-t">
                            <?php if ( has_post_thumbnail()) : ?>
                                <?php 
									if($i==0 || $i%6 == 0 || $j%6 == 0){
                                    	$wr = 460; $hr = 310;
									}else{
										$wr = 220; $hr = 310;
									}
                                ?>
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
                            <div class="media-icon">
                                <?php if($port_type == 'vimeo'){ ?>
                                <a class="portfolio-preview" href="<?php echo $video_embed_code ?>" rel="prettyPhoto">
                                	<i class="icon-play"></i>
                                </a>
                                <?php }elseif($port_type == 'youtube'){ ?>
                                <a class="portfolio-preview" href="<?php echo $video_embed_code ?>" rel="prettyPhoto">
                                	<i class="icon-play"></i>
                                </a>
                                <?php }else{ ?>
                                <a class="portfolio-preview" href="<?php the_permalink()?>">
                                	<i class="icon-eye-open"></i>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="portfolio-item-title">
                                <h4><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h4>
                                <p class="terms"><?php the_terms($post->ID, 'portfolio_cats', '', ' | ', ''); ?></p>
                            </div>
                        </span>
                    </div>
                    
                </li>
            <?php 
				$i++; $j++;
				endwhile; wp_reset_postdata();
			?>	
            </ul>
        </section>
        <?php } echo do_shortcode('[clear size="50"]');?>
        <?php if (function_exists("pagination")) { ?>
            <div class="tabs">
                <ul class="tabNavigation">
                    <?php pagination(); ?>
                </ul>
             </div> 
             <?php } ?>
        <?php $wp_query = $temp;?>
        <div class="clear"></div>
            
    </div>
    	
</div>

<?php get_footer(' '); ?>