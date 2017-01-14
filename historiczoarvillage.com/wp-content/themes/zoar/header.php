<?php

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="main">

 *

 * @package WordPress

 * @subpackage Twenty_Ten

 * @since Twenty Ten 1.0

 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php

	/*

	 * Print the <title> tag based on what is being viewed.

	 */

	global $page, $paged;



	wp_title( '|', true, 'right' );



	// Add the blog name.

	bloginfo( 'name' );



	// Add the blog description for the home/front page.

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )

		echo " | $site_description";



	// Add a page number if necessary:

	if ( $paged >= 2 || $page >= 2 )

		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );



	?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />



<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/tour-style.css" type="text/css" media="screen" />

    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.3.1.min.js"></script>

    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.betterTooltip.js"></script>

    <script type="text/javascript">

		$(document).ready(function(){

			$('.tTip').betterTooltip({speed: 150, delay: 300});

		});

	</script>



<?php

	/* We add some JavaScript to pages with the comment form

	 * to support sites with threaded comments (when in use).

	 */

	if ( is_singular() && get_option( 'thread_comments' ) )

		wp_enqueue_script( 'comment-reply' );



	/* Always have wp_head() just before the closing </head>

	 * tag of your theme, or you will break many plugins, which

	 * generally use this hook to add elements to <head> such

	 * as styles, scripts, and meta tags.

	 */

	wp_head();

?>

</head>



<body <?php body_class(); ?>>
<a name="top"></a>
<div id="wrapper" class="hfeed">
	<div id="header">
      <div id="header-wrap">
		<div class="logo">
          <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		  <img src="<?php bloginfo( 'template_url' ); ?>/images/logo.png" /></a>
        </div>
        <div id="header-right">
         <div class="ohio-logos">
          <?php dynamic_sidebar('header-right-ohio-logo');?>
          </div>
           <div class="clear"></div>
          <div id="search_fix">
            <div class="social_icon">
               <a class="facebook" target="_blank" href="https://www.facebook.com/pages/Zoar-Community-Association/69911062658"></a>
               <a class="twitter" target="_blank" href="https://twitter.com/zoarohio"></a>
               <a class="tube" target="_blank" href="#"></a>
            </div>
            <div class="search_box">
			   <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                   <label class="screen-reader-text" for="s">Search for:</label>
                   <input type="text" value="Search this website..." name="s" id="s" onFocus="this.value=''" 

                   onBlur="this.value=(this.value!='') ? this.value : 'Search this website...'" />
                   <input type="submit" id="searchsubmit" value="Search" />
                </form>
            </div>

           <div class="clear"></div>
          </div><!-- #search_fix -->
        </div><!-- #header-right-->
        <div class="clear"></div>
        </div><!-- #header-wrap-->
        <?php wp_nav_menu( array( 'container_class' => 'menubar', 'theme_location' => 'primary' ) ); ?>
        <div class="blank_bg"></div>
	</div><!-- #header -->
	<div id="main">