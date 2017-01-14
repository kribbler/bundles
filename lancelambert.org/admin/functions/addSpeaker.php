<?php
	require_once('HTML/QuickForm.php');
	$form = new HTML_QuickForm('Create', 'post', 'speakers.php');
	
	
	require('assets/connectdb.php');
	$db_start = new PDO($dsn, $user, $password);
	$db_start->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	$opts = array('size' => 20, 'maxlength' => 255);
	$form->addElement('text', 'speaker', 'Speakers Name:', $opts);
	
	// This is for the speakers drop down select
	
	$form->addElement('submit', 'submit', 'Add Speaker');
	
	
	$form->addRule('speaker',
		'You must Enter a Speaker\'s Name.',
		'required', null
	);
	
	

	
	if ($form->validate()) {
		
		require('assets/connectdb.php');
		try {
			
			$db = new PDO($dsn, $user, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION);

			$speaker = $_POST['speaker'];
			

			
			$sql = 'INSERT INTO speakers ' .
				   '(speakerName) VALUES (:speaker)';

			$stmt = $db->prepare($sql);
			$stmt->bindParam(':speaker', $speaker);
			$stmt->execute();
		
		
			$form->removeElement('submit');
			$form->addElement('static', 'header', null, '<h3>Upload Complete</h3>');
			$form->freeze();
			$formsource = $form->toHtml();
		} catch (PDOException $e) {
				error_log('Submit Speaker Form Error: ' . $e->getMessage());
				$form->removeElement('submit');
				$form->addElement('static', 'header', null);
				$form->freeze();
				$formsource = $form->toHtml() . '<p>An Error occurred. The above information was not successfully submitted.  <br />' . $e->getMessage();	
		}
	} else {
		$formsource = $form->toHtml();
	}

	
?>