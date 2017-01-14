<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <?php global $etheme_responsive, $woocommerce;; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <?php if($etheme_responsive): ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <?php endif; ?>
	<link rel="shortcut icon" href="<?php etheme_option('favicon',true) ?>" />
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
			echo ' | ' . sprintf( __( 'Page %s', ETHEME_DOMAIN ), max( $paged, $page ) );
		?></title>
        <!--[if IE 9]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri().'/css/'; ?>ie9.css"><![endif]-->
		<?php
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );
			wp_head();
		?>
</head>
<body>
    <div class="new-wrapper">
	<?php if(etheme_get_option('mobile_loader')): ?>
		<div class="mobile-loader hidden-desktop">
			<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>
                        <h5><?php _e('Loading the content...', ETHEME_DOMAIN); ?></h5>
		</div>
	<?php endif; ?>
        <header class="site-header">
            <div class="center-wrap clearfix">
                <div class="logo">
                    <a href="<?php echo site_url(); ?>" alt="<?php print get_bloginfo('name') .' - '. get_bloginfo('description'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-new.png"/>
                    </a>
                </div>
                <div class="header-right">
                    <?php dynamic_sidebar('header-section'); ?>
                </div>                                
            </div> 
        </header>
        <nav class="nav-primary">
            <div class="center-wrap">
                <?php wp_nav_menu( array('menu' => 'New Menu' )); ?>
                <div class="search-bar">
                    <form role="search" method="get" class="search-form" action="<?php echo site_url();?>">
                        <div class="input-group">
                            <span class="input-group-btn" id="btn-search">
                            <div class="btn btn-search"><i class="fa fa-search search-ico"></i></div>
                            </span>
                            <input type="search" class="search-field unhovered" id="box-search" placeholder="Search" name="s" />
                        </div>
                    </form>
                </div>
            </div>
        </nav>       
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('#btn-search').click(function(){
	
    jQuery('#box-search').css('border-color', '#aaa').animate({
        'width' : 300
    }, 300).focus().queue(function(){
			jQuery(this).addClass('toggled'); 
			jQuery(this).dequeue();
		});
});
});

// Once opened, check to see if the user isn't hovered or clicking the text field, and then don't do anything like close it
jQuery('#box-search').hover(
  function() {
    jQuery(this).removeClass('unhovered');
  }, function() {
    jQuery(this).addClass('unhovered');
  }
);

// If the user is not hovered over the open text field, and they click, go ahead and close it
jQuery(document).click(function(){
	if(jQuery('#box-search').hasClass('toggled') && jQuery('#box-search').hasClass('unhovered')) {
		jQuery('#box-search').animate({
				'width' : 0
		}, 300).css('border-color', 'transparent').queue(function(){
			jQuery(this).removeClass('toggled'); 
			jQuery(this).dequeue();
		});;  
	}
});
</script>