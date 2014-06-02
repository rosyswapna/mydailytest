<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$mygroupimports = new Groups_import($myconnection);
 	$mygroupimports->connection = $myconnection;

 	$mytempgroup = new Temp_groups();
   	 $mytempgroup->connection = $myconnection;

if(isset($_GET['importid'])){
$group_import_id ="";
$group_import_id = $_GET['importid'];

$mygroupimports->id= $group_import_id;
	$mygroupimports->get_count_passages();
	$mygroupimports->get_detail();
	$mygroup = new Groups();
	$mygroup->connection = $myconnection;
	$mygroup->question_group_import_id=$group_import_id;
	$mygroup->get_count_passages();

}

    //check user exist or not
    
if(isset($_POST['submit'])){
	if(isset($_POST['delete_main_passages']) || isset($_POST['delete_temp_passages'])){
	$mygroup = new Groups();
	$mygroup->connection = $myconnection;
		
	$mytempgroup = new Temp_groups();
   	$mytempgroup->connection = $myconnection;
	$mytempgroup->question_group_import_id =$_POST['txtimport_id'];
	$mygroup->question_group_import_id=$_POST['txtimport_id'];
	if($_POST['delete_temp_passages']){
	$chk=$mytempgroup->delete_by_import_id();
	if($chk==true){
		$RD_MSG_attempt_success="Groups Deleted";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: import_groups.php");
		exit();
	}else{
		$RD_MSG_attempt_failed="Groups Delete Failed";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: import_groups.php");
		exit();

	}
	}else if($_POST['delete_main_passages']){
	$chk=$mygroup->delete_by_import_id();
	if($chk==true){
		$RD_MSG_attempt_success="Groups Deleted";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location:". $_POST["h_return_url"]);
		exit();
	}else{
		$RD_MSG_attempt_failed=$mygroup->error_description;
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location:". $_POST["h_return_url"]);
		exit();

	}
	}
	}else{
		$RD_MSG_attempt_failed="Check Any options";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location:". $_POST["h_return_url"]);
		exit();

	}



}
?>
