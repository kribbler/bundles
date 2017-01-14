<!DOCTYPE html>
<html>
<head>
	<title><?php bloginfo('name');?> &raquo; <?php echo (wp_title('')=="" && (is_front_page() || is_home())) ? bloginfo('description') : wp_title(''); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<?php wp_head();?>
</head>
<body <?php body_class();?>>
<div id="wrapper">
	<div class="page-wrapper container">
		<div class="header-wrapper header-type-2">
			<div class="container">
				<div class="row-fluid">
					<div class="span4">
						<a href="<?php echo site_url();?>/">
							<img id="header_logo_img" src="<?php echo get_template_directory_uri();?>/images/logo.png" title="<?php echo get_bloginfo('name');?>" alt="" />
						</a>
					</div>
					<div class="span8">
						<a class="accessibility" href="<?php echo site_url();?>/accessibility/">Accessibility</a>&nbsp;
						<div class="text_resize" id="text_size1">A</div>
						<div class="text_resize" id="text_size2">A</div>
						<div class="text_resize" id="text_size3">A</div>
						<div class="clear"></div>
						<div id="header_phone">705 325 7861</div>
						<div id="header_ex">*After hours calls are monitored</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<div id="header">

			<div id="menu" role="navigation">
				<div class="page-wrapper___ container">
					<?php /*

					Allow screen readers / text browsers to skip the navigation menu and
					get right to the good stuff. */ ?>

					<div class="skip-link screen-reader-text">
						<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>">
						<?php _e( 'Skip to content', 'twentyten' ); ?></a>
					</div>
					<nav><?php wp_nav_menu(array(
								'theme_location' => 'main',
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 4,
								'fallback_cb' => false,
								'walker' => new Et_Navigation

					)); ?>
					</nav>
					<?php
					/*
						wp_nav_menu( 
							array( 
								'container_class' => 'navigation', 
								'menu_class' => 'nav-menu',
								'theme_location' => 'main',
								'after' => '<li class="menu-divider">//</li>',
								'walker' => new Walker_Nav_Menu(),
								'depth' => 2
						 ) );
					*/
					?>
				</div>

			</div><!-- #menu -->
			
			<!-- Header Goes here-->
		</div>
	

	<div class="page-wrapper">
	<div id="content">
		<!-- Content Goes here-->