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

//pagination
if(isset($_REQUEST['lstrecord_per_page'])){
	$record_per_page = $_REQUEST['lstrecord_per_page'];
}elseif (isset($_GET['rpp'])) {
	$record_per_page = $_GET['rpp']; 
}else{
	$record_per_page = 10;
}


$Mypagination = new Pagination($record_per_page);
//$data=$_GET["id"]; echo $data; exit();
if(isset($_SESSION[SESSION_TITLE.'demotestid'])) 
{
	$demotestdetails->demo_test_id = $_SESSION[SESSION_TITLE.'demotestid'];
	$chk_test_details = $demotestdetails->exist();//check test details prepared
	if($chk_test_details == true){

		if(!isset($_SESSION[SESSION_TITLE.'duration']))
		{
			$demotest->id = $_SESSION[SESSION_TITLE.'demotestid'];
			$demotest->get_details();
			$total_time_list = explode(":",$demotest->total_time);
			$used_time_list  = explode(":",$demotest->used_time);
			$total_time_in_seconds = ($total_time_list[0] * 60 * 60)+($total_time_list[1] * 60)+($total_time_list[2]);
			$used_time_in_seconds = ($used_time_list[0] * 60 * 60)+($used_time_list[1] * 60)+($used_time_list[2]);
			$mytimer->duration = $total_time_in_seconds-$used_time_in_seconds; //echo $mytimer->duration;exit();
		}

		$mytimer->initialize_timer_variables();
		$current_qns_list = $demotestdetails->get_test_questions($Mypagination->start_record,$Mypagination->max_records);
		$count_data=count($current_qns_list);
		$Mypagination->total_records = $demotestdetails->total_records;
		$Mypagination->paginate();
	}
	else{
			//questions not generated
			unset($_SESSION[SESSION_TITLE.'demotestid']);
			$_SESSION[SESSION_TITLE.'flash'] = "Invalid Test. Contact System Administrator.";
	        header( "Location: demo.php");
	        exit();	
	}
}
else
{
	$_SESSION[SESSION_TITLE.'flash'] = "Please choose test";
	header('Location:demo.php');exit();
}




//submit test and end test
if(isset($_POST["submit"]) and $_POST["submit"] == "Finish")
{   
	//------------block for user key update start here----------
	
	$dataArray = get_user_key_data_array($_POST);

	if(count($dataArray) > 0) //then update userkey batch
	{
		$demotestdetails->user_keys_batch = $dataArray; 
		$update = $demotestdetails->update_userkeys_batch(); 
	}
	//find used time 
	$demotest->id = $_SESSION[SESSION_TITLE.'demotestid'];
	$demotest->get_details();
	$timeTaken = strtotime(CURRENT_DATETIME)-strtotime($demotest->resumed_time);
	//update user test (user test finished)
	
	$demotest->used_time = date('H:i:s',strtotime($demotest->used_time)+$timeTaken);
	$demotest->test_status_id = TEST_STATUS_FINISHED; 
	$demotest->update();
	$mytimer->stop();

	$demo_test_id = $_SESSION[SESSION_TITLE.'demotestid'];
	$_SESSION[SESSION_TITLE.'demotestid']= "";
	unset($_SESSION[SESSION_TITLE.'demotestid']);
	header('Location:demo_result.php?id='.$demo_test_id);exit();
	//header("Location:demo.php");exit();
}


//update user key and go to next page (set through jquery)
if(isset($_POST["flag"])){
	$id = $_POST["id"];
	$flag = $_POST["flag"];
	$demotestdetails->id		= $id;
	$demotestdetails->flag		= $flag;
	$update = $demotestdetails->update_flag();
}


if(isset($_POST["submit"]) and $_POST["submit"] == "Pause")
{
	$demotest->id = $_SESSION[SESSION_TITLE.'demotestid'];
	$demotest->get_details();
	//------------block for user key update start here----------
	$dataArray = get_user_key_data_array($_POST);
	if(count($dataArray) > 0) //then update userkey batch
	{
		$demotestdetails->user_keys_batch = $dataArray; 
		$update = $demotestdetails->update_userkeys_batch();
	}
	//------------block for user key update ends here----------		
		
	$demotest->used_time =  date('H:i:s',(strtotime(CURRENT_DATETIME) - strtotime($demotest->resumed_time))+strtotime($demotest->used_time)); 
	$demotest->pause();
	$mytimer->stop();
		
		
	$_SESSION[SESSION_TITLE.'demotestid']="";
	unset($_SESSION[SESSION_TITLE.'demotestid']);
	header('Location:demo.php');
	exit();
}


if(isset($_POST["submit"]) and $_POST["submit"] == "Display Flagged questions")
{
	//------------block for user key update start here----------
	$dataArray = get_user_key_data_array($_POST);
	if(count($dataArray) > 0) //then update userkey batch
	{
		$demotestdetails->user_keys_batch = $dataArray; 
		$update = $demotestdetails->update_userkeys_batch();
	}
	//------------block for user key update ends here----------
		$chk_flag=1;
		$demotestdetails->user_test_id = $_SESSION[SESSION_TITLE.'demotestid'];
		$filter = " AND DTD.flag = 1";
		$current_qns_list = $demotestdetails->get_test_questions($Mypagination->start_record,$Mypagination->max_records,$filter);
		$count_data=count($current_qns_list);
		$Mypagination->total_records = $demotestdetails->total_records;
		$Mypagination->paginate();
		
		if($current_qns_list==false)
			$mesg = "No Records Found";
		else
			$mesg = "";
}


//Save user keys on next button click (set through jquery)
if(isset($_POST["update_count"])){
	$count =$_POST["update_count"];
	$ids = $_POST['idArray'];
	$user_keys = $_POST['userkeyArray'];
	$i=0;$dataArray = array();
	while($count > $i){
		$key = $ids[$i];
		$val = $user_keys[$i];
		$dataArray[$key] = $val;
		$i++; 
	}
	$demotestdetails->user_keys_batch = $dataArray; 
	$update = $demotestdetails->update_userkeys_batch();

}


//trigger on change lstrecords
if(isset($_POST["submit"]) and $_POST["submit"] == "HD_submit")
{
		
		$demotestdetails = new DemoTestDetails($myconnecion);
		$demotestdetails->connection 	= $myconnection;
		$demotestdetails->user_test_id = $_SESSION[SESSION_TITLE.'demotestid'];
		$filter = "";
		$current_qns_list = $demotestdetails->get_test_questions($Mypagination->start_record,$Mypagination->max_records,$filter);
		$count_data=count($current_qns_list);//echo $candidate->total_records;exit();
		$Mypagination->total_records = $usertestdetails->total_records;
		$Mypagination->paginate();
		
		if($current_qns_list==false)
			$mesg = "No Records Found";
		else
			$mesg = "";
}


//Quit user test
if(isset($_POST["submit"]) and $_POST["submit"] == "Quit")
{
	unset($_SESSION[SESSION_TITLE.'demotestid']);
	//stop timer
	$mytimer->stop();
	header("Location:index.php");exit();
}

//update user key on click option (set through jquery)-
if(isset($_POST["user_keys"]))
{
	$demotestdetails->id		= $_POST["id"];
	$demotestdetails->user_keys	= $_POST["user_keys"];
	$update = $demotestdetails->update_userkeys();
}


//update used time on pause(jquery)
if(isset($_POST["pause_time"]))
{
	$count =$_POST["update_count"];
	$ids = $_POST['dtd_idArray'];
	$user_keys = $_POST['userkeyArray'];
	$pause_time = $_POST['pause_time'];
	if($count > 0)
	{
		$i=0;$dataArray = array();
		while($count > $i){
			$key = $ids[$i];
			$val = $user_keys[$i];
			$dataArray[$key] = $val;
			$i++; 
		}
		$demotestdetails->user_keys_batch = $dataArray; 
		$update = $demotestdetails->update_userkeys_batch();
	}
	$demotest->id = $_SESSION[SESSION_TITLE.'demotestid'];	
	$demotest->get_details();
	$demotest->used_time =  date('H:i:s',(strtotime(CURRENT_DATETIME)-$_SESSION[SESSION_TITLE."start_time"])+strtotime($demotest->used_time));
	//print $demotest->used_time;exit();
	$demotest->pause();
	$_SESSION[SESSION_TITLE.'duration'] = "";
	unset($_SESSION[SESSION_TITLE.'duration']);


}


//update resume time on resume(jquery)
if(isset($_POST["paused_time"]))
{//print "1";exit();
	$demotest->id = $_SESSION[SESSION_TITLE.'demotestid'];
	$demotest->resume();

	$demotest->id = $_SESSION[SESSION_TITLE.'demotestid'];
	$demotest->get_details();
	$total_time_list = explode(":",$demotest->total_time);
	$used_time_list  = explode(":",$demotest->used_time);
	$total_time_in_seconds = ($total_time_list[0] * 60 * 60)+($total_time_list[1] * 60)+($total_time_list[2]);
	$used_time_in_seconds = ($used_time_list[0] * 60 * 60)+($used_time_list[1] * 60)+($used_time_list[2]);
	$mytimer->duration = $total_time_in_seconds-$used_time_in_seconds; //echo $mytimer->duration;exit();
	$mytimer->initialize_timer_variables();

}



?>
