<?php
if(isset($_GET['action']))   //added by tim gane, april 2010. Manage pdf study notes.
  {
    if($_GET['action'] == 'uploadpdf')
    {
     define ("FILEREPOSITORY","../pdf/");
  
     if (is_uploaded_file($_FILES['notes']['tmp_name'])) {
  
        if ($_FILES['notes']['type'] != "application/pdf") {
           echo "<p>Notes must be uploaded in PDF format.</p>";
        } else {
           $name = $_FILES['notes']['name'];
           $name = str_replace(' ', '_', $name);
           $result = move_uploaded_file($_FILES['notes']['tmp_name'], FILEREPOSITORY."$name");
           if ($result == 1)
            {
              $sql = "UPDATE  `audio` SET  `pdf` =  '". $name ."' WHERE  `id` =". $_GET['id'];                
              $conn = mysql_connect('localhost', 'lancelam_lance', 'lambert') or die ('Error connecting to mysql');
              mysql_select_db('lancelam_lancelamb');
              mysql_query($sql);
              header("Location:".$PHP_SELF."?id=".$_GET['id']."&audio=".$_GET['audio']);                                             
            }
           else echo "<p>There was a problem uploading the file.</p>";
        } #endIF
     } #endIF
    }
    else if($_GET['action'] == "deletepdf")
    {              
      $conn = mysql_connect('localhost', 'lancelam_lance', 'lambert') or die ('Error connecting to mysql');
      mysql_select_db('lancelam_lancelamb');        
      $query = "SELECT pdf FROM audio WHERE id = '".$_GET['id']."'";
      $result = mysql_query($query);
      while($row = mysql_fetch_array($result))
        { unlink('../pdf/'.$row['pdf']);}
      $sql = "UPDATE  `audio` SET  `pdf` =  '' WHERE  `id` =". $_GET['id'];
      mysql_query($sql);
      header("Location:".$PHP_SELF."?id=".$_GET['id']."&audio=".$_GET['audio']);
      
    }
  }
	require_once('includes/header.php');
	require_once('functions/pagination.php');
	require_once('functions/form_edit.php');
	
	$audioURL = $_GET['audio'];
	
?>
	

		<h2>Edit</h2>
		<script language="JavaScript" src="audio/audio-player.js"></script>
		<object type="application/x-shockwave-flash" data="audio/player.swf" id="audioplayer1" height="24" width="290">
		<param name="movie" value="audio/player.swf">
		<param name="FlashVars" value="playerID=1&amp;soundFile=/audioFiles/<?php echo $audioURL ?>.mp3">
		<param name="quality" value="high">
		<param name="menu" value="false">
		<param name="wmode" value="transparent">
		</object>
		<?php
			echo $formsource;
		?>
		
		<h2>Upload Study Notes</h2>
		<p><b>NOTE:</b>Uploading a new PDF will not remove current PDF from server. If filenames are the same, it will overwrite PDF.<br />
    <a href="<? echo $PHP_SELF."?id=".$_GET['id']."&audio=".$_GET['audio'];?>&action=deletepdf">Delete Current PDF</a></p>
		<form action="<?php echo $PHP_SELF."?id=".$_GET['id']."&audio=".$_GET['audio']."&action=uploadpdf";?>" enctype="multipart/form-data" method="post">
   Notes (PDF Files):<br /> <input type="file" name="notes" value="" /><br />
   <p><input type="submit" name="submit" value="Submit Notes" /><input type="hidden" name="id" value="<? echo $_GET['id']; ?>"></p>
    </form>
	

<?php
	require_once('includes/footer.php');
?>