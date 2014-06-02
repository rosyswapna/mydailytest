<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class CreditPlan {
	var $connection;
    var $id = gINVALID;
    var $name = "";
    var $amount = "";
    var $credit = "";
    var $credit_plan_status_id = "";
	var $default_plan="";
    var $error_number = "";
  	var $error_description = "";

    //for pagination
    var $total_records = "";
	
	 function update()
    {
	
        if ( $this->id == "" || $this->id == gINVALID) 
        {
            $strSQL = "INSERT INTO credit_plans (name, amount,credit,credit_plan_status_id,default_plan) VALUES ('"; 
         	$strSQL .= mysql_real_escape_string($this->name) ."','";
            $strSQL .= mysql_real_escape_string($this->amount) ."','";
            $strSQL .= mysql_real_escape_string($this->credit) ."','";
			$strSQL .= mysql_real_escape_string($this->default_plan) ."','";
            $strSQL .= mysql_real_escape_string($this->credit_plan_status_id) . "')";
            
            
            $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    	    if ( mysql_affected_rows($this->connection) > 0 )
            {
                $this->id = mysql_insert_id();
                $this->error_description = "New Quiz generated";
                return true;
            }else{
                $this->error_number = 3;
                $this->error_description="Can't insert this Quiz";
                return false;
            }
        } 
        elseif($this->id > 0 ) 
        {
    		$strSQL = "Update credit_plans SET ";
            $strSQL .= " name = '".mysql_real_escape_string($this->name)."',";
            $strSQL .= " amount = '".mysql_real_escape_string($this->amount)."',";
            $strSQL .= " credit = '".mysql_real_escape_string($this->credit)."',";
			 $strSQL .= " default_plan = '".mysql_real_escape_string($this->default_plan)."',";
            $strSQL .= " credit_plan_status_id = '".mysql_real_escape_string($this->credit_plan_status_id)."'";	
            $strSQL .= " WHERE id = ".$this->id;
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) 
            {
                $this->error_description = "Credit Updated";
                return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Credit";
                return false;
            }
        }
    }





	function get_credit_plans()
	{
        $credit_plans = array();$i=0;
        $strSQL = "SELECT  * FROM credit_plans WHERE credit_plan_status_id = '".CREDIT_PLAN_ACTIVE."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $credit_plans[$i]["id"] = $row["id"];
				$credit_plans[$i]["name"] = $row["name"];
                $i++;
            }
            return $credit_plans;
        }else{
        	$this->error_number = 4;
        	$this->error_description="Can't list Credit plans";
        	return false;
        }
	}

    function get_detail()
    {
        $strSQL = "SELECT * FROM credit_plans WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            $row = mysql_fetch_assoc($rsRES);
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->amount = $row['amount'];
            $this->credit = $row['credit'];
            $this->credit_plan_status_id = $row['credit_plan_status_id'];
			 $this->default_plan = $row['default_plan'];
            return true;
        }
        else{
            return false;
        }
    }
	function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id,name FROM credit_plans";
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
	function delete(){
    $strSQL = "DELETE FROM `credit_plans`  WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    }
	
	function get_default_credit_plan_id(){
	 $strSQL = "SELECT id FROM credit_plans WHERE default_plan = '".true."'"; 
  $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		$this->id = mysql_result($rsRES,0,'id');
            return $this->id;
        }
        else{
            return false;
        }	
	}
	
	    function exist(){
        $strSQL = "SELECT id FROM credit_plans WHERE name = '".$this->name."'"; 
  $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		$this->id = mysql_result($rsRES,0,'id');
            return true;
        }
        else{
            return false;
        }
    }
	function change_default_plan(){
	$strSQL = "Update credit_plans SET ";
            $strSQL .= " default_plan = '".intval(false)."'";
            $strSQL .= " WHERE default_plan = ".true;
			  $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );	
	}
	
	
	
}
?>