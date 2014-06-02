<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

 $myagent = new Agent($myconnection);
 $myagent->connection = $myconnection;
 //$chk_user = $myagent->get_list_array();



//for pagination
	$Mypagination = new Pagination(10);
	
	

        $data_bylimit = $myagent->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
        $agent_statuses=$myagent->get_list_array_agent_statuses();
	
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
	    $Mypagination->total_records = $myagent->total_records;
            $Mypagination->paginate();

        }


if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_submit ) {



    $myagent = new Agent();
    $myagent->connection = $myconnection;
	if($_POST['txtusername']!=''){
   	$myagent->username = $_POST['txtusername'];
	}
	if($_POST['txtemail']!=''){
	$myagent->email = $_POST['txtemail'];
	}
	if($_POST['txtname']!=''){
	$myagent->name = $_POST['txtname'];
	}
	$myagent->phone = $_POST['txtphone'];

if($_POST['txtagent_status']==-1){
	$myagent->agent_status_id ='';
}else{
$myagent->agent_status_id = $_POST['txtagent_status'];
}


  //check user exist or not
    //$chk = $myagent->exist();
	
	$data_bylimit = $myagent->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
	if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $myagent->total_records;
            $Mypagination->paginate();

        }
			

}
?>
