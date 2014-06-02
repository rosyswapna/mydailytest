<?php

//prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}



$message="";

$mypayment = new Payment($myconnection);
$mypayment->connection = $myconnection;

$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;

$mycreditplan = new CreditPlan($myconnection);
$mycreditplan->connection = $myconnection;

$myuser = new User($myconnection);
$myuser->connection = $myconnection;

$mypaymentstatus = new PaymentStatus($myconnection);
$mypaymentstatus->connection = $myconnection;

$transaction_status = "";




if(count($_GET) > 0)
{
	if(isset($_GET['plid'])){	
		$credit_plan		= $_GET['plid'];
	}
	else{
		$credit_plan = gINVALID;
	}

	if (array_key_exists(CryptoUtils::ENCRYPTED_STRING_PARAM, $_GET)) 
	{
		try {
			$return = CryptoUtils::decrypt($_GET[CryptoUtils::ENCRYPTED_STRING_PARAM]);
		} catch (CryptoException $e) {
			echo "Got Exception: " . $e->getMessage();
		}
		//print_r($return);exit();
		$order_id		= $return['r'];
		$payment_id 	= substr($order_id,10,strlen($order_id));
		if(array_key_exists('ts', $return)){ //check transaction status returned
			$transaction_status		= $return['ts'];
		}else{
			$transaction_status = "";
		}

		if($transaction_status == 'S')//transaction success
		{
			if(array_key_exists('tx', $return))
			{
				$transaction_id	= $return['tx'];
				$check = $mypayment->check_ipayy_transaction($transaction_id);
				if($check == true){
					header("Location:get_credit.php");exit();
				}
				else{
					$mypayment->id = $payment_id;
					$mypayment->payment_status_id = PAYMENT_STATUS_PAID;
					$mypayment->iipay_transaction_number = $transaction_id;
					$update = $mypayment->update_from_ipayy_process();


					if($update == true)//update user credit table
					{
						$mypayment->id = $payment_id;
						$mypayment->get_detail();
						$mycreditplan->id = $credit_plan;
						$my_plan = $mycreditplan->get_detail();
						
						if($my_plan == false){
							$myusercredit->credit = $mypayment->amount;
						}
						else{
							$myusercredit->credit = $mycreditplan->credit;
					    	$myusercredit->credit_plan_id = $mycreditplan->id;
						}
						$myusercredit->credit_type_id = CREDIT_TYPE_PAYMENT;
					    $myusercredit->payment_id = $mypayment->id;;
					    $myusercredit->user_id = $mypayment->user_id;
					    $update = $myusercredit->update();
						if($_SESSION[SESSION_TITLE.'registration_type']=="REGISTER_WITH_PAYMENT"){
						$mysms = new Sms();
						$phone=trim($_SESSION[SESSION_TITLE.'phone']);
						$mysms->amount=$mypayment->amount;
						$mysms->user_welcome_sms_paid($phone);
						$_SESSION[SESSION_TITLE.'flash'] = " Transaction success. Your account has been updated with ".$myusercredit->credit." exam credits. ";
						header( "Location: dashboard.php");
						exit();
						}
					}
					$message = "Transaction success. Your account has been updated with ".$myusercredit->credit." exam credits.";	
			$_SESSION[SESSION_TITLE.'flash'] = $message;
			header( "Location:dashboard.php");
			exit();
				}
			}
			else{
				$_SESSION[SESSION_TITLE.'flash'] = "Erron in IPAYY Transaction .Please contact administrator";
				header( "Location: get_credit.php");
				exit();
			}
		}
		else if($transaction_status == 'F')//transaction failure
		{
			if(array_key_exists('tf', $return)){
				switch($return['tf'])
				{
					case 'LB':$message .= "Transaction Failed due to Low Balance";
								$mypayment->payment_status_id = PAYMENT_STATUS_FAILED;
								break;
					case 'IS':$message .= "You are does not belong to the selected operator network";
								$mypayment->payment_status_id = PAYMENT_STATUS_FAILED;
								break;
					case 'OF':$message .= "Transaction failed due to some other failure . Please contact administrator";
								$mypayment->payment_status_id = PAYMENT_STATUS_FAILED;
								break;
					case 'UC':$message .= "Your Transaction cancelled";
								$mypayment->payment_status_id = PAYMENT_STATUS_CANCELLED;
								break;
					case 'ST':$message .= "Session timed out .Please try again";
								$mypayment->payment_status_id = PAYMENT_STATUS_FAILED;
								break;
					case 'PF':$message .= "OTP retry max attempts exceeded .Please try again";
								$mypayment->payment_status_id = PAYMENT_STATUS_FAILED;
								break;
					default:$message .= "Transaction Failed";
							$mypayment->payment_status_id = PAYMENT_STATUS_FAILED;
				}
			}else{
				$message = "Transaction Failed";
				$mypayment->payment_status_id = PAYMENT_STATUS_FAILED;
			}
			
			$mypayment->id = $payment_id;
			$update = $mypayment->update_from_ipayy_process();
			if(array_key_exists('tf', $return) and $return['tf']== 'UC'){
				$_SESSION[SESSION_TITLE.'flash'] = $message;
				header( "Location: get_credit.php");
				exit();
			}
		}
		else{
			$_SESSION[SESSION_TITLE.'flash'] = "Erron in IPAYY Transaction .Please contact administrator";
			header( "Location: get_credit.php");
			exit();
		}	

	} 
	else
	{
		$_SESSION[SESSION_TITLE.'flash'] = "Payment details not returned";
		header( "Location: get_credit.php");
		exit();
	}
}
else{
	header( "Location: get_credit.php");
	exit();
}



/*
$mymail = new Email()
$mymail->to_email ="rosy.swapna@acube.co";
$mymail->from_email ="from@ipayy.co";
$mymail->su
*/

?>
