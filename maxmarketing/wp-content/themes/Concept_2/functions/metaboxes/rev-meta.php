<?php
/* Define the custom box */

add_action( 'add_meta_boxes', 'add_rev_metabox' );
add_action( 'save_post', 'save_rev_postdata' );

/* Adds a box to the side column on the Post and Page edit screens */
function add_rev_metabox()
{
	add_meta_box(
		'custom_rev',
		__( 'Revolution Slider', 'concept7' ),
		'custom_rev_callback',
		'page',
		'normal'
	);
}

/* Prints the box content */
function custom_rev_callback( $post )
{
	$custom = get_post_custom($post->ID);

	if(isset($custom['custom_rev']))
		$val = $custom['custom_rev'][0];
	else
		$val = "none";

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'custom_rev_nonce' );

	// The actual fields for data entry
	$output = '<p><label for="myplugin_new_field">'.__("Choose a revolution slider to display", 'concept7' ).'</label></p>';
	$output .= "<select name='custom_rev' id='custom_rev'>";

	// Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "revslider_sliders";
 
    // Get sliders
    $sliders = $wpdb->get_results( "SELECT * FROM $table_name LIMIT 100" );
 
    // Iterate over the sliders
    foreach($sliders as $key) {
 
        $output .= "<option";
		if(($key->alias )== $val)
			$output .= " selected='selected'";
		$output .= " value='".$key->alias."'>".$key->title."</option>";
    }
	
	$output .= "</select>";

	echo $output;
}


/* When the post is saved, saves our custom data */
function save_rev_postdata( $post_id )
{
	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	  return;

	// verify this came from our screen and with proper authorization,
	// because save_post can be triggered at other times
	if(!isset($_POST['custom_rev_nonce'])) return;
	if ( !wp_verify_nonce( $_POST['custom_rev_nonce'], plugin_basename( __FILE__ ) ) )
	  return;

	if ( !current_user_can( 'edit_page', $post_id ) )
		return;

	$concept7_data = $_POST['custom_rev'];

	update_post_meta($post_id, "custom_rev", $concept7_data);
}

?>