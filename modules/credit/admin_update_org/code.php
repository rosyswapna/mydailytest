<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$myorganization = new Organization($myconnection);
$myorganization->connection = $myconnection;
if(isset($_GET['id'])){
	$myorganization->id = $_GET['id'];
	$myorganization->get_detail();
}

$myorganizationcredit = new OrganizationCredit($myconnection);
$myorganizationcredit->connection = $myconnection;

$mypayment = new Payment($myconnection);
$mypayment->connection = $myconnection;

$mycreditplan = new CreditPlan($myconnection);
$mycreditplan->connection = $myconnection;
$my_credit_plans = $mycreditplan->get_credit_plans();

$mypaymenttype = new PaymentType($myconnection);
$mypaymenttype->connection = $myconnection;
$mypaymenttype->online = PAYMENT_OFFLINE;
$my_payment_types = $mypaymenttype->get_payment_types();

$myorganizationcredit->organization_id = $myorganization->id; 
$myorganizationcredit->get_organization_total_credit();

$my_organization_credits = $myorganizationcredit->get_organization_credit_list_array();
//print_r($my_organization_credits);exit();
if($my_organization_credits == false)
{
	$myorganizationcredit->error_description = "No records found";
	$myorganizationcredit->total_credit = 0;
	$count_data =0;
}
else{
	$count_data = count($my_organization_credits);echo $count_data;
}




if(isset($_GET['slno'])){
	$myorganizationcredit->id = $_GET['slno'];
	$myorganizationcredit->get_detail();
	$mypayment->id = $myorganizationcredit->payment_id;
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
		$myorganizationcredit->total_credit = $_POST['txttotalcredit'];
		if($_POST['lstcreditplans'] == gINVALID and ($myorganizationcredit->total_credit -abs($_POST['hdamount'])) < 0)
		{
			$_SESSION[SESSION_TITLE.'flash'] = "Can not update credit";
		    $_SESSION[SESSION_TITLE.'flash_redirect_page'] = $redirect;
		    header( "Location: flash.php");
		    exit();
		}
		else
		{
			$organization_id = $_POST['organization_id'];
			$redirect = $current_url."?id=".$organization_id;
			$credit_plan	= $_POST['lstcreditplans'];
			$payment_type	= $_POST['lstpaymenttypes'];

			$mycreditplan->id=$credit_plan;
			$mycreditplan->get_detail();
			
			//insert payment details
			$mypayment->id = $_POST['txtpaymentid'];
			$mypayment->payment_type_id = $payment_type;
			$mypayment->payment_status_id = PAYMENT_STATUS_PAID;
			$mypayment->organization_id = $organization_id;
			$mypayment->amount = $mycreditplan->amount;
			$mypayment->credit_plan_id = $credit_plan;
			if ($payment_type == PAYMENT_TYPE_CHEQUE) {
				$mypayment->cheque_number = $_POST['txtchequenumber'];
				$mypayment->bank = $_POST['txtbank'];
			}
			$update = $mypayment->update();

			if($update == true)//insert organization credit details
			{
				$myorganizationcredit->id = $_POST['txtorganizationcreditid'];
				$myorganizationcredit->credit_type_id = CREDIT_TYPE_PAYMENT;
			    $myorganizationcredit->payment_id = $mypayment->id;;
			    $myorganizationcredit->organization_id = $organization_id;
			    $myorganizationcredit->credit = $mycreditplan->credit;
			   
			    $myorganizationcredit->credit_plan_id = $credit_plan;
			    $update = $myorganizationcredit->update();
			    if($update == true) {
			    	$_SESSION[SESSION_TITLE.'flash'] = "Credit updated";
				    header( "Location: ".$redirect);
				    exit();
			    }
			    else
			    {
			    	$_SESSION[SESSION_TITLE.'flash'] = "Payment Success but organization credit not updated.\n Please contact ur software support";
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