<?php
class QuizDetail 
{
	var $connection;
    var $id = gINVALID;
    var $quiz_id = gINVALID;
    var $question_group = "";
    var $exam_id = "";
    var $subject_id = "";
    var $section_id = "";
    var $diffilulty_level_id = "";
    var $question_ids = "";
    var $number_of_questions = "";
    var $language_id = "";
    var $total_mark	= "";
    var $negative_mark = "";
    var $wrong_answer_count = "";
    var $cutoff = "";
    var $description = "";
    var $number_of_question_groups = "";

    var $quiz_total_questions = "";
    var $quiz_total_mark = "";
	
    
    var $error_number = "";
  	var $error_description = "";

    //for pagination
    var $total_records = "";




    function batch_update($dataArray=array())
    {
		//Function Delete all quizdetails of assigned quiz and insert from array
    	//delete if exists
    	$strSQL = "DELETE FROM quiz_details WHERE quiz_id='".$this->quiz_id."'";
        $result = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
        //insert new batch
    	$strSQL = "";$i=0;
		$strSQL .= "INSERT INTO quiz_details (quiz_id, exam_id,subject_id,section_id,language_id,difficulty_level_id,number_of_questions,total_mark,negative_mark,wrong_answer_count,description,question_ids,question_group,number_of_question_groups)";
		$strSQL .= " VALUES";
		while(count($dataArray) > $i)
		{
			$strSQL .= "('";
			$strSQL .= mysql_real_escape_string(trim($this->quiz_id))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['exam_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['subject_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['section_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['language_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['difficulty_level_id']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['number_of_questions']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['total_mark']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['negative_mark']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['wrong_answer_count']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['description']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['question_ids']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['question_group']))."','";
			$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['number_of_question_groups']))."'),";
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







    function get_quiz_details()
	{
		$strSQL = "SELECT QD.*,Q.organization_id FROM quiz_details QD
					JOIN quizzes Q ON Q.id = QD.quiz_id
					WHERE QD.quiz_id = '".$this->quiz_id."'
					ORDER BY QD.id ";
	    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
	    if ( mysql_num_rows($rsRES) > 0 )
	    {
	            $dataArray = array();$i=0;
	            while($row = mysql_fetch_assoc($rsRES))
	            {
                    $dataArray[$i]['id']                    = $row['id'];
                    $dataArray[$i]['quiz_id']               = $row['quiz_id'];
                    $dataArray[$i]['question_group']        = $row['question_group'];
	                $dataArray[$i]['exam_id']               = $row['exam_id'];
	                $dataArray[$i]['subject_id']         	= $row['subject_id'];
	                $dataArray[$i]['section_id']         	= $row['section_id'];
	                $dataArray[$i]['diffilulty_level_id'] 	= $row['difficulty_level_id'];
	                $dataArray[$i]['question_ids'] 			= $row['question_ids'];
	                $dataArray[$i]['number_of_questions'] 	= $row['number_of_questions'];
	                $dataArray[$i]['language_id']         	= $row['language_id'];
	                $dataArray[$i]['total_mark'] 			= $row['total_mark'];
	                $dataArray[$i]['negative_mark'] 		= $row['negative_mark'];
	                $dataArray[$i]['wrong_answer_count'] 	= $row['wrong_answer_count'];
	                $dataArray[$i]['cutoff'] 				= $row['cutoff'];
	                $dataArray[$i]['description'] 				= $row['description'];
	                $dataArray[$i]['number_of_question_groups'] = $row['number_of_question_groups'];
	                $dataArray[$i]['organization_id'] 		= $row['organization_id'];
	                $i++;
	        }
	        return $dataArray;
	    }
	    else{
	        return false;
	    }
	}




    function batch_validate_rule($dataArray=array())
    {
    	
		$return_error = true;
		$i=0;
		
		$failed_rules = array();
		while(count($dataArray) > $i)
		{
			
			$check_rule = $this->validate_rule($dataArray[$i]['question_group'],$dataArray[$i]['exam_id'], $dataArray[$i]['subject_id'], $dataArray[$i]['section_id'], $dataArray[$i]['language_id'], $dataArray[$i]['difficulty_level_id'], $dataArray[$i]['number_of_questions'],$dataArray[$i]['number_of_question_groups'] );

			if($check_rule == false ){
				$return_error = false;
				$failed_rules[$i]["exam_id"] = $dataArray[$i]['exam_id'];
				$failed_rules[$i]["subject_id"] = $dataArray[$i]['subject_id'];
				$failed_rules[$i]["section_id"] = $dataArray[$i]['section_id'];
				$failed_rules[$i]["language_id"] = $dataArray[$i]['language_id'];
				$failed_rules[$i]["difficulty_level_id"] = $dataArray[$i]['difficulty_level_id'];
				$failed_rules[$i]["number_of_questions"] = $dataArray[$i]['number_of_questions'];
				$failed_rules[$i]["number_of_question_groups"] = $dataArray[$i]['number_of_question_groups'];
			}else{
				// do noting
			}
			$i++;
		}
		
		if ( $return_error == false ) {
			$this->error_number = 3;
			$this->error_description="Rule Failed";
			return $failed_rules;
		}else{
		  return true;
		}
    	
    }


	function validate_rule($question_group=0, $exam_id=gINVALID, $subject_id=gINVALID, $section_id=gINVALID, $language_id=gINVALID, $difficulty_level_id=gINVALID, $number_of_questions=0, $number_of_question_groups=0  ){
			$strSQL = "";
			$total_questions = 0;
			if($question_group == 1){
				$table = "question_groups";
				$default_where = "question_group_status_id = '".STATUS_ACTIVE."'";
				$limit = $number_of_question_groups;
			}else{
				$table = "questions";
				$default_where = "question_status_id = '".STATUS_ACTIVE."'";
				$limit=$number_of_questions;
			}
			if(trim($number_of_questions) == "" || trim($number_of_questions) < 1){
				$number_of_questions=0;
			}
			$strSQL .= "SELECT * from ".$table." WHERE ".$default_where;
			$strSQL .= " AND exam_id = '".mysql_real_escape_string(trim($exam_id))."' ";

			if(trim($subject_id) != "" && trim($subject_id) != gINVALID){
				$strSQL .= " AND subject_id='". mysql_real_escape_string(trim($subject_id))."' ";
			}
			if(trim($section_id) != "" && trim($section_id) != gINVALID){
				$strSQL .= " AND section_id='".mysql_real_escape_string(trim($section_id))."' ";
			}
			if(trim($language_id) != "" && trim($language_id) != gINVALID){
				$strSQL .= " AND language_id='".mysql_real_escape_string(trim($language_id))."' ";
			}
			if(trim($difficulty_level_id) != "" && trim($difficulty_level_id) != gINVALID){
				$strSQL .= " AND difficulty_level_id ='".mysql_real_escape_string(trim($difficulty_level_id))."' ";
			}
			$strSQL .= " LIMIT 0,".mysql_real_escape_string(trim($limit));
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			
			$total_questions = mysql_num_rows($rsRES);

			//checking requested number of questions exist in database
			if($limit == $total_questions){
				return true;
			}else{
				return false;
			}

	}


	function get_real_quiz_question_count_and_mark(){
		$strSQL = "SELECT sum(number_of_questions) as total_questions, sum(total_mark) as total_mark FROM quiz_details  WHERE quiz_id = '".$this->quiz_id."'";
	    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
	    if(mysql_num_rows($rsRES) > 0){
			$this->quiz_total_questions = mysql_result($rsRES,0,'total_questions');
			$this->quiz_total_mark = mysql_result($rsRES,0,'total_mark');
			return true;
		}else{
			return false;
		}
	}




}
?>
