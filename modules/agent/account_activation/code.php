<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
	
}
	$activation_token=$_GET['activation_token'];

	 $myorganization = new Organization();
      //$myorganization->id = $_SESSION[SESSION_TITLE.'userid'];
	$myorganization->connection = $myconnection;
	$chk = $myorganization->activate_account($activation_token);
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_incorrect_token;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
        header( "Location: index.php");
        exit(); 
        //echo $msg_unmatching_que_ans;exit();
        }
        else{

		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_correct_token;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "login.php";
		header( "Location: login.php");
		exit();
		}


?>
