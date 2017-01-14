<?php
global $post;
/* Add in any custom meta fields */
foreach (DD_PeopleManager::$custom_meta_fields as $key=>$label) {
	$fieldname	 = DD_PeopleManager::$cpt . "_" . $key;
	$value		 = get_post_meta($post->ID, $fieldname, true);
	?>
	<p class="description"><?php echo $label; ?>:</p>
	<input type="text" id="<?php echo $fieldname ?>" name="<?php echo $fieldname; ?>" value="<?php echo htmlq($value); ?>" style="width:100%"/>
	<?php
}