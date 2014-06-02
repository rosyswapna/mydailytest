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

$mygroups_status_id = new QuestionStatuses($myconnection);
$mygroups_status_id->connection = $myconnection;
$mygroups_status_ids = $mygroups_status_id->get_array(); 

/////////////////

$mygroups = new Groups($myconnection);
$mygroups->connection = $myconnection;

$Mypagination = new Pagination(25);



//For Search
 if(isset($_GET["submit"])){	
 
 	if(trim($_GET['txtpassage_id']) != ""){
		$mygroups->id=$_GET['txtpassage_id'];
	} 
	if(trim($_GET['txtpassage']) != ""){
		$mygroups->passage=$_GET['txtpassage'];
	} 
	
	if($_GET['lstquestionstatuses']!=gINVALID){
		$mygroups->question_group_status_id=$_GET['lstquestionstatuses'];
	}
	
	if($_GET['lstdifficultylevel']!=gINVALID){
		$mygroups->difficulty_level_id=$_GET['lstdifficultylevel'];
	}
	if($_GET['lstsubject']!=gINVALID){
	$mygroups->subject_id=$_GET['lstsubject'];
	}
	if($_GET['lstsection']!=gINVALID){
	$mygroups->section_id=$_GET['lstsection'];
	}
	////
	if($_GET['lstexam']!=gINVALID){
		$mygroups->exam_id=$_GET['lstexam'];
	}
	
}


$data_bylimit = $mygroups->get_list_array_bylimit("",$Mypagination->start_record,$Mypagination->max_records);

if ( $data_bylimit == false ){
	$mesg = "No records found";
}else{
	$count_data_bylimit=count($data_bylimit);
	$Mypagination->total_records = $mygroups->total_records;
	$Mypagination->paginate();
}



?>
