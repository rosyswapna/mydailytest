<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}


$myuser = new User($myconnection);
$myuser->connection = $myconnection;
if(isset($_GET['id'])){
	$myuser->id = $_GET['id'];
	$myuser->get_detail();
}



$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;
$myusercredit->user_id = $myuser->id; 
$myusercredit->get_user_total_credit();

$mypayment = new Payment($myconnection);
$mypayment->connection = $myconnection;

$mycreditplan = new CreditPlan($myconnection);
$mycreditplan->connection = $myconnection;
$my_credit_plans = $mycreditplan->get_credit_plans();

$mypaymenttype = new PaymentType($myconnection);
$mypaymenttype->connection = $myconnection;
$mypaymenttype->online = PAYMENT_OFFLINE;
$my_payment_types = $mypaymenttype->get_payment_types();


$my_user_credits = $myusercredit->get_user_credit_list_array();
if($my_user_credits == false)
{
	$myusercredit->error_description = "No records found";
	$myusercredit->total_credit = 0;
}
else{
	$count_data = count($my_user_credits);
}


if(isset($_GET['slno'])){
	$myusercredit->id = $_GET['slno'];
	$myusercredit->get_detail();
	$mypayment->id = $myusercredit->payment_id;
	$mypayment->get_detail();
}




//payment on submit
if(isset($_POST['payment']))
{
	//validation start
	$errorMsg = "";
	if($_POST['lstcreditplans'] == ""){
		$errorMsg .= "Select Credit Plan\n";
	}
	if($_POST['lstpaymenttypes'] == "" || $_POST['lstpaymenttypes'] == gINVALID){
		$errorMsg .= "Select Payment Type\n";
	}
	else
	{
		if($_POST['lstpaymenttypes'] == PAYMENT_TYPE_CHEQUE){
			if($_POST['txtchequenumber'] == ""){
				$errorMsg .= "Enter check number\n";
			}
			if($_POST['txtbank'] == ""){
				$errorMsg .= "Enter Bank\n";
			}
		}
	}
	//validation end


	if($errorMsg == "") //validation true
	{
		$myusercredit->total_credit = $_POST['txttotalcredit'];
		if($_POST['lstcreditplans'] == gINVALID and ($myusercredit->total_credit -abs($_POST['hdamount'])) < 0)
		{
			$_SESSION[SESSION_TITLE.'flash'] = "Can not update credit";
		    $_SESSION[SESSION_TITLE.'flash_redirect_page'] = $redirect;
		    header( "Location: flash.php");
		    exit();
		}
		else
		{
			$user_id = $_POST['user_id'];
			$redirect = $current_url."?id=".$user_id;
			$credit_plan	= $_POST['lstcreditplans'];
			$payment_type	= $_POST['lstpaymenttypes'];

			$mycreditplan->id=$credit_plan;
			$mycreditplan->get_detail();
			
			//insert payment details
			$mypayment->id = $_POST['txtpaymentid'];
			$mypayment->payment_type_id = $payment_type;
			$mypayment->payment_status_id = PAYMENT_STATUS_PAID;
			$mypayment->user_id = $user_id;
			$mypayment->amount = $mycreditplan->amount;
			$mypayment->credit_plan_id = $credit_plan;
			if ($payment_type == PAYMENT_TYPE_CHEQUE) {
				$mypayment->cheque_number = $_POST['txtchequenumber'];
				$mypayment->bank = $_POST['txtbank'];
			}
			$update = $mypayment->update();

			if($update == true)//insert user credit details
			{
				$myusercredit->id = $_POST['txtusercreditid'];
				$myusercredit->credit_type_id = CREDIT_TYPE_PAYMENT;
			    $myusercredit->payment_id = $mypayment->id;;
			    $myusercredit->user_id = $user_id;
			    $myusercredit->credit = $mycreditplan->credit;
			   
			    $myusercredit->credit_plan_id = $credit_plan;
			    $update = $myusercredit->update();
			    if($update == true) {
			    	$_SESSION[SESSION_TITLE.'flash'] = "Credit updated";
				    header( "Location: ".$redirect);
				    exit();
			    }
			    else
			    {
			    	$_SESSION[SESSION_TITLE.'flash'] = "Payment Success but user credit not updated.\n Please contact ur software support";
				    header( "Location: ".$redirect);
				    exit();
			    }
			}
			else
			{
				$_SESSION[SESSION_TITLE.'flash'] = "Payment Failed";
			    header( "Location: ".$redirect);
			    exit();
			}
		}

	}
	else //validation false
	{
		$_SESSION[SESSION_TITLE.'flash'] = "Please fill all required fields/n".$errorMsg;
	    header( "Location: ".$redirect);
	    exit();
	}
}



if(isset($_POST['addcredit']))
{
	//validation start
	$errorMsg = "";
	
	if($_POST['txtcredit'] == ""){
		$errorMsg .= "Credit is Empty\n";
	}
	//validation end


	if($errorMsg == "") //validation true
	{
		$user_id = $_POST['user_id'];
		$redirect = $current_url."?id=".$user_id;
		
		$myusercredit->id = $_POST['txtusercreditid'];
		$myusercredit->credit_type_id = CREDIT_TYPE_OFFER;
		$myusercredit->user_id = $user_id;
		$myusercredit->credit = $_POST['txtcredit'];
		$myusercredit->offer_note = $_POST['txtoffernote'];
		$update = $myusercredit->update();
		if($update == true) {
		    $_SESSION[SESSION_TITLE.'flash'] = "Credit updated";
			header( "Location: ".$redirect);
			exit();
	    }
	    else
	    {
	    	$_SESSION[SESSION_TITLE.'flash'] = "Credit not added";
		    header( "Location: ".$redirect);
		    exit();
	    }
	}
	else //validation false
	{
		$_SESSION[SESSION_TITLE.'flash'] = "Please fill all required fields/n".$errorMsg;
	    header( "Location: ".$redirect);
	    exit();
	}
}



//get plan from jquery
if (isset($_POST['credit_plan'])) {
	$mycreditplan->id = $_POST['credit_plan'];
	$plan_detail = $mycreditplan->get_detail();
	if($plan_detail == true){
		print $mycreditplan->amount."_".$mycreditplan->credit;exit();
	}
	else{
		print 0;exit();
	}
}






?>
