<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Voucher_bill_items {
    var $connection;
    var $id 			= gINVALID;
    var $commision		= "";
    var $tax 	= "";
    var $amount		= "";
    var $credit 	= "";
    var $valid_from		= "";
    var $valid_to			= "";
    var $voucher_bill_item_status_id = "";
    var $agent_id 	= "";
    var $voucher_type_id	= "";
    var $voucher_bill_id="" ; 
	var $total_voucher_bill_items= "";
	var $description="";
	var $discount=""; 
	var $number_of_vouchers="";
	

    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";


    function __construct()
    {

    }
function set_defaults(){
$this->amount=0;
$this->credit=0;
$this->commision=0;
$this->discount=0;
$this->valid_from=gINVALID;
$this->valid_to=gINVALID;
$this->voucher_bill_item_status_id=gINVALID;
$this->number_of_vouchers=gINVALID;

}


    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
		
		
              $strSQL = "INSERT INTO voucher_bill_items (voucher_bill_id,amount, credit,valid_from,valid_to,description,commision,discount,voucher_bill_item_status_id,number_of_vouchers) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->voucher_bill_id))."','";
			  $strSQL .= addslashes(trim($this->amount))."','";
              $strSQL .= addslashes(trim($this->credit))."','";
              $strSQL .= addslashes(trim($this->valid_from))."','";
              $strSQL .= addslashes(trim($this->valid_to))."','";
			  $strSQL .= addslashes(trim($this->description))."','";
				$strSQL .= addslashes(trim($this->commision))."','";
			  $strSQL .= addslashes(trim($this->discount))."','";
			  $strSQL .= addslashes(trim($this->voucher_bill_item_status_id))."','";
				$strSQL .= addslashes(trim($this->number_of_vouchers))."')";
             
			 //try{
				
		      $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			// throw new Exception((mysql_error(). $strSQL ));
				 
				//}
				//catch(Exception $e){
				
				//return false;
				//}
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();
		    		return true;
              }
              else{
                $this->error_description = "Voucher bill adding failed.Please Try Again.";
                return false;
              }

        }
        elseif($this->id > 0 ) {
        $strSQL = "UPDATE voucher_bill_items SET ";
	    if($this->amount!=''){
	    $strSQL .= "amount = '".addslashes(trim($this->amount))."',";
	    }
		if($this->credit!=''){
            $strSQL .= "credit = '".addslashes(trim($this->credit))."',";
		}
		
            $strSQL .= "valid_from = '".addslashes(trim($this->valid_from))."',";
	     
		
	    	$strSQL .= "valid_to = '".addslashes(trim($this->valid_to))."',";
		
		if($this->voucher_bill_item_status_id!=''){
	    $strSQL .= "voucher_bill_item_status_id = '".$this->voucher_bill_item_status_id."',";
	    }

		if($this->commision!=''){
            $strSQL .= "commision = '".addslashes(trim($this->commision))."',";
		}
		if($this->description!=''){
            $strSQL .= "description = '".addslashes(trim($this->description))."',";
		}
		if($this->discount!=''){
            $strSQL .= "discount = '".addslashes(trim($this->discount))."',";
		}
		if($this->number_of_vouchers!=''){
            $strSQL .= "number_of_vouchers = '".addslashes(trim($this->number_of_vouchers))."',";
		}
		if($this->voucher_bill_id!=''){
            $strSQL .= "voucher_bill_id = '".addslashes(trim($this->voucher_bill_id))."'";
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
        $strSQL = "SELECT id FROM voucher_bill_items WHERE voucher_bill_id = '".$this->voucher_bill_id."'"; 
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
		$strcondition='';
        $strSQL = "SELECT * FROM voucher_bill_items WHERE id = '".$this->id."'";//
		
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->amount = mysql_result($rsRES,0,'amount');
                $this->credit= mysql_result($rsRES,0,'credit');
				$this->discount = mysql_result($rsRES,0,'discount');
                $this->commision= mysql_result($rsRES,0,'commision');
				$this->valid_from = mysql_result($rsRES,0,'valid_from');
                $this->valid_to = mysql_result($rsRES,0,'valid_to');
                $this->description = mysql_result($rsRES,0,'description');
		        $this->voucher_bill_id = mysql_result($rsRES,0,'voucher_bill_id');
				$this->voucher_bill_item_status_id = mysql_result($rsRES,0,'voucher_bill_item_status_id');
				$this->number_of_vouchers = mysql_result($rsRES,0,'number_of_vouchers');
               
                return true;
        }
        else{
            return false;
        }
    }

function get_detail_by_voucher(){
        $strSQL = "SELECT * FROM voucher_bill_items WHERE voucher = ".$this->voucher;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		
                $this->id = mysql_result($rsRES,0,'id');
                $this->voucher = mysql_result($rsRES,0,'voucher');
                $this->amount = mysql_result($rsRES,0,'amount');
                $this->credit= mysql_result($rsRES,0,'credit');
				$this->tax = mysql_result($rsRES,0,'tax');
                $this->commision= mysql_result($rsRES,0,'commision');
		
                $this->status_id= mysql_result($rsRES,0,'status_id');
                $this->valid_from = mysql_result($rsRES,0,'valid_from');
                $this->valid_to = mysql_result($rsRES,0,'valid_to');
                $this->agent_id = mysql_result($rsRES,0,'agent_id');
				
                return true;
        }
        else{
            return false;
        }
    }




function get_array_voucher_bill_item_status_id(){
        $voucher_bill_items_statuses = array();
        $strSQL = "SELECT id,name FROM voucher_bill_item_statuses ORDER BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
          $voucher_bill_items_statuses[$id] = $name;
        }
        return $voucher_bill_items_statuses;
        }
        else{
        $this->error_number = 4;
        $this->error_description="Can't list voucher_bill_items";
        return false;
        }
}




 
    function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,description,commision,amount,credit,valid_from,valid_to,number_of_vouchers,voucher_bill_item_status_id FROM voucher_bill_items WHERE 1";
		if($this->id!='' && $this->id!=gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
      	 }
        if ($this->valid_from!='') { 
       	$strSQL .= " AND valid_from LIKE '%".addslashes(trim($this->valid_from))."%'";  
        }
		if ($this->valid_to!='') { 
       	$strSQL .= " AND valid_to LIKE '%".addslashes(trim($this->valid_to))."%'";  
        }
	 if ($this->voucher_bill_item_status_id!='') { 
        $strSQL .= " AND voucher_bill_item_status_id = '".addslashes(trim($this->voucher_bill_item_status_id))."'";  
        }
		
		if ($this->voucher_type_id!='') { 
       	$strSQL .= " AND voucher_type_id LIKE '%".addslashes(trim($this->voucher_type_id))."%'";  
        }
	 if ($this->voucher_bill_id!='') { 
        $strSQL .= " AND voucher_bill_id = '".addslashes(trim($this->voucher_bill_id))."'";  
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
			while (list ($id,$description,$commision,$amount,$credit,$valid_from,$valid_to,$number_of_vouchers,$voucher_bill_item_status_id) = mysql_fetch_row($rsRES) ){
		          $limited_data[$i]["id"] = $id;
					 $limited_data[$i]["description"]=$description;
		          $limited_data[$i]["commision"] = $commision;
		          $limited_data[$i]["amount"] = $amount;
				  $limited_data[$i]["credit"] = $credit;
				  $limited_data[$i]["valid_from"]=$valid_from;
		          $limited_data[$i]["valid_to"] = $valid_to;
			  	  $limited_data[$i]["number_of_vouchers"]=$number_of_vouchers;
				$limited_data[$i]["voucher_bill_item_status_id"]=$voucher_bill_item_status_id;
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
        $strSQL = " DELETE FROM voucher_bill_items WHERE id = '".$this->id."'";
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
$strSQL = "SELECT count(id) as total_voucher_bill_items from voucher_bill_items";
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_voucher_bill_items=mysql_result($rsRES,0,'total_voucher_bill_items');
}
$strSQL = "SELECT count(id) as total_voucher_bill_items_active from voucher_bill_items WHERE status_id=".STATUS_ACTIVE;
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_voucher_bill_items_active=mysql_result($rsRES,0,'total_voucher_bill_items_active');
}
$strSQL = "SELECT count(id) as total_voucher_bill_items_inactive from voucher_bill_items WHERE status_id=".STATUS_INACTIVE;
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_voucher_bill_items_inactive=mysql_result($rsRES,0,'total_voucher_bill_items_inactive');
}
$strSQL ="SELECT count(id) as total_voucher_bill_items_used from voucher_bill_items  WHERE used=".intval(true);
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_voucher_bill_items_used=mysql_result($rsRES,0,'total_voucher_bill_items_used');
}
}

function generate_voucher(){
$random= "";

srand((double)microtime()*1000000);

$data = "ABCDEFGHJKLMNPQRSTUVWXYZ";
$data .= "23456789ZYXWVUTSRQNMLKJHGFEDCBA98765432";


for($i = 0; $i < 16; $i++)
{
$random .= substr($data, (rand()%(strlen($data))), 1);
}

return $random;
}

function check_voucher($voucher){
$mysql="SELECT id from voucher_bill_items WHERE voucher='".$voucher."'";
$result=mysql_query($mysql) or die(mysql_error(). $mysql );
if ( mysql_num_rows($result) > 0 ){
return false;
}else{
return true;
}
}



function voucher_start_id(){
$start_id="";
$strSQL = "SELECT id  from voucher_bill_items WHERE status_id='".STATUS_INACTIVE."' AND used='".intval(false)."' ORDER BY id ASC";
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$start_id=mysql_result($rsRES,0,'id');
return $start_id;
}

}


function cancel_bill_item_statuses_with_bill_id(){
 $strSQL = "UPDATE voucher_bill_items SET voucher_bill_item_status_id = '".VOUCHER_BILL_ITEM_CANCELLED."' WHERE voucher_bill_id='".addslashes(trim($this->voucher_bill_id))."'";
	$rsRES = mysql_query($strSQL, $this->connection);    

}
function get_array_id(){
$voucher_bill_id="";
$i=0;
$strSQL = "SELECT id  from voucher_bill_items WHERE voucher_bill_id='".addslashes(trim($this->voucher_bill_id))."'";
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id) = mysql_fetch_row($rsRES) ){
          $voucher_bill_id[$i] = $id;
			$i++;
        }
        return $voucher_bill_id;
        }
        else{
        $this->error_number = 4;
        $this->error_description="Can't list voucher_bill_id";
        return false;
        }


}
}
?>
