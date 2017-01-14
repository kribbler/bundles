<?php
	require_once('HTML/QuickForm.php');
	$form = new HTML_QuickForm('Create', 'post', 'editSpeaker.php');
	
	$id = $_GET['id'];
	
	
	try {
		require('assets/connectdb.php');
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$sql = "SELECT * FROM speakers where id = :id ";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();


	
		$opts = array('size' => 20, 'maxlength' => 255);
		$form->addElement('text', 'speaker', 'Speakers Name:', $opts);
		$form->addElement('hidden', 'id', $id);
		$form->addElement('submit', 'submit', 'Edit Speakers Name');
	
	
		$form->addRule('speaker',
			'You must enter a speakers name',
			'required', null
		);
	
	
		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
	
			
			$user = array("speaker"=>$row[1]
			                );
			
			
		}

		$form->setDefaults($user);

	
		if ($form->validate()) {
		
		
			try {
			
				$db1 = new PDO($dsn, $user, $password);
				$db1->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);

				$speaker = $_POST['speaker'];
				$id = $_POST['id'];

			
				$sql1 = 'UPDATE speakers SET speakerName=:speaker WHERE id=:id';

				$stmt1 = $db1->prepare($sql1);
				$stmt1->bindParam(':id', $id);
				$stmt1->bindParam(':speaker', $speaker);
				$stmt1->execute();
		
		
				$form->removeElement('submit');
				$form->addElement('static', 'header', null, '<h3>Upload Complete</h3>');
				$form->freeze();
				$formsource = $form->toHtml();
			} catch (PDOException $e) {
				error_log('Submit Speakers Name Form Error: ' . $e->getMessage());
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