<div class="post basket">
	<h2 class="title">F.A.Q.'s</h2>

	<p><a href="/FaqAdmin/Edit/" class="ui-state-default ui-corner-all"><img src="/resources/icons/mini/icon_wand.gif" alt="New faq" />New question</a></p>

	<div class="post_content">
		<table class="admin_table">

			<thead>
				<tr class="header">
					<th>ID</th>
					<th>Question</th>
					<th>Ordering</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
			{foreach from=$faqs item=faq}
				<tr class="item">
					<td class="center">{$faq->id}</td>
					<td>{$faq->question|strip_tags|truncate}</td>
					<td>
						<a href="/FaqAdmin/MoveUp/{$faq->id}" title="Move question up">
							<img src="/resources/icons/silk/arrow_up.png" alt="Up" />
						</a>

						<a href="/FaqAdmin/MoveDown/{$faq->id}" title="Move question down">
							<img src="/resources/icons/silk/arrow_down.png" alt="Down" />
						</a>
					</td>
					<td>
						<a href="/FaqAdmin/Edit/{$faq->id}">Edit</a>
						<span> / </span>
						<a href="/FaqAdmin/Delete/{$faq->id}" onclick="return confirm('Do you really want to delete question: {$faq->question}?')">Delete</a>
					</td>
				</tr>
			{/foreach}
			</tbody>
		</table>

		<p><sup>*)</sup><span>To refresh <a href="/FaqAdmin/FlushCache/">flush cache</a></span></p>
	</div>
</div>
