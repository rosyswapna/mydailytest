<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class CreditPlanStatuses {
	var $connection;
    var $id = gINVALID;
    var $name = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

    function get_list_array()
    {
        $credit_plan_statuses = array();$i=0;
		
        $strSQL = "SELECT  * FROM credit_plan_statuses";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $credit_plan_statuses[$i]["id"] = $row["id"];
				$credit_plan_statuses[$i]["name"] = $row["name"];
                $i++;
            }
            return $set;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Credit Plan Status";
        return false;
        }
	}
	  function get_array()
    {
        $subjects = array();
		
        $strSQL = "SELECT  id,name FROM credit_plan_statuses";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
				$credit_plan_statuses[$id] = $name;
               
            }
            return $credit_plan_statuses;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Credit Plan Status";
        return false;
        }
	}
}
?>