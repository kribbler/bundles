<div id="login_box">

	<div id="login">
		<form action="/User/Login" method="post">
			
			<div class="login_username">
				<div class="input">
					<input id="username" class="inputbox" maxlength="12" style="width: 90px;" name="username" type="text" />
				</div>
				<div class="label" style="">{$lang->USERNAME} {$lang->OR} {$lang->EMAIL}</div>
				<div class="link_below">

				</div>
			</div>

			<div class="login_password">
				<div class="input">
					<input style="width: 90px;" id="password" maxlength="12" name="password" type="password" />
				</div>
				<div class="label">{$lang->PASSWORD}</div>
				<div class="link_below">
					<a href="/User/LostPassword" title="Lost password">{$lang->LOST_PASSWORD}</a>
				</div>
			</div>

			<div class="login_submit">
				<div class="remember_me">
					<label for="remember_login">{$lang->REMEMBER_ME}</label>
					<input name="rememberme" id="remember_login" value="yes" checked="checked" style="margin-bottom: -10px;" type="checkbox" />
				</div>
				<div class="submit">
					<input value="{$lang->BUTTON_LOGIN}" name="Login" style="border: medium none ; margin: 0pt; padding: 0pt; background: rgb(255, 255, 255) url('/resources/images/button.png') no-repeat scroll left bottom; width: 60px; height: 23px; font-size: 13px;" type="submit" /></div>

				<div class="link_below">
					<a href="/User/Register" title="Register">{$lang->NO_ACCOUNT} {$lang->REGISTER}.</a>
				</div>
			</div>

		</form>

	</div>

</div>

