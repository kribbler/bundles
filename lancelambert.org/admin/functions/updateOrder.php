<?php

	require('../assets/connectdb.php');
	try {
	
		$array = array();
		$arrayToBe = $_POST['data'];	
		parse_str($arrayToBe);
		
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		

			$orderid = 1;
			
			$listCount = count($lists);
			
			error_log("********************************");
			error_log("arrayToBe ----> " . $arrayToBe);
			error_log("********************************");
			
			error_log("________________________________");
			error_log("listCount ----> " . $listCount);
			error_log("________________________________");

			foreach($lists as $catid) {		
				$catid2 = (int) $catid;
				
				error_log("________________________________");
				error_log("Order id is ----> " . $orderid . " for Catid number ----> " . $catid2 . " the order requested is " . $lists[$catid]);
				error_log("________________________________");
				
				$sql = 'UPDATE subSections SET orderid=:orderid WHERE catid=:id';
				
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':orderid', $orderid);
				$stmt->bindParam(':id', $catid);
				$stmt->execute();
				$orderid++;
			}

/* 		} */
	} catch (PDOException $e) {
		error_log('Submit Speaker Form Error: ' . $e->getMessage());
	}
?>