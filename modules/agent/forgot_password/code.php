<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

if (isset($_POST['captcha'])) {
	
		print $_SESSION[SESSION_TITLE.'security_code'];exit();
	
}
if (isset($_POST['captcha_image'])) {
	
		print '<img src="/captcha.php"/>';exit();
	
}

if (isset($_POST['submit']) && $_POST['submit'] == $CAP_reset){

      
      $myagent = new Agent();
      //$myagent->id = $_SESSION[SESSION_TITLE.'userid'];
	$myagent->connection = $myconnection;
	$myagent->username = $_POST['username'];
        $chk = $myagent->check_email();
	   if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_incorrect_username;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
        header( "Location: index.php");
        exit(); 
        //echo $msg_unmatching_que_ans;exit();
        }
        else{
	if($strERR==""){	
	$myagent_notification = new Agent_notification();
	$myagent_notification->connection = $myconnection;
	$myagent_notification->username = $_POST['username'];
	$myagent_notification->password_token=$chk;
	$myagent_notification->agent_password_reset();
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
