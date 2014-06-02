<?php //DASHBOARD
$mytimer = new Timer;

if(isset($_SESSION[SESSION_TITLE.'demotestid'])) {
	$mytimer->stop();
	$_SESSION[SESSION_TITLE.'demotestid'] = "";
	unset($_SESSION[SESSION_TITLE.'demotestid']);
}

	
$myquiz = new Quiz($myconnection);
$myquiz->connection = $myconnection;
$Mypagination = new Pagination(50);

$myquiz->special_demo = SPECIAL_DEMO_FALSE;
$data_demo_quiz = $myquiz->get_list_array_bylimit("",DEMO_QUIZ,$Mypagination->start_record,$Mypagination->max_records,"","exam_id");
if ( $data_demo_quiz == false ){
		$count_demo_quiz=0;
		$mesg_demo_quiz = "No records found";
}else{//print_r($data_demo_quiz);exit();
	$count_demo_quiz=count($data_demo_quiz);
}




?>
