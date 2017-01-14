<?php
/* Define the custom box */

add_action( 'add_meta_boxes', 'add_ls_metabox' );
add_action( 'save_post', 'save_ls_postdata' );

/* Adds a box to the side column on the Post and Page edit screens */
function add_ls_metabox()
{
	add_meta_box(
		'custom_ls',
		__( 'Layer Slider', 'concept7' ),
		'custom_ls_callback',
		'page',
		'normal'
	);
}

/* Prints the box content */
function custom_ls_callback( $post )
{
	$custom = get_post_custom($post->ID);

	if(isset($custom['custom_ls']))
		$val = $custom['custom_ls'][0];
	else
		$val = "none";

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'custom_ls_nonce' );

	// The actual fields for data entry
	$output = '<p><label for="myplugin_new_field">'.__("Choose a Layer Slider to display", 'concept7' ).'</label></p>';
	$output .= "<select name='custom_ls' id='custom_ls'>";

	global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "layerslider";
 
    // Get sliders
    $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" );
 
    // Iterate over the sliders
    foreach($sliders as $key => $item) {
 
        $output .= "<option";
		if(($item->id )== $val)
			$output .= " selected='selected'";
		$output .= " value='".$item->id."'>".$item->name."</option>";
    }
	
	$output .= "</select>";

	echo $output;
}


/* When the post is saved, saves our custom data */
function save_ls_postdata( $post_id )
{
	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	  return;

	// verify this came from our screen and with proper authorization,
	// because save_post can be triggered at other times
	if(!isset($_POST['custom_ls_nonce'])) return;
	if ( !wp_verify_nonce( $_POST['custom_ls_nonce'], plugin_basename( __FILE__ ) ) )
	  return;

	if ( !current_user_can( 'edit_page', $post_id ) )
		return;

	$concept7_data = $_POST['custom_ls'];

	update_post_meta($post_id, "custom_ls", $concept7_data);
}

?>