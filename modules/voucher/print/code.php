<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$myvoucherbill=new Voucher_bill();
$myvoucherbill->connection = $myconnection;
$bill_statuses=$myvoucherbill->get_array_statuses();

$myvoucherbillitems=new Voucher_bill_items();
$myvoucherbillitems->connection = $myconnection;

if(isset($_GET['voucher_bill_id'])){
	$myvoucherbill->id = $_GET['voucher_bill_id'];
	$myvoucherbill->get_detail();

	$myvoucherbillitems->voucher_bill_id = $_GET['voucher_bill_id'];
	$data=$myvoucherbillitems->get_list_array_bylimit();

}
else
{
	//do nothing
}



if(isset($_POST['submit']) && $_POST['submit'] == 'Email')
{
	
	
}

?>
