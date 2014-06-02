<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

 $myuser = new User($myconnection);
 $myuser->connection = $myconnection;
$myuser->error_description = "";
 
$myexam= new Exam();
 $myexam->connection = $myconnection;
$exams=$myexam->get_array();

$mycreditplan = new CreditPlan($myconnection);
$mycreditplan->connection = $myconnection;
$my_credit_plans = $mycreditplan->get_credit_plans();
$dafault_credit_plan_id=$mycreditplan->get_default_credit_plan_id();
if($dafault_credit_plan_id==false){
$dafault_credit_plan_id=$my_credit_plans[0]['id'];
}
$mypaymenttype = new PaymentType($myconnection);
$mypaymenttype->connection = $myconnection;
$mypaymenttype->online = PAYMENT_ONLINE;
$my_payment_types = $mypaymenttype->get_payment_types();

$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;

$mypayment = new Payment($myconnection);
$mypayment->connection = $myconnection;
/*
if (isset($_POST['credit_plan'])) {
	$mycreditplan->id = $_POST['credit_plan'];
	$plan_detail = $mycreditplan->get_detail();
	if($plan_detail == true){
		print $mycreditplan->credit;exit();
	}
	else{
		print 0;exit();
	}
}
*/

if(isset($_POST['plan_id']) and $_POST['plan_id'] > 0)
{
	$mycreditplan->id = $_POST['plan_id'];
	$plan = $mycreditplan->get_detail();
	if($plan == true){
		//print 'Credit - '.$mycreditplan->credit.' ForAmount - '.$mycreditplan->amount;exit();
		
		print 'Pay Rs '.$mycreditplan->amount.' and get '.$mycreditplan->credit. ' exam credits'; exit();
		
	}
}



if (isset($_POST['captcha'])) {
	
		print $_SESSION[SESSION_TITLE.'security_code'];exit();
	
}
if (isset($_POST['captcha_image'])) {
	
		print '<img src="/captcha.php"/>';exit();
	
}

?>
