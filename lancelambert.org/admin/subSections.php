<?php
	require_once('includes/header.php');
	require_once('functions/pagination.php');
	require_once('functions/addSubSection.php');
?>
	
	<h2>Add Sub Section</h2>
	<?php
		echo $formsource;
	?>

		<h2>Sub Sections</h2>
		<p>
		<?php
			echo $_GET['deleteSuccessful'];
		?>
		</p>
		
		<?php
			$page= new pagination;
			$page->connect("localhost","lancelam_lance","lambert","lancelam_lancelamb");
			$page->setMax(150);      // 25 being number of results to be displaued
			$page->setData("subSections","");
			$page->display4();
			$page->displayLinks(5,""); // 5 being number of links to display
		?>
		
				
		<script type="text/javascript">
		
		Sortable.create("lists",
		{
			onUpdate: function()
			{
				
				new Ajax.Request("functions/updateOrder.php",
				{
					method: "post",
					parameters: { data: Sortable.serialize("lists") }
				});
			}
		});
		</script>



<?php
	require_once('includes/footer.php');
?>