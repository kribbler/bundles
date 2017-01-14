<?php
/**
 * Plugin update class
 *
 * @package   Woocommerce Purchase Limits
 * @author    Code Ninjas 
 * @link      http://codeninjas.co
 * @copyright 2014 Code Ninjas
 */
class WPL_Updates{

	private $plugin_id = '0d5161e3-7457-4774-9a00-847f31d448ee';

	/**
	 * Initialize updates
	 *
	 * @since     1.1.0
	 */
	public function __construct()
	{		
		$this->automatic_updates_init();
		add_action( 'admin_init', array( $this, 'update_check' ) );
	}
	
	/**
	 * Update database to current version of plugin
	 *
	 * @since     1.1.0
	 */
	public function update_check()
	{ 
		// Get the db version
		$db_version = (float)get_site_option( 'woocommerce_purchase_limits_db_version', 0 );
		$plugin_version = (float)WPL_VERSION;
		
		if( $db_version == $plugin_version ) return false;
		
		if( $db_version < 1.1 ) include 'wpl-update-1-1.php';
		
		if( $db_version < 1.2 ) include 'wpl-update-1-2.php';
		
		update_site_option( 'woocommerce_purchase_limits_db_version', $plugin_version );
			
	}
	
	/**
	 * Automatic updates 
	 * Full credit to Janis Elsts @ http://w-shadow.com/ for this class 
	 *
	 * @since     1.1.0
	 */
	public function automatic_updates_init()
	{
		include 'automatic-updates.class.php';
		$wpl_automatic_updates = new PluginUpdateChecker(
			'http://updates.codeninjas.co?key='.$this->plugin_id,
			WPL_FULL_PATH,
			'woocommerce-purchase-limits'
		);
		//$wpl_automatic_updates->checkForUpdates();
	}

}
		
return new WPL_Updates();
