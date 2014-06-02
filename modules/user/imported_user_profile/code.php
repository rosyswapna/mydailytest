<?php 
// prevent execution of this page by direct call by browser
if($_SESSION[SESSION_TITLE.'user_status_id']==USERSTATUS_IMPORTED || $_SESSION[SESSION_TITLE.'user_status_id']==USERSTATUS_MOBILE_REGISTRATION){

if ( !defined('CHECK_INCLUDED') ){
    exit();
}
 $user_id =$_SESSION[SESSION_TITLE.'userid'];
$user_name=$_SESSION[SESSION_TITLE.'username'];
 $myuser = new User($myconnection);
 $myuser->connection = $myconnection;
 $myuser->id = $user_id;
 $chk_user = $myuser->get_detail();

$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$my_exams = $myexam->get_detail_all();
 


 if ( isset($_GET['id']) && $_GET['id'] > 0 ){
      $myuser = new User();
      $myuser->id = $_GET['id'];
      $myuser->connection = $myconnection;
      $chk1 = $myuser->get_detail();
      if ( $chk == false ){
		  header("Location: index.php");
		  exit();
      }
 }




 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
		$myuser = new User();
		 $myuser->connection = $myconnection;
		$strERR='';$strERORR='';
		 if ( trim($_POST['txtusername']) == "" ){
      		$strERR .= "<br/>".$MSG_empty_username;
 		}else if (!filter_var($_POST['txtusername'], FILTER_VALIDATE_EMAIL)){
		$strERR .= "<br/>".$MSG_invalid_username;
 		}	
		if ( trim($_POST['txtemail']) != "" ){
    		 if (!filter_var($_POST['txtemail'], FILTER_VALIDATE_EMAIL))
		$strERR .= "<br/>".$MSG_invalid_email;
 		}
		$myuser->id = $user_id;
		if($_POST['hiddenusername']!=$_POST['txtusername']){
		$myuser->username=$_POST['txtusername'];
		$chk = $myuser->exist();
	   	 if ( $chk == true ){
		$strERR .= "User already exist";
		}
		}	
		if($strERR!=""){
		
			$_SESSION[SESSION_TITLE.'flash'] = $strERR;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;

			header( "Location:".$current_url );

			exit();
		
		}else{
		if($_POST['txtusername']==$user_name && ($_SESSION[SESSION_TITLE.'user_status_id']==USERSTATUS_IMPORTED || $_SESSION[SESSION_TITLE.'user_status_id']==USERSTATUS_MOBILE_REGISTRATION))
		{
		$strERORR="error";
		}
		if($strERORR==''){
		if(isset($_POST['chk_exam']))
		{
			foreach ($_POST['chk_exam'] as $exam) {
				$exam_ids .= $exam.DEFAULT_IDS_DELIMITER;
			}
			if($exam_ids!=""){
				$myuser->exam_ids = substr($exam_ids,0,-1);
			}
		}		
		
		$myuser->username= $_POST['txtusername'];
		$myuser->first_name= $_POST['txtfirst_name'];
		$myuser->last_name= $_POST['txtlast_name'];
		$myuser->email = $_POST['txtemail'];
		$myuser->occupation= $_POST['txtoccupation'];
		$myuser->phone= $_POST['txtphone'];
		$myuser->address= $_POST['txtaddress'];
		$myuser->user_status_id=USERSTATUS_ACTIVE;
		$myuser->connection = $myconnection;
		$chk = $myuser->update();	
	if ( $chk == true ){
			$_SESSION[SESSION_TITLE.'flash'] = $myuser->error_description;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] ="logout.php";
			header( "Location: logout.php");
			exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $myuser->error_description;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;

			header( "Location:".$current_url );

			exit();
		}
	
 }else{	
			$myuser->error_description=$RD_MSG_change_username;
			$_SESSION[SESSION_TITLE.'flash'] = $myuser->error_description;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;

			header( "Location:".$current_url );

			exit();
}
}
}
}
?>
