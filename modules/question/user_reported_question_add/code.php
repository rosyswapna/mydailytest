<?php

// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

//question class
$myquestion = new Question($myconnection);
$myquestion->connection = $myconnection;

//class user
$myuser = new User($myconnection);
$myuser->connection = $myconnection;

//class usertest
$usertest = new UserTest($myconnection);
$usertest->connection = $myconnection;

//class usertestdetails
$usertestdetails = new UserTestDetails($myconnection);
$usertestdetails->connection = $myconnection;

$userquestionreporting = new UserQuestionReporting($myconnection);
$userquestionreporting->connection = $myconnection;



if(isset($_GET['id'])){
	$usertestdetails->id = $_GET['id'];
	$usertestdetails->get_detail();
	$usertest->id = $usertestdetails->user_test_id;
	$usertest->get_details();
	$myuser->id = $usertest->user_id;
	$myuser->get_detail();
	$myquestion->id = $usertestdetails->question_id;
	$myquestion->get_detail();


	
}


if(isset($_POST['submit'])){
	$userid = $_POST['hd_userid'];
	$usertestid = $_POST["hd_utid"];
	$questionid = $_POST['hd_questionid'];
	$description = $_POST['txtdescription'];
	$myquestion->id = $questionid;
	$myquestion->get_detail();

	$userquestionreporting->user_id = $userid;
	$userquestionreporting->question_id = $questionid;
	$userquestionreporting->status_id = STATUS_ACTIVE;
	$userquestionreporting->description = $description;
	$userquestionreporting->update(); 

	$_SESSION[SESSION_TITLE.'flash'] = "Question Reported.";
	header( "Location:result.php?id=".$usertestid);
	exit();
}





?>