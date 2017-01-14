<?php


/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Page */
/*-----------------------------------------------------------------------------------*/

function port_cat_settings_portfolio_metabox() {
	
	global $post;
	$hide_filter = get_post_meta( $post->ID, 'hide_filter', true );
	$port_cat = get_post_meta( $post->ID, 'port_cat', true );
	$number_port_cat = (isset($port_cat['number_port_cat']) && $port_cat['number_port_cat'])?$port_cat['number_port_cat']:'';
	if(isset($port_cat['only']) && is_array($port_cat['only']) ) $only = $port_cat['only']; else $only = array();
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr><td>
        	<?php $cats = get_terms('portfolio_cats');
			foreach ($cats as $cat ) :
			echo '
				<input name="port_cat[only][]" value="' . $cat->term_id . '" type="checkbox"' . (in_array($cat->term_id, $only)?' checked':'') . '>
				<label for="port_cat">'.$cat->name.'</label>
			<br />';
			endforeach; ?>
			<input id="hide_filter" name="hide_filter" type="checkbox" <?php if( $hide_filter == 'true' ) { ?>checked="checked"<?php } ?> />
            <label for="hide_filter"><?php _e( " Hide filter section", 'concept7' ); ?></label>
		</td></tr>
		
	</table>
	
<?php
}


/*-----------------------------------------------------------------------------------*/
/* Icon metabox for pages */
/*-----------------------------------------------------------------------------------*/

function icon_metabox() {
	
	global $post;
	
	$icon = get_post_meta( $post->ID, 'icon', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="icon"><?php _e( "Icon:", 'concept7' ); ?></label></th>
			<td>
				<input id="icon" size="20" type="text" name="icon" value="<?php echo $icon; ?>" />
				<br />
				<p>
					<?php _e( 'Ex: <i><b>icon-signal</b></i>. More info is <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">here</a>', 'concept7' ); ?>
				</p>
			</td>
		</tr>
	</table>
	
<?php
}



/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Slider */
/*-----------------------------------------------------------------------------------*/

function slider_settings_portfolio_metabox() {
	
	global $post;
	
	$img1 = get_post_meta( $post->ID, 'portfolio-image-1', true );
	$img2 = get_post_meta( $post->ID, 'portfolio-image-2', true );
	$img3 = get_post_meta( $post->ID, 'portfolio-image-3', true );
	$img4 = get_post_meta( $post->ID, 'portfolio-image-4', true );
	$img5 = get_post_meta( $post->ID, 'portfolio-image-5', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="portfolio-image-1"><?php _e( "Image 1:", 'concept7' ); ?></label></th>
			<td>
				<input id="portfolio-image-1" class="upload_field regular-text" type="text" name="portfolio-image-1" value="<?php echo $img1; ?>" />
				<input id="portfolio-image-1-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 580x420 pixels.', 'concept7' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-2"><?php _e( "Image 2:", 'concept7' ); ?></label></th>
			<td>
				<input id="portfolio-image-2" class="upload_field regular-text" type="text" name="portfolio-image-2" value="<?php echo $img2; ?>" />
				<input id="portfolio-image-2-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 580x420 pixels.', 'concept7' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-3"><?php _e( "Image 3:", 'concept7' ); ?></label></th>
			<td>
				<input id="portfolio-image-3" class="upload_field regular-text" type="text" name="portfolio-image-3" value="<?php echo $img3; ?>" />
				<input id="portfolio-image-3-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 580x420 pixels.', 'concept7' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-4"><?php _e( "Image 4:", 'concept7' ); ?></label></th>
			<td>
				<input id="portfolio-image-4" class="upload_field regular-text" type="text" name="portfolio-image-4" value="<?php echo $img4; ?>" />
				<input id="portfolio-image-4-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 580x420 pixels.', 'concept7' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-5"><?php _e( "Image 5:", 'concept7' ); ?></label></th>
			<td>
				<input id="portfolio-image-5" class="upload_field regular-text" type="text" name="portfolio-image-5" value="<?php echo $img5; ?>" />
				<input id="portfolio-image-5-uploader" class="upload_image_button button" type="button" value="<?php _e( 'Browse', 'concept7' ); ?>" />
				<br />
				<p>
					<?php _e( 'This image will be resized to 580x420 pixels.', 'concept7' ); ?>
				</p>
			</td>
		</tr>
	</table>
	
<?php
}



/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Videos */
/*-----------------------------------------------------------------------------------*/

function video_portfolio_metabox() {
	
	global $post;
	
	$video_embed_code = get_post_meta( $post->ID, 'portfolio-video-embed', true );	
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="portfolio-video-embed"><?php _e("Video Embed Code:", 'concept7'); ?></label></th>
			<td><textarea id="portfolio-video-embed" cols="60" rows="3" name="portfolio-video-embed"><?php echo $video_embed_code; ?></textarea>
				<br />
				
				<p>
				<?php _e( 'Add your video embed code (such as: youtube & vimeo). Resolution should be 580x420 pixels.', 'concept7' ); ?>
				</p>
			</td>
		</tr>
	</table>
	
<?php
}



/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Additional Information */
/*-----------------------------------------------------------------------------------*/

function optional_portfolio_metabox() {
	
	global $post;
	
	$client = get_post_meta( $post->ID, 'copyright', true );
	$project_url = get_post_meta( $post->ID, 'project-url', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
    	
		<tr>
			<th><label for="copyright"><?php _e( "Copyright:", 'concept7' ); ?></label></th>
			<td>
				<input id="copyright" class="regular-text" type="text" name="copyright" value="<?php echo $client; ?>" />
				<br />
				<p>
					<?php _e( "The name of the owner for this portfolio item.", 'concept7' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="project-url"><?php _e( "Project URL:", 'concept7' ); ?></label></th>
			<td>
				<input id="project-url" class="regular-text" type="text" name="project-url" value="<?php echo $project_url; ?>" />
				<br />
				<p>
					<?php _e( 'The link/URL of this portfolio item.', 'concept7' ); ?>
				</p>
			</td>
		</tr>
		
	</table>

<?php
}



/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Featured Project */
/*-----------------------------------------------------------------------------------*/

function featured_portfolio_metabox() {
	
	global $post;
	
	$featured = get_post_meta( $post->ID, 'portfolio-featured', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
    	
		<tr>
			<td>
			<input id="portfolio-featured" name="portfolio-featured" type="checkbox" <?php if( $featured == 'true' ) { ?>checked="checked"<?php } ?> />
            <label for="portfolio-featured"><?php _e( " Featured Project", 'concept7' ); ?></label>
			</td>
		</tr>
		
	</table>

	
<?php
}



/*-----------------------------------------------------------------------------------*/
/* Custom Metabox For Portfolio type */
/*-----------------------------------------------------------------------------------*/

function port_metabox() {
	
	global $post;
	
	$port = get_post_meta( $post->ID, 'port', true );
	if(isset($port['only']) && is_array($port['only']) ) $only = $port['only']; else $only = array();
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<td>
				<input id="port-slider" name="port[only][]" value="slider" type="radio" <?php if(in_array('slider', $only)){ echo 'checked';}else echo ''; ?> />
            	<label for="port-slider"><?php _e( " Portfolio Slider", 'concept7' ); ?></label>
			<br />
				<input id="port-youtube" name="port[only][]" value="youtube" type="radio" <?php if(in_array('youtube', $only)){ echo 'checked';}else echo ''; ?> />
            	<label for="port-youtube"><?php _e( " Portfolio Video Youtube", 'concept7' ); ?></label>
            <br />
				<input id="port-vimeo" name="port[only][]" value="vimeo" type="radio" <?php if(in_array('vimeo', $only)){ echo 'checked';}else echo ''; ?> />
            	<label for="port-vimeo"><?php _e( " Portfolio Video Vimeo", 'concept7' ); ?></label>
            <br />
            	<input id="port-none" name="port[only][]" value="none" type="radio" <?php if(in_array('none', $only)){ echo 'checked';}else echo ''; ?> />
            	<label for="port-none"><?php _e( " Your Custom Build", 'concept7' ); ?></label>

			</td>
		</tr>
	</table>
	
<?php
}




/*
 * Process the custom metabox fields
 */
function save_portfolio_meta_box_values( $post_id ) {
	global $post;
	
	// Verify nonce
	if(!isset($_POST['portfolio_meta_box_nonce'])) return;
	
    if ( !wp_verify_nonce( $_POST['portfolio_meta_box_nonce'], basename(__FILE__) ) ) {
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
    if( $post->post_type == "portfolio" || $post->post_type == "page" ) {
		if ( isset( $_POST['icon']) ) { update_post_meta( $post->ID, 'icon', stripslashes(  $_POST['icon']  ) ); }
        if ( isset( $_POST['portfolio-image-1']) ) { update_post_meta( $post->ID, 'portfolio-image-1', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-1'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-2']) ) { update_post_meta( $post->ID, 'portfolio-image-2', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-2'] ) ) ) ); }
		if ( isset( $_POST['portfolio-image-3']) ) { update_post_meta( $post->ID, 'portfolio-image-3', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-3'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-4']) ) { update_post_meta( $post->ID, 'portfolio-image-4', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-4'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-5']) ) { update_post_meta( $post->ID, 'portfolio-image-5', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-5'] ) ) ) ); }
		if ( isset( $_POST['portfolio-video-embed']) ) { update_post_meta( $post->ID, 'portfolio-video-embed', stripslashes( htmlspecialchars( $_POST['portfolio-video-embed'] ) ) ); }
        if ( isset( $_POST['copyright']) ) { update_post_meta( $post->ID, 'copyright', stripslashes( htmlspecialchars( $_POST['copyright'] ) ) ); }
		if ( isset( $_POST['project-url']) ) { update_post_meta( $post->ID, 'project-url', stripslashes( htmlspecialchars( esc_url( $_POST['project-url'] ) ) ) ); }
    }	
		
		$chk_featured = isset( $_POST['portfolio-featured'] ) && $_POST['portfolio-featured'] ? 'true' : 'false';  
    	update_post_meta( $post_id, 'portfolio-featured', $chk_featured );
		
		$chk_filter = isset( $_POST['hide_filter'] ) && $_POST['hide_filter'] ? 'true' : 'false';  
    	update_post_meta( $post_id, 'hide_filter', $chk_filter );
		
		$chk = isset( $_POST['custom_single'] ) && $_POST['custom_single'] ? 'true' : 'false';  
    	update_post_meta( $post_id, 'custom_single', $chk );
		
		$concept7_data_port = null;
			if( isset($_POST['port']['only']) ) {
				$concept7_data_port['only'] = $_POST['port']['only'];
			}
					
			update_post_meta( $post_id, 'port', $concept7_data_port );
		
		
		$mydatacat = null;
		if( isset($_POST['port_cat']['only']) ) {
			$mydatacat['only'] = $_POST['port_cat']['only'];
		}
		$mydatacat['number_port_cat'] = intval($_POST['number_port_cat']);
				
		update_post_meta( $post_id, 'port_cat', $mydatacat );
}


// Add action
add_action( 'admin_init', 'add_portfolio_meta_boxes' );
add_action( 'save_post', 'save_portfolio_meta_box_values' );


/*
 * Add meta box
 */
function add_portfolio_meta_boxes() {
	add_meta_box( 'icon-settings-metabox', __( "Icon for page", 'concept7' ), 'icon_metabox', 'page', 'side', 'high' );
	add_meta_box( 'portfolio-img-settings-metabox', __( "Slider Settings", 'concept7' ), 'slider_settings_portfolio_metabox', 'portfolio', 'normal', 'high' );
	add_meta_box( 'portfolio-video-settings-metabox', __( "Video Settings", 'concept7' ), 'video_portfolio_metabox', 'portfolio', 'normal', 'high' );
	add_meta_box( 'portfolio-additional-info-metabox', __( "Additional Information", 'concept7' ), 'optional_portfolio_metabox', 'portfolio', 'normal', 'high' );
	add_meta_box( 'portfolio-featured-metabox', __( "Featured", 'concept7' ), 'featured_portfolio_metabox', 'portfolio', 'side', 'low' );
	add_meta_box( 'portfolio-cat-metabox', __( "Portfolio Options", 'concept7' ), 'port_cat_settings_portfolio_metabox', 'page', 'side', 'high' );
	add_meta_box( 'portfolio-custom-metabox', __( "Portfolio Options", 'concept7' ), 'port_metabox', 'portfolio', 'side', 'high' );
}

?>