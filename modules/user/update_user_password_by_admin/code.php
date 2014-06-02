<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$u_id=$_GET['id'];
if (isset($_POST['submit']) && $_POST['submit'] == $CAP_update){
$passwd_error = "";
if ( $_POST['new_passwd'] == "" ){
    $passwd_error .= "<br/>".$MSG_empty_new_password;
}
if ( $_POST['retype_passwd'] == "" ){
    $passwd_error .= "<br/>".$MSG_empty_retype_password;
}
if ( $_POST['new_passwd'] != $_POST['retype_passwd'] ){
    $passwd_error .= "<br/>".$MSG_unmatching_passwords;
}
if ( $passwd_error == "" ){
       
       $myuser = new User();
	$myuser->connection = $myconnection;
      	$myuser->id = $_POST['u_id'];
	$pass=$_POST['new_passwd'];
	$myuser->password= md5(trim($_POST['new_passwd']));
      $chk = $myuser->change_user_password();
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_incorrect_password;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: dashboard.php");
        exit();
        //echo $msg_unmatching_que_ans;exit();
        }
        else{
	$myuser_notification = new User_notifications();
	$myuser_notification->connection = $myconnection;
	$myuser_notification->password=$myuser->password;
	$myuser_notification->id=$myuser->id;
	$msg=$myuser_notification->user_password_reset_by_admin($pass);
	if($msg==true){
	$_SESSION[SESSION_TITLE.'flash'] =$RD_MSG_changed_password;

    // $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: dashboard.php");
        exit();
    }else{$_SESSION[SESSION_TITLE.'flash'] =$RD_MSG_changed_password_failed;
    // $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: dashboard.php");
	 exit();

    }
        }
}

}
?>
