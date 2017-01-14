{strip}
<div class="post">
	<div id="postcontent">
		<h1 class="title">Sitemap</h1>

		<div class="sitemap_column" style="margn-right: 3%;">
			<p class="sitemap_header">Main menu</p>
			<ol>
				<li class="main"><a href="/gistsilversmiths.html">Company Profile</a></li>
				<li class="main"><a href="/custom-products.html">Custom Products</a>
					<ul>
						{assign var=categories value=$categories}
						{assign var=categories_all_open value=1}
						{assign var=main_category value=$custom_products_category}
						{include file="category/menu.tpl"}
					</ul>
				</li>
				<li class="main"><a href="/tradeshows.html">Tradeshows</a></li>
				<li class="main"><a href="/partner-links.html">Partner Links</a></li>
			</ol>
		</div>
		
		<div class="sitemap_column" style="margn-right: 3%;">
			<p class="sitemap_header">Store</p>
			<ol>
				<li class="main"><a href="/gistsilversmiths.html">Ready To Wear Online Store</a>
					<ul>
						{assign var=categories value=$categories}
						{assign var=categories_all_open value=1}
						{assign var=main_category value=$rtw_category}
						{include file="category/menu.tpl"}
						
						{assign var=categories_all_open value=0}
						{assign var=main_category value=null}
					</ul>
				</li>
			</ol>
		</div>
		
		<div class="sitemap_column">
			<p class="sitemap_header">Secondary menu</p>
			<ol>
				<li class="main"><a href="/">Home</a></li>
				<li class="main"><a href="/contactus.html">Contact Us</a></li>
				<li class="main"><a href="/faq.html">F.A.Q.'s</a></li>
				<li class="main"><a href="/User/Register">Register</a></li>
			</ol>
		</div>
		
		<div class="sitemap_column">
			<p class="sitemap_header">Shopping Cart</p>
			<ol>
				<li class="main"><a href="/Basket/View">View Cart</a></li>
			</ol>
		</div>

		{*
		<div style="width: 49%; float: left;">
			<ol class="sitemap">
				<li><h2>Pages</h2>
				<ul>
					{foreach from=$pages item=page}
					<li><a href="{$seourl->seoPage($page->id,$page->title)}" title="{$page->title}">{$page->title}</a></li>
					{/foreach}
				</ul>
				</li>
				<li><h2>Categories</h2>
				<ul>
					<li><h3>Custom Products</h3></li>
					{assign var=categories value=$categories}
					{assign var=categories_all_open value=1}
					{assign var=main_category value=$custom_products_category}
					{include file="category/menu.tpl"}
					<li><h3>Ready To Wear Online Store</h3></li>
					{assign var=categories value=$rtw}
					{assign var=main_category value=$rtw_category}
					{include file="category/menu.tpl"}
					{assign var=main_category value=0}
				</ul>
				</li>
				<li><h2><a href="{$seourl->_('/Link/')}">Partner links</a></h2></li>
				<li><h2><a href="{$seourl->_('/Contactus/')}">Contact Us</a></h2></li>
				<li><h2>Products</h2>
				<ul>
					{foreach from=$products item=product name="product_loop"}
					{if $smarty.foreach.product_loop.index<=$smarty.foreach.product_loop.total/2}
					<li><a href="{$seourl->seoProduct($product->id,$product->name)}" title="{$product->name}">{$product->name}</a></li>
					{/if}
					{/foreach}
				</ul>
				</li>
			</ol>
		</div>
		
		<div style="width: 50%; float: left;">
		<ul class="sitemap">
			{foreach from=$products item=product name="product_loop"}
			{if $smarty.foreach.product_loop.index>$smarty.foreach.product_loop.total/2}
			<li><a href="{$seourl->seoProduct($product->id,$product->name)}" title="{$product->name}">{$product->name}</a></li>
			{/if}
			{/foreach}

		</ul>
		</div>
		*}
		
		<div style="clear: both;"></div>
	</div>
</div>
<div class="post_close"></div>
{/strip}
