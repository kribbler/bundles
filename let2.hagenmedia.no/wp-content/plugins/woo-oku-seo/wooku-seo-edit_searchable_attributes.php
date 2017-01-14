<?php include_styles();?>
<div id="icon-tools" class="icon32"><br /></div>
<h2><?php _e( 'WoOKU Seo', 'wooku-seo' ); ?></h2>
<h3>Edit searchable atttributes</h3>
<?php include 'wooku-seo-menu.php'?>

<?php $attributes = wp_get_attributes(); //pr($attributes)?>

<form enctype="multipart/form-data" method="post" action="<?php echo get_admin_url().'tools.php?page=wooku-seo&action=set_attributes_searchable'; ?>">
<table class="form-table1 table_short">
<?php foreach ($attributes as $attribute):?>
<tr>
	<th class="align_right"><label for="attributes_<?php echo $attribute->attribute_id?>"><?php echo $attribute->attribute_name;?></label></th>
	<td>
		<input type="checkbox" name="attributes_<?php echo $attribute->attribute_id?>" <?php echo ($attribute->attribute_searchable) ? "checked" : "";?>>
	</td>
</tr>
<?php endforeach;?>
<tr>
	<th></th>
	<td>
		<button class="button-primary" type="submit"><?php _e( 'Save', 'wooku-seo' ); ?></button>
	</td>
</tr>
</table>
</form>
