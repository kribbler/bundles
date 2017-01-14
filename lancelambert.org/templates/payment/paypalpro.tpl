{literal}
<style type="text/css">
.paypalpro input.text			{ width: 180px; }
.paypalpro select.countries		{ width: 160px; }
.paypalpro td.block				{ vertical-align: top;  }
label.error 					{ right: -30px; width: 80px; }
</style>
{/literal}

<div class="post">

	{if $payment_result}
		<h2>{$payment_result.L_SEVERITYCODE0}</h2>
		<div class="error">
			{$payment_result.L_SHORTMESSAGE0}<br />
			{$payment_result.L_LONGMESSAGE0}
		</div>

	{/if}

	{assign var=checkout_stage value=4}
	{include file=checkout/checkout_stages.tpl}

	<h2 class="title">{$lang->PLEASE_ENTER_YOUR_PAYMENT_DETAILS}</h2>

	<div style="border-bottom: 1px solid silver; margin: 20px 0;"></div>
	
	<div class="post_content">
		<p style="color: red; font-weight: bold;">All fields are mandatory.</p>
		<form method="post" action="/Payment/Paypalpro/" id="payment_form" class="paypalpro">
			<table class="ui-widget ui-widget-content ui-corner-all">
				<tr>
					<td valign="top" class="block">
						{* Personal details *}
						{include file="payment/paypalpro/personal_details.tpl"}

						{* Billing details *}
						{include file="payment/paypalpro/billing_address.tpl"}
					</td>

					<td valign="top" class="block">
						{* Payment details *}
						{include file="payment/paypalpro/payment_details.tpl"}
						
						{if !$smarty.const.PRODUCTION}
						<div>
							<label for="paypal_bypass">Paypal bypass</label>
							<input type="checkbox" id="paypal_bypass" name="paypal_bypass" value="1" />
						</div>
						{/if}
				
						<div>
							<div style="border-bottom: 1px solid silver; margin: 20px 0;"></div>
							<p>Your basket value is {$smarty.const.CURRENCY_SIGN}{$basket_total.value*$vat_multiply|string_format:"%.2f"}</p>
							<p>Shipping: {$smarty.const.CURRENCY_SIGN}{$shipping_rate*$vat_multiply|string_format:"%.2f"}</p>
							{if $tax_total}<p>State tax: {$smarty.const.CURRENCY_SIGN}{$tax_total|string_format:"%.2f"}</p>{/if}
							<p><h2>Total: {$smarty.const.CURRENCY_SIGN}{$shipping_rate+$basket_total.value+$tax_total|string_format:"%.2f"}</h2></p>

							<input type="submit" value="Pay" id="submit_button" class="button" style="margin: 40px 0 0 80px;" />
						</div>
					</td>
				</tr>
			</table>

		</form>
		
		<script type="text/javascript">{literal}
			jQuery('#payment_form').validate({
				submitHandler: function(form) {
					jQuery('#submit_button').attr('disabled','true');
					form.submit();
				}
			});
		{/literal}</script>
	</div>

	<p class="checkout_note" style="margin: 0 0 20px 0;">International orders may be subject to additional taxes, handling fees and duty charges that are outside of our control. For specific information for your intended shipping area, please consult with the local government import office.</p>


	<div class="basket">
		<h3>Your order:</h3>
		{include file="basket/basket-table.tpl"}
		<p>Shipping: {$smarty.const.CURRENCY_SIGN}{$shipping_rate*$vat_multiply|string_format:"%.2f"}</p>
		{if $tax_total}<p>State tax: {$smarty.const.CURRENCY_SIGN}{$tax_total}</p>{/if}
		<p><h2>Total: {$smarty.const.CURRENCY_SIGN}{$shipping_rate+$basket_total.value+$tax_total|string_format:"%.2f"}</h2></p>

	</div>
</div>
<div class="post_close"></div>
