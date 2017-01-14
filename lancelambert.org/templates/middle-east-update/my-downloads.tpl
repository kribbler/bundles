<div id="main" class="middle-east-update">
	<hr color="#999999" size="1" width="100%">

	<h2>Your files</h2>

	{if $messages}
		{foreach from=$messages item=message}

			<h3>{$message->getYear()}-{$message->getMonth()}</h3>

			<table>
				{foreach $message->mp3 as $index => $file}
					<tr>
						<td>{$index+1} - </td>
						<td>
							<a href="/middle-east-update.php/download/{$file->id}/{$file->file|basename|escape:'url'}">{$file->name}</a>
						</td>
					</tr>
				{/foreach}
			</table>

			{if $message->mp3|count > 1}
				<div><a href="/middle-east-update.php/download-zip/{$message->id}">Download as single zip file</a></div>
			{/if}
		{/foreach}
	{else}
		No files bought or session expired.
	{/if}

	<hr />

		<p>If you don't see your files immediately, please refresh the page after 30-60 seconds. There is sometimes a delay in response from PayPal letting us know we have received your payment.</p>

	<hr />

	<form method="post" action="/middle-east-update.php/my-downloads">
		<p>If you don't see any files you bought or some may be missing, please enter your PayPal email which you used to buy missing files.</p>
		<label>Email</label>
		<input type="text" name="email" value="" />
		<input type="submit" value="Confirm" />
	</form>
</div>
