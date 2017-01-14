<div class="post basket">
	<h1 class="title">Order {$order->id} Receipt</h2>

	<p>This receipt has been emailed to the email address on the account.</p>

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

	<div class="post_content">
		<h3>Your order has been successfully placed.</h3>

		<p>Thank you for placing an order at our Online Store. An email receipt has been sent to the email address on the account. We look forward to your next visit.</p>
	</div>

</div>
<div class="post_close"></div>
