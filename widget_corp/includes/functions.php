<?php

function confirm_query($result_set)
{
	if(!$result_set){
	die("Error in Execute table".mysqli_error());
	}
}


function get_all_subjects()
{
	global $con;
		$query ="SELECT * 
			FROM subject
			ORDER BY position ASC";
	$subject_set = mysqli_query($con,$query);
	confirm_query($subject_set);
	return $subject_set;
}

function redirect_too($location=NULL){
	if($location != NULL){
	exit;}
}

function redirect_to($location=NULL){
	if($location != NULL){
	redirect_to("new_subject.php");exit;}
}
function mysql_prep($value){
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists("mysql_real_escape_string(unescaped_string");
	if($new_enough_php){
		if($magic_quotes_active){$value=stripcslashes($value);}
		$value = mysql_real_escape_string($value);
	}else{
		if(!$magic_quotes_active){$value=addslashes($value);}
	}
	return $value;
}
function get_pages_for_subject($subject_id)
{
		global $con;
$query = "SELECT * 
			FROM pages 
			where subject_id ={$subject_id}
			ORDER BY position ASC";
	$page_set = mysqli_query($con,$query);
		confirm_query($page_set);
		return $page_set;
}
function get_subject_by_id($subject_id)
{
	global $con;
	$query  = "SELECT * ";
	$query .= " FROM subject ";
	$query .= " WHERE id=".$subject_id."";
	$query .=" LIMIT 1";
	$result_set = mysqli_query($con,$query);
	 confirm_query($result_set);
	
if($subject = mysqli_fetch_array($result_set))
	{
		return $subject;
	}
	else
	{
		return NULL;
	}


}



function get_page_by_id($page_id)
{
	global $con;
	$query  = "SELECT * ";
	$query .= " FROM pages ";
	$query .= " WHERE id=".$page_id."";
	$query .=" LIMIT 1";
	$result_set = mysqli_query($con,$query);
	 confirm_query($result_set);
	
if($page = mysqli_fetch_array($result_set))
	{
		return $page;
	}
	else
	{
		return NULL;
	}


}

function find_selected_page(){
	global 	$sel_subject;
	global  $sel_page;
if(isset($_GET['subj'])){
$sel_subject = get_subject_by_id($_GET['subj']);
	$sel_page =NULL;
}elseif (isset($_GET['page'])) {
	$sel_subject = NULL;
	$sel_page = get_page_by_id( $_GET['page']);

}
else{
	$sel_subject = NULL;
	$sel_page =NULL;
}


}


function navigation($sel_subject,$sel_page)
{
	
		$output = "<ul class=\"subjects\">";
		$subject_set = get_all_subjects();
while ($subject = mysqli_fetch_array($subject_set)) {
$output .= "<li"; 
if($subject["id"] == $sel_subject["id"]){$output .= " class=\"selected\"";}
   $output .= "><a href=\"edit_subject.php?subj=" .urlencode($subject["id"]).
	"\">{$subject["menu_name"]}</a></li>";

$page_set = get_pages_for_subject($subject["id"]);
	$output .= "<ul class=\"pages\">";
while ($page = mysqli_fetch_array($page_set)) {
	$output .= "<li"; 
if($page["id"] == $sel_page["id"]){$output .= "class=\"selected\"";}
   $output .= "><a href=\"content.php?page=" .urlencode($page["id"]).
	"\">{$page["menu_name"]}</a></li>";

	}
		$output .= "</ul>";
	}

$output .= "</ul>";
return $output;

}



?>