<?php

	$request = $_GET['request'];
	$id = $_GET['id'];
	$pageID = $_GET['pageNum'];
	
/* 	echo $request; */
	
	if ($request == "enable" || $request == "disable") {
		try {
			require('assets/connectdb.php');
			$db = new PDO($dsn, $user, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "UPDATE audio SET request=:request where id = :id ";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->bindParam(':request', $request);
			$stmt->execute();
			
			header("Location:audio.php?p=".$pageNum."&deleteSuccessful=Message has been ".$request."d.");
		
		} catch (PDOException $e) {
			error_log('Error in ' . $e->getFiles() .
				' Line: ' . $e->getLine() .
				' Error: ' . $e->getMessage()
			);
			
		}
	}
?>