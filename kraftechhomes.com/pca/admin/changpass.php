<?php 
session_start();
include('includes/funct.php');
     //   Array ( [username] => sadfdsfasdfsdfg [password] => dsfgdsfgdfg [btnsubmit] => Submit ) 

if(!empty($_POST)){

$oldpassword = sanitize($_POST['oldpassword']);
$password = sanitize($_POST['password']);
$passwordagain = sanitize($_POST['passwordagain']);
$msg ='';

if($password=='' || $passwordagain=='' || $oldpassword==''){
	$msg = "Please enter values!";
}

if($password!=$passwordagain){
	$msg = "Password not match!";
}

	if($msg==''){
			$result =  confirmUserPass($_SESSION['username'], $oldpassword);
      $username = $_SESSION['username'];

			if($result==1)  {
				 $sql =  "UPDATE   users  SET password='".md5($password)."'  WHERE username = '" . $username."' AND password='".md5($oldpassword)."'" ;
				$rr = mysql_query($sql) or die(mysql_error());
				$msg = "Password has been successfully changed";
			 }else{ 
				$msg = "Please enter valid Password!";
			 }
	}

}
?>
 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kraftech Inc. - Contact Us</title>
<meta name="description" content="Kraftech, Inc. is a residential, new construction, custom home builder and home remodeler located in Summit, Geauga, Cuyahoga, Portage, Lorain, Medina, Wayne, Stark, Lake counties of North Eastern Ohio. We are a dynamic, innovative, customer service driven and affordable home builder. We will design and build your new home on your lot or in one of our communities. " />
<meta name="keywords" content="Kraftech Homes, kraftech, homes, homes, custom homes, custom, builder, new construction, craftech, kraftechomes, residential, developer, designer, building, design, build, construction, home plans, house plans, developments, land for sale, home for sale, lots for sale, Cleveland, Ohio, Northeast Ohio, Macedonia, Brecksville, Northfield Village, Portage County, Summit County, Medina, County, Paul Karnow, Home Builders Association, dream home, kraftec, krafttech, kraft-tech, craft-tech, kraft-teck, craft-teck, craftec, crafteck, affordable, Lorain, Medina, Wayne, Stark, Lake, new homes, available homes" />
<link href="../../../../../../css/style.css" rel="stylesheet" type="text/css" />
 
 
</head>

<body>
<div id="container">
<div id="wraper">
<div class="header"><img src="../../../../../../images/header.jpg" width="919" height="137" /></div>
<div class="outline">
<div class="menu-bar">
<div class="logo-bal"><img src="../../../../../../images/logo-bal.jpg" width="121" height="44" /></div>
<div class="menu">

            	<?php 
				if( isset($_SESSION['username']) && $_SESSION['username']!='')
				include('nav.html');  
				?>
</div>

</div>
<div class="clear"></div>
<div class="middle">
<div class="left-col">
  <div class="custom-content">
  <div class="form">
  
       
 <h2>Change Password</h2>
  <form id="contact" name="contact" method="post" action="">
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="50%">
          <tbody>
                
           <tr>
            <td colspan="2" ><h3><?php echo $msg; ?></h3></td>
        
          </tr> 
           
         
           <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="110">Old Password:</td>
            <td><input name="oldpassword" id="oldpassword"  type="password"></td>
          </tr>
          <tr>
            <td colspan="2" style="height: 12px;" height="7"></td>
          </tr>
          <tr>
            <td>New password:</td>
            <td><input name="password" id="password"  type="password"></td>
          </tr>
           <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
            <tr>
            <td>Password again:</td>
            <td><input name="passwordagain" id="passwordagain"  type="password"></td>
          </tr>
           <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
         <tr>
            <td colspan="2" align="center"><input type="submit" name="btnsubmit" value="Submit" align="center"/> </td>
          </tr>
         </table>
      	</form>
 
        
        
   <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
  
  </div>
  
  
  

  
  </div>


</div>
<!--<div class="right-col">
<?php include('sidebar.html'); ?>
</div>-->

</div>

</div>

<div class="footer-line"><img src="../../../../../../images/footer.jpg" width="919" height="5" /></div>
<div class="footer">

<?php include('../../footer.html'); ?>            
            
</div>


</div>
</div>
</div>
</body>
</html>
