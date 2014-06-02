<?php  
 // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
	$strERR="";
	$mytempquestion = new Temp_question($myconnection);
	$mytempquestion->connection = $myconnection;
	$myimport=new Question_import();
	$myimport->connection = $myconnection;
	$mysubject = new Subject($myconnection);
	$mysubject->connection = $myconnection;
	$subject=$mysubject->get_list_array();
	$subjectcount=count($subject); 
	
	$myorganization = new Organization();
	$myorganization->connection = $myconnection;
	$organizations=$myorganization->get_list_array_organizations();

	$myexam = new Exam($myconnection);
	$myexam->connection = $myconnection;
	$exam=$myexam->get_list_array();
	$examcount=count($exam);

	$mydifficultylevel = new DifficultyLevel($myconnection);
	$mydifficultylevel->connection = $myconnection;
	$difficulty_levels=$mydifficultylevel->get_list_array();

	$mylanguage = new Language($myconnection);
	$mylanguage->connection = $myconnection;
	$languages=$mylanguage->get_list_array();

	$mysection = new Section($myconnection);
	$mysection->connection = $myconnection;
	$sections=$mysection->get_list_array();

if(isset($_FILES["csv"]["size"]) && $_FILES["csv"]["size"] > 0) { 
 if ( trim($_POST['txtcreated']) == "" ){
      $strERR .= "<br/>".$MSG_empty_created;
 }

 if ( trim($_POST['txtdelimiter']) == "" ){
      $strERR .= "<br/>".$MSG_empty_delimiter;
 }

 if ( trim($_POST['txtquestionstartcol']) == "" ){
      $strERR .= "<br/>".$MSG_empty_questionstartcol;
 }

 if ( trim($_POST['txtoptionstartcol']) == "" ){
      $strERR .= "<br/>".$MSG_empty_optionstartcol;
 }

if ( trim($_POST['txtnumberoption']) == "" ){
      $strERR .= "<br/>".$MSG_empty_numberoption;
 }
if(isset($_FILES["zip"]["size"]) && $_FILES["zip"]["size"] > 0) { 
 if ( trim($_POST['txtquestionimagestartcol']) == "" ){
      $strERR .= "<br/>".$MSG_empty_imagestartcol;
 }

if ( trim($_POST['txtnumberimage']) == "" ){
      $strERR .= "<br/>".$MSG_empty_numberimage;
 }
}

if ( trim($_POST['txtnumberanswer']) == "" ){
     $number_of_answer=1;
 }
 if ( trim($_POST['txtanswerstartcol']) == "" ){
      $strERR .= "<br/>".$MSG_empty_answerstartcol;
 }

 if ( trim($_POST['txtexamstartcol']) == "" && trim($_POST['txtexam']) == -1 ){
      $strERR .= "<br/>".$MSG_empty_examstartcol;
	$strERR .= "<br/>".$MSG_empty_exam;
	}
if ( trim($_POST['txtexamstartcol']) != "" && trim($_POST['txtexam']) != -1 ){
      $strERR .= "<br/>".$MSG_duplicate_exam;
	
	}
if ( trim($_POST['txtsubjectstartcol']) != "" && trim($_POST['txtsubject']) != -1 ){
      $strERR .= "<br/>".$MSG_duplicate_subject;

	}
if ( trim($_POST['txtsection_col']) != "" && trim($_POST['txtsection']) != -1 ){
      $strERR .= "<br/>".$MSG_duplicate_section;

	}
if ( trim($_POST['txtdifficulty_level_col']) != "" && trim($_POST['txtdifficultylevel']) != -1 ){
      $strERR .= "<br/>".$MSG_duplicate_difficulty;

	}
if ( trim($_POST['txtlanguage_col']) != "" && trim($_POST['txtlangauge']) != -1 ){
      $strERR .= "<br/>".$MSG_duplicate_language;

	}			

 $mytempquestion->error_description=$strERR;
    if($strERR==""){
	  $csvfile_name=$_FILES["csv"]["name"]; 
	$csvfile=$_FILES["csv"]["tmp_name"];
    $question_start_col=$_POST['txtquestionstartcol']-1;
    $delimiter= $_POST['txtdelimiter'];
    $option_start_col= $_POST['txtoptionstartcol']-1;
	if (is_numeric($_POST['txtnumberoption'])){
	$number_of_option= $_POST['txtnumberoption'];
	}else{
	$number_of_option=$_POST['txtnumberoption'];
	}
	$question_image_start_col=$_POST['txtquestionimagestartcol']-1;
	$image_start_col=$_POST['txtimagestartcol']-1;
	$number_of_image_or_delimiter=$_POST['txtnumberimage'];
	$number_of_answer= $_POST['txtnumberanswer'];
	
   $answer_start_col= $_POST['txtanswerstartcol']-1;
    $exam_start_col	= $_POST['txtexamstartcol']-1;
    if($_POST['txtsubjectstartcol']!=""){
   	$subject_start_col= $_POST['txtsubjectstartcol']-1;
   }else{
   	$subject_start_col="";
   }
    if($_POST['txtsection_col']!=""){
    $section_col= $_POST['txtsection_col']-1;
	}else{
	$section_col= "";	
	}
	 if($_POST['txtdifficulty_level_col']!=""){
    $difficulty_col= $_POST['txtdifficulty_level_col']-1;
	}else{
	$difficulty_col="";	
	}
	 if($_POST['txtlanguage_col']!=""){
    $language_col= $_POST['txtlanguage_col']-1;
	}else{
	$language_col= "";	
	}
	 if($_POST['txtgroup_key_col']!=""){
    $group_col= $_POST['txtgroup_key_col']-1;
    }else{
    $group_col="";	
    }
    $myimport->created= $_POST['txtcreated'];
    $myimport->description=$_POST['txtdescription'] ;
	
	$mytempquestion->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	
	$myimport->csv_file=$csvfile_name;
	$myimport->image_zipped_file=$_FILES["zip"]["name"];
	$chk_import=$myimport->update();
	
	if(isset($_FILES["zip"]["size"]) && $_FILES["zip"]["size"] > 0) { 
 
		$zip = new ZipArchive;
		$folder_name=$myimport->id;
		mkdir(ROOT_PATH.'images/temp_question/'.$folder_name, 0777);
		$zipfile=$_FILES["zip"]["tmp_name"];
		if ($zip->open($zipfile) === TRUE) {
			$zip->extractTo(ROOT_PATH.'images/temp_question/'.$folder_name);
			$zip->close();
			
		} else {
			
		}

	}
	
	
	if($chk_import=='true'){
	$handle = fopen($csvfile,"r");
	 $slno=1;
	while ($line= fgets ($handle)) {
	$mysubject = new Subject($myconnection);
	$mysubject->connection = $myconnection;
	$subject=$mysubject->get_list_array();

	$myexam = new Exam($myconnection);
	$myexam->connection = $myconnection;
	$exam=$myexam->get_list_array();


	$mydifficultylevel = new DifficultyLevel($myconnection);
	$mydifficultylevel->connection = $myconnection;
	$difficulty_levels=$mydifficultylevel->get_list_array();

	$mylanguage = new Language($myconnection);
	$mylanguage->connection = $myconnection;
	$languages=$mylanguage->get_list_array();

	$mysection = new Section($myconnection);
	$mysection->connection = $myconnection;
	$sections=$mysection->get_list_array();
	
	$subjectcount=count($subject); 
	$examcount=count($exam);
	$difficulty_level_count=count($difficulty_levels); 
	$language_count=count($languages); 
	$section_count=count($sections); 
	$shuffle=true;
	if(!isset($_POST['shuffle_chkbox'])){
	$shuffle=false;
	}
    	$data=explode($delimiter,$line);
	$mytempquestion->question=get_question($data,$question_start_col);
	$mytempquestion->image=get_image($data,$question_image_start_col);
	$answer_array=get_answer($data, $answer_start_col,$number_of_answer);
	 $mytempquestion->answers=trim($answer_array["answer"]);
	$number_of_answer=trim($answer_array["number_of_answer"]);
	$option_answerkey_images_array=get_options($data, $option_start_col,$number_of_option,$image_start_col,$number_of_image_or_delimiter,$answer_start_col,$mytempquestion->answers,$shuffle);
	$mytempquestion->options=trim($option_answerkey_images_array['options']);
	$mytempquestion->answer_keys=trim($option_answerkey_images_array['answer_keys']);
	$mytempquestion->option_images=trim($option_answerkey_images_array['images']);
		$mytempquestion->exam_id="";
	if(trim($_POST['txtexam'])== -1 && trim($exam_start_col)!="" && trim($data[$exam_start_col])!=""){
		$index=0;  while ($examcount > $index ){ 
    	if(strcasecmp(trim($data[$exam_start_col]),trim($exam[$index]["name"]))== 0){
 		 $mytempquestion->exam_id=$exam[$index]["id"];
      		}$index++;
        	}
		if($mytempquestion->exam_id==""){
		$myexam->name= trim($data[$exam_start_col]);
		$myexam->organization_id=$mytempquestion->organization_id;
		$myexam->update();
		$mytempquestion->exam_id=$myexam->id;
		$myexam->id="";
		}
	}else{
		 $mytempquestion->exam_id=trim($_POST['txtexam']);
		}
		$mytempquestion->subject_id="";
	if(trim($_POST['txtsubject']) == -1 && trim($subject_start_col)!="" && trim($data[$subject_start_col])!=""){
		$index1=0;  while ($subjectcount > $index1 ){ 
    	if(strcasecmp(trim($data[$subject_start_col]),trim($subject[$index1]["name"]))== 0){
 		$mytempquestion->subject_id=trim($subject[$index1]["id"]);
      		}$index1++;
        	}
		if($mytempquestion->subject_id==""){
		$mysubject->name= trim($data[$subject_start_col]);
		$mysubject->organization_id=$mytempquestion->organization_id;
		$mysubject->update();
		$mytempquestion->subject_id=trim($mysubject->id);
		$mysubject->id="";
		$mysubject->name="";
		}
	}else{
		 $mytempquestion->subject_id=trim($_POST['txtsubject']);
	}

	$mytempquestion->difficulty_level_id="";
	if(trim($_POST['txtdifficultylevel'])== -1 && trim($difficulty_col)!="" && trim($data[$difficulty_col])!=""){
		$index=0;  while ($difficulty_level_count > $index ){ 
    	if(strcasecmp(trim($data[$difficulty_col]),trim($difficulty_levels[$index]["name"]))== 0){
 		 $mytempquestion->difficulty_level_id=trim($difficulty_levels[$index]["id"]);
      		}$index++;
        	}
		if($mytempquestion->difficulty_level_id==""){
		$mydifficultylevel->name= trim($data[$difficulty_col]);
		$mydifficultylevel->update();
		$mytempquestion->difficulty_level_id=trim($mydifficultylevel->id);
		$mydifficultylevel->id="";
		}
	}else{
		 $mytempquestion->difficulty_level_id=trim($_POST['txtdifficultylevel']);
	}

	$mytempquestion->section_id="";
	if(trim($_POST['txtsection'])== -1 && trim($section_col)!="" && trim($data[$section_col])!=""){
		$index=0;  while ($section_count > $index ){ 
    	if(strcasecmp(trim($data[$section_col]),trim($sections[$index]["name"]))== 0){
 		 $mytempquestion->section_id=trim($sections[$index]["id"]);
      		}$index++;
        	}
		if($mytempquestion->section_id==""){
		$mysection->name= trim($data[$section_col]);
		$mysection->organization_id=$mytempquestion->organization_id;
		$mysection->update();
		$mytempquestion->section_id=trim($mysection->id);
		$mysection->id="";
		}
	}else{
		 $mytempquestion->section_id=trim($_POST['txtsection']);
	}

	$mytempquestion->language_id="";
	if(trim($_POST['txtlangauge'])== -1 && trim($language_col)!=""){
		$index=0;  while ($language_count > $index ){ 
    	if(strcasecmp(trim($data[$language_col]),trim($languages[$index]["name"]))== 0){
 		 $mytempquestion->language_id=trim($languages[$index]["id"]);
      		}$index++;
        	}
		if($mytempquestion->language_id==""){
		echo $mylanguage->language= trim($data[$language_col]);
		$mylanguage->update();
		$mytempquestion->language_id=trim($mylanguage->id);
		$mylanguage->id="";
		}
	}else{
		 $mytempquestion->language_id=trim($_POST['txtlangauge']);
	}
	if (strpos($mytempquestion->answers,DEFAULT_OPTION_DELIMITER) != false) {
    	  $mytempquestion->question_type_id=QUESTION_TYPE_MULTIPLE_ANSWERS;
	}else{
	  $mytempquestion->question_type_id=QUESTION_TYPE_SINGLE_ANSWER;
	}
	 $mytempquestion->question_import_id=trim($myimport->id);
	$mytempquestion->slno=trim($slno);
	if($group_col!=""){
	$mytempquestion->group_key=trim($data[$group_col]);
	}else{
	$mytempquestion->group_key="";
	}
	$chk=$mytempquestion->update();
	$answers="";
	$options="";
	$mytempquestion->group_key="";
	$mytempquestion->language_id="";
	$mytempquestion->difficulty_level_id="";
	$mytempquestion->section_id="";
	$mytempquestion->options_string="";
	$mytempquestion->answer_keys="";
	$mytempquestion->answer="";
	$slno++;
	
   }
if($chk==true){
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "temp_questions.php?importid=".$myimport->id;
		header( "Location: temp_questions.php?importid=".$myimport->id);
		exit();
}else{
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
		header( "Location: dashboard.php");
}
} else{
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
		header( "Location: dashboard.php");

	}
}
}

?>
