<?php
	// Call Required Files
	require_once ('functions/emailFriend.php');
	
	// Set Variables
	$name = $_POST['yourName'];
	$email = $_POST['yourEmail'];
	$friendName = $_POST['friendName'];
	$friendEmail = $_POST['friendEmail'];
	$comments = $_POST['comments'];
	$audioID = $_POST['id'];
	
	$potentialReturn = "yourName=".$name."&yourEmail=".$email."&friendsName=".$friendName."&friendsEmail=".$friendEmail."&comments=".$comments;
		
	$emailFriend = new EmailFriend();
	$message = $emailFriend->validateForm($name,$email,$friendName,$friendEmail,$comments);
	
	if ($message) {
		header("Location:sendEmailToFriend.php?id=".$audioID."&".$potentialReturn."&message=".$message."");
	} else {
		$formReturn = $emailFriend->emailFriend($name,$email,$friendName,$friendEmail,$comments,$audioID);
		
		if ($formReturn == "Mail could not be sent. Sorry.") {
			header("Location:sendEmailToFriend.php?id=".$audioID."&".$potentialReturn."&message=".$formReturn."");
		} else {
			header("Location:sendEmailToFriend.php?id=".$audioID."&success=".$formReturn."");
		}
	}
	
?>