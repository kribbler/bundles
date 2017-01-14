<div class="post">
	<h2 class="title">{if $faq}Question: '{$faq->question|strip_tags}' editing{else}New Question{/if}</h2>

	<div class="post_content">
	
		<form action="/FaqAdmin/Edit/{$faq->id}" method="post">
			<table>
			
				<tr>
					<td>
						<div class="post_cell ui-widget ui-widget-content ui-corner-all">
							<label>Question:</label>
							<br />
							<textarea cols="80" rows="3" name="question">{$faq->question}</textarea>

							<br />
							<label>Answer:</label>
							<br />
							<textarea cols="80" rows="10" name="answer">{$faq->answer}</textarea>

							{if $smarty.const.TINY_MCE}
								{include file="admin/tiny_mce.tpl"}
							{/if}

						</div>
					</td>

				</tr>
					
				<tr>
					<td style="padding-top: 10px;">
						<input type="submit" value="Save" class="submit ui-corner-all" style="font-size: 11px;" />
					</td>
				</tr>
				
			</table>
		</form>
		
		<br />
		<div style="clear: both"></div>
	</div>
</div>
