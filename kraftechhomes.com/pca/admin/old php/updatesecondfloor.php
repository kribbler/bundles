<?php
session_start();
if( !isset($_SESSION['username']) || $_SESSION['username']=='')
	header("Location:index.php");
	
	include("includes/config.php");

	if(isset($_GET['deleteId'])&& $_GET['deleteId']!=""){
	
			$delete="Delete from tbl_secondfloormasters_img where id=".$_GET['deleteId'];
			mysql_query($delete);
			$affected	=	mysql_affected_rows();
			if($affected>0){
			$msg['dalate']='Record deleted successfully.';
			}
	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Kraftech Inc. - Second Floor Master</title>
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
 <h2>Second Floor Image Details</h2>
<h3><?php echo $succesms; ?></h3>
<?php 
		$selectImg	=	"select * from tbl_secondfloormasters_img where pretableId='".$_GET['id']."'";
 
		$msquery	=	mysql_query($selectImg);
?>
        <table bgcolor="#FAE6BC" style="border: solid 1px #666666; padding:0px; margin:0 0 0 300px;" align="center" cellpadding="5" width="300" cellspacing="0">
        		<tr height="30px" bgcolor="#594638" style="color:#fff; font:bold 12px arial;">
                	<th width="120px;">Image</th>                                   
                    <th colspan="3" width="200px">Action</th>                    
                </tr>   
 
                <?php 
				if(isset($msg['dalate'])){?>
                <tr bgcolor="#FFFFFF">
                	<td align="center" colspan="2"><font color="#00FF00" size="+1"><?php echo $msg['dalate']; ?></font></td>
                </tr>
        		<?php } ?>
                        
<?php
		while($data	=	mysql_fetch_assoc($msquery)){?>		
            <tr height="40px" bgcolor="#FAE6BC" style="color:#000; font:normal 12px arial;">
                	<td height="80px"><img width="100px" src="image/SecondFloorMasters/<?php echo $data['imgname']; ?>" /></td>
                    <td align="center"><a onClick="return confirm('Are you sure you want to delete?')" href="updatesecondfloor.php?deleteId=<?php echo $data['id'];?>&updateimage=<?php echo $_GET['updateimage']; ?>&id=<?php echo $_GET['id']; ?>">
                    <img src="image/img/b_drop.png" /></a>
                    </td>
                                        
		     </tr> 			
					
					<?php } ?>
    </table>
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
