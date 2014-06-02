<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Set {
	var $connection;
    var $id = gINVALID;
    var $name = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";
	
	
	
	
function update(){ 
	
    if ( $this->id == "" || $this->id == gINVALID) {
     $strSQL = "INSERT INTO `set` (name) VALUES ('".mysql_real_escape_string($this->name) ."')";
	
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
    $strSQL = "UPDATE `set` SET name = '".mysql_real_escape_string($this->name)."'";
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
	
    $strSQL = "SELECT * FROM `set`";
   
	
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
		 $myset = array();
		 $i=0;
		while($row = mysql_fetch_assoc($rsRES)){
        $myset[$i]["id"] =  $row['id'];
        $myset[$i]["name"] = $row['name'];
		$i++;
			}
        return $myset ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function get_detail(){
	
    $strSQL = "SELECT id, name";
    $strSQL .= " FROM `set`  WHERE id = '".$this->id."'";
	
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');

        $myset = array();$i=0;
        $myset[$i]["id"] =  $this->id;
        $myset[$i]["name"] = $this->name;
       
	

        return $myset ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}



	function delete(){
    $strSQL = "DELETE FROM `set`  WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    }



    function get_list_array()
    {
        $set = array();$i=0;
		
        $strSQL = "SELECT  * FROM `set`";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $set[$i]["id"] = $row["id"];
				$set[$i]["name"] = $row["name"];
                $i++;
            }
            return $set;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Set Names";
        return false;
        }
	}
	
	function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id,name FROM `set`";
		$strSQL .= " WHERE";
   		//if($this->subject!=''){
           $strSQL .= " name LIKE '".addslashes(trim($this->name))."%'";
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