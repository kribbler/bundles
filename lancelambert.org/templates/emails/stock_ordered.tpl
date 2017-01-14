{$smarty.const.SITE_NAME} - INVOICE

Invoice / order number: {$order->id}
Date: {$smarty.now|date_format}

CUSTOMER:

{$order->customer_name}
{$order->customer_address}
{$order->customer_city}
{$order->customer_postcode}
{$order->customer_country}
{$order->customer_email}

ORDER:

    {assign var=basket_totals value=$basket->GetTotals()}

{foreach from=$basket->items item=item key=item_key}{foreach from=$item item=variant key=variant_key}{assign var=product value=$basket->GetProduct($item_key)}{assign var=variants value=$basket->GetVariant($variant_key)}
{if $product}{$product->name} - quantity: {$variant.quantity} - price per item: {$smarty.const.CURRENCY_SIGN}{math equation="x * y * vat" x=$variant.item_value y=$variant.quantity vat=$vat_multiply format="%.2f"} ({foreach from=$variants item=variant_object name=variantsloop}{$variant_object->type}: {$variant_object->name} {if not $smarty.foreach.variantsloop.last}, {/if}{/foreach}) 
{/if}{/foreach}{/foreach}


ORDER TOTALS:

Items: {$basket_totals.quantity} item{if $basket_totals.quantity > 1}s{/if}

{$smarty.const.SALES_TAX_NAME} total: {$smarty.const.PAYPAL_CURRENCY_CODE} {math equation="x-y" x=$basket_totals.value*$vat_multiply y=$basket_totals.value|string_format:"%.2f"}

Value total: {$smarty.const.PAYPAL_CURRENCY_CODE} {if $shipping}{$shipping->ValueWithOrder($basket_totals.value)*$vat_multiply|string_format:"%.2f"}{else}{$basket_totals.value*$vat_multiply|string_format:"%.2f"}{/if}


Paid fully by electronic transfer.

Thank you for selling at {$smarty.const.SITE_NAME}
