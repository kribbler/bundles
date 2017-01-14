<?php


/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Videos */
/*-----------------------------------------------------------------------------------*/

function title_slideshow_metabox() {
	
	global $post;
	
	$title = get_post_meta( $post->ID, 'slideshow-title', true );	
	$subtitle = get_post_meta( $post->ID, 'slideshow-subtitle', true );	
	$link_to = get_post_meta( $post->ID, 'link_to', true );	
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="slideshow_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="slideshow-title"><?php _e("Title:", 'concept7'); ?></label></th>
			<td><textarea id="slideshow-title" cols="60" rows="3" name="slideshow-title"><?php echo $title; ?></textarea>
			</td>
		</tr>
        <tr>
			<th><label for="slideshow-subtitle"><?php _e("Subtitle:", 'concept7'); ?></label></th>
			<td><textarea id="slideshow-subtitle" cols="60" rows="3" name="slideshow-subtitle"><?php echo $subtitle; ?></textarea>
			</td>
		</tr>
        <tr>
			<th><label for="link_to"><?php _e("Link to:", 'concept7'); ?></label></th>
			<td><textarea id="link_to" cols="60" rows="3" name="link_to"><?php echo $link_to; ?></textarea>
			</td>
		</tr>
	</table>
	
<?php
}



function slider_settings_slideshow_metabox() {
	
	global $post;
	
	$img1 = get_post_meta( $post->ID, 'slideshow-image-1', true );
	$img2 = get_post_meta( $post->ID, 'slideshow-image-2', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="slideshow_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="slideshow-image-1"><?php _e( "Image 1:", 'concept7' ); ?></label></th>
			<td>
				<input id="slideshow-image-1" class="upload_field regular-text" type="text" name="slideshow-image-1" value="<?php echo $img1; ?>" />
				<input id="slideshow-image-1-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
			</td>
		</tr>
		
		<tr>
			<th><label for="slideshow-image-2"><?php _e( "Image 2:", 'concept7' ); ?></label></th>
			<td>
				<input id="slideshow-image-2" class="upload_field regular-text" type="text" name="slideshow-image-2" value="<?php echo $img2; ?>" />
				<input id="slideshow-image-2-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
			</td>
		</tr>
	</table>
	
<?php
}



/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Videos */
/*-----------------------------------------------------------------------------------*/

function video_slideshow_metabox() {
	
	global $post;
	
	$video_embed_code = get_post_meta( $post->ID, 'slideshow-video-embed', true );	
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="slideshow_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="slideshow-video-embed"><?php _e("Video Embed Code:", 'concept7'); ?></label></th>
			<td><textarea id="slideshow-video-embed" cols="60" rows="3" name="slideshow-video-embed"><?php echo $video_embed_code; ?></textarea>
			</td>
		</tr>
	</table>
	
<?php
}


/*
 * Process the custom metabox fields
 */
function save_slideshow_meta_box_values( $post_id ) {
	global $post;
	
	// Verify nonce
	if(!isset($_POST['slideshow_meta_box_nonce'])) return;
    if ( !wp_verify_nonce( $_POST['slideshow_meta_box_nonce'], basename(__FILE__) ) ) {
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
	
	//check for slideshow post type only
    if( $post->post_type == "slideshow" ) {
        if ( isset( $_POST['slideshow-image-1']) ) { update_post_meta( $post->ID, 'slideshow-image-1', stripslashes( htmlspecialchars( esc_url( $_POST['slideshow-image-1'] ) ) ) ); }
        if ( isset( $_POST['slideshow-image-2']) ) { update_post_meta( $post->ID, 'slideshow-image-2', stripslashes( htmlspecialchars( esc_url( $_POST['slideshow-image-2'] ) ) ) ); }
		
		if ( isset( $_POST['slideshow-video-embed']) ) { update_post_meta( $post->ID, 'slideshow-video-embed', stripslashes( htmlspecialchars( $_POST['slideshow-video-embed'] ) ) ); }
		if ( isset( $_POST['slideshow-image-1']) ) { update_post_meta( $post->ID, 'slideshow-image-1', stripslashes( htmlspecialchars( esc_url( $_POST['slideshow-image-1'] ) ) ) ); }
        if ( isset( $_POST['slideshow-title']) ) { update_post_meta( $post->ID, 'slideshow-title', stripslashes( htmlspecialchars( $_POST['slideshow-title'] ) ) ); }
		if ( isset( $_POST['slideshow-subtitle']) ) { update_post_meta( $post->ID, 'slideshow-subtitle', stripslashes( htmlspecialchars( $_POST['slideshow-subtitle'] ) ) ); }
		
		if ( isset( $_POST['link_to']) ) { update_post_meta( $post->ID, 'link_to', stripslashes( htmlspecialchars( $_POST['link_to'] ) ) ); }
    }	
		
}


// Add action
add_action( 'admin_init', 'add_slideshow_meta_boxes' );
add_action( 'save_post', 'save_slideshow_meta_box_values' );


/*
 * Add meta box
 */
function add_slideshow_meta_boxes() {
	add_meta_box( 'slideshow-title-settings-metabox', __( "Title Settings", 'concept7' ), 'title_slideshow_metabox', 'slideshow', 'normal', 'high' );
	add_meta_box( 'slideshow-img-settings-metabox', __( "Slider Settings", 'concept7' ), 'slider_settings_slideshow_metabox', 'slideshow', 'normal', 'high' );
	add_meta_box( 'slideshow-video-settings-metabox', __( "Video Settings", 'concept7' ), 'video_slideshow_metabox', 'slideshow', 'normal', 'high' );
}

?>