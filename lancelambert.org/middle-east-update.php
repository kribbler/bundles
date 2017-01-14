<?php

require_once( 'config/config.php' );

if( !PRODUCTION )
{
	error_reporting( E_ALL ^E_NOTICE );

	ini_set( 'xdebug.var_display_max_depth', 20 );
	ini_set( 'display_errors', 'On' );
	ini_set( 'log_errors', 'Off' );
}

session_start();

$_SERVER[ 'REQUEST_URI' ] = str_replace( 'middle-east-update.php', "MiddleEastUpdate", $_SERVER[ 'REQUEST_URI' ] );

Controller::dispatch();

var_dump(get_included_files());
