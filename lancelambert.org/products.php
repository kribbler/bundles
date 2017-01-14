<?php
require_once("header.php");
$pagenum=1;
$product_id=1;
if (is_numeric($_GET["pagenum"])) {
	$pagenum=$_GET["pagenum"];
}
$matchproduct=false;
if (is_numeric($_GET["Product_Id"])) {
	$product_id=$_GET["Product_Id"];
	$matchproduct=true;
}

$sql="select count(*) from product where Category_Id=$category_id ";
$product_result=$db->openRS($sql);
$ptotal=mysql_fetch_array($product_result);
$numrows=$ptotal[0];

$sort="Product_Name";
$_SESSION["sort"]=$sort;

if ($_GET["sort"]=="date") {
	$sort="Date_Added";
	$pagenum=1;
	$_SESSION["sort"]=$sort;
}
if ($_GET["sort"]=="name") {
	$sort="Product_Name";
	$pagenum=1;
	$_SESSION["sort"]=$sort;
}
/*
if($_GET['Category_Id'] == '4'){
  $sort="Product_Name DESC";
}*/
$to=$pagenum*$maxperpage;
$from=($pagenum-1)*$maxperpage;
$sort=$_SESSION["sort"];
$searchFor=$_POST["searchFor"];
if ($searchFor=="") {
	$searchFor=$_GET["searchFor"];
}
if (!$searched) {
	$sql="select * from product
	where Category_Id=$category_id
	";
	if ($matchproduct)
		$sql.=" and Product_ID=$product_id ";
	$sql.="order by $sort limit $from, $to";
} else {
	$sql="select * from product
	where
	 ( Product_Name like '%$searchFor%'
	or Product_Desc like '%$searchFor%'
	)
	order by $sort
	";

}
$product_result=$db->openRS($sql);

$normal=true;
if ($searched) $normal=false;
if ($matchproduct) $normal=false;
 ?>

<div id="main">
	<hr size="1" color="#999999" width="100%" />
	<form action="products.php?Category_Id=<?php echo $category_id ?>" method="post">
	<table align="right">
	<tr>
	<td >
	<a href="products.php?Category_Id=<?php echo $category_id?>&sort=name&searchFor=<?php echo $searchFor ?>">Sort by Name</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="products.php?Category_Id=<?php echo $category_id?>&sort=date&searchFor=<?php echo $searchFor ?>">Sort by Date</a>
&nbsp;&nbsp;&nbsp;Search:

	</td>
	<td>
<input type="text" style="border: 1px solid grey; width:100px" value="<?php echo $searchFor ?>" name="searchFor">
	</td>
	<td><input type="submit" value="GO" /><?php if ($searchFor!="") { ?>&nbsp;&nbsp;<a href="products.php?Category_Id=<?php echo $category_id ?>">Clear</a><?php } ?></td>
	</tr>
	<tr>
	  <td colspan="3" ><div align="right">Text size: <a id="increasetextsize" class="increaseFont" href="#">Enlarge</a>&nbsp;&nbsp;&nbsp;<a id="resettextsize" class="resetFont" href="#">Reset</a></div></td>
	  </tr>
	</table>
	</form>
	<p>&nbsp;</p>
	<?php if ($searched) $Category_Name = "Search Results"; ?>
<h2><?php echo $Category_Name ?></h2>

	<!-- This has been added by Andrew Kelly	 -->
	
	<?php
	
		if ($Category_Name == "Video") {
			require_once('videoFiles/videos.php');		
		}
	
	?>
	
	<!-- This ends where Andrew Kelly had done work	 -->
	
	
	<?php if ($normal) { ?>
	<span id="feature">
	
		<?php echo $Category_Desc; ?>
	</span>
	<br style="clear: both;" />
	<?php } ?>	
<hr size="1" color="#999999" width="100%" /><br />

<?php if (!$searched) { ?>
	<table width="740" style="margin-left:30px; font-size:13px;" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top">
<?php
	$col=0;
	$rowat=1;
while (($rowat<=$maxperpage) && ($prow=mysql_fetch_array($product_result,MYSQL_ASSOC))) {
	$rowat++;
	
	while (list ($key, $val) = each ($prow)) {
		$$key=$val;
	}				?>
    <td width="260" align="left">


		<span class="itemTitle"><?php
			$string = strtolower($Product_Name);
			$string = substr_replace($string, strtoupper(substr($string, 0, 1)), 0, 1);
			echo $string;
		 ?></span><br />
		<?php echo $Product_Desc;

		if($Category_ID==1){
			/*
				Information stored in the database.
				book_url_ID 	-	auto incremental id of the book url
				Product_ID		-	The id of the book this url is connected to 
				lang_code		-	2 digit iso language code
				book_url		-	the url where the button will link to
				book_type		-	The type of book (kindle, book) this is added to the beginning of the button image url.
				
					// Hard cover book naming convention: book_(ISO Code)_edition
					// Kindle book naming convention: kindle_(ISO Code)_edition
				
			*/
			// echo "<a href=".$Product_URL." target=\"_blank\" onmouseover=\"MM_swapImage('buy".$rowat."','','media/buy_button_ro.png',1)\" onmouseout=\"MM_swapImgRestore()\">";
			$alt_books_sql="SELECT * FROM `book_urls` WHERE `book_id`='".((int)$Product_ID)."'";
			$extra_urls_result=$db->openRS($alt_books_sql);
			echo "<p>";
			$button_list=array();
				while($alt_url_row = mysql_fetch_array($extra_urls_result)){
					if($alt_url_row['book_available']==1){
						$button_list[$alt_url_row['book_type']] = "<a href=\"".$alt_url_row['book_url']."\" target=\"_blank\" style=\"margin: 0 2px;\">";
							$button_list[$alt_url_row['book_type']] .= "<img src=\"media/book_buttons/".$alt_url_row['book_type']."_".$alt_url_row['lang_code']."_edition.png\" alt=\"Buy Online Now\" width=\"102\" height=\"27\" border=\"0\" />";
						$button_list[$alt_url_row['book_type']] .= "</a>";
					}else{
						echo "<p class=\"unavailable\">Currently Unavailable</p>";
					}
					$order_buttons_by = array('book','kindle','other');
					// orders the buttons based on the array $order_buttons_by
					$order_buttons_correctly = implode(array_merge(array_flip($order_buttons_by), $button_list));
					// granted this is not the best but it does remove the numbers
					// appended at the end when a book doesn't have a specific url
					$order_buttons_correctly = trim($order_buttons_correctly,'0..9');
				}
				echo $order_buttons_correctly;
			echo "</p>";
		}else{
			if ($Product_Available==1) {?>
			<p>
				<?php echo "<a href=".$Product_URL." target=\"_blank\" onmouseover=\"MM_swapImage('buy".$rowat."','','media/buy_button_ro.png',1)\" onmouseout=\"MM_swapImgRestore()\">";?>
				<a href="<?php echo $Product_URL ?>" target="_blank" >
					<img src="media/buy_button.png" alt="Buy Online Now" name="buy<?php echo $rowat ?>" width="102" height="27" border="0" id="buy<?php echo $rowat ?>" />
				</a>
			</p>
			<?php }
			else { ?>
				<p class="unavailable">Currently Unavailable</p>
			<?php }
		}
		?>
	</td>
    <td width="100" align="center"><img width="86" src="<?php echo $Product_Image ?>" class="img-border" /></td>
		
	<?php
	if ($col==0) {
	?>
	  <td width="20">&nbsp;</td>
	<?php
	}	
	if ($col==1) {
	?>
	  </tr>
  <tr valign="top">

	<?php
	}
	$col++;
	if ($col==2) $col=0;

}
?>

</table>
<?php } else {
	//search for
	?>
	<?php if (mysql_num_rows($product_result)==0) { ?>
	Sorry, we couldn't find any products to match your search.
	<?php } ?>
	<?php
	while ($prow=mysql_fetch_array($product_result,MYSQL_ASSOC)) {
		$rowat++;
		while (list ($key, $val) = each ($prow)) {
			$$key=$val;
		}				?>
		<a href="products.php?Category_Id=<?php echo $Category_ID?>&Product_Id=<?php echo $Product_ID ?>"><?php echo $Product_Name ?></a><BR>
	<?php } ?>

<?php } ?>
</div>
	<?php require_once("footer.php") ?>