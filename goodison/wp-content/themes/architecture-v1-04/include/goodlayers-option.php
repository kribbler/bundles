<?php



	/*	

	*	Goodlayers Option File

	*	---------------------------------------------------------------------

	* 	@version	1.0

	* 	@author		Goodlayers

	* 	@link		http://goodlayers.com

	* 	@copyright	Copyright (c) Goodlayers

	*	---------------------------------------------------------------------

	*	This file contains the goodlayers panel elements and create the 

	*	goodlayers panel to the back-end of the framework

	*	---------------------------------------------------------------------

	*/

	

	// goodlayers panel navigation elements

	$goodlayers_menu = array(			

		__('General', 'gdl_back_office') => array(

			__('Page Style', 'gdl_back_office')=>'gdl_panel_page_style',

			__('Blog / Port Style', 'gdl_back_office')=>'gdl_panel_blog_port_style',

			__('Search / Archive Style', 'gdl_back_office')=>'gdl_panel_search_archive_style',

			__('Sidebar', 'gdl_back_office')=>'gdl_panel_sidebar',

			__('Footer Style', 'gdl_back_office')=>'gdl_panel_footer_style',

			__('Google Analytics', 'gdl_back_office')=>'gdl_panel_google_analytics',

			__('Favicon', 'gdl_back_office')=>'gdl_panel_favicon'),

			

		__('Font Style', 'gdl_back_office') => array(

			__('Font Size', 'gdl_back_office')=>'gdl_panel_font_size',

			__('Font Family', 'gdl_back_office')=>'gdl_panel_font',

			__('Font Style (Google)', 'gdl_back_office')=>'gdl_panel_google_font',

			__('Upload Font', 'gdl_back_office')=>'gdl_panel_upload_font'),

			

		__('Overall Elements', 'gdl_back_office') => array(

			__('Header / Logo', 'gdl_back_office')=>'gdl_panel_logo',

			__('Header Title Background', 'gdl_back_office')=>'gdl_panel_header_title_bg',

			__('Icon Style', 'gdl_back_office')=>'gdl_panel_icon_style',

			__('Social Network', 'gdl_back_office')=>'gdl_panel_social_network',

			__('Social Shares', 'gdl_back_office')=>'gdl_panel_social_shares',

			__('Copyright', 'gdl_back_office')=>'gdl_panel_copyright_area'),

			//__('Dummy Data', 'gdl_back_office')=>'gdl_panel_dummy_data' ),	

			

		__('Elements Color', 'gdl_back_office') => array(

			__('Header / Navigation', 'gdl_back_office')=>'gdl_panel_header_navigation',

			__('Floating Navigation', 'gdl_back_office')=>'gdl_panel_floating_navigation',

			__('Body / Sidebar', 'gdl_back_office')=>'gdl_panel_body',

			__('Footer', 'gdl_back_office')=>'gdl_panel_footer',

			__('Slider / Stunning text', 'gdl_back_office')=>'gdl_panel_slider',

			__('Blog / Pagination', 'gdl_back_office')=>'gdl_panel_blog_pagination',

			__('Portfolio', 'gdl_back_office')=>'gdl_panel_portfolio',

			__('Contact / Comments', 'gdl_back_office')=>'gdl_panel_contact_form',

			__('Price / Personnal Item', 'gdl_back_office')=>'gdl_panel_price_personnal_item',			

			__('Additional Elements', 'gdl_back_office')=>'gdl_panel_additional_elements',

			__('Additional Elements 2', 'gdl_back_office')=>'gdl_panel_additional_elements_2',

			__('Load Default Color', 'gdl_back_office')=>'gdl_panel_load_default_color'),

			

		__('Translator','gdl_back_office')=> array(

			__('Enable Admin Translator', 'gdl_back_office')=>'gdl_panel_enable_admin_translator',

			__('Blog/Portfolio', 'gdl_back_office')=>'gdl_panel_blog_port_translator',

			__('Contact Form', 'gdl_back_office')=>'gdl_panel_contact_form_translator',

			__('Additional Elements', 'gdl_back_office')=>'gdl_panel_additional_elements_translator'),

		

		__('Plugin Setting', 'gdl_back_office') => array(

			__('Enable/Disable Plugin', 'gdl_back_office')=>'gdl_panel_plugin_enable',

			__('Nivo Slider', 'gdl_back_office')=>'gdl_panel_nivo_slider',

			__('Flex / Carousel Slider', 'gdl_back_office')=>'gdl_panel_flex_slider',

			__('Anything Slider', 'gdl_back_office')=>'gdl_panel_anything_slider',

			__('Custom (Top) Slider', 'gdl_back_office')=>'gdl_panel_custom_slider',

			__('Disable Right Click', 'gdl_back_office')=>'gdl_panel_disable_right_click')

	);

	

	// goodlayers panel elements ( the head of array links to the menu of navigation elements )

	$goodlayers_element = array(

		//General

		'gdl_panel_page_style' => array(	

			__('ENABLE RESPONSIVE', 'gdl_back_office')=>array(

				'type'=>'radioenabled',

				'name'=>THEME_SHORT_NAME.'_enable_responsive',

				'description'=>'*** Anything slider will not supported with the responsive mode ***'

			),

			__('ENABLE FLOATING MENU', 'gdl_back_office')=>array(

				'type'=>'radioenabled',

				'name'=>THEME_SHORT_NAME.'_enable_floating_menu'

			),			

			__('CUT EXCERPT BY SPACE', 'gdl_back_office')=>array(

				'type'=>'radioenabled',

				'name'=>THEME_SHORT_NAME.'_space_excerpt',

				'description'=>'Enabling this will make the theme cut the end of the excerpt by considering the space.' .

					' ( Only use with language that divides the word by space )'

			),		

			__('DEFAULT DATE FORMAT', 'gdl_back_office')=>array(

				'type'=>'inputtext',

				'name'=>THEME_SHORT_NAME.'_default_date_format',

				'default'=>'d M y',

				'description'=>'See more details about the date format here. http://codex.wordpress.org/Formatting_Date_and_Time'),				

			__('DEFAULT WIDGET DATE FORMAT', 'gdl_back_office')=>array(

				'type'=>'inputtext',

				'name'=>THEME_SHORT_NAME.'_default_widget_date_format',

				'default'=>'d M y',

				'description'=>'See more details about the date format here. http://codex.wordpress.org/Formatting_Date_and_Time'),												

			__('ADDITIONAL STYLE (CSS)', 'gdl_back_office')=>array(

				'type'=>'textarea',

				'name'=>THEME_SHORT_NAME.'_additional_style',

				'body_class'=>'gdl-additional-style')

		),

		

		'gdl_panel_blog_port_style' => array(

			__('DEFAULT POST HEADER', 'gdl_back_office')=>array(

				'type'=>'inputtext',

				'name'=>THEME_SHORT_NAME.'_default_post_header',

				'default'=>'Blog Post'),			

			__('DEFAULT POST SIDEBAR', 'gdl_back_office')=>array(

				'type'=>'radioimage',

				'name'=>THEME_SHORT_NAME.'_default_post_sidebar',

				'default'=>'post-no-sidebar',

				'options'=>array(

					'1'=>array('value'=>'post-right-sidebar','default'=>'selected','image'=>'/include/images/right-sidebar-120.png'),

					'2'=>array('value'=>'post-left-sidebar','image'=>'/include/images/left-sidebar-120.png'),

					'3'=>array('value'=>'post-both-sidebar','image'=>'/include/images/both-sidebar-120.png'),

					'4'=>array('value'=>'post-no-sidebar','image'=>'/include/images/no-sidebar-120.png'))),

			__('DEFAULT POST LEFT SIDEBAR', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_default_post_left_sidebar',

				'options'=> get_sidebar_name(),

				'body'=>'gdl-default-post-left-sidebar'),

			__('DEFAULT POST RIGHT SIDEBAR', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_default_post_right_sidebar',

				'options'=> get_sidebar_name(),

				'body'=>'gdl-default-post-right-sidebar'),	

			__('SHOW POST TAG INFO', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_show_post_tag',

				'options'=> array('Yes','No'),

				'description'=> 'Select this to "No" will hide the post tag in post item out.'

			),

			__('SHOW POST COMMENT INFO', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_show_post_comment_info',

				'options'=> array('Yes','No'),

				'description'=> 'Select this to "No" will hide the post comment info in post item out.'

			),		

			__('SHOW POST AUTHOR INFO', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_show_post_author_info',

				'options'=> array('Yes','No'),

				'description'=> 'Select this to "No" will hide the post author in post item out. ( not the about author section in the post )'

			),				

			__('PORTFOLIO PAGE STYLE', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_use_portfolio_as',

				'options'=>array('1'=>'portfolio style', '2'=>'blog style'),

				'description'=>'You can choose the portfolio page style to be the portfolio style or the same as blog style.'),

			__('PORTFOLIO SLUG', 'gdl_back_office')=>array(

				'type'=>'inputtext',

				'name'=>THEME_SHORT_NAME.'_gdl_portfolio_slug',

				'default'=>'portfolio',

				'description'=>'Change/Rewrite the permalink when you use the permalink type as %postname%.'

			),	

			__('RELATED PORTFOLIO', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio',

				'default'=>'portfolio',

				'options'=>array('Yes', 'No'),

				'description'=>'Show related portfolio for portfolio post type.'

			),	

			__('RELATED PORTFOLIO SIZE', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio_size',

				'options'=>array('1/4', '1/3', '1/2')

			),		

			__('RELATED PORTFOLIO NUM FETCH', 'gdl_back_office')=>array(

				'type'=>'inputtext',

				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio_num_fetch',

				'default'=>'4'

			),			

			__('SHOW RELATED PORTFOLIO TITLE', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio_title',

				'options'=>array('Yes', 'No')

			),				

			__('SHOW RELATED PORTFOLIO TAG', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio_tag',

				'options'=>array('Yes', 'No')

			),				

		),

		

		'gdl_panel_search_archive_style' => array(

			__('SEARCH/ARCHIVE SIDEBAR', 'gdl_back_office')=>array(

				'type'=>'radioimage',

				'name'=>THEME_SHORT_NAME.'_search_archive_sidebar',

				'default'=>'no-sidebar',

				'options'=>array(

					'1'=>array('value'=>'right-sidebar','default'=>'selected','image'=>'/include/images/right-sidebar-120.png'),

					'2'=>array('value'=>'left-sidebar','image'=>'/include/images/left-sidebar-120.png'),

					'3'=>array('value'=>'both-sidebar','image'=>'/include/images/both-sidebar-120.png'),

					'4'=>array('value'=>'no-sidebar','image'=>'/include/images/no-sidebar-120.png'))),

			__('SEARCH/ARCHIVE LEFT SIDEBAR', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_search_archive_left_sidebar',

				'options'=> get_sidebar_name(),

				'body'=>'gdl-default-post-left-sidebar'),

			__('SEARCH/ARCHIVE RIGHT SIDEBAR', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_search_archive_right_sidebar',

				'options'=> get_sidebar_name(),

				'body'=>'gdl-default-post-right-sidebar'),						

			__('SEARCH/ARCHIVE EXCERPT NUM', 'gdl_back_office')=>array(

				'type'=>'inputtext',

				'name'=>THEME_SHORT_NAME.'_search_archive_num_excerpt',

				'default'=>'285',

				'description'=>'Input the number of character you want to cut from the content to be the excerpt of search and archive page.'),

			__('SEARCH/ARCHIVE ITEM SIZE', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_search_archive_item_size',

				'options'=>array('1/4 Blog Grid', '1/3 Blog Grid', '1/2 Blog Grid', '1/1 Blog Grid'),

				'default'=>'1/2 Blog Grid'

			),	

			__('SEARCH/ARCHIVE FULL BLOG CONTENT', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'name'=>THEME_SHORT_NAME.'_search_archive_full_blog_content',

				'options'=>array('No', 'Yes')

			),		

			__('PORTFOLIO ARCHIVE SIZE', 'gdl_back_office')=>array(

				'type'=>'combobox', 

				'name'=>THEME_SHORT_NAME.'_portfolio_archive_size',

				'options'=>array('1/4', '1/3', '1/2'),

				'default'=>'1/2'

			),		

			__('PORTFOLIO ARCHIVE SHOW TITLE', 'gdl_back_office')=>array(

				'type'=>'combobox', 

				'name'=>THEME_SHORT_NAME.'_portfolio_archive_show_title',

				'options'=>array('Yes', 'No')

			),			

			__('PORTFOLIO ARCHIVE SHOW TAGS', 'gdl_back_office')=>array(

				'type'=>'combobox', 

				'name'=>THEME_SHORT_NAME.'_portfolio_archive_show_tags',

				'options'=>array('Yes', 'No')

			),					

		),

		

		'gdl_panel_sidebar' => array(

			__('CREATE SIDEBAR', 'gdl_back_office')=>array('type'=>'sidebar','name'=>THEME_SHORT_NAME.'_create_sidebar')

		),

		

		'gdl_panel_footer_style' => array(

			__('SHOW FOOTER', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=> THEME_SHORT_NAME.'_show_footer'),		

			__('CHOOSE FOOTER STYLE', 'gdl_back_office')=>array(

				'type'=>'radioimage',

				'name'=>THEME_SHORT_NAME.'_footer_style', 

				'default'=>'footer-style1',

				'options'=>array(

					'1'=>array('value'=>'footer-style1','image'=>'/include/images/footer-style1.png'),

					'2'=>array('value'=>'footer-style2','image'=>'/include/images/footer-style2.png'),

					'3'=>array('value'=>'footer-style3','image'=>'/include/images/footer-style3.png'),

					'4'=>array('value'=>'footer-style4','image'=>'/include/images/footer-style4.png'),

					'5'=>array('value'=>'footer-style5','image'=>'/include/images/footer-style5.png'),

					'6'=>array('value'=>'footer-style6','image'=>'/include/images/footer-style6.png'),

			))

		),

		

		'gdl_panel_google_analytics' => array(

			__('ENABLE GOOGLE ANALYTICS', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=> THEME_SHORT_NAME.'_enable_analytics', 'default'=>'disable'),

			__('GOOGLE ANALYTICS CODE', 'gdl_back_office')=>array('type'=>'textarea', 'name'=> THEME_SHORT_NAME.'_analytics_code',

				'description'=>'Place the code you get from google here. This should be something like <br>' . 

				htmlspecialchars('<script type="text/javascript">') . '<br> ... <br>' .

				htmlspecialchars('</script>'))

		),

		

		'gdl_panel_favicon' => array(

			__('ENABLE FAVICON', 'gdl_back_office')=>array('type'=>'radioenabled','name'=> THEME_SHORT_NAME.'_enable_favicon', 'default'=>'disable',

				'description' => 'Upload the .ICO file type to make the favicon support with all browser.'),

			__('UPLOAD FAVICON ICON', 'gdl_back_office')=>array('type'=>'upload','name'=> THEME_SHORT_NAME.'_favicon_image'),

		),		

		

		//Theme Style

		'gdl_panel_font_size' => array(

			__('NAVIGATION SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_navigation_size','default'=>'12',

				'description'=>'Main menu font size.'),

			__('PAGE TITLE SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_header_title_size','default'=>'25'),

			__('CONTENT SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_content_size','default'=>'14'),

			__('WIDGET TITLE SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_widget_title_size','default'=>'16',

				'descriptoin'=>'Size of the widget title ( that resides in sidebar and footer ).'),

			__('H1 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h1_size','default'=>'30',

				'description'=>'H1 to H6 size will only effects to the user content ( the h1 to h6 tag that users add them self ) font size. '),

			__('H2 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h2_size','default'=>'25'),

			__('H3 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h3_size','default'=>'20'),

			__('H4 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h4_size','default'=>'18'),

			__('H5 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h5_size','default'=>'16'),

			__('H6 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h6_size','default'=>'15'),



		),



		'gdl_panel_font' => array(

			__('HEADER FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_header_font', 'default'=>'- Default',

				'description'=>'Choose the header font of this theme. This font will be used in all title and header elements including the slider title.'),

			__('MAIN NAVIGATION FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_navigation_font', 'default'=>'- Open Sans'),

			__('SLIDER TITLE FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_slider_title_font', 'default'=>'- Open Sans'),

			__('CONTENT FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_content_font', 'default'=>'- default',

				'description'=>'Choose the font to use with content. CUFON are not allowed to use with the content font.'),

			__('STUNNING TEXT FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_stunning_text_font', 'default'=>'- default',

				'description'=>'Choose the font to use with stunning text title.')

		),

		

		'gdl_panel_google_font' => array(

			__('INCLUDE FONT WEIGHT', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_google_font_weight', 

				'default'=>'n,i,b,bi', 'description' => 'This is an example of the font weight <br><br> 300,400,300italic,400italic'),		

			__('INCLUDE FONT SUBSET', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_google_font_subset', 

				'default'=>'latin' , 'description' => 'This is an example of the font subset <br><br> latin,cyrillic,greek,vietnamese,greek-ext,cyrillic-ext,latin-ext'),		

		),



		'gdl_panel_upload_font' => array(

			__('UPLOAD FONT', 'gdl_back_office')=>array(

				'type'=>'uploadfont',

				'name'=>THEME_SHORT_NAME.'_upload_font',

				'file'=>THEME_SHORT_NAME.'_upload_font_file')

		),

		

		//Overall Elements

		'gdl_panel_logo' => array( 

			__('LOGO', 'gdl_back_office')=>array('type'=>'upload','name'=>THEME_SHORT_NAME.'_logo'), 

			__('LOGO TOP MARGIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_logo_top_margin','default'=>'120',

				'description'=>'Input number to set the top space of the logo. Negative value is allowed. Please use -0 instead of 0.'), 

			__('HEADER NAVIGATION TOP MARGIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_header_nav_top_margin','default'=>'48'),				

			__('HEADER NAVIGATION BOTTOM MARGIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_header_nav_bottom_margin','default'=>'35'),				

		),

		

		'gdl_panel_header_title_bg' => array(

			__('DEFAULT HEADER BACKGROUND', 'gdl_back_office')=>array('type'=>'upload','name'=>THEME_SHORT_NAME.'_default_header_background'), 

			__('PAGE HEADER BACKGROUND', 'gdl_back_office')=>array('type'=>'upload','name'=>THEME_SHORT_NAME.'_page_header_background'), 

			__('SINGLE HEADER BACKGROUND', 'gdl_back_office')=>array('type'=>'upload','name'=>THEME_SHORT_NAME.'_single_header_background'), 

			__('SEARCH/ARCHIVE HEADER BACKGROUND', 'gdl_back_office')=>array('type'=>'upload','name'=>THEME_SHORT_NAME.'_search_header_background'), 

			__('404 HEADER BACKGROUND', 'gdl_back_office')=>array('type'=>'upload','name'=>THEME_SHORT_NAME.'_404_header_background'), 

		),		



		'gdl_panel_icon_style' => array(

			__('HEADER ICON STYLE','gdl_back_office')=>array( 'type'=>'combobox', 'name'=>THEME_SHORT_NAME.'_header_icon_type', 'options'=>array('1'=>'light','2'=>'dark')),			

			__('BODY ICON STYLE','gdl_back_office')=>array( 'type'=>'combobox', 'name'=>THEME_SHORT_NAME.'_icon_type', 'options'=>array('1'=>'dark','2'=>'light'),

				'description'=>'This option will change all of the icon in this theme( except from footer ) to be dark/light version.'),		

			__('CAROUSEL ICON STYLE', 'gdl_back_office')=>array('type'=>'combobox','name'=>THEME_SHORT_NAME.'_carousel_icon_type','options'=>array('0'=>'light','1'=>'dark'),'default'=>'light',

				'description' =>'This is left and right icon type of the thumbnail in carousel slider.'),

			__('FOOTER ICON STYLE', 'gdl_back_office')=>array('type'=>'combobox','name'=>THEME_SHORT_NAME.'_footer_icon_type','options'=>array('0'=>'light','1'=>'dark'),'default'=>'light',

				'description' =>'There are two icon types in this theme, dark and light, you can choose it to display on footer as you want.'),

		),

		

		'gdl_panel_social_network' => array( 

			__('DELICIOUS', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_delicious',

				'description'=>'Place the link you want and delicious icon will appear. To remove it, just leave it blank.'),	

			__('DEVIANTART', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_deviantart',

				'description'=>'Place the link you want and deviantart icon will appear. To remove it, just leave it blank.'),	

			__('DIGG', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_digg',

				'description'=>'Place the link you want and digg icon will appear. To remove it, just leave it blank.'),					

			__('FACEBOOK', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_facebook',

				'description'=>'Place the link you want and facebook icon will appear. To remove it, just leave it blank.'),

			__('FLICKR', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_flickr',

				'description'=>'Place the link you want and flickr icon will appear. To remove it, just leave it blank.'),

			__('LASTFM', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_lastfm',

				'description'=>'Place the link you want and lastfm icon will appear. To remove it, just leave it blank.'),

			__('LINKEDIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_linkedin',

				'description'=>'Place the link you want and linkedin icon will appear. To remove it, just leave it blank.'),			

			__('PICASA', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_picasa',

				'description'=>'Place the link you want and picasa icon will appear. To remove it, just leave it blank.'),

			__('RSS', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_rss',

				'description'=>'Place the link you want and feed icon will appear. To remove it, just leave it blank.'),

			__('STUMBLE UPON', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_stumble_upon',

				'description'=>'Place the link you want and stumble upon icon will appear. To remove it, just leave it blank.'),

			__('TUMBLR', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_tumblr',

				'description'=>'Place the link you want and tumblr icon will appear. To remove it, just leave it blank.'),	

			__('TWITTER', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_twitter',

				'description'=>'Place the link you want and twitter icon will appear. To remove it, just leave it blank.'),

			__('VIMEO', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_vimeo',

				'description'=>'Place the link you want and vimeo icon will appear. To remove it, just leave it blank.'),

			__('YOUTUBE', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_youtube',

				'description'=>'Place the link you want and youtube icon will appear. To remove it, just leave it blank.'),

			__('GOOGLE PLUS', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_google_plus',

				'description'=>'Place the link you want and google plus icon will appear. To remove it, just leave it blank.'),		

			__('EMAIL', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_email',

				'description'=>'Place the link you want and email icon will appear. To remove it, just leave it blank.'),				

			__('PINTEREST', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_pinterest',

				'description'=>'Place the link you want and pinterest icon will appear. To remove it, just leave it blank.'),	

			),		

		

		'gdl_panel_social_shares' => array(

			__('FACEBOOK', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_facebook_share',

				'description'=>'Toggle to enable/disable the facebook shares in blog and portfolio page.'),

			__('TWITTER', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_twitter_share',

				'description'=>'Toggle to enable/disable the twitter shares in blog and portfolio page.'),

			__('STUMBLE UPON', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_stumble_upon_share',

				'description'=>'Toggle to enable/disable the stumble upon shares in blog and portfolio page.'),

			__('MY SPACE', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_my_space_share',

				'description'=>'Toggle to enable/disable the my spce shares in blog and portfolio page.'),

			__('DELICIOUS', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_delicious_share',

				'description'=>'Toggle to enable/disable the delicious shares in blog and portfolio page.'),

			__('DIGG', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_digg_share',

				'description'=>'Toggle to enable/disable the digg shares in blog and portfolio page.'),

			__('REDDIT', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_reddit_share',

				'description'=>'Toggle to enable/disable the reddit shares in blog and portfolio page.'),

			__('LINKEDIN', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_linkedin_share',

				'description'=>'Toggle to enable/disable the linkedin shares in blog and portfolio page.'),

			__('GOOGLE PLUS', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_google_plus_share',

				'description'=>'Toggle to enable/disable the google plus shares in blog and portfolio page.'),			

			__('PINTEREST', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_pinterest_share',

				'description'=>'Toggle to enable/disable the pinterest shares in blog and portfolio page.'),						

				

		),

			

		'gdl_panel_copyright_area' => array( 

			__('SHOW COPYRIGHT', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=> THEME_SHORT_NAME.'_show_copyright'),		

			__('COPYRIGHT LEFT AREA', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_copyright_left_area'), 

			__('COPYRIGHT RIGHT AREA', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_copyright_right_area')

		),

		

		// 'gdl_panel_dummy_data' => array( 

		// 	__('LOAD DUMMY DATA', 'gdl_back_office')=>array('type'=>'dummy')

		// ),

			

		// Elements Color

		'gdl_panel_header_navigation' => array(

			__('PAGE HEADER TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_page_header_title_color',

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'h1.page-header-title'),			

			__('HEADER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_header_background',

				'default'=>'#000000', 'attr'=> array('background-color'), 'selector'=>'div.header-wrapper' ),		

			__('NAVIGATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_head_navigation_text',

				'default'=>'#aeaeae', 'attr'=> array('color'), 'selector'=>'div.header-navigation ul.menu li a' ),

			__('NAVIGATION TEXT HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_head_navigation_text_hover',

				'default'=>'#ffffff', 'attr'=> array('color'), 'selector'=>'div.header-navigation ul.menu li a:hover' ),

			__('NAVIGATION TEXT CURRENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_head_navigation_text_current',

				'default'=>'#ffffff', 'attr'=> array('color'), 

				'selector'=>'div.header-navigation ul.menu li.current-menu-item a, div.header-navigation ul.menu li.current-menu-ancestor a' ),		

			__('NAVIGATION LEFT BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_head_navigation_left_border',

				'default'=>'#4f4f4f', 'attr'=> array('border-color'), 'selector'=>'.first-header-navigation ul' ),

			__('SUB NAVIGATION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_head_sub_navigation_background',

				'default'=>'#272727', 'attr'=> array('background-color'), 'selector'=>'div.header-navigation ul.menu ul.sub-menu' ),

			__('SUB NAVIGATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_head_sub_navigation_text',

				'default'=>'#d8d8d8', 'attr'=> array('color'), 

				'selector'=>'div.header-navigation ul.menu ul.sub-menu li a, div.header-navigation ul.menu ul.sub-menu ul.sub-menu li a' ),

			__('SUB NAVIGATION TEXT HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_head_sub_navigation_text_hover',

				'default'=>'#ffffff', 'attr'=> array('color'), 

				'selector'=>'div.header-navigation ul.menu ul.sub-menu li a:hover, div.header-navigation ul.menu ul.sub-menu ul.sub-menu li a:hover' ),

			__('SUB NAVIGATION TEXT CURRENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_head_sub_navigation_text_current',

				'default'=>'#ffffff', 'attr'=> array('color'), 

				'selector'=>'div.header-navigation ul.menu ul.sub-menu li.current-menu-item a, div.header-navigation ul.menu ul.sub-menu li.current-menu-ancestor a,' .

							'div.header-navigation ul.menu ul.sub-menu ul.sub-menu li.current-menu-item a'),					

		),		

		

		'gdl_panel_floating_navigation' => array(

			__('FLOATING NAVIGATION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_background',

				'default'=>'#272727', 'attr'=> array('background-color'), 'selector'=>'.navigation-wrapper, ul.sf-menu li a' ),

			__('FLOATING NAVIGATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text',

				'default'=>'#ffffff', 'attr'=> array('color'), 'selector'=>'.sf-menu li a',

				'description'=>'This is the text color of the main navigation in the normal state.'),

			__('FLOATING NAVIGATION TEXT HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text_hover',

				'default'=>'#ffffff', 'attr'=> array('color'),  'selector'=>'.sf-menu li:hover a',

				'description'=>'This is the text color of the main navigation in "hover" state.'),

			__('FLOATING NAVIGATION BACKGROUND HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_background_hover',

				'default'=>'#a92727', 'attr'=> array('background-color'),  'selector'=>'.sf-menu li:hover a'),				

			__('FLOATING NAVIGATION TEXT CURRENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text_current',

				'default'=>'#ffffff', 'attr'=> array('color'), 'selector'=>'.sf-menu li.current-menu-ancestor a, .sf-menu li.current-menu-item a',

				'description'=>'This is the text color of the main navigation in "current page" state.'),				

			__('FLOATING NAVIGATION TEXT CURRENT BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text_current_bg',

				'default'=>'#a92727', 'attr'=> array('background-color'), 'selector'=>'.sf-menu li.current-menu-ancestor a, .sf-menu li.current-menu-item a',

				'description'=>'This is the text color of the main navigation in "current page" state.'),

			__('FLOATING SUB NAVIGATION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_background',

				'default'=>'#262626', 'attr'=> array('background-color'), 'selector'=>'.sf-menu li li' ),

			__('FLOATING SUB NAVIGATION BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_border',

				'default'=>'#262626', 'attr'=> array('border-color'), 'selector'=>'.sf-menu ul, .sf-menu ul li' ),

			__('FLOATING SUB NAVIGATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_text',

				'default'=>'#aaaaaa', 'attr'=> array('color'), 

				'selector'=>'.sf-menu li li a, .sf-menu li:hover li a, .sf-menu li.current-menu-item li a, .sf-menu li.current-menu-ancestor li a, .sf-menu li li.current-menu-item li a, .sf-menu li li.current-menu-ancestor li a' ),

			__('FLOATING SUB NAVIGATION TEXT HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_text_hover',

				'default'=>'#ffffff', 'attr'=> array('color'), 

				'selector'=>'.sf-menu li li a:hover, .sf-menu li li.current-menu-item li a:hover, .sf-menu li li.current-menu-ancestor li a:hover' ),

			__('FLOATING SUB NAVIGATION TEXT CURRENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_text_current',

				'default'=>'#ffffff', 'attr'=> array('color'), 

				'selector'=>'.sf-menu li li.current-menu-item a, .sf-menu li li.current-menu-ancestor a, .sf-menu li li.current-menu-ancestor li.current-menu-item a' ),		

		),

		

		'gdl_panel_body' => array(				

			__('TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_title_color',

				'default'=>'#303030', 'attr'=>array('color'), 'selector'=>'h1, h2, h3, h4, h5, h6',

				'description'=>'Change this title color wil effects all title in this theme except footer title, sidebar title, blog thumbnail title and portolio thumbnail title color.'),

			__('ITEM HEADER TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_title_color',

				'default'=>'#888888', 'attr'=>array('color'), 'selector'=>'h3.gdl-header-title' ),	

			__('CONTENT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_content_color',

				'default'=>'#878787', 'attr'=>array('color'), 'selector'=>'body'),

			__('BODY BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_body_background',

				'default'=>'#ffffff', 'attr'=>array('background-color'), 'selector'=>'html, div.personnal-widget-navigation'),

			__('LINK COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_link_color',

				'default'=>'#7a7a7a', 'attr'=>array('color'), 'selector'=>'a',

				'description'=>'This color effects all of the link color in this theme.'),

			__('LINK HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_link_hover_color',

				'default'=>'#cccccc', 'attr'=>array('color'), 'selector'=>'a:hover',

				'description'=>'This color effects all of the link color on "hover" state in this theme.'),	

			__('SELECTION TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_selection_text_clor',

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'::selection, ::-moz-selection'),

			__('SELECTION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_selection_background',

				'default'=>'#4f4f4f', 'attr'=>array('background-color'), 'selector'=>'::selection, ::-moz-selection',

				'description'=>'This is the background color when the text is selected ( hightlight ) on your site.'),

			__('SIDEBAR LINK COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sidebar_link_color',

				'default'=>'#606060', 'attr'=>array('color'), 'selector'=>'.sidebar-wrapper a' ),

			__('SIDEBAR LINK HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sidebar_link_hover_color',

				'default'=>'#9c9c9c', 'attr'=>array('color'), 'selector'=>'.sidebar-wrapper a:hover' ),

			__('SIDEBAR TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sidebar_title_color',

				'default'=>'#303030', 'attr'=>array('color'), 'selector'=>'.custom-sidebar-title, .custom-sidebar-title a' ),

			__('SIDEBAR INFO COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sidebar_info_color',

				'default'=>'#aaaaaa', 'attr'=>array('color'), 'selector'=>'.sidebar-wrapper .recent-post-widget-info, .sidebar-wrapper #twitter_update_list' ),				

			__('POST/PORT WIDGET FRAME', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_widget_frame_background',

				'default'=>'#eeeeee', 'attr'=>array('background-color'), 

				'selector'=>'div.recent-port-widget .recent-port-widget-thumbnail, div.recent-post-widget .recent-post-widget-thumbnail, div.custom-sidebar .flickr_badge_image' ),		

			__('TAG CLOUD BACKGROUND COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tagcloud_background',

				'default'=>'#f5f5f5', 'attr'=>array('background-color'), 'selector'=>'.tagcloud a' ),					

		),

		

		'gdl_panel_footer' => array(		

			__('FOOTER LINK COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_link_color',

				'default'=>'#8c8c8c', 'attr'=>array('color'), 'selector'=>'.footer-wrapper a', 

				'description'=>'This color changes all of the link color inside footer in normal state.'),

			__('FOOTER LINK HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_link_hover_color',

				'default'=>'#e6e6e6', 'attr'=>array('color'), 'selector'=>'.footer-wrapper a:hover', 

				'description'=>'This is the link color of footer frame in "hover" state.'),

			__('FOOTER TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_title_color',

				'default'=>'#ececec', 'attr'=>array('color'), 'selector'=>'.footer-wrapper .custom-sidebar-title, .footer-wrapper .custom-sidebar-title a' ),	

			__('FOOTER CONTENT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_content_color',

				'default'=>'#bababa', 'attr'=>array('color'), 'selector'=>'.footer-wrapper, .footer-wrapper table th'),	

			__('FOOTER CONTENT INFO COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_content_info_color',

				'default'=>'#b1b1b1', 'attr'=>array('color'), 'selector'=>'.footer-wrapper .recent-post-widget-info, .footer-wrapper #twitter_update_list',

				'description' =>'The content info is the color of the post date( in post/portfolio widget ) and twitter widget'),	

			__('FOOTER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_background',

				'default'=>'#030303', 'attr'=>array('background-color'), 'selector'=>'div.footer-wrapper'),

			__('FOOTER DIVIDER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_divider_color', 

				'default'=>'#3b3b3b', 'attr'=>array('border-color'), 'selector'=>'div.footer-wrapper *'),

			__('FOOTER INPUT BOX TEXT', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_input_text', 

				'default'=>'#f0f0f0', 'attr'=>array('color'), 

				'selector'=>'div.footer-wrapper div.contact-form-wrapper input[type="text"], div.footer-wrapper div.contact-form-wrapper input[type="password"], ' .

					'div.footer-wrapper div.contact-form-wrapper textarea, div.footer-wrapper div.custom-sidebar #search-text input[type="text"]'),

			__('FOOTER INPUT BOX BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_input_background', 

				'default'=>'#292929', 'attr'=>array('background-color'), 

				'selector'=>'div.footer-wrapper div.contact-form-wrapper input[type="text"], div.footer-wrapper div.contact-form-wrapper input[type="password"], ' .

					'div.footer-wrapper div.contact-form-wrapper textarea, div.footer-wrapper div.custom-sidebar #search-text input[type="text"]'),

			__('FOOTER INPUT BOX BORDER', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_input_border', 

				'default'=>'#292929', 'attr'=>array('border-color'), 

				'selector'=>'div.footer-wrapper div.contact-form-wrapper input[type="text"], div.footer-wrapper div.contact-form-wrapper input[type="password"], ' .

					'div.footer-wrapper div.contact-form-wrapper textarea, div.footer-wrapper div.custom-sidebar #search-text input[type="text"]'),

			__('FOOTER BUTTON TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_button_text', 

				'default'=>'#424242', 'attr'=>array('color'), 'selector'=>'.footer-wrapper .contact-form-wrapper button'),

			__('FOOTER BUTTON BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_button_color', 

				'default'=>'#f2f2f2', 'attr'=>array('background-color'), 'selector'=>'.footer-wrapper .contact-form-wrapper button',

				'description' =>'This color is for the submit button of contact widget.'),

			__('FOOTER PERSONNAL INFO', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_personnal_widget_info', 

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.footer-wrapper .personnal-widget-item .personnal-widget-info'),				

			__('FOOTER TAG CLOUD BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_tagcloud_background', 

				'default'=>'#292929', 'attr'=>array('background-color'), 'selector'=>'div.footer-wrapper .tagcloud a'),

			__('FOOTER POST/PORT WIDGET FRAME', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_post_widget_frame_background',

				'default'=>'#2d2d2d', 'attr'=>array('background-color'), 

				'selector'=>'div.footer-wrapper div.recent-port-widget .recent-port-widget-thumbnail, div.footer-wrapper div.recent-post-widget .recent-post-widget-thumbnail,' . 

							'div.footer-wrapper .custom-sidebar .flickr_badge_image'),					

			__('COPYRIGHT TEXT COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_copyright_text', 

				'default'=>'#787878', 'attr'=>array('color'), 'selector'=>'.copyright-container'),

			__('COPYRIGHT BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_copyright_background', 

				'default'=>'#2b2b2b', 'attr'=>array('background-color'), 'selector'=>'.copyright-outer-wrapper'),

		),

		

		'gdl_panel_slider' => array(

			__('TOP SLIDER CAPTION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_top_slider_caption_color',

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.gdl-top-slider .custom-caption-row .custom-caption span' ),

			__('SLIDER TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_title_color',

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'h2.gdl-slider-title' ),

			__('SLIDER TITLE BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_title_background',

				'default'=>'#A92727', 'attr'=>array('background-color'), 'selector'=>'h2.gdl-slider-title'),

			__('SLIDER CAPTION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_caption_color',

				'default'=>'#d4d4d4', 'attr'=>array('color'), 'selector'=>'div.gdl-slider-caption'),	

			__('SLIDER CAPTION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_caption_background',

				'default'=>'#333333', 'attr'=>array('background'), 'selector'=>'div.gdl-slider-caption'),		

			__('SLIDER BULLET COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_bullet_color',

				'default'=>'#c9c9c9', 'attr'=>array('background-color'), 

				'selector'=>'.flex-control-nav li a, .nivo-controlNav a, div.anythingSlider .anythingControls ul a, div.custom-slider-nav a'),

			__('SLIDER BULLET ACTIVE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_bullet_active',

				'default'=>'#030303', 'attr'=>array('background'), 

				'selector'=>'.flex-control-nav li a:hover, .flex-control-nav li a.flex-active, ' . 

							'.nivo-controlNav a:hover, .nivo-controlNav a.active, div.custom-slider-nav a.activeSlide,' .

							'div.anythingSlider .anythingControls ul a.cur, div.anythingSlider .anythingControls ul a:hover '),										

			__('SLIDER THUMBNAIL BACKGROUND ( CAROUSEL )', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_thumbnail_background',

				'default'=>'#000000', 'attr'=>array('background-color'), 'selector'=>'.flex-carousel.carousel-included'),					

			__('STUNNING TEXT TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_title_color',

				'default'=>'#a4a4a4', 'attr'=>array('color'), 'selector'=>'h1.stunning-text-title' ),

			__('STUNNING TEXT BACKGROUND COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_background_color',

				'default'=>'#f4f4f4', 'attr'=>array('background-color'), 'selector'=>'.stunning-text-wrapper'),		

			__('STUNNING TEXT BOTTOM BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_border',

				'default'=>'#606060', 'attr'=>array('border-color'), 'selector'=>'body .stunning-text-wrapper'),

		),

			

		'gdl_panel_blog_pagination' => array(			

			__('BLOG TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_title_color',

				'default'=>'#303030', 'attr'=>array('color'), 'selector'=>'h2.blog-title a, h1.blog-title a' ),

			__('BLOG TITLE HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_title_hover_color',

				'default'=>'#9c9c9c', 'attr'=>array('color'), 'selector'=>'h2.blog-title a:hover, h1.blog-title a:hover',

				'description'=>'This is the blog thumbnail title color in "hover" state.'),				

			__('BLOG INFO COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_info_color',

				'default'=>'#4a4a4a', 'attr'=>array('color'), 'selector'=>'div.gdl-blog-widget .blog-author a, div.gdl-blog-widget .blog-comment a'),

			__('BLOG INFO HEAD COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_info_title_color',

				'default'=>'#bababa', 'attr'=>array('color'), 'selector'=>'div.gdl-blog-widget .blog-tag a, div.gdl-blog-widget .blog-date a, div.blog-info-wrapper'),				

			__('BLOG ABOUT AUTHOR BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_about_author_color',

				'default'=>'#f5f5f5', 'attr'=>array('background-color'), 'selector'=>'.about-author-wrapper',

				'description'=>'The author item is located in the blog page, you can enable/disable it using the post/portfolio options.'),

			__('PAGINATION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_background',

				'default'=>'#f5f5f5', 'attr'=>array('background-color'), 'selector'=>'div.gdl-pagination a'),

			__('PAGINATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_text',

				'default'=>'#7b7b7b', 'attr'=>array('color'), 'selector'=>'div.gdl-pagination a'),

			__('PAGINATION HOVER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_hover_background',

				'default'=>'#4d4d4d', 'attr'=>array('background-color'), 'selector'=>'div.gdl-pagination a:hover'),

			__('PAGINATION HOVER TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_hover_text',

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.gdl-pagination a:hover'),	

			__('PAGINATION CURRENT BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_current_background',

				'default'=>'#4d4d4d', 'attr'=>array('background-color'), 'selector'=>'div.gdl-pagination span'),

			__('PAGINATION CURRENT TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_current_text',

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.gdl-pagination span'),						

		),			

		

		'gdl_panel_portfolio' => array(

			__('THUMBNAIL HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_thumbnail_hover_color',

				'default'=>'#be0f0f', 'attr'=>array('background-color'), 'selector'=>'div.portfolio-media-wrapper div.portfolio-thumbnail-image-hover'),					

			__('PORT TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_title_color',

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'.portfolio-item .portfolio-context .portfolio-title a',

				'description'=>'This is the portfolio item title color.'),

			__('PORT TAG COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_tag_color',

				'default'=>'#fee7e7', 'attr'=>array('color'), 'selector'=>'.portfolio-item .portfolio-context .portfolio-tag, .portfolio-item .portfolio-context .portfolio-tag a'),				

			__('PORT INFO COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_info_color',

				'default'=>'#c2c2c2', 'attr'=>array('color'), 'selector'=>'div.single-portfolio .port-info'),

			__('PORT INFO HEAD COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_info_head_color',

				'default'=>'#6b6b6b', 'attr'=>array('color'), 'selector'=>'div.single-portfolio .port-info .head'),	

			

			__('PORT NAV BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_carousel_nav',

				'default'=>'#b9b9b9', 'attr'=>array('background-color'), 

				'selector'=>'div.portfolio-carousel-wrapper .port-nav, div.single-portfolio .port-nav a, div.gdl-carousel-testimonial .testimonial-navigation a'),

			__('PORT NAV BACKGROUND HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_carousel_nav_hover',

				'default'=>'#595959', 'attr'=>array('background-color'), 

				'selector'=>'div.portfolio-carousel-wrapper .port-nav:hover, div.single-portfolio .port-nav a:hover, div.gdl-carousel-testimonial .testimonial-navigation a:hover'),					

		),

		

		// ** set default color in both style-custom.php and theme-customizer.php file.

		'gdl_panel_contact_form' => array(

			__('CONTACT/COMMENT BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_background_color','default'=>'#ffffff',

				'description'=>'This is a background color of textbox and textarea in contact form and comments area.'),

			__('CONTACT/COMMENT TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_text_color','default'=>'#888888',

				'description'=>'This is a text color of textbox and textarea in contact form and comments area.'),

			__('CONTACT/COMMENT BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_border_color','default'=>'#e3e3e3'),

			__('CONTACT/COMMENT FRAME', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_frame_color','default'=>'#f7f7f7'),

			__('CONTACT/COMMENT INNER SHADOW', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_inner_shadow','default'=>'#ececec',

				'description'=>'An inner shadow of the textbox and textarea in contact form and comments area.'),

		),		



		

		'gdl_panel_price_personnal_item' => array(

			__('PRICE TAG COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_tag_color', 

				'default'=>'#404040', 'attr'=>array('color'), 'selector'=>'div.price-item .price-tag'),

			__('PRICE TAG SUFFIX COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_tag_suffix', 

				'default'=>'#a5a5a5', 'attr'=>array('color'), 'selector'=>'div.price-item .price-tag .price-suffix'),		

			__('PRICE TAG BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_tag_background', 

				'default'=>'#fafafa', 'attr'=>array('background-color'), 'selector'=>'div.price-item .price-tag'),

			__('PRICE TAG INNER BORDER', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_tag_border', 

				'default'=>'#ffffff', 'attr'=>array('border-color'), 'selector'=>'div.price-item .price-tag'),		

			__('PRICE CONTENT COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_content_color', 

				'default'=>'#868686', 'attr'=>array('color'), 'selector'=>'div.price-item'),

			__('PRICE BUTTON BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_button_background', 

				'default'=>'#5b5b5b', 'attr'=>array('background-color'), 'selector'=>'div.price-item .price-button'),

			__('PRICE BUTTON TEXT', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_button_text', 

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.price-item .price-button'),	

			__('PRICE TAG ACTIVE COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_tag_active_color', 

				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.best-price .price-tag, div.price-item .price-tag .price-suffix'),				

			__('PRICE TAG ACTIVE BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_tag_active_background', 

				'default'=>'#c82828', 'attr'=>array('background-color'), 'selector'=>'div.best-price .price-tag'),

			__('PRICE ACTIVE TOP BORDER', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_active_border', 

				'default'=>'#c82828', 'attr'=>array('border-top-color', 'border-bottom-color'), 'selector'=>'div.best-active'),			

			__('PRICE ACTIVE BUTTON BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_active_button_background', 

				'default'=>'#c82828', 'attr'=>array('background-color'), 'selector'=>'div.price-item .price-button'),				

			__('PERSONNAL BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_background', 

				'default'=>'#f7f7f7', 'attr'=>array('background-color'), 'selector'=>'div.personnal-item'),

			__('PERSONNAL POSITION TEXT', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_position_text', 

				'default'=>'#9d9d9d', 'attr'=>array('color'), 'selector'=>'div.personnal-item .personnal-position'),

			__('PERSONNAL TITLE', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_title', 

				'default'=>'#353535', 'attr'=>array('color'), 'selector'=>'div.personnal-item .personnal-title'),

			__('PERSONNAL THUMBNAIL BORDER', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_thumbnail_border', 

				'default'=>'#9e9e9e', 'attr'=>array('border-color'), 'selector'=>'div.personnal-item .personnal-thumbnail'),

			__('PERSONNAL CONTENT', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_content', 

				'default'=>'#b0b0b0', 'attr'=>array('color'), 'selector'=>'div.personnal-item .personnal-content'),			

			__('PERSONNAL WIDGET INFO', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_widget_info', 

				'default'=>'#4a4a4a', 'attr'=>array('color'), 'selector'=>'div.personnal-widget-item .personnal-widget-info'),						

		),		



		'gdl_panel_additional_elements' => array(				

			__('ACCORDION TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_accordion_title',

				'default'=>'#404040', 'attr'=>array('color'), 'selector'=>'ul.gdl-accordion li .accordion-title, ul.gdl-toggle-box li .toggle-box-title'),

			__('BLOCKQUOTE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_blockquote_color',

				'default'=>'#ababab', 'attr'=>array('color'), 'selector'=>'blockquote'),

			__('BLOCKQUOTE BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_blockquote_border',

				'default'=>'#cfcfcf', 'attr'=>array('border-color'), 'selector'=>'body blockquote'),

			__('BUTTON BACKGROUND COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_button_background_color',

				'default'=>'#3e3e3e', 'attr'=>array('background-color'), 'selector'=>'a.gdl-button, body button, input[type="submit"], input[type="reset"], input[type="button"]'),					

			__('BUTTON TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_button_text_color',

				'default'=>'#dddddd', 'attr'=>array('color'), 'selector'=>'a.gdl-button, body button, input[type="submit"], input[type="reset"], input[type="button"]'),			

			__('COLUMN SERVICE TOP BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_column_service_top_border',

				'default'=>'#f3f3f3', 'attr'=>array('border-color'), 'selector'=>'body .column-service-wrapper'),	

			__('COLUMN SERVICE TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_column_service_title_color',

				'default'=>'#808080', 'attr'=>array('color'), 'selector'=>'h2.column-service-title'),

			__('COLUMN SERVICE CAPTION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_column_service_caption_background',

				'default'=>'#000000', 'attr'=>array('background-color'), 'selector'=>'div.column-service-caption'),	

			__('COLUMN SERVICE CAPTION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_column_service_caption_color',

				'default'=>'#c7c7c7', 'attr'=>array('color'), 'selector'=>'div.column-service-caption'),	

			__('DIVIDER LINE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_divider_line',

				'default'=>'#e6e6e6', 'attr'=>array('border-color'), 'selector'=>'body *',

				'description'=>'This is the color of all divider inside the container( excluding divider of the footer ).'),

			__('DIVIDER ITEM BACK TO TOP TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_back_to_top_text_color',

				'default'=>'#919191', 'attr'=>array('color'), 'selector'=>'.scroll-top',

				'description'=>'This is the back to top text color of the divider item ( create from page items or shortcode ).'),				

			__('FEATURE SERVICE 1 TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_feature_service_1_text_color',

				'default'=>'#a5a5a5', 'attr'=>array('color'), 'selector'=>'div.feature-service-1 .feature-service-description span'),

			__('FEATURE SERVICE 1 HILIGHT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_feature_service_1_highlight_color',

				'default'=>'#f5f5f5', 'attr'=>array('background-color'), 'selector'=>'div.feature-service-1 .feature-service-description span'),	

			__('FEATURE SERVICE 2 TITLE', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_feature_service_2_title',

				'default'=>'#383838', 'attr'=>array('color'), 'selector'=>'div.feature-service-2 .feature-service-title'),

			__('FEATURE SERVICE 2 CAPTION', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_feature_service_2_caption',

				'default'=>'#d2d2d2', 'attr'=>array('color'), 'selector'=>'div.feature-service-2 .feature-service-caption'),					

		),

		

		'gdl_panel_additional_elements_2' => array(		

			__('TABLE BORDER (TABLE TAG)', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_table_border',

				'default'=>'#e5e5e5', 'attr'=>array('border-color'), 'selector'=>'table, table tr, table tr td, table tr th' ),

			__('TABLE TITLE TEXT COLOR (TH TAG)', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_table_text_title',

				'default'=>'#666666', 'attr'=>array('color'), 'selector'=>'table th'),

			__('TABLE TITLE BACKGROUND (TH TAG)', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_table_title_background',

				'default'=>'#fdfdfd', 'attr'=>array('background-color'), 'selector'=>'table th'),		

			__('TAB ACTIVE BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_background_color',

				'default'=>'#ffffff', 'attr'=>array('background-color'), 

				'selector'=>'div.gdl-tab ul.gdl-tab-content, div.gdl-tab ul.gdl-tab-title a.active'),

			__('TAB ACTIVE TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_text_color',

				'default'=>'#a6a6a6', 'attr'=>array('color'), 'selector'=>'div.gdl-tab ul.gdl-tab-content' ),

			__('TAB ACTIVE TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_active_text_color',

				'default'=>'#575757', 'attr'=>array('color'), 'selector'=>'div.gdl-tab ul.gdl-tab-title a.active' ),				

			__('TAB ACTIVE TITLE BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_active_title_border',

				'default'=>'#c82828', 'attr'=>array('border-top-color'), 'selector'=>'div.gdl-tab ul.gdl-tab-title li a.active' ),	

			__('TAB TITLE TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_title_text',

				'default'=>'#959595', 'attr'=>array('color'), 'selector'=>'div.gdl-tab ul.gdl-tab-title a' ),	

			__('TAB TITLE BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_title_background',

				'default'=>'#fafafa', 'attr'=>array('background-color'), 'selector'=>'div.gdl-tab ul.gdl-tab-title a' ),		

			__('TESTIMONIAL (SLIDE) CONTENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_slide_content',

				'default'=>'#9d9d9d', 'attr'=>array('color'), 'selector'=>'div.gdl-carousel-testimonial .testimonial-content'),

			__('TESTIMONIAL (SLIDE) INFO', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_slide_info',

				'default'=>'#656565', 'attr'=>array('color'), 'selector'=>'div.gdl-carousel-testimonial .testimonial-info'),

			__('TESTIMONIAL (SLIDE) BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_slide_background',

				'default'=>'#f8f8f8', 'attr'=>array('background-color'), 'selector'=>'div.gdl-carousel-testimonial .testimonial-content'),	

			__('TESTIMONIAL (STATIC) CONTENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_static_content_color',

				'default'=>'#c9c9c9', 'attr'=>array('color'), 'selector'=>'div.gdl-static-testimonial .testimonial-item'),

			__('TESTIMONIAL (STATIC) BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_static_border',

				'default'=>'#d9d9d9', 'attr'=>array('border-color'), 'selector'=>'div.gdl-static-testimonial .testimonial-item'),

			__('TESTIMONIAL (STATIC) INFO', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_static_info',

				'default'=>'#999999', 'attr'=>array('color'), 'selector'=>'div.gdl-static-testimonial .testimonial-info'),				

		),

		

		'gdl_panel_load_default_color' => array(

			__('LOAD DEFAULT ELEMENTS COLOR','gdl_back_office')=>array('type'=>'button','text'=>'Load Default','id'=>'gdl_load_default_color_button',

				'description'=>'Click this button to load the default elements color of this theme. Then click save changes to save the default value. <br><br> ' .

				'WARNING : All of settings cannot be undo after you click save changes button.')

		),

		

		// Translator

		'gdl_panel_enable_admin_translator' => array(

			__('ENABLE ADMIN TRANSLATOR', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=>THEME_SHORT_NAME.'_enable_admin_translator')

		),

		

		'gdl_panel_blog_port_translator' => array(

			__('SOCIAL SHARE (BLOG/PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_social_shares','default'=>'Social Share'),

			__('LEAVE A REPLY (BLOG)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_leave_reply','default'=>'Leave a Reply'),

			__('ABOUT THE AUTHOR (BLOG)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_about_author','default'=>'About the Author'),

			__('READ THE BLOG (BLOG)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_read_the_blog','default'=>'Read The Blog'),



			__('VIEW ALL PORTFOLIO (PORTFOLIO TITLE)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_view_all_portfolio','default'=>'View All Portfolio'),			

			__('ALL (PORTFOLIO FILTER)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_all','default'=>'All'),			

			__('TAG (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_tag','default'=>'Tags /'),

			__('CLIENT (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_client','default'=>'Clients /'),

			__('SKILL (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_skill','default'=>'Skills Used /'),

			__('VISIT WEBSITE (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_visit_website','default'=>'View Project'),

			__('RELATED PORTFOLIO (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_related_portfolio','default'=>'Related Portfolio'),

			

		),

		

		'gdl_panel_contact_form_translator' => array(

			__('NAME (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_name_contact_form','default'=>'Name'),

			__('NAME ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_name_error_contact_form','default'=>'Please enter your name'),

			__('EMAIL (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_email_contact_form','default'=>'Email'),

			__('EMAIL ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_email_error_contact_form','default'=>'Please enter a valid email address'),

			__('MESSAGE (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_message_contact_form','default'=>'Message'),

			__('MESSAGE ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_message_error_contact_form','default'=>'Please enter message'),

			__('SUBMIT BUTTON (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_submit_contact_form','default'=>'Submit'),

			__('SEND ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_contact_send_error','default'=>'Message cannot be sent to destination'),

			__('SEND COMPLETE (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_contact_send_complete','default'=>'The e-mail was sent successfully'),

		),



		'gdl_panel_additional_elements_translator' => array(

			__('READ MORE (PRICE ITEM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_read_more_price','default'=>'Read More'),

			__('404 TITLE (404 PAGE)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_404_title','default'=>'Page Not Found'),

			__('404 CONTENT (404 PAGE)', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_404_content','default'=>"The page you are looking for doesn't seem to exist."),

			__('SEARCH NOT FOUND TITLE (SEARCH PAGE)', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_search_not_found_title','default'=>"Search Not Found."),

			__('SEARCH NOT FOUND (SEARCH PAGE)', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_search_not_found','default'=>"Sorry, but nothing matched your search criteria. Please try again with some different keywords."),

		),

		

		// Slider Setting

		'gdl_panel_nivo_slider' => array(

			__('SLIDER EFFECTS', 'gdl_back_office')=>array(

				'type'=>'combobox',

				'oldname'=>'effect',

				'name'=>THEME_SHORT_NAME.'_nivo_slider_effect',

				'options'=>array(

					'0'=>'sliceDown', '1'=>'sliceDownLeft', '2'=>'sliceUp',

					'3'=>'sliceUpLeft', '4'=>'sliceUpDown', '5'=>'sliceUpDownLeft',

					'6'=>'fold', '7'=>'fade', '8'=>'random',

					'9'=>'slideInRight', '10'=>'slideInLeft', '11'=>'boxRandom',

					'12'=>'boxRain', '13'=>'boxRainReverse', '14'=>'boxRainGrow',

					'15'=>'boxRainGrowReverse')),

			__('PAUSE ON HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_SHORT_NAME.'_nivo_slider_pause_on_hover',

				'description'=>'Pause the nivo slider when user hover at the slider.'),

			__('SHOW BULLETS', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_SHORT_NAME.'_nivo_slider_show_bullets',

				'description'=>'Enable to show the nivo slider navigation bullets.'),

			__('SHOW LEFT/RIGHT NAVIGATION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_SHORT_NAME.'_nivo_slider_show_navigation',

				'description'=>'Enable left/right navigation of the nivo slider.'),

			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'animSpeed','name'=>THEME_SHORT_NAME.'_nivo_slider_animation_speed','default'=>'500',

				'description'=>'This is the animation speed during the change of each slide.'),

			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'pauseTime','name'=>THEME_SHORT_NAME.'_nivo_slider_pause_time','default'=>'12000',

				'description'=>'This option is the pause time of each slider.'),

		),

		

		'gdl_panel_plugin_enable' => array(

			__('COMMENT CAPTCHA', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=>THEME_SHORT_NAME.'_enable_comment_captcha',

				'description'=>'Disabling this to remove captcha out of the comment.'),

			__('LIGHT BOX THUMBNAIL', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=>THEME_SHORT_NAME.'_enable_lightbox_thumbnail',

				'description'=>'Enabling the lightbox thumbnail. ( When it\'s gallery mode)'),		

			__('LIGHT BOX THUMBNAIL WIDHT', 'gdl_back_office')=>array('type'=>'inputtext', 'name'=>THEME_SHORT_NAME.'_enable_lightbox_thumbnail_width', 'default'=>'80'),

			__('LIGHT BOX THUMBNAIL HEIGHT', 'gdl_back_office')=>array('type'=>'inputtext', 'name'=>THEME_SHORT_NAME.'_enable_lightbox_thumbnail_height', 'default'=>'45'),

		),

		

		'gdl_panel_flex_slider' => array(

			__('SLIDER EFFECTS', 'gdl_back_office')=>array('type'=>'combobox','oldname'=>'animation'

				,'name'=>THEME_SHORT_NAME.'_flex_slider_effect', 'options'=>array('0'=>'fade', '1'=>'slide')),

			__('PAUSE ON HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_SHORT_NAME.'_flex_slider_pause_on_hover',

				'description'=>'Pause the flex slider when user hover at the slider.'),

			__('SHOW BULLETS', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_SHORT_NAME.'_flex_slider_show_bullets',

				'description'=>'Enable to show the flex slider navigation bullets.'),

			__('SHOW NAVIGATION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_SHORT_NAME.'_flex_slider_show_navigation',

				'description'=>'Enable left/right navigation of the flex slider.'),

			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'animationSpeed','name'=>THEME_SHORT_NAME.'_flex_slider_animation_speed','default'=>'600',

				'description'=>'This is the animation speed during the change of each slide.'),

			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'slideshowSpeed','name'=>THEME_SHORT_NAME.'_flex_slider_pause_time','default'=>'12000',

				'description'=>'This option is the pause time of each slider.'),

			__('PAUSE ON ACTION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnAction','name'=>THEME_SHORT_NAME.'_flex_slider_pause_on_action','default'=>'false'),

			__('CAROUSEL THUMBNAIL WIDTH', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'thumbnail_width','name'=>THEME_SHORT_NAME.'_flex_thumbnail_width','default'=>'75'),			

			__('CAROUSEL THUMBNAIL HEIGHT', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'thumbnail_height','name'=>THEME_SHORT_NAME.'_flex_thumbnail_height','default'=>'50'),			

		),

		

		'gdl_panel_anything_slider' => array(

			__('PAUSE ON HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_SHORT_NAME.'_anything_slider_pause_on_hover',

				'description'=>'Pause the anything slider when user hover at the slider.'),

			__('SHOW BULLETS', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'buildNavigation','name'=>THEME_SHORT_NAME.'_anything_slider_show_bulltes',

				'description'=>'Enable to show the anything slider navigation bullets.'),

			__('ONLY SHOW BULLETS WHEN HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'toggleControls','name'=>THEME_SHORT_NAME.'_anything_slider_hover_bulltes', 'default'=>'disable',

				'description'=>'If the bullets navigation is enabled, enable this option will hide the bullets navigation when the mouse cursor is outside the nivo slider frame.'),

			__('SHOW NAVIGATION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'buildArrows','name'=>THEME_SHORT_NAME.'_anything_slider_show_navigation',

				'description'=>'Enable left/right navigation of the anything slider.'),

			__('ONLY SHOW NAVIGATION WHEN HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'toggleArrows','name'=>THEME_SHORT_NAME.'_anything_slider_hover_navigation',

				'description'=>'If the left/right navigation is enabled, enable this option will hide the left/right navigation when the mouse cursor is outside the nivo slider frame.'),

			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'animationTime','name'=>THEME_SHORT_NAME.'_anything_slider_animation_speed','default'=>'600',

				'description'=>'This is the animation speed during the change of each slide.'),

			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'delay','name'=>THEME_SHORT_NAME.'_anything_slider_pause_time','default'=>'12000',

				'description'=>'This option is the pause time of each slider.'),

		),

		

		'gdl_panel_custom_slider' => array(

			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'speed','name'=>THEME_SHORT_NAME.'_custom_slider_animation_speed','default'=>'600',

				'description'=>'This is the animation speed during the change of each slide.'),

			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'timeout','name'=>THEME_SHORT_NAME.'_custom_slider_pause_time','default'=>'10000',

				'description'=>'This option is the pause time of each slider.'),

			__('PARALLAX SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'parallax','name'=>THEME_SHORT_NAME.'_custom_slider_parallax_speed','default'=>'3',

				'description'=>'You can increse this value to slow down the vertical slide speed when you scroll the page. ( You can input negative value to stop the vertical slide )'),				

		),						

		

		'gdl_panel_disable_right_click' => array(

			__('DISABLE RIGHT CLICK', 'gdl_back_office')=>array('type'=>'radioenabled','name'=> THEME_SHORT_NAME.'_disable_right_click', 'default'=>'disable'),

			__('ALERT MSG', 'gdl_back_office')=>array('type'=>'textarea','name'=> THEME_SHORT_NAME.'_right_click_alert',

				'description'=>'If this filed is not empty, there\'ll be alert box show up when user using the right click.'),

		),		

		

	);

	

	// add action to embeded the panel in to dashboard

	add_action('admin_menu','add_goodlayers_panel');

	function add_goodlayers_panel(){

	

		$page = add_menu_page('GoodLayers Option', THEME_FULL_NAME, 'administrator', 'goodlayers_admin_panel', 'create_goodlayers_panel' /*,  GOODLAYERS_PATH.'/include/images/portfolio-icon.png' */);

		

		add_action('admin_print_scripts-' . $page,'register_goodlayers_panel_scripts');

		add_action('admin_print_styles-' . $page,'register_goodlayers_panel_styles');

		

	}

	

	// add ajax action to hook the functions when save button is pressed 

	add_action('wp_ajax_save_goodlayers_panel','save_goodlayers_panel');

	function save_goodlayers_panel(){

	

		check_ajax_referer(plugin_basename(__FILE__),'security');

		

		global $goodlayers_element;

		

		$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');

		

		foreach($goodlayers_element as $elements){

		

			foreach($elements as $element){

			

				// when save sidebar

				if($element['type'] == 'sidebar'){

				

					$sidebar_xml = '<sidebar>';

					if( !empty( $_POST[$element['name']] ) ){

						$sidebar = $_POST[$element['name']];     

					}else{

						$sidebar = array();

					}

					

					foreach($sidebar as $sidebar_name){

					

						$sidebar_xml = $sidebar_xml . create_xml_tag('name',$sidebar_name);

						

					}

					

					$sidebar_xml = $sidebar_xml . '</sidebar>';

					

					if(!save_option($element['name'], get_option($element['name']), $sidebar_xml)){

					

						die( json_encode($return_data) );

						

					}

					

				// when save uploaded font

				}else if($element['type'] == 'uploadfont'){

				

					$uploadfont_xml = '<uploadfont>';

					if( !empty($_POST[$element['name']]) && !empty($_POST[$element['file']]) ){

						$uploadfont = $_POST[$element['name']];

						$uploadfont_file = $_POST[$element['file']];

						$num = sizeof($uploadfont);

						

						for($i=0; $i<$num; $i++){

						

							$uploadfont_xml = $uploadfont_xml . '<font>';

							$uploadfont_xml = $uploadfont_xml . create_xml_tag('name', $uploadfont[$i]);

							$uploadfont_xml = $uploadfont_xml . create_xml_tag('file', $uploadfont_file[$i]);

							$uploadfont_xml = $uploadfont_xml . '</font>';

							

						}

					}

					$uploadfont_xml = $uploadfont_xml . '</uploadfont>';

					

					if(!save_option($element['name'], get_option($element['name']), $uploadfont_xml)){

					

						die( json_encode($return_data) );

						

					}

					

				// do nothing with dummy button

				}else if($element['type'] == 'dummy'){

				

				}else if( !empty($element['name']) ){

					if( !empty( $_POST[$element['name']] ) ){

						$new_option_value = str_replace( "\'" , "'", $_POST[$element['name']]);

						$new_option_value = str_replace( '\"' , '"', $new_option_value);

						$new_option_value = str_replace( '\\\\' , '\\' , $new_option_value);

					}else{

						$new_option_value = '';

					}

					

					if(!save_option($element['name'], get_option($element['name']), $new_option_value)){

					

						die( json_encode($return_data) );

						

					}

					

				}

				

			}

			

		}

		

		// call the function to generate the style-custom.css file.

		gdl_generate_style_custom();

		

		die( json_encode( array('success'=>'0') ) );

		

	}

	

	// update the option if new value is exists and not equal to old one 

	function save_option($name, $old_value, $new_value){

	

		if(empty($new_value) && !empty($old_value)){

		

			if(!delete_option($name)){

			

				return false;

				

			}

			

		}else if($old_value != $new_value){

		

			if(!update_option($name, $new_value)){

			

				return false;

				

			}

			

		}

		

		return true;

		

	}

	

	// start creating the goodlayers panel ( by calling function to create menu and elements )

	function create_goodlayers_panel(){

	

		global $goodlayers_menu;

		global $goodlayers_element;		

		

		?>

		

		<form name="goodlayer-panel-form" id="goodlayer-panel-form">

			<div class="goodlayers-panel-wrapper">

			<?php

				

				echo '<div class="panel-menu">';

				echo '<div class="panel-menu-header"><div class="panel-menu-header-strap"></div>';

				echo '<img src="' . GOODLAYERS_PATH . '/include/images/admin-panel-logo.png" alt="goodlayers"/>';

				echo '</div>';

				

					create_goodlayers_menu($goodlayers_menu);

					

				echo '</div>';

				echo '<div class="panel-elements" id="panel-elements">';

				echo '<div class="panel-element-head"><div class="panel-element-header-strap"></div>';

				

				echo '<div class="panel-header-left-text">';

				echo '<div class="panel-goodlayers-text">goodlayers</div>';

				echo '<div class="panel-admin-panel-text">admin panel</div>';

				echo '</div>';

				

				echo '<div class="head-save-changes"><div class="loading-save-changes"></div>';

				echo '<input type="submit" value="' . __('Save Changes','gdl_back_office') . '">';

				echo '</div>';	

				echo '</div>';	

				

				echo '<div class="panel-element" id="panel-element-save-complete">';

				echo '<div class="panel-element-save-text">Save Options Complete.</div>';

				echo '<div class="panel-element-save-arrow"></div></div>';

			

					create_goodlayers_elements($goodlayers_element);

				

				echo '<div class="panel-element-tail">';

				echo '<div class="tail-save-changes"><div class="loading-save-changes"></div>';

				echo '<input type="submit" value="' . __('Save Changes','gdl_back_office') . '">';

				echo '</div>';						

				echo '</div>';						

				echo '<input type="hidden" name="action" value="save_goodlayers_panel">';

				echo '<input type="hidden" name="security" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '">';

				echo '</div>';	

				

			?>



			</div>

		</form>

		

		<?php

	}

	

	// Create accordion menu

	function create_goodlayers_menu($menu){

	

		echo '<div id="panel-nav"><ul>';

		

		foreach($menu as $title=>$sub_menu){ 

		

			echo '<li>';

			echo '<a id="parent" href="#" >';

			echo '<div class="top-menu-bar"></div>';

			echo '<div class="top-menu-image"><img src="' . GOODLAYERS_PATH . '/include/images/admin-panel/' . str_replace(' ', '', $title) . '.png"/></div>';

			echo '<span class="top-menu-text">' . __($title, 'gdl_back_office') . '</span>';

			echo '</a>';

			echo '<ul>';

			

			foreach($sub_menu as $sub_title=>$name){

			

				echo '<li>';

				echo '<a id="children" href="#" rel=' . $name . '>';

				echo '<div class="child-menu-image"></div>';

				echo '<span class="child-menu-text">' . __($sub_title, 'gdl_back_office') . '</span>';

				echo '</a>';

				echo '</li>';

				

			}

			

			echo '</ul>';

			echo '</li>';

			

		}

		

		echo '</ul></div>';

		

	}

	

	// decide to create each input element base on the receiving key of elements

	function create_goodlayers_elements($elements){

	

		foreach($elements as $key => $element){

		

			echo '<div class="panel-element" id=' . $key . '>';



				foreach($element as $key => $values){

				

					if( !empty($values['name']) ){

						$values['value'] = get_option($values['name']);

						$values['default'] = (isset($values['default']))? $values['default']: '';

					}

					

					switch($values['type']){

					

						case 'upload': print_panel_upload($key, $values); break;

						case 'inputtext': print_panel_input_text($key, $values); break;

						case 'textarea': print_panel_input_textarea($key, $values); break;

						case 'radioenabled': print_panel_radio_enabled($key, $values); break;

						case 'radioimage' : print_panel_radioimage($key, $values); break;

						case 'combobox': print_panel_combobox($key, $values); break;

						case 'font-combobox': print_panel_font_combobox($key, $values); break;

						case 'colorpicker': print_panel_color_picker($key, $values); break;

						case 'sliderbar': print_panel_sliderbar($key, $values); break;

						case 'sidebar': print_panel_sidebar($key, $values); break;

						case 'uploadfont': print_panel_upload_font($key, $values); break;

						case 'button': print_panel_button($key, $values); break;

						case 'dummy': print_panel_dummy(); break;

						

					}

					

				}

			

			echo '</div>';

			

		}

		

	}

	

	/*  ---------------------------------------------------------------------

	*	The following section is the template of input elements

	*	---------------------------------------------------------------------

	*/

	

	// Upload => name, value, default

	function print_panel_upload($title, $values){

	

		extract($values);

		if( empty( $body_class ) ){ $body_class = $name; }

		

		?>

			<div class="panel-body body-<?php echo $body_class; ?>">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>

				</div>

				<div class="panel-input">	

					<div class="input-example-image" id="input-example-image">

					<?php 

					

						$image_src = '';

						

						if(!empty($value)){ 

						

							$image_src = wp_get_attachment_image_src( $value, 'full' );

							$image_src = (empty($image_src))? '': $image_src[0];

							$thumb_src_preview = wp_get_attachment_image_src( $value, '150x150');

							echo '<img src="' . $thumb_src_preview[0] . '" />';

							

						} 

						

					?>			

					</div>

					<input name="<?php echo $name; ?>" type="hidden" id="upload_image_attachment_id" value="<?php 

					

						echo ($value == '')? esc_html($default): esc_html($value);

						

					?>" />

					<input id="upload_image_text" class="upload_image_text" type="text" value="<?php echo $image_src; ?>" />

					<input class="upload_image_button" type="button" value="Upload" />

				</div>

				<br class="clear">

			</div>

			

		<?php

		

	}

	

	// text => name, value, default

	function print_panel_input_text($title, $values){

	

		extract($values);

		

		?>

			<div class="panel-body">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>

				</div>

				<div class="panel-input">

					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php 

						

						echo ($value == '')? esc_html($default): esc_html($value);

						

						 ?>" />

				</div>

				<?php if(isset($description)){ ?>

				

					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>

					<div class="panel-description-info-img"></div>

					

				<?php } ?>

				<br class="clear">

			</div>

			

		<?php

	

	}

	

	// textarea => name, value, default

	function print_panel_input_textarea($title, $values){

	

		extract($values);

		if( empty( $body_class ) ){ $body_class = ''; }

		

		?>

		

			<div class="panel-body <?php echo $body_class; ?>">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>

				</div>

				<div class="panel-input">

					<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" ><?php

						

						echo ($value == '')? esc_html($default): esc_html($value);

						

					?></textarea>

				</div>

				<?php if(isset($description)){ ?>

				

					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>

					<div class="panel-description-info-img"></div>

					

				<?php } ?>

				<br class="clear">

			</div>

			

		<?php

		

	}

	

	// radioenabled => name, value

	function print_panel_radio_enabled($title, $values){

	

		extract($values);

		

		?>

		

			<div class="panel-body">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>

				</div>

				<div class="panel-input">

					<label for="<?php echo $name; ?>"><div class="checkbox-switch <?php

						

						echo ($value=='enable' || ($value=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 



					?>"></div></label>

					<input type="checkbox" name="<?php echo $name; ?>" class="checkbox-switch" value="disable" checked>

					<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="checkbox-switch" value="enable" <?php 

						

						echo ($value=='enable' || ($value=='' && empty($default)))? 'checked': ''; 

					

					?>>

				</div>

				<?php if(isset($description)){ ?>

				

					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>

					<div class="panel-description-info-img"></div>

					

				<?php } ?>

				<br class="clear">

			</div>

			

		<?php

		

	}

	

	function print_panel_radioimage($title, $values){

		

		extract($values);

		

		if( empty( $body_class ) ){ $body_class = $name; }

		

		?>

		

			<div class="panel-body body-<?php echo $body_class; ?>">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>

				</div>

				<div class="panel-radioimage">

				

					<?php foreach( $options as $option ){ ?>

					

						<div class='radio-image-wrapper'>

							<label for="<?php echo $option['value']; ?>">

								<img src=<?php echo GOODLAYERS_PATH.$option['image']?> alt=<?php echo $name;?>>

								<div id="check-list"></div>

							</label>

							<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option['value'];?>" <?php 

								if($value == $option['value']){

									echo 'checked';

								}else if($value == '' && $default == $option['value']){

									echo 'checked';

								}

							?> id="<?php echo $option['value']; ?>" class="<?php echo $name; ?>" > 

						</div>

						

					<?php } ?>

					<br class="clear">	

				</div>

			</div>		

		

		<?php

		

	}

	

	// combobox => name, value, options[]

	function print_panel_combobox($title, $values){

	

		extract($values);

		

		if( empty($body) ) $body = "";

		if( empty($id) ) $id = $name;

		if(empty($value)){ $value = $default; } 

		

		?>

		

			<div class="panel-body <?php echo $body; ?>">	

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>

				</div>

				<div class="panel-input">	

					<div class="combobox">

						<select name="<?php echo $name; ?>" id="<?php echo $id; ?>">

						

							<?php foreach($options as $option){ ?>

							

								<option <?php if( $option == esc_html($value) ){ echo 'selected'; }?>><?php echo $option; ?></option>

							

							<?php } ?>

							

						</select>

					</div>

				</div>

				<?php if(isset($description)){ ?>

				

					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>

					<div class="panel-description-info-img"></div>

					

				<?php } ?>

				<br class="clear">

			</div>

			

		<?php

		

	}	

	

	// font-combobox => name, value, options[]

	function print_panel_font_combobox($title, $values){

	

		extract($values);

		if(empty($value)){ $value = $default; } 

		$elements = get_font_array();

		

		?>

		

			<div class="panel-body">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>

				</div>

				<div class="panel-input">	

					<div class="panel-font-sample" id="panel-font-sample"><?php echo FONT_SAMPLE_TEXT; ?></div> 

					<div class="combobox" id="combobox-font-sample">

						<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="gdl-panel-select-font-family">

						

							<?php foreach($elements as $option_name => $status){ ?>

							

								<option <?php if( $option_name==substr(esc_html($value),2) ){ echo 'selected'; }?> <?php echo $status; ?>><?php 

										

										echo ($status=='enabled')?  '- ':'';

										echo $option_name; 

									

									?></option>

							

							<?php } ?>

							

						</select>

					</div>

				</div>

				<?php if(isset($description)){ ?>

				

					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>

					<div class="panel-description-info-img"></div>

					

				<?php } ?>

				<br class="clear">

			</div>

			

		<?php

		

	}	

	

	// colorpicker => name, value, default

	function print_panel_color_picker($title, $values){

	

		extract($values);

		

		?>

		

			<div class="panel-body">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>

				</div>

				<div class="panel-input">

					<input type="text" name="<?php echo $name; ?>" class="color-picker" value="<?php 

												

						if($value == '' || $value == 'transparent'){ 

							if($default == 'transparent'){ echo '#ffffff';

							}else{ echo esc_html($default); }

						}else{ echo esc_html($value); }

						

						?>" default="<?php echo $default; ?>" />

					<div class="color-transparent-wrapper">

						<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="color-transparent" value="transparent" <?php 

							

							if($value == 'transparent' || (empty($value) && $default == 'transparent')) echo 'checked';

							

						?>/> <span class="color-transparent"><label for="<?php echo $name; ?>"> transparent </label></span>

					</div>

				</div>

				<?php if(isset($description)){ ?>

				

					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>

					<div class="panel-description-info-img"></div>

					

				<?php } ?>

				<br class="clear">

			</div>

			

		<?php

	}

	

	// sliderbar => name, value, default

	function print_panel_sliderbar($title, $values){

	

		extract($values);

		

		?>

		

			<div class="panel-body">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>

				</div>

				<div class="panel-input">

					<div id="<?php echo $name; ?>" class="sliderbar" rel="sliderbar"></div>

					<input type="hidden" name="<?php echo $name; ?>" value="<?php echo ($value == '')? esc_html($default): esc_html($value); ?>" >

					<div id="slidertext"><?php echo ($value == '')? esc_html($default): esc_html($value); ?> px</div>

				</div>

				<?php if(isset($description)){ ?>

				

					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>

					<div class="panel-description-info-img"></div>

					

				<?php } ?>

				<br class="clear">

			</div>

			

		<?php

		

	}

	

	// sidebar => name, value

	function print_panel_sidebar($title, $values){

	

		extract($values);

		

		?>

		

		<div class="panel-body" id="panel-body">

			<div class="panel-body-gimmick"></div>

			<div class="panel-title">

				<label> <?php _e($title, 'gdl_back_office'); ?> </label>

			</div>

			<div class="panel-input">

				<input type="text" id="add-more-sidebar" value="type title here" rel="type title here">

				<div id="add-more-sidebar" class="add-more-sidebar"></div>

			</div>

				<?php if(isset($description)){ ?>

				

					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>

					

				<?php } ?>

			<br class="clear">

			<div id="selected-sidebar" class="selected-sidebar">

				<div class="default-sidebar-item" id="sidebar-item">

					<div class="panel-delete-sidebar"></div>

					<div class="slider-item-text"></div>

					<input type="hidden" id="<?php echo $name; ?>">

				</div>

				

				<?php 

				

				if(!empty($value)){

					

					$xml = new DOMDocument();

					$xml->loadXML($value);

					

					foreach( $xml->documentElement->childNodes as $sidebar_name ){

					

				?>

						<div class="sidebar-item" id="sidebar-item">

							<div class="panel-delete-sidebar"></div>

							<div class="slider-item-text"><?php echo $sidebar_name->nodeValue; ?></div>

							<input type="hidden" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo $sidebar_name->nodeValue; ?>">

						</div>

					

				<?php 

					} 

					

				} 

				

				?>

				

			</div>

		</div>

		<?php 

		

	}

	

	// uploadfont => name, value

	function print_panel_upload_font($title, $values){

	

		extract($values);

		

		?>

		

		<div class="panel-body" id="panel-body">

			<div class="panel-body-gimmick"></div>

			<div class="panel-title panel-add-more-title">

				<?php _e($title, 'gdl_back_office'); ?>

			</div>

			<div id="add-more-font" class="add-more-font"></div>

			<br class="clear">

			<div id="added-font" class="added-font">

				<div class="default-font-item" id="font-item">

					<div class="inner-font-item">

						<div class="panel-font-title"><?php _e('Font Name','gdl_back_office'); ?></div>

						<input type="text" id="<?php echo $name; ?>" class="gdl_upload_font_name" readonly>

					</div>

					<div class="inner-font-item">

						<div class="panel-font-title"><?php _e('Font File','gdl_back_office'); ?></div>

						<input type="hidden" id="<?php echo $file; ?>"  class="font-attachment-id">

						<input type="text" class="upload-font-text" readonly>

						<input class="upload-font-button" type="button" value="Upload" />

					</div>

					<div class="panel-delete-font"></div>

				</div>

				<?php 

				

					if(!empty($value)){

						

						$xml = new DOMDocument();

						$xml->loadXML($value);

						

						foreach( $xml->documentElement->childNodes as $each_font ){

						

				?>

				

					<div class="font-item" id="font-item">

						<div class="inner-font-item">

							<div class="panel-font-title"><?php _e('Font Name','gdl_back_office'); ?></div>

							<input type="text" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo find_xml_value($each_font, 'name'); ?>" class="gdl_upload_font_name" readonly>

						</div>

						<div class="inner-font-item">

							<div class="panel-font-title"><?php _e('Font File','gdl_back_office'); ?></div>

							<input type="hidden" name="<?php echo $file; ?>[]" id="<?php echo $file; ?>" class="font-attachment-id" value="<?php 

									$attachment_id = find_xml_value($each_font, 'file'); 

									echo $attachment_id;

								?>" >

							<input type="text" class="upload-font-text" value="<?php echo (empty($attachment_id))? '': wp_get_attachment_url( $attachment_id ); ?>" readonly>

							<input class="upload-font-button" type="button" value="Upload" />

						</div>

						<div class="panel-delete-font"></div>

					</div>

					

				<?php 

				

						}

						

					}

					

				?>

				

			</div>

		</div>

		<?php

		

	}

	

	// print normal button

	function print_panel_button($title, $values){

	

		extract($values);

	

		?>



			<div class="panel-body">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label> <?php _e($title, 'gdl_back_office'); ?> </label>

				</div>

				<div class="panel-input">

					<input type="button" value="<?php echo $text; ?>" id="<?php echo $id; ?>" />

				</div>

				<?php if(isset($description)){ ?>

				

					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>

					<div class="panel-description-info-img"></div>

					

				<?php } ?>

				<br class="clear">

			</div>		

		

		<?php	

	}

	

	// upload dummy data (from xml file)

	function print_panel_dummy(){

		?>



			<div class="panel-body">

				<div class="panel-body-gimmick"></div>

				<div class="panel-title">

					<label> DUMMIES DATA </label>

				</div>

				<div class="panel-input">

					<input type="button" value="Import Dummies Data" id="import-dummies-data" />

					<div id="import-now-loading" class="now-loading"></div>

				</div>

				<div class="panel-description">

					By clicking this button, you can import the dummy post and page to help 

					you create a site that look like theme preview to help you understand the

					function of this theme better. <br><br>

					*** It may takes a while during importing process, make sure not to reload

					the page or make any changes to the database.

				</div>

				<div class="panel-description-info-img"></div>

				<br class="clear">

			</div>		

		

		<?php

	}

?>