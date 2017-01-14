<div id="icon-tools" class="icon32"><br /></div>
<h2><?php _e( 'WoBIL Product Checker', 'wobil-checker' ); ?></h2>

<form enctype="multipart/form-data" method="post" action="<?php echo get_admin_url().'tools.php?page=wobil-checker&action=preview'; ?>">
<table class="form-table">
	<!--
	<tr>
		<th><label for="check_category"><?php _e( 'Category', 'wobil-checker' ); ?></label></th>
		<td>
			<select name="check_category">
				<option>Select...</option>
				<?php foreach ($categories as $category):?>
					<option value="<?php echo $category->term_id?>"><?php echo $category->name?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>
	-->
	<tr>
		<th></th>
		<td>
			<button class="button-primary" type="submit"><?php _e( 'Load scraped products', 'wobil-checker' ); ?></button>
		</td>
	</tr>
</table>
</form>