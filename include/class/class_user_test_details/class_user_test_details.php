<?php

class UserTestDetails
{
	var $id = gINVALID;
	var $user_test_id = gINVALID;
	var $question_id = "";
	var $flag = "";
	var $user_keys = "";
	var $answer_keys = "";
	var $slno ="";
	var $quiz_detail_id ="";
	var $question_group_id = gINVALID;

	var $total_records ="";
	var $total_questions = "";

	var $exam_id ="";
	var $subject_id = "";
	var $section_id ="";
	var $language_id = "";
	var $difficulty_level_id = "";
	var $number_of_questions = "";

	var $quiz_details = false;

	var $user_keys_batch = array();
	
	function insert_test_details($dataArray=array())
	{
		$strSQL = "";$i=0;$slno = 0;
		$strSQL .= "INSERT INTO user_test_details(user_test_id,question_id,flag,user_keys,answer_keys,slno,quiz_detail_id,question_group_id)";
		$strSQL .= " VALUES";
		$question_group_id = "";
		while(count($dataArray) > $i)
		{
			//if($question_group_id != $dataArray[$i]['question_group_id'] || $dataArray[$i]['question_group_id'] == gINVALID){
				//$question_group_id = $dataArray[$i]['question_group_id'];
				$slno++;
			//}

			$strSQL .= "('".mysql_real_escape_string(trim($this->user_test_id))."','".mysql_real_escape_string(trim($dataArray[$i]['question_id']))."',0,-1,'".mysql_real_escape_string(trim($dataArray[$i]['answer_keys']))."','".$slno."','".mysql_real_escape_string(trim($dataArray[$i]['quiz_detail_id']))."','".mysql_real_escape_string(trim($dataArray[$i]['question_group_id']))."'),";
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


	//update batch of userkeys
	function update_userkeys_batch()
	{
		$strSQL = "";$i=0;$dataArray = $this->user_keys_batch;
		$strSQL .= "UPDATE user_test_details";
		$strSQL .= " SET user_keys = CASE id";
		$id_list="";
		if(count($dataArray)>0)
		{
			foreach($dataArray as $key=>$value)
			{
				$strSQL .=" WHEN '".mysql_real_escape_string(trim($key))."' THEN '".mysql_real_escape_string(trim($value))."'";
				$id_list .= "'".$key."',";
				$i++;
			}
			$strSQL .= " END WHERE id IN(".substr($id_list,0,-1).")";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			//echo $strSQL;exit();
			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->update_count = mysql_affected_rows($this->connection);
				return true;
			}
			else{
				return false;
			}
		}
	}

	//update user keys
	function update_userkeys()
	{
		$strSQL .= "UPDATE user_test_details SET user_keys = '".mysql_real_escape_string(trim($this->user_keys))."' WHERE id= '".mysql_real_escape_string(trim($this->id))."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		if ( mysql_affected_rows($this->connection) > 0 ) {
			return true;
		}
		else{
			return false;
		}
	}

	//update flag
	function update_flag()
	{
		$strSQL .= "UPDATE user_test_details SET flag = '".mysql_real_escape_string(trim($this->flag))."' WHERE id= '".mysql_real_escape_string(trim($this->id))."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		if ( mysql_affected_rows($this->connection) > 0 ) {
			return true;
		}
		else{
			return false;
		}
	}



	function exist()
	{
		$strSQL = "SELECT COUNT(*) AS num FROM user_test_details WHERE user_test_id = '".$this->user_test_id."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		$row = mysql_fetch_assoc($rsRES);
		$this->total_records = $row['num'];
		if($this->total_records > 0)
			return true;
		else
			return false;
	}


	//generate question- answer keys array for sample test
	function get_quesion_answerkey($question_ids)
	{
		$strSQL = "SELECT Q.id,Q.options,Q.answers
					FROM questions Q
					WHERE Q.id IN (".$question_ids.")";
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		$data= array();$i=0;
		if(mysql_num_rows($rsRES) > 0)
		{
			while($row = mysql_fetch_assoc($rsRES))
			{
				$options = $row['options'];
				$keys_list = explode(DEFAULT_OPTION_DELIMITER,$options);
				$keys = array_search(trim($row['answers']),$keys_list);
				$data[$i]['question_id']=$row['id'];
				$data[$i]['answer_keys']=$keys;
				$i++;
			}
			return $data;
		}
		else
		{
			return false;
		}
	}


	

	function generate_rule_questionids($dataArray = array())
	{
		
		if(count($dataArray) > 0){
			$i=0;

			$strSQL_start = "SELECT questions.id FROM questions";
			$strSQL_where   = " WHERE question_status_id = '".STATUS_ACTIVE."'";
			$strSQL_rule = "";

			if($dataArray[$i]['exam_id'] > 0){
				$strSQL_rule .= " AND exam_id = '".$dataArray[$i]['exam_id']."'";
			}
			if($dataArray[$i]['subject_id'] > 0){
				$strSQL_rule .= " AND subject_id = '".$dataArray[$i]['subject_id']."'";
			}
			if($dataArray[$i]['section_id'] > 0){
				$strSQL_rule .= " AND section_id = '".$dataArray[$i]['section_id']."'";
			}
			if($dataArray[$i]['language_id'] > 0){
				$strSQL_rule .= " AND language_id = '".$dataArray[$i]['language_id']."'";
			}
			if($dataArray[$i]['diffilulty_level_id'] > 0){
				$strSQL_rule .= " AND difficulty_level_id = '".$dataArray[$i]['diffilulty_level_id']."'";
			}
			$strSQL_end = " ORDER BY RAND() LIMIT ".$dataArray[$i]['number_of_questions'];
			

			if($dataArray[$i]['question_group'] == QUESTION_GROUP_TRUE){
				$strSQL_join = " INNER JOIN (SELECT * FROM question_groups WHERE question_group_status_id = '".STATUS_ACTIVE."'";
				if($strSQL_rule != ""){
					$strSQL_join .= $strSQL_rule;
				}
				$strSQL_join .= $strSQL_end.") as QG ON QG.id = questions.question_group_id";
				$strSQL = $strSQL_start.$strSQL_join;

			}elseif($dataArray[$i]['question_group'] == QUESTION_GROUP_FALSE){
				$strSQL = $strSQL_start.$strSQL_where;
				if($strSQL_rule != ""){
					$strSQL = $strSQL.$strSQL_rule;
				}
				$strSQL = $strSQL.$strSQL_end;
			}


			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$question_ids_string = "";
				while($row = mysql_fetch_assoc($rsRES)){
					$question_ids_string .= $row['id'].",";
				}
				$question_ids_string = substr($question_ids_string,0,-1);
				$this->question_ids = $question_ids_string;
				return true;
			}else{
				$this->question_ids = "";
				$this->error_description = "No Records found";
				return false;
			}

		}else{
			$this->error_description = "Invalid Rule";
			return false;
		}
	}





	function get_test_questions($start_record = 0,$max_records = 25 ,$filter= "")
	{
		$strSQL="";$data=array();$i=0;
		$strSQL .= "SELECT UTD.id, UTD.slno, UTD.user_test_id, UTD.question_id, UTD.flag, UTD.answer_keys,UTD.user_keys,Q.question,Q.options,Q.question_type_id,Q.updated, Q.question_group_id, Q.image,Q.option_images, QG.passage";
		$strSQL .= " FROM user_test_details UTD";
		$strSQL .= " LEFT JOIN questions Q ON Q.id = UTD.question_id";
		$strSQL .= " LEFT JOIN (SELECT * FROM question_groups ORDER BY id DESC) AS QG ON QG.id = Q.question_group_id";
		$strSQL .= " WHERE UTD.user_test_id = ".$this->user_test_id;
		if($filter != ""){
			$strSQL .= $filter;
		}
		$strSQL .= " ORDER BY UTD.slno ASC";
		//taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		mysql_query("SET NAMES utf8");//echo $strSQL_limit;exit();
		$rsRES	= mysql_query($strSQL_limit,$this->connection) or die(mysql_error().$strSQL_limit);
		if(mysql_num_rows($rsRES) > 0)
		{
			//without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {

            } else {
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
                $this->total_records = mysql_num_rows($all_rs);
            }

			while($row = mysql_fetch_assoc($rsRES))
			{
				$data[$i]['id']				=	$row['id'];
				$data[$i]['slno']			=	$row['slno'];
				$data[$i]['question_id']	=	$row['question_id'];
				$data[$i]['question_type_id']	=	$row['question_type_id'];
				$data[$i]['answer_keys']		=	$row['answer_keys'];
				$data[$i]['user_keys']		=	$row['user_keys'];
				$data[$i]['question']		=	$row['question'];
				$data[$i]['options']		=	$row['options'];
				$data[$i]['updated']		=	$row['updated'];
				$data[$i]['flag']			=	$row['flag'];
				$data[$i]['passage']		=	$row['passage'];
				$data[$i]['question_group_id']	=	$row['question_group_id'];
				$data[$i]['image']			=	$row['image'];
				$data[$i]['option_images']	=	$row['option_images'];
				$i++;
			}
			return $data;
		}
		else
		{
			return false;
		}

	}

	function get_count($filter = "")
	{
		$strSQL = "SELECT COUNT(*) AS NUM FROM user_test_details WHERE user_test_id = ".$this->user_test_id;
		if($filter != ""){
			$strSQL .=" AND ".$filter;
		}
		$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		if(mysql_num_rows($rsRES) > 0){
			$row = mysql_fetch_assoc($rsRES);
			return $row['NUM'];
		}
		else{
			return 0;
		}
	}

	function get_detail(){
        $strSQL = "SELECT * FROM user_test_details WHERE id = ".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->user_test_id = mysql_result($rsRES,0,'user_test_id');
                $this->question_id = mysql_result($rsRES,0,'question_id');
                $this->flag= mysql_result($rsRES,0,'flag');
		        $this->user_keys = mysql_result($rsRES,0,'user_keys');
                $this->answer_keys= mysql_result($rsRES,0,'answer_keys');
                $this->slno = mysql_result($rsRES,0,'slno');
                return true;
        }
        else{
            return false;
        }
    }


    function get_list_array_for_report_subject_wise()
    {
    	$strSQL = "SELECT QD.quiz_id,Q.exam_id,QU.subject_id,count(UTD.id) as number_of_questions,COUNT(CASE WHEN UTD.user_keys = UTD.answer_keys THEN 1 END)  as correct_answers,COUNT(CASE WHEN UTD.user_keys != -1 THEN 1 END)  as attempted
				FROM questions QU, user_test_details UTD
				LEFT JOIN quiz_details QD ON QD.id = UTD.quiz_detail_id
				LEFT JOIN quizzes Q ON QD.quiz_id = Q.id  

				WHERE UTD.question_id = QU.id AND UTD.user_test_id = '".$this->user_test_id."'
				GROUP BY QU.subject_id";


		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if(mysql_num_rows($rsRES) > 0){
			$dataArray = array();$i=0;
			while ($row = mysql_fetch_assoc($rsRES)) {
				$dataArray[$i]['quiz_id'] = $row['quiz_id'];
				$dataArray[$i]['exam_id'] = $row['exam_id'];
				$dataArray[$i]['subject_id'] = $row['subject_id'];
				$dataArray[$i]['number_of_questions'] = $row['number_of_questions'];
				$dataArray[$i]['correct_answers'] = $row['correct_answers'];
				$dataArray[$i]['attempted'] = $row['attempted'];
				$i++;
			}
			return $dataArray;
		}else{
			$this->error_description = "Could not list data";
			return false;
		}

    }

    //generate question- real test
	function generate_test_questions()
	{
		$dataArray = array();
		$i=0;	
		if($this->quiz_details == false){
			$this->error_description = "Rules not defined";
			return false;
		}else{
			foreach ($this->quiz_details as $quiz_detail) 
			{
				if($quiz_detail['question_ids'] == ""){//random questions for test
					if($quiz_detail['question_group'] == QUESTION_GROUP_TRUE){
						$utd_array = $this->generate_data_array_for_random_real_test_rule_group($quiz_detail);
					}elseif($quiz_detail['question_group'] == QUESTION_GROUP_FALSE){
						$utd_array = $this->generate_data_array_for_random_real_test_rule($quiz_detail);
					}
				}else{//staic questions for test
					$utd_array = $this->generate_data_array_for_static_real_test_rule($quiz_detail);
				}

				if($utd_array == false){
					$this->error_description = "Not enough questions for this quiz .Please contact administrator";
					$_SESSION[SESSION_TITLE.'flash'] = $this->error_description;
				    header( "Location: dashboard.php");
				    exit();
				}else{
					$dataArray = array_merge($dataArray,$utd_array);
				}
				$i++;
			}
			
			return $dataArray;
		}
	}

	//generate dataArray with question ids for static real test rule
	function generate_data_array_for_static_real_test_rule($quiz_detail)
	{
		$question_ids = $quiz_detail['question_ids']; 
		$strSQL = "SELECT ".$quiz_detail['id']." AS quiz_detail_id, Q.id, Q.options,Q.answers,Q.answer_keys, Q.question_group_id FROM questions Q
		WHERE Q.id IN (".$question_ids.")";
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		$total_questions = mysql_num_rows($rsRES);
		if($total_questions > 0){ //if question exist for this rule
			$dataArray = array();$i=$this->index;
			while($row = mysql_fetch_assoc($rsRES)){
				$i++;
				$dataArray[$i]['question_id']=$row['id'];
				$dataArray[$i]['answer_keys']=$row['answer_keys'];
				$dataArray[$i]['quiz_detail_id']=$row['quiz_detail_id'];
				$dataArray[$i]['question_group_id']=$row['question_group_id'];
			}
			return $dataArray;
		}else{
			return false;
		}
	}

	//generate dataArray with question ids for random real test rule 
	function generate_data_array_for_random_real_test_rule($quiz_detail)
	{
		$strSQL_rule ="";
		if($quiz_detail['exam_id'] > 0){
			$strSQL_rule .= " AND Q.exam_id = '".$quiz_detail['exam_id']."'";
		}
		if($quiz_detail['subject_id'] > 0){
			$strSQL_rule .= " AND Q.subject_id = '".$quiz_detail['subject_id']."'";
		}
		if($quiz_detail['section_id'] > 0){
			$strSQL_rule .= " AND Q.section_id = '".$quiz_detail['section_id']."'";
		}
		if($quiz_detail['language_id'] > 0){
			$strSQL_rule .= " AND Q.language_id = '".$quiz_detail['language_id']."'";
		}
		if($quiz_detail['diffilulty_level_id'] > 0){
			$strSQL_rule .= " AND Q.difficulty_level_id = '".$quiz_detail['diffilulty_level_id']."'";
		}

		$strSQL_rule_no_used_questions = " AND Q.id NOT IN (SELECT UTD.question_id FROM user_test_details UTD, user_tests UT WHERE UTD.user_test_id = UT.id AND  UT.quiz_id='".$quiz_detail['quiz_id']."' AND user_id = '".$this->user_id."') " ;
		$strSQL_start  = "SELECT ".$quiz_detail['id']." AS quiz_detail_id, Q.id, Q.options,Q.answers,Q.answer_keys, Q.question_group_id FROM questions Q WHERE Q.question_status_id = '".STATUS_ACTIVE."'";
		if($quiz_detail['organization_id'] > 0){
			$organization_id = $quiz_detail['organization_id'];
			$strSQL_start .= " AND (Q.organization_id = '".$organization_id."' OR Q.organization_id = '' OR Q.organization_id <= 0) ";
		}

						
		$strSQL_end =" ORDER BY RAND() LIMIT ".$quiz_detail['number_of_questions']." ";
		$balance_question_count = $quiz_detail['number_of_questions'];//get limit


		$strSQL = $strSQL_start.$strSQL_rule_no_used_questions.$strSQL_rule.$strSQL_end;
		mysql_query("SET NAMES utf8");echo $strSQL;exit();
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		$total_questions = mysql_num_rows($rsRES);
		//echo $total_questions;exit();
		$question_ids_forsql = "";
		
		if($total_questions > 0){ //if question exist for this rule
			$dataArray = array();$i=0;
			while($row = mysql_fetch_assoc($rsRES)){
				$dataArray[$i]['question_id']=$row['id'];
				$question_ids_forsql .= $row['id'].",";
				$dataArray[$i]['answer_keys']=$row['answer_keys'];
				$dataArray[$i]['quiz_detail_id']=$row['quiz_detail_id'];
				$dataArray[$i]['question_group_id']=$row['question_group_id'];
				$balance_question_count--;
				$i++;
			}
			$question_ids_forsql = substr($question_ids_forsql,0,-1);
		}

		if($balance_question_count > 0) {//check questions all retrieved for that rule
			$strSQL_end =" ORDER BY RAND() LIMIT ".$balance_question_count." ";
			$strSQL = $strSQL_start.$strSQL_rule;
			if($question_ids_forsql != ""){
				$strSQL .= " AND Q.id NOT IN (".$question_ids_forsql.")";
			}
			$strSQL .= $strSQL_end;
			mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL);
			$total_questions_without_used_rule = mysql_num_rows($rsRES);
			if(mysql_num_rows($rsRES) > 0){
				while($row = mysql_fetch_assoc($rsRES)){
					$dataArray[$i]['question_id']=$row['id'];
					$dataArray[$i]['answer_keys']=$row['answer_keys'];
					$dataArray[$i]['quiz_detail_id']=$row['quiz_detail_id'];
					$dataArray[$i]['question_group_id']=$row['question_group_id'];
					$i++;
				}
			}
		}

		if(count($dataArray) ==  $quiz_detail['number_of_questions']){
			return $dataArray;
		}else{
			return false;
		}
	}

	//generate dataArray with question ids for random real test rule passage 
	function generate_data_array_for_random_real_test_rule_group($quiz_detail)
	{
		$strSQL_rule ="";
		if($quiz_detail['exam_id'] > 0){
			$strSQL_rule .= " AND QG.exam_id = '".$quiz_detail['exam_id']."'";
		}
		if($quiz_detail['subject_id'] > 0){
			$strSQL_rule .= " AND QG.subject_id = '".$quiz_detail['subject_id']."'";
		}
		if($quiz_detail['section_id'] > 0){
			$strSQL_rule .= " AND QG.section_id = '".$quiz_detail['section_id']."'";
		}
		if($quiz_detail['language_id'] > 0){
			$strSQL_rule .= " AND QG.language_id = '".$quiz_detail['language_id']."'";
		}
		if($quiz_detail['diffilulty_level_id'] > 0){
			$strSQL_rule .= " AND QG.difficulty_level_id = '".$quiz_detail['diffilulty_level_id']."'";
		}

		$strSQL_rule_no_used_questions = " AND QG.id NOT IN (SELECT UTD.question_group_id FROM user_test_details UTD, user_tests UT WHERE UTD.user_test_id = UT.id AND  UT.quiz_id='".$quiz_detail['quiz_id']."' AND user_id = '".$this->user_id."') " ;
		
		$strSQL_start = "SELECT QG.id FROM question_groups QG WHERE QG. question_group_status_id = '".STATUS_ACTIVE."'";
		if($quiz_detail['organization_id'] > 0){
			$organization_id = $quiz_detail['organization_id'];
			$strSQL_start .= " AND (QG.organization_id = '".$organization_id."' OR QG.organization_id = '' OR QG.organization_id <= 0) ";
		}
		$strSQL_end =" ORDER BY RAND() LIMIT ".$quiz_detail['number_of_question_groups'];
		$balance_question_group_count = $quiz_detail['number_of_question_groups'];
		$strSQL = $strSQL_start.$strSQL_rule_no_used_questions.$strSQL_rule.$strSQL_end;
		mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		$total_questions = mysql_num_rows($rsRES);
		$question_group_ids = "";
		if($total_questions > 0)
		{	
			while($row = mysql_fetch_assoc($rsRES)){
				$question_group_ids .=$row['id'].",";
				$balance_question_group_count--;
			}
			
		}
		if($balance_question_group_count > 0) {//check question groups all retrieved for that rule
			if($question_group_ids != ""){
				$strSQL_no_repeat = " AND QG.id NOT IN (".substr($question_group_ids,0,-1).")";
				$strSQL_end =" ORDER BY RAND() LIMIT ".$balance_question_group_count." ";
				$strSQL = $strSQL_start.$strSQL_rule.$strSQL_no_repeat.$strSQL_end;
				mysql_query("SET NAMES utf8");
				$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
				if(mysql_num_rows($rsRES) > 0){
					while($row = mysql_fetch_assoc($rsRES)){
						$question_group_ids .=$row['id'].",";
						$balance_question_group_count--;
					}
				}
			}
		}

		if($balance_question_group_count == 0){
			$question_group_ids =substr($question_group_ids,0,-1);
			$dataArray = $this->get_utdArray_with_question_group_ids($quiz_detail['id'],$question_group_ids);
			return $dataArray;
		}
		else{
			return false;
		}
	}

	//function to get user test details insert array with question group ids
	function get_utdArray_with_question_group_ids($quiz_detail_id = gINVALID,$question_group_ids = "")
	{
		if($question_group_ids != "" and $quiz_detail_id > 0)
		{
			$dataArray = array();$i=0;
			$strSQL = "SELECT ".$quiz_detail_id." AS quiz_detail_id, Q.id, Q.options,Q.answers,Q.answer_keys, Q.question_group_id FROM questions Q WHERE Q.question_group_id IN (".$question_group_ids.")";
			mysql_query("SET NAMES utf8");//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL);
			if(mysql_num_rows($rsRES) > 0){
				while($row = mysql_fetch_assoc($rsRES)){
					$dataArray[$i]['question_id']=$row['id'];
					$dataArray[$i]['answer_keys']=$row['answer_keys'];
					$dataArray[$i]['quiz_detail_id']=$row['quiz_detail_id'];
					$dataArray[$i]['question_group_id']=$row['question_group_id'];
					$i++;
				}
				return $dataArray;
			}else{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


}
?>
