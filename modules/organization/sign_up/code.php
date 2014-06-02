<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

 $myorganization = new Organization($myconnection);
 $myorganization->connection = $myconnection;
$myorganization->error_description = "";
$types=$myorganization->get_list_array_organization_types();

 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_add ) {
 $strERR = "";

 if ( trim($_POST['txtusername']) == "" ){
      $strERR .= "<br/>".$MSG_empty_username;
 }elseif (!filter_var($_POST['txtusername'], FILTER_VALIDATE_EMAIL)){
		$strERR .= "<br/>".$MSG_invalid_email;
 }
if ( trim($_POST['txtorganizationname']) == "" ){
      $strERR .= $MSG_empty_first_name."<br/>";
 }

 
if ( trim($_POST['txttype']) ==-1 ){
      $strERR .= $MSG_empty_type."<br/>";
 }
if ( trim($_POST['txtpassword']) == "" ){
      $strERR .= $MSG_empty_password."<br/>";
 }
if ( trim($_POST['txtconfirm']) == "" ){
      $strERR .= $MSG_empty_cpassword."<br/>";
 }

 if ( trim($_POST['txtpassword']) !=$_POST['txtconfirm']){
      $strERR .= "<br/>".$MSG_missmatch_password;
 }
/*
 if ( trim($_POST['txtoccupation']) == "" ){
      $strERR .= $MSG_empty_occupation."<br/>";
 }
 */

 if ( trim($_POST['txtemail']) != "" ){
     if (!filter_var($_POST['txtemail'], FILTER_VALIDATE_EMAIL))
		$strERR .= "<br/>".$MSG_invalid_email;
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
		
		  $myorganization->name = $_POST['txtorganizationname'];
		  $myorganization->last_name = $_POST['txtlast_name'];
		  $myorganization->address = $_POST['txtaddress'];
		  $myorganization->organization_type_id = $_POST['txttype'];
		  $myorganization->email = $_POST['txtemail'];
		  $myorganization->phone = $_POST['txtphone'];
		  $myorganization->web_url = $_POST['txtweburl'];
	    
          $myorganization->password = $_POST['txtpassword'];
          $myorganization->organization_status_id =  USERSTATUS_WAITING_EMAIL_ACTIVATION;
	  $myorganization->activation_token=md5(time());
          $chk = $myorganization->update();
          if ( $chk == true){
			if ( $myorganization->id > 0 ) {
				$myorganization_notification = new Organization_notification();
				$myorganization_notification->username = $myorganization->username;
				$myorganization_notification->activation_token=$myorganization->activation_token;
				$myorganization_notification->password=$myorganization->password;
				$myorganization_notification->to =$myorganization->email;
				$myorganization_notification->organization_account_activation();
				
				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_signup;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
				header( "Location: index.php");
				exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
				header( "Location:".$current_url);
				exit();
			}
    	}else{
			$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
			header( "Location".$current_url);
			exit();
			}
	}
}
}

?>
