<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>{if $title}{$title} | {/if}Lance Lambert</title>

	<link type="text/css" rel="stylesheet" href="/css/lance_lg.css" />
	<link type="text/css" rel="stylesheet" href="/css/lance.css" />
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

		$(document).ready(function()
			{ldelim}userNotification('{foreach from=$smarty.session.user_notification item=message}{assign var=notification_type value=$message.type}<p>{$message.text}</p>{/foreach}','{$notification_type}');{rdelim}

			$('#increasetextsize').click(function(){
				document.styleSheets[1].disabled=true;
				document.styleSheets[0].disabled=false;
			});

			$('#resettextsize').click(function(){
				document.styleSheets[1].disabled=false;
				document.styleSheets[0].disabled=true;
			});

		);
	</script>
	{/if}

</head>

<body>
  <div style="text-align: center;margin-top: -15px;margin-bottom: 25px;font-family: Arial, Helvetica, sans-serif;">
	<a href="http://livestream.com/accounts/1140382/events/4048279" target="_blank" style="color:#FFFFFF;border-bottom: 1px solid #919191;text-decoration: none;" onMouseOver="this.style.color='#669900'" onMouseOut="this.style.color='#FFFFFF'">View the May 27, 2015 Memorial Service for Lance</a>
  </div>
	<div id="user_notification" style="display: none;"><div id="user_notification_message"></div></div>
	<table class="secondaryTable" cellspacing="0" cellpadding="0" width="800" align="center" border="0">
		<tbody>
			<tr>
				<td>
					<img class="img-block" height="20" alt="" width="800" src="/media/spacer.gif" />
				</td>
			</tr>
			<tr>
				<td>
					<!-- div style="text-align: right; margin-right: 30px; font-size: 12px; width: 200px; float: right;">Text size: <a id="increasetextsize" href="#">Enlarge</a>&nbsp;&nbsp;&nbsp;<a id="resettextsize" href="#">Reset</a></div -->
					<img height="46" alt="" width="25" src="/media/spacer.gif" />
					<img height="46" alt="" width="374" src="/media/title.png" />
				</td>
			</tr>
			<tr>
				<td>
					<img class="img-block" height="5" alt="" width="800" src="/media/spacer.gif" />
				</td>
			</tr>
			<tr>
				<td>
					<div id="navbar"><img height="15" alt="" width="28" src="/media/spacer.gif" /><a href="/index.html">Home</a>&nbsp;&nbsp;&nbsp;<a href="/about.html">About</a>&nbsp;&nbsp;&nbsp;<a href="/products.php?Category_Id=1">Books</a>&nbsp;&nbsp;&nbsp;<a href="/audio.php">Audio</a>&nbsp;&nbsp;&nbsp;<a href="/products.php?Category_Id=2">Video</a>&nbsp;&nbsp;&nbsp;<a href="/middle-east-update.php">Middle East Update</a>&nbsp;&nbsp;&nbsp;<a href="/prophetic.php">Prophetic Messages</a>&nbsp;&nbsp;&nbsp;<a href="/contact.html">Contact Us</a>&nbsp;&nbsp;&nbsp;<a href="/resources.html">Resources</a></div>
				</td>
			</tr>
			<tr>
				<td>
					{$content}
				</td>
			</tr>
		</tbody>
	</table>
	<table cellspacing="0" cellpadding="0" width="800" align="center" border="0">
		<tbody>
			<tr>
				<td>
					<img class="img-block" height="15" alt="" width="800" src="/media/spacer.gif" />
				</td>
			</tr>
			<tr>
				<td>
					  <span class="copyright">
	&copy; 2007 - <script type='text/javascript'>var d = new Date; document.write(d.getFullYear());</script> Lance Lambert Ministries Inc. All rights reserved. 
	<a href="terms.php" style="color:#333333;">Terms of Use</a>
</span>
				</td>
			</tr>
		</tbody>
	</table>
<script type="text/javascript">{literal}(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-48849022-1', 'lancelambert.org');ga('send', 'pageview');{/literal}</script>
</body>
</html>
