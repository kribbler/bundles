<?php

/* Disable woocommerce default css */
define( WOOCOMMERCE_USE_CSS, false );

/* Image sizes Woocommerce */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'anps_woocommerce_image_dimensions', 1 );
 
function anps_woocommerce_image_dimensions() {
    $catalog = array(
    'width' => '220',
    'height'    => '164',
    'crop'    => 0
    );

    $single = array(
    'width' => '450',
    'height'    => '338',
    'crop'    => 0
    );

    $thumbnail = array(
    'width' => '138',
    'height'    => '103',
    'crop'    => 0
    );
 
    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
    update_option( 'shop_single_image_size', $single ); // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
}

//Support for WooCommerce
add_theme_support("woocommerce");

if (!isset($content_width))
    $content_width = 967;

add_action('after_setup_theme', 'theme_setup');
add_filter('widget_text', 'do_shortcode');

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (!function_exists('theme_setup')):

    function theme_setup() {

        add_editor_style();
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        load_theme_textdomain('shopifiq', get_template_directory() . '/languages');

        $locale = get_locale();
        $locale_file = get_template_directory() . "/languages/$locale.php";
        if (is_readable($locale_file))
            require_once( $locale_file );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Navigation', 'blocked'),
        ));

        define('HEADER_TEXTCOLOR', '');
        define('HEADER_IMAGE', '%s/images/headers/path.jpg');
        define('HEADER_IMAGE_WIDTH', apply_filters('blocked_header_image_width', 190));
        define('HEADER_IMAGE_HEIGHT', apply_filters('blocked_header_image_height', 54));
        set_post_thumbnail_size(HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true);
        define('NO_HEADER_TEXT', true);

        register_default_headers(array(
            'berries' => array(
                'url' => '%s/images/headers/logo.png',
                'thumbnail_url' => '%s/images/testing-files/logo.png',
                'description' => __('Theme default logo', 'shopifiq')
            )
        ));


        global $wpdb;
        global $jal_db_version;

        $table_widget = $wpdb->prefix . "widget_layout";
        $table_contact = $wpdb->prefix . "contact";
        $table_account = $wpdb->prefix . "envoo_account";
        $table_media = $wpdb->prefix . "envoo_media";
        $table_pages = $wpdb->prefix . "envoo_pages";


        $sql2 = "CREATE TABLE IF NOT EXISTS $table_widget (
                 id INT NOT NULL PRIMARY KEY,
                 layout varchar (20)
                );";

        $sql3 = "CREATE TABLE IF NOT EXISTS $table_contact (
                id INT NOT NULL AUTO_INCREMENT,
                label varchar(200),
                form_type varchar(40),
                required char(2),
                placeholder varchar(100),
                validation varchar(50),
                PRIMARY KEY id (id));";

        $sql4 = "CREATE TABLE IF NOT EXISTS $table_account (
                id INT NOT NULL AUTO_INCREMENT,
                responsive varchar(10) NOT NULL DEFAULT '-1',
                responsive_demand varchar(10) NOT NULL DEFAULT '-1',
                email varchar(150),
                google_analytics varchar(150),
                facebook varchar(150),
                google varchar(150),
                twitter varchar(150),
                linkedin varchar(150),
                vimeo varchar(150),
                youtube varchar(150),
                flickr varchar(150),
                copyright text,
                copyright_on varchar(10),
                top_menu varchar(20),
                top_menu_label varchar(255),
                top_menu_input varchar(255),
                boxed varchar(10) NOT NULL DEFAULT '-1',
                pattern varchar(10) NOT NULL DEFAULT '1',
                custom_pattern varchar(255),
                type varchar(10),
                dummy tinyint(1) NOT NULL DEFAULT 0,
                PRIMARY KEY id (id));";

        $sql5 = "CREATE TABLE IF NOT EXISTS $table_media (
                id INT NOT NULL AUTO_INCREMENT,
                type varchar(50),
                url varchar(150),
                PRIMARY KEY id (id));";

        $sql6 = "CREATE TABLE IF NOT EXISTS $table_pages (
                id INT NOT NULL AUTO_INCREMENT,
                type varchar(50),
                details varchar(255),
                PRIMARY KEY id (id));";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        if (is_admin() && isset($_GET["activated"])) {
            dbDelta($sql2);
            dbDelta($sql3);
            dbDelta($sql4);
            dbDelta($sql5);
            dbDelta($sql6);

            add_option("jal_db_version", $jal_db_version);            
        }


        if (!isset($_GET['stylesheet']))
            $_GET['stylesheet'] = '';

        $theme = wp_get_theme($_GET['stylesheet']);

        if (!isset($_GET['activated']))
            $_GET['activated'] = '';

        if ($_GET['activated'] == 'true' && $theme->get_template() == 'shopifiq') {
            
            $wpdb->query("INSERT INTO " . $wpdb->prefix . "contact (id, label, form_type, required, placeholder, validation) VALUES (1, 'e-mail', 'text', 'on', 'e-mail', 'email') ON DUPLICATE KEY UPDATE label = 'e-mail';");
            $wpdb->query("INSERT INTO " . $wpdb->prefix . "contact (id, label, form_type, required, placeholder, validation) VALUES (2, 'subject', 'text', 'on', 'subject', 'none') ON DUPLICATE KEY UPDATE label = 'subject';");
            $wpdb->query("INSERT INTO " . $wpdb->prefix . "contact (id, label, form_type, required, placeholder, validation) VALUES (3, 'contact number', 'text', '', 'contact  number', 'phone') ON DUPLICATE KEY UPDATE label = 'contact number';");
            $wpdb->query("INSERT INTO " . $wpdb->prefix . "contact (id, label, form_type, required, placeholder, validation) VALUES (4, 'lorem ipsum', 'text', '', 'lorem ipsum', 'none') ON DUPLICATE KEY UPDATE label = 'lorem ipsum';");
            $wpdb->query("INSERT INTO " . $wpdb->prefix . "contact (id, label, form_type, required, placeholder, validation) VALUES (5, 'message', 'textarea', 'on', 'message', 'none') ON DUPLICATE KEY UPDATE label = 'message';");

        }
    }

endif;

add_action('switch_theme', 'on_switch_theme_function');
add_action('admin_init', 'theme_options_init');
add_action('admin_menu', 'theme_options_add_page');

function theme_options_init() {
    register_setting('sample_options', 'sample_theme_options');
}

function theme_options_add_page() {
	global $current_user; 
    if($current_user->user_level==10) {
    	add_theme_page('Theme options', 'Theme options', 'read', 'theme_options', 'theme_options_do_page');
    }
}

add_action('admin_head', 'show_hidden_customfields');

function show_hidden_customfields() {
    echo "<input type='hidden' value='" . get_template_directory_uri() . "' id='hidden_url'/>";
}

function theme_options_do_page() { 

    wp_enqueue_style( "admin_style", get_template_directory_uri() . '/admin-functions/admin-style.css' );
    wp_enqueue_style( "colorpicker_css", get_template_directory_uri() . '/css/colorpicker.css' );

    ?>
    <div class="envoo-admin">
        <ul class="envoo-admin-menu">
            <li><h2>Theme Options</h2></li>
            <li><a <?php if (!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style") {
        echo 'id="selected-menu-item"';
    } ?> href="themes.php?page=theme_options&sub_page=theme_style">Theme style</a></li>
            <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options") {
        echo 'id="selected-menu-item"';
    } ?> href="themes.php?page=theme_options&sub_page=options">Theme options</a></li>
            <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "contact_form") {
        echo 'id="selected-menu-item"';
    } ?> href="themes.php?page=theme_options&sub_page=contact_form">Contact form</a></li>
            <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "dummy_content") {
        echo 'id="selected-menu-item"';
    } ?> href="themes.php?page=theme_options&sub_page=dummy_content">Dummy content</a></li>
        </ul>
        <div class="envoo-admin-content">
            <?php
            include_once 'admin-functions/adminThemeOptions.php';

            $contact = new adminThemeOptions();

            if (!isset($_GET['sub_page']))
                echo $contact->style() . "<br>";

            else if ($_GET['sub_page'] == "options") {
                echo $contact->info() . "<br>";
            } else if ($_GET['sub_page'] == "contact_form") {
                echo $contact->contact() . "<br>";
            } else if ($_GET['sub_page'] == "dummy_content") {
                echo $contact->dummy() . "<br>";
            } else {
                echo $contact->style() . "<br>";
            }
            ?>
        </div></div> 
    <?php
}

/* Widgets */
include_once 'admin-functions/widgets.php';

/* Shortcodes */
include_once 'admin-functions/shortcodes.php';


if (is_admin()) {
    include_once 'shortcodes/shortcodes_init.php';
}

function on_switch_theme_function() {
}

if (!function_exists('blocked_admin_header_style')) :

    function blocked_admin_header_style() {
        ?>
        <style type="text/css">
            /* Shows the same border as on front end */
            #headimg {
                border-bottom: 1px solid #000;
                border-top: 4px solid #000;
            }
        </style>
        <?php
    }

endif;

function blocked_filter_wp_title($title, $separator) {
    if (is_feed())
        return $title;

    global $paged, $page;

    if (is_search()) {

        $title = sprintf(__('Search results for %s', 'shopifiq'), '"' . get_search_query() . '"');

        if ($paged >= 2)
            $title .= " $separator " . sprintf(__('Page %s', 'shopifiq'), $paged);

        $title .= " $separator " . get_bloginfo('name', 'display');

        return $title;
    }

    $title .= get_bloginfo('name', 'display');

    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title .= " $separator " . $site_description;

    if ($paged >= 2 || $page >= 2)
        $title .= " $separator " . sprintf(__('Page %s', 'shopifiq'), max($paged, $page));

    return $title;
}

add_filter('wp_title', 'blocked_filter_wp_title', 10, 2);

function blocked_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'blocked_page_menu_args');

function blocked_excerpt_length($length) {
    return 40;
}

add_filter('excerpt_length', 'blocked_excerpt_length');

function blocked_continue_reading_link() {
    return ' <a href="' . get_permalink() . '">' . __('Continue reading <span class="meta-nav">&rarr;</span>', 'blocked') . '</a>';
}

function blocked_auto_excerpt_more($more) {
    return ' &hellip;' . blocked_continue_reading_link();
}

add_filter('excerpt_more', 'blocked_auto_excerpt_more');

function blocked_custom_excerpt_more($output) {
    if (has_excerpt() && !is_attachment()) {
        $output .= blocked_continue_reading_link();
    }
    return $output;
}

add_filter('get_the_excerpt', 'blocked_custom_excerpt_more');

function blocked_remove_gallery_css($css) {
    return preg_replace("#<style type='text/css'>(.*?)</style>#s", '', $css);
}

add_filter('gallery_style', 'blocked_remove_gallery_css');

function blocked_widgets_init() {
    // Area 1, located at the top of the sidebar.
    register_sidebar(array(
        'name' => __('Sidebar', 'cooblue'),
        'id' => 'primary-widget-area',
        'description' => __('The primary widget area', 'blocked'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Secondary Sidebar', 'shopifiq'),
        'id' => 'secondary-widget-area',
        'description' => __('Secondary widget area', 'blocked'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Filter (only WooCommerce Price Filter)', 'cooblue'),
        'id' => 'filter-widget-area',
        'description' => __('Filter widget area', 'cooblue'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 style="display: none" class="widget-title">',
        'after_title' => '</h3>',
    ));

    // Area 3, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('First Footer Column', 'shopifiq'),
        'id' => 'first-footer-widget-area',
        'description' => __('The first footer widget area', 'blocked'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    // Area 4, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Second Footer Column', 'shopifiq'),
        'id' => 'second-footer-widget-area',
        'description' => __('The second footer widget area', 'blocked'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    // Area 5, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Third Footer Column', 'shopifiq'),
        'id' => 'third-footer-widget-area',
        'description' => __('The third footer widget area', 'blocked'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    // Area 6, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Fourth Footer Column', 'shopifiq'),
        'id' => 'fourth-footer-widget-area',
        'description' => __('The fourth footer widget area', 'blocked'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'blocked_widgets_init');


function blocked_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

add_action('widgets_init', 'blocked_remove_recent_comments_style');


if (!function_exists('blocked_posted_on')) :

    function blocked_posted_on() {
        printf(__('<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'shopifiq'), 'meta-prep meta-prep-author', sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>', get_permalink(), esc_attr(get_the_time()), get_the_date()
                ), sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>', get_author_posts_url(get_the_author_meta('ID')), sprintf(esc_attr__('View all posts by %s', 'shopifiq'), get_the_author()), get_the_author()
                )
        );
    }

endif;

if (!function_exists('blocked_posted_in')) :

    function blocked_posted_in() {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list('', ', ');
        if ($tag_list) {
            $posted_in = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'shopifiq');
        } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
            $posted_in = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'shopifiq');
        } else {
            $posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'shopifiq');
        }
        // Prints the string, replacing the placeholders.
        printf(
                $posted_in, get_the_category_list(', '), $tag_list, get_permalink(), the_title_attribute('echo=0')
        );
    }

endif;

/* Image sizes */
add_theme_support('post-thumbnails');
update_option('thumbnail_size_w', 275);
update_option('thumbnail_size_h', 135);

add_image_size('small-thumbnail', 48, 48, true);
add_image_size('blog-one-sidebar', 671, 337, true);
add_image_size('blog-no-sidebar', 495, 337, true);
add_image_size('blog-two-column', 450, 337, true);

add_image_size('portfolio', 649, 0, true);
add_image_size('portfolio-thumbnail', 117, 117, true);
add_image_size('portfolio-thumbnail-3-column', 300, 220, true);
add_image_size('portfolio-thumbnail-2-column', 460, 320, true);
add_image_size('portfolio-thumbnail-4-column', 220, 164, true);
add_image_size('portfolio-first-responsive', 290, 200, true);

add_filter('avatar_defaults', 'newgravatar');

function newgravatar($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/images/blocked_default_avatar.jpg';
    $avatar_defaults[$myavatar] = "Blocked default avatar";
    return $avatar_defaults;
}

function curPageURL() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"])) {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function the_breadcrumb() {


    if (!is_front_page()) {

        echo '<a href="';
        echo home_url();
        echo '">';
        echo __("Home", "shopifiq");

        $img_url = '/images/arrow_right.png';

        if ( get_option('rtl', '') && get_option('rtl', '') == "on" ) {
            $img_url = '/images/rtl/arrow_right.png';
        }

        echo "</a> > ";
 
        /* Parents */
        global $post;
        $page_id = $post->ID;
        $page_breadcrumbs = get_page( $page_id );
        $parent_id  = $page_breadcrumbs->post_parent;
        if( $parent_id ) {
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . "</a> > ";
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
        }
        
        if ( is_plugin_active('woocommerce/woocommerce.php') && is_cart() ) {
            echo '<a href="' . get_permalink( woocommerce_get_page_id( 'shop' )) . '">' . get_the_title(get_option('woocommerce_shop_page_id') ) . '</a>';
            echo " > ";
        }

        if ( is_plugin_active('woocommerce/woocommerce.php') && is_checkout() ) {
            echo '<a href="' . get_permalink( woocommerce_get_page_id( 'shop' )) . '">' . get_the_title(get_option('woocommerce_shop_page_id') ) . '</a>';
            echo " > ";
            echo '<a href="' . get_permalink( woocommerce_get_page_id( 'cart' )) . '">' . __("Cart", "shopifiq") . '</a>';
            echo " > ";
        }

        if (get_post_type() == "portfolio") {

            global $wpdb;
            $data = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "envoo_pages WHERE type=\"portfolio\"");
            $ex = explode(";", $data[0] -> details);
            $parent = get_page($ex[0]);
            if ( $parent ) {
                echo '<a href="' . get_permalink($parent->ID) . '">' . $parent->post_title . '</a>';
            }
            
        }

        if (is_home() && !is_front_page()) {
            echo get_the_title(get_option('page_for_posts'));
        } else {
            if (is_category() || is_single()) {
                //the_category('title_li=');
                if (is_single()) {
                    global $post;
                    
                    if ( $terms = wp_get_object_terms( $post->ID, 'product_cat' ) ) {
                        $term = current( $terms );
                        $parents = array();
                        $parent = $term->parent;
                        
                        while ( $parent ) {
                            $parents[] = $parent;
                            $new_parent = get_term_by( 'id', $parent, 'product_cat' );
                            $parent = $new_parent->parent;
                        }
                        
                        echo '<a href="' . get_permalink( woocommerce_get_page_id( 'shop' )) . '">' . get_the_title(get_option('woocommerce_shop_page_id') ) . '</a>';
            
                        if ( ! empty( $parents ) ) {
                            $parents = array_reverse($parents);
                            foreach ( $parents as $parent ) {
                                $item = get_term_by( 'id', $parent, 'product_cat');
                                echo " > ";
                                echo $before . '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>' . $after . $delimiter;
                            }
                        }

                        echo " > ";
                        echo $before . '<a href="' . get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a>' . $after . $delimiter;
                    
                    }
                    elseif (get_post_type() != "portfolio") {
                        global $post;
                        if ( isset($post) && get_post_type( $post ) == "product") {
                            echo '<a href="' . get_permalink( woocommerce_get_page_id( 'shop' )) . '">' . get_the_title(get_option('woocommerce_shop_page_id') ) . '</a>';
                        } else {
                            echo '<a href="' . get_permalink(get_option('page_for_posts')) . '">' . get_the_title(get_option('page_for_posts')) . '</a>';                            
                        }
                    }

                    echo " > ";


                    the_title();
                }
            } elseif (is_page()) {
                echo get_the_title();
            } elseif ( is_archive() ) {
                if ( single_tag_title( '', false) != "" ) {
                } else {
                    if (is_shop())
                        echo get_the_title(get_option('woocommerce_shop_page_id') );
                    else
                        echo "Archives for " . get_the_date('F') . ' ' . get_the_date('Y');
                }
            } else {
                if (get_search_query() != "") {
                    printf(__('Search Results for: %s', 'shopifiq'), '' . get_search_query() . '');
                } else {
					global $wpdb;
			        $data = $wpdb->get_results("SELECT details FROM " . $wpdb->prefix . "envoo_pages WHERE type='error'");
			
			    	$page = get_page( $data[0]->details );
                    echo $page->post_title;
                }
            }
        }

        if (single_cat_title("", false) != "") {
            if ( is_tax( 'product_cat' ) ) {

                echo '<a href="' . get_permalink( woocommerce_get_page_id( 'shop' )) . '">' . __("Shop", "shopifiq") . '</a>';
                echo " > ";
            
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                $parents = array();
                $parent = $term->parent;
                while ( $parent ) {
                    $parents[] = $parent;
                    $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
                    $parent = $new_parent->parent;
                }

                if ( ! empty( $parents ) ) {
                    $parents = array_reverse( $parents );
                    foreach ( $parents as $parent ) {
                        $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                        echo $before .  '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>' . $after . $delimiter;
                    }
                    echo "<img alt='Breadcrumbs arrow' src='" . get_template_directory_uri() . $img_url ."' class='breadcrumbs-arrow' />";
                }

            }
            echo single_cat_title("", false);
        }
    }
}

/* Portfolio */

include_once 'admin-functions/portfolio.php';
add_action('init', 'portfolio');

function portfolio() {
    new Portfolio();
}

/* Testimonial */

include_once 'admin-functions/testimonial.php';
add_action('init', 'testimonial');

function testimonial() {
    new Testimonial();
}

/* FAQ */

include_once 'admin-functions/faq.php';
add_action('init', 'faq');

function faq() {
    new Faq();
}

function tagsAndAuthor() {
    ?>

    <div class="tags-author">
        <?php echo __('Posted by', 'shopifiq'); ?> <strong><?php echo get_the_author(); ?></strong> 

    <?php
    $posttags = get_the_tags();
    if ($posttags) {

        echo "/ ";
		echo __('Taged as', 'shopifiq') . " ";
        $first_tag = true;
        echo '<strong>';

        foreach ($posttags as $tag) {
            echo  '<a href="' . esc_url( home_url( '/' )) . 'tag/' . $tag->name . '/">';
            if ($first_tag) {
                echo $tag->name;
                $first_tag = false;
            } else {
                echo ', ' . $tag->name;
            }
            echo '</a>';
        }

        echo '</strong>';
    }
    ?>
    </div>
        <?php
    }

//get post_type    
function get_current_post_type() {
    if(is_admin()) {
        global $post, $typenow, $current_screen;

        if ( $post && $post->post_type )
            return $post->post_type;

        elseif( $typenow )
            return $typenow;

        elseif( $current_screen && $current_screen->post_type )
            return $current_screen->post_type;

        elseif( isset( $_REQUEST['post_type'] ) )
            return sanitize_key( $_REQUEST['post_type'] );

        elseif(isset($_REQUEST['post']))
            return get_post_type($_REQUEST['post']);

        return null;
    }
}   


if(get_current_post_type()!='testimonials' && get_current_post_type()!='portfolio' && get_current_post_type()!='faq') {
    include_once 'admin-functions/sidebar_generator.php';
}
    
include_once 'admin-functions/install_plugins.php';


function get_the_post_thumbnail_src($img) {

    return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';

}   

/* GOOGLE FONTS */ 
add_action('admin_init', 'fonts_options_init');

function fonts_options_init() {
    register_setting('google_fonts', 'google_fonts_options');
}


/* Admin/backend styles */

function backend_styles() {
	 echo '<style type="text/css">
	 	.mceListBoxMenu {
    		height: auto !important;
		}

		.wp_themeSkin .mceListBoxMenu {
    		overflow: visible;
    		overflow-x: visible;
		}
	</style>';
}

add_action('admin_head', 'backend_styles');

add_editor_style('css/editor.css');
add_editor_style('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700,300&subset=latin,latin-ext');








function theme_styles()  
{	   

  global $wpdb;
 
 
  /* Load media-queries.css if responsive is on */
  $data = $wpdb->get_results("SELECT responsive FROM " . $wpdb->prefix . "envoo_account");
  $responsive = "";
  
  if (isset($data[0])) {
    $responsive = $data[0]->responsive;     
  }

  if ( ($responsive == "on" && !isset($_COOKIE['responsive_on_demand'])) || ($responsive == "on" && $_COOKIE['responsive_on_demand']!= 'on' )){
    
    if ( ! get_option('rtl', '') || get_option('rtl', '') != "on" ) {
        wp_register_style( 'media-queries', get_template_directory_uri() . '/css/media-queries.css' );
        wp_enqueue_style( 'media-queries', 1 );        
    }

  }


}


function body_class_and_style($class_or_style) {
	
    global $wpdb;

    $number_of_fields = 0;
	$data_boxed = $wpdb->get_results("SELECT boxed, pattern,custom_pattern,type  FROM " . $wpdb->prefix . "envoo_account"); 
	$body_class = "";
	$body_set_class = "";
	$body_style = "";

	if ( isset($data_boxed[0]) && $data_boxed[0]->boxed == 'on' ) {
		$body_class = "boxed";
	}


	if ( isset($data_boxed[0]->boxed) && $data_boxed[0]->boxed == 'on' ) {
		 $body_set_class .= "body-boxed"; 
	}

	if ( isset($data_boxed[0]->boxed) && $data_boxed[0]->boxed == 'on' ) {
		 if ( $data_boxed[0]->pattern != 0 ) {
		 	 $body_set_class .= " patern-" . $data_boxed[0]->pattern; 
		 } else {
			if ( $data_boxed[0]->type == "stretched" ) {
				$body_style = ' style="background: url(' . $data_boxed[0]->custom_pattern. ') center center fixed;background-size: cover; 	-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"';
			} else {
				$body_style = ' style="background: url(' . $data_boxed[0]->custom_pattern. ')"';
			}
	
		 }
	}
	if ( $class_or_style == "style" ) {
		return $body_style;
	} else {
		return $body_set_class;
	}
}


function get_top_menu() {

	global $wpdb;
	
	$data = $wpdb->get_results("SELECT top_menu FROM " . $wpdb->prefix . "envoo_account");
	
	$top_menu = "";
	  
	if ( isset($data[0]) ) {
	  	$top_menu = $data[0]->top_menu; 	
	}		  
	if ( $top_menu != "off" ) {
		get_template_part("includes/top_menu");
	}
	
}


function get_logo() {
	
      global $wpdb;

      $media_data = $wpdb->get_results("SELECT type, url FROM " . $wpdb->prefix . "envoo_media");

      if ( $media_data && $media_data[1]->url ) : ?>
		<a id="logo" href="<?php echo esc_url( home_url( "/" ) ); ?>"><img alt="Site logo"  src="<?php echo  $media_data[1]->url; ?>"></a>
      <?php else: ?>
        <a id="logo" href="<?php echo esc_url( home_url( "/" ) ); ?>"><img alt="Site logo"  src= "<?php echo get_template_directory_uri(); ?> /images/testing-files/logo.png"></a>
      <?php endif;
	  
}



function get_wooHeader() { ?>
    
    <?php if (is_plugin_active('woocommerce/woocommerce.php')): ?>

        <?php if ( is_user_logged_in() ): ?>

            <?php
                $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
                if ( $myaccount_page_id ) {
                  $logout_url = wp_logout_url( get_permalink( $myaccount_page_id ) );
                  if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' )
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                  ?>
                    <a class="loginr login-register right" href="<?php echo $logout_url; ?>"><?php _e("Logout", "shopifiq"); ?></a><span class="loginr login-register-left right">|</span>
                  <?php
                }
            ?>

            <a class="loginricon loginr login-register-left right" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My account','woothemes'); ?>">
                <?php _e("My account", "shopifiq"); ?>
            </a>

        <?php else: ?>
            <a class="loginricon loginr login-register right" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>">
                <?php _e("Login | Register", "shopifiq"); ?>
            </a>  


        <?php endif; ?>

        <div class="cart-wrapper">
            <?php 
                /* WooCommerce cart */
                $cart = woocommerce_header_add_to_cart_fragment();
                echo $cart ["a.cart-contents"];
            ?>
        </div>

        <?php get_search_form(); ?>

    <?php endif; ?>
      
<?php }




function get_mobile_menu() {

$locations = get_theme_mod('nav_menu_locations');
$menu_items = wp_get_nav_menu_items($locations['primary']);

if ( $menu_items ):?>

      <select class="mobile-menu">

          <option value="Navigation">Navigation</option><?php 
				$previuos_id = 0;

				$previuos_valid = true;
				
				foreach ( $menu_items as $item ) {
				
				echo "<option value='" . $item->url . "'>";
				
					if ( $item->menu_item_parent != 0) {
				
						if ( $previuos_id == $item->menu_item_parent ) {
				
							if( $previuos_valid ) {
				
							echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - ";
					
					$previuos_id = $item->menu_item_parent; 
                  } else {

                      echo " &nbsp;&nbsp; - ";

                                      $previuos_id = $item->ID;

                                  }

  

                              } else {

  

                                  echo " &nbsp;&nbsp;  - ";

  

                                  $previuos_id = $item->ID;

                              }

                         }

  

                         if( $item->menu_item_parent != 0) {

                              $previuos_valid = true;

                          } else {

                              $previuos_valid = false;

                          }

                          echo $item->title;

                          echo "</option>";

  

                      } ?>
      </select><?php
    endif;
}



function set_page_layout() {

      $src_tr = __("Search", "shopifiq");
      echo '<input id="src_tr" class="none" type="text" placeholder="' . $src_tr . '" value="' . $src_tr . '" />';

      echo '<input id="site_url" type="text" class="none" value="' . get_site_url() . '">';
	
      if ( ! is_front_page() && !is_product_category() ): ?>
      	
			<?php get_template_part("includes/page_titles"); ?>

	  <?php else: ?>
		  <?php if ( get_option('slider', '') ): ?>
	      	<?php echo do_shortcode( shortcode_unautop( get_option('slider', '') ) ); ?>
	      <?php endif; ?>
	  <?php endif; ?>


	  <input class="none" type="text" id="theme-path" data-placeholder="<?php echo get_template_directory_uri(); ?>" value="<?php echo get_template_directory_uri(); ?>" />
      <div class="new_wrapper">
	  <div class="main-wrapper main-content clearfix <?php if ( !is_front_page() ) { echo "innerpages"; }?> <?php if ( is_shop() ) { echo "shoppage"; }?> <?php if ( is_product_category() ) { echo "productcategory"; } ?> <?php if ( is_page() ) { echo "pagepages"; } ?>">
	      	<?php 
	      	if ( is_plugin_active('woocommerce/woocommerce.php') && (is_shop() || get_the_ID() != NULL || is_product_category() )): ?>
		      <?php if ( ! is_front_page() ): ?>
                    <?php if (get_option('breadcrumbs', '') == "on"): ?>
		      		  <div class="breadcrumbs clearfix"><?php echo the_breadcrumb(); ?></div>
                    <?php else: ?>
                        <div style="height: 25px"></div>
                    <?php endif; ?>
                    <?php if (is_product() || is_product_category() ): ?>
                        <div class="breadcrumbs clearfix"><?php echo the_breadcrumb(); ?></div>
                    <?php else: ?>
                    <?php endif; ?>
		      <?php endif; ?>
	  <?php endif; ?>
    <?php 
    if ( is_plugin_active('woocommerce/woocommerce.php') && ( is_shop()  || is_product_category() || is_product_tag() ) ) {
        add_action('woocommerce_before_main_content','woocommerce_catalog_ordering',20);
        remove_action('woocommerce_pagination','woocommerce_catalog_ordering',20);

        ?>
            <?php 
                $meta = get_post_meta( get_option('woocommerce_shop_page_id') );
                $has_sidebar = false;
            ?>
            <?php if ( (isset($meta['sbg_selected_sidebar']) && $meta['sbg_selected_sidebar'][0] != '0' && is_product_category() && get_option('cat_layout_chk', '') != "on" ) || (isset($meta['sbg_selected_sidebar']) && $meta['sbg_selected_sidebar'][0] != '0' && ! is_product_category()) || ( is_product_category() && get_option('cat_layout_chk', '') == "on" && get_option('cat_layout_left', '') ) ): $has_sidebar = 'blog-one-sidebar'; ?>
                <?php
                    global $woocommerce_loop;
                    $woocommerce_loop['columns'] = 3;
                ?>

                <?php if ( is_product_category() && get_option('cat_layout_chk', '') == "on" ): ?>
                    <aside class="sidebar sidebar-left clearfix"><?php get_sidebar( dynamic_sidebar( get_option('cat_layout_left', '') ) ); ?></aside>
                <?php else: ?>
                    <aside class="sidebar sidebar-left clearfix"><?php get_sidebar( dynamic_sidebar( $meta['sbg_selected_sidebar'][0]) ); ?></aside>
                <?php endif; ?>

                
            <?php elseif (  (isset($meta['sbg_selected_sidebar_replacement']) && $meta['sbg_selected_sidebar_replacement'][0] != '0' && is_product_category() && get_option('cat_layout_chk', '') != "on" ) || (isset($meta['sbg_selected_sidebar_replacement']) && $meta['sbg_selected_sidebar_replacement'][0] != '0' && ! is_product_category()) || ( is_product_category() && get_option('cat_layout_chk', '') == "on" && get_option('cat_layout_right', '') ) ): $has_sidebar = 'blog-one-sidebar'; ?>

                    <?php
                        global $woocommerce_loop;
                        $woocommerce_loop['columns'] = 3;
                    ?>

                    <?php if ( is_product_category() && get_option('cat_layout_chk', '') == "on"  ): ?>
                        <aside class="sidebar sidebar-right clearfix"><?php get_sidebar( dynamic_sidebar( get_option('cat_layout_right', '') ) ); ?></aside>
                    <?php else: ?>
                        <aside class="sidebar sidebar-right clearfix"><?php get_sidebar( dynamic_sidebar( $meta['sbg_selected_sidebar_replacement'][0]) ); ?></aside>
                    <?php endif; ?>

            <?php endif; ?>
            <section class="clearfix <?php if($has_sidebar){ echo $has_sidebar; } ?>">
        <?php 
    }
}




add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));
	
    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }
    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(940/$columns) : 100;

    $float = is_rtl() ? 'right' : 'left';
	$margin = 0;
    
	switch($columns) {
		case 1: $size = "full"; break;
		case 2: $size = "portfolio-thumbnail-2-column"; $itemwidth = 460; $margin = 20; break;
		case 3: $size = "portfolio-thumbnail-2-column"; $itemwidth = 300; $margin = 20; break;
		case 4: $size = "portfolio-thumbnail-3-column"; $itemwidth = 220; $margin = 20; break;
		case 5: $size = "portfolio-thumbnail-3-column"; $itemwidth = 172; $margin = 20; break;
		case 6: $size = "portfolio-thumbnail-3-column"; $itemwidth = 140; $margin = 20; break;
		case 7: $size = "portfolio-thumbnail-3-column"; $itemwidth = 117; $margin = 20; break;
		case 8: $size = "portfolio-thumbnail-3-column"; $itemwidth = 100; $margin = 20; break;
		case 9: $size = "portfolio-thumbnail-3-column"; $itemwidth = 86; $margin = 20; break;
	}

    $selector = "gallery-{$instance}";
	?>
		<!--[if IE 8]>
			<?php $size = "portfolio-thumbnail-2-column"; ?>
		<![endif]--> 
	<?php 
    $output = '';
    $output .= "

		<!--[if IE 8]>
			<style type='text/css'>
				.gallery-{$columns}-columns .gallery-item {
					width: {$itemwidth}px; 
				}
			</script>
		<![endif]-->
        <style type='text/css'>
			.gallery-{$columns}-columns .gallery-item {
				padding: 0;
				line-height: 0;
			}
            .gallery-{$columns}-columns .gallery-item {
                float: {$float};
                margin-top: 5px;
                margin-right: {$margin}px;
                text-align: center;
            }
            .gallery-{$columns}-columns .gallery-item:nth-of-type({$columns}n) {
            	margin-right: 0;
            }
            	
            .gallery-{$columns}-columns .gallery-item img {
            	width: {$itemwidth}px;  
				height: auto;   
            }
            .gallery-{$columns}-columns .gallery-caption {
                margin-left: 0;
            }
        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->
        <div id='$selector' class='gallery gallery-{$columns}-columns galleryid-{$id}'>";
 
    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
    	$link_big = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image_src($id, 'full', false) : wp_get_attachment_image_src($id, $size, false);
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image_src($id, $size, false) : wp_get_attachment_image_src($id, $size, false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                <a rel='lightbox' title='" . wptexturize($attachment->post_excerpt) . "' href='" . $link_big[0] . "'><img src='$link[0]' ></a>
            </{$icontag}>";
        $output .= "</{$itemtag}>";

    }
    $output .= "
            <br style='clear: both;' />
        </div>\n";

    return $output;
}



/* WOOCOMMERCE */

if (is_plugin_active('woocommerce/woocommerce.php')) {

    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . get_option('shop_num', '4') . ';' ), 20 );

    remove_action( 'woocommerce_before_main_content',
        'woocommerce_breadcrumb', 20, 0);

    add_action('wp', create_function("", "if (is_archive(array('product'))) remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);") );
    //Unhook (remove) the WooCommerce sidebar on individual product pages

    add_action('wp', create_function("", "if (is_singular(array('product'))) remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);") );
    //Unhook (remove) the WooCommerce sidebar on all pages

    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

    add_action('woo_nav_after', 'wootique_cart_button', 10);
        function wootique_cart_button() { 
        echo current(woocommerce_header_add_to_cart_fragment());
    }

    function woocommerce_output_related_products() {
        if ( is_product() && ((get_option('single_product_left', '') && get_option('single_product_left', '') != "") || (get_option('single_product_right', ''))) ) {
            woocommerce_related_products(6, 3); 
        } else {
            woocommerce_related_products(4, 4); 
        }
    }

    add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

    function woocommerce_header_add_to_cart_fragment() { 

    global $woocommerce;

    ob_start();

    ?>
    <?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ): ?>
        <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php _e('View Cart', 'shopifiq'); echo " (" . $woocommerce->cart->cart_contents_count . ")"; ?></a>
    <?php else: ?>
        <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php _e('View Cart', 'shopifiq'); echo " (" . $woocommerce->cart->cart_contents_count . ")"; ?></a>
    <?php endif; ?>
    <?php $woocommerce->mfunc_wrapper( 'woocommerce_mini_cart()', 'woocommerce_mini_cart', '');

    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;

    }
    if( function_exists('wp_pagenavi')) {

        //remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
        function woocommerce_pagination() {
                wp_pagenavi();         
        }
        //add_action('woocommerce_pagination', 'woocommerce_pagination', 10);
    }



    function widget($atts) {
        
        global $wp_widget_factory;
        
        extract(shortcode_atts(array(
            'widget_name' => FALSE
        ), $atts));

        $widget_name = esc_html($widget_name);
        
        if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
            $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
            
            if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
                return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct", "shopifiq"),'<strong>'.$class.'</strong>').'</p>';
            else:
                $class = $wp_class;
            endif;
        endif;

        $instance = "";
        $instance["title"] = "";
        $id = 0;

        ob_start();
        the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        ));
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
        
    }
    add_shortcode('widget','widget'); 

}

function styles_and_scripts() {

    if ( get_option('font_type_1') && get_option('font_type_1') != "Arial, Helvetica, sans-serif" ) {
        wp_enqueue_style( "font_type_1",  'http://fonts.googleapis.com/css?family=' . urlencode(get_option('font_type_1', 'Open Sans')) . ':400italic,400,600,700,300&subset=latin,latin-ext');
    }

    //wp_enqueue_style( "font_type_2",  'http://fonts.googleapis.com/css?family=' . urlencode(get_option('font_type_2', 'Open Sans')) . ':400italic,400,600,700,300&subset=latin,latin-ext');
    
    if ( ! get_option('rtl', '') || get_option('rtl', '') != "on" ) {
        wp_enqueue_style( "theme_main_style", get_bloginfo( 'stylesheet_url' ) );
        wp_enqueue_style( "custom", get_template_directory_uri() . '/custom.css' );
    }
    wp_enqueue_style( "lightbox", get_template_directory_uri() . '/css/lightbox.css' );
    theme_styles();
    
    wp_enqueue_script( "jquery", "//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" );
    wp_enqueue_script("jquery");
    wp_enqueue_script( "modernizr", get_template_directory_uri()  . "/js/modernizr.js" ); 

    //Responsive on demand
    get_template_part("includes/responsive_on_demand");
    
    //Google analytics
    get_template_part("includes/google_analytics");
    
    //Shortcut icon
    get_template_part("includes/shortcut_icon");
    
    //Custom theme styles
    //get_template_part("includes/custom-styles-min");

}
add_action('styles_and_scripts', 'styles_and_scripts', 10);


function load_admin_scripts() {
    wp_enqueue_script( "pattern-js", get_template_directory_uri() . "/admin-functions/pattern.js" , array("jquery" ), '', true);
    wp_enqueue_script( "colorpicker", get_template_directory_uri() . "/js/colorpicker.js" , array("jquery" ), '', true);
    wp_enqueue_script( "contact", get_template_directory_uri() . '/admin-functions/contact.js' , array("colorpicker" ));
}

add_action('admin_enqueue_scripts', 'load_admin_scripts');



add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

    return $content;
}


function setRTL() {

    global $wp_locale, $wp_styles;

    if( get_option('rtl', '') && get_option('rtl', '') == "on" ) {
        $direction = "rtl";
    } else {
        $direction = "ltr";
    }

    error_reporting(0);

    $wp_locale->text_direction = $direction;        
    $wp_styles->text_direction = $direction;
}

add_action('wp_loaded', 'setRTL');


function MailFunction(){
    $to = $_POST['form_data']['envoo-admin-mail'];    //your e-mail to which the message will be sent
    $from = $_POST['form_data']['envoo-admin-mail'];        //e-mail address from which the e-mail will be sent

    $subject_contact_us = 'Someone has sent you a message!';   //subject of the e-mail for the form on contact-us.html
    $subject_follow_us = 'I want to follow you';       //subject of the e-mail for the form on follow-us.html

    $message = '';
    $message .= '<table cellpadding="0" cellspacing="0">';
    foreach ($_POST['form_data'] as $postname => $post) {

        if ($postname != 'envoo-admin-mail') {

            $message .= "<tr><td style='padding: 5px 20px 5px 5px'><strong>" . urldecode($postname) . ":</strong>" . "</td><td style='padding: 5px; color: #444'>" . $post . "</td></tr>";
        }
    }

    $message .= '</table>';

    $headers = 'From: ' . $from . "\r\n" .
            'Reply-To: info@yourdomain.com' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    wp_mail($to, $subject_contact_us, $message, $headers);

}
add_action('wp_ajax_nopriv_MailFunction', 'MailFunction');
add_action( 'wp_ajax_MailFunction', 'MailFunction' ); 

/* Woocommerce Video in tabs */
function removeVideoFromTabs() {
    $offset = 0;
    $videos = array();
    $content = " " . get_post_field('post_content', get_the_ID());
    if (strpos(get_post_field('post_content', get_the_ID()), "[youtube") > -1) {
        $i = 0;
        while (true) {       
            $start = strpos($content, "[youtube", $offset);
            $end = strpos($content, "[/youtube]", $start);
            $offset = $end;
            if (!$start) break;
            $videos["youtube_" . $i] = substr(get_post_field('post_content', get_the_ID()), $start + 8, $end - $start - 9);
        }
        $i++;
    }
    $offset = 0;
    if (strpos(get_post_field('post_content', get_the_ID()), "[vimeo") > -1) {
        $j = 0;
        while (true) {      
            $start = strpos($content, "[vimeo", $offset);
            $end = strpos($content, "[/vimeo]", $start);
            $offset = $end;
            if (!$start) break;
            $videos["vimeo_" . $j] = substr(get_post_field('post_content', get_the_ID()), $start + 6, $end - $start - 7);
        }
        $j++;
    }
    if(empty($videos))
        return false;
    $i = 0;
    foreach ($videos as $key => $video) {
        $featured = substr($video, 10, 1);
        if (substr($key, 0, 5) == "vimeo") {
            $video_content = substr($video, strpos($video, 'content="') + 9, 1);
            $start = strpos($video, "[vimeo");
            $end = strpos($video, "[/vimeo]");
            $video_id = (substr($video, $end - 7, 7));
            $video_all[$i]['type'] = 'vimeo';
        } else {
            $video_content = substr($video, strpos($video, 'content="') + 9, 1);
            $start = strpos($video, "[youtube");
            $end = strpos($video, "[/youtube]");
            $video_id = (substr($video, $end - 11, 11));
            $video_all[$i]['type'] = 'youtube';
        }
        $video_all[$i]['featured'] = $featured;
        $video_all[$i]['video_content'] = $video_content;
        $video_all[$i]['video_id'] = $video_id;
        $i++;
    }

    foreach ($video_all as $item) {
        if ($item['video_content'] == "f") { 
            if ($item['featured'] == "f") $featured = "false"; else $featured = "true";
            if ($item['type'] == 'youtube') {
                $content = str_replace('[youtube featured="' . $featured . '" content="false"]' . $item['video_id'] . '[/youtube]', "", $content);
            }
            if ($item['type'] == 'vimeo') {
                $content = str_replace('[vimeo featured="' . $featured . '" content="false"]' . $item['video_id'] . '[/vimeo]', "", $content);
            }
        }
    }
    $content = apply_filters('the_content', $content); 
    return $content;
}

/* Woocommerce change featured image */
function videoFeatured() {
    $offset = 0;
    $videos = array();
    $content = " " . get_post_field('post_content', get_the_ID());   
    if (strpos(get_post_field('post_content', get_the_ID()), "[youtube") > -1) { 
        $i = 0;
        while (true) {
                $start = strpos($content, "[youtube", $offset);
                $end = strpos($content, "[/youtube]", $start);
                $offset = $end;
                if (!$start) break;
                $videos["youtube_".$i] = substr(get_post_field('post_content', get_the_ID()), $start + 8, $end - $start - 9);
            $i++;
        }
    }   
    $offset = 0;
    if (strpos(get_post_field('post_content', get_the_ID()), "[vimeo") > -1) { 
        $j = 0;
        while (true) {        
            $start = strpos($content, "[vimeo", $offset);
            $end = strpos($content, "[/vimeo]", $start);
            $offset = $end;
            if (!$start) break;
            $videos["vimeo_" . $j] = substr(get_post_field('post_content', get_the_ID()), $start + 6, $end - $start - 7);
        }
        $j++;
    }
    $i = 0;
    foreach ($videos as $key => $video) {
        $featured = substr($video, 10, 1); 
        if($featured=='t') {
            if (substr($key, 0, 5) == "vimeo") {
                $video_content = substr($video, strpos($video, 'content="') + 9, 1);
                $start = strpos($video, "[vimeo");
                $end = strpos($video, "[/vimeo]");
                $video_id = (substr($video, $end - 7, 7));
                $video_all = "[vimeo]".$video_id."[/vimeo]";
            } else {
                $video_content = substr($video, strpos($video, 'content="') + 9, 1);
                $start = strpos($video, "[youtube");
                $end = strpos($video, "[/youtube]");
                $video_id = (substr($video, $end - 11, 11));
                $video_all = "[youtube]".$video_id."[/youtube]";
                                 "<img width=\"138\" height=\"103\" src='http://img.youtube.com/vi/$video_id/mqdefault.jpg' /></a>";
            }           
            break;
        } else {        
            $i++;
        }
    }
    if(empty($video_all))
        $video_all = false;

    return $video_all;
}

/* Woocommerce video thumbnails */
function videoThumb() { 
    $offset = 0;
    $videos = array();
    $content = " " . get_post_field('post_content', get_the_ID());
    if (strpos(get_post_field('post_content', get_the_ID()), "[youtube") > -1) {
        $i = 0;
        while (true) {        
            $start = strpos($content, "[youtube", $offset);
            $end = strpos($content, "[/youtube]", $start);
            $offset = $end;
            if (!$start) break;
            $videos["youtube_" . $i] = substr(get_post_field('post_content', get_the_ID()), $start + 8, $end - $start - 9);
        }
        $i++;
    } 
    $offset = 0;
    if (strpos(get_post_field('post_content', get_the_ID()), "[vimeo") > -1) {
        $j = 0;
        while (true) {        
            $start = strpos($content, "[vimeo", $offset);
            $end = strpos($content, "[/vimeo]", $start);
            $offset = $end;
            if (!$start) break;
            $videos["vimeo_" . $j] = substr(get_post_field('post_content', get_the_ID()), $start + 6, $end - $start - 7);
        }
        $j++;
    }
    if(empty($videos))
        return false;
    $i = 0;
    foreach ($videos as $key => $video) {
        $featured = substr($video, 10, 1);
        if (substr($key, 0, 5) == "vimeo") {
            $video_content = substr($video, strpos($video, 'content="') + 9, 1);
            $start = strpos($video, "[vimeo");
            $end = strpos($video, "[/vimeo]");
            $video_id = (substr($video, $start));
            $video_all[$i]['type'] = 'vimeo';
        } else {
            $video_content = substr($video, strpos($video, 'content="') + 9, 1);
            $start = strpos($video, "[youtube");
            $end = strpos($video, "[/youtube]");
            $video_id = (substr($video, $end - 11, 11));
            $video_all[$i]['type'] = 'youtube';
        }
        $video_all[$i]['featured'] = $featured;
        $video_all[$i]['video_content'] = $video_content;
        $video_all[$i]['video_id'] = $video_id;
        if($featured=='t') {
            unset($video_all[$i]);
        }
        $i++;
    }

    foreach ($video_all as $item) {
            $video_id = $item['video_id'];
            if ($item['type'] == 'youtube') {
                $video_thumb[] = '<a href="http://www.youtube.com/embed/' . $video_id . '?iframe=true" rel="prettyPhoto[product]" class="product-image-holder thumbnail-image">' . 
                                 "<img width=\"138\" height=\"103\" src='http://img.youtube.com/vi/$video_id/mqdefault.jpg' />" . '
                                                <div class="product-image-holder-after"></div>
                                                <div class="product-image-hover">
                                                    <div class="enlarge"></div>
                                                </div>
                                 </a>';
            }
            if ($item['type'] == 'vimeo') {
                $data = file_get_contents("http://vimeo.com/api/v2/video/$video_id.json");
                $data = json_decode($data);
                $video_link = $data[0]->thumbnail_medium;
                $video_thumb[] = '<a href="https://vimeo.com/' . $video_id . '?autoplay=false" rel="prettyPhoto[product]" class="product-image-holder thumbnail-image">' 
                                 . '<img width=\"138\" height=\"103\" src="' . $video_link . '" />
                                                <div class="product-image-holder-after"></div>
                                                <div class="product-image-hover">
                                                    <div class="enlarge"></div>
                                                </div>
                                 </a>';
            }
    }

    return $video_thumb;
}

/* Custom Widget for homepage*/

if (function_exists('register_sidebar')) { 

    register_sidebar(array(  
        'name' => 'Header Texts',  
        'id'   => 'header-texts',  
        'description'   => 'Header Texts before Navigation',  
        'before_widget' => '',  
        'after_widget'  => '',  
        'before_title'  => '<h2>',  
        'after_title'   => '</h2>'  
    ));

    register_sidebar(array(  
        'name' => 'Three Home Icons',  
        'id'   => 'home-icons',  
        'description'   => 'Home Icons on Blue Bar',  
        'before_widget' => '',  
        'after_widget'  => '',  
        'before_title'  => '<h2 style="display: none;">',  
        'after_title'   => '</h2>'  
    ));  

    register_sidebar(array(  
        'name' => 'Treatment Texts',  
        'id'   => 'treatmenttexts',  
        'description'   => 'Treatment Content shown on Homepage',  
        'before_widget' => '',  
        'after_widget'  => '',  
        'before_title'  => '<h2 style="display: none;">',  
        'after_title'   => '</h2>'  
    ));

    register_sidebar(array(  
        'name' => 'Causes of Gout Texts',  
        'id'   => 'causesofgouttexts',  
        'description'   => 'Causes of Gout Content shown on Homepage',  
        'before_widget' => '',  
        'after_widget'  => '',  
        'before_title'  => '<h2 style="display: none;">',  
        'after_title'   => '</h2>'  
    ));

    register_sidebar(array(  
        'name' => 'The Gout Diet',  
        'id'   => 'goutdiet',  
        'description'   => 'The Gout Diet Content shown on Homepage',  
        'before_widget' => '',  
        'after_widget'  => '',  
        'before_title'  => '<h2 style="display: none;">',  
        'after_title'   => '</h2>'  
    ));

    register_sidebar(array(  
        'name' => 'Other Benefits',  
        'id'   => 'otherbenefits',  
        'description'   => 'Other Benefits Content shown on Homepage',  
        'before_widget' => '',  
        'after_widget'  => '',  
        'before_title'  => '<h2 style="display: none;">',  
        'after_title'   => '</h2>'  
    ));

    register_sidebar(array(  
        'name' => 'Primary Sidebar',  
        'id'   => 'primarysidebar',  
        'description'   => 'Primary Sidebar for Pages',  
        'before_widget' => '',  
        'after_widget'  => '',  
        'before_title'  => '<h2 style="display: none;"">',  
        'after_title'   => '</h2>'  
    ));
} 

function register_my_menu() {
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_my_menu' );

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
add_action('init', 'my_custom_init');
     function my_custom_init() {
     add_post_type_support( 'page', 'excerpt' );
}
