<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}


$record_per_page = 10;

$Mypagination = new Pagination($record_per_page);

$myorganization = new Organization($myconnection);
$myorganization->connection = $myconnection;

$myuser = new User($myconnection);
$myuser->connection = $myconnection;

$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;

if(isset($_SESSION[SESSION_TITLE.'userid'])){
	$myorganization->id = $_SESSION[SESSION_TITLE.'userid'];
	$myorganization->get_detail();
	$myuser->organization_id = $myorganization->id;
	$my_users = $myuser->get_users();

	if(isset($_GET['slno'])){
		$myusercredit->user_id =$_GET['slno'];
		$myusercredit->get_user_total_credit();
	}
	$myusercredit->organization_id = $myorganization->id;
	$my_user_credits = $myusercredit->get_list_array($Mypagination->start_record,$Mypagination->max_records);
	if($my_user_credits == false){	
		//do nothing
	}
	else
	{
		$count_data=count($my_user_credits);//echo $candidate->total_records;exit();
		$Mypagination->total_records = $myusercredit->total_records;
		$Mypagination->paginate();
	}
	
}else{
	header("Location:index.php");exit();
}



if(isset($_POST['submit']) and $_POST['submit'] == "Search")
{
	$user_id = $_POST['lstuser'];
	$myusercredit->user_id = $user_id;
	$myuser->organization_id = $_SESSION[SESSION_TITLE.'userid'];
	$myusercredit->get_user_total_credit();
	$myusercredit->organization_id = $_SESSION[SESSION_TITLE.'userid'];
	$my_user_credits = $myusercredit->get_list_array($Mypagination->start_record,$Mypagination->max_records);
	if($my_user_credits == false){	
		//do nothing
	}
	else
	{
		$count_data=count($my_user_credits);//echo $candidate->total_records;exit();
		$Mypagination->total_records = $myusercredit->total_records;
		$Mypagination->paginate();
	}
}



?>