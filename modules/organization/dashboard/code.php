

<?php //DASHBOARD

	
	$myquiz = new Quiz($myconnection);
	$myquiz->connection = $myconnection;
	$Mypagination = new Pagination(50);

	//$data_sample_quiz = $myquiz->get_list_array_bylimit("",SAMPLE_QUIZ,$Mypagination->start_record,$Mypagination->max_records);
	/*if ( $data_sample_quiz == false ){
			$count_sample_quiz=0;
			$mesg_sample_quiz = "No records found";
	}else{
		$count_sample_quiz=count($data_sample_quiz);
	}



	$data_real_quiz = $myquiz->get_list_array_bylimit("",REAL_QUIZ,$Mypagination->start_record,$Mypagination->max_records);
	if ( $data_real_quiz == false ){
			$count_real_quiz=0;
			$mesg_real_quiz = "No records found";
	}else{
		$count_real_quiz=count($data_real_quiz);
	}


*/
?>
