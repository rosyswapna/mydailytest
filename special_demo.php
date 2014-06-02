<?php
session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/conf/conf.php');
require(ROOT_PATH.'include/conf/system_conf.php');
require(ROOT_PATH.'include/connection/connection.php');
require(ROOT_PATH.'include/class/class_quiz/class_quiz.php');
require(ROOT_PATH.'include/class/class_quiz/class_quiz_conf.php');

 

$myquiz = new Quiz($myconnecion);
$myquiz->connection 	= $myconnection;
$myquiz->special_demo=intval(true);
$data_demo_quiz = $myquiz->get_list_array_bylimit("",DEMO_QUIZ,0,1,"","id DESC");
	if ( $data_demo_quiz == false ){
			$_SESSION[SESSION_TITLE.'flash'] = "Watch this space for the latest public examination tests.";
			header("Location: /index.php");
			exit();
	}else{
		//print_r($data_demo_quiz);exit();
		header("Location: /demo_test_start.php?id=".$data_demo_quiz[0]['id']);
			exit();

		
	}
?>
