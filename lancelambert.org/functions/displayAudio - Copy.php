<?php
class displayAudio {
	function connect($host, $username, $password, $name) {
		$connects=mysql_connect($host, $username, $password) or die(mysql_error());
		$selected=mysql_select_db($name) or die(mysql_error());
	}

	function setInformation($table, $section, $column, $s) {
  $s=($s=='Lance Lambert')?'speaker=\'Lance Lambert\'':'speaker!=\'Lance Lambert\'';
		if(!$section) {
			$this->table = $table;
			$this->section = $section;
			$this->column = $column;
			$this->sql = "SELECT * FROM subSections ORDER BY orderid";
			$this->sql = mysql_query($this->sql) or die(mysql_error());
			while($subSections = mysql_fetch_row($this->sql)) {
				if ($this->column == "left")	$this->choseTable = "SELECT * FROM {$this->table} WHERE ((subSection ='{$subSections[1]}' AND request='enable' AND `column`='{$this->column}') OR (subSection ='{$subSections[1]}' AND request='enable' AND `column`='')) AND {$s} ORDER BY id ASC";
			 else	$this->choseTable = "SELECT * FROM {$this->table} WHERE subSection ='{$subSections[1]}' AND request='enable' AND `column`='{$this->column}' AND {$s} ORDER BY id ASC";
				$this->choseTable = mysql_query($this->choseTable) or die(mysql_error());
    if(mysql_num_rows($this->choseTable)!=0){
    	$this->subSectionName = $subSections[1];
 				$this->displaySubSection();
 			}
			}
		} else {
			$this->table = $table;
			$this->section = $section;
			$this->column = $column;
			/* 		This is set up to load all the sections in from the Sub Sections Table	 */
			if ($this->column == "left") {
				$this->sql = "SELECT * FROM subSections WHERE section = '" . $this->section . "' AND (leftright='".$this->column."' OR leftright='') ORDER BY orderid ASC";
			} else {
				$this->sql = "SELECT * FROM subSections WHERE section = '" . $this->section . "' AND leftright = '".$this->column."' ORDER BY orderid ASC";
			}		
			$this->sql = mysql_query($this->sql) or die(mysql_error());
			/* 		This is set up to load only the tables select by the user	 */
			while ($subSections = mysql_fetch_row($this->sql)) {
				$this->choseTable = "SELECT * FROM " . $this->table . " WHERE subSection ='" . $subSections[1] . "' AND request='enable' AND {$s} ORDER BY id ASC";
				$this->choseTable = mysql_query($this->choseTable) or die(mysql_error());
				if(mysql_num_rows($this->choseTable)!=0){
					$this->subSectionName = $subSections[1];
 				$this->displaySubSection();
 			}
			}
		}
	}
	
	function displaySubSection() {
		if ($this->subSectionName == "None") {
		} else {
			if (stripslashes($this->subSectionName) == "Study Guides With No Audio") echo "<h1 class='audioHeader'>Download the following Study Guides for messages without audio:</h1>";
      else echo "<h1 class='audioHeader'>" . stripslashes($this->subSectionName) . "</h1>";
		}
		echo "<ul>";
		while ($display = mysql_fetch_row($this->choseTable)) {
			//if (stripslashes($this->subSectionName) == "Study Guides With No Audio") print_r($display);
      $messageTitle = stripslashes($display[5]);
			$messageTitle = stripslashes($messageTitle);
			if (stripslashes($this->subSectionName) == "Study Guides With No Audio") echo "<li><a href='pdf/".$display[10]."'>".$messageTitle ." (Right-click to download Study Guide)</a></li>" ;
			else echo "<li><a href='viewAudio.php?id=".$display[0]."' class='audioMessage'>".$messageTitle ."</a></li>";
		}
		echo "</ul>";
	}
}
?>
