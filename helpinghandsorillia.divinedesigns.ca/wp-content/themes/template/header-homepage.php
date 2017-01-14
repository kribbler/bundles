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
	

	<div class="page-wrapper">
	<div id="content">
		<!-- Content Goes here-->