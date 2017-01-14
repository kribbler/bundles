<div class="post">
	<h2 class="title">{$lang->CATEGORIES}</h2>

	<div>
		<a href="/CategoryAdmin/Edit/" class="ui-state-default ui-corner-all">
			<img src="/resources/icons/mini/icon_wand.gif" alt="New category" /><span>{$lang->ADD_NEW_CATEGORY}</span>
		</a>
	</div>
{if $categories}

	<table class="admin_table">
		<thead>
			<tr class="header">
				<th colspan="3">{$lang->NAME}</th>
				<th>{$lang->ACTION}</th>
			</tr>
		</thead>
		
		<tbody>
			{foreach from=$categories item=category}
			<tr class="main">
				<td colspan="3">
					<a href="/Category/Index/{$category->id}/1/{$category->name}" title="{$category->name}"{* onclick="return showCategory({$category->id});"*}>{$category->name}</a>
				</td>
				<td>
					<a href="/CategoryAdmin/ListOrderUp/{$category->id}" title="Move category up in this category">
						<img src="/resources/icons/silk/arrow_up.png" alt="Up" />
					</a>

					<a href="/CategoryAdmin/ListOrderDown/{$category->id}" title="Move category down in this category">
						<img src="/resources/icons/silk/arrow_down.png" alt="Down" />
					</a>

					<a href="/CategoryAdmin/Edit/{$category->id}" title="{$lang->EDIT}">
						<img src="/resources/icons/silk/application_edit.png" alt="{$lang->EDIT}" />
					</a>
					<a href="/CategoryAdmin/View/{$category->id}" title="{$lang->VIEW}">
						<img src="/resources/icons/silk/application_go.png" alt="{$lang->VIEW}" />
					</a>
					<a href="/CategoryAdmin/Delete/{$category->id}" onclick="return confirm('{$lang->DO_YOU_REALLY_WANT_TO_DELETE_THIS_CATEGORY} {$category->name}')" alt="{$lang->DELETE}">
						<img src="/resources/icons/silk/application_delete.png" title="{$lang->DELETE}" />
					</a>
				</td>
			</tr>

				{if $category->kids}
					{foreach from=$category->kids item=category_kid}
					<tr class="kid">
						<td style="width: 20px;">
							&nbsp;
						</td>
						<td colspan="2">
							<a href="/Category/Index/{$category_kid->id}/1/{$category_kid->name}" title="{$category_kid->name}" {*onclick="return showCategory({$category_kid->id});"*}>{$category_kid->name}</a>
						</td>
						<td>
							
							<a href="/CategoryAdmin/ListOrderUp/{$category_kid->id}" title="Move category up in this category">
								<img src="/resources/icons/silk/arrow_up.png" alt="Up" />
							</a>

							<a href="/CategoryAdmin/ListOrderDown/{$category_kid->id}" title="Move category down in this category">
								<img src="/resources/icons/silk/arrow_down.png" alt="Down" />
							</a>

							<a href="/CategoryAdmin/Edit/{$category_kid->id}" title="{$lang->EDIT}">
								<img src="/resources/icons/silk/application_edit.png" alt="{$lang->EDIT}" />
							</a>
							<a href="/Category/View/{$category_kid->id}" title="{$lang->VIEW}">
								<img src="/resources/icons/silk/application_go.png" alt="{$lang->VIEW}" />
							</a>
							<a href="/CategoryAdmin/Delete/{$category_kid->id}" onclick="return confirm('{$lang->DO_YOU_REALLY_WANT_TO_DELETE_THIS_CATEGORY} {$category_kid->name}?')" alt="{$lang->DELETE}">
								<img src="/resources/icons/silk/application_delete.png" title="{$lang->DELETE}" />
							</a>
						</td>
					</tr>
					
					{assign var=category_kids value=$category_kid->GetKids(true)}
					{if $category_kids}
						{foreach from=$category_kids item=category_kid_kid}
						<tr class="kid">
							<td style="width: 20px;">
								&nbsp;
							</td>
							<td style="width: 20px;">
								&nbsp;
							</td>
							<td>
								<a href="/Category/Index/{$category_kid_kid->id}/1/{$category_kid_kid->name}" title="{$category_kid_kid->name}" {*onclick="return showCategory({$category_kid->id});"*}>{$category_kid_kid->name}</a>
							</td>
							<td>
							
								<a href="/CategoryAdmin/ListOrderUp/{$category_kid_kid->id}" title="Move category up in this category">
									<img src="/resources/icons/silk/arrow_up.png" alt="Up" />
								</a>

								<a href="/CategoryAdmin/ListOrderDown/{$category_kid_kid->id}" title="Move category down in this category">
									<img src="/resources/icons/silk/arrow_down.png" alt="Down" />
								</a>

								<a href="/CategoryAdmin/Edit/{$category_kid_kid->id}" title="{$lang->EDIT}">
									<img src="/resources/icons/silk/application_edit.png" alt="{$lang->EDIT}" />
								</a>
								<a href="/Category/View/{$category_kid_kid->id}" title="{$lang->VIEW}">
									<img src="/resources/icons/silk/application_go.png" alt="{$lang->VIEW}" />
								</a>
								<a href="/CategoryAdmin/Delete/{$category_kid_kid->id}" onclick="return confirm('{$lang->DO_YOU_REALLY_WANT_TO_DELETE_THIS_CATEGORY} {$category_kid_kid->name}?')" alt="{$lang->DELETE}">
									<img src="/resources/icons/silk/application_delete.png" title="{$lang->DELETE}" />
								</a>
							</td>
						</tr>
						{/foreach}
					{/if}

					{/foreach}
				{/if}

				{assign var=category_menu_kids value=0}

			{/foreach}
		</tbody>
	</table>
{/if}
</div>
