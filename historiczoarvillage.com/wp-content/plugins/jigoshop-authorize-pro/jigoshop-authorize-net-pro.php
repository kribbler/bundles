<?php
/*
Plugin Name:    Authorize.net PRO Gateway for Jigoshop
Plugin URI:     https://jigoshop.com/product/authorize-net-pro/
Description:    Extends JigoShop with an <a href="https://www.authorize.net" target="_blank">Authorize.net</a>  gateway. An Authorize.net Merchant account -is- required. Although not required, a server with SSL support and an SSL certificate is needed for security reasons for full PCI compliance and the Authorize.net AIM integration method will be used if the Jigoshop SSL setting is enabled.  Without Jigoshop SSL enabled, then the Authorize.net SIM or DPM integration methods can be used used to ensure maximum PCI complicance for those servers without SSL.
Version:        1.0.2
Author:         divergeinfinity
Author URI:     http://divergeinfinity.com/
*/


add_action( 'plugins_loaded', 'init_authorize_pro_gateway' );
function init_authorize_pro_gateway() {
	
	if ( ! class_exists( 'jigoshop' ) ) return;     /* don't do anything at all without Jigoshop */
	
	/**
	 *  Add the gateway to JigoShop
	 */
	function add_authorize_gateway( $methods ) {
		$methods[] = 'authorize_pro';
		return $methods;
	}
	add_filter( 'jigoshop_payment_gateways', 'add_authorize_gateway', 1 );
	
	
	// define the Authorize.net server URL's
	define( 'ANET_LIVE_URL', 'https://secure.authorize.net/gateway/transact.dll' );
	define( 'ANET_SANDBOX_URL', 'https://test.authorize.net/gateway/transact.dll' );
	
	// load our classes
 	include( 'classes/DTI_ANet_SIM_Form.php' );
 	include( 'classes/DTI_ANet_Response.php' );
 	include( 'classes/DTI_ANet_SIM_Response.php' );
 	include( 'classes/DTI_ANet_AIM_Response.php' );
 	include( 'classes/DTI_ANet_Request.php' );
 	include( 'classes/DTI_ANet_AIM_Request.php' );
	
	
	/**
	 *  Main Authorize.net PRO Gateway Class
	 */
	class authorize_pro extends jigoshop_payment_gateway {
		
		private $merchant_countries = array( 'US', 'CA', 'GB' );
		private $allowed_currency = array( 'USD', 'CAD', 'GBP' );
		
		
		public function __construct() {
			
			// load our text domains first for translations (constructor is called on the 'init' action hook)
			load_textdomain( 'dti-authorize-pro', WP_LANG_DIR.'/jigoshop-authorize-pro/jigoshop-authorize-pro-'.get_locale().'.mo' );
			load_plugin_textdomain( 'dti-authorize-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			
			parent::__construct(); // now, construct the parent to get our options installed and translated
			
			$options = Jigoshop_Base::get_options();
			
			// and initialize all our variables based on settings here
	        $this->id			= 'authorize_pro';
			$this->icon	= plugins_url('images/authorize_logo.png', __FILE__);
	        $this->has_fields 	= false;
			
	      	$this->enabled		= $options->get_option( 'jigoshop_authorize_enabled' );
			$this->title 		= $options->get_option( 'jigoshop_authorize_title' );
			$this->description  = $options->get_option( 'jigoshop_authorize_description' );
			$this->apilogin 	= $options->get_option( 'jigoshop_authorize_apilogin' );
			$this->transkey		= $options->get_option( 'jigoshop_authorize_transkey' );
			$this->md5hash		= $options->get_option( 'jigoshop_authorize_md5hash' );
			$this->testmode		= $options->get_option( 'jigoshop_authorize_testmode' );
			$this->debuglog		= $options->get_option( 'jigoshop_authorize_debugon' );
			$this->transtype	= $options->get_option( 'jigoshop_authorize_transtype' );
			$this->cardtypes	= $options->get_option( 'jigoshop_authorize_cardtypes' );
			$this->email_receipt= $options->get_option( 'jigoshop_authorize_email_receipt' ) == 'yes';
			$this->certificate	= $options->get_option( 'jigoshop_authorize_certificate' );
						
			// strip out the state if there is one and get the Shop country code
			$this->shop_base_country = (
				strpos( $options->get_option( 'jigoshop_default_country' ), ':' ) !== false )
				? substr( $options->get_option( 'jigoshop_default_country'), 0,
					strpos( $options->get_option('jigoshop_default_country' ), ':' ))
				: $options->get_option( 'jigoshop_default_country' );
				
			$this->currency = $options->get_option( 'jigoshop_currency' );
			
			// determine the authorize server to use
			$this->server_url = ($this->testmode == 'no') ? ANET_LIVE_URL : ANET_SANDBOX_URL;
			// set this for AIM, for now
			define( 'DTI_AUTHORIZENET_SANDBOX', $this->testmode == 'yes' );
			
			define( 'DTI_AUTHORIZENET_LOG_FILE', 
				$this->debuglog == 'on'
				? WP_PLUGIN_DIR . '/' . plugin_basename( dirname(__FILE__) ) . '/log/authorize_pro_debug.log'
				: false );
			
			$this->connect_method = $options->get_option( 'jigoshop_authorize_connect_method' );
			$this->sim_enabled = $options->get_option( 'jigoshop_authorize_connect_method' ) == 'sim';
			$this->dpm_enabled = $options->get_option( 'jigoshop_authorize_connect_method' ) == 'dpm';
			$this->aim_enabled = $options->get_option( 'jigoshop_force_ssl_checkout' ) == 'yes'
				|| $options->get_option( 'jigoshop_authorize_connect_method' ) == 'aim';
			
			// SIM connection methods will use the 'pay' page, hook it up
			if ( $this->sim_enabled ) {
				add_action( 'receipt_authorize_pro', array( $this, 'receipt_page' ) );
			}
			
			add_action( 'init', array( $this, 'check_sim_dpm_response' ), 99 );
			add_action( 'admin_notices', array( $this, 'authorize_notices' ) );
			
	    }


		/**
		 *  Default Option settings for WordPress Settings API using the Jigoshop_Options class
		 *
		 *  These will be installed on the Jigoshop_Options 'Payment Gateways' tab by the parent class 'jigoshop_payment_gateway'
		 *
		 */	
		protected function get_default_options() {
			
			$defaults = array();
			
			// Define the Section name for the Jigoshop_Options
			$defaults[] = array(
				'name' => sprintf(__('Authorize.net PRO %s', 'dti-authorize-pro'), '<img style="vertical-align:middle;margin-top:-4px;margin-left:10px;" src="'.plugins_url('images/authorize_logo.png', __FILE__).'" alt="Authorize.net">'),
				'type' => 'title',
				'desc' => __('Authorize.net PRO allows merchants to accept credit card payments on their Shop securely using a variety of connection methods to your Authorize.net Merchant account.  With the Jigoshop SSL setting enabled, the most secure and PCI compliant AIM integration is used, but an SSL installation is required on your server.  Otherwise the SIM and DPM methods are used to still ensure maximim PCI compliance.  SIM will redirect the user to the Authorize.net SSL secured servers to enter Credit Card information.  DPM will post credit card information directly from the customer to the secured Authorize servers bypassing the Shop server.', 'dti-authorize-pro' )
			);
			
			// List each option in order of appearance with details
			$defaults[] = array(
				'name'		=> __('Enable Authorize.net PRO', 'dti-authorize-pro'),
				'desc' 		=> '',
				'tip' 		=> '',
				'id' 		=> 'jigoshop_authorize_enabled',
				'std' 		=> 'no',
				'type' 		=> 'checkbox',
				'choices'	=> array(
					'no'			=> __('No', 'dti-authorize-pro'),
					'yes'			=> __('Yes', 'dti-authorize-pro')
				)
			);
			
			$defaults[] = array(
				'name'		=> __('Method Title', 'dti-authorize-pro'),
				'desc' 		=> '',
				'tip' 		=> __('This controls the title which the user sees during checkout and also appears as the Payment Method on final Orders.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_title',
				'std' 		=> __('Credit Card', 'dti-authorize-pro'),
				'type' 		=> 'text'
			);
			
			$defaults[] = array(
				'name'		=> __('Description', 'dti-authorize-pro'),
				'desc' 		=> '',
				'tip' 		=> __('This controls the description which the user sees during checkout.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_description',
				'std' 		=> __('Pay securely using your credit card with Authorize.net', 'dti-authorize-pro'),
				'type' 		=> 'longtext'
			);
			
			$defaults[] = array(
				'name'		=> __('Test Mode', 'dti-authorize-pro'),
				'desc' 		=> __('Requires a <a href="https://developer.authorize.net/testaccount/">developer account</a> on the Authorize.net testing servers.', 'dti-autorize-pro'),
				'tip' 		=> __('Transactions are sent to the Authorize.net testing server which require different API Login ID\'s and Transaction Key\'s than an actual Merchant account.  Turn this off or disable it to go LIVE and use the production servers.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_testmode',
				'std' 		=> 'no',
				'type' 		=> 'checkbox',
				'choices'	=> array(
					'no'			=> __('No', 'dti-authorize-pro'),
					'yes'			=> __('Yes', 'dti-authorize-pro')
				)
			);
			
			$defaults[] = array(
				'name'		=> __('Connection Method', 'dti-authorize-pro'),
				'desc' 		=> __('If the Jigoshop General tab setting has SSL enabled, AIM will <strong>always</strong> be used.', 'dti-authorize-pro'),
				'tip' 		=> __('<strong>SIM</strong> - No SSL required, transfers customer to Authorize.net secured SSL servers to accept credit card Information.<br><strong>DPM</strong> - No SSL required.  Uses unique transaction "fingerprint" for security.  Customers stay on your Server, but credit card info is sent directly from the customer to the secured Authorize servers.<br><strong>AIM</strong> - SSL IS required, maximum security and full PCI compliance.  Customers stay on your Server.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_connect_method',
				'std' 		=> 'sim',
				'type' 		=> 'radio',
				'choices'	=> array(
					'sim'           => __('Server Integration Method (SIM)', 'dti-authorize-pro'),
					'dpm'           => __('Direct Post Method (DPM)', 'dti-authorize-pro'),
					'aim'           => __('Advanced Integration Method (AIM)', 'dti-authorize-pro')
				),
				'extra'		=> array( 'vertical' )
			);
			
			$defaults[] = array(
				'name'		=> __('Merchant API Login ID', 'dti-authorize-pro'),
				'desc' 		=> '',
				'tip' 		=> __('This is your Authorize.net API Login ID supplied by Authorize.net and available from within your Merchant Account.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_apilogin',
				'std' 		=> '',
				'type' 		=> 'text'
			);
			
			$defaults[] = array(
				'name'		=> __('Transaction Key', 'dti-authorize-pro'),
				'desc' 		=> '',
				'tip' 		=> __('This is the Transaction Key supplied by Authorize.net and available within your Merchant Account.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_transkey',
				'std' 		=> '',
				'type' 		=> 'text'
			);
			
			$defaults[] = array(
				'name'		=> __('MD5 Hash', 'dti-authorize-pro'),
				'desc' 		=> __('Optional - not used if using SSL and AIM.', 'dti-authorize-pro'),
				'tip' 		=> __('This is the optional MD5 Hash you may have entered on your Authorize.net Merchant Account for additional security with DPM and SIM transactions.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_md5hash',
				'std' 		=> '',
				'type' 		=> 'text'
			);
			
			$defaults[] = array(
				'name'		=> __('Debug Logging', 'dti-authorize-pro'),
				'desc' 		=> '',
				'tip' 		=> __('Transactions between the Shop and Authorize.net are logged into a file here: <em>wp-content/plugins/jigoshop-authorize-net-pro/log/authorize_pro_debug.log</em>.  This file must have server write permissions.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_debugon',
				'std' 		=> 'off',
				'type' 		=> 'radio',
				'choices'	=> array(
					'off'           => __('Off', 'dti-authorize-pro'),
					'on'            => __('On', 'dti-authorize-pro')
				)
			);
			
			$defaults[] = array(
				'name'		=> __('Transaction Type', 'dti-authorize-pro'),
				'desc' 		=> '',
				'tip' 		=> __('<em>Authorize Only</em> will <strong>not</strong> actually capture funds for the Order.  You will have to do it manually via your Merchant account when ready to do so.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_transtype',
				'std' 		=> 'capture',
				'type' 		=> 'radio',
				'choices'	=> array(
					'authorize'			=> __('Authorize Only', 'dti-authorize-pro'),
					'capture'			=> __('Authorize and Capture', 'dti-authorize-pro')
				)
			);
			
			$defaults[] = array(
				'name'		=> __('Credit Card Types Accepted', 'dti-authorize-pro'),
				'desc' 		=> '',
				'tip' 		=> __('Select which credit card types to accept.  These should match the settings within your Authorize.net Merchant account.', 'dti-authorize-pro'),
				'id' 			=> 'jigoshop_authorize_cardtypes',
				'type' 		=> 'multicheck',
				'std'       => array('amex' => '','diners' => '','discover' => '','jcb' => '','mastercard' => '1','visa' => '1'),
				'choices'			=> array(
					'amex'  		=> __('American Express', 'dti-authorize-pro'),
					'diners'  		=> __('Diners Club', 'dti-authorize-pro'),
					'discover'      => __('Discover', 'dti-authorize-pro'),
					'jcb'  			=> __('JCB', 'dti-authorize-pro'),
					'mastercard'    => __('MasterCard', 'dti-authorize-pro'),
					'visa'          => __('Visa', 'dti-authorize-pro')
				),
				'extra'		=> array( 'vertical' )
			);
 			
			$defaults[] = array(
				'name'		=> __('Email Authorize.net Receipt', 'dti-authorize-pro'),
				'desc' 		=> '',
				'tip' 		=> __('In addition to Jigoshop emails, allow Authorize.net to also email successful payment receipts to customers.', 'dti-authorize-pro'),
				'id' 		=> 'jigoshop_authorize_email_receipt',
				'std' 		=> 'no',
				'type' 		=> 'checkbox',
				'choices'	=> array(
					'no'			=> __('No', 'dti-authorize-pro'),
					'yes'			=> __('Yes', 'dti-authorize-pro')
				)
			);
			
 			// the 'codeblock' option type is only available in Jigoshop 1.8 onwards
 			if ( jigoshop::jigoshop_version() >= '1.8' ) {
				$defaults[] = array(
					'name'		=> __('SSL Certification', 'dti-authorize-pro'),
					'desc' 		=> __('Leave blank to display nothing if you want to display it elsewhere on the site or you are not using SSL and AIM.<br />Available HTML tags are: ', 'dti-authorize-pro') . "'a', 'img', 'script', 'abbr', 'acronym', 'b', 'blockquote', 'cite', 'code', 'del', 'em', 'i', 'q', 'strike', 'strong'",
					'tip' 		=> __('Use limited HTML markup for links, images and javascript code to display your site\'s SSL certification image.', 'dti-authorize-pro'),
					'id' 		=> 'jigoshop_authorize_certificate',
					'std' 		=> '',
					'type' 		=> 'codeblock'
				);
			}
			
			return $defaults;
			
		}
		
		
		/**
		 *  Admin Notices for conditions under which Authorize.net PRO is available on a Shop
		 */
		public function authorize_notices() {
			
			$options = Jigoshop_Base::get_options();
			
			if ( $this->enabled == 'no' ) return;
			
			if ( ! $this->aim_enabled && $this->connect_method == 'aim' ) {
				echo '<div class="error"><p>'.__('The Authorize.net PRO gateway cannot use the AIM connection method without Jigoshop SSL enabled.  Please enable SSL to use this connection method.  The connection method has been <strong>reset back to SIM</strong> in the gateway settings.', 'dti-authorize-pro').'</p></div>';
				$options->set_option( 'jigoshop_authorize_connect_method', 'sim' );
			}
			
			if ( $this->aim_enabled && ! ($this->connect_method == 'aim') ) {
				echo '<div class="error"><p>'.__('The Authorize.net PRO gateway will <strong>always</strong> use the AIM connection method if the Jigoshop settings for SSL are enabled.  The connection method has been <strong>reset back to AIM</strong> in the gateway settings.  If you don\'t want this you must disable Jigoshop\'s SSL setting on the General Tab.', 'dti-authorize-pro').'</p></div>';
				$options->set_option( 'jigoshop_authorize_connect_method', 'aim' );
			}
			
			if ( ! in_array( $this->currency, $this->allowed_currency )) {
				echo '<div class="error"><p>'.sprintf(__('The Authorize.net PRO gateway accepts payments in currencies of %s.  Your current currency is %s.  Authorize.net PRO won\'t work until you change the Jigoshop currency to an accepted one.  Authorize.net PRO is <strong>currently disabled</strong> on the Payment Gateways settings tab.', 'dti-authorize-pro'), implode( ', ', $this->allowed_currency ), $this->currency ).'</p></div>';
				$options->set_option( 'jigoshop_authorize_enabled', 'no' );
			}
			
			if ( ! in_array( $this->shop_base_country, $this->merchant_countries )) {
				$country_list = array();
				foreach ( $this->merchant_countries as $this_country ) {
					$country_list[] = jigoshop_countries::$countries[$this_country];
				}
				echo '<div class="error"><p>'.sprintf(__('The Authorize.net PRO gateway is available to merchants from: %s.  Your country is: %s.  Authorize.net PRO won\'t work until you change the Jigoshop Shop Base country to an accepted one.  Authorize.net PRO is <strong>currently disabled</strong> on the Payment Gateways settings tab.', 'dti-authorize-pro'), implode( ', ', $country_list ), jigoshop_countries::$countries[$this->shop_base_country] ).'</p></div>';
				$options->set_option( 'jigoshop_authorize_enabled', 'no' );
			}
			
			if ( ( ! $this->apilogin || ! $this->transkey ) && $this->enabled == 'yes' ) {
				echo '<div class="error"><p>'.__('The Authorize.net PRO gateway does not have values entered for the required fields for either Merchant API Login ID or Transaction Key and the gateway is set to enabled.  Please enter your credentials for these fields or the gateway <strong>will not</strong> be available on the Checkout.  Disable the gateway to remove this warning.', 'dti-authorize-pro').'</p></div>';
			}
			
			if ( ! $this->has_cards() && $this->enabled == 'yes' ) {
				echo '<div class="error"><p>'.__('The Authorize.net PRO gateway does not have any Credit Card Types enabled.  Please enable the Credit Cards your Authorize.net Merchant account is set up to process or the gateway <strong>will not</strong> be available on the Checkout.  Disable the gateway to remove this warning.', 'dti-authorize-pro').'</p></div>';
			}
			
		}
	
	
		/**
		 *  Determine conditions for which Authorize.net PRO is available on the Shop Checkout
		 */
		public function is_available() {
			
			$options = Jigoshop_Base::get_options();
			
			if ( $this->enabled == 'no' ) {
				return false;
			}
			
			if ( ! in_array( $this->currency, $this->allowed_currency ) ) {
				return false;
			}
			
			if ( ! in_array( $this->shop_base_country, $this->merchant_countries )) {
				return false;
			}
			
			if ( ! $this->apilogin || ! $this->transkey ) {
				return false;
			}
			
			if ( ! $this->has_cards() ) {
				return false;
			}
			
			return true;
			
		}
				
		
		/**
		 *  Determine if there are Credit Card types available from Settings
		 */
		private function has_cards() {
			$result = false;
			foreach ( $this->cardtypes as $key => $value ) {
				if ( $value == '1' ) {
					$result = true;
					break;
				}
			}
			return $result;
		}
						
		
		/**
		 *  Determine connection method, process the payment and handle results
		 */
		public function process_payment( $order_id ) {
			
			if ( $this->aim_enabled ) {
				
				return $this->process_aim_payment( $order_id );
				
			} elseif ( $this->dpm_enabled ) {
				
				return $this->process_dpm_payment( $order_id );
				
			} else {
				
				$order = new jigoshop_order( $order_id );
				
				$args = array(
					'order' => $order->id,
					'key' => $order->order_key,
				);
				
				return array(
					'result' 	=> 'success',
					'redirect'	=> add_query_arg( $args, get_permalink( jigoshop_get_page_id( 'pay' )))
				);
				
			}
			
		}
		
		
		/**
		 *  Only used for SIM connection methods, uses the 'pay' page, called from action hook
		 */
		public function receipt_page( $order_id ) {
			
			echo '<p>'.__('Thank you for your order, please click the button below to pay with Authorize.net.', 'dti-authorize-pro').'</p>';
			
			$this->process_sim_payment( $order_id );
			
		}
		
		
		/**
		 *  prefill form fields for use with both SIM and DPM
		 */
		private function get_sim_dpm_form_fields( $order_id ) {
		
			$order = new jigoshop_order( $order_id );
			$time = time();
			$fingerprint = DTI_ANet_SIM_Form::getFingerprint( $this->apilogin, $this->transkey, $order->order_total, $order->id, $time );
			$transtype = $this->transtype == 'capture' ? 'AUTH_CAPTURE' : 'AUTH_ONLY';

			$form_fields = new DTI_ANet_SIM_Form( array(
			
				'x_type'                 => $transtype,
				
				'x_amount'               => $order->order_total,
				'x_freight' 		     => $order->order_shipping,
				'x_tax' 			     => $order->order_total - $order->order_subtotal - $order->order_shipping - $order->order_shipping_tax,
				
				'x_login'                => $this->apilogin,
				'x_fp_hash'              => $fingerprint,
				'x_fp_sequence'          => $order->id,
				'x_fp_timestamp'         => $time,
				
				'x_delim_data'           => 'false',
				'x_relay_response'       => 'true',
				'x_relay_always'         => 'true',
				'x_relay_url'            => trailingslashit( get_bloginfo( 'wpurl' )),
				'x_cancel_url'           => get_permalink( jigoshop_get_page_id( 'cart' )),
				
				'x_receipt_link_ method' => 'POST',
				'x_method'               => 'CC',
				
				'x_first_name'           => $order->billing_first_name,
				'x_last_name'            => $order->billing_last_name,
				'x_company'              => $order->billing_company,
				'x_address'              => $order->billing_address_1 . ' ' . $order->billing_address_2,
				'x_city'                 => $order->billing_city,
				'x_state'                => $order->billing_state,
				'x_zip'                  => $order->billing_postcode,
				'x_country'              => $order->billing_country,
				'x_phone'                => $order->billing_phone,
				'x_email'                => $order->billing_email,
				
				'x_ship_to_first_name'   => $order->shipping_first_name,
				'x_ship_to_last_name'    => $order->shipping_last_name,
				'x_ship_to_company'      => $order->shipping_company,
				'x_ship_to_address'      => $order->shipping_address_1 . ' ' . $order->shipping_address_2,
				'x_ship_to_city'         => $order->shipping_city,
				'x_ship_to_state'        => $order->shipping_state,
				'x_ship_to_zip'          => $order->shipping_postcode,
				'x_ship_to_country'      => $order->shipping_country,
				
				'x_cust_id'              => $order->user_id,
				'x_customer_ip' 	     => $_SERVER['REMOTE_ADDR'],
				'x_invoice_num'          => $order->get_order_number(),
				'x_order_key'            => $order->order_key,
				'x_description'          => $order->id,
				
			));
			
			return $form_fields;
			
		}
		
		
		/**
		 *  Process the payment for DPM and handle the result
		 */
		private function process_dpm_payment( $order_id ) {
			
			$form = $this->get_sim_dpm_form_fields( $order_id );
			$form->add_fields( array(
				'x_card_num'    => $this->get_post( 'authorize_pro_ccnum' ),
				'x_exp_date'    => $this->get_post( 'authorize_pro_expmonth' ) .'-'. $this->get_post( 'authorize_pro_expyear' ),
				'x_card_code'   => $this->get_post( 'authorize_pro_cvc' )
			));
			if ( $this->email_receipt ) {
				$form->add_fields( array(
					'x_email_customer' => 'true'
				));
			}
			
			// get all the data fields from the form as 'hidden' inputs
			$hidden_fields = $form->getHiddenFieldString();
			
			// spit them out in javascript attached to the checkout form to call authorize dot net
			echo '
				<script type="text/javascript">
				/*<![CDATA[*/

					jQuery(function($){

						$("form.checkout").before(\'<form method="POST" name="authorize-pro-dpm-form" id="authorize-pro-dpm-form" action="'.$this->server_url.'">\
						'.$hidden_fields.'\
						<input type="submit" class="button-alt" id="authorize-pro-dpm-form-submit" value="'.__('Pay via Authorize.net', 'dti-authorize-pro').'" />\
						</form>\');

						$("body").block(
							{
								message: "<img src=\"'.jigoshop::assets_url().'/assets/images/ajax-loader.gif\" alt=\"Redirecting...\" />'.__('One moment ... contacting Authorize.net to process your order ...', 'dti-authorize-pro').'",
								overlayCSS:
								{
									background: "#fff",
									opacity: 0.6
								},
								css: {
									padding:		20,
									textAlign:	  "center",
									color:		  "#555",
									border:		 "3px solid #aaa",
									backgroundColor:"#fff",
									cursor:		 "wait"
								}
							});
						$("#authorize-pro-dpm-form").submit();

					});
					
				/*]]>*/
				</script>
			';
			
			return false;
		}
		
		
		/**
		 *  Process the payment for SIM and handle the result
		 */
		private function process_sim_payment( $order_id ) {
			
			$form = $this->get_sim_dpm_form_fields( $order_id );
			$form->add_fields( array(
				'x_show_form'   => 'PAYMENT_FORM', /* differentiates SIM from DPM */
			));
			if ( $this->email_receipt ) {
				$form->add_fields( array(
					'x_email_customer' => 'true'
				));
			}
			
			// get all the data fields from the form as 'hidden' inputs
			$hidden_fields = $form->getHiddenFieldString();

			// spit them out in javascript attached to the pay page bode to call authorize dot net
			echo '
				<script type="text/javascript">
				/*<![CDATA[*/

					jQuery(function($){

						$("body").append(\'<form method="POST" name="authorize-pro-sim-form" id="authorize-pro-sim-form" action="'.$this->server_url.'">\
						'.$hidden_fields.'\
						<input type="submit" class="button-alt" id="authorize-pro-sim-form-submit" value="'.__('Pay via Authorize.net', 'dti-authorize-pro').'" />\
						</form>\');

						$("body").block(
							{
								message: "<img src=\"'.jigoshop::assets_url().'/assets/images/ajax-loader.gif\" alt=\"Redirecting...\" />'.__('One moment ... transfering to Authorize.net where you can securely enter your Credit Card information ...', 'dti-authorize-pro').'",
								overlayCSS:
								{
									background: "#fff",
									opacity: 0.6
								},
								css: {
									padding:		20,
									textAlign:	  "center",
									color:		  "#555",
									border:		 "3px solid #aaa",
									backgroundColor:"#fff",
									cursor:		 "wait"
								}
							});
						$("#authorize-pro-sim-form").submit();

					});
					
				/*]]>*/
				</script>
			';
			
		}
		
		
		/**
		 *  Check response from SIM and DPM, called from 'init' action hook
		 */
		public function check_sim_dpm_response() {
			
			if ( isset( $_POST['x_response_code'] )) {
				
				$response = new DTI_ANet_SIM_Response( $this->apilogin, $this->md5hash );
				$order = new jigoshop_order( $response->description );
				$transtype = $this->transtype == 'capture' ? 'AUTH_CAPTURE' : 'AUTH_ONLY';
				
				if ( ! $response->isAuthorizeNet() ) {
				
					$order->add_order_note( __('Authorize.net PRO Payment Warning: The server-generated fingerprint does not match the merchant-specified fingerprint in the "x_fp_hash" field.  Check the MD5 Hash Setting for the Gateway and in your Authorize Merchant Account.' ));

					if ( $this->debuglog == 'on') {
						$this->add_to_log('AUTHORIZE.NET ERROR:' . PHP_EOL.
							'response_code: ' . '3' . PHP_EOL .
							'response_reason_code: ' . '99' . PHP_EOL .
							'response_reason_text: ' . 'The server-generated fingerprint does not match the merchant-specified fingerprint in the "x_fp_hash" field.  Check the MD5 Hash Setting for the Gateway and in your Authorize Merchant Account.' . PHP_EOL );
					}
					
					// notify the admin
					$subject = html_entity_decode('[' . get_bloginfo('name') . '] ' . __('Authorize dot net MD5 Hash Invalid', 'dti-authorize-pro'), ENT_QUOTES, 'UTF-8');
					$message = __('Authorize dot net PRO Payment Gateway Warning: The Authorize server-generated fingerprint does not match the Merchant-specified fingerprint in the "x_fp_hash" field for an Order just processed.  Check the MD5 Hash Setting for the Gateway and in your Authorize Merchant Account.', 'dti-authorize-pro' );
					$message = wordwrap(html_entity_decode(strip_tags($message), ENT_QUOTES, 'UTF-8'), 70);
					add_filter( 'wp_mail_from_name', 'jigoshop_mail_from_name', 99 );
					wp_mail(Jigoshop_Base::get_options()->get_option('jigoshop_email'), $subject, $message, "From: " . Jigoshop_Base::get_options()->get_option('jigoshop_email') . "\r\n");
					remove_filter( 'wp_mail_from_name', 'jigoshop_mail_from_name', 99 );

				}
				
				if ( $response->approved ) {
					
					// Successful payment
					if ( $this->debuglog == 'on') {
						$this->add_to_log( 'RESPONSE: ' . print_r( $response, true ) );
					}
					
					$order->payment_complete();
					
					$order->add_order_note( sprintf(__('Authorize.net PRO Payment completed via %s. (Response: %s - Transaction Type: %s with Authorization Code: %s)', 'dti-authorize-pro'), strtoupper( $this->connect_method ), $response->response_reason_text, $transtype, $response->authorization_code ));
					
					$args = array(
						'key'               => $order->order_key,
						'order'             => $order->id,
						'response_code'     => 1,
						'transaction_id'    => $response->transaction_id,
					);
					
					$redirect_url = add_query_arg( $args, get_permalink( jigoshop_get_page_id( 'thanks' ) ));
									
				} elseif ( $response->error ) {
					
					if ( $this->debuglog == 'on') {
						$this->add_to_log('AUTHORIZE.NET ERROR:' . PHP_EOL.
							'response_code: ' . $response->response_code. PHP_EOL .
							'response_reason_code: ' . $response->response_reason_code. PHP_EOL .
							'response_reason_text: ' . $response->response_reason_text);
					}
					
					$args = array(
						'order_id'                => $order->id,
						'response_code'           => $response->response_code,
						'response_reason_code'    => $response->response_reason_code,
						'response_reason_text'    => $response->response_reason_text,
					);
					
					$redirect_url = add_query_arg( $args, get_permalink( jigoshop_get_page_id( 'checkout' ) ));
					
				} else {
					
					if ( $this->debuglog == 'on') {
						$this->add_to_log('AUTHORIZE.NET ERROR:' . PHP_EOL.
							'response_code: ' . $response->response_code. PHP_EOL .
							'response_reason_code: ' . $response->response_reason_code. PHP_EOL .
							'response_reason_text: ' . $response->response_reason_text);
						$this->add_to_log( 'RESPONSE: ' . print_r( $response, true ) );
					}
					
					$args = array(
						'order_id'                => $order->id,
						'response_code'           => $response->response_code,
						'response_reason_code'    => $response->response_reason_code,
						'response_reason_text'    => $response->response_reason_text,
					);
					
					$redirect_url = add_query_arg( $args, get_permalink( jigoshop_get_page_id( 'checkout' ) ));
					
				}
				
				
				// send results back to Authorize.net and it will redirect customer to desired Shop page
				echo DTI_ANet_SIM_Response::getRelayResponseSnippet( $redirect_url );
				
				
				
			} elseif ( ! count( $_POST ) && count( $_GET ) ) {
				
				// these are only set on error conditions from Authorize.net
				// put up messages for user on the Checkout
				if ( isset( $_GET['order_id'] ) && isset( $_GET['response_code'] ) && isset( $_GET['response_reason_code'] ) && isset( $_GET['response_reason_text'] ) ) {
					
					$order = new jigoshop_order( $_GET['order_id'] );
					
					$fail_note = __('Authorize.net PRO Payment failed', 'dti-authorize-pro') . ' (Response Code: ' . $_GET['response_reason_code'] . '). ' . __('Payment was rejected due to an error', 'dti-authorize-pro') . ': "' . $_GET['response_reason_text'] . '". ';
					$order->add_order_note( $fail_note );
											
					jigoshop::add_error( sprintf(__('Authorize.net Payment failed (%s:%s) -- %s Please try again or choose another gateway for your Order.', 'dti-authorize-pro'), $_GET['response_code'], $_GET['response_reason_code'], $_GET['response_reason_text'] ) );

				}
				
			}

		}
	
	
		/**
		 *  Process the payment for AIM and handle the result
		 */
		private function process_aim_payment( $order_id ) {

			$order = new jigoshop_order( $order_id );
			$transtype = $this->transtype == 'capture' ? 'AUTH_CAPTURE' : 'AUTH_ONLY';
			
			$dti_authorize_request = array (

				'type' 				=> $transtype,
				
				'amount' 			=> $order->order_total,
				'freight' 			=> $order->order_shipping,
				'tax' 				=> $order->order_total - $order->order_subtotal - $order->order_shipping - $order->order_shipping_tax,
				
				'login' 			=> $this->apilogin,
				'tran_key' 			=> $this->transkey,
				
				'cust_id' 			=> $order->user_id,
				'customer_ip' 		=> $_SERVER['REMOTE_ADDR'],
				'invoice_num' 		=> $order->get_order_number(),
				'description' 		=> $order->id,
				
				'first_name' 		=> $order->billing_first_name,
				'last_name' 		=> $order->billing_last_name,
				'company' 			=> $order->billing_company,
				'address' 			=> $order->billing_address_1 . ' ' . $order->billing_address_2,
				'city' 				=> $order->billing_city,
				'state' 			=> $order->billing_state,
				'zip' 				=> $order->billing_postcode,
				'country' 			=> $order->billing_country,
				'phone' 			=> $order->billing_phone,
				'email' 			=> $order->billing_email,
				
				'ship_to_first_name'=> $order->shipping_first_name,
				'ship_to_last_name'	=> $order->shipping_last_name,
				'ship_to_company'	=> $order->shipping_company,
				'ship_to_address'	=> $order->shipping_address_1 . ' ' . $order->shipping_address_2,
				'ship_to_city'		=> $order->shipping_city,
				'ship_to_state'		=> $order->shipping_state,
				'ship_to_zip'		=> $order->shipping_postcode,
				'ship_to_country'	=> $order->shipping_country,
				
				'method'            => 'CC',
				'card_num' 			=> $this->get_post( 'authorize_pro_ccnum' ),
				'card_code' 		=> $this->get_post( 'authorize_pro_cvc' ),
				'exp_date' 			=> $this->get_post( 'authorize_pro_expmonth' ) . '-' . $this->get_post( 'authorize_pro_expyear' )
				
			);
			
			
			$request_sale = new DTI_ANet_AIM_Request( $this->apilogin, $this->transkey );
			$request_sale->setFields( $dti_authorize_request );
			
			if ( $this->email_receipt ) {
				$request_sale->setFields( array(
					'email_customer' => 'true'
				));
			}
			
			if ( $this->transtype == 'capture' ) {
				$response = $request_sale->authorizeAndCapture();
			} else {
				$response = $request_sale->authorizeOnly();
			}
			
			if ( $response->approved ) {
			
				// Successful payment
				$order->payment_complete();
				
				$order->add_order_note( sprintf(__('Authorize.net PRO Payment completed via %s. (Response: %s - Transaction Type: %s with Authorization Code: %s)', 'dti-authorize-pro'), strtoupper( $this->connect_method ), $response->response_reason_text, $transtype, $response->authorization_code ));
				
				// Return thankyou page redirect, Jigoshop will empty the Cart on the thankyou page
				return array(
					'result' 	=> 'success',
					'redirect'	=> add_query_arg( 'key', $order->order_key, add_query_arg( 'order', $order_id, get_permalink( Jigoshop_Base::get_options()->get_option( 'jigoshop_thanks_page_id' ))))
				);
				
			} elseif ( $response->error ) {
				
				if ( $this->debuglog == 'on') {
					$this->add_to_log( $response->error_message . PHP_EOL );
				}
				
				jigoshop::add_error( sprintf(__('%s Please try again or choose another gateway for your Order.', 'dti-authorize-pro'), strip_tags( $response->error_message ) ) );
				
			} else {
			
				if ( $this->debuglog == 'on') {
					$this->add_to_log('AUTHORIZE.NET ERROR:' . PHP_EOL.
							'response_code: ' . $response->response_code. PHP_EOL .
							'response_reason_text: ' . $response->response_reason_text);
					$this->add_to_log( 'RESPONSE from authorizeAndCapture(): ' . print_r( $response, true ) );
				}
				
				$cancelNote = __('Authorize.net PRO Payment failed', 'dti-authorize-pro') . ' (Response Code: ' . $response->response_code . '). ' . __('Payment was rejected due to an error', 'dti-authorize-pro') . ': "' . $response->response_reason_text . '". ';
				
				$order->add_order_note( $cancelNote );
				
				jigoshop::add_error( sprintf(__('Authorize.net PRO Payment failed: %s Please try again or choose another gateway for your Order.', 'dti-authorize-pro'), $response->response_reason_text ) );
				
			}
			
			return false;

		}
		
		
	    /**
		 *  Payment fields for Authorize.net on the Checkout.
		 */
	    public function payment_fields() {

			if ( $this->description ) echo wpautop( wptexturize( $this->description ));
	    	
	    	if ( $this->aim_enabled ) {
			?>
				<div class="ssl-certificate" style="margin-bottom:30px;">
					<?php if ( $this->certificate ) echo wptexturize( $this->certificate ); ?>
				</div>
				<div class="clear"></div>
			<?php } ?>
				
			<div class="available-cards">
			<?php
				if ( $this->cardtypes['visa'] == '1' ) {
					echo '<img src="'.plugins_url('images/visa.png', __FILE__).'" alt="Visa Image">';
				}
				if ( $this->cardtypes['mastercard'] == '1' ) {
					echo '<img src="'.plugins_url('images/mastercard.png', __FILE__).'" alt="Mastercard Image">';
				}
				if ( $this->cardtypes['amex'] == '1' ) {
					echo '<img src="'.plugins_url('images/amex.png', __FILE__).'" alt="AMEX Image">';
				}
				if ( $this->cardtypes['discover'] == '1' ) {
					echo '<img src="'.plugins_url('images/discover.png', __FILE__).'" alt="Discover Image">';
				}
				if ( $this->cardtypes['jcb'] == '1' ) {
					echo '<img src="'.plugins_url('images/jcb.png', __FILE__).'" alt="JCB Image">';
				}
				if ( $this->cardtypes['diners'] == '1' ) {
					echo '<img src="'.plugins_url('images/diners.png', __FILE__).'" alt="Diners Image">';
				}
			?>
			</div>
			<div class="clear"></div>

			<?php
				// we wont' display credit card entry fields for SIM
	    		if ( ! $this->aim_enabled && ! $this->dpm_enabled ) {
	    			return;
	    		}
			?>
			
			<fieldset>
			
				<p class="form-row form-row-first validate-required">
					<label for="authorize_pro_ccnum"><?php echo __('Credit Card Number', 'dti-authorize-pro') ?> <span class="required">*</span></label>
					<input type="text" class="input-text input-required" id="authorize_pro_ccnum" name="authorize_pro_ccnum" />
				</p>
			
			
				<p class="form-row form-row-last validate-required">
					<label for="authorize_pro_cvc"><?php _e('Card Security Code', 'dti-authorize-pro') ?> <span class="required">*</span></label>
					<input type="text" class="input-text input-required" id="authorize_pro_cvc" name="authorize_pro_cvc" maxlength="4" style="width:70px" />
					<span style="margin-left: 5px;"><?php _e('3-4 digits printed on the back of the card.', 'dti-authorize-pro'); ?></span>
				</p>
				
				<div class="clear"></div>
			
				<p class="form-row form-row-first validate-required">
					<label for="authorize_pro_expmonth"><?php echo __('Expiration Date', 'dti-authorize-pro') ?> <span class="required">*</span></label>
					<select class="input-required" style="width: 120px;" name="authorize_pro_expmonth" id="authorize_pro_expmonth">
						<option value=""><?php _e('Month', 'dti-authorize-pro') ?></option>
						<?php
							$months = array();
							for ($i = 1; $i <= 12; $i++) {
								$timestamp = mktime(0, 0, 0, $i, 1);
								$months[date('n', $timestamp)] = date('F', $timestamp);
							}
							foreach ( $months as $num => $name ) {
								printf('<option value="%u">%s</option>', $num, $name);
							}
						?>
					</select>
					<select class="input-required" style="width:120px;" name="authorize_pro_expyear" id="authorize_pro_expyear">
						<option value=""><?php _e('Year', 'dti-authorize-pro') ?></option>
						<?php
							$years = array();
							for ( $i = date('y'); $i <= date('y') + 15; $i++ ) {
								printf('<option value="20%u">20%u</option>', $i, $i);
							}
						?>
					</select>
				</p>
			
				<div class="clear"></div>
				
			</fieldset>
						
			<script type="text/javascript">
				/*<![CDATA[*/
					
					jQuery(document).ready( function($) {
						
						$('#authorize_pro_ccnum').on( 'blur change', function(
						) {
							var $this = $(this);
							var $parent = $this.closest('.form-row');
							var validated = true;
							
							if ( $parent.is( '.validate-required' ) )
							{
								validated = wa.ecom.validateCardNumber( $this.val() );
							}
							if ( validated )
							{
								$parent.removeClass( 'jigoshop-invalid' ).addClass( 'jigoshop-validated' );
							}
							else
							{
								$parent.removeClass( 'jigoshop-validated' ).addClass( 'jigoshop-invalid' );
							}
						});
						
						$('#authorize_pro_cvc').on( 'blur change', function(
						) {
							var $this = $(this);
							var $parent = $this.closest('.form-row');
							var validated = true;
							
							if ( $parent.is( '.validate-required' ) )
							{
								validated = wa.ecom.validateCVC( $this.val() );
							}
							if ( validated )
							{
								$parent.removeClass( 'jigoshop-invalid' ).addClass( 'jigoshop-validated' );
							}
							else
							{
								$parent.removeClass( 'jigoshop-validated' ).addClass( 'jigoshop-invalid' );
							}
						});
						
					});
					
					(function( wa ) {
						"use strict";

						var ecom = wa.ecom = {}, 
							NUMPATTERN = /^\d+$/,
							cardTypes = {
								visa: { css: 'visa', name: 'Visa' },
								master: { css: 'masterCard', name: 'MasterCard' },
								ax: { css: 'americanExpress', name: 'American Express' },
								discover: { css: 'discover', name: 'Discover' },
								jcb: { css: 'jcb', name: 'JCB' },
								diners: { css: 'dinersClub', name: 'Diners Club' },
								unknown: { css: 'unknown', name: 'unknown' }
							};

						ecom.trim = function( value ) {
							return ( value + "" ).replace( /^\s+|\s+$/g, "" );
						};

						ecom.luhnCheck = function( cardNumber ) {
							var sum = 0,
								numdigits = cardNumber.length,
								parity = numdigits % 2,
								i = 0;
							for( ; i < numdigits; i++ ) {
								var digit = parseInt( cardNumber.charAt( i ), 10 );
								if( i % 2 === parity ) {
									digit *= 2;
								}
								if( digit > 9 ) {
									digit -= 9;
								}
								sum += digit;
							}

							return (sum % 10) === 0;
						};

						ecom.cardTypes = function () {
							var e, t, n, r;
							t = {};
							for ( e = n = 40; n <= 49; e = ++n ) {
								t[ e ] = cardTypes.visa;
							}
							for ( e = r = 50; r <= 59; e = ++r ) {
								t[ e ] = cardTypes.master;
							}
							t[ 34 ] = t[ 37 ] = cardTypes.ax;
							t[ 60 ] = t[ 62 ] = t[ 64 ] = t[ 65 ] = cardTypes.discover;
							t[ 35 ] = cardTypes.jcb;
							t[ 30 ] = t[ 36 ] = t[ 38 ] = t[ 39 ] = cardTypes.diners;

							return t;
						}();

						//public API
						wa.ecom.validateCardNumber = function ( cardNumber ) {
							cardNumber = ( cardNumber + "" ).replace( /\s+|-/g, "" );
	
							return cardNumber.length >= 10 && cardNumber.length <= 16 && ecom.luhnCheck( cardNumber );
						};

						wa.ecom.validateExpiry = function ( month, year ) {
							var r,
								i,
								numMonth = parseInt( month, 10 );
	
							month = ecom.trim( month );
							year = ecom.trim( year );
	
							if( !NUMPATTERN.test( month ) || !NUMPATTERN.test( year ) ||  numMonth < 1 || numMonth > 12 ) {
								return false;
							}
							i = new Date( year, month );
							r = new Date();
							i.setMonth( i.getMonth() - 1 );
							i.setMonth( i.getMonth() + 1, 1 );
							return i > r;
						};

						wa.ecom.validateCVC = function ( cvc ) {
							cvc = ecom.trim( cvc );
							return  ( NUMPATTERN.test( cvc ) && cvc.length >= 3 && cvc.length <= 4 );
						};

						wa.ecom.cardType = function( cardNumber ) {
							return ecom.cardTypes[ cardNumber.slice( 0, 2 ) ] || cardTypes.unknown;
						};

					})( window.wa || ( window.wa = {} ) );
					
				/*]]>*/
			</script>
			
			<?php
			
	    }
		
		
		/**
		 *  Validate payment form fields on the Checkout, called from parent payment gateway class
		 */
		public function validate_fields() {
			
			// SIM doesn't need card validations
			if ( ! $this->aim_enabled && ! $this->dpm_enabled ) {
				return true;
			}
			
			$validated = true;
			$cardNumber = $this->get_post( 'authorize_pro_ccnum' );
			$cardCVC = $this->get_post( 'authorize_pro_cvc' );
			$cardExpirationMonth = $this->get_post( 'authorize_pro_expmonth' );
			$cardExpirationYear = $this->get_post( 'authorize_pro_expyear' );
			
			// check credit card number
			$cardNumber = str_replace(array(' ', '-'), '', $cardNumber);
			// this will validate (Visa, MasterCard, Discover, American Express) for length and format
			$valid = preg_match( '^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$^', $cardNumber );
			if ( $valid == 0 ) {
				jigoshop::add_error( __('The Authorize.net Credit Card number entered is invalid.', 'dti-authorize-pro') );
				$validated = false;
			} elseif ( $valid === false ) {
				jigoshop::add_error( __('There was an error validating your Authorize.net credit card number.', 'dti-authorize-pro') );
				$validated = false;
			}
			
			// check CVC
			if ( ! ctype_digit( $cardCVC )) {
				jigoshop::add_error(__('Authorize.net Credit Card security code entered is invalid.', 'dti-authorize-pro'));
				$validated = false;
			}

			// check expiration data
			$currentYear = date('Y');
			if ( ! ctype_digit( $cardExpirationMonth ) || ! ctype_digit( $cardExpirationYear )
				|| $cardExpirationMonth > 12
				|| $cardExpirationMonth < 1
				|| $cardExpirationYear < $currentYear
				|| $cardExpirationYear > $currentYear + 20
			) {
				jigoshop::add_error( __('Authorize.net Credit Card expiration date is invalid.', 'dti-authorize-pro') );
				$validated = false;
			}
			
			return $validated;
		}
		
		
		/**
		 *  Clean and return requested $_POST data
		 */
		private function get_post( $name ) {
			
			$value = null;
			
			if ( isset( $_POST[$name] )) {
				$value = strip_tags( stripslashes( trim( $_POST[$name] )));
			}
			
			return $value;
			
		}
		
		
		/**
		 *  Dump a message into the logging facility for debugging
		 */
		private function add_to_log( $message ) {
			
			$path = WP_PLUGIN_DIR . '/' . plugin_basename( dirname(__FILE__) ) . '/log/authorize_pro_debug.log';
			
			$string = '-----Log Entry-----' . PHP_EOL;
			$string .= 'Log Date: ' . date('r') . PHP_EOL . $message. PHP_EOL;
			
			if ( file_exists( $path ) ) {
				if ( $log = fopen( $path, 'a' ) ) {
					fwrite( $log, $string, strlen( $string ) );
					fclose( $log );
				}
			} else {
				if ( $log = fopen( $path, 'c' ) ) {
					fwrite( $log, $string, strlen( $string ) );
					fclose( $log );
				}
			}
			
		}
		
	}

}


/**
 * Exception class for DTIAuthorizeNet PHP SDK.
 *
 * @package AuthorizeNet
 */
class DTIAuthorizePROException extends Exception
{
	
}
