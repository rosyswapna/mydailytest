<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

 $myvoucherbill = new Voucher_bill();
 $myvoucherbill->connection = $myconnection;
 //$chk_user = $myvoucherbill->get_list_array();

$myagent=new Agent();
$myagent->connection = $myconnection;
$agents=$myagent->get_array();


//for pagination
	$Mypagination = new Pagination(10);
	$myvoucherbill->id='';
	$data_bylimit = $myvoucherbill->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
        $bill_statuses=$myvoucherbill->get_array_statuses();
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
	    
            $Mypagination->total_records = $myvoucherbill->total_records;
            $Mypagination->paginate();

        }


if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_submit ) {



    $myvoucherbill = new Voucher_bill();
    $myvoucherbill->connection = $myconnection;
	if($_POST['txtid']!=''){
   	$myvoucherbill->id = $_POST['txtid'];
	}
	if($_POST['txtname']!=''){
	$myvoucherbill->name = $_POST['txtname'];
	}
	if($_POST['lstagent']!=''){
	$myvoucherbill->agent_id = $_POST['lstagent'];
	}
	if($_POST['txtdate']!=''){
	$myvoucherbill->date = $_POST['txtdate'];
	}
	if($_POST['lstbillstatus']!=''){	
	$myvoucherbill->bill_status_id = $_POST['lstbillstatus'];
	}

  //check user exist or not
    //$chk = $myvoucherbill->exist();
	
	$data_bylimit = $myvoucherbill->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
	if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $myvoucherbill->total_records;
	 $Mypagination->paginate();
            $Mypagination->paginate();

        }
			

}
?>
