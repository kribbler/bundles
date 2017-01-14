<?php
class mosPageNav {
	/** @var int The record number to start dislpaying from */
	var $limitstart = null;
	/** @var int Number of rows to display per page */
	var $limit 		= null;
	/** @var int Total number of rows */
	var $total 		= null;

	function mosPageNav( $total, $limitstart, $limit ) {
		$this->total 		= (int) $total;
		$this->limitstart 	= (int) max( $limitstart, 0 );
		$this->limit 		= (int) max( $limit, 1 );
		if ($this->limit > $this->total) {
			$this->limitstart = 0;
		}
		if (($this->limit-1)*$this->limitstart > $this->total) {
			$this->limitstart -= $this->limitstart % $this->limit;
		}
	}
function getPagesCounter() {
		$html = '';
		$from_result = $this->limitstart+1;
		if ($this->limitstart + $this->limit < $this->total) {
			$to_result = $this->limitstart + $this->limit;
		} else {
			$to_result = $this->total;
		}
		if ($this->total > 0) {
			$html .= "<p class='pagenavCount'> Results " . $from_result . " - " . $to_result . " of " . $this->total."</p>";
		} else {
			$html .= "\nNo records found.";
		}
		return $html;
	}

	function getPagesLinks() {
		$html 				= '';
		$displayed_pages 	= 10;
		$total_pages 		= ceil( $this->total / $this->limit );
		$this_page 			= ceil( ($this->limitstart+1) / $this->limit );
		$start_loop 		= (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}

		if ($this_page > 1) {
			$page = ($this_page - 2) * $this->limit;
			//$html .= "\n<a href=\"#beg\" class=\"pagenav\" title=\"first page\" onclick=\"javascript: document.frm.limitstart.value=0; document.frm.submit();return false;\">&lt;&lt;&nbsp;Start</a>";
			$html .= "\n<li class=\"\"><a href=\"#prev\" class=\"pagenav\" title=\"previous page\" onclick=\"javascript: document.frmSearch.limitstart.value=$page; document.frmSearch.submit();return false;\">&lt;&nbsp;&lt;&nbsp;Previous</a></li>";
		}elseif($total_pages<2){
			echo '';
		}else {
			//$html .= "\n<span class=\"pagenav\">&lt;&lt;&nbsp;Start</span>";
			$html .= "\n<li class=\"previous-off\"><span class=\"pagenav\">&lt;&nbsp;&lt;&nbsp;Previous</span></li>";
		}

		for ($i=$start_loop; $i <= $stop_loop; $i++) {
			$page = ($i - 1) * $this->limit;
			if ($i == $this_page && $total_pages>1 ) {
				$html .= "\n <li class=\"active\"><span class=\"pagenavSingle\"> $i </span></li>";
			}elseif($total_pages<2){
				echo '';
			}	else {
				$html .= "\n <li><a href=\"#$i\" class=\"pagenav\" onclick=\"javascript: document.frmSearch.limitstart.value=$page; document.frmSearch.submit();return false;\"><strong>$i</strong></a></li>";
			}
		}

		if ($this_page < $total_pages) {
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;

			$html .= "\n <li class=\"\"><a href=\"#next\" class=\"pagenav\" title=\"next page\" onclick=\"javascript: document.frmSearch.limitstart.value=$page; document.frmSearch.submit();return false;\"> Next&nbsp;&gt;&nbsp;&gt;</a></li>";
			//$html .= "\n<a href=\"#end\" class=\"pagenav\" title=\"end page\" onclick=\"javascript: document.frm.limitstart.value=$end_page; document.frm.submit();return false;\"> End&nbsp;&gt;&gt;</a>";
		}elseif($total_pages<2){
			echo '';
		}else {
			$html .= "\n<li class=\"previous-off\"><span class=\"pagenav\">Next&nbsp;&gt;&nbsp;&gt;</span></li>";
			//$html .= "\n<span class=\"pagenav\">End&nbsp;&gt;&gt;</span>";
		}
		return $html;
	}
function getListFooter() {
		$html = ' <div class="clear"></div><ul id="pagination-flickr">';
	//	$html .= '<tr><th>'.$this->getPagesLinks().'</th>';
 		$html .= $this->getPagesLinks();
	//	$html .= '<td> </td>';
	//	$html .= '<td nowrap="nowrap" width="48%" align="left" ></td>';
		$html .= ' </ul> ';
  		return $html;
	}
}












class mosPageNavCustom {
	/** @var int The record number to start dislpaying from */
	var $limitstart = null;
	/** @var int Number of rows to display per page */
	var $limit 		= null;
	/** @var int Total number of rows */
	var $total 		= null;

	function mosPageNavCustom( $total, $limitstart, $limit ) {
		$this->total 		= (int) $total;
		$this->limitstart 	= (int) max( $limitstart, 0 );
		$this->limit 		= (int) max( $limit, 1 );
		if ($this->limit > $this->total) {
			$this->limitstart = 0;
		}
		if (($this->limit-1)*$this->limitstart > $this->total) {
			$this->limitstart -= $this->limitstart % $this->limit;
		}
	}
function getPagesCounter() {
		$html = '';
		$from_result = $this->limitstart+1;
		if ($this->limitstart + $this->limit < $this->total) {
			$to_result = $this->limitstart + $this->limit;
		} else {
			$to_result = $this->total;
		}
		if ($this->total > 0) {
			$html .= "<p class='pagenavCount'> Results " . $from_result . " - " . $to_result . " of " . $this->total."</p>";
		}elseif($total_pages<2){
			echo '';
		}else {
			$html .= "\nNo records found.";
		}
		return $html;
	}

	function getPagesLinks() {
		$html 				= '';
		$displayed_pages 	= 10;
		$total_pages 		= ceil( $this->total / $this->limit );
		$this_page 			= ceil( ($this->limitstart+1) / $this->limit );
		$start_loop 		= (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}

		if ($this_page > 1) {
			$page = ($this_page - 2) * $this->limit;
			//$html .= "\n<a href=\"#beg\" class=\"pagenav\" title=\"first page\" onclick=\"javascript: document.frm.limitstart.value=0; document.frm.submit();return false;\">&lt;&lt;&nbsp;Start</a>";
			$html .= "\n<li class=\"\"><a href=\"#prev\" class=\"pagenav\" title=\"previous page\" onclick=\"javascript: document.frmSearchF.limitstartF.value=$page; document.frmSearchF.submit();return false;\">&lt;&nbsp;&lt;&nbsp;Previous</a></li>";
		}elseif($total_pages<2){
			echo '';
		}else {
			//$html .= "\n<span class=\"pagenav\">&lt;&lt;&nbsp;Start</span>";
			$html .= "\n<li class=\"previous-off\"><span class=\"pagenav\">&lt;&nbsp;&lt;&nbsp;Previous</span></li>";
		}

		for ($i=$start_loop; $i <= $stop_loop; $i++) {
			$page = ($i - 1) * $this->limit;
			if ($i == $this_page && $total_pages>1) {
				$html .= "\n <li class=\"active\"><span class=\"pagenavSingle\"> $i </span></li>";
			}elseif($total_pages<2){
				echo '';
			}else {
				$html .= "\n <li><a href=\"#$i\" class=\"pagenav\" onclick=\"javascript: document.frmSearchF.limitstartF.value=$page; document.frmSearchF.submit();return false;\"><strong>$i</strong></a></li>";
			}
		}

		if ($this_page < $total_pages) {
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;

			$html .= "\n <li class=\"\"><a href=\"#next\" class=\"pagenav\" title=\"next page\" onclick=\"javascript: document.frmSearchF.limitstartF.value=$page; document.frmSearchF.submit();return false;\"> Next&nbsp;&gt;&nbsp;&gt;</a></li>";
			//$html .= "\n<a href=\"#end\" class=\"pagenav\" title=\"end page\" onclick=\"javascript: document.frm.limitstart.value=$end_page; document.frm.submit();return false;\"> End&nbsp;&gt;&gt;</a>";
		}elseif($total_pages<2){
			echo '';
		}else {
			$html .= "\n<li class=\"previous-off\"><span class=\"pagenav\">Next&nbsp;&gt;&nbsp;&gt;</span></li>";
			//$html .= "\n<span class=\"pagenav\">End&nbsp;&gt;&gt;</span>";
		}
		return $html;
	}
function getListFooter() {
		$html = ' <div class="clear"></div><ul id="pagination-flickr">';
	//	$html .= '<tr><th>'.$this->getPagesLinks().'</th>';
 		$html .= $this->getPagesLinks();
	//	$html .= '<td> </td>';
	//	$html .= '<td nowrap="nowrap" width="48%" align="left" ></td>';
		$html .= ' </ul> ';
  		return $html;
	}
}
?>