<?php

$myquiz = new Quiz($myconnection);
$myquiz->connection = $myconnection;

$demotest = new DemoTest($myconnecion);
$demotest->connection 	= $myconnection;

$demotestdetails = new DemoTestDetails($myconnecion);
$demotestdetails->connection 	= $myconnection;

$myquestion = new Question($myconnection);
$myquestion->connection = $myconnection;

$mytimer = new Timer;
if(isset($_SESSION[SESSION_TITLE.'demotestid'])){
	//$_SESSION[SESSION_TITLE.'flash'] = "Please choose Demo Quiz from list.";
	header('Location:demo_test.php');
	exit();
}
else{//do nothing
	
	
}

if(isset($_REQUEST['id']))
{
	//get quiz details
	$quizid = $_REQUEST['id'];
	$myquiz->id = $quizid;
	$myquiz->get_details();
	$question_ids = "";
	if($myquiz->question_ids != ""){
		$question_ids .= $myquiz->question_ids;
	}

	//GET QUESTION IDS USING PASSAGE IDS
	if($myquiz->question_group_ids != ""){
		$question_ids_return = $myquestion->get_question_ids($myquiz->question_group_ids);
		if($question_ids_return == false){
			//do nothing
		}else{
			if($question_ids != ""){
				$question_ids .= ",".$question_ids_return;
			}else{
				$question_ids .= $question_ids_return;
			}

		}		
	}

	//GET TOTAL QUESTION COUNT
	$tot_question=explode(DEFAULT_ANSWER_KEY_DELIMITER,$question_ids);
	$tot_questions=count($tot_question);

	if($myquiz->quiz_type_id != DEMO_QUIZ ){
		$_SESSION[SESSION_TITLE.'flash'] = "Invalid Quiz.</br>Please choose Demo Quiz from list.";
		header( "Location: index.php");
		exit();
	}
}else{
	$_SESSION[SESSION_TITLE.'flash'] = "Please choose Demo Quiz from list.";
	header('Location:demo.php');
	exit();
}


//set through jquery
if (isset($_POST['test_start'])){
	//echo $question_ids;exit();
	$strERR="";
	if($_SESSION[SESSION_TITLE.'security_code']!=$_POST['txtcaptcha']){
	$strERR="The characters didn't match the picture. Please try again.";
	}
	
	if($strERR==""){
	$demotest->quiz_id 		= $myquiz->id;
	$demotest->test_status_id 	= TEST_STARTED;
	$demotest->used_time		='00:00:00';
	$demotest->total_time 		= $myquiz->total_time;
	$update = $demotest->update();
	if($update == true)
	{
		$_SESSION[SESSION_TITLE.'demotestid'] = $demotest->id;
		$orderby = ($myquiz->question_group_ids != "")?"question_group_id":"";
		$questions = $myquestion->get_list_array($question_ids,$orderby);
		$demotestdetails->demo_test_id=$demotest->id;
		$insert = $demotestdetails->insert_demo_test_details($questions);
		if($insert == true){
			//timer start
			
			$demotest->id = $_SESSION[SESSION_TITLE.'demotestid'];
			$demotest->get_details();
			$total_time_list = explode(":",$demotest->total_time);
			$used_time_list  = explode(":",$demotest->used_time);
			$total_time_in_seconds = ($total_time_list[0] * 60 * 60)+($total_time_list[1] * 60)+($total_time_list[2]);
			$used_time_in_seconds = ($used_time_list[0] * 60 * 60)+($used_time_list[1] * 60)+($used_time_list[2]);
			$mytimer->duration = $total_time_in_seconds-$used_time_in_seconds; 
			//echo $mytimer->duration;exit();
			$mytimer->initialize_timer_variables();
			
			header('Location:demo_test.php');
			exit();
		}
		else{
			$_SESSION[SESSION_TITLE.'flash'] = "Demo Test cant be start.";
		header('Location:'.$current_url);
		exit();
		}
	}
	else{
		$_SESSION[SESSION_TITLE.'flash'] = "Demo Test cant be start.";
		header('Location:'.$current_url);
		exit();
	}
	}else{
	$_SESSION[SESSION_TITLE.'flash'] = $strERR;
	header('Location:'.$current_url."?id=".$_REQUEST['id']);
	exit();
	}
}

?>
