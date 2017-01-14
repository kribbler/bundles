<?php
add_theme_support( 'post-thumbnails' );

/*
 * Login Screen Modifications
 */
function dd_login_logo() {
    $logo_relative_path = "/wp-content/themes/template/images/logo.png";
    $logo_path = ABSPATH.$logo_relative_path;
    $logo_url = get_bloginfo('wpurl').$logo_relative_path;
    $logo_info = getimagesize($logo_path);
    $width = $logo_info[0];
    $height = $logo_info[1];
    if ($width>320){
        $ratio = $width/$height;
        $width = 320;
        $height = round($width/$ratio);
    }
    
    echo "<style type=\"text/css\">
        .login h1 a {
            background-image:url(".$logo_url.") !important;
            width:{$width}px;
            height:{$height}px;
            background-size: {$width}px {$height}px !important;
        }
    </style>";
}

add_action('login_head', 'dd_login_logo');

function dd_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'dd_login_logo_url' );

function dd_login_logo_url_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'dd_login_logo_url_title' );

function etheme_enqueue_styles() {
	wp_enqueue_style("responsive",get_template_directory_uri().'/responsive.css', array());
	//wp_enqueue_script('etheme', get_template_directory_uri().'/js/etheme.js',array(),false,true);
	//wp_enqueue_script('less', get_template_directory_uri().'/js/less-1.4.1.min.js',array(),false,true);	
	//echo "<link href='".get_template_directory_uri().'/style.less'."' rel='stylesheet/less' type='text/css'/>";
}
add_action( 'wp_enqueue_scripts', 'etheme_enqueue_styles', 30);

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'menus', true );
}


/*****************
 *	ACTIONS
 *****************/
 
add_action( 'init', 'dd_register_my_menus' );
 
 # Action : init
function dd_register_my_menus() {
	register_nav_menus(
		array(
			'main' => __( 'Main Menu Navigation' ),
			'footer_menu' => __('Footer Menu'),
			'footer_links' => __('Footer Links')
		)
	);
}


// Enqueue Scripts
function dd_enqueue_scripts() {
	 wp_enqueue_script('jquery');
}

add_action( 'wp_enqueue_scripts', 'dd_enqueue_scripts' );	 

class Et_Navigation extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $display_depth = ($depth + 1); 
        if($display_depth == '1') {
            $class_names = 'nav-sublist-dropdown';
            $container = 'container';
        } else {
            $class_names = 'nav-sublist';
            $container = '';
        }

        $indent = str_repeat("\t", $depth);

         $output .= "\n$indent<ul class=".$class_names.">\n";
    }

    function end_lvl( &$output, $depth = 1, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . apply_filters('custom_menu_link', esc_attr( $item->url )) .'"' : '';

        $description = '';
        if(strpos($class_names,'image-item') !== false){$description = '<img src="'.do_shortcode($item->description).'" alt=" "/>';}

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= $description;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    } 


}