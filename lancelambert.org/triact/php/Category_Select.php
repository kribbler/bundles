<?
require_once("inc.php");


if ($mode=="delete") {
	$WGM_sql="delete from category where Category_ID in ($Category_ID)";
	$db->execSQL($WGM_sql);
} 


$WGM_sql="select `category`.`Category_ID` as `Category_ID`,
`category`.`Category_Name` as `Category_Name`,
`category`.`Category_Desc` as `Category_Desc` from category ";
$result=array();
array_push($result,$db->openRS($WGM_sql));



flexResult($result,"category retrieved.",0);
?>
