<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

//pagination
$record_per_page = 5;
$Mypagination = new Pagination($record_per_page);

if(isset($_GET['id'])){
	$user_test_id = $_GET['id'];
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
	$dat=$usertest->get_details(); 
   
	
	$total=$usertest->total_questions; 
	$correct=$usertest->correct_ans;
	$attempted=$usertest->attempted; 
	$incorrect=$attempted - $correct;
	
	/////////////////////USER TREND/////////////////////////////
	//$usertestreports = new UserTestReport($myconnecion);
	//$usertestreports->connection 	= $myconnection;
	//$data=$usertestreports->get_reports();
	$label='"Result"';
	$total=$usertest->total_questions; 
	$correct=$usertest->correct_ans;
	$attempted=$usertest->attempted; 
	$notattempted=$total-$attempted;
	$incorrect=$attempted - $correct;
	$datasets = array();
	$datasets[1]["name"] = "Correct";
	$datasets[1]["color"] = "#17C864";
	$datasets[1]["dataset"] = $correct;	
	$datasets[2]["name"] = "Incorrect";
	$datasets[2]["color"] = "#B40A0A";
	$datasets[2]["dataset"] = $incorrect;	
	$datasets[3]["name"] = "Not Attempted";
	$datasets[3]["color"] = "#F0C500";
	$datasets[3]["dataset"] = $notattempted;


	$mychartgraph_usertrend = new ChartGraph($myconnecion);
	$mychartgraph_usertrend->label = $label;	
	$mychartgraph_usertrend->datasets = $datasets;	

	
/////////////////////USER REPORTS BY QUIZ AVERAGE/////////////////////////////
	$usertestreports = new UserTestReport($myconnecion);
	$usertestreports->connection 	= $myconnection;
	$data=$usertestreports->get_reports();
	$label='"Result"';
	$total=  array_avg_by_key($data, "total"); 
	$correct=  array_avg_by_key($data, "correct"); 
	$attempted=  array_avg_by_key($data, "attempted"); 
	$incorrect=$attempted-$correct;	
	$datasets = array();

	$datasets[1]["name"] = "Correct";
	$datasets[1]["color"] = "#17C864";
	$datasets[1]["dataset"] = $correct;
	$datasets[2]["name"] = "Incorrect";
	$datasets[2]["color"] = "#B40A0A";
	$datasets[2]["dataset"] = $incorrect;
	$datasets[3]["name"] = "Attempted";
	$datasets[3]["color"] = "#CCC";
	$datasets[3]["dataset"] = $attempted;	
	$mychartgraph_useravge = new ChartGraph($myconnecion);
	$mychartgraph_useravge->label = $label;	
	$mychartgraph_useravge->datasets = $datasets;	

/////////////////////USER REPORTS BY SUBJECT/////////////////////////////
	$usertestreports = new UserTestReport($myconnecion);
	$usertestreports->connection = $myconnection;
	$question_id="";
	$subjects=$usertestreports->new_get_subject_reports($user_test_id);  
	$mychartgraph_subject_count=count($subjects);
	$label="";
	$attempted="";
	$correct="";
	$incorrect="";
	$total="";
	$unattempted="";
	$datasets = array();
	//echo "<pre>";print_r($subjects);echo "</pre>";
	if($subjects != false){
		foreach ($subjects as $subject){
			$label.='"'.$subject["name"].'",';
		    $attempted.=$subject["attempted"].',';	
		    $correct.=$subject["correct_answers"].',';			
		    $total.=$subject["number_of_questions"].',';
			$incorrect.=$subject["wrong_answers"].',';
			$unattempted.=($subject["number_of_questions"]-$subject["attempted"]).',';		
		}
		$label=substr($label, 0, -1);
		$attempted=substr($attempted, 0, -1);
		$correct=substr($correct, 0, -1);
		$total=substr($total, 0, -1);
		$incorrect=substr($incorrect, 0, -1);	
		$unattempted=substr($unattempted, 0, -1);
	}	

	$datasets[1]["name"] = "Correct";
	$datasets[1]["color"] = "#17C864"; //green
	$datasets[1]["dataset"] = $correct;
	$datasets[2]["name"] = "Incorrect";
	$datasets[2]["color"] = "#B40A0A"; //red
	$datasets[2]["dataset"] = $incorrect;
	$datasets[3]["name"] = "Attempted";
	$datasets[3]["color"] = "#CCC"; //yellow
	$datasets[3]["dataset"] = $attempted;	
	$datasets[4]["name"] = "Unattempted";
	$datasets[4]["color"] = "#F0C500"; //Ash
	$datasets[4]["dataset"] = $unattempted;	
	$mychartgraph = new ChartGraph($myconnecion);
	$mychartgraph->label = $label;	
	$mychartgraph->datasets = $datasets;
/////////////////////////////////////////////////////////////


	$quiz = new Quiz($myconnecion);
	$quiz->connection 	= $myconnection;
	$quiz->id = $usertest->quiz_id;
	
	$quiz->get_details();
	
	$current_qns_list = $usertestdetails->get_test_questions($Mypagination->start_record,$Mypagination->max_records); //print_r($current_qns_list);
	
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
}else{
	echo "Result not available";
	exit();
}	
///////////CHART GRAPH///////////////



										
?>
