

<?php require_once 'includes/connection.php'; ?>

<?php require_once 'includes/functions.php'; ?>
<?php
$errors =array();
$require_fields= array('menu_name','position','visible');

foreach ($require_fields as $fieldname) {
	//if(isset($_POST[$fieldname] || empty($_POST[$fieldname])))
	$errors[] = $fieldname;
}


if(!empty($errors)){
	header("Location: new_subject.php");
	exit;
}

?>
<?php

$menu_name =  mysql_prep($_POST['menu_name']);
$position =  mysql_prep($_POST['position']);
$visible=  mysql_prep($_POST['visible']);

?>
<?php
$query  = "INSERT INTO subject (menu_name,position,visible
	) VALUES(
	'{$menu_name}',{$position},{$visible}
	)";
	$result = mysqli_query($con,$query);
	if($resul){
		header("Location: content.php");
		exit;

	}else{
		echo "<p>Subject creation failed ..</p>";
		echo "<p>mysqli_error().</p>";

	}
	
?>


<?php mysqli_close($con); ?>