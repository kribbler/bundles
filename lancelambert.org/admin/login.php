<?php
	if ($_COOKIE['usrname']) {
		$username = $_COOKIE['usrname'];
		header("Location:index.php");
	}
	require_once('functions/loginForm.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Lance Lambert - Content Management System</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Andrew Kelly">
	<link rel="stylesheet" href="style/css.css" type="text/css" media="screen" />    
	<!-- Date: 2009-05-15 -->
</head>
<body>

<div id="container">
	<div id="header">
		<div id="logo"></div>
		<div id="loggedIn">
			<p>You are not currently logged in.</p>
		</div>
	</div>
	
	<div id="nav">
		<div id="leftNavBar"></div>
		<ul>
			<li class="last">&nbsp;</li>
		</ul>
		<div id="rightNavBar"></div>
	</div>
	
	<div id="content">
		



				<h2>Log In</h2>
				<?php
					echo $formsource;
				?>
	<?php
	
		include('includes/footer.php');
		
	?>
