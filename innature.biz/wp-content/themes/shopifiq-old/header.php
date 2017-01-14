<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
<meta name="google-site-verification" content="484MJU3mRbA0CYSp4FSzHQ2zAbrgSI6-higqt70G7Vo" />
	<meta  charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width">
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

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

<?php if ( body_class_and_style("class") != "" ) { echo "<div class='boxed'>"; } ?>

	  <!-- Site header Start-->

      <header id="site-header">
      

        <div class="main-wrapper clearfix">

        	<?php if ( get_option('cart', '') != "on"): ?>
        		<div class="clearfix">
					
<a class="mycartcheckout" href="/checkout"> Checkout </a>
<a class="login-register right" title="Login / Register" href="http://www.innature.co.nz/my-account/"> Register </a>
<span class="login-register-left right linkdivider"></span>
<a class="login-register-left right" title="Login / Register" href="http://www.innature.co.nz/my-account/"> Login </a>
<div class="cart-wrapper">
<a class="cart-contents" title="View your shopping cart" href="http://www.innature.co.nz/cart/">Cart (0)</a>
</div>

				</div>
			<?php endif; ?>

			<div class="topheader">
				<?php get_logo(); ?>	
                
                <div class="headersearch">
                    <?php get_search_form(); ?>        		
                </div>
                <br />
                <br />
                
                <div class="socialmedia">
                    <span class="facebook"><a href="http://www.facebook.com/INNATURE4you?sk=app_208195102528120" target="_blank">Facebook</a></span>
                    <span class="kiwi"><a href="http://innature.co.nz/about-us-2/">Kiwi Owned</a></span>
                    <span class="callus"><a href="tel:+64508466288">Call Us</a></span>
                    <span class="comeandvisit"><a href="http://innature.co.nz/contact/">Come and Visit</a></span>
                </div>
            </div>
	        <!-- Main navigation Start -->

		    <nav id="access" role="navigation" class="font-main">

				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary') ); ?>

		    </nav>

	      	<!-- Main navigation End -->

            <?php get_mobile_menu(); ?>	

          </div>    

      </header>
	  <!-- Site header End -->
	  
	  <?php set_page_layout(); ?>