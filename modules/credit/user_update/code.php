<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$Mypagination = new Pagination(10);

$myuser = new User($myconnection);
$myuser->connection = $myconnection;

$mycreditplan = new CreditPlan($myconnection);
$mycreditplan->connection = $myconnection;
$my_credit_plans = $mycreditplan->get_credit_plans();

$mypaymenttype = new PaymentType($myconnection);
$mypaymenttype->connection = $myconnection;
$mypaymenttype->online = PAYMENT_ONLINE;
$my_payment_types = $mypaymenttype->get_payment_types();

$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;
$myusercredit->user_id = $_SESSION[SESSION_TITLE.'userid'];
$myusercredit->get_user_total_credit();

$mypayment = new Payment($myconnection);
$mypayment->connection = $myconnection;

$myvoucher = new Voucher($myconnection);
$myvoucher->connection = $myconnection;

$my_user_credits = $myusercredit->get_user_credit_list_array();
//print_r($my_user_credits);exit();
if($my_user_credits == false)
{
	$myusercredit->error_description = "No records found";
	$myusercredit->total_credit = 0;
}
else{
	$count_data = count($my_user_credits);
}



//jquey post for onchange credit plan
if(isset($_POST['plan_id']) and $_POST['plan_id'] > 0)
{
	$mycreditplan->id = $_POST['plan_id'];
	$plan = $mycreditplan->get_detail();
	if($plan == true){
		//print 'Credit - '.$mycreditplan->credit.' ForAmount - '.$mycreditplan->amount;exit();
		
		print 'Recharge for Rs '.$mycreditplan->amount.' and get '.$mycreditplan->credit. ' exam credits'; exit();
		
	}
}



//temporary code for payment

if(isset($_POST['payment']))
{
	$errorMsg = "";
	if($_POST['lstcreditplans'] == "" || $_POST['lstcreditplans'] == gINVALID){
		$errorMsg .= "Select Credit Plan\n";
	}
	if($_POST['lstpaymenttypes'] == "" || $_POST['lstpaymenttypes'] == gINVALID){
		$errorMsg .= "Select Payment Type";
	}
	else if($_POST['lstpaymenttypes'] == PAYMENT_TYPE_IIPAY)//check mobile number exists else update mobile number
	{
		$myuser->id = $_SESSION[SESSION_TITLE.'userid'];
		$myuser->get_detail();
		if($myuser->phone == "")
		{
			//header("Location:profile.php");exit();//redirect to profile page to update mobile number
		}

	}

	if($errorMsg == "")
	{
		$credit_plan	= $_POST['lstcreditplans'];
		$payment_type	= $_POST['lstpaymenttypes'];

		$mycreditplan->id=$credit_plan;
		$mycreditplan->get_detail();

		//ipayy payment start
		if($payment_type == PAYMENT_TYPE_IIPAY)
		{
			$urlstr = $credit_plan."_".$payment_type;
			header("Location:ipayy_payment.php?slno=".$urlstr);
			exit();
		}
		
		//ipayy payment ends here
		else if ($payment_type == PAYMENT_TYPE_CCAVENUE) {
			$mypayment->cc_avanue_transaction_number = 'CCAVENUE12345';
		}
		$update = $mypayment->update();
		
		if($update == true){//insert into user credit
			$myusercredit->credit_type_id = CREDIT_TYPE_PAYMENT;
		    $myusercredit->payment_id = $mypayment->id;;
		    $myusercredit->user_id = $_SESSION[SESSION_TITLE.'userid'];
		    $myusercredit->credit = $mycreditplan->credit;
		    $myusercredit->credit_plan_id = $credit_plan;
		    $update = $myusercredit->update();

		    //update session usercredit value
		    $myusercredit->get_user_total_credit();
		    $_SESSION[SESSION_TITLE.'user_credit'] = $myusercredit->total_credit;
		    
		    if($update == true) {
		    	$_SESSION[SESSION_TITLE.'flash'] = "Payment Success";
			    header( "Location: get_credit.php");
			    exit();
		    }
		}
		else{
			$_SESSION[SESSION_TITLE.'flash'] = "Payment details not inserted";
		    header( "Location: get_credit.php");
		    exit();	
		}
	}
	else
	{
		$_SESSION[SESSION_TITLE.'flash'] = "Please fill all required fields";
	    header( "Location: get_credit.php");
	    exit();
	}
}



//voucher recharge on submit
if(isset($_POST['recharge']))
{
	if(trim($_POST['txtvoucher']) == ""){
		$_SESSION[SESSION_TITLE.'flash'] = "Please enter voucher number";
	    header( "Location: get_credit.php");
	    exit();
	}else{
		// 1. check voucher is valid
		$myvoucher->voucher = $_POST['txtvoucher'];
		$my_voucher = $myvoucher->validate_voucher();

		if($my_voucher == true){
			// 2. update user credit with voucher
			$myvoucher->get_detail();
			$myusercredit->voucher_id = $myvoucher->id;
			$myusercredit->credit_type_id=CREDIT_TYPE_VOUCHER;
			$myusercredit->user_id = $_SESSION[SESSION_TITLE.'userid'];
			$myusercredit->credit=$myvoucher->credit;
			$update = $myusercredit->update();
			if($update == true){
				// 3. update voucher as used
				$myvoucher->update_voucher_used();
			}
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Invalid voucher number";
		    header( "Location: get_credit.php");
		    exit();
		}
		$_SESSION[SESSION_TITLE.'flash'] = "Credit updated";
	    header( "Location: get_credit.php");
	    exit();			
	}
}




?> 
