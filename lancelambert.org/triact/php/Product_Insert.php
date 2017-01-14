<?
require_once("inc.php");
$WGM_message="";
$WGM_message .= checkNumeric($Product_ID, "Product ID");
$WGM_message .= checkNumeric($Category_ID, "Category ID");
$WGM_message .= checkLength($Product_Name,"Product Name",200);
$WGM_message .= checkLength($Product_Image,"Product Image",200);
$WGM_message .= checkLength($Product_URL,"Product URL",200);
// Product_Available not checked 
// Date_Added not checked 

$Product_Name=sqlSafe($Product_Name);
$Product_Desc=sqlSafe($Product_Desc);
$Product_URL=sqlSafe($Product_URL);
			
if(strtotime($Date_Added)){
	$WGM_strdt=strtotime($Date_Added);
	if ($WGM_strdt=="" || $WGM_strdt == null) $WGM_message.="Cannot convert $Date_Added to date.";		
	$WGM_strdt=date("Y-m-d",$WGM_strdt);
} else  {
	$WGM_message.="Cannot convert $Date_Added to date.";		
}
$Date_Added=$WGM_strdt;

			
showMessage($WGM_message);
	
if ($Product_ID == 0 ) {
	$WGM_message="product inserted.";
	$WGM_sql="
	insert into product  
		(`Category_ID`,
`Product_Name`,
`Product_Desc`,
`Product_Image`,
`Product_URL`,
`Product_Available`,
`Date_Added`) 
	values 
		('$Category_ID', 
'$Product_Name', 
'$Product_Desc', 
'$Product_Image', 
'$Product_URL', 
'$Product_Available', 
'$Date_Added')";

	$WGM_id=$db->insert($WGM_sql);

} else {
	$WGM_message="product updated.";
	$WGM_sql="
	update product set 
		`product`.`Category_ID`='$Category_ID',
`product`.`Product_Name`='$Product_Name',
`product`.`Product_Desc`='$Product_Desc',
`product`.`Product_Image`='$Product_Image',
`product`.`Product_URL`='$Product_URL',
`product`.`Product_Available`='$Product_Available',
`product`.`Date_Added`='$Date_Added'
	where Product_ID=$Product_ID";
	$WGM_id=$Product_ID;
	$db->execSQL($WGM_sql);
}


$result=array();

$WGM_sql="select `product`.`Product_ID` as `Product_ID`, 
`product`.`Category_ID` as `Category_ID`, 
`product`.`Product_Name` as `Product_Name`, 
`product`.`Product_Desc` as `Product_Desc`, 
`product`.`Product_Image` as `Product_Image`, 
`product`.`Product_URL` as `Product_URL`, 
`product`.`Product_Available` as `Product_Available`, 
date_format(`product`.`Date_Added`,'%m/%d/%Y') as `Date_Added`, category.Category_Name from product
		inner join category 
			on category.Category_ID=product.Category_ID 
where product.Product_ID=$WGM_id";

array_push($result,$db->openRS($WGM_sql));

flexResult($result,$WGM_message,"1");
?>
