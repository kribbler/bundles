{if $pager}
{strip}
{assign var=min value=$pager->page*$pager->elements-5-$pager->elements}

<ul class="pager">
	{if $pager->max > 1}
		{if $pager->max > 1 && $pager->page > 1}
			<li><a href="{$pager->self}/1/{$pager->option}">First</a></li>
		{else}
			<li class="inactive">First</li>
		{/if}
		{if $pager->page gt 1}
			<li><span class="inactive"><a href="{$pager->self}/{$pager->page-1}/{$pager->option}">Prev</a></li>
		{else}
			<li class="inactive">Prev</li>
		{/if}
		<li class="page_info"><strong>Page: {$pager->page} / {$pager->CountPages()}</strong></li>

	{*if $pager->page < 6}
		{section name=pagerloop loop=$pager->elements_loop max=$pager->CountPages() start=1}
			{if 1 neq $smarty.section.pagerloop.index}<li class="divider"><span class="inactive"> | </span></li>{/if}
			{if $pager->page neq $smarty.section.pagerloop.index}
				<li><a href="{$pager->self}/{$smarty.section.pagerloop.index}/{$pager->option}">{$smarty.section.pagerloop.index}</a></li>
			{else}
				<li class="active"><span>{$smarty.section.pagerloop.index}</span></li>
			{/if}
		{/section}
	{else}
		{section name=pagerloop loop=$pager->CountPages()+1 start=$pager->page-5 max=$pager->elements_loop}
			{if $min neq $smarty.section.pagerloop.index}<li class="divider"><span class="inactive"> | </span></li>{/if}
			{if $pager->page neq $smarty.section.pagerloop.index}
				<li><a href="{$pager->self}/{$smarty.section.pagerloop.index}/{$pager->option}">{$smarty.section.pagerloop.index}</a></li>
			{else}
				<li class="active"><span>{$smarty.section.pagerloop.index}</span></li>
			{/if}
		{/section}
	{/if*}
		{if $pager->page lt $pager->max/$pager->elements}
				<li><a href="{$pager->self}/{$pager->page+1}/{$pager->option}">Next</a></li>
			{if $pager->max gt 1}
				<li><a href="{$pager->self}/{$pager->countPages()}/{$pager->option}">Last</a></li>
			{/if}
		{else}
				<li class="inactive">Next</li>
			{if $pager->max gt 1}
				<li class="inactive">Last</li>
			{/if}
		{/if}
{/if}
</ul>
{/strip}
{/if}
