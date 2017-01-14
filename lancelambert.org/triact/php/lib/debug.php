<?php
$g_debug_count=0;

function showArray($level,$ar) {

	$level=1;
	$debug_level=$_SESSION["debug_level"];
//	echo "level: $level; debuglevel: $debug_level; $ar<BR>";
	if ($level>$debug_level) return;
	global $g_debug_count;
	$g_debug_count++;
	echo '
	<a href="#" onClick="document.getElementById(\'debug' . $g_debug_count . '\').style.display=\'block\'; return false;">Show</a>
	<span id="debug' . $g_debug_count. '" style="display:non2e" onClick="document.getElementById(\'debug' . $g_debug_count . '\').style.display=\'none\'; return false;">
	<pre>
	';
	echo "Total: " . count($ar) . "<BR>";
	print_r($ar);
	echo '
	</pre></span><BR>' ;
}
function debug($level,$s) {

	$debug_level=$_SESSION["debug_level"];
//	echo "level: $level; debuglevel: $debug_level; $s<BR>";
	if ($debug_level<$level) return;
	echo str_pad('',1024);
	if (substr($s,0,1)=="<") {
	echo $s;
	} else {
	echo "<pre>$s</pre>";
	}
}
?>