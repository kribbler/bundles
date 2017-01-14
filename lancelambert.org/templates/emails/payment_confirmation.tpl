<html>
<head></head>
<body>
<h1>{$smarty.const.SITE_NAME} - INVOICE</h1>
<div>
<h3>Invoice / order number: {$order->id}</h3>
<p>Date: {$smarty.now|date_format}</p>

<h2>Delivery Details:</h2>

<p>{$order->customer_name}</p>
<p>{$order->customer_address}</p>
<p>{$order->customer_postcode}, {$order->customer_city}</p>
<p>{$order->customer_county}</p>
<p>{$order->customer_country}</p>
<p>{$order->customer_email}</p>

<h2>Order details:</h2>

    {assign var=basket_totals value=$basket->GetTotals()}
    <div>{include file="basket/basket-table.tpl"}</div>
	
<h2>Shipping details:</h2>
<p>UPS - Ground Service: {$smarty.const.CURRENCY_SIGN}{$order->shipping_value}<p>

{if $order->tax}<p>State tax paid: {$smarty.const.CURRENCY_SIGN}{$order->tax|string_format:"%.2f"}</p>{/if}
<p><h2>Total: {$smarty.const.CURRENCY_SIGN}{$shipping_rate+$order_totals.value+$tax_total|string_format:"%.2f"}</h2></p>



<p>Paid fully by electronic transfer.</p>

<p>Thank you for shopping at {$smarty.const.SITE_NAME}</p>
</div>
</body>
</html>
