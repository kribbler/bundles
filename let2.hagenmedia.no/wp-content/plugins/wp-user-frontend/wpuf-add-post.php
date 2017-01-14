<?php

/**
 * Add Post form class
 *
 * @author Tareq Hasan
 * @package WP User Frontend
 */
class WPUF_Add_Post {

    function __construct() {
        add_shortcode( 'wpuf_addpost', array($this, 'shortcode') );
    }

    /**
     * Handles the add post shortcode
     *
     * @param $atts
     */
    function shortcode( $atts ) {

        extract( shortcode_atts( array('post_type' => 'post'), $atts ) );

        ob_start();

        if ( is_user_logged_in() ) {
            $this->post_form( $post_type );
        } else {
            printf( __( "This page is restricted. Please %s to view this page.", 'wpuf' ), wp_loginout( get_permalink(), false ) );
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * following function is written by daniel
     */
    function show_attribute_terms($taxonomy){
    	$final = '<option value="">'. __('-- Select --', wpuf) . '</option>';
		$terms = get_terms($taxonomy, array('hide_empty' => false));
		
		foreach ($terms as $term){
			$final .= "<option value='" . $term->name . "'>" . $term->name . "</option>";
		}
		return $final;
    }
    /**
     * Add posting main form
     *
     * @param $post_type
     */
    function post_form( $post_type ) {
        global $userdata;

        $userdata = get_user_by( 'id', $userdata->ID );

        if ( isset( $_POST['wpuf_post_new_submit'] ) ) {
            $nonce = $_REQUEST['_wpnonce'];
            if ( !wp_verify_nonce( $nonce, 'wpuf-add-post' ) ) {
                wp_die( __( 'Cheating?' ) );
            }

            $this->submit_post();
        }

        $info = __( "Post It!", 'wpuf' );
        $can_post = 'yes';

        $info = apply_filters( 'wpuf_addpost_notice', $info );
        $can_post = apply_filters( 'wpuf_can_post', $can_post );
        $featured_image = wpuf_get_option( 'enable_featured_image', 'wpuf_frontend_posting', 'no' );

        $title = isset( $_POST['wpuf_post_title'] ) ? esc_attr( $_POST['wpuf_post_title'] ) : '';
        $description = isset( $_POST['wpuf_post_content'] ) ? $_POST['wpuf_post_content'] : '';

        if ( $can_post == 'yes' ) {
        	
            ?>
            <div class="container_12">
			<div class="grid_8">
            <div id="wpuf-post-area">
                <form id="wpuf_new_post_form" name="wpuf_new_post_form" action="" enctype="multipart/form-data" method="POST">
                    <?php wp_nonce_field( 'wpuf-add-post' ) ?>

                    <ul class="wpuf-post-form">
						<li><h3>Nøkkelinfo (kan ikke endres)</h3></li>
                        <?php do_action( 'wpuf_add_post_form_top', $post_type ); //plugin hook   ?>
                        <?php wpuf_build_custom_field_form( 'top' ); ?>
                        
                        <li id="car_info_fetch" class="" style="display: none"></li>
						<li>
                        	<label for="new-post-year">Registreringsnummer</label>
                        	<input class="requiredField__" type="text" value="" name="wpuf_post_reg-nr" id="new-post-registreringsnummer" minlength="2">
                        	<span id="get_car_info">Få informasjon</span>
                        	<div class="clear"></div>
                        </li>
                            
                        <li style="display: none">
                            <label for="new-post-title">
                                <?php echo wpuf_get_option( 'title_label', 'wpuf_labels', 'Title'  ); ?> <span class="required__">*</span>
                            </label>
                            <input class="requiredField__" type="text" value="<?php echo $title; ?>" name="wpuf_post_title" id="new-post-title" minlength="2">
                            <div class="clear"></div>
                            <p class="description"><?php echo stripslashes( wpuf_get_option( 'title_help', 'wpuf_labels' ) ); ?></p>
                        </li>

                        <?php if ( wpuf_get_option( 'allow_cats', 'wpuf_frontend_posting', 'on' ) == 'on' ) { ?>
                            <li>
                                <label for="new-post-cat">
                                    <?php echo wpuf_get_option( 'cat_label', 'wpuf_labels', 'Category' ); ?> <span class="required__">*</span>
                                </label>

                                <div class="category-wrap" style="float:left;">
                                    <div id="lvl0">
                                        <?php
                                        $exclude = wpuf_get_option( 'exclude_cats', 'wpuf_frontend_posting' );
                                        $cat_type = wpuf_get_option( 'cat_type', 'wpuf_frontend_posting', 'normal' );

                                        if ( $cat_type == 'normal' ) {
                                            //wp_dropdown_categories( 'show_option_none=' . __( '-- Select --', 'wpuf' ) . '&hierarchical=1&hide_empty=0&orderby=name&name=category[]&id=cat&show_count=0&title_li=&use_desc_for_title=1&class=cat requiredField__&exclude=' . $exclude );
                                            wp_dropdown_categories( 'show_option_none=' . __( '-- Select --', 'wpuf' ) . '&hierarchical=1&hide_empty=0&orderby=name&name=category[]&id=cat&show_count=0&taxonomy=product_cat&echo=1&&title_li=&use_desc_for_title=1&class=cat requiredField__&exclude=' . $exclude );
                                        } else if ( $cat_type == 'ajax' ) {
                                            wp_dropdown_categories( 'show_option_none=' . __( '-- Select --', 'wpuf' ) . '&hierarchical=1&hide_empty=0&orderby=name&name=category[]&id=cat-ajax&show_count=0&taxonomy=product_cat&title_li=&use_desc_for_title=1&class=cat requiredField__&depth=1&exclude=' . $exclude );
                                        } else {
                                            wpuf_category_checklist(0, false, 'category', $exclude);
                                        }
                                        ?>
                                        <span id="lvl0___"></span>
                                    </div>
                                    
                                </div>
                                <div class="loading"></div>
                                <div class="clear"></div>
                                <p class="description"><?php echo stripslashes( wpuf_get_option( 'cat_help', 'wpuf_labels' ) ); ?></p>
                            </li>
                            
                            <li style="display: none">
                            	<label for="new-post-arsmodell">Year</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_arsmodell" id="new-post-arsmodell" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-year">Variant</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_variant" id="new-post-variant" minlength="2">
                            	<div class="clear"></div>
                            	<p class="description">Variant blir automatisk lagt til merke og modell, f.eks. Volkswagen Golf 2.0 GL. Det er ikke lov å bruke dette feltet til annen tekst, som Løp og kjøp, o.l.</p>
                            </li>
                            
                            <li>
                            	<label for="new-post-karosseri">Karosseri <span class="required__">*</span></label>
                            	<select name="wpuf_post_karosseri">
	                            	<?php echo $this->show_attribute_terms("pa_karosseri") ?>
                            	</select>
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-avgiftsklasse">Avgiftsklasse <span class="required__">*</span></label>
                            	<select id="new-post-avgiftsklasse" name="wpuf_post_avgiftsklasse">
                            	<?php echo $this->show_attribute_terms("pa_avgiftsklasse"); ?>
                            	</select>
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-year">Skjul registreringsnummer</label>
                            	<input class="requiredField__" type="checkbox" value="" name="wpuf_post_skjul-registreringsnummer" id="new-post-skjul_registreringsnummer" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-drivstoff">Drivstoff <span class="required__">*</span></label>
                            	<select id="new-post-drivstoff" name="wpuf_post_drivstoff">
                            	<?php echo $this->show_attribute_terms("pa_drivstoff");?>
                            	</select>
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-farge">Farge <span class="required__">*</span></label>
                            	<select id="new-post-farge" name="wpuf_post_farge">
                            	<?php echo $this->show_attribute_terms("pa_farge");?>
                            	</select>
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-farge_beskr">Farge beskrivelse</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_farge-beskr" id="new-post-farge-beskr" minlength="2">
                            	<div class="clear"></div>
                            	<p class="description">(f.eks Azurblå)</p>
                            </li>
                            
                            <li>
                            	<label for="new-post-effekt">Effekt</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_effekt" id="new-post-effekt" minlength="2">
                            	<div class="clear"></div>
                            	<p class="description">(hk)</p>
                            </li>
                            
                            <li>
                            	<label for="new-post-girkasse">Girkasse <span class="required__">*</span></label>
                            	<select name="wpuf_post_girkasse">
                            	<?php echo $this->show_attribute_terms("pa_girkasse");?>
                            	</select>
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-gir_betegnelse">Gir betegnelse</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_gir-betegnelse" id="new-post-gir-betegnelse" minlength="2">
                            	<div class="clear"></div>
                            	<p class="description">(f.eks Tiptronic)</p>
                            </li>
                            
                            <li>
                            	<label for="new-post-hjuldrift">Hjuldrift <span class="required__">*</span></label>
                            	<select name="wpuf_post_hjuldrift">
                            	<?php echo $this->show_attribute_terms("pa_hjuldrift");?>
                            	</select>
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-hjuldrift_beskrivelse">Hjuldrift beskrivelse</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_hjuldrift-beskrivelse" id="new-post-hjuldrift-beskrivelse" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li><h3>Detaljinfo</h3></li>
                            
                            <li>
                            	<label for="new-post-bilen">Bilen står i <span class="required__">*</span></label>
                            	<select name="wpuf_post_bilen-star-i">
                            	<?php echo $this->show_attribute_terms("pa_bilen-star-i");?>
                            	</select>
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-pris-eks-omreg">Salgspris eks. omreg. <span class="required__">*</span></label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_pris-eks-omreg" id="new-post-salgspris-eks-omreg" minlength="2">
                            	<div class="clear"></div>
                            	<p class="description">(kr)</p>
                            </li>
                            
                            <li>
                            	<label for="new-post-omregistrering">Omregistreringsavgift <span class="required__">*</span></label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_omregistrering" id="new-post-omregistrering" minlength="2">
                            	<div class="clear"></div>
                            	<p class="description">(kr)</p>
                            </li>
                            
                            <li>
                            	<label for="new-post-fritatt-fra-omreg-avgift">Fritatt fra omreg. avgift?</label>
                            	<input class="requiredField__" type="checkbox" value="" name="wpuf_post_fritatt-fra-omreg-avgift" id="new-post-fritatt-fra-omreg-avgift" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<p style="font-size: 1.3em">Totalpris: <b><span id="calc_total_price"></span>,-</b> (søkbar pris)</p>
                            </li>
                            
                            <li><p><i>Selger er ansvarlig for at opplysningene om omreg.avgift stemmer.</i></p></li>
                            
                            <li>
                            	<label for="new-post-bilen">Årsavgift inkludert <span class="required__">*</span></label>
                            	<select name="wpuf_post_arsavgift">
                            	<?php echo $this->show_attribute_terms("pa_arsavgift");?>
                            	</select>
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-kilometer">Km. stand <span class="required__">*</span></label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_kilometer" id="new-post-kilometer" minlength="2">
                            	<div class="clear"></div>
                            	<p class="description">(km)</p>
                            </li>
                            
                            <li>
                            	<label for="new-post-arsmodell">Årsmodell <span class="required__">*</span></label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_arsmodell" id="new-post-arsmodell" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-1-gang-reg">1. gang registrert</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_1-gang-reg" id="new-post-1-gang-reg" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-antall-eiere">Antall eiere</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_antall-eiere" id="new-post-antall-eiere" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-sylindervolum">Sylindervolum</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_sylindervolum" id="new-post-sylindervolum" minlength="2">
                            	<div class="clear"></div>
                            	<p class="description">(liter, f.eks 1.8)</p>
                            </li>
                            
                            <li>
                            	<label for="new-post-antall-seter">Antall seter <span class="required__">*</span></label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_antall-seter" id="new-post-antall-seter" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-antall-dorer">Antall dører</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_antall-dorer" id="new-post-antall-dorer" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-naf-testnummer">NAF testnummer</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_naf-testnummer" id="new-post-naf-testnummer" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li>
                            	<label for="new-post-naf-testnummer">Co2-utslipp</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_co2-utslipp" id="new-post-co2-utslipp" minlength="2">
                            	<div class="clear"></div>
                            	<p class="description">(g/km)</p>
                            </li>
                            
                            <li>
                            	<label for="new-post-naf-testnummer">Interiørfarge</label>
                            	<input class="requiredField__" type="text" value="" name="wpuf_post_interiorfarge" id="new-post-interiorfarge" minlength="2">
                            	<div class="clear"></div>
                            </li>
                            
                            <li><h3>Utstyr</h3>
                            	<div class="Utstyr_col">
                            		<h4>Utvendig utstyr</h4>
                            		<?php 
                            		$utvendig_utstyr = get_term_by("name", "Utvendig utstyr", "pa_utstyr");
                            		$terms_utvendig_utstyr = get_terms("pa_utstyr", array('hide_empty' => false, 'parent' => $utvendig_utstyr->term_id));
                            		foreach ($terms_utvendig_utstyr as $term){?>
                            			<!--<div style="width: 30%; float: left">-->
                            				<input type = "checkbox" name="wpuf_post_utstyr_<?php echo $term->slug?>" /> <?php echo $term->name?><br />
                            			<!--</div>-->
                            		<?php } ?>
                            	</div>
                            	
                            	<div class="Utstyr_col">
                            		<h4>Komfort</h4>
                            		<?php 
                            		$komfort = get_term_by("name", "Komfort", "pa_utstyr");
                            		$terms_komfort = get_terms("pa_utstyr", array('hide_empty' => false, 'parent' => $komfort->term_id));
									//echo "<pre>";var_dump($terms_komfort);echo "</pre>";
                            		foreach ($terms_komfort as $term){?>
                            			<input type = "checkbox" name="wpuf_post_utstyr_<?php echo $term->slug?>" /> <?php echo $term->name?><br />
                            		<?php } ?>
                            	</div>
                            	
                            	<div class="Utstyr_col">
                            		<h4>Sikkerhet</h4>
                            		<?php 
                            		$sikkerhet = get_term_by("name", "Sikkerhet", "pa_utstyr");
                            		$terms_sikkerhet = get_terms("pa_utstyr", array('hide_empty' => false, 'parent' => $sikkerhet->term_id));
                            		foreach ($terms_sikkerhet as $term){?>
                            			<input type = "checkbox" name="wpuf_post_utstyr_<?php echo $term->slug?>" /> <?php echo $term->name?><br />
                            		<?php } ?>
                            	</div>
                            	
                            	<div class="clear"></div>
                            </li>
                            
                            
                        <?php } ?>

                        <?php do_action( 'wpuf_add_post_form_description', $post_type ); ?>
                        <?php wpuf_build_custom_field_form( 'description' ); ?>

						<li><h3>Beskrivelse</h3></li>
                        <li>
                            <label for="new-post-desc">
                                <?php echo wpuf_get_option( 'desc_label', 'wpuf_labels', '' ); ?> <span class="required__">*</span>
                            </label>

                            <?php
                            $editor = wpuf_get_option( 'editor_type', 'wpuf_frontend_posting' );
                            if ( $editor == 'full' ) {
                                ?>
                                <div style="float:left;">
                                    <?php wp_editor( $description, 'new-post-desc', array('textarea_name' => 'wpuf_post_content', 'editor_class' => 'requiredField__', 'teeny' => false, 'textarea_rows' => 8) ); ?>
                                </div>
                            <?php } else if ( $editor == 'rich' ) { ?>
                                <div style="float:left;">
                                    <?php wp_editor( $description, 'new-post-desc', array('textarea_name' => 'wpuf_post_content', 'editor_class' => 'requiredField__', 'teeny' => true, 'textarea_rows' => 8) ); ?>
                                </div>

                            <?php } else { ?>
                                <textarea name="wpuf_post_content" class="requiredField__" id="new-post-desc" cols="60" rows="8"><?php echo esc_textarea( $description ); ?></textarea>
                            <?php } ?>

                            <div class="clear"></div>
                            <p class="description"><?php echo stripslashes( wpuf_get_option( 'desc_help', 'wpuf_labels' ) ); ?></p>
                        </li>
                        
                        <li><h3>Salgssted (kan ikke endres)</h3></li>
                        
                        <li>
                            <label for="new-post-naf-postnummer">Postnummer <span class="required__">*</span></label>
                            <input class="requiredField__" type="text" value="" name="wpuf_post_postnummer" id="new-post-postnummer" minlength="2">
                            <div class="clear"></div>
                        </li>
                        
                        <li>
                            <label for="new-post-naf-postnummer">Gatenavn og nummer</label>
                            <input class="requiredField__" type="text" value="" name="wpuf_post_gatenavn-og-nummer" id="new-post-gatenavn-og-nummer" minlength="2">
                            <div class="clear"></div>
                        </li>
                            
						<li><h3>Kontaktinformasjon (kan ikke endres)</h3></li>
						
						<li>
                            <label for="new-post-naf-postnummer">E-post <span class="required__">*</span></label>
                            <input class="requiredField__" type="text" value="" name="wpuf_post_e-post" id="new-post-e-post" minlength="2">
                            <div class="clear"></div>
                        </li>
						
						<li>
                            <label for="new-post-naf-postnummer">Kontaktperson <span class="required__">*</span></label>
                            <input class="requiredField__" type="text" value="" name="wpuf_post_kontaktperson" id="new-post-kontaktperson" minlength="2">
                            <div class="clear"></div>
                        </li>
                        
                        <li>
                            <label for="new-post-naf-postnummer">Telefon <span class="required__">*</span></label>
                            <input class="requiredField__" type="text" value="" name="wpuf_post_telefon" id="new-post-telefon" minlength="2">
                            <div class="clear"></div>
                        </li>
                        
                        <li>
                            <label for="new-post-naf-postnummer">Mobil</label>
                            <input class="requiredField__" type="text" value="" name="wpuf_post_mobil" id="new-post-mobil" minlength="2">
                            <div class="clear"></div>
                        </li>
                        
                        <li>
                            <label for="new-post-naf-postnummer">Faks</label>
                            <input class="requiredField__" type="text" value="" name="wpuf_post_faks" id="new-post-faks" minlength="2">
                            <div class="clear"></div>
                        </li>
                        
                        <li><h3>Bilder</h3></li>
                        
                        <?php if ( $featured_image == 'yes' ) { ?>
                            <?php if ( current_theme_supports( 'post-thumbnails' ) ) { ?>
                                <li>
                                    <label for="post-thumbnail" style="display: none"><?php echo wpuf_get_option( 'ft_image_label', 'wpuf_frontend_posting', 'Featured Image' ); ?></label>
                                    <div id="wpuf-ft-upload-container">
                                        <div id="wpuf-ft-upload-filelist"></div>
                                        <a id="wpuf-ft-upload-pickfiles" class="button" href="#"><?php echo /*wpuf_get_option( 'ft_image_btn_label', 'wpuf_frontend_posting', 'Upload Image' )*/ wpuf_get_option( 'ft_image_btn_label', 'wpuf_frontend_posting', 'Last opp bilde' ); ?></a>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                            <?php } else { ?>
                                <div class="info"><?php _e( 'Your theme doesn\'t support featured image', 'wpuf' ) ?></div>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php
                        do_action( 'wpuf_add_post_form_after_description', $post_type );

                        $this->publish_date_form();
                        $this->expiry_date_form();

                        wpuf_build_custom_field_form( 'tag' );

                        if ( wpuf_get_option( 'allow_tags', 'wpuf_frontend_posting', 'on' ) == 'on' ) {
                            ?>
                            <li>
                                <label for="new-post-tags">
                                    <?php echo wpuf_get_option( 'tag_label', 'wpuf_labels', 'Tags' ); ?>
                                </label>
                                <input type="text" name="wpuf_post_tags" id="new-post-tags" class="new-post-tags">
                                <p class="description"><?php echo stripslashes( wpuf_get_option( 'tag_help', 'wpuf_labels' ) ); ?></p>
                                <div class="clear"></div>
                            </li>
                            <?php
                        }

                        do_action( 'wpuf_add_post_form_tags', $post_type );
                        wpuf_build_custom_field_form( 'bottom' );
                        ?>
<p></p>
                        <li>
                            <input class="wpuf_submit" type="submit" name="wpuf_new_post_submit" value="<?php echo esc_attr( wpuf_get_option( 'submit_label', 'wpuf_labels', 'Submit' ) ); ?>">
                            <input type="hidden" name="wpuf_post_type" value="<?php echo $post_type; ?>" />
                            <input type="hidden" name="wpuf_post_new_submit" value="yes" />
                        </li>

                        <?php do_action( 'wpuf_add_post_form_bottom', $post_type ); ?>

                    </ul>
                </form>
                <p>Feltene kan ikke endres når annonsen er opprettet</p>
            </div>
            </div>
            </div>
            
            <script type="text/javascript">
            	jQuery(document).ready(function($){
                	$('#new-post-salgspris-eks-omreg').blur(function(){
                    	$('#calc_total_price').html(
                            parseInt($(this).val()) + parseInt($('#new-post-omregistrering').val())
						);
                	});
                	$('#new-post-omregistrering').blur(function(){
                    	$('#calc_total_price').html(
                            parseInt($(this).val()) + parseInt($('#new-post-salgspris-eks-omreg').val())
						);
                	});
                	
                	$( document ).ajaxComplete(function(event,request, settings) {
                		console.log(event);
                		console.log(request);
                		console.log(settings);
                		
                		$('#lvl0___').html('<?php _e('Modell', wpuf);?>');
                		//$('#new-post-title').val('aaa');
                	});
            	});
            </script>
            <?php
        } else {
            echo '<div class="info">' . $info . '</div>';
        }
    }

    /**
     * Prints the post publish date on form
     *
     * @return bool|string
     */
    function publish_date_form() {
        $enable_date = wpuf_get_option( 'enable_post_date', 'wpuf_frontend_posting', 'off' );

        if ( $enable_date != 'on' ) {
            return;
        }

        $timezone_format = _x( 'Y-m-d G:i:s', 'timezone date format' );
        $month = date_i18n( 'm' );
        $month_array = array(
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec'
        );
        ?>
        <li>
            <label for="timestamp-wrap">
                <?php _e( 'Publish Time:', 'wpuf' ); ?> <span class="required__">*</span>
            </label>
            <div class="timestamp-wrap">
                <select name="mm">
                    <?php
                    foreach ($month_array as $key => $val) {
                        $selected = ( $key == $month ) ? ' selected="selected"' : '';
                        echo '<option value="' . $key . '"' . $selected . '>' . $val . '</option>';
                    }
                    ?>
                </select>
                <input type="text" autocomplete="off" tabindex="4" maxlength="2" size="2" value="<?php echo date_i18n( 'd' ); ?>" name="jj">,
                <input type="text" autocomplete="off" tabindex="4" maxlength="4" size="4" value="<?php echo date_i18n( 'Y' ); ?>" name="aa">
                @ <input type="text" autocomplete="off" tabindex="4" maxlength="2" size="2" value="<?php echo date_i18n( 'G' ); ?>" name="hh">
                : <input type="text" autocomplete="off" tabindex="4" maxlength="2" size="2" value="<?php echo date_i18n( 'i' ); ?>" name="mn">
            </div>
            <div class="clear"></div>
            <p class="description"></p>
        </li>
        <?php
    }

    /**
     * Prints post expiration date on the form
     *
     * @return bool|string
     */
    function expiry_date_form() {
        $post_expiry = wpuf_get_option( 'enable_post_expiry', 'wpuf_frontend_posting' );

        if ( $post_expiry != 'on' ) {
            return;
        }
        ?>
        <li>
            <label for="timestamp-wrap">
                <?php _e( 'Expiration Time:', 'wpuf' ); ?><span class="required__">*</span>
            </label>
            <select name="expiration-date">
                <?php
                for ($i = 1; $i <= 90; $i++) {
                    if ( $i % 2 != 0 ) {
                        continue;
                    }

                    printf( '<option value="%1$d">%1$d %2$s</option>', $i, __( 'days', 'wpuf' ) );
                }
                ?>
            </select>
            <div class="clear"></div>
            <p class="description"><?php _e( 'Post expiration time in day after publishing.', 'wpuf' ); ?></p>
        </li>
        <?php
    }

    /**
     * Validate the post submit data
     *
     * @global type $userdata
     * @param type $post_type
     */
    function submit_post() {
        global $userdata;
		
		/*echo "<pre>";
		$merke = get_term( $_POST['category'][0], "product_cat" );
			$_POST['wpuf_post_merke'] = $merke->name;
			$model = get_term( $_POST['category'][1], "product_cat" );
			$_POST['wpuf_post_modell'] = $model->name;
			
			var_dump($_POST);
		die();
		*/
        //echo 'the varddump is here';var_dump($_POST);var_dump($_FILES);die();
        $errors = array();

        //if there is some attachement, validate them
        if ( !empty( $_FILES['wpuf_post_attachments'] ) ) {
            $errors = wpuf_check_upload();
        }

        $title = trim( $_POST['wpuf_post_title'] );
		/**
		 * Daniel's code: create title from car's attributes
		 */
		
		$title = get_term( $_POST['category'][0], 'pa_merke' )->name;
		if ($_POST['category'][1]){
			$title .= ' ' . get_term( $_POST['category'][1], 'pa_modell' )->name;
		}
		if ($_POST['wpuf_post_arsmodell']){
			$title .= ", " . $_POST['wpuf_post_arsmodell'];
		}
		if ($_POST['wpuf_post_karosseri']){
			$title .= ", " . $_POST['wpuf_post_karosseri'];
		}
		if ($_POST['wpuf_post_drivstoff']){
			$title .= ", " . $_POST['wpuf_post_drivstoff'];
		}
		if ($_POST['wpuf_post_farge']){
			$title .= ", " . $_POST['wpuf_post_farge'];
		}
		//echo $title; 
		//echo "<pre>"; var_dump(get_term($_POST['category'][0], 'pa_merke'));var_dump(get_term(18517, 'pa_modell'));var_dump($_POST);die();
		
		
        $content = trim( $_POST['wpuf_post_content'] );

        $tags = '';
        if ( isset( $_POST['wpuf_post_tags'] ) ) {
            $tags = wpuf_clean_tags( $_POST['wpuf_post_tags'] );
        }

        //validate title
        if ( empty( $title ) ) {
            $errors[] = __( 'Empty product title', 'wpuf' );
        } else {
            $title = trim( strip_tags( $title ) );
        }

        //validate cat
        if ( wpuf_get_option( 'allow_cats', 'wpuf_frontend_posting', 'on' ) == 'on' ) {
            $cat_type = wpuf_get_option( 'cat_type', 'wpuf_frontend_posting', 'normal' );
            if ( !isset( $_POST['category'] ) ) {
                $errors[] = __( 'Please choose a category', 'wpuf' );
            } else if ( $cat_type == 'normal' && $_POST['category'][0] == '-1' ) {
                $errors[] = __( 'Please choose a category', 'wpuf' );
            } else {
                if ( count( $_POST['category'] ) < 1 ) {
                    $errors[] = __( 'Please choose a category', 'wpuf' );
                }
            }
        }

        //validate post content
        if ( empty( $content ) ) {
            $errors[] = __( 'Empty post content', 'wpuf' );
        } else {
            $content = trim( $content );
        }

        //process tags
        if ( !empty( $tags ) ) {
            $tags = explode( ',', $tags );
        }

        //post attachment
        $attach_id = isset( $_POST['wpuf_featured_img'] ) ? intval( $_POST['wpuf_featured_img'] ) : 0;

        //post type
        $post_type = trim( strip_tags( $_POST['wpuf_post_type'] ) );

        
        
        
        //process the custom fields
        $custom_fields = array();

        $fields = wpuf_get_custom_fields();
        if ( is_array( $fields ) ) {

            foreach ($fields as $cf) {
                if ( array_key_exists( $cf['field'], $_POST ) ) {

                    if ( is_array( $_POST[$cf['field']] ) ) {
                        $temp = implode(',', $_POST[$cf['field']]);
                    } else {
                        $temp = trim( strip_tags( $_POST[$cf['field']] ) );
                    }

                    //var_dump($temp, $cf);

                    if ( ( $cf['type'] == 'yes' ) && !$temp ) {
                        $errors[] = sprintf( __( '"%s" is missing', 'wpuf' ), $cf['label'] );
                    } else {
                        $custom_fields[$cf['field']] = $temp;
                    }
                } //array_key_exists
            } //foreach
        } //is_array

        $post_date_enable = wpuf_get_option( 'enable_post_date', 'wpuf_frontend_posting' );
        $post_expiry = wpuf_get_option( 'enable_post_expiry', 'wpuf_frontend_posting' );

        //check post date
        if ( $post_date_enable == 'on' ) {
            $month = $_POST['mm'];
            $day = $_POST['jj'];
            $year = $_POST['aa'];
            $hour = $_POST['hh'];
            $min = $_POST['mn'];

            if ( !checkdate( $month, $day, $year ) ) {
                $errors[] = __( 'Invalid date', 'wpuf' );
            }
        }

        $errors = apply_filters( 'wpuf_add_post_validation', $errors );


        //if not any errors, proceed
        if ( $errors ) {
            echo wpuf_error_msg( $errors );
            return;
        }

        $post_stat = wpuf_get_option( 'post_status', 'wpuf_frontend_posting' );
        $post_author = (wpuf_get_option( 'post_author', 'wpuf_frontend_posting' ) == 'original' ) ? $userdata->ID : wpuf_get_option( 'map_author', 'wpuf_frontend_posting' );

        //users are allowed to choose category
        if ( wpuf_get_option( 'allow_cats', 'wpuf_frontend_posting', 'on' ) == 'on' ) {
            $post_category = $_POST['category'];
        } else {
            $post_category = array(wpuf_get_option( 'default_cat', 'wpuf_frontend_posting' ));
        }

        $my_post = array(
            'post_title' => $title,
            'post_content' => $content,
            'post_status' => $post_stat,
            'post_author' => $post_author,
            'post_category' => $post_category,
            'post_type' => $post_type,
            'post_name' => sanitize_title($title),
            'tags_input' => $tags
        );

        if ( $post_date_enable == 'on' ) {
            $month = $_POST['mm'];
            $day = $_POST['jj'];
            $year = $_POST['aa'];
            $hour = $_POST['hh'];
            $min = $_POST['mn'];

            $post_date = mktime( $hour, $min, 59, $month, $day, $year );
            $my_post['post_date'] = date( 'Y-m-d H:i:s', $post_date );
        }

        //plugin API to extend the functionality
        $my_post = apply_filters( 'wpuf_add_post_args', $my_post );

        //var_dump( $_POST, $my_post );die();
        //insert the post
        $post_id = wp_insert_post( $my_post );

        if ( $post_id ) {
        	
	        /**
	         * Daniel's code - create custom fields array
	         * this should be moved after post is created so we can have it's ID
	         */
			
	        $my_custom_fields = array();
	        
	        $terms_utstyr = get_terms("pa_utstyr", array('hide_empty' => false));
	        $checked_utstyr = "";
	        foreach ($terms_utstyr as $term){
	        	if (isset($_POST['wpuf_post_utstyr_' . $term->slug])){
	        		$checked_utstyr .= $term->name;
					$checked_utstyr .= "|";
					$my_custom_fields[]['pa_utstyr'] = $term->name;
	        	}
	        }
	        $checked_utstyr = substr($checked_utstyr, 0, -1);
	        
			/**
			 * daniel's code to add product to merke and modell instead of category!
			 * instead of using the above line: $set_categories = wp_set_post_terms($post_id, $_POST['category'], "product_cat");
			 */
			 
			$merke = get_term( $_POST['category'][0], "product_cat" );
			$_POST['wpuf_post_merke'] = $merke->name;
			$model = get_term( $_POST['category'][1], "product_cat" );
			$_POST['wpuf_post_modell'] = $model->name;
			
			
	        $attributes = array('merke', 'modell',
	        	'arsmodell', 'variant', 'karosseri', 'avgiftsklasse', 'reg-nr',
	        	'skjul-registreringsnummer',
	        	'drivstoff', 'farge', 'farge-beskr', 'effekt', 'girkasse',
	        	'gir-betegnelse', 'hjuldrift', 'hjuldrift-beskrivelse', 'bilen-star-i',
	        	'pris-eks-omreg', 'omregistrering', 'fritatt-fra-omreg-avgift',
	        	'arsavgift', 'kilometer', '1-gang-reg', 'antall-eiere', 
	        	'sylindervolum', 'antall-seter', 'antall-dorer', 'naf-testnummer',
	        	'co2-utslipp', 'interiorfarge', 'postnummer', 'gatenavn-og-nummer',
	        	'e-post', 'kontaktperson', 'telefon', 'mobil', 'faks'	        
	        );
	        
	        foreach ($attributes as $attribute){
		        if (isset($_POST['wpuf_post_' . $attribute])){
		        	$my_custom_fields[]['pa_' . $attribute] = $_POST['wpuf_post_' . $attribute];
		        }
	        }
	        
	        foreach ($my_custom_fields as $cf){
	        	$key = key($cf);
	        	$value = $cf[$key];
				$new_post_custom_fields[$value] = array (
					"name" => $key,
					"value" => $value,
					"is_visible" => 1,
					"is_variation" => 0,
					"is_taxonomy" => 1
				);
				$new_post_terms[$key][] = $value;
				$existing_product_attributes = get_post_meta($post_id, '_product_attributes', true);
				if (is_array($existing_product_attributes))
					$new_post_custom_fields = array_merge($existing_product_attributes, $new_post_custom_fields);
	        }
	        
	        //var_dump($attributes);var_dump($new_post_custom_fields);die();
	        add_post_meta($post_id, '_product_attributes', $new_post_custom_fields, true) or
				update_post_meta($post_id, '_product_attributes', $new_post_custom_fields);
	    	foreach($new_post_terms as $tax => $term_ids) {
				$y = wp_set_object_terms($post_id, $term_ids, $tax);
				//var_dump($tax, $y);
			}
			
			/**
	         * daniel's code: attach images to post
	         */
			
			$attachments = array();
	        foreach ($_POST as $key=>$value){
	        	if (strstr($key, "wpuf_featured_img__")){
	        		$attachments[] = $value;
	        	}
	        }
	        $att_str = ""; $k=1;	        
	        foreach ($attachments as $attach_id){
	        	if ($k < count($attachments)){
		        	$att_str .= $attach_id;
		        	if ($k++ < count($attachments))
		        		$att_str .= ",";
	        	}
	        }
	        //echo $att_str;
	        update_post_meta($post_id, "_product_image_gallery", $att_str);
	        
			/**
			 * add product price
			 */
			$product_price = $new_post_terms['pa_pris-eks-omreg'][0] + $new_post_terms['pa_omregistreringsavgift'][0];
			//var_dump($product_price);
			add_post_meta($post_id, "_price", $product_price);
			add_post_meta($post_id, "_regular_price", $product_price);
			
			
			//add product to category::
			//wp_set_post_terms($post_id, array($_POST['category'][count($_POST['category']) - 1]), "product_cat");
			$set_categories = wp_set_post_terms($post_id, $_POST['category'], "product_cat");
			
			
			
			
			
			//end of daniel's code
			
			
			
			
			//wp_set_post_terms(1814, array(0=>7236, 1=>7237), "product_cat");
			//var_dump($post_id);var_dump($_POST['category']);var_dump($set_categories);die();
			//end daniel's code to add attributes

            //upload attachment to the post
            wpuf_upload_attachment( $post_id );

            //send mail notification
            if ( wpuf_get_option( 'post_notification', 'wpuf_others', 'yes' ) == 'yes' ) {
                wpuf_notify_post_mail( $userdata, $post_id );
            }

            //add the custom fields
            if ( $custom_fields ) {
                foreach ($custom_fields as $key => $val) {
                    add_post_meta( $post_id, $key, $val, true );
                }
            }

            //set post thumbnail if has any
            if ( $attach_id ) {
                set_post_thumbnail( $post_id, $attach_id );
            }

            //Set Post expiration date if has any
            if ( !empty( $_POST['expiration-date'] ) && $post_expiry == 'on' ) {
                $post = get_post( $post_id );
                $post_date = strtotime( $post->post_date );
                $expiration = (int) $_POST['expiration-date'];
                $expiration = $post_date + ($expiration * 60 * 60 * 24);

                add_post_meta( $post_id, 'expiration-date', $expiration, true );
            }
			//die('please remove me dan');
            //plugin API to extend the functionality
            do_action( 'wpuf_add_post_after_insert', $post_id );
//var_dump($attributes);var_dump($new_post_custom_fields);die();
            //echo '<div class="success">' . __('Post published successfully', 'wpuf') . '</div>';
            if ( $post_id ) {
                //$redirect = apply_filters( 'wpuf_after_post_redirect', get_permalink( $post_id ), $post_id );
                //wp_redirect( $redirect );
				
				/**
				 * daniel: change redirect on post submit to user dashboard
				 */
				$redirect = get_site_url() . '/my-account/dashboard/';
				wp_redirect( $redirect );
				
                exit;
            }
        }
    }

}

$wpuf_postform = new WPUF_Add_Post();