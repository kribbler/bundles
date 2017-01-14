<div id="main" class="middle-east-update">
	<hr color="#999999" size="1" width="100%" />

	<div style="float: right; margin-right: 15px;">
		<a href="/middle-east-update.php/my-downloads">Your files</a>
	</div>

	<h2>Middle East Update</h2>
	<img src="/images/lance.jpg" alt="" style="float: right; margin: 0 8px 8px 8px;" />
	{if $about_middle_east_update->published}
	<div style="padding: 5px 20px 15px 5px;">
		{$about_middle_east_update->content|nl2br}
	</div>
	{/if}

	<div style="clear: both;"></div>

	{foreach $messages as $index => $message}
		{assign var=year value=$message->getYear()}
		{if $year!=$last_year}<div class="year">{$year}</div>{/if}
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
				</a>
				</center>
			</div>
			<div class="mp3">
				<center>
					{if $message->mp3}
						<a href="/middle-east-update.php/downloadmessage/{$message->id}">
							<img src="/images/mp3-icon.png" alt="mp3" />
							<br />
							Cost: {if $message->price > 0}${$message->price|string_format:"%.2f"}{else}free{/if}
							<br />
							<span class="download">Buy Now</span>
						</a>
					{/if}
				</center>
			</div>
		</div>
		{assign var=last_year value=$year}
	{/foreach}

</div>
