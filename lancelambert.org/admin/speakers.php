<?php
	require_once('includes/header.php');
	require_once('functions/pagination.php');
	require_once('functions/addSpeaker.php');
?>
	
	<h2>Add Speaker</h2>
	<?php
		echo $formsource;
	?>

		<h2>Speakers</h2>
		<p>
		<?php
			echo $_GET['deleteSuccessful'];
		?>
		</p>
		
		<?php
			$page= new pagination;
			$page->connect("localhost","lancelam_lance","lambert","lancelam_lancelamb");
			$page->setMax(25);      // 25 being number of results to be displaued
			$page->setData("speakers","");
			$page->display3();
			$page->displayLinks(5,""); // 5 being number of links to display
		?>
		
		


<?php
	require_once('includes/footer.php');
?>