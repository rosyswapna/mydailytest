<?php

$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$exams = $myexam->get_array(); 
 

$mysubject = new Subject($myconnection);
$mysubject->connection = $myconnection;
$subjects = $mysubject->get_array();


$mytempgroups = new Temp_groups($myconnection);
$mytempgroups->connection = $myconnection;

$Mypagination = new Pagination(300);

if ( isset($_GET['importid']) && $_GET['importid'] > 0 ){
      $mygroupimports = new Groups_import($myconnection);
 	$mygroupimports->connection = $myconnection;
	$mygroupimports->id=$_GET['importid'];
	$mygroupimports->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	$mygroupimports->get_detail();
	$mygroupimports->get_count_passages();

      $mytempgroups->question_group_import_id = $_GET['importid'];
      $mytempgroups->connection = $myconnection;
	  $mytempgroups->organization_id=$_SESSION[SESSION_TITLE.'userid'];
      $data_bylimit = $mytempgroups->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
if ( $data_bylimit == false ){
	$mesg = "No records found";
	}else{
	$count_data_bylimit=count($data_bylimit);
	$Mypagination->total_records = $mytempgroups->total_records;
	$Mypagination->paginate();
 }
}
 if(isset($_POST["update"])){
	$mytempgroups->question_group_import_id =$_POST['txtimport_id'];
	$mytempgroups->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	$data_bylimit = $mytempgroups->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
	$count_data_bylimit=count($data_bylimit);
	$verify= $_POST['verify'];
	$index=0;
	while($count_data_bylimit > $index){
$flag=0;
 if($data_bylimit[$index]['question_group_status_id']==STATUS_ACTIVE){
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
	 $mytempgroups->id=$id;
	$mytempgroups->question_group_status_id=STATUS_INACTIVE;
	$chk=$mytempgroups->update();
}

}else{
	echo $mytempgroups->id=$data_bylimit[$index]['id'];
	$mytempgroups->question_group_status_id=STATUS_INACTIVE;
	$chk=$mytempgroups->update();

}
}
$index++;
}

foreach ($verify as $key => $value)
{

	$mytempgroups->id=$value;
	$mytempgroups->question_group_status_id=STATUS_ACTIVE;
	$chk=$mytempgroups->update();

}	
if($chk==true){
		$RD_MSG_attempt_success="passage status updated";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "exports.php?importid=".$mytempgroups->question_group_import_id;
		header( "Location: export_groups.php?importid=".$mytempgroups->question_group_import_id);
		exit();
}else{
		$RD_MSG_attempt_failed="Questions Status Updation Failed";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: import_group.php");
		exit();
}	

}
	
 if(isset($_POST["submit"]))
	{
	$mytempgroups->question_group_import_id =$_POST['txtimport_id'];	
	$mytempgroups->passage=$_POST['txtpassage'];
	$mygroupimports = new Groups_import($myconnection);
 	$mygroupimports->connection = $myconnection;
	$mygroupimports->id=$_POST['txtimport_id'];
	$mytempgroups->question_group_import_id =$_POST['txtimport_id'];
	$mygroupimports->get_detail();
	$mygroupimports->get_count_passages();
	if($_POST['lstsubject']==-1){
		$mytempgroups->subject_id="";//condition check. if enters neagtive value,converts it into null
	}
	else{
	$mytempgroups->subject_id=$_POST['lstsubject'];
	}
	////
	if($_POST['lstexam']==-1){
		$mytempgroups->exam_id="";//condition check. if enters neagtive value,converts it into null
	}
	else{
	$mytempgroups->exam_id=$_POST['lstexam'];
	}
	$data_bylimit=$mytempgroups->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
	if( $data_bylimit == false ){
	$mesg = "No records found";
	}else{
	$count_data_bylimit=count($data_bylimit);
	$Mypagination->total_records = $mytempgroups->total_records;
	$Mypagination->paginate();
 	}
	}
	

?>
