<?php

function check_time_based_test($period_from = "", $period_to = "", $time_from = "", $time_to = "", $total_time= "")
{
	$error = 100;

	//calculate total time in seconds
	$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $total_time);
	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
	$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

	//test start time
	if($period_from == "" or $period_from == "0000-00-00"){
		$period_from = CURRENT_DATE;
	}
	if($time_from == "" or $time_from == "00:00:00"){
		$time_from = CURRENT_TIME;
	}
	$test_start = $period_from." ".$time_from;

	//test end time
	if(($period_to == "" or $period_to == "0000-00-00") and ($time_to == "" or $time_to == "00:00:00")){
		$test_end = false;
	}elseif ($period_to == "" or $period_to == "0000-00-00") {
		$test_end = CURRENT_DATE." ".$time_to;
	}elseif($time_to == "" or $time_to == "00:00:00"){
		$test_end = $period_to." 23:00:00";
	}else{
		$test_end = $period_to." ".$time_to;
	}

	//condition for check start and end time period for test
	if(strtotime($test_start) <= strtotime(CURRENT_DATETIME)){ //test started
		if($test_end == false){//no end time
			$error = 100;
		}else{
			$balance = strtotime($test_end) - strtotime(CURRENT_DATETIME);
			if($balance >= $time_seconds){
				$error = 100;
			}elseif($balance <= 0){
				$error = 102;
			}else{
				$error = 103;
			}
		}
	}else{ //test not started yet
		$error = 101;
	}
	
	return $error;
}



function time_based_test_errors($error)
{
	$error_description = "";
	switch($error)
	{
		case 100:$error_description = false;break;
		case 101:$error_description = "Test not started yet";break;
		case 102:$error_description = "Test not availabe at this time";break;
		case 103:$error_description = "You does not have much time . Do you want to continue ,click start";
	}
	return $error_description;
}

?>