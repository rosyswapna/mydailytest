<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

 $user_id =$_SESSION[SESSION_TITLE.'userid'];
$user_name=$_SESSION[SESSION_TITLE.'username'];
 $myagent = new Agent($myconnection);
 $myagent->connection = $myconnection;
 $myagent->id = $user_id;
 $chk_user = $myagent->get_detail();


 


 if ( isset($_GET['id']) && $_GET['id'] > 0 ){
      $myagent = new Agent();
      $myagent->id = $_GET['id'];
      $myagent->connection = $myconnection;
      $chk1 = $myagent->get_detail();
      if ( $chk == false ){
		  header("Location: index.php");
		  exit();
      }
 }




 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
		$strERR = "";
		$myagent->id = $user_id;
		
		 if ( $_POST['txtusername'] == "" ){
			  $strERR .= $MSG_empty_username;
		 }

		if($_POST['hiddenusername']!=$_POST['txtusername']){
		$myagent->username=$_POST['txtusername'];
		$chk = $myagent->exist();
	   	 if ( $chk == true ){
		$strERR .= "User already exist";
		}
		}
		
	 	if ( $strERR == "" ){
		$myagent->username= $_POST['txtusername'];
		$myagent->name= $_POST['txtname'];
		$myagent->email = $_POST['txtemail'];
		$myagent->phone= $_POST['txtphone'];
		$myagent->contact_phone= $_POST['txtcphone'];
		$myagent->address= $_POST['txtaddress'];
		$myagent->web_url= $_POST['txtweburl'];
		$chk = $myagent->update();	
		if ( $chk == true ){
			
			$_SESSION[SESSION_TITLE.'flash'] = "Profile updated.";
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] ="dashboard.php";
			header( "Location: dashboard.php");
			exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Profile updation failed.";
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
			header( "Location:".$current_url);
			exit();
		}
	

		}else
		{
			$_SESSION[SESSION_TITLE.'flash'] =$strERR;
			header( "Location:dashboard.php");
			exit();
		}

}
?>
