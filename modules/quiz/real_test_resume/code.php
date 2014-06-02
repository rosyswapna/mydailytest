<?php


if(isset($_GET["id"]) && $_GET["id"] > 0)
{
	//Timer
	$mytimer = new Timer;
	$usertest = new UserTest($myconnecion);
	$usertest->connection 	= $myconnection;
	$usertest->id = $_GET["id"];
	$usertest->get_details();
	$view_flag = 0;
	if(isset($_SESSION[SESSION_TITLE.'usertestid']))
	{ 
		if($_SESSION[SESSION_TITLE.'usertestid'] == $_GET["id"]){  //continue test
			header("Location:test.php");
			exit();
		}
		else
		{
			$view_flag = 1;
		}
	}
	else
	{

		$usertest->resume();
		$_SESSION[SESSION_TITLE.'usertestid']=$_GET["id"];
		//timer start
		$total_time_list = explode(":",$usertest->total_time);
		$used_time_list  = explode(":",$usertest->used_time);
		$total_time_in_seconds = ($total_time_list[0] * 60 * 60)+($total_time_list[1] * 60)+($total_time_list[2]);
		$used_time_in_seconds = ($used_time_list[0] * 60 * 60)+($used_time_list[1] * 60)+($used_time_list[2]);
		$mytimer->duration = $total_time_in_seconds-$used_time_in_seconds; 
		$mytimer->initialize_timer_variables();
		header("Location:test.php");
		exit();
	}
}
else
{

	header("Location: dashboard.php");
	exit();
}



//submit pause and start
if(isset($_POST['submit']) and $_POST['submit'] == "Pause and Start")
{
	$usertest = new UserTest($myconnecion);
	$usertest->connection 	= $myconnection;
	//pause current test
	$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
	$usertest->get_details();


	$usertest->used_time =  date('H:i:s',(strtotime(CURRENT_DATETIME) - strtotime($usertest->resumed_time))+strtotime($usertest->used_time));
	$pause = $usertest->pause();
	if($pause == TRUE)
	{
		$_SESSION[SESSION_TITLE.'usertestid'] = $_POST["hd_resume_id"];
		$mytimer->stop();
		//resume test
		$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
		$usertest->get_details();
		$resume = $usertest->resume();

		

		//timer start
		$total_time_list = explode(":",$usertest->total_time);
		$used_time_list  = explode(":",$usertest->used_time);
		$total_time_in_seconds = ($total_time_list[0] * 60 * 60)+($total_time_list[1] * 60)+($total_time_list[2]);
		$used_time_in_seconds = ($used_time_list[0] * 60 * 60)+($used_time_list[1] * 60)+($used_time_list[2]);
		$mytimer->duration = $total_time_in_seconds-$used_time_in_seconds; 
		$mytimer->initialize_timer_variables();
	}
	
	header("Location:test.php");
	exit();


}

//continue current test
if(isset($_POST['submit']) and $_POST['submit'] == "Continue")
{
	header("Location:test.php");
	exit();
}

//cancel action
if(isset($_POST['submit']) and $_POST['submit'] == "Cancel")
{
	header("Location:user_test_history.php");
	exit();
}


?>