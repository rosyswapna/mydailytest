<?php  
 // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
	$myorganization = new Organization();
	$myorganization->connection = $myconnection;
	$myuser_credits=new UserCredit();
	$myuser_credits->connection = $myconnection;
$organizations=$myorganization->get_list_array_organizations();
if(isset($_FILES["csv"]["size"]) && $_FILES["csv"]["size"] > 0) { 
	$myuser = new User();
	$myuser->connection = $myconnection;
	if ( $_POST['txtorganizationid'] == -1 ){
	$myuser->organization_id= "NULL";
	 }else{
      	$myuser->organization_id= $_POST['txtorganizationid'];
	}
    //get the csv file 
    $file = $_FILES["csv"]["tmp_name"]; 
    $handle = fopen($file,"r");
	do { 
        if ($data[0]) { 
          $myuser->username=$data[0]; 
          $myuser->password=$data[1]; 
          $chk=$myuser->import_user_csv(); 
	 $myuser->username=""; 
	 $myuser->password="";
	if(isset($_POST['chkoffer'])) {
	$myuser_credits->credit_type_id=CREDIT_TYPE_OFFER;
	$myuser_credits->user_id=$myuser->id;
	$myuser_credits->credit=DEFAULT_NEW_USER_CREDITS;
	$myuser_credits->update();
	}
    	}
	}while ($data = fgetcsv($handle,1000,",","'"));  
	
	if($chk==true){
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
		header( "Location: dashboard.php");
		exit();
}else{
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
		header( "Location: dashboard.php");
		exit();
}
} 
?>
