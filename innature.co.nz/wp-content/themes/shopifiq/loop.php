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
    if ( is_home() || single_cat_title("",false != "" ) || get_search_query() != "" || isset($year) ) {
        $id = get_option("page_for_posts");
    } else {
        $id = $post->ID;
    }
        
    $meta = get_post_meta( $id );
    
    $left_sidebar = $meta['sbg_selected_sidebar'];
    $right_sidebar = $meta['sbg_selected_sidebar_replacement'];
        
    
    $sidebar_layout = 0;
        
    if ( $left_sidebar[0] != "0" && $right_sidebar[0] != "0" ) {
        $sidebar_layout = 4;
    } else if ( $left_sidebar[0] != "0" || $right_sidebar[0] != "0" || isset($year) ) {
        $sidebar_layout = 1;
    }
    
?>
<?php if ( $left_sidebar[0] != "0" && $blog_layout == "Sidebar layout" ): ?>

    <?php if ( $sidebar_layout == 4 ): ?>
        <aside class="sidebar sidebar-two-left clearfix"><?php get_sidebar( dynamic_sidebar( $left_sidebar[0]) ); ?></aside>
    <?php else: ?>
        <aside class="sidebar sidebar-left clearfix"><?php get_sidebar( dynamic_sidebar( $left_sidebar[0]) ); ?></aside>   
    <?php endif; ?>

</aside>
<?php endif; ?>
    <?php     

    $posts_page_id = get_option( 'page_for_posts');
    $site_link =  home_url() . '/' . get_page_uri( $posts_page_id );
    
    if( is_month() ) {
       $site_link =  home_url();
    }
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $new_query = new WP_Query();
    
    if ( isset( $_GET['s'] ) ) {
        $search = $_GET['s'];
    }
    else {
        $search = "";
    }

    
    $cat = "Posts";
    
    if ( single_cat_title( '', false ) != "") {
    
        $cat = single_cat_title( '', false );
    
        $site_link =  home_url();
    
    }

    $month = get_the_date('m');
    if($search != "") {
        $new_query->query( 's="'.$search . '&post_type=post&posts_per_page=-1' );
    } elseif( get_cat_id( single_cat_title("",false) ) != "" ) {
        $new_query->query( 'cat='.get_cat_id( single_cat_title("",false) ).'&paged='.$paged.'&post_type=post' );
    } elseif ( single_tag_title( '', false) != "" ) {
        $new_query->query( 'paged='.$paged.'&tag=' . single_tag_title( '', false) . '' );
    } elseif( is_archive() ) {
        $new_query->query( 'paged='.$paged.'&year='.$year.'&monthnum='.$month . '&post_type=post&posts_per_page=-1' );
    } else {
        $new_query->query( 'paged='.$paged.'&post_type=post' );
    }

            
    $blog_class = "";
    
    $select = 0;
    
    if ( $blog_layout == "Sidebar layout" ) {
        $select = $sidebar_layout;
    }

    if ( $blog_layout == "1 column" ) {
        $select = 2;
    }
    
    if ( $blog_layout == "2 column" ) {
        $select = 3;
    }
    
    if ( $blog_layout == "3 column" ) {
        $select = 6;
    }
    
    if ( $blog_layout == "4 column" ) {
        $select = 7;
    }
    
    $number_of_columns = 0;
    
    switch( $select ) {
        
        case 0: $blog_class = "blog-full-view"; break;
        case 1: $blog_class = "blog-one-sidebar"; break;
        case 2: $blog_class = "blog-no-sidebar"; break;
        case 3: $blog_class = "blog-two-column"; $number_of_columns = 2; break;
        case 4: $blog_class = "blog-two-sidebar"; break;
        case 6: $blog_class = "blog-three-column"; $number_of_columns = 3; break;
        case 7: $blog_class = "blog-four-column"; $number_of_columns = 4; break;
    }

    echo '<section class="clearfix ' . $blog_class . '">';
    
    $counter = 0;
    $first = true;
    
    while ($new_query->have_posts()) : $new_query->the_post(); ?>
    
        <?php $counter++; ?>
    	<?php $post = get_post(get_the_ID()); ?>
        <?php $post_category = get_the_category(get_the_ID()); ?>
        <?php $proceed = true; ?>
        <?php if ( isset($post_category[0]->category_parent) && $post_category[0]->category_parent != 0 ): ?>
    		<?php $category_parent = get_the_category_by_ID($post_category[0]->category_parent); ?>
        	<?php if($category_parent == "Portfolio"){
                         $proceed  = false;
                      }
		?>
    	<?php endif; ?>
       
       <?php if( $proceed ): ?>
       
       
       <?php if ( $blog_class ==  "blog-two-column" || $blog_class == "blog-three-column" || $blog_class == "blog-four-column"): ?>

            <?php  if ( $counter  ==  $number_of_columns || $first ) { 
                    //echo '<div class="row">';
                    $counter = 0;
                    $first = false;
            } ?>

       <?php endif; ?>

            <article id="post-<?php the_ID(); ?>" class="clearfix blog <?php echo $blog_class; ?>" <!--<?php post_class(); ?>-->

                <?php $check_if_text_only = true; ?>
                <?php if ( strpos(get_post_field('post_content', get_the_ID()), "[vimeo]") > -1 ): ?>
                    <?php
                        $check_if_text_only = false;
                        $content = get_post_field('post_content', get_the_ID());
                        $start = strpos($content, "[vimeo]");
                        $end = strpos($content, "[/vimeo]");
                                                
                        echo do_shortcode(substr($content, $start, $end - $start + 8));
                    ?>
                <?php elseif ( strpos(get_post_field('post_content', get_the_ID()), "[youtube]") > -1 ): ?>
                    <?php
                        $check_if_text_only = false;
                        $content = get_post_field('post_content', get_the_ID());
                        $start = strpos($content, "[youtube]");
                        $end = strpos($content, "[/youtube]");
                                                
                        echo do_shortcode(substr($content, $start, $end - $start + 10));
                    ?>
                <?php elseif (get_the_post_thumbnail($post->ID, $blog_class) == ""): ?>
                	
                <?php else: ?>
                <div class="wp-post-image">
                <?php echo get_the_post_thumbnail($post->ID, $blog_class); ?>
                        <?php
                            $attachments = get_posts( array(
                                    'post_type' => 'attachment',
                                    'posts_per_page' => -1,
                                    'post_parent' => $post->ID,
                                    'orderby' => 'id',
                                    'order' => 'ASC'
                            )); 
                            
                            if ( get_the_post_thumbnail($post->ID, $blog_class) ) {
                                $check_if_text_only = false;
                            }

                            if ( $attachments ) {
                                $check_if_text_only = false;
                                $count_att = 0;
                                foreach ( $attachments as $attachment ) {
                                    $count_att++;
                                    $thumbimg = wp_get_attachment_image( $attachment->ID, $blog_class );
                                    if( $thumbimg != str_replace(" wp-post-image", "", get_the_post_thumbnail($post->ID, $blog_class)) ) {
                                        echo $thumbimg;
                                    }
                                }
                                if ( $count_att > 1):
                                ?>
                                    <div class="blog-loop-controls">
                                        <a class="left-blog-control"></a>
                                        <a class="right-blog-control"></a>
                                    </div>
                                <?php
                                endif;
                            }
                        ?>
                </div>  
                <?php endif; ?>
                
                <?php if ( ! $check_if_text_only ): ?>
                    <div class="post-date-comments">

                        <div>
                            <span class="day-month"><?php echo get_the_date('M d'); ?></span>
                            <span class="year"><?php echo get_the_date('Y'); ?></span>
                        </div>

                        <a href="<?php echo the_permalink(); ?>#comments">
                            <span class="comments-number"><?php echo $post->comment_count; ?></span>
                            <span class="comments-text"><?php echo __('comments', 'shopifiq'); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="blog-main clearfix">
                
                    <header>
                            <?php if ( $check_if_text_only ): ?>
                                <a href="<?php echo the_permalink(); ?>"><h2 class="article-text-only"><?php the_title(); ?></h2></a>
                                <div class="post-date-comments2">
                                    <?php echo get_the_date('M d Y'); ?>,
                                    <a href="<?php echo the_permalink(); ?>#comments">
                                        <?php echo $post->comment_count; ?> <?php echo __('comments', 'shopifiq'); ?>
                                    </a>
                                </div>
                            <?php else: ?>
                               <a href="<?php echo the_permalink(); ?>"><h2 class="article-text-only"><?php the_title(); ?></h2></a>
                            <?php endif; ?>
                    </header>
                    
                    <?php if( $blog_class == 'blog-no-sidebar' ): ?>
                        <?php tagsAndAuthor(); ?>
                    <?php endif; ?>
                    <div class="blog-more-content blog-all">                        
                        <?php 
                                global $more;
                                $more = 0;
                                echo do_shortcode(wpautop(get_the_content(''))); 
                        ?>
                    </div>
                    <footer>
                        <?php if( $blog_class != 'blog-no-sidebar' ): ?>
                            <?php tagsAndAuthor(); ?>
                        <?php endif; ?>
                        <span>
                            <img alt='Readmore arrow' src="<?php echo get_template_directory_uri() . "/images/arrow_right.png"; ?>" class='breadcrumbs-arrow' /><a href="<?php echo the_permalink(); ?>"><?php echo __('Read more', 'shopifiq'); ?></a>
                        </span>
                    </footer>
                    
                </div>
                <div class="clearfix"></div>
                <div class="hr clearfix"></div>
                
            </article>
                 
            <?php if ( $counter == $number_of_columns - 1 ) {
                echo "<div class='column-hr clearfix'></div>";
            } ?>
       <?php endif; ?>
       
    <?php
    
    endwhile;
    
    ?>
    <?php 
    
    echo '<div class="clearfix"></div>';
    
    if( $new_query->found_posts == 0 ) {
        if( $counter == 0 ) {
            echo "<h2>";
            _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'shopifiq' );
            echo "</h2>";
        }
    }
    else {
        if( single_tag_title( '', false) == "" && get_template_part('includes/pagination') != "" ) {
            echo '<div class="box cleafix">';
                get_template_part('includes/pagination');
            echo '</div>';
        }
    }
    
    echo '</section>';
    
    ?>
            
    <?php wp_reset_query(); ?>
    <?php if ( isset($right_sidebar[0]) && $blog_layout == "Sidebar layout" ): ?>

        <?php if ( $sidebar_layout == 4 ): ?>
            <aside class="sidebar sidebar-two-right clearfix"><?php get_sidebar( dynamic_sidebar( $right_sidebar[0]) ); ?></aside>
        <?php else: ?>
            <aside class="sidebar sidebar-right clearfix"><?php get_sidebar( dynamic_sidebar( $right_sidebar[0]) ); ?></aside>   
        <?php endif; ?>

    <?php endif; ?>