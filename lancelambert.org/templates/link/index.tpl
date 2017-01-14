<div class="post">
	<h1 class="title">Partner Links</h1>
	
	<h3>Gist Silversmiths Is Proud To Support These Fine Organizations:</h3>

	{foreach from=$links item=link name=link_loop}
		<div class="partner_link" {if $smarty.foreach.link_loop.index%4==0} style="padding-left: 0;"{elseif $smarty.foreach.link_loop.index%4==3} style="padding-right: 0;"{/if}>
			<a href="{$link->url}" title="{$link->name}" target="_blank">
				<center>
					<div class="image_holder">
						<img src="/Link/Image/100x100/{$link->id}/{$link->image|basename}" alt="{$link->name}" />
					</div>
					<span>{$link->name}</span>
				</center>
			</a>
		</div>
	{/foreach}

	<div style="clear: both"></div>
</div>
<div class="post_close"></div>
