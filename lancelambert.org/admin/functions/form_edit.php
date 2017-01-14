<?php
	require_once('HTML/QuickForm.php');
	$form = new HTML_QuickForm('Create', 'post', 'editAudio.php');
	
	$id = $_GET['id'];
	
	
	try {
		require('assets/connectdb.php');
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$sql = "SELECT * FROM audio where id = :id ";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		$sql_section = "SELECT * FROM sections";
		$stmt_section = $db->prepare($sql_section);
		$stmt_section->execute();

		$sql_speakers = "SELECT * FROM speakers";
		$stmt_speakers = $db->prepare($sql_speakers);
		$stmt_speakers->execute();
		
		$sql_subSection = "SELECT * FROM subSections";
		$stmt_subSection = $db->prepare($sql_subSection);
		$stmt_subSection->execute();


		// $i = 0;
		// 		while($row1 = $stmt_section->fetch(PDO::FETCH_NUM)) {	
		// 				$sections = array($i = $row1[1]);
		// 			$i++;
		// 		}
		// 
		// 		$r = 0;
		// 		while($row1 = $stmt_speakers->fetch(PDO::FETCH_NUM)) {	
		// 				$speakers = array($r = $row1[1]);
		// 			$r++;
		// 		}

	
		$opts = array('size' => 20, 'maxlength' => 255);
		$optsd = array('size' => 20, 'maxlength' => 255, "disabled" => true);
		$form->addElement('text', 'price', 'Price', $opts);
		$form->addElement('text', 'title', 'Title', $opts);
		$form->addElement('text', 'reference', 'Reference Number', $opts);
		$form->addElement('text', 'scripture', 'Scripture Reference', $opts);
		$form->addElement('text', 'scriptureLink', 'Scripture Link', $opts);
		$form->addElement('text', 'videoLink', 'Video Link', $opts);
		$form->addElement('text', 'pdf', 'PDF Title', $optsd);
		$form->addElement('text', 'additionalComments', 'Additional Comments', $opts);
		// $form->addElement('select', 'speakerName', 'Speaker', $speakers);
		// 		$form->addElement('select', 'section', 'Section', $sections);

		// This is for the speakers drop down select

		$s =& $form->createElement('select','speakerName','Speaker: ');

		$opts = array();
		while($row1 = $stmt_speakers->fetch(PDO::FETCH_NUM)) {	
			$opts[$row1[1]] = stripslashes($row1[1]);

		}

		$s->loadArray($opts);
		$form->addElement($s);

		// This is for the section drop down select

		$a =& $form->createElement('select','section','Section: ');

		$opts2 = array();
		while($row2 = $stmt_section->fetch(PDO::FETCH_NUM)) {	
			$opts2[$row2[1]] = stripslashes($row2[1]);

		}

		$a->loadArray($opts2);
		$form->addElement($a);
		
		// This is for the section drop down select

		$ss =& $form->createElement('select','subSection','Sub Section: ');

		$opts3 = array();
		while($row3 = $stmt_subSection->fetch(PDO::FETCH_NUM)) {	
			
			$opts3[$row3[1]] = stripslashes($row3[1]);
			
		}

		$ss->loadArray($opts3);
		$form->addElement($ss);
		
		/* 	divide here	 */

		$form->addElement('hidden', 'id', $id);
		$form->addElement('submit', 'submit', 'Edit Audio Entry');
	
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
			'You must enter a Sub Section',
			'required', null
		);
	
	
		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
	
			
			$user = array("price"=>$row[1],
			         		"title"=>$row[5],
			                "reference"=>$row[2],
							"id"=>$row[0],
							"scriptureLink"=>$row[3],
							"scripture"=>$row[4],
							"section"=>$row[7],
							"speakerName"=>$row[8],
							"subSection"=>$row[12],
							"videoLink"=>$row[9],
							"pdf"=>$row[10],
							"additionalComments"=>$row[11]
			                );
			
			
		}

		$form->setDefaults($user);

	
		if ($form->validate()) {
		
		
			try {
			
				$db1 = new PDO($dsn, $user, $password);
				$db1->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);

				$price = $_POST['price'];
				$title = $_POST['title'];
				$reference = $_POST['reference'];
				$url = $_POST['scriptureLink'];
				$scripture = $_POST['scripture'];
				$section = $_POST['section'];
				$speaker = $_POST['speakerName'];
				$subSection = stripslashes($_POST['subSection']);
				$videoLink = $_POST['videoLink'];
				$additionalComments = $_POST['additionalComments'];
				$id = $_POST['id'];
				
				$subSection = stripslashes($subSection);
			
				$sql1 = 'UPDATE audio SET price=:price,url=:url, reference=:reference, scripture=:scripture, speaker=:speakerName, section=:section, subSection=:subSection, title=:title, videolink=:videoLink, additionalcomments=:additionalComments, user=:user WHERE id=:id';

				$stmt1 = $db1->prepare($sql1);
				$stmt1->bindParam(':id', $id);
				$stmt1->bindParam(':price', $price);
				$stmt1->bindParam(':url', $url);
				$stmt1->bindParam(':reference', $reference);
				$stmt1->bindParam(':scripture', $scripture);
				$stmt1->bindParam(':title', $title);
				$stmt1->bindParam(':user', $_COOKIE['name']);
				$stmt1->bindParam(':section', $section);
				$stmt1->bindParam(':speakerName', $speaker);
				$stmt1->bindParam(':videoLink', $videoLink);
				$stmt1->bindParam(':additionalComments', $additionalComments);
				$stmt1->bindParam(':subSection', stripslashes($subSection));
				$stmt1->execute();
		
		
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
	} catch (PDOException $e) {
		error_log('Error in ' . $e->getFiles() .
			' Line: ' . $e->getLine() .
			' Error: ' . $e->getMessage()
		);
		
		
	}
	
?>