<img src="/resources/images/gist/sidebar-news-header.png" alt="Corporate News" />

<ul class="sidebar_news">
	{foreach from=$left_sidebar_news item=page name=pages}
		<li><p class="news_title">{$page->title}</p><p><a href="/Page/View/{$page->id}/{$page->title|replace:"/":"+"|escape:'url'}">{$page->text|strip_tags|truncate}</a></p></li>
		{if !$smarty.foreach.pages.last}
			<li class="divider"></li>
		{/if}
	{/foreach}
</ul>
