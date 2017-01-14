<?php
	require_once('HTML/QuickForm.php');
	$form = new HTML_QuickForm('Create', 'post', 'audio.php?p=');
	
	
	require('assets/connectdb.php');
	$db_start = new PDO($dsn, $user, $password);
	$db_start->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql_section = "SELECT * FROM sections";
	$stmt_section = $db_start->prepare($sql_section);
	$stmt_section->execute();
	
	$sql_subSection = "SELECT * FROM subSections";
	$stmt_subSection = $db_start->prepare($sql_subSection);
	$stmt_subSection->execute();
	
	$sql_speakers = "SELECT * FROM speakers";
	$stmt_speakers = $db_start->prepare($sql_speakers);
	$stmt_speakers->execute();
	
	
	$opts = array('size' => 20, 'maxlength' => 255);
	$form->addElement('text', 'price', 'Price', $opts);
	$form->addElement('text', 'title', 'Title', $opts);
	$form->addElement('text', 'reference', 'Reference Number', $opts);
	$form->addElement('text', 'scripture', 'Scripture Reference', $opts);
	$form->addElement('text', 'scriptureLink', 'Scripture Link', $opts);
	$form->addElement('text', 'videoLink', 'Video Link', $opts);
	$form->addElement('text', 'additionalComments', 'Additional Comments', $opts);
	
	// This is for the speakers drop down select
	
	$s =& $form->createElement('select','speakerName','Speaker: ');
	
	$opts = array();
	while($row1 = $stmt_speakers->fetch(PDO::FETCH_NUM)) {	
		$opts[$row1[1]] = $row1[1];
		
	}
	
	$s->loadArray($opts);
	$form->addElement($s);
	
	// This is for the section drop down select
	
	$a =& $form->createElement('select','section','Section: ');
	
	$opts2 = array();
	while($row2 = $stmt_section->fetch(PDO::FETCH_NUM)) {	
		$opts2[$row2[1]] = $row2[1];
		
	}
	
	$a->loadArray($opts2);
	$form->addElement($a);
	
	// This is for the sub sections drop down select
	
	$c =& $form->createElement('select','subSection','Sub Section: ');
	
	$opts3 = array();
	while($row3 = $stmt_subSection->fetch(PDO::FETCH_NUM)) {	
		$opts3[$row3[1]] = $row3[1];
		
	}
	
	$c->loadArray($opts3);
	$form->addElement($c);
	
	$form->addElement('submit', 'submit', 'Add Audio File');
	
	
/*
	$form->addRule('price',
		'You must Enter a price',
		'required', null
	);
*/
	
	$form->addRule('title',
		'You must enter a Title',
		'required', null
	);
	
	$form->addRule('reference',
		'You must enter a Reference Number',
		'required', null
	);
	
	/*
$form->addRule('scripture',
		'You must enter a Scripture Reference',
		'required', null
	);
	
	$form->addRule('scriptureLink',
		'You must enter a Scripture Link',
		'required', null
	);
*/
	
	$form->addRule('speakerName',
		'You must enter a Speakers Name',
		'required', null
	);
	
	$form->addRule('section',
		'You must enter a section',
		'required', null
	);
	
	$form->addRule('subSection',
		'You must select a Sub Section',
		'required', null
	);

	
	if ($form->validate()) {
		
		require('assets/connectdb.php');
		try {
			
			$db = new PDO($dsn, $user, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION);

			$price = $_POST['price'];
			$descript = $_POST['description'];
			$title = $_POST['title'];
			$reference = $_POST['reference'];
			$url = $_POST['scriptureLink'];
			$scripture = $_POST['scripture'];
			$section = $_POST['section'];
			$speaker = $_POST['speakerName'];
			$subSection = $_POST['subSection'];
			$videoLink = $_POST['videoLink'];
			$additionalComments = $_POST['additionalComments'];
			$request = "disable";
			

			
			$sql = 'INSERT INTO audio ' .
				   '(price,url, reference, scripture, title, user, section, speaker, subSection, request, videolink, additionalcomments ) VALUES (:price, :url, :reference, :scripture, :title, :user, :section, :speaker, :subSection, :request, :videoLink, :additionalComments)';

			$stmt = $db->prepare($sql);
			$stmt->bindParam(':price', $price);
			$stmt->bindParam(':url', $url);
			$stmt->bindParam(':reference', $reference);
			$stmt->bindParam(':scripture', $scripture);
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':user', $_COOKIE['name']);
			$stmt->bindParam(':section', $section);
			$stmt->bindParam(':speaker', $speaker);
			$stmt->bindParam(':subSection', $subSection);
			$stmt->bindParam(':videoLink', $videoLink);
			$stmt->bindParam(':additionalComments', $additionalComments);
			$stmt->bindParam(':request', $request);
			$stmt->execute();
		
		
			$form->removeElement('audio');
			$form->removeElement('submit');
			$form->addElement('static', 'header', null, '<h3>Upload Complete</h3>');
			$form->freeze();
			$formsource = $form->toHtml();
		} catch (PDOException $e) {
				error_log('Submit Audio File Form Error: ' . $e->getMessage());
				$form->removeElement('audio');
				$form->removeElement('submit');
				$form->addElement('static', 'header', null);
				$form->freeze();
				$formsource = $form->toHtml() . '<p>An Error occurred. The above information was not successfully submitted.  <br />' . $e->getMessage();	
		}
	} else {
		$formsource = $form->toHtml();
	}

	
?>