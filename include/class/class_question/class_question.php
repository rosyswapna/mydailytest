
<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Question {
    var $connection;
    var $id = gINVALID;
    var $question = "";
	var $exam_id = "";
	var $subject_id = "";
	var $section_id = "";
	var $difficulty_level_id = "";
	var $language_id = "";
	var $updated="";
    var $image = "";
    var $options = "";
    var $answers = "";
    var $answer_keys = "";
	var $question_import_id = "";
	var $option_images = "";
	var $question_status_id = "";
	var $organization_id = "";
	var $question_type_id = "";
	var $share = "";
	var $question_group_id = "";
	var $question_group_key = "";
	var $import_slno = "" ;
	var $total_questions="";

    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";
	
function set_defaults(){
		
	 $this->question = "";
	 $this->exam_id = gINVALID;
	 $this->subject_id = gINVALID;
	 $this->section_id = gINVALID;
	 $this->difficulty_level_id = gINVALID;
	 $this->language_id = gINVALID;
	 $this->image = "";
	 $this->options = "";
	 $this->answers = "";
	 $this->answer_keys = "";
	 $this->question_import_id = gINVALID;
	 $this->option_images = "";
	 $this->question_status_id = gINVALID;
	 $this->organization_id = gINVALID;
	 $this->question_type_id = gINVALID;
	 $this->share = FB_SHARE_ALLOWED;
	 $this->question_group_id = gINVALID;
	 $this->import_slno = "" ;
}

function get_id(){
    $strSQL = "SELECT * FROM questions  WHERE question = '".$this->question."'";
	mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->question = mysql_result($rsRES,0,'question');
		$this->exam_id = mysql_result($rsRES,0,'exam_id');
		$this->subject_id = mysql_result($rsRES,0,'subject_id');
		$this->section_id = mysql_result($rsRES,0,'section_id');
		$this->difficulty_level_id = mysql_result($rsRES,0,'difficulty_level_id');
		$this->language_id = mysql_result($rsRES,0,'language_id');
        $this->image = mysql_result($rsRES,0,'image');
        $this->options = mysql_result($rsRES,0,'options');
        $this->answers = mysql_result($rsRES,0,'answers');
        $this->answer_keys = mysql_result($rsRES,0,'answer_keys');
		$this->question_import_id = mysql_result($rsRES,0,'question_import_id');
		$this->option_images = mysql_result($rsRES,0,'option_images');
		$this->question_status_id = mysql_result($rsRES,0,'question_status_id');
		$this->organization_id = mysql_result($rsRES,0,'organization_id');
		$this->question_type_id = mysql_result($rsRES,0,'question_type_id');
		$this->share = mysql_result($rsRES,0,'share');
		$this->question_group_id = mysql_result($rsRES,0,'question_group_id');
		$this->import_slno = mysql_result($rsRES,0,'import_slno');
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This Question doesn't exist";
        return false;
    }
}

function get_detail(){
	$strcondition='';
    $strSQL = "SELECT * FROM questions  WHERE id = '".$this->id."'";
	if(isset($this->organization_id)&&$this->organization_id!=gINVALID && $this->organization_id!=''){
	$strcondition=" AND organization_id='".$this->organization_id."'";
	}
	if($strcondition!=''){
	 $strSQL= $strSQL.$strcondition;	
	}
	mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){

        $this->id = mysql_result($rsRES,0,'id');
        $this->question = mysql_result($rsRES,0,'question');
		$this->exam_id = mysql_result($rsRES,0,'exam_id');
		$this->subject_id = mysql_result($rsRES,0,'subject_id');
		$this->section_id = mysql_result($rsRES,0,'section_id');
		$this->difficulty_level_id = mysql_result($rsRES,0,'difficulty_level_id');
		$this->language_id = mysql_result($rsRES,0,'language_id');
        $this->image = mysql_result($rsRES,0,'image');
        $this->options = mysql_result($rsRES,0,'options');
        $this->answers = mysql_result($rsRES,0,'answers');
        $this->answer_keys = mysql_result($rsRES,0,'answer_keys');
		$this->question_import_id = mysql_result($rsRES,0,'question_import_id');
		$this->option_images = mysql_result($rsRES,0,'option_images');
		$this->question_status_id = mysql_result($rsRES,0,'question_status_id');
		$this->organization_id = mysql_result($rsRES,0,'organization_id');
		$this->question_type_id = mysql_result($rsRES,0,'question_type_id');
		$this->share = mysql_result($rsRES,0,'share');
		$this->question_group_id = mysql_result($rsRES,0,'question_group_id');
		$this->question_group_key = mysql_result($rsRES,0,'question_group_key');
		$this->import_slno = mysql_result($rsRES,0,'import_slno');

        $questions = array();
		$index=0;
        $questions[$index]["id"] =  $this->id;
        $questions[$index]["question"] = $this->question;
		$questions[$index]["exam_id"] = $this->exam_id;
		$questions[$index]["subject_id"] = $this->subject_id;
		$questions[$index]["section_id"] = $this->section_id;
		$questions[$index]["difficulty_level_id"] = $this->difficulty_level_id;
		$questions[$index]["language_id"] = $this->language_id;
        $questions[$index]["image"] = $this->image;
        $questions[$index]["options"] = $this->options;
        $questions[$index]["answers"] = $this->answers;
        $questions[$index]["answer_keys"] = $this->answer_keys;
		$questions[$index]["question_import_id"] = $this->question_import_id;
		$questions[$index]["option_images"] = $this->option_images;
		$questions[$index]["question_status_id"] = $this->question_status_id;
		$questions[$index]["organization_id"] = $this->organization_id;
		$questions[$index]["question_type_id"] = $this->question_type_id;
		$questions[$index]["share"] = $this->share;
		$questions[$index]["question_group_id"] = $this->question_group_id;
		$questions[$index]["import_slno"] = $this->import_slno;
        return $questions ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){

    if ( $this->id == "" || $this->id == gINVALID) {
		$strSQL = "INSERT INTO questions (question, exam_id, subject_id, section_id, difficulty_level_id, language_id,image,options, answers, answer_keys,question_import_id, option_images,question_status_id, organization_id, question_type_id, share, question_group_id,question_group_key,import_slno ) VALUES ('";
		$strSQL .= mysql_real_escape_string(trim($this->question))."','";
		$strSQL .= mysql_real_escape_string(trim($this->exam_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->subject_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->section_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->difficulty_level_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->language_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->image))."','";
		$strSQL .= mysql_real_escape_string(trim($this->options))."','";
		$strSQL .= mysql_real_escape_string(trim($this->answers))."','";
		$strSQL .= mysql_real_escape_string(trim($this->answer_keys))."','";
		$strSQL .= mysql_real_escape_string(trim($this->question_import_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->option_images))."','";
		$strSQL .= mysql_real_escape_string(trim($this->question_status_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->organization_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->question_type_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->share))."','";
		$strSQL .= mysql_real_escape_string(trim($this->question_group_id))."','";
		$strSQL .= mysql_real_escape_string(trim($this->question_group_key))."','";
		$strSQL .= mysql_real_escape_string(trim($this->import_slno))."')";
		
		mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

		if ( mysql_affected_rows($this->connection) > 0 ) {
		  $this->id = mysql_insert_id();
		  return true;
		}else{
		  $this->error_number = 3;
		  $this->error_description="Can't insert this Question";
		  return false;
		}

    }elseif($this->id > 0 ) {
    
	$strSQL = "UPDATE questions SET ";
	$str_condition = "";
	if($this->updated!=""){
		$str_condition .= (trim($str_condition)=="")?"updated = '".mysql_real_escape_string($this->updated)."'":", updated = '".mysql_real_escape_string($this->updated)."'";
	}
	if($this->question!=""){
		$str_condition .= (trim($str_condition)=="")?"question = '".mysql_real_escape_string($this->question)."'":", question = '".mysql_real_escape_string($this->question)."'";
	}
    if($this->exam_id!=""){
		$str_condition .= (trim($str_condition)=="")?"exam_id = '".mysql_real_escape_string($this->exam_id)."'":", exam_id = '".mysql_real_escape_string($this->exam_id)."'";
	}
	if($this->subject_id!=""){
		$str_condition .= (trim($str_condition)=="")? "subject_id = '".mysql_real_escape_string($this->subject_id)."'":", subject_id = '".mysql_real_escape_string($this->subject_id)."'";
	}
	if($this->section_id!=""){
		$str_condition .= (trim($str_condition)=="")? "section_id = '".mysql_real_escape_string($this->subject_id)."'":", section_id = '".mysql_real_escape_string($this->section_id)."'";
	}
	if($this->difficulty_level_id!=""){
		$str_condition .= (trim($str_condition)=="")? "difficulty_level_id = '".mysql_real_escape_string($this->difficulty_level_id)."'":", difficulty_level_id = '".mysql_real_escape_string($this->difficulty_level_id)."'";
	}
	if($this->language_id!=""){
		$str_condition .= (trim($str_condition)=="")? "language_id = '".mysql_real_escape_string($this->language_id)."'":", language_id = '".mysql_real_escape_string($this->language_id)."'";
	}
	if($this->image!=""){
		$str_condition .= (trim($str_condition)=="")? "image = '".mysql_real_escape_string($this->image)."'":", image = '".mysql_real_escape_string($this->image)."'";
	}
	if($this->options!=""){
   		$str_condition .= (trim($str_condition)=="")? "options = '".mysql_real_escape_string($this->options)."'":", options = '".mysql_real_escape_string($this->options)."'";
	}
	if($this->answers!=""){
  		$str_condition .= (trim($str_condition)=="")? "answers = '".mysql_real_escape_string($this->answers)."'": ", answers = '".mysql_real_escape_string($this->answers)."'";
	}
	if($this->answer_keys!=""){
	if($this->answer_keys==gINVALID){
		$this->answer_keys="";
	}
  		$str_condition .= (trim($str_condition)=="")? "answer_keys = '".mysql_real_escape_string($this->answer_keys)."'": ", answer_keys = '".mysql_real_escape_string($this->answer_keys)."'";
	}
	if($this->question_import_id!=""){
  		$str_condition .= (trim($str_condition)=="")? "question_import_id = '".mysql_real_escape_string($this->question_import_id)."'": ", question_import_id = '".mysql_real_escape_string($this->question_import_id)."'";
	}
	if($this->option_images!=""){
   		$str_condition .= (trim($str_condition)=="")? "option_images = '".mysql_real_escape_string($this->option_images)."'":", option_images = '".mysql_real_escape_string($this->option_images)."'";
	}
	if($this->question_status_id!=""){
		$str_condition .= (trim($str_condition)=="")? "question_status_id = '".mysql_real_escape_string($this->question_status_id)."'":", question_status_id = '".mysql_real_escape_string($this->question_status_id)."'";
	}
	if($this->organization_id!=""){
  		$str_condition .= (trim($str_condition)=="")? "organization_id = '".mysql_real_escape_string($this->organization_id)."'": ", organization_id = '".mysql_real_escape_string($this->organization_id)."'";
	}
	if($this->question_type_id!=""){
  		$str_condition .= (trim($str_condition)=="")? "question_type_id = '".mysql_real_escape_string($this->question_type_id)."'": ", question_type_id = '".mysql_real_escape_string($this->question_type_id)."'";
	}
	if($this->share!=""){
  		$str_condition .= (trim($str_condition)=="")? "share = '".mysql_real_escape_string($this->share)."'": ", share = '".mysql_real_escape_string($this->share)."'";
	}
	if($this->question_group_id!=""){
  		$str_condition .= (trim($str_condition)=="")? "question_group_id = '".mysql_real_escape_string($this->question_group_id)."'": ", question_group_id = '".mysql_real_escape_string($this->question_group_id)."'";
	}
	if($this->question_group_key!=""){
  		$str_condition .= (trim($str_condition)=="")? "question_group_key = '".mysql_real_escape_string($this->question_group_key)."'": ", question_group_key = '".mysql_real_escape_string($this->question_group_key)."'";
	}
	
	if($this->import_slno!=""){
	$str_condition .= (trim($str_condition)=="")? "import_slno = '".mysql_real_escape_string($this->import_slno)."'":", import_slno = '".mysql_real_escape_string($this->import_slno)."'";
	}
	
	 
  	  $strSQL .= $str_condition ." WHERE id = ".$this->id;  
		mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

		if ( mysql_affected_rows($this->connection) >= 0 ) {
			    return true;
		}else{
			$this->error_number = 3;
			$this->error_description="Can't update this Question";
			return false;
		}

	}

}




function delete(){
	$strSQL = "DELETE FROM questions WHERE id =".$this->id;
	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_affected_rows($this->connection) > 0 ) {
			    return true;
		}
		else{
			$this->error_description = "Can't Delete This Question";
			return false;
		}
}


function update_question_status_id(){
	$strSQL = "UPDATE  questions SET  question_status_id =  '".QUESTION_STATUS_INACTIVE."' WHERE  id =".$this->id;
	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_affected_rows($this->connection) > 0 ) {
			    return true;
		}
		else{
			$this->error_description = "Can't Update This Question";
			return false;
		}
}

function get_list_array($question_ids = "", $orderby = ""){
  
        $strSQL = "SELECT * FROM questions";
        if(trim($question_ids)!= "")
        {
        	$strSQL .= " WHERE id IN (".$question_ids.")";
        }
        if($orderby != ""){
        	$strSQL .= "ORDER BY ".$orderby;
        }
		mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
 	        $data = array(); 
       		$index=0;
			while ($row = mysql_fetch_assoc($rsRES)){
				$data[$index]["id"] = $row["id"];
				$data[$index]["question"] = $row["question"];
				$data[$index]["exam_id"] = $row["exam_id"];
				$data[$index]["subject_id"] = $row["subject_id"];
				$data[$index]["section_id"] = $row["section_id"];
				$data[$index]["difficulty_level_id"] = $row["difficulty_level_id"];
				$data[$index]["language_id"] = $row["language_id"];
				$data[$index]["image"] = $row["image"];
				$data[$index]["options"] = $row["options"];
				$data[$index]["answers"] = $row["answers"];
				$data[$index]["answer_keys"] = $row["answer_keys"];
				$data[$index]["question_import_id"] = $row["question_import_id"];
				$data[$index]["option_images"] = $row["option_images"];
				$data[$index]["question_status_id"] = $row["question_status_id"];
				$data[$index]["organization_id"] = $row["organization_id"];
				$data[$index]["question_type_id"] = $row["question_type_id"];
				$data[$index]["share"] = $row["share"];
				$data[$index]["question_group_id"] = $row["question_group_id"];
				$data[$index]["import_slno"] = $row["import_slno"];
				$index++;
			}
		
            return $data;
        }else{
		    $this->error_number = 4;
		    $this->error_description="Can't list questions";
		    return false;
        }
}




function get_list_array_bylimit($quiz_ids="", $start_record = 0,$max_records = 25){


        $str_condition = "";

        $strSQL = "SELECT * FROM questions Q WHERE 1";
		
		if ($quiz_ids != "" ) {
            $str_condition = " AND Q.id  IN ( " . $quiz_ids . ") " ;
        }
		if ($this->id != -1) { 
			$str_condition .= " AND Q.id  = '".mysql_real_escape_string($this->id)."'";  
		}
		
		if($this->question != ""){
		   $str_condition .= " AND Q.question LIKE '%".mysql_real_escape_string(trim($this->question))."%'";
		}

		if ($this->exam_id != "") { 
			$str_condition .= " AND Q.exam_id  = '".mysql_real_escape_string($this->exam_id)."'";  
		}
		
		if($this->question_status_id != ""  ){
			$str_condition .= " AND Q.question_status_id = '".mysql_real_escape_string($this->question_status_id)."'";
		}

		if($this->difficulty_level_id != ""  ){
			$str_condition .= " AND Q.difficulty_level_id = '".mysql_real_escape_string($this->difficulty_level_id)."'";
		}
		   
	   
		if ($this->subject_id != "" ) { 
			$str_condition .= " AND Q.subject_id = '".mysql_real_escape_string($this->subject_id)."'";  
		}
		
		if ($this->section_id != "" ) { 
			$str_condition .= " AND Q.section_id = '".mysql_real_escape_string($this->section_id)."'";  
		}
		if ($this->share != "" ) { 
			$str_condition .= " AND Q.share = '".mysql_real_escape_string($this->share)."'";  
		}
	   if ($this->organization_id != "" ) { 
			$str_condition .= " AND Q.organization_id = '".mysql_real_escape_string($this->organization_id)."'";  
		}

        if (trim($str_condition) !="") {
            $strSQL .=  $str_condition . "  ORDER BY Q.id ";
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
				$limited_data[$index]["question"] = $row["question"];
				$limited_data[$index]["exam_id"] = $row["exam_id"];
				$limited_data[$index]["subject_id"] = $row["subject_id"];
				$limited_data[$index]["section_id"] = $row["section_id"];
				$limited_data[$index]["difficulty_level_id"] = $row["difficulty_level_id"];
				$limited_data[$index]["language_id"] = $row["language_id"];
				$limited_data[$index]["image"] = $row["image"];
				$limited_data[$index]["options"] = $row["options"];
				$limited_data[$index]["answers"] = $row["answers"];
				$limited_data[$index]["answer_keys"] = $row["answer_keys"];
				$limited_data[$index]["question_import_id"] = $row["question_import_id"];
				$limited_data[$index]["option_images"] = $row["option_images"];
				$limited_data[$index]["question_status_id"] = $row["question_status_id"];
				$limited_data[$index]["organization_id"] = $row["organization_id"];
				$limited_data[$index]["question_type_id"] = $row["question_type_id"];
				$limited_data[$index]["share"] = $row["share"];
				$limited_data[$index]["question_group_id"] = $row["question_group_id"];
				$limited_data[$index]["import_slno"] = $row["import_slno"];
				$index++;
			}
		
            return $limited_data;
        }
        else{
            return false;
        }
    }



function get_count_questions(){
$i=0;
$strcondition='';
$strSQL = "SELECT count(id) as total_questions from questions WHERE question_import_id='".$this->question_import_id."'";
if($this->organization_id!=''){
$strcondition=" AND organization_id=".$this->organization_id;
}
if($strcondition!=''){
$strSQL.=$strcondition;
}
$rsRES = mysql_query($strSQL, $this->connection);

$this->total_questions=mysql_result($rsRES,0,'total_questions');

}


function delete_by_import_id(){
        $strSQL = "SELECT Q.id FROM questions Q,user_test_details UTD WHERE Q.id=UTD.question_id AND Q.question_import_id =".$this->question_import_id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
           if(mysql_num_rows($rsRES)>0){ 
		$this->error_description = "Questions Can't be Delete,Since They are Already Used in Quizzes";
                return false;
	
	}
	else{
	    $strSQL = "DELETE FROM questions WHERE question_import_id =".$this->question_import_id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
   	 if ( mysql_affected_rows($this->connection) > 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Can't Delete  Questions";
                return false;
            }
	}
    }
	
function get_exam_count(){
	
		$i=0;
		$strSQL = "SELECT count(*) as exam_count from questions WHERE exam_id='".$this->exam_id."'";
		print_r($strSQL);
		$rsRES = mysql_query($strSQL, $this->connection);
		$this->exam_count=mysql_result($rsRES,0,'exam_count');

	}


function get_option_images(){

		$strSQL = "SELECT option_images from questions WHERE id='".$this->id."'";
		$rsRES = mysql_query($strSQL, $this->connection);
		$option_image=mysql_result($rsRES,0,'option_images');
		return $option_image;

}

function get_details_by_group_id(){

$strSQL = "SELECT * FROM questions WHERE question_group_id='".$this->question_group_id."'  ORDER BY id";
		
        
		mysql_query("SET NAMES utf8");
       $rsRES = mysql_query($strSQL, $this->connection);

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
				$limited_data[$index]["question"] = $row["question"];
				$limited_data[$index]["exam_id"] = $row["exam_id"];
				$limited_data[$index]["subject_id"] = $row["subject_id"];
				$limited_data[$index]["section_id"] = $row["section_id"];
				$limited_data[$index]["difficulty_level_id"] = $row["difficulty_level_id"];
				$limited_data[$index]["language_id"] = $row["language_id"];
				$limited_data[$index]["image"] = $row["image"];
				$limited_data[$index]["options"] = $row["options"];
				$limited_data[$index]["answers"] = $row["answers"];
				$limited_data[$index]["answer_keys"] = $row["answer_keys"];
				$limited_data[$index]["question_import_id"] = $row["question_import_id"];
				$limited_data[$index]["option_images"] = $row["option_images"];
				$limited_data[$index]["question_status_id"] = $row["question_status_id"];
				$limited_data[$index]["organization_id"] = $row["organization_id"];
				$limited_data[$index]["question_type_id"] = $row["question_type_id"];
				$limited_data[$index]["share"] = $row["share"];
				$limited_data[$index]["question_group_id"] = $row["question_group_id"];
				$limited_data[$index]["import_slno"] = $row["import_slno"];
				$index++;
			}
		//print_r($limited_data);exit();
            return $limited_data;
        }
        else{
            return false;
        }


}

	//function for get question ids ,seperated with coma
	function get_question_ids($question_group_ids = "")
	{
		if($question_group_ids != ""){
			$strSQL = "SELECT id FROM questions WHERE question_group_id IN (".$question_group_ids.") ORDER BY question_group_id";
			$rsRES = mysql_query($strSQL, $this->connection);
			if( mysql_num_rows($rsRES) > 0 ){
				$question_ids = "";
				while($row = mysql_fetch_assoc($rsRES))
				{
					$question_ids .= $row['id'].",";
				}
				return substr($question_ids, 0, -1);
			}
			else{
				return false;
			}
		}else{
			return false;
		}

	}



}
?>
