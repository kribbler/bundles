<?
require_once("inc.php");
$WGM_message="";
$WGM_message .= checkNumeric($Category_ID, "Category ID");
$WGM_message .= checkLength($Category_Name,"Category Name",200);

$Category_Name=sqlSafe($Category_Name);
$Category_Desc=sqlSafe($Category_Desc);

showMessage($WGM_message);
	
if ($Category_ID == 0 ) {
	$WGM_message="category inserted.";
	$WGM_sql="
	insert into category  
		(`Category_Name`,
`Category_Desc`) 
	values 
		('$Category_Name', 
'$Category_Desc')";

	$WGM_id=$db->insert($WGM_sql);

} else {
	$WGM_message="category updated.";
	$WGM_sql="
	update category set 
		`category`.`Category_Name`='$Category_Name',
`category`.`Category_Desc`='$Category_Desc'
	where Category_ID=$Category_ID";
	$WGM_id=$Category_ID;
	$db->execSQL($WGM_sql);
}


$result=array();

$WGM_sql="select `category`.`Category_ID` as `Category_ID`, 
`category`.`Category_Name` as `Category_Name`, 
`category`.`Category_Desc` as `Category_Desc` from category 
where category.Category_ID=$WGM_id";

array_push($result,$db->openRS($WGM_sql));

flexResult($result,$WGM_message,"1");
?>
