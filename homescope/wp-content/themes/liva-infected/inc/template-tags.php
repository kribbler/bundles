<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package liva
 * @since liva 1.0
 */

/**
 * Getting google web fonts
 * @return type
 */
function ts_get_used_googe_web_fonts()
{
	$fonts = array(
		'content_font' => ot_get_option('content_font'),
		'title_font' => ot_get_option('title_font'),
		'menu_font' => ot_get_option('menu_font'),
		'headers_font' => ot_get_option('headers_font')
	);
	//get fonts from page content
	if (is_page()) {
		$page = get_page( get_the_ID() );
		preg_match_all('/google_web_font_[a-zA-Z0-9. ]*+/i',$page -> post_content,$matches);

		if (isset($matches[0]) && is_array($matches[0])) {
			foreach ($matches[0] as $font) {
				$fonts[] = $font;
			}
		}
	}

	$fonts_to_get = array();
	$fonts_to_get[] = 'Open Sans';
	$fonts_to_get[] = 'Roboto';
	$fonts_return = array();
	foreach ($fonts as $key => $font)
	{
		if (empty($font))
		{
			continue;
		}
		$tmp = $font;
		if (strstr($font,'google_web_font_'))
		{
			$tmp = str_replace('google_web_font_','',$tmp);
			$fonts_to_get[] = $tmp;
		}
		$fonts_return[$key] = $tmp;
	}

	$fonts_to_get = array_unique($fonts_to_get);

	$subset = '';
	$character_sets = ot_get_option('character_sets');
	if (is_array($character_sets) && count($character_sets) > 0) {
		$subset = '&subset=latin,'.implode(',',$character_sets);
	}

	if (count($fonts_to_get) > 0)
	{
		$protocol = is_ssl() ? 'https' : 'http';

		foreach ($fonts_to_get as $font)
		{?>
			<link href="<?php echo $protocol; ?>://fonts.googleapis.com/css?family=<?php echo urlencode($font);?>:300,400,600,700,800<?php echo $subset; ?>" rel="stylesheet" type="text/css">
		<?php
		}
	}
	return $fonts_return;
}

if ( ! function_exists( 'theme_styles' ) ) :

function theme_styles()
{
	$fonts = ts_get_used_googe_web_fonts();

	$content_font = isset($fonts['content_font']) ? $fonts['content_font'] : '';
	$title_font = isset($fonts['title_font']) ? $fonts['title_font'] : '';
	$menu_font = isset($fonts['menu_font']) ? $fonts['menu_font'] : '';
	$headers_font = isset($fonts['headers_font']) ? $fonts['headers_font'] : '';
	?>
	<style type="text/css">
		<?php if (!empty( $content_font ) && $content_font != 'default'): ?>
			.content_main p,
			.content_main a,
			.content_main ul li,
			.acc-trigger a,
			.content,
			blockquote,
			.punchline_text_box strong,
			.punch_text b,
			.punch_text02,
			.fresh_projects_list h1,
			.fresh_projects_list h2,
			.list_doted02 h5,
			.fullimage_box2 h3,
			.box_widget_full h3,
			.punch_text03 h1,
			.framed-box h3,
			.get_features_list h5,
			.icon-box3 h2,
			.icon-box4 h2,
			.icon-box2 h2,
			.icon-box5 h2,
			.icon-box h2,
			.icon-box-style2 h3,
			.fullimage_box h2,
			.arrow_sign_list h5,
			.our_team h4,
			.features_sec02 h1,
			.features_sec02 .left,
			.features_sec02 .right,
			.portfolio_page h1,
			.portfolio_page h3,
			.lirt_section li strong,
			ul.tabs-horizontal li a,
			ul.tabs-vertical li a,
			.tab-horizontal-content,
			.tab-vertical-content,
			.lirc_section h3,
			.testimonials-5 span strong,
			.testimonials-2 span strong,
			.faide_slide,
			.sidebar_widget,
			.sidebar_widget p
			{ font-family: '<?php echo $content_font; ?>'; }
		<?php endif; ?>

		<?php if (ot_get_option('content_font_size')): ?>
			.content_fullwidth p,
			.content_fullwidth a,
			.content,
			blockquote,
			.contact_info
			{ font-size: <?php echo ot_get_option('content_font_size'); ?>px; }
		<?php endif; ?>

		<?php if (!empty( $title_font ) && $title_font != 'default'): ?>
			.page_title h1, .page_title .pagenation { font-family: '<?php echo $title_font; ?>'; }
		<?php endif; ?>

		<?php if (ot_get_option('title_font_size')): ?>
			.page_title h1 { font-size: <?php echo ot_get_option('title_font_size'); ?>px; }
		<?php endif; ?>

		<?php if (!empty( $menu_font ) && $menu_font != 'default'): ?>
			#trueHeader .menu li a,
			#trueHeader .menu li ul li a
			{ font-family: '<?php echo $menu_font; ?>'; }
		<?php endif; ?>

		<?php if (ot_get_option('menu_font_size')): ?>
			#trueHeader .menu li a,
			#trueHeader .menu li ul li a
			{ font-size: <?php echo ot_get_option('menu_font_size'); ?>px; }
		<?php endif; ?>

		<?php if (!empty( $headers_font ) && $headers_font != 'default'): ?>
			.content_main h1,
			.content_main h2,
			.content_main h3,
			.content_main h4,
			.content_main h5,
			.content_main h6,
			.sidebar_title h3 {
				font-family: '<?php echo $headers_font; ?>';
			}
		<?php endif; ?>

		<?php if (ot_get_option('h1_size')): ?>
			.content_main h1 { font-size: <?php echo ot_get_option('h1_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h2_size')): ?>
			.content_main h2 { font-size: <?php echo ot_get_option('h2_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h3_size')): ?>
			.content_main h3 { font-size: <?php echo ot_get_option('h3_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h4_size')): ?>
			.content_main h4 { font-size: <?php echo ot_get_option('h4_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h5_size')): ?>
			.content_main h5 { font-size: <?php echo ot_get_option('h5_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h6_size')): ?>
			.content_main h6 { font-size: <?php echo ot_get_option('h6_size'); ?>px;}
		<?php endif; ?>

		<?php if (
				in_array(ot_get_option('body_class'),array('b1170','b960')) && (!isset($_GET['switch_layout']) || in_array($_GET['switch_layout'],array('b1170','b960'))) ||
				isset($_GET['switch_layout']) && ($_GET['switch_layout'] == 'b1170' || $_GET['switch_layout'] == 'b960') ||
				(ts_check_if_use_control_panel_cookies() && isset($_COOKIE['theme_body_class']) && in_array($_COOKIE['theme_body_class'],array('b1170','b960') ) )
			): ?>
			.b1170, .b960 {

				<?php if (isset($_GET['switch_layout']) && ($_GET['switch_layout'] == 'b1170' || $_GET['switch_layout'] == 'b960') ): ?>
					background-image: url(<?php echo get_template_directory_uri(); ?>/images/body-bg/dark_wood.png);
					background-attachment: fixed;

				<?php elseif (ts_check_if_control_panel() && isset($_COOKIE['theme_background']) && !empty($_COOKIE['theme_background'])): ?>
					background-image: url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $_COOKIE['theme_background']; ?>);
					background-repeat: no-repeat;
					background-position: center;
					background-attachment: fixed;

				<?php elseif (ot_get_option('background_pattern') == 'image' && ot_get_option('background_image') != '' ): ?>
					background-image: url(<?php echo ot_get_option('background_image'); ?>);

					<?php if (ot_get_option('background_attachment') != '' ): ?>
						background-attachment: <?php echo ot_get_option('background_attachment'); ?>;
					<?php endif; ?>

				<?php elseif (ot_get_option('background_pattern') != 'none' ): ?>
					background-image: url(<?php echo get_template_directory_uri(); ?>/images/body-bg/<?php echo ot_get_option('background_pattern'); ?>);

					<?php if (ot_get_option('background_attachment') != '' ): ?>
						background-attachment: <?php echo ot_get_option('background_attachment'); ?>;
					<?php endif; ?>

				<?php endif; ?>
				<?php if (ot_get_option('background_color') != '' ): ?>
					background-color: <?php echo ot_get_option('background_color'); ?>;
				<?php endif; ?>
				<?php if (ot_get_option('background_repeat') != '' ): ?>
					background-repeat: <?php echo ot_get_option('background_repeat'); ?>;
				<?php endif; ?>
				<?php if (ot_get_option('background_position') != '' ): ?>
					background-position: <?php echo ot_get_option('background_position'); ?> top;
				<?php endif; ?>
				<?php if (ot_get_option('background_size') == 'browser' ): ?>
					background-size: 100%;
				<?php endif; ?>
			}
		<?php endif; ?>

		<?php
		$preheader_background_color = ot_get_option('preheader_background_color');
		if ($preheader_background_color): ?>
			.top_contact_info,
			#topHeader:after
			{
				background-image: none;
				background-color: <?php echo $preheader_background_color; ?>;
				border-color: <?php echo $preheader_background_color; ?>  transparent transparent transparent;
			}
		<?php endif;

		$preheader_background_image = ot_get_option('preheader_background_image');
		if ($preheader_background_image): ?>
			.top_contact_info
			{
				background-image: url(<?php echo $preheader_background_image; ?>);
			}
		<?php endif;

		//header
		$header_background_color = ot_get_option('header_background_color');
		if ($header_background_color): ?>
			.page_title
			{
				background-image: none;
				background-color: <?php echo $header_background_color; ?>;
			}
		<?php endif;

		$header_background_image = ot_get_option('header_background_image');
		if ($header_background_image): ?>
			.page_title
			{
				background-image: url(<?php echo $header_background_image; ?>);
			}
		<?php endif;

		$header_text_color = ot_get_option('header_text_color');
		if ($header_text_color): ?>
			.page_title .title h1
			{
				color: <?php echo $header_text_color; ?>;
			}
		<?php endif;

		$header_breadcrumbs_color = ot_get_option('header_breadcrumbs_color');
		if ($header_breadcrumbs_color): ?>
			.page_title .pagenation a
			{
				color: <?php echo $header_breadcrumbs_color; ?>;
			}
		<?php endif;

		$header_breadcrumbs_active_color = ot_get_option('header_breadcrumbs_active_color');
		if ($header_breadcrumbs_active_color): ?>
			.page_title .pagenation a:hover,
			.page_title .pagenation span.current,
			.page_title .pagenation span.delimiter
			{
				color: <?php echo $header_breadcrumbs_active_color; ?>;
			}
		<?php endif;

		if (is_page()):
			$header_background_color = get_post_meta(get_the_ID(),'header_background_color',true);
			if ($header_background_color): ?>
				.page_title
				{
					background-image: none;
					background-color: <?php echo $header_background_color; ?>;
				}
			<?php endif;
			$header_background_image = get_post_meta(get_the_ID(),'header_background_image',true);
			if ($header_background_image): ?>
				.page_title
				{
					background-image: url(<?php echo $header_background_image; ?>);
				}
			<?php endif;

			$header_text_color = get_post_meta(get_the_ID(),'header_text_color',true);
			if ($header_text_color): ?>
				.page_title .title h1
				{
					color: <?php echo $header_text_color; ?>;
				}
			<?php endif;

			$header_breadcrumbs_color = get_post_meta(get_the_ID(),'header_breadcrumbs_color',true);
			if ($header_breadcrumbs_color): ?>
				.page_title .pagenation a
				{
					color: <?php echo $header_breadcrumbs_color; ?>;
				}
			<?php endif;

			$header_breadcrumbs_active_color = get_post_meta(get_the_ID(),'header_breadcrumbs_active_color',true);
			if ($header_breadcrumbs_active_color): ?>
				.page_title .pagenation a:hover,
				.page_title .pagenation span.current,
				.page_title .pagenation span.delimiter
				{
					color: <?php echo $header_breadcrumbs_active_color; ?>;
				}
			<?php endif;
		?>
		<?php endif; ?>
	</style>
	<style type="text/css" id="dynamic-styles">
		<?php ts_the_theme_dynamic_styles(false); ?>
	</style>
	<?php if (ot_get_option('custom_css')): ?>
		<style type="text/css">
			<?php echo ot_get_option('custom_css'); ?>
		</style>
	<?php endif;
}
add_action('wp_head','theme_styles');
endif;

/**
 * Display dynamic css styles, function is used when opening page and in control panel when we change colors
 * @param type $ajax_request
 */
function ts_the_theme_dynamic_styles($ajax_request = true)
{
	$main_color = ot_get_option('main_color');

	//change color if control panel is enabled
	if (ts_check_if_control_panel())
	{
		if (isset($_GET['main_color']) && !empty($_GET['main_color'])) {
			setcookie('theme_main_color', $_GET['main_color'],null,'/');
			$_COOKIE['theme_main_color'] = $_GET['main_color'];
			$main_color = $_COOKIE['theme_main_color'];
		}

		if (ts_check_if_use_control_panel_cookies() && isset($_COOKIE['theme_main_color']) && !empty($_COOKIE['theme_main_color'])) {
			$main_color = $_COOKIE['theme_main_color'];
		}
	}
	?>
	<?php if (1 == 2): //fake <style> tag, reguired only for editor formatting, please don't remove ?>
		<style>
	<?php endif; ?>

	<?php if (in_array(ot_get_option('body_class'),array('w1170','w960')) && ot_get_option('main_body_background_color')): ?>
		body {
			background: <?php echo ot_get_option('main_body_background_color'); ?>
		}
	<?php endif; ?>
	<?php if (in_array(ot_get_option('body_class'),array('b1170','b960')) && ot_get_option('main_body_background_color')): ?>
		TODO {
			background: <?php echo ot_get_option('main_body_background_color'); ?>
		}
	<?php endif; ?>

	<?php if ($main_color): ?>
		/* main_color */
		a,
		.acc-trigger a:hover,
		.acc-trigger.active a,
		.acc-trigger.active a:hover,
		.fullimage_box2 li i,
		.fullimage_box2 h3,
		.punch_text02 b,
		.icon-box2 h2,
		.icon-box5 i,
		.icon-box-style2 i,
		.icon-box-style2 a,
		.arrow_sign_list li h5,
		.arrow_sign_list li i,
		.portfolio_page h1,
		.big_text1 em,
		.big_text1 p em,
		.lirt_section li strong,
		html ul.tabs-vertical li.active,
		html ul.tabs-vertical li.active a,
		html ul.tabs-vertical li.active a:hover,
		.lirc_section li.left i,
		.testimonials-1 a, .testimonials-2 a, .testimonials-3 a, .testimonials-4 a, .testimonials-5 a,
		.faide_slider.testimonials-1 .slider b,
		.faide_slider.testimonials-2 .slider b,
		.faide_slide a,
		.sidebar_widget a,
		.recent_posts_list li a:hover,
		.punch_text02 a.icon_but:before,
		.icon-box-style3 i,
		.portfolio_page h1,
		.punch_text03.alternative_punch .right a,
		.blog_post h3 a,
		.blog_post a.date strong,
		.small_social_links li i,
		.icon-box:hover i,
		.icon-box:hover a,
		.icon-box a:hover,
		.icon-box a:hover i,
		.icon-box i:hover
		{
			color: <?php echo $main_color; ?>;
		}

		a.knowmore_but,
		.get_features_list li.left,
		.icon-box2 i,
		.portfolioFilter a.current,
		.portfolioFilter a:hover,
		ul.tabs-horizontal,
		ul.tabs-horizontal li a,
		.tags li a:hover,
		span.acc-trigger.active a:before,
		.copyright_info,
		#trueHeader .menu li a:hover,
		#trueHeader .menu li ul li a,
		#trueHeader .menu li ul,
		.sliderContainer .slideSelectors .item,
		.portfolioFilter a.current,
		.punch_text03.alternative_punch,
		.faide_slider.testimonials-3 .slider,
		.blog_post a.date i,
		.pricing-tables-helight .title,
		.pricing-tables-helight-two .title,
		.pricing-tables-helight .price,
		.pricing-tables-helight-two .price,
		.pricing-tables-main .ordernow .colorchan,
		#trueHeader .menu li.current_page_item a
		{
			background-color: <?php echo $main_color; ?>;
		}

		blockquote
		{
			border-left-color: <?php echo $main_color; ?>;
		}

		ul.tabs li.active, html ul.tabs li.active a, html ul.tabs li.active a:hover,
		.pricing-tables-helight .title,
		.pricing-tables-helight-two .title
		{
			border-top-color: <?php echo $main_color; ?>;
		}

		.pricing-tables-helight .title,
		.pricing-tables-helight-two .title
		{
			border-bottom-color: <?php echo $main_color; ?>;
		}

		.punchline_text_box {
			border-left: 5px solid <?php echo $main_color; ?>;
		}

	<?php endif;?>

	<?php if (ot_get_option('main_body_text_color')): ?>
		/* main_body_text_color */
		.content_main p,
		.content_main ul li,
		.acc-trigger a,
		.acc-container .content,
		.content,
		blockquote,
		.punchline_text_box strong,
		.punch_text02,
		.fresh_projects_list h1,
		.fresh_projects_list h2,
		.list_doted02 h5,
		.box_widget_full h3,
		.punch_text03 h1,
		.framed-box h3,
		.get_features_list h5,
		.icon-box3 h2,
		.icon-box4 h2,
		.icon-box5 h2,
		.icon-box h2,
		.icon-box-style2 h3,
		.fullimage_box h2,
		.arrow_sign_list h5,
		.our_team h4,
		.features_sec02 h1,
		.features_sec02 .left,
		.features_sec02 .right,
		.portfolio_page h3,
		ul.tabs-vertical li a,
		.tab-horizontal-content,
		.tab-vertical-content,
		.lirc_section h3,
		.testimonials-5 span strong,
		.testimonials-2 span strong,
		.faide_slider .faide_slide,
		.sidebar_widget,
		.sidebar_widget p,
		.contact_info .address li a,
		.icon-box2 h2 em
		{
			color: <?php echo ot_get_option('main_body_text_color'); ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('menu_background_color')): ?>
		/* menu_background_color */
		TODO
		{
			background-color: <?php echo ts_hex_to_rgb(ot_get_option('menu_background_color'),ot_get_option('menu_background_transparency')) ; ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('menu_background_hover_color')): ?>
		/* menu_background_hover_color */
		#trueHeader .menu  li a:hover
		{
			background-color: <?php echo ot_get_option('menu_background_hover_color'); ?>;
		}
		.headerstyle2 #trueHeader .menu li a:hover
		{
			color: <?php echo ot_get_option('menu_background_hover_color'); ?>;
			border-bottom-color: <?php echo ot_get_option('menu_background_hover_color'); ?>;
		}
		.headerstyle3 #trueHeader .menu li a:hover
		{
			color: <?php echo ot_get_option('menu_background_hover_color'); ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('sub_menu_background_color')): ?>
		#trueHeader .menu li ul li a
		{
			background-color: <?php echo ot_get_option('sub_menu_background_color'); ?> !important;
		}
	<?php endif; ?>

	<?php if (ot_get_option('sub_menu_background_hover_color')): ?>
		#trueHeader .menu li ul li a:hover
		{
			background-color: <?php echo ot_get_option('sub_menu_background_hover_color'); ?> !important;
		}
	<?php endif; ?>

	<?php if (ot_get_option('headers_text_color')): ?>
		/* headers_text_color */
		.content_main h1,
		.content_main h2,
		.content_main h3,
		.content_main h4,
		.content_main h5,
		.content_main h6,
		.sidebar_title h3
		{
			color: <?php echo ot_get_option('headers_text_color'); ?>;
		}
	<?php endif; ?>
		
	<?php if (ot_get_option('footer_background_color')): ?>
		.footer
		{
			background-color: <?php echo ot_get_option('footer_background_color'); ?>;
			background-image: none;
		}
	<?php endif; ?>
		
	<?php if (ot_get_option('footer_headers_color')): ?>
		.footer h2
		{
			color: <?php echo ot_get_option('footer_headers_color'); ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('footer_main_text_color')): ?>
		/* footer_main_text_color */
		.footer,
		.footer a
		{
			color: <?php echo ot_get_option('footer_main_text_color'); ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('copyrights_bar_background')): ?>
		/* copyrights_bar_background */
		.copyright_info
		{
			background-image: none;
			background-color: <?php echo ot_get_option('copyrights_bar_background'); ?> !important;
		}
	<?php endif; ?>

	<?php if (ot_get_option('copyrights_bar_text_color')): ?>
		/* copyrights_bar_text_color */
		.copyright_info b,
		.copyright_info a
		{
			color: <?php echo ot_get_option('copyrights_bar_text_color'); ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('copyrights_bar_text_hover_color')): ?>
		/* copyrights_bar_text_hover_color */
		.copyright_info a:hover
		{
			color: <?php echo ot_get_option('copyrights_bar_text_hover_color'); ?>;
		}
	<?php endif; ?>

	<?php if (1 == 2): //fake </style> tag, reguired only for editor formatting, please don't remove ?>
		</style>
	<?php endif; ?>

	<?php

	if ($ajax_request === true)
	{
		die();
	}
}

function ts_the_theme_dynamic_styles_ajax_request()
{
	ts_the_theme_dynamic_styles(true);
}

add_action( 'wp_ajax_nopriv_the_theme_dynamic_styles', 'ts_the_theme_dynamic_styles_ajax_request' );
add_action( 'wp_ajax_the_theme_dynamic_styles', 'ts_the_theme_dynamic_styles_ajax_request' );


if ( ! function_exists( 'ts_theme_comment' ) ) :
/**
 * Comments and pingbacks. Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since liva 1.0
 */
function ts_theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	$class = 'comment_wrap';
	if ($depth > 1) {
		$class = 'comment_wrap chaild';
	}
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
		<div <?php comment_class($class); ?> id="li-comment-<?php comment_ID(); ?>">
			<div class="comment_content">
				<div class="comment_text">
					<p><?php _e( 'Pingback:', 'liva' ); ?> <?php comment_author_link(); ?></p>
					<?php edit_comment_link( __( 'Edit', 'liva' ), ' ' ); ?>
				</div>
			</div>
		</div><!-- end section -->
		<?php
			break;
		default :
	?>
	<div <?php comment_class($class); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="gravatar"><?php echo get_avatar( $comment, 60 ); ?></div>
		<div class="comment_content">
			<div class="comment_meta">
				<div class="comment_author"><?php comment_author_link();?> - <i><?php echo get_comment_date().' '.get_comment_time(); ?></i></div>
			</div>
			<div class="comment_text">
				<p>
				<?php if ( $comment->comment_approved == 0 ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'liva' ); ?></em>
				<?php endif; ?>
				<?php comment_text(); ?></p>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 2 ) ) ); ?><?php edit_comment_link( __( 'Edit', 'liva' ), ' ' );?>
			</div>
		</div>
	</div><!-- end section -->
	<?php
			break;
	endswitch;
}
endif; // ends check for theme_comment()

if (!function_exists('ts_the_liva_navi')):

/**
 * Show liva navi
 *
 * @since liva 1.0
 */
function ts_the_liva_navi()
{
	global $wp_query;

	$pagination = ts_get_theme_navi_array();
	if (is_array($pagination['links']) && count($pagination['links']) > 0)
	{
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) { // applies when this page template is used as a static homepage in WP3+
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		?>
		<div class="pagination">
			<b><?php _e('Pages','liva'); ?> <?php echo $paged; ?> of <?php echo $wp_query->max_num_pages; ?></b>
			<?php foreach ($pagination['links'] as $key => $item): ?>
				<?php if ($key == 'prev' || $key == 'next'): ?>
					<?php echo $item; ?>
				<?php else: ?>
					<?php echo $item; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
endif; //ends check for theme_navi

if (!function_exists('ts_theme_navi')):

/**
 * Posts annd search pagination
 *
 * @since liva 1.0
 */
function ts_theme_navi()
{
	$args = array(
		'container' => 'ul',
		'container_id' => 'pager',
		'container_class' => 'post-pagination',
		'items_wrap' => '<li class="%s"><span></span>%s</li>',
		'item_class' => '',
		'item_active_class' => '',
		'list_item_active_class' => 'active',
        'item_prev_class' => 'prev-page',
        'item_next_class' => 'next-page',
		'prev_text' => '',
		'next_text' => ''
	);
	ts_wp_custom_corenavi( $args);
}
endif; //ends check for theme_navi

if (!function_exists('ts_get_theme_navi_array')):

/**
 * Get Posts annd search pagination array
 *
 * @since liva 1.0
 */
function ts_get_theme_navi_array()
{
	$args = array(
		'container' => '',
		'container_id' => 'pager',
		'container_class' => 'clearfix',
		'items_wrap' => '%s',
		'item_class' => 'navlinks',
		'item_active_class' => 'navlinks current',
		'item_prev_class' => 'navlinks',
        'item_next_class' => 'navlinks',
		'prev_text' => '< '.__('Previous','liva'),
		'next_text' => __('Next','liva').' >',
		'next_prev_only' => false,
		'type' => 'array'
	);
	return ts_wp_custom_corenavi( $args);
}
endif; //ends check for theme_navi

function ts_the_breadcrumbs() {

  /* === OPTIONS === */
  $text['home']     = __('Home','liva'); // text for the 'Home' link
  $text['category'] = __('Archive by Category "%s"','liva'); // text for a category page
  $text['search']   = __('Search Results for "%s" Query','liva'); // text for a search results page
  $text['tag']      = __('Posts Tagged "%s"','liva'); // text for a tag page
  $text['author']   = __('Posts by %s','liva'); // text for an author page
  $text['404']      = __('404 Page Not Found','liva'); // text for the 404 page

  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter   = ' <span class="delimiter">/</span> '; // delimiter between crumbs
  $before      = '<span class="current">'; // tag before the current crumb
  $after       = '</span>'; // tag after the current crumb
  /* === END OF OPTIONS === */

  global $post;
  $homeLink = home_url() . '/';
  $linkBefore = '<span>';
  $linkAfter = '</span>';
  $linkAttr = '';
  $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

  if (is_home() || is_front_page()) {

    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';

  } else {

    echo '<div id="crumbs">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

	if (function_exists('is_shop') && is_shop()) {
		echo $before . __('Shop','liva') . $after;
	} else if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) {
        $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
      }
      echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

    } elseif ( is_search() ) {
      echo $before . sprintf($text['search'], get_search_query()) . $after;

    } elseif ( is_day() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());

		if ($post_type -> query_var == 'product') {
			$label = __('Shop','liva');
		} else {
			$label = $post_type->labels->singular_name;
		}
		$slug = $post_type->rewrite;

		$portfolio_page_id = null;
		if (get_post_type() == 'portfolio') {
			$portfolio_page_id = ot_get_option('portfolio_page');
		}
		if (!empty($portfolio_page_id)) {
			echo '<a href="'.get_permalink($portfolio_page_id).'">'.get_the_title($portfolio_page_id).'</a>';
		} else {
			printf($link, get_post_type_archive_link( $post_type -> name ), $label);
		}
        if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $delimiter);
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      $cats = get_category_parents($cat, TRUE, $delimiter);
	  if (!is_wp_error($cats))
	  {
		$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
		$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
		echo $cats;
		printf($link, get_permalink($parent), $parent->post_title);
	  }
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo $delimiter;
      }
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . sprintf($text['author'], $userdata->display_name) . $after;

    } elseif ( is_404() ) {
      echo $before . $text['404'] . $after;
    }
    echo '</div>';

  }
}

/**
 * Get post slider
 * @since liva 1.0
 */
if (!function_exists('ts_get_post_slider'))
{
function ts_get_post_slider($post_id)
{
	$a = get_post_meta(get_the_ID(), 'post_slider',true);

	if (strstr($a,'LayerSlider'))
	{
		$id = str_replace('LayerSlider-','',$a);
		return do_shortcode('[layerslider id="'.$id.'"]');
	}
	else if (strstr($a,'revslider'))
	{
		$id = str_replace('revslider-','',$a);
		return do_shortcode('[rev_slider '.$id.']');
	}

	if (strstr($a,'flexslider'))
	{
		$id = str_replace('flexslider-','',$a);
		return do_shortcode('[flexslider id="'.$id.'"]');
	}

	if (strstr($a,'banner-builder'))
	{
		$id = str_replace('banner-builder-','',$a);
		return td_get_banner($id);
	}
}
}

/**
 * Shows preheader
 * @since liva 3.0
 */
function ts_show_preheader() {

	$preheader = ot_get_option('preheader');

	$show_preheader = ot_get_option('show_preheader');
	if (is_singular()) {
		$show_post_preheader = get_post_meta(get_the_ID(),'show_preheader',true);
		if (in_array($show_post_preheader,array('yes','no'))) {
			$show_preheader = $show_post_preheader;
		}
	}

	if ($show_preheader == 'yes' && is_array($preheader) && count($preheader) > 0): ?>
		<!-- Top header bar -->
			<div id="topHeader">

			<div class="wrapper">

				<div class="top_contact_info">

				<div class="container">
				<?php
				foreach (array('left','right') as $float):
					foreach ($preheader as $item):

						if ($item['float'] != $float):
							continue;
						endif;

						$float_class = 'tci_list';
						if ($float == 'left'):
							$float_class = 'tci_list_left';
						endif;

						$menu_id = null;
						if (strstr($item['type'],'menu_')) {
							$menu_id = str_replace('menu_', '', $item['type']);
							$item['type'] = 'menu';
						}

						switch ($item['type']):
							case 'date': ?>
								<ul class="<?php echo $float_class; ?>">
									<li class="empty">
										<?php if (!empty($item['icon']) && $item['icon'] != 'no'): ?>
											<i class="<?php echo $item['icon']; ?>"></i>
										<?php endif; ?>
										<?php echo date(get_option('date_format')); ?>
									</li>
								</ul>
								<?php
								break;
							case 'menu':
								if (intval($menu_id)) {
									$defaults = array(
										'container'			=> 'div',
										'container_class'	=> $float_class,
										'fallback_cb'		=> '',
										'menu'				=> $menu_id,
										'depth' 			=> 1
									);
									wp_nav_menu( $defaults );
								}
								break;

							case 'social_icons':
								$active_social_items = ot_get_option('active_social_items');
								if (!is_array($active_social_items)):
									$active_social_items = array();
								endif; ?>

								<ul class='<?php echo $float_class; ?>'>
									<?php if (in_array('facebook',$active_social_items)): ?>
										<li>
											<a href='<?php echo ot_get_option('facebook_url'); ?>' title="Facebook" target="_blank"><i class="icon-facebook"></i></a>
										</li>
									<?php endif;?>
									<?php if (in_array('twitter',$active_social_items)): ?>
										<li>
											<a href='<?php echo ot_get_option('twitter_url'); ?>' title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
										</li>
									<?php endif;?>
									<?php if (in_array('google_plus',$active_social_items)): ?>
										<li>
											<a href='<?php echo ot_get_option('google_plus_url'); ?>' title="Google+" target="_blank"><i class="icon-google-plus"></i></a>
										</li>
									<?php endif;?>
									<?php if (in_array('linkedin',$active_social_items)): ?>
										<li>
											<a href='<?php echo ot_get_option('linkedin_url'); ?>' title="LinkedIn" target="_blank"><i class="icon-linkedin"></i></a>
										</li>
									<?php endif;?>
									<?php if (in_array('flickr',$active_social_items)): ?>
										<li>
											<a href='<?php echo ot_get_option('flickr_url'); ?>' title="Flickr" target="_blank"><i class="icon-flickr"></i></a>
										</li>
									<?php endif;?>
									<?php if (in_array('youtube',$active_social_items)): ?>
										<li>
											<a href='<?php echo ot_get_option('youtube_url'); ?>' title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
										</li>
									<?php endif;?>
									<?php if (in_array('rss',$active_social_items)): ?>
										<li>
											<a href='<?php bloginfo('rss_url'); ?>' title="RSS" target="_blank"><i class="icon-rss"></i></a>
										</li>
									<?php endif;?>
								</ul>
								<?php break;

							default: ?>
								<ul class="<?php echo $float_class; ?>">
									<li class="empty">
										<?php if (!empty($item['url'])): ?>
											<a href="<?php echo $item['url']; ?>" target="<?php echo $item['target']; ?>">
										<?php endif; ?>
										<?php if (!empty($item['icon']) && $item['icon'] != 'no'): ?>
											<i class="<?php echo $item['icon']; ?>"></i>
										<?php endif; ?>
										<?php echo $item['text']; ?>
										<?php if (!empty($item['url'])): ?>
											</a>
										<?php endif; ?>
									</li>
								</ul>
								<?php
								break;
						endswitch; ?>

					<?php endforeach;
				endforeach; ?>
			 </div>

		</div><!-- end top contact info -->

		</div>

		</div>
	<?php endif;
}

/**
 * Share buttons
 * Can be included in the loop only
 * @since sentiment 1.0
 */
function ts_share_buttons($class = '' ) { ?>
	<div class="sharepost">
		<h4><i><?php _e('Share this Post','liva');?></i></h4>
		<ul>
			<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">&nbsp;<i class="icon-facebook icon-large"></i>&nbsp;</a></li>
			<li><a target="_blank" class="twitter-share-button" href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="icon-twitter icon-large"></i></a></li>
			<?php 
			$pin_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'pinterest' );
			if ($pin_image): ?>
			<li><a target="_blank" href="http://pinterest.com/pin/create%2Fbutton/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode($pin_image[0]); ?>&description=<?php echo urlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="icon-pinterest icon-large"></i></a></li>
			<?php endif; ?>
			<li><a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="icon-google-plus icon-large"></i></a></li>
			<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>&summary=<?php echo urlencode(ts_get_the_excerpt_theme(10)); ?>&source=<?php echo get_bloginfo( 'name' );?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=531,width=545');return false;"><i class="icon-linkedin icon-large"></i></a></li>
		</ul>
	</div>	
		
<?php }