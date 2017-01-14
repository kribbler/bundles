<div class="post basket">
	<h2 class="title">Site modules</h2>

	<p><a href="/ModuleAdmin/Edit/" class="ui-state-default ui-corner-all"><img src="/resources/icons/mini/icon_wand.gif" alt="New module" />New module</a></p>

	<div class="post_content">
		<table class="admin_table">

			<thead>
				<tr class="header">
					<th>ID</th>
					<th>Name</th>
					<th>Postion</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
			{foreach from=$modules item=module}
				<tr class="item">
					<td class="center">{$module->id}</td>
					<td>{$module->name}</td>
					<td>{$module->position}</td>
					<td>
						<a href="/ModuleAdmin/Edit/{$module->id}">Edit</a>
						<span> / </span>
						<a href="/Module/View/{$module->id}/{$module->title}">View</a>
						<span> / </span>
						<a href="/ModuleAdmin/Delete/{$module->id}" onclick="return confirm('Do you really want to delete module: {$module->name}?')">Delete</a>
					</td>
				</tr>
			{/foreach}
			</tbody>
		</table>

	</div>
</div>
