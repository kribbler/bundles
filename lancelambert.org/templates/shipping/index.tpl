<div class="basket post">

	{assign var=checkout_stage value=3}
	{include file=checkout/checkout_stages.tpl}
	
    <h2 class="title">Shipping</h2>

	<div class="post_content">
		<p>Your basket value is {$smarty.const.CURRENCY_SIGN}{$basket_total.value*$vat_multiply|string_format:"%.2f"}</p>

		{if $error}<div style="margin: 20px 0;"><strong class="error">{$error}</strong></div>{/if}

		{if $shipping.rate>0}
			<p>Shipping: {$smarty.const.CURRENCY_SIGN}{$shipping.rate*$vat_multiply|string_format:"%.2f"}</p>
			<p>Package weight: {$package_weight} LBS</p>
			{if $tax_total}<p>State tax: {$smarty.const.CURRENCY_SIGN}{$tax_total}</p>{/if}
			<p><h2>Total: {$smarty.const.CURRENCY_SIGN}{$shipping.rate+$basket_total.value+$tax_total|string_format:"%.2f"}</h2></p>
			<br />
			<a href="/Payment/"><img src="/resources/images/checkout_button.png" alt="Checkout" /></a>
		{else}
			<div style="position: relative;">
				{assign var=basedir value=$smarty.const.INCLUDE_PATH}
				{include file="$basedir/templates/form.tpl"}
			</div>

			{literal}
			<script type="text/javascript">
				jQuery('#shipping_postcode').validate();
			</script>
			{/literal}

		{/if}
	</div>
	
	<p class="checkout_note" style="margin: 40px 0 20px 0;">International orders may be subject to additional taxes, handling fees and duty charges that are outside of our control. For specific information for your intended shipping area, please consult with the local government import office.</p>
</div>
<div class="post_close"></div>
