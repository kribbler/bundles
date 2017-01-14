<?php
class pagination {
	var $p=1, $max_r, $limits;
	var $count_all=0, $sql, $total,$table,$totalres,$totalpages;
	var $r, $i;
	var $show=10;
	
	function connect($host, $username, $password, $name) {
		$connects = mysql_connect($host, $username, $password) or die(mysql_error());
		$selected = mysql_select_db($name) or die(mysql_error());
	}
	
	function setMax($max_r) {
		$this->p = $_GET['p'];
		$this->max_r = $max_r;
		if(empty($this->p)) {
			$this->p = 1;
		}
		$this->limits = ($this->p -1) * $this->max_r;
	}
	
	
	function setData($table, $section) {
		if (!$section) {
			$this->table = $table;
			$this->sql = "SELECT * FROM " . $this->table . " ORDER BY id ASC  LIMIT " . $this->limits . "," . $this->max_r . "";
			$this->sql = mysql_query($this->sql) or die(mysql_error());
			$this->total = "SELECT * FROM " . $this->table . "";
			$this->totalres = mysql_query($this->total) or die(mysql_error());
			$this->count_all = mysql_num_rows($this->totalres); // count all the rows
			$this->totalpages = ceil($this->count_all / $this->max_r); // work out total pages
		} else {
			$this->table = $table;
			$this->sql = "SELECT * FROM " . $this->table . " WHERE section = '" . $section . "' ORDER BY id ASC  LIMIT " . $this->limits . "," . $this->max_r . "";
			//echo $this->sql;
			$this->sql = mysql_query($this->sql) or die(mysql_error());
			$this->total = "SELECT * FROM " . $this->table . " WHERE section = '" . $section . "'";
			$this->totalres = mysql_query($this->total) or die(mysql_error());
			$this->count_all = mysql_num_rows($this->totalres); // count all the rows
			$this->totalpages = ceil($this->count_all / $this->max_r); // work out total pages
		}
	}
	
	function searchData ($table, $refnumber)
	{
    $this->table = $table;    
		$this->sql = "SELECT * FROM " . $this->table . " WHERE reference LIKE '" . $refnumber . "%' ORDER BY id ASC";		
		$this->sql = mysql_query($this->sql) or die(mysql_error());
		$this->total = "SELECT * FROM " . $this->table . " WHERE reference LIKE '" . $refnumber . "%'";;
		$this->totalres = mysql_query($this->total) or die(mysql_error());
		$this->count_all = mysql_num_rows($this->sql); // count all the rows
  }
	
	function display() {
		echo "<strong>Total Value(s):</strong> " . $this->count_all . "<br /><br />";
		echo "<strong>Page:</strong> " . $this->p . "<br />";
		$fields = mysql_num_fields($this->totalres); // work out number of fields
		echo "<table border='0' width=100% style='font-size:10px;'>";
	 echo "
			<tr style='font-weight:bold'>
				<td style='padding:5px'>Price</td>
				<td style='padding:5px'>Reference Number</td>
				<td style='padding:5px'>Scripture Link</td>
				<td style='padding:5px'>Scripture Reference</td>
				<td style='padding:5px'>Title</td>
				<td style='padding:5px'>User</td>
				<td style='padding:5px'>Section</td>
				<td style='padding:5px'>Speakers' Name</td>
				<td style='padding:5px'>Categories</td>
				<td style='padding:5px'>&nbsp;</td>
			</tr>
		 ";
	 $bgcolor = "#FFFFFF";
  while ($row = mysql_fetch_array($this->sql)) 		  { 
   echo "<tr style='background:".$bgcolor.";'>";
   for ($f=1; $f < ($fields - 1); $f++) 		    {
				echo "<td style='padding:5px'>" . $row[$f]. "</td>"; 
 		}	
			if ($bgcolor == "#FFFFFF") {
				$bgcolor = "#cde0f8";
			} else {
				$bgcolor = "#FFFFFF";
			}
	  if ($row[request] == "disable") {
		  echo "<td style='padding:5px'><a href='enableDisable.php?id=".$row[0]."&request=enable&pageNum=".$_GET['p']."'><strong>Enable</strong></a></td>";
	  } else {
	  	echo "<td style='padding:5px'><a href='enableDisable.php?id=".$row[0]."&request=disable'><strong>Disable</strong></a></td>";
	  }
	  echo "<td style='padding:5px'><a href='editAudio.php?id=".$row[0]."&audio=".$row[2]."'>Edit</a></td>";
	  echo "<td style='padding:5px'><a href='deleteAudio.php?id=".$row[0]."&delete=yes'>Delete</a></td>";
	  echo "</tr>\n";
	 }
	 echo "</table><p>";
	}
	
	function display2() {
		echo "<p><strong>Total Value(s):</strong> " . $this->count_all . "<br />";
		echo "<strong>Page:</strong> " . $this->p . "<br /></p>";
		
		$fields = mysql_num_fields($this->totalres); // work out number of fields
		
		// echo "<table border='0' width=100%>";
		// 	$bgcolor = "#FFFFFF";
		// 	 
		  while ($row = mysql_fetch_row($this->sql)) 
		  { 
		     echo "<div class='audioContainer'>";
			 echo "<h1>" .  $row[5] . "</h1>";
			 echo "<p class='speakerTitle'>Speaker: " . $row[8] . "</p>";
			echo '
				<object type="application/x-shockwave-flash" data="admin/audio/player.swf" id="audioplayer1" height="24" width="290" class="flashPlayer">
				<param name="movie" value="admin/audio/player.swf">
				<param name="FlashVars" value="playerID=1&amp;soundFile=admin/uploads/' . $row[2] .'.mp3">
				<param name="quality" value="high">
				<param name="menu" value="false">
				<param name="wmode" value="transparent">
				</object>
			 ';
			
			 
	 		 echo "<p>Reference Number: " . $row[2] .  "<br />";
			 echo "Scripture Reference: <a href='".$row[4]."' target='_blank'>".$row[3]."</a></p>";
			 echo "<p class='audioDownloadLink'><a href='admin/uploads/".$row[3].".mp3'>Download</a></p>";
			 echo "</div>";
			// if ($bgcolor == "#FFFFFF") {
			// 			$bgcolor = "#cde0f8";
			// 		} else {
			// 			$bgcolor = "#FFFFFF";
			// 		}
			// 		
		    // for ($f=1; $f < $fields; $f++) 
		    // 		    {
		    // 		       echo "<td class='tableCell".$f."'>$row[$f]</td>"; 
		    // 		    }
		  // echo "</tr>\n";
		  }
		  // echo "</table><p>";
	}
	
	function display3() {
		echo "<strong>Total Value(s):</strong> " . $this->count_all . "<br /><br />";
		echo "<strong>Page:</strong> " . $this->p . "<br />";
		
		$fields = mysql_num_fields($this->totalres); // work out number of fields
		
		echo "<table border='0' width=50% style='font-size:10px;'>";
		
		 echo "
			<tr style='font-weight:bold'>
				<td style='padding:5px'>Speaker</td>
			</tr>
		 ";
		 
		  $bgcolor = "#FFFFFF";
		  while ($row = mysql_fetch_row($this->sql)) 
		  { 
		     echo "<tr style='background:".$bgcolor.";'>";
		    for ($f=1; $f < $fields; $f++) 
		    {
			
					echo "<td style='padding:5px'>" . $row[$f]. "</td>"; 
			}	
				
				if ($bgcolor == "#FFFFFF") {
					$bgcolor = "#cde0f8";
				} else {
					$bgcolor = "#FFFFFF";
				}
		       
		    
		  echo "<td style='padding:5px'><a href='editSpeaker.php?id=".$row[0]."'>Edit</a></td>";
		  echo "<td style='padding:5px'><a href='deleteSpeaker.php?id=".$row[0]."&delete=yes'>Delete</a></td>";
		  echo "</tr>\n";
		  }
		  echo "</table><p>";
	}
	
	/*  Display Divides	 */
	
	function display4() {
		
		require('functions/getList.php');
		$sortLists = new getList();
		$list = $sortLists->getList();
		$setBG = "even";
		
		echo "<ul id='lists' style='list-style:none;'>\n";
		
		foreach($list as $item) {
		    echo "<li class=\"" . $setBG . "\" id='item_" . $item['catid'] . "' >\n";
		    echo "<p onMouseUp=\"new Effect.Highlight(this.parentNode, { startcolor: '#ffff99',
endcolor: '#cde0f8' }); return false;\" onMouseOver=\"new Effect.Opacity(this.parentNode, { from: 1, to: .5 }); return false;\" onMouseOut=\"new Effect.Opacity(this.parentNode, { from: .5, to: 1 }); return false;\"><strong>" . $item['subSection'] . "</strong> <br />";
		    echo $item['section'];		    
		  	echo "  |  <a href='editSubSections.php?id=".$item['id']."'>Edit</a>   |   ";
		  	echo "<a href='deleteSubSection.php?id=".$item['id']."&delete=yes'>Delete</a></p>\n";
		  	echo "</li>\n";
		  	
		  	if ($setBG == "even") {
				$setBG = "odd";
			} else {
				$setBG = "even";
			}
				
		  }
		  echo "</ul>
		  <p>";
	}
	
	function displayLinks($show, $section){

	    $this->show = $show; // How many links to show
		$this->section = $section; // The section currently listed.
	
	    echo "<br><br>";
		echo "<div class='clearLeft'>";

	    if($this->p > 1) // If p > then one then give link to first page
	    {
	        echo "<a href='?p=1&section=".$this->section."'> [FIRST] </a>  ";    
	    }
	        else
	        { // else show nothing
	            echo "";
	    }
	    if($this->p != 1)
	        { // if p aint equal to 1 then show previous text

	            $previous = $this->p-1;
	        echo "<a href='?p=$previous&section=".$this->section."'> [ PREVIOUS ] </a>";

	    }
	    else
	        { //else show nothing
	        echo "";
	    } 
	    for($i =1; $i <= $this->show; $i++) // show ($show) links
	    {

	            if($this->p > $this->totalpages)
	                { // if p is greater then totalpages then display nothing
	                echo "";
	        }
	        else if($_GET["p"] == $this->p)
	                { //if p is equal to the current loop value then dont display that value as link
	                   echo $this->p ;
	        }
	        else{
	                   echo " <a href='?p=".$this->p."&section=".$this->section."'> ( ".$this->p.") </a>"; // else display the rest as links
	        }

	        $this->p++; //increment $p  
	    }
	    echo "....."; // display dots

	    if($_GET["p"] == $this->totalpages)
	        {// if page is equal to totalpages then  dont display the last page at the end of links
	        echo "";
	    }
	    else // else display the last page link after other ones
	    {
	        echo "<a href='?p=".$this->totalpages."&section=".$this->section."'> ( ".$this->totalpages.") </a>"; 
	    }
	    if($_GET["p"] < $this->totalpages)// if p is less then total pages then show next link
	    {
	        $next = $_GET["p"] + 1;
		 echo "<a href='?p=$next&section=".$this->section."'> [ NEXT >] </a>";    
	    }

	    echo "<br><br>";
		echo "</div>";

	}
}

?>
