<div class="post">
	{assign var=checkout_stage value=2}
	{include file=checkout/checkout_stages.tpl}


	<h1 class="title">Your details</h1>
	
	<table>
		<tr>
			<td class="top" style="width: 45%;">
			
				<div class="outer_box" style="min-height: 160px;">
					<h2><a href="/User/Login">1. Login to your account</a></h2>
					
					<form action="{$seourl->_("/User/Login")}" method="post" id="basket_login" style="position: relative;">
						<br />
						<table>
							<tr>
								<td><label for="username">Username</label></td>
								<td style="position: relative;"><input type="text" class="loginbox required" name="username" /></td>
							</tr>
							<tr>
								<td><label for="password">Password</label></td>
								<td style="position: relative;"><input type="password" class="loginbox required" name="password" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" class="submit" value="Login" /></td>
							</tr>
						</table>

					</form>
					
				</div>
			</td>
			<td class="top">
				<div class="outer_box" style="min-height: 160px;">

					<h2><a href="/User/Register/C">2. Register new account</a></h2>

					<h2><a href="/Shipping/">3. Skip registration</a></h2>

				</div>
			</td>
		</tr>
	</table>
	
	{literal}
	<script type="text/javascript">
		jQuery('#basket_login').validate();
	</script>
	{/literal}

	<div>
		<a href="/Payment/" title="Payment">Skip Registration and go to Payment page</a>
	</div>
	
</div>
<div class="post_close"></div>
