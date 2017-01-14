<?php
	include("../includes/config.php");
	include("../includes/clsPaging.php");


///////// Paging Start  /////////



		$pageNum =0;

		$recordsPerPage =  6;

		if(isset($_POST['limitstart']) && $_POST['limitstart']!=0)

				$pageNum = $_POST['limitstart'];

////////     ///        ////////

?>
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

<?php 
	if(isset($_GET['deleteId'])&& $_GET['deleteId']!=""){
				 $deleteId	= 	$_GET['deleteId'];
				 $tbl		=	$_GET['tbl'];
				 $tblimg	=	trim($tbl).'_img';
				 
				 $del		=	"delete from $tbl where id= $deleteId";
				 mysql_query($del);
				 
				 $delimg	=	"delete from $tblimg where pretableId= $deleteId";
				 mysql_query($delimg);
				 
				 $affectedrows = mysql_affected_rows();
				 if($affectedrows>0){
				 $msg['delete']="Record deleted successfully.";
				 }
	
	}
	
	
	echo '<a style="text-decoration:none" href="admindashboard.php?flag=add">Add Master</a>';
	echo '<p><a style="text-decoration:none" href="listofproduct.php?flag=list">List of product</a>	</p>';
	
	
	
	if(isset($_GET['flag'])&& $_GET['flag']=="list"){
				$list	=	array('tbl_secondfloormasters'=>"Second Floor Masters",'tbl_firstfloormasters'=>"First Floor Masters",'tbl_ranchstyles'=>"Ranch Styles");
				
				echo "<ul>";
				foreach($list as $k=>$val){?>
				<li><a style="text-decoration:none" href="listofproduct.php?tbl=<?php echo $k ;?> & val=<?php echo $val; ?>"><?php echo $val; ?></a></li>				
				<?php } 
				echo "</ul>";	
				}
				
				
	if(isset($_GET['tbl'])&& $_GET['tbl']!=""){
		
		$tbl		=	$_GET['tbl'];
		$tblimg		=   trim($tbl).'_img';
		$squery		=	"select * from $tbl limit " .$pageNum.",".$recordsPerPage;
		$msquery	=	mysql_query($squery);
		
		
		
		?>
      
        <table bgcolor="#999999" style="border: solid 1px #666666; padding:5px;" align="center" cellpadding="0" cellspacing="0">
        		<tr height="30px" bgcolor="#D8DCD6">
                	<th width="200px;">Name</th>
                    <th width="50px;">B.room</th>
                    <th width="100px;">Bath</th>
                    <th width="130px;">S.foot</th>
                    <th width="100px;">Extra text</th>
                    <th width="100px;">Image</th>
                    <th colspan="2"width="80px;">Action</th>
                    
                </tr>  
                <?php 
				if(isset($msg['delete'])){?>
                <tr bgcolor="#FFFFFF">
                	<td align="center" colspan="8"><font color="#00FF00" size="+2"><?php echo $msg['delete']; ?></font></td>
                </tr>
        		<?php } ?>
           <?php 
		   $i=0;
            while($data	=	mysql_fetch_assoc($msquery)){$i++; if($i%2==0){ ?>
		        
                <tr height="40px" bgcolor="#DDFFEE">
                	<td><?php echo $data['title']; ?></td>
                    <td align="center"><?php echo $data['bdrm']; ?></td>
                    <td align="center"><?php echo $data['bath']; ?></td>
                    <td align="center"><?php echo $data['sqft']; ?></td>
                    <td align="center"><?php echo $data['extratext']; ?></td>
                    
                    <td align="center">
					
					<?php
					 $selectimg		=	"select * from $tblimg where pretableId=".$data['id'].' ORDER BY id ASC limit 1'; 
					 $mquery		=	mysql_query($selectimg);
					 $img 			=	mysql_fetch_assoc($mquery);
					 
					 ?>
                    <img width="50px" src="image/<?php echo $_GET['val'].'/'.$img['imgname'];?>" />
                    
                    </td>
                    
                    <td align="center"><a href="productedit.php?editid=<?php echo $data['id'];?>& tbl=<?php echo $tbl;?>& val=<?php echo $_GET['val']; ?>">
                    <img src="image/img/b_edit.png" /></a></td>
                    <td align="center"><a onclick="return confirm('Are you sure you want to delete?')" href="listofproduct.php?deleteId=<?php echo $data['id'];?>& tbl=<?php echo $tbl;?>& val=<?php echo $_GET['val']; ?> ">
                    <img src="image/img/b_drop.png" /></a></td>
                   
                    
                </tr>  
           <?php }else{ ?>
           		 <tr height="40px" bgcolor="#DDDDEE">
                 
                	<td><?php echo $data['title']; ?></td>
                    <td align="center"><?php echo $data['bdrm']; ?></td>
                    <td align="center"><?php echo $data['bath']; ?></td>
                    <td align="center"><?php echo $data['sqft']; ?></td>
                    <td align="center"><?php echo $data['extratext']; ?></td>
                    <td align="center">
					<?php
					 $selectimg		=	"select * from $tblimg where pretableId=".$data['id'].' ORDER BY id ASC limit 1'; 
					 $mquery		=	mysql_query($selectimg);
					 $img 			=	mysql_fetch_assoc($mquery);					 
					 ?>
                    <img width="50px;" src="image/<?php echo $_GET['val'].'/'.$img['imgname'];?>" />
                    </td>
                    
                   <td align="center"><a href="productedit.php?editid=<?php echo $data['id'];?>& tbl=<?php echo $tbl; ?>& val=<?php echo $_GET['val']; ?>">
                    <img src="image/img/b_edit.png" /></a></td>
                    <td align="center"><a onclick="return confirm('Are you sure you want to delete?')" href="listofproduct.php?deleteId=<?php echo $data['id'];?>& tbl=<?php echo $tbl; ?>& val=<?php echo $_GET['val']; ?> ">
                    <img src="image/img/b_drop.png" /></a></td>
                                     
                </tr>  
            <?php }
			
			 }?> 
               
                
   <tr>
        <td bgcolor="#EAEAEA"  colspan="8">
        <div class="pagination">
        
		<ul id="pagination-flickr">
          <?php 

									$a="select * from $tbl"; 

									$res = mysql_query($a);
											if(mysql_num_rows($res)>0)
											$numRows = mysql_num_rows($res);
											else
											$numRows = 0;
											include_once("../includes/clsPaging.php");

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
		
<?php }?>
<p><a style="text-decoration:none" href="ordering/imagefiles.php?order">Order by product</a>	</p>