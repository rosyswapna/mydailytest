<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}


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
	$user_test_id = $_GET['id'];
}else if(isset($_REQUEST['hd_usertestid'])){
	$user_test_id = $_REQUEST['hd_usertestid'];	
}

	$usertest = new UserTest($myconnecion);
	$usertest->connection 	= $myconnection;
    $usertest->id = $user_test_id;
	$usertest->get_report(); 


	//get test mark for each rules
	$usertestrules = new UserTestRules($myconnecion);
	$usertestrules->connection 	= $myconnection;
	$usertestrules->user_test_id = $user_test_id;
	$user_marks = $usertestrules->get_test_mark_for_each_rule();
	


	$usertestdetails = new UserTestDetails($myconnecion);
	$usertestdetails->connection 	= $myconnection;
	$usertestdetails->user_test_id = $user_test_id;
	//////////////////GET RESULT IN SINGLE QUERY//////////////////
	$usertest->id = $user_test_id;
	$usertest->get_details();
    $attempted=$usertest->attempted; 
	$correct_ans=$usertest->correct_ans;
	$total_questions=$usertest->total_questions;
	$wrong_ans=$attempted - $correct_ans;
	
	/////////////////////USER REPORTS BY QUIZ AVERAGE/////////////////////////////
	/*$usertestreports = new UserTestReport($myconnecion);
	$usertestreports->connection 	= $myconnection;
	$quiz_id=""; $user_id="";$user_test_id=""; 
	$data=$usertestreports->get_reports($quiz_id,$user_id);
	$avg_total=  array_avg_by_key($data, "total"); 
	$avg_user=  array_avg_by_key($data, "correct"); 
	$avg_attempted=  array_avg_by_key($data, "attempted"); 
	$avg_wrong=$avg_attempted-$avg_user;  //echo $avg_wrong; echo "avg user".$avg_user;*/

/////////////////////USER REPORTS BY SUBJECT/////////////////////////////
	/*$usertestreports = new UserTestReport($myconnecion);
	$usertestreports->connection = $myconnection;
	$question_id="";
	$subjects=$usertestreports->get_subject_reports($usertest->quiz_id);  
	$label="";
	$attempted="";
	$correct="";
	$total="";
	$datasets = array();
	foreach ($subjects as $subject){
		$label.='"'.$subject["name"].'",';
	    $attempted.=$subject["avg_attempted"].',';	
	    $correct.=$subject["avg_correct"].',';			
	    $total.=$subject["total_questions"].',';		
	}
	$label=substr($label, 0, -1);
	$attempted=substr($attempted, 0, -1);
	$correct=substr($correct, 0, -1);
	$total=substr($total, 0, -1);	
	$datasets[1]["name"] = "Attempted";
	$datasets[1]["color"] = "#B40A0A";
	$datasets[1]["dataset"] = $attempted;
	$datasets[2]["name"] = "Correct";
	$datasets[2]["color"] = "#17C864";
	$datasets[2]["dataset"] = $correct;
	$datasets[3]["name"] = "Total";
	$datasets[3]["color"] = "#F0C500";
	$datasets[3]["dataset"] = $total;
	$mychartgraph = new ChartGraph($myconnecion);
	$mychartgraph->label = $label;	
	$mychartgraph->datasets = $datasets;*/
/////////////////////////////////////////////////////////////
	$quiz = new Quiz($myconnecion);
	$quiz->connection 	= $myconnection;
	$quiz->id = $usertest->quiz_id;
	
	$quiz->get_details();
	
	$current_qns_list = $usertestdetails->get_test_questions($Mypagination->start_record,$Mypagination->max_records);
	
	$total_questions			= $usertestdetails->total_records;
	$total_questions_answered	= $usertestdetails->get_count("user_keys <> '-1'");
	$total_correct_answers		= $usertestdetails->get_count("user_keys = answer_keys");
	$total_wrong_answers		= $usertestdetails->get_count("user_keys  <> answer_keys AND user_keys <> -1");
	$attempted=$total_wrong_answers + $total_correct_answers;
	$notattempted=$total_questions-$attempted;
	
	$Mypagination->total_records = $usertestdetails->total_records;
	$Mypagination->paginate();
	$count_data=count($current_qns_list);
	if($count_data > 0){
		//pagination
		
	}else{
		$mesg = "No Records Found";
	}
	
///////////CHART GRAPH///////////////



										
?>
