<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>{if $title}{$title} | {/if}Lance Lambert</title>

	<link rel="stylesheet" href="/admin/style/css.css" type="text/css" media="screen" />
	<!-- link rel="stylesheet" type="text/css" href="print.css" media="print" / -->
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	{foreach from=$styles item=style}
		<link rel="stylesheet" href="{$style}" type="text/css" />
	{/foreach}

	{foreach from=$metas item=meta}
		<meta name="{$meta.name}" content="{$meta.content|truncate:'255':''}" />
	{/foreach}

	<link rel="shortcut icon" type="image/png" href="/resources/images/favicon.ico" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	{foreach from=$scripts item=script}
		<script type="text/javascript" src="{$script}"></script>
	{/foreach}

	{if $lightbox}
		<script type="text/javascript" src="/resources/js/jquery.lightbox-0.5.js"></script>
		<link href="/resources/css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		$(function() {
			$("a.thickbox").lightBox({
				imageLoading: '/resources/images/lightbox-ico-loading.gif',
				imageBtnClose: '/resources/images/lightbox-btn-close.gif',
				imageBtnPrev: '/resources/images/lightbox-btn-prev.gif',
				imageBtnNext: '/resources/images/lightbox-btn-next.gif',
				containerResizeSpeed: 350,
				fixedNavigation:true
			});
		});
	</script>
	{/if}

	{if $tiny_mce}
		<script type="text/javascript" src="/resources/js/tiny_mce/tiny_mce.js"></script>
	{/if}

	{if $smarty.session.user_notification}
	<script type="text/javascript">
		function userNotification(message,type)
		{
			jQuery("#user_notification").addClass(type);
			jQuery("#user_notification_message").html(message);
			jQuery("#user_notification").show('slow');
			setTimeout("$('#user_notification').hide('slow');", 10000);
		}

		$(document).ready(function(){ldelim}userNotification('{foreach from=$smarty.session.user_notification item=message}{assign var=notification_type value=$message.type}<p>{$message.text}</p>{/foreach}','{$notification_type}');{rdelim});
	</script>
	{/if}

</head>

<body>
	<div onclick="$('#user_notification').hide('slow')" class="user_notification" id="user_notification" title="User notification" style="display: none;">
		<div id="user_notification_message"></div>
	</div>

	<div id="container">
		<div id="header">
			<div id="logo"></div>
			<div id="loggedIn">
				<p>You are logged in as <a href="/admin/profile.php">{$smarty.cookies.usrname}</a>	|	<a href="/admin/logout.php">Log Out</a></p>
			</div>
		</div>

		<div id="nav">
			<div id="leftNavBar"></div>
			<ul>
				{if $smarty.cookies.username != 'lanceministry'}
				<li><a href="/admin/index.php">Dashboard</a></li>
				<li><a href="/admin/audio.php?p=">Audio</a></li>
				<li><a href="/admin/speakers.php">Speakers</a></li>

				<li><a href="/admin/subSections.php">Sub Sections</a></li>
				<li><a href="/admin/profile.php">Profile</a></li>
				{/if}
				<li class="last"><a href="/admin-middle-east-update.php">Middle East Update</a></li>
			</ul>
			<div id="rightNavBar"></div>
		</div>

		<div id="content">
			<div class="submenux">
				<ul>
					<li>Submenu:</li>
					<li><a href="/admin-middle-east-update.php/files">Files</a> / <a href="/admin-middle-east-update.php/file-edit">New file</a></li>
					<li><a href="/admin-middle-east-update.php/messages">Messages</a> / <a href="/admin-middle-east-update.php/message-edit">New message</a></li>
					<li><a href="/admin-middle-east-update.php/about">About Middle East</a></li>
					<li><a href="/admin-middle-east-update.php/training">Training Video</a></li>
				</ul>
			</div>

			<div style="clear: both;">{$content}</div>

		</div>

		<div id="footer"></div>
	</div>


</body>
</html>
