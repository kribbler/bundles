<?php include_styles();?>
<div id="icon-tools" class="icon32"><br /></div>
<h2><?php _e( 'WoOKU Seo', 'wooku-seo' ); ?></h2>
<?php include 'wooku-seo-menu.php'?>

<form enctype="multipart/form-data" method="post" action="<?php echo get_admin_url().'tools.php?page=wooku-seo&action=preview'; ?>">
<?php $metasets = get_metasets(); ?>
<table class="form-table1">
	<tr>
		<th>Metaset Name</th>
		<th>Title</th>
		<th>Keywords</th>
		
		<th>Categories</th>
		<th>Attributes</th>
		<th class="ms_small">Edit</th>
		<th class="ms_small">Delete</th>
	</tr>
<?php foreach ($metasets as $metaset):?>
	<tr>
		<td><?php echo $metaset['name'];?></td>
		<td><?php echo $metaset['title'];?></td>
		<td><?php echo $metaset['keyword'];?></td>
		
		<td>
			<?php foreach ($metaset['links'] as $link):?>
				<?php if ($link['type'] == "C"){?>
					<?php echo $link['link_name']?><br />
				<?php }?>
			<?php endforeach;?>
		</td>
		<td>
			<?php foreach ($metaset['links'] as $link):?>
				<?php if ($link['type'] == "A" || $link['type'] == "AV"){
					if (isset($link['attribute_name'])) echo '<i>'.$link['attribute_name']. '</i> - ';
					echo $link['link_name']?><br />
				<?php }?>
			<?php endforeach;?>
		</td>
		<td><a href="<?php echo get_admin_url().'tools.php?page=wooku-seo&action=edit-metaset&id=' . $metaset['id']?>"><img src="<?php echo plugins_url() . '/woo-oku-seo'?>/images/Actions-document-edit-icon.png" width="30" /></a></td>
		<td><a onclick="return confirm('Are you sure want to delete this metaset?');" href="<?php echo get_admin_url().'tools.php?page=wooku-seo&action=delete-metaset&id=' . $metaset['id']?>"><img src="<?php echo plugins_url() . '/woo-oku-seo'?>/images/Actions-edit-delete-icon.png" width="30" /></a></td>
	</tr>
	<tr class="end_row">
		<td>Description:</td>
		<td colspan=6><?php echo $metaset['description'];?></td>
	</tr>
<?php endforeach; ?>
</table>
</form>