<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}




$login_error = "";
if(isset($_POST['submit']) and $_POST['submit'] == $capSIGNIN)
{
	if ( $_POST['loginname'] == ""  || $_POST['passwd'] == ""){
		$login_error = "Invalid Username or password!";
	}
	
	
	if ( $login_error == "" )
	{
		  $username = trim($_POST['loginname']);
		  $password = md5(trim($_POST['passwd']));


		  $myorganizationsession = new Organization_session($username,$password,$myconnection);
			 
		  $chk = $myorganizationsession->login();
		  if ( $chk == true ){
			if($_SESSION[SESSION_TITLE.'organization_status_id']==USERSTATUS_IMPORTED){
			 header('Location:update_user_profile.php');
				exit();
		}else{
			  header('Location:dashboard.php');
				exit();
		  }	
		  }
		  else{
			  $login_error = "Invalid Username or password!";
		  }
		  
	}
	
	
}



?>
