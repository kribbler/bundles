<?php
/* Define the custom box */

add_action( 'add_meta_boxes', 'add_sidebar_metabox' );
add_action( 'save_post', 'save_sidebar_postdata' );

/* Adds a box to the side column on the Post and Page edit screens */
function add_sidebar_metabox()
{
	add_meta_box(
		'custom_sidebar',
		__( 'Sidebar', 'concept7' ),
		'custom_sidebar_callback',
		'page',
		'side'
	);
}

/* Prints the box content */
function custom_sidebar_callback( $post )
{
	global $wp_registered_sidebars;

	$custom = get_post_custom($post->ID);

	if(isset($custom['custom_sidebar']))
		$val = $custom['custom_sidebar'][0];
	else
		$val = "default";

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' );

	// The actual fields for data entry
	$output = '<p><label for="myplugin_new_field">'.__("Choose a sidebar to display", 'concept7' ).'</label></p>';
	$output .= "<select name='custom_sidebar' id='custom_sidebar'>";

	// Add a default option
	$output .= "<option";
	if($val == "default")
		$output .= " selected='selected'";
	$output .= " value='default'>".__('default', 'concept7')."</option>";

	// Fill the select element with all registered sidebars
	foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
	{
		$output .= "<option";
		if($sidebar['name'] == $val)
			$output .= " selected='selected'";
		$output .= " value='".$sidebar['name']."'>".$sidebar['name']."</option>";
	}

	$output .= "</select>";

	echo $output;
}


/* When the post is saved, saves our custom data */
function save_sidebar_postdata( $post_id )
{
	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	  return;

	// verify this came from our screen and with proper authorization,
	// because save_post can be triggered at other times
	if(!isset($_POST['custom_sidebar_nonce'])) return;
	if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename( __FILE__ ) ) )
	  return;

	if ( !current_user_can( 'edit_page', $post_id ) )
		return;

	$concept7_data = $_POST['custom_sidebar'];

	update_post_meta($post_id, "custom_sidebar", $concept7_data);
}

?>