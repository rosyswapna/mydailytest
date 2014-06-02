<?php


////////// For DropDown//////
 
; 

$myquestion_status_id = new QuestionStatuses($myconnection);
$myquestion_status_id->connection = $myconnection;
$myreported_question_status_ids = $myquestion_status_id->get_array(); 

/////////////////

$myreportedquestion = new UserQuestionReporting($myconnection);
$myreportedquestion->connection = $myconnection;


//For Search
 if(isset($_GET["delid"])){	
 		
		$myreportedquestion->id=$_GET['delid'];
		 $myreportedquestion->to_inactive();
		header("Location:reported_questions.php");
		}






?>