<?php

/*-----------------------------------------------------------------------------------*/
/* Post Custom Metabox For Slider */
/*-----------------------------------------------------------------------------------*/

function slider_settings_post_metabox() {
	
	global $post;
	
	$img1 = get_post_meta( $post->ID, 'post-image-1', true );
	$img2 = get_post_meta( $post->ID, 'post-image-2', true );
	$img3 = get_post_meta( $post->ID, 'post-image-3', true );
	$img4 = get_post_meta( $post->ID, 'post-image-4', true );
	$img5 = get_post_meta( $post->ID, 'post-image-5', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="post_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="post-image-1"><?php _e( "Image 1:", 'concept7' ); ?></label></th>
			<td>
				<input id="post-image-1" class="upload_field regular-text" type="text" name="post-image-1" value="<?php echo $img1; ?>" />
				<input id="post-image-1-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
			</td>
		</tr>
		
		<tr>
			<th><label for="post-image-2"><?php _e( "Image 2:", 'concept7' ); ?></label></th>
			<td>
				<input id="post-image-2" class="upload_field regular-text" type="text" name="post-image-2" value="<?php echo $img2; ?>" />
				<input id="post-image-2-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
			</td>
		</tr>
		
		<tr>
			<th><label for="post-image-3"><?php _e( "Image 3:", 'concept7' ); ?></label></th>
			<td>
				<input id="post-image-3" class="upload_field regular-text" type="text" name="post-image-3" value="<?php echo $img3; ?>" />
				<input id="post-image-3-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
			</td>
		</tr>
		
		<tr>
			<th><label for="post-image-4"><?php _e( "Image 4:", 'concept7' ); ?></label></th>
			<td>
				<input id="post-image-4" class="upload_field regular-text" type="text" name="post-image-4" value="<?php echo $img4; ?>" />
				<input id="post-image-4-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
			</td>
		</tr>
		
		<tr>
			<th><label for="post-image-5"><?php _e( "Image 5:", 'concept7' ); ?></label></th>
			<td>
				<input id="post-image-5" class="upload_field regular-text" type="text" name="post-image-5" value="<?php echo $img5; ?>" />
				<input id="post-image-5-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
			</td>
		</tr>
	</table>
	
<?php
}


/*-----------------------------------------------------------------------------------*/
/* Post Custom Metabox For Videos */
/*-----------------------------------------------------------------------------------*/

function video_post_metabox() {
	
	global $post;
	
	$video_embed_code = get_post_meta( $post->ID, 'post-video-embed', true );	
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="post_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="post-video-embed"><?php _e("Video Embed Code:", 'concept7'); ?></label></th>
			<td><textarea id="post-video-embed" cols="60" rows="3" name="post-video-embed"><?php echo $video_embed_code; ?></textarea>
				<br />
				
				<p>
				<?php _e( 'Add your video embed code (such as: youtube & vimeo). Resolution should be 620x348 pixels.', 'concept7' ); ?>
				</p>
			</td>
		</tr>
	</table>
	
<?php
}


/*-----------------------------------------------------------------------------------*/
/* Post Custom Metabox For Heading */
/*-----------------------------------------------------------------------------------*/

function heading_post_metabox() {
	
	global $post;
	
	$post_heading = get_post_meta( $post->ID, 'post-heading', true );	
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="post_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="post-heading"><?php _e("Post heading: (Displaying below post title)", 'concept7'); ?></label></th>
			<td><textarea id="post-heading" cols="60" rows="3" name="post-heading"><?php echo $post_heading; ?></textarea>
				<br />
			</td>
		</tr>
	</table>
	
<?php
}


/*-----------------------------------------------------------------------------------*/
/* Post Custom Metabox For Additional Information */
/*-----------------------------------------------------------------------------------*/

function optional_post_metabox() {
	
	global $post;
	
	$post_link = get_post_meta( $post->ID, 'post_link', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="post_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
    	
		<tr>
			<th><label for="post_link"><?php _e( "Post link:", 'concept7' ); ?></label></th>
			<td>
				<input id="post_link" class="regular-text" type="text" name="post_link" value="<?php echo $post_link; ?>" />
				<br />
				<p>
					<?php _e( "The target URL of you post.", 'concept7' ); ?>
				</p>
			</td>
		</tr>
		
	</table>
	
<?php
}



/*
 * Process the custom metabox fields
 */
function save_post_meta_box_values( $post_id ) {
	global $post;
	
	// Verify nonce
	if(!isset($_POST['post_meta_box_nonce'])) return;
    if ( !wp_verify_nonce( $_POST['post_meta_box_nonce'], basename(__FILE__) ) ) {
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
	
	//check for post post type only
    if( $post->post_type == "post" ) {
        if ( isset( $_POST['post-image-1']) ) { update_post_meta( $post->ID, 'post-image-1', stripslashes( htmlspecialchars( esc_url( $_POST['post-image-1'] ) ) ) ); }
        if ( isset( $_POST['post-image-2']) ) { update_post_meta( $post->ID, 'post-image-2', stripslashes( htmlspecialchars( esc_url( $_POST['post-image-2'] ) ) ) ); }
		if ( isset( $_POST['post-image-3']) ) { update_post_meta( $post->ID, 'post-image-3', stripslashes( htmlspecialchars( esc_url( $_POST['post-image-3'] ) ) ) ); }
        if ( isset( $_POST['post-image-4']) ) { update_post_meta( $post->ID, 'post-image-4', stripslashes( htmlspecialchars( esc_url( $_POST['post-image-4'] ) ) ) ); }
        if ( isset( $_POST['post-image-5']) ) { update_post_meta( $post->ID, 'post-image-5', stripslashes( htmlspecialchars( esc_url( $_POST['post-image-5'] ) ) ) ); }
        if ( isset( $_POST['post_link']) ) { update_post_meta( $post->ID, 'post_link', stripslashes( htmlspecialchars( $_POST['post_link'] ) ) ); }
		if ( isset( $_POST['post-video-embed']) ) { update_post_meta( $post->ID, 'post-video-embed', stripslashes( htmlspecialchars( $_POST['post-video-embed'] ) ) );}
		if ( isset( $_POST['post-heading']) ) { update_post_meta( $post->ID, 'post-heading', stripslashes( htmlspecialchars( $_POST['post-heading'] ) ) );}
    }	
}

// Add action
add_action( 'admin_init', 'add_post_meta_boxes' );
add_action( 'save_post', 'save_post_meta_box_values' );


/*
 * Add meta box
 */
function add_post_meta_boxes() {
	add_meta_box( 'post-heading-metabox', __( "Post heading", 'concept7' ), 'heading_post_metabox', 'post', 'normal', 'high' );
	add_meta_box( 'post-additional-info-metabox', __( "Post format: Link (only use with post format link)", 'concept7' ), 'optional_post_metabox', 'post', 'normal', 'high' );
	add_meta_box( 'post-video-settings-metabox', __( "Video Settings", 'concept7' ), 'video_post_metabox', 'post', 'normal', 'high' );
	add_meta_box( 'post-img-settings-metabox', __( "Post format: Gallery (only use with post format gallery)", 'concept7' ), 'slider_settings_post_metabox', 'post', 'normal', 'high' );
}

?>