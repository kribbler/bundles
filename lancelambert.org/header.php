<?php
 require_once("triact/php/inc.php");

 $category_id=0;
 $maxperpage=6;
 $searched=false;
 if ($_POST["searchFor"]!="" || $_GET["searchFor"]!="") {
 	$searched=true;
 }
 if (is_numeric($_GET["Category_Id"])) {
 	$category_id=$_GET["Category_Id"];
 }

 if ($category_id==0) {
 	$category_id=1;
 }
	 $sql="select * from category where Category_Id=$category_id";
	 $result=$db->openRS($sql);
	 $row=mysql_fetch_array($result, MYSQL_ASSOC);
	 while (list ($key, $val) = each ($row)) {
 		$$key=$val;

 	}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link href="css/lance_lg.css" rel="stylesheet" type="text/css" />
	<link href="css/lance.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="colorbox-master/example1/colorbox.css" />
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="colorbox-master/jquery.colorbox-min.js"></script>
	<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			
			$("a.audioMessage").colorbox({iframe: true, width: "80%", height: "80%"});
			

			function prepareTextSizeIncreaser(){
			  if( document.getElementById ){
			    if( document.getElementById( 'increasetextsize' ) ){
					var gallery = document.getElementById( 'increasetextsize' );
					gallery.onclick = function(){
						document.styleSheets[1].disabled=true;
						document.styleSheets[0].disabled=false;
			
					};
			    }
			  }
			}
			
			function prepareTextSizeResetter(){
			  if( document.getElementById ){
			    if( document.getElementById( 'resettextsize' ) ){
					var gallery = document.getElementById( 'resettextsize' );
					gallery.onclick = function(){
						document.styleSheets[0].disabled=true;
						document.styleSheets[1].disabled=false;
				    }
			  	}
				}
				}
			
			function afterload() {
			
			prepareTextSizeIncreaser();
			prepareTextSizeResetter();
			}
		});

</script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Lance Lambert</title>

<script type="text/JavaScript">
	$(document).ready(function() {
	<!--
	function MM_swapImgRestore() { //v3.0
	  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
	}
	
	function MM_preloadImages() { //v3.0
	  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
	}
	
	function MM_findObj(n, d) { //v4.01
	  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
	    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
	  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
	  if(!x && d.getElementById) x=d.getElementById(n); return x;
	}
	
	function MM_swapImage() { //v3.0
	  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
	   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
	}
//-->
	
	MM_preloadImages('media/buy_button_ro.png'); 
	// afterload()
	
	});
</script>
</head>

<body>
  <div style="text-align: center;margin-top: -15px;margin-bottom: 25px;font-family: Arial, Helvetica, sans-serif;">
	<a href="http://livestream.com/accounts/1140382/events/4048279" target="_blank" style="color:#FFFFFF;border-bottom: 1px solid #919191;text-decoration: none;" onMouseOver="this.style.color='#669900'" onMouseOut="this.style.color='#FFFFFF'">View the May 27, 2015 Memorial Service for Lance</a>
  </div>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center" class="secondaryTable">
  <tr>
    <td><img src="media/spacer.gif" width="800" height="20" class="img-block" /></td>
  </tr>
  <tr>
    <td><img src="media/spacer.gif" width="25" height="46" /><img src="media/title.png" width="374" height="46" /></td>
  </tr>
  <tr>
    <td><img src="media/spacer.gif" width="800" height="5" class="img-block" /></td>
  </tr>
  <tr>
    <td><div id="navbar"><img src="media/spacer.gif" width="28" height="15" /><a href="index.html">Home</a>&nbsp;&nbsp;&nbsp;<a href="about.html">About</a>&nbsp;&nbsp;&nbsp;<a href="products.php?Category_Id=1">Books</a>&nbsp;&nbsp;&nbsp;<a href="audio.php">Audio</a>&nbsp;&nbsp;&nbsp;<a href="products.php?Category_Id=2">Video</a>&nbsp;&nbsp;&nbsp;<a href="/middle-east-update.php">Middle East Update</a>&nbsp;&nbsp;&nbsp;<a href="prophetic.html">Prophetic Messages</a>&nbsp;&nbsp;&nbsp;<a href="contact.html">Contact Us</a>&nbsp;&nbsp;&nbsp;<a href="resources.html">Resources</a></div></td>
  </tr>

  <tr>
    <td>
