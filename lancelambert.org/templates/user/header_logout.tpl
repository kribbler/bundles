<div id="login_box">
	<div id="logout">
		<form action="/User/Logout" method="post" name="login">
			<input name="Submit" class="logout_button" value="{$lang->BUTTON_LOGOUT}" style="border: medium none ; background: rgb(255, 255, 255) url('/resources/images/button.png') no-repeat scroll left bottom; width: 60px; height: 25px; font-size: 13px;" type="submit" />
			<div class="greetings">{$lang->YOU_ARE_LOGGED} {$logged_user->username} !</div>
			<ul>
				<li>
					<a href="/User/Account">
						{$lang->ACCOUNT_TITLE}
					</a>
				</li>

				<li>
					<a href="/Download/">{$lang->DOWNLOADS_TITLE}</a>
				</li>
				
				{if $logged_user->HasRole('vendor')}
				<li>
					<a class="" href="/VendorAdmin/">
						{$lang->SHOP_ADMINISTRATION}
					</a>
				</li>
				{else}
				<li>
					<a class="" href="/VendorRegistration/">
						{$lang->BUSINESS_REGISTRATION}
					</a>
				</li>

				{/if}

				{if $logged_user->HasRole('admin')}
				<li>
					<a class="" href="/Admin/">
						{$lang->SITE_ADMINISTRATION}
					</a>
				</li>
				{/if}
			</ul>

		</form>
	</div>

</div>
