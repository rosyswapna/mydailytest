<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserQuestionReporting {
    var $connection;
    var $id = gINVALID;
    var $user_id = "";
    var $question_id = "";
    var $status_id = "";
    var $description = "";

    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

    function update()
    {
    	if($this->id == "" || $this->id == gINVALID){
	    	$strSQL = "INSERT INTO user_question_reportings(user_id,question_id,status_id,description) VALUES('";
	    	$strSQL .= mysql_real_escape_string(trim($this->user_id))."','";
	    	$strSQL .= mysql_real_escape_string(trim($this->question_id))."','";
	    	$strSQL .= mysql_real_escape_string(trim($this->status_id))."','";
			$strSQL .= mysql_real_escape_string(trim($this->description))."')";
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			if ( mysql_affected_rows($this->connection) > 0 ) {
			  $this->id = mysql_insert_id();
			  return true;
			}else{
			  $this->error_number = 3;
			  $this->error_description="Can't insert this Question";
			  return false;
			}
		}else{
			$strSQL = "UPDATE user_question_reportings SET ";
			$strSQL .= "user_id = '".mysql_real_escape_string(trim($this->user_id))."',";
			$strSQL .= "question_id = '".mysql_real_escape_string(trim($this->question_id))."',";
			$strSQL .= "status_id = '".mysql_real_escape_string(trim($this->status_id))."',";
			$strSQL .= "description = '".mysql_real_escape_string(trim($this->description))."'";
			$strSQL .= " WHERE id = '".$this->id."'";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			if ( mysql_affected_rows($this->connection) > 0 ) {
			  $this->id = mysql_insert_id();
			  return true;
			}else{
			  $this->error_number = 3;
			  $this->error_description="Can't insert this Question";
			  return false;
			}
		}
    }
	
	function to_inactive(){
	$strSQL = "UPDATE user_question_reportings SET status_id = '".STATUS_INACTIVE."' WHERE id='".$this->id."'";	
	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
	}
	
	
	function get_list_reported_questions($start_record = 0,$max_records = 25){



        $strSQL = "SELECT * FROM  user_question_reportings WHERE";
		$str_condition = "";
		if($this->status_id==""){
		$str_condition = "  status_id ='".STATUS_ACTIVE."'" ;	
		}else{
		$str_condition = "  status_id ='".mysql_real_escape_string($this->status_id)."'" ;		
		}
		if ($this->id != "") { 
			$str_condition .= " AND id = '".mysql_real_escape_string($this->id)."'";  
		}
		

        if (trim($str_condition) !="") {
            $strSQL .=  $str_condition . "  ORDER BY id DESC";
        }
		
		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }


	        $limited_data = array(); 
       		$index=0;
			while ($row = mysql_fetch_assoc($rsRES)){
				$limited_data[$index]["id"] = $row["id"];
				$limited_data[$index]["question_id"] = $row["question_id"];
				$limited_data[$index]["description"] = $row["description"];
				$limited_data[$index]["user_id"] = $row["user_id"];
				$limited_data[$index]["status_id"] = $row["status_id"];
				
				$index++;
			}
		
            return $limited_data;
        }
        else{
            return false;
        }
    }


    
}

?>