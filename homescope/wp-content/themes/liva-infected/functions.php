<?php

/**

 * liva functions and definitions

 *

 * @package liva

 * @since liva 1.0

 */



/**

 * Optional: set 'ot_show_pages' filter to false.

 * This will hide the settings & documentation pages.

 */

add_filter( 'ot_show_pages', '__return_false' );



/**

 * Optional: set 'ot_show_new_layout' filter to false.

 * This will hide the "New Layout" section on the Theme Options page.

 */

add_filter( 'ot_show_new_layout', '__return_false' );



/**

 * Required: set 'ot_theme_mode' filter to true.

 */

add_filter( 'ot_theme_mode', '__return_true' );



/**

 * Required: include OptionTree.

 */

include_once( 'option-tree/ot-loader.php' );



/**

* Theme Options

*/

include_once( 'inc/theme-options.php' );



/**

* Meta boxes + page builder

*/



include_once( 'inc/meta-boxes.php' );

include_once( 'framework/page-builder.php' );



/**

 * Framework functions

 */

include_once( 'framework/framework.php' );



/**

 * Widgets initalization

 */

include_once( 'inc/widgets.php' );



/**

 * Shortcodes initalization

 */

include_once( 'inc/shortcodes.php' );



/**

 * Third Party Plugins activation

 */

include_once( 'framework/plugins-activation.php' );



/**

 * FlexSlider

 */

include_once( 'framework/flexslider.php' );



/**

* Liva walkers

*/

include_once( 'inc/class/liva_walker_nav.class.php' );

include_once( 'inc/class/liva_one_page_walker_nav.class.php' );



/**

 * Set the content width based on the theme's design and stylesheet.

 *

 * @since liva 1.0

 */

if ( !isset( $content_width ) )

{

    $content_width = 1053; /* pixels */

}



if ( !function_exists( 'ts_theme_setup' ) ):

/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * @since liva 1.0

 */

function ts_theme_setup()

{

	/**

	 * Enable Retina Support

	 */

	if (!is_admin() && ot_get_option('retina_support') == 'enabled')

	{

		define('RETINA_SUPPORT',true);

	}

	

    /**

     * Custom template tags for this theme.

     */

    require( get_template_directory() . '/inc/template-tags.php' );



    /**

     * Custom functions that act independently of the theme templates

     */

    require( get_template_directory() . '/inc/tweaks.php' );



    /**

     * Make theme available for translation

     */

    load_theme_textdomain( 'liva', get_template_directory() . '/languages' );

    load_theme_textdomain( 'framework', get_template_directory() . '/languages' );



	/**

     * This theme uses wp_nav_menu() in one location.

     */

    register_nav_menus( array(

        'primary' => __( 'Primary Menu', 'liva' ),

        'copyright-bar' => __( 'Copyright bar menu', 'liva' ),

    ) );

	

    /**

     * Add default posts and comments RSS feed links to head

     */

    add_theme_support( 'automatic-feed-links' );



    /**

	* Reset post formats for public part of the website

	* Using set_custom_post_formats() is not enough, it sets only formats for post edit form

	*/

	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'audio', 'video', 'quote', 'status') );

	add_post_type_support( 'portfolio', 'post-formats' );

  

	/**

	* Woocommerce support

	*/

	add_theme_support( 'woocommerce' );

	

	/**

	* Images

	*/

	add_theme_support('post-thumbnails'); //enable

	set_post_thumbnail_size( 594, 325, true ); //set default resolution for featured image

	add_image_size( 'pinterest', 735, 735, true );



	//standard content

	ts_add_theme_image_size('full', 1156, 577, true);

	ts_add_theme_image_size('one-sidebar', 814, 363,true);

	ts_add_theme_image_size('two-sidebars', 566, 283 ,true);



	ts_add_theme_image_size('full-small', 306, 137, true);

	ts_add_theme_image_size('one-sidebar-small', 306, 137,true);

	ts_add_theme_image_size('two-sidebars-small', 306, 137 ,true);



	ts_add_theme_image_size('half-full', 578, 288, true);

	ts_add_theme_image_size('half-one-sidebar', 431, 215,true);

	ts_add_theme_image_size('half-two-sidebars', 283, 142 ,true);



	ts_add_theme_image_size('third-full', 385, 192, true);

	ts_add_theme_image_size('third-one-sidebar', 287, 143,true);

	ts_add_theme_image_size('third-two-sidebars', 188, 94 ,true);



	ts_add_theme_image_size('fourth-full', 289, 144, true);

	ts_add_theme_image_size('fourth-one-sidebar', 215, 107, true);

	ts_add_theme_image_size('fourth-two-sidebars', 141, 70 ,true);



	//flexslider

	ts_add_theme_image_size('slider', 1170, 360, true);

	ts_add_theme_image_size('full-aligned', 1156, 577, true);

	ts_add_theme_image_size('one-sidebar-aligned', 344, 266,true);

	ts_add_theme_image_size('two-sidebars-aligned', 266, 266 ,true);



	//templates

	ts_add_theme_image_size('portfolio-1', 545,306 ,true);

	ts_add_theme_image_size('portfolio-1-3', 296,167 ,true);

	ts_add_theme_image_size('portfolio-1-4', 205,115 ,true);

	ts_add_theme_image_size('portfolio-2', 370,250 ,true);

	ts_add_theme_image_size('portfolio-single', 878,638 ,true);



	//shortcodes

	ts_add_theme_image_size('latest-posts', 50,50, true);

	ts_add_theme_image_size('testimonial', 110,130, true);

	ts_add_theme_image_size('testimonials', 116,136, true);

	ts_add_theme_image_size('testimonials-2', 70,70, true);

	ts_add_theme_image_size('latest-works', 275,250, true);

	ts_add_theme_image_size('person-mid', 270,180, true);

	ts_add_theme_image_size('recent-projects', 370,250, true);



	//widgets

	ts_add_theme_image_size('portfolio-widget', 250, 250, true);

	ts_add_theme_image_size('multi-posts-widget', 50, 50, true);

	ts_add_theme_image_size('testimonial-widget', 50, 50, true);

	

	/**

	* Exerpt length

	* Usage ts_the_excerpt_theme('short');

	*/

	define ('TINY_EXCERPT',12);

	define ('SHORT_EXCERPT',22);

	define ('REGULAR_EXCERPT',55);

	define ('LONG_EXCERPT',55);

   

   /**

    * Slider nav labels

    */

	define ('SLIDER_PREV_TEXT',__('Left', 'liva'));

	define ('SLIDER_NEXT_TEXT',__('Right', 'liva'));

	

	/**

	 * Add editor styles

	 */

	add_editor_style('css/style.css');

}

endif; // theme_setup

add_action( 'after_setup_theme', 'ts_theme_setup' );



if ( ! function_exists( 'ts_theme_activation' ) ):

/**

 * Runs on theme activation

 *

 * @since liva 1.0

 */

function ts_theme_activation()

{

	global $wpdb;



	$table = $wpdb->get_var("SHOW TABLES LIKE '".$wpdb -> prefix."fs_sliders'");

	if (!strstr($table,'fs_sliders'))

	{

		$wpdb-> query("

		   CREATE TABLE `".$wpdb -> prefix."fs_sliders` (

			`slider_id` int(11) NOT NULL AUTO_INCREMENT,

			`name` varchar(64) NOT NULL,

			`created_date` int(11) NOT NULL,

			`animation` varchar(32) NOT NULL,

			`direction` varchar(32) NOT NULL,

			`slideshow_speed` int(10) unsigned NOT NULL,

			`animation_speed` int(10) unsigned NOT NULL,

			`background` varchar(512) NOT NULL,

			`reverse` tinyint(1) unsigned NOT NULL DEFAULT '0',

			`randomize` tinyint(1) unsigned NOT NULL DEFAULT '0',

			`control_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',

			`direction_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',

			PRIMARY KEY (`slider_id`)

		  ) ENGINE=MyISAM;

		");

	}

	$table = $wpdb->get_var("SHOW TABLES LIKE '".$wpdb -> prefix."fs_slides'");

	if (!strstr($table,'fs_slides'))

	{

		$wpdb-> query("

		   CREATE TABLE `".$wpdb -> prefix."fs_slides` (

			`slide_id` int(11) NOT NULL AUTO_INCREMENT,

			`slider_id` int(11) NOT NULL,

			`image` varchar(255) NOT NULL,

			`show_order` int(10) unsigned NOT NULL,

			`update_status` tinyint(1) unsigned NOT NULL DEFAULT '0',

			PRIMARY KEY (`slide_id`),

			KEY `slider_id` (`slider_id`)

		  ) ENGINE=MyISAM;

		 ");

	}

}

endif; //theme_activation

add_action('after_switch_theme', 'ts_theme_activation');



/**

 * Enable support for Post Formats for post edit form

 * Formats depends on post type here

 */

function ts_set_custom_post_formats()

{

	$postType = '';

	if (isset($_GET['post'])) {

		$postType = get_post_type( $_GET['post'] );

	}



	if($postType == 'portfolio' || (isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio' ) )

    {

		add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

        add_post_type_support( 'portfolio', 'post-formats' );

    }

	else

	{

		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'audio', 'video', 'quote', 'status') );

    }

}



add_action( 'load-post.php','ts_set_custom_post_formats' );

add_action( 'load-post-new.php','ts_set_custom_post_formats' );



/**

 * Reset post formats for public part of the website

 * Using set_custom_post_formats() is not enough, it sets only formats for post edit form

 */

function ts_reset_post_formats()

{

    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'audio', 'video', 'quote', 'status') );

	add_post_type_support( 'portfolio', 'post-formats' );

}

add_action( 'after_setup_theme','ts_reset_post_formats' );



/**

 * Register post type

 *

 * @since liva 1.0

 */

add_action( 'init', 'ts_register_theme_post_types' );

function ts_register_theme_post_types()

{

	register_post_type( 'portfolio',

		array(

			'labels' =>

                array(

                    'name' => __( 'Portfolio' , 'liva'),

                    'singular_name' => __( 'Portfolio' , 'liva')

                ),

            'public' => true,

            'has_archive' => false,

            'rewrite' => array( 'slug' => 'portfolio' ),

            'supports' => array('title',

                'editor',

                //'author',

                'thumbnail',

                //'excerpt',

                //'comments'

            )

		)

	);



    register_taxonomy(

        "portfolio-categories",

        array("portfolio"),

        array(

            "hierarchical" => true,

            "label" => __("Categories",'liva'),

            "singular_label" => __("Category","liva"),

            "rewrite" => true

        )

    );



    register_post_type( 'faq',

		array(

			'labels' =>

                array(

                    'name' => __( 'FAQ' , 'liva'),

                    'singular_name' => __( 'FAQ' , 'liva')

                ),

            'public' => true,

            'has_archive' => false,

            'rewrite' => array( 'slug' => 'faq' ),

            'supports' => array('title',

                'editor',

                //'author',

                'thumbnail',

                //'excerpt',

                //'comments'

            )

		)

	);



    register_taxonomy(

        "faq-categories",

        array("faq"),

        array(

            "hierarchical" => true,

            "label" => __("Categories",'liva'),

            "singular_label" => __("Category",'liva'),

            "rewrite" => true

        )

    );



    register_post_type( 'team',

		array(

			'labels' =>

                array(

                    'name' => __('Team Members' , 'liva'),

                    'singular_name' => __('Team Member' , 'liva'),

                    'add_new' => __('Add New', 'liva'),

                    'add_new_item' => __('Add New Team Member', 'liva'),

                    'edit_item' => __('Edit Team Member', 'liva'),

                    'new_item' => __('New Team Member', 'liva'),

                    'all_items' => __('All Team Members', 'liva'),

                    'view_item' => __('View Team Member', 'liva'),

                    'search_items' => __('Search Team Members', 'liva'),

                    'not_found' =>  __('No team members found', 'liva'),

                    'not_found_in_trash' => __('No team member found in Trash', 'liva'),

                    'parent_item_colon' => '',

                    'menu_name' => __('Team Members', 'liva')

               ),

            'public' => true,

            'has_archive' => false,

            'rewrite' => array( 'slug' => 'team' ),

            'capability_type' => 'page',

            'supports' => array('title',

                'editor',

                //'author',

                'thumbnail',

                //'excerpt',

                //'comments'

                'page-attributes'

            )

		)

	);

}



/**

 * Modify title placeholder for custom post types

 *

 * @since liva 1.0

 */

add_filter( 'enter_title_here', 'ts_custom_enter_title' );

function ts_custom_enter_title( $input ) {

    global $post_type;



    if ( is_admin() && 'team' == $post_type )

    {

        return __( 'Enter team member name here', 'liva' );

    }

    return $input;

}





/**

 * Enqueue scripts and styles

 *

 * @since liva 1.0

 */

function ts_theme_scripts() {



	wp_register_style( 'reset', get_template_directory_uri() . '/css/reset.css', array(), null, 'all' );

	wp_register_style( 'style', get_template_directory_uri() . '/css/style.css', array(), null, 'all' );

	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', array(), null, 'all' );

	wp_register_style( 'responsive-leyouts', get_template_directory_uri() . '/css/responsive-leyouts.css', array(), null, 'all' );

	wp_register_style( 'color-switcher', get_template_directory_uri() . '/js/style-switcher/color-switcher.css', array(), null, 'all' );

	wp_register_style( 'sticky-menu', get_template_directory_uri() . '/js/sticky-menu/core.css', array(), null, 'all' );

	wp_register_style( 'accordion', get_template_directory_uri() . '/js/accordion/accordion.css', array(), null, 'all' );

	wp_register_style( 'tabs', get_template_directory_uri() . '/js/tabs/tabs.css', array(), null, 'all' );

	wp_register_style( 'tabs-style2', get_template_directory_uri() . '/js/tabs/tabs-style2.css', array(), null, 'all' );

	wp_register_style( 'fadeeffect', get_template_directory_uri() . '/js/testimonials/fadeeffect.css', array(), null, 'all' );

	wp_register_style( 'icomoon', get_template_directory_uri() . '/css/icomoon.css', array(), null, 'all' );

	wp_register_style( 'ui-progress-bar', get_template_directory_uri() . '/js/progressbar/ui.progress-bar.css', array(), null, 'all' );

	wp_register_style( 'jcarousel-skin', get_template_directory_uri() . '/js/jcarousel/skin.css', array(), null, 'all' );

	wp_register_style( 'jcarousel-skin2', get_template_directory_uri() . '/js/jcarousel/skin2.css', array(), null, 'all' );

	wp_register_style( 'tabwidget', get_template_directory_uri() . '/js/tabs/tabwidget/tabwidget.css', array(), null, 'all' );

	wp_register_style( 'iosslider', get_template_directory_uri() . '/js/iosslider/common.css', array(), null, 'all' );

	wp_register_style( 'isotope', get_template_directory_uri() . '/js/portfolio/isotope.css', array(), null, 'all' );

	wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), null, 'all' );

	wp_register_style( 'fancybox', get_template_directory_uri() . '/js/portfolio/source/jquery.fancybox.css', array(), null, 'all' );



	wp_enqueue_style( 'reset' );

	wp_enqueue_style( 'font-awesome' );

	wp_enqueue_style( 'style' );

	wp_enqueue_style( 'responsive-leyouts' );

	wp_enqueue_style( 'color-switcher' );

	wp_enqueue_style( 'sticky-menu' );

	wp_enqueue_style( 'accordion' );

	wp_enqueue_style( 'tabs' );

	wp_enqueue_style( 'tabs-style2' );

	wp_enqueue_style( 'fadeeffect' );

	wp_enqueue_style( 'icomoon' );

	wp_enqueue_style( 'ui-progress-bar' );

	wp_enqueue_style( 'style', get_stylesheet_uri() );

    wp_enqueue_style( 'jquery');

    wp_enqueue_style( 'jcarousel-skin');

    wp_enqueue_style( 'jcarousel-skin2');

    wp_enqueue_style( 'tabwidget');

    wp_enqueue_style( 'iosslider');

    wp_enqueue_style( 'isotope');

    wp_enqueue_style( 'animate');

    wp_enqueue_style( 'fancybox');



    wp_register_script( 'style-switcher-jquery-1', get_template_directory_uri().'/js/style-switcher/jquery-1.js',array('jquery'),null,true);

    wp_register_script( 'style-switcher-styleselector', get_template_directory_uri().'/js/style-switcher/styleselector.js',array('jquery'),null,true);

    wp_register_script( 'ddsmoothmenu', get_template_directory_uri().'/js/mainmenu/ddsmoothmenu.js',array(),null,true);

    wp_register_script( 'selectnav', get_template_directory_uri().'/js/mainmenu/selectnav.js',array('ddsmoothmenu'),null,true);

    wp_register_script( 'mainmenu-scripts', get_template_directory_uri().'/js/mainmenu/scripts.js',array('jquery'),null,true);

    wp_register_script( 'accordion-custom', get_template_directory_uri().'/js/accordion/custom.js',array('jquery'),null,true);

    wp_register_script( 'modernizr', get_template_directory_uri().'/js/modernizr.custom.38913.js',array(),null,true);

	wp_register_script( 'sticky-menu-core', get_template_directory_uri().'/js/sticky-menu/core.js',array('jquery','modernizr'),null,true);

    wp_register_script( 'retina', get_template_directory_uri().'/js/retina/retina.js',array(),null,true);

    wp_register_script( 'progress', get_template_directory_uri().'/js/progressbar/progress.js',array('jquery'),null,true);

    wp_register_script( 'jcarousel', get_template_directory_uri().'/js/jcarousel/jquery.jcarousel.min.js',array('jquery'),null,true);

    wp_register_script( 'tabwidget', get_template_directory_uri().'/js/tabs/tabwidget/tabwidget.js',array('jquery'),null,true);

    wp_register_script( 'flexslider', get_template_directory_uri().'/js/flexslider/jquery.flexslider-min.js',array('jquery'),null,true);

    wp_register_script( 'testimonials', get_template_directory_uri().'/js/testimonials/testimonials.js',array('jquery'),null,true);

    wp_register_script( 'iosslider', get_template_directory_uri().'/js/iosslider/_src/jquery.iosslider.js',array('jquery'),null,true);

    wp_register_script( 'easing', get_template_directory_uri().'/js/iosslider/_lib/jquery.easing-1.3.js',array('jquery'),null,true);

    wp_register_script( 'iosslider-custom', get_template_directory_uri().'/js/iosslider/_src/custom.js',array('jquery'),null,true);

    wp_register_script( 'isotope', get_template_directory_uri().'/js/portfolio/jquery.isotope.js',array('jquery'),null,true);

	wp_register_script( 'jquery-nav', get_template_directory_uri().'/js/jquery.nav.js',array('jquery'),null,true);

    wp_register_script( 'jquery-scrollto', get_template_directory_uri().'/js/jquery.scrollto.min.js',array('jquery'),null,true);

    wp_register_script( 'jquery-fancybox', get_template_directory_uri().'/js/portfolio/source/jquery.fancybox.js',array('jquery'),null,true);

    wp_register_script( 'main', get_template_directory_uri().'/js/main.js',array('jquery'),null,true);



	wp_enqueue_script( 'jquery' );



	wp_enqueue_script( 'style-switcher-jquery-1' );

	wp_enqueue_script( 'style-switcher-styleselector' );

	wp_enqueue_script( 'accordion-custom' );

	wp_enqueue_script( 'sticky-menu-core' );

	wp_enqueue_script( 'progress' );

	wp_enqueue_script( 'jcarousel' );

	wp_enqueue_script( 'tabwidget' );

	wp_enqueue_script( 'modernizr' );

	wp_enqueue_script( 'flexslider' );

	wp_enqueue_script( 'testimonials' );

	wp_enqueue_script( 'iosslider' );

	wp_enqueue_script( 'easing' );

	wp_enqueue_script( 'iosslider-custom' );

	wp_enqueue_script( 'isotope' );

	wp_enqueue_script( 'jquery-fancybox' );

	wp_enqueue_script( 'selectnav' );

   wp_enqueue_script( 'jquery-nav' );

	if (ts_get_main_menu_style() == 'style4') {

		wp_enqueue_script( 'jquery-scrollto' );

		wp_enqueue_script( 'jquery-nav' );

	} else {

		wp_enqueue_script( 'ddsmoothmenu' );

		wp_enqueue_script( 'mainmenu-scripts' );

	}

	wp_enqueue_script( 'main' );



	$translation_array = array(

		'just_now' => __( 'Just now', 'liva'),

		'one_minute_ago' => __( '1 minute ago', 'liva'),

		'minutes_ago' => __( 'minutes ago', 'liva'),

		'one_hour_ago' => __( '1 hour ago', 'liva'),

		'hours_ago' => __( 'hours ago', 'liva'),

		'yesterday' => __( 'yesterday', 'liva'),

		'days_ago' => __( 'days ago', 'liva'),

		'weeks_ago' => __( 'weeks ago', 'liva'),

		'months_ago' => __( 'months ago', 'liva'),

		'one_year_ago' => __( '1 year ago', 'liva'),

		'years_ago' => __( 'years ago', 'liva'),

	);



    wp_localize_script( 'main', 'locales', $translation_array );



	if (defined('RETINA_SUPPORT') && RETINA_SUPPORT === true)

	{

		wp_enqueue_script( 'retina' );

	}



    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

        wp_enqueue_script( 'comment-reply' );

    }

}

add_action( 'wp_enqueue_scripts', 'ts_theme_scripts' );



$html5shim = create_function( '', 'echo \'<!--[if lt IE 9]><script src="\'.get_template_directory_uri().\'/js/html5.js"></script><![endif]-->\';' );

add_action( 'wp_head', $html5shim );



$icomoon = create_function( '', 'echo \'<!--[if lt IE 7]><script src="\'.get_template_directory_uri().\'/js/icomoon/icomoon.js"></script><![endif]-->\';' );

add_action( 'wp_head', $icomoon );



function ts_ajaxurl() { ?>

	<script type="text/javascript">

		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

	</script>

	<?php

}

add_action('wp_head','ts_ajaxurl');



/**

 * Google analytics output

 */

function ts_google_analytics_output() {



	if (ot_get_option('google_analytics_id') != "") {

	?>

		<script type="text/javascript">



			var _gaq = _gaq || [];

			_gaq.push(['_setAccount', '<?php echo ot_get_option('google_analytics_id'); ?>']);

			_gaq.push(['_trackPageview']);



			(function() {

			  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

			  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

			  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

			})();



		</script>

	<?php

	}

}



add_action( 'wp_footer', 'ts_google_analytics_output',1200);



/**

* Register theme widgets

*

* @since liva 1.0

*/

function ts_theme_widgets_init()

{

    register_sidebar( array(

        'name' => __( 'Main Sidebar', 'liva' ),

        'id' => 'main',

        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',

        'after_widget' => '</div>',

        'before_title' => '<div class="sidebar_title"><h3>',

        'after_title' => '</h3></div>',

    ) );



    for ($i = 1; $i <= 4; $i ++)

    {

        register_sidebar( array(

            'name' => __( 'Footer Area', 'liva' ).' '.$i,

            'id' => 'footer-area-'.$i,

            'before_widget' => '<section id="%1$s" class="widget %2$s">',

            'after_widget' => '</section>',

            'before_title' => '<h2>',

            'after_title' => '</h2>',

        ) );

    }



	$user_sidebars = ot_get_option('user_sidebars');



    if (is_array($user_sidebars))

    {

        foreach ($user_sidebars as $sidebar)

        {

            register_sidebar( array(

                'name' => $sidebar['title'],

                'id' => sanitize_title($sidebar['title']),

                'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',

				'after_widget' => '</div>',

				'before_title' => '<div class="sidebar_title"><h3>',

				'after_title' => '</h3></div>',

            ) );

        }

    }



}

add_action( 'widgets_init', 'ts_theme_widgets_init' );





/**

 * Add classes to body

 *

 * @param array $classes

 * @return array

 * @since framework 1.0

 */

// Add specific CSS class by filter

add_filter('body_class','ts_get_body_main_class');

function ts_get_body_main_class($classes) {



	global $body_class;



	//add body class and main menu style selected from control panel

	$added_body_class = false;

	$body_class = null;

	$added_main_menu_style = false;

	if (ts_check_if_control_panel())

	{

		if (ts_check_if_use_control_panel_cookies() && !empty($_COOKIE['theme_body_class']))

		{

			$added_body_class = true;

			$classes[] = $_COOKIE['theme_body_class'];

			$body_class = $_COOKIE['theme_body_class'];

		}

		else if (isset($_GET['switch_layout']) && !empty($_GET['switch_layout']))

		{

			$added_body_class = true;

			$classes[] = $_GET['switch_layout'];

			$body_class = $_GET['switch_layout'];

		}



		if (ts_check_if_use_control_panel_cookies() &&  !empty($_COOKIE['theme_main_menu_style']))

		{

			$main_menu_style = $_COOKIE['theme_main_menu_style'];

		}

		elseif (isset($_GET['switch_main_menu_style']) && !empty($_GET['switch_main_menu_style']))

		{

			$main_menu_style = $_GET['switch_main_menu_style'];

		}



		if (!empty($main_menu_style))

		{

			$added_main_menu_style = true;

			switch ($main_menu_style)

			{

				case 'style1':

					break;



				case 'style2':

					$classes[] = 'headerstyle2';

					break;



				case 'style3':

					$classes[] = 'headerstyle3';

					break;



				case 'style4':

					$classes[] = 'headerstyle4';

					break;

			}

		}

	}

	//add body_class set in theme options only if not added from control panel

	if ($added_body_class == false)

	{

		$class = ot_get_option('body_class');

		if (empty($class))

		{

			$class = 'w1170';

		}

		$classes[] = $class;

		$body_class = $class;

	}

	//add body_class set in theme options only if not added from control panel



	if ($added_main_menu_style == false)

	{

		$style = ts_get_main_menu_style();

		if (!empty($style))

		{

			switch ($style)

			{

				case 'style1':

					break;



				case 'style2':

					$classes[] = 'headerstyle2';

					break;



				case 'style3':

					$classes[] = 'headerstyle3';

					break;



				case 'style4':

					$classes[] = 'headerstyle4';

					break;

			}

		}

	}

	//add class if there is not header image

	$slider = null;

	if (is_page())

	{

		$slider = get_post_meta(get_the_ID(), 'post_slider',true);

		if ($slider)

		{

			$slider = ts_get_post_slider(get_the_ID());

		}

		else

		{

			$slider = null;

		}

		if (empty($slider))

		{

			$header_background = get_post_meta(get_the_ID(),'header_background',true);

			if (empty($header_background))

			{

				$classes[] = 'no-header-image';

			}

		}

	}



	//add class if sticky menu is enabled

	if (ot_get_option('show_sticky_menu') != 'no') {

		$classes[] = 'sticky-menu-on';

	}



	//responsivness

	if (ot_get_option('enable_responsiveness') == 'no') {

		$classes[] = 'not-responsive';

	}



	//add content background for wide only (for boxed

	if (in_array($body_class, array('w1170', 'w960'))) {

		$content_background_pattern = ot_get_option('content_background_pattern');

		if (!empty($content_background_pattern) && $content_background_pattern != 'no-background') {

			$classes[] = $content_background_pattern;

		}

	}



	return $classes;

}



/**

 * Get class for specified sidebar

 *

 * @param array $classes

 * @return array

 * @since framework 1.0

 */

// Add specific CSS class by filter

add_filter('body_class','ts_get_sidebar_class');

function ts_get_sidebar_class($classes) {



	$sidebar_position = ts_get_single_post_sidebar_position();



	switch ($sidebar_position) {

		case 'left':

			$classes[] = 'left-sidebar';

			break;



		case 'no':

			$classes[] = 'no-sidebar';

			break;



		case 'right':

		default:

			$classes[] = 'right-sidebar';

			break;

	}



	return $classes;

}



/**

 * Get a list of supported header styles

 * @return array

 */

function ts_get_header_styles($empty_option = false)

{

	if ($empty_option === true) {

		$styles[] = array(

			'value' => 'default',

			'label' => __('Default', 'framework'),

			'src' => ''

		);

	}



	$styles[] =  array(

		'value' => 'style1',

		'label' => __('Style 1', 'framework').' '.($empty_option === false ? __('(default)','framework') : ''),

		'src' => ''

	);

	$styles[] =  array(

		'value' => 'style2',

		'label' => __('Style 2', 'framework'),

		'src' => ''

	);

	$styles[] =  array(

		'value' => 'style3',

		'label' => __('Style 3', 'framework'),

		'src' => ''

	);

	$styles[] =  array(

		'value' => 'style4',

		'label' => __('Style 4', 'framework'),

		'src' => ''

	);

	return $styles;

}



/**

 * Get control panel layouts

 */

function ts_get_control_panel_layouts()

{

	$layouts = array(

		array(

			'name' => __('Corporate','liva'),

			'thumb' => get_template_directory_uri().'/images/elements/layout-one-full.png',

			'url' => 'http://livacorporate.dahaguclu.com',

		),

		array(

			'name' => __('Business Classic','liva'),

			'thumb' => get_template_directory_uri().'/images/elements/layout-two-full.png',

			'url' => 'http://livabusiness.dahaguclu.com',

		),

		array(

			'name' => __('Creative','liva'),

			'thumb' => get_template_directory_uri().'/images/elements/layout-three-full.png',

			'url' => 'http://livacreative.dahaguclu.com',

		),

		array(

			'name' => __('One Page','liva'),

			'thumb' => get_template_directory_uri().'/images/elements/layout-four-full.png',

			'url' => 'http://livaone.dahaguclu.com',

		),

	);

	return $layouts;

}



//page builder configuration

//content - element required for each template

$page_builder_config = array(

	'default' => array(

		'content' => __('Page builder','framework')

	)

);



/**

 * Gettext filter, used in functions: __,_e etc.

 * @global array $ns_options_translations

 * @param string $content

 * @param string $text

 * @param string $domain

 * @return string

 */

if (!is_admin())

{

	function ts_translation($content, $text, $domain)

	{

		if (in_array($domain,array('liva')))

		{

			return ot_get_option('translator_'.sanitize_title($content),$content);

		}

		return $content;

	}



	function ts_check_if_translations_enabled() {

		if (ot_get_option('enable_translations') == 'yes') {

			add_filter( 'gettext','ts_translation',20, 3);

		}

	}

	add_action('init','ts_check_if_translations_enabled');

}



/**

 * Woocommerce support - hiding title on product's list

 * @param type $content

 * @return boolean

 */



function ts_hide_woocommerce_page_title($content) {

	return false;

}



add_filter('woocommerce_show_page_title','ts_hide_woocommerce_page_title');



/**

 * Get content container class (used in templates eg. page.php template-blog-1.php etc.)

 * @return string

 */

function ts_get_liva_content_class() {



	$sidebar_position = ts_get_single_post_sidebar_position();



	switch ($sidebar_position) {

		case 'left':

			$content_class = 'content_right';

			break;

		case 'no':

			$content_class = 'content_fullwidth';

			break;



		case 'right':

		default:

			$content_class = 'content_left';

			break;

	}



	return 'content_main '.$content_class;

}



/**

 * Get animation class for animated shortcodes

 * @param type $animation

 * @return string

 */

function ts_get_animation_class($animation, $add_class_attr = false) {



	if (!empty($animation)) {

		$class = 'animated-block '.$animation;



		if ($add_class_attr === true) {

			return 'class="'.$class.'"';

		}

		return $class;

	}

	return '';

}