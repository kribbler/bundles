<?php
/*
Plugin Name: Swipe Checkout for WooCommerce
Plugin URI: http://www.swipehq.com/
Description: A payment plugin for WooCommerce
Version: 2.9.1
Author: Swipe
Author URI: http://www.swipehq.com/
Copyright: © 2013 Optimizer Corp.
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

add_action('plugins_loaded', 'woocommerce_swipehq_init', 0);

function woocommerce_swipehq_init() {

	if ( !class_exists( 'WC_Payment_Gateway' ) ) return;
	/**
	  Gateway class
	 **/
	class WC_SwipeHQ_Gateway extends WC_Payment_Gateway {
		 
		protected $msg = array();

		public function __construct(){
			
			$this -> id = 'swipehq';
			$this -> icon = WP_PLUGIN_URL . "/" . plugin_basename(dirname(__FILE__)) . '/images/checkout-logo.png';
			$this -> has_fields = false;
                        $this -> method_title = __('Swipe Checkout', 'Optimizer');
                        
			$this -> init_form_fields();
			$this -> init_settings();
                        
			$this -> title = $this -> settings['title'];
			$this -> description = $this -> settings['description'];
			$this -> merchant_id = $this -> settings['merchant_id'];
			$this -> working_key = $this -> settings['working_key'];
			$this -> api_url     = $this -> settings['api_url'];
			$this -> payment_url = $this -> settings['payment_url'];

			$this -> liveurl = trim($this -> settings['payment_url'],'/');
			$this -> notify_url = str_replace( 'https:', 'http:', add_query_arg( 'wc-api', 'WC_SwipeHQ_Gateway', home_url( '/' ) ) );
			$this -> msg['message'] = "";
			$this -> msg['class'] = "";

			add_action('valid-swipehq-payment-request', array($this, 'successful_request'));
                        if ( version_compare( WOOCOMMERCE_VERSION, '2.0.0', '>=' ) ) {
                        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( &$this, 'process_admin_options' ) );
                        } else {
                        add_action( 'woocommerce_update_options_payment_gateways', array( &$this, 'process_admin_options' ) );
                        }
			add_action('woocommerce_receipt_swipehq', array($this, 'receipt_page'));
			add_action( 'thankyou_swipehq', array( $this, 'thankyou_page' ) );
			add_action( 'woocommerce_api_wc_swipehq_gateway', array( $this, 'check_swipe_response' ) );
//                        add_action( 'woocommerce_thankyou', array( $this, 'custom_woocommerce_auto_complete_order' ) ); 


		}

		function post_to_url($url, $body) {
                    
                    
			$ch = curl_init ($url);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $body);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
			curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
			$html = curl_exec ($ch);
			curl_close ($ch);
			return $html;
		}

		/**
		  @return array of string e.g. NZD
		**/
		function getAcceptedCurrencies(){
			$api_url = trim($this -> api_url, '/');
			$params = array(
					'merchant_id' => $this->merchant_id,
					'api_key' => $this->working_key 
 			);
			 
			$response = $this->post_to_url($api_url.'/fetchCurrencyCodes.php', $params);
			$response_data = json_decode($response, true);
			return $response_data['data'];
		}

		function init_form_fields(){

			$this -> form_fields = array(
                                        'title' => array(
							'title' => __('Payment Method Name', 'Optimizer'),
							'type'=> 'text',
							'description' => __('This is the name which the user sees during checkout.', 'Optimizer'),
							'default' => __('Swipe Checkout', 'Optimizer'),
					),
					'description' => array(
							'title' => __('Payment Method Description', 'Optimizer'),
							'type' => 'textarea',
							'description' => __('This is the description which the user sees during checkout.', 'Optimizer'),
							'default' => __('Swipe Checkout enables small businesses to transact smarter, better and cheaper than ever before...', 'Optimizer')
					),
					'merchant_id' => array(
							'title' => __('Merchant ID', 'Optimizer'),
							'type' => 'text',
							'description' => __('Find this in your Swipe Merchant login under Settings -> API Credentials'),
					),
					'working_key' => array(
							'title' => __('Api Key', 'Optimizer'),
							'type' => 'text',
							'description' =>  __('Find this in your Swipe Merchant login under Settings -> API Credentials', 'Optimizer'),
					),
					'api_url' => array(
							'title' => __('Api Url', 'Optimizer'),
							'type' => 'text',
							'description' =>  __('Find this in your Swipe Merchant login under Settings -> API Credentials', 'Optimizer'),
					),
					'payment_url' => array(
							'title' => __('Payment Page Url', 'Optimizer'),
							'type' => 'text',
							'description' =>  __('Find this in your Swipe Merchant login under Settings -> API Credentials', 'Optimizer'),
					),
					'enabled' => array(
							'title' => __('Enabled', 'Optimizer'),
							'type' => 'checkbox',
							'label' => __('Enable Swipe Payment Module.', 'Optimizer'),
							'default' => 'no'
					),
			);


		}
		/**
		  Admin Panel Options
		 **/
             
		public function admin_options(){
			echo '<h3>'.__('Swipe Checkout', 'swipe').'</h3>';
			echo '<table class="form-table">';
			$this -> generate_settings_html();
			echo '</table>';
                        
                        
                        echo '<script>
                                 function check_config(){
                                     var elementToRemove = jQuery("#check_config_results");
                                     if(elementToRemove!=null && typeof(elementToRemove)!="undefined"){
                                         jQuery(elementToRemove).remove();
                                     }

                                      var mainForm = document.getElementById("mainform");
                                      var elementToInsert = document.createElement("div");
                                      elementToInsert.setAttribute("id", "check_config_results");
                                      elementToInsert.setAttribute("style", "width:100%;height:100%");
                                      jQuery(mainForm).append(elementToInsert);
                                      elementToInsert.innerHTML = "<p style=\"line-height:1;font-size:50px\">Checking config, please wait...</p>";

                                      var merchantId = jQuery("input[name=\"woocommerce_swipehq_merchant_id\"]").val();
                                      var apiKey = jQuery("input[name=\"woocommerce_swipehq_working_key\"]").val();
                                      var apiURL = jQuery("input[name=\"woocommerce_swipehq_api_url\"]").val();
                                      var paymentURL = jQuery("input[name=\"woocommerce_swipehq_payment_url\"]").val();

                                     
                                      var testUrl = "'.WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)) . '/test-plugin.php";
                                          
                                      var currencySelected = "'.get_woocommerce_currency().'";
                                          
                                      
                                          
                                      if(currencySelected!=null && typeof(currencySelected)!="undefined"){
                                          if(currencySelected.length!=3){
                                              currencySelected = null;
                                          }
                                      }
                                      else{
                                          currencySelected = null;
                                      }
                                      
                                      

                                      var urlToLoad = testUrl+"?merchant_id="+merchantId+"&api_key="+apiKey+"&api_url="+apiURL+"&payment_page_url="+paymentURL+((currencySelected!=null && typeof(currencySelected!="undefined"))?("&currency="+currencySelected):"");

                                      jQuery("#check_config_results").load(urlToLoad);


                                }

                                 jQuery(document).ready(function(){
                                    var main_form = document.getElementById("mainform");
                                    var buttonToInsert = document.createElement("input");
                                    buttonToInsert.setAttribute("type", "button");
                                    buttonToInsert.setAttribute("value", "Check Config");
                                    buttonToInsert.setAttribute("name", "checkconfig");
                                    buttonToInsert.setAttribute("onclick", "check_config()");
                                    jQuery(main_form).append(buttonToInsert);

                                });
                             </script>';
		} 
		
		/**
		  Receipt Page
		 **/
		function receipt_page($order){
			global $woocommerce;
			
			//check currency
			$acceptedCurrencies = $this->getAcceptedCurrencies();
			$currency = get_woocommerce_currency();
			if(!in_array($currency, $acceptedCurrencies)){
				echo '<p>'.__('Swipe does not support currency: '.$currency.'. Swipe supports these currencies: '.join(', ', $acceptedCurrencies).'.', 'Optimizer').'</p>';
				return;
			}

			$order = new WC_Order($order);
			$true_order_id = $order->id;
			$order_id = $order->id.'_'.date("ymds");
			$products = $order->get_items();

			$product_details = '';
			foreach($products as $value){
				$product_details .= $value['qty'] . ' x ' . $value['name'] . '<br/>';
			}
                        
			//get product ID using TransactionIdentifier API
			$params = array (
					'merchant_id'           => $this -> merchant_id,
					'api_key'               => $this -> working_key,
					'td_item'               => $order_id,
					'td_description'        => $product_details,
                                        'td_amount'             => $order->order_total,
					'td_default_quantity'   => 1,
					'td_user_data'          => $true_order_id,
					'td_currency'           => $currency,
					'td_callback_url'       => add_query_arg( 'utm_nooverride', '1', $this->get_return_url( $order ) ),
					'td_lpn_url'            => $this -> notify_url
			);
                        
                        if(!empty($order->billing_email)){
                            $params['td_email'] = $order->billing_email;
                        }
                        
			$response = $this->post_to_url(trim($this -> api_url, '/').'/createTransactionIdentifier.php', $params);

			$response_data = json_decode($response);

			if($response_data->response_code == 200 && !empty($response_data->data->identifier)){
				$trans_id = $response_data->data->identifier;

				echo '<p>'.__('Thank you for your order, please click the button below to pay with Swipe.', 'Optimizer').'</p>';
				echo $this -> generate_swipe_form($trans_id,$order);
			}
			else{
				echo '<p>'.__('There has been a problem with your order. Please contact your website administrator.', 'Optimizer').'</p>';
			}

		}
                
		/**
		 Process the payment and return the result
		 **/
		function process_payment($order_id){
			$order = new WC_Order($order_id);
                        
                        return array('result' => 'success', 'redirect' => add_query_arg('order',
					$order->id, add_query_arg('key', $order->order_key, $order->get_checkout_payment_url(true)))
			);
		}
		/**
		 Check for valid Swipe server callback
		 **/
                
	function successful_request($posted){
			global $woocommerce;
                        
			if(isset($posted['status']) && isset($posted['identifier_id']) && isset($posted['transaction_id']) && isset($posted['td_user_data'])){
				$order = new WC_Order((int) $posted['td_user_data']);
				
                                /**Validate Transaction**/
				$params = array(
						'merchant_id'       => $this -> merchant_id,
						'api_key'           => $this -> working_key,
						'transaction_id'    => $posted['transaction_id'],
						'identifier_id'     => $posted['identifier_id']

				);

				$response = $this->post_to_url(trim($this -> api_url, '/').'/verifyTransaction.php', $params);
				$response_data = json_decode($response);
				if($response_data->response_code == 200){
					if($response_data->data->status == 'accepted' && $response_data->data->transaction_approved == 'yes'){
						$this -> msg['message'] = "Thank you for shopping with us. Your account has been charged and your transaction is successful. We will be shipping your order to you soon.";
						$this -> msg['class'] = 'success';
						$order -> payment_complete();
						$order -> add_order_note('Swipe: Payment Successful');
						$order -> add_order_note($this->msg['message']);
						$woocommerce->cart->empty_cart();
					}
					elseif($response_data->data->status == 'test-accepted' && $response_data->data->transaction_approved == 'yes'){
						$this -> msg['message'] = "Thank you for using Swipe. Your test transaction is successful.";
						$this -> msg['class'] = 'success';
                                                $order ->update_status('completed'); 
						$order -> add_order_note('Swipe: Test Payment Successful');
						$order -> add_order_note($this->msg['message']);
						$woocommerce->cart->empty_cart();
					}
					else{
						$order -> update_status('failed');
						$order -> add_order_note('Swipe: Transaction Declined');
						$order -> add_order_note($this->msg['message']);
					}
				}
				else{
					$order -> update_status('failed');
					$order -> add_order_note('Swipe : Unauthorized Transaction. Transaction Failed.');
				}
			}

		}

           //Order Complete     
        function custom_woocommerce_auto_complete_order( $order_id ) {
            global $woocommerce;
 
                if ( !$order_id )
                return;
                $order = new WC_Order( $order_id );
                $order->update_status( 'completed' );
        }        
                


	function check_swipe_response() {
			@ob_clean();
			if($_POST){
				$_POST = stripslashes_deep( $_POST );
				if(isset($_POST['status']) && isset($_POST['identifier_id']) && isset($_POST['transaction_id']) && isset($_POST['td_user_data'])){
					$data = array(
							'status'            => $_POST['status'],
							'identifier_id'     => $_POST['identifier_id'],
							'transaction_id'    => $_POST['transaction_id'],
							'td_user_data'      => $_POST['td_user_data']
					);
					do_action("valid-swipehq-payment-request", $data);
				}else {
					wp_die( "Swipe IPN Request Failure" );
				}
			}
		}


	function thankyou_page() {
			switch($_REQUEST['result']){
				case 'accepted':
					$this -> msg['message'] = "Thank you for shopping with us. Your account has been charged and your transaction is successful. We will be shipping your order to you soon.";
					$this -> msg['class'] = 'success';
					echo wpautop( wptexturize( 'Thank you for shopping with us. Your account has been charged and your transaction is successful. We will be shipping your order to you soon.' ) );
					break;
				case 'test-accepted':
					$this -> msg['message'] = "Thank you for shopping with us. Your account has been charged and your test transaction is successful.";
					$this -> msg['class'] = 'success';
					echo wpautop( wptexturize( 'Thank you for shopping with us. Your account has been charged and your test transaction is successful.' ) );
					break;
				case 'test-declined':
					echo wpautop( wptexturize( '<font color="red">Transaction Declined. We\'re sorry, but the transaction has failed.</font>' ) );
					break;
				case 'declined':
					echo wpautop( wptexturize( '<font color="red">Transaction Declined. We\'re sorry, but the transaction has failed.</font>' ) );
					break;
				default:
					echo wpautop( wptexturize( '<font color="red">Authorization Denied. We\'re sorry, but the transaction has failed.</font>' ) );
					break;
			}
			add_action('the_content', array($this, 'showMessage'));

		}

	function showMessage($content){
			return '<div class="box '.$this -> msg['class'].'-box">'.$this -> msg['message'].'</div>'.$content;
		}
		/**
		 Generate Swipe button link
		 **/
	public function generate_swipe_form($trans_id,$order){
			global $woocommerce;
                        
                        
			return '<form action="'.$this -> liveurl.'?identifier_id='.$trans_id.'&checkout=true" method="post" id="swipe_payment_form">
					<input type="submit" class="button alt" id="submit_swipehq_payment_form" value="'.__('Pay via Swipe', 'Optimizer').'" />
							<a class="button cancel" href="'.$order->get_cancel_order_url().'">'.__('Cancel order &amp; restore cart', 'Optimizer').'</a>
									<script type="text/javascript">

									jQuery(function(){

									jQuery("body").block(
									{
									message: "<img src=\"'.$woocommerce->plugin_url().'/assets/images/ajax-loader.gif\" alt=\"Redirecting…\" style=\"float:left; margin-right: 10px;\" />'.__('Thank you for your order. We are now redirecting you to Swipe to make payment.', 'Optimizer').'",
											overlayCSS:
											{
											background: "#fff",
											opacity: 0.6
		},
											css: {
											padding:        20,
											textAlign:      "center",
											color:          "#555",
											border:         "3px solid #aaa",
											backgroundColor:"#fff",
											cursor:         "wait",
											lineHeight:"32px"
		}
		});
                                                                                        setTimeout(function(){ jQuery("#submit_swipehq_payment_form").click(); },3000);
											//jQuery("#submit_swipehq_payment_form").click();

		});

											</script>
											</form>';

		}

	//get all pages
	function get_pages($title = false, $indent = true) {
			$wp_pages = get_pages('sort_column=menu_order');
			$page_list = array();
			if ($title) $page_list[] = $title;
			foreach ($wp_pages as $page) {
				$prefix = '';
				// show indented child pages?
				if ($indent) {
					$has_parent = $page->post_parent;
					while($has_parent) {
						$prefix .=  ' - ';
						$next_page = get_page($has_parent);
						$has_parent = $next_page->post_parent;
					}
				}
				//add to page list array array
				$page_list[$page->ID] = $prefix . $page->post_title;
			}
			return $page_list;
		}

	}

	/**
	 Add the Gateway to WooCommerce
	 **/
	function woocommerce_add_swipehq_gateway($methods) {
		$methods[] = 'WC_SwipeHQ_Gateway';
		return $methods;
	}

	add_filter('woocommerce_payment_gateways', 'woocommerce_add_swipehq_gateway');
}

?>
