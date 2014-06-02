<?php
class Quiz {
    var $connection;
    var $id = gINVALID;
    var $name = "";
    var $exam_id = "";
    var $quiz_type_id = "";
    var $total_time = "";
    var $quiz_status_id = "";
    var $question_ids = "";
    var $question_group_ids = "";
    var $credit = DEFAULT_CREDIT;
    var $organization_id="";
    var $total_questions="";
    var $description = "";
    var $special_demo = gINVALID;
    var $period_from = "";
    var $period_to = "";
    var $time_from = "";
    var $time_to = "";
    //timer variables
    var $hour = "00";
    var $minute = "05";
    var $second = "00";
	
    var $error_number = "";
    var $error_description = "";

    //for pagination
    var $total_records = "";
  	


    function get_quiz_types()
    {
        $quiz_types = array();$i=0;
		
        $strSQL = "SELECT  * FROM quiz_types";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $quiz_types[$i]["id"] = $row["id"];
				$quiz_types[$i]["name"] = $row["name"];
                $i++;
            }
            return $quiz_types;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Quiz Types";
        return false;
        }
    }

    function update()
    {
	
        if ( $this->id == "" || $this->id == gINVALID) 
        {
            $strSQL = "INSERT INTO quizzes (name, exam_id, quiz_type_id,total_time,quiz_status_id, question_ids, question_group_ids, credit, organization_id,description,special_demo,period_from,period_to,time_from,time_to) VALUES ('"; 
         	$strSQL .= mysql_real_escape_string($this->name) ."','";
            $strSQL .= mysql_real_escape_string($this->exam_id) ."','";
            $strSQL .= mysql_real_escape_string($this->quiz_type_id) ."','";
            $strSQL .= mysql_real_escape_string($this->total_time) ."','";
            $strSQL .= mysql_real_escape_string($this->quiz_status_id) ."','";
            $strSQL .= mysql_real_escape_string($this->question_ids) ."','";
            $strSQL .= mysql_real_escape_string($this->question_group_ids) ."','";
            $strSQL .= mysql_real_escape_string($this->credit) ."','";
            $strSQL .= mysql_real_escape_string($this->organization_id) ."','";
            $strSQL .= mysql_real_escape_string($this->description) ."','";
            $strSQL .= mysql_real_escape_string($this->special_demo) ."','";
            if($this->period_from == ""){
                $period_from = "";
            }else{
                 $period_from = date('Y-m-d',strtotime($this->period_from));
            }
            $strSQL .= $period_from ."','";

            if($this->period_to == ""){
                $period_to = "";
            }else{
                 $period_to = date('Y-m-d',strtotime($this->period_to));
            }
            $strSQL .= $period_to ."','";

            if($this->period_to == ""){
                $period_to = "";
            }else{
                 $period_to = date('Y-m-d',strtotime($this->period_to));
            }
            $strSQL .= mysql_real_escape_string($this->time_from) ."','";
            $strSQL .= mysql_real_escape_string($this->time_to) . "')";
           //echo $strSQL;exit();
            
            $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    	    if ( mysql_affected_rows($this->connection) > 0 )
            {
                $this->id = mysql_insert_id();
                $this->error_description = "New Quiz generated";
                return true;
            }else{
                $this->error_number = 3;
                $this->error_description="Can't insert this Quiz";
                return false;
            }
        } 
        elseif($this->id > 0 ) 
        {
    		$strSQL = "Update quizzes SET ";
            $strSQL .= " name = '".mysql_real_escape_string($this->name)."',";
            $strSQL .= " exam_id = '".mysql_real_escape_string($this->exam_id)."',";
            $strSQL .= " quiz_type_id = '".mysql_real_escape_string($this->quiz_type_id)."',";
            $strSQL .= " total_time = '".mysql_real_escape_string($this->total_time)."',";
            $strSQL .= " quiz_status_id = '".mysql_real_escape_string($this->quiz_status_id)."',";
            $strSQL .= " question_ids = '".mysql_real_escape_string($this->question_ids)."',";
            $strSQL .= " question_group_ids = '".mysql_real_escape_string($this->question_group_ids)."',";
            $strSQL .= " credit = '".mysql_real_escape_string($this->credit)."',";
            $strSQL .= " organization_id = '".mysql_real_escape_string($this->organization_id)."',";
            $strSQL .= " description = '".mysql_real_escape_string($this->description)."',";
            $strSQL .= " special_demo = '".mysql_real_escape_string($this->special_demo)."'";
            if($this->period_from != ""){
                $strSQL .= ", period_from = '".date('Y-m-d',strtotime($this->period_from))."'";
            }else{
                $strSQL .= ", period_from = ''";
            }
            if($this->period_to != ""){
                $strSQL .= ", period_to = '".date('Y-m-d',strtotime($this->period_to))."'";
            }else{
                $strSQL .= ", period_to = ''";
            }
            if($this->time_from != ""){
                $strSQL .= ", time_from = '".mysql_real_escape_string($this->time_from)."'";
            }else{
                $strSQL .= ", time_from = ''";
            }
            if($this->time_to != ""){
                $strSQL .= ", time_to = '".mysql_real_escape_string($this->time_to)."'";	
            }else{
                $strSQL .= ", time_to = ''";
            }
            $strSQL .= " WHERE id = ".$this->id;//echo $strSQL;exit();
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) 
            {
                $this->error_description = "Quiz Updated";
                return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Quiz";
                return false;
            }
        }
    }

    function get_list_array()
    {
        $strSQL = "SELECT id,name, exam_id, quiz_type_id,total_time,quiz_status_id, question_ids, credit, organization_id,description,special_demo FROM quizzes";
        $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
        if (mysql_num_rows($rsRES) > 0 ){
            $quiz = array();
            $i=0;
            while($row = mysql_fetch_assoc($rsRES)){
                $quiz[$i]["id"]             = $row['id'];
                $quiz[$i]["name"]           = $row['name'];
            	$quiz[$i]["exam_id"]   		= $row['exam_id'];
                $quiz[$i]["quiz_type_id"]   = $row['quiz_type_id'];
                $quiz[$i]["total_time"]     = $row['total_time'];
                $quiz[$i]["quiz_status_id"] = $row['quiz_status_id'];
                $quiz[$i]["question_ids"]   = $row['question_ids'];
                $quiz[$i]["credit"]         = $row['credit'];
                $quiz[$i]["organization_id"]= $row['organization_id'];
                $quiz[$i]["description"]= $row['description'];
                $quiz[$i]["special_demo"]= $row['special_demo'];
                
                $i++;
            } 
            return $quiz ;
        }else{
            $this->error_number = 2;
            $this->error_description="Contact administrator to get its details";
            return false;
        }
    }
    
    function get_details()
    {	 
        $strSQL = "SELECT * FROM quizzes  WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
        if ( mysql_num_rows($rsRES) > 0 )
        {
            $this->id = mysql_result($rsRES,0,'id');
            $this->name = mysql_result($rsRES,0,'name');
            $this->exam_id = mysql_result($rsRES,0,'exam_id');
            $this->quiz_type_id = mysql_result($rsRES,0,'quiz_type_id');
            $this->total_time = mysql_result($rsRES,0,'total_time');
            $this->quiz_status_id = mysql_result($rsRES,0,'quiz_status_id');
            $this->question_ids = mysql_result($rsRES,0,'question_ids');
            $this->question_group_ids = mysql_result($rsRES,0,'question_group_ids');
            $this->credit = mysql_result($rsRES,0,'credit');
            $this->organization_id = mysql_result($rsRES,0,'organization_id');
            $this->description = mysql_result($rsRES,0,'description');
            $this->special_demo = mysql_result($rsRES,0,'special_demo');
            $this->period_from = mysql_result($rsRES,0,'period_from');
            $this->period_to = mysql_result($rsRES,0,'period_to');
            $this->time_from = mysql_result($rsRES,0,'time_from');
            $this->time_to = mysql_result($rsRES,0,'time_to');
            
            $time_list = explode(":",$this->total_time);
            $this->hour = $time_list[0];
            $this->minute = $time_list[1];
            $this->second = $time_list[2];
    		return true;
        }
        else{
            $this->error_number = 2;
            $this->error_description="Contact administrator to get its details";
            return false;
        }
	
    }

    function get_quiz_name()
    {
        $strSQL = "SELECT name FROM quizzes  WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            $this->name = mysql_result($rsRES,0,'name');
            return $this->name;   
        }
        else{
            return false;
        }

    }

    function get_quiz_type()
    {
        $strSQL = "SELECT quiz_type_id FROM quizzes  WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            $this->quiz_type_id = mysql_result($rsRES,0,'quiz_type_id');
    		 return $this->quiz_type_id;   
    	}
    	else{
    		return false;
    	}
    }

    function get_list_array_bylimit($name = "", $quiz_type_id = gINVALID, $start_record = 0,$max_records = 25,$filter="",$orderby="")
    {

        $limited_data = array();
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT Q.*,EX.name as exam_name FROM quizzes Q";
        $strSQL .= " LEFT JOIN exams EX ON Q.exam_id = EX.id"; 
        if ($name != "" ) {
            if (trim($str_condition) =="") {
                $str_condition = " Q.name  LIKE '%" . $name . "%'" ;
            }else{
                $str_condition .= " AND Q.name  LIKE '%" . $name . "%'" ;
            } 
        }


        if ( $quiz_type_id != "" && $quiz_type_id != -1 ) {
            if (trim($str_condition) =="") {
                $str_condition = "  Q.quiz_type_id  = '" . $quiz_type_id . "'" ;
            }else{
                $str_condition .= " AND Q.quiz_type_id  = '" . $quiz_type_id . "'" ;
            } 
        }

        if ( $this->exam_id != "" && $this->exam_id != -1 ) {
            if (trim($str_condition) =="") {
                $str_condition = "  Q.exam_id  = '" . $this->exam_id . "'" ;
            }else{
                $str_condition .= " AND Q.exam_id  = '" . $this->exam_id . "'" ;
            } 
        }


        if ( $this->special_demo > gINVALID ) {
            if (trim($str_condition) =="") {
                $str_condition = "  Q.special_demo  = '" . $this->special_demo . "'" ;
            }else{
                $str_condition .= " AND Q.special_demo  = '" . $this->special_demo . "'" ;
            } 
        }
  

        if (trim($str_condition) !="") {
            $strSQL .= " WHERE  " . $str_condition . "  ";
        }

        if(trim($filter) != ""){
            $strSQL .= $filter;
        } 
        if(trim($orderby) != "")
        {
            $strSQL .= " ORDER BY Q.".$orderby;
        }
        else{
            $strSQL .= "ORDER BY Q.exam_id,Q.name";
        }
      // echo $strSQL;
        //taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
	
       $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){
            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
                
            } else {
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }

            while ( $row = mysql_fetch_assoc($rsRES) ){
                $limited_data[$i]["id"] = $row["id"];
                $limited_data[$i]["name"] = $row["name"];
                $limited_data[$i]["exam_id"] = $row["exam_id"];
                $limited_data[$i]["exam_name"] = $row["exam_name"];
                $limited_data[$i]["quiz_type_id"] = $row["quiz_type_id"];
				$limited_data[$i]["credit"] = $row["credit"];
                $i++;
            }
            return $limited_data;
        }else{
            $this->error_number = 5;
            $this->error_description="Can't get limited data";
            return false;
        }
    }


function get_list($name = "",$start_record = 0,$max_records = 25,$filter="",$orderby="")
    {

        $limited_data = array();
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT * FROM quizzes";
       
        if ($name != "" ) {
            if (trim($str_condition) =="") {
                $str_condition = " name  LIKE '%" . $name . "%'" ;
            }else{
                $str_condition .= " AND name  LIKE '%" . $name . "%'" ;
            } 
        }

        if ($this->organization_id != "" || $this->organization_id > 0) {
            if (trim($str_condition) =="") {
                $str_condition = " organization_id = '" . $this->organization_id . "'" ;
            }else{
                $str_condition .= " AND organization_id = '" . $this->organization_id . "'" ;
            } 
        }

        if (trim($str_condition) !="") {
            $strSQL .= " WHERE  " . $str_condition . "  ";
        }

       
            $strSQL .= " ORDER BY id";
       
       //echo $strSQL;
        //taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){
            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
                
            } else {
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }

            while ( $row = mysql_fetch_assoc($rsRES) ){
                $limited_data[$i]["id"] = $row["id"];
                $limited_data[$i]["name"] = $row["name"];
                $limited_data[$i]["exam_id"] = $row["exam_id"];
                $limited_data[$i]["organization_id"] = $row["organization_id"];
                $limited_data[$i]["quiz_type_id"] = $row["quiz_type_id"];
				$limited_data[$i]["credit"] = $row["credit"];
				$limited_data[$i]["description"] = $row["description"];
				$limited_data[$i]["total_time"]     = $row['total_time'];
                $limited_data[$i]["quiz_status_id"] = $row['quiz_status_id'];
                $limited_data[$i]["question_ids"]   = $row['question_ids'];
				$i++;
            }
            return $limited_data;
        }else{
            $this->error_number = 5;
            $this->error_description="Can't get limited data";
            return false;
        }
    }





	function validate()
	{
		# code...
	}

    function get_details_with_id($quiz_id)
    {
        $strSQL = "SELECT * FROM quizzes  WHERE id = '".$quiz_id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
        $data = array();
        if ( mysql_num_rows($rsRES) > 0 )
        {
            $data['id'] = mysql_result($rsRES,0,'id');
            $data['name'] = mysql_result($rsRES,0,'name');
            $data['exam_id ']= mysql_result($rsRES,0,'exam_id');
            $data['quiz_type_id ']= mysql_result($rsRES,0,'quiz_type_id');
            $data['total_time'] = mysql_result($rsRES,0,'total_time');
            $data['quiz_status_id'] = mysql_result($rsRES,0,'quiz_status_id');
            $data['question_ids'] = mysql_result($rsRES,0,'question_ids');
            $data['credit'] = mysql_result($rsRES,0,'credit');
            $data['organization_id'] = mysql_result($rsRES,0,'organization_id');
            $data['special_demo'] = mysql_result($rsRES,0,'special_demo');
            return $data;
        }
        else{
            $this->error_number = 2;
            $this->error_description="Contact administrator to get its details";
            return false;
        }

    }






}	

?>
