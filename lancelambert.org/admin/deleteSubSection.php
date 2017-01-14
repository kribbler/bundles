<?php

	$delete = $_GET['delete'];
	$id = $_GET['id'];
	
	if ($delete == "yes") {
		
		try {
			require('assets/connectdb.php');
			$db = new PDO($dsn, $user, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "DELETE FROM subSections where id = :id ";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			header("Location:subSections.php?p=1&deleteSuccessful=Speaker has been deleted.");
		
		} catch (PDOException $e) {
			error_log('Error in ' . $e->getFiles() .
				' Line: ' . $e->getLine() .
				' Error: ' . $e->getMessage()
			);
			
		}
	}
?>