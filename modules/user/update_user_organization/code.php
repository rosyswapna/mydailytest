<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
	$myorganizationcredit = new OrganizationCredit();
	$myorganizationcredit->connection = $myconnection;

	$myusercredit = new UserCredit();
	$myusercredit->connection = $myconnection;

	$myorganizationcredit->organization_id = $_SESSION[SESSION_TITLE.'userid'];
	$myorganizationcredit->get_organization_total_credit();


	$myuser = new User();
    $myuser->connection = $myconnection;
	$user_statuses=$myuser->get_list_array();
 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_add ) {
 $strERR = "";
 if ( trim($_POST['txtusername']) == "" ){
      $strERR .= $MSG_empty_username;
 }
/*
 if ( trim($_POST['txtemail']) == "" ){
      $strERR .= $MSG_empty_email;
 }*/

 if ( trim($_POST['txtpassword']) == "" && trim($_POST['txtrepassword']) == "" ){
	      $strERR .= $MSG_empty_password;
  
 }
if ( trim($_POST['txtpassword']) !=trim($_POST['txtrepassword']) ){
	      $strERR .= $MSG_match_password;
  
 }
 
 if ( $_POST['txtuserstatus'] == -1 ){
      $strERR .= $MSG_empty_userstatus;
 }
/*
if($_POST['txtphone'] == ""){
	$strERR .= $MSG_empty_phone;
 }*/


 	if($_POST['txtcredit'] != ""){
	 	$options = array('options' => array('min_range' => 1,'max_range' => $myorganizationcredit->total_credit));
		if(!filter_var($_POST['txtcredit'], FILTER_VALIDATE_INT)){
			$strERR .= $MSG_invalid_credit;
		}elseif(!filter_var($_POST['txtcredit'], FILTER_VALIDATE_INT,$options)){
				$validation = false;
				$strERR .= $MSG_low_credit;
		}
	}

	

$myuser->error_description = $strERR;

if ( $strERR == "" ){
    $myuser->username = $_POST['txtusername'];
    //check user exist or not
    $chk = $myuser->exist();
    if ( $chk == true ){
       $_SESSION[SESSION_TITLE.'flash'] ="User already exist";
    }else{
          	$myuser->password = $_POST['txtpassword'];
		$myuser->first_name = $_POST['txtfirstname'];
        	$myuser->last_name = $_POST['txtlastname'];
		$myuser->user_status_id =  $_POST['txtuserstatus'];
		if($myuser->user_status_id== USERSTATUS_WAITING_EMAIL_ACTIVATION){
		$myuser->activation_token=md5(time());
		}else{
		$myuser->activation_token="";
		}
		$myuser->organization_id=$_SESSION[SESSION_TITLE.'userid'];
		$myuser->email = $_POST['txtemail'];
		$myuser->phone = $_POST['txtphone'];
		$myuser->address = $_POST['txtaddress'];
		$myuser->occupation = $_POST['txtoccupation'];
		$chk = $myuser->update();
          if ( $chk == true ){
			if($myuser->user_status_id==USERSTATUS_WAITING_EMAIL_ACTIVATION){
				$myuser_notification = new User_notifications();
				$myuser_notification->username = $myuser->username;
				$myuser_notification->activation_token=$myuser->activation_token;
				$myuser_notification->password=$myuser->password;
				$myuser_notification->to =$myuser->email;
				$msg=$myuser_notification->user_account_activation();
				}
				 
 				if ( $_POST['txtcredit'] != '' ){//update user credit
 					//deduct from organization credit table
 					$myorganizationcredit->organization_id = $_SESSION[SESSION_TITLE.'userid'];
					$myorganizationcredit->credit_type_id = CREDIT_TYPE_ORGANIZATION_CREDIT;
					$myorganizationcredit->credit = -($_POST['txtcredit']);
					$update = $myorganizationcredit->update();
					//credit to user credit table
					if($update == true){
						$myusercredit->credit_type_id=CREDIT_TYPE_OFFER;
						$myusercredit->user_id=$myuser->id;
						$myusercredit->credit=$_POST['txtcredit'];
						$myusercredit->organization_credit_id = $myorganizationcredit->id;
						$myusercredit->update();
					}
				}
				
				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_added ;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "users.php";
				header( "Location: users.php");
				exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
				header( "Location:".$current_url);
				exit();
			}
    	}
	}
}

 if ( isset($_GET['id']) && $_GET['id'] > 0 ){
      $myuser = new User();
      $myuser->id = $_GET['id'];
      $myuser->connection = $myconnection;
	   $myuser->organization_id=$_SESSION[SESSION_TITLE.'userid'];
      $chk = $myuser->get_detail();
	$user_statuses=$myuser->get_list_array();
      if ( $chk == false ){
		  $_SESSION[SESSION_TITLE.'flash'] ="You are not authorized acces this content.";
		  header("Location: users.php");
		  exit();
      }
 }


 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
 $strERR = "";
	
	 if ( $_POST['txtuserstatus'] == -1 ){
		  $strERR .= $MSG_empty_userstatus;
	 }

	 if ( $_POST['txtusername'] == "" ){
		  $strERR .= $MSG_empty_username;
	 }

	 if ( $_POST['txtemail'] == "" ){
		$strERR .= $MSG_empty_email;
	}

	if($_POST['hiddenusername']!=$_POST['txtusername']){
		$myuser->username=$_POST['txtusername'];
		$chk = $myuser->exist();
	   	 if ( $chk == true ){
		$strERR .= "User already exist";
		$myuser->get_detail();
	    	}
		}
	$myuser->error_description = $strERR;
	 if ( $strERR == "" ){
		
		echo $myuser->id = $_POST['h_id'];
		
		$chk = $myuser->get_detail();
		$myuser->username = $_POST['txtusername'];
		$myuser->password = $_POST['txtpassword'];
		$myuser->first_name = $_POST['txtfirstname'];
        	$myuser->last_name = $_POST['txtlastname'];
		$myuser->user_status_id = $_POST['txtuserstatus'];
		$myuser->email = $_POST['txtemail'];
		$myuser->phone = $_POST['txtphone'];
		$myuser->address = $_POST['txtaddress'];
		$myuser->occupation = $_POST['txtoccupation'];
		$chk = $myuser->update();

		if ( $chk == true ){
			$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_updated;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "users.php";
			header( "Location: users.php");
			exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
			header( "Location: ". $current_url);
			exit();
		}
	 }
 }
if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_delete ) {
	$myuser = new User();
	$myuser->connection = $myconnection;
	$myuser->id = $_POST['h_id'];
	$chk = $myuser->delete();
	if ( $chk == true ){
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_deleted;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "users.php";
		header( "Location: users.php");
		exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
		header( "Location:".$current_url);
		exit();
	}
}
?>
