<?php

@session_start();

include('../../../wp-load.php');

/*define('DB_SERVER', 'mysqlv111');
define('DB_USERNAME', 'eppingwell');
define('DB_PASSWORD', 'Admin321!');
define('DB_DATABASE', 'eppingwell');

$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die('Oops connection error -> ' . mysql_error());
mysql_select_db(DB_DATABASE, $connection) or die('Database error -> ' . mysql_error());*/


//-------------------------------------------------------
require_once 'anet_php_sdk/AuthorizeNet.php'; // Include the SDK you downloaded in Step 2
$api_login_id = '659r8XDgsF';
//$transaction_key = '2psj2K2T9GKRw848';
$transaction_key = '6LPq4f2UVh92W74Y';

$amount_arr= explode("$",$_POST['mem_plan']);
$amount = $amount_arr[1];

$fp_timestamp = time();
$fp_sequence = "123" . time(); // Enter an invoice or other unique number.
$fingerprint = AuthorizeNetSIM_Form::getFingerprint($api_login_id, $transaction_key, $amount, $fp_sequence, $fp_timestamp);
  
//--------------------------------------------------------------------------------------------------------------------------
if($_REQUEST)
{
	extract ($_REQUEST);
}

if(isset($_POST['next'])=="Submit")
{
	$app="INSERT INTO subuser (name, email, phone, address,  city, state, zip_code, payment_status,renew,mem_plan)
	 				   values ('$name', '$email', '$phone', '$address',  '$city', '$state', '$zip_code','pending','$renew','".$_POST['mem_plan']."') ";
	$appRes=mysql_query($app);			
}
$Name = explode(" ",$_POST['name']);

?>

<!--<form method='post' action="https://test.authorize.net/gateway/transact.dll">-->
<form method='post' action="https://secure.authorize.net/gateway/transact.dll">

<input type="hidden" name="x_amount" id="x_amount" value="<?php echo $amount; ?>" />
<input type="hidden" name="x_first_name" id="x_first_name" value="<?php echo $Name[0]; ?>" />
<input type="hidden" name="x_last_name" id="x_last_name" value="<?php echo $Name[1]; ?>" />
<input type="hidden" name="x_email" id="x_email" value="<?php echo $_POST['email']; ?>" />
<input type="hidden" name="x_city" id="x_city" value="<?php echo $_POST['city']; ?>" />
<input type="hidden" name="x_state" id="x_state" value="<?php echo $_POST['state']; ?>" />
<input type="hidden" name="x_zip" id="x_zip" value="<?php echo $_POST['zip_code'];?>" />
<input type="hidden" name="x_country" id="x_country" value="" />
<input type="hidden" name="x_address" id="x_address" value="<?php echo $_POST['address']; ?>" />


<input type='hidden' name="x_login" value="<?php echo $api_login_id; ?>" />
<input type='hidden' name="x_fp_hash" value="<?php echo $fingerprint; ?>" />
<input type="hidden" name="x_card_num" id="x_card_num" value="" />
<input type='hidden' name="x_fp_timestamp" value="<?php echo $fp_timestamp; ?>" />
<input type='hidden' name="x_fp_sequence" value="<?php echo $fp_sequence; ?>" />
<input type='hidden' name="x_version" value="3.1">
<input type='hidden' name="x_show_form" value="payment_form">
<input type='hidden' name="x_test_request" value="false" />
<input type='hidden' name="x_method" value="cc">

</form>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    window.document.forms[0].submit();
  });
</script>