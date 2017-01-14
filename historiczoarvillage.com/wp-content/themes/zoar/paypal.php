<?php
session_start();
/* Template Name: Paypal */
$ROOT='http://'.$_SERVER['SERVER_NAME']."/";
require_once('paypal.class.php');  // include the class file

$p = new paypal_class;             // initiate an instance of the class

$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // Test Sandbox url
//$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // paypal url

// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';  

switch ($_GET['action']) {

	case 'success':
	
		/*foreach($_REQUEST as $k => $v){
			$m .= $k .' = ' . $v . "\n";
		}
		mail('sittestaccount@gmail.com', 'Just getting paypal variables on Success', $m);*/
	
		// Order was successful...
		$custField = explode(':',$_REQUEST['custom']);
		$rowId = $custField[0];
		$sessionId = $custField[1];

		//UPDATE USER TABLE
		$updSql = "UPDATE subuser SET transaction_id='".$_REQUEST['txn_id']."', total_amount='".$_REQUEST['payment_gross']."', payment_status='".$_REQUEST['payment_status']."' WHERE id='".$rowId."' AND session_id='".$sessionId."'";
		$updResult = mysql_query($updSql);

		$select = mysql_query("SELECT * FROM subuser WHERE id='".$rowId."' AND session_id='".$sessionId."'");
		$row = mysql_fetch_assoc($select);
		if(mysql_num_rows($select) > 0){
			
			// Send email to subuser/visitor
			
			$subject = 'User Subscription';
			$to = $row['email'];
			$body =  "Hi ".$row['name'].",<br /><br />";
			$body .=  "Your Subscription.<br /><br />";
			$body .=  "Thank you for Subscription .<br /><br />";
			
			$body .=  "Kind Regards,<br />";
			$body .=  "Zoar Team<br />";

			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From:Zoar <noreply@zca.org>' . "\r\n";
			mail($to,$subject,$body,$headers);

			// email to project selleer
			$my_message  =  "The following user has been subscribe through our website by ".$row['name']."\n\n";
			$my_message .=  "-----------------------------------------------------\n";
			$my_message .=  "User Details\n";
			$my_message .=  "-----------------------------------------------------\n";
			$my_message .=  'Name: '.$row['name'].' '."\n";
			$my_message .=  'Email: '.$row['email']."\n";
			$my_message .=  'Address 1: '.$row['address']."\n\n";
			$my_message .=  'Address 2: '.$row['address1']."\n";
	
		
			// send an email to administrator
			$subject1 = 'User Subscription - zca.org';
			$mailto   = 'sittestaccount@gmail.com'; // Replace with client email 
			//$mailto   = "$Proj_userEmail"; // client email 
			$from_mail  = "From:Zoar <zoarinfo@zca.org>";
			$from_name   = "Zoar";
			$replyto  = '';

			mail($mailto, $subject1, $my_message, $from_mail); // test mail
		}

		//$thankUrl="http://localhost/buyintome/thankyou-payment-received/";
		
		echo '<script>window.location.href="'.get_bloginfo('url').'/thankyou-user-subscription/"</script>';
   		exit;
	break;

	case 'cancel':       
		// The order was canceled before being completed.
		echo "<html><head><title>Canceled</title></head><body><h3>The order was canceled.</h3>";
		echo "</body></html>";
		
		//$CancelUrl="http://localhost/buyintome/thankyou-payment-received/";		
		echo '<script>window.location.href="'.get_bloginfo('url').'/cancel-return/"</script>';
	break;


	case 'ipn': 
		// IPN received
		
		/*foreach($_REQUEST as $k => $v){
			$m .= $k .' = ' . $v . "\n";
		}
		mail('dk6504@gmail.com','Just getting paypal variables on IPN received',$m);*/
		
		$custField = explode(':',$_REQUEST['custom']);
		$rowId = $custField[0];
		$sessionId = $custField[1];

		
			$updSql = "UPDATE subuser SET transaction_id='".$_REQUEST['txn_id']."', payment_status='".$_REQUEST['payment_status']."' WHERE id='".$rowId."' AND session_id='".$sessionId."'";
			$updResult = mysql_query($updSql);
		

	break;
}
?>