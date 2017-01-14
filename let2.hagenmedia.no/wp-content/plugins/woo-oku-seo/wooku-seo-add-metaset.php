<?php include_styles();?>
<div id="icon-tools" class="icon32"><br /></div>
<h2><?php _e( 'WoOKU Seo', 'wooku-seo' ); ?></h2>
<h3>Add metaset</h3>
<?php include 'wooku-seo-menu.php'?>
<?php wp_get_categories();?>

<form enctype="multipart/form-data" method="post" action="<?php echo get_admin_url().'tools.php?page=wooku-seo&action=preview'; ?>">
<table class="form-table1">
	<tr>
		<th><label for="metaset_name">Meta Name</label></th>
		<td>
			<input type="text" name="metaset_name" />
		</td>
	</tr>
	<tr>
		<th><label for="metaset_metatitle">Meta Title</label></th>
		<td>
			<input type="text" name="metaset_metatitle" />
		</td>
	</tr>
	<tr>
		<th><label for="metaset_metadescription">Meta Description</label></th>
		<td>
			<input type="text" name="metaset_metadescription" />
		</td>
	</tr>
	<tr>
		<th><label for="metaset_metakeywords">Meta Keywords</label></th>
		<td>
			<input type="text" name="metaset_metakeywords" />
		</td>
	</tr>
	<tr>
		<th><label for="metaset_attributes">Categories</label></th>
		<td>
			<?php $categories = wp_get_categories(); ?>
			<?php $i=0; foreach ($categories as $category):?>
				<input style="float:left" type="checkbox" name="categories_<?php echo $category->term_id?>">
				<label class="attribute_name"><?php echo $category->name;?></label>
				<?php $i++; if ($i%4 == 0) echo "<div class='clear'></div>";?>
			<?php endforeach;?>
		</td>
	</tr>
	<tr>
		<th><label for="metaset_attributes">Attributes</label></th>
		<td>
			<?php $attributes = wp_get_attributes('full'); //pr($attributes);?>
			<?php foreach ($attributes as $attribute):?>
				<?php if ($attribute->Attribute_values){?>
					<div class='attribute_values'>
						<h3><?php echo $attribute->attribute_name;?></h3>
						<?php $i=0;
						foreach ($attribute->Attribute_values as $a_value){ if ($a_value->name){?>
							<input style="float:left; margin-top:0.3em" type="checkbox" name="attribute-values_<?php echo $a_value->woocommerce_term_id?>">
							<label class="attribute_name"><?php echo $a_value->name;?></label>
							<?php $i++; if ($i%4 == 0) echo "<div class='clear'></div>";?>
						<?php } }?>
					</div>
					<div class='clear'></div><?php 
				} else {?>
					<h3><input style="float:left" type="checkbox" name="attributes_<?php echo $attribute->attribute_id?>">&nbsp;<?php echo $attribute->attribute_name;?></h3>
				<?php }?>
			<?php endforeach;?>
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
			<button class="button-primary" type="submit"><?php _e( 'Save', 'wooku-seo' ); ?></button>
		</td>
	</tr>
</table>
</form>