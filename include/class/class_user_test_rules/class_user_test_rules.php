<?php

// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserTestRules
{
	var $connection = "";
	var $id = gINVALID;
	var $user_test_id = "";
	var $quiz_id = "";
	var $quiz_detail_id = "";
	var $question_group = "";
	var $exam_id = "";
    var $subject_id = "";
    var $section_id = "";
    var $language_id = "";
    var $diffilulty_level_id = "";
    var $question_ids = "";
    var $number_of_questions = "";
    var $total_mark	= "";
    var $negative_mark = "";
    var $wrong_answer_count = "";
    var $cutoff = "";
    var $user_mark = "";
    var $result_status_id = "";
    var $attempted = "";
    var $correct_answers = "";

	var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";
    var $update_count = "";

    function insert_batch($dataArray=array())
    {//print_r($dataArray);
		
		$strSQL = "INSERT INTO user_test_rules (user_test_id,quiz_id,quiz_detail_id,question_group, exam_id,subject_id,section_id,difficulty_level_id,question_ids,number_of_questions,language_id,total_mark,negative_mark,wrong_answer_count,cutoff)";
		$strSQL .= " VALUES";
		$i=0;
		while(count($dataArray) > $i)
		{
			$strSQL .= "('";
			$strSQL .= mysql_real_escape_string(trim($this->user_test_id))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['quiz_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['question_group']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['exam_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['subject_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['section_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['diffilulty_level_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['question_ids']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['number_of_questions']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['language_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['total_mark']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['negative_mark']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['wrong_answer_count']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['cutoff']))."'),";
			$i++;
		}
		$strSQL =substr($strSQL,0,-1);//echo $strSQL;exit();
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		if ( mysql_affected_rows($this->connection) > 0 ) {
		  $this->total_records = mysql_affected_rows($this->connection);
		  return true;
		}else{
		  $this->error_number = 3;
		  $this->error_description="Can't insert data";
		  return false;
		}
    	
    }


    //calculate usermark on finish test
    function calculate_user_mark_for_each_rule()
    {
    	$strSQL = "SELECT UTR.id,UTR.quiz_detail_id,UTR.total_mark,UTR.negative_mark,UTR.wrong_answer_count,COUNT(CASE WHEN UTD.user_keys = UTD.answer_keys THEN 1 END)  as correct,COUNT(CASE WHEN UTD.user_keys <> '-1'	THEN 1 END ) AS attempted,COUNT( * ) AS total_questions";
		$strSQL .= " FROM user_test_rules UTR";
		$strSQL .= " LEFT JOIN user_test_details UTD ON UTD.user_test_id=UTR.user_test_id";		
		$strSQL .= " WHERE UTR.user_test_id ='".trim($this->user_test_id)."' AND UTR.quiz_detail_id =UTD.quiz_detail_id";
		$strSQL .= " GROUP BY UTR.quiz_detail_id";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		if(mysql_num_rows($rsRES) > 0)
		{
			$dataArray=array();$i=0;
			while($row = mysql_fetch_assoc($rsRES))
			{
				$total_mark = $row['total_mark'];
				$negative_mark = $row['negative_mark'];
				$wrong_answer_count=$row['wrong_answer_count'];//count of wrong answer for one negative mark 
				$count_right_answers = $row['correct'];//total count for right anwers
				$count_attempted = $row['attempted']; //total count attempted questions
				$count_total = $row['total_questions'];
				if($count_attempted > 0)
				{
					$count_wrong_answers = $count_attempted - $count_right_answers; //total wrong answers
					$mark_for_each_right_answer = $total_mark/$count_total;
					$count_wrong_answers = $count_attempted - $count_right_answers;
					$total_marks_for_right_answer = $count_right_answers*$mark_for_each_right_answer;
					if($wrong_answer_count > 0)//negative mark included
					{
						if($count_wrong_answers >= $wrong_answer_count){
							$total_negative_marks= (floor($count_wrong_answers / $wrong_answer_count))*$negative_mark;
						}else{
							$total_negative_marks = 0;
						}
						$total_user_mark = $total_marks_for_right_answer - $total_negative_marks;
					}else{ //no negative mark
						$total_user_mark = $total_marks_for_right_answer;
					}	
					
				}else{
					$total_user_mark = 0;
					$count_wrong_answers = 0;
				}
				$dataArray[$i]['id']=  $row['id'];
				$dataArray[$i]['attempted']=  $count_attempted;
				$dataArray[$i]['correct_answers']=  $count_right_answers;
				$dataArray[$i]['total_mark']=  $total_mark;
				$dataArray[$i]['number_of_questions']=  $count_total;
				$dataArray[$i]['user_mark']=  $total_user_mark;

				$i++;
			}

			return $dataArray;
		}
		else
		{
			return false;
		}
    }


    //get rule details
    function get_test_mark_for_each_rule()
    {
    	$strSQL = "SELECT UTR.quiz_detail_id,UTR.total_mark,UTR.user_mark,UTR.number_of_questions ,EX.name as exam,SB.name as subject,SC.name as section,DF.name as difficulty_level,LG.name as language,COUNT(CASE WHEN UTD.user_keys = UTD.answer_keys THEN 1 END)  as correct";
		$strSQL .= " FROM user_test_rules UTR";
		$strSQL .= " LEFT JOIN user_test_details UTD ON UTD.user_test_id=UTR.user_test_id";
		$strSQL .= " LEFT JOIN exams EX ON EX.id=UTR.exam_id";
		$strSQL .= " LEFT JOIN subjects SB ON SB.id=UTR.subject_id";
		$strSQL .= " LEFT JOIN sections SC ON SC.id=UTR.section_id";
		$strSQL .= " LEFT JOIN difficulty_levels DF ON DF.id=UTR.difficulty_level_id";
		$strSQL .= " LEFT JOIN languages LG ON LG.id=UTR.language_id";
		$strSQL .= " WHERE UTR.user_test_id ='".trim($this->user_test_id)."' AND UTR.quiz_detail_id =UTD.quiz_detail_id";
		$strSQL .= " GROUP BY UTR.quiz_detail_id";
		//echo $strSQL;exit();
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		if(mysql_num_rows($rsRES) > 0)
		{
			$dataArray=array();$i=0;
			while($row = mysql_fetch_assoc($rsRES))
			{
				$dataArray[$i]['quiz_detail_id']	= $row['quiz_detail_id'];
				$dataArray[$i]['total_count']		= $row['number_of_questions'];
				$dataArray[$i]['total_mark']		= $row['total_mark'];
				$dataArray[$i]['total_user_mark']	= $row['user_mark'];
				$dataArray[$i]['exam'] 				= $row['exam'];
				$dataArray[$i]['subject'] 			= $row['subject'];
				$dataArray[$i]['section'] 			= $row['section'];
				$dataArray[$i]['difficulty_level'] 	= $row['difficulty_level'];
				$dataArray[$i]['language'] 			= $row['language'];
				$dataArray[$i]['correct'] 			= $row['correct'];
				$i++;
			}

			return $dataArray;
		}
		else
		{
			return false;
		}
    }


    //update user mark on finish
    function update_batch($dataArray= array())
    {
    	if(count($dataArray) > 0 and $this->user_test_id > 0)
    	{
    		$strSQL = "UPDATE user_test_rules SET user_mark = CASE id";
    		$id_list = "";$i=0;
    		$strSQL_user_mark = "";
    		$strSQL_attempted = "";
    		$strSQL_correct = "";
    		while(count($dataArray) > $i)
    		{
    			$strSQL_user_mark .=" WHEN '".mysql_real_escape_string(trim($dataArray[$i]['id']))."' THEN '".mysql_real_escape_string(trim($dataArray[$i]['user_mark']))."'";
    			$strSQL_attempted .=" WHEN '".mysql_real_escape_string(trim($dataArray[$i]['id']))."' THEN '".mysql_real_escape_string(trim($dataArray[$i]['attempted']))."'";
    			$strSQL_correct .=" WHEN '".mysql_real_escape_string(trim($dataArray[$i]['id']))."' THEN '".mysql_real_escape_string(trim($dataArray[$i]['correct_answers']))."'";
				$id_list .= "'".$dataArray[$i]['id']."',";
				$i++;
    		}
    		$strSQL .= $strSQL_user_mark." END, attempted = CASE id".$strSQL_attempted." END, correct_answers = CASE id".$strSQL_correct." END WHERE user_test_id =  '".$this->user_test_id."'";
    		//echo $strSQL;exit();
    		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->update_count = mysql_affected_rows($this->connection);
				return true;
			}
			else{
				return false;
			}
    	}
    	else
    	{
    		return false;
    	}
    }


    function get_list_array_with_user_test_id($user_test_id)
    {
    	$strSQL = "SELECT * FROM user_test_rules WHERE user_test_id = '".$user_test_id."'";
    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
    	if(mysql_num_rows($rsRES) > 0)
    	{
    		$dataArray = array();$i=0;
    		while($row = mysql_fetch_assoc($rsRES))
    		{
    			$dataArray[$i]['id'] 					= $row['id'];
    			$dataArray[$i]['user_test_id'] 			= $row['user_test_id'];
    			$dataArray[$i]['quiz_id'] 				= $row['quiz_id'];
    			$dataArray[$i]['quiz_detail_id'] 		= $row['quiz_detail_id'];
    			$dataArray[$i]['question_group'] 		= $row['question_group'];
    			$dataArray[$i]['exam_id'] 				= $row['exam_id'];
    			$dataArray[$i]['subject_id'] 			= $row['subject_id'];
    			$dataArray[$i]['section_id'] 			= $row['section_id'];
    			$dataArray[$i]['difficulty_level_id'] 	= $row['difficulty_level_id'];
    			$dataArray[$i]['question_ids'] 			= $row['question_ids'];
    			$dataArray[$i]['number_of_questions'] 	= $row['number_of_questions'];
    			$dataArray[$i]['language_id'] 			= $row['language_id'];
    			$dataArray[$i]['total_mark'] 			= $row['total_mark'];
    			$dataArray[$i]['negative_mark'] 		= $row['negative_mark'];
    			$dataArray[$i]['wrong_answer_count'] 	= $row['wrong_answer_count'];
    			$dataArray[$i]['cutoff'] 				= $row['cutoff'];
    			$dataArray[$i]['user_mark'] 			= $row['user_mark'];
    			$dataArray[$i]['result_status_id'] 		= $row['result_status_id'];
    			$dataArray[$i]['attempted'] 			= $row['attempted'];
    			$dataArray[$i]['correct_answers'] 		= $row['correct_answers'];
    			$i++;
    		}
    		return $dataArray;
    	}
    	else
    	{
    		$this->error_description = "No records found";
    		return false;
    	}
    }




}
?>