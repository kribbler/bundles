<?
@session_start();
require_once("lib/mysqldb.php");
require_once("lib/debug.php");
require_once("lib/class.phpmailer.php");
DEFINE("XML_HEAD","<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>");
DEFINE("MESSAGE_LIST_DELIM","\n - ");
$_SESSION["debug_level"]=0;

$debug_mode=3;

if ($debug_mode)
	$x_error_reporting = E_ALL ^ E_NOTICE;
else
	$x_error_reporting = 0;

error_reporting ($x_error_reporting);


while (list ($key, $val) = each ($_COOKIE)) {
	$$key=$val;
}

while (list ($key, $val) = each ($_SESSION)) {
	$$key=$val;
}

while (list ($key, $val) = each ($_GET)) {
	$$key=sqlSafe($val);
}

while (list ($key, $val) = each ($_POST)) {
	$$key=sqlSafe($val);
}

function sqlSafe($s) {
	//$s=str_replace("'","&rsquo;",$s);
	return $s;
}


function checkLength($var,$varName,$len) {
	if (strlen($var)>$len) {
		return MESSAGE_LIST_DELIM . $varName . " must be only " . $len . " characters.";
	}
	return "";
}
function checkNumeric($var, $varName) {
	if (!(is_numeric($var)) || $var=="" || is_null($var) || strlen($var)==0) {
		return MESSAGE_LIST_DELIM . $varName . " must be numeric. ($var)";
	}
	return "";
}


function showMessage($m) {
	if ($m!="") {
		flexMessage($m,-1);
	}
}
function flexMessage($s, $errNo) {
	header("Content-type: application/xml");
	echo XML_HEAD . "<result><message>$s</message><errorNumber>$errNo</errorNumber></result>";
	die();
}
function FlexType($m) {
	switch ($m) {
		case "string":
		case "blob":
			$m="String";
			break;
		case "real":
		case "int":
		case "decimal" :
			$m="Number";
			break;
		case "datetime" :
			$m="Date";
			break;
		default:
			$m="Number";
			break;
	}
	return $m;
}
function flexResultSafe($s) {
	//$s=str_replace("&rsquo;","'",$s);
	$s=htmlspecialchars($s);
	return $s;

}

function encryptData($value){
   global $g_encryption_key;
   $text = $value;
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $g_encryption_key, $text, MCRYPT_MODE_ECB, $iv);
   return $crypttext;
}


function flexResult($ar_result, $message, $errorNumber) {

	header("Content-type: application/xml");

	echo XML_HEAD . "<result><message>$message</message><errorNumber>$errorNumber</errorNumber>";

	for ($a=0;$a< count($ar_result);$a++) {
	echo "<resultSet>";
		$result=$ar_result[$a];
		while ($row=mysql_fetch_array($result)) {
			echo "<record>";
			for ($i=0;$i<mysql_num_fields($result);$i++) 
			{
				$finfo = mysql_fetch_field($result,$i);
				echo("	<" . $finfo->name . " value=\"" . flexResultSafe($row[$finfo->name]) . "\" type=\"" . FlexType($finfo->type) . "\" />
				"); 
			}
			echo "
		</record>";
		}
	echo "</resultSet>";

	}
	
	echo "</result>";

}

$appname="llambert";
$server="localhost";
$username="lancelam_llamber";
$password="LLAM2000";
$database="lancelam_llambert";
$g_encryption_key = "lk38dj2kj2dDFERuj278";

$db=new mysqldb($appname, $server, $username, $password, $database);
?>