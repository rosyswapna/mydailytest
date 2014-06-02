<?php

// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class DemoTestReport
{
	var $connection = "";
	var $id = gINVALID;
	var $demo_id = gINVALID;
	var $quiz_id = gINVALID;
	var $question_id = gINVALID;
	var $test_status_id = gINVALID;
	var $test_date = "";
	var $start_time = "";
	var $end_time = "";
	var $resumed_time = "";
	var $used_time = "";
	var $total_time = "";
	var $remaining_time = "";
	//////////////////////////////
	var $attempted = "";
	var $correct = "";
	var $wrong_answer = "";
	var $user_test_id = "";
	

	
	var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";
	
	
	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////	
function get_subject_reports($quiz_id=gINVALID){
	   
	$strSQL =  "SELECT id FROM demo_tests WHERE quiz_id= '".$quiz_id."'";
	$rsRES_quiz = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
	 $count_quizzes = mysql_num_rows($rsRES_quiz);
	
	$strcondition ="";
		if ($quiz_id > 0){
			$strcondition= "DT.quiz_id='".$quiz_id."'"; 
		} 
		
		
		if (trim($strcondition) != "") {
		 $strcondition = " AND ".$strcondition;
		}else{
         // Do Nothing
        } 
	
			
		$strSQL =  "SELECT Q.subject_id, DTD.demo_test_id,  S.name,D.id, COUNT( CASE WHEN DTD.user_keys <> '-1' THEN 1 END ) AS attempted, COUNT( 
					CASE WHEN DTD.user_keys = DTD.answer_keys
					THEN 1 
					END ) AS correct, COUNT( * ) AS total
					FROM questions Q, demo_test_details DTD, demo_tests DT, subjects S, users U
					WHERE DT.demo_id =U.id
					AND DTD.demo_test_id = DT.id
					AND DTD.question_id = Q.id
					AND Q.subject_id = S.id ".$strcondition." GROUP BY Q.subject_id";
					
		//print_r($strSQL);
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		$data= array();$i=0;
			if(mysql_num_rows($rsRES) > 0){
			$report = array();
				$i=0;
				while($row = mysql_fetch_assoc($rsRES)){
						$report[$i]["name"]    = $row['name'];
				if($row['total'] > 0 ){	
					$report[$i]["total_questions"]  = $row['total']/$count_quizzes;
				}else{
					$report[$i]["total_questions"]  = $row['total'];	
				}							
				if($row['attempted'] > 0 ){	
					$report[$i]["avg_attempted"]  = $row['attempted']/$count_quizzes;
				}else{
					$report[$i]["avg_attempted"]  = $row['attempted'];
				}
				
				if($row['correct'] > 0 ){	
					$report[$i]["avg_correct"]  = $row['correct']/$count_quizzes;
				}else{
					$report[$i]["avg_correct"]  = $row['correct'];
				}	
				

				
										
				$report[$i]["total_attempted"]  = $row['attempted'];
				$report[$i]["total_correct"]  = $row['correct'];

				$report[$i]["count_quizzes"]  = $count_quizzes;
			
				$i++;
      }
	 
	 return $report;
	 
	// print_r($report);  exit();
	 
		}
		else
		{ 
			return false;
		}
	}	
	
	
	
	
	
}
?>
