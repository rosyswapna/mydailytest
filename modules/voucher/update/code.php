<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$myvoucher=new Voucher();
$myvoucher->connection = $myconnection;

$myvoucherbill=new Voucher_bill();
$myvoucherbill->connection = $myconnection;

$myvoucherbillitems=new Voucher_bill_items();
$myvoucherbillitems->connection = $myconnection;

$bill_statuses=$myvoucherbill->get_array_statuses();
$myagent=new Agent();
$myagent->connection = $myconnection;
$agents=$myagent->get_array();

$myvoucher->get_counts();

if($myvoucher->total_vouchers_inactive<=0){
$_SESSION[SESSION_TITLE.'flash'] = "No vouchers avalilable.";
header( "Location:generate_vouchers.php");
exit();
}

if(isset($_POST['agent_id']) and $_POST['agent_id'] > 0)
{
	$myagent->id = $_POST['agent_id'];
	$myagent->get_detail();
	
		
		print $myagent->name.','.$myagent->email.','.$myagent->address.','.$myagent->phone; exit();
		
}

if(isset($_POST['submit'])){

if(isset($_POST['paylater'])){
if($_POST['lstagent']==gINVALID){
$_SESSION[SESSION_TITLE.'flash'] = "For Pay later voucher allocation agent id is required.";
header( "Location:allocate_vouchers.php");
exit();
}
}
$bill_tot_amountaftrercommisions='';
$bill_tot_amount='';
$amounts_array=$_POST['txtamount'];
$credits_array=$_POST['txtcredit'];
$numberofvouchers_array=$_POST['txtnumberofvouchers'];
$totamount_array=$_POST['txttotamount'];
$commision_array=$_POST['txtcommision'];
$amountaftrercommision_array=$_POST['txtamountaftrercommision'];
$validfrom_array=$_POST['txtvalidfrom'];
$validto_array=$_POST['txtvalidto'];
//$discount_array=$_POST['txtdiscount'];
$tot_amount_of_item=0;
foreach ($amounts_array as $key => $value)
{

	$amounts[$key]=$value;
	

}
//print_r($amounts);
$totnumber_of_vouchers_for_bill=0;
foreach ($numberofvouchers_array as $key => $value)
{

	$numberofvoucher_per_items[$key]=$value;
	$totnumber_of_vouchers_for_bill=+$value;

}
if($myvoucher->total_vouchers_inactive<$totnumber_of_vouchers_for_bill){
$needed_voucher=$totnumber_of_vouchers_for_bill-$myvoucher->total_vouchers_inactive;
$_SESSION[SESSION_TITLE.'flash'] .= $needed_voucher." more vouchers is needed.";
header( "Location:generate_vouchers.php");
exit();
}
//print_r($numberofvouchers);
foreach($credits_array as $key => $value)
{

	$credits[$key]=$value;
	$credits_per_items[$key]=$credits[$key]*$numberofvoucher_per_items[$key];

}
//print_r($credits);
/*
foreach ($discount_array as $key => $value)
{

	$discount_for_voucher[$key]=$value;
	

}
*/
foreach ($totamount_array as $key => $value)
{

	$totamounts_for_item[$key]=$value;
	$bill_tot_amount+=$value;

}
//print_r($totamounts_for_item);

foreach ($commision_array as $key => $value)
{

	$commisions_per_voucher[$key]=$value;
	

}
//print_r($commisions);

foreach ($amountaftrercommision_array as $key => $value)
{

	$amountaftrercommisions[$key]=$value;
	$bill_tot_amountaftrercommisions+=$value;
	//$commisions[$key]=$totamounts_for_item[$key]-$amountaftrercommisions[$key];

}
//print_r($amountaftrercommisions);
foreach ($validfrom_array as $key => $value)
{

	$validfrom[$key]=$value;
	

}
//print_r($validfrom);
foreach ($validto_array as $key => $value)
{

	$validto[$key]=$value;
	

}

//print_r($validto);

$bill_commision=$bill_tot_amount-$bill_tot_amountaftrercommisions;
$myvoucher->set_defaults();
if($_POST['lstagent']!=gINVALID){
$myvoucherbill->agent_id=$_POST['lstagent'];
$myvoucherbill->name=$_POST['txtname'];
$myvoucher->agent_id=$_POST['lstagent'];

}else{
$myvoucherbill->name=$_POST['txtname'];

}
if(isset($_POST['paylater'])){
$myvoucherbill->bill_status_id=VOUCHER_BILL_UNPAID;
}else{
$myvoucherbill->bill_status_id=VOUCHER_BILL_PAID;
}
$myvoucherbill->address=$_POST['txtaddress'];
$myvoucherbill->phone=$_POST['txtphone'];
$myvoucherbill->email=$_POST['txtemail'];
$myvoucherbill->commision=$bill_commision;
$myvoucherbill->discount=$_POST['txtdiscount'];
$myvoucherbill->amount=$bill_tot_amount;
$myvoucherbill->update();

if(!isset($_POST['paylater']) && $myvoucherbill->bill_status_id==VOUCHER_BILL_PAID){
$mypayment = new Payment($myconnection);
$mypayment->connection = $myconnection;
$mypayment->payment_status_id = PAYMENT_STATUS_PAID;
$mypayment->payment_type_id =PAYMENT_TYPE_CASH;
$mypayment->amount=$_POST['txtbilltotamount'];
$mypayment->update();
$myvoucherbill->get_detail();
$myvoucherbill->payment_id=$mypayment->id;
$myvoucherbill->update();
}


for($i=0;$i<count($numberofvoucher_per_items);$i++){
if($numberofvoucher_per_items[$i]!=''){

$myvoucherbillitems->set_defaults();
$myvoucherbillitems->voucher_bill_id=$myvoucherbill->id;
$myvoucherbillitems->update();

$voucher_start_id=$myvoucher->voucher_start_id();
$voucher_end_id=$voucher_start_id;
for($voucher_index=0;$voucher_index<$numberofvoucher_per_items[$i];$voucher_index++){

$myvoucher->id=$voucher_end_id;
$myvoucher->amount=$amounts[$i];
$myvoucher->credit=$credits[$i];

if($validfrom[$i]!=''){
$myvoucher->valid_from=date("Y-m-d",strtotime($validfrom[$i]));
$valid_from=$myvoucher->valid_from;
}else{
$valid_from='';
}
if($validto[$i]!=''){
$myvoucher->valid_to=date("Y-m-d",strtotime($validto[$i]));
$valid_to=$myvoucher->valid_to;
}else{
$valid_to='';
}
if(!isset($_POST['paylater'])){
$myvoucher->voucher_type_id=BILLED;
}else{
$myvoucher->voucher_type_id=UNBILLEDr;
}

$myvoucher->status_id=STATUS_ACTIVE;
$myvoucher->voucher_bill_id=$myvoucherbill->id;
$myvoucher->voucher_bill_item_id=$myvoucherbillitems->id;
$myvoucher->commision=$commisions_per_voucher[$i];
$myvoucher->update();
$myvoucher->id="";
$voucher_end_id++;
}

$myvoucherbillitems->amount=$amounts[$i];
$myvoucherbillitems->credit=$credits[$i];
if($valid_from!=''){
$myvoucherbillitems->valid_from=$valid_from;
}else{
$myvoucherbillitems->valid_from='';
}
if($valid_to!=''){
$myvoucherbillitems->valid_to=$valid_to;
}
else{
$myvoucherbillitems->valid_to='';
}
$myvoucherbillitems->description="Allocated voucher number from ".$voucher_start_id." to ".$voucher_end_id.". with Rs.".$amounts[$i]." and credits ".$credits[$i]." .";
$myvoucherbillitems->number_of_vouchers=$numberofvoucher_per_items[$i];
$myvoucherbillitems->commision=$commisions_per_voucher[$i];
$myvoucherbillitems->voucher_bill_item_status_id=STATUS_ACTIVE;
$myvoucherbillitems->update();
$myvoucherbillitems->id="";
$myvoucherbillitems->description="";

}
}
if(count($numberofvoucher_per_items)>0){
$_SESSION[SESSION_TITLE.'flash'] = "Vouchers Allocated Successfuly.";
header( "Location:voucher_bill_print.php?voucher_bill_id=".$myvoucherbill->id);
exit();
}
}






?>
