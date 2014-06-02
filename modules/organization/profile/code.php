<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

 $user_id =$_SESSION[SESSION_TITLE.'userid'];
$user_name=$_SESSION[SESSION_TITLE.'username'];
 $myorganization = new Organization($myconnection);
 $myorganization->connection = $myconnection;
 $myorganization->id = $user_id;
 $chk_user = $myorganization->get_detail();
$types=$myorganization->get_list_array_organization_types();

 


 if ( isset($_GET['id']) && $_GET['id'] > 0 ){
      $myorganization = new Organization();
      $myorganization->id = $_GET['id'];
      $myorganization->connection = $myconnection;
      $chk1 = $myorganization->get_detail();
      if ( $chk == false ){
		  header("Location: index.php");
		  exit();
      }
 }




 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
		$strERR = "";
		$myorganization->id = $user_id;
		if ( $_POST['txttype'] == -1 ){
		  $strERR .= $MSG_empty_type;
		 }

		 if ( $_POST['txtusername'] == "" ){
			  $strERR .= $MSG_empty_username;
		 }

		if($_POST['hiddenusername']!=$_POST['txtusername']){
		$myorganization->username=$_POST['txtusername'];
		$chk = $myorganization->exist();
	   	 if ( $chk == true ){
		$strERR .= "User already exist";
		}
		}
		
	 	if ( $strERR == "" ){
		echo $myorganization->username= $_POST['txtusername'];
		echo $myorganization->name= $_POST['txtname'];
		echo $myorganization->organization_type_id= $_POST['txttype'];
		echo $myorganization->email = $_POST['txtemail'];
		echo $myorganization->phone= $_POST['txtphone'];
		echo $myorganization->contact_phone= $_POST['txtcphone'];
		echo $myorganization->address= $_POST['txtaddress'];
		echo $myorganization->web_url= $_POST['txtweburl'];
		echo $myorganization->password="";
		
		$chk = $myorganization->update();	
		if ( $chk == true ){
			
			$_SESSION[SESSION_TITLE.'flash'] = $myorganization->error_description;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] ="dashboard.php";
			header( "Location: dashboard.php");
			exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $myorganization->error_description;
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
