

<?php require_once 'includes/connection.php'; ?>

<?php require_once 'includes/functions.php'; ?>

<?php


if(isset($_POST['submit'])){
$errors =array();



if(intval($_GET['subj'])==0){
redirect_to("content.php");
}

$require_fields=array('menu_name','position','visible');
foreach ($require_fields as $fieldname) {
	if(!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]) && $_POST[$fieldname]!=0)){
	$errors[] = $fieldname;
}
}

$fields_with_lengths= array('menu_name' => 30);
foreach ($fields_with_lengths as $fieldname=>$maxlength) {
	if(strlen(trim(mysql_prep($_POST[$fieldname]))) >
		$maxlength){
	$errors[] = $fieldname;
}
}


if(empty($errors))
{

$id=mysql_prep($_GET['subj']);
$menu_name =mysql_prep($_POST['menu_name']);
$position =mysql_prep($_POST['position']);
$visible =mysql_prep($_POST['visible']);

global $con;

$query = "UPDATE subject SET
					menu_name ='{$menu_name}',
					position ={$position},
					visible ={$visible}
			WHERE id={$id}";

			$result =mysqli_query($con,$query);

			echo $result;
			if(mysqli_num_rows($result)==true)
			{
				$message = "success updated..........";
										//success
			}
			else{
				$message =  " Subject update Failed";
			}
}
 
else
{
	//error occured
}



}

?>


<?php find_selected_page(); ?>

<?php include 'includes/header.php'; ?>
	<table id ="structure">
		<tr>
			<td id="navigation">
		<?php echo navigation($sel_subject,$sel_page); ?>
		</td>
		<td id="page">
			<h2>Edit Subject :</h2>
			<?php echo $sel_subject['menu_name'];?>
			<?php
				 if(!empty($message)){
				  echo "<p class=\"message\">" .$message."</p>";} 
			?>
			<?php
			if(!empty($errors)){
				echo "<p class=\"errors\">";
				echo "Please review the Following Fields :</br>";
				foreach ($errors as $error) {
					echo " - ".$error. "<br/>";
				}
			}
				echo "</p>";
			?>
						<form action="edit_subject.php?subj=<?php echo urlencode($sel_subject['id']);?>" method="post">
				<p>Subject Name : 
					<input type="text" name="menu_name"  value="<?php echo $sel_subject['menu_name'];?>" id="menu_name"/>
				</p>
				<p>Position:
					<select name="position">
						<?php $subject_set = get_all_subjects();
							$subject_count = mysqli_num_rows($subject_set);
				for ($count=1; $count < $subject_count+1; $count++) { 
			echo "<option value=\"{$count}\"";
				if($sel_subject['position'] == $count){
					echo "selected";
				}
			echo ">{$count}</option>";

			}
						?>
					</select>
				</p>
				<p>Visible
					<input type="radio" name="visible" value="0"
					<?php if($sel_subject['visible']==0)
					{echo "Checked";} 

					?>/>NO &nbsp;

					<input type="radio" name="visible" value="1"<?php if($sel_subject['visible']==1)
					{echo "Checked";}?>/>YES
				</p>
				<input type="submit" name ="submit" value="Edit Subject"/>
				&nbsp;&nbsp;
				<a href="delete_subject.php?subj=<?php echo	urlencode($sel_subject['id']); ?>">Delete Subject</a>

			<br/>
			<a href="content.php">Cancel</a>

			</form>

		</td>
		</tr>
	</table>

	<?php require 'includes/footer.php'; ?>
	

