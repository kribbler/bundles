<?php

require_once ('admin/index.php');

// general includes
include('functions/better-comments.php');
include('functions/better-excerpts.php');
include('functions/pagination.php');
include('functions/resizer.php'); 
include('functions/shortcodes/contact-info.php');
include('functions/shortcodes/columns.php');
include('functions/shortcodes/columns-fullwidth.php');
include('functions/shortcodes/accordion.php');
include('functions/shortcodes/accordion-item.php');
include('functions/shortcodes/toggle.php');
include('functions/shortcodes/toggle-item.php');
include('functions/shortcodes/link-button.php');
include('functions/shortcodes/services.php');
include('functions/shortcodes/miscellaneous.php');
include('functions/shortcodes/latest-portfolio.php');
include('functions/shortcodes/clients.php');
include('functions/shortcodes/testimonial.php');
include('functions/shortcodes/block-title.php');
include('functions/shortcodes/social.php');
include('functions/shortcodes/recent.php');
include('functions/shortcodes/slider.php');
include('functions/shortcodes/tabs.php');
include('functions/shortcodes/map.php');

// metaboxes
include('functions/metaboxes/portfolio-meta.php');
include('functions/metaboxes/clients-meta.php');
include('functions/metaboxes/sidebar-meta.php');
include('functions/metaboxes/rev-meta.php');
include('functions/metaboxes/ls-meta.php');
include('functions/metaboxes/post-meta.php');
include('functions/metaboxes/testimonial-meta.php');

// widgets
include('functions/widgets/recent-comments.php');
include('functions/widgets/contact-info.php');
include('functions/widgets/recent-posts.php');

// localization
$lang = get_template_directory() . '/languages';
load_theme_textdomain('concept7', $lang);

// get scripts
add_action('wp_enqueue_scripts','concept7_scripts_function');
function concept7_scripts_function() {
	// include all JS to the WP hook
	if(preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT']))
	{
		wp_enqueue_script( 'html5shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js', array('jquery'), '3.6.2', true);  
	}
	if ( is_single()) wp_enqueue_script( 'comment-reply' ); 
	wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '2.0.6', true);
	wp_enqueue_script('concept7', get_stylesheet_directory_uri() . '/js/concept7.js', array('jquery'), '', true);
	wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('flexslider', get_stylesheet_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('nicescroll', get_stylesheet_directory_uri() . '/js/jquery.nicescroll.js', array('jquery'), '2.0.2', true);
	wp_enqueue_script('carouFredSel', get_stylesheet_directory_uri() . '/js/jquery.carouFredSel.min.js', array('jquery'), '2.0.2', true);
	// Global WooCommerce frontend scripts
	wp_dequeue_script('woocommerce');
	wp_enqueue_script( 'woocommerce', get_template_directory_uri() . '/js/woocommerce.min.js', array( 'jquery', 'jquery-blockui' ), '', true );
	wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '1.2', true);
}

function concept7_style_function()  
{  
	wp_register_style( 'default', get_stylesheet_uri(), array(), '1.2', 'all' );  
    wp_enqueue_style( 'default' );
    wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.2', 'all' );  
    wp_enqueue_style( 'normalize' );
	wp_register_style( 'prettyphoto', get_template_directory_uri() . '/css/prettyphoto.css', array(), '1.2', 'all' );  
    wp_enqueue_style( 'prettyphoto' );  
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '1.2', 'all' );  
    wp_enqueue_style( 'bootstrap' );  
	wp_register_style( 'bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.css', array(), '1.2', 'all' );  
    wp_enqueue_style( 'bootstrap-responsive' ); 
	wp_register_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '1.2', 'all' );  
    wp_enqueue_style( 'flexslider' ); 
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.2', 'all' );  
    wp_enqueue_style( 'font-awesome' ); 
	if(preg_match('/(?i)msie [2-7]/',$_SERVER['HTTP_USER_AGENT']))
	{
		wp_register_style( 'font-awesome-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.min.css', array(), '1.2', 'all' );  
    	wp_enqueue_style( 'font-awesome-ie7' ); 
	}
	wp_register_style( 'effect', get_template_directory_uri() . '/css/effect.css', array(), '1.2', 'all' );  
    wp_enqueue_style( 'effect' ) ;
	wp_register_style( 'custom', get_template_directory_uri() . '/css/custom.php', array(), '1.2', 'all' );  
    wp_enqueue_style( 'custom' ) ;
}  
add_action( 'wp_enqueue_scripts', 'concept7_style_function' );  

function concept7_google_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
	global $concept7_data;
	$concept7_data['heading_font']['font'] = trim($concept7_data['heading_font']['font']);
	$concept7_data['heading_font_4']['font'] = trim($concept7_data['heading_font_4']['font']);
	$concept7_data['menu_font']['font'] = trim($concept7_data['menu_font']['font']);
	$concept7_data['sidebar_font']['font'] = trim($concept7_data['sidebar_font']['font']);
	$concept7_data['body_font']['face'] = trim($concept7_data['body_font']['face']);
	$str = '';
	$str .= str_replace(' ', '+', $concept7_data['heading_font']['font']);
	if($concept7_data['heading_font_4']['font'] != $concept7_data['heading_font']['font']) $str .= '|' . str_replace(' ', '+', $concept7_data['heading_font_4']['font']);
	if(($concept7_data['menu_font']['font'] != $concept7_data['heading_font_4']['font']) && ($concept7_data['menu_font']['font'] != $concept7_data['heading_font']['font'])) $str .= '|' . str_replace(' ', '+', $concept7_data['menu_font']['font']);
	if($concept7_data['sidebar_font']['font'] != $concept7_data['heading_font_4']['font'] && $concept7_data['sidebar_font']['font'] != $concept7_data['heading_font']['font'] && $concept7_data['sidebar_font']['font'] != $concept7_data['menu_font']['font']) $str .= '|' . str_replace(' ', '+', $concept7_data['sidebar_font']['font']);
	if(trim($concept7_data['body_font']['face']) != $concept7_data['heading_font_4']['font'] && trim($concept7_data['body_font']['face']) != $concept7_data['heading_font']['font'] && trim($concept7_data['body_font']['face']) != $concept7_data['menu_font']['font'] && trim($concept7_data['body_font']['face']) != $concept7_data['sidebar_font']['font']) $str .= '|' . str_replace(' ', '+', trim($concept7_data['body_font']['face']));
    wp_register_style( 'googleFonts', $protocol.'://fonts.googleapis.com/css?family='.$str );
	wp_enqueue_style( 'googleFonts');
}
if($concept7_data['gg_font']) {
add_action( 'wp_enqueue_scripts', 'concept7_google_fonts' );
}

if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}
/*
define('WOOCOMMERCE_USE_CSS', false);

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'overriding_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60 );

function overriding_template_loop_product_thumbnail(){
	global $post;
	global $concept7_data;
	if ( has_post_thumbnail() ){
		if($concept7_data['port_resize']){
			$wr = $concept7_data['resize_option_1']; $hr = $concept7_data['resize_option_2'];
		}else{
			$wr = 460; $hr = 340;
		}
		$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
		echo '<span class="da-t"><img src="'.aq_resize($thumbnail, $wr, $hr, true).'" alt="'.get_the_title().'"/><div class="hover-dir"><a class="btn white_bg no_colored_color" href="'.$thumbnail.'" rel="prettyPhoto">'.__('Quick View','concept7').'</a></div></span>';
	}
}
*/
// activate post-image function
if ( function_exists( 'add_theme_support' ) ){
	
	add_theme_support( 'post-thumbnails' ); // This feature enables post-thumbnail support for a theme
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-header' );
	$defaults = array(
		'default-color'          => '',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', $defaults );
}

add_filter('get_search_form', 'new_search_button');
function new_search_button($text) {
$text = str_replace('value=""', 'value="Search ..."', $text);
return $text;
}

if ( ! isset( $content_width ) ) $content_width = 960;

function custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = $term->name;
			$return = join( ' ', $out );
		}
		return $return;
	}
}

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
	  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
	  $r = hexdec(substr($hex,0,2));
	  $g = hexdec(substr($hex,2,2));
	  $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}

function wt_get_category_count($input = '') {
	global $wpdb;
	if($input == ''){
		$category = get_the_category();
		return $category[0]->category_count;
	}
	elseif(is_numeric($input)){
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
		return $wpdb->get_var($SQL);
	}
	else{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
		return $wpdb->get_var($SQL);
	}
}

add_theme_support( 'post-formats', array( 'link', 'quote', 'status', 'gallery', 'video' ) );

//using Shortcode in Text Widget
add_filter('widget_text', 'do_shortcode');

//limited the title
function the_titlesmall($before = '', $after = '', $echo = true, $length = false) { $title = get_the_title();

	if ( $length && is_numeric($length) ) {
		$title = substr( $title, 0, $length );
	}

	if ( strlen($title)> 0 ) {
		$title = apply_filters('the_titlesmall', $before . $title . $after, $before, $after);
		if ( $echo )
			echo $title;
		else
			return $title;
	}
}

// get permalink by title
function get_permalink_by_name($page_name) {
        global $post;
        global $wpdb;
        $pageid_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $page_name . "' LIMIT 0, 1");
        return get_permalink($pageid_name);
}


// replace general excerpt length
function thefirst_new_excerpt_more($more) {
       global $post;
	return '...';
}
add_filter('excerpt_more', 'thefirst_new_excerpt_more');

function the_breadcrumb() {
	global $post;
	//if(is_woocommerce()){
	//	woocommerce_breadcrumb();
	//}else{
		echo '<ul class="breadcrumb">';
	if (!is_home()) {
		echo '<li><i class="icon-sitemap"></i><a class="underline-hover" href="';
		echo home_url();
		echo '">';
		echo 'Home';
		echo "</a><span class=\"divider\">/</span></li>";
		if (is_category() || is_singular('post')) {
			echo '<li>';
			the_category(' <span class="divider">/</span></li><li> ');
			if (is_single()) {
				echo "<span class=\"divider\">/</span></li><li>";
				the_title();
				echo '</li>';
			}
		}elseif(is_singular('portfolio')){
			echo '<li>';
			the_terms($post -> ID, 'portfolio_cats', '',' <span class="divider">/</span></li><li> ');
			echo "<span class=\"divider\">/</span></li><li>";
			the_title();
			echo '</li>';
		}elseif (is_page()) {
			echo '<li>';
			if(!empty( $post->post_parent )){
				echo '<a class="underline-hover" href="'.get_permalink( $post->post_parent ).'">'.get_the_title( $post->post_parent ).'</a>';
				echo "<span class=\"divider\">/</span></li><li>";
			}
			echo the_title();
			echo '</li>';
		}
	}
	elseif (is_tag()) {single_tag_title();}
	elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
	elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	echo '</ul>';
	//}
}

// register navigation menus
register_nav_menus(
	array(
	'main nav'=>__('Main Nav'),
	)
);
register_nav_menus(
	array(
	'footer nav'=>__('Footer Nav'),
	)
);

class top_bar_walker extends Walker_Nav_Menu {
 
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $element->has_children = !empty($children_elements[$element->ID]);
        $element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active' : '';
        $element->classes[] = ($element->has_children) ? 'has-dropdown' : '';
		
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);	
        $classes = empty($item->classes) ? array() : (array) $item->classes;	
		$output .= ($depth == 0) ? '<li class="divider"></li>' : '';
        if(in_array('section', $classes)) {
            //$output .= '<li class="divider"></li>';
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html);
        }
		
        $output .= $item_html;
    }
	
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"sub-menu dropdown\">\n";
    }
    
} // end top bar walker

add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'main nav' )
        return $items."<li class='custom-search custom-search-gradient menu-item'><a href=\"javascript:void(0)\"><i class=\"icon-search\"></i>".__('Search', 'concept7')."</a><div class=\"menu-search-form\"><form style=\"overflow:hidden;text-align:center;\" method=\"get\" id=\"searchbar\" action=" .home_url()."/ >
                <input type=\"text\" class=\"menu-search-form-input\" name=\"s\" id=\"search\" value=\"Type and hit enter ...\"/>
                </form></div></li>";

    return $items;
}

// register sidebars
global $concept7_data;
$sidebars = $concept7_data['sidebar_options']; 
if($sidebars){
	foreach ($sidebars as $sidebar) { 
		if ( function_exists('register_sidebar') )
		register_sidebar(array(
		'name' => $sidebar['title'],
		'description' => 'Widgets in this area will be shown in the sidebar.',
		'before_widget' => '<div class="sidebar-box">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="blog-sidebar-title">',
		'after_title' => '</h4><div class="sidebar-box-content">',
		));
	}
}
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Blog Single',
'description' => 'Widgets in this area will be shown in the sidebar.',
'before_widget' => '<div class="sidebar-box">',
'after_widget' => '</div></div>',
'before_title' => '<h4 class="blog-sidebar-title">',
'after_title' => '</h4><div class="sidebar-box-content">',
));
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Portfolio Single',
'description' => 'Widgets in this area will be shown in the sidebar.',
'before_widget' => '<div class="sidebar-box">',
'after_widget' => '</div>',
'before_title' => '<h4 class="blog-sidebar-title"><span class="sidebar-title">',
'after_title' => '</span></h4><div class="blog-break"><hr /><hr /><hr /></div>',
));
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'First Footer Area',
'description' => 'Widgets in this area will be shown in the footer - left side.',
'before_widget' => '<div class="footer-box box-1">',
'after_widget' => '</div>',
'before_title' => '<h4 class="footer-heading">',
'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Second Footer Area',
'description' => 'Widgets in this area will be shown in the footer - left middle side.',
'before_widget' => '<div class="footer-box box-2">',
'after_widget' => '</div>',
'before_title' => '<h4 class="footer-heading">',
'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Third Footer Area',
'description' => 'Widgets in this area will be shown in the footer - right middle side.',
'before_widget' => '<div class="footer-box box-3">',
'after_widget' => '</div>',
'before_title' => '<h4 class="footer-heading">',
'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Fourth Footer Area',
'description' => 'Widgets in this area will be shown in the footer - right side.',
'before_widget' => '<div class="footer-box box-4">',
'after_widget' => '</div>',
'before_title' => '<h4 class="footer-heading">',
'after_title' => '</h4>',
));

add_action( 'init', 'create_post_types' );
function create_post_types() {
// Define Post Type For Services
register_post_type( 'Clients',
    array(
      'labels' => array(
        'name' => __( 'Clients', 'concept7' ),
        'singular_name' => __( 'Client', 'concept7' ),		
		'add_new' => _x( 'Add New', 'Client', 'concept7' ),
		'add_new_item' => __( 'Add New Client', 'concept7' ),
		'edit_item' => __( 'Edit Client', 'concept7' ),
		'new_item' => __( 'New Client', 'concept7' ),
		'view_item' => __( 'View Client', 'concept7' ),
		'search_items' => __( 'Search Clients', 'concept7' ),
		'not_found' =>  __( 'No Clients found', 'concept7' ),
		'not_found_in_trash' => __( 'No Clients found in Trash', 'concept7' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'exclude_from_search' => true,
	  'supports' => array('title','thumbnail'),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/clients.png',
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'clients' ),
    )
  );
  
// Define Post Type For Testimonial
register_post_type( 'Testimonial',
    array(
      'labels' => array(
        'name' => __( 'Testimonial', 'concept7' ),
        'singular_name' => __( 'Testimonial', 'concept7' ),		
		'add_new' => _x( 'Add New', 'Testimonial', 'concept7' ),
		'add_new_item' => __( 'Add New Testimonial', 'concept7' ),
		'edit_item' => __( 'Edit Testimonial', 'concept7' ),
		'new_item' => __( 'New Testimonial', 'concept7' ),
		'view_item' => __( 'View Testimonial', 'concept7' ),
		'search_items' => __( 'Search Testimonial', 'concept7' ),
		'not_found' =>  __( 'No Testimonial found', 'concept7' ),
		'not_found_in_trash' => __( 'No Testimonial found in Trash', 'concept7' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'exclude_from_search' => true,
	  'supports' => array('title','editor','thumbnail'),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/faq.png',
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'testimonial' ),
    )
  );


// Define Post Type For Portfolio
register_post_type( 'Portfolio',
    array(
      'labels' => array(
        'name' => __( 'Portfolio', 'concept7' ),
        'singular_name' => __( 'Portfolio', 'concept7' ),		
		'add_new' => _x( 'Add New', 'Portfolio Project', 'concept7' ),
		'add_new_item' => __( 'Add New Portfolio Project', 'concept7' ),
		'edit_item' => __( 'Edit Portfolio Project', 'concept7' ),
		'new_item' => __( 'New Portfolio Project', 'concept7' ),
		'view_item' => __( 'View Portfolio Project', 'concept7' ),
		'search_items' => __( 'Search Portfolio Projects', 'concept7' ),
		'not_found' =>  __( 'No Portfolio Projects found', 'concept7' ),
		'not_found_in_trash' => __( 'No Portfolio Projects found in Trash', 'concept7' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'supports' => array('title','editor','thumbnail', 'comments' ),
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/portfolio.png',
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'portfolio' ),
    )
  );
}

//Create project taxonomies
add_action( 'init', 'create_taxonomies' );
function create_taxonomies() {
	$cat_labels = array(
		'name' => __( 'Categories', 'concept7' ),
		'singular_name' => __( 'Category', 'concept7' ),
		'search_items' =>  __( 'Search Categories' , 'concept7'),
		'all_items' => __( 'All Categories', 'concept7' ),
		'parent_item' => __( 'Parent Category', 'concept7' ),
		'parent_item_colon' => __( 'Parent Category:', 'concept7' ),
		'edit_item' => __( 'Edit Category', 'concept7' ),
		'update_item' => __( 'Update Category', 'concept7' ),
		'add_new_item' => __( 'Add New Category', 'concept7' ),
		'new_item_name' => __( 'New Category Name', 'concept7' ),
		'choose_from_most_used'	=> __( 'Choose from the most used categories', 'concept7' )
	); 	

	register_taxonomy('portfolio_cats','portfolio',array(
		'hierarchical' => true,
		'labels' => $cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' ),
	));	
		
	$tag_labels = array(
		'name' => __( 'Tags', 'concept7' ),
		'singular_name' => __( 'Tag' , 'concept7'),
		'search_items' =>  __( 'Search Tags', 'concept7' ),
		'all_items' => __( 'All Tags' , 'concept7'),
		'parent_item' => __( 'Parent Tag', 'concept7' ),
		'parent_item_colon' => __( 'Parent Tag:', 'concept7' ),
		'edit_item' => __( 'Edit Tag', 'concept7' ),
		'update_item' => __( 'Update Tag' , 'concept7'),
		'add_new_item' => __( 'Add New Tag', 'concept7' ),
		'new_item_name' => __( 'New Tag Name' , 'concept7')
	); 	

	register_taxonomy('portfolio_tags','portfolio',array(
		'hierarchical' => false,
		'labels' => $tag_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-tag' ),
	));
	
}

//add_post_type_support( 'portfolio', 'post-formats' );
// functions run on activation --> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	$wp_rewrite->flush_rules();
}
?>
<?php function concept7_echo_scripts(){ ?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {

// Media Uploader
window.formfield = '';

jQuery('.upload_image_button').live('click', function() {
window.formfield = jQuery('.upload_field',jQuery(this).parent());
tb_show('', 'media-upload.php?type=image&TB_iframe=true');
return false;
});

window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html) {
if (window.formfield) {
imgurl = jQuery('img',html).attr('src');
window.formfield.val(imgurl);
tb_remove();
}
else {
window.original_send_to_editor(html);
}
window.formfield = '';
window.imagefield = false;
}

});
//]]> 
</script>
<?php }?>
<?php function admin_scripts()
{
   wp_enqueue_script('media-upload');
   wp_enqueue_script('thickbox');
}

function admin_styles()
{
   wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'admin_scripts');
add_action('admin_print_styles', 'admin_styles');
add_action('admin_head', 'concept7_echo_scripts'); 
?>