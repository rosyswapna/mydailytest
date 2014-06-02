<?php


////////// For DropDown//////
 
; 

$myquestion_status_id = new QuestionStatuses($myconnection);
$myquestion_status_id->connection = $myconnection;
$myreported_question_status_ids = $myquestion_status_id->get_array(); 

/////////////////

$myreportedquestion = new UserQuestionReporting($myconnection);
$myreportedquestion->connection = $myconnection;

$Mypagination = new Pagination(25);
$myreportedquestion->status_id="";
$myreportedquestion->id="";
//For Search
 if(isset($_GET["submit"])){	
 
 	if(trim($_GET['txtreportedquestion_id']) != ""){
		$myreportedquestion->id=$_GET['txtreportedquestion_id'];
	} 
	
	
	if($_GET['lstreportedquestionstatuses']!=gINVALID){
		$myreportedquestion->status_id=$_GET['lstreportedquestionstatuses'];
	}else{
	$myreportedquestion->status_id="";
	}
	
}


$data_bylimit = $myreportedquestion->get_list_reported_questions($Mypagination->start_record,$Mypagination->max_records);

if ( $data_bylimit == false ){
	$mesg = "No records found";
}else{
	$count_data_bylimit=count($data_bylimit);
	$Mypagination->total_records = $myreportedquestion->total_records;
	$Mypagination->paginate();
}



?>