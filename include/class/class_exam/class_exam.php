<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Exam {
	var $connection;
    var $id = gINVALID;
    var $name = "";
	var $organization_id = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";
	
	
	
	
function update(){ 
	
    if ( $this->id == "" || $this->id == gINVALID) {
     $strSQL = "INSERT INTO exams (name,organization_id) VALUES ('".mysql_real_escape_string($this->name) ."','".mysql_real_escape_string($this->organization_id) ."')";
	
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
	
          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this Member";
              return false;
          }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE exams SET name = '".mysql_real_escape_string($this->name)."'";
    $strSQL .= " WHERE id = ".$this->id;
	
	
	
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
	
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Member";
                return false;
            }
    }
}

function get_detail_all(){
	
    $strSQL = "SELECT * FROM exams";
   
	
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
		 $myexam = array();
		 $i=0;
		while($row = mysql_fetch_assoc($rsRES)){
        $myexam[$i]["id"] =  $row['id'];
        $myexam[$i]["name"] = $row['name'];
		$i++;
			}
        return $myexam ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function get_detail(){
	
    $strSQL = "SELECT id, name";
    $strSQL .= " FROM exams  WHERE id = '".$this->id."'";
	
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');

        $myexam = array();$i=0;
        $myexam[$i]["id"] =  $this->id;
        $myexam[$i]["name"] = $this->name;
       
	

        return $myexam ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}



	function delete(){
    $strSQL = "DELETE FROM exams  WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    }


	  function get_array()
    {
        $subjects = array();
		
        $strSQL = "SELECT  id,name FROM exams";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
				$exams[$id] = $name;
               
            }
            return $exams;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Subjects";
        return false;
        }
	}


    function get_list_array()
    {
        $exam = array();$i=0;
		
        $strSQL = "SELECT  * FROM exams";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $exam[$i]["id"] = $row["id"];
				$exam[$i]["name"] = $row["name"];
                $i++;
            }
            return $exam;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Exam Names";
        return false;
        }
	}
	
	function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id,name FROM exams";
		$strSQL .= " WHERE";
   		//if($this->subject!=''){
           $strSQL .= " name LIKE '%".addslashes(trim($this->name))."%'";
       	   $strSQL .= " ORDER BY id";
	   //}
	//	echo $strSQL;
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
                
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }


			
            while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
                  $limited_data[$i]["id"] = $id;
                  $limited_data[$i]["name"] = $name;
                  $i++;
            }
			
            return $limited_data;
        }
        else{
            return false;
        }
    }
	
}
?>
