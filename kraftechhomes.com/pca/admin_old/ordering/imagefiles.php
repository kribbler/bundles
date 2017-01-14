<?php
	mysql_connect("localhost","root","")or die("server not found");
    mysql_select_db("kraftechhomes")or die ("Database not found.");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
 
<body>


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

     

</script>
<a style="text-decoration:none" href="../admindashboard.php?flag=add">Add Master</a>

<p><a style="text-decoration:none" href="../listofproduct.php?flag=list">List of product</a>	</p>
<p><a style="text-decoration:none" href="imagefiles.php?order">Order by product</a>	</p>
<?php 
$add	=	array('tbl_firstfloormasters'=>"First Floor Masters",'tbl_secondfloormasters'=>"Second Floor Masters",'tbl_ranchstyles'=>"Ranch Styles");
	if(isset($_GET['order']))
				{
				echo "<ul>";
				foreach($add as $k=>$val){?>
				<li><a href="imagefiles.php?tbl=<?php echo $k ;?> & val=<?php echo $val; ?>"><?php echo $val; ?></a></li>				
				<?php } 
				echo "</ul>";
				}
				
				
				if(isset($_POST['submit'])&& $_POST['submit']=="submit"){
						$tbl = $_GET['tbl'];
						foreach($_POST['a'] as $k => $val){
						$k++;
						
						 $query		=	"update $tbl set
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
<script type="text/javascript" charset="utf-8">
		function selectAll(){
			var multi=document.getElementById('a');
			
				for(i=0;i<multi.options.length;i++)
				multi.options[i].selected=true;
			
			
		}
	</script>
    
  <?php if(isset($_GET['tbl'])){?> 
<div style="background-color:#CCCCCC; width:270px; margin-left:400px; border:solid 1px #333333;">
<?php 
	
			if(isset($_GET['val'])) echo "<p align='center'>". $_GET['val']." </p>"; 
			if(isset($msg['update']))echo "<div style='margin-left:30px'><font color='#006600'>".$msg['update']."</font></div><br>";
	
	?>

<form action="" name="frm" enctype="multipart/form-data" method="post">
        
      
       <a onclick="listbox_move('a', 'up')" href="#">up</a>
<a onclick="listbox_move('a', 'down')" href="#">down</a>

<select multiple="multiple" size="10" id="a" name="a[]">    
    
<?php
	echo $squery		=	"select * from ".$_GET['tbl']. "order by ordering";
	$msquery	=	mysql_query($squery);
	while($data	=	mysql_fetch_assoc($msquery)){
	echo "<option value=".$data['id'].">".$data['title']."</option>";
	}
?>	
   
</select>
      <input type="submit" name="submit"  value="submit" onclick="selectAll()"/>  
</form>        

<?php } ?>
</div>
</body>
</html>
