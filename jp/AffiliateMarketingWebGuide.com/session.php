<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
session_save_path('/var/lib/php/session');

if (!isset($_SESSION['counter']))
	$_SESSION['counter']=0;
echo "Вы обновили эту страницу ".$_SESSION['counter']++." раз. <br><a href='".$_SERVER['PHP_SELF']."'>обновить</a>";
echo "<br/>Сессия ".session_id()." берется из ".session_save_path();

?>