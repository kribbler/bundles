
<table class="checkout_stages">
	<tr>
		<td{if $checkout_stage<2} class="selected">1. Basket{else}>1. <a href="/Basket/">Basket</a>{/if}</td>
		<td{if $checkout_stage==2} class="selected">2. Registration{else}>2. <a href="/Checkout/YourDetails/">Registration</a>{/if}</td>
		<td{if $checkout_stage==3} class="selected">3. Delivery method{else}>3. <a href="/Shipping/">Delivery method</a>{/if}</td>
		<td{if $checkout_stage==4} class="selected">4. Payment{else}>4. <a href="/Payment/">Payment</a>{/if}</td>
	</tr>
</table>
