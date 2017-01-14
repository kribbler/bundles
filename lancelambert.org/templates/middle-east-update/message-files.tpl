<div id="main" class="middle-east-update">
	<div class="item">
		<div class="year">{$message->getYear()}</div>
		<div class="item {if $index % 2}odd{/if}">
			<div class="month">{$message->getMonth()}</div>
			<div class="content">{$message->content}</div>
			<div class="pdf">
				<center>
					{if $message->pdf}
						<a href="/middle-east-update.php/download/{$message->pdf->id}/{$message->pdf->file|basename|escape:'url'}">
							<img src="/images/pdf-icon.png" alt="pdf" />
							<br />
							Cost: {if $message->pdf->price > 0}${$message->pdf->price|string_format:"%.2f"}{else}free{/if}
							<br />
							<span class="download">Download</span>
						</a>
					{/if}
				</center>
			</div>
		</div>
	</div>

	{if $message->mp3}
	<div style="clear: both">
		<h3>Media files</h3>
		<p>Your download will consist of the following files:</p>

		<div>
			{foreach from=$message->mp3 item=mp3}
				<ul>
					<li>
						<span class="download">{$mp3->name}</span>
					</li>
				</ul>
			</center>
			{/foreach}

		</div>

		<p style="font-size: 16px;">
			<a href="/middle-east-update.php/buy/{$message->id}">
				Cost: {if $message->price > 0}${$message->price|string_format:"%.2f"} CAD - Place order{else}free{/if}
			</a>
		</p>

	</div>
	{/if}
</div>
