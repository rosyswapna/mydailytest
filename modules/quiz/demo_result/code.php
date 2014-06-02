<?php 

//pagination
if(isset($_REQUEST['lstrecord_per_page'])){
	$record_per_page = $_REQUEST['lstrecord_per_page'];
}elseif (isset($_GET['rpp'])) {
	$record_per_page = $_GET['rpp'];
}else{
	$record_per_page = 10;
}



$Mypagination = new Pagination($record_per_page);

if(isset($_GET['id'])){
	$demo_test_id = $_GET['id'];
}else if(isset($_REQUEST['hd_demo_test_id'])){
	$demo_test_id = $_REQUEST['hd_demo_test_id'];	
}
///
$myquiz = new Quiz($myconnecion);
$myquiz->connection 	= $myconnection;

$demotest = new DemoTest($myconnecion);
$demotest->connection 	= $myconnection;

$demotestdetails = new DemoTestDetails($myconnecion);
$demotestdetails->connection 	= $myconnection;

$myquestion = new Question($myconnection);
$myquestion->connection = $myconnection;


//pagination
if(isset($_REQUEST['lstrecord_per_page'])){
	$record_per_page = $_REQUEST['lstrecord_per_page'];
}elseif (isset($_REQUEST['rpp'])) {
	$record_per_page = $_REQUEST['rpp']; 
}else{
	$record_per_page = 10;
}


$Mypagination = new Pagination($record_per_page);

if(isset($_GET['id']))
{
	$demo_test_id = $_GET['id'];
	
    $demotest->id = $demo_test_id;
	$demotest->get_report(); 
	$demotest->id = $demo_test_id;
	$demotest->get_details();

	$myquiz->id = $demotest->quiz_id;
	$myquiz->get_details();
	if($myquiz->quiz_type_id == DEMO_QUIZ ){
		$demotestdetails->demo_test_id = $demotest->id;
		$current_qns_list = $demotestdetails->get_test_questions($Mypagination->start_record,$Mypagination->max_records);
		//print_r($current_qns_list);exit();
		$count_data=count($current_qns_list);
		$Mypagination->total_records = $demotestdetails->total_records;
		$Mypagination->paginate();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = "Invalid Quiz.</br>Please choose Demo Quiz from list.";
		header( "Location: index.php");
		exit();
	}

    $attempted=$demotest->attempted;
	$correct_ans=$demotest->correct_ans;
	$total_questions=$demotest->total_questions;
	$wrong_ans=$attempted - $correct_ans;
	$notattempted =$total_questions- $attempted;

	
}
else{
		//donothing
}

?>