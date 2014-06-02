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

$mypaymenttype = new PaymentType($myconnection);
$mypaymenttype->connection = $myconnection;
$mypaymenttype->online = PAYMENT_ONLINE;
$my_payment_types = $mypaymenttype->get_payment_types();

$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;

$mypayment = new Payment($myconnection);
$mypayment->connection = $myconnection;

$myvoucher = new Voucher($myconnection);
$myvoucher->connection = $myconnection;

 $strERR = "";

 if ( trim($_POST['username']) == "" ){
      $strERR .= "".$MSG_empty_username;
 }elseif (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)){
		$strERR .= "".$MSG_invalid_email;
 }


 if ( trim($_POST['first_name']) == "" ){
      $strERR .= "<br/>".$MSG_empty_first_name;
 }

 if ( trim($_POST['last_name']) == "" ){
      $strERR .= "<br/>".$MSG_empty_last_name;
 }

 if ( trim($_POST['exam_ids']) == -1 ){
      $strERR .= "<br/>".$MSG_empty_exam;
 }

 if ( trim($_POST['phone']) == "" ){
      $strERR .= "<br/>".$MSG_empty_phone;
 }



$myuser->error_description = $strERR;

if ( $strERR == "" ){
    $myuser = new User();
    $myuser->connection = $myconnection;
    $myuser->username =trim($_POST['username']);
    //check user exist or not
    $chk = $myuser->exist();
    if ( $chk == true ){
        $_SESSION[SESSION_TITLE.'flash'] = "User already exist";
	echo "index.php";
	exit();
    }else{
		  $myuser->phone = trim($_POST['phone']);
		  $myuser->first_name = trim($_POST['first_name']);
		  $myuser->last_name = trim($_POST['last_name']);
		  
		  $myuser->exam_ids = trim($_POST['exam_ids']);
		  
	    
          $myuser->password = trim($_POST['password']);
	  if($_POST['credit_plan_id']==gINVALID){
          $myuser->user_status_id =  USERSTATUS_WAITING_EMAIL_ACTIVATION;
	  $myuser->activation_token=md5(time());
	  }else{
	  $myuser->user_status_id = USERSTATUS_ACTIVE;	
	  }
	
	
		$chk = $myuser->update();
	  
		if($chk == true)
		{
			if(trim($_POST['voucher']) != ""){
				// 1. check voucher is valid
				$myvoucher->voucher = $_POST['voucher'];
				$my_voucher = $myvoucher->validate_voucher();
				if($my_voucher == true){
					// 2. update user credit with voucher
					$myvoucher->get_detail();
					$myusercredit->voucher_id = $myvoucher->id;
					$myusercredit->credit_type_id=CREDIT_TYPE_VOUCHER;
					$myusercredit->user_id=$myuser->id;
					$myusercredit->credit=$myvoucher->credit;
					$update = $myusercredit->update();
					if($update == true){
						// 3. update voucher as used
						$myvoucher->update_voucher_used();
					}
				}			
			}
		}
		


          if ( $chk == true && $myuser->user_status_id == USERSTATUS_WAITING_EMAIL_ACTIVATION )
          {
			if ( $myuser->id > 0 ) {
				
				$myuser_credits->credit_type_id=CREDIT_TYPE_OFFER;
				$myuser_credits->user_id=$myuser->id;
				$myuser_credits->credit=DEFAULT_NEW_USER_CREDITS;
				$myuser_credits->update();

				$myuser_notification = new User_notifications();
				$myuser_notification->username = $myuser->username;
				$myuser_notification->first_name=$myuser->first_name;
				$myuser_notification->last_name=$myuser->last_name;
				$myuser_notification->activation_token=$myuser->activation_token;
				$myuser_notification->password=$myuser->password;
				//$myuser_notification->to =$myuser->email;
				$myuser_notification->user_account_activation();

				

				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_signup;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
				echo "login.php";
				exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] = $myuser->error_description;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
				header( "Location:" .$current_url);

				exit();
			}
    	}else{
		if($chk==true){

				

				$myuser_notification = new User_notifications();
				$myuser_notification->connection= $myconnection;
				$myuser_notification->username = $myuser->username;
				$myuser_notification->activation_token=$myuser->activation_token;
				$myuser_notification->password=$myuser->password;
				//$myuser_notification->to =$myuser->email;
				$myuser_notification->user_welcome_email();

				$_SESSION[SESSION_TITLE.'user_status_id'] = $myuser->user_status_id;
				$_SESSION[SESSION_TITLE.'userid'] = $myuser->id;
				$_SESSION[strERRSSION_TITLE.'name'] = $myuser->first_name." ".$myuser->last_name;
			  	$_SESSION[SESSION_TITLE.'username'] = $myuser->username;
				$_SESSION[SESSION_TITLE.'exam_ids'] = $myuser->exam_ids;
				$_SESSION[SESSION_TITLE.'user_type'] = REGISTERED_USER;
				$_SESSION[SESSION_TITLE.'phone'] = $myuser->phone;
				$_SESSION[SESSION_TITLE.'registration_type'] ="REGISTER_WITH_PAYMENT";
				
				//payment
				
			$credit_plan	= trim($_POST['credit_plan_id']);
			$payment_type	= PAYMENT_TYPE_IIPAY;

			$mycreditplan->id=$credit_plan;
			$mycreditplan->get_detail();

			//ipayy payment start
			if($payment_type == PAYMENT_TYPE_IIPAY)
			{
				$urlstr = $credit_plan."_".$payment_type;
				echo "ipayy_payment.php?slno=".$urlstr;
				exit();
			}
		
			//ipayy payment ends here
			
			
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $myuser->error_description;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;

			echo "sign_up.php";

			exit();
			}
	}
	}
	}else{
	$_SESSION[SESSION_TITLE.'flash'] =$strERR;
	echo "sign_up.php";
	exit();	
	}
	
?>
