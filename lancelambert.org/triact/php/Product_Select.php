<?
require_once("inc.php");


if ($mode=="delete") {
	$WGM_sql="delete from product where Product_ID in ($Product_ID)";
	$db->execSQL($WGM_sql);
} 


$WGM_sql="select `product`.`Product_ID` as `Product_ID`,
`product`.`Category_ID` as `Category_ID`,
`product`.`Product_Name` as `Product_Name`,
`product`.`Product_Desc` as `Product_Desc`,
`product`.`Product_Image` as `Product_Image`,
`product`.`Product_URL` as `Product_URL`,
`product`.`Product_Available` as `Product_Available`,
date_format(`product`.`Date_Added`,'%m/%d/%Y') as `Date_Added`, category.Category_Name from product
		inner join category 
			on category.Category_ID=product.Category_ID";
$result=array();
array_push($result,$db->openRS($WGM_sql));



flexResult($result,"product retrieved.",0);
?>
