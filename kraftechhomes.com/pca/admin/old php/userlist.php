<?php

session_start();

if( !isset($_SESSION['username']) || $_SESSION['username']=='')

	header("Location:index.php");

 

 	include("includes/config.php");

	include("includes/clsPaging.php"); 

///////// Paging Start  /////////

		$pageNum =0;

		$recordsPerPage =  6;

		if(isset($_POST['limitstart']) && $_POST['limitstart']!=0)

				$pageNum = $_POST['limitstart'];

////////     ///        ////////

?>





<?php 

	if(isset($_GET['deleteId'])&& $_GET['deleteId']!=""){

				$deleteId	= 	$_GET['deleteId'];

				$tbl		=	'users';

				 $del		=	"delete from users where id= $deleteId";

				 mysql_query($del);

				 $affectedrows = mysql_affected_rows();

				 if($affectedrows>0){

					 $msg['delete']="Record deleted successfully.";

				 }

	

	}

	

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>Kraftech Inc. -Users</title>

<meta name="description" content="Kraftech, Inc. is a residential, new construction, custom home builder and home remodeler located in Summit, Geauga, Cuyahoga, Portage, Lorain, Medina, Wayne, Stark, Lake counties of North Eastern Ohio. We are a dynamic, innovative, customer service driven and affordable home builder. We will design and build your new home on your lot or in one of our communities. " />

<meta name="keywords" content="Kraftech Homes, kraftech, homes, homes, custom homes, custom, builder, new construction, craftech, kraftechomes, residential, developer, designer, building, design, build, construction, home plans, house plans, developments, land for sale, home for sale, lots for sale, Cleveland, Ohio, Northeast Ohio, Macedonia, Brecksville, Northfield Village, Portage County, Summit County, Medina, County, Paul Karnow, Home Builders Association, dream home, kraftec, krafttech, kraft-tech, craft-tech, kraft-teck, craft-teck, craftec, crafteck, affordable, Lorain, Medina, Wayne, Stark, Lake, new homes, available homes" />

<link href="../../css/style.css" rel="stylesheet" type="text/css" />

</head>



<body>

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

<div class="left-col"  style="width:900px;">

  <div class="custom-content" style="width:900px;">

  <div class="form">

 <h2>User Managment</h2>

<h3><?php echo $succesms; ?></h3>

<?php 		

 

		$tbl = 'users';

		$squery		=	"select * from users limit " .$pageNum.",".$recordsPerPage;

		$msquery	=	mysql_query($squery);

	

?>

        <table bgcolor="#FAE6BC" style="border: solid 1px #666666; padding:0px; margin:0 0 0 10px;" align="center" cellpadding="5" width="480" cellspacing="0">

        		<tr height="30px" bgcolor="#594638" style="color:#fff; font:bold 12px arial;">

                	<th width="20%">User Name</th>

                    <th width="10%">Password</th>

                    <th width="10%;">Action</th>

                </tr>  

                <?php 

				if(isset($msg['delete'])){?>

                <tr bgcolor="#FFFFFF">

                	<td align="center" colspan="8"><font color="#00FF00" size="+2"><?php echo $msg['delete']; ?></font></td>

                </tr>

        		<?php } ?>

           <?php 

		   $i=0;

            while($data	=	mysql_fetch_assoc($msquery)){  ?>

                <tr height="40px" bgcolor="#FAE6BC" style="color:#000; font:normal 12px arial;">

                    <td align="center"><?php echo $data['username']; ?></td>

                    <td align="center">********</td>

                    <td align="center"><a onClick="return confirm('Are you sure you want to delete?')" href="userlist.php?deleteId=<?php echo $data['id'];?>&amp;tbl=<?php echo $tbl;?>">

                    <img src="image/img/b_drop.png" /></a></td>

                </tr>  

          <?php 

			 }?> 

   <tr>

        <td bgcolor="#fff"  colspan="8">

        <div class="pagination">

        

		<ul id="pagination-flickr">

          <?php 



									$a="select * from users"; 



									$res = mysql_query($a);

											if(mysql_num_rows($res)>0)

											$numRows = mysql_num_rows($res);

											else

											$numRows = 0;



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

        	</td>

		</tr>

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



<div class="footer-line"><img src="images/footer.jpg" width="919" height="5" /></div>

<div class="footer">



<?php include('../../footer.html'); ?>            

            

</div>

</div>

</div>

</div>

</body>

</html>

