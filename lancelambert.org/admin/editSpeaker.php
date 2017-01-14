<?php
	require_once('includes/header.php');
	require_once('functions/pagination.php');
	require_once('functions/editSpeaker.php');
	
	$audioURL = $_GET['audio'];
?>
	

		<h2>Edit</h2>

		<?php
			echo $formsource;
		?>
		

<?php
	require_once('includes/footer.php');
?>