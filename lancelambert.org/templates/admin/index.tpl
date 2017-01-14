
<div class="post_cell ui-widget ui-widget-content ui-corner-all" style="padding: 10px; margin: 0 20px; float: right; width: 250px;">
	<div>
		<h3>New orders</h3>
		{if $orders}
			<table class="admin_table">
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Value</th>
					<th>Status</th>
				</tr>
				{foreach from=$orders item=order}
				{if $order->GetPurchaseDate()!=$current_date}
				<tr>
					<th colspan="4">{$order->GetPurchaseDate()}</th>
				</tr>
				{/if}
				<tr>
					<td><a href="/OrderAdmin/View/{$order->id}">{$order->id}</a></td>
					<td><a href="/OrderAdmin/View/{$order->id}">{$order->customer_name}</a></td>
					<td><a href="/OrderAdmin/View/{$order->id}">{$smarty.const.CURRENCY_SIGN}{$order->value|string_format:"%.2f"}</a></td>
					<td>{$order->GetStatus()}</td>
				</tr>
				{assign var=current_date value=$order->GetPurchaseDate()}
				{/foreach}
			</table>
		{else}
			<p>No new orders</p>
		{/if}
	</div>
</div>

<div>
	<ul class="controls post_cell ui-widget ui-widget-content ui-corner-all">

		<li>
			<a href="/OrderAdmin/">
				<img src="/resources/images/admin/header/icon-48-static.png" width="48" height="48" alt="" border="0"/>
				<span>Order Manager</span>
			</a>
		</li>

		<li>
			<a href="/UserAdmin/">
				<img src="/resources/images/admin/header/icon-48-user.png" width="48" height="48" alt="" border="0"/>
				<span>User Manager</span>
			</a>
		</li>

		<li>
			<a href="/UrlAdmin/">
				<img src="/resources/images/admin/header/icon-48-cpanel.png" width="48" height="48" alt="" border="0"/>
				<span>SEO Url</span>
			</a>
		</li>


		<li>
			<a href="/CategoryAdmin/">
				<img src="/resources/images/admin/header/icon-48-category.png" width="48" height="48" alt="" border="0" />
				<span>Category Manager</span>
			</a>
		</li>

		<li>
			<a href="/ProductAdmin/">
				<img src="/resources/images/admin/header/icon-48-generic.png" width="48" height="48" alt="" border="0" />
				<span>Product Manager</span>
			</a>
		</li>

		<li>
			<a href="/PageAdmin/">
				<img src="/resources/images/admin/header/icon-48-article-add.png" width="48" height="48" alt="" border="0" />
				<span>Content Manager</span>
			</a>
		</li>

		<li>
			<a href="/ModuleAdmin/">
				<img src="/resources/images/admin/header/icon-48-component.png" width="48" height="48" alt="" border="0"/>
				<span>Module Manager</span>
			</a>
		</li>

		<li>
			<a href="/LinkAdmin/">
				<img src="/resources/images/admin/header/icon-48-article.png" width="48" height="48" alt="" border="0" />
				<span>Links Manager</span>
			</a>
		</li>

		{*
		<li>
			<a href="/SettingsAdmin/">
				<img src="/resources/images/admin/header/icon-48-cpanel.png" width="48" height="48" alt="" border="0"/>
				<span>Shop Configuration</span>
			</a>
		</li>
		*}
		
		<li>
			<a href="/FaqAdmin/">
				<img src="/resources/images/admin/header/icon-48-static.png" width="48" height="48" alt="" border="0"/>
				<span>Faq</span>
			</a>
		</li>
		
		{*
		<li>
			<a href="/ShippingAdmin/">
				<img src="/resources/images/admin/header/icon-48-install.png" width="48" height="48" alt="" border="0"/>
				<span>Shipping</span>
			</a>
		</li>
		*}

		<li>
			<a href="/User/Logout">
				<img src="/resources/images/admin/header/icon-48-checkin.png" width="48" height="48" alt="" border="0"/>
				<span>Logout</span>
			</a>
		</li>

	</ul>
</div>

