<?php 
include("includes/config.php");
include("includes/clsPaging.php");
///////// Paging Start  /////////
		$pageNum =0;
		$recordsPerPage =  15;
		if(isset($_POST['limitstart']) && $_POST['limitstart']!=0)
				$pageNum = $_POST['limitstart'];
////////     ///        ////////
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kraftech Inc. - Ranch Styles</title>
<meta name="description" content="Kraftech, Inc. is a residential, new construction, custom home builder and home remodeler located in Summit, Geauga, Cuyahoga, Portage, Lorain, Medina, Wayne, Stark, Lake counties of North Eastern Ohio. We are a dynamic, innovative, customer service driven and affordable home builder. We will design and build your new home on your lot or in one of our communities. " />
<meta name="keywords" content="Kraftech Homes, kraftech, homes, homes, custom homes, custom, builder, new construction, craftech, kraftechomes, residential, developer, designer, building, design, build, construction, home plans, house plans, developments, land for sale, home for sale, lots for sale, Cleveland, Ohio, Northeast Ohio, Macedonia, Brecksville, Northfield Village, Portage County, Summit County, Medina, County, Paul Karnow, Home Builders Association, dream home, kraftec, krafttech, kraft-tech, craft-tech, kraft-teck, craft-teck, craftec, crafteck, affordable, Lorain, Medina, Wayne, Stark, Lake, new homes, available homes" />

<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body id="services" oncontextmenu="return false;">
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

<div class="ourhome"><img width="666" height="65" src="images/ranchstyles.jpg"></div>

<div class="interior-content">



<?php

echo '<div class="pic-hold">';

	$_GET['folder']= 'RanchStyles';

	$tbl		=	'tbl_ranchstyles';

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

                <a href="ranchstylesview.php?viewid=<?php echo $data['id'];?>&tbl=<?php echo $tbl; ?>">

                <img style="margin-left:3px;" src="admin/image/RanchStyles/<?php echo $imgname['imgname']; ?>" width="170" height="130" border="0" /></a></div>

                <div class="pic-text">

                <h2><?php echo $data['title']; ?></h2>

                <p><?php echo $data['bdrm']; ?> Bdrm. <?php echo $data['bath']; ?> Bath</p>
   				<p>Ranch Style</p>
                <p><?php echo $data['sqft']; ?>sq. ft.</p> 
                </div>



<div class="viewbtn"><a href="ranchstylesview.php?viewid=<?php echo $data['id'];?>&tbl=<?php echo $tbl; ?>"><img src="images/viewdetails.jpg" width="194" height="26" border="0" /></a></div>

<div class="viewbtn"  <?php if(empty($data['virtualTour'])) echo "style='display:none'";?> >



<?php

  $string = $data['virtualTour'];

    $pos = strpos($string, "http");

    if ($pos === false) { ?>



<a href="admin/videos/RanchStyles/<?php echo $data['virtualTour']; ?>"><img src="images/virtual-tour-gallery.jpg" width="194" height="26" border="0" /></a>



<?php     } else { ?>

       <a href="<?php echo $data['virtualTour']; ?>"  target="_blank"><img src="images/virtual-tour-gallery.jpg" width="194" height="26" border="0" /></a>

<?php   } ?>





</div>



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