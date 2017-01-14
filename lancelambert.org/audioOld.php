
	<? require_once("header.php"); ?>
	<? require_once("functions/displayAudio.php"); ?>
	<div id="main">
	<div align="right">Text size: <a id="increasetextsize" class="increaseFont" href="#">Enlarge</a>&nbsp;&nbsp;&nbsp;<a id="resettextsize" class="resetFont" href="#">Reset</a></div>
	<hr width="100%" color="#999999" size="1" />
	
	<?php
		if (!$_GET['section']) {
		$section="Bible Studies";
		echo "
			<p><a href='audio.php?p=1&section=Bible Studies'>Bible Studies</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp <a href='audio.php?p=1&section=Teaching and Devotional'>Teaching and Devotional</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='audio.php?p=1&section=The Jews and Israel'>The Jews and Israel</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='audio.php?p=1&section=Conferences'>Conferences</a></p>
			<h2>Bible Studies</h2>
			";
		} else {
		$section =  $_GET['section'];
			echo "
				<p><a href='audio.php?p=1&section=Bible Studies'>Bible Studies</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp <a href='audio.php?p=1&section=Teaching and Devotional'>Teaching and Devotional</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='audio.php?p=1&section=The Jews and Israel'>The Jews and Israel</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='audio.php?p=1&section=Conferences'>Conferences</a></p>
				<h2>" . $_GET['section'] . "</h2>
				";
		}
	?>
	

		
		<div id="leftColumnAudio">
			<?php
						
			$page= new displayAudio;
			$page->connect("localhost","lancestg_lancest","kb6^mF{1S3&X","lancestg_lancestg");
			$page->setInformation("audio",$section,0,11);
/* 			$page->displaySubSection(); */
			
/* 			$page->connect("localhost","root","root","lancelambert"); */
/* 			$page->setMax(25);      // 25 being number of results to be displaued */
/* 			$page->setData("audio","Austin 3:16"); */
/* 			$page->display2(); */
/* 			$page->displayLinks(5, $_GET['section']); // 5 being number of links to display */
			?>
		</div>
		
		<div id="rightColumnAudio">
		<?php
			$page= new displayAudio;
			$page->connect("localhost","lancestg_lancest","kb6^mF{1S3&X","lancestg_lancestg");
			$page->setInformation("audio",$section,11,30);
		?>
		</div>
		<?php
			/*
$page= new pagination;
			$page->connect("localhost","root","root","lancelambert");
			$page->setMax(25);      // 25 being number of results to be displaued
			$page->setData("audio",$_GET['section']);
			$page->display2();
			$page->displayLinks(5, $_GET['section']); // 5 being number of links to display
*/
		?>

		</div>
		<div style="clear:both"></div>
			<?require_once("footer.php") ?>