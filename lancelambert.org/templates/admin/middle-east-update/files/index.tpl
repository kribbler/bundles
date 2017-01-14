<div class="post">
	<h2 class="title">Files</h2>

	<div class="post_content">
		<table class="admin_table">
			<thead>
				<tr class="header">
					<th>ID</th>
					<th>Name</th>
					<th>Type</th>
					<th>Size</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				{foreach $files as $file}
				<tr class="item">
					<td>{$file->id}</td>
					<td>{$file->name}</td>
					<td>{$file->type}</td>
					<td>{($file->size / 1024)|string_format:"%.2f"} kb</td>
					<td>{if $file->price > 0}${$file->price}{else}Free{/if}</td>
					<td>
						<a href="/admin-middle-east-update.php/download/{$file->id}">Download</a> |
						<a href="/admin-middle-east-update.php/fileEdit/{$file->id}">Edit</a> |
						<a href="/admin-middle-east-update.php/fileDelete/{$file->id}" onclick="return confirm('Do you really want to delete this file?');">Delete</a>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>
