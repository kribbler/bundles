<?php
// Incoming vars: $backupFile, $step
if ( ! current_user_can( pb_backupbuddy::$options['role_access'] ) ) {
	die( 'Error #473623. Access Denied.' );
}

pb_backupbuddy::verify_nonce();
$restoreData = unserialize( base64_decode( pb_backupbuddy::_POST( 'restoreData' ) ) );



$sqlFile = $restoreData['tempPath'] . 'db_1.sql';
if ( ! file_exists( $sqlFile ) ) {
	pb_backupbuddy::alert( 'Error #43563434: Missing SQL file `' . $sqlFile . '`.' );
	return false;
}

if ( ! file_exists( ABSPATH . '.maintenance' ) ) {
	$maintenance_result = @file_put_contents( ABSPATH . '.maintenance', "<?php die( 'Site undergoing maintenance.' ); ?>" );
	if ( false === $maintenance_result ) {
		pb_backupbuddy::status( 'error', '.maintenance file unable to be generated to prevent viewing.' );
		return false;
	} else {
		pb_backupbuddy::status( 'details', '.maintenance file generated to prevent viewing partially migrated site.' );
	}
} else {
	pb_backupbuddy::status( 'details', '.maintenance file already exists. Skipping creation.' );
}
?>



Rename existing DB table names.
Import SQL files into database with same prefix.
Instruct user to test rollback success.
	User has option to confirm success & clean up the restored-over tables.
		Success: Wipe renamed tables.
		Fail: Wipe new tables & rename the restored-over tables back.







<form method="post" action="<?php echo esc_url( add_query_arg( array( 'step' => '1', 'rollback' => $backupFile ) , pb_backupbuddy::page_url() ) ); ?>">
	<?php pb_backupbuddy::nonce(); ?>
	<input type="hidden" name="restoreData" value="<?php echo base64_encode( serialize( $restoreData ) ); ?>">
	<?php submit_button( __('Next Step') . ' &raquo;', 'primary', 'add-site' ); ?>
</form>