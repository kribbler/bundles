<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @package liva
 * @since liva 1.0
 */


global $body_class;
?> 
<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
		echo ' | ' . sprintf( __( 'Page %s', 'liva' ), max( $paged, $page ) );

		?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php if (ot_get_option('favicon')) :?>
			<link rel="shortcut icon" href="<?php echo ot_get_option('favicon') ?>" type="image/x-icon" />
		<?php endif;?>
		<?php echo ot_get_option('scripts_header'); ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	  <div id="top"></div>
		<?php
		if (ot_get_option('control_panel') == 'enabled_admin' && current_user_can('manage_options') || ot_get_option('control_panel') == 'enabled_all'): ?>
			<?php get_template_part('framework/control-panel'); ?>
		<?php endif; ?>
		<div class="site_wrapper <?php echo in_array($body_class,array('b1170','b960')) ? ot_get_option('content_background_pattern') : ''; ?>">
	
<!-- HEADER -->
<header id="header">
	<?php ts_show_preheader(); ?>
    
	<div id="trueHeader">
    
		<div class="wrapper">

			<div class="container">

				<!-- Logo -->
				<div class="one_fourth">
					<?php if (ot_get_option('logo_url')): ?>
						<?php $logo = ts_get_image(ot_get_option('logo_url'), '' , esc_attr( get_bloginfo( 'name', 'display' ) )); ?>
					<?php else: ?>
						<?php $logo = '<img src="'.get_bloginfo('template_directory').'/images/logo.png" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">'; ?>
					<?php endif;?>
					<a id="logo" href='<?php echo home_url( '/' ); ?>' title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php echo $logo; ?>
					</a>
				</div>

				<!-- Menu -->
				<div class="three_fourth last"><div id="book_home"><?php dynamic_sidebar( 'header_booking' ); ?> </div>
<?php $header_menu_defaults = array(
							'container'			=> 'div',							
							'container_class' => 'header_menu',							
							'container_id'    => 'the_header_menu',							
							'theme_location'	=> 'header-menu',							
							'depth' 			=> 2,							
							'walker'			=> new liva_walker_nav_menu	,
							'items_wrap'		=> '<div id="%1$s" class="%2$s">%3$s</div>'					
							);						
					wp_nav_menu( $header_menu_defaults );    ?>
					<div id="homescope_09"><?php dynamic_sidebar( 'homescope_09' ); ?> </div>
				   <nav id="access" class="access" role="navigation">
						<?php
						
						
						$defaults = array(
							'container'			=> 'div',
							'container_class' => 'menu',
							'container_id'    => 'menu',
							'theme_location'	=> 'primary',
							'depth' 			=> 2,
							'walker'			=> new liva_walker_nav_menu
						);
						
						wp_nav_menu( $defaults ); ?>            
					</nav><!-- end nav menu -->
				</div>
			</div>

		</div>
    
	</div>
    
</header><!-- end header -->
   

<div class="clearfix"></div>

<?php  if (!get_post_meta(get_the_ID(), 'post_slider',true)):
	get_template_part( 'inc/top' );
else:
	get_template_part('inc/slider');?>
<?php endif; ?>
