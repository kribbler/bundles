<div class="post">
	<div id="postcontent">
		<h1 class="title">{$page->title|stripslashes}</h1>
		{if $page->image}
		<div style="float: right; margin: 0 0 10px 10px;">
			<img src="/Page/Image/0x0/{$page->id}" alt="{$page->title|stripslashes}" />
		</div>
		{/if}

		{$page->text|stripslashes}
	</div>
</div>
<div class="post_close"></div>
