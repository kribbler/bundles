<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta  charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="format-detection" content="telephone=no">
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,700,800' rel='stylesheet' type='text/css'>


	<?php styles_and_scripts(); ?>

	<?php
		if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	?>
	
	<?php wp_head(); ?>
	<?php

	    if ( get_option('rtl', '') && get_option('rtl', '') == "on" ) {
	        echo '<link href="' . get_template_directory_uri() . '/css/media-queries_rtl.css" rel="stylesheet" type="text/css" >';
	        echo '<link href="' . get_template_directory_uri() . '/custom.css" rel="stylesheet" type="text/css" >';
	    }

	?>
	<!--[if lt IE 9]>
		<?php wp_enqueue_script( "respond_queries", get_template_directory_uri()  . "/js/respond.min.js" ); ?>
		
		<?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ): ?>
			<?php echo "<link href='" . ( get_template_directory_uri() . '/css/iefix_rtl.css' ) . "' rel='stylesheet' type='text/css' >"; ?>
		<?php else: ?>
			<?php echo "<link href='" . ( get_template_directory_uri() . '/css/iefix.css' ) . "' rel='stylesheet' type='text/css' >"; ?>
		<?php endif; ?>

		<style>
		.cart-wrapper .cart-contents:after {
			<?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ): ?>
				border-top: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-bottom: 8px solid #fff; border-left: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-right: 8px solid #fff;
			<?php else: ?>
				border-top: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-bottom: 8px solid #fff; border-left: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-right: 8px solid #fff;
			<?php endif; ?>
		}
		</style>
	<![endif]-->

		<!--[if IE 9]>

		<?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ): ?>
			<?php echo "<link href='" . ( get_template_directory_uri() . '/css/ie9_rtl.css' ) . "' rel='stylesheet' type='text/css' >"; ?>
		<?php else: ?>
			<?php echo "<link href='" . ( get_template_directory_uri() . '/css/iefix9.css' ) . "' rel='stylesheet' type='text/css' >"; ?>
		<?php endif; ?>

		<style>
		.cart-wrapper .cart-contents:after {
			<?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ): ?>
				border-top: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-bottom: 8px solid #fff; border-left: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-right: 8px solid #fff;
			<?php else: ?>
				border-top: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-bottom: 8px solid #fff; border-left: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-right: 8px solid #fff;
			<?php endif; ?>
		}
		</style>
	<![endif]-->

</head>

<body <?php body_class(body_class_and_style("class")); ?> <?php echo body_class_and_style("style"); ?>>

<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>

<?php if ( body_class_and_style("class") != "" ) { echo "<div class='boxed'>"; } ?>

	  <!-- Site header Start-->

      <header id="site-header">
      	<?php get_top_menu(); ?>	

        <div class="main-wrapper clearfix">

        	<?php if ( get_option('cart', '') != "on"): ?>
        		<div class="clearfix woohead">
				
<div class="cart-wrapper"><a style="float: right; text-transform: uppercase; margin-right: 130px; margin-top: 10px;" href="http://www.goutcare.co.nz/wp-login.php?action=logout&redirect_to=http://www.goutcare.net.nz/my-account">Logout</a>
<span class="loginr login-register-left right">|</span>
<a style="float: right; text-transform: uppercase; margin-right: 10px; margin-top: 10px;" title="My account" href="http://www.goutcare.co.nz/my-account/"> My account </a>
<a class="cart-contents" title="View your shopping cart" href="http://www.goutcare.co.nz/cart/">View Cart</a>
</div>
			<?php endif; ?>

			<?php get_logo(); ?>	        		

	        <!-- Main navigation Start -->
	        <div class="headertexts">
	        	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Header Texts') ) : ?>  
      			<?php endif; ?> 
	        </div>

		    <nav id="access" role="navigation" class="right font-main">

				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary') ); ?>

		    </nav>

	      	<!-- Main navigation End -->

            <?php get_mobile_menu(); ?>	

          </div>    

      </header>
	  <!-- Site header End -->
	  
	  <?php set_page_layout(); ?>
