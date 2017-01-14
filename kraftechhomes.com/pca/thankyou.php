<?php 
$your_email = 'paulk@kraftechhomes.com';  // Email to send message to
if ($_SERVER['REQUEST_METHOD'] != 'POST') exit; // Quit if it is not a form post
// quick way clean up incoming fields
foreach($_POST as $key => $value) $_POST[$key] = urldecode(trim($value));
// get form data into shorter variables
// each $_POST variable is named based on the form field's id value
 $name=$_POST["name"];
$email=$_POST["email"];
$address=$_POST["address"];
$city=$_POST["city"];
$state=$_POST["state"];
$zip=$_POST["zip"];
$phone=$_POST["phone"];
$contact_me=$_POST["contact_me"];
$hear=$_POST["hear"];
$looking=$_POST["looking"];
$sell=$_POST["sell"];
if($sell=="")
     $sell="No";
$helpful=$_POST["helpful"];
$comments=$_POST["comments"];

$code  = $_POST['code'];

$errors  = array(); // array of errors

// basic validation
if ($name == '') {
  $errors[] = "Please enter your name";
}

if ($email == '') {
  $errors[] = "Please enter your email address";
} else if (strpos($email, '@') === false) {
  $errors[] = "Please enter a valid email address";
}

if ($comments == '') {
  $errors[] = "Please enter a Comments to send";
}


if (sizeof($errors) == 0) {
  // only check the code if there are no other errors
  include('securimage.php');
  $img = new Securimage;
  if ($img->check($code) == false) {
    $errors[] = "Incorrect security code entered please refresh";
  } // if the code checked is correct, it is destroyed to prevent re-use
}

if (sizeof($errors) > 0) {
  // if errors, send the error message
  $str = implode("\n", $errors);
  die("There was an error with your submission!  Please correct the following:\n\n" . $str);
}
$time = date('r');
$body = <<<EOD
Hi!
A message was sent to you from $name on $time.
Here is their message:
$comments
name  : $name
Email : $email 
Address : $address
City : $city
State : $state
Zip : $zip
Phone : $phone
Contact You : $contact_me
Here you : $hear
Looking : $looking
Sell : $sell
Help : $helpful
EOD;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="6;URL=contact.php" />
<title>Kraftech Inc.</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
<div id="wraper">
<div class="header"><img src="images/header.jpg" width="919" height="137" /></div>
<div class="outline">
<div class="menu-bar">
<div class="logo-bal"><img src="images/logo-bal.jpg" width="121" height="44" /></div>
<div class="menu">
            	<ul>
                    <li><a href="index.html">Home</a></li>              
                <li><a href="builderprofile.html" >Builder Profile</a></li>
                    <li><a href="services.html" >Services</a>
                    <ul>
                    <li><a href="newconstruction.html">New Construction</a></li>
                       <li style="border-bottom:none;"><a href="renovation.html" >Renovations/Additions</a></li>
                    </ul>
                    </li>
                   <li><a href="communities.html"  >Communities</a>
                    <ul>
                    <li><a href="canyonwoods.html">Canyon Woods</a></li>
                      <li style="border-bottom:none;"><a href="hiddencanyon.html" >Hidden Canyon</a></li>
                    </ul>
                    </li>
                    <li><a href="gallerymain.html">Gallery</a></li>
                    <li><a href="testimonials.html">Testimonials</a></li>
                   <li><a href="contact.php" class="current" >Contact</a></li>
                    
                </ul>       
</div>
</div>
<div class="clear"></div>
<div class="middle">
<div class="left-col">
  <div class="custom-content">
  <div class="form">
  
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>


<?php
 // send email
 if(mail($your_email, "Contact Form Sent", $body, "From: $your_email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=ISO-8859-1\r\nMIME-Version: 1.0")){
 
     echo "<p><h4>&nbsp;&nbsp;&nbsp;Thank you for filling out the form. Your message has been sent. We will contact you shortly.</h4></p>";
 
   }
 else{
 
   echo "<p><h4>&nbsp;&nbsp;&nbsp; sorry some technical problem.</h4></p>";
   }

?>


  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
 <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
 <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
 <p>&nbsp;</p>
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
<div class="right-col">
<div class="we_can"><a href="custom.php"><img src="images/wecan.jpg" width="202" height="80" border="0" /></a></div>
<div class="community_map"><img src="images/community.jpg" width="202" height="28" /></div>
<div class="map_photo"><a href="communities.html"><img src="images/map.jpg" width="172" height="129"/></a></div>
<div class="featured"><img src="images/featured.jpg" width="202" height="28" /></div>
<div class="featured_photo">
  <p><a href="canyonwoods.html"><img src="images/feature-photo.jpg" width="172" height="119" border="0" /></a>
    </p>
</div>
<div class="mikenna_text">9536 Mikenna Run<br />Canyon Woods</div>
<div class="mikenna_text1">
  <p>City: Macedonia<br />
Bedrooms: 4  &nbsp;&nbsp;&nbsp;Baths: 3<br />
Sq. Ft.: 2,793</p>
  <p>Price: $349,900</p>
</div>
<div class="kaftech"><a href="#"><img src="images/kraftech.jpg" width="168" height="109" border="0" /></a></div>
<div class="number">330.468.2892</div>
<div class="contact_button"><a href="contact.php"><img src="images/contactus.jpg" width="144" height="40" border="0" /></a></div>
</div>

</div>

</div>

<div class="footer-line"><img src="images/footer.jpg" width="919" height="5" /></div>
<div class="footer">
<ul class="footer_list">
                 <li><a href="index.html">Home</a></li>  
                <li><a href="builderprofile.html">Builder Profile</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="communities.html">Communities</a></li>
                <li><a href="gallerymain.html">Gallery</a></li>
                <li ><a href="testimonials.html">Testimonials</a></li>
                 <li class="last"><a href="contact.php">Contact</a></li>
                
      </ul>
           <div class="copy"> Copyright © 2010 <a href="index.html">Kraftech</a> All Rights Reserved</div>           
</div>
</div>
</div>
</div>
</body>
</html>
