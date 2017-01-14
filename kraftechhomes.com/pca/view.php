<?php

include("includes/config.php");





$tbl		= $_GET['tbl'];

$tblimg		= 'tbl_secondfloormasters_img';

$query		=	"select * from $tbl where id=".$_GET['viewid'] ; 

$msquery	=	mysql_query($query);

$data	=	mysql_fetch_assoc($msquery);



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Kraftech Inc.</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

  <!-- Arquivos utilizados pelo jQuery lightBox plugin -->



  <script type="text/javascript" src="imagelitebox/js/jquery.js"></script>

  

  <script type="text/javascript" src="imagelitebox/js/jquery.lightbox-0.5.js"></script>

  <link rel="stylesheet" type="text/css" href="imagelitebox/css/jquery.lightbox-0.5.css" media="screen" />

  <!-- / fim dos arquivos utilizados pelo jQuery lightBox plugin -->

  

   <!-- Ativando o jQuery lightBox plugin -->

  <script type="text/javascript">

  

  $(document).ready(function(){

      $(function() {
        $('#gallery a').lightBox();
    });
 });

  

	

	

    </script>

    

    	<style type="text/css">

	/* jQuery lightBox plugin - Gallery style */

	

	#gallery ul { list-style: none; }

	#gallery ul li { display: inline; }

	

		.slide-img1 {

    border: 3px solid #FFFFFF;

    float: left;

    height: 100px;

    margin: 3px 0 4px 5px;

    padding: 2px;

    width: 100px;

}

	

	</style>

  <!--

<script src="js/prototype.js" type="text/javascript"></script>

	<script src="js/scriptaculous.js" type="text/javascript"></script>

    <script src="js/builder.js" type="text/javascript"></script>

     <script src="js/effects.js" type="text/javascript"></script>

	<script src="js/lightbox.js" type="text/javascript"></script>
-->
</head>



<body  oncontextmenu="return false;">

<div id="container">

<div id="wraper">

<div class="header"><img src="images/header.jpg" width="919" height="137" /></div>

<div class="outline">

<div class="menu-bar">

<div class="logo-bal"><img src="images/logo-bal.jpg" width="121" height="44" /></div>

<div class="menu">

 <?php include('nav.html'); ?> 

        

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

<div class="floor-hold">

<div class="floorplan"><img src="images/floorplan.jpg" width="200" height="86" />

  

  <h2><?php echo $data['title']; ?></h2>

  <p><?php echo $data['bdrm']; ?>  Bdrm. <?php echo $data['bdrm']; ?>  Bath</p>

   <p>Second Floor Master</p>

  <p><?php echo $data['sqft']; ?> sq. ft.</p>

</div>

<?php if($data['virtualTour']!='' && $data['virtualTour']!='0'){ ?>

<div class="gallery-btn">

<?php

  $string = $data['virtualTour'];

    $pos = strpos($string, "http");

    if ($pos === false) { ?>

<a href="admin/videos/SecondFloorMasters/<?php echo $data['virtualTour']; ?>"><img src="images/virtual-tour.jpg" width="200" height="32" border="0" /></a>

<?php     } else { ?>

       <a href="<?php echo $data['virtualTour']; ?>"  target="_blank"><img src="images/virtual-tour.jpg" width="200" height="32" border="0" /></a>

<?php   } ?>

</div>

<?php   } ?>

<div class="gallery-btn"><a href="contact.php"><img src="images/request.jpg" width="200" height="32" border="0" /></a></div>

  <div class="gallery-btn"><a href="gallerymain.php"><img src="images/backtogallery.jpg" width="200" height="32" border="0" /></a></div>

</div>



<div class="slideshow">

<div id="gallery">

		

        		

<?php 

 					$imgquery 		= 	"select * from  $tblimg where pretableId='".$data['id']."' ORDER BY id ASC  LIMIT 1";  

					

					 $msimgquery	=	mysql_query($imgquery);

 

					while($imgname		=	mysql_fetch_assoc($msimgquery)){?>					



		 <div style="display:block;">   				

                    <a href="admin/image/SecondFloorMasters/<?php echo $imgname['imgname']; ?>"  rel="lightbox[roadtrip]"  title="<?php echo $imgname['imagetext']; ?>" >

                    <img src="admin/image/SecondFloorMasters/<?php echo $imgname['imgname']; ?>" width="465" height="344" alt="" />

                    </a>

           </div>

       				 <?php  }?>

                     

<span class="text" style="text-align:center">click image to view slide show</span> 



<span class="text" style="text-align:left;margin-top:30px;"><b><?php echo $data['extratext']; ?> </b></span> 

                     

	<?php	

		    $imgquery 		= 	"select * from  $tblimg where pretableId='".$data['id']."' ORDER BY id ASC LIMIT 1,30";  

			$msimgquery	=	mysql_query($imgquery);

			while($imgname		=	mysql_fetch_assoc($msimgquery)){  ?>

 			<div  class="slide-img1">   				

                    <a href="admin/image/SecondFloorMasters/<?php echo $imgname['imgname']; ?>"  rel="lightbox[roadtrip]" title="<?php echo $imgname['imagetext']; ?>" >

                    <img src="admin/image/SecondFloorMasters/<?php echo $imgname['imgname']; ?>" width="100" height="100" alt="" />

                    </a>

           </div>

           <?php   } ?> 

   
</div>
</div>



</div>

 





</div>

<div class="right-col"> 

 <?php include('sidebar.html'); ?>

</div>



</div>



</div>



<div class="footer-line"><img src="images/footer.jpg" width="919" height="5" /></div>

<div class="footer"> 

 <?php include('footer.html'); ?>  

</div>





</div>

</div>

</div>

</body>

</html>