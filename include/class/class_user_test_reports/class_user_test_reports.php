<?php

// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserTestReport
{
	var $connection = "";
	var $id = gINVALID;
	var $user_id = gINVALID;
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
	
	
	
	function get_report()
	{
		$strSQL = "SELECT COUNT(CASE WHEN user_keys <> -1 THEN 1 END ) as attempted,  
					COUNT(CASE WHEN user_keys = answer_keys THEN 1 END )  as correct ,
					COUNT(*) as total FROM user_test_details";
		
		$strSQL .= " WHERE user_test_id = '".$this->id."'";
		
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		$data= array();$i=0;
		if(mysql_num_rows($rsRES) > 0)
		{ 
			$row = mysql_fetch_assoc($rsRES); 
			$this->attempted 				= $row['attempted'];
			$this->correct_ans 				= $row['correct'];
			$this->total_questions 			= $row['total'];
	
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	function get_reports($quiz_id=gINVALID,$user_id=gINVALID,$user_test_id=gINVALID){
	    $strcondition ="";
		if ($quiz_id > 0){
			$strcondition= "UT.quiz_id='".$quiz_id."'"; 
		} 
		if ($user_id > 0){ 
			if (trim($strcondition)== ""){
				$strcondition= "UT.user_id='".$user_id."'";
			}else{
				$strcondition.= " AND UT.user_id='".$user_id."'";
			}
			
		}
	
		
		if ($user_test_id > 0){ 
			if (trim($strcondition)== ""){
				$strcondition= "UTD.user_test_id='".$user_test_id."'";
			}else{
				$strcondition.= " AND UTD.user_test_id='".$user_test_id."'";
			}
			
		}
		
		if (trim($strcondition) != "") {
			
		 $strcondition = " AND ".$strcondition;
		}else{
         // Do Nothing
        } 
		
		
		$strSQL =  "SELECT UT.user_id, UT.quiz_id, COUNT(CASE WHEN UTD.user_keys <> -1 THEN 1 END ) as attempted,  
					COUNT(CASE WHEN UTD.user_keys = UTD.answer_keys THEN 1 END )  as correct ,
					COUNT(*) as total FROM user_test_details UTD, user_tests UT WHERE UTD.user_test_id= UT.id ".$strcondition." GROUP BY UTD.user_test_id";
					
		//echo $strSQL."<br>";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		$data= array();$i=0;
			if(mysql_num_rows($rsRES) > 0){
			$report = array();
				$i=0;
				while($row = mysql_fetch_assoc($rsRES)){
				$report[$i]["attempted"]  = $row['attempted'];
				$report[$i]["correct"]    = $row['correct'];
				$report[$i]["total"]      = $row['total'];
				$report[$i]["user_id"]    = $row['user_id'];
				$report[$i]["quiz_id"]    = $row['quiz_id'];
				$i++;
      }
	 return $report;
	 // print_r($report); 
	 
		}
		else
		{ 
			return false;
		}
	}
	
/////////////////////////////////////////////////////////////////////////////////////////////////	
function get_subject_reports($quiz_id=gINVALID){
	   
	$strSQL =  "SELECT id FROM user_tests WHERE quiz_id= '".$quiz_id."'";
	$rsRES_quiz = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
	 $count_quizzes = mysql_num_rows($rsRES_quiz);
	
	$strcondition ="";
		if ($quiz_id > 0){
			$strcondition= "UT.quiz_id='".$quiz_id."'"; 
		} 
		
		
		if (trim($strcondition) != "") {
		 $strcondition = " AND ".$strcondition;
		}else{
         // Do Nothing
        }  
	
			
		$strSQL =  "SELECT Q.subject_id, UTD.user_test_id,  S.name,U.id, COUNT( CASE WHEN UTD.user_keys <> '-1' THEN 1 END ) AS attempted,
		COUNT( 
					CASE WHEN UTD.user_keys  <> UTD.answer_keys AND UTD.user_keys <> -1
					THEN 1 
					END ) AS wrong,
					
		
		 COUNT( 
					CASE WHEN UTD.user_keys = UTD.answer_keys
					THEN 1 
					END ) AS correct, COUNT( * ) AS total
					FROM questions Q, user_test_details UTD, user_tests UT, subjects S, users U
					WHERE UT.user_id =U.id
					AND UTD.user_test_id = UT.id
					AND UTD.question_id = Q.id
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
				if($row['wrong'] > 0 ){	
					$report[$i]["avg_wrong"]  = $row['wrong']/$count_quizzes;
				}else{
					$report[$i]["avg_wrong"]  = $row['wrong'];
				}					
				

				
										
				$report[$i]["total_attempted"]  = $row['attempted'];
				$report[$i]["total_correct"]  = $row['correct'];
				$report[$i]["total_wrong"]  = $row['wrong'];
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
	
	




function new_get_subject_reports($user_test_id=gINVALID){
	$report = array();
	$strSQL =  "SELECT SWR.*, S.name as subject_name FROM user_test_report_subject_wise SWR, subjects S WHERE SWR.subject_id=S.id AND SWR.user_test_id ='".$user_test_id."'";
	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);

	if(mysql_num_rows($rsRES) > 0){
		$i=0;
		while($row = mysql_fetch_assoc($rsRES)){
		$report[$i]["name"] = $row['subject_name'];
		$report[$i]["number_of_questions"] = $row['number_of_questions'];
		$report[$i]["attempted"] = $row['attempted'];
		$report[$i]["correct_answers"] = $row['correct_answers'];
		$report[$i]["wrong_answers"] = $row['attempted'] - $row['correct_answers'];
		$report[$i]["user_mark"] = $row['user_mark'];
		$i++;
		}
 		return $report;
	}else{
		return false;
	}

}


function new_get_all_reports($user_test_id=gINVALID){
	$report = array();
	$strSQL =  "SELECT SWR.*, S.name as subject_name FROM user_test_report_subject_wise SWR, subjects S WHERE SWR.subject_id=S.id AND SWR.user_test_id ='".$user_test_id."'";
	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);

	if(mysql_num_rows($rsRES) > 0){

		$number_of_questions = 0;
		$attempted = 0;
		$correct_answers = 0;
		$wrong_answers = 0;
		$user_mark = 0;

		while($row = mysql_fetch_assoc($rsRES)){
			$number_of_questions = $number_of_questions + $row['number_of_questions'];
			$attempted = $attempted + $row['attempted'];
			$correct_answers = $correct_answers + $row['correct_answers'];
			$user_mark = $user_mark + $row['user_mark'];
		}
	
		$report["number_of_questions"] = $number_of_questions;
		$report["attempted"] = $attempted;
		$report["correct_answers"] =  $correct_answers;
		$report["user_mark"] =  $user_mark;
		$report["wrong_answers"] = $attempted - $correct_answers;

 		return $report;
	}else{
		return false;
	}

}
	
	
	
}
?>
