<?php

// Contact Info Widget

class concept7_contact_info extends WP_Widget {
	
	function concept7_contact_info() {
		
		// define widget title and description
		$widget_ops = array('classname' => 'contact_info',
							'description' => __( 'Displaying your contact information','concept7') );
		// register the widget
		$this->WP_Widget('concept7_contact_info', __('Concept7 - Contact Info','concept7'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
	  	$name = strip_tags($instance['name']);
	  	$mail = strip_tags($instance['mail']);
		$phone = strip_tags($instance['phone']);
		$address = strip_tags($instance['address']);
		$xtra_info = strip_tags($instance['xtra_info']);
		
		echo $before_widget;
             if ( $title )
                 echo $before_title . $title . $after_title; 
				 ?>		
				<div id="contact-info">
                    <ul class="contact-info">
                        <?php 
						if($name) echo do_shortcode('[contact_name]'.$name.'[/contact_name]'); 
						if($mail) echo do_shortcode('[contact_email]'.$mail.'[/contact_email]');
						if($phone) echo do_shortcode('[contact_phone]'.$phone.'[/contact_phone]');
						if($address) echo do_shortcode('[contact_address]'.$address.'[/contact_address]');
						if($xtra_info) echo do_shortcode('[contact_speech]'.$xtra_info.'[/contact_speech]');
						?>
                    </ul>
                </div>
			<?php
			
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['mail'] = strip_tags($new_instance['mail']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['xtra_info'] = strip_tags($new_instance['xtra_info']);

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'title' => 'Contact Info', 'name' => '', 'mail'=> '', 'phone' => '', 'address' => '', 'xtra_info' => '' ) );
	$name = strip_tags($instance['name']);
	$mail = strip_tags($instance['mail']);
	$phone = strip_tags($instance['phone']);
	$address = strip_tags($instance['address']);
	$xtra_info = strip_tags($instance['xtra_info']);
	$title = strip_tags($instance['title']);
	
	
	
	// print the form fields
	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>">
	<?php _e('Title:','concept7'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo
		esc_attr($title); ?>" /></p>
	
	<p><label for="<?php echo $this->get_field_id('name'); ?>">
	<?php _e('Name:','concept7'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo
		esc_attr($name); ?>" /></p>
        
   	<p><label for="<?php echo $this->get_field_id('mail'); ?>">
	<?php _e('Mail:','concept7'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" type="text" value="<?php echo
		esc_attr($mail); ?>" /></p>
        
  	<p><label for="<?php echo $this->get_field_id('phone'); ?>">
	<?php _e('Phone:','concept7'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo
		esc_attr($phone); ?>" /></p>
        
   	<p><label for="<?php echo $this->get_field_id('address'); ?>">
	<?php _e('Address:','concept7'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo
		esc_attr($address); ?>" /></p>
   
   	<p><label for="<?php echo $this->get_field_id('xtra_info'); ?>">
	<?php _e('Extra Info:','concept7'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('xtra_info'); ?>" name="<?php echo $this->get_field_name('xtra_info'); ?>"><?php echo
		esc_attr($xtra_info); ?></textarea></p>

	<?php
	}
}
// register Flickr widget
add_action('widgets_init', create_function('', 'return register_widget("concept7_contact_info");'));	
?>