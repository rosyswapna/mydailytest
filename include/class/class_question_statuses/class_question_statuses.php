<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class QuestionStatuses {
	var $connection;
    var $id = gINVALID;
    var $name = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

    function get_list_array()
    {
        $set = array();$i=0;
		
        $strSQL = "SELECT  * FROM question_statuses";
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
        $this->error_description="Can't list Difficulty Levels";
        return false;
        }
	}
	  function get_array()
    {
        $subjects = array();
		
        $strSQL = "SELECT  id,name FROM question_statuses";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
				$question_statuses[$id] = $name;
               
            }
            return $question_statuses;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Subjects";
        return false;
        }
	}
}
?>