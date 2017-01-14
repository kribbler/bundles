<?php get_header(); ?>

<?php   

        
        global $is_portfolio_page;

        $is_portfolio_page = false;

        $meta = get_post_meta( get_the_ID() );
        
		$left_sidebar = 0;
		if ( isset($meta['sbg_selected_sidebar']) ) {
        	$left_sidebar = $meta['sbg_selected_sidebar'];
		}
		
		$right_sidebar = 0;
		if ( isset($meta['sbg_selected_sidebar_replacement']) ) {
			$right_sidebar = $meta['sbg_selected_sidebar_replacement'];
		}
				
        global $wpdb;
        $data = $wpdb->get_results("SELECT type, details FROM " . $wpdb->prefix . "envoo_pages WHERE type='portfolio' ORDER BY id ASC");

        if ( empty ( $data ) ) {
            $data[0]->details = '';
        }
                
        $data = explode(';', $data[0]->details);
        if ( !isset($data[2]) ) {
            $data[2] = '';
        }
        if ( !isset($data[1]) ) {
            $data[1] = '';
        }
        if ( !isset($data[3]) ) {
            $data[3] = '';
        }
		
        $max_per_pages = $data[2];
        $filter_status = $data[3];
        $number_of_columns = $data[1];
           		        
        switch( $number_of_columns ) {
            case "2 column": $number_of_columns = "two-column"; break;
            case "3 column": $number_of_columns = "three-column"; break;
            case "4 column": $number_of_columns = "four-column"; break;
        }
        
?>

<input class="none" id="max_per_page" type="text" value="<?php echo $max_per_pages; ?>" >

<?php   
    global $wpdb;
    $data = $wpdb->get_results("SELECT type, details FROM " . $wpdb->prefix . "envoo_pages WHERE type='portfolio'");
	
	$parent = "";

	$zac_id = explode(";", $data[0]->details);

	if( isset($data[0]->type) ) {
		$parent = get_page( $zac_id[0] );
	}
	       
    if ( isset($parent->ID) && $parent->ID == get_the_ID() && $zac_id[0] != "0" ):
        
        $is_portfolio_page = true;
?>

<?php
    $myterms = get_terms('portfolio_category', 'orderby=none&hide_empty');    
?>

<?php if ( $filter_status ): ?>
	<div class="box portfolio-filter">
	    
	   <ul id="filters" class="clearfix" data-option-key="filter">   
	
	        <li><a href="#filter" class="selected-filter" data-filter="*">All</a></li>
	
	        <?php
	            $filters = get_terms('portfolio_category', 'orderby=none&hide_empty');   
	            
	            foreach ($filters as $filter) {
	                echo '<li> <span>/</span> <a href="#filter" data-filter="' . strtolower(str_replace(" ","-", $filter->name)) . '">' . $filter->name . '</a></li>';
	            } 
	
	        ?>
	
	    </ul>
	    
	</div>
<?php endif; ?>
</div>
<div class="main-wrapper portfolio-wrapper" <?php if ( ! $filter_status ) { echo 'style="margin-top: -60px"'; } ?>>
    <ul class="portfolio clearfix" id="isotope-container">
    <?php
        
        $args = array(
            'post_type'    => 'portfolio',
            'orderby'      => 'id',
            'order'        => 'DESC',
            'numberposts'  => -1,
        );
        
        $thumbnail_args = array(
            'alt'	=> "",
            'title'	=> "",
        );
                
        $current_number = 0;
        $current_class = 1;
        
        $portfolio_posts = get_posts( $args );
        
        foreach( $portfolio_posts as $post ) :	setup_postdata($post); ?>
                
                <?php
                    if ( $current_number++ == $max_per_pages) {
                        $current_number = 1;
                        $current_class++;
                    }
                ?>
                
                <li class="isotope-item <?php echo 'page-' . $current_class; ?> <?php echo $number_of_columns; ?> <?php if ( get_the_terms( $post->ID, 'portfolio_category' )) { foreach (get_the_terms( $post->ID, 'portfolio_category' ) as $cat){ echo strtolower(str_replace(" ","-", $cat->name)) . " "; } } ?>">
                    
                    <?php if( $number_of_columns == "four-column" ): ?>
                        <?php echo get_the_post_thumbnail($post->ID, "portfolio-thumbnail-4-column", $thumbnail_args); ?>
                    <?php elseif ( $number_of_columns == "three-column" ): ?>
                        <?php echo get_the_post_thumbnail($post->ID, "portfolio-thumbnail-3-column", $thumbnail_args); ?>
                    <?php else: ?>
                        <?php echo get_the_post_thumbnail($post->ID, "portfolio-thumbnail-2-column", $thumbnail_args); ?>
                    <?php endif; ?>
                    
                    <div class="portfolio-responsive"><?php echo get_the_post_thumbnail($post->ID, "portfolio-first-responsive", $thumbnail_args); ?></div>
                    
                    <h3>
                        <?php the_title(); ?>
                    </h3>
                    
                    <div class="portfolio-hover">
                        <h3>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p>
                            <?php 
                                global $more;
                                $more = 0;
                                echo do_shortcode(str_replace("&nbsp;", '<p class="blank-line clearfix"><br /></p>', get_the_content("", true)))
                            ?>
                        </p>
                        <a rel="lightbox" href="<?php echo get_the_post_thumbnail_src(get_the_post_thumbnail($post->ID, 'full')); ?>" class="enlarge"></a>
                        <a href="<?php the_permalink(); ?>" class="open"></a>
                    </div>
                    
                </li>
        <?php endforeach; ?>
    </ul> 
</div>

<div class="main-wrapper">
  
<div class="box portfolio-pagination jquery-pagination">
    <div>

        <a><?php echo "<img src='" . get_template_directory_uri() . "/images/arrow_left.png' class='previous' />"; ?></a>
        <span data-post-number="<?php echo $wp_query->found_posts; ?>" data-max-pages="<?php echo $max_per_pages; ?>" class="pagination-data">
        <?php
            $number_of_pages = ceil ( count($portfolio_posts) / $max_per_pages );
            for ( $i = 1; $i <= $number_of_pages; $i++ ) {
                $selected = '';
                if ( $i == 1 ) {
                    $selected = 'selected-link';
                } else {
                    echo "<span> / </span>";
                }
                echo '<a class="' . $selected . ' pagination-value">' . $i . '</a>';
            }    
        ?></span>
        <a><?php echo "<img src='" . get_template_directory_uri() . "/images/arrow_right.png' class='next' />"; ?></a>

    <?php wp_reset_query(); ?>
    </div>
</div>

<?php endif;?>
<?php $faq_id = get_the_id(); ?>


<!-- Start Load page content -->
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
        
        <?php if ( $left_sidebar[0] != "0" ): ?>
            <aside class="sidebar sidebar-left clearfix"><?php get_sidebar( dynamic_sidebar( $left_sidebar[0]) ); ?></aside>   
        <?php endif; ?>

        <section class="clearfix <?php if( isset($left_sidebar[0]) && $left_sidebar[0] != "0" && isset($right_sidebar[0]) && $right_sidebar[0] != "0" ){ echo "blog-two-sidebar"; } elseif ( (isset($left_sidebar[0]) && $left_sidebar[0] != "0") || (isset($right_sidebar[0]) && $right_sidebar[0] != "0" ) ) { echo "blog-one-sidebar"; } ?>">
            



        <?php if( $faq_id == get_option("faq_page") ): ?>
            <!--  FAQ PAGE   -->
            <div class="box portfolio-filter faq-filter-wrapper">
                
               <ul id="filters" class="clearfix faq-filter" data-option-key="filter">   
            
                    <li><a class="selected-filter" data-filter="*">All</a></li>
            
                    <?php
                        $filters = get_terms('faq_category', 'orderby=none&hide_empty');   
                        
                        foreach ($filters as $filter) {
                            echo '<li> <span>/</span> <a href="#filter" data-filter="' . strtolower(str_replace(" ","-", $filter->name)) . '">' . $filter->name . '</a></li>';
                        } 
            
                    ?>
            
                </ul>
                
            </div>

            <ul class="faq clearfix">
            <?php
                
                $args = array(
                    'post_type'    => 'faq',
                    'orderby'      => 'id',
                    'order'        => 'DESC',
                    'numberposts'  => -1,
                );
                
                $thumbnail_args = array(
                    'alt'   => "",
                    'title' => "",
                );
                        
                $current_number = 0;
                $current_class = 1;
                
                $faq_posts = get_posts( $args );
                
                foreach( $faq_posts as $post ) :  setup_postdata($post); ?>
                        
                        <?php
                            if ( $current_number++ == $max_per_pages) {
                                $current_number = 1;
                                $current_class++;
                            }
                        ?>
                        
                        <li class=" <?php echo 'page-' . $current_class; ?> <?php echo $number_of_columns; ?> <?php if ( get_the_terms( $post->ID, 'faq_category' )) { foreach (get_the_terms( $post->ID, 'faq_category' ) as $cat){ echo strtolower(str_replace(" ","-", $cat->name)) . " "; } } ?>">
                            <?php echo do_shortcode('[accordion closed="true"][accordion_item title="' . get_the_title() . '"]' . get_the_content() . '[/accordion_item][/accordion]'); ?>             

                            
                         
                            
                        </li>
                <?php endforeach; ?>
            </ul> 
        <?php endif;?>


            <?php wp_reset_query(); the_content(); ?>
        </section>
                        
        <?php if ( isset($right_sidebar[0]) && $right_sidebar[0] != "0" ): ?>
            <aside class="sidebar sidebar-right clearfix"><?php get_sidebar( dynamic_sidebar( $right_sidebar[0]) ); ?></aside>   
        <?php endif; ?>
    
    <?php endwhile; ?>   
<!-- End Load page content -->


<?php get_footer(); ?>