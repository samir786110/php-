
<?php require_once 'includes/connection.php'; ?>

<?php require_once 'includes/functions.php'; ?>

<?php
if(intval($_GET['subj'])==0){
redirect_too("content.php");

}
	$id = mysql_prep($_GET['subj']);


if($subject = get_subject_by_id($id)){
$query = "DELETE FROM subject WHERE id={$id} LIMIT 1";

$result  = mysqli_query($con,$query);
echo $result;
if($result == 1){
	redirect_to("content.php");
}else{
	echo "<p> Subject Deletion failed </p>";
	echo "<a href=\"content.php\">Return to main Page</a>";

}
}
else{
	redirect_to("content.php");
}
?>
<?php mysqli_close($con); ?>

