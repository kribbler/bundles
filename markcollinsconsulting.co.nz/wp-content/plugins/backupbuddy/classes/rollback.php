<?php
class backupbuddy_rollback {
	
	
	private $_state = array();
	private $_errors = array();
	
	public function __construct() { }
	
	
	/* start()
	 *
	 * Returns false on failure. Use getErrors() to get an array of errors encountered if any.
	 * Returns an array of information on success.
	 * Grab the rollback state data with getState().
	 *
	 */
	public function start( $backupFile ) {
		
		$serial = backupbuddy_core::get_serial_from_file( basename( $backupFile ) );
		$this->_state = array(
			'archive' => $backupFile,
			'serial' => $serial,
			'tempPath' => backupbuddy_core::getTempDirectory() . 'rollback_' . $serial . '/',
			'meta' => array(),
			'data' => array(),
		);
		
		// Get zip meta information.
		$getMeta = array(
			'siteurl',
			'created',
			'type',
			'profile',
			'bb_version',
			'wp_version',
		);
		$customTitle = 'Backup Details';
		if ( false !== ( $metaInfo = backupbuddy_core::getZipMeta( $backupFile ) ) ) {
			/*
			$datLocation = '';
			if ( isset( $metaInfo['dat_path'] ) ) {
				$datLocation = $metaInfo['dat_path'][1];
			}
			$siteurl = '';
			if ( isset( $metaInfo['dat_path'] ) ) {
				$siteurl = $metaInfo['siteurl'][1];
			}
			$backupType = '';
			if ( isset( $metaInfo['type'] ) ) {
				$backupType = $metaInfo['type'][1];
			}
			*/
			foreach( $metaInfo as $metaType => $metaValue ) {
				// Remove unwanted meta.
				if ( ! in_array( $metaType, $getMeta ) ) {
					unset( $metaInfo[$metaType] );
				}
			}
		}
		//$this->_state['meta'] = $metaInfo;
		
		
		require_once( pb_backupbuddy::plugin_path() . '/lib/zipbuddy/zipbuddy.php' );
		$zipbuddy = new pluginbuddy_zipbuddy( backupbuddy_core::getBackupDirectory() );
		
		
		// Find DAT file.
		$possibleDatLocations = array();
		if ( isset( $metaInfo['dat_path'] ) ) {
			$possibleDatLocations[] = $metaInfo['dat_path']; // DAT file location encoded in meta info. Should always be valid.
		}
		$possibleDatLocations[] = 'backupbuddy_dat.php'; // DB backup.
		$possibleDatLocations[] = 'wp-content/uploads/backupbuddy_temp/' . $serial . '/backupbuddy_dat.php'; // Full backup.
		foreach( $possibleDatLocations as $possibleDatLocation ) {
			if ( true === $zipbuddy->file_exists( $backupFile, $possibleDatLocation, $leave_open = true ) ) {
				$detectedDatLocation = $possibleDatLocation;
				break;
			}
		} // end foreach.
		
		
		// Load DAT file contents.
		pb_backupbuddy::$filesystem->unlink_recursive( $this->_state['tempPath'] ); // Remove if already exists.
		mkdir( $this->_state['tempPath'] ); // Make empty directory.
		$files = array( $detectedDatLocation => 'backupbuddy_dat.php' );
		require( pb_backupbuddy::plugin_path() . '/classes/_restoreFiles.php' );
		$result = backupbuddy_restore_files::restore( $backupFile, $files, $this->_state['tempPath'], $zipbuddy );
		echo '<script type="text/javascript">jQuery("#pb_backupbuddy_working").hide();</script>';
		pb_backupbuddy::flush();
		if ( false === $result ) {
			$this->_errors[] = 'Error #85484: Unable to retrieve DAT file. This is a fatal error.';
			return false;
		}
		$datData = backupbuddy_core::get_dat_file_array( $this->_state['tempPath'] . 'backupbuddy_dat.php' );
		$this->_state['dat'] = $datData;
		
		
		if ( site_url() != $this->_state['dat']['siteurl'] ) {
			$this->_errors[] = __( 'Error #5849843: Site URL does not match. You cannot roll back the database if the URL has changed or for backups or another site. Use importbuddy.php to restore or migrate instead.', 'it-l10n-backupbuddy' );
			return false;
		}
		
		global $wpdb;
		if ( $this->_state['dat']['db_prefix'] != $wpdb->prefix ) {
			$this->_errors[] = __( 'Error #2389394: Database prefix does not match. You cannot roll back the database if the database prefix has changed or for backups or another site. Use importbuddy.php to restore or migrate instead.', 'it-l10n-backupbuddy' );
			return false;
		}
		
		
		
		

		
		
		
	} // End preCheck().
	
	public function process() {
	} // End process().
	
	public function getErrors() {
		return $this->_errors;
	} // End getErrors();
	
	public function getState() {
		return $this->_state;
	} // End getState().
	
} // end class.