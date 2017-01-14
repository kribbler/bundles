<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php	if(!isset($_GET['flag'])){?>

<div align="center" style="margin-top:100px">
<div align="center" style="background-color:#CCCCCC; height:40px; width:400px; border:#666666; padding:20px;"><font size="+2" color="#33CC00">Your record inserted successfully.</font></div>

</div>
<meta http-equiv="refresh" content="2;url=http://localhost/kraftechhomes/admin/admindashboard.php">
<?php } ?>


<?php	if(isset($_GET['flag'])&& $_GET['flag']=='edit'){?>


<div align="center" style="margin-top:100px">
<div align="center" style="background-color:#CCCCCC; height:40px; width:400px; border:#666666; padding:20px;"><font size="+2" color="#33CC00">Your record updated successfully.</font></div>

</div>
<meta http-equiv="refresh" content="2;url=http://localhost/kraftechhomes/admin/admindashboard.php">

<?php } ?>


</body>
</html>
