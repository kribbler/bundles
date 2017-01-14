<?php
	include("../includes/config.php");
?>

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
        $("table#myTable tr:last").after('<tr id=\"myRow'+counter+'\"> 		<td> Image'+counter+' </td>		<td><input type="file" name="imageFiles[]" id="imageFiles" /></td>		<td><a href="#." onClick="test('+counter+');"> Remove </a></td>   </tr>');
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
 
<?php

		function fileGetExt($fileName)
			{
				$positionOfDot = strpos($fileName,".");
				$ext = substr($fileName,$positionOfDot+1,strlen($fileName));
				return $ext;
			}
		function uniqfileName($fileName)
			{
				$positionOfDot 	= strpos($fileName,".");
				$filebeforDot 	= substr($fileName,0,$positionOfDot);
				$uniqfileName	= $filebeforDot.rand(213,2);
				return $uniqfileName;
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
					$valideExt=array("bmp", "gif", "jpg", "png", "psd");
					if(!in_array($filenameExt,$valideExt)){
					$msg['imageFiles']="<br> Please upload only bmp, gif, jpg, png, psd extension file for image $i.";
					}	//$in_array
				}	//foreach
			
			}	//empty($msg)
			$filevirtualTour='';
			if(isset($_FILES['filevirtualTour']['name'])){
			$filevirtualTour		= 	$_FILES['filevirtualTour']['name'];
			$filevirtualTourext		=	fileGetExt($filevirtualTour);
					if($filevirtualTourext=='exe'){
						$filevirtualTour =	uniqfileName($filevirtualTour);
					    $filevirtualTour.='.exe';
						move_uploaded_file($_FILES['filevirtualTour']['tmp_name'],"image/".$_POST['filefoldername']."/". $filevirtualTour);
					}
			}
					
			if(empty($msg)){
				$tbl=$_POST['txttblname'];
				$query		=	"insert into $tbl set
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
				foreach($_FILES['imageFiles']['name'] as $filename){
						
				$filenameExt =	fileGetExt($filename);
				$valideExt=array("bmp", "gif", "jpg", "png", "psd");
				if(in_array($filenameExt,$valideExt)){
													 	
					if (file_exists("image/".$_POST['filefoldername']."/". $filename)){
						$filename	=	uniqfileName($filename);
						$filename.=".".$filenameExt;
						move_uploaded_file($_FILES['imageFiles']['tmp_name'][$i],"image/".$_POST['filefoldername']."/". $filename);
						$i++;
						 
						
					   $inquery="insert into $tbl	set
																pretableId				=	'".$insertId."',
																imgname					=	'".$filename."'";
					
						mysql_query($inquery);
						$id=mysql_insert_id();
						
										
					}	//file_exists
					else{
					   move_uploaded_file($_FILES['imageFiles']['tmp_name'][$i],"image/".$_POST['filefoldername']."/". $filename);
					   $i++;							 
				
					   $inquery="insert into $tbl	set
																pretableId				=	'".$insertId."',
																imgname					=	'".$filename."'";
															
						mysql_query($inquery);
						$id=mysql_insert_id();
						
					   
					}		
				}				//if(in_array(
								
			 }					//foreach
			 
			 
			 if($id>0){
						
						header("location:success.php");	
						}  
			}					//if($insertId>0)
			
										
					
			}
			 
	}
?>


<?php
		$add	=	array('tbl_firstfloormasters'=>"First Floor Masters",'tbl_secondfloormasters'=>"Second Floor Masters",'tbl_ranchstyles'=>"Ranch Styles");
?>

<a style="text-decoration:none" href="admindashboard.php?flag=add">Add Master</a>

<?php
				
				if(isset($_GET['flag'])&& $_GET['flag']=="add")
				{
				echo "<ul>";
				foreach($add as $k=>$val){?>
				<li><a href="admindashboard.php?tbl=<?php echo $k ;?> & val=<?php echo $val; ?>"><?php echo $val; ?></a></li>				
				<?php } 
				echo "</ul>";
				
				}
			
				
				if(isset($_GET['tbl'])&& isset($_GET['val'])){?>
				
                		<form action="" name="frm" enctype="multipart/form-data" method="post">
                        
                 		<div style="background-color:#CCCCCC; width:550px; border:solid 1px #666666; padding:5px; margin-left:400px;">
                        		
                                <p align="center"><b><?php echo $_GET['val']; ?></b></p>
                        			
                			<p>
                                <div style="float:left; min-width:200px">Title</div>		
                                <div><input style="min-width:250px;" type="text" name="txtTitle" value="<?php echo isset($_POST['txtTitle'])?$_POST['txtTitle']:''; ?>" /></div>
                            	<font style="margin-left:200px;" color="#FF0000"><?php if(isset($msg['txtTitle'])){ echo $msg['txtTitle'];}?></font>
                            </p>            	                           		
                            
                                
                                <div style="float:left; min-width:200px">Bedroom </div>	
                                <div><input style="min-width:250px;" type="text" name="txtBdrm" value="<?php echo isset($_POST['txtBdrm'])?$_POST['txtBdrm']:''; ?>" /></div> 
                            	<font style="margin-left:200px;" color="#FF0000"><?php if(isset($msg['txtBdrm'])){ echo $msg['txtBdrm'];}?></font>
                            
                           
                            <p>
                            	<div style="float:left; min-width:200px">Bath</div>	
                                <div><input style="min-width:250px;" type="text" name="txtBath" value="<?php echo isset($_POST['txtBath'])?$_POST['txtBath']:''; ?>" /></div> 
                            	<font style="margin-left:200px;" color="#FF0000"><?php if(isset($msg['txtBath'])){ echo $msg['txtBath'];}?></font>
                           </p>
                           
                          
                            <div style="float:left; min-width:200px">Square foot</div>
                            <div><input style="min-width:250px;" type="text" name="txtSfoot" value="<?php echo isset($_POST['txtSfoot'])?$_POST['txtSfoot']:''; ?>" /></div>
                           	<font style="margin-left:200px;" color="#FF0000"><?php if(isset($msg['txtSfoot'])){ echo $msg['txtSfoot'];}?></font>
                            
                          <p>
                            <div style="float:left; min-width:200px">Extra text</div>
                            <div><input style="min-width:250px;" type="text" name="txtExtratext" value="<?php echo isset($_POST['txtExtratext'])?$_POST['txtSfoot']:''; ?>" /></div>
                           	
                           </p>
                           
                            <p>
                            <div style="float:left; min-width:200px">Virtual Tour</div>
                            <div><input style="min-width:250px;" type="file" name="filevirtualTour" /></div>
                           	
                           </p>
                          
                            <table id="myTable">
                            <tbody>
                            <tr id="myRow0">
                            <td style="min-width:200px" >Image</td>
                            <td width=""><input type="file" name="imageFiles[]" id="imageFiles" />
							<font color="#FF0000"><?php echo isset($msg['imageFiles'])?$msg['imageFiles']:''; ?></font></td>
                            <td width="250"> </td>
                            </tr>
                            </tbody>
                            </table>
                            <a href="#." name="addRow"> + Add URL </a>      
                            <input type='hidden' name='hCount' id='hCount' value='1' />
                            <input type="hidden" name="filefoldername" value="<?php echo $_GET['val']; ?>" />
                            <input type="hidden" name="txttblname" value="<?php echo $_GET['tbl']; ?>" />
                           
                           <p> <div align="center"><input type="submit" name="btnSubmit" value="Add" /></div></p>
                        </div>
                    
                       </form>      	
				
			<?php }
?>
<p><a style="text-decoration:none" href="listofproduct.php?flag=list">List of product</a>	</p>
<p><a style="text-decoration:none" href="ordering/imagefiles.php?order">Order by product</a>	</p>
