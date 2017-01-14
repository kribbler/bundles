{assign var=basedir value=$smarty.const.SMARTY_DEFAULT_TEMPLATES_DIR}
<div class="post basket">
	<h2 class="title noprint">Order preview</h2>
	<div class="post_content">

		<div style="position: relative;" class="toolbar noprint" class="noprint" onmouseout="jQuery('#search_help').hide();" onmouseover="jQuery('#search_help').show();">
			<img  onclick="javascript:window.print(); return false;" src="/resources/icons/silk/printer.png" alt="Print invoice" title="Print invoice" />

			<div id="search_help" class="popup noprint" onmouseout="jQuery('#search_help').hide();" style="width: 300px; position: absolute; top: 20px; left: 0;">
				{include file="admin/help/printing.tpl"}
			</div>
		</div>

		<h1>Order {$order->id} <span style="color: red; font-weight: bold;">{$order->PayStatus()}</span></h1>

		<h3 style="margin-top: 15px;">Delivery details</h3>
		<div>
			<div>{$order->customer_name}</div>
			<div>{$order->customer_address}</div>
			<div>{$order->customer_postcode}, {$order->customer_city}</div>
			<div>{$order->customer_county}</div>
			<div><img src="/resources/icons/flag/{$order->customer_country|lower}.png" alt="{$order->customer_country}" /> <span>{$order->customer_country->name}</span></div>
			<div>{$order->customer_email}</div>
			{if $order->customer_phone}<div>{$order->customer_phone}</div>{/if}
			{if $order->customer_note}<div>{$order->customer_note}</div>{/if}

		</div>

		<h3 style="margin-top: 15px;">Order details - products</h3>

		{include file="basket/basket-table.tpl"}

		{if $order->tax}<p>State tax paid: {$smarty.const.CURRENCY_SIGN}{$order->tax|string_format:"%.2f"}</p>{/if}
		<p><h2>Total: {$smarty.const.CURRENCY_SIGN}{$shipping_rate+$order_totals.value+$tax_total|string_format:"%.2f"}</h2></p>

		{if $order->status_history}<h3 style="margin-top: 15px;" class="noprint">Order history</h3>

			<table class="noprint admin_table">
				<thead>
					<tr class="header">
						<th>ID</th>
						<th style="width: 200px;">Created</th>
						<th>Status</th>
						<th>Payer ID</th>
						<th>Transaction ID</th>
						<th>Total</th>
					<tr>
				</thead>
				<tbody>
				{foreach from=$order->status_history item=status}
					<tr class="item">
						<td>{$status->id}</td>
						<td style="font-size: smaller;">{$status->created}</td>
						<td>{$status->status}</td>
						<td>{$status->payer_id}</td>
						<td>{$status->transaction_id}</td>
						<td>{$smarty.const.CURRENCY_SIGN}{$status->total|string_format:"%.2f"}</td>
					</tr>
				{/foreach}
				</tbody>
			</table>
		{/if}

		<div class="noprint">
		{if $order->GetStatus()!='Despatched' && $order->GetStatus()!='Cancelled'}
			<ul>
				<li><a href="/OrderAdmin/Despatch/{$order->id}" onclick="return confirm('All stock has been despatched, customer will be informed by email.');">Despatch</a></li>
				<li><a href="/OrderAdmin/Cancel/{$order->id}">Cancel</a></li>
			</ul>
		{/if}
		</div>

		{if $feedback}
		<div class="blockquote">
			<h3>{$feedback->RateToText()} feedback received.</h3>
			<p>{$feedback->comment}</p>
		</div>
		{/if}
	</div>
</div>
