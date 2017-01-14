<?php

function settings_clients_metabox() {
	
	global $post;
	
	$client_url = get_post_meta( $post->ID, 'client-url', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="clients_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="client-url"><?php _e( "Client URL:", 'concept7' ); ?></label></th>
			<td>
				<input id="client-url" class="regular-text" type="text" name="client-url" value="<?php echo $client_url; ?>" />
			</td>
		</tr>
	</table>
	
<?php
}

/*
 * Process the custom metabox fields
 */
function save_clients_meta_box_values( $post_id ) {
	global $post;
	
	// Verify nonce
	if(!isset($_POST['clients_meta_box_nonce'])) return;
    if ( !wp_verify_nonce( $_POST['clients_meta_box_nonce'], basename(__FILE__) ) ) {
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
	
	//check for portfolio post type only
    if( $post->post_type == "clients" ) {
        if ( isset( $_POST['client-url']) ) { update_post_meta( $post->ID, 'client-url', stripslashes( htmlspecialchars( esc_url( $_POST['client-url'] ) ) ) ); }
    }	
}

// Add action
add_action( 'admin_init', 'add_clients_meta_boxes' );
add_action( 'save_post', 'save_clients_meta_box_values' );


/*
 * Add meta box
 */
function add_clients_meta_boxes() {
	add_meta_box( 'client-url-settings-metabox', __( "Clients Settings", 'concept7' ), 'settings_clients_metabox', 'clients', 'normal', 'high' );
}

?>