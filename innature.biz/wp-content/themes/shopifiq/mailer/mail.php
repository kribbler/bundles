<?php 


     $to    =   $_POST['envoo-admin-mail'];    //your e-mail to which the message will be sent
     $from  =   $_POST['envoo-admin-mail'];        //e-mail address from which the e-mail will be sent
     
     $subject_contact_us  =  'Someone has sent you a message!';   //subject of the e-mail for the form on contact-us.html
     $subject_follow_us   =  'I want to follow you';       //subject of the e-mail for the form on follow-us.html


    $message = '';
	$message .= '<table cellpadding="0" cellspacing="0">';
    foreach($_POST as $postname => $post){
		
		if( $postname != 'envoo-admin-mail' ) {
		
       		$message .= "<tr><td style='padding: 5px 20px 5px 5px'><strong>" . urldecode($postname) . ":</strong>" . "</td><td style='padding: 5px; color: #444'>" . $post . "</td></tr>";
		
		}
    }
	
	$message .= '</table>';
	
    $headers = 'From: ' . $from . "\r\n" .
        'Reply-To: info@yourdomain.com' . "\r\n" .
        'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject_contact_us, $message, $headers);
 	
?>
