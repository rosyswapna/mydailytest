<?php
session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/conf/conf.php');
require(ROOT_PATH.'include/conf/system_conf.php');
require(ROOT_PATH.'include/connection/connection.php');
require(ROOT_PATH.'include/class/class_user_session/class_user_session.php');
require(ROOT_PATH.'include/class/class_user_test/class_user_test.php');
require(ROOT_PATH.'include/class/class_user_test/class_user_test_conf.php');
require(ROOT_PATH.'include/class/class_timer/class_timer.php');

//Timer
$mytimer = new Timer;

//user test
$usertest = new UserTest($myconnecion);
$usertest->connection 	= $myconnection;


//if test running pause test
if(isset($_SESSION[SESSION_TITLE.'usertestid']))
{
	$usertest->id = $_SESSION[SESSION_TITLE.'usertestid'];
	$usertest->get_details();

	$usertest->used_time =  date('H:i:s',(strtotime(CURRENT_DATETIME) - strtotime($usertest->resumed_time))+strtotime($usertest->used_time)); 
	$usertest->pause();
	$mytimer->stop();
}

 

$myuser = new UserSession("","","");
$chk = $myuser->logout();
if ($chk == true){
    header("Location: index.php");
    exit();
}
?>
