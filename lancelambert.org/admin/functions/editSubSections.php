<?php
	require_once('HTML/QuickForm.php');
	$form = new HTML_QuickForm('Create', 'post', 'editSubSections.php');
	
	$id = $_GET['id'];
	
	
	try {
		require('assets/connectdb.php');
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		

	
		$sql = "SELECT * FROM subSections where id = :id ORDER BY id ASC";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		$sql_section = "SELECT * FROM sections";
		$stmt_section = $db->prepare($sql_section);
		$stmt_section->execute();
		
		$opts = array('size' => 20, 'maxlength' => 255);
		$form->addElement('text', 'subSection', 'Sub Section Title:', $opts);
		
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

		
		$form->addElement('hidden', 'id', $id);
		$form->addElement('submit', 'submit', 'Edit Sub Section Title');
	
	
		$form->addRule('subSection',
			'You must enter a Sub Section Title',
			'required', null
		);
		
		$form->addRule('section',
			'You must select a section.',
			'required', null
		);
	
		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
	
			
			$user = array("subSection"=>$row[1],
							"section"=>$row[2],
							"column"=>$row[5]
			                );
			
			
		}

		$form->setDefaults($user);

	
		if ($form->validate()) {
		
		
			try {
			
				$db1 = new PDO($dsn, $user, $password);
				$db1->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);

				$subSection = $_POST['subSection'];
				$section = $_POST['section'];
				$columnPos = $_POST['column'];
				$id = $_POST['id'];

			
				$sql1 = 'UPDATE subSections SET subSection=:subSection, section=:section, leftright=:columnPos WHERE id=:id';

				$stmt1 = $db1->prepare($sql1);
				$stmt1->bindParam(':id', $id);
				$stmt1->bindParam(':section', $section);
				$stmt1->bindParam(':subSection', $subSection);
				$stmt1->bindParam(':columnPos', $columnPos);
				$stmt1->execute();
		
		
				$form->removeElement('submit');
				$form->addElement('static', 'header', null, '<h3>Upload Complete</h3>');
				$form->freeze();
				$formsource = $form->toHtml();
			} catch (PDOException $e) {
				error_log('Submit Sub Sections Form Error: ' . $e->getMessage());
				$form->removeElement('submit');
				$form->addElement('static', 'header', null);
				$form->freeze();
				$formsource = $form->toHtml() . '<p>An Error occurred. The above information was not successfully submitted.  <br />' . $e->getMessage();	
			}
		} else {
			$formsource = $form->toHtml();
		}
	} catch (PDOException $e) {
		error_log('Error in ' . $e->getFiles() .
			' Line: ' . $e->getLine() .
			' Error: ' . $e->getMessage()
		);
		
		
	}
	
?>