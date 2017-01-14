<?php
	require_once('HTML/QuickForm.php');
	$form = new HTML_QuickForm('Create', 'post', 'login.php');
	
	$id = $_COOKIE['id'];
	
	try {
		
	
		$opts = array('size' => 20, 'maxlength' => 255);
		
		$form->addElement('text', 'username', 'Username:', $opts);
		$form->addElement('password', 'password', 'Password:', $opts);
		$form->addElement('submit', 'submit', 'Login');
	
	
		
		
		$form->addRule('username',
			'You must enter a username',
			'required', null
		);
	
		$form->addRule('password',
			'You must enter your password',
			'required', null
		);

		
		if ($form->validate()) {
		
		
			try {
				require('assets/connectdb.php');
				$db1 = new PDO($dsn, $user, $password);
				$db1->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);

				$name = $_POST['username'];
				$pwd = md5($_POST['password']);

				
				
				$sql1 = 'SELECT * FROM users';
				$stmt1 = $db1->prepare($sql1);
				$stmt1->execute();
				
				
				while($row = $stmt1->fetch(PDO::FETCH_NUM)) {
				
				if($name == $row[1]) {
					if ($pwd == $row[2]) {
						setcookie( 'usrname', $row['1'], time() + 60 * 60 * 24 * 1365, '/', $_SERVER[ 'SERVER_NAME' ] );
						header("Location:index.php");
					}
				}	
				}
			
				

				
		
		
				$form->addElement('static', 'header', null, 'Username and Password do not match. Please try again.');
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
