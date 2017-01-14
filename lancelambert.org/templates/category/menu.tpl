{if $categories}
{foreach from=$categories item=root_category}
	{if $root_category->id == $main_category->id}
		{assign var=kids value=$root_category->GetKids()}
		{foreach from=$kids item=category_list_item}
		<li {if $category_list_item->id==$category->id || $category_list_item->id==$category->parent->id} class="selected"{/if}>
			<a href="{$seourl->seoCategory($category_list_item->id,1,$category_list_item->name)}" title="{$category_list_item->name}">{$category_list_item->name}</a>
			{if $categories_all_open || $category_list_item->id==$category->id}
				{assign var=category_menu_kids value=$category_list_item->LevelCollection($category_list_item->id)}
			{elseif $category_list_item->parent->id > 0 && $category_list_item->id==$category->parent->id}
				{assign var=category_menu_kids value=$category_list_item->LevelCollection($category_list_item->id)}
			{/if}

			{if $category_menu_kids}
				<ul>
				{foreach from=$category_menu_kids item=category_kid}
					<li{if $category_kid->id==$category->id} class="selected2"{/if}>
						<a href="{$seourl->seoCategory($category_kid->id,1,$category_kid->name)}" title="{$category_kid->name}">{$category_kid->name}</a>
					</li>
				{/foreach}
				</ul>
			{/if}

			{assign var=category_menu_kids value=0}
		</li>
		{/foreach}
	{/if}
{/foreach}
{/if}
