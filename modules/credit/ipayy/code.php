<?php
//prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}



$myuser = new User($myconnection);
$myuser->connection = $myconnection;

$mycreditplan = new CreditPlan($myconnection);
$mycreditplan->connection = $myconnection;

$mypayment = new Payment($myconnection);
$mypayment->connection = $myconnection;



$myuser->id = $_SESSION[SESSION_TITLE.'userid'];
$myuser->get_detail();
//print_r($_GET);exit();



if(isset($_GET['slno'])){
	$list = explode("_",$_GET['slno']);
	$credit_plan = $list[0];
	$payment_type = $list[1];
	$mycreditplan->id = $credit_plan;
	$mycreditplan->get_detail();
	$ipayy_merchant_key = "se_OvIoG2aNW1Lv1PJjBMw";
	$ipayy_application_key = "7R54aPZnIT_QYgsxlt1Ncw";

	//insert payment details with status as pending
	$mypayment->payment_type_id = $payment_type;
	$mypayment->payment_status_id = PAYMENT_STATUS_PENDING;
	$mypayment->user_id = $_SESSION[SESSION_TITLE.'userid'];
	$mypayment->amount = $mycreditplan->amount;
	$mypayment->credit_plan_id = $credit_plan;
	$update = $mypayment->update();



	//order id is genereated for ipayy transacion request id is unique
	$order_id = time().$mypayment->id;
	$mypayment->ipayy_request_id = $order_id;
	$mypayment->update_ipayy_request_id();

	$ipayy_url_param = array();
	$ipayy_url_param['r']= $order_id;
	$ipayy_url_param['m']=$ipayy_merchant_key;
	$ipayy_url_param['a']=$ipayy_application_key;
	$ipayy_url_param['in']=$mycreditplan->name;
	$ipayy_url_param['ip']=$mycreditplan->amount;
	$ipayy_url_param['ic']=$mycreditplan->id;
	$ipayy_url_param['c']="INR";
	$ipayy_url_param['ru']= WEB_URL."/ipayy_process.php";

	//encrypt the url parameters
	try {
		$return = CryptoUtils::encrypt($ipayy_url_param);
	} catch (CryptoException $e) {
		echo "Got Exception: " . $e->getMessage();
	}

    $ipayy_url='http://api.ipayy.com/v001/c/oc/dopayment?gh='.$return.'&plid='.$credit_plan;	

	header("Location:".$ipayy_url);exit();

}
else{
	header('Location:get_credit.php');exit();
}
?>
