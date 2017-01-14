<?php
session_start();
if( !isset($_SESSION['username']) || $_SESSION['username']=='')
	header("Location:index.php");
	
	
	include("includes/config.php");
	
	if(isset($_POST['submit'])&& $_POST['submit']=="submit"){
						foreach($_POST['a'] as $k => $val){
						$k++;
						
						 $query		=	"update  tbl_ranchstyles set
										ordering			=	'".$k."'
										where id		=	'".$val."'";
						 mysql_query($query);				
						 $affected = mysql_affected_rows();
						if($affected>0){
						$msg['update']="Record updated successfully.";
						}
						
						}				
				} 
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Kraftech Inc.</title>
<meta name="description" content="Kraftech, Inc. is a residential, new construction, custom home builder and home remodeler located in Summit, Geauga, Cuyahoga, Portage, Lorain, Medina, Wayne, Stark, Lake counties of North Eastern Ohio. We are a dynamic, innovative, customer service driven and affordable home builder. We will design and build your new home on your lot or in one of our communities. " />
<meta name="keywords" content="Kraftech Homes, kraftech, homes, homes, custom homes, custom, builder, new construction, craftech, kraftechomes, residential, developer, designer, building, design, build, construction, home plans, house plans, developments, land for sale, home for sale, lots for sale, Cleveland, Ohio, Northeast Ohio, Macedonia, Brecksville, Northfield Village, Portage County, Summit County, Medina, County, Paul Karnow, Home Builders Association, dream home, kraftec, krafttech, kraft-tech, craft-tech, kraft-teck, craft-teck, craftec, crafteck, affordable, Lorain, Medina, Wayne, Stark, Lake, new homes, available homes" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />

 <script src="jquery.js" type="text/javascript"></script>
 

<script>
function listbox_move(listID, direction) {
 
    var listbox = document.getElementById(listID);
    var selIndex = listbox.selectedIndex;
 
    if(-1 == selIndex) {
        alert("Please select an option to move.");
        return;
    }
 
    var increment = -1;
    if(direction == 'up')
        increment = -1;
    else
        increment = 1;
 
    if((selIndex + increment) < 0 ||
        (selIndex + increment) > (listbox.options.length-1)) {
        return;
    }
 
    var selValue = listbox.options[selIndex].value;
    var selText = listbox.options[selIndex].text;
    listbox.options[selIndex].value = listbox.options[selIndex + increment].value
    listbox.options[selIndex].text = listbox.options[selIndex + increment].text
 
    listbox.options[selIndex + increment].value = selValue;
    listbox.options[selIndex + increment].text = selText;
 
    listbox.selectedIndex = selIndex + increment;
}

function selectAll(){
			var multi=document.getElementById('a');
			for(i=0;i<multi.options.length;i++)
			multi.options[i].selected=true;
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
<div class="left-col"  style="width:900px;">
  <div class="custom-content" style="width:900px;">
  <div class="form">
 <h2>Ranch Style Home Ordering</h2>
<h3><?php echo $msg['update']; ?></h3>
 
<form action="" name="frm" enctype="multipart/form-data" method="post">
        
<div style="float:left; padding-right:10px; padding-left:200px;">        
<select multiple="multiple" size="10" id="a" name="a[]">    
    
<?php
	echo $squery		=	"select * from   tbl_ranchstyles order by ordering";
	$msquery	=	mysql_query($squery);
	while($data	=	mysql_fetch_assoc($msquery)){
	echo "<option value=".$data['id'].">".$data['title']."</option>";
	}
?>	
</select>
</div>
<div style="float:left;">
    <a style="text-decoration:none;" onclick="listbox_move('a', 'up')" href="#">&uarr; up</a><br><br>
    <a style="text-decoration:none;" onclick="listbox_move('a', 'down')" href="#">&darr; down</a><br><br><br><br><br><br>
	<input type="submit" name="submit"  value="submit" onclick="selectAll()"/>  
</div>
<div style="clear:both"></div>
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
