<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}


$record_per_page = 10;

$Mypagination = new Pagination($record_per_page);

$myorganization = new Organization($myconnection);
$myorganization->connection = $myconnection;
$my_organizations = $myorganization->get_organizations();

$myorganizationcredit = new OrganizationCredit($myconnection);
$myorganizationcredit->connection = $myconnection;
$organization_name = "";

if(isset($_SESSION[SESSION_TITLE.'organizationid'])){echo "org";exit();
	$myorganization->id = $_SESSION[SESSION_TITLE.'organizationid'];
	$myorganization->get_detail();
	$organization_name = $myorganization->name;
	$myorganizationcredit->organization_id =$myorganization->id;
	$myorganizationcredit->get_organization_total_credit();
}
else if(isset($_GET['id'])){
	$myorganization->id = $_GET['id'];
	$myorganization->get_detail();
	$organization_name = $myorganization->name;
	$myorganizationcredit->organization_id =$myorganization->id;
	$myorganizationcredit->get_organization_total_credit();
}

if(isset($_POST['submit']) and $_POST['submit'] == "Search")
{
	$myorganization->id = $_POST['lstorganization'];
	$myorganization->get_detail();
	$myorganizationcredit->organization_id =$myorganization->id;
	$my_organization_credits = $myorganizationcredit->get_list_array($Mypagination->start_record,$Mypagination->max_records);
	if($my_organization_credits == false){
	}
	else{
		$count_data=count($my_organization_credits);//echo $candidate->total_records;exit();
		$Mypagination->total_records = $myorganizationcredit->total_records;
		$Mypagination->paginate();
	}
	if($myorganization->id !="" || $myorganization->id != gINVALID){
		header("location:".$current_url."?id=".$myorganization->id);
	}
}


$my_organization_credits = $myorganizationcredit->get_list_array($Mypagination->start_record,$Mypagination->max_records);
if($my_organization_credits == false)
{
	
}
else
{
	$count_data=count($my_organization_credits);//echo $candidate->total_records;exit();
	$Mypagination->total_records = $myorganizationcredit->total_records;
	$Mypagination->paginate();
}

?>