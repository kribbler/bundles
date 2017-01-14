<?php
/* BackupBuddy script to undo a database rollback procedure if it has failed.
 * Access this script in your web browser to undo a rollback.
 *
 * @author Dustin Bolton, January 2014.
 * @url http://ithemes.com
 *
 * NOTES:
 * 	-- This will only seek out wp-config.php in the current DIR or up one level. If this file is not in the root then it is innert.
 * 	-- No user-editable variables within. No user-submitted data is used for any processing.
 */


$abspath = rtrim( dirname( __FILE__ ), '\\/' ) . '/';
define( 'ABSPATH', $abspath );


if ( ! isset( $_GET['confirm'] ) || ( '1' != $_GET['confirm'] ) ) { // Do rollback since user confirmed.
	echo 'Are you sure you want to undo this rollback operation? <a href="?confirm=1">Click here to confirm.</a>';
	echo '<br><br>';
	echo 'If you do not want to undo the rollback you may safely delete this file.';
	die();
}


// Determine database connection information and connect to DB.
$configFile = '';
if ( ! file_exists( ABSPATH . 'wp-config.php' ) ) { // Normal config file not found so warn or see if parent config may exist.
	$parentConfig =  dirname( ABSPATH ) . '/wp-config.php';
	if ( @file_exists( $parentConfig ) ) { // Parent config exists so offer it as an option or possibly use it if user has selected to do so.
		if ( pb_backupbuddy::_GET( 'parent_config' ) == 'true' ) { // User opted to use parent config.
			$configFile = $parentConfig;
		}
	}
	unset( $parentConfig );
} else { // Use normal config file.
	$configFile = ABSPATH . 'wp-config.php';
}
if ( '' == $configFile ) {
	die( 'Error #4534434: wp-config.php file not found.' );
}
// Read in wp-config.php file contents.
$configContents = file_get_contents( $configFile );
if ( false === $configContents ) {
	pb_backupbuddy::alert( 'Error: Unable to read wp-config.php configuration file.' );
	return;
}

// Grab database settings from wp-config.php contents.
$databaseSettings = array();
preg_match( '/define\([\s]*(\'|")DB_NAME(\'|"),[\s]*(\'|")(.*)(\'|")[\s]*\);/i', $configContents, $matches );
$databaseSettings['name'] = $matches[4];
preg_match( '/define\([\s]*(\'|")DB_USER(\'|"),[\s]*(\'|")(.*)(\'|")[\s]*\);/i', $configContents, $matches );
$databaseSettings['username'] = $matches[4];
preg_match( '/define\([\s]*(\'|")DB_PASSWORD(\'|"),[\s]*(\'|")(.*)(\'|")[\s]*\);/i', $configContents, $matches );
$databaseSettings['password'] = $matches[4];
preg_match( '/define\([\s]*(\'|")DB_HOST(\'|"),[\s]*(\'|")(.*)(\'|")[\s]*\);/i', $configContents, $matches );
$databaseSettings['host'] = $matches[4];
preg_match( '/\$table_prefix[\s]*=[\s]*(\'|")(.*)(\'|");/i', $configContents, $matches );
$databaseSettings['prefix'] = $matches[2];
// Connect to DB.
@mysql_connect( $databaseSettings['host'], $databaseSettings['username'], $databaseSettings['password'] ) or die( 'Error #45543434: Unable to connect to database based on wp-config.php settings.' );
@mysql_select_db( $databaseSettings['name'] ) or die( 'Error #5484584: Unable to select database based on wp-config.php settings.' );

// Loop through all tables prefixed with BBTEMPserial_.
$serial = str_replace( '.php', '', str_replace( 'backupbuddy_rollback_undo-', '', __FILE__ ) );
$tempPrefix = 'BBTEMP' . $serial . '_';
if ( 0 == count( $tempTables ) ) {
	echo 'No temporary tables found matching this serial `' . $serial . '`. Did you already accept or undo the rollback?';
	die();
}

// Loop through all temp-prefixed tables.
foreach( $tempTables as $tempTable ) {
	$nonTempName = str_replace( $tempPrefix, '', $tempTable );

	// CHECK if $nonTempName table exists in db. If it does then DROP the table.
	if ( false === ( $result = mysql_query( "SHOW TABLES LIKE '" . mysql_real_escape_string( $nonTempName ) . "'" ) ) ) {
		echo 'Error #89294: `' . mysql_error() . '`.<br>';
	}
	if ( mysql_num_rows( $result ) > 0 ) { // WordPress EXISTS already. Collision.
		if ( false === mysql_query("DROP TABLE `" . mysql_real_escape_string( $nonTempName ) . "`") ) {
			echo 'Error #24873: `' . mysql_error() . '`.<br>';
		}
	}
	unset( $result );

	// RENAME $tempTable to $nonTempName
	$result = mysql_query( "RENAME TABLE `" . mysql_real_escape_string( $tempTable ) . "` TO `" . mysql_real_escape_string( $nonTempName ) . "`" );
	if ( false === $result ) { // Failed.
		echo 'Error #54924: `' . mysql_error() . '`.<br>';
	}
}
echo 'Completed undoing database rollback.';
