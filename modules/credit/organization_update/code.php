<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$Mypagination = new Pagination(10);

$myorganization = new Organization($myconnection);
$myorganization->connection = $myconnection;

$myorganizationcredit = new OrganizationCredit($myconnection);
$myorganizationcredit->connection = $myconnection;

$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;

if(isset($_GET['slno'])){
	$myusercredit ->user_id = $_GET['slno'];
}
$my_user_credits = $myusercredit->get_user_credit_list_array();
$myusercredit->get_user_total_credit();


$myorganizationcredit->organization_id = $_SESSION[SESSION_TITLE.'userid'];
$myorganizationcredit->get_organization_total_credit();



if($my_user_credits == false)
{
	$myusercredit->error_description = "No records found";
	$myusercredit->total_credit = 0;
}
else{
	$count_data = count($my_user_credits);
}







//temporary code for payment

if(isset($_POST['submit']) and $_POST['submit'] == "Add")
{
	$errorMSG = "";
	$user_id = $_POST['hd_userid'];
	$organization_id = $_SESSION[SESSION_TITLE.'userid'];
	$txtcredit = $_POST['txtcredit'];

	$myorganizationcredit->organization_id = $organization_id;
	$myorganizationcredit->get_organization_total_credit();
	$options = array('options' => array('min_range' => 1,'max_range' => $myorganizationcredit->total_credit));

	//validation start
	if($txtcredit == ""){
		$validation =false;
		$errorMSG = "Please fill all required fields";
	}else{
		if(filter_var($txtcredit, FILTER_VALIDATE_INT,$options)){
			$validation = true;
		}else{
			$validation = false;
			$errorMSG = "Enter valid credit";
		}
	}
	//validaion ends

	if($validation == true){
		//debit from organization credit
		$myorganizationcredit->organization_id = $organization_id;
		$myorganizationcredit->credit_type_id = CREDIT_TYPE_ORGANIZATION_CREDIT;
		$myorganizationcredit->credit = -($txtcredit);
		$update = $myorganizationcredit->update();

		//credit to user credit
		if($update == true){
			$myusercredit->user_id = $user_id;
			$myusercredit->credit_type_id = CREDIT_TYPE_OFFER;
			$myusercredit->credit = $txtcredit;
			$myusercredit->organization_credit_id = $myorganizationcredit->id;
			$myusercredit->update();
		}
		$_SESSION[SESSION_TITLE.'flash'] = "User account credited";
	    header( "Location: get_credit_from_org.php?slno=".$user_id);
	    exit();
		
		
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
	    header( "Location: get_credit_from_org.php?slno=".$user_id);
	    exit();
	}
}




?> 
