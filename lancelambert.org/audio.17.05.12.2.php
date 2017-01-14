<?php
	require_once("header.php");
	require_once("functions/displayAudio.php");
?>
<div id="main">
	<div align="right">Text size: <a id="increasetextsize" class="increaseFont" href="#">Enlarge</a>&nbsp;&nbsp;&nbsp;<a id="resettextsize" class="resetFont" href="#">Reset</a></div>
	<hr width="100%" color="#999999" size="1" />
<?php
if(!isset($_GET['speaker'])){
 echo '	<div align=center><img src="images/LanceLambert-AudioSection_v2.jpg" usemap="#map"></div><map name="map"><area shape="rect" href="audio.php?speaker=Lance Lambert" coords="0,29,259,96" /><area shape="rect" href="audio.php?speaker=" coords="279,29,538,96" /></map>';
}else{
 if($_GET['speaker']=='Lance Lambert')
 {
  if (!$_GET['section']) {
  	$section="Bible Studies";
  	echo "<p><a href='audio.php?p=1&section=Bible Studies&speaker={$_GET['speaker']}'>Bible Studies</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp <a href='audio.php?p=1&section=Teaching and Devotional&speaker={$_GET['speaker']}'>Teaching and Devotional</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='audio.php?p=1&section=The Jews and Israel&speaker={$_GET['speaker']}'>The Jews and Israel</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='audio.php?p=1&section=Conferences&speaker={$_GET['speaker']}'>Conferences</a></p><h2>Bible Studies</h2>";
  } else {
  	$section =  $_GET['section'];
  	echo "<p><a href='audio.php?p=1&section=Bible Studies&speaker={$_GET['speaker']}'>Bible Studies</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp <a href='audio.php?p=1&section=Teaching and Devotional&speaker={$_GET['speaker']}'>Teaching and Devotional</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='audio.php?p=1&section=The Jews and Israel&speaker={$_GET['speaker']}'>The Jews and Israel</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='audio.php?p=1&section=Conferences&speaker={$_GET['speaker']}'>Conferences</a></p><h2>" . $_GET['section'] . "</h2>";
  }
 }
 else echo '<h2>Messages from other Speakers at Halford House</h2>';
 echo '<font size="-1"><b>Messages with an * have a corresponding study guide.</b></font><br />';
 echo '		<div id="leftColumnAudio">';
 $page= new displayAudio;
 $page->connect("localhost","lancestg_lancest","kb6^mF{1S3&X","lancestg_lancestg");
 $page->setInformation("audio",$section,"left",$_GET['speaker']);
 echo '		</div>
		<div id="rightColumnAudio">';
 $page= new displayAudio;
 $page->connect("localhost","lancestg_lancest","kb6^mF{1S3&X","lancestg_lancestg");
 $page->setInformation("audio",$section,"right",$_GET['speaker']);
	?>
	<?php if($_GET['speaker'] == 'Lance Lambert'): ?>
		<h3 class="audio-header-2">Download Transcripts in additional languages</h3>
		<h1 class="audioHeader">Mandarin</h1>
		<ul>
			<li><a href="/files/CHURCH AT LAODICEA - Mandarin.pdf" target="_blank">老底嘉教會 (中文版)</a></li>
        </ul>
        <h1 class="audioHeader">Italian</h1>
        <ul>
            <li><a href="/files/italian/1/Struttura e crescita della Bibbia.pdf" target="_blank">Struttura e crescita della Bibbia</a></li>
            <li><a href="/files/italian/1/Testo e trasmissione 1.pdf" target="_blank">Testo e trasmissione 1</a></li>
            <li><a href="/files/italian/1/Testo e trasmissione 2.pdf" target="_blank">Testo e trasmissione 2</a></li>
            
            <li><a href="/files/italian/2/Autorità della Bibbia.pdf" target="_blank">Autorità della Bibbia</a></li>
            <li><a href="/files/italian/2/Come studiare la Bibbia - 1.pdf" target="_blank">Come studiare la Bibbia - 1</a></li>
            <li><a href="/files/italian/2/Come studiare la Bibbia - 2.pdf" target="_blank">Come studiare la Bibbia - 2</a></li>
            <li><a href="/files/italian/2/GENESI 1.pdf" target="_blank">GENESI 1</a></li>
            <li><a href="/files/italian/2/Ispirazione e rivelazione - 1.pdf" target="_blank">Ispirazione e rivelazione - 1</a></li>
            <li><a href="/files/italian/2/Ispirazione e rivelazione - 2.pdf" target="_blank">Ispirazione e rivelazione - 2</a></li>
            <li><a href="/files/italian/2/Obbiettivo e proposito della Bibbia 1.pdf" target="_blank">Obbiettivo e proposito della Bibbia 1</a></li>
            <li><a href="/files/italian/2/Obbiettivo e proposito della Bibbia 2.pdf" target="_blank">Obbiettivo e proposito della Bibbia 2</a></li>
		</ul>
	<?php endif; ?>
	<?php
 echo '		</div>';
}
?>
</div>

<div style="clear:both"></div>
<?php require_once("footer.php") ?>
