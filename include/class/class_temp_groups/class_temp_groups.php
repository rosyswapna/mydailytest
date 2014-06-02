
<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Temp_groups {
	var $connection;
	var $id 			= gINVALID;
	var $passage		= "";
	
	var $exam_id		= "";
	
	var $subject_id 	= "";
	
	var $question_group_import_id="";
	var $slno="";
	var $section_id="";
	
	var $difficulty_level_id="";
	var $language_id="";
	var $image = "";
	var $question_group_key="";
	var $organization_id="";
	var $question_group_status_id="";

	

    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";


    function __construct()
    {

    }
	


function get_id(){
    $strSQL = "SELECT id, passage ";
    $strSQL .= "FROM temp_question_groups  WHERE passage = '".$this->passage."'";
	mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->passage = mysql_result($rsRES,0,'passage');
       
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This passage doesn't exist";
        return false;
    }
}

function get_detail(){
    $strSQL = "SELECT * FROM temp_question_groups  WHERE id = '".$this->id."'";
	mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->passage = mysql_result($rsRES,0,'passage');
		$this->image = mysql_result($rsRES,0,'image');
		$this->set_id = mysql_result($rsRES,0,'section_id');
		$this->exam_id = mysql_result($rsRES,0,'exam_id');
		$this->subject_id = mysql_result($rsRES,0,'subject_id');
		$this->difficulty_level_id = mysql_result($rsRES,0,'difficulty_level_id');
		$this->language_id = mysql_result($rsRES,0,'language_id');
		$this->question_group_status_id = mysql_result($rsRES,0,'question_group_status_id');
		$this->question_group_import_id = mysql_result($rsRES,0,'question_group_import_id');
		$this->slno = mysql_result($rsRES,0,'slno');
		

		$passage = array();$i=0;
		$passage[$i]["id"] =  $this->id;
		$passage[$i]["passage"] = $this->passage;
		$passage[$i]["image"] = $this->image;
		$passage[$i]["section_id"] = $this->set_id;
		$passage[$i]["exam_id"] = $this->exam_id;
		$passage[$i]["subject_id"] = $this->subject_id;
		$passage[$i]["difficulty_level_id"] = $this->difficulty_level_id;
		$passage[$i]["language_id"] = $this->language_id;
		$passage[$i]["question_group_status_id"] = $this->question_group_status_id;
		$passage[$i]["question_group_import_id"] = $this->question_group_import_id;
		$passage[$i]["slno"] = $this->slno;
		
		
		
        return $passage ;
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
       $strSQL = "INSERT INTO temp_question_groups(passage,exam_id,subject_id, section_id,difficulty_level_id,language_id,image, question_group_import_id,question_group_status_id,organization_id,question_group_key,slno) VALUES('".mysql_real_escape_string($this->passage)."','".mysql_real_escape_string($this->exam_id)."','".mysql_real_escape_string($this->subject_id)."','".mysql_real_escape_string($this->section_id)."','".mysql_real_escape_string($this->difficulty_level_id)."','".mysql_real_escape_string($this->language_id)."','".mysql_real_escape_string($this->image)."','".mysql_real_escape_string($this->question_group_import_id)."','".STATUS_INACTIVE."','".mysql_real_escape_string($this->organization_id)."','".mysql_real_escape_string($this->question_group_key)."','".mysql_real_escape_string($this->slno)."')";
	mysql_query("SET NAMES utf8");
	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
               return true;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this passage";
              return false;
          }
    
  } elseif($this->id > 0 ) {


	$strSQL = "UPDATE temp_question_groups SET ";
	$str_condition = "";
	if($this->passage!=""){
		$str_condition .= (trim($str_condition)=="")?"passage ='".mysql_real_escape_string($this->passage)."'":", passage = '".mysql_real_escape_string($this->passage)."'";
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
	if($this->question_group_status_id!=""){
		$str_condition .= (trim($str_condition)=="")? "question_group_status_id ='".mysql_real_escape_string($this->question_group_status_id)."'":", question_group_status_id = '".mysql_real_escape_string($this->question_group_status_id)."'";
	}
	
	
  	   $strSQL .= $str_condition ." WHERE id = "."'".$this->id."'"; 
	mysql_query("SET NAMES utf8");
   	 $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Passage";
                return false;
            }
		
	
    
}
}
function delete(){
        $strSQL = "DELETE FROM temp_question_groups WHERE id =".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) > 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Can't Delete This passage";
                return false;
            }
    }


function delete_by_import_id(){
        $strSQL = "DELETE FROM temp_question_groups WHERE question_group_import_id =".$this->question_group_import_id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) > 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Can't Delete  Passage";
                return false;
            }
    }


function get_list_array(){
        $cities = array();$i=0;

        $strSQL = "SELECT id , passage  FROM temp_question_groups";
		mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$passage) = mysql_fetch_row($rsRES) ){
                $passage[$i]["id"] =  $id;
                $passage[$i]["passage"] = $passage;
               
                $i++;
            }
            return $passage;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list passage";
        return false;
        }
}






function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id , passage,subject_id,exam_id,question_group_status_id,image,slno FROM temp_question_groups";
	$strSQL .= " WHERE question_group_import_id=".addslashes(trim($this->question_group_import_id));
	if($this->organization_id!=''){
           $strSQL .= " AND organization_id = '".addslashes(trim($this->organization_id))."'";
      	 }
   	if($this->passage!=''){
           $strSQL .= " AND passage LIKE '%".addslashes(trim($this->passage))."%'";
      	 }
        if ($this->subject_id!='') { 
       	$strSQL .= " AND subject_id = '".addslashes(trim($this->subject_id))."'";  
        }
	 if ($this->exam_id!='') { 
        $strSQL .= " AND exam_id = '".addslashes(trim($this->exam_id))."'";  
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


			
            while ( list ($id,$passage,$subject_id,$exam_id,$question_group_status_id,$image,$slno) = mysql_fetch_row($rsRES) ){
                $limited_data[$i]["id"] = $id;
               	$limited_data[$i]["passage"] = $passage;
                $limited_data[$i]["subject_id"] = $subject_id;
				$limited_data[$i]["exam_id"] = $exam_id;
				$limited_data[$i]["question_group_status_id"] = $question_group_status_id;
                $limited_data[$i]["image"] = $image;
				$limited_data[$i]["slno"] = $slno;
                $i++;
            }
		
            return $limited_data;
        }
        else{
            return false;
        }
    }


function get_all_verified_passages(){
$limited_data="";
$strSQL = "SELECT * FROM  temp_question_groups WHERE question_group_import_id='".$this->question_group_import_id."' AND question_group_status_id='".STATUS_ACTIVE."' ORDER BY RAND()";
	mysql_query("SET NAMES utf8");
$rsRES = mysql_query($strSQL, $this->connection);
$i=0;
while( $i < mysql_num_rows($rsRES)){
        $limited_data[$i]["id"] = mysql_result($rsRES,$i,'id');
        $limited_data[$i]["passage"] = mysql_result($rsRES,$i,'passage');
		$limited_data[$i]["image"] = mysql_result($rsRES,$i,'image');
		$limited_data[$i]["subject_id"] = mysql_result($rsRES,$i,'subject_id');
		$limited_data[$i]["exam_id"] = mysql_result($rsRES,$i,'exam_id');
		$limited_data[$i]["slno"] = mysql_result($rsRES,$i,'slno');
		$limited_data[$i]["organization_id"] = mysql_result($rsRES,$i,'organization_id');
		$limited_data[$i]["question_group_status_id"] = mysql_result($rsRES,$i,'question_group_status_id');
		$limited_data[$i]["question_group_import_id"] = mysql_result($rsRES,$i,'question_group_import_id');
		$limited_data[$i]["section_id"] = mysql_result($rsRES,$i,'section_id');
		$limited_data[$i]["difficulty_level_id"] = mysql_result($rsRES,$i,'difficulty_level_id');
		$limited_data[$i]["question_group_key"] = mysql_result($rsRES,$i,'question_group_key');
		$limited_data[$i]["language_id"] = mysql_result($rsRES,$i,'language_id');
		$i++;
	}
	return $limited_data; 

}

function organization_existence(){
$strSQL = "SELECT id  FROM temp_question_groups where question_group_import_id='".$this->question_group_import_id."' AND organization_id='".$this->organization_id."'";
		mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		 if ( mysql_num_rows($rsRES) > 0 ){
		return true;
		}else{
		return false;
}
}



}
?>
