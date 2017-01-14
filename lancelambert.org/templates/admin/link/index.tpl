<div class="post">
	<h2 class="title">Link {$lang->ADMIN}</h2>
	
	<a href="/LinkAdmin/Edit" class="ui-state-default ui-corner-all"><img src="/resources/icons/mini/icon_wand.gif" alt="New link" />New link</a>

	<div class="post_content">
		<table class="admin_table">
			<thead>
				<tr class="header">
					<th>ID</th>
					<th>{$lang->IMAGE}</th>
					<th>{$lang->NAME}</th>
					<th>{$lang->ORDER}</th>
					<th>{$lang->ACTION}</th>
				</tr>
			</thead>
			
			<tbody>
				{foreach from=$links item=link loop=link_loop}
				<tr class="item">
					<td>{$link->id}</td>
					<td>{if $link->image}<img src="/Link/Image/20x20/{$link->id}/{$link->image|basename}" alt="Image" />{else}-{/if}</td>
					<td>{$link->name}</td>
					<td>
						<a href="/LinkAdmin/MoveUp/{$link->id}" title="Move link up">
							<img src="/resources/icons/silk/arrow_up.png" alt="Up" />
						</a>

						<a href="/LinkAdmin/MoveDown/{$link->id}" title="Move link down">
							<img src="/resources/icons/silk/arrow_down.png" alt="Down" />
						</a>
					</td>
					<td>
						<a href="/LinkAdmin/Delete/{$link->id}" onclick="return confirm('Do you really want to delete link: {$link->name}?')" title="Delete">
							<img src="/resources/icons/silk/application_delete.png" alt="Delete" />
						</a>
						<a href="/LinkAdmin/Edit/{$link->id}" title="{$lang->EDIT}">
							<img src="/resources/icons/silk/application_edit.png" alt="{$lang->EDIT}" />
						</a>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>
