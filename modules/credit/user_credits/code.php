<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}


$record_per_page = 10;

$Mypagination = new Pagination($record_per_page);

$myuser = new User($myconnection);
$myuser->connection = $myconnection;


$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;

if(isset($_SESSION[SESSION_TITLE.'userid'])){
	$myuser->id = $_SESSION[SESSION_TITLE.'userid'];
	$myuser->get_detail();
	$myusercredit->user_id =$myuser->id;
	$myusercredit->get_user_total_credit();

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
else{
	header("Location:index.php");exit();
}

?>