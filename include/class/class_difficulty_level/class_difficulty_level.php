<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class DifficultyLevel {
	var $connection;
    var $id = gINVALID;
    var $name = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";
	
	function update(){ 
	
    if ( $this->id == "" || $this->id == gINVALID) {
     $strSQL = "INSERT INTO `difficulty_levels` (name) VALUES ('".mysql_real_escape_string($this->name) ."')";
	
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
    $strSQL = "UPDATE `difficulty_levels` SET name = '".mysql_real_escape_string($this->name)."'";
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
	
    $strSQL = "SELECT * FROM `difficulty_levels`";
   
	
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
		 $mydifficultylevel = array();
		 $i=0;
		while($row = mysql_fetch_assoc($rsRES)){
        $mydifficultylevel[$i]["id"] =  $row['id'];
        $mydifficultylevel[$i]["name"] = $row['name'];
		$i++;
			}
        return $mydifficultylevel ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}

function get_detail(){
	
    $strSQL = "SELECT id, name";
    $strSQL .= " FROM `difficulty_levels`  WHERE id = '".$this->id."'";
	
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');

        $mydifficultylevel = array();$i=0;
        $mydifficultylevel[$i]["id"] =  $this->id;
        $mydifficultylevel[$i]["name"] = $this->name;
       
	

        return $mydifficultylevel;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}
	function delete(){
    $strSQL = "DELETE FROM `difficulty_levels`  WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    }
	
	function get_array()
    {
        $subjects = array();
		
        $strSQL = "SELECT  id,name FROM difficulty_levels";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
				$difficulty_levels[$id] = $name;
               
            }
            return $difficulty_levels;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list difficulty_levels";
        return false;
        }
	}



    function get_list_array()
    {
        $mydifficultylevel = array();$i=0;
		
        $strSQL = "SELECT  * FROM difficulty_levels";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
                $mydifficultylevel[$i]["id"] = $id;
				$mydifficultylevel[$i]["name"] = $name;
                $i++;
            }
            return $mydifficultylevel;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Difficulty Levels";
        return false;
        }
	}
	
	function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id,name FROM difficulty_levels";
		$strSQL .= " WHERE";
   		//if($this->subject!=''){
           $strSQL .= " name LIKE '%".addslashes(trim($this->name))."%'";
       	   $strSQL .= " ORDER BY id";
	   //}
		//echo $strSQL;
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