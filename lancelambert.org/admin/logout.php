<?php

	setcookie("usrname", "", time()-3600, '/', $_SERVER[ 'SERVER_NAME' ]);
	header("Location:login.php");

?>
