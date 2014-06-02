<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Subject {
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
     $strSQL = "INSERT INTO `subjects` (name,organization_id) VALUES ('".mysql_real_escape_string($this->name) ."','".mysql_real_escape_string($this->organization_id) ."')";
	
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
    $strSQL = "UPDATE `subjects` SET name = '".mysql_real_escape_string($this->name)."'";
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
	
    $strSQL = "SELECT * FROM `subjects`";
   
	
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
		 $mysubject = array();
		 $i=0;
		while($row = mysql_fetch_assoc($rsRES)){
        $mysubject[$i]["id"] =  $row['id'];
        $mysubject[$i]["name"] = $row['name'];
		$i++;
			}
        return $mysubject ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function get_detail(){
	
    $strSQL = "SELECT id, name";
    $strSQL .= " FROM `subjects`  WHERE id = '".$this->id."'";
	
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');

        $mysubject = array();$i=0;
        $mysubject[$i]["id"] =  $this->id;
        $mysubject[$i]["name"] = $this->name;
       
	

        return $mysubject ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}
	function delete(){
   	 	$strSQL = "DELETE FROM `subjects`  WHERE id = '".$this->id."'";
    	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    }
	

    function get_array()
    {
        $subjects = array();
		
        $strSQL = "SELECT  id,name FROM subjects";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
				$subjects[$id] = $name;
               
            }
            return $subjects;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Subjects";
        return false;
        }
	}

    function get_list_array()
    {
        $mysubject = array();$i=0;
		
        $strSQL = "SELECT  id,name FROM subjects";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
                $mysubject[$i]["id"] = $id;
				$mysubject[$i]["name"] = $name;
                $i++;
            }
            return $mysubject;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Subjects";
        return false;
        }
	}
	
	function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id,name FROM subjects";
		
   		if($this->name!=''){
		  $strSQL .= " WHERE";
           $strSQL .= " name LIKE '%".addslashes(trim($this->name))."%'";
		   
       	  
	   } $strSQL .= " ORDER BY id";
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
