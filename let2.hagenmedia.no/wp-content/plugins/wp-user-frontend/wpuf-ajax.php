<?php

class WPUF_Ajax {

    function __construct() {
        add_action( 'wp_ajax_nopriv_wpuf_get_child_cats', array($this, 'get_child_cats') );
        add_action( 'wp_ajax_wpuf_get_child_cats', array($this, 'get_child_cats') );

        add_action( 'wp_ajax_wpuf_feat_img_del', array($this, 'featured_img_delete') );
        add_action( 'wp_ajax_wpuf_featured_img', array($this, 'featured_img_upload') );
		
		add_action( 'wp_ajax_wpuf_get_car_info', array($this, 'get_car_info') );
    }


	function get_car_info(){
		$exteral_url = "http://www.vegvesen.no/Kjoretoy/Eie+og+vedlikeholde/Kjøretøyopplysninger?registreringsnummer=" . $_POST['reg_nr'];
		
		$ch = curl_init($exteral_url);
        curl_setopt($ch,CURLOPT_FRESH_CONNECT,true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_REFERER,$master_url);
        curl_setopt($ch,CURLOPT_TIMEOUT,30);		
	    $output = curl_exec($ch);
		
		$car_info = array();
		
		preg_match_all("/<tr><th>Kjøretøygruppe<\/th><td>(.*?)<\/td><\/tr>/s", $output, $matches, PREG_SET_ORDER);
		if ($matches) $car_info['new_post_avgiftsklasse'] = $matches[0][1];
		
		preg_match_all("/<tr><th>Registreringsår<\/th><td>(.*?)<\/td><\/tr>/s", $output, $matches, PREG_SET_ORDER);
		if ($matches) $car_info['new_post_1_gang_reg'] = $matches[0][1];
		
		preg_match_all("/<tr><th>Antall seter<\/th><td>(.*?)<\/td><\/tr>/s", $output, $matches, PREG_SET_ORDER);
		if ($matches) $car_info['antall_seter'] = $matches[0][1];
		
		preg_match_all("/<tr><th>Farge<\/th><td>(.*?)<\/td><\/tr>/s", $output, $matches, PREG_SET_ORDER);
		if ($matches) $car_info['farge'] = $matches[0][1];
		
		preg_match_all("/<tr><th>Drivstoff<\/th><td>(.*?)<\/td><\/tr>/s", $output, $matches, PREG_SET_ORDER);
		if ($matches) $car_info['drivstoff'] = $matches[0][1];
		
		preg_match_all("/<tr><th>Registrert første gang i Norge<\/th><td>(.*?)\.(.*?)\.(.*?)<\/td><\/tr>/s", $output, $matches, PREG_SET_ORDER);
		if ($matches) $car_info['one_gang_reg'] = $matches[0][3];
		
		preg_match_all("/<tr><th>Slagvolum<\/th><td>(.*?) cm<sup>3<\/sup><\/td><\/tr>/s", $output, $matches, PREG_SET_ORDER);
		if ($matches) $car_info['new_post_sylindervolum'] = round($matches[0][1]/1000, 1);
		
		preg_match_all("/<td>(.*?) KW \((.*?) HK\)\s+?<\/td>/s", $output, $matches, PREG_SET_ORDER);
		if ($matches) $car_info['effekt'] = $matches[0][2];
	
		echo json_encode($car_info);die();
	}
    /**
     * Returns child category dropdown on ajax request
     */
    function get_child_cats() {
        $parentCat = $_POST['catID'];
        $result = '';
        if ( $parentCat < 1 )
            die( $result );

        if ( get_categories( 'taxonomy=product_cat&child_of=' . $parentCat . '&hide_empty=0' ) ) {
            $result .= wp_dropdown_categories( 'show_option_none=' . __( '-- Select --', 'wpuf' ) . '&class=dropdownlist&orderby=name&name=category[]&id=cat-ajax&order=ASC&hide_empty=0&hierarchical=1&taxonomy=product_cat&depth=1&echo=0&child_of=' . $parentCat );
        } else {
            die( '' );
        }

        die( $result );
    }

    /**
     * Delete a featured image via ajax
     *
     * @since 0.8
     */
    function featured_img_delete() {
        check_ajax_referer( 'wpuf_nonce', 'nonce' );

        $attach_id = isset( $_POST['attach_id'] ) ? intval( $_POST['attach_id'] ) : 0;
        $attachment = get_post( $attach_id );

        //post author or editor role
        if ( get_current_user_id() == $attachment->post_author || current_user_can( 'delete_private_pages' ) ) {
            wp_delete_attachment( $attach_id, true );
            echo 'success';
        }

        exit;
    }

    /**
     * Upload Featured image via ajax
     *
     * @since 0.8
     */
    function featured_img_upload() {
        check_ajax_referer( 'wpuf_featured_img', 'nonce' );

        $upload_data = array(
            'name' => $_FILES['wpuf_featured_img']['name'],
            'type' => $_FILES['wpuf_featured_img']['type'],
            'tmp_name' => $_FILES['wpuf_featured_img']['tmp_name'],
            'error' => $_FILES['wpuf_featured_img']['error'],
            'size' => $_FILES['wpuf_featured_img']['size']
        );

        $attach_id = wpuf_upload_file( $upload_data );

        if ( $attach_id ) {
            $html = wpuf_feat_img_html( $attach_id );

            $response = array(
                'success' => true,
                'html' => $html,
            );

            echo json_encode( $response );
            exit;
        }

        $response = array('success' => false);
        echo json_encode( $response );
        exit;
    }

}

$wpuf_ajax = new WPUF_Ajax();