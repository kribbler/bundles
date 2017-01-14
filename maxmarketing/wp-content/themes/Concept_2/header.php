<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<?php global $concept7_data; ?>
	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?><?php
				if(is_front_page()) echo ' - ' .get_bloginfo('description');
				else echo wp_title(); ?>
    </title>
    <link rel="icon" type="image/png" href="<?php echo $concept7_data['custom_favicon']; ?>" />
	<meta name="description" content="<?php echo $concept7_data['meta_description']; ?>">
    <meta name="keywords" content="<?php echo $concept7_data['meta_keyword']; ?>">
	<meta name="author" content="<?php echo $concept7_data['meta_author']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo $concept7_data['custom_favicon']; ?>">
	<link rel="apple-touch-icon" href="<?php echo $concept7_data['touch_icon']; ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $concept7_data['touch_icon_72']; ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $concept7_data['touch_icon_144']; ?>">
	<?php if($concept7_data['tk_font']) {
        echo '<script type="text/javascript" src="//use.typekit.net/'.$concept7_data['tk_id'].'.js"></script>
                <script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
        }?>
<?php wp_head(); ?>
</head>
<!--?php if($_GET["layout"] == 'white') $concept7_data['site_layout'] = 'white'; else $concept7_data['site_layout'] = ''; ?>-->
<?php if(!is_page_template('template-rev.php') && !is_page_template('template-ls.php') && $concept7_data['site_layout'] == 'white') $classes = 'white-layout'; else $classes = '';?>
<body <?php body_class($classes); ?>>
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
        <h3>Menu</h3>
        <?php
			wp_nav_menu(array( 
				'container' => false,
				'container_class' => '',
				'menu_class' => 'mobile-nav',
				'theme_location' => 'main nav',
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'fallback_cb' => false
			));
			
		?>
    </nav>
	<div id="ontop">
        <div class="container">
            <div class="row">
                <div class="top-info-wrapper">
                    <div id="logo" class="pull-left">
                         <a href="<?php echo home_url(); ?>">
                            <?php 
								if(!is_page_template('template-rev.php') && !is_page_template('template-ls.php') && (is_page_template('template-white-rev.php') || $concept7_data['site_layout'] == 'white')){
									if($concept7_data['logo_alt_upload']){
										echo '<div class="logo-wrapper" style="width:'.$concept7_data['logo_width'].'px; top: '.$concept7_data['logo_top'].'px; left:'.$concept7_data['logo_left'].'px;"><img src="'.$concept7_data['logo_alt_upload'].'" alt="'.get_bloginfo( 'name' ).'" /></div>';
									}
								}else{
									if(trim($concept7_data['logo_upload']) != ''){
										echo '<div class="logo-wrapper" style="width:'.$concept7_data['logo_width'].'px; top: '.$concept7_data['logo_top'].'px; left:'.$concept7_data['logo_left'].'px;"><img src="'.$concept7_data['logo_upload'].'" alt="'.get_bloginfo( 'name' ).'" /></div>';
									}else{
                            ?>
                            	<div class="logo-wrapper">
                            		<div class="logo-symbol pull-left"><i class="icon-bolt"></i></div>
                            		<h3 class="font-700">Concept II.</h3>
                          	</div>
                            <?php }} ?>
                         </a>
                    </div>
                    <div id="showLeftPush" class="btn-collapse">
                        <i class="icon-list"></i>
                    </div>
                    <div class="nav-wrapper pull-right hidden-phone">
                    	<div class="navbar navbar-inverse">
                        <div class="navbar-inner">
                            <div class="nav-collapse">
                            <?php
                                wp_nav_menu(array( 
                                    'container' => false,
                                    'container_class' => 'menu',
                                    'menu_class' => 'nav',
                                    'theme_location' => 'main nav',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'fallback_cb' => false,
                                    'walker' => new top_bar_walker()
                                ));
                                
                            ?>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
         
    </div>
    <div class="clearfix"></div>
    <?php if(!is_page_template('template-ls.php') && !is_page_template('template-rev.php') && !is_page_template('template-white-rev.php')) get_template_part('slider') ?>
    <div class="clearfix"></div>
    <?php  
		if(!is_page_template('template-blog-classic.php') && !is_archive() && !is_404() && !is_search() && !is_page_template('template-blog-medium.php') && !is_singular('post')){
			echo '<style>.sidebar-circle, .sidebar-arrow {display:none !important;} .sidebar-content {margin-left:40px; padding-right:0;}</style>';
		}
	?>
   