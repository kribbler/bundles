<?php get_header(); ?>

<div id="primary">
    <div id="content" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'single' ); ?>

        <?php endwhile; // end of the loop. ?>

    </div>
</div>

<?php if ( get_post_type() == "portfolio" ): ?>
<div class="clearfix">
    <div class="portfolio-image clearfix">

        <?php

            function getVideos ($shortcode_start, $shortcode_end, $shortcode_content, $offset1, $offset2) {

                $offset = 0;
                $videos = array();

                while(true) {
                    $start = strpos($shortcode_content, $shortcode_start, $offset);
                    $end = strpos($shortcode_content, $shortcode_end, $start);
                    $offset = $end;

                    if ( ! $start ) {
                        break;
                    }

                    array_push($videos, substr($shortcode_content, $start + $offset1, $end - $start - $offset2));
                }

                return $videos;
            }

        ?>

       <?php                                                   
            $attachments = get_posts( array(
                    'post_type' => 'attachment',
                    'posts_per_page' => -1,
                    'post_parent' => $post->ID,
                    'orderby' => 'id',
                    'order' => 'ASC'
            ));
            $i =0;
            foreach ( $attachments as $attachment ) {
                echo '<div class="';
                if( $i++ == 0 ) {?>
                    portfolio-current-image
                <?php }
                    echo ' portfolio-image-single"><div class="portfolio-controls"><a class="left-portfolio"></a><a class="right-portfolio"></a></div>' . wp_get_attachment_image( $attachment->ID, "portfolio") . '</div>';   
            }


            $youtube_videos = getVideos("[youtube]", "[/youtube]", get_the_content(), 9, 9);

            foreach ( $youtube_videos as $video ) { ?>
                <div class="portfolio-image-single <?php if ( $i == 0 ) { $i++; echo "portfolio-current-image"; } ?>">
                    <div class="portfolio-controls">
                        <a class="left-portfolio"></a>
                        <a class="right-portfolio"></a>
                    </div>
                    <div class="video-wrapper"><iframe src="http://www.youtube.com/embed/<?php echo $video; ?>?wmode=transparent" frameborder="0" wmode="Opaque"></iframe></div>
                </div>
            <?php }

            $vimeo_videos = getVideos("[vimeo]", "[/vimeo]", get_the_content(), 7, 7);

            foreach ( $vimeo_videos as $video ) { ?>
                <div class="portfolio-image-single <?php if ( $i == 0 ) { $i++; echo "portfolio-current-image"; } ?>">
                    <div class="portfolio-controls">
                        <a class="left-portfolio"></a>
                        <a class="right-portfolio"></a>
                    </div>
                    <div class="video-wrapper"><iframe src="http://player.vimeo.com/video/<?php echo $video; ?>" frameborder="0" width="560" height="315" wmode="Opaque"></iframe></div>
                </div>
            <?php }

        ?>
        
        <div class="thumbnails clearfix">
            <?php 
                $i =0;
                foreach ( $attachments as $attachment ) {
                    ?>
                        <div  <?php if( $i++ == 0 ) { echo "id='selected-thumbnail'" ; } ?> class="thumbnail"><img src="<?php $cur = wp_get_attachment_image_src( $attachment->ID, "portfolio-thumbnail"); echo $cur[0]; ?>"><div class="portfolio-thumbnails-hover"></div></div>
                    <?php
                }

                foreach ( $youtube_videos as $video ) {
                    ?>
                        <div  <?php if( $i++ == 0 ) { echo "id='selected-thumbnail'" ; } ?> class="thumbnail" style="background: url(http://img.youtube.com/vi/<?php echo $video; ?>/mqdefault.jpg) center center"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/portfolio_video_thumbnail.png"><div class="portfolio-thumbnails-hover"></div></div>
                    <?php                    
                }

                foreach ( $vimeo_videos as $video ) {
                    $data = file_get_contents("http://vimeo.com/api/v2/video/$video.json");
                    $data = json_decode($data);
                    ?>
                        <div  <?php if( $i++ == 0 ) { echo "id='selected-thumbnail'" ; } ?> class="thumbnail" style="background: url(<?php echo $data[0]->thumbnail_medium; ?>) center center"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/portfolio_video_thumbnail.png"><div class="portfolio-thumbnails-hover"></div></div>
                    <?php                    
                }
            ?>
                        
        </div>
    </div>
    
    <div class="portfolio-content clearfix">
        <?php echo str_replace("&nbsp;", '<p class="blank-line clearfix"><br /></p>', strip_shortcodes(get_the_content("", true))); ?>  
    </div>
</div>
<div class="box portfolio-pagination">
    <div>
        
        <?php wp_reset_query(); ?>
        <?php
            $next_post = get_next_post();
            if (!empty( $next_post )): ?>

            <?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ): ?>
                <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo "<img src='" . get_stylesheet_directory_uri() . "/images/arrow_right.png' class='next' />"; ?></a>
            <?php else: ?>
                <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo "<img src='" . get_stylesheet_directory_uri() . "/images/arrow_left.png' class='previous' />"; ?></a>
            <?php endif; ?>
        <?php endif; ?>
            
        <?php
        $args = array(
            'post_type'    => 'portfolio',
            'orderby'      => 'id',
            'order'        => 'DESC',
            'numberposts'  => -1,
        );
            $page_number = 1;
            $current_page_id = get_the_ID();
        $portfolio_posts = get_posts( $args );
        foreach( $portfolio_posts as $post ) :  setup_postdata($post); ?>
            <?php if ( $page_number != 1 ) { echo "<span> / </span>"; } ?>
            <a <?php if ( $current_page_id == get_the_ID() ) { echo 'class="selected-link"'; } ?> href="<?php the_permalink(); ?>"><?php echo $page_number++; ?></a>
        <?php endforeach; ?>

        <?php wp_reset_query(); ?>
        <?php
            $previous_post = get_previous_post();
            if (!empty( $previous_post )): ?>

            <?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ): ?>
                <a href="<?php echo get_permalink( $previous_post->ID ); ?>"><?php echo "<img src='" . get_stylesheet_directory_uri() . "/images/arrow_left.png' class='previous' />"; ?></a>
            <?php else: ?>
                <a href="<?php echo get_permalink( $previous_post->ID ); ?>"><?php echo "<img src='" . get_stylesheet_directory_uri() . "/images/arrow_right.png' class='next' />"; ?></a>
            <?php endif; ?>
        <?php endif; ?>
            
    </div>
</div>

<?php else: ?>

<?php
        
    $meta = get_post_meta( get_the_ID() );
    $left_sidebar = "";
    $right_sidebar = "";
    
    if ( isset($meta['sbg_selected_sidebar'])  ) {
        $left_sidebar = $meta['sbg_selected_sidebar'];
    }
    
    if ( isset($meta['sbg_selected_sidebar_replacement']) ) {
        $right_sidebar = $meta['sbg_selected_sidebar_replacement'];
    }
    
$post2 = $post;

?>

<?php if ( isset($left_sidebar[0]) && $left_sidebar[0] != "0" ): ?>

    <?php if ( isset($right_sidebar[0]) && $right_sidebar[0] != "0" ): ?>
        <aside class="sidebar sidebar-two-left clearfix"><?php get_sidebar( dynamic_sidebar( $left_sidebar[0]) ); ?></aside>
    <?php else: ?>
        <aside class="sidebar sidebar-left clearfix"><?php get_sidebar( dynamic_sidebar( $left_sidebar[0]) ); ?></aside>   
    <?php endif; ?>

</aside>
<?php endif; ?>
<?php $post = $post2; ?>
<?php 
    
    global $wpdb;
    $data = $wpdb->get_results("SELECT type, details FROM " . $wpdb->prefix . "envoo_pages ORDER BY id ASC");

    if ( empty ( $data ) ) {
        $data[0]->details = '';
    }

    $data = explode(';', $data[0]->details); 
    
    $blog_layout = "";
    
    if( isset($data[1]) ) {
        $blog_layout = $data[1];
    }
    
    $id = $post->ID;
        
    $meta = get_post_meta( $id );
    
    $left_sidebar = "";
    $right_sidebar = "";
    
    if(isset($meta['sbg_selected_sidebar'])) {
        $left_sidebar = $meta['sbg_selected_sidebar'];
    }
    
    if(isset($meta['sbg_selected_sidebar_replacement'])) {
        $right_sidebar = $meta['sbg_selected_sidebar_replacement'];
    }
    
    $blog_class = "blog-full-view";

    
    if(  ( isset($left_sidebar[0]) && $left_sidebar[0] != "0" ) || ( isset($right_sidebar[0]) &&  $right_sidebar[0] != "0") )
        $blog_class = "blog-one-sidebar";
    
    
    if( isset( $left_sidebar[0] ) && $left_sidebar[0] != "0" && isset($right_sidebar[0]) && $right_sidebar[0] != "0" )
        $blog_class = "blog-two-sidebar";
    
    ?> 
<section class="<?php echo $blog_class; ?>">   
   <article class="clearfix blog">
            
        <?php if ( get_the_post_thumbnail($post->ID, $blog_class) != "" ): ?>
            <div class="post-date-comments">

                <div>
                    <span class="day-month"><?php echo get_the_date('M d'); ?></span>
                    <span class="year"><?php echo get_the_date('Y'); ?></span>
                </div>

                <a href="<?php echo the_permalink(); ?>#comments" id="scrollToComments">
                    <span class="comments-number"><?php echo $post->comment_count; ?></span>
                    <span class="comments-text"><?php echo __('comments', 'shopifiq'); ?></span>
                </a>
            </div>
        <?php echo get_the_post_thumbnail($post->ID, $blog_class); ?>
        <?php endif; ?> 
        <div class="blog-main clearfix">
            
            <?php if ( get_the_post_thumbnail($post->ID, $blog_class) == "" ): ?>
                <div class="no-image-post">
                    <div class="post-date-comments3 clearfix">

                        <div>
                            <span class="day-month"><?php echo get_the_date('M d'); ?></span>
                            <span class="year"><?php echo get_the_date('Y'); ?></span>
                        </div>

                        <a href="<?php echo the_permalink(); ?>#comments" id="scrollToComments">
                            <span class="comments-number"><?php echo $post->comment_count; ?></span>
                            <span class="comments-text">comments</span>
                        </a>
                    </div>
                    <header>
                            <h2><?php the_title(); ?></h2>
                    </header>
                </div>
            <?php else: ?>
                <header>
                        <h2><?php the_title(); ?></h2>
                </header>
            <?php endif; ?>
            
            <?php if( $blog_class == 'blog-no-sidebar' ): ?>
                <?php tagsAndAuthor(); ?>
            <?php endif; ?>
            <div class="blog-more-content">                        
                <?php 
                     the_content();
                ?>
            </div>
            <footer>
                <?php if( $blog_class != 'blog-no-sidebar' ): ?>
                    <?php tagsAndAuthor(); ?>
                <?php endif; ?>
            </footer>

        </div>
        <div class="clearfix" style="margin: 20px"></div>

    </article>



    <?php 
    
    $sidebar_layout = 0;
        
    if ( isset( $left_sidebar[0] ) && $left_sidebar[0] != 0 && isset( $right_sidebar[0] ) && $right_sidebar[0] != 0 ) {
        $sidebar_layout = 4;
    } else if ( (isset( $left_sidebar[0] ) && $left_sidebar[0] != 0) || (isset( $right_sidebar[0] ) && $right_sidebar[0] != 0) ) {
        $sidebar_layout = 1;
    }
    


?>

<div class="box">
    
    <!-- ShareThis elements -->

    <div class="share-this">

        <span class='st_facebook_hcount' displayText='Facebook'></span>
        <span class='st_twitter_hcount' displayText='Tweet'></span>
        <span class='st_pinterest_hcount' displayText='Pinterest'></span>
        <span class='st_sharethis_hcount' displayText='ShareThis'></span>
    
    </div>

    <!-- ShareThis Scripts -->

    <script type="text/javascript">var switchTo5x=false;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "ur-79f4387c-3a8c-7231-9a0c-f92b327ca6c4", doNotHash: false, doNotCopy: true, hashAddressBar: false});</script>  
    
</div>


<?php comments_template(); ?>
</section>

<?php if ( isset($right_sidebar[0]) && $right_sidebar[0] != "0" ): ?>

    <?php if ( isset($left_sidebar[0]) && $left_sidebar[0] != "0" ): ?>
        <aside class="sidebar sidebar-two-right clearfix"><?php get_sidebar( dynamic_sidebar( $right_sidebar[0]) ); ?></aside>
    <?php else: ?>
        <aside class="sidebar sidebar-right clearfix"><?php get_sidebar( dynamic_sidebar( $right_sidebar[0]) ); ?></aside>   
    <?php endif; ?>

</aside>
<?php endif; ?>

<?php endif; ?>

<?php get_footer(); ?>