<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class OrganizationCredit {

	var $connection;
    var $id = gINVALID;
    var $date = "";
    var $credit_type_id = "";
    var $payment_id = "";
    var $organization_id = "";
    var $credit = "";
    var $credit_plan_id ="";
    var $offer_note ="";

    var $total_credit ="";

    var $error_number = "";
  	var $error_description = "";

    //for pagination
    var $total_records = "";




    function update()
    {
        if($this->id == "" || $this->id == gINVALID)
        {
            $strSQL = "INSERT INTO organization_credits(date,credit_type_id,payment_id,organization_id,credit,credit_plan_id, offer_note) VALUES('";
            $strSQL .= CURRENT_DATETIME."','";
            $strSQL .= mysql_real_escape_string(trim($this->credit_type_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->payment_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->organization_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->credit))."','";
             $strSQL .= mysql_real_escape_string(trim($this->credit_plan_id))."','";
            $strSQL .= mysql_real_escape_string(trim($this->offer_note))."')";//echo $strSQL;exit();
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
            if(mysql_affected_rows($this->connection)>0){
                $this->id = mysql_insert_id();
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $strSQL = "UPDATE organization_credits SET ";
            $strSQL .= "date ='".CURRENT_DATETIME."',";
            $strSQL .= "credit_type_id ='".mysql_real_escape_string(trim($this->credit_type_id))."',";
            $strSQL .= "payment_id ='".mysql_real_escape_string(trim($this->payment_id))."',";
            $strSQL .= "organization_id ='".mysql_real_escape_string(trim($this->organization_id))."',";
            $strSQL .= "credit ='".mysql_real_escape_string(trim($this->credit))."',";
            $strSQL .= "offer_note ='".mysql_real_escape_string(trim($this->offer_note))."',";
            $strSQL .= "credit_plan_id ='".mysql_real_escape_string(trim($this->credit_plan_id))."'";
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


    function get_organization_credit_list_array()
    {

    	$strSQL = "SELECT OC.id,OC.date,OC.credit,OC.credit_type_id, OC.payment_id,OC.offer_note, P.amount, P.payment_type_id, P.ipayy_transaction_number,P.cc_avanue_transaction_number,P.cheque_number,P.bank,PT.name as payment_type, PT.online, PS.name as payment_status,CT.name as credit_type,CP.name
					FROM organization_credits OC
					LEFT JOIN payments P ON P.id = OC.payment_id
					LEFT JOIN payment_types PT ON PT.id = P.payment_type_id
					LEFT JOIN payment_statuses PS ON PS.id = P.payment_status_id
					LEFT JOIN credit_types CT ON CT.id = OC.credit_type_id
                    LEFT JOIN credit_plans CP ON CP.id = OC.credit_plan_id
					WHERE OC.organization_id = '".$this->organization_id."' ORDER BY OC.id DESC LIMIT ".LIMIT_CREDITS;

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

    function get_organization_total_credit()
    {
    	$strSQL = "SELECT SUM(credit) AS total_credit , COUNT(credit) AS count_credit FROM organization_credits WHERE organization_id = '".$this->organization_id."'";
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

        $strSQL = "SELECT OC.id,OC.date,OC.credit, OC.credit_type_id, OC.payment_id, OC.offer_note, P.amount, P.payment_type_id,P.ipayy_transaction_number,P.cc_avanue_transaction_number,P.cheque_number,P.bank,PT.name as payment_type, PT.online, PS.name as payment_status,CT.name as credit_type,CP.name
                    FROM organization_credits OC
                    LEFT JOIN payments P ON P.id = OC.payment_id
                    LEFT JOIN payment_types PT ON PT.id = P.payment_type_id
                    LEFT JOIN payment_statuses PS ON PS.id = P.payment_status_id
                    LEFT JOIN credit_types CT ON CT.id = OC.credit_type_id
                    LEFT JOIN credit_plans CP ON CP.id = OC.credit_plan_id";

        if($this->organization_id != "" and  $this->organization_id != gINVALID){
            $strSQL .= " WHERE OC.organization_id = '".$this->organization_id."'";
        }
        $strSQL .= " ORDER BY OC.id DESC ";        
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        //echo $strSQL_limit;exit();
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
        $strSQL = "SELECT * FROM organization_credits WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0){
            $this->id = mysql_result($rsRES, 0, 'id');
            $this->date = mysql_result($rsRES, 0, 'date');
            $this->credit_type_id = mysql_result($rsRES, 0, 'credit_type_id');
            $this->payment_id = mysql_result($rsRES, 0, 'payment_id');
            $this->organization_id = mysql_result($rsRES, 0, 'organization_id');
            $this->credit = mysql_result($rsRES, 0, 'credit');
            $this->credit_plan_id =mysql_result($rsRES, 0, 'credit_plan_id');
            $this->offer_note =mysql_result($rsRES, 0, 'offer_note');
            return true;
        }
        else{
            return false;
        }

    }


    function get_low_credit_organizations($limit)
    {
        $strSQL = "SELECT organization_id,sum(credit) as total_credit FROM `organization_credits` GROUP BY organization_id HAVING sum(credit) >= ".$limit;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0)
        {
            $limit_data = array();$i=0;
            while($row = mysql_fetch_assoc($rsRES))
            {
                $limit_data[$i]['organization_id'] = $row['organization_id'];
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
