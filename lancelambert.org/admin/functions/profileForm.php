<?php
	require_once('HTML/QuickForm.php');
	$form = new HTML_QuickForm('Create', 'post', 'profile.php');
	
	$id = $_COOKIE['id'];
	
	try {
		require('assets/connectdb.php');
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$sql = "SELECT * FROM users where id = :id ";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	
		$opts = array('size' => 20, 'maxlength' => 255);
		
		$form->addElement('static', 'username', '<b>Username:</b>', '<h4>Username:</h4>');
		$form->addElement('password', 'password', 'Password:', $opts);
		$form->addElement('text', 'name', 'Name:', $opts);
		$form->addElement('text', 'email', 'Email:', $opts);
		$form->addElement('hidden', 'id', $id);
		$form->addElement('submit', 'submit', 'Update Profile');
	
	
		
		
		$form->addRule('name',
			'You must enter an name',
			'required', null
		);
	
		$form->addRule('email',
			'You must enter an email',
			'required', null
		);
	
		$form->addRule('email',
			'You must enter a valid email',
			'email', null
		);
	
	
		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
	
			
			$user = array("name"=>$row[3],
			         	  "email"=>$row[4],
						  "username"=>$row[1]
			              );
			
			
		}

		$form->setDefaults($user);
		
		if ($form->validate()) {
		
		
			try {
				require('assets/connectdb.php');
				$db1 = new PDO($dsn, $user, $password);
				$db1->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);

				$name = $_POST['name'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$id = $_POST['id'];
				
				if(!$password) {
					$sql1 = 'UPDATE users SET name=:name, email=:email WHERE id=:id';
					$stmt1 = $db1->prepare($sql1);
					$stmt1->bindParam(':id', $id);
					$stmt1->bindParam(':name', $name);
					$stmt1->bindParam(':email', $email);
					$stmt1->execute();
				} else {
					$sql1 = 'UPDATE users SET name=:name,email=:email, password=:password WHERE id=:id';
					$stmt1 = $db1->prepare($sql1);
					$stmt1->bindParam(':id', $id);
					$stmt1->bindParam(':name', $name);
					$stmt1->bindParam(':email', $email);
					$stmt1->bindParam(':password', md5($password));
					$stmt1->execute();
				}
			
				

				
		
		
				$form->removeElement('submit');
				$form->addElement('static', 'header', null, '<h3>Edit Complete</h3>');
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
		error_log('Error in');
		$formsource = $form->toHtml();
		
	}
	
?>