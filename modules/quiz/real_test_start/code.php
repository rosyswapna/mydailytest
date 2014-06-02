<?php

// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}


//Timer
$mytimer = new Timer;

//class quiz
$myquiz = new Quiz($myconnection);
$myquiz->connection = $myconnection;

//class_quiz details
$myquizdetail = new QuizDetail($myconnection);
$myquizdetail->connection = $myconnection;

//class user credit
$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;

//user test
$usertest = new UserTest($myconnecion);
$usertest->connection 	= $myconnection;

//user test details
$usertestdetails = new UserTestDetails($myconnection);
$usertestdetails->connection 	= $myconnection;

//user test rules
$usertestrules = new UserTestRules($myconnecion);
$usertestrules->connection 	= $myconnection;


//get user credit details
$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;
$myusercredit->user_id = $_SESSION[SESSION_TITLE.'userid'];
$myusercredit->get_user_total_credit();

$short_time = "";$test_end = "";


if(isset($_GET['id']))
{
	//get quiz details
	$quizid = $_GET['id'];
	$myquiz->id = $quizid;
	$myquiz->get_details();
	$myquizdetail->quiz_id = $myquiz->id;
	$my_quiz_details = $myquizdetail->get_quiz_details();
	$tot_questions = $myquizdetail->get_real_quiz_question_count_and_mark();
	$error = check_time_based_test($myquiz->period_from, $myquiz->period_to, $myquiz->time_from, $myquiz->time_to,$myquiz->total_time);
	$error_description = time_based_test_errors($error);
	if($error == 103){
		$test_end = $myquiz->period_to." ".$myquiz->time_to;
		$balance = strtotime($test_end) - strtotime(CURRENT_DATETIME);
		$h = sprintf("%02s",floor($balance/3600));;
		$m = sprintf("%02s",$balance/60%60);
		$s = sprintf("%02s",$balance%60);
		$short_time = $h.":".$m.":".$s;
	}

}
else
{
	header('Location:index.php');
	exit();
}



if(isset($_SESSION[SESSION_TITLE.'usertestid'])){
	$current_quiz = "";
	$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
	$usertest->get_details();
	$current_quiz_details = $myquiz->get_details_with_id($usertest->quiz_id);
	if($current_quiz_details == false){
	}
	else{
		$current_quiz = "Currently you are running on another test , ".$current_quiz_details['name'].".";
	}

}
else{
	if($myquiz->credit > $myusercredit->total_credit ){ //if enough credit balace then go to test
		$_SESSION[SESSION_TITLE.'flash'] = "You do not have enough balance in your account . Please recharge.";
		header("Location:get_credit.php");
		exit();
	}
}





//if start new test
if(isset($_POST['submit']))
{

	if($_POST['submit'] == "Cancel")
	{
			header('Location:dashboard.php');exit();
	}
	if($_POST['submit'] == "Continue")
	{
			header('Location:test.php');exit();
	}

	if($_POST['hd_mode'] == 'pause')
	{
		$quizid = $_POST['hd_quizid'];
		$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
		$usertest->get_details();
		if($_SESSION[SESSION_TITLE.'userid'] ==$usertest->user_id)
		{
			$usertest->used_time =  date('H:i:s',(strtotime(CURRENT_DATETIME) - strtotime($usertest->resumed_time))+strtotime($usertest->used_time));
			$usertest->pause();
			$mytimer->stop();
			$_SESSION[SESSION_TITLE.'usertestid']="";
			unset($_SESSION[SESSION_TITLE.'usertestid']);

			if($myquiz->credit > $myusercredit->total_credit ){ //if enough credit balace then go to test
				$_SESSION[SESSION_TITLE.'flash'] = "You do not have enough EXAM CREDITS to take a QUIZ now.Please choose a Credit Plan and pay through your Mobile to recharge your account.";
				header("Location:get_credit.php");
				exit();
			}
	    }
	    else{
	    	//do nothing
	    } 
	}
	
	$balance_time_for_timebased_test = $_POST['hd_balancetime'];


	//check time based real test
	$error_description = time_based_test_errors($error);
	
	if($error_description == false or $error == 103)
	{
		//insert user test (new user test started)
		$usertest->user_id 		= $_SESSION[SESSION_TITLE.'userid'];
		$usertest->quiz_id 		= $_POST['hd_quizid'];
		$usertest->test_status_id = TEST_STATUS_STARTED;
		if($balance_time_for_timebased_test != ""){
			$used_time_in_seconds = strtotime($myquiz->total_time) - $balance_time_for_timebased_test;
			$usertest->used_time = date('H:i:s',$used_time_in_seconds);
		}else{
			$usertest->used_time	='00:00:00';
		}
		$usertest->total_time = $myquiz->total_time;
		$usertest->update();


		//if real quiz ,then random questions
		if($myquiz->quiz_type_id == REAL_QUIZ) { 
	       $myquizdetail->quiz_id = $myquiz->id;
	       $usertestdetails ->user_id = $_SESSION[SESSION_TITLE.'userid'];
	       $quiz_details = $myquizdetail->get_quiz_details();
	       $usertestdetails->quiz_details = $quiz_details;
	       $test_questions = $usertestdetails->generate_test_questions();
	       if($test_questions == false ){
				// if questions not generated - delete user test
				$usertest->delete();
				$_SESSION[SESSION_TITLE.'flash'] = "Test question generation failed";
				header( "Location: index.php");
				exit();
	       }
	       else{			
				//insert generated questions to user test details
				$usertestdetails->user_test_id = $usertest->id;
				$check_usertestdetails = $usertestdetails->insert_test_details($test_questions);

				//insert test rules details
				$usertestrules->user_test_id = $usertest->id;//print_r($quiz_details);exit();
				$usertestrules->insert_batch($quiz_details);



				if($check_usertestdetails == true){
					//insert generated questions done
					//set test id to session
					$_SESSION[SESSION_TITLE.'usertestid'] = $usertest->id;

					//deduct credit balace
					$myusercredit->user_id = $_SESSION[SESSION_TITLE.'userid'];
					$myusercredit->credit_type_id 	= CREDIT_TYPE_TEST;
					$myusercredit->user_test_id		= $_SESSION[SESSION_TITLE.'usertestid'];
					$myusercredit->credit 			= -$myquiz->credit;
					$update = $myusercredit->update();
					$_SESSION[SESSION_TITLE.'user_credit']=  $myusercredit->total_credit - $myquiz->credit;
					//timer start
					$total_time_list = explode(":",$usertest->total_time);
					$total_time_in_seconds = ($total_time_list[0] * 60 * 60)+($total_time_list[1] * 60)+($total_time_list[2]);
					$used_time_list  = explode(":",$usertest->used_time);
					$used_time_in_seconds = ($used_time_list[0] * 60 * 60)+($used_time_list[1] * 60)+($used_time_list[2]);

					$mytimer->duration = $total_time_in_seconds-$used_time_in_seconds; 
					$mytimer->initialize_timer_variables();
					header('Location:test.php');
				}else{
					// if questions not inserted to user test details - delete user test
					$usertest->delete();
					header('Location:index.php');
					exit();	
				}



	       }
	   }else{ // if not real quiz redirect
				$_SESSION[SESSION_TITLE.'flash'] = "Quiz Type disabled";
				header( "Location: index.php");
				exit();
	   }
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $error_description;
		header( "Location: index.php");
		exit();
	}
}







?>
