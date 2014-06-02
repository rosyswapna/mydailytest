<?php

$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$exams = $myexam->get_array(); 
 

$mysubject = new Subject($myconnection);
$mysubject->connection = $myconnection;
$subjects = $mysubject->get_array();


$mytempquestion = new Temp_question($myconnection);
$mytempquestion->connection = $myconnection;

$Mypagination = new Pagination(300);

if ( isset($_GET['importid']) && $_GET['importid'] > 0 ){
      $myquestionimports = new Question_import($myconnection);
 	$myquestionimports->connection = $myconnection;
	$myquestionimports->id=$_GET['importid'];
	$myquestionimports->get_detail();
	$myquestionimports->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	$myquestionimports->get_count_questions();

      $mytempquestion->question_import_id = $_GET['importid'];
      $mytempquestion->connection = $myconnection;
		$mytempquestion->organization_id=$_SESSION[SESSION_TITLE.'userid'];
      $data_bylimit = $mytempquestion->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
if ( $data_bylimit == false ){
	$mesg = "No records found";
	}else{
	$count_data_bylimit=count($data_bylimit);
	$Mypagination->total_records = $mytempquestion->total_records;
	$Mypagination->paginate();
 }
}
 if(isset($_POST["update"])){
	$mytempquestion->question_import_id =$_POST['txtimport_id'];
	$mytempquestion->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	$data_bylimit = $mytempquestion->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
	$count_data_bylimit=count($data_bylimit);
	$verify= $_POST['verify'];
	$index=0;
	while($count_data_bylimit > $index){
$flag=0;
 if($data_bylimit[$index]['question_status_id']==QUESTION_STATUS_ACTIVE){
	if(isset($_POST['verify'])){
foreach ($verify as $key => $value)
{ 
	if($data_bylimit[$index]['id']==$value){
	$flag++;
	
	}else{
	$id=$data_bylimit[$index]['id'];
	}
}
if($flag==0){
	 $mytempquestion->id=$id;
	$mytempquestion->question_status_id=QUESTION_STATUS_INACTIVE;
	$chk=$mytempquestion->update();
}

}else{
	echo $mytempquestion->id=$data_bylimit[$index]['id'];
	$mytempquestion->question_status_id=QUESTION_STATUS_INACTIVE;
	$chk=$mytempquestion->update();

}
}
$index++;
}

foreach ($verify as $key => $value)
{

	$mytempquestion->id=$value;
	$mytempquestion->question_status_id=QUESTION_STATUS_ACTIVE;
	$chk=$mytempquestion->update();

}	
if($chk==true){
		$RD_MSG_attempt_success="Question Status Updated";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "exports.php?importid=".$mytempquestion->question_import_id;
		header( "Location: exports.php?importid=".$mytempquestion->question_import_id);
		exit();
}else{
		$RD_MSG_attempt_failed="Questions Status Updation Failed";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: imports.php");
		exit();
}	

}
	
 if(isset($_POST["submit"]))
	{
	$mytempquestion->question_import_id =$_POST['txtimport_id'];	
	$mytempquestion->question=$_POST['txtquestions'];
	$myquestionimports = new Question_import($myconnection);
 	$myquestionimports->connection = $myconnection;
	$myquestionimports->id=$_POST['txtimport_id'];
	$mytempquestion->question_import_id =$_POST['txtimport_id'];
	$myquestionimports->get_detail();
	$myquestionimports->get_count_questions();
	if($_POST['lstsubject']==-1){
		$mytempquestion->subject_id="";//condition check. if enters neagtive value,converts it into null
	}
	else{
	$mytempquestion->subject_id=$_POST['lstsubject'];
	}
	////
	if($_POST['lstexam']==-1){
		$mytempquestion->exam_id="";//condition check. if enters neagtive value,converts it into null
	}
	else{
	$mytempquestion->exam_id=$_POST['lstexam'];
	}
	$data_bylimit=$mytempquestion->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
	if( $data_bylimit == false ){
	$mesg = "No records found";
	}else{
	$count_data_bylimit=count($data_bylimit);
	$Mypagination->total_records = $mytempquestion->total_records;
	$Mypagination->paginate();
 	}
	}
	

?>
