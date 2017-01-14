<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="google-site-verification" content="MrPt-D7OWUBNhWW5ysthSiQ1VKdG6_056QXZ-BUhGB8" />
<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' /> 

<title><?php elegant_titles(); ?></title>
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href='http://fonts.googleapis.com/css?family=Covered+By+Your+Grace|Oxygen:400,700,300' rel='stylesheet' type='text/css'>

<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie6style.css" />
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('img#logo, #header #search-form, #slogan, a#left_arrow, a#right_arrow, div.slide img.thumb, div#controllers a, a.readmore, a.readmore span, #services .one-third, #services .one-third.first img.icon, #services img.icon, div.sidebar-block .widget ul li');</script>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie7style.css" />
<![endif]-->

<script type="text/javascript">
	document.documentElement.className = 'js';
</script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body <?php body_class(); ?> ><div class="nav-banner">&nbsp;</div>
	<div class="wrapper">
	<div id="page-wrap">
			
		<div id="header">
				<div class="clear"></div>
				
				<?php $menuClass = 'superfish nav clearfix';
				$primaryNav = '';
				
				if (function_exists('wp_nav_menu')) {
					$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'echo' => false ) );
				};
				if ($primaryNav == '') { ?>
					<ul class="<?php echo $menuClass; ?>">
						<?php if (get_option('minimal_home_link') == 'on') { ?>
							<li <?php if (is_front_page()) echo('class="current_page_item"') ?>><a href="<?php bloginfo('url'); ?>"><?php _e('Home','Minimal'); ?></a></li>
						<?php }; ?>

						<?php show_categories_menu($menuClass,false); ?>
						
						<?php show_page_menu($menuClass,false,false); ?>
					</ul> <!-- end ul.nav -->
					<div id="click-menu"></div>
				<?php }
				else echo($primaryNav); ?>
			<!-- Start Logo -->
				<a href="<?php bloginfo('url'); ?>" class="logo"><?php $logo = (get_option('minimal_logo') <> '') ? get_option('minimal_logo') : get_bloginfo('template_directory').'/images/logo.png'; ?>
					<img src="<?php echo $logo; ?>" alt="Logo" id="logo"/>
				</a>
				<div class="socialicons">
					<a href="https://www.facebook.com/MarkCollinsNZ?sk=wall" target="_blank"><img src="<?php echo get_bloginfo('template_directory')?>/images/facebook.png" alt="facebook"></a>
					<a href="https://twitter.com/markcollinsnz" target="_blank"><img src="<?php echo get_bloginfo('template_directory')?>/images/twitter.png" alt="twitter"></a>
					<a href="http://www.linkedin.com/pub/mark-collins/15/739/348" target="_blank"><img src="<?php echo get_bloginfo('template_directory')?>/images/linkedin.png" alt="linkedin"></a>
					<a href="https://www.youtube.com/channel/UCr0gUo0Jwe0z0KeJK8rt9Nw" target="_blank"><img src="<?php echo get_bloginfo('template_directory')?>/images/youtube.png" alt="youtube"></a>
					<p><span>Phone</span> 027 534 0860</p>
				</div>
					
			<!-- End Logo -->						
		</div> <!-- end #header -->

		