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
$voucher_bill_item_statuses=$myvoucherbillitems->get_array_voucher_bill_item_status_id();
if(isset($_GET['voucher_bill_id'])){
	$myvoucherbill->id = $_GET['voucher_bill_id'];
	$myvoucherbill->get_detail();

	$myvoucherbillitems->voucher_bill_id = $_GET['voucher_bill_id'];
	$data=$myvoucherbillitems->get_list_array_bylimit();

}
else
{
	
}



if(isset($_POST['submit']))
{
$myvoucherbillitems->voucher_bill_id=$_POST['hd_bill_id'];
$bill_items_id=$myvoucherbillitems->get_array_id();
if(isset($_POST['cancel_chk'])){
$cancelled_items_array=$_POST['cancel_chk'];
foreach ($cancelled_items_array as $key => $value)
{

	$cancelled_items_id[$key]=$value;
	

}

$items_to_be_cancelled_id=array_diff($bill_items_id,$cancelled_items_id);
}else{
$items_to_be_cancelled_id=$bill_items_id;
}

$amount=0;
$commision=0;
foreach ($items_to_be_cancelled_id as $key => $value)
{
$myvoucherbillitems->id=$value;
$myvoucherbillitems->get_detail();
$myvoucherbillitems->voucher_bill_item_status_id=VOUCHER_BILL_ITEM_CANCELLED;
$myvoucherbillitems->update();
$tot_amount_items=$myvoucherbillitems->amount*$myvoucherbillitems->number_of_vouchers;
$amount=$amount+($tot_amount_items);
$commision=$commision+((($tot_amount_items)*($myvoucherbillitems->commision))/100);
}

$myvoucherbill->id=$_POST['hd_bill_id'];
$myvoucherbill->get_detail();

if($amount>0){
$myvoucherbill->amount=($myvoucherbill->amount)-$amount;

}
if($commision>0){
$myvoucherbill->commision=$myvoucherbill->commision-$commision;

}
if(isset($_POST['cancel_bill_chk'])){
$myvoucherbill->bill_status_id=VOUCHER_BILL_CANCELLED;
$myvoucherbillitems->voucher_bill_item_status_id=VOUCHER_BILL_ITEM_CANCELLED;
$myvoucherbillitems->voucher_bill_id=$_POST['hd_bill_id'];
$myvoucherbillitems->cancel_bill_item_statuses_with_bill_id();

}
if(isset($_POST['paid_bill_chk'])){

$myvoucherbill->bill_status_id=VOUCHER_BILL_PAID;
}
$chk=$myvoucherbill->update();
if($chk==true){
$_SESSION[SESSION_TITLE.'flash'] = "Vouchers Updated Successfuly.";
header( "Location:bill.php?voucher_bill_id=".$myvoucherbill->id);
exit();
}else{
$_SESSION[SESSION_TITLE.'flash'] = "Vouchers Updation Failed.";
header( "Location:bill.php?voucher_bill_id=".$myvoucherbill->id);
exit();

}

}

?>
