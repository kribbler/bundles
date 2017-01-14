<div class="post">
	<h2 class="title">{if $link->id}Link {$lang->ADMIN} - "{$link->name}"{else}New Link{/if}</h2>

	{if $link->image}
		<img src="/Link/Image/145x95/{$link->id}/{$link->image|basename}" alt="Image" />
	{/if}

	<div class="post_content">
		{assign var=basedir value=$smarty.const.INCLUDE_PATH}
		{include file="$basedir/templates/form.tpl"}
	</div>
</div>
