<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta  charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="format-detection" content="telephone=no">
	
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

<?php if(!$_COOKIE["shopifiq-notification-closed"] || get_option("notification_changes") != $_COOKIE["shopifiq-notification-closed"]): ?>

	<?php if( get_option("notice-active", "") == "on" ): ?>

	    <?php if( get_option("notice-type", "off") == "off" ): ?>

	        <div id="notice-inline" class="site-notice">
				<div class="main-wrapper clearfix">

	            		<?php echo do_shortcode(get_option("notice", "")); ?>

	            	<div class="notice-close"></div>

				</div>
	        </div>
	        
	    <?php endif; ?>

	<?php endif; ?>

<?php endif; ?>

<?php if ( body_class_and_style("class") != "" ) { echo "<div class='boxed'>"; } ?>

	  <!-- Site header Start-->

      <header id="site-header">
      	<?php get_top_menu(); ?>	

        <div class="main-wrapper clearfix">

        	<?php if ( get_option('cart', '') != "on"): ?>
	        	<div class="clearfix woo-header-wrapper">
	        		<div class="woo-header">
						<?php get_wooHeader(); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="logo-and-nav">

				<?php get_logo(); ?>	     

		        <!-- Main navigation Start -->

			    <nav id="access" role="navigation" class="right font-main">

					<?php //wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary') ); ?>

					<?php
						$locations = get_theme_mod('nav_menu_locations');

						wp_nav_menu( array(
						 'container' => false,
						 'menu_class' => 'nav',
						 'echo' => true,
						 'before' => '',
						 'after' => '',
						 'link_before' => '',
						 'link_after' => '',
						 'depth' => 0,
						 'walker' => new description_walker(),
						 'menu'=>$locations['primary']
						 ));
					?>

			    </nav>

		      	<!-- Main navigation End -->

	            <?php get_mobile_menu(); ?>

            </div>

          </div>    

      </header>
	  <!-- Site header End -->

	  <?php set_page_layout(); ?>
