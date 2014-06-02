<?php
if (isset($_SESSION[SESSION_TITLE.'demotestid'])) {
	$mytimer = new Timer;
	$mytimer->stop();
	$demotest = new DemoTest($myconnecion);
	$demotest->connection 	= $myconnection;
	$demotest->id = $_SESSION[SESSION_TITLE.'demotestid'];
	$demotest->test_status_id = TEST_STATUS_FINISHED;
	$demotest->update();
	$_SESSION[SESSION_TITLE.'demotestid']="";
	unset($_SESSION[SESSION_TITLE.'demotestid']);
	header("Location:demo_result.php?id=".$demotest->id);exit();
}else{
	header("Location:demo.php");exit();
}
?>