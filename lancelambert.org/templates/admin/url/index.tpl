<div class="post">
	<h2 class="title">SEO Friendly Url Index</h2>
	
	<a href="/UrlAdmin/Edit" class="ui-state-default ui-corner-all"><img src="/resources/icons/mini/icon_wand.gif" alt="New" />New</a>
	
	<table class="admin_table">
		<thead>
			<tr class="header">
				<th>Id</th>
				<th>Organic (real)</th>
				<th>Artificial</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
		{foreach from=$urls item=url loop=url_loop}
			<tr class="item">
				<td>{$url->id}</td>
				<td>{$url->organic}</td>
				<td>{$url->artificial}</td>
				<td>
					<a href="/UrlAdmin/Edit/{$url->id}" title="Edit"><img src="/resources/icons/silk/application_edit.png" alt="Edit" /></a>
					<a href="{$url->artificial}" title="View" target="_blank"><img src="/resources/icons/silk/application_go.png" alt="View" /></a>
					<a href="/UrlAdmin/Delete/{$url->id}" onclick="return confirm('Do you really want to delete url {$url->organic}?')" title="Delete"><img src="/resources/icons/silk/application_delete.png" alt="Delete" /></a>

				</td>
			</tr>
		{/foreach}
		</tbody>

	</table>
</div>
