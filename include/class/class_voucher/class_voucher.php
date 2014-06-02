<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Voucher {
    var $connection;
    var $id 			= gINVALID;
    var $voucher		= "";
	var $commision		= "";
    var $tax 	= "";
    var $amount		= "";
    var $credit 	= "";
    var $valid_from		= "";
    var $valid_to			= "";
    var $status_id		= "";
    var $agent_id 	= "";
    var $voucher_type_id	= "";
    var $voucher_bill_id="" ; 
	var $total_vouchers= "";
	var $total_vouchers_active= "";
	var $total_vouchers_inactive= "";
	var $total_vouchers_used= "";
	var $voucher_bill_item_id="";
    var $used = "";

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
$this->tax=0;
$this->valid_from=gINVALID;
$this->valid_to=gINVALID;
$this->status_id=STATUS_INACTIVE;
$this->agent_id=gINVALID;
$this->voucher_type_id=gINVALID;
$this->voucher_bill_item_id=gINVALID;
$this->voucher_bill_id=gINVALID;
$this->bill_id=gINVALID;
}


    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
		$valid_from=date("Y/m/d H.i:s<br>", time());
		
              $strSQL = "INSERT INTO vouchers (voucher,commision,tax,amount, credit,valid_from,valid_to,status_id,agent_id,voucher_type_id,voucher_bill_id,voucher_bill_item_id) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->voucher))."','";
			  $strSQL .= addslashes(trim($this->amount))."','";
              $strSQL .= addslashes(trim($this->credit))."','";
              $strSQL .= addslashes(trim($this->commision))."','";
              $strSQL .= addslashes(trim($this->tax))."','";
              $strSQL .= addslashes(trim($this->valid_from))."','";
              $strSQL .= addslashes(trim($this->valid_to))."','";
	     	  $strSQL .= addslashes(trim($this->status_id))."','";
              $strSQL .= addslashes(trim($this->agent_id))."','";
              $strSQL .= addslashes(trim($this->voucher_type_id))."','";
              $strSQL .= addslashes(trim($this->voucher_bill_id))."','";
 			  $strSQL .= addslashes(trim($this->voucher_bill_item_id))."')";
			 //try{
				
		      $rsRES = mysql_query($strSQL,$this->connection) or (mysql_error(). $strSQL );
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
                $this->error_description = "Voucher adding failed.Please Try Again.";
                return false;
              }

        }
        elseif($this->id > 0 ) {
        $strSQL = "UPDATE vouchers SET ";
	    if($this->amount!=''){
	    $strSQL .= "amount = '".addslashes(trim($this->amount))."',";
	    }
		if($this->credit!=''){
            $strSQL .= "credit = '".addslashes(trim($this->credit))."',";
		}
		if($this->valid_from!=''){
            $strSQL .= "valid_from = '".addslashes(trim($this->valid_from))."',";
	     }
		if($this->valid_to!=''){
	    	$strSQL .= "valid_to = '".addslashes(trim($this->valid_to))."',";
		}
		if($this->amount!='' && $this->credit!=''){
	    $strSQL .= "status_id = '".STATUS_ACTIVE."',";
	    }

		if($this->agent_id!=''){
            $strSQL .= "agent_id = '".addslashes(trim($this->agent_id))."',";
		}
		if($this->voucher_type_id!=''){
            $strSQL .= "voucher_type_id = '".addslashes(trim($this->voucher_type_id))."',";
		}
		if($this->commision!=''){
            $strSQL .= "commision = '".addslashes(trim($this->commision))."',";
		}
		if($this->tax!='' && $this->tax!=gINVALID ){
            $strSQL .= "tax = '".addslashes(trim($this->tax))."',";
		}
		if($this->voucher_bill_item_id!=''){
            $strSQL .= "voucher_bill_item_id = '".addslashes(trim($this->voucher_bill_item_id))."',";
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
        $strSQL = "SELECT id FROM vouchers WHERE voucher = '".$this->voucher."'"; 
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
        $strSQL = "SELECT * FROM vouchers WHERE id = '".$this->id."'";//
		if($this->agent_id!='' && $this->agent_id!=gINVALID){
		$strcondition=" AND agent_id=".$this->agent_id;
		}
		if($strcondition!=''){
		$strSQL.=$strcondition;
		}
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
                $this->voucher_type_id = mysql_result($rsRES,0,'voucher_type_id');
		        $this->bill_id = mysql_result($rsRES,0,'bill_id');
               
                return true;
        }
        else{
            return false;
        }
    }

function get_detail_by_voucher(){
        $strSQL = "SELECT * FROM vouchers WHERE voucher = '".$this->voucher."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->voucher = mysql_result($rsRES,0,'voucher');
                $this->commision= mysql_result($rsRES,0,'commision');
                $this->tax = mysql_result($rsRES,0,'tax');
                $this->amount = mysql_result($rsRES,0,'amount');
                $this->credit= mysql_result($rsRES,0,'credit');
                $this->valid_from = mysql_result($rsRES,0,'valid_from');
                $this->valid_to = mysql_result($rsRES,0,'valid_to');
                $this->status_id= mysql_result($rsRES,0,'status_id');
                $this->agent_id = mysql_result($rsRES,0,'agent_id');
                $this->voucher_type_id = mysql_result($rsRES,0,'voucher_type_id');
                $this->voucher_bill_id = mysql_result($rsRES,0,'voucher_bill_id');
                $this->voucher_bill_item_id= mysql_result($rsRES,0,'voucher_bill_item_id');
                $this->used = mysql_result($rsRES,0,'used');
                return true;
        }
        else{
            return false;
        }
    }




function get_array(){
        $vouchers = array();
        $strSQL = "SELECT id,voucher FROM vouchers ORDER BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$voucher) = mysql_fetch_row($rsRES) ){
          $vouchers[$id]["voucher"] = $voucher;
        }
        return $vouchers;
        }
        else{
        $this->error_number = 4;
        $this->error_description="Can't list vouchers";
        return false;
        }
}



function get_vouchers(){
        $vouchers = array();$i=0;
        
        $strSQL = "SELECT id,voucher FROM vouchers ORDER BY id DESC";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $vouchers[$i]["id"] = $row["id"];
                $vouchers[$i]["voucher"] = $row["voucher"];
                $i++;
            }
            return $vouchers;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Users";
        return false;
        }
}

 
    function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,voucher,commision,amount,credit,valid_from,valid_to,status_id,agent_id,voucher_type_id,voucher_bill_id,used FROM vouchers WHERE 1";
		if($this->id!='' and $this->id != gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
      	}
        if ($this->valid_from!='') { 
       	$strSQL .= " AND valid_from LIKE '%".addslashes(trim($this->valid_from))."%'";  
        }
		if ($this->valid_to!='') { 
       	$strSQL .= " AND valid_to LIKE '%".addslashes(trim($this->valid_to))."%'";  
        }
	   if ($this->status_id!='') { 
        $strSQL .= " AND status_id = '".addslashes(trim($this->status_id))."'";  
        }
		if ($this->agent_id!='') { 
       	$strSQL .= " AND agent_id LIKE '%".addslashes(trim($this->agent_id))."%'";  
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
			while (list ($id,$voucher,$commision,$amount,$credit,$valid_from,$valid_to,$status_id,$agent_id,$voucher_type_id,$bill_id,$used) = mysql_fetch_row($rsRES) ){
		          $limited_data[$i]["id"] = $id;
		          $limited_data[$i]["voucher"] = $voucher;
		          $limited_data[$i]["commision"] = $commision;
		          $limited_data[$i]["amount"] = $amount;
				  $limited_data[$i]["credit"] = $credit;
				  $limited_data[$i]["valid_from"]=$valid_from;
		          $limited_data[$i]["valid_to"] = $valid_to;
			  	  $limited_data[$i]["status_id"]=$status_id;
				  $limited_data[$i]["agent_id"]=$agent_id;
				  $limited_data[$i]["voucher_type_id"]=$voucher_type_id;
				  $limited_data[$i]["bill_id"]=$bill_id;
                  $limited_data[$i]["used"]=$used;
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
        $strSQL = " DELETE FROM vouchers WHERE id = '".$this->id."'";
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
$strSQL = "SELECT count(id) as total_vouchers from vouchers";
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_vouchers=mysql_result($rsRES,0,'total_vouchers');
}
$strSQL = "SELECT count(id) as total_vouchers_active from vouchers WHERE status_id=".STATUS_ACTIVE;
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_vouchers_active=mysql_result($rsRES,0,'total_vouchers_active');
}
$strSQL = "SELECT count(id) as total_vouchers_inactive from vouchers WHERE status_id=".STATUS_INACTIVE;
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_vouchers_inactive=mysql_result($rsRES,0,'total_vouchers_inactive');
}
$strSQL ="SELECT count(id) as total_vouchers_used from vouchers  WHERE used=".intval(true);
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$this->total_vouchers_used=mysql_result($rsRES,0,'total_vouchers_used');
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
$mysql="SELECT id from vouchers WHERE voucher='".$voucher."'";
$result=mysql_query($mysql) or die(mysql_error(). $mysql );
if ( mysql_num_rows($result) > 0 ){
return false;
}else{
return true;
}
}



function voucher_start_id(){
$start_id="";
$strSQL = "SELECT id  from vouchers WHERE status_id='".STATUS_INACTIVE."' AND used='".intval(false)."' ORDER BY id ASC";
$rsRES = mysql_query($strSQL, $this->connection);
if ( mysql_num_rows($rsRES) > 0 ){
$start_id=mysql_result($rsRES,0,'id');
return $start_id;
}

}


    //check voucher is valid (not used)
    function validate_voucher()
    {
        $valid_voucher = "";
        if($this->voucher !=""){
            $this->get_detail_by_voucher();
             //check voucher date
            if(strtotime($this->valid_from) != "" and strtotime($this->valid_to) != ""){
               if(strtotime($this->valid_from) <= strtotime(CURRENT_DATETIME) and strtotime($this->valid_to) >= strtotime(CURRENT_DATETIME)){
                    $valid_voucher = true;
               }else{
                $valid_voucher = false;
               }
            }elseif(strtotime($this->valid_from) != "" and strtotime($this->valid_to) == ""){
                if(strtotime($this->valid_from) <= strtotime(CURRENT_DATETIME)){
                    $valid_voucher = true;
                }else{
                    $valid_voucher = false;
                }
            }elseif(strtotime($this->valid_from) == "" and strtotime($this->valid_to) != ""){
                if(strtotime($this->valid_to) >= strtotime(CURRENT_DATETIME)){
                     $valid_voucher = true;
                }else{
                    $valid_voucher = false;
                }
            }else{
                $valid_voucher = true;
            }

            if($valid_voucher ==true){
                //check voucher flags
                if($this->used == VOUCHER_UNUSED and $this->status_id == STATUS_ACTIVE and $this->voucher_bill_id > 0 and $this->voucher_bill_item_id > 0){
                    $valid_voucher = true;
                }else{
                    $valid_voucher = false;
                }
            }
            return $valid_voucher;

        }else{
            return false;
        }     
    }

    //update voucher as used
    function update_voucher_used()
    {
        if ( $this->id != "" || $this->id != gINVALID) {
            $strSQL = "UPDATE vouchers SET used = '".VOUCHER_USED."' WHERE id = '".$this->id."'";
            $rsRES = mysql_query($strSQL,$this->connection) or (mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) > 0 ){
                return true;
            }
            else{
                return false;
            }
        }
    }

    //function to fetch count of agent voucher details
    function get_count_voucher()
    {
        $strSQL = "SELECT COUNT(*)  as vouchers, COUNT(CASE WHEN used = '". VOUCHER_USED."' THEN 1 END)  as used,COUNT(CASE WHEN status_id = '".STATUS_ACTIVE."' THEN 1 END)  as active, COUNT(CASE WHEN status_id = '".STATUS_INACTIVE."' THEN 1 END)  as inactive FROM vouchers";
        if($this->agent_id != "" and $this->agent_id > 0){
            $strSQL .= " WHERE agent_id = '".$this->agent_id."'" ;
        }//echo $strSQL;exit();
        $rsRES = mysql_query($strSQL,$this->connection) or (mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            $this->total_vouchers = mysql_result($rsRES,0,'vouchers');
            $this->total_vouchers_used = mysql_result($rsRES,0,'used');
            $this->total_vouchers_active = mysql_result($rsRES,0,'active');
            $this->total_vouchers_inactive = mysql_result($rsRES,0,'inactive');
            return true;
        }else{
            return false;
        }
    }

}
?>
