<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Groups_import {
    var $connection;
    var $id = gINVALID;
    var $exam_id = "";
	var $created = "";
    var $description = "" ; 
	var $csv_file = "";
	var $total_passages = "" ; 
	var $total_verified_passage = "";
	var $date="";
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
	$date=date("Y/m/d H.i:s<br>", time());
  $strSQL = "INSERT INTO question_group_imports(exam_id,date,created,csv_file,image_zipped_file,description,organization_id)VALUES('".$this->exam_id."','$date','".$this->created."','".$this->csv_file."','','".$this->description."','".$this->organization_id."')";
	 
	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return true;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't Perform import";
              return false;
          }  

}




function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT * FROM question_group_imports";
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
        $strSQL = " DELETE FROM question_group_imports WHERE id = '".$this->id."'";
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
$strSQL = "SELECT id from question_groups WHERE question_group_import_id='".$this->id."'";	
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


function get_count_passages(){
$i=0;
	$strcondition='';
$strSQL = "SELECT count(id) as total_passages from  temp_question_groups WHERE question_group_import_id='".$this->id."'";
if($this->organization_id!=''){
$strcondition=" AND organization_id=".$this->organization_id;
}
if($strcondition!=''){
$strSQL.=$strcondition;
}
$rsRES = mysql_query($strSQL, $this->connection);

$this->total_passages=mysql_result($rsRES,0,'total_passages');
	$strcondition='';
$strSQL1 = "SELECT count(id) as total_verified_passage from temp_question_groups WHERE question_group_import_id='".$this->id."' AND question_group_status_id='".STATUS_ACTIVE."'";
if($this->organization_id!=''){
$strcondition=" AND organization_id=".$this->organization_id;
}
if($strcondition!=''){
$strSQL1.=$strcondition;
}
$rsRES1 = mysql_query($strSQL1, $this->connection);

$this->total_verified_passage=mysql_result($rsRES1,0,'total_verified_passage');

}

function get_detail(){
	$strcondition='';
    $strSQL = "SELECT created,csv_file,date from question_group_imports WHERE id = '".$this->id."'";
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
		
}
}

}
?>

