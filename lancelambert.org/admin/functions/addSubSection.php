<?php
	require_once('HTML/QuickForm.php');
	$form = new HTML_QuickForm('Create', 'post', 'subSections.php');
	
	
	require('assets/connectdb.php');
	$db_start = new PDO($dsn, $user, $password);
	$db_start->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	$sql_section = "SELECT * FROM sections";
	$stmt_section = $db_start->prepare($sql_section);
	$stmt_section->execute();
	
	$sql_subSection = "SELECT MAX(orderid) FROM subSections";
	$stmt_subSection = $db_start->prepare($sql_subSection);
	$stmt_subSection->execute();
	
	$sql_subSection2 = "SELECT MAX(catid) FROM subSections";
	$stmt_subSection2 = $db_start->prepare($sql_subSection2 );
	$stmt_subSection2->execute();
	
	$subSectionResult1 = $stmt_subSection->fetch(PDO::FETCH_NUM);
	$subSectionResult2 = $stmt_subSection2->fetch(PDO::FETCH_NUM);
		
	$startNumCat = $subSectionResult2[0];
	$startNumOrd = $subSectionResult1[0];
	
	$startNumCat++;
	$startNumOrd++;
	
	/*
while($row3 = $stmt_subSection->fetch(PDO::FETCH_NUM)) {	
		$startNumCat = $row3[4];
		$startNumCat++;
		
		/*
$startNumOrd = $row3[3];
		$startNumOrd++;
*/
		
/* 	} */

/*
	
	while($row4 = $stmt_subSection2->fetch(PDO::FETCH_NUM)) {	
		
		$startNumOrd = $row4[3];
		$startNumOrd++;
		
	}
*/
	
	error_log("The new startNum is " . $startNum);
	
	$opts = array('size' => 20, 'maxlength' => 255);
	$form->addElement('text', 'subSection', 'Sub Section Name:', $opts);
	
	// This is for the section drop down select
	
	$a =& $form->createElement('select','section','Section: ');
	
	$opts2 = array();
	while($row2 = $stmt_section->fetch(PDO::FETCH_NUM)) {	
		$opts2[$row2[1]] = $row2[1];
		
	}
	
	$a->loadArray($opts2);
	$form->addElement($a);
	
	// This is for the section drop down select
	
	$columnPos =& $form->createElement('select','column','Column: ');
	
	$cols = array();
	$cols["left"] = "Left";
	$cols["right"] = "Right";	
	
	$columnPos->loadArray($cols);
	$form->addElement($columnPos);
	
	$form->addElement('submit', 'submit', 'Add Sub Section');
	
	
	$form->addRule('subSection',
		'You must Enter a Sub Section title.',
		'required', null
	);
	
	
	$form->addRule('section',
		'You must Enter select a section.',
		'required', null
	);
	
		
	if ($form->validate()) {
		
		require('assets/connectdb.php');
		try {
			
			$db = new PDO($dsn, $user, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION);

			$subSection = $_POST['subSection'];
			$section = $_POST['section'];
			$columnPos = $_POST['column'];
	
			$orderid = -1;
			
			echo $columnPos;
			
			$sql = 'INSERT INTO subSections ' .
				   '(subSection, section, orderid, catid, leftright) VALUES (:subSection, :section,:orderid, :catid, :columnPos)';

			$stmt = $db->prepare($sql);
			$stmt->bindParam(':subSection', $subSection);
			$stmt->bindParam(':section', $section);
			$stmt->bindParam(':orderid', $startNumOrd);
			$stmt->bindParam(':catid', $startNumCat);
			$stmt->bindParam(':columnPos', $columnPos);
			$stmt->execute();
		
		
			$form->removeElement('submit');
			$form->addElement('static', 'header', null, '<h3>Upload Complete</h3>');
			$form->freeze();
			$formsource = $form->toHtml();
		} catch (PDOException $e) {
				error_log('Submit Sub Section Form Error: ' . $e->getMessage());
				$form->removeElement('submit');
				$form->addElement('static', 'header', null);
				$form->freeze();
				$formsource = $form->toHtml() . '<p>An Error occurred. The above information was not successfully submitted.  <br />' . $e->getMessage();	
		}
	} else {
		$formsource = $form->toHtml();
	}

	
?>