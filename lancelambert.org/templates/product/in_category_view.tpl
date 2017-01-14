<div class="{if $tile_class}tile_product_rtw_view{else}tile_product_view{/if}">

	{assign var=product_mini_image value=$product_mini->GetMainImage()}
	{if $product_mini_image->id}
		<a href="{$seourl->seoProduct($product_mini->id,$product_mini->name)}" title="{$product_mini->name}">
			<img src="/Product/Image/150x130/{$product_mini_image->id}/{$product_mini_image->GetFilename()}" title="{$product_mini_image->title}" />
		</a>
	{/if}

	<div class="details_button">
		<a href="{$seourl->seoProduct($product_mini->id,$product_mini->name)}" title="{$product_mini->name}">
			{$product_mini->name}
		</a>
	</div>

</div>
