<?php

	require_once('connectdb.php');
	
	if ($_COOKIE['usrname']) {
		$username = $_COOKIE['usrname'];
	} else {
		header("Location:login.php");
	}
	
//	
	
	try {
		$dbh = new PDO($dsn, $user, $password);
		$sql = "SELECT * from users where username =:username";
		$dbh->setAttribute(PDO::ATTR_ERRMODE,
			PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			setcookie("name", $row['name'], time() + 3600 * 24 * 256, '/', $_SERVER[ 'SERVER_NAME' ]);
			setcookie("email", $row['email'], time() + 3600 * 24 * 256, '/', $_SERVER[ 'SERVER_NAME' ]);
			setcookie("username", $row['username'], time() + 3600 * 24 * 256,'/', $_SERVER[ 'SERVER_NAME' ]);
			setcookie("id", $row['id'], time() + 3600 * 24 * 256,'/', $_SERVER[ 'SERVER_NAME' ]);
			
		}

		if( $_COOKIE[ 'username' ] == 'lanceministry' )
		{
			header( 'Location: /admin-middle-east-update.php' );
			exit;
		}
	}
	catch (PDOException $e) {
		echo 'PDO Exception caught . ';
		echo 'Error with the database: <br />';
		echo 'SQL Query: ',  $sql;
		echo 'Error: ' . $e->getMessage();
	}
	
?>
