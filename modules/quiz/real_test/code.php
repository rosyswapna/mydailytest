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
$usertestdetails = new UserTestDetails($myconnecion);
$usertestdetails->connection 	= $myconnection;

//user test rules
$usertestrules = new UserTestRules($myconnecion);
$usertestrules->connection 	= $myconnection;

//user test report subject wise
$usertestreportsubjectwise = new UserTestReportSubjectWise($myconnecion);
$usertestreportsubjectwise->connection 	= $myconnection;

//start
if(isset($_SESSION[SESSION_TITLE.'usertestid']))
{
	$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
	$usertest->user_id 		= $_SESSION[SESSION_TITLE.'userid'];
	$chk = $usertest->check();//check usertest id with userid who logged in current session
	if($chk == true)
	{
		$usertestdetails->user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
		$chk_test_details = $usertestdetails->exist();//check test details prepared
		if($chk_test_details == true){
			if(!isset($_SESSION[SESSION_TITLE.'duration']))
			{
				$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
				$usertest->get_details();
				$total_time_list = explode(":",$usertest->total_time);
				$used_time_list  = explode(":",$usertest->used_time);
				$total_time_in_seconds = ($total_time_list[0] * 60 * 60)+($total_time_list[1] * 60)+($total_time_list[2]);
				$used_time_in_seconds = ($used_time_list[0] * 60 * 60)+($used_time_list[1] * 60)+($used_time_list[2]);
				$mytimer->duration = $total_time_in_seconds-$used_time_in_seconds; //echo $mytimer->duration;exit();
			}
			$mytimer->initialize_timer_variables();
			$current_qns_list = $usertestdetails->get_test_questions($Mypagination->start_record,$Mypagination->max_records);
			$count_data=count($current_qns_list);//echo $candidate->total_records;exit();
			$Mypagination->total_records = $usertestdetails->total_records;
			$Mypagination->paginate();
		}else{
			//questions not generated
			unset($_SESSION[SESSION_TITLE.'usertestid']);
			$_SESSION[SESSION_TITLE.'flash'] = "Invalid Test. Contact System Administrator.";
	        header( "Location: index.php");
	        exit();	
		}

	}
	else{
		//invalid user
		$_SESSION[SESSION_TITLE.'flash'] = "Invalid user.";
		header('Location:index.php');exit();
	}

}
else{
	$_SESSION[SESSION_TITLE.'flash'] = "Please choose test";
	header('Location:dashboard.php');exit();
}




//Quit user test
if(isset($_POST["hd_quit"]))
{
	//find used time 
	$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
	$usertest->get_details();
	$timeTaken = strtotime(CURRENT_DATETIME)-strtotime($usertest->resumed_time);
	$usertest->used_time = date('H:i:s',strtotime($usertest->used_time)+$timeTaken);
	$usertest->test_status_id = TEST_STATUS_FINISHED; 

	//find test marks and update user test rules table
	$usertestrules->user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
	$markList =$usertestrules->calculate_user_mark_for_each_rule();
	if($markList == false){//mark not calculated
	}
	else{
		$usertestrules->update_batch($markList);
	}
	
	//generate data array for subject wise report table
	$usertestdetails->user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
	$dataArray = $usertestdetails->get_list_array_for_report_subject_wise();
	//insert data
	$usertestreportsubjectwise->user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
	$check = $usertestreportsubjectwise->check();//check report exist for this usertestid
	if($check == false){
		$usertestreportsubjectwise->update_batch($dataArray);
	}
	
	//update user test (user test finished)
	$usertest->update();
	
	//finish test
	$_SESSION[SESSION_TITLE.'usertestid'] = "";
	unset($_SESSION[SESSION_TITLE.'usertestid']);

	//stop timer
	$mytimer->stop();
	header("Location:index.php");exit();
}


if(isset($_POST["submit"]) and $_POST["submit"] == "Display Flagged questions")
{
	//------------block for user key update start here----------
	$dataArray = get_user_key_data_array($_POST);
	if(count($dataArray) > 0) //then update userkey batch
	{
		$usertestdetails->user_keys_batch = $dataArray; 
		$update = $usertestdetails->update_userkeys_batch();
	}
	//------------block for user key update ends here----------
		$chk_flag=1;
		$usertestdetails = new UserTestDetails($myconnecion);
		$usertestdetails->connection 	= $myconnection;
		$usertestdetails->user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
		$filter = " AND UTD.flag = 1";
		$current_qns_list = $usertestdetails->get_test_questions($Mypagination->start_record,$Mypagination->max_records,$filter);
		$count_data=count($current_qns_list);//echo $candidate->total_records;exit();
		$Mypagination->total_records = $usertestdetails->total_records;
		$Mypagination->paginate();
		
		if($current_qns_list==false)
			$mesg = "No Records Found";
		else
			$mesg = "";
}

if(isset($_POST["submit"]) and $_POST["submit"] == "Finish")
{
	//------------block for user key update start here----------
	$dataArray = get_user_key_data_array($_POST);
	if(count($dataArray) > 0) //then update userkey batch
	{
		$usertestdetails->user_keys_batch = $dataArray; 
		$update = $usertestdetails->update_userkeys_batch();
	}
	//------------block for user key update ends here----------

	if(isset($_SESSION[SESSION_TITLE.'usertestid']))
	{
		//find used time 
		$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
		$usertest->get_details();
		$timeTaken = strtotime(CURRENT_DATETIME)-strtotime($usertest->resumed_time);
		//update user test (user test finished)
		
		$usertest->used_time = date('H:i:s',strtotime($usertest->used_time)+$timeTaken);
		$usertest->test_status_id = TEST_STATUS_FINISHED; 
		

	
		//find test marks and update user test rules table
		$usertestrules->user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
		$markList =$usertestrules->calculate_user_mark_for_each_rule();
		if($markList == false){//mark not calculated
		}
		else{
			$usertestrules->update_batch($markList);
		}

		
		
		//generate data array for subject wise report table
		$usertestdetails->user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
		$dataArray = $usertestdetails->get_list_array_for_report_subject_wise();
		//insert data
		$usertestreportsubjectwise->user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
		$check = $usertestreportsubjectwise->check();//check report exist for this usertestid
		if($check == false){
			$usertestreportsubjectwise->update_batch($dataArray);
		}
		


		$usertest->update();
		
		//finish test
		$user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
		$_SESSION[SESSION_TITLE.'usertestid'] = "";
		unset($_SESSION[SESSION_TITLE.'usertestid']);

		//stop timer
		$mytimer->stop();
		header("Location:result.php?id=".$user_test_id);exit();
	}
}


//trigger on change lstrecords
if(isset($_POST["submit"]) and $_POST["submit"] == "HD_submit")
{
		
		$usertestdetails = new UserTestDetails($myconnecion);
		$usertestdetails->connection 	= $myconnection;
		$usertestdetails->user_test_id = $_SESSION[SESSION_TITLE.'usertestid'];
		$filter = "";
		$current_qns_list = $usertestdetails->get_test_questions($Mypagination->start_record,$Mypagination->max_records,$filter);
		$count_data=count($current_qns_list);//echo $candidate->total_records;exit();
		$Mypagination->total_records = $usertestdetails->total_records;
		$Mypagination->paginate();
		
		if($current_qns_list==false)
			$mesg = "No Records Found";
		else
			$mesg = "";
}




if(isset($_POST["submit"]) and $_POST["submit"] == "Pause")
{//print_r($_POST);exit();
	$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
	$usertest->get_details();

	if($_SESSION[SESSION_TITLE.'userid'] ==$usertest->user_id){

	//------------block for user key update start here----------
	$dataArray = get_user_key_data_array($_POST);
	if(count($dataArray) > 0) //then update userkey batch
	{
		$usertestdetails->user_keys_batch = $dataArray; 
		$update = $usertestdetails->update_userkeys_batch();
	}
	//------------block for user key update ends here----------		
		//$data=$usertest->get_details();
		$usertest->used_time =  date('H:i:s',(strtotime(CURRENT_DATETIME) - strtotime($usertest->resumed_time))+strtotime($usertest->used_time)); 
		$usertest->pause();
		$mytimer->stop();
		
		
		$_SESSION[SESSION_TITLE.'usertestid']="";
		unset($_SESSION[SESSION_TITLE.'usertestid']);
		header('Location:dashboard.php');
		exit();
    }
    else{
    	//do nothing
    } 
}


//update user key on click option (set through jquery)-
if(isset($_POST["user_keys"]))
{
	$usertestdetails->id		= $_POST["id"];
	$usertestdetails->user_keys	= $_POST["user_keys"];
	$update = $usertestdetails->update_userkeys();
}

//update multiple user keys on click checkboxs (set through jquery)-
if(isset($_POST["user_key_check"]))
{
	$checked	= $_POST["user_key_check"];
	$option_value = $_POST["key"];
	$usertestdetails->id		= $_POST["id"];
	$usertestdetails->get_detail();

	if($checked == 1)//add userkey
	{ 
		if($usertestdetails->user_keys == "" or $usertestdetails->user_keys == gINVALID)
		{
			$usertestdetails->user_keys	= $option_value;
			$update = $usertestdetails->update_userkeys();	
		}
		else
		{
			$list = explode(DEFAULT_ANSWER_KEY_DELIMITER,$usertestdetails->user_keys);
			if(in_array($option_value, $list)){
				//do nothing user key exists
				exit();
			}
			else{
				$userkey_multiple =  $usertestdetails->user_keys.DEFAULT_ANSWER_KEY_DELIMITER.$option_value;
				$usertestdetails->user_keys	= $userkey_multiple;
				$update = $usertestdetails->update_userkeys();exit();
			}
		}
	}
	elseif ($checked == 0) //remove userkey
	{
		if($usertestdetails->user_keys == "" or $usertestdetails->user_keys == gINVALID){
			//do nothing userkey null
		}
		else
		{
			$list = explode(DEFAULT_ANSWER_KEY_DELIMITER,$usertestdetails->user_keys);
			if(in_array($option_value, $list)){
				$index = array_search($option_value, $list);
				unset($list[$index]);
				$userkey_multiple =  "";
				if(count($list) > 0){
					foreach ($list as $value) {
						$userkey_multiple .= $value.",";
					}
					$usertestdetails->user_keys	= substr($userkey_multiple,0,-1);
				}
				else{
					$usertestdetails->user_keys = gINVALID;
				}
				$update = $usertestdetails->update_userkeys();exit();
			}
			else{//do nothing user key not exists
				exit();
			}
		}
	}	
}







//update user key and go to next page (set through jquery)
if(isset($_POST["flag"])){
	$id = $_POST["id"];
	$flag = $_POST["flag"];
	$usertestdetails->id		= $id;
	$usertestdetails->flag		= $flag;
	$update = $usertestdetails->update_flag();
}




//Save user keys on link buttons(first,previous,next.last) click (set through jquery)
if(isset($_POST["update_count"])){

	$count =$_REQUEST["update_count"];
	$ids = json_decode($_REQUEST['utd_idArray']);
	$user_keys = json_decode($_REQUEST['userkeyArray']);

	$i=0;$dataArray = array();
	while($count > $i){
		$key = $ids[$i];
		$val = $user_keys[$i];
		$dataArray[$key] = $val;
		$i++; 
	}
	//print_r($dataArray);exit();
	$usertestdetails->user_keys_batch = $dataArray;
	$update = $usertestdetails->update_userkeys_batch();
	
}

//update used time on pause(jquery)
if(isset($_POST["pause_time"]))
{
	
	$pause_time = $_POST['pause_time'];
	$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];	
	$usertest->get_details();
	$usertest->used_time =  date('H:i:s',(strtotime(CURRENT_DATETIME)-$_SESSION[SESSION_TITLE."start_time"])+strtotime($usertest->used_time));
	$usertest->pause();

	
	$_SESSION[SESSION_TITLE.'duration'] = "";
	unset($_SESSION[SESSION_TITLE.'duration']);
}

//unset usertestid
if(isset($_POST["end_test"]))
{
	$_SESSION[SESSION_TITLE.'usertestid']="";
	unset($_SESSION[SESSION_TITLE.'usertestid']);
	$mytimer->stop();
	
}


//update resume time on resume(jquery)
if(isset($_POST["paused_time"]))
{
	$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
	$usertest->resume();

	$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
	$usertest->get_details();
	$total_time_list = explode(":",$usertest->total_time);
	$used_time_list  = explode(":",$usertest->used_time);
	$total_time_in_seconds = ($total_time_list[0] * 60 * 60)+($total_time_list[1] * 60)+($total_time_list[2]);
	$used_time_in_seconds = ($used_time_list[0] * 60 * 60)+($used_time_list[1] * 60)+($used_time_list[2]);
	$mytimer->duration = $total_time_in_seconds-$used_time_in_seconds; //echo $mytimer->duration;exit();
	$mytimer->initialize_timer_variables();

}




?>
