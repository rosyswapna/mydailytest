<?php

class DemoTestDetails
{
	var $id = gINVALID;
	var $demo_test_id = gINVALID;
	var $question_id = "";
	var $flag = "";
	var $user_keys = "";
	var $answer_keys = "";
	var $slno ="";
	var $quiz_detail_id ="";

	var $total_records ="";
	var $total_questions = "";


	var $quiz_details= false;

	var $user_keys_batch = array();
	
	
	//insert demotest details
	function insert_demo_test_details($dataArray=array())
	{//print_r($dataArray);exit();
		$strSQL = "";$i=0;$slno = $i+1;
		$strSQL .= "INSERT INTO demo_test_details(demo_test_id,question_id,flag,user_keys,answer_keys,slno)";
		$strSQL .= " VALUES";
		while(count($dataArray) > $i)
		{
			$strSQL .= "('".mysql_real_escape_string(trim($this->demo_test_id))."','".mysql_real_escape_string(trim($dataArray[$i]['id']))."','0','-1','".mysql_real_escape_string(trim($dataArray[$i]['answer_keys']))."','".$slno."'),";
			$i++;$slno++;
		}
		$strSQL =substr($strSQL,0,-1);
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


	//get demo test questions for test
	function get_test_questions($start_record = 0,$max_records = 25 ,$filter= "")
	{
		$strSQL="";$data=array();$i=0;
		$strSQL .= "SELECT DTD.id, DTD.slno, DTD.demo_test_id, DTD.question_id, DTD.flag, DTD.answer_keys,DTD.user_keys,Q.question,Q.options,Q.question_type_id,Q.updated, Q.question_group_id, QG.passage, Q.image, Q.option_images";
		$strSQL .= " FROM demo_test_details DTD";
		$strSQL .= " LEFT JOIN questions Q ON Q.id = DTD.question_id";
		$strSQL .= " LEFT JOIN question_groups QG ON QG.id = Q.question_group_id";
	
		$strSQL .= " WHERE DTD.demo_test_id = '".$this->demo_test_id."'";
		if($filter != ""){
			$strSQL .= $filter;
		}
		$strSQL .= " ORDER BY DTD.slno ASC";
		//taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		mysql_query("SET NAMES utf8");
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
				$data[$i]['question_group_id']			=	$row['question_group_id'];
				$data[$i]['passage']			=	$row['passage'];
				$data[$i]['image']			=	$row['image'];
				$data[$i]['option_images']			=	$row['option_images'];
				$i++;
			}
			return $data;
			
		}
		else
		{
			return false;
		}

	}

	//update flag
	function update_flag()
	{
		$strSQL .= "UPDATE demo_test_details SET flag = '".mysql_real_escape_string(trim($this->flag))."' WHERE id= '".mysql_real_escape_string(trim($this->id))."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		if ( mysql_affected_rows($this->connection) > 0 ) {
			return true;
		}
		else{
			return false;
		}
	}


	//update batch of userkeys
	function update_userkeys_batch()
	{
		$strSQL = "";$i=0;$dataArray = $this->user_keys_batch;
		$strSQL .= "UPDATE demo_test_details";
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
			$strSQL .= " END WHERE id IN(".substr($id_list,0,-1).")";//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			if (mysql_affected_rows($this->connection) > 0 ) {
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
		$strSQL .= "UPDATE demo_test_details SET user_keys = '".mysql_real_escape_string(trim($this->user_keys))."' WHERE id= '".mysql_real_escape_string(trim($this->id))."'";
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
		$strSQL = "SELECT COUNT(*) AS num FROM demo_test_details WHERE demo_test_id = '".$this->demo_test_id."'";
		//echo $strSQL ;exit();
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


	function get_details(){
        $strSQL = "SELECT * FROM demo_test_details WHERE id = ".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->user_test_id = mysql_result($rsRES,0,'demo_test_id');
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


}
?>
