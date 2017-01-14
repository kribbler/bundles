<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);

		
		
		//Fonts Reader
		$fonts_path = get_stylesheet_directory(). '/fonts/'; // change this to where you store your bg images
		$fonts_url = get_template_directory_uri().'/fonts/'; // change this to where you store your bg images
		$fonts = array();
		
		if ( is_dir($fonts_path) ) {
			if ($fonts_dir = opendir($fonts_path) ) { 
				while ( ($fonts_file = readdir($fonts_dir)) !== false ) {
					if(stristr($fonts_file, ".ttf") !== false) {
						$fonts_file = str_replace('-webfont.ttf', '',$fonts_file);
						$fonts[] = $fonts_file;
					}
				}    
			}
		}
		
		$font_resource 	= array("Google webfonts","Typekit");
		
		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		
		//Background Footer Reader
		$bg_footer_path = get_stylesheet_directory(). '/images/bg/footer/'; // change this to where you store your bg images
		$bg_footer_url = get_template_directory_uri().'/images/bg/footer/'; // change this to where you store your bg images
		$bg_footer = array();
		
		if ( is_dir($bg_footer_path) ) {
		    if ($bg_footer_dir = opendir($bg_footer_path) ) { 
		        while ( ($bg_footer_file = readdir($bg_footer_dir)) !== false ) {
		            if(stristr($bg_footer_file, ".png") !== false || stristr($bg_footer_file, ".jpg") !== false) {
		                $bg_footer[] = $bg_footer_url . $bg_footer_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( "name" => "Main Settings",
					"type" => "heading");
	
$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( "name" => "Main Layout",
					"desc" => "Layout style for non-home pages.",
					"id" => "site_layout",
					"std" => "normal",
					"type" => "images",
					"options" => array(
						'normal' => $url . 'normal.png',
						'white' => $url . 'white.png')
					);
				
$of_options[] = array( "name" => "Logo",
					"desc" => "Your logo upload here",
					"id" => "logo_upload",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => "Logo width",
					"desc" => "Define width for logo",
					"id" => "logo_width",
					"std" => "220",
					"type" => "text");
					
$of_options[] = array( "name" => "Logo for Page with white background slider",
					"desc" => "Your logo upload here",
					"id" => "logo_alt_upload",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => "Space between logo and top (px)",
					"desc" => "Ex: 10(px)",
					"id" => "logo_top",
					"std" => "10",
					"mod" => "min",
					"type" => "text");

$of_options[] = array( "name" => "Space between logo and left (px)",
					"desc" => "Ex: 10(px)",
					"id" => "logo_left",
					"std" => "0",
					"type" => "text");
	
$of_options[] = array( "name" => "Top information",
					"desc" => "Ex: We do 24/7 online support. Feel free to call us: (+84)123 456 78",
					"id" => "top_info",
					"std" => "We do 24/7 online support. Feel free to call us: (+84)123 456 780",
					"type" => "text");
				
$of_options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px .png/.gif/.ico image that will represent your website's favicon.",
					"id" => "custom_favicon",
					"std" => "",
					"type" => "upload");

$of_options[] = array( "name" => "Apple touch icon",
					"desc" => "Your touch icon upload here",
					"id" => "touch_icon",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => "Apple touch icon 72x72",
					"desc" => "Your touch icon upload here",
					"id" => "touch_icon_72",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => "Apple touch icon 144x144",
					"desc" => "Your touch icon upload here",
					"id" => "touch_icon_144",
					"std" => "",
					"mod" => "min",
					"type" => "media");

//Styling and Font
$of_options[] = array( "name" => "Styling and Font",
					"type" => "heading");
					
$of_options[] = array( 	"name" 		=> "Hello there!",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">You can choose fonts to use from Google webfonts library or Typekit.</h3>
						If you decide to use font from Google webfonts library, please not to turn off all options related to Typekit, or vice versa.",
						"icon" 		=> true,
						"type" 		=> "info"
				);
					
$of_options[] = array( "name" => "Enable google webfont resource",
					"desc" => "Only check if you want to use font from Google webfont",
					"id" => "gg_font",
					"std" => 1,
          			"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => "Custom heading font (H1, H2, H3, H4)",
					"desc" => "",
					"id" => "heading_font",
					"std" => array('font' => 'Lato','color' => '#69747f', 'style' => '300'),
					"fold" => "gg_font",
					"type" => "font");

$of_options[] = array( "name" => "Custom heading font (H5, H6)",
					"desc" => "",
					"id" => "heading_font_4",
					"std" => array('font' => 'Lato','color' => '#69747f', 'style' => '400'),
					"fold" => "gg_font",
					"type" => "font");
					
$of_options[] = array( "name" => "Menu font",
					"desc" => "",
					"id" => "menu_font",
					"std" => array('font' => 'Lato','color' => '#fff', 'style' => '400'),
					"fold" => "gg_font",
					"type" => "font");
					
$of_options[] = array( "name" => "Menu font (for white background page templates)",
					"desc" => "",
					"id" => "menu_font_white",
					"std" => array('font' => 'Lato','color' => '#69747f', 'style' => '400'),
					"fold" => "gg_font",
					"type" => "font");
										
$of_options[] = array( "name" => "Sidebar - Footer title font",
					"desc" => "",
					"id" => "sidebar_font",
					"std" => array('font' => 'Lato','color' => '#69747f', 'style' => '400'),
					"fold" => "gg_font",
					"type" => "font");

//Typekit
$of_options[] = array( "name" => "Enable typekit resource",
					"desc" => "Only check if you want to use font from Typekit",
					"id" => "tk_font",
					"std" => 0,
          			"folds" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => "Your Typekit ID",
					"desc" => "Ex: ID is text that bold use.typekit.net/<b>abcdefj</b>.js",
					"id" => "tk_id",
					"std" => "",
					"fold" => "tk_font",
					"type" => "text");

$of_options[] = array( "name" => "Custom heading font (H1, H2, H3, H4)",
					"desc" => "",
					"id" => "tk_heading_font",
					"std" => array('font' => 'prenton','color' => '#69747f'),
					"fold" => "tk_font",
					"type" => "typekit");

$of_options[] = array( "name" => "Custom heading font (H5, H6)",
					"desc" => "",
					"id" => "tk_heading_font_4",
					"std" => array('font' => 'prenton','color' => '#69747f'),
					"fold" => "tk_font",
					"type" => "typekit");
					
$of_options[] = array( "name" => "Menu font",
					"desc" => "",
					"id" => "tk_menu_font",
					"std" => array('font' => 'prenton','color' => '#fff'),
					"fold" => "tk_font",
					"type" => "typekit");
					
$of_options[] = array( "name" => "Menu font (for white background page templates)",
					"desc" => "",
					"id" => "tk_menu_font_white",
					"std" => array('font' => 'proxima-nova','color' => '#69747f'),
					"fold" => "tk_font",
					"type" => "typekit");
										
$of_options[] = array( "name" => "Sidebar - Footer title font",
					"desc" => "",
					"id" => "tk_sidebar_font",
					"std" => array('font' => 'prenton','color' => '#69747f'),
					"fold" => "tk_font",
					"type" => "typekit");


$of_options[] = array( "name" => "Enable google webfont for body font",
					"desc" => "Only check if you want to use font from Google webfont",
					"id" => "gg_body_font",
					"std" => 1,
          			"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => "Body Font",
					"desc" => "Specify the body font properties",
					"id" => "body_font",
					"std" => array('size' => '14px','face' => 'Open Sans','style' => 'normal','color' => '#929da8'),
					"fold" => "gg_body_font",
					"type" => "typography");
					
					
$of_options[] = array( "name" => "Enable typekit webfont for body font",
					"desc" => "Only check if you want to use font from Typekit webfont",
					"id" => "typekit_body_font",
					"std" => 0,
          			"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => "Body Font",
					"desc" => "Specify the body font properties",
					"id" => "tk_body_font",
					"std" => array('size' => '14px','face' => 'prenton','style' => '400','color' => '#929da8'),
					"fold" => "typekit_body_font",
					"type" => "tk_typography");

$of_options[] = array( "name" => "Footer background color",
					"desc" => "Footer background color (default #eef4f9)",
					"id" => "theme_color_1",
					"std" => "#eef4f9",
					"type" => "color");

$of_options[] = array( "name" => "Bottom background color",
					"desc" => "Bottom background color (default #fff)",
					"id" => "theme_color_2",
					"std" => "#fff",
					"type" => "color");
					
$of_options[] = array( "name" => "Color scheme",
					"desc" => "Your main color (default #7199c8)",
					"id" => "color_scheme",
					"std" => "#7199c8",
					"type" => "color");

$of_options[] = array( "name" => "Alternate color scheme",
					"desc" => "Your main color (default #85a5cc)",
					"id" => "color_scheme_alt",
					"std" => "#85a5cc",
					"type" => "color");
					
$of_options[] = array( "name" => "Footer text color",
					"desc" => "Your footer text color (default #919cab)",
					"id" => "footer_color",
					"std" => "#919cab",
					"type" => "color");

$of_options[] = array( "name" => "Custom CSS",
					"desc" => "Your custom CSS",
					"id" => "custom_css",
					"std" => "",
					"type" => "textarea");

//Sidebar Settings

$of_options[] = array( "name" => "Sidebar Settings",
					"type" => "heading");

$of_options[] = array( "name" => "Sidebar Options",
					"desc" => "",
					"id" => "sidebar_options",
					"std" => "",
					"type" => "sidebar");

//Blog Settings

$of_options[] = array( "name" => "Blog Settings",
					"type" => "heading");

$of_options[] = array( "name" => "Single post top image",
					"desc" => "Display the top image in single post",
					"id" => "top_image",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => "Single with left sidebar",
					"desc" => "Display the sidebar on the left in single post",
					"id" => "single_left",
					"std" => 0,
					"type" => "checkbox");

//Portfolio Settings

$of_options[] = array( "name" => "Portfolio Settings",
					"type" => "heading");

$of_options[] = array( "name" => "Portfolio featured images resizing",
					"desc" => "Only check if you want a custom size for portfolio featured images",
					"id" => "port_resize",
					"std" => 0,
          			"folds" => 1,
					"type" => "checkbox");    

$of_options[] = array( "name" => "Width",
					"desc" => "Set width for image",
					"id" => "resize_option_1",
					"std" => "460",
          			"fold" => "port_resize", /* the checkbox hook */
					"type" => "text");
					
$of_options[] = array( "name" => "Height",
					"desc" => "Set height for image",
					"id" => "resize_option_2",
					"std" => "340",
          			"fold" => "port_resize", /* the checkbox hook */
					"type" => "text");

$of_options[] = array( "name" => "Portfolios per page",
					"desc" => "Enter the number of Portfolio per page",
					"id" => "portfolio_page",
					"std" => "12",
					"type" => "select",
					"options" => $other_entries);

$of_options[] = array( "name" => "Single portfolio",
					"desc" => "Display related portfolios",
					"id" => "related_portfolio",
					"std" => 1,
					"type" => "checkbox");

//SEO

$of_options[] = array( "name" => "SEO",
					"type" => "heading");

$of_options[] = array( "name" => "Meta description",
					"desc" => "Enter your meta description",
					"id" => "meta_description",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => "Meta keyword",
					"desc" => "Enter your meta keywords",
					"id" => "meta_keyword",
					"std" => "",
					"type" => "textarea");					

$of_options[] = array( "name" => "Meta author",
					"desc" => "Enter your meta author",
					"id" => "meta_author",
					"std" => "",
					"type" => "textarea");

//Footer Settings

$of_options[] = array( "name" => "Footer Settings",
					"type" => "heading");

$of_options[] = array( "name" => "Footer Logo",
					"desc" => "Your footer logo upload here",
					"id" => "footer_upload",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => "Copyright text",
					"desc" => "Enter the text for your copyright",
					"id" => "copyright_text",
					"std" => "Copyright&copy; 2012 concept7. All right reserved.",
					"type" => "text");

$of_options[] = array( "name" => "Bottom Menu",
					"desc" => "Display the bottom menu",
					"id" => "bottom_menu",
					"std" => 1,
					"type" => "checkbox");
					
// Backup Options
$of_options[] = array( "name" => "Backup Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
	}
}
?>
