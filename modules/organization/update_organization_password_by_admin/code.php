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
       
       $myorganization = new Organization();
	$myorganization->connection = $myconnection;
      	$myorganization->id = $_POST['u_id'];
	$pass=$_POST['new_passwd'];
	$myorganization->password= md5(trim($_POST['new_passwd']));
      $chk = $myorganization->change_organization_password();
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_incorrect_password;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: dashboard.php");
        exit();
        //echo $msg_unmatching_que_ans;exit();
        }
        else{
	$myorganization_notification = new Organization_notification();
	$myorganization_notification->connection = $myconnection;
	$myorganization_notification->password=$myorganization->password;
	$myorganization_notification->id=$myorganization->id;
	$msg=$myorganization_notification->organization_password_reset_by_admin($pass);
	if($msg==true){
	$_SESSION[SESSION_TITLE.'flash'] =$RD_MSG_changed_password;
    // $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: dashboard.php");
        exit();
    }else{$_SESSION[SESSION_TITLE.'flash'] =$RD_MSG_changed_password_failed;
     //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: dashboard.php");
	exit();

    }
        }
}

}
?>
