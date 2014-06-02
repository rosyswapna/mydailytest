<?php
$myquiz = new Quiz($myconnection);
$myquiz->connection = $myconnection;

$myquestion = new Question($myconnection);
$myquestion->connection = $myconnection;
//for pagination
	$Mypagination = new Pagination(10);

if(isset($_POST["h_quiz_id"]) && $_POST["h_quiz_id"] > 0) {
	$myquiz->id = $_POST["h_quiz_id"];
	$result = $myquiz->get_details();
	if($result!= false && $myquiz->quiz_type_id == DEMO_QUIZ ){
		$result = $myquestion->get_list_array_bylimit($myquiz->question_ids,$Mypagination->start_record,$Mypagination->max_records);
		$counts = count($result);
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = "Invalid Quiz.</br>Please choose Demo Quiz from list.";
		header( "Location: index.php");
		exit();
	}
}else{


		$_SESSION[SESSION_TITLE.'flash'] = "Please choose Demo Quiz from list.";
		header( "Location: index.php");
		exit();

}

?>
