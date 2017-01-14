<ul>
	<li><a href="/" title="Home">Home</a></li>
	{foreach from=$breadcrumbs item=breadcrumb}
	<li> <img src="/resources/images/gist/breadcrumb-spacer.png" alt=" | " /> {if $breadcrumb.link}<a href="{$seourl->_($breadcrumb.link)}" title="{$breadcrumb.name}">{$breadcrumb.name}</a>{/if}</li>
	{/foreach}
</ul>
