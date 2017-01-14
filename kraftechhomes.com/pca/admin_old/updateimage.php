<?php
include("../includes/config.php");

		function fileGetExt($fileName)
			{
				$positionOfDot = strpos($fileName,".");
				$ext = substr($fileName,$positionOfDot+1,strlen($fileName));
				return $ext;
			}
		function uniqfileName($imgfoldername,$fileName,$ext)
			{
				if (file_exists("image/".$imgfoldername."/". $fileName)){
				$positionOfDot 	= 	strpos($fileName,".");
				$filebeforDot 	= 	substr($fileName,0,$positionOfDot);
				$fileName		= 	$filebeforDot.rand(213,2);
				$fileName.='.'.$ext;
				}
				return $fileName;
			}
	
$arraydata=explode("/",$_GET['updateimage']);
$imgfoldername	=	$arraydata[0];
$tbl			=	trim($arraydata[1]).'_img';
$recordid		=	$arraydata[2];

		if(isset($_GET['deleteId'])&& $_GET['deleteId']!=""){
		
					$delete="Delete from $tbl where id=".$_GET['deleteId'];
					mysql_query($delete);
					$affected	=	mysql_affected_rows();
					if($affected>0){
					$msg['dalate']='Record deleted successfully.';
					}
		
		}
		
if(isset($_POST['btnSubmit'])&& $_POST['btnSubmit']=="Update"){
		
				$filename = $_FILES['txtFile']['name'];
				 
				 if(empty($filename)){
						$msg['imageFiles']	=		"Please select file to upload.";
					}
				
				if(empty($msg)){
								
						$filenameExt	=	fileGetExt($filename);
						$valideExt		=	array("bmp", "gif", "jpg", "png", "psd");
						
						if(!in_array($filenameExt,$valideExt)){
						$msg['imageFiles']="<br> Please upload only bmp, gif, jpg, png, psd extension file for image.";
						}				
				 }
				if(empty($msg)){
								 					
				 $filename	=	uniqfileName($imgfoldername,$filename,$filenameExt);			
				 if(move_uploaded_file($_FILES['txtFile']['tmp_name'],"image/".$imgfoldername."/". $filename))
				 {
				 	$updateImage	=	"update $tbl set 
														imgname 	=	 '".$filename."'
														where id	=	 '".$_GET['editid']."'";
					mysql_query($updateImage);
				 }
				 
				
				}
				
				
				
						
}	//isset($_POST['btnSubmit'])
			
		
		
		
		
		
		$selectImg	=	"select * from $tbl where pretableId=$recordid";
		$msquery	=	mysql_query($selectImg);
?>
<body bgcolor="#CCCCCC">
		  <div style="float:left">
          <a style="text-decoration:none" href="admindashboard.php?flag=add">Add Master</a>
		  <p><a style="text-decoration:none" href="listofproduct.php?flag=list">List of product</a>	</p>
          </div>
          
		  <div>
         <table bgcolor="#999999" style="border: solid 1px #666666; padding:5px;" align="center" cellpadding="0" cellspacing="0">
        		<tr height="30px" bgcolor="#DCEFE1">
                	<th width="120px;">Image</th>                                   
                    <th colspan="3" width="200px">Action</th>                    
                </tr>   
                
                 <?php 
				if(isset($msg['dalate'])){?>
                <tr bgcolor="#FFFFFF">
                	<td align="center" colspan="4"><font color="#00FF00" size="+1"><?php echo $msg['dalate']; ?></font></td>
                </tr>
        		<?php } ?>
                        
<?php
		while($data	=	mysql_fetch_assoc($msquery)){?>		
        <tr bgcolor="#D8DCD6">
                	<td height="80px"><img width="100px" src="image/<?php echo $imgfoldername.'/'.$data['imgname']; ?>" /></td>                                   
                    <?php  
					if(isset($_GET['editid'])&& $_GET['editid']==$data['id'])	{	?>
                     <td colspan="2">
                     				<form name="frmImageUpdate" action="" method="post" enctype="multipart/form-data">
                                   		 <input type="file" name="txtFile" /><br />
                                         
                     					<input type="submit" name="btnSubmit" value="Update" /><br>
                                       <font color="#FF0000"> <?php if(isset($msg['imageFiles']))echo $msg['imageFiles'];?></font>
                                    </form>
                     </td> 
					<?php }else{?>                    
                    
                    
                   <td width="50px;" align="center"><a href="updateimage.php?editid=<?php echo $data['id'];?>&updateimage=<?php echo $_GET['updateimage']; ?>& val=<?php echo $_GET['val']; ?>">
                    <img src="image/img/b_edit.png" /></a></td>
                    <td align="center"><a onClick="return confirm('Are you sure you want to delete?')" href="updateimage.php?deleteId=<?php echo $data['id'];?>& updateimage=<?php echo $_GET['updateimage']; ?>">
                    <img src="image/img/b_drop.png" /></a></td>
                                        
					
					
					<?php } ?>
					
                     
                     
                   
                    
        </tr> 
                    	
	<?php 	} ?>
	
    
    </table>
    
    
    </div>
  </body>