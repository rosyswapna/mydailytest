<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$myquestionimports = new Question_import($myconnection);
 	$myquestionimports->connection = $myconnection;

 	$mytempquestion = new Temp_question();
   	 $mytempquestion->connection = $myconnection;

if(isset($_GET['importid'])){
$question_import_id ="";
$question_import_id = $_GET['importid'];

$myquestionimports->id= $question_import_id;
$myquestionimports->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	 $myquestionimports->get_count_questions();
	$myquestionimports->get_detail();
	$myquestion = new Question();
	$myquestion->connection = $myconnection;
	$myquestion->question_import_id=$question_import_id;
	$myquestion->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	$myquestion->get_count_questions();

}

    //check user exist or not
    
if(isset($_POST['submit'])){
	if(isset($_POST['delete_main_questions']) || isset($_POST['delete_temp_questions'])){
	$myquestion = new Question();
	$myquestion->connection = $myconnection;
		
	$mytempquestion = new Temp_question();
   	$mytempquestion->connection = $myconnection;
	$mytempquestion->question_import_id =$_POST['txtimport_id'];
	$myquestion->question_import_id=$_POST['txtimport_id'];
	if($_POST['delete_temp_questions']){
	$chk=$mytempquestion->delete_by_import_id();
	if($chk==true){
		$RD_MSG_attempt_success="Questions Deleted";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: imports.php");
		exit();
	}else{
		$RD_MSG_attempt_failed="Questions Delete Failed";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: imports.php");
		exit();

	}
	}else if($_POST['delete_main_questions']){
	$chk=$myquestion->delete_by_import_id();
	if($chk==true){
		$RD_MSG_attempt_success="Questions Deleted";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location:". $_POST["h_return_url"]);
		exit();
	}else{
		$RD_MSG_attempt_failed=$myquestion->error_description;
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
