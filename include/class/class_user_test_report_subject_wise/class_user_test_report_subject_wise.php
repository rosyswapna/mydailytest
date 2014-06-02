<?php 
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserTestReportSubjectWise
{
	
	var $connection = "";
	var $id = gINVALID;
	var $user_test_id = "";
	var $quiz_id = "";
	var $exam_id = "";
	var $subject_id = "";
	var $number_of_questions = "";
	var $user_mark = "";
	var $attempted = "";
	var $correct_answers = "";



	var $error_number=gINVALID;
    var $error_description="";

    //for pagination
    var $total_records = "";


    function update_batch($dataArray = array())
    {
    	if(count($dataArray) > 0){
    		$strSQL = "INSERT INTO user_test_report_subject_wise(user_test_id,quiz_id,exam_id,subject_id,number_of_questions,user_mark,attempted,correct_answers) VALUES";
    		$i=0;
    		while(count($dataArray) > $i)
    		{
    			$strSQL .="('";
				$strSQL .= mysql_real_escape_string(trim($this->user_test_id))."','";
				$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['quiz_id']))."','";
				$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['exam_id']))."','";
				$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['subject_id']))."','";
				$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['number_of_questions']))."','";
                //user mark not updated . .This will update later 
				$strSQL .= "','";
				$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['attempted']))."','";
				$strSQL .= mysql_real_escape_string(trim($dataArray[$i]['correct_answers']))."'),";
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
    	else{
    		$this->error_description = "Data Array not prepared. Contact administrator";
    		return false;
    	}
    }



    function check()
    {
    	$strSQL = "SELECT COUNT(*) AS count FROM user_test_report_subject_wise WHERE user_test_id = '".$this->user_test_id."'";
    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
    	$row = mysql_fetch_assoc($rsRES);
    	if($row['count'] > 0){
    		return true;
    	}
    	else{
    		return false;
    	}
    }

    function empty_table()
    {
        $strSQL = "TRUNCATE TABLE user_test_report_subject_wise";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if($rsRES){
            return true;
        }else{
            return false;
        }
    }
   
}
?>