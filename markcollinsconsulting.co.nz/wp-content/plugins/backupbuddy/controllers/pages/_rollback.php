<?php
pb_backupbuddy::$ui->title( 'Roll Back Database' );


echo pb_backupbuddy::status_box( 'Starting rollback process . . .' );
global $wp_version;
pb_backupbuddy::status( 'details', 'BackupBuddy v' . pb_backupbuddy::settings( 'version' ) . ' using WordPress v' . $wp_version . ' on ' . PHP_OS . '.' );
?>


<script type="text/javascript">
	function pb_status_append( status_string ) {
		target_id = 'pb_backupbuddy_status'; // importbuddy_status or pb_backupbuddy_status
		if( jQuery( '#' + target_id ).length == 0 ) { // No status box yet so suppress.
			return;
		}
		jQuery( '#' + target_id ).append( "\n" + status_string );
		textareaelem = document.getElementById( target_id );
		textareaelem.scrollTop = textareaelem.scrollHeight;
	}
</script>


<iframe id="pb_backupbuddy_modal_iframe" src="<?php echo pb_backupbuddy::ajax_url( 'rollback' ); ?>&step=<?php echo pb_backupbuddy::_GET( 'step' ); ?>&archive=<?php echo pb_backupbuddy::_GET( 'rollback' ); ?>" width="100%" style="max-width: 1000px;" height="1800" frameBorder="0" padding="0" margin="0">Error #4584594579. Browser not compatible with iframes.</iframe>
