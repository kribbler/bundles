<?php header("Content-type: text/css"); ?>
<?php
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
?>
<?php global $concept7_data; ?>
<?php 
	$h1 = ''; $h1_color = ''; $h1_weight = '300';
	$h5 = ''; $h5_color = ''; $h5_weight = '400';
	$menu_font = ''; $menu_font_white = ''; $menu_font_color = ''; $menu_font_white_color = ''; $menu_font_weight = '400'; $menu_font_white_weight = '400';
	$sidebar_font = ''; $sidebar_font_color = ''; $sidebar_font_weight = '400';
	$body_font = ''; $body_font_color = ''; $body_font_size = '';
	$concept7_data['heading_font']['font'] = trim($concept7_data['heading_font']['font']);
	$concept7_data['heading_font_4']['font'] = trim($concept7_data['heading_font_4']['font']);
	$concept7_data['menu_font']['font'] = trim($concept7_data['menu_font']['font']);
	$concept7_data['menu_font_white']['font'] = trim($concept7_data['menu_font_white']['font']);
	$concept7_data['sidebar_font']['font'] = trim($concept7_data['sidebar_font']['font']);
	$concept7_data['body_font']['face'] = trim($concept7_data['body_font']['face']);
	if ($concept7_data['gg_font']){
		$h1 = $concept7_data['heading_font']['font'];
		$h1_color = $concept7_data['heading_font']['color'];
		$h1_weight = $concept7_data['heading_font']['style'];
		$h5 = $concept7_data['heading_font_4']['font'];
		$h5_color = $concept7_data['heading_font_4']['color'];
		$h5_weight = $concept7_data['heading_font_4']['style'];
		
		$menu_font = $concept7_data['menu_font']['font'];
		$menu_font_color = $concept7_data['menu_font']['color'];
		$menu_font_weight = $concept7_data['menu_font']['style'];
		
		$menu_font_white = $concept7_data['menu_font_white']['font'];
		$menu_font_white_color = $concept7_data['menu_font_white']['color'];
		$menu_font_white_weight = $concept7_data['menu_font_white']['style'];
		
		$sidebar_font = $concept7_data['sidebar_font']['font'];
		$sidebar_font_color = $concept7_data['sidebar_font']['color'];
		$sidebar_font_weight = $concept7_data['sidebar_font']['style'];
	}
	if ($concept7_data['tk_font']){
		$h1 = $concept7_data['tk_heading_font']['font'];
		$h1_color = $concept7_data['tk_heading_font']['color'];
		$h5 = $concept7_data['tk_heading_font_4']['font'];
		$h5_color = $concept7_data['tk_heading_font_4']['color'];
		$menu_font = $concept7_data['tk_menu_font']['font'];
		$menu_font_color = $concept7_data['tk_menu_font']['color'];
		$menu_font_white = $concept7_data['tk_menu_font_white']['font'];
		$menu_font_white_color = $concept7_data['tk_menu_font_white']['color'];
		$sidebar_font = $concept7_data['tk_sidebar_font']['font'];
		$sidebar_font_color = $concept7_data['tk_sidebar_font']['color'];
	}
	if ($concept7_data['gg_body_font']){
		$body_font = trim($concept7_data['body_font']['face']);
		$body_font_color = $concept7_data['body_font']['color'];
		$body_font_size = $concept7_data['body_font']['size'];
		$body_font_weight = $concept7_data['body_font']['style'];
	}
	if ($concept7_data['typekit_body_font']){
		$body_font = trim($concept7_data['tk_body_font']['face']);
		$body_font_color = $concept7_data['tk_body_font']['color'];
		$body_font_size = $concept7_data['tk_body_font']['size'];
		$body_font_weight = $concept7_data['tk_body_font']['style'];
	}

?>
<?php echo'
h1, h2, h3, h4, h1 span, h2 span, h3 span, h4 span, h1 a, h2 a, h3 a, h4 a, .logo h1 span, #team .team-info .team-name, .recent-post-wrapper h4 a
{
	font-family:"'.$h1.'", "Helvetica Neue", Helvetica, arial !important;
	color: '.$h1_color.';
	font-weight:'.$h1_weight.';
}
'; 
?>

<?php echo'
h5, h6, h5 a, h6 a, .sidebar-item-box h5 a, .tabs-left > .nav-tabs > li.active > a, #team .team-info .team-position
{
	font-family:"'.$h5.'", "Helvetica Neue", Helvetica, arial !important;
	color: '.$h5_color.';
	font-weight:'.$h5_weight.';
}
.column-section-color .testimonial-normal h5, .page-template-template-white-rev-php .btn-collapse i, .white-layout .btn-collapse i, .accordion-heading .accordion-toggle{
	color: '.$h5_color.';
}
.tabs-left > .nav-tabs > li > a, ul.post-nav-link li a, ul#sub-menu-page li a, ul.post-nav-link li a, ul.subpage-container li.subpage-content a{
	font-family:"'.$h5.'", "Helvetica Neue", Helvetica, arial !important;
}
';

?>

<?php echo'
.navbar .nav > li > a, .navbar .nav ul a, .navbar-search .search-query
{
	font-family:"'.$menu_font.'", "Helvetica Neue", Helvetica, arial !important;
}
.top-bar .has-dropdown > a:after{
	border-color: '.$menu_font_color.'  transparent transparent transparent;
}
.navbar-search i, .tabs-left > .nav-tabs > li.active > p
{
	color: '.$menu_font_color.' !important;
}
input::-webkit-input-placeholder
{
	color: '.$menu_font_color.';
	text-transform:uppercase;
	padding-top:2px;
}
.navbar .nav ul a:hover , .navbar-inverse .nav > li > a:focus, .navbar-inverse .nav > li > a:hover{
	color:#fff;
    color: '.$menu_font_color.';
}
';
?>

<?php echo'
.sidebar-box h4.blog-sidebar-title span, h4.footer-heading span
{
	font-family:"'.$sidebar_font.'", "Helvetica Neue", Helvetica, arial !important;
	color: '.$sidebar_font_color.' !important;
	font-weight:'.$sidebar_font_weight.';
}
'; 
?>

<?php echo'
*, body
{
	color: '.$body_font_color.';
	font-family: "'.$body_font.'";
	font-size: '.$body_font_size.';
	font-weight: '.$body_font_weight.';
	line-height:1.55;
	-webkit-font-smoothing: antialiased;
}
p, .meta span, .comment-meta h4 span,blockquote p, h6.medium-more a, .footer-nav li a
{
	font-family: "'.$body_font.'", "Helvetica Neue", Helvetica, arial !important;
	color: '.$body_font_color.';
	font-size: '.$body_font_size.';
	line-height:1.55;
}
#testimonial-normal .testimonial-normal-position .position{
	font-family: "'.$body_font.'", "Helvetica Neue", Helvetica, arial !important;
	color: '.$body_font_color.';
}
#team .team-content p,.team-mail, .sidebar-box h4.blog-sidebar-title, .recent-post-wrapper a.cat-link, .recent-post-meta *,.related-post-title .sidebar-item-category a:hover,#testimonial-normal .testimonial-normal-content i,.column-section-color #testimonial-normal .testimonial-normal-content p,#testimonial-normal .testimonial-normal-author h5,.column-section-color .testimonial-normal p, .column-section-color .testimonial-normal i{
	color: '.$body_font_color.' !important;
}
a{
	-webkit-transition: all 0.1s ease-in-out;
	-moz-transition: all 0.1s ease-in-out;
	transition: all 0.1s ease-in-out;
	color: '.$body_font_color.';
}
a:hover, a:focus, .recent-post-wrapper h4 a:hover{
	color: '.$concept7_data['color_scheme'].';
}
.aq_block_toggle h2.tab-head, .aq_block_accordion h2.tab-head, .aq_block_toggle h2.tab-head i, .aq_block_accordion h2.tab-head i, .portfolio-button:hover{
	color: '.$h5_color.';
}
'; 
?>

<?php echo'
ol, ul, p, .blog-masonry-description p, .twtr-tweet-text p, #footer-nav li a, .wp-caption p.wp-caption-text, .twt-border .twt-tweet .entry-title, .twt-border .twt-o .entry-title a, .twt-border .twt-o .entry-title b, #details h5 span, .service-1 p, .service-2 p, .textwidget, .post-sc-content
{
	font-size: '.$body_font_size.';
}
'; 
?>

<?php echo'
h2.intro p, #nav > li a span, a.rev, .banner-container .container > p, #testimonial .flex-direction-nav a i, .page-template-template-white-rev-php .custom-search .menu-search-form .menu-search-form-input,
.white-layout .custom-search .menu-search-form .menu-search-form-input
{
	color: '.$body_font_color.';
}

'; 

?>

<?php echo'
body{
	background: url(../images/body-bg-red-new.jpg) '.$concept7_data['color_scheme'].';
	color: '.$body_font_color.';
	text-shadow:0px 1px 0px rgba(0,0,0,.03);
}
#footer-wrapper{
	background: '.$concept7_data['theme_color_1'].';
}
.footer-bottom{
	background: '.$concept7_data['theme_color_2'].';
}
.MailPressFormEmail, .MailPressFormName{
	background: rgba(255,255,255,.4) !important;
	color: '.$concept7_data['body_font']['color'].';
}
.navbar .nav > li ul{
	background: url(../images/overlay.png) '.$concept7_data['color_scheme'].';
}
.page-template-template-white-rev-php  .navbar .nav > li ul,
.white-layout  .navbar .nav > li ul{
	background-image: none;
	background-color: #fff !important;
}
#nav-bar, .logo-symbol, .sidebar-circle, .cbp-spmenu h3, .pricing-column ul li.pricing-title
{
	background: '.$concept7_data['color_scheme'].';
	*background: '.$concept7_data['color_scheme'].';
}
.btn.no_colored_bg, input[type="submit"]{
	background-color: '.$concept7_data['color_scheme'].';
}
.tag-wrapper a, .tagcloud a:hover  {
	border-color: '.$concept7_data['color_scheme'].';
}
.flex-direction-nav a:hover, #testimonial .flex-direction-nav a:hover{
	background: '.$concept7_data['color_scheme'].' !important;
}
.sidebar-arrow:after, #team .team-img .team-img-line:after{
	border-right-color: '.$concept7_data['color_scheme'].';
}
#team.team-even .team-img .team-img-line:after{
	border-left-color: '.$concept7_data['color_scheme'].';
}
.intro-bg, .map-wrapper-bg, .tabs-left > .nav-tabs, .portfolio-item div.da-animate, .progress-bar ul li span.percent, .timeline, .time-wrapper h4, .history-btn-rounded, .portfolio-1-arrow-left:hover, .portfolio-1-arrow-right:hover, .recent-1-arrow-left:hover, .recent-1-arrow-right:hover, .flex-direction-nav a:hover{
	background: '.$concept7_data['color_scheme'].';
}
.ls-fullwidth .ls-nav-prev, .ls-fullwidth .ls-nav-next, .bg-colored
{
	background-color: '.$concept7_data['color_scheme'].' !important;
}
.colored, .post-content-meta-category a:hover,#portfolio-filter .filter-option .filterable.current a, #portfolio-filter .filter-option .filterable.current a:hover, .filter-option .filterable.current a:focus, code, ul.list_wrap li i, body.page-template-template-sitemap-php #page-content i, body.error404 #page-content i, .aq-block-aq_column_block .progress-bar ul li span.title, .team-mail:hover, .media-icon i,.portfolio-item div.da-animate a i, ul.subpage-container li.subpage-content a,#testimonial-normal .testimonial-normal-position .name{
	color: '.$concept7_data['color_scheme'].' !important;
}
.jcarousel-next-horizontal, .jcarousel-prev-horizontal, .button-slider, .se-next,.se-prev, #xxx, .ontop-bg, .mi-slider nav span.mi-selected a,.contact-info i,.recent-post-wrapper-2 .da-animate
{
	background-color:'.$concept7_data['color_scheme'].' !important;
}
.boxed-wrapper{
	border-top:8px solid '.$concept7_data['color_scheme_alt'].';
}
#page-info-section, .navbar .nav > li.custom-search a, .navbar .nav > li.custom-search a:hover, .navbar .nav > li.custom-search-gradient a:hover, .custom-search .menu-search-form, ul.subpage-container li.subpage-content a i, body.white-layout #page-info-section{
	background-color:'.$concept7_data['color_scheme_alt'].';
}
#footer-wrapper, #footer-wrapper .textwidget, #footer-wrapper a, #footer-wrapper p, #footer-wrapper span, #footer-wrapper time, #footer-wrapper i, .footer-bottom *{
	color:'.$concept7_data['footer_color'].'; 
}
@media (max-width: 979px){
	#ontop{
		background-color: '.$concept7_data['color_scheme'].';
	}
}
.page-template-template-white-rev-php .navbar .nav > li.custom-search a, .page-template-template-white-rev-php .navbar .nav > li.custom-search a i,
.white-layout .navbar .nav > li.custom-search a, .white-layout .navbar .nav > li.custom-search a i{
	background:none; 
	color:'. $concept7_data['color_scheme'].' !important; 
	-webkit-box-shadow:none; -
	moz-box-shadow:none; 
	box-shadow:none; 
	text-shadow:none;
}
';
$rgb = hex2rgb($concept7_data['color_scheme_alt']);
$rgb1 = hex2rgb($concept7_data['color_scheme']);
$rgb2 = hex2rgb($body_font_color);
$rgb3 = hex2rgb($menu_font_white_color);
$rgb4 = hex2rgb($menu_font_color);


echo '
	.page-template-template-white-rev-php .nav-wrapper a, .page-template-template-white-rev-php .nav-wrapper a:hover,
	.white-layout .nav-wrapper a, .white-layout .nav-wrapper a:hover{
		color:'.$menu_font_white_color.' !important;
	}
	.page-template-template-white-rev-php .navbar .nav > li ul > li a,
	.white-layout .navbar .nav > li ul > li a{
		color: rgba('.$rgb3[0].','.$rgb3[1].','.$rgb3[2].',.8) !important;
	}
	.page-template-template-white-rev-php .navbar-inverse .nav > .active > a, .page-template-template-white-rev-php .navbar-inverse .nav > .active > a:hover, .page-template-template-white-rev-php .navbar-inverse .nav > .active > a:focus, .page-template-template-white-rev-php .navbar .nav > li ul,
	.white-layout .navbar-inverse .nav > .active > a, .white-layout .navbar-inverse .nav > .active > a:hover, .white-layout .navbar-inverse .nav > .active > a:focus, .white-layout .navbar .nav > li ul {
		border: 1px solid rgba('.$rgb3[0].','.$rgb3[1].','.$rgb3[2].',.2) !important; 
	}
	.page-template-template-white-rev-php .navbar .nav > li ul > li a,
	.white-layout .navbar .nav > li ul > li a{
		border-top: 1px solid rgba('.$rgb3[0].','.$rgb3[1].','.$rgb3[2].',.2)!important ;
	}
	.page-template-template-white-rev-php .navbar .nav > li ul > li:first-child > a,
	.white-layout .navbar .nav > li ul > li:first-child > a{
		border-top:none !important;
	}
	.page-template-template-white-rev-php .navbar-inverse .nav > li:hover > a,
	.page-template-template-white-rev-php .navbar-inverse .nav > li:focus > a,
	.white-layout .navbar-inverse .nav > li:hover > a,
	.white-layout .navbar-inverse .nav > li:focus > a{
		border: 1px solid rgba('.$rgb3[0].','.$rgb3[1].','.$rgb3[2].', 0.2) !important;
	}
	.page-template-template-white-rev-php .navbar .nav > li.custom-search a,
	.white-layout .navbar .nav > li.custom-search a{
		border:none !important
	}
	
';

echo '
	.navbar-inverse .brand,
	.navbar-inverse .nav > li > a, .navbar-inverse .nav > li > a i, .navbar .nav > li a{
		color: rgba('.$rgb4[0].','.$rgb4[1].','.$rgb4[2].',.8);
	}
	.navbar-inverse .nav > .active > a, .navbar-inverse .nav > .active > a:hover, .navbar-inverse .nav > .active > a:focus,.navbar .nav > li ul {
		border: 1px solid rgba('.$rgb4[0].','.$rgb4[1].','.$rgb4[2].',.4); 
	}
	.navbar .nav > li li a{
		border-top: 1px solid rgba('.$rgb4[0].','.$rgb4[1].','.$rgb4[2].',.2);
	}
	.navbar-inverse .nav > li:hover > a,
	.navbar-inverse .nav > li:focus > a{
		border: 1px solid rgba('.$rgb4[0].','.$rgb4[1].','.$rgb4[2].', 0.3);
	}';

echo '
.btn.no_colored_color{
	color: rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.8);
}
.btn.no_colored_color:hover{
	color: '.$concept7_data['color_scheme'].';
}
.btn.default_color{
	color: rgba('.$rgb2[0].','.$rgb2[1].','.$rgb2[2].',.8);
}
.btn.default_color:hover{
	color: '.$body_font_color.';
}
ul.subpage-container span.subpage-bg-center, .white-layout .subpage-parent{
	-webkit-box-shadow: inset 0px -2px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.2);
	-moz-box-shadow: inset 0px -2px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.2);
	box-shadow: inset 0px -2px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.2);
}
ul.subpage-container span.subpage-bg-left
{
	-webkit-box-shadow: inset -1px -2px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.2);
	-moz-box-shadow: inset -1px -2px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.2);
	box-shadow: inset -1px -2px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.2);
}
ul.subpage-container span.subpage-bg-right
{
	-webkit-box-shadow: inset 1px -2px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.2);
	-moz-box-shadow: inset 1px -2px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.2);
	box-shadow: inset 1px -2px 3px rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.2);
}
ul.subpage-container span.subpage-bg-center, ul.subpage-container span.subpage-bg-left, ul.subpage-container span.subpage-bg-right,
.white-layout .subpage-parent{
	background-image: -moz-linear-gradient(bottom, rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.08) 10%, rgba(255,255,255,.08) 90%, rgba(255,255,255,0) 90%);
	background-image: -o-linear-gradient(bottom, rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.08) 10%, rgba(255,255,255,.08) 90%, rgba(255,255,255,0) 90%);
	background-image: -webkit-linear-gradient(bottom, rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.08) 10%, rgba(255,255,255,.08) 90%, rgba(255,255,255,0) 90%);
	background-image: linear-gradient(bottom, rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.08) 10%, rgba(255,255,255,.08) 90%, rgba(255,255,255,0) 90%);
}
.related-post-wrapper, .recent-post-wrapper, .recent-post-wrapper-2{
	-moz-box-shadow: 0 6px 0 -4px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
	-webkit-box-shadow: 0 6px 0 -4px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
	box-shadow: 0 6px 0 -4px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
}
.portfolio-item span img{
	-moz-box-shadow: 0 7px 0 -4px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
	-webkit-box-shadow: 0 7px 0 -4px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
	box-shadow: 0 7px 0 -4px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
}
.testimonial-normal{
	-moz-box-shadow: inset 0 1px #fff, 0 1px 2px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
	-webkit-box-shadow: inset 0 1px #fff, 0 1px 2px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
	box-shadow: inset 0 1px #fff, 0 1px 2px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
}
.triangle-topleft-backface{
	border-top: 23px solid rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
}
.btn{
	-moz-box-shadow: 0 1px 2px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
	-webkit-box-shadow: 0 1px 2px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
	box-shadow: 0 1px 2px rgba('.$rgb1[0].','.$rgb1[1].','.$rgb1[2].',.2);
}
';
?>
<?php echo $concept7_data['custom_css']; ?>
