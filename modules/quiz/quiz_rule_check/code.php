<?php
if(isset($_GET)){

	$myquizdetail = new QuizDetail($myconnection);
	$myquizdetail->connection = $myconnection;
	$validate_rules = $myquizdetail->validate_rule($_GET["question_group"],$_GET["exam_id"], $_GET["subject_id"], $_GET["section_id"], $_GET["language_id"], $_GET["difficulty_level_id"], $_GET["number_of_questions"]);

	if($validate_rules == true){
		echo true;
	}else{
		echo false;
	}
}else{
	echo false;
}
?>
