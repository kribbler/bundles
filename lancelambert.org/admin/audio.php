<?php
	require_once('includes/header.php');
	require_once('functions/pagination.php');
	require_once('functions/forms.php');
?>
	
	<table><tr><td>
  <h2>Quick Add</h2>
	<?php
		echo $formsource;
	?>
   </td>
   <td valign="top">
  <h2>Search by Reference Number</h2>
    <form action="searchAudio.php" method="get" name="Search" id="Search">
      <input name="search" value="<? echo $search; ?>" id="search" type="textbox">
      <input type="submit" name="Submit" value="Search">
    </form>
  </td></tr></table>
		<h2>Audio</h2>
		<p>
		<?php
			echo $_GET['deleteSuccessful'];
		?>
		</p>
		
		<?php
			$page= new pagination;
			$page->connect("localhost","lancelam_lance","lambert","lancelam_lancelamb");
			$page->setMax(25);      // 25 being number of results to be displaued
			$page->setData("audio","");
			$page->display();
			$page->displayLinks(5,""); // 5 being number of links to display
		?>
		
		


<?php
	require_once('includes/footer.php');
?>