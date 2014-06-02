<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$myvoucherbill=new Voucher_bill();
$myvoucherbill->connection = $myconnection;

$myvoucherbillitems=new Voucher_bill_items();
$myvoucherbillitems->connection = $myconnection;

if(isset($_GET['slno'])){
	$myvoucherbill->id = $_GET['slno'];
	$myvoucherbill->get_detail();

	$myvoucherbillitems->voucher_bill_id = $myvoucherbill->id;
	$data = $myvoucherbillitems->get_list_array_bylimit();

}
?>