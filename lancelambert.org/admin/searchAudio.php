<?php
	require_once('includes/header.php');
	require_once('functions/pagination.php');
	require_once('functions/forms.php');
	
	if (isset($_REQUEST['search'])) $search = $_REQUEST['search'];
	else $search = "";
?>
	
	<h2>Search by Reference Number</h2>
    <form action="searchAudio.php" method="get" name="Search" id="Search">
      <input name="search" value="<? echo $search; ?>" id="search" type="textbox">
      <input type="submit" name="Submit" value="Search">
    </form>      
		<? 
      if ( $search != "" )
      {
        ?>
        <h2>Audio</h2>
        <b>The top 100 Results</b>
    		<p>
    		<?php
    			echo $_GET['deleteSuccessful'];
    		?>
    		</p>
    		
    		<?php
    			$page= new pagination;
    			$page->connect("localhost","lancelam_lance","lambert","lancelam_lancelamb");
    			$page->setMax(100);      // 25 being number of results to be displaued
    			$page->searchData("audio",$_REQUEST['search']);
    			$page->display();
    			$page->displayLinks(5,""); // 5 being number of links to display
    	}
    	else {
      	?>  <b>No Search item entered. Please enter a search term </b>
      	<? } ?>
		  
		


<?php
	require_once('includes/footer.php');
?>