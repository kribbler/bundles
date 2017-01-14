<?php 
$username = "root";
$password = "";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)  or die("Unable to connect to MySQL");
//select a database to work with
$selected = mysql_select_db("seed_talent",$dbhandle)
  or die("Could not select examples");
  
function usernameEmailExists($username)
{
          global $db;
          
		  $username = sanitize($username);
		  $query = "SELECT ID  FROM wp_users  WHERE user_login='".$username."' OR user_email = '".$username."' LIMIT 1";
 
          $sql = mysql_query($query);
          if (mysql_num_rows($sql) == 1)
              return true;
          else
              return false;
}
function getArrayIntoCommaSep($arr){
	$cStr ='';
	$flag = 0;
	
	 foreach ($arr as $val) {
		if($flag==0)
			$cStr.=	 $val ;
		else
			$cStr.=	",".$val."";
	$flag=1;
	}
	return $cStr;
}

function getEventLocation($locationid){
 $sSql = "SELECT * FROM  wp_em_locations WHERE location_id='$locationid' LIMIT 1";
$sResult = mysql_query($sSql);
if(mysql_num_rows($sResult)>0){
	$sRow = mysql_fetch_assoc($sResult);
}else
	$sRow=false;

return $sRow;
}

function getRegisterTypeByUsername($username){
 $sSql = "SELECT usertype FROM  wp_users WHERE user_login='$username' LIMIT 1";
$sResult = mysql_query($sSql);
if(mysql_num_rows($sResult)>0){
	$sRow = mysql_fetch_assoc($sResult);
}

$type = $sRow['usertype'];
if($type)
	return $type;
else
	return '';

}
function getUserById($uid){
$sSql = "SELECT * FROM  wp_users WHERE ID='$uid' LIMIT 1";
$sResult = mysql_query($sSql);
	if(mysql_num_rows($sResult)>0){
		$sRow = mysql_fetch_assoc($sResult);
	}else{
	 $sRow = false;
	}
return  $sRow;
}
//////////// log in automatically ////////////////////
function autologin_wp($username){	
   if ( !is_user_logged_in() ) {
        $user = get_userdatabylogin( $username );
        $user_id = $user->ID;
		$user_login = $username ;
        wp_set_current_user( $user_id, $user_login );
        wp_set_auth_cookie( $user_id ,false);
        do_action( 'wp_login', $user_login );
    }  
 
  /*	if(is_user_logged_in())
    {
        echo '<br />User Logged in ok<br />';
        echo 'User ID is: '.$user->ID.'<br />';
        echo 'User login is: '.$user->user_login.'<br />';
    }
    else 
        echo 'No user is logged in< br/>'; */
}


function get_facebook_cookie($app_id, $app_secret) {
  $args = array();
  parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
  ksort($args);
  $payload = '';
  foreach ($args as $key => $value) {
    if ($key != 'sig') {
      $payload .= $key . '=' . $value;
    }
  }
  if (md5($payload . $app_secret) != $args['sig']) {
    return null;
  } 
  return $args;
}

function randomString($length)
{
    $string = md5(time());
    $highest_startpoint = 32-$length;
    $randomString = substr($string,rand(0,$highest_startpoint),$length);
    return  $randomString ;
}

 

function getiiObjectiveShortNameEdit($uid,$sel=''){
 
	$sql = "SELECT * FROM iobjective WHERE userid='$uid' ORDER BY id ";
	$res = mysql_query($sql);
	$select = '<select name="cboiObjectiveShortName" class="cboDropDown" onchange="Javascript:document.getElementById(\'hioeditmode\').value=1;document.frmiObjective.submit();" style="width:80px;">';
	$select.='<option value="0" $selected>Select iObjective</option>';
	while($row=mysql_fetch_assoc($res)){
		if($sel==$row['id'])
			$selected= "SELECTED"; 
		else
			$selected= "";
			
		$select.='<option value="'.$row['id'].'" $selected>'.$row['iObjectiveShortName'].'</option>';
	}
			$select.='</select>';
	return $select;
}
function getiGoalsShortNameEditio($uid,$sel=''){
 
	$sql = "SELECT * FROM igoal WHERE userid='$uid' ORDER BY id ";
	$res = mysql_query($sql);
	$select = '<select name="cboiGoalsShortNameio" class="cboDropDown" style="width:80px;">';
	$select.='<option value="0">Select iGoal</option>';
	while($row=mysql_fetch_assoc($res)){
		if($sel==$row['id'])
			$selected= "SELECTED"; 
		else
			$selected= "";
			
		$select.='<option value="'.$row['id'].'" '.$selected.'>'.$row['igoalShortName'].'</option>';
	}
			$select.='</select>';
	return $select;
}
function getiGoalsShortNameEdit($uid,$sel=''){
 
	$sql = "SELECT * FROM igoal WHERE userid='$uid' ORDER BY id ";
	$res = mysql_query($sql);
	$select = '<select name="cboiGoalsShortName" class="cboDropDown" onchange="Javascript:document.getElementById(\'heditmode\').value=1;document.frmiGoals.submit();" style="width:80px;">';
	$select.='<option value="0">Select iGoal</option>';
	while($row=mysql_fetch_assoc($res)){
		if($sel==$row['id'])
			$selected= "SELECTED"; 
		else
			$selected= "";
			
		$select.='<option value="'.$row['id'].'" '.$selected.'>'.$row['igoalShortName'].'</option>';
	}
			$select.='</select>';
	return $select;
}
function getCountiGoals($fudnaid){
	$sqli = "SELECT COUNT(*) AS cntigoal FROM  igoal WHERE userid='".$_SESSION['id']."' AND Fundamentals='$fudnaid' AND iGoalsStatus IN ('Getting started','Procrastinating','Working on it')";
	$resi = mysql_query($sqli);
	if(mysql_num_rows($resi)>0){
		    $rowi = mysql_fetch_assoc($resi);
			$fundacount = $rowi['cntigoal'];
			return $fundacount ;
	} else {
			return 0;
	}

}
function getCountiObjectives($fudnaid){
$sqli = "SELECT COUNT(iobjective.userid) AS iocount
FROM igoal INNER JOIN iobjective ON igoal.id = iobjective.iGoalsShortNameid
GROUP BY igoal.id, igoal.Fundamentals,iobjective.userid,iobjective.iObjectiveStatus
HAVING (((iobjective.userid)='".$_SESSION['id']."') AND ((igoal.Fundamentals)='$fudnaid') AND ( iobjective.iObjectiveStatus  IN ('Getting started','Procrastinating','Working on it')))";

 //echo $sqli;
	$resi = mysql_query($sqli);
	if(mysql_num_rows($resi)>0){
		    $rowi = mysql_fetch_assoc($resi);
			$fundacount = $rowi['iocount'];
			return $fundacount ;
	} else {
			return 0;
	}

}


function getFundamentals($id=''){
	$sql = "SELECT * FROM fundamentals ORDER BY id";
	$res = mysql_query($sql);
	$select = '<select name="cboFundamentals" class="cboDropDown">';
	while($row=mysql_fetch_assoc($res)){
		if($id==$row['id'])
			$selected= "SELECTED"; 
		else
			$selected= "";
			
		$select.='<option value="'.$row['id'].'" '.$selected.'>'.$row['name'].'</option>';
	}
			$select.='</select>';
	return $select;
}
function getiGoalsShortName($uid,$sel=''){
 
	$sql = "SELECT * FROM igoal WHERE userid='$uid' ORDER BY id ";
	$res = mysql_query($sql);
	$select = '<select name="cboiGoalsShortName" class="cboDropDown" style="width:80px;">';
	$select.='<option value="0" '.$selected.'>Select iGoal</option>';
	while($row=mysql_fetch_assoc($res)){
		if($sel==$row['id'])
			$selected= "SELECTED"; 
		else
			$selected= "";
			
		$select.='<option value="'.$row['id'].'" $selected>'.$row['igoalShortName'].'</option>';
	}
			$select.='</select>';
	return $select;
}

function sanitize($string, $trim = false)
  {
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      if ($trim)
          $string = substr($string, 0, $trim);
      
      return $string;
	  
  }

function redirect_to($location)
  {
      if (!headers_sent())
          header('Location: ' . $location);
      else {
          echo '<script type="text/javascript">';
          echo 'window.location.href="' . $location . '";';
          echo '</script>';
          echo '<noscript>';
          echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
          echo '</noscript>';
      }
  }
  
function validate_email($umail){

		  if (!$umail || strlen($umail = trim($umail)) == 0) {
              return  1;
          } elseif (emailExists($umail)) {
             return  2;
          } else {
              $regex = "/^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*" . "@[a-z0-9-]+(\.[a-z0-9-]{1,})*" . "\.([a-z]{2,}){1}$/i";
              if (!preg_match($regex, $umail)) {
                 return  3;
              }
		   }
}

function emailExists($email)
{
          global $db;
          
		  $email = sanitize($email);
          $sql = mysql_query("SELECT id" 
				. "\n FROM users " 
				. "\n WHERE user_email = '" .  $email . "'" 
				. "\n LIMIT 1");
          if (mysql_num_rows($sql) == 1)
              return true;
          else
              return false;
}

function usernameExists($username)
      {
          global $db;
          
          if (strlen($username) < 4)
              return 1;  // User name must be 4 Charaters
          
          $username = str_replace(" ", "", $username);
         // if (!ctype_alnum($alpha_num))
          //    return 2;
          
          $sql = mysql_query("SELECT id" 
				. "\n FROM wp_users" 
				. "\n WHERE 	user_login = '" . sanitize($username) . "'" 
				. "\n LIMIT 1");
          if (mysql_num_rows($sql) > 0)
              return 2; // User name Already Exist.
          else
              return false;
      }
	  
	
function sendMail($to, $subject, $body, $sitemail,$sitename)
{
          $from = "From: " .  $sitemail . " <" . $sitename . ">";
		  $headers = "MIME-Version: 1.0" . "\r\n";
		  $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		  $headers .= "From: <" . $sitemail . "> " . $sitename . "" . "\r\n";
		  $body = nl2br($body);
		
          return mail($to, $subject, $body, $headers);
}

function generateRandID($len)
      {
          return md5(generateRandStr($len));
      }
      
      /**
       * Session::generateRandStr()
       * 
       * @param mixed $length
       * @return
       */
function generateRandStr($length)
{
          $randstr = "";
          for ($i = 0; $i < $length; $i++) {
              $randnum = mt_rand(0, 61);
              if ($randnum < 10) {
                  $randstr .= chr($randnum + 48);
              } elseif ($randnum < 36) {
                  $randstr .= chr($randnum + 55);
              } else {
                  $randstr .= chr($randnum + 61);
              }
          }
          return $randstr;
}
function validateToken($token)
{
   
          $sql = "SELECT user_activation_key" 
		  . "\n FROM wp_users" 
		  . "\n WHERE user_activation_key ='" . $token . "'" 
		  . "\n LIMIT 1";
          $result = mysql_query($sql);
          if (mysql_num_rows($result)>0) {
		 	$sql =  "UPDATE  `wp_users` SET user_activation_key='' WHERE user_activation_key ='$token' LIMIT 1";
   		    $rr = mysql_query($sql);
	        return true;
			  
		}
}

function confirmUserPass($username, $password)
{
          global $db;

          $sql = "SELECT user_pass,user_activation_key FROM wp_users WHERE user_login = '" . $username."' OR user_email = '".$username."' ";
		 
          $result = mysql_query($sql);
		         
		  if(mysql_num_rows($result)>0){
		  
          	$row = mysql_fetch_assoc($result);
 
			 
          if ($row['user_activation_key'] != '')
              return 3;
          
          
          $row['user_pass'] = sanitize($row['user_pass']);
          $password = sanitize($password);
          $entered_pass = ($password);
		    if ( !isset($wp_hasher) ) {
 	           require_once( ABSPATH . 'wp-includes/class-phpass.php');
  	           // By default, use the portable hash from phpass
  	           $wp_hasher = new PasswordHash(8, TRUE);
}
 		 //  $wp_hasher = new PasswordHash(8, TRUE);
		   $password_hashed =  $row['user_pass'];
		   $plain_password = $entered_pass;
				
			if($wp_hasher->CheckPassword($plain_password, $password_hashed)) {
			   $match = "YES";
			}
			else {
			   $match = "No";
			}

		  	
          if ($match=='YES') {
              return 1;
          } else {
              return 2;
          }
		 }else {
				 return 0;
		 }
		 
}

/*function  login($username,$password){
$sql = "SELECT * FROM users WHERE username ='$username' AND password='$password' and status='1' LIMIT 1";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

$_SESSION['username'] = $row['fname'];
}

function  logout(){
	unset($_SESSION['username']);
}*/

function login($uname, $upass, $uremember)
{
          $uname = sanitize($uname);
		  $upass = sanitize($upass);
          $result =  confirmUserPass($uname, $upass);
          $msgError=='';
          if (empty($msgError)) {
			  $userinfo = getUserInfo($uname);
 			  $id = $_SESSION['id'] = $userinfo['ID'];
			  $username = $_SESSION['username'] = $userinfo['user_login'];
			  $upass = $_SESSION['password'] = $upass;
			  $fname = $_SESSION['fname'] = $userinfo['user_login'] ;
			  $user_emrail = $_SESSION['useremail'] = $userinfo['user_email'] ;
			  $cookie_id = $_SESSION['cookie_id'] = generateRandID(16);

		     // $userlevel = $userinfo['userlevel'];
 			 // User::updateUserField($this->username, "last_access", $this->time);
             // User::updateUserField($this->username, "cookie_id", $this->cookie_id);
			 // User::updateUserField($this->username, "last_ip", $_SERVER['REMOTE_ADDR']);
              
			  if ($uremember) {
				  setcookie("MSM_COOKIE", $this->username, time() + COOKIE_EXPIRE, COOKIE_PATH);
				  setcookie("MSM_COOKIE_ID", $this->cookie_id, time() + COOKIE_EXPIRE, COOKIE_PATH);
			  }
	
			  //wp_login($uname, $upass,'');
              return true;
          } else {
              return false;
          }
      }

function logout()
{
          if (isset($_COOKIE['MSM_COOKIE']) && isset($_COOKIE['MSM_COOKIE_ID'])) {
              setcookie("MSM_COOKIE", "", time() - COOKIE_EXPIRE, COOKIE_PATH);
              setcookie("MSM_COOKIE_ID", "", time() - COOKIE_EXPIRE, COOKIE_PATH);
          }
          
		  $_SESSION['username']='';
          $_SESSION['cookie_id']='';
		  $_SESSION['id']='';
 		  $_SESSION['fname']=''; 
		  $_SESSION['useremail']='';
 
		  
          unset($_SESSION['username']);
          unset($_SESSION['cookie_id']);
		  unset($_SESSION['id']);
 		  unset($_SESSION['fname']);
		  unset($_SESSION['useremail']);
 
		  if(isset($_SESSION['first_name'])) unset($_SESSION['first_name']);
		  if(isset($_SESSION['last_name'])) unset($_SESSION['last_name']) ;
 
     
          $logged_in = false;
          $username = "Guest";
          $userlevel = 0;
      }

function getUserInfo($username)
{
          global $db;
          $sql = "SELECT * FROM wp_users WHERE user_login = '". $username."' OR user_email = '".$username."' ";
		  
          $result = mysql_query($sql);
          if (!$username) {
              return false;
          }
          
          if (mysql_num_rows($result) > 0) {
              $row = mysql_fetch_assoc($result);
              return $row;
          } else
              return null;
}
function getUserProfile($tablename,$userid)
{
          global $db;
          $sql = "SELECT * FROM $tablename WHERE uid = '". $userid."'";
		  
          $result = mysql_query($sql);
          if (!$tablename) {
              return false;
          }
          
          if (mysql_num_rows($result) > 0) {
              $row = mysql_fetch_assoc($result);
              return $row;
          } else
              return null;
}
function getUserContact($profileid)
{
          global $db;
          $sql = "SELECT * FROM contacts_profile WHERE teacher_profile_id = '". $profileid."'";
		  
          $result = mysql_query($sql);
          if (!$profileid) {
              return false;
          }
          
          if (mysql_num_rows($result) > 0) {
		  	$record = array();
              while($row  = mysql_fetch_assoc($result) ){
			  		$record[] = $row;
			  }
			  
              return $record;
          } else
              return null;
}  


function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
    if (mail($mailto, $subject, "", $header)) {
       return "1"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
}



function makeThumbnail($imgName, $srcDir, $thDir, $maxWidth, $maxHeight) {
    if ($thDir != "") {
        copy($srcDir.$imgName, $thDir.$imgName);
        $srcFile = $thDir.$imgName;
    }
    else {
        copy($srcDir.$imgName, $srcDir.'th_'.$imgName);
        $srcFile = $srcDir.'th_'.$imgName;
    }
	chmod($srcFile,0777);
    
    $ext = strtolower(substr($srcFile,-3));
    $width  = $maxWidth;

    if (file_exists($srcFile) ) {
        $size        = getimagesize($srcFile);
        $IW             = $size[0];
        $IH             = $size[1];
        
        if ($IW < $maxWidth && $IH  < $maxHeight ) {
            $w = $IW;
            $h = $IH;
        }    
        else {
            if ($IW >= $IH) {
                $w = number_format($width, 0, ',', '');
                $h = number_format(($IH / $IW) * $width, 0, ',', '');
            }
            else {
                $ARW         = (float) ($size[0]/($IH-$IW));
                $ARH         = (float) ($size[1]/($IH-$IW));
                $h           = number_format($maxHeight, 0, ',', '');
                $tw             = (float)(($h * $ARW) / $ARH);
                $w           = number_format($tw, 0, ',', '');
                
                if ($w > $maxWidth) {
                    $howMuch   = $w - $maxWidth;
                    $reducePro = $howMuch/$ARW;
                    
                    $h  = $h - ( $ARH * $reducePro );
                    $w  = $w - ( $ARW * $reducePro );
                    $h  = number_format($h, 0, ',', '');
                    $w  = number_format($w, 0, ',', '');
                }
            }
            if ($h > $maxHeight ) {
                $w    = number_format(($w / $h) * $maxHeight, 0, ',', '');
                $h    = number_format($maxHeight, 0, ',', '');
            }
        }
    }
    
    $new_width = $w;
    $new_height = $h;
     
    $image_p = imagecreatetruecolor($new_width, $new_height);    
    if ($ext == 'jpg') {
        $image = imagecreatefromjpeg($srcFile);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $IW, $IH);
        imagejpeg($image_p, $srcFile, 500);
    }
    else if ($ext == 'png') {
        $image = imagecreatefrompng($srcFile);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $IW, $IH);
        imagepng($image_p, $srcFile, 9);
    }
    else if ($ext == 'gif') {
        
        $image = imagecreatefromgif($srcFile);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $IW, $IH);
        imagegif($image_p, $srcFile, 100);
    }
}

// GET FILE EXTENSION
function getFileExtension($file_name){
	$extnStart = strrpos($file_name, '.');
	$extnEnd = strlen($file_name);
	$filExtn = substr($file_name, $extnStart, $extnEnd);
	return $filExtn;
}


function newreferenceno()
			{
			$maxnum=1;		
			$query="select reference from post_job";
			$q=mysql_query($query);
			while($row=mysql_fetch_array($q))
				{
				 $num = substr($row['reference'],2)."</br>";
				 $num = (int)$num;
						if($num>$maxnum)
						{
						$maxnum=$num;
						}			
				}
				return("ST".($maxnum+1));		
				
			}
			
	function createUniqueFile($fileName,$uploadDir)
	{	
		
		$orgname=$fileName;
		
		$positionOfDot = strpos($fileName,".");
		$fileBeforeDot = substr($fileName,0,$positionOfDot);
	    $ext = substr($fileName,$positionOfDot,strlen($fileName));
		$counter =1;
		
		while(file_exists($uploadDir.$fileName))
		{  
    		$fileName =  $fileBeforeDot."~".$counter.$ext;
			$counter++;
		}	
				
		return $fileName;
	}

?>