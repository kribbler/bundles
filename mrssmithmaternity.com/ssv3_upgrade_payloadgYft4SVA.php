<?php
error_reporting(0);
if ($_GET['ping']) {
	echo 'Pong';
	exit;
}
@ini_set('cgi.fix_pathinfo', 1);
$upgrader = new Upgrade($_POST);
@unlink(__FILE__);
exit;
/**
 * Pre Installer Payload Script
 *
 * This is called via curl. The settings are passed in the headers and the process is run
 * on the remote server.
 *
 * @subpackage Lib.assets
 *
 * @copyright SimpleScripts.com, 8 May, 2012
 * @author Oli Ikeme
 **/

/**
 * Define DocBlock
 **/

class Upgrade {

/**
 * Debug Storage
 *
 * @var array $debug
 */
	public $debug = array();

/**
 * Settings
 *
 * @var array $settings
 */
	public $settings = array(
		//'ss_site_url' => null,
		//'ss_dbhost' => 'localhost',
		//'ss_dbname' => null,
		//'ss_dbpass' => null,
		//'install_directory' => null,
		//'filename' => null,
		'extract_package' => false,
		'directory_created' => false,
		'backup_dir' => '.ss_backup',
		'file_ext' => 'tgz',
	);

/**
 * Class Constructor
 *
 * The $_POST will be sent to this method and merged into the $settings defaults.
 *
 * @author Oli Ikeme
 **/
	public function __construct($settings = null) {
		if (!$settings) {
			return false;
		}
		$this->debug['setup'][] = 'Configuring settings.';
		$this->settings = array_merge($this->settings, $settings);
		$this->settings['os'] = strtolower(substr(PHP_OS, 0, 3));
		$this->settings['passthru'] = function_exists('passthru') ? true : false;
		$this->settings['root_directory'] = $this->settings['ss_full_path'];
		$this->settings['full_install_path'] = $this->settings['root_directory'] . DIRECTORY_SEPARATOR . $this->settings['install_directory'];

		//check for backup dir and create it if it doesnt exists. New in v3
		$this->debug['directory_created'] = 0;
		if (!is_dir($this->settings['backup_dir'])) {
			$this->debug['setup'][] = 'Creating backup directory.';
			if (!@mkdir($this->settings['backup_dir'])) {
				$this->error['backupDirectory'] = 'the backup directory could not be created.';
				$this->error['extra'] = $this->settings['backup_dir'];
				$this->errorDie();
			}
			$this->settings['directory_created'] = true;
			$this->debug['directory_created'] = 1;
		}

		//Run the backup process
		if ($this->settings['backup_dir']) {
			$this->debug['process'][] = 'Backing up current installation';
			$this->backup();
			$this->debug['process'][] = 'Backup successfully created';
		}

		$this->settings['install_directory'] = rtrim($this->settings['install_directory'], '/') . '/';

		// if (!$this->settings['filename']) {
		// 	$this->error['fileNotFound'] = 'the package file name is missing.';
		// 	$this->error['extra'] = $this->settings['filename'];
		// 	$this->errorDie();
		// }

		$this->debug['setup'][] = 'Setting full file path.';
		$this->settings['path_to_file'] = dirname(__FILE__) . '/' . $this->settings['filename'];
		//$this->settings['file_ext'] = pathinfo($this->settings['filename'], PATHINFO_EXTENSION);

		$this->debug['setup'][] = 'Starting process.';

		if ($this->settings['extract_package']) {
			$this->debug['process'][] = 'Extracting package';
			$this->extractPackage();
			$this->debug['process'][] = 'Package extracted successfully!';
		}

		if ($this->settings['os'] != 'win') {
			$this->debug['process'][] = 'Setting permissions';
			$this->setPermissions();
			$this->debug['process'][] = 'Permissions set successfully!';
		}
		$this->debug['status'] = 'success';
		echo serialize($this->debug);
	}

/**
 * Extract Package
 *
 * Extract the package to the path specified or the default if not specified.
 *
 * @return void
 * @author Chuck Burgess
 **/
	public function extractPackage() {
		if ($this->settings['os'] == 'win' || !$this->settings['passthru']) {
			$this->debug['process'][] = 'Manual Extracting';
			$this->manualExtract();
		} else {
			$this->debug['process'][] = 'Auto Extracting';
			$this->autoExtract();
		}
		@unlink($this->settings['path_to_file']);
		return true;
	}

/**
 * Auto Extraction
 *
 * Passthru works so we can run a command on the server to extract the files.
 *
 * @return void
 * @author Chuck Burgess
 **/
	public function autoExtract() {
		$options = null;
		if ($this->settings['file_ext'] == 'tar') {
			$options = 'xf';
		} elseif ($this->settings['file_ext'] == 'tgz') {
			$options = 'xzf';
		} else {
			$this->error['incompatibleExtension'] = 'extension not compatible with extraction process.';
			$this->error['extra'] = $this->settings['install_directory'] . $this->settings['filename'];
			$this->errorDie();
		}
		$command = 'cd ' . $this->settings['install_directory'] . '; tar --no-same-owner -' . $options . ' ' . $this->settings['path_to_file'] . ' 2>/dev/null';
		$this->settings['command'] = $command;
		$result = $this->runCommand($command);
		$this->settings['list'] = preg_split("/\n/", $results);
		return true;
	}

/**
 * Manual Extract
 *
 * Extraction for windows machines
 *
 * @return void
 * @author Chuck Burgess
 **/
	public function manualExtract() {
		$filename = $this->settings['path_to_file'];
		$returnValue = array();
		if ($this->settings['file_ext'] == 'tgz') {
			$ghandle = gzopen($filename, 'r');
			$reghandle = fopen($filename.'gzconvert', 'w');
			gzseek($ghandle, 0);
			while ($temp = gzread($ghandle, 1048576)) {
				fwrite($reghandle, $temp);
			}
			fclose($reghandle);
			gzclose($ghandle);
			$filename = $filename.'gzconvert';
		}
		$tarfile = @fopen($filename, 'r');
		while (!feof($tarfile)) {
			$readdata = fread($tarfile,512);
			if (substr($readdata,257,5) == 'ustar') {
				$tfilename = substr($readdata, 0, 100);
				$indicator = substr($readdata, 156, 1);
				if ($indicator == 5) {
					if (!@mkdir($tfilename)) {
						$levels = explode("/", $tfilename);
						$thestring = "";
						foreach ($levels as $level) {
							$thestring .= $level . "/";
							$st = @mkdir($thestring);
						}
					}
				}
			}
		}
		@fclose($tarfile);
		$tarfile = @fopen($filename, 'r');
		$thetar = @fopen($filename, 'r');
		$longlinkfound = false;
		while (!feof($tarfile)) {
			$readdata = fread($tarfile, 512);
			if (substr($readdata, 257, 5) == 'ustar') {
				$tfilename = substr($readdata, 0, 100);
				$permissions = substr($readdata, 100, 8);
				$tfilename = $this->settings['install_directory'].trim($tfilename);
				$indicator = substr($readdata, 156, 1);
				if ($indicator == 2) {
					$linklocation = $this->settings['install_directory'].substr($readdata, 157, 100);
				}
				$offset = ftell($tarfile);
				$filesize = octdec(substr($readdata, 124, 12));
				$directory = "";
			}
			if (substr($readdata, 257, 5) == 'ustar') {
				if ($indicator == 5) {
					continue;
				}
				if ($indicator == 2) {
					symlink($linklocation, $tfilename);
					continue;
				}
				if ($longlinkfound) {
					$tfilename = $this->settings['install_directory'].$longlinkfound;
				}
				if ($tfilename == $this->settings['install_directory'].'././@LongLink') {
					fseek($thetar, $offset);
					$data = @fread($thetar, $filesize);
					$longlinkfound = $data;
					continue;
				} else if ($longlinkfound) {
					$longlinkfound = false;
				}
				$fh = @fopen($tfilename, 'wb');
				if (!$fh) {
					$levels = explode("/", $tfilename);
					$thestring = "";
					foreach ($levels as $level) {
						$thestring .= $level . "/";
						@mkdir($thestring);
					}
					$fh = @fopen($tfilename, 'wb');
				}
				fseek($thetar, $offset);
				$data = @fread($thetar, $filesize);
				$st = @fwrite($fh, $data);
				@fclose($fh);
				if ($this->settings['os'] != 'WIN') {
					@chmod($tfilename, 0 . octdec(substr($permissions, 3)));
				}
			}
		}
		@fclose($thetar);
		@fclose($tarfile);
		return true;
	}

/**
 * Set Permissions
 *
 * Set the file / directory permissions. Defaults are:
 * - dir (0755)
 * - cgi (0755)
 * - all other files (0644)
 *
 * @return void
 * @author Chuck Burgess
 **/
	public function setPermissions() {
		$chmod_lists = array('0755' => array(), '0644' => array());
		foreach ($this->settings['list'] as $listItem) {
			$listItem = trim($listItem);
			if (empty($listItem)) {
				continue;
			}
			if (is_file($listItem) && substr($listItem, -3) != 'php') {
				if (substr($listItem, -3) == 'cgi') {
					$chmod_lists['0755'][] = $listItem;
				} else {
					$chmod_lists['0644'][] = $listItem;
				}
			} elseif (is_dir($listItem) && false === in_array($listItem, array('.', '..'))) {
				$chmod_lists['0755'][] = $listItem;
			} else {
				$chmod_lists['0644'][] = $listItem;
			}
		}
		ob_start();
		foreach ($chmod_lists as $mode => $list) {
			$count = count($list);
			for ($i = 0; $i <= $count; $i += 100) {
				$go = array_slice($list, $i, 100);
				if ($this->setting['passthru']) {
					if (false === empty($go)) {
						passthru('chmod ' . $mode . ' ' . implode(' ', $go));
					}
				} else {
					foreach ($go as $g) {
						chmod($g, octdec($mode));
					}
				}
			}
		}
		ob_end_clean();
		return true;
	}
/**
 * Backup
 *	
 * Backup the user account(File backup implied. Database backup if the database is present and small enough)
 * 
 *
 * @return void
 * @author Oli Ikeme
 **/
	public function backup() {
		if ($this->settings['backup_database']) {
			if (!$this->backupDatabase()) {
				$this->error['backup'] = 'No database backup file created. The backup process appears to have failed';
			}
		}
		if (!$this->backupUserFiles()) {
			$this->error['backup'] = 'No backup file created. The backup process appears to have failed';
		}
		if (!$this->backupProcessCleanup()) {
			$this->error['backup'] = 'Backup cleanup process failed.';
		}
	}
/**
 * Backup User Files
 *
 * Backup the users current files in the protected .ss_backup directory which is created if it doesnt exist
 *
 * @return void
 * @author Oli Ikeme
 **/
	public function backupUserFiles() {
		$options = null;
		if ($this->settings['file_ext'] == 'tar') {
			$options = 'cf';
		} elseif ($this->settings['file_ext'] == 'tgz') {
			$options = 'czf';
		} else {
			$this->error['incompatibleExtension'] = 'extension not compatible with backup process.';
			$this->error['extra'] = $this->settings['install_directory'] . $this->settings['filename'];
			$this->errorDie();
		}

		//protect the backup dir
		$fp = fopen($this->settings['backup_dir'] . DIRECTORY_SEPARATOR . '.htaccess' , 'w');
		fwrite($fp, 'deny from all');
		fclose($fp);
		$backupFileName = $this->settings['backup_dir'] . DIRECTORY_SEPARATOR . 'ss_backup' . $this->randomString(8) . '.tgz';
		//Pass the backup file back to the daemon
		$this->debug['backup_filename'] = $backupFileName;
		$command = 'tar --no-same-owner -' . $options . ' ' . $backupFileName . ' ' . '-C' . ' ' . $this->settings['install_directory'] . ' ' . '.' . ' 2>/dev/null';
		$this->settings['command'] = $command;
		$result = $this->runCommand($command);
		$this->settings['list'] = preg_split("/\n/", $results);
		return true;
	}

/**
 * Backup User Database
 *
 * Backup the user database if there is one 
 *
 * @return void
 * @author Oli Ikeme
 **/
	public function backupDatabase() {
		$host = $this->settings['ss_dbhost'];
		$user = $this->settings['ss_dbuser'];
		$pass = $this->settings['ss_dbpass'];
		$name = $this->settings['ss_dbname'];
		$tables = '*';
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		if ($tables == '*') {
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while ($row = mysql_fetch_row($result)) {
				$tables[] = $row[0];
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		foreach ($tables as $table) {
			$result = mysql_query('SELECT * FROM ' . $table);
			$num_fields = mysql_num_fields($result);
			$return.= 'DROP TABLE IF EXISTS ' . $table . ';';
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE ' . $table));
			$return.= "\n\n".$row2[1].";\n\n";
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysql_fetch_row($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = ereg_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}
		$handle = fopen($this->settings['install_directory']. DIRECTORY_SEPARATOR . 'ss_database_backup' . '.sql','w+');
		fwrite($handle,$return);
		fclose($handle);
		return true;
	}

/**
 * Backup Process Cleanup
 *
 * Cleanup after the backup process is run. Nuke the db thats created in the install directory 
 *
 * @return void
 * @author Oli Ikeme
 **/
	public function backupProcessCleanup() {
		$command = 'rm' . ' ' . $this->settings['install_directory'] . DIRECTORY_SEPARATOR . 'ss_database_backup.sql';
		$result = $this->runCommand($command);
		$this->settings['list'] = preg_split("/\n/", $results);
		return true;
	}

/**
 * Random String
 *
 * Generate a random string
 * @param string $ length The length of the random string to generate
 * @return void
 * @author 
 **/
	public function randomString($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		$size = strlen( $chars );
		for ( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[rand( 0, $size - 1 )];
		}
		return $str;
	}

/**
 * Run Command
 *
 * Run the specified command using passthru to get and return the results.
 *
 * @param string $command The command to run on the server.
 * @return string $output The raw output of the command.
 * @author Chuck Burgess
 **/
	public function runCommand($command = null, $redirect = false) {
		if (!$command) {
			return false;
		}
		if ($redirect) {
			$command .= ' 2>&1';
		}
		ob_start();
		passthru($command);
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

/**
 * Error
 *
 * Call an error to pass back to the caller.
 *
 * @return void
 *
 * @author Chuck Burgess
 **/
	public function errorDie() {
		$this->error['status'] = 'error';
		$this->error['debug'] = $this->debug;
		$this->error = serialize($this->error);
		if ($this->settings['directory_created']) {
			$this->removeDirectoryRecursive($this->settings['install_directory']);
		}
		@unlink(__FILE__);
		die($this->error);
	}
}