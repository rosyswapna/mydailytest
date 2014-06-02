<?php //USER HISTORY

	$usertest = new UserTest($myconnection);
	$usertest->connection = $myconnection;
	$Mypagination = new Pagination(3);
	
	$data_bylimit = $usertest->get_list_array_bylimit($_SESSION[SESSION_TITLE.'userid'],$Mypagination->start_record,$Mypagination->max_records);
	//print_r($data_bylimit); exit();
	
	 $counts=count($data_bylimit);
	
	if ( $data_bylimit == false ){
	$mesg = "No records found";
	}else{
	$count_data_bylimit=count($data_bylimit);
	$Mypagination->total_records = $usertest->total_records;
	$Mypagination->paginate();
	
	}
?>