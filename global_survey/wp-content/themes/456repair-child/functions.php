<?php
define('PARENT_DIR', get_stylesheet_directory() );

add_action( 'widgets_init', 'child_456_widgets_init' );

function child_456_widgets_init(){
    if ( function_exists('register_sidebar') ) {
        register_sidebar(array(
            'name' => 'Footer Column 1',
            'id' => 'footer_column_1',
            'before_widget' => '<div id="%1$s" class="footer_column_1 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));	
		
		register_sidebar(array(
            'name' => 'Footer Column 2',
            'id' => 'footer_column_2',
            'before_widget' => '<div id="%1$s" class="footer_column_2 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));	
		
		register_sidebar(array(
            'name' => 'Footer Column 3',
            'id' => 'footer_column_3',
            'before_widget' => '<div id="%1$s" class="footer_column_3 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));	
		
		register_sidebar(array(
            'name' => 'Footer Column 4',
            'id' => 'footer_column_4',
            'before_widget' => '<div id="%1$s" class="footer_column_4 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));	
		
		register_sidebar(array(
            'name' => 'Footer Column 5',
            'id' => 'footer_column_5',
            'before_widget' => '<div id="%1$s" class="footer_column_5 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));	

        register_sidebar(array(
            'name' => 'Footer Column 6',
            'id' => 'footer_column_6',
            'before_widget' => '<div id="%1$s" class="footer_column_6 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        )); 
		
		register_sidebar(array(
            'name' => 'Bellow Footer Left',
            'id' => 'bellow_footer_left',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
		
		register_sidebar(array(
            'name' => 'Bellow Footer Center',
            'id' => 'bellow_footer_center',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
		
		register_sidebar(array(
            'name' => 'Bellow Footer Right',
            'id' => 'bellow_footer_right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
		
		register_sidebar(array(
            'name' => 'Need Help?',
            'id' => 'need_help',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
    }
}

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'home_tab',
    array(
      'labels' => array(
        'name' => __( 'Home Tabs' ),
        'singular_name' => __( 'Home Tab' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

add_shortcode( 'my_header_search', 'show_my_header_search' );

function show_my_header_search( $atts, $content = null ){
    get_template_part('includes/my-header-bottom-search' );
}

add_shortcode( 'homepage_tabs', 'show_tabbed_homepage' );

function show_tabbed_homepage($atts, $content = null){
    extract(shortcode_atts(array(
        'id'       => '',
        'taxonomy' => '',
        'term'     => '',
    ), $atts ) );

    $limit = 10;

    $query_args = array(
        'post_type'       => 'home_tab',
        'posts_per_page'  => $limit,
        'order'           => 'ASC',
            'orderby'         => 'id',
    );

    if($term && $taxonomy) {
        $query_args = array(
            'post_type'       => 'home_tab',
            'posts_per_page'  => $limit,
            'tax_query'       => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'     => $term
                )
            )
        );
    }

    global $post;

    $listings_array = get_posts( $query_args );

    $output = '<div class="featured_listings">';
    $output .= '<div class="row">';

    $output .= '<ul id="header_tabs">';
    foreach ($listings_array as $listing) {
        $output .= '<li id="home_tab_'.$listing->ID.'" class="h_tabs_li featured_inactive">' . $listing->post_title . '</li>';
    }
    $output .= '</ul>';

    $first_one = 0;
    $output .= '<div class="featured_listing_extend">';
    foreach ($listings_array as $listing) {
        $output .= '<div class="featured_listing_hidden_info" id="featured_hidden_'.$listing->ID.'">';
        $output .= $listing->post_content;
        $output .= '</div>';
    }
    $output .= '</div>';

    $output .= '</div>';
    $output .= '</div>';

    $output .= '
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
    var visible_featured = '.$listings_array[0]->ID.';
    $("#home_tab_" + visible_featured).addClass("featured_active");
    console.log("home_tab_" + visible_featured);
    $("#featured_hidden_" + visible_featured).show();
    
    $(".h_tabs_li").mouseover(function(){

        var id = $(this).attr("id");
        id = id.split("_");
        id = id[2];
        console.log(id);
        if (id != visible_featured){
            $("#home_tab_" + visible_featured).removeClass("featured_active");
            visible_featured = id;
            $("#home_tab_" + visible_featured).addClass("featured_active");

            //$(".li_inactive").removeClass("featured_active");
            //$("#use_the_" + id).addClass("featured_active");

            $(".featured_listing_hidden_info").hide();
            $("#featured_hidden_" + id).fadeIn();
            visible_featured = id;
        }
    });
    </script>';
    

    //echo "<pre>"; var_dump($listings_array);echo "</pre>";
    return $output;
}

add_image_size('dan_thumb1', 180, 180, true);

add_shortcode( 'homepage_portfolio', 'show_portfolio_homepage' );

function show_portfolio_homepage($atts, $content = null){
    extract(shortcode_atts(array(
        'id'       => '',
        'taxonomy' => '',
        'term'     => '',
    ), $atts ) );

    $limit = 10;

    $query_args = array(
        'post_type'       => 'portfolio',
        'posts_per_page'  => $limit,
        'order'           => 'ASC',
            'orderby'         => 'id',
    );

    $output = 'riggdhdhdgdgdg';
    return $output;
}