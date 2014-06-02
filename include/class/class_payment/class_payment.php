<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Payment {

	var $connection;
    var $id     = gINVALID;
    var $date   = "";
    var $payment_type_id    = "";
    var $payment_status_id  = "";
    var $user_id    = "";
    var $amount     = "";
    var $iipay_transaction_number       = "";
    var $ipayy_request_id = "";
    var $cc_avanue_transaction_number   = "";
    var $cheque_number  = "";
    var $bank           = "";
    var $credit_plan_id = "";
    

    var $error_number = "";
  	var $error_description = "";

    //for pagination
    var $total_records = "";



    function update()
    {
        if($this->id == "" || $this->id == gINVALID)
        {
            $strSQL = "INSERT INTO payments(date,payment_type_id,payment_status_id,user_id,amount,ipayy_transaction_number,cc_avanue_transaction_number,cheque_number,bank,credit_plan_id) VALUES('";
            $strSQL .= CURRENT_DATETIME."','";
            $strSQL .= mysql_real_escape_string(trim($this->payment_type_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->payment_status_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->user_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->amount))."','";
            $strSQL .= mysql_real_escape_string(trim($this->iipay_transaction_number))."','";
            $strSQL .= mysql_real_escape_string(trim($this->cc_avanue_transaction_number))."','";
            $strSQL .= mysql_real_escape_string(trim($this->cheque_number))."','";
            $strSQL .= mysql_real_escape_string(trim($this->bank))."','";
            $strSQL .= mysql_real_escape_string(trim($this->credit_plan_id))."')";
           // echo $strSQL;exit();
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
            if(mysql_affected_rows($this->connection)>0){
                $this->id = mysql_insert_id();
                return true;
            }
            else{
                return false;
            }
        }
        else
        {
            $strSQL = "UPDATE payments SET ";
            $strSQL .= "date ='".CURRENT_DATETIME."',";
            $strSQL .= "payment_type_id ='".mysql_real_escape_string(trim($this->payment_type_id))."',";
            $strSQL .= "payment_status_id ='".mysql_real_escape_string(trim($this->payment_status_id))."',";
            $strSQL .= "user_id ='".mysql_real_escape_string(trim($this->user_id))."',";
            $strSQL .= "amount ='".mysql_real_escape_string(trim($this->amount))."',";
            $strSQL .= "ipayy_transaction_number ='".mysql_real_escape_string(trim($this->iipay_transaction_number))."',";
            $strSQL .= "cc_avanue_transaction_number ='".mysql_real_escape_string(trim($this->cc_avanue_transaction_number))."',";
            $strSQL .= "cheque_number ='".mysql_real_escape_string(trim($this->cheque_number))."',";
            $strSQL .= "bank ='".mysql_real_escape_string(trim($this->bank))."',";
            $strSQL .= "credit_plan_id ='".mysql_real_escape_string(trim($this->credit_plan_id))."'";
            $strSQL .= " WHERE id = '".$this->id."'";//echo $strSQL;exit();
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
            if(mysql_affected_rows($this->connection)>0){
                return true;
            }
            else{
                return false;
            }
        }
    }


    function update_from_ipayy_process()
    {
        if($this->id == "" || $this->id == gINVALID)
        {
            echo "payment id not set";exit();
        }
        else
        {
            $strSQL = "UPDATE payments SET ";
            $strSQL .= "date ='".CURRENT_DATETIME."',";
            $strSQL .= "payment_status_id ='".mysql_real_escape_string(trim($this->payment_status_id))."',";
            $strSQL .= "ipayy_transaction_number ='".mysql_real_escape_string(trim($this->iipay_transaction_number))."'";
            $strSQL .= " WHERE id = '".$this->id."'";//echo $strSQL;exit();
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
            if(mysql_affected_rows($this->connection)>0){
                return true;
            }
            else{
                return false;
            }
        } 
    }

    function update_ipayy_request_id()
    {
        $strSQL = "UPDATE payments SET ipayy_request_id = '".$this->ipayy_request_id."' WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_affected_rows($this->connection)>0){
            return true;
        }
        else{
            return false;
        }
    }

    function get_detail()
    {
        $strSQL = "SELECT * FROM payments WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0){
            $this->id = mysql_result($rsRES, 0, 'id');
            $this->date = mysql_result($rsRES, 0, 'date');
            $this->payment_type_id = mysql_result($rsRES, 0, 'payment_type_id');
            $this->payment_status_id = mysql_result($rsRES, 0, 'payment_status_id');
            $this->user_id = mysql_result($rsRES, 0, 'user_id');
            $this->amount = mysql_result($rsRES, 0, 'amount');
            $this->iipay_transaction_number = mysql_result($rsRES, 0, 'ipayy_transaction_number');
            $this->cc_avanue_transaction_number = mysql_result($rsRES, 0, 'cc_avanue_transaction_number');
            $this->cheque_number =mysql_result($rsRES, 0, 'cheque_number');
            $this->bank =mysql_result($rsRES, 0, 'bank');
            $this->credit_plan_id =mysql_result($rsRES, 0, 'credit_plan_id');
            return true;
        }
        else{
            return false;
        }

    }

    function check_ipayy_transaction($transaction_id)
    {
        $strSQL = "SELECT * FROM payments WHERE ipayy_transaction_number = '".trim($transaction_id)."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0){
            return true;
        }
        else{
            return false;
        }
    }


    
}
?>