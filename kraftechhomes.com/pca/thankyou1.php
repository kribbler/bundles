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
  
  if(isset($_POST['submit']))
  {
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

$message="\n\n
Name: $name\n
Email: $email\n
Address: $address\n
City: $city\n
State: $state\n
Zip: $zip\n
Phone: $phone\n
Contact me: $contact_me\n
How did you hear of us?: $hear\n
When Are You Looking To Move?: $looking\n
We have a home to sell: $sell\n
Was this site helpful?: $helpful\n
Comments:\n
$comments\n\n";

$email="jroberts@netfusionstudios.com";
$title="Customer Service";
$headers="From:\"$name\"<$email>";
  if(mail($email,$title,$message,$headers))
    {
	 echo "<p><h3> &nbsp;&nbsp;Thank you for contacting us. Your message has been sent. We will contact you shortly.</h3></p>";
	
	}
  else {
    echo "Some fields may not have been filled correctly. Hence problem has been encountered";
  
  } 
  
  
  
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
<div class="we_can"><a href="custom.html"><img src="images/wecan.jpg" width="202" height="80" border="0" /></a></div>
<div class="community_map"><img src="images/community.jpg" width="202" height="28" /></div>
<div class="map_photo"><a href="communities.html"><img src="images/map.jpg" width="172" height="129"/></a></div>
<div class="featured"><img src="images/featured.jpg" width="202" height="28" /></div>
<div class="featured_photo">
  <p><a href="canyonwoods.html"><img src="images/feature-photo.jpg" width="172" height="119" border="0" /></a>
    </p>
</div>
<div class="mikenna_text">867 Mikenna Run<br />Canyon Woods</div>
<div class="mikenna_text1">
  <p>City: Macedonia<br />
    Bedrooms:4,  Baths:3,<br />
    Sq. Ft.:2793,</p>
  <p>Price:</p>
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
