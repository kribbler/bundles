<?php
/*
Plugin Name: WPMessenger
Version: v1.1.1
Plugin URI: http://www.tipsandtricks-hq.com/
Author: Tips and Tricks HQ
Author URI: http://www.tipsandtricks-hq.com/
Description: WordPress plugin for private messaging between the registered users of the site
*/
//Direct access to this file is not permitted
if (realpath (__FILE__) === realpath ($_SERVER["SCRIPT_FILENAME"])){
	exit("Do not access this file directly.");
}

require_once  ('class-tnt-wpmessenger.php');
define('WPMESSENGER_VERSION', "1.1.1");
define('WPMESSENGER_DB_VERSION', "1.0.0"); 
define('WPMESSENGER_FOLDER', dirname(plugin_basename(__FILE__)));
define('WPMESSENGER_URL', WP_PLUGIN_URL. '/'. WPMESSENGER_FOLDER); 
define('WPMESSENGER_DIR', WP_PLUGIN_DIR .'/'. WPMESSENGER_FOLDER);
$wpMessanger = new WPMessenger();
