<?php


////////// For DropDown//////
$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$exams=$myexam->get_array(); 

$mydifficultylevel = new DifficultyLevel($myconnection);
$mydifficultylevel->connection = $myconnection;
$difficulty_levels=$mydifficultylevel->get_array(); 

$mysubject = new Subject($myconnection);
$mysubject->connection = $myconnection;
$subjects = $mysubject->get_array(); 

$mysection = new Section($myconnection);
$mysection->connection = $myconnection;
$sections = $mysection->get_array(); 

$myquestion_status_id = new QuestionStatuses($myconnection);
$myquestion_status_id->connection = $myconnection;
$myquestion_status_ids = $myquestion_status_id->get_array(); 

/////////////////

$myquestion = new Question($myconnection);
$myquestion->connection = $myconnection;

$Mypagination = new Pagination(25);



//For Search
 if(isset($_GET["submit"])){	
 
 	if(trim($_GET['txtquestion_id']) != ""){
		$myquestion->id=$_GET['txtquestion_id'];
	} 
	if(trim($_GET['txtquestions']) != ""){
		$myquestion->question=$_GET['txtquestions'];
	} 
	
	if($_GET['lstquestionstatuses']!=gINVALID){
		$myquestion->question_status_id=$_GET['lstquestionstatuses'];
	}
	
	if($_GET['lstdifficultylevel']!=gINVALID){
		$myquestion->difficulty_level_id=$_GET['lstdifficultylevel'];
	}
	if($_GET['lstsubject']!=gINVALID){
	$myquestion->subject_id=$_GET['lstsubject'];
	}
	if($_GET['lstsection']!=gINVALID){
	$myquestion->section_id=$_GET['lstsection'];
	}
	////
	if($_GET['lstexam']!=gINVALID){
		$myquestion->exam_id=$_GET['lstexam'];
	}
	if($_GET['lstshare']!=gINVALID){
		$myquestion->share=$_GET['lstshare'];
	}
}


$data_bylimit = $myquestion->get_list_array_bylimit("",$Mypagination->start_record,$Mypagination->max_records);

if ( $data_bylimit == false ){
	$mesg = "No records found";
}else{
	$count_data_bylimit=count($data_bylimit);
	$Mypagination->total_records = $myquestion->total_records;
	$Mypagination->paginate();
}



?>