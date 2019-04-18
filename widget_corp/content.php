
<!--13_10_subjecteditcont -->
<?php require_once 'includes/connection.php'; ?>

<?php require_once 'includes/functions.php'; ?>



<?php

find_selected_page();
?>

<?php include 'includes/header.php'; ?>
	<table id ="structure">
		<tr>
			<td id="navigation">
<?php echo navigation($sel_subject,$sel_page);?> 

	<a href="new_subject.php">+ Add a new Subject</a>


			<td id="page">
<?php if(!is_null($sel_subject)){?>
<h2><?php echo $sel_subject['menu_name']; ?></h2>
<?php }  elseif (!is_null($sel_page)) { ?>
<h2><?php echo $sel_page['menu_name']; ?></h2>
<div class="page-content">
	<?php echo $sel_page['content'];?>
	
</div>
<?php } else { ?>
	<h2>select a subject page to edit</h2>
<?php } ?>

		</td>
		</tr>
	</table>

	<?php require 'includes/footer.php'; ?>
	

