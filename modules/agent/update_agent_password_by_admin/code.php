<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
if(isset($_GET['id'])){
$u_id=$_GET['id'];
}

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
       
       $myagent = new Agent();
	$myagent->connection = $myconnection;
      	$myagent->id = $_POST['u_id'];
	$pass=$_POST['new_passwd'];
	$myagent->password= md5(trim($_POST['new_passwd']));
      $chk = $myagent->change_agent_password();
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = "Updation failed";
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: agents.php");
        exit();
        
        }
        else{
	$myagent_notification = new Agent_notification();
	$myagent_notification->connection = $myconnection;
	$myagent_notification->password=$myagent->password;
	$myagent_notification->id=$myagent->id;
	$msg=$myagent_notification->agent_password_reset_by_admin($pass);
	if($msg==true){
	$_SESSION[SESSION_TITLE.'flash'] =$RD_MSG_changed_password;
    // $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: agents.php");
        exit();
    }else{$_SESSION[SESSION_TITLE.'flash'] ="password changed notification sending failed";
     //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: agents.php");
	exit();

    }
        }
}

}
?>
