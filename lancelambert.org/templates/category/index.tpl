{if $category->is_set}<div style="float: right; margin-right: 63px; margin-top: -10px;"><a  href="/Basket/AddSet/{$category->id}" title="Purchase entire set"><img src="/resources/images/gist/purchase-set-button.png" alt="Purchase entire set" /></a></div>{/if}
<div class="post">
	{if $category}
	<h1 class="title">{$category->name}</h1>
	
	<div class="post_content" style="padding: 10px 15px;">

			{assign var=kids value=$category->LevelCollection($category->id,true,$pager->elements,$pager->page)}
			{foreach from=$kids item=kid_category}
				{include file='category/tile_view.tpl'}
			{/foreach}

			{if $products}
			{foreach from=$products item=product_mini}
				{include file="product/in_category_view.tpl"}
			{/foreach}
			{/if}
		
		<div style="clear: both;"></div>

	</div>
	{else}
		Category not found.
	{/if}
</div>
{if $pager}
<div class="post_pagination">
	{include file="category/pager.tpl"}
</div>
{else}
<div class="post_close"></div>
{/if}
