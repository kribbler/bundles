<div id="main" class="middle-east-update">
	<hr color="#999999" size="1" width="100%">

	<h2>Buy File</h2>

	<p>You should automatically be redirected to PayPal in a few seconds to complete your payment.</p>

	<form action="https://www.{if not $smarty.const.PRODUCTION}sandbox.{/if}paypal.com/uk/cgi-bin/webscr" method="post" id="paypalForm">
		<div>
			<input name="cmd" value="_cart" type="hidden" />

			<input name="upload" value="1" type="hidden" />
			<input name="business" value="{$smarty.const.PAYPAL_ACCOUNT_EMAIL}" type="hidden" />
			<input name="currency_code" value="{$smarty.const.PAYPAL_CURRENCY_CODE}" type="hidden" />
			<input name="cancel_return" value="http://{$smarty.server.SERVER_NAME}/middle-east-update.php" type="hidden" />
			<input name="cbt" value="Continue" type="hidden" />
			<input name="notify_url" value="http://{$smarty.server.SERVER_NAME}/middle-east-update.php/ipn/{$smarty.cookies.customer_id}/{$message->id}" type="hidden" />
			<input name="return" value="http://{$smarty.server.SERVER_NAME}/middle-east-update.php/my-downloads/" type="hidden" />
			<input name="rm" value="2" type="hidden" />
			<input name="cbt" value="Continue to download page" type="hidden" />

			<input name="item_name_1" value="Middle East Update: {$message->getYear()}-{$message->getMonth()} - media version" type="hidden" />
			<input name="quantity_1" value="1" type="hidden" />
			<input name="amount_1" value="{$message->price|string_format:"%.2f"}" type="hidden" />
			<input name="tax_rate_1" value="0" type="hidden" />

			<p>If you are not redirected automatically <a href="#" onclick="jQuery('#paypalForm').submit(); return false;">click here</a></p>

		</div>
	</form>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#main').find('form').submit();
});
</script>
