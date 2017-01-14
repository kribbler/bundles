<div class="post">
	<h2 class="title">{$lang->USERS} {$lang->ADMIN}</h2>
	
	<a href="/UserAdmin/Edit" class="ui-state-default ui-corner-all"><img src="/resources/icons/mini/icon_wand.gif" alt="New user" />New user</a>

	<div class="post_content">
		<table class="admin_table">
			<thead>
				<tr class="header">
					<th>ID</th>
					<th>{$lang->USERNAME}</th>
					<th>{$lang->EMAIL}</th>
					<th>{$lang->VENDOR}</th>
					<th>{$lang->ROLE}</th>
					<th>{$lang->LAST_LOGIN}</th>
					<th>{$lang->ACTION}</th>
				</tr>
			</thead>
			
			<tbody>
				{foreach from=$users item=user loop=user_loop}
				<tr class="item">
					<td>{$user->id}</td>
					<td>{$user->username}</td>
					<td><a href="mailto:{$user->email}">{$user->email}</a></td>
					<td>{if $user->vendor}<a href="/VendorAdmin/View/{$user->vendor->id}">{$user->vendor->name}</a>{/if}</td>
					<td>
						{if $user && $user->HasRole('admin')}Admin{/if}
						{if $user && $user->HasRole('banned')}Banned{/if}
					</td>
					<td>{$user->last_login|date_format:"%Y-%m-%d %H:%m"}</td>
					<td>
						<a href="/UserAdmin/Edit/{$user->id}" title="{$lang->EDIT}"><img src="/resources/icons/silk/application_edit.png" alt="{$lang->EDIT}" /></a>
						<a href="/UserAdmin/Delete/{$user->id}" title="{$lang->DELETE}" onclick="return confirm('Do you really want to delete {$user->username} &lt;{$user->email}&gt;');"><img src="/resources/icons/silk/application_delete.png" alt="{$lang->DELETE}" /></a>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>
