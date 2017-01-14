<?php 
session_start();

if( !isset($_SESSION['username']) || $_SESSION['username']=='')
	header("Location:index.php");
	
include('includes/funct.php');

if(!empty($_POST)){

$username1 = sanitize($_POST['username1']);
$password1 = sanitize($_POST['password1']);
$passwordagain1 = sanitize($_POST['passwordagain1']);
$msg ='';

if($password1 =='' || $passwordagain1 =='' || $username1 ==''){
	$msg = "Please enter values!";
}

if($password1 != $passwordagain1){
	$msg = "Password not match!";
}


if($password1 !='' && $passwordagain1 !='' && $msg=='' ){
	$result =  confirmUserPass($username1, $password1);
	if($result==1)  {
		$msg = "User already exist!";	
	}			
}

   if($msg==''){
				 $sql =  "INSERT INTO  users  SET password='".md5($password1)."' ,username = '" . $username1."'";
				$rr = mysql_query($sql);
				$msg = "User added successfully.";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kraftech Inc. - New User</title>
<meta name="description" content="Kraftech, Inc. is a residential, new construction, custom home builder and home remodeler located in Summit, Geauga, Cuyahoga, Portage, Lorain, Medina, Wayne, Stark, Lake counties of North Eastern Ohio. We are a dynamic, innovative, customer service driven and affordable home builder. We will design and build your new home on your lot or in one of our communities. " />
<meta name="keywords" content="Kraftech Homes, kraftech, homes, homes, custom homes, custom, builder, new construction, craftech, kraftechomes, residential, developer, designer, building, design, build, construction, home plans, house plans, developments, land for sale, home for sale, lots for sale, Cleveland, Ohio, Northeast Ohio, Macedonia, Brecksville, Northfield Village, Portage County, Summit County, Medina, County, Paul Karnow, Home Builders Association, dream home, kraftec, krafttech, kraft-tech, craft-tech, kraft-teck, craft-teck, craftec, crafteck, affordable, Lorain, Medina, Wayne, Stark, Lake, new homes, available homes" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
 
 
</head>

<body>
<div id="container">
<div id="wraper">
<div class="header"><img src="../images/header.jpg" width="919" height="137" /></div>
<div class="outline">
<div class="menu-bar">
<div class="logo-bal"><img src="../images/logo-bal.jpg" width="121" height="44" /></div>
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
  
       
 <h2>Create User</h2>
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
            <td width="110">User Name:</td>
            <td><input name="username1" id="username1"  type="text"></td>
          </tr>
          <tr>
            <td colspan="2" style="height: 12px;" height="7"></td>
          </tr>
          <tr>
            <td>Password:</td>
            <td><input name="password1" id="password1"  type="password"></td>
          </tr>
           <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
            <tr>
            <td>Password again:</td>
            <td><input name="passwordagain1" id="passwordagain1"  type="password"></td>
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

<div class="footer-line"><img src="../images/footer.jpg" width="919" height="5" /></div>
<div class="footer">

<?php include('../footer.html'); ?>            
            
</div>


</div>
</div>
</div>
</body>
</html>

