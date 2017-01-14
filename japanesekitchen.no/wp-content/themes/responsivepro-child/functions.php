<?php 
$domain = 'responsive-child';

		load_theme_textdomain( $domain, WP_LANG_DIR . '/responsive-child/' );
		load_theme_textdomain( $domain, WP_LANG_DIR . '/responsive-child/' . '/languages/' );
		load_theme_textdomain( $domain, WP_LANG_DIR . '/responsive-child/' . '/languages/' ); 
		
		
	
	
function my_widget_title($title, $instance, $id_base) {
      if ( is_singular() && 'my_post_type' == get_post_type() && 'recent-posts' == $id_base) {
        return __('Recent entries from my_post_type');
      }
      else {
      	//var_dump($instance);
      	//var_dump($title);
      	//_e( 'Categories', 'responsive-child' );
      	//_e( 'Hagen Media - Nettsider og markedsf�ring.', 'responsive-child' );
        return __( $title, 'responsive-child' );
      }
    }
 
add_filter ( 'widget_title' , 'my_widget_title', 10, 3);

__( 'Categories', 'responsive-child' );
wp_register_script('jquery', ("http://code.jquery.com/jquery-latest.min.js"), false, '');
wp_enqueue_script('jquery');

wp_register_script('backstretch', (get_stylesheet_directory_uri() . "/jquery.backstretch.min.js"), false, '');
wp_enqueue_script('backstretch');

function get_post_content_by_slug($slug){
	$post = get_page_by_path( $slug, OBJECT, 'post' );
	$postcontent = apply_filters('the_content', $post->post_content); 
	return $postcontent;
}

add_action('wpcf7_mail_sent', 'extra_sms', 10, 3);

function extra_sms2(){
	//
}

//add_action( 'wpcf7_before_send_mail', 'extra_sms2' );

function extra_sms( $cf7 )
{
	//if ($_SERVER['REMOTE_ADDR'] == '83.109.35.209' || $_SERVER['REMOTE_ADDR'] == '81.89.11.237'){
		//echo "<pre>";
		//var_dump($cf7->posted_data);
		
    
		if (isset($cf7->posted_data['res_phone']) &&
			isset($cf7->posted_data['menu-dd']) &&
			isset($cf7->posted_data['menu-mm']) &&
			isset($cf7->posted_data['menu-yy']) &&
			isset($cf7->posted_data['res_menu'])
		) {
			$time = explode(":", $cf7->posted_data['res_menu']);
			$cell 	= $cf7->posted_data['res_phone'];
			$dd		= $cf7->posted_data['menu-dd'];
			$dd_n 	= ltrim($dd, '0');
			$dd		= str_pad($dd, 2, '0', STR_PAD_LEFT); 

//			$mm 	= date('m',strtotime($cf7->posted_data['menu-mm']));
			$mm 	= $cf7->posted_data['menu-mm'];
      $mm = strtolower($mm);
//      $mm = substr($mm, 3);
      
//			$mm 	= str_pad($mm, 2, '0', STR_PAD_LEFT); 
			$yy		= $cf7->posted_data['menu-yy'];
			$h_		= $time[0];
			$m_		= $time[1];
      $navn = $cf7->posted_data['res_name'];
      $navn = str_replace(" ", "%20", $navn);
      $antall = $cf7->posted_data['res_nr'];

                        
                        if ($_SERVER['REMOTE_ADDR'] == '151.231.135.22'){
                            echo "<pre>";var_dump($cf7->posted_data);
                            //die();
                        }
                        
                        $cellowner = "41088880";
                      //  $cellowner = "92282815";
                        
			//var_dump($dd);
			//var_dump($mm);
			//$string1 = "https://sveve.no/SMS/SendMessage?user=hagenmedia&passwd=per39&to=[cell]&msg=Hei!%20Din%20bordreservasjon%20[dd].[mm].[yy]%20kl.%20[hh.mm]%20er%20bekreftet.%20Velkommen!%20Mvh%20Sushi%20Delight";
			//$string2 = "https://sveve.no/SMS/SendMessage?user=hagenmedia&passwd=per39&to=[cell]&msg=Hei!%20Din%20bordreservasjon%20[dd].[mm].[yy]%20kl.%20[hh.mm]%20er%20bekreftet.%20Velkommen!%20Mvh%20Sushi%20Delight%20([cell])";
			
			$string1 = "https://sveve.no/SMS/SendMessage?user=hagenmedia&passwd=per39&to=$cell&msg=Hei!%20Din%20bordreservasjon%20$dd_n.%20$mm%20kl.%20$h_.$m_%20(ant.%20$antall)%20er%20bekreftet.%20Velkommen!%20Mvh%20Arigato&from=41088880";
			$string2 = "https://sveve.no/SMS/SendMessage?user=hagenmedia&passwd=per39&to=$cellowner&msg=Bordreservasjon%20av%20$navn%20$dd_n.%20$mm%20kl.%20$h_.$m_.%20Antall%20$antall.%20($cell)&from=Arigato";
//			$string1 = "https://sveve.no/SMS/SendMessage?user=hagenmedia&passwd=per39&to=$cell&msg=Hei!%20Din%20bordreservasjon%20er%20bekreftet.%20Velkommen!%20Mvh%20Sushi%20Delight&from=41088880";
//			$string2 = "https://sveve.no/SMS/SendMessage?user=hagenmedia&passwd=per39&to=$cellowner&msg=Bordreservasjon%20$dd.$mm.$yy%20kl.%20$h_.$m_%20er%20bekreftet.%20($cell)&from=Sushi";
//var_dump($string1);
//var_dump($string2);
//die();
			//%20$dd.%20$mm%20kl.%20$h_.$m_%20
			//20av%20$navn%20$dd.%20$mm%20kl.%20$h_.$m_.%20
			$response1 = file_get_contents($string1);
			var_dump($response1);
			
			$response2 = file_get_contents($string2);
			var_dump($response2);
		}
		//die();
	//}
}