<?php 
include("includes/config.php");
include("includes/clsPaging.php");


///////// Paging Start  /////////



		$pageNum =0;

		$recordsPerPage =  30;

		if(isset($_POST['limitstart']) && $_POST['limitstart']!=0)

				$pageNum = $_POST['limitstart'];

////////     ///        ////////

?>
<form name="frmSearch" action="" method="post">

<?php 

    if(isset($_POST['limitstart'])){

        echo "<input type='hidden' name='limitstart' value='".$_POST['limitstart']."' />";

   }

   else{

        echo "<input type='hidden' name='limitstart' value='0' />"; 

    } 

?>

</form>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                   <li><a href="services.html">Services</a>
                    <ul>
                    <li><a href="newconstruction.html">New Construction</a></li>
                      <li><a href="renovation.html">Renovations/Additions</a></li>
                    </ul>
                    </li>
                     <li><a href="communities.html" >Communities</a>
                    <ul>
                    <li><a href="canyonwoods.html">Canyon Woods</a></li>
                      <li><a href="hiddenconyon.html">Hidden Canyon</a></li>
                    </ul>
                    </li>
                    <li><a href="gallerymain.html" class="current">Gallery</a></li>
                    <li><a href="testimonials.html">Testimonials</a></li>
                   <li><a href="contact.php" >Contact</a></li>
                    
                </ul> 
        
</div>

</div>
<div class="clear"></div>
<div class="middle">
<div class="left-col">
<div class="ourhome"><img src="images/ourhomes.jpg" width="666" height="81" /></div>
<div class="ourhome">
<ul>
<li><a href="gallerymain.php">Second Floor Masters</a></li>
<li><a href="firstfloormaster.php">First Floor Masters</a></li>
<li><a href="ranchstyles.php">Ranch Styles</a></li>
</ul>

</div>
<div class="ourhome"><img src="images/second_floor_title_bar.jpg" width="666" height="65" /></div>
<div class="interior-content">

<?php
echo '<div class="pic-hold">';
	$_GET['folder']= 'Second Floor Masters';
	$tbl		=	'tbl_secondfloormasters';
	$tblimg		=	trim($tbl)."_img";
	$select		=	"select * from $tbl order by ordering limit " .$pageNum.",".$recordsPerPage;
	$msquery=mysql_query($select);
	$i=0;
	while($data=mysql_fetch_assoc($msquery)){
	
if($i%3==0){

echo '</div><div class="pic-hold">';
}
?>

<div class="pic-one">
<div class="home-pic">
                	<?php
					 $imgquery 		= 	"select * from  $tblimg where pretableId='".$data['id']."' ORDER BY id ASC limit 1";  
					 $msimgquery	=	mysql_query($imgquery);
					 $imgname		=	mysql_fetch_assoc($msimgquery);
					?>
                <a href="view.php?viewid=<?php echo $data['id'];?>&tbl=<?php echo $tbl; ?>">
                <img style="margin-left:3px;" src="admin/image/<?php echo $_GET['folder']; ?>/<?php echo $imgname['imgname']; ?>" width="180" height="130" border="0" /></a></div>
                <div class="pic-text">
                <h2><?php echo $data['title']; ?></h2>
                <p><?php echo $data['bdrm']; ?> Bdrm. <?php echo $data['bath']; ?> Bath</p>
                <p><?php echo $data['sqft']; ?> sq. ft.<br />
                
                </div>
virtualTour
<div class="viewbtn"><a href="alan.html"><img src="images/viewdetails.jpg" width="194" height="26" border="0" /></a></div>
<div class="viewbtn"  <?php if(empty($data['virtualTour'])) echo "style='display:none'";?> ><a href="admin/image/Second Floor Masters/<?php echo $data['virtualTour']; ?>"><img src="images/virtual-tour-gallery.jpg" width="194" height="26" border="0" /></a></div>

</div>


<?php $i++;}?>

<?php echo '</div>'; ?>

</div>

<div class="pagination">
		<ul id="pagination-flickr">
          <?php 

									$a="select * from $tbl"; 

									$res = mysql_query($a);
											if(mysql_num_rows($res)>0)
											$numRows = mysql_num_rows($res);
											else
											$numRows = 0;
											include_once("includes/clsPaging.php");

											if(isset($_POST['limitstart']))
												$limitstart = $_POST['limitstart'];
											else
												$limitstart = 0;

											$paging = new  mosPageNav($numRows,$limitstart,$recordsPerPage);

											if($numRows>0)

												echo $paging->getListFooter();

											else

												echo "<b>No results found!</b>";  

											

								?>
        </ul> 
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
<div class="contact_button"><a href="contact.html"><img src="images/contactus.jpg" width="144" height="40" border="0" /></a></div>
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
                 <li class="last"><a href="contact.html">Contact</a></li>
                
      </ul>
           <div class="copy"> Copyright © 2010 <a href="index.html">Kraftech</a> All Rights Reserved</div>
            
            
</div>


</div>
</div>
</div>
</body>
</html>