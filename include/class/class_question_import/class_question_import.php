<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Question_import {
    var $connection;
    var $id = gINVALID;
    var $exam_id = "";
	var $created = "";
    var $description = "" ; 
	var $csv_file = "";
	var $total_questions = "" ; 
	var $total_verified_questions = "";
	var $image_zipped_file =""; 
	var $organization_id="";
	 



    var $error = false;
    var $error_number = gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";


    function __construct()
    {

    }


	
function update(){

	if ( $this->id == "" || $this->id == gINVALID) {
	$date=date("Y/m/d H.i:s<br>", time());
  $strSQL = "INSERT INTO question_imports(exam_id,date,created,csv_file,image_zipped_file,description)VALUES('".$this->exam_id."','$date','".$this->created."','".$this->csv_file."','".$this->image_zipped_file."','".$this->description."')";
	 
	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return true;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't Perform import";
              return false;
          }  

} elseif($this->id > 0 ) {
	
		$strSQL = "UPDATE question_imports SET ";
	$str_condition = "";
	if($this->exam_id!=""){
		$str_condition .= (trim($str_condition)=="")?"exam_id ='".mysql_real_escape_string($this->exam_id)."'":", exam_id = '".mysql_real_escape_string($this->exam_id)."'";
	}
    if($this->description!=""){
		$str_condition .= (trim($str_condition)=="")?"description = '".mysql_real_escape_string($this->description)."'":", description = '".mysql_real_escape_string($this->description)."'";
	}
	
	}
	$strSQL .= $str_condition ." WHERE id = "."'".$this->id."'"; 
	mysql_query("SET NAMES utf8");
   	 $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this import";
                return false;
            }

}

function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT * FROM question_imports";
	if($this->created!=''|| $this->csv_file!='' || $this->organization_id!=''){
	$strSQL .= " WHERE 1";
	
	if($this->created!=''){
            $strSQL .= " AND created LIKE '%".addslashes(trim($this->created))."%'";
	}
	if($this->csv_file!=''){
		    $strSQL .= " AND csv_file LIKE '%".addslashes(trim($this->csv_file))."%'";
	}
	if( $this->organization_id!='' ){
		    $strSQL .= " AND organization_id= '".addslashes(trim($this->organization_id))."'";
	
	}
	         $strSQL .= " ORDER BY id";
	}
		//$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
				
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }



		    while ( $row = mysql_fetch_assoc($rsRES) ){
		          $limited_data[$i]["id"] = $row["id"];
		          $limited_data[$i]["created"] = $row["created"];
		          $limited_data[$i]["csv_file"] = $row["csv_file"];
			      $limited_data[$i]["description"] = $row["description"];
		          $i++;
		    }
			
        	return $limited_data;
			
        }
        else{
        	return false;
        }
    }





function delete(){
    if($this->id > 0 ) {
        $strSQL = " DELETE FROM question_imports WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't delete this Import";
            return  false;
        }
    }
}


function get_existence_in_main_db(){
$strcondition='';
$strSQL = "SELECT id from questions WHERE question_import_id='".$this->id."'";	
if($this->organization_id!=''){
$strcondition=" AND organization_id=".$this->organization_id;
}
if($strcondition!=''){
$strSQL.=$strcondition;
}
 $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
	return true;	
	}else{
	return false;	
	}
}


function get_count_questions(){
$i=0;
	$strcondition='';
$strSQL = "SELECT count(id) as total_questions from temp_questions WHERE question_import_id='".$this->id."'";
if($this->organization_id!=''){
$strcondition=" AND organization_id=".$this->organization_id;
}
if($strcondition!=''){
$strSQL.=$strcondition;
}
$rsRES = mysql_query($strSQL, $this->connection);

$this->total_questions=mysql_result($rsRES,0,'total_questions');
	$strcondition='';
$strSQL1 = "SELECT count(id) as total_verified_questions from temp_questions WHERE question_import_id='".$this->id."' AND question_status_id='".QUESTION_STATUS_ACTIVE."'";
if($this->organization_id!=''){
$strcondition=" AND organization_id=".$this->organization_id;
}
if($strcondition!=''){
$strSQL1.=$strcondition;
}
$rsRES1 = mysql_query($strSQL1, $this->connection);
$this->total_verified_questions=mysql_result($rsRES1,0,'total_verified_questions');

}

function get_detail(){
$strcondition='';
    $strSQL = "SELECT created,csv_file,date,description from question_imports WHERE id = '".$this->id."'";
	if($this->organization_id!=''){
	$strcondition=" AND organization_id=".$this->organization_id;
	}
	if($strcondition!=''){
	$strSQL.=$strcondition;
	}
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
       
       	$this->created = mysql_result($rsRES,0,'created');
		$this->csv_file = mysql_result($rsRES,0,'csv_file');
		$this->date = mysql_result($rsRES,0,'date');
		$this->description = mysql_result($rsRES,0,'description');
		
}
}

}
?>

