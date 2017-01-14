<?php

function child_ts_theme_widgets_init(){
	register_sidebar( array(
        'name' => __( 'Copyright area 1', 'liva' ),
        'id' => 'coyright-area-1',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Copyright area 2', 'liva' ),
        'id' => 'coyright-area-2',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer left', 'liva' ),
        'id' => 'footer-left',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer center', 'liva' ),
        'id' => 'footer-center',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer right', 'liva' ),
        'id' => 'footer-right',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar(array(
        'name' => __( 'My Facebook', 'theretailer' ),
        'id' => 'my_facebook',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}

add_action( 'widgets_init', 'child_ts_theme_widgets_init' );

function daniel_get_social_icons(){
	$gdl_icon_type = get_option(THEME_SHORT_NAME.'_header_icon_type', 'light');
	$gdl_social_icon = array(
		'delicious'=> array('name'=>THEME_SHORT_NAME.'_delicious', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/delicious.png'),
		'deviantart'=> array('name'=>THEME_SHORT_NAME.'_deviantart', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/deviantart.png'),
		'digg'=> array('name'=>THEME_SHORT_NAME.'_digg', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/digg.png'),
		'facebook' => array('name'=>THEME_SHORT_NAME.'_facebook', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/facebook.png'),
		'flickr' => array('name'=>THEME_SHORT_NAME.'_flickr', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/flickr.png'),
		'lastfm'=> array('name'=>THEME_SHORT_NAME.'_lastfm', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/lastfm.png'),
		'linkedin' => array('name'=>THEME_SHORT_NAME.'_linkedin', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/linkedin.png'),
		'picasa'=> array('name'=>THEME_SHORT_NAME.'_picasa', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/picasa.png'),
		'rss'=> array('name'=>THEME_SHORT_NAME.'_rss', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/rss.png'),
		'stumble-upon'=> array('name'=>THEME_SHORT_NAME.'_stumble_upon', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/stumble-upon.png'),
		'tumblr'=> array('name'=>THEME_SHORT_NAME.'_tumblr', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/tumblr.png'),
		'twitter' => array('name'=>THEME_SHORT_NAME.'_twitter', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/twitter.png'),
		'vimeo' => array('name'=>THEME_SHORT_NAME.'_vimeo', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/vimeo.png'),
		'youtube' => array('name'=>THEME_SHORT_NAME.'_youtube', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/youtube.png'),
		'google_plus' => array('name'=>THEME_SHORT_NAME.'_google_plus', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/google-plus.png'),
		'email' => array('name'=>THEME_SHORT_NAME.'_email', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/email.png'),
		'pinterest' => array('name'=>THEME_SHORT_NAME.'_pinterest', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/pinterest.png')
	);	
	echo '<div id="gdl-social-iconx" class="social-wrapperx">';
	echo '<div class="social-icon-wrapper">';
	foreach( $gdl_social_icon as $social_name => $social_icon ){
		$social_link = get_option($social_icon['name']);
		
		if( !empty($social_link) ){
			echo '<div class="social-icon"><a target="_blank" href="' . $social_link . '">' ;
			echo '<img src="' . $social_icon['url'] . '" alt="' . $social_name . '"/>';
			echo '</a></div>';
		}
	}
	echo '<div class="clear"></div>';
	echo '</div>'; // social icon wrapper
	echo '</div>'; // social wrapper	
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 113, 85 );
}