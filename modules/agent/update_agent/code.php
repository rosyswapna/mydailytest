<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
	$myagent = new Agent();
    $myagent->connection = $myconnection;
	$agent_statuses=$myagent->get_list_array_agent_statuses();
	
 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_add ) {
 $strERR = "";
 if ( trim($_POST['txtusername']) == "" ){
      $strERR .= $MSG_empty_username;
 }

 if ( trim($_POST['txtemail']) == "" ){
      $strERR .= $MSG_empty_email;
 }

 if ( trim($_POST['txtpassword']) == "" && trim($_POST['txtrepassword']) == "" ){
	      $strERR .= $MSG_empty_password;
  
 }
if ( trim($_POST['txtpassword']) !=trim($_POST['txtrepassword']) ){
	      $strERR .= $MSG_match_password;
  
 }
 
 if ( $_POST['txtagent_status'] == -1 ){
      $strERR .= $MSG_empty_Agentstatus;
 }


if($_POST['txtphone'] == ""){
	$strERR .= $MSG_empty_phone;
 }
$myagent->error_description = $strERR;

if ( $strERR == "" ){
    $myagent = new Agent();
    $myagent->connection = $myconnection;
    $myagent->username = $_POST['txtusername'];
    //check user exist or not
    $chk = $myagent->exist();
    if ( $chk == true ){
        $myagent->error_description = "User already exist";
    }else{
          	$myagent->password = $_POST['txtpassword'];
		$myagent->name = $_POST['txtname'];
        	
		$myagent->agent_status_id =  $_POST['txtagent_status'];
		if($myagent->agent_status_id==USERSTATUS_WAITING_EMAIL_ACTIVATION){
		$myagent->activation_token=md5(time());
		}else{
		$myagent->activation_token="";
		}
		$myagent->email = $_POST['txtemail'];
		$myagent->phone = $_POST['txtphone'];
		$myagent->address = $_POST['txtaddress'];
		$chk = $myagent->update();
          if ( $chk == true ){
			if($myagent->agent_status_id==USERSTATUS_WAITING_EMAIL_ACTIVATION){
				$myagent_notification = new Agent_notification();
				$myagent_notification->username = $myagent->username;
				$myagent_notification->activation_token=$myagent->activation_token;
				$myagent_notification->password=$myagent->password;
				$myagent_notification->to =$myagent->email;
				$msg=$myagent_notification->agent_account_activation();
				}
				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_added ;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "Agents.php";
				header( "Location: agents.php");
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
      $myagent = new Agent();
      $myagent->id = $_GET['id'];
      $myagent->connection = $myconnection;
      $chk1 = $myagent->get_detail();
	$agent_statuses=$myagent->get_list_array_Agent_statuses();
	
      if ( $chk == false ){
		  header("Location: index.php");
		  exit();
      }
 }


 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
 $strERR = "";

	  if ( $_POST['txtagent_status'] == -1 ){
		  $strERR .= $MSG_empty_Agentstatus;
	 }

	 if ( $_POST['txtusername'] == "" ){
		  $strERR .= $MSG_empty_username;
	 }

	 if ( $_POST['txtemail'] == "" ){
		$strERR .= $MSG_empty_email;
	}
	
	if($_POST['hiddenusername']!=$_POST['txtusername']){
		$myagent->username=$_POST['txtusername'];
		$chk = $myagent->exist();
	   	 if ( $chk == true ){
		$strERR .= "User already exist";
		$myagent->get_detail();
	    	}
		}
	$myagent->error_description = $strERR;
	 if ( $strERR == "" ){
		$myagent = new Agent();
		$myagent->id = $_POST['h_id'];
		$myagent->connection = $myconnection;
		$chk = $myagent->get_detail();
		$myagent->username = $_POST['txtusername'];
		$myagent->password = $_POST['txtpassword'];
		$myagent->name = $_POST['txtname'];
       	$myagent->agent_status_id =  $_POST['txtAgent_status'];
		$myagent->email = $_POST['txtemail'];
		$myagent->phone = $_POST['txtphone'];
		$myagent->address = $_POST['txtaddress'];
		
		$chk = $myagent->update();

		if ( $chk == true ){
			$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_updated;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "Agents.php";
			header( "Location: agents.php");
			exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
			header( "Location:".$current_url);
			exit();
		}
	 }
 }
if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_delete ) {
	$myagent = new Agent();
	$myagent->connection = $myconnection;
	$myagent->id = $_POST['h_id'];
	$chk = $myagent->delete();
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
