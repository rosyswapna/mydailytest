<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
	$myorganization = new Organization();
    $myorganization->connection = $myconnection;
	$user_statuses=$myorganization->get_list_array_organization_statuses();
	$types=$myorganization->get_list_array_organization_types();
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
 
 if ( $_POST['txtorganization_status'] == -1 ){
      $strERR .= $MSG_empty_organizationstatus;
 }

if ( $_POST['txtorganizationtype'] == -1 ){
      $strERR .= $MSG_empty_organizationtype;
 }

if($_POST['txtphone'] == ""){
	$strERR .= $MSG_empty_phone;
 }
$myorganization->error_description = $strERR;

if ( $strERR == "" ){
    $myorganization = new Organization();
    $myorganization->connection = $myconnection;
    $myorganization->username = $_POST['txtusername'];
    //check user exist or not
    $chk = $myorganization->exist();
    if ( $chk == true ){
        $myorganization->error_description = "User already exist";
    }else{
          	$myorganization->password = $_POST['txtpassword'];
		$myorganization->name = $_POST['txtname'];
        	$myorganization->organization_type_id = $_POST['txtorganizationtype'];
		$myorganization->organization_status_id =  $_POST['txtorganization_status'];
		if($myorganization->organization_status_id==USERSTATUS_WAITING_EMAIL_ACTIVATION){
		$myorganization->activation_token=md5(time());
		}else{
		$myorganization->activation_token="";
		}
		$myorganization->email = $_POST['txtemail'];
		$myorganization->phone = $_POST['txtphone'];
		$myorganization->address = $_POST['txtaddress'];
		$chk = $myorganization->update();
          if ( $chk == true ){
			if($myorganization->organization_status_id==USERSTATUS_WAITING_EMAIL_ACTIVATION){
				$myorganization_notification = new Organization_notification();
				$myorganization_notification->username = $myorganization->username;
				$myorganization_notification->activation_token=$myorganization->activation_token;
				$myorganization_notification->password=$myorganization->password;
				$myorganization_notification->to =$myorganization->email;
				$msg=$myorganization_notification->organization_account_activation();
				}
				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_added ;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "organizations.php";
				header( "Location: organizations.php");
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
      $myorganization = new Organization();
      $myorganization->id = $_GET['id'];
      $myorganization->connection = $myconnection;
      $chk1 = $myorganization->get_detail();
	$user_statuses=$myorganization->get_list_array_organization_statuses();
	$types=$myorganization->get_list_array_organization_types();
      if ( $chk == false ){
		  header("Location: index.php");
		  exit();
      }
 }


 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
 $strERR = "";

	  if ( $_POST['txtorganization_status'] == -1 ){
		  $strERR .= $MSG_empty_organizationstatus;
	 }

	 if ( $_POST['txtusername'] == "" ){
		  $strERR .= $MSG_empty_username;
	 }

	 if ( $_POST['txtemail'] == "" ){
		$strERR .= $MSG_empty_email;
	}
	
	if($_POST['hiddenusername']!=$_POST['txtusername']){
		$myorganization->username=$_POST['txtusername'];
		$chk = $myorganization->exist();
	   	 if ( $chk == true ){
		$strERR .= "User already exist";
		$myorganization->get_detail();
	    	}
		}
	$myorganization->error_description = $strERR;
	 if ( $strERR == "" ){
		$myorganization = new Organization();
		$myorganization->id = $_POST['h_id'];
		$myorganization->connection = $myconnection;
		$chk = $myorganization->get_detail();
		$myorganization->username = $_POST['txtusername'];
		$myorganization->password = $_POST['txtpassword'];
		$myorganization->name = $_POST['txtname'];
        	$myorganization->organization_type_id = $_POST['txtorganizationtype'];
		$myorganization->organization_status_id =  $_POST['txtorganization_status'];
		$myorganization->email = $_POST['txtemail'];
		$myorganization->phone = $_POST['txtphone'];
		$myorganization->address = $_POST['txtaddress'];
		
		$chk = $myorganization->update();

		if ( $chk == true ){
			$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_updated;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "organizations.php";
			header( "Location: organizations.php");
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
	$myorganization = new Organization();
	$myorganization->connection = $myconnection;
	$myorganization->id = $_POST['h_id'];
	$chk = $myorganization->delete();
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
