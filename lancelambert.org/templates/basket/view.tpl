<div class="basket post">
	
	{assign var=checkout_stage value=1}
	{include file=checkout/checkout_stages.tpl}

    <h2 class="title">Basket</h2>

	<div class="post_content">
		{if $basket}
		<form action="/Basket/Update/" method="post">
			<div>
			{assign var=basket_editable value=1}
			{include file="basket/basket-table.tpl"}

				<div>

					<div class="button" style="float: left;">
						<a href="/Basket/Wipe" onclick="return confirm('Do you really want to delete your basket?');">
							<button style="background: transparent url('/resources/icons/silk/cart_delete.png') center left no-repeat;">Delete basket</button>
						</a>
					</div>

					<div class="button" style="float: left; margin-left: 10px;">
						<center>
							<input type="submit" value="Update basket" style="background: transparent url('/resources/icons/silk/arrow_rotate_clockwise.png') center left no-repeat;" />
						</center>
					</div>

					<div style="width: 150px; float: right;">
						<a href="/Checkout/YourDetails/" title="Registartion">
							<img src="/resources/images/button_next.png" alt="Registration" />
						</a>
					</div>

					<div class="button" style="clear: both; padding-top: 20px;">
						<a href="{$seourl->_("/Category/Index/153/1")}">
							<button style="background: transparent url('') center left no-repeat;padding: 5px 20px;">Continue Shopping</button>
						</a>
					</div>

					<div style="clear: both;"></div>
				</div>
			</div>

		</form>
		{else}
			<div>Your basket is empty.</div>
		{/if}
	</div>
</div>
<div class="post_close"></div>
