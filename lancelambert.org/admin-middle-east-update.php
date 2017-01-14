<?php

require_once( 'config/config.php' );

//$_COOKIE[ 'usrname' ] = 'Marek';

if( !PRODUCTION )
{
	error_reporting( E_ALL ^E_NOTICE );

	ini_set( 'xdebug.var_display_max_depth', 20 );
	ini_set( 'display_errors', 'On' );
	ini_set( 'log_errors', 'Off' );
}

session_start();

if( !$_COOKIE[ 'usrname' ] )
{
	header( "Location: /" );
}

$_SERVER[ 'REQUEST_URI' ] = str_replace( 'admin-middle-east-update.php', "MiddleEastUpdateAdmin", $_SERVER[ 'REQUEST_URI' ] );
Controller::dispatch();
