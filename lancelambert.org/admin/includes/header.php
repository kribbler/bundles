<?php
	require_once('assets/admin.php');

	if( $_COOKIE[ 'username' ] == 'lanceministry' || $_COOKIE[ 'usrname' ] == 'lanceministry' )
	{
		header( 'Location: /admin-middle-east-update.php' );
		exit;
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Lance Lambert - Content Management System</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Andrew Kelly">
	<link rel="stylesheet" href="style/css.css" type="text/css" media="screen" />  
	
	<script src="js/prototype.js" type="text/javascript"></script>
  	<script src="js/scriptaculous.js" type="text/javascript"></script>

	<!-- Date: 2009-05-15 -->
</head>
<body>

<div id="container">
	<div id="header">
		<div id="logo"></div>
		<div id="loggedIn">
			<p>You are logged in as <a href="profile.php"><?=$_COOKIE['name'] ?></a>   |   <a href="logout.php">Log Out</a></p>
		</div>
	</div>
	
	<div id="nav">
		<div id="leftNavBar"></div>
		<ul>
			<li><a href="index.php">Dashboard</a></li>
			<li><a href="audio.php?p=">Audio</a></li>
			<li><a href="speakers.php">Speakers</a></li>
			<li><a href="subSections.php">Sub Sections</a></li>
			<li><a href="profile.php">Profile</a></li>
			<li class="last"><a href="/admin-middle-east-update.php">Middle East Update</a></li>
		</ul>
		<div id="rightNavBar"></div>
	</div>
	
	<div id="content">
