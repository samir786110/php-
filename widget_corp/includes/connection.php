<?php
require("constants.php");
$con = mysqli_connect(DB_SERVER,DB_USER);
if(!$con)
{
	die("Database failed ".mysql_error());
}
//print_r($con);
//2select database to use
$db_select = mysqli_select_db($con ,DB_NAME);
if(!$db_select){
	die("Database slelection Failed".mysql_error());
}
?>
