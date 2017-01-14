<?php
	require_once('functions/emailFriend.php');
	
	// Get required variables
	$audioID = $_GET['id'];
	$warningMessage = $_GET['message'];
	$successMessage = $_GET['success'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Email a Friend</title>
	<link href="css/emailFriend.css" rel="Stylesheet" type="text/css" />
	
</head>

<body>

<div id="emailFriendContainer">
<h1>Email Your Friend</h1>
<p>Fill out the form below in order to send one of Lance Lambert's inspirational messages to one of your friends.</p>

<?php
if ($warningMessage) {
	echo '<p class="warning">'.$warningMessage.'</p>';
} elseif ($successMessage) {
	echo '<p class="success">'.$successMessage.'</p>';
}
	$emailForm = new EmailFriend();
	$emailForm->constructForm($audioID, $_GET["yourName"],$_GET["yourEmail"],$_GET["friendsName"],$_GET["friendsEmail"],$_GET["comments"]);

?>
</div>

</body>
</html>