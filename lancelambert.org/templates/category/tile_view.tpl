<div class="{if $tile_class}{$tile_class}{else}tile_category_view{/if}{if $kid_category->is_set} product_set{/if}">

	{if $kid_category->image}
		<a href="{$seourl->seoCategory($kid_category->id,1,$kid_category->name)}" title="{$kid_category->name}">
			<img style="padding: 0; " src="/Category/Image/150x130/{$kid_category->id}/{$kid_category->ImageBasename()}" title="{$kid_category->name}" />
		</a>
	{/if}

	<div class="details_button">
		<a href="{$seourl->seoCategory($kid_category->id,1,$kid_category->name)}" title="{$kid_category->name}">{$kid_category->name}</a>
	</div>
</div>
