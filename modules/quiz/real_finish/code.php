<?php

	if (isset($_SESSION[SESSION_TITLE.'usertestid'])) {
		$mytimer = new Timer;
		$mytimer->stop();
		$usertest = new UserTest($myconnecion);
		$usertest->connection 	= $myconnection;
		$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
		$usertest->test_status_id = TEST_STATUS_FINISHED;
		$usertest->update();
		$_SESSION[SESSION_TITLE.'usertestid']="";
		unset($_SESSION[SESSION_TITLE.'usertestid']);
		header("Location:result.php?id=".$usertest->id);exit();
	}else{
		header("Location:user_test_history.php");exit();
	}
?>