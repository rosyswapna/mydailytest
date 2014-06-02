
<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Temp_question {
	var $connection;
	var $id 			= gINVALID;
	var $question		= "";
	var $options	= "";
	var $exam_id		= "";
	var $answer_keys ="";
	var $answers		= "";
	var $subject_id 	= "";
	var $answer_string="";
	var $question_import_id="";
	var $slno="";
	var $section_id="";
	
	var $difficulty_level_id="";
	var $language_id="";
	var $image = "";
	var $group_key="";
	var $organization_id="";
	var $question_status_id="";
	var $share="";

    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";


    function __construct()
    {

    }
	


function get_id(){
    $strSQL = "SELECT id, question, options, answer ";
    $strSQL .= "FROM temp_questions  WHERE question = '".$this->question."'";
	mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->question = mysql_result($rsRES,0,'question');
        $this->options = mysql_result($rsRES,0,'options');
        $this->answer = mysql_result($rsRES,0,'answer');
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This Question doesn't exist";
        return false;
    }
}

function get_detail(){
    $strSQL = "SELECT * FROM temp_questions  WHERE id = '".$this->id."'";
	mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->question = mysql_result($rsRES,0,'question');
		$this->set_id = mysql_result($rsRES,0,'section_id');
		$this->exam_id = mysql_result($rsRES,0,'exam_id');
		$this->subject_id = mysql_result($rsRES,0,'subject_id');
		$this->difficulty_level_id = mysql_result($rsRES,0,'difficulty_level_id');
		$this->language_id = mysql_result($rsRES,0,'language_id');
		$this->options = mysql_result($rsRES,0,'options');
		$this->answers = mysql_result($rsRES,0,'answers');
		$this->question_status_id = mysql_result($rsRES,0,'question_status_id');
		$this->question_import_id = mysql_result($rsRES,0,'question_import_id');
		$this->share = mysql_result($rsRES,0,'share');
		$this->slno = mysql_result($rsRES,0,'slno');
		$this->answer_keys = mysql_result($rsRES,0,'answer_keys');
		$this->option_images = mysql_result($rsRES,0,'option_images');

		$questions = array();$i=0;
		$questions[$i]["id"] =  $this->id;
		$questions[$i]["question"] = $this->question;
		$questions[$i]["section_id"] = $this->set_id;
		$questions[$i]["exam_id"] = $this->exam_id;
		$questions[$i]["subject_id"] = $this->subject_id;
		$questions[$i]["difficulty_level_id"] = $this->difficulty_level_id;
		$questions[$i]["language_id"] = $this->language_id;
		$questions[$i]["options"] = $this->options;
		$questions[$i]["answers"] = $this->answers;
		$questions[$i]["question_status_id"] = $this->question_status_id;
		$questions[$i]["share"] = $this->share;
		$questions[$i]["answer_keys"] = $this->answer_keys;
		$questions[$i]["slno"] = $this->slno;
		$questions[$i]["option_images"] = $this->option_images;
		$questions[$i]["question_import_id"] = $this->question_import_id;
		
		
		
        return $questions ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
	if ($this->exam_id==""){
		$this->exam_id=gINVALID;
	}
	if ($this->organization_id==""){
		$this->organization_id=gINVALID;
	}
	if ($this->subject_id==""){
		$this->subject_id=gINVALID;
	}
	if ($this->section_id==""){
		$this->section_id=gINVALID;
	}
	if ($this->difficulty_level_id==""){
		$this->difficulty_level_id=gINVALID;
	}
	if ($this->language_id==""){
		$this->language_id=gINVALID;
	}
       $strSQL = "INSERT INTO temp_questions(question,exam_id,subject_id, section_id,difficulty_level_id,language_id,image, options,answers,answer_keys,question_import_id,option_images,question_status_id,organization_id,question_type_id,share,question_group_key,slno) VALUES('".mysql_real_escape_string($this->question)."','".mysql_real_escape_string($this->exam_id)."','".mysql_real_escape_string($this->subject_id)."','".mysql_real_escape_string($this->section_id)."','".mysql_real_escape_string($this->difficulty_level_id)."','".mysql_real_escape_string($this->language_id)."','".mysql_real_escape_string($this->image)."','".mysql_real_escape_string($this->options)."','".mysql_real_escape_string($this->answers)."','".mysql_real_escape_string($this->answer_keys)."','".mysql_real_escape_string($this->question_import_id)."','".mysql_real_escape_string($this->option_images)."','".QUESTION_STATUS_INACTIVE."','".mysql_real_escape_string($this->organization_id)."','".mysql_real_escape_string($this->question_type_id)."','','".mysql_real_escape_string($this->group_key)."','".mysql_real_escape_string($this->slno)."')";
	mysql_query("SET NAMES utf8");
	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
               return true;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this Question";
              return false;
          }
    
  } elseif($this->id > 0 ) {


	$strSQL = "UPDATE temp_questions SET ";
	$str_condition = "";
	if($this->question!=""){
		$str_condition .= (trim($str_condition)=="")?"question ='".mysql_real_escape_string($this->question)."'":", question = '".mysql_real_escape_string($this->question)."'";
	}
    if($this->exam_id!=""){
		$str_condition .= (trim($str_condition)=="")?"exam_id = '".mysql_real_escape_string($this->exam_id)."'":", exam_id = '".mysql_real_escape_string($this->exam_id)."'";
	}
	if($this->subject_id!=""){
		$str_condition .= (trim($str_condition)=="")? "subject_id = '".mysql_real_escape_string($this->subject_id)."'":", subject_id = '".mysql_real_escape_string($this->subject_id)."'";
	}
	if($this->difficulty_level_id!=""){
		$str_condition .= (trim($str_condition)=="")? "difficulty_level_id = '".mysql_real_escape_string($this->difficulty_level_id)."'":", difficulty_level_id = '".mysql_real_escape_string($this->difficulty_level_id)."'";
	}
	if($this->language_id!=""){
		$str_condition .= (trim($str_condition)=="")? "language_id = '".mysql_real_escape_string($this->language_id)."'":", language_id = '".mysql_real_escape_string($this->language_id)."'";
	}
	if($this->question_status_id!=""){
		$str_condition .= (trim($str_condition)=="")? "question_status_id ='".mysql_real_escape_string($this->question_status_id)."'":", question_status_id = '".mysql_real_escape_string($this->question_status_id)."'";
	}
	if($this->options!=""){
   		$str_condition .= (trim($str_condition)=="")? "options = '".mysql_real_escape_string($this->options)."'":", options = '".mysql_real_escape_string($this->options)."'";
	}
	if($this->share!=""){
	$str_condition .= (trim($str_condition)=="")? "share = '".mysql_real_escape_string($this->share)."'":", share = '".mysql_real_escape_string($this->share)."'";
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
	if($this->question_type_id!=""){
	$str_condition .= (trim($str_condition)=="")? "question_type_id = '".mysql_real_escape_string($this->question_type_id)."'":", question_type_id = '".mysql_real_escape_string($this->question_type_id)."'";
	}
	 
  	   $strSQL .= $str_condition ." WHERE id = "."'".$this->id."'";
	mysql_query("SET NAMES utf8");
   	 $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Question";
                return false;
            }
		
	
    
}
}
function delete(){
        $strSQL = "DELETE FROM temp_questions WHERE id =".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) > 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Can't Delete This Question";
                return false;
            }
    }


function delete_by_import_id(){
        $strSQL = "DELETE FROM temp_questions WHERE question_import_id =".$this->question_import_id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) > 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Can't Delete  Questions";
                return false;
            }
    }


function get_list_array(){
        $cities = array();$i=0;

        $strSQL = "SELECT id , question, options, answer FROM questions";
		mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$question,$options, $answer, $examination, $subject) = mysql_fetch_row($rsRES) ){
                $questions[$i]["id"] =  $id;
                $questions[$i]["question"] = $question;
                $questions[$i]["options"] = $options;
                $questions[$i]["answer"] = $answer;
                $i++;
            }
            return $questions;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list questions";
        return false;
        }
}

function organization_existence(){
$strSQL = "SELECT id  FROM temp_questions where question_import_id='".$this->question_import_id."' AND organization_id='".$this->organization_id."'";
		mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		 if ( mysql_num_rows($rsRES) > 0 ){
		return true;
		}else{
		return false;
}
}




function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id , question, options, answers,answer_keys,subject_id,exam_id,question_status_id,slno,option_images,image FROM temp_questions";
	$strSQL .= " WHERE question_import_id=".addslashes(trim($this->question_import_id));
   	if($this->question!=''){
           $strSQL .= " AND question LIKE '%".addslashes(trim($this->question))."%'";
      	 }
        if ($this->subject_id!='') { 
       	$strSQL .= " AND subject_id LIKE '".addslashes(trim($this->subject_id))."%'";  
        }
		if ($this->organization_id!='') { 
       	$strSQL .= " AND organization_id LIKE '".addslashes(trim($this->organization_id))."%'";  
        }
	 if ($this->exam_id!='') { 
        $strSQL .= " AND exam_id LIKE '".addslashes(trim($this->exam_id))."%'";  
        }
	$strSQL .= " ORDER BY id";
		//echo $strSQL;
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


			
            while ( list ($id,$question,$options,$answers,$answer_keys,$subject_id,$exam_id,$question_status_id,$slno,$option_images,$image) = mysql_fetch_row($rsRES) ){
                  $limited_data[$i]["id"] = $id;
               $limited_data[$i]["question"] = $question;
                 $limited_data[$i]["options"] = $options;
                $limited_data[$i]["answers"] = $answers;
		$limited_data[$i]["answer_keys"] = $answer_keys;
		  $limited_data[$i]["subject_id"] = $subject_id;
		$limited_data[$i]["exam_id"] = $exam_id;
		$limited_data[$i]["question_status_id"] = $question_status_id;
		$limited_data[$i]["slno"] = $slno;
		$limited_data[$i]["option_images"] = $option_images;
		$limited_data[$i]["image"] = $image;
                $i++;
            }
		
            return $limited_data;
        }
        else{
            return false;
        }
    }


function get_all_verified_questions(){
$limited_data="";
$strcondition='';
$strSQL = "SELECT * FROM temp_questions WHERE question_import_id='".$this->question_import_id."' AND question_status_id='"
.QUESTION_STATUS_ACTIVE."'";
if($this->organization_id!='' && $this->organization_id!=gINVALID){
$strcondition=" AND organization_id=".$this->organization_id;
}
if($strcondition!=''){
$strSQL.=$strcondition;
}
$strSQL.= " ORDER BY RAND()"; 
	mysql_query("SET NAMES utf8");
$rsRES = mysql_query($strSQL, $this->connection);
$i=0;
while( $i < mysql_num_rows($rsRES)){
        $limited_data[$i]["id"] = mysql_result($rsRES,$i,'id');
        $limited_data[$i]["question"] = mysql_result($rsRES,$i,'question');
		$limited_data[$i]["options"] = mysql_result($rsRES,$i,'options');
		$limited_data[$i]["answers"] = mysql_result($rsRES,$i,'answers');
		$limited_data[$i]["answer_keys"] = mysql_result($rsRES,$i,'answer_keys');
		$limited_data[$i]["subject_id"] = mysql_result($rsRES,$i,'subject_id');
		$limited_data[$i]["exam_id"] = mysql_result($rsRES,$i,'exam_id');
		$limited_data[$i]["slno"] = mysql_result($rsRES,$i,'slno');
		$limited_data[$i]["question_type_id"] = mysql_result($rsRES,$i,'question_type_id');
		$limited_data[$i]["question_status_id"] = mysql_result($rsRES,$i,'question_status_id');
		$limited_data[$i]["organization_id"] = mysql_result($rsRES,$i,'organization_id');
		$limited_data[$i]["question_import_id"] = mysql_result($rsRES,$i,'question_import_id');
		$limited_data[$i]["section_id"] = mysql_result($rsRES,$i,'section_id');
		$limited_data[$i]["option_images"] = mysql_result($rsRES,$i,'option_images');
		$limited_data[$i]["image"] = mysql_result($rsRES,$i,'image');
		$limited_data[$i]["difficulty_level_id"] = mysql_result($rsRES,$i,'difficulty_level_id');
		$limited_data[$i]["question_group_key"] = mysql_result($rsRES,$i,'question_group_key');
		$limited_data[$i]["language_id"] = mysql_result($rsRES,$i,'language_id');
		$i++;
	}
	return $limited_data; 

}





}
?>
