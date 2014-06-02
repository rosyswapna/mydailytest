<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}


$record_per_page = 10;

$Mypagination = new Pagination($record_per_page);

$myuser = new User($myconnection);
$myuser->connection = $myconnection;
$my_users = $myuser->get_users();

$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;
$user_name = "";

if(isset($_SESSION[SESSION_TITLE.'userid'])){
	$myuser->id = $_SESSION[SESSION_TITLE.'userid'];
	$myuser->get_detail();
	$user_name = $myuser->first_name." ".$myuser->last_name;
	$myusercredit->user_id =$myuser->id;
	$myusercredit->get_user_total_credit();
}
else if(isset($_GET['id'])){
	$myuser->id = $_GET['id'];
	$myuser->get_detail();
	$user_name = $myuser->first_name." ".$myuser->last_name;
	$myusercredit->user_id =$myuser->id;
	$myusercredit->get_user_total_credit();
}

if(isset($_POST['submit']) and $_POST['submit'] == "Search")
{
	$myuser->id = $_POST['lstuser'];
	$myuser->get_detail();
	$myusercredit->user_id =$myuser->id;
	$my_user_credits = $myusercredit->get_list_array($Mypagination->start_record,$Mypagination->max_records);
	if($my_user_credits == false){
	}
	else{
		$count_data=count($my_user_credits);//echo $candidate->total_records;exit();
		$Mypagination->total_records = $myusercredit->total_records;
		$Mypagination->paginate();
	}
	if($myuser->id !="" || $myuser->id != gINVALID){
		header("location:".$current_url."?id=".$myuser->id);
	}
}


$my_user_credits = $myusercredit->get_list_array($Mypagination->start_record,$Mypagination->max_records);
if($my_user_credits == false)
{
	
}
else
{
	$count_data=count($my_user_credits);//echo $candidate->total_records;exit();
	$Mypagination->total_records = $myusercredit->total_records;
	$Mypagination->paginate();
}

?>