<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Voucher_bill {
    var $connection;
    var $id 			= gINVALID;
    var $date		= "";
	var $commision		= "";
    var $tax 	= "";
    var $amount		= "";
    var $discount 	= "";
    var $bill_status_id		= "";
    var $payment_id			= "";
 	var $name			= "";
    var $agent_id		= "";
    var $address	= "";
    var $email	= "";
    var $phone="" ; 
	var $total_bills= "";
	var $total_bills_active= "";
	var $total_bills_cancelled= "";
	
	

    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";


    function __construct()
    {

    }
function set_defaults(){
$this->amount=gINVALID;
$this->credit=gINVALID;
$this->commision=gINVALID;
$this->agent_id=gINVALID;

}


    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
		$date=date("Y/m/d H.i:s<br>", time());
		
              $strSQL = "INSERT INTO voucher_bills (date,bill_status_id,payment_id,agent_id, name,address,email,phone,amount,commision,discount,tax) ";
              $strSQL .= "VALUES ('".$date."','";
			  $strSQL .= addslashes(trim($this->bill_status_id))."','";
              $strSQL .= addslashes(trim($this->payment_id))."','";
              $strSQL .= addslashes(trim($this->agent_id))."','";
              $strSQL .= addslashes(trim($this->name))."','";
              $strSQL .= addslashes(trim($this->address))."','";
              $strSQL .= addslashes(trim($this->email))."','";
	     	  $strSQL .= addslashes(trim($this->phone))."','";
              $strSQL .= addslashes(trim($this->amount))."','";
              $strSQL .= addslashes(trim($this->commision))."','";
			  $strSQL .= addslashes(trim($this->discount))."','";
              $strSQL .= addslashes(trim($this->tax))."')";
		      $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();
		    		return true;
              }
              else{
                $this->error_description = "Voucher bill adding failed.Please Try Again.";
                return false;
              }

        }elseif($this->id > 0 ) {
        $strSQL = "UPDATE voucher_bills SET ";
	   
		
		if($this->address!=''){
            $strSQL .= "address = '".addslashes(trim($this->address))."',";
	     }
		if($this->phone!=''){
	    	$strSQL .= "phone = '".addslashes(trim($this->phone))."',";
		}
		if($this->bill_status_id!=''){
	    $strSQL .= "bill_status_id = '".addslashes(trim($this->bill_status_id))."',";
	    }

		if($this->agent_id!=''){
            $strSQL .= "agent_id = '".addslashes(trim($this->agent_id))."',";
		}
		if($this->payment_id!=''){
            $strSQL .= "payment_id = '".addslashes(trim($this->payment_id))."',";
		}
		if($this->name!=''){
            $strSQL .= "name = '".addslashes(trim($this->name))."',";
		}
		if($this->commision!=''){
            $strSQL .= "commision = '".addslashes(trim($this->commision))."',";
		}
		if($this->tax!='' && $this->tax!=gINVALID ){
            $strSQL .= "tax = '".addslashes(trim($this->tax))."',";
		}
		if($this->email!=''){
            $strSQL .= "email = '".addslashes(trim($this->email))."',";
		}
		 if($this->amount!=''){
	    $strSQL .= "amount = '".addslashes(trim($this->amount))."'";
	    }	
					
	    $strSQL .= " WHERE id = ".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) >= 0 ) {
		$this->error_description = "Updated data Successfuly";                    
		return true;
            }
        else{
             $this->error_description = "Update data Failed";
             return false;
            }
        }
        

    }




    function exist(){
        $strSQL = "SELECT id FROM voucher_bills WHERE id = '".$this->id."'"; 
  		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		$this->id = mysql_result($rsRES,0,'id');
            return true;
        }
        else{
            return false;
        }
    }



    function get_detail(){
		
        $strSQL = "SELECT * FROM voucher_bills WHERE id = '".$this->id."'";//echo $strSQL;exit();
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
				$this->date = mysql_result($rsRES,0,'date');
                $this->name = mysql_result($rsRES,0,'name');
				$this->email = mysql_result($rsRES,0,'email');
				$this->phone = mysql_result($rsRES,0,'phone');
				$this->address = mysql_result($rsRES,0,'address');
                $this->amount = mysql_result($rsRES,0,'amount');
				$this->discount = mysql_result($rsRES,0,'discount');
                $this->tax = mysql_result($rsRES,0,'tax');
                $this->commision= mysql_result($rsRES,0,'commision');
				$this->payment_id= mysql_result($rsRES,0,'payment_id');
				$this->bill_status_id= mysql_result($rsRES,0,'bill_status_id');
                $this->agent_id = mysql_result($rsRES,0,'agent_id');
                
               
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
        $strSQL = "SELECT id,date,bill_status_id,payment_id,agent_id,name,amount,commision FROM voucher_bills WHERE 1";
		if($this->id!='' && $this->id!=gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
      	 }
        if ($this->date!='') { 
       	$strSQL .= " AND date LIKE '%".addslashes(trim($this->date))."%'";  
        }
		
	 if ($this->bill_status_id!='' && $this->bill_status_id!=gINVALID) { 
        $strSQL .= " AND bill_status_id = '".addslashes(trim($this->bill_status_id))."'";  
        }
		if ($this->agent_id!='' && $this->agent_id!=gINVALID) { 
       	$strSQL .= " AND agent_id = '".addslashes(trim($this->agent_id))."'";  
        }
		
	 if ($this->name!='') { 
        $strSQL .= " AND name LIKE '%".addslashes(trim($this->bill_id))."%'";  
        }

         $strSQL .= " ORDER BY id";
		
	
		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
				
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }
			while (list ($id,$date,$bill_status_id,$payment_id,$agent_id,$name,$amount,$commision) = mysql_fetch_row($rsRES) ){
		          $limited_data[$i]["id"] = $id;
		          $limited_data[$i]["date"] = $date;
		          $limited_data[$i]["bill_status_id"] = $bill_status_id;
		          $limited_data[$i]["payment_id"] = $payment_id;
				  $limited_data[$i]["agent_id"] = $agent_id;
				  $limited_data[$i]["name"]=$name;
		           $limited_data[$i]["amount"]=$amount;
				  $limited_data[$i]["commision"]=$commision;
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
        $strSQL = " DELETE FROM voucher_bills WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't delete this User";
            return  false;
        }
    }
}
function get_counts(){
$strSQL = "SELECT count(id) as total_voucher_bills from voucher_bills";
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_voucher_bills=mysql_result($rsRES,0,'total_voucher_bills');
}
$strSQL = "SELECT count(id) as total_voucher_bills_active from voucher_bills WHERE bill_status_id=".STATUS_ACTIVE;
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_voucher_bills_active=mysql_result($rsRES,0,'total_voucher_bills_active');
}
$strSQL = "SELECT count(id) as total_voucher_bills_cancelled from voucher_bills WHERE status_id=".STATUS_INACTIVE;
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_voucher_bills_cancelled=mysql_result($rsRES,0,'total_voucher_bills_inactive');
}

}

function get_array_statuses()
    {
        $bill_statuses = array();
		
        $strSQL = "SELECT  id,name FROM bill_statuses";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
				$bill_statuses[$id] = $name;
               
            }
            return $bill_statuses;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list bill_statuses";
        return false;
        }
	}


}
?>
