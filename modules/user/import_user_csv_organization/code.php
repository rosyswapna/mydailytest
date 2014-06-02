<?php  
 // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
	$myorganization = new Organization();
	$myorganization->connection = $myconnection;

	$myorganizationcredit = new OrganizationCredit();
	$myorganizationcredit->connection = $myconnection;
	$myorganizationcredit->organization_id = $_SESSION[SESSION_TITLE.'userid'];
	$myorganizationcredit->get_organization_total_credit();

	$myusercredit=new UserCredit();
	$myusercredit->connection = $myconnection;

$organizations=$myorganization->get_list_array_organizations();
if(isset($_FILES["csv"]["size"]) && $_FILES["csv"]["size"] > 0) { 
	$myuser = new User();
	$myuser->connection = $myconnection;
	$myuser->organization_id= $_SESSION[SESSION_TITLE.'userid'];
	//get the csv file 
    $file = $_FILES["csv"]["tmp_name"]; 
    $handle = fopen($file,"r");
    $user_ids = array();
    $i = 0;
	while ($data = fgetcsv($handle,1000,",","'")){ 
		$myuser->username=$data[0]; 
		$myuser->password=$data[1]; 
		$chk=$myuser->import_user_csv();
		if($chk == true) {
			$user_ids[$i] .= $myuser->id;
			$i++;
		}
		$myuser->username=""; 
		$myuser->password="";
	}

	$user_count = count($user_ids);
	$credit_each = $_POST['txtcredit'];
	$need_credit = $user_count*$credit_each;
	if($user_count > 0 and $need_credit <= $myorganizationcredit->total_credit){
		//deduct organization credit
		$myorganizationcredit->organization_id = $_SESSION[SESSION_TITLE.'userid'];
		$myorganizationcredit->credit_type_id = CREDIT_TYPE_ORGANIZATION_CREDIT;
		$myorganizationcredit->credit = -($need_credit);
		$update = $myorganizationcredit->update();
		if($update == true){
			//credit user credit
			$myusercredit->credit_type_id = CREDIT_TYPE_OFFER;
			$myusercredit->organization_credit_id = $myorganizationcredit->id;
			$myusercredit->credit = $credit_each;		
			$myusercredit->update_from_organization_import($user_ids);
		}
	}
	
	if($user_count > 0){
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
