<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class PaymentType {

var $connection;
    var $id = gINVALID;
    var $name = "";
    var $online ="";
    

    var $error_number = "";
  	var $error_description = "";

    //for pagination
    var $total_records = "";





	function get_payment_types()
	{
        $payment_types = array();$i=0;
        $strSQL = "SELECT  * FROM payment_types WHERE online = '".$this->online."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $payment_types[$i]["id"] = $row["id"];
				$payment_types[$i]["name"] = $row["name"];
                $i++;
            }
            return $payment_types;
        }else{
        	$this->error_number = 4;
        	$this->error_description="Can't list Payment Types";
        	return false;
        }
	}

    function get_detail()
    {
        $strSQL = "SELECT * FROM payment_types WHERE id = '".$this->id."'";
        $rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0){
            $this->id = mysql_result($rsRES,0,'id');
            $this->name = mysql_result($rsRES,0,'name');
            $this->online = mysql_result($rsRES,0,'online');
            return true;
        }
        else{
            return false;
        }
    }

}
?>