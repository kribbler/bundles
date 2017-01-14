<?php

/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Additional Information */
/*-----------------------------------------------------------------------------------*/

function testimonial_metabox() {
	
	global $post;
	
	$client = get_post_meta( $post->ID, 'client', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="testimonial_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
    	
		<tr>
			<td>
				<input id="client" class="regular-text" type="text" name="client" value="<?php echo $client; ?>" />
				<p>
					<?php _e( "The name of client.", 'concept7' ); ?>
				</p>
			</td>
		</tr>
	</table>

<?php
}


/*
 * Process the custom metabox fields
 */
function save_testimonial_meta_box_values( $post_id ) {
	global $post;
	
	// Verify nonce
	if(!isset($_POST['testimonial_meta_box_nonce'])) return;
    if ( !wp_verify_nonce( $_POST['testimonial_meta_box_nonce'], basename(__FILE__) ) ) {
        return $post_id;
    }
	
	// Skip auto save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	
	//Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        }
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
	
	//check for testimonial post type only
    if( $post->post_type == "testimonial" ) {
        if ( isset( $_POST['client']) ) { update_post_meta( $post->ID, 'client', stripslashes( htmlspecialchars( $_POST['client'] ) ) ); }
	}
}

// Add action
add_action( 'admin_init', 'add_testimonial_meta_boxes' );
add_action( 'save_post', 'save_testimonial_meta_box_values' );


/*
 * Add meta box
 */
function add_testimonial_meta_boxes() {
	add_meta_box( 'testimonial-info-metabox', __( "Client name", 'concept7' ), 'testimonial_metabox', 'testimonial', 'normal', 'low' );
}

?>