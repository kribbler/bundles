<?php 

require_once(TEMPLATEPATH . '/epanel/custom_functions.php'); 

require_once(TEMPLATEPATH . '/includes/functions/comments.php'); 

require_once(TEMPLATEPATH . '/includes/functions/sidebars.php'); 

load_theme_textdomain('Minimal',get_template_directory().'/lang');

require_once(TEMPLATEPATH . '/epanel/options_minimal.php');

require_once(TEMPLATEPATH . '/epanel/core_functions.php'); 

require_once(TEMPLATEPATH . '/epanel/post_thumbnails_minimal.php');

function register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'footer-menu' => __( 'Footer Menu' )
		)
	);
};
if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

if (function_exists('register_sidebar')) {
	register_sidebar(array(
	'name' => 'Home Icons',
	'id' => 'home-icons',
	'description' => '4 Homepage icons below the main banner',
	'before_widget' => '<div id="%1$s" class="widget %2$s homeicons">',
	'after_widget' => '</div>',
	'before_title' => '<h2 style="display: none;">',
	'after_title' => '</h2>'
	));
}

if (function_exists('register_sidebar')) {
	register_sidebar(array(
	'name' => 'Footer Icons',
	'id' => 'footer-icons',
	'description' => '2 Footer icons below the main banner',
	'before_widget' => '<div id="%1$s" class="widget %2$s footericons">',
	'after_widget' => '</div>',
	'before_title' => '<h2 style="display: none;">',
	'after_title' => '</h2>'
	));
}

$wp_ver = substr($GLOBALS['wp_version'],0,3);
if ($wp_ver >= 2.8) include(TEMPLATEPATH . '/includes/widgets.php'); ?>