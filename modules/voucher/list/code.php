<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$Mypagination = new Pagination(25);

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
	if(isset($_GET['slno']))
	{
		$myvoucherbill->id = $_GET['slno'];
		$myvoucherbill->get_detail();
		$myvoucher->voucher_bill_id = $myvoucherbill->id;
	}
	$my_vouchers = $myvoucher->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
	if($my_vouchers == false){
	}else{
		$Mypagination->total_records = $myvoucher->total_records;
		$Mypagination->paginate();
	}
}
else
{
	header( "Location:index.php");
	exit();
}

?>