<?php
global $post;
/* Add in any custom meta fields */
foreach (DD_UsefulLinks::$custom_meta_fields as $field => $label) {
	$fieldname	 = DD_UsefulLinks::$cpt . "_" . $field;
	$value		 = get_post_meta($post->ID, $fieldname, true);
	if ($field == "link")
		$value		 = esc_url($value);
	?>
	<p class="description"><?php echo $label; ?>:</p>
	<input type="text" id="<?php echo $fieldname ?>" name="<?php echo $fieldname; ?>" value="<?php echo htmlq($value); ?>" style="width:100%"/>
	<?php
}