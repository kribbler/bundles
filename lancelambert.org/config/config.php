<?php

error_reporting( 0 );
define( 'TIMER', microtime( true ) );
define( 'PROJECT_PATH', substr( __file__, 0, strlen( __file__ ) - 18 ) );

/* configuration begins */

define( 'INCLUDE_PATH', PROJECT_PATH .'/include' );
define( 'SMARTY_DIR', INCLUDE_PATH .'/Smarty-3.0.6/libs/' );
require_once( INCLUDE_PATH .'/class/Config.class.php' );
require_once( 'database.php' );

define( 'PROJECT_NAME', 'lancelambert' );
define( 'SITE_NAME', 'Lance Lambert' );
/*
define( 'CACHE_TYPE', 'memcache' );
define( 'CACHE_HOST', '127.0.0.1' );
define( 'CACHE_PORT', 11211 );
define( 'CACHE_LIFETIME', 12000 ); // in seconds
define( 'CACHE_PREFIX', 'LANCELAMBERT' );
*/

define( 'CACHE_ROOT', '/tmp/lancelambert-live/' );
define( 'PAGE_CACHE_DIR', CACHE_ROOT .'page_cache/' ); // compiled pages cache

define( 'ASSETS_PATH', PROJECT_PATH .'/../assets/' );

define( 'CURRENCY_SIGN', '$' );
define( 'PAYPAL_CURRENCY_CODE', 'CAD' );
define( 'SALES_TAX_NAME', 'Sales Tax' );

define( 'SMARTY_TEMPLATES_DIR', PROJECT_PATH .'/templates/' );

//define( 'MODULE_POSITIONS', 'sidebar,content' );
define( 'LOG_DIRECTORY', '/tmp' );

define( 'PRODUCTION', true );

if( PRODUCTION )
{
	define( 'ADMIN_EMAIL', 'marek@dajnowski.net' );
	define( 'TIMER', microtime( true ) );
	define( 'SMARTY_COMPILE_DIR', '/tmp/lancelambert.org' );
	define( 'SMARTY_TEMPLATES_DIR', PROJECT_PATH ."/templates/" );
	define( 'PAYPAL_ACCOUNT_EMAIL', 'info@lancelambert.org' );
	define( 'PROJECT_URL', 'http://lancelambert.org/' );
	define( 'SITE_ADDRESS', 'http://lancelambert.org/' );

}
else
{
	ini_set( 'display_errors', 'On' );
	ini_set( 'log_errors', 'Off' );
	define( 'ADMIN_EMAIL', 'tigi@sunforum.co.uk' );
	define( 'TIMER', microtime( true ) );
	define( 'SMARTY_COMPILE_DIR', '/tmp/booking' );
	define( 'SMARTY_TEMPLATES_DIR', PROJECT_PATH ."/templates/" );
	define( 'PROJECT_URL', 'http://booking.fbsd' );
	define( 'SITE_ADDRESS', 'booking.fbsd' );

	define( 'PAYPAL_ACCOUNT_EMAIL', 'dummy_1244752696_biz@dajnowski.net' );
}

/* end of configuration */

require_once( SMARTY_DIR .'/Smarty.class.php' );

if( !file_exists( SMARTY_COMPILE_DIR ) )
{
	mkdir( SMARTY_COMPILE_DIR );
}

spl_autoload_register( 'autoload' );

function autoload( $name )
{
	$path_array = array(
		'class/',
		'entities/',
		'controllers/',
		'libs/',
		INCLUDE_PATH .'/class/'
	 );

	foreach( $path_array as $path )
	{
		if( file_exists( $path . $name .'.class.php' ) )
		{
			include_once( $path . $name .'.class.php' );
			return true;
		}
		elseif( file_exists( $path . $name .'.php' ) )
		{
			include_once( $path . $name .'.php' );
			return true;
		}
	}
}
