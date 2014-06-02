<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$Mypagination = new Pagination(50);

$myagent = new Agent();
$myagent->connection = $myconnection;

$myvoucher = new Voucher();
$myvoucher->connection = $myconnection;

$myvoucherbill = new Voucher_bill();
$myvoucherbill->connection = $myconnection;

if(isset($_SESSION[SESSION_TITLE.'userid']))
{
	$myagent->id = $_SESSION[SESSION_TITLE.'userid'];
	$myagent->get_detail();

	$myvoucher->agent_id = $myagent->id;
	$myvoucher->get_count_voucher();

	$myvoucherbill->agent_id = $myagent->id;
	$my_voucher_bills = $myvoucherbill->get_list_array_bylimit();
}
else
{
	header( "Location:index.php");
	exit();
}


	
?>
