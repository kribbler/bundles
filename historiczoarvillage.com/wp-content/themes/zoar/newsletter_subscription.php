<?php

@session_start();

include('../../../wp-load.php');

/*define('DB_SERVER', 'mysqlv111');
define('DB_USERNAME', 'eppingwell');
define('DB_PASSWORD', 'Admin321!');
define('DB_DATABASE', 'eppingwell');

$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die('Oops connection error -> ' . mysql_error());
mysql_select_db(DB_DATABASE, $connection) or die('Database error -> ' . mysql_error());*/
$ROOT='http://'.$_SERVER['SERVER_NAME']."/";

//--------------------------------------------------------------------------------------------------------------------------
if($_REQUEST)
{
	extract ($_REQUEST);
}
if(isset($_POST['next'])=="Sign Up")
{
	$app="INSERT INTO user 
	(name, subscribe, address, address1, city, state, zip_code, email)
	 Values ('$name', '$subscribe', '$address', '$address1', '$city', '$state', '$zip_code', '$email') ";
	$appRes=mysql_query($app);
		
		if($appRes)
		{
			echo '<script>window.location.href="'.get_bloginfo('url').'/contact/?thanks=1"</script>';
		}
		else
		{
			echo '<script>window.location.href="'.get_bloginfo('url').'/contact/?sorry=0"</script>';
		}
	
}

?>