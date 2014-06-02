<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
if (isset($_POST['submit']) && $_POST['submit'] == $CAP_reset){

      
      $myorganization = new Organization();
      //$myorganization->id = $_SESSION[SESSION_TITLE.'userid'];
	$myorganization->connection = $myconnection;
	$myorganization->username = $_POST['username'];
        $chk = $myorganization->check_email();
	if($_SESSION[SESSION_TITLE.'captcha']!=$_POST['randome_expression']){
	$strERR="Captcha Mismached";
	}
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_incorrect_username;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
        header( "Location: index.php");
        exit(); 
        //echo $msg_unmatching_que_ans;exit();
        }
        else{
	if($strERR==""){	
	$myorganization_notification = new Organization_notification();
	$myorganization_notification->connection = $myconnection;
	$myorganization_notification->username = $_POST['username'];
	$myorganization_notification->password_token=$chk;
	$msg=$myorganization_notification->organization_password_reset();
	$msg.=$RD_MSG_email_send;
		$_SESSION[SESSION_TITLE.'flash'] =$msg;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
		header( "Location: index.php");
		exit();
		}else{
		$_SESSION[SESSION_TITLE.'flash'] =$strERR;
		header( "Location: index.php");
        	exit(); 
		}
	}
}
?>
