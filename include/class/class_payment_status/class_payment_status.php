<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class PaymentStatus {

	var $connection;
    var $id = gINVALID;
    var $name = "";
    
    var $error_number = "";
  	var $error_description = "";

    //for pagination
    var $total_records = "";


    function get_detail()
    {
        $strSQL = "SELECT * FROM payment_statuses WHERE id = '".$this->id."'";
        $rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0){
            $this->id = mysql_result($rsRES,0,'id');
            $this->name = mysql_result($rsRES,0,'name');
            return true;
        }
        else{
            return false;
        }
    }
}
?>