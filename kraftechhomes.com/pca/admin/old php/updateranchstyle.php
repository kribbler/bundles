<?php

session_start();
if($_REQUEST)
{
	extract($_REQUEST);
}

if( !isset($_SESSION['username']) || $_SESSION['username']=='')

	header("Location:index.php");

	

	include("includes/config.php");

	

	if(isset($_GET['deleteId'])&& $_GET['deleteId']!=""){

	

			$delete="Delete from tbl_ranchstyles_img where id=".$_GET['deleteId'];

			mysql_query($delete);

			$affected	=	mysql_affected_rows();

			if($affected>0){

			$msg['dalate']='Record deleted successfully.';

			}

	

	}

//---------------------Set Order
	if(isset($_POST['submit'])=="Set Order")
	{
		 $imgId= implode(",",$img_id);
		 
		$CountOrder=sizeof($img_id);
		for($i=0; $i<$CountOrder; $i++)
		{
		$upd="UPDATE tbl_ranchstyles_img SET  img_order='".$img_order[$i]."' where id='".$img_id[$i]."' AND pretableId='".$_GET['id']."' ";
		$UpdRes=mysql_query($upd);
		}
		
		echo '<script>window.location.href="updateranchstyle.php?updateimage=&id='.$_GET['id'].' "</script>>';
		
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>Kraftech Inc. - Ranch Styles</title>

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

           	<?php include('nav.html'); ?>

</div>

</div>

<div class="clear"></div>

<div class="middle">

<div class="left-col"  style="width:900px;">

  <div class="custom-content" style="width:900px;">

  <div class="form">

 <h2>Ranch Styles Image Details</h2>

<h3><?php if(empty($succesms)){echo "";}else{ echo $succesms;} ?></h3>

<?php 

		$selectImg	=	"select * from tbl_ranchstyles_img where pretableId='".$_GET['id']."' ORDER BY img_order asc";

 

		$msquery	=	mysql_query($selectImg);

?>
<form name="order" id="order" action="" method="post">
        <table bgcolor="#FAE6BC" style="border: solid 1px #666666; padding:0px; margin:0 0 0 300px;" align="center" cellpadding="5" width="400" cellspacing="0">

        		<tr height="30px" bgcolor="#594638" style="color:#fff; font:bold 12px arial;">

                	<th width="120px;">Image</th>                                   

                    <th  width="50px">Order</th> 
                    <th colspan="2" width="200px">Action</th>                    

                </tr>   

 

                <?php 

				if(isset($msg['dalate'])){?>

                <tr bgcolor="#FFFFFF">

                	<td align="center" colspan="2"><font color="#00FF00" size="+1"><?php echo $msg['dalate']; ?></font></td>

                </tr>

        		<?php } ?>

                        

<?php

		while($data	=	mysql_fetch_assoc($msquery)){
		
			$Id= $data['id'];
		?>		

            <tr height="40px" bgcolor="#FAE6BC" style="color:#000; font:normal 12px arial;">

                	<td height="80px"><img width="100px" src="image/RanchStyles/<?php echo $data['imgname']; ?>" /></td>
                    <td height="80px">
                    <input type="hidden" name="img_id[]" id="img_id" value="<?php echo $data['id']; ?>" size="7" />
                    <input type="text" name="img_order[]" id="img_order" value="<?php  echo $data['img_order']; ?>" size="7" /></td>

                    <td align="center"><a onClick="return confirm('Are you sure you want to delete?')" href="updateranchstyle.php?deleteId=<?php echo $data['id'];?>&updateimage=<?php echo $_GET['updateimage']; ?>&id=<?php echo $_GET['id']; ?>">

                    <img src="image/img/b_drop.png" /></a>

                    </td>

                                        

		     </tr> 			

					

					<?php }?>
                    
                    <tr height="40px" bgcolor="#FAE6BC" style="color:#000; font:normal 12px arial;">
					<?php if($Id){ ?>
                	<td colspan="3" align="center"><input type="submit" id="submit" name="submit" value="Set Order"  /></td>
                    <?php } else{ ?>
                    <td colspan="3" align="center">Sorry, Records not available !.</td>
                     <?php }?>
                    
                   </tr> 
                   

                                        

		     		

    </table>
</tr>
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



<div class="footer-line"><img src="../images/footer.jpg" width="919" height="5" /></div>

<div class="footer">



<?php include('../footer.html'); ?>            

            

</div>





</div>

</div>

</div>

</body>

</html>

