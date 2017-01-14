<?php
	class showAudio {
	
		function connect($host, $username, $password, $name) {
			$connects = mysql_connect($host, $username, $password) or die(mysql_error());
			$selected = mysql_select_db($name) or die(mysql_error());
		}
		
		function getInformation($id) {
		
			$this->id = $id;
			
			$this->sql = "SELECT * FROM audio where id='" . $this->id . "'";
			$this->sql = mysql_query($this->sql) or die(mysql_error());
		
		}
		
		function displayInformation() {
			while ($display = mysql_fetch_row($this->sql)) {
			  
				echo "<div class='audioContainer'>";
			 	 //DEBUG print_r($display);
         echo "<h1>" .  stripslashes($display[5])	 . "</h1>";
			 	if($display[12] != "No Audio")
			 	{
          echo "<p class='speakerTitle'>Speaker: " . $display[8] . "</p>";
  				echo '
  				<object type="application/x-shockwave-flash" data="admin/audio/player.swf" id="audioplayer1" height="24" width="290" class="flashPlayer">
  				<param name="movie" value="admin/audio/player.swf">
  				<param name="FlashVars" value="playerID=1&amp;soundFile=/audioFiles/' . $display[2] .'.mp3">
  				<param name="quality" value="high">
  				<param name="menu" value="false">
  				<param name="wmode" value="transparent">
  				</object>
  			 ';
  			 echo "<p>Reference Number: " . $display[2] .  "<br />";
        }
        //var_dump($display);
			 	echo "Scripture Reference: <a href='".$display[3]."' target='_blank'>".$display[4]."</a><br />";
			 	if($display[10]) { //checks for associated pdf file and creates a link based on result.                     
			 	 	echo "<br />";
          echo "Study Guide:<a href=\"pdf/".$display[10]."\">".$display[10]."</a> (Right Click and choose Save As...)";              
			 	 	}
			 	echo "</p>";
			 	if($display[12] != "No Audio") echo "<p class='audioDownloadLink'><a href='/audioFiles/".$display[2].".mp3' target='_blank'>Download</a> (Right Click and choose Save As...)</p>";
			 	
			 	if ($display[9]) {
				 	echo "<p class='audioDownloadLink'><a href='".$display[9]."' target='_blank'>Video</a></p>";
				}
				
			 	echo "<p class='audioDownloadLink'><a href=\"javascript:popUp('sendEmailToFriend.php?id=".$_GET['id']."')\">Email a Friend</a></p>";
			 	
			 	if($display[11]) {
				 	echo "<p>Additional Comments:<br />
				 	".$display[11]."</p>";
           				}
			 	echo "</div>";
			
			}
		}
	}
?>