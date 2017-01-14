<?php

/*
Plugin Name: Shipping Details for WooCommerce
Plugin URI: http://www.patsatech.com
Description: WooCommerce Plugin for Displaying Shipping Tracking Number.
Author: PatSaTECH
Version: 1.6.5
Author URI: http://www.patsatech.com
Text Domain : wshipinfo-patsatech
*/

define('SDURL', WP_PLUGIN_URL."/".dirname( plugin_basename( __FILE__ ) ) );  

if ( ! class_exists( 'wooshippinginfo' ) ) {
			
	load_plugin_textdomain('wshipinfo-patsatech', false, dirname( plugin_basename( __FILE__ ) ) . '/lang');
		
	class wooshippinginfo {
		
		function __construct() {
	
			add_action( 'add_meta_boxes', array( &$this, 'woocommerce_metaboxes' ) );
		
			add_action( 'woocommerce_order_items_table', array( &$this, 'track_page_shipping_details' ) );
						
			add_action( 'woocommerce_process_shop_order_meta', array( &$this, 'woocommerce_process_shop_ordermeta' ), 5, 2 );
			
			add_action( 'woocommerce_email_before_order_table', array( &$this, 'email_shipping_details' ) );
	
			add_action( 'admin_menu', array( &$this, 'ship_select_menu'));
			
			add_action( 'admin_init', array( &$this, 'ship_register_settings'));
		
		}
		
		function shipping_details_options($data, $options, $part)  
		{  
			if ($part == '0') {
				$part = '';
			} 
		
			if ($options['USPS'] == '1') {
				echo '<option value="USPS" ';
				if ($data['_order_trackurl'.$part][0] == 'USPS') {
					echo 'selected="selected"';
				}
				echo '>US Postal Service</option>'; 
			} 
			
			if ($options['AUSTRALIAPOST'] == '1') {
				echo '<option value="AUSTRALIAPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'AUSTRALIAPOST') {
					echo 'selected="selected"';
				}
				echo '>Australia POST Domestic</option>'; 
			}
			
			if ($options['AUSTRALIAPOSTINTL'] == '1') {
				echo '<option value="AUSTRALIAPOSTINTL" ';
				if ($data['_order_trackurl'.$part][0] == 'AUSTRALIAPOSTINTL') {
					echo 'selected="selected"';
				}
				echo '>Australia POST International</option>'; 
			}
			
			if ($options['CHINAPOST'] == '1') {
				echo '<option value="CHINAPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'CHINAPOST') {
					echo 'selected="selected"';
				}
				echo '>China POST</option>'; 
			}
			
			if ($options['CANADAPOST'] == '1') {
				echo '<option value="CANADAPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'CANADAPOST') {
					echo 'selected="selected"';
				}
				echo '>Canada POST</option>'; 
			}
			
			if ($options['HKPOST'] == '1') {
				echo '<option value="HKPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'HKPOST') {
					echo 'selected="selected"';
				}
				echo '>HongKong POST</option>'; 
			}
			
			if ($options['ANPOST'] == '1') {
				echo '<option value="ANPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'ANPOST') {
					echo 'selected="selected"';
				}
				echo '>An POST</option>'; 
			}
			
			if ($options['PARCELFORCE'] == '1') {
				echo '<option value="PARCELFORCE" ';
				if ($data['_order_trackurl'.$part][0] == 'PARCELFORCE') {
					echo 'selected="selected"';
				}
				echo '>Parcel Force</option>'; 
			}
			
			if ($options['FEDEX'] == '1') {
				echo '<option value="FEDEX" ';
				if ($data['_order_trackurl'.$part][0] == 'FEDEX') {
					echo 'selected="selected"';
				}
				echo '>FEDEX</option>'; 
			}
			
			if ($options['DHL'] == '1') {
				echo '<option value="DHL" ';
				if ($data['_order_trackurl'.$part][0] == 'DHL') {
					echo 'selected="selected"';
				}
				echo '>DHL</option>'; 
			}
			
			if ($options['UPS'] == '1') {
				echo '<option value="UPS" ';
				if ($data['_order_trackurl'.$part][0] == 'UPS') {
					echo 'selected="selected"';
				}
				echo '>UPS</option>'; 
			}
			
			if ($options['NZCOURIERS'] == '1') {
				echo '<option value="NZCOURIERS" ';
				if ($data['_order_trackurl'.$part][0] == 'NZCOURIERS') {
					echo 'selected="selected"';
				}
				echo '>New Zealand Couriers</option>'; 
			}
			
			if ($options['POSTNLL'] == '1') {
				echo '<option value="POSTNLL" ';
				if ($data['_order_trackurl'.$part][0] == 'POSTNLL') {
					echo 'selected="selected"';
				}
				echo '>POSTNL Local</option>'; 
			}
			
			if ($options['POSTNLINTL'] == '1') {
				echo '<option value="POSTNLINTL" ';
				if ($data['_order_trackurl'.$part][0] == 'POSTNLINTL') {
					echo 'selected="selected"';
				}
				echo '>POSTNL International</option>'; 
			}
			
			if ($options['COURIERPOST'] == '1') {
				echo '<option value="COURIERPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'COURIERPOST') {
					echo 'selected="selected"';
				}
				echo '>CourierPost</option>'; 
			}
			
			if ($options['NEWZEALANDPOST'] == '1') {
				echo '<option value="NEWZEALANDPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'NEWZEALANDPOST') {
					echo 'selected="selected"';
				}
				echo '>New Zealand Post</option>'; 
			}
			
			if ($options['FASTWAY'] == '1') {
				echo '<option value="FASTWAY" ';
				if ($data['_order_trackurl'.$part][0] == 'FASTWAY') {
					echo 'selected="selected"';
				}
				echo '>Fastway Couriers</option>'; 
			}
			
			if ($options['TPCINDIA'] == '1') {
				echo '<option value="TPCINDIA" ';
				if ($data['_order_trackurl'.$part][0] == 'TPCINDIA') {
					echo 'selected="selected"';
				}
				echo '>Professionals Courier</option>'; 
			}
			
			if ($options['TRADELL'] == '1') {
				echo '<option value="TRADELL" ';
				if ($data['_order_trackurl'.$part][0] == 'TRADELL') {
					echo 'selected="selected"';
				}
				echo '>TradeLink International</option>'; 
			}
			
			if ($options['OMICC'] == '1') {
				echo '<option value="OMICC" ';
				if ($data['_order_trackurl'.$part][0] == 'OMICC') {
					echo 'selected="selected"';
				}
				echo '>OM International Courier & Cargo</option>'; 
			}
			
			if ($options['ICCW'] == '1') {
				echo '<option value="ICCW" ';
				if ($data['_order_trackurl'.$part][0] == 'ICCW') {
					echo 'selected="selected"';
				}
				echo '>ICC Worldwide</option>'; 
			}
						
			if ($options['UACE'] == '1') {
				echo '<option value="UACE" ';
				if ($data['_order_trackurl'.$part][0] == 'UACE') {
					echo 'selected="selected"';
				}
				echo '>Urgent Air Courier Express</option>'; 
			}
			
			if ($options['FIRSTFLIGHT'] == '1') {
				echo '<option value="FIRSTFLIGHT" ';
				if ($data['_order_trackurl'.$part][0] == 'FIRSTFLIGHT') {
					echo 'selected="selected"';
				}
				echo '>First Flight Courier</option>'; 
			}
			
			if ($options['ORBITWW'] == '1') {
				echo '<option value="ORBITWW" ';
				if ($data['_order_trackurl'.$part][0] == 'ORBITWW') {
					echo 'selected="selected"';
				}
				echo '>Orbit Worldwide</option>'; 
			}
			
			if ($options['FLYKING'] == '1') {
				echo '<option value="FLYKING" ';
				if ($data['_order_trackurl'.$part][0] == 'FLYKING') {
					echo 'selected="selected"';
				}
				echo '>FlyKing</option>'; 
			}
			
			if ($options['SHREEMC'] == '1') {
				echo '<option value="SHREEMC" ';
				if ($data['_order_trackurl'.$part][0] == 'SHREEMC') {
					echo 'selected="selected"';
				}
				echo '>Shree Maruti Courier</option>'; 
			}
			
			if ($options['SMCS'] == '1') {
				echo '<option value="SMCS" ';
				if ($data['_order_trackurl'.$part][0] == 'SMCS') {
					echo 'selected="selected"';
				}
				echo '>S M Courier Services</option>'; 
			}
			
			if ($options['OVERSEASCS'] == '1') {
				echo '<option value="OVERSEASCS" ';
				if ($data['_order_trackurl'.$part][0] == 'OVERSEASCS') {
					echo 'selected="selected"';
				}
				echo '>OverSeas Courier Service</option>'; 
			}
			
			if ($options['BLUEDART'] == '1') {
				echo '<option value="BLUEDART" ';
				if ($data['_order_trackurl'.$part][0] == 'BLUEDART') {
					echo 'selected="selected"';
				}
				echo '>BlueDart</option>'; 
			}
			
			if ($options['AFLWIZ'] == '1') {
				echo '<option value="AFLWIZ" ';
				if ($data['_order_trackurl'.$part][0] == 'AFLWIZ') {
					echo 'selected="selected"';
				}
				echo '>AFL WiZ Express</option>'; 
			}
			
			if ($options['AFLLT'] == '1') {
				echo '<option value="AFLLT" ';
				if ($data['_order_trackurl'.$part][0] == 'AFLLT') {
					echo 'selected="selected"';
				}
				echo '>AFL Logistics / Transportation</option>'; 
			}
			
			if ($options['BLAZEFLASHD'] == '1') {
				echo '<option value="BLAZEFLASHD" ';
				if ($data['_order_trackurl'.$part][0] == 'BLAZEFLASHD') {
					echo 'selected="selected"';
				}
				echo '>BlazeFlash Domestic</option>'; 
			}
			
			if ($options['BLAZEFLASHI'] == '1') {
				echo '<option value="BLAZEFLASHI" ';
				if ($data['_order_trackurl'.$part][0] == 'BLAZEFLASHI') {
					echo 'selected="selected"';
				}
				echo '>BlazeFlash International</option>'; 
			}
			
			if ($options['ARAMEX'] == '1') {
				echo '<option value="ARAMEX" ';
				if ($data['_order_trackurl'.$part][0] == 'ARAMEX') {
					echo 'selected="selected"';
				}
				echo '>Aramex</option>'; 
			}
			
			if ($options['SHREEMAHAC'] == '1') {
				echo '<option value="SHREEMAHAC" ';
				if ($data['_order_trackurl'.$part][0] == 'SHREEMAHAC') {
					echo 'selected="selected"';
				}
				echo '>Shree Mahavir Courier</option>'; 
			}
			
			if ($options['POSTOUK'] == '1') {
				echo '<option value="POSTOUK" ';
				if ($data['_order_trackurl'.$part][0] == 'POSTOUK') {
					echo 'selected="selected"';
				}
				echo '>POST Office UK</option>'; 
			}
			
			if ($options['TNTEXPRESS'] == '1') {
				echo '<option value="TNTEXPRESS" ';
				if ($data['_order_trackurl'.$part][0] == 'TNTEXPRESS') {
					echo 'selected="selected"';
				}
				echo '>TNT Express</option>'; 
			}
			
			if ($options['HDNL'] == '1') {
				echo '<option value="HDNL" ';
				if ($data['_order_trackurl'.$part][0] == 'HDNL') {
					echo 'selected="selected"';
				}
				echo '>Home Delivery Network</option>'; 
			}
			
			if ($options['CITYLINK'] == '1') {
				echo '<option value="CITYLINK" ';
				if ($data['_order_trackurl'.$part][0] == 'CITYLINK') {
					echo 'selected="selected"';
				}
				echo '>City link</option>'; 
			}
			
			if ($options['JPPOST'] == '1') {
				echo '<option value="JPPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'JPPOST') {
					echo 'selected="selected"';
				}
				echo '>Japan POST</option>'; 
			}
			
			if ($options['POSTDAN'] == '1') {
				echo '<option value="POSTDAN" ';
				if ($data['_order_trackurl'.$part][0] == 'POSTDAN') {
					echo 'selected="selected"';
				}
				echo '>Post Danmark</option>'; 
			}
			
			if ($options['POSTSWEDEN'] == '1') {
				echo '<option value="POSTSWEDEN" ';
				if ($data['_order_trackurl'.$part][0] == 'POSTSWEDEN') {
					echo 'selected="selected"';
				}
				echo '>Posten Sweden</option>'; 
			}
			
			if ($options['POSTNORWAY'] == '1') {
				echo '<option value="POSTNORWAY" ';
				if ($data['_order_trackurl'.$part][0] == 'POSTNORWAY') {
					echo 'selected="selected"';
				}
				echo '>Posten Norway</option>'; 
			}
			
			if ($options['PARCEL2GO'] == '1') {
				echo '<option value="PARCEL2GO" ';
				if ($data['_order_trackurl'.$part][0] == 'PARCEL2GO') {
					echo 'selected="selected"';
				}
				echo '>Parcel2Go</option>'; 
			}
			
			if ($options['YODEL'] == '1') {
				echo '<option value="YODEL" ';
				if ($data['_order_trackurl'.$part][0] == 'YODEL') {
					echo 'selected="selected"';
				}
				echo '>Yodel</option>'; 
			}
			
			if ($options['COLLECTPLUS'] == '1') {
				echo '<option value="COLLECTPLUS" ';
				if ($data['_order_trackurl'.$part][0] == 'COLLECTPLUS') {
					echo 'selected="selected"';
				}
				echo '>Collect+</option>'; 
			}
			
			if ($options['CITYSPRINT'] == '1') {
				echo '<option value="CITYSPRINT" ';
				if ($data['_order_trackurl'.$part][0] == 'CITYSPRINT') {
					echo 'selected="selected"';
				}
				echo '>CitySprint</option>'; 
			}
			
			if ($options['POSTINDIA'] == '1') {
				echo '<option value="POSTINDIA" ';
				if ($data['_order_trackurl'.$part][0] == 'POSTINDIA') {
					echo 'selected="selected"';
				}
				echo '>India POST</option>'; 
			}
			
			if ($options['INTEXPRESS'] == '1') {
				echo '<option value="INTEXPRESS" ';
				if ($data['_order_trackurl'.$part][0] == 'INTEXPRESS') {
					echo 'selected="selected"';
				}
				echo '>InterLink Express</option>'; 
			}
			
			if ($options['DPDPARCEL'] == '1') {
				echo '<option value="DPDPARCEL" ';
				if ($data['_order_trackurl'.$part][0] == 'DPDPARCEL') {
					echo 'selected="selected"';
				}
				echo '>DPD Parcel</option>'; 
			}
			
			if ($options['SPEEDEE'] == '1') {
				echo '<option value="SPEEDEE" ';
				if ($data['_order_trackurl'.$part][0] == 'SPEEDEE') {
					echo 'selected="selected"';
				}
				echo '>Spee Dee</option>'; 
			}
			
			if ($options['PUROLATOR'] == '1') {
				echo '<option value="PUROLATOR" ';
				if ($data['_order_trackurl'.$part][0] == 'PUROLATOR') {
					echo 'selected="selected"';
				}
				echo '>Purolator</option>'; 
			}
			
			if ($options['ONTRAC'] == '1') {
				echo '<option value="ONTRAC" ';
				if ($data['_order_trackurl'.$part][0] == 'ONTRAC') {
					echo 'selected="selected"';
				}
				echo '>OnTrac</option>'; 
			}
			
			if ($options['LASERSHIP'] == '1') {
				echo '<option value="LASERSHIP" ';
				if ($data['_order_trackurl'.$part][0] == 'LASERSHIP') {
					echo 'selected="selected"';
				}
				echo '>LaserShip</option>'; 
			}
			
			if ($options['SAFEX'] == '1') {
				echo '<option value="SAFEX" ';
				if ($data['_order_trackurl'.$part][0] == 'SAFEX') {
					echo 'selected="selected"';
				}
				echo '>SafeXpress</option>'; 
			}
			
			if ($options['DYNAMEX'] == '1') {
				echo '<option value="DYNAMEX" ';
				if ($data['_order_trackurl'.$part][0] == 'DYNAMEX') {
					echo 'selected="selected"';
				}
				echo '>Dynamex</option>'; 
			}
			
			if ($options['ENSENDA'] == '1') {
				echo '<option value="ENSENDA" ';
				if ($data['_order_trackurl'.$part][0] == 'ENSENDA') {
					echo 'selected="selected"';
				}
				echo '>Ensenda</option>'; 
			}
			
			if ($options['CEVA'] == '1') {
				echo '<option value="CEVA" ';
				if ($data['_order_trackurl'.$part][0] == 'CEVA') {
					echo 'selected="selected"';
				}
				echo '>CEVA</option>'; 
			}
			
			if ($options['AONEINT'] == '1') {
				echo '<option value="AONEINT" ';
				if ($data['_order_trackurl'.$part][0] == 'AONEINT') {
					echo 'selected="selected"';
				}
				echo '>A-1 International</option>'; 
			}
			
			if ($options['PARCELLINK'] == '1') {
				echo '<option value="PARCELLINK" ';
				if ($data['_order_trackurl'.$part][0] == 'PARCELLINK') {
					echo 'selected="selected"';
				}
				echo '>Parcel link</option>'; 
			}
			
			if ($options['NAPAREX'] == '1') {
				echo '<option value="NAPAREX" ';
				if ($data['_order_trackurl'.$part][0] == 'NAPAREX') {
					echo 'selected="selected"';
				}
				echo '>NAPAREX</option>'; 
			}
			
			if ($options['PNCOURIER'] == '1') {
				echo '<option value="PNCOURIER" ';
				if ($data['_order_trackurl'.$part][0] == 'PNCOURIER') {
					echo 'selected="selected"';
				}
				echo '>Poslaju National Courier</option>'; 
			}
			
			if ($options['SKYNET'] == '1') {
				echo '<option value="SKYNET" ';
				if ($data['_order_trackurl'.$part][0] == 'SKYNET') {
					echo 'selected="selected"';
				}
				echo '>SkyNET</option>'; 
			}
			
			if ($options['GDEX'] == '1') {
				echo '<option value="GDEX" ';
				if ($data['_order_trackurl'.$part][0] == 'GDEX') {
					echo 'selected="selected"';
				}
				echo '>GD Express</option>'; 
			}
			
			if ($options['CHRONOS'] == '1') {
				echo '<option value="CHRONOS" ';
				if ($data['_order_trackurl'.$part][0] == 'CHRONOS') {
					echo 'selected="selected"';
				}
				echo '>Chronos Couriers</option>'; 
			}
			
			if ($options['POSMALAY'] == '1') {
				echo '<option value="POSMALAY" ';
				if ($data['_order_trackurl'.$part][0] == 'POSMALAY') {
					echo 'selected="selected"';
				}
				echo '>POS Malayasia</option>'; 
			}
			
			if ($options['LAPOSTE'] == '1') {
				echo '<option value="LAPOSTE" ';
				if ($data['_order_trackurl'.$part][0] == 'LAPOSTE') {
					echo 'selected="selected"';
				}
				echo '>LA Poste</option>'; 
			}
			
			if ($options['JNEEXP'] == '1') {
				echo '<option value="JNEEXP" ';
				if ($data['_order_trackurl'.$part][0] == 'JNEEXP') {
					echo 'selected="selected"';
				}
				echo '>JNE Express</option>'; 
			}
			
			if ($options['BRTCE'] == '1') {
				echo '<option value="BRTCE" ';
				if ($data['_order_trackurl'.$part][0] == 'BRTCE') {
					echo 'selected="selected"';
				}
				echo '>BRT Courier Express</option>'; 
			}
			
			if ($options['POSINDO'] == '1') {
				echo '<option value="POSINDO" ';
				if ($data['_order_trackurl'.$part][0] == 'POSINDO') {
					echo 'selected="selected"';
				}
				echo '>POS Indonesia</option>'; 
			}
			
			if ($options['ROYALMAIL'] == '1') {
				echo '<option value="ROYALMAIL" ';
				if ($data['_order_trackurl'.$part][0] == 'ROYALMAIL') {
					echo 'selected="selected"';
				}
				echo '>Royal Mail</option>'; 
			}
			
			if ($options['MYHERMES'] == '1') {
				echo '<option value="MYHERMES" ';
				if ($data['_order_trackurl'.$part][0] == 'MYHERMES') {
					echo 'selected="selected"';
				}
				echo '>Hermes</option>'; 
			}
			
			if ($options['SINGPOST'] == '1') {
				echo '<option value="SINGPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'SINGPOST') {
					echo 'selected="selected"';
				}
				echo '>SingPost</option>'; 
			}
			
			if ($options['GATI'] == '1') {
				echo '<option value="GATI" ';
				if ($data['_order_trackurl'.$part][0] == 'GATI') {
					echo 'selected="selected"';
				}
				echo '>GATI</option>'; 
			}
			
			if ($options['AFGHANPOST'] == '1') {
				echo '<option value="AFGHANPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'AFGHANPOST') {
					echo 'selected="selected"';
				}
				echo '>Afghan POST</option>'; 
			}
			
			if ($options['PAKPOST'] == '1') {
				echo '<option value="PAKPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'PAKPOST') {
					echo 'selected="selected"';
				}
				echo '>Pakistan POST</option>'; 
			}
			
			if ($options['LITPOST'] == '1') {
				echo '<option value="LITPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'LITPOST') {
					echo 'selected="selected"';
				}
				echo '>Lithuania POST</option>'; 
			}
			
			if ($options['PERUPOST'] == '1') {
				echo '<option value="PERUPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'PERUPOST') {
					echo 'selected="selected"';
				}
				echo '>PERU POST</option>'; 
			}
			
			if ($options['ROMPOST'] == '1') {
				echo '<option value="ROMPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'ROMPOST') {
					echo 'selected="selected"';
				}
				echo '>Romania POST</option>'; 
			}
			
			if ($options['ELTA'] == '1') {
				echo '<option value="ELTA" ';
				if ($data['_order_trackurl'.$part][0] == 'ELTA') {
					echo 'selected="selected"';
				}
				echo '>Elta</option>'; 
			}
			
			if ($options['LBCEX'] == '1') {
				echo '<option value="LBCEX" ';
				if ($data['_order_trackurl'.$part][0] == 'LBCEX') {
					echo 'selected="selected"';
				}
				echo '>LBC Express</option>'; 
			}
			
			if ($options['PHLPOST'] == '1') {
				echo '<option value="PHLPOST" ';
				if ($data['_order_trackurl'.$part][0] == 'PHLPOST') {
					echo 'selected="selected"';
				}
				echo '>PHL Post</option>'; 
			}
			
			if ($options['APCOVERNIGHT'] == '1') {
				echo '<option value="APCOVERNIGHT" ';
				if ($data['_order_trackurl'.$part][0] == 'APCOVERNIGHT') {
					echo 'selected="selected"';
				}
				echo '>APC OverNight</option>';
			}
			
			if ($options['UKMAIL'] == '1') {
				echo '<option value="UKMAIL" ';
				if ($data['_order_trackurl'.$part][0] == 'UKMAIL') {
					echo 'selected="selected"';
				}
				echo '>UK Mail</option>';
			}
			
			if ($options['CORREIOS'] == '1') {
				echo '<option value="CORREIOS" ';
				if ($data['_order_trackurl'.$part][0] == 'CORREIOS') {
					echo 'selected="selected"';
				}
				echo '>CORREIOS</option>';
			}
			
			if ($options['CTT'] == '1') {
				echo '<option value="CTT" ';
				if ($data['_order_trackurl'.$part][0] == 'CTT') {
					echo 'selected="selected"';
				}
				echo '>CTT</option>';
			}
			
			if ($options['SMARTSEND'] == '1') {
				echo '<option value="SMARTSEND" ';
				if ($data['_order_trackurl'.$part][0] == 'SMARTSEND') {
					echo 'selected="selected"';
				}
				echo '>SmartSend</option>';
			}
		}  
					
		function woocommerce_order_shippingdetails($post) {
	
			$data = get_post_custom( $post->ID );
			$options = get_option( 'woo_ship_options' );
			$style1 = 'style="display: none"';
			$btn1 = '';
			$style2 = 'style="display: none"';
			$btn2 = '';
			$style3 = 'style="display: none"';
			$btn3 = '';
			$style4 = 'style="display: none"';
			$btn4 = '';
			
			if( $data['_order_trackno1'][0] != '' ){
				$style1 = '';
				$btn1 = 'style="display: none"';
			}
			if( $data['_order_trackno2'][0] != '' ){
				$style2 = '';
				$btn2 = 'style="display: none"';
			}
			if( $data['_order_trackno3'][0] != '' ){
				$style3 = '';
				$btn3 = 'style="display: none"';
			}
			if( $data['_order_trackno4'][0] != '' ){
				$style4 = '';
				$btn4 = 'style="display: none"';
			}
			
			?>
			<div id="sdetails">
				<ul class="totals">
					<li>
						<label><?php _e('Tracking Number:', 'wshipinfo-patsatech'); ?></label>
						<br />
						<input type="text" id="_order_trackno" name="_order_trackno" placeholder="Enter Tracking No" value="<?php if (isset($data['_order_trackno'][0])) echo $data['_order_trackno'][0]; ?>" class="first" />
					</li>		
					<li>
						<label><?php _e('Shipping Company:', 'wshipinfo-patsatech'); ?></label><br />
						<select id="_order_trackurl" name="_order_trackurl" onselect="javascript:toggle();" onclick="javascript:toggle();" >
							<option value="NOTRACK" <?php if ($data['_order_trackurl'][0] == 'NOTRACK') {
								echo 'selected="selected"';
							} ?>><?php _e('No Tracking', 'wshipinfo-patsatech'); ?></option>
							<?php $this->shipping_details_options( $data, $options, '' ); ?>
						</select>
					</li>
					<li id="shownzcourierinfo" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <b style="color:red;">LH-14148561</b>.</h4>
					<img src="<?php echo SDURL.'/img/lab1.jpg'; ?>"/>
					</li>
					<li id="showpostnllinfo" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('TrackingNo-PostalCode', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
					<li id="showapcovernight" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('PostalCode-TrackingNo', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
	
				</ul>
				<input type="button" class="button button-primary" name="save" value="Add Second" id="add1" <?php echo $btn1; ?> onclick="javascript:sdetails1display();" />
			</div>
			<div id="sdetails1" <?php echo $style1; ?>>
				<ul class="totals">
					<li>
						<label><?php _e('Tracking Number 2:', 'wshipinfo-patsatech'); ?></label>
						<br />
						<input type="text" id="_order_trackno1" name="_order_trackno1" placeholder="Enter Tracking No" value="<?php if (isset($data['_order_trackno1'][0])) echo $data['_order_trackno1'][0]; ?>" class="first" />
					</li>		
					<li>
						<label><?php _e('Shipping Company 2:', 'wshipinfo-patsatech'); ?></label><br />
						<select id="_order_trackurl1" name="_order_trackurl1" onclick="javascript:toggle1();"  onselect="javascript:toggle1();" >
							<option value="NOTRACK" <?php if ($data['_order_trackurl1'][0] == 'NOTRACK') {
								echo 'selected="selected"';
							} ?>><?php _e('No Tracking', 'wshipinfo-patsatech'); ?></option>
							<?php $this->shipping_details_options( $data, $options, '1' ); ?>
						</select>
					</li>
					<li id="shownzcourierinfo1" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <b style="color:red;">LH-14148561</b>.</h4>
					<img src="<?php echo SDURL.'/img/lab1.jpg'; ?>"/>
					</li>
					<li id="showpostnllinfo1" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('TrackingNo-PostalCode', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
					<li id="showapcovernight1" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('PostalCode-TrackingNo', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
					
				</ul>
				<input type="button" class="button button-primary" name="save" value="Add Third" id="add2" <?php echo $btn2; ?> onclick="javascript:sdetails2display();" />
				<input type="button" class="button button-primary" name="save" value="Remove"  id="remove1" <?php echo $btn1; ?> onclick="javascript:sdetails1remove();" />
			</div>
			<div id="sdetails2" <?php echo $style2; ?>>
				<ul class="totals">
					<li>
						<label><?php _e('Tracking Number 3:', 'wshipinfo-patsatech'); ?></label>
						<br />
						<input type="text" id="_order_trackno2" name="_order_trackno2" placeholder="Enter Tracking No" value="<?php if (isset($data['_order_trackno2'][0])) echo $data['_order_trackno2'][0]; ?>" class="first" />
					</li>		
					<li>
						<label><?php _e('Shipping Company 3:', 'wshipinfo-patsatech'); ?></label><br />
						<select id="_order_trackurl2" name="_order_trackurl2" onclick="javascript:toggle2();"  onselect="javascript:toggle2();" >
							<option value="NOTRACK" <?php if ($data['_order_trackurl2'][0] == 'NOTRACK') {
								echo 'selected="selected"';
							} ?>><?php _e('No Tracking', 'wshipinfo-patsatech'); ?></option>
							<?php $this->shipping_details_options( $data, $options, '2' ); ?>
						</select>
					</li>
					<li id="shownzcourierinfo2" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <b style="color:red;">LH-14148561</b>.</h4>
					<img src="<?php echo SDURL.'/img/lab1.jpg'; ?>"/>
					</li>
					<li id="showpostnllinfo2" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('TrackingNo-PostalCode', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
					<li id="showapcovernight2" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('PostalCode-TrackingNo', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
	
				</ul>
				<input type="button" class="button button-primary" name="save" id="add3" value="Add Fourth" <?php echo $btn3; ?> onclick="javascript:sdetails3display();" />
				<input type="button" class="button button-primary" name="save" value="Remove"  id="remove2" <?php echo $btn2; ?> onclick="javascript:sdetails2remove();" />
			</div>
			<div id="sdetails3" <?php echo $style3; ?>>
				<ul class="totals">
					<li>
						<label><?php _e('Tracking Number 4:', 'wshipinfo-patsatech'); ?></label>
						<br />
						<input type="text" id="_order_trackno3" name="_order_trackno3" placeholder="Enter Tracking No" value="<?php if (isset($data['_order_trackno3'][0])) echo $data['_order_trackno3'][0]; ?>" class="first" />
					</li>		
					<li>
						<label><?php _e('Shipping Company 4:', 'wshipinfo-patsatech'); ?></label><br />
						<select id="_order_trackurl3" name="_order_trackurl3" onclick="javascript:toggle3();"  onselect="javascript:toggle3();" >
							<option value="NOTRACK" <?php if ($data['_order_trackurl3'][0] == 'NOTRACK') {
								echo 'selected="selected"';
							} ?>><?php _e('No Tracking', 'wshipinfo-patsatech'); ?></option>
							<?php $this->shipping_details_options( $data, $options, '3' ); ?>
						</select>
					</li>
					<li id="shownzcourierinfo3" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <b style="color:red;">LH-14148561</b>.</h4>
					<img src="<?php echo SDURL.'/img/lab1.jpg'; ?>"/>
					</li>
					<li id="showpostnllinfo3" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('TrackingNo-PostalCode', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
					<li id="showapcovernight3" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('PostalCode-TrackingNo', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
	
				</ul>
				<input type="button" class="button button-primary" name="save" value="Add Fifth" id="add4" <?php echo $btn4; ?> onclick="javascript:sdetails4display();" />
				<input type="button" class="button button-primary" name="save" value="Remove"  id="remove3" <?php echo $btn3; ?> onclick="javascript:sdetails3remove();" />
			</div>
			<div id="sdetails4" <?php echo $style4; ?>>
				<ul class="totals">
					<li>
						<label><?php _e('Tracking Number 5:', 'wshipinfo-patsatech'); ?></label>
						<br />
						<input type="text" id="_order_trackno4" name="_order_trackno4" placeholder="Enter Tracking No" value="<?php if (isset($data['_order_trackno4'][0])) echo $data['_order_trackno4'][0]; ?>" class="first" />
					</li>		
					<li>
						<label><?php _e('Shipping Company 5:', 'wshipinfo-patsatech'); ?></label><br />
						<select id="_order_trackurl4" name="_order_trackurl4" onclick="javascript:toggle4();"  onselect="javascript:toggle4();" >
							<option value="NOTRACK" <?php if ($data['_order_trackurl4'][0] == 'NOTRACK') {
								echo 'selected="selected"';
							} ?>><?php _e('No Tracking', 'wshipinfo-patsatech'); ?></option>
							<?php $this->shipping_details_options( $data, $options, '4' ); ?>
						</select>
					</li>
					<li id="shownzcourierinfo4" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <b style="color:red;">LH-14148561</b>.</h4>
					<img src="<?php echo SDURL.'/img/lab1.jpg'; ?>"/>
					</li>
					<li id="showpostnllinfo4" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('TrackingNo-PostalCode', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
					<li id="showapcovernight4" style="display: none">
					<h4><?php echo 'Enter the Tracking Number as'; ?> <br><b style="color:red;"><?php _e('PostalCode-TrackingNo', 'wshipinfo-patsatech'); ?></b>.</h4>
					</li>
	
				</ul>
				<input type="button" class="button button-primary" name="save" value="Remove" id="remove4" <?php echo $btn4; ?> onclick="javascript:sdetails4remove();" />
			</div>
			<div class="clear"></div><?php 

		}			
	
		function woocommerce_process_shop_ordermeta( $post_id, $post ) {
	
			global $wpdb, $woocommerce;
			
			$woocommerce_errors = array();
				
			add_post_meta( $post_id, '_order_key', uniqid('order_') );
		
			update_post_meta( $post_id, '_order_trackno', stripslashes( $_POST['_order_trackno'] ));
		
			update_post_meta( $post_id, '_order_trackurl', stripslashes( $_POST['_order_trackurl'] ));
		
			update_post_meta( $post_id, '_order_trackno1', stripslashes( $_POST['_order_trackno1'] ));
		
			update_post_meta( $post_id, '_order_trackurl1', stripslashes( $_POST['_order_trackurl1'] ));
		
			update_post_meta( $post_id, '_order_trackno2', stripslashes( $_POST['_order_trackno2'] ));
		
			update_post_meta( $post_id, '_order_trackurl2', stripslashes( $_POST['_order_trackurl2'] ));
		
			update_post_meta( $post_id, '_order_trackno3', stripslashes( $_POST['_order_trackno3'] ));
		
			update_post_meta( $post_id, '_order_trackurl3', stripslashes( $_POST['_order_trackurl3'] ));
		
			update_post_meta( $post_id, '_order_trackno4', stripslashes( $_POST['_order_trackno4'] ));
		
			update_post_meta( $post_id, '_order_trackurl4', stripslashes( $_POST['_order_trackurl4'] ));
		}
	
		function woocommerce_metaboxes() {

			add_meta_box( 'woocommerce-order-ship', __('Shipping Details', 'wshipinfo-patsatech'), array( &$this, 'woocommerce_order_shippingdetails' ), 'shop_order', 'side', 'high');

		}
	
		function ship_register_settings(){
			register_setting('woo_ship_group','woo_ship_options');
			wp_enqueue_script('shippingdetails-js', SDURL.'/js/shippingdetails.js', array('jquery')); 
		}
			
		function ship_select_menu()
		{
			
			if (!function_exists('current_user_can') || !current_user_can('manage_options') )
			return;
				
			if ( function_exists( 'add_options_page' ) )
			{
				add_options_page(
					__('Shipping Details Settings', 'wshipinfo-patsatech'),
					__('Shipping Details', 'wshipinfo-patsatech'),
					'manage_options',
					'woo_ship_buttons',
					array( &$this, 'admin_options' ) );
			}
		}
			
			
		public function admin_options() {
			$options = get_option( 'woo_ship_options' );
			ob_start();
		   	?>
			<div class="wrap">
				<?php screen_icon("options-general"); ?>
				<h2>Shipping Details Settings</h2>
				<br>
				<h3><b>Select Shipping Company that you will be using to ship the Products.</b></h3>
				<form action="options.php" method="post"  style="padding-left:20px">
				<?php 	settings_fields('woo_ship_group'); ?>	
					<table cellpadding="10px">
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[USPS]" id="USPS" value="1"<?php checked( 1 == $options['USPS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('US Postal Service', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[AUSTRALIAPOST]" id="AUSTRALIAPOST" value="1"<?php checked( 1 == $options['AUSTRALIAPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Australia POST Domestic', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[AUSTRALIAPOSTINTL]" id="AUSTRALIAPOSTINTL" value="1"<?php checked( 1 == $options['AUSTRALIAPOSTINTL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Australia POST International', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[CHINAPOST]" id="CHINAPOST" value="1"<?php checked( 1 == $options['CHINAPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('China POST', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[CANADAPOST]" id="CANADAPOST" value="1"<?php checked( 1 == $options['CANADAPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Canada POST', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[ANPOST]" id="ANPOST" value="1"<?php checked( 1 == $options['ANPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('An POST', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[PARCELFORCE]" id="PARCELFORCE" value="1"<?php checked( 1 == $options['PARCELFORCE'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Parcel Force', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[FEDEX]" id="FEDEX" value="1"<?php checked( 1 == $options['FEDEX'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('FEDEX', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[DHL]" id="DHL" value="1"<?php checked( 1 == $options['DHL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('DHL', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[UPS]" id="UPS" value="1"<?php checked( 1 == $options['UPS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('UPS', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[NZCOURIERS]" id="NZCOURIERS" value="1"<?php checked( 1 == $options['NZCOURIERS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('New Zealand Couriers', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[POSTNLL]" id="POSTNLL" value="1"<?php checked( 1 == $options['POSTNLL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('POSTNL Local', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[POSTNLINTL]" id="POSTNLINTL" value="1"<?php checked( 1 == $options['POSTNLINTL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('POSTNL International', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[COURIERPOST]" id="COURIERPOST" value="1"<?php checked( 1 == $options['COURIERPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('CourierPost', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[NEWZEALANDPOST]" id="NEWZEALANDPOST" value="1"<?php checked( 1 == $options['NEWZEALANDPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('New Zealand Post', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[FASTWAY]" id="FASTWAY" value="1"<?php checked( 1 == $options['FASTWAY'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Fastway Couriers', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[TPCINDIA]" id="TPCINDIA" value="1"<?php checked( 1 == $options['TPCINDIA'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Professionals Courier', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[TRADELL]" id="TRADELL" value="1"<?php checked( 1 == $options['TRADELL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('TradeLink International', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[OMICC]" id="OMICC" value="1"<?php checked( 1 == $options['OMICC'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('OM International Courier & Cargo', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[ICCW]" id="ICCW" value="1"<?php checked( 1 == $options['ICCW'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('ICC Worldwide', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[UACE]" id="UACE" value="1"<?php checked( 1 == $options['UACE'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Urgent Air Courier Express', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[FIRSTFLIGHT]" id="FIRSTFLIGHT" value="1"<?php checked( 1 == $options['FIRSTFLIGHT'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('First Flight', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[ORBITWW]" id="ORBITWW" value="1"<?php checked( 1 == $options['ORBITWW'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Orbit Worldwide', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[FLYKING]" id="FLYKING" value="1"<?php checked( 1 == $options['FLYKING'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('FlyKing', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[SHREEMC]" id="SHREEMC" value="1"<?php checked( 1 == $options['SHREEMC'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Shree Maruti Courier', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[SMCS]" id="SMCS" value="1"<?php checked( 1 == $options['SMCS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('S M Courier Services', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[OVERSEASCS]" id="OVERSEASCS" value="1"<?php checked( 1 == $options['OVERSEASCS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('OverSeas Courier Service', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[BLUEDART]" id="BLUEDART" value="1"<?php checked( 1 == $options['BLUEDART'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('BlueDart', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[AFLWIZ]" id="AFLWIZ" value="1"<?php checked( 1 == $options['AFLWIZ'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('AFL WiZ Express', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[AFLLT]" id="AFLLT" value="1"<?php checked( 1 == $options['AFLLT'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('AFL Logistics / Transportation', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[BLAZEFLASHD]" id="BLAZEFLASHD" value="1"<?php checked( 1 == $options['BLAZEFLASHD'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('BlazeFlash Domestic', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[BLAZEFLASHI]" id="BLAZEFLASHI" value="1"<?php checked( 1 == $options['BLAZEFLASHI'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('BlazeFlash International', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[ARAMEX]" id="ARAMEX" value="1"<?php checked( 1 == $options['ARAMEX'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Aramex', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[SHREEMAHAC]" id="SHREEMAHAC" value="1"<?php checked( 1 == $options['SHREEMAHAC'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Shree Mahavir Courier', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[POSTOUK]" id="POSTOUK" value="1"<?php checked( 1 == $options['POSTOUK'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('POST Office UK', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[TNTEXPRESS]" id="TNTEXPRESS" value="1"<?php checked( 1 == $options['TNTEXPRESS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('TNT Express', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[HDNL]" id="HDNL" value="1"<?php checked( 1 == $options['HDNL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Home Delivery Network', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[CITYLINK]" id="CITYLINK" value="1"<?php checked( 1 == $options['CITYLINK'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('City link', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[JPPOST]" id="JPPOST" value="1"<?php checked( 1 == $options['JPPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Japan POST', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[POSTDAN]" id="POSTDAN" value="1"<?php checked( 1 == $options['POSTDAN'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Post Danmark', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[POSTSWEDEN]" id="POSTSWEDEN" value="1"<?php checked( 1 == $options['POSTSWEDEN'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Posten Sweden', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[POSTNORWAY]" id="POSTNORWAY" value="1"<?php checked( 1 == $options['POSTNORWAY'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Posten Norway', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[PARCEL2GO]" id="PARCEL2GO" value="1"<?php checked( 1 == $options['PARCEL2GO'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Parcel2Go', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[YODEL]" id="YODEL" value="1"<?php checked( 1 == $options['YODEL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Yodel', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[COLLECTPLUS]" id="COLLECTPLUS" value="1"<?php checked( 1 == $options['COLLECTPLUS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Collect+', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[CITYSPRINT]" id="CITYSPRINT" value="1"<?php checked( 1 == $options['CITYSPRINT'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('CitySprint', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[POSTINDIA]" id="POSTINDIA" value="1"<?php checked( 1 == $options['POSTINDIA'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('India POST', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[INTEXPRESS]" id="INTEXPRESS" value="1"<?php checked( 1 == $options['INTEXPRESS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('InterLink Express', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[DPDPARCEL]" id="DPDPARCEL" value="1"<?php checked( 1 == $options['DPDPARCEL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('DPD Parcel', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[SPEEDEE]" id="SPEEDEE" value="1"<?php checked( 1 == $options['SPEEDEE'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Spee Dee', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[PUROLATOR]" id="PUROLATOR" value="1"<?php checked( 1 == $options['PUROLATOR'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Purolator', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[ONTRAC]" id="ONTRAC" value="1"<?php checked( 1 == $options['ONTRAC'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('OnTrac', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[LASERSHIP]" id="LASERSHIP" value="1"<?php checked( 1 == $options['LASERSHIP'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('LaserShip', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[SAFEX]" id="SAFEX" value="1"<?php checked( 1 == $options['SAFEX'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('SafeXpress', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[DYNAMEX]" id="DYNAMEX" value="1"<?php checked( 1 == $options['DYNAMEX'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Dynamex', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[ENSENDA]" id="ENSENDA" value="1"<?php checked( 1 == $options['ENSENDA'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Ensenda', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[CEVA]" id="CEVA" value="1"<?php checked( 1 == $options['CEVA'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('CEVA', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[AONEINT]" id="AONEINT" value="1"<?php checked( 1 == $options['AONEINT'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('A-1 International', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[PARCELLINK]" id="PARCELLINK" value="1"<?php checked( 1 == $options['PARCELLINK'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Parcel link', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[NAPAREX]" id="NAPAREX" value="1"<?php checked( 1 == $options['NAPAREX'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('NAPAREX', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[PNCOURIER]" id="PNCOURIER" value="1"<?php checked( 1 == $options['PNCOURIER'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Poslaju National Courier', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[SKYNET]" id="SKYNET" value="1"<?php checked( 1 == $options['SKYNET'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('SkyNET', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[GDEX]" id="GDEX" value="1"<?php checked( 1 == $options['GDEX'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('GD Express', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[CHRONOS]" id="CHRONOS" value="1"<?php checked( 1 == $options['CHRONOS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Chronos Couriers', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[POSMALAY]" id="POSMALAY" value="1"<?php checked( 1 == $options['POSMALAY'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('POS Malayasia', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[LAPOSTE]" id="LAPOSTE" value="1"<?php checked( 1 == $options['LAPOSTE'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('LA Poste', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[JNEEXP]" id="JNEEXP" value="1"<?php checked( 1 == $options['JNEEXP'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('JNE Express', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[BRTCE]" id="BRTCE" value="1"<?php checked( 1 == $options['BRTCE'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('BRT Courier Express', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[POSINDO]" id="POSINDO" value="1"<?php checked( 1 == $options['POSINDO'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('POS Indonesia', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[ROYALMAIL]" id="ROYALMAIL" value="1"<?php checked( 1 == $options['ROYALMAIL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Royal Mail', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[MYHERMES]" id="MYHERMES" value="1"<?php checked( 1 == $options['MYHERMES'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Hermes', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[SINGPOST]" id="SINGPOST" value="1"<?php checked( 1 == $options['SINGPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('SingPost', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[GATI]" id="GATI" value="1"<?php checked( 1 == $options['GATI'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('GATI', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[AFGHANPOST]" id="AFGHANPOST" value="1"<?php checked( 1 == $options['AFGHANPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Afghan POST', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[PAKPOST]" id="PAKPOST" value="1"<?php checked( 1 == $options['PAKPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Pakistan POST', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[LITPOST]" id="LITPOST" value="1"<?php checked( 1 == $options['LITPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Lithuania POST', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[PERUPOST]" id="PERUPOST" value="1"<?php checked( 1 == $options['PERUPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('PERU POST', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[ROMPOST]" id="ROMPOST" value="1"<?php checked( 1 == $options['ROMPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Romania POST', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp" >
								<input type="checkbox" name="woo_ship_options[ELTA]" id="ELTA" value="1"<?php checked( 1 == $options['ELTA'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('Elta', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[HKPOST]" id="HKPOST" value="1"<?php checked( 1 == $options['HKPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('HongKong POST', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[LBCEX]" id="LBCEX" value="1"<?php checked( 1 == $options['LBCEX'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('LBC Express', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[PHLPOST]" id="PHLPOST" value="1"<?php checked( 1 == $options['PHLPOST'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('PHL Post', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[APCOVERNIGHT]" id="APCOVERNIGHT" value="1"<?php checked( 1 == $options['APCOVERNIGHT'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('APC OverNight', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[UKMAIL]" id="UKMAIL" value="1"<?php checked( 1 == $options['UKMAIL'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('UK Mail', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[CORREIOS]" id="CORREIOS" value="1"<?php checked( 1 == $options['CORREIOS'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('CORREIOS', 'wshipinfo-patsatech') ?></td>
					    </tr>
					    <tr>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[CTT]" id="CTT" value="1"<?php checked( 1 == $options['CTT'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('CTT', 'wshipinfo-patsatech') ?></td>
					        <td class="forminp">
								<input type="checkbox" name="woo_ship_options[SMARTSEND]" id="SMARTSEND" value="1"<?php checked( 1 == $options['SMARTSEND'] ); ?> />
										
					        </td>
					        <td scope="row"><?php _e('SmartSend', 'wshipinfo-patsatech') ?></td>
					    </tr>
					</table>
					<p class="submit">
						<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'wshipinfo-patsatech'); ?>" />
					</p>
				</form>
			</div>
			<?php
			echo ob_get_clean();
		}	
	
		function track_page_shipping_details( $order ){
					
			$order_meta = get_post_custom( $order->id );
						
			for ($i=0; $i<=4; $i++)
		  	{
				if($i == 0){
			  		$this->shipping_details($order_meta['_order_trackno'] , $order_meta['_order_trackurl']);
				}else{
			  		$this->shipping_details($order_meta['_order_trackno'.$i] , $order_meta['_order_trackurl'.$i]);					
				}
		  	}
			
		}
		
		
		function email_shipping_details( $order ) {
					
			$order_meta = get_post_custom( $order->id );
						
			for ($i=0; $i<=4; $i++)
		  	{
				if($i == 0){
			  		$this->shipping_details($order_meta['_order_trackno'] , $order_meta['_order_trackurl']);
				}else{
			  		$this->shipping_details($order_meta['_order_trackno'.$i] , $order_meta['_order_trackurl'.$i]);					
				}
		  	}

		}
		
		function shipping_details($trackno , $trackurl){
			
			if ($trackurl[0] == 'USPS'){
				$trackcomp = 'USPS';
				$urltrack = 'http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?origTrackNum='.$trackno[0];
			} 
			else if ($trackurl[0] == 'AUSTRALIAPOST'){
				$trackcomp = 'Australia POST Domestic';
				$urltrack = 'http://auspost.com.au/track/display.asp?type=article&id='.$trackno[0];	 
			}
			else if ($trackurl[0] == 'AUSTRALIAPOSTINTL'){
				$trackcomp = 'Australia POST International';
				$urltrack = 'http://ice.auspost.com.au/display.asp?ShowFirstScreenOnly=FALSE&ShowFirstRecOnly=TRUE&txtItemNumber='.$trackno[0];
			}
			else if ($trackurl[0] == 'CHINAPOST'){
				$trackcomp = 'China POST';
				$urltrack = 'http://intmail.183.com.cn/item/itemStatusQuery.do?lan=0&itemNo='.$trackno[0];
			}
			else if ($trackurl[0] == 'CANADAPOST'){
				$trackcomp = 'Canada POST';
				$urltrack = 'https://www.canadapost.ca/cpotools/apps/track/personal/findByTrackNumber?trackingNumber='.$trackno[0].'&LOCALE=en';
			}
			else if ($trackurl[0] == 'HKPOST'){
				$trackcomp = 'HongKong POST';
				$urltrack = 'http://app3.hongkongpost.com/CGI/mt/genresult.jsp?tracknbr='.$trackno[0];
			}
			else if ($trackurl[0] == 'ANPOST'){
				$trackcomp = 'An POST';
				$urltrack = 'http://track.anpost.ie/track/track.asp?track='.$trackno[0];
			}
			else if ($trackurl[0] == 'PARCELFORCE'){
				$trackcomp = 'Parcel Force';
				$urltrack = 'http://www.parcelforce.com/track-trace?trackNumber='.$trackno[0].'&page_type=rml-tracking-details';
			}
			else if ($trackurl[0] == 'FEDEX'){
				$trackcomp = 'FEDEX';
				$urltrack = 'http://www.fedex.com/Tracking?action=track&tracknumbers='.$trackno[0];
			}
			else if ($trackurl[0] == 'DHL'){
				$trackcomp = 'DHL';
				$urltrack = 'http://www.dhl.com/content/g0/en/express/tracking.shtml?brand=DHL&AWB='.$trackno[0];
			}
			else if ($trackurl[0] == 'UPS'){
				$trackcomp = 'UPS';
				$urltrack = 'http://wwwapps.ups.com/WebTracking/processRequest?&tracknum='.$trackno[0];
			}
			else if ($trackurl[0] == 'NZCOURIERS'){
				$trackcomp = 'New Zealand Couriers';
				$track = explode("-", $trackno[0]);
				$urltrack = 'http://www.nzcouriers.co.nz/nzc/servlet/ITNG_TAndTServlet?page=1&VCCA=Enabled&Key_Type=Ticket&product_code='.$track[0].'&serial_number='.$track[1];
			}
			else if ($trackurl[0] == 'POSTNLL'){
				$trackcomp = 'POSTNL Local';
				$track = explode("-", $trackno[0]);
				$urltrack = 'https://mijnpakket.postnl.nl/Claim?Barcode='.$track[0].'&Postalcode='.$track[1].'&Foreign=False&ShowAnonymousLayover=False&CustomerServiceClaim=False';
			}
			else if ($trackurl[0] == 'POSTNLINTL'){
				$trackcomp = 'POSTNL International';
				$urltrack = 'https://mijnpakket.postnl.nl/Claim?Barcode='.$trackno[0].'&Postalcode=&Foreign=True&ShowAnonymousLayover=False&CustomerServiceClaim=False';
			}
			else if ($trackurl[0] == 'COURIERPOST'){
				$trackcomp = 'CourierPost';
				$urltrack = 'http://trackandtrace.courierpost.co.nz/search/'.$trackno[0];
			}
			else if ($trackurl[0] == 'NEWZEALANDPOST'){
				$trackcomp = 'New Zealand Post';
				$urltrack = 'http://www.nzpost.co.nz/tools/tracking?trackid='.$trackno[0];
			}
			else if ($trackurl[0] == 'FASTWAY'){
				$trackcomp = 'Fastway Couriers';
				$urltrack = 'http://fastway.com.au/courier-services/track-your-parcel?l='.$trackno[0];
			}
			else if ($trackurl[0] == 'TPCINDIA'){
				$trackcomp = 'Professionals Courier';
				$urltrack = 'http://www.tpcindia.com/track.aspx?id='.$trackno[0];
			}
			else if ($trackurl[0] == 'TRADELL'){
				$trackcomp = 'TradeLink International';
				$urltrack = 'http://www.tradelinkinternational.co.in/track.asp?awbno='.$trackno[0];
			}
			else if ($trackurl[0] == 'OMICC'){
				$trackcomp = 'OM International Courier & Cargo';
				$urltrack = 'http://www.omintl.net/tracking.aspx?AwbNo='.$trackno[0];
			}
			else if ($trackurl[0] == 'ICCW'){
				$trackcomp = 'ICC Worldwide';
				$urltrack = 'http://www.iccworld.com/track.asp?txtawbno='.$trackno[0];
			}
			else if ($trackurl[0] == 'UACE'){
				$trackcomp = 'Urgent Air Courier Express';
				$urltrack = 'http://urgentair.co.in/trackshipment_status.php?track='.$trackno[0];
			}
			else if ($trackurl[0] == 'FIRSTFLIGHT'){
				$trackcomp = 'First Flight';
				$urltrack = 'http://www.firstflight.net/track.asp?txtcon_no='.$trackno[0];
			}
			else if ($trackurl[0] == 'ORBITWW'){
				$trackcomp = 'Orbit Worldwide';
				$urltrack = 'http://www.orbitexp.com/tools/showTrack.asp?awbnoMul='.$trackno[0];
			}
			else if ($trackurl[0] == 'FLYKING'){
				$trackcomp = 'FlyKing';
				$urltrack = 'http://www.flykingonline.com/WebFCS/cnotequery.aspx?cnoteno='.$trackno[0];
			}
			else if ($trackurl[0] == 'SHREEMC'){
				$trackcomp = 'Shree Maruti Courier';
				$urltrack = 'http://erp.shreemarutionline.com/frmTrackingDetails.aspx?id='.$trackno[0];
			}
			else if ($trackurl[0] == 'SMCS'){
				$trackcomp = 'S M Courier Services';
				$urltrack = 'http://www.smcouriers.com/Tracking.aspx?btnchk=A&txtAwb='.$trackno[0];
			}
			else if ($trackurl[0] == 'OVERSEASCS'){
				$trackcomp = 'OverSeas Courier Service';
				$urltrack = 'https://webcsw.ocs.co.jp/csw/ECSWG0201R00003P.do?edtAirWayBillNo='.$trackno[0];
			}
			else if ($trackurl[0] == 'BLUEDART'){
				$trackcomp = 'BlueDart';
				$urltrack = 'http://www.bluedart.com/servlet/RoutingServlet?handler=tnt&action=awbquery&awb=awb&numbers='.$trackno[0];
			}
			else if ($trackurl[0] == 'AFLWIZ'){
				$trackcomp = 'AFL WiZ Express';
				$urltrack = 'http://trackntrace.aflwiz.com/Wiz_Summary.jsp?shpntnum='.$trackno[0];
			}
			else if ($trackurl[0] == 'AFLLT'){
				$trackcomp = 'AFL Logistics / Transportation';
				$urltrack = 'http://trackntrace.afllogistics.com/login.do?gcn='.$trackno[0];
			}
			else if ($trackurl[0] == 'BLAZEFLASHD'){
				$trackcomp = 'BlazeFlash Domestic';
				$urltrack = 'http://www.blazeflash.net/trackdetail.aspx?awbno='.$trackno[0];
			}
			else if ($trackurl[0] == 'BLAZEFLASHI'){
				$trackcomp = 'BlazeFlash International';
				$urltrack = 'http://www.blazeflash.net/intl/trackfinal.asp?search='.$trackno[0];
			}
			else if ($trackurl[0] == 'ARAMEX'){
				$trackcomp = 'Aramex';
				$urltrack = 'http://www.aramex.com/track_results_multiple.aspx?ShipmentNumber='.$trackno[0];
			}
			else if ($trackurl[0] == 'SHREEMAHAC'){
				$trackcomp = 'Shree Mahavir Courier';
				$urltrack = 'http://www.shreemahavircourier.com/ShipmentDetails.aspx?Type=track&awb='.$trackno[0];
			}
			else if ($trackurl[0] == 'POSTOUK'){
				$trackcomp = 'POST Office UK';
				$urltrack = 'http://www.postoffice.co.uk/track-trace?trackNumber='.$trackno[0].'&page_type=rml-tracking-details';
			}
			else if ($trackurl[0] == 'TNTEXPRESS'){
				$trackcomp = 'TNT Express';
				$urltrack = 'http://www.tnt.com/webtracker/tracking.do?cons='.$trackno[0].'&trackType=CON&saveCons=Y';
			}
			else if ($trackurl[0] == 'HDNL'){
				$trackcomp = 'Home Delivery Network';
				$urltrack = 'http://www.hdnl.co.uk/UPI-Tracking-Details/?upi='.$trackno[0];
			}
			else if ($trackurl[0] == 'CITYLINK'){
				$trackcomp = 'City link';
				$urltrack = 'http://www.city-link.co.uk/dynamic/track.php?parcel_ref_num='.$trackno[0];
			}
			else if ($trackurl[0] == 'JPPOST'){
				$trackcomp = 'Japan POST';
				$urltrack = 'http://tracking.post.japanpost.jp/service/singleSearch.do?searchKind=S004&locale=en&reqCodeNo1='.$trackno[0].'&x=16&y=15';
			}
			else if ($trackurl[0] == 'POSTDAN'){
				$trackcomp = 'Post Danmark';
				$urltrack = 'http://www.postdanmark.dk/tracktrace/TrackTrace.do?i_lang=INE&i_stregkode='.$trackno[0];
			}
			else if ($trackurl[0] == 'POSTSWEDEN'){
				$trackcomp = 'Posten Sweden';
				$urltrack = 'http://www.posten.se/tracktrace/TrackConsignments_do.jsp?trackntraceAction=saveSearch&lang=GB&consignmentId='.$trackno[0];
			}
			else if ($trackurl[0] == 'POSTNORWAY'){
				$trackcomp = 'Posten Norway';
				$urltrack = 'http://sporing.posten.no/sporing.html?q='.$trackno[0].'&lang=en';
			}
			else if ($trackurl[0] == 'PARCEL2GO'){
				$trackcomp = 'Parcel2Go';
				$urltrack = 'https://www.parcel2go.com/UniversalTracking.aspx?tk='.$trackno[0];
			}
			else if ($trackurl[0] == 'YODEL'){
				$trackcomp = 'Yodel';
				$urltrack = 'http://tracking.yodel.co.uk/wrd/run/wt_pclinf_req_pw.EntryPoint?PCL_NO='.$trackno[0];
			}
			else if ($trackurl[0] == 'COLLECTPLUS'){
				$trackcomp = 'Collect+';
				$urltrack = 'https://www.collectplus.co.uk/track/'.$trackno[0];
			}
			else if ($trackurl[0] == 'CITYSPRINT'){
				$trackcomp = 'CitySprint';
				$urltrack = 'http://ijb.citysprint.co.uk/cs/quiktrak.php?CK=&wwhawb='.$trackno[0];
			}
			else if ($trackurl[0] == 'POSTINDIA'){
				$trackcomp = 'India POST';
				$urltrack = 'http://services.ptcmysore.gov.in/Speednettracking/Track.aspx?articlenumber='.$trackno[0];
			}
			else if ($trackurl[0] == 'INTEXPRESS'){
				$trackcomp = 'InterLink Express';
				$urltrack = 'http://www.interlinkexpress.com/tracking/trackingSearch.do?search.searchType=0&appmode=guest&search.parcelNumber='.$trackno[0];
			}
			else if ($trackurl[0] == 'DPDPARCEL'){
				$trackcomp = 'DPD Parcel';
				$urltrack = 'https://tracking.dpd.de/cgi-bin/delistrack?pknr='.$trackno[0].'&typ=1&lang=en';
			}
			else if ($trackurl[0] == 'SPEEDEE'){
				$trackcomp = 'Spee Dee';
				$urltrack = 'http://packages.speedeedelivery.com/packages.asp?tracking='.$trackno[0];
			}
			else if ($trackurl[0] == 'PUROLATOR'){
				$trackcomp = 'Purolator';
				$urltrack = 'https://eshiponline.purolator.com/ShipOnline/Public/Track/TrackingDetails.aspx?pup=Y&pin='.$trackno[0];
			}
			else if ($trackurl[0] == 'ONTRAC'){
				$trackcomp = 'OnTrac';
				$urltrack = 'http://www.ontrac.com/trackingres.asp?tracking_number='.$trackno[0].'&x=16&y=8';
			}
			else if ($trackurl[0] == 'LASERSHIP'){
				$trackcomp = 'LaserShip';
				$urltrack = 'http://www.lasership.com/track.php?track_number_input='.$trackno[0].'&Submit=Track';
			}
			else if ($trackurl[0] == 'SAFEX'){
				$trackcomp = 'SafeXpress';
				$urltrack = 'http://www.safexpress.com/shipment_inq.aspx?sno='.$trackno[0];
			}
			else if ($trackurl[0] == 'DYNAMEX'){
				$trackcomp = 'Dynamex';
				$urltrack = 'https://www.dynamex.com/shipping/dxnow-order-track?ctl='.$trackno[0];
			}
			else if ($trackurl[0] == 'ENSENDA'){
				$trackcomp = 'Ensenda';
				$urltrack = 'http://www.ensenda.com/content/track-shipment?trackingNumber='.$trackno[0].'&TRACKING_SEND=GO';
			}
			else if ($trackurl[0] == 'CEVA'){
				$trackcomp = 'CEVA';
				$urltrack = 'http://www.cevalogistics.com/en-US/toolsresources/Pages/CEVATrak.aspx?sv='.$trackno[0];
			}
			else if ($trackurl[0] == 'AONEINT'){
				$trackcomp = 'A-1 International';
				$urltrack = 'http://www.aoneonline.com/pages/customers/shiptrack.php?tracking_number='.$trackno[0];
			}
			else if ($trackurl[0] == 'PARCELLINK'){
				$trackcomp = 'Parcel link';
				$urltrack = 'http://www.parcel-link.co.uk/track-and-trace.php?consignment='.$trackno[0];
			}
			else if ($trackurl[0] == 'NAPAREX'){
				$trackcomp = 'NAPAREX';
				$urltrack = 'https://xcel.naparex.com/orders/WebForm/OrderTracking.aspx?OrderTrackingID='.$trackno[0];
			}
			else if ($trackurl[0] == 'PNCOURIER'){
				$trackcomp = 'Poslaju National Courier';
				$urltrack = 'http://www.pos.com.my/emstrack/viewdetail.asp?parcelno='.$trackno[0];
			}
			else if ($trackurl[0] == 'SKYNET'){
				$trackcomp = 'SkyNET';
				$urltrack = 'http://www.courierworld.com/scripts/webcourier1.dll/TrackingResultwoheader?type=4&nid=1&hawbNoList='.$trackno[0];
			}
			else if ($trackurl[0] == 'GDEX'){
				$trackcomp = 'GD Express';
				$urltrack = 'http://203.106.236.200/official/etracking.php?capture='.$trackno[0].'&Submit=Track';
			}
			else if ($trackurl[0] == 'CHRONOS'){
				$trackcomp = 'Chronos Couriers';
				$urltrack = 'http://chronoscouriers.com/popup/scr_popup_trak_shipment.php?shipmentId='.$trackno[0];
			}
			else if ($trackurl[0] == 'POSMALAY'){
				$trackcomp = 'POS Malayasia';
				$urltrack = 'http://www.pos.com.my/emstrack/viewdetail.asp?parcelno='.$trackno[0];
			}
			else if ($trackurl[0] == 'LAPOSTE'){
				$trackcomp = 'LA Poste';
				$urltrack = 'http://www.csuivi.courrier.laposte.fr/suivi/index/id/'.$trackno[0];
			}			
			else if ($trackurl[0] == 'JNEEXP'){
				$trackcomp = 'JNE Express';
				$urltrack = 'http://www.jne.co.id/index.php?mib=tracking.detail&awb='.$trackno[0];
			}
			else if ($trackurl[0] == 'BRTCE'){
				$trackcomp = 'BRT Courier Express';
				$urltrack = 'http://as777.brt.it/vas/sped_det_show.hsm?referer=sped_numspe_par.htm&Nspediz='.$trackno[0].'&RicercaNumeroSpedizione=Search';
			}
			else if ($trackurl[0] == 'POSINDO'){
				$trackcomp = 'POS Indonesia';
				$urltrack = 'http://www.posindonesia.co.id/home/modules/mod_search/tmpl/libs/lacakk1121m4np05.php?jenis=0&barcode='.$trackno[0].'&lacak=Lacak';
			}
			else if ($trackurl[0] == 'ROYALMAIL'){
				$trackcomp = 'Royal Mail';
				$urltrack = 'http://www.royalmail.com/portal/rm/track?trackNumber='.$trackno[0];
			}
			else if ($trackurl[0] == 'MYHERMES'){
				$trackcomp = 'Hermes';
				$urltrack = 'https://www.hermes-europe.co.uk/tracker.html?trackingNumber='.$trackno[0].'&Postcode='.$trackno[1];
			}
			else if ($trackurl[0] == 'SINGPOST'){
				$trackcomp = 'SingPost';
				$urltrack = 'http://www.singpost.com/index.php?option=com_tablink&controller=tracking&task=trackdetail&layout=show_detail&tmpl=component&ranumber='.$trackno[0];
			}
			else if ($trackurl[0] == 'GATI'){
				$trackcomp = 'GATI Courier';
				$urltrack = 'http://www.gati.com/single_dkt_track_int.jsp?dktNo='.$trackno[0];
			}
			else if ($trackurl[0] == 'AFGHANPOST'){
				$trackcomp = 'Afghan POST';
				$urltrack = 'http://afghanpost.gov.af/track/index.php?ID='.$trackno[0];
			}
			else if ($trackurl[0] == 'PAKPOST'){
				$trackcomp = 'Pakistan POST';
				$urltrack = 'http://ep.gov.pk/track.asp?textfield='.$trackno[0];
			}
			else if ($trackurl[0] == 'LITPOST'){
				$trackcomp = 'Lithuania POST';
				$urltrack = 'http://www.post.lt/en/help/parcel-search/index?num='.$trackno[0];
			}
			else if ($trackurl[0] == 'PERUPOST'){
				$trackcomp = 'PERU POST';
				$urltrack = 'http://clientes.serpost.com.pe/Web-Original/IPSWeb_item_events.asp?itemid='.$trackno[0].'&Submit=Submit';
			}
			else if ($trackurl[0] == 'ROMPOST'){
				$trackcomp = 'Romania POST';
				$urltrack = 'http://www.posta-romana.ro/en/posta-romana/servicii-online/track-trace.html?track='.$trackno[0];
			}
			else if ($trackurl[0] == 'ELTA'){
				$trackcomp = 'Elta';
				$urltrack = 'http://www.eltacourier.gr/en/webservice_client.php?br='.$trackno[0];
			}
			else if ($trackurl[0] == 'LBCEX'){
				$trackcomp = 'LBC Express';
				$urltrack = 'http://www.lbcexpress.com/IN/TrackAndTraceResults/0/'.$trackno[0];
			}
			else if ($trackurl[0] == 'PHLPOST'){
				$trackcomp = 'PHL Post';
				$urltrack = 'http://webtrk1.philpost.org/index.asp?i='.$trackno[0];
			}
			else if ($trackurl[0] == 'APCOVERNIGHT'){
				$track = explode("-", $trackno[0]);
				$trackcomp = 'APC OverNight';
				$urltrack = 'http://www.apc-overnight.com/apc/quickpod.php?txtpostcode='.$track[0].'&txtconno='.$track[1].'&Track=Track&type=1';
			}
			else if ($trackurl[0] == 'UKMAIL'){
				$trackcomp = 'UK Mail';
				$urltrack = 'https://www.ukmail.com/ConsignmentStatus/UnsecuredConsignmentDetails.aspx?SearchType=Consignment&SearchString='.$trackno[0];
			}
			else if ($trackurl[0] == 'CORREIOS'){
				$trackcomp = 'CORREIOS';
				$urltrack = 'http://websro.correios.com.br/sro_bin/txect01$.Inexistente?P_LINGUA=001&P_TIPO=002&P_COD_LIS='.$trackno[0];
			}
			else if ($trackurl[0] == 'CTT'){
				$trackcomp = 'CTT';
				$urltrack = 'http://www.ctt.pt/feapl_2/app/open/tools.jspx?lang=def&objects='.$trackno[0].'&showResults=true';
			}
			else if ($trackurl[0] == 'SMARTSEND'){
				$trackcomp = 'SmartSend';
				$urltrack = 'https://www.smartsend.com.au/#!track?consignment='.$trackno[0];
			}
			
			if ($trackno[0] != null && $trackurl[0] != null && $trackurl[0] != 'NOTRACK' ) { ?>
				<h3><?php echo _e('Your Order has been shipped via', 'wshipinfo-patsatech'); ?> <?php echo $trackcomp; ?>.</h3>
				<?php if ($trackurl[0] == 'POSTNLL'){?>
				<STRONG><?php echo _e('Tracking #', 'wshipinfo-patsatech'); ?> </STRONG><?php echo $track[0]; ?><br/>
				<STRONG><?php echo _e('Postal Code' , 'wshipinfo-patsatech');?> </STRONG><?php echo $track[1]; ?>
				<?php } else if ($trackurl[0] == 'APCOVERNIGHT'){?>
				<STRONG><?php echo _e('Consignment #', 'wshipinfo-patsatech'); ?> </STRONG><?php echo $track[1]; ?><br/>
				<STRONG><?php echo _e('Postal Code' , 'wshipinfo-patsatech');?> </STRONG><?php echo $track[0]; ?>
				<?php } else { ?>
				<STRONG><?php echo _e('Tracking #', 'wshipinfo-patsatech'); ?></STRONG><?php echo $trackno[0]; ?>
				<?php } ?>
				<br/>
				<a href="<?php echo $urltrack; ?>" target="_blank" ><STRONG><?php echo _e('CLICK HERE', 'wshipinfo-patsatech'); ?></STRONG> </a><?php echo _e('to track your shipment.', 'wshipinfo-patsatech'); ?>
				<br/><br/>
			<?php } 
			
		}
	}
}
$GLOBALS['wooshippinginfo'] = new wooshippinginfo();