<?php

// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class DemoTest
{
	var $connection = "";
	var $id = gINVALID;
	var $quiz_id = gINVALID;
	var $quiz_name = "";	
	var $test_status_id = gINVALID;
	var $test_date = "";
	var $start_time = "";
	var $end_time = "";
	var $resumed_time = "";
	var $used_time = "";
	var $total_time = "";
	//////////////////////////////
	var $attempted = "";
	var $correct = "";
	var $wrong_answer = "";
	

	
	var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";
	
	
	function update()
	{
		if ( $this->id == "" || $this->id == gINVALID) 
		{
			$strSQL = "INSERT INTO demo_tests (quiz_id, test_status_id, test_date, start_time, resumed_time,used_time,total_time) VALUES ('";
			$strSQL .= mysql_real_escape_string(trim($this->quiz_id)) ."','";
			$strSQL .= mysql_real_escape_string($this->test_status_id) ."','";
			$strSQL .= CURRENT_DATE."','";
			$strSQL .= CURRENT_DATETIME."','";
			$strSQL .= CURRENT_DATETIME."','";
			$strSQL .= mysql_real_escape_string(trim($this->used_time))."','";
			$strSQL .= mysql_real_escape_string(trim($this->total_time))."')";//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			
		 	if ( mysql_affected_rows($this->connection) > 0 ) {
			  $this->id = mysql_insert_id();
			  return TRUE;
		    }else{
			  $this->error_number = 3;
			  $this->error_description="Can't insert data";
			  return false;
			}
		}
		elseif($this->id > 0 )
		{
			$strSQL = "UPDATE demo_tests SET end_time = '".CURRENT_DATETIME."',";
			$strSQL .= " test_status_id = '".$this->test_status_id."',";
			$strSQL .= " used_time = '".$this->used_time."'";
			$strSQL .= " WHERE id = '".mysql_real_escape_string(trim($this->id))."'";//echo $strSQL;exit();
			$rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );//echo $strSQL;exit();
			if ( mysql_affected_rows($this->connection) >= 0 ) {
						return true;
			}
			else{
				$this->error_number = 3;
				$this->error_description="Can't update this Lead";
				return false;
			}
		}
	}
	function get_details()
	{
		$strSQL = "SELECT id, quiz_id, test_status_id, test_date, start_time,end_time,resumed_time,used_time,total_time";
		$strSQL .= " FROM demo_tests";
		$strSQL .= " WHERE id = '".$this->id."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		if(mysql_num_rows($rsRES) > 0)
		{
			$row = mysql_fetch_assoc($rsRES);
			$this->id 				= $row['id'];
			$this->quiz_id 			= $row['quiz_id'];
			$this->test_status_id 	= $row['test_status_id'];
			$this->test_date 		= $row['test_date'];
			$this->start_time 		= $row['start_time'];
			$this->end_time 		= $row['end_time'];
			$this->resumed_time 	= $row['resumed_time'];
			$this->used_time 		= $row['used_time'];
			$this->total_time 		= $row['total_time'];
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	
	
	
	function pause(){
		if($this->id > 0 )
		{	
			$strSQL = "UPDATE demo_tests SET used_time = '".$this->used_time."', test_status_id = '".TEST_STATUS_PAUSED."'";
			$strSQL .= " WHERE id = '".mysql_real_escape_string(trim($this->id))."'";
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		 	if ( mysql_affected_rows($this->connection) > 0 ) {
			  $this->id = mysql_insert_id();
			  return TRUE;
		    }else{
			  $this->error_number = 3;
			  $this->error_description="Can't insert data";
			  return false;
			}		
		}
		else{	
			return false;
		} 	
	}

	function resume(){
		
	if($this->id > 0 ){
		//$this->get_details();
		
		
			
			$strSQL = "UPDATE demo_tests SET resumed_time = '".CURRENT_DATETIME."',test_status_id = '".TEST_STATUS_STARTED."'";
			$strSQL .= " WHERE id = '".mysql_real_escape_string(trim($this->id))."'";
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		 	if ( mysql_affected_rows($this->connection) > 0 ) {
			  $this->id = mysql_insert_id();
			  return TRUE;
		    }else{
			  $this->error_number = 3;
			  $this->error_description="Can't insert data";
			  return false;
			}		
			
			
			
			
			
		}else{	
		return false;} 	
		
		
	}

	function check()
	{
		$strSQL = "SELECT UT.id, UT.quiz_id, Q.name as quiz_name  FROM user_tests UT, quizzes Q WHERE UT.quiz_id = Q.id AND UT.user_id = '".$this->user_id."' AND UT.id = '".$this->id."'";
		$rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		if(mysql_num_rows($rsRES)>0)
		{
			//To display the name of the quiz on Real test
			$this->quiz_name = mysql_result($rsRES, 0,"quiz_name");
			return true;
		}
		else
		{
			return false;
		}
	}
	
	



function get_list_array_bylimit($user_id=gINVALID,$start_record = 0,$max_records = 3){
		
        $str_condition = "";
		if($user_id > 0){
			 $str_condition = "UT.user_id ='".mysql_real_escape_string($user_id)."'";
		}
		
		if(trim($str_condition)!=""){
		$str_condition= " AND ".$str_condition;
		}
		$strSQL = "SELECT  UT.id,UT.user_id,UT.quiz_id,UT.test_status_id,UT.test_date,UT.start_time,UT.end_time,UT.resumed_time,UT.used_time, UT.total_time, QT.name as                    quiz_type_name, Q.name as quiz_name, U.username FROM user_tests UT ,users U, quizzes Q, quiz_types QT WHERE UT.user_id = U.id AND UT.quiz_id = Q.id  
			       AND Q.quiz_type_id = QT.id ".$str_condition."  ORDER BY UT.start_time DESC";
        //taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
         $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
                
            } else {
				$str_all_condition = "";
				if($user_id > 0){
					 $str_all_condition = " WHERE user_id ='".mysql_real_escape_string($user_id)."'";
				}
				$strSQL="SELECT count(*) as total_records FROM user_tests ".$str_all_condition;
				
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
				$row_all=mysql_fetch_assoc($all_rs);
				
                $this->total_records = $row_all["total_records"];
            }

			$usertest = array();$i=0;
		    while ( $row = mysql_fetch_assoc($rsRES) ){ 

				
				$usertest[$i]["id"] = $row["id"];
				$usertest[$i]["quiz_id"] = $row["quiz_id"];
				$usertest[$i]["test_status_id"] = $row["test_status_id"];
				$usertest[$i]["test_date"] = $row["test_date"];
				$usertest[$i]["start_time_formated"] = date('d/m/Y (H:i:s)',strtotime($row["start_time"]));
				$usertest[$i]["end_time"] = $row["end_time"];
				$usertest[$i]["resumed_time"] = $row["resumed_time"];
				$usertest[$i]["used_time"] = $row["used_time"];
				$usertest[$i]["total_time"] = $row["total_time"];
				$usertest[$i]["quiz_name"] = $row["quiz_name"];
				$usertest[$i]["quiz_type_name"] = $row["quiz_type_name"];
				$usertest[$i]["username"] = $row["username"];
                $i++;
            }
            return $usertest;
		
        }else{
            $this->error_number = 5;
            $this->error_description="Can't get limited data";
            return false;
        }
}
	function get_report()
	{
		$strSQL = "SELECT COUNT(CASE WHEN user_keys <> -1 THEN 1 END ) as attempted,  
					COUNT(CASE WHEN user_keys = answer_keys THEN 1 END )  as correct ,
					COUNT(*) as total FROM demo_test_details";
		
		$strSQL .= " WHERE demo_test_id = '".$this->id."'";
		//echo $strSQL;
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









	function delete(){
		$strSQL = "DELETE FROM user_tests WHERE id =".$this->id;
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_affected_rows($this->connection) > 0 ) {
					return true;
			}
			else{
				$this->error_description = "Can't Delete This Test";
				return false;
			}
	}

	function get_quiz_name_with_usertestid($usertestid)
	{
		$strSQL = "SELECT Q.name FROM quizzes Q  WHERE Q.id = (SELECT UT.quiz_id FROM user_tests UT WHERE id = '".$usertestid."')";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		if(mysql_num_rows($rsRES) > 0){
			$row = mysql_fetch_assoc($rsRES);
			return $row['name'];
		}
		else{
			return "";
		}
	}



}


?>
