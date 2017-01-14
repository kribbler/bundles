<?php
	class EmailFriend {
	
	function __construct() {
		// If anything needs to occur right away I'll set that up here.
	}
	
	function constructForm($id, $yName, $yEmail, $fName, $fEmail, $comments) {
	
		echo '
			<form name="emailFriend" id="emailFriend" action="sendToFriend.php" method="POST">
			<ul>
				<li><label for="yourName">Your Name:</label><input type="text" id="yourName" name="yourName" value="'.$yName.'" /></li>
				<li><label for="yourEmail">Your Email:</label><input type="text" id="yourEmail" name="yourEmail" value="'.$yEmail.'" /></li>
				<li><label for="friendName">Friend\'s Name:</label><input type="text" id="friendName" name="friendName" value="'.$fName.'" /></li>
				<li><label for="friendEmail">Friend\'s Email:</label><input type="text" id="friendEmail" name="friendEmail" value="'.$fEmail.'" /></li>
		';
		
		if ($comments) {
			echo '<li><label for="comments">Comments:</label><textarea name="comments" id="comments">'.$comments.'</textarea></li>';
		} else {
			echo '<li><label for="comments">Comments:</label><textarea name="comments" id="comments">This is an excellent message by Lance Lambert that i thought you would enjoy.</textarea></li>';
		}
				
		echo '	
				
				<li><input type="submit" name="submit" id="submit" value="Email Friend">
			</ul>
			<input type="hidden" name="id" id="id" value="'.$id.'" />
			</form>
		';
	
	}
	
	
	function validateForm($yourName, $yourEmail, $friendName, $friendEmail, $comments) {
		
		if (!$yourName) {
			$message="You must enter your name.";
		} elseif(!$yourEmail) {
			$message="You must enter your email";
		} elseif (!preg_match( "/^[\d\w\/+!=#|$?%{^&}*`'~-][\d\w\/\.+!=#|$?%{^&}*`'~-]*@[A-Z0-9][A-Z0-9.-]{1,61}[A-Z0-9]\.[A-Z]{2,6}$/ix", $yourEmail)) {
			$message = "You must enter a valid email for yourself.";
		} elseif (!$friendName) {
			$message="You must enter your friends name";
		} elseif(!$friendEmail) {
			$message="You must enter your friends email";
		} elseif (!preg_match( "/^[\d\w\/+!=#|$?%{^&}*`'~-][\d\w\/\.+!=#|$?%{^&}*`'~-]*@[A-Z0-9][A-Z0-9.-]{1,61}[A-Z0-9]\.[A-Z]{2,6}$/ix", $friendEmail)) {
			$message = "You must enter a valid email for your friend.";
		} elseif (!$comments) {
			$message = "Please enter some comments for your friend to read.";
		}
		
		return $message;
		
	}
	
	function emailFriend($yourName, $yourEmail, $friendName, $friendEmail, $comments, $id) {
	
	
		$to = $friendEmail;
		$from = $yourName . "<".$yourEmail.">";
		$subject = $yourName . " thought you might like to see this";
		$messages = $comments;
		$messages .= "<br /> <a href='http://lancelambert.org/viewAudio.php?id=".$id."'>Click Here to enjoy the message.</a>";
		
		$headers = "From: " . $from . "\r\n";
		
		// Now we specify our MIME version
	    $headers .= "MIME-Version: 1.0\r\n"; 
	
		// Create a boundary so we know where to look for
		// the start of the data
	
	    
	    $headers .= "Content-type: text/html\r\n"; 
                
		 
		$ok = @mail($to, $subject, $messages, $headers); 
		if ($ok) {
			 $this->formReturn = "You have successfully mailed your comments.";
		} else {
			 $this->formReturn .= "Mail could not be sent. Sorry.";
		} 
		
		return $this->formReturn;
	
	
	}
	
	}
?>