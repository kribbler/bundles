<div class="post">
	<h2 class="title">Messages</h2>

	<div class="post_content">
		<table class="admin_table">
			<thead>
				<tr class="header">
					<th>ID</th>
					<th>Date</th>
					<th>Published</th>
					<th>Content</th>
					<th>Pdf</th>
					<th>Mp3</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				{foreach $messages as $message}
				<tr class="item">
					<td>{$message->id}</td>
					<td>{$message->date|date_format:'%Y-%m-%d'}</td>
					<td>{if $message->published}Yes{else}No{/if}</td>
					<td>{$message->content|truncate:300|nl2br}</td>
					<td>{if $message->pdf}Yes{else}No{/if}</td>
					<td>{if $message->mp3}Yes{else}No{/if}</td>
					<td>
						<a href="/admin-middle-east-update.php/messageEdit/{$message->id}">Edit</a>
						<a href="/admin-middle-east-update.php/messageDelete/{$message->id}" onclick="return confirm('Do you really want to delete this message?');">Delete</a>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>
