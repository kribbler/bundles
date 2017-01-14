<?php

session_start();

if( !isset($_SESSION['username']) || $_SESSION['username']=='')

	header("Location:index.php");	

	

	include("includes/config.php");



include("includes/imageprocess.php");

$max_width    = "600";	// Max width allowed for the large image

$max_height  = "400";

$thumb_width  = "600";	// Width of thumbnail image

$thumb_height = "400";	// Height of thumbnail image 	

?>

<?php



		function fileGetExt($fileName)

			{

				$positionOfDot = strpos($fileName,".");

				$ext = substr($fileName,$positionOfDot+1,strlen($fileName));

				return $ext;

			}

 

	if(isset($_POST['btnSubmit'])&& $_POST['btnSubmit']=="Add"){		

			

			if(empty($_POST['txtTitle'])){

				$msg['txtTitle']	=		"Please enter title.";

			} 

			if(empty($_POST['txtBdrm'])){

				$msg['txtBdrm']		=		"Please enter Bedroom.";

			}  

			if(empty($_POST['txtBath'])){

				$msg['txtBath']		=		"Please enter Bath.";

			}  

			if(empty($_POST['txtSfoot'])){

				$msg['txtSfoot']	=		"Please enter Square foot.";

			} 

			

			if(empty($_FILES['imageFiles']['name']['0'])){

				$msg['imageFiles']	=		"Please select file to upload.";

			}

			

			if(empty($msg)){

					$i=0;

					foreach($_FILES['imageFiles']['name'] as $filename){

					$i++;

					$filenameExt =	fileGetExt($filename);

					$valideExt=array("bmp", "gif", "jpg", "png", "psd", "jpeg","BMP", "GIF", "JPG", "PNG", "PSD", "JPEG");

					if(!in_array($filenameExt,$valideExt)){

					$msg['imageFiles']="<br> Please upload only bmp, gif, jpg, png extension image.";

					}	//$in_array

				}	//foreach

			

			}	//empty($msg)

			

			$filevirtualTour='';

			if(isset($_POST['virtualtour']) && $_POST['virtualtour']=='File'){ 

				$filevirtualTour='';

				if(isset($_FILES['filevirtualTour']['name']) && $_FILES['filevirtualTour']['name']!=''){

					$filevirtualTour = str_replace(" ","",$_FILES['filevirtualTour']['name']);

					$filevirtualTour = time().'_'.strtolower($filevirtualTour);

					move_uploaded_file($_FILES['filevirtualTour']['tmp_name'],"videos/RanchStyles/". $filevirtualTour);

 

				}

			}

			

			if(isset($_POST['virtualtour']) && $_POST['virtualtour']=='Link'){ 

				$filevirtualTour= $_POST['filevirtualTourtext'];

			}	

					

			if(empty($msg)){

				$tbl=$_POST['txttblname'];

				$query		=	"insert into tbl_ranchstyles set

										title			=	'".$_POST['txtTitle']."',

										bdrm			=	'".$_POST['txtBdrm']."',				

										bath			=	'".$_POST['txtBath']."',

										sqft			=	'".$_POST['txtSfoot']."',

										extratext 		=	'".$_POST['txtExtratext']."',

										virtualTour		=	'".$filevirtualTour."'";

				$msquery	=	mysql_query($query);

				$insertId	= 	mysql_insert_id();

				

				if($insertId>0){

			

				$i=0;	

				

				 $tbl=trim($tbl);

				 $tbl.='_img';	

		 		 $imagetext ='';

				 

				foreach($_FILES['imageFiles']['name'] as $filename){

					if(!empty($_FILES['imageFiles']['name'])){



							if($_POST['imageFilesText'][$i]!='')

									$imagetext = $_POST['imageFilesText'][$i];

							else

									$imagetext ='';

									

							$filename = str_replace(" ","",$filename);

							$filename = time().'_'.strtolower($filename);	 

							

					   		move_uploaded_file($_FILES['imageFiles']['tmp_name'][$i],"image/RanchStyles/". $filename);

					   ///////////////////

							$large_image_location = "image/RanchStyles/". $filename ; 

							$width  = getWidth($large_image_location);

							$height = getHeight($large_image_location);

							

							if($width>$thumb_width && $height>$thumb_height){

			 					if($height > $max_height){

									$scale = $max_height/$height;

									$uploaded = resizeImage($large_image_location,$width,$height,$scale);

								}else{

									$scale = 1;

									$uploaded = resizeImage($large_image_location,$width,$height,$scale);					

								} 

					

									$width  = getWidth($large_image_location);

									$height = getHeight($large_image_location);

									

								if ($width > $max_width){

									$scale = $max_width/$width;

									$uploaded = resizeImage($large_image_location,$width,$height,$scale);

								}else{

									$scale = 1;

									$uploaded = resizeImage($large_image_location,$width,$height,$scale);

								} 	 	 

							}

					   ///////////////////////////	

					$inquery="insert into tbl_ranchstyles_img set pretableId =	'".$insertId."',imgname	='".$filename."', imagetext='".$imagetext."'";

						mysql_query($inquery);

						$id=mysql_insert_id();

					}		// if(!empty($_ 	

				  $i++;

			 }					//foreach

			 if($id>0){

							$succesms = "<span style='color:#FAE6BC;'>Record Interted Successfully</span>";

							unset($_POST);

			}  

		}	//if($insertId>0)

	}

}

?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Kraftech Inc. - Ranch Styles</title>

<meta name="description" content="Kraftech, Inc. is a residential, new construction, custom home builder and home remodeler located in Summit, Geauga, Cuyahoga, Portage, Lorain, Medina, Wayne, Stark, Lake counties of North Eastern Ohio. We are a dynamic, innovative, customer service driven and affordable home builder. We will design and build your new home on your lot or in one of our communities. " />

<meta name="keywords" content="Kraftech Homes, kraftech, homes, homes, custom homes, custom, builder, new construction, craftech, kraftechomes, residential, developer, designer, building, design, build, construction, home plans, house plans, developments, land for sale, home for sale, lots for sale, Cleveland, Ohio, Northeast Ohio, Macedonia, Brecksville, Northfield Village, Portage County, Summit County, Medina, County, Paul Karnow, Home Builders Association, dream home, kraftec, krafttech, kraft-tech, craft-tech, kraft-teck, craft-teck, craftec, crafteck, affordable, Lorain, Medina, Wayne, Stark, Lake, new homes, available homes" />

<link href="../../css/style.css" rel="stylesheet" type="text/css" />

 <script src="jquery.js" type="text/javascript"></script>

<script type="text/javascript">

var counter = 1;

 <!-- jQuery Code will go underneath this -->

$(document).ready(function () {        

        // Code between here will only run when the document is ready

        $("a[name=addRow]").click(function() {

		 var counter1=  eval(document.getElementById("hCount").value) ; 

		 counter = eval(counter1);

		document.getElementById("hCount").value = eval(counter1 + 1);

        // Code between here will only run when the a link is clicked and has a name of addRow

        $("table#myTable tr:last").after('<tr id=\"myRow'+counter+'\"> 		<td> Image'+counter+' </td>	<td> 	<input type="text" name="imageFilesText[]" id="imageFilesText" />	</td>	<td><input type="file" name="imageFiles[]" id="imageFiles" /></td>		<td><a href="#." onClick="test('+counter+');"> Remove </a></td>   </tr>');

        return false;

  });

});

function test(id){

         //change the background color to red before removing

        $('#myRow'+id).css("background-color","#FF3700");

        $('#myRow'+id).fadeOut(400, function(){

            $('#myRow'+id).remove();

        });

}

</script>

 

</head>



<body>

<div id="container">

<div id="wraper">

<div class="header"><img src="../../images/header.jpg" width="919" height="137" /></div>

<div class="outline">

<div class="menu-bar">

<div class="logo-bal"><img src="../../images/logo-bal.jpg" width="121" height="44" /></div>

<div class="menu">



            	<?php include('nav.html'); ?>

        

</div>



</div>

<div class="clear"></div>

<div class="middle">

<div class="left-col">

  <div class="custom-content">

  <div class="form">

 <h2>Ranch Styles</h2>

<h3><?php echo $succesms; ?></h3>

<form action="" name="frm" enctype="multipart/form-data" method="post">

<table align="center">

<tr>

<td>Title</td>

<td><input style="min-width:250px;" type="text" name="txtTitle" value="<?php echo isset($_POST['txtTitle'])?$_POST['txtTitle']:''; ?>" /></td>

<td><?php if(isset($msg['txtTitle'])){ echo $msg['txtTitle'];}?></td>

</tr>

<tr>

<td>Bedroom</td>

<td><input style="min-width:250px;" type="text" name="txtBdrm" value="<?php echo isset($_POST['txtBdrm'])?$_POST['txtBdrm']:''; ?>" /></td>

<td><?php if(isset($msg['txtBdrm'])){ echo $msg['txtBdrm'];}?></td>

</tr>



<tr>

<td>Bath</td>

<td><input style="min-width:250px;" type="text" name="txtBath" value="<?php echo isset($_POST['txtBath'])?$_POST['txtBath']:''; ?>" /></td>

<td><?php if(isset($msg['txtBath'])){ echo $msg['txtBath'];}?></td>

</tr>



<tr>

<td>Square foot</td>

<td><input style="min-width:250px;" type="text" name="txtSfoot" value="<?php echo isset($_POST['txtSfoot'])?$_POST['txtSfoot']:''; ?>" /></td>

<td><?php if(isset($msg['txtSfoot'])){ echo $msg['txtSfoot'];}?></td>

</tr>                			

                		       	                           		

 <tr>

<td>Description</td>

<td><input style="min-width:250px;" type="text" name="txtExtratext" value="<?php echo isset($_POST['txtExtratext'])?$_POST['txtSfoot']:''; ?>" /></td>

<td></td>

</tr>     

<tr>

<script>

function tourToggle(val){

  if(val=='File'){

  		$("#tourFile").css('display','block');

		$("#tourLink").css('display','none');

  }

  if(val=='Link'){

  		$("#tourFile").css('display','none');

		$("#tourLink").css('display','block');

  }  	

}

</script>

<td>Virtual Tour</td>

<td><input type="radio" name="virtualtour" value="File" onclick="tourToggle(this.value);" />Upload &nbsp; &nbsp; 

<input type="radio" name="virtualtour" value="Link"  onclick="tourToggle(this.value);"/>Link

<br />

<span style="display:none;" id="tourFile"><input style="min-width:250px;" type="file" name="filevirtualTour" /></span>

<span style="display:none;" id="tourLink"><input style="min-width:250px;" type="text" name="filevirtualTourtext" value="" /></span>

</td>

<td>

</td>

</tr>

<tr>

<td colspan="3">





  <table id="myTable"  style="margin-left:0px">

                            <tbody>

                            <tr id="myRow0">

                            <td style="min-width:72px" >Image</td>

                             <td><input type="text" name="imageFilesText[]" id="imageFilesText" />	</td>

                            <td><input type="file" name="imageFiles[]" id="imageFiles" />

							</td>

                            <td><font color="#FF0000"><?php echo isset($msg['imageFiles'])?$msg['imageFiles']:''; ?></font> </td>

                            </tr>

                            </tbody>

                            </table>

                            <a href="#." name="addRow"   style="margin-left:150px"> Add Additional Image </a>      

                            <input type='hidden' name='hCount' id='hCount' value='1' />

                            <input type="hidden" name="filefoldername" value="<?php echo $_GET['val']; ?>" />

                            <input type="hidden" name="txttblname" value="<?php echo $_GET['tbl']; ?>" />

                           <p> <div align="center"><input type="submit" name="btnSubmit" value="Add" /></div></p>

</td>

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





</div>



</div>



<div class="footer-line"><img src="../../images/footer.jpg" width="919" height="5" /></div>

<div class="footer">



<?php include('../../footer.html'); ?>            

            

</div>





</div>

</div>

</div>

</body>

</html>

