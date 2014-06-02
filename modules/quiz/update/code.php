<?php
$myquiz = new Quiz($myconnection);
$myquiz->connection = $myconnection;
$my_quiz_types=$myquiz->get_quiz_types();

$myquizdetail = new QuizDetail($myconnection);
$myquizdetail->connection = $myconnection;

$myorganization = new Organization($myconnection);
$myorganization->connection = $myconnection;
$my_organizations=$myorganization->get_list_array();

$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$my_exams=$myexam->get_list_array();


$mysubject = new Subject($myconnection);
$mysubject->connection = $myconnection;
$my_subjects=$mysubject->get_list_array();

$mysection = new Section($myconnection);
$mysection->connection = $myconnection;
$my_sections=$mysection->get_list_array();


$mylanguage = new Language($myconnection);
$mylanguage->connection = $myconnection;
$my_languages=$mylanguage->get_list_array();

$mydifficultylevel = new DifficultyLevel($myconnection);
$mydifficultylevel->connection = $myconnection;
$my_difficulty_levels=$mydifficultylevel->get_list_array();

$usertestdetails = new UserTestDetails($myconnection);
$usertestdetails->connection 	= $myconnection;



$myquiz_details = false;
if(isset($_GET["id"]) && $_GET["id"] > 0   ){
	$myquiz->id = $_GET["id"];
	$myquiz->get_details();
	if($myquiz->quiz_type_id == 1){
		$myquizdetail->quiz_id = $myquiz->id;
		$myquiz_details = $myquizdetail->get_quiz_details();
	}
}




if(isset($_POST["submit"]) && $_POST["submit"] == "submit")
{	
	$validation_rule_error_message = "";
	$descriptionArray = $_POST["ruledescription"];
	$questionidsArray = $_POST["rulequestionids"];
	$examArray 		= $_POST["lstexam"];
	$subjectArray 	= $_POST["lstsubject"];
	$sectionArray 	= $_POST["lstsection"];
	$languageArray 	= $_POST["lstlanguage"];
	$dlevelArray 	= $_POST["lstdifficultylevel"];
	$no_questionArray = $_POST["no_questions"];
	$total_markArray = $_POST["total_mark"];
	$negative_markArray = $_POST["negative_mark"];
	$wrong_answer_countArray = $_POST["wrong_answer_count"];
	if(isset($_POST["chk_passage"])){
		$question_group = $_POST["chk_passage"];
		$no_question_groupArray = $_POST["no_question_groups"];
	}else{
		$question_group = array();;
	}

	
	$validation = true;

	//validation start here

	$count_rows		= count($examArray);
	$dataArray =array();//insert array for quiz details
	for($i=0;$i<$count_rows;$i++)
	{
		$rule_id = $i+1;
		if(count($question_group) > 0 and in_array($rule_id, $question_group)){
			$dataArray[$i]['question_group'] = 1;
			$dataArray[$i]['number_of_question_groups'] =$no_question_groupArray[$i];
		}else{
			$dataArray[$i]['question_group'] = 0;
			$dataArray[$i]['number_of_question_groups'] = "";
		}
		$dataArray[$i]['description'] =$descriptionArray[$i];
		$dataArray[$i]['question_ids'] =$questionidsArray[$i];
		$dataArray[$i]['exam_id'] =$examArray[$i];
		$dataArray[$i]['subject_id'] =$subjectArray[$i];
		$dataArray[$i]['section_id'] =$sectionArray[$i];
		$dataArray[$i]['language_id'] =$languageArray[$i];
		$dataArray[$i]['difficulty_level_id'] =$dlevelArray[$i];
		$dataArray[$i]['number_of_questions'] =$no_questionArray[$i];
		$dataArray[$i]['total_mark'] =$total_markArray[$i];
		$dataArray[$i]['negative_mark'] =$negative_markArray[$i];
		$dataArray[$i]['wrong_answer_count'] =$wrong_answer_countArray[$i];
	}

	if(trim($_POST["txtname"]) == ""){
		$validation = false;
	}
	if(trim($_POST["txtdescription"]) == ""){
		$validation = false;
	}
	if(trim($_POST["txtcredit"]) == ""){
		$validation = false;
	}
	if(trim($_POST["lstexamination"]) == -1){
		$validation = false;
	}

	if($_POST["lstquiz_type"]=="" || $_POST["lstquiz_type"] == -1){
		$validation = false;
	}else if($_POST["lstquiz_type"] == 1){//real quiz validation
		if(in_array('-1',$examArray)) {
			$validation = false;
		}
		if(in_array('',$no_questionArray)) {
			$validation = false;
		}
		if(in_array('',$total_markArray)) {
			$validation = false;
		}

		$validate_rules = $myquizdetail->batch_validate_rule($dataArray);
		
		if(is_array($validate_rules)){echo "fail";exit();
			$validation_rule_error_message = "<br> Failed Rule(s)";
			foreach ($validate_rules as $validate_rule)
			{
				$validation_rule_error_message .= "</br>".search_assoc_key($validate_rule["exam_id"],$my_exams) . " - " . search_assoc_key($validate_rule["subject_id"],$my_subjects) . " - " . search_assoc_key($validate_rule["section_id"],$my_sections) . " - " . search_assoc_key($validate_rule["difficulty_level_id"],$my_difficulty_levels) ." - " . search_assoc_key($validate_rule["language_id"],$my_languages) . " - ". $validate_rule["number_of_questions"];
			}
			
			
			$validation = false;
			
		}else{
			// do noting
		}

	}else{ // demo quiz validation


		if(trim($_POST["txtquestions"]) == "" and trim($_POST["txtquestiongroups"]) == ""){
			$validation = false;
		}
		else{
			//check duplicates question ids
		}
	}

	
	if($validation == false ){
		$_SESSION[SESSION_TITLE.'flash'] = "Please Fill the required (<span style=\"color:red;\">*</span>) fields.".$validation_rule_error_message;
//		if(isset($_GET["id"]) && $_GET["id"] > 0   ){
//			header( "Location: quiz.php?id=".$_GET["id"]);
//			exit();
//		}else{
//			header( "Location: quiz.php");
//			exit();
//		}
	}else{


	
		$myquiz->id  = $_POST['h_id'];
		$myquiz->name = $_POST["txtname"];
		$myquiz->description = $_POST["txtdescription"];
		$myquiz->credit = $_POST["txtcredit"];
		$myquiz->organization_id = $_POST["lstorganization"];
		$myquiz->total_time = $_POST["lsthour"].":".$_POST["lstminute"].":".$_POST["lstsecond"];
		$myquiz->exam_id = $_POST["lstexamination"];
		$myquiz->quiz_type_id = $_POST["lstquiz_type"];
		$myquiz->question_ids = $_POST["txtquestions"];
		$myquiz->question_group_ids = $_POST["txtquestiongroups"];

		$myquiz->period_from = $_POST["date_from"];
		$myquiz->period_to = $_POST["date_to"];
		$myquiz->time_from = $_POST["time_from"];
		$myquiz->time_to = $_POST["time_to"];
		if(isset($_POST['chk_specialdemo'])){
			$myquiz->special_demo = SPECIAL_DEMO_TRUE; 
		}else{
			$myquiz->special_demo = SPECIAL_DEMO_FALSE; 
		}
		$check = $myquiz->update();
		if($myquiz->quiz_type_id == 1)//then insert quiz details
		{
			$myquizdetail->quiz_id = $myquiz->id;
			if($count_rows > 0)
			{
				$myquizdetail->batch_update($dataArray);
			}
		}

		$_SESSION[SESSION_TITLE.'flash'] = $myquiz->error_description;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "quizzes.php";
		header( "Location: quizzes.php");
		exit();
	}
}


$myquiz_details = false;
if(isset($_GET["id"]) && $_GET["id"] > 0   ){
	$myquiz_id = $_GET["id"];
}elseif(isset($_POST["h_id"]) && $_POST["h_id"] > 0   ){
	$myquiz_id = $_POST["h_id"];
}else{
	$myquiz_id = gINVALID;
}
	$myquiz->id =$myquiz_id;
	$myquiz->get_details();
	if($myquiz->quiz_type_id == 1){
		$myquizdetail->quiz_id = $myquiz->id;
		$myquiz_details = $myquizdetail->get_quiz_details();//print_r($myquiz_details);
	}

	
	

//set through jquery
if(isset($_POST['rule_quesionids']))
{
	$dataArray = array();

	$dataArray[0]['id']               		= gINVALID;
    $dataArray[0]['exam_id']               	= $_POST['exam_id'];
    $dataArray[0]['subject_id']         	= $_POST['subject_id'];
    $dataArray[0]['section_id']         	= $_POST['section_id'];
    $dataArray[0]['diffilulty_level_id'] 	= $_POST['difficulty_level_id'];
    $dataArray[0]['number_of_questions'] 	= $_POST['number_of_questions'];
    $dataArray[0]['language_id']         	= $_POST['language_id'];
    $dataArray[0]['question_group']         = $_POST['question_group'];
    //user test details
    $question_ids = $usertestdetails->generate_rule_questionids($dataArray);
    print $usertestdetails->question_ids;exit();
    
}


?>
