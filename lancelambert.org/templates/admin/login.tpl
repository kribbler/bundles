<center>
	<div class="login_box">
		<h1 class="admin_heading">Administrator Panel</h1>
		
		<div class="login_lock">
			<img src="/resources/images/admin/j_login_lock.jpg" alt="" />
		</div>
		
		<div class="login_form">

			<form action="/Admin/Login" method="post">
				<div>
					<label>Username</label>
					<br />
					<input type="text" name="username" id="username" class="textinput" maxlength="40" />
				</div>

				<div>
					<label>Password</label>
					<br />
					<input type="password" name="password" id="password" class="textinput" maxlength="40" />
				</div>

				<div>
					<input type="submit" value="Login" class="submit" />
				</div>
			</form>
		</div>
		<div style="clear: both"></div>
	</div>
</center>
