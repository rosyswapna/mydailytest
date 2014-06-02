<?php
$myquiz = new Quiz($myconnecion);
$myquiz->connection 	= $myconnection;

$demotest = new DemoTest($myconnecion);
$demotest->connection 	= $myconnection;

$demotestdetails = new DemoTestDetails($myconnecion);
$demotestdetails->connection 	= $myconnection;



if(isset($_GET["id"]) )
{
	$demotest->id = $_GET["id"];
	$demotest->get_details();
	$demotest->get_report();

	$myquiz->id = $demotest->quiz_id;
	$myquiz->get_details();
	if($myquiz->quiz_type_id == DEMO_QUIZ ){
		$demotestdetails->demo_test_id = $demotest->id;
		$current_qns_list = $demotestdetails->get_test_questions();
		//print_r($current_qns_list);exit();
		$count_data=count($current_qns_list);
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = "Invalid Quiz.</br>Please choose Demo Quiz from list.";
		header( "Location: index.php");
		exit();
	}
	$label='"Result"';
	$attempted=$demotest->attempted;
	$correct=$demotest->correct_ans;
	$total_questions=$demotest->total_questions;
	$incorrect=$attempted - $correct;
	$notattempted =$total_questions- $attempted;
	/////////////////

	$incorrect=$attempted-$correct;	
	$datasets = array();

	$datasets[1]["name"] = "Correct";
	$datasets[1]["color"] = "#17C864";
	$datasets[1]["dataset"] = $correct;
	$datasets[2]["name"] = "Incorrect";
	$datasets[2]["color"] = "#B40A0A";
	$datasets[2]["dataset"] = $incorrect;
	$datasets[3]["name"] = "Not Attempted";
	$datasets[3]["color"] = "#FFBF00";
	$datasets[3]["dataset"] = $notattempted;	
	$mychartgraph_useravge = new ChartGraph($myconnecion);
	$mychartgraph_useravge->label = $label;	
	$mychartgraph_useravge->datasets = $datasets;	
	
	////////////////
}
else{
	$_SESSION[SESSION_TITLE.'flash'] = "Invalid Test.";
	header( "Location: index.php");
	exit();
}
	
?>
