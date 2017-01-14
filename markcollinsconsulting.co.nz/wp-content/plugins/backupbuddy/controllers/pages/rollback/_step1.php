<?php
// Incoming vars: $backupFile, $step
if ( ! current_user_can( pb_backupbuddy::$options['role_access'] ) ) {
	die( 'Error #473623. Access Denied.' );
}

pb_backupbuddy::verify_nonce();
$restoreData = unserialize( base64_decode( pb_backupbuddy::_POST( 'restoreData' ) ) );


// Generate UNDO script.
$undoFilename = 'backupbuddy_rollback_undo-' . $restoreData['serial'] . '.php';
$undoURL = rtrim( site_url(), '/\\' ) . '/' . $undoFilename;
if ( false === copy( dirname( __FILE__ ) . '/_rollback_undo.php', ABSPATH . $undoFilename ) ) {
	pb_backupbuddy::alert( 'Warning: Unable to create undo script in site root. You will not be able to automated undoing the rollback if something fails so BackupBuddy will not continue.' );
	return false;
}

pb_backupbuddy::alert(
	'If the rollback should fail for any reason you may undo its changes at any time by visiting the URL:' .
	'<br>' .
	'<a href="' . $undoURL . '">' . $undoURL . '</a>'
);

// Get SQL file.
$files = array( 'db_1.sql' => 'db_1.sql' );
pb_backupbuddy::$filesystem->unlink_recursive( $restoreData['tempPath'] ); // Remove if already exists.
mkdir( $restoreData['tempPath'] ); // Make empty directory.
require( pb_backupbuddy::plugin_path() . '/classes/_restoreFiles.php' );
backupbuddy_restore_files::restore( $restoreData['archive'], $files, $restoreData['tempPath'] );



?>



TODO: Temporarily create backupbuddy_revert_rollback.php file in root. Accessing w/ importbuddy password deletes new tables and reverts back to renamed tables.
$undoFile = 'backupbuddy_rollback_undo-' . $restoreData['serial'] . '.php';


<form method="post" action="<?php echo esc_url( add_query_arg( array( 'step' => '2', 'rollback' => $backupFile ) , pb_backupbuddy::page_url() ) ); ?>">
	<?php pb_backupbuddy::nonce(); ?>
	<input type="hidden" name="restoreData" value="<?php echo base64_encode( serialize( $restoreData ) ); ?>">
	<?php submit_button( __('Next Step') . ' &raquo;', 'primary', 'add-site' ); ?>
</form>