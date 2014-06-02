<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserCredit {

	var $connection;
    var $id = gINVALID;
    var $date = "";
    var $credit_type_id = "";
    var $payment_id = "";
    var $user_id = "";
    var $user_test_id = "";
    var $user_report_id = "";
    var $credit = "";
    var $credit_plan_id ="";
    var $offer_note ="";
    var $organization_credit_id = "";

    var $organization_id = "";

    var $total_credit ="";

    var $error_number = "";
  	var $error_description = "";

    //for pagination
    var $total_records = "";




    function update()
    {
        if($this->id == "" || $this->id == gINVALID)
        {
            $strSQL = "INSERT INTO user_credits(date,credit_type_id,payment_id,user_id,user_test_id,user_report_id,credit,credit_plan_id, offer_note, organization_credit_id, voucher_id) VALUES('";
            $strSQL .= CURRENT_DATETIME."','";
            $strSQL .= mysql_real_escape_string(trim($this->credit_type_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->payment_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->user_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->user_test_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->user_report_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->credit))."','";
            $strSQL .= mysql_real_escape_string(trim($this->credit_plan_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->offer_note))."','";
            $strSQL .= mysql_real_escape_string(trim($this->organization_credit_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->voucher_id))."')";//echo $strSQL;exit();
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
            if(mysql_affected_rows($this->connection)>0){
                //$this->id = mysql_insert_id();
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $strSQL = "UPDATE user_credits SET ";
            $strSQL .= "date ='".CURRENT_DATETIME."',";
            $strSQL .= "credit_type_id ='".mysql_real_escape_string(trim($this->credit_type_id))."',";
            $strSQL .= "payment_id ='".mysql_real_escape_string(trim($this->payment_id))."',";
            $strSQL .= "user_id ='".mysql_real_escape_string(trim($this->user_id))."',";
            $strSQL .= "user_test_id ='".mysql_real_escape_string(trim($this->user_test_id))."',";
            $strSQL .= "user_report_id ='".mysql_real_escape_string(trim($this->user_report_id))."',";
            $strSQL .= "credit ='".mysql_real_escape_string(trim($this->credit))."',";
            $strSQL .= "offer_note ='".mysql_real_escape_string(trim($this->offer_note))."',";
            $strSQL .= "credit_plan_id ='".mysql_real_escape_string(trim($this->credit_plan_id))."',";
            $strSQL .= "voucher_id ='".mysql_real_escape_string(trim($this->voucher_id))."',";
            $strSQL .= "organization_credit_id ='".mysql_real_escape_string(trim($this->organization_credit_id))."'";
            $strSQL .= " WHERE id = '".$this->id."'";// echo $strSQL;exit();
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
            if(mysql_affected_rows($this->connection)>0){
                return true;
            }
            else{
                return false;
            }
        }
    }

    function update_from_organization_import($user_ids = array())
    {
        if(count($user_ids) > 0)
        {
            $strSQL = "INSERT INTO user_credits(date,credit_type_id,payment_id,user_id,user_test_id,user_report_id,credit,credit_plan_id, offer_note, organization_credit_id) VALUES";
            $strSQL_values = "";
            foreach ($user_ids as $userid) {
                $strSQL_values .= "('".CURRENT_DATETIME."','";
                $strSQL_values .= mysql_real_escape_string(trim($this->credit_type_id))."','";
                $strSQL_values .= mysql_real_escape_string(trim($this->payment_id))."','";
                $strSQL_values .= mysql_real_escape_string(trim($userid))."','";
                $strSQL_values .= mysql_real_escape_string(trim($this->user_test_id))."','";
                $strSQL_values .= mysql_real_escape_string(trim($this->user_report_id))."','";
                $strSQL_values .= mysql_real_escape_string(trim($this->credit))."','";
                $strSQL_values .= mysql_real_escape_string(trim($this->credit_plan_id))."','";
                $strSQL_values .= mysql_real_escape_string(trim($this->offer_note))."','";
                $strSQL_values .= mysql_real_escape_string(trim($this->organization_credit_id))."'),";
            }
            $strSQL .= substr($strSQL_values, 0, -1);//echo $strSQL;exit();
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
            if(mysql_affected_rows($this->connection)>0){
                return true;
            }
            else{
                $this->error_description = "Can't insert";
                return false;
            }
        }
        else
        {
            return false;
        }
    }


    function get_user_credit_list_array()
    {

    	$strSQL = "SELECT UC.id,UC.date,UC.credit,UC.credit_type_id, UC.payment_id,UC.offer_note, P.amount, P.payment_type_id, P.ipayy_transaction_number,P.cc_avanue_transaction_number,P.cheque_number,P.bank,PT.name as payment_type, PT.online, PS.name as payment_status,CT.name as credit_type,CP.name
					FROM user_credits UC
					LEFT JOIN payments P ON P.id = UC.payment_id
					LEFT JOIN payment_types PT ON PT.id = P.payment_type_id
					LEFT JOIN payment_statuses PS ON PS.id = P.payment_status_id
					LEFT JOIN credit_types CT ON CT.id = UC.credit_type_id
                    LEFT JOIN credit_plans CP ON CP.id = UC.credit_plan_id
					WHERE UC.user_id = '".$this->user_id."' ORDER BY UC.id DESC LIMIT ".LIMIT_CREDITS;

					//echo $strSQL;exit();

    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
    	if(mysql_num_rows($rsRES) > 0){
    		$limit_data = array();$i=0;
    		while($row = mysql_fetch_assoc($rsRES))
    		{
    			$limit_data[$i]['id'] = $row['id'];
    			$limit_data[$i]['date'] = $row['date'];
    			$limit_data[$i]['credit'] = $row['credit'];
    			$limit_data[$i]['amount'] = $row['amount'];
    			$limit_data[$i]['iipay_transaction_number'] = $row['ipayy_transaction_number'];
    			$limit_data[$i]['cc_avanue_transaction_number'] = $row['cc_avanue_transaction_number'];
    			$limit_data[$i]['cheque_number'] = $row['cheque_number'];
    			$limit_data[$i]['bank'] = $row['bank'];
                $limit_data[$i]['online'] = $row['online'];
    			$limit_data[$i]['payment_type'] = $row['payment_type'];
                $limit_data[$i]['credit_type_id'] = $row['credit_type_id'];
                $limit_data[$i]['payment_type_id'] = $row['payment_type_id'];
    			$limit_data[$i]['payment_status'] = $row['payment_status'];
    			$limit_data[$i]['credit_type'] = $row['credit_type'];
                $limit_data[$i]['payment_id'] = $row['payment_id'];
                $limit_data[$i]['credit_plan'] = $row['name'];
                $limit_data[$i]['offer_note'] = $row['offer_note'];
    			$i++;

    		}
    		return $limit_data;
    	}
    	else{
    		return false;
    	}
    }

    function get_user_total_credit()
    {
    	$strSQL = "SELECT SUM(credit) AS total_credit , COUNT(credit) AS count_credit FROM user_credits WHERE user_id = '".$this->user_id."'";
    	$rsRES 	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        $this->total_records =  mysql_result($rsRES,0,'count_credit');
    	if(mysql_num_rows($rsRES) > 0){
    		$this->total_credit = mysql_result($rsRES,0,'total_credit');
    		return true;
    	}
    	else{
            $this->total_credit = 0;
    		return false;
    	}
    }


    function get_list_array($start_record = 0,$max_records = 25)
    {

        $strSQL = "SELECT UC.id,UC.date,UC.credit, UC.credit_type_id, UC.payment_id, UC.offer_note, P.amount, P.payment_type_id,P.ipayy_transaction_number,P.cc_avanue_transaction_number,P.cheque_number,P.bank,PT.name as payment_type, PT.online, PS.name as payment_status,CT.name as credit_type,CP.name
                    FROM user_credits UC
                    LEFT JOIN payments P ON P.id = UC.payment_id
                    LEFT JOIN payment_types PT ON PT.id = P.payment_type_id
                    LEFT JOIN payment_statuses PS ON PS.id = P.payment_status_id
                    LEFT JOIN credit_types CT ON CT.id = UC.credit_type_id
                    LEFT JOIN credit_plans CP ON CP.id = UC.credit_plan_id";
        $strSQL_where = "";
        if($this->user_id != "" and  $this->user_id != gINVALID){
            $strSQL_where .= " UC.user_id = '".$this->user_id."'";
        }
        if($this->organization_id > 0){
            if($strSQL_where != ""){
                $strSQL_where .= " AND";
            }
            $strSQL_where .= "  UC.organization_credit_id in(SELECT id FROM organization_credits WHERE organization_id = '".$this->organization_id."')";
            
        }
        if($strSQL_where != ""){
            $strSQL.= " WHERE".$strSQL_where;
        }
        $strSQL .= " ORDER BY UC.id DESC ";        
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        //echo $strSQL;//exit();
        $rsRES = mysql_query($strSQL_limit,$this->connection) or die(mysql_error().$strSQL_limit);
        if(mysql_num_rows($rsRES) > 0){

            $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
            $this->total_records = mysql_num_rows($all_rs);

            $limit_data = array();$i=0;
            while($row = mysql_fetch_assoc($rsRES))
            {
                $limit_data[$i]['id'] = $row['id'];
                $limit_data[$i]['date'] = $row['date'];
                $limit_data[$i]['credit'] = $row['credit'];
                $limit_data[$i]['amount'] = $row['amount'];
                $limit_data[$i]['iipay_transaction_number'] = $row['ipayy_transaction_number'];
                $limit_data[$i]['cc_avanue_transaction_number'] = $row['cc_avanue_transaction_number'];
                $limit_data[$i]['cheque_number'] = $row['cheque_number'];
                $limit_data[$i]['bank'] = $row['bank'];
                $limit_data[$i]['online'] = $row['online'];
                $limit_data[$i]['payment_type'] = $row['payment_type'];
                $limit_data[$i]['payment_status'] = $row['payment_status'];
                $limit_data[$i]['credit_type'] = $row['credit_type'];
                $limit_data[$i]['id'] = $row['id'];
                $limit_data[$i]['credit_type_id'] = $row['credit_type_id'];
                $limit_data[$i]['payment_type_id'] = $row['payment_type_id'];
                $limit_data[$i]['payment_id'] = $row['payment_id'];
                $limit_data[$i]['credit_plan'] = $row['name'];
                 $limit_data[$i]['offer_note'] = $row['offer_note'];
                $i++;

            }
            return $limit_data;
        }
        else{
            return false;
        }
    }


    function get_detail()
    {
        $strSQL = "SELECT * FROM user_credits WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0){
            $this->id = mysql_result($rsRES, 0, 'id');
            $this->date = mysql_result($rsRES, 0, 'date');
            $this->credit_type_id = mysql_result($rsRES, 0, 'credit_type_id');
            $this->payment_id = mysql_result($rsRES, 0, 'payment_id');
            $this->user_id = mysql_result($rsRES, 0, 'user_id');
            $this->user_test_id = mysql_result($rsRES, 0, 'user_test_id');
            $this->user_report_id = mysql_result($rsRES, 0, 'user_report_id');
            $this->credit = mysql_result($rsRES, 0, 'credit');
            $this->credit_plan_id =mysql_result($rsRES, 0, 'credit_plan_id');
            $this->offer_note =mysql_result($rsRES, 0, 'offer_note');
            return true;
        }
        else{
            return false;
        }

    }


    function get_low_credit_users($limit)
    {
        $strSQL = "SELECT user_id,sum(credit) as total_credit FROM `user_credits` GROUP BY user_id HAVING sum(credit) >= ".$limit;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0)
        {
            $limit_data = array();$i=0;
            while($row = mysql_fetch_assoc($rsRES))
            {
                $limit_data[$i]['user_id'] = $row['user_id'];
                $limit_data[$i]['total_credit'] = $row['total_credit'];
                $i++;
            }
           return $limit_data;
        }
        else{
            return false;
        }

    }
       
}
?>
