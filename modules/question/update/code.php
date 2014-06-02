<?php
$myquestion = new Question($myconnection);
$myquestion->connection = $myconnection;
if(isset($_GET["id"]) && $_GET["id"] > 0   ){
	$myquestion->id = $_GET["id"];
	$myquestion->get_detail(); 
	
}
$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$my_exams=$myexam->get_list_array();

$mygroups=new Groups();
$mygroups->connection = $myconnection;

$mysubject = new Subject($myconnection);
$mysubject->connection = $myconnection;
$my_subjects=$mysubject->get_list_array();

$mysection = new Section($myconnection);
$mysection->connection = $myconnection;
$my_sections=$mysection->get_list_array();


$mydifficultylevel = new DifficultyLevel($myconnection);
$mydifficultylevel->connection = $myconnection;
$my_difficulty_levels=$mydifficultylevel->get_list_array();

$mylanguage = new Language($myconnection);
$mylanguage->connection = $myconnection;
$my_languages=$mylanguage->get_list_array();

$myquestionstatuses = new QuestionStatuses($myconnection);
$myquestionstatuses->connection = $myconnection;
$my_question_statuses=$myquestionstatuses->get_list_array();


if(isset($_GET["id"]) && $_GET["id"] > 0   ){
	$myquestion->id = $_GET["id"];
	$data=$myquestion->get_detail(); 
	//print_r($data);
}

if(isset($_GET["delid"]) && $_GET["delid"] > 0   ){
		$myquestion->id = $_GET["delid"];
		$myquestion->update_question_status_id(); 
		header('location:questions.php');
}


if(isset($_POST["submit"]) && $_POST["submit"] == "submit"   )
{	$strERR="";
	if(trim($_POST['h_id'])==gINVALID){
		$myquestion->set_defaults();
	}else{ //do nothing
	}
//print_r($_FILES);
	if($_POST['h_id']==gINVALID){
	
	foreach ($_FILES as $file) {
 	$option_image_file_name       = $file['name'];
	$option_image_tmp_name   = $file['tmp_name'];
	}
	}
	
	$options="";
	$answers="";
	$answer_keys="";
	$image="";
	if(isset($_POST['h_image'])){
	$old_questoin_image_file=$_POST['h_image'];
	}
	$optioncheck="";
	$new_option_array="";
	$option_txt_array= $_POST['txtoptions'];
	$question_image_file_name='';
	$question_image_temp_name='';
	if(isset($_FILES["question_image"]["size"]) && $_FILES["question_image"]["size"] > 0) { 
 		
		$question_image_temp_name=$_FILES["question_image"]["tmp_name"];
		$question_image_file_name=$_FILES["question_image"]["name"];
		
	}
	$i=0;
	$image=$question_image_file_name;
	foreach ($option_txt_array as $key => $value)
	{ 	if($_POST['h_id']!=gINVALID){
		$new_option_array[$i]=$value;
		$i++;
		}else{
		$option_array[$i]=$value;
		$i++;
		}
		//}
	}
	if($_POST['h_id']!=gINVALID){
	$myquestion->id=$_POST['h_id'];
	$option_image_for_checking=$myquestion->get_option_images();
	$j=0;
	$option_images_array=explode(DEFAULT_OPTION_DELIMITER,$option_image_for_checking);
	//checking options with option images
	if(count($option_images_array)>count($new_option_array)){
	for($k=0;$k<count($option_images_array);$k++){
	if($new_option_array[$k]=='' && $option_images_array[$k]==''){
	
	}else{
	$option_array[$j]=$new_option_array[$k];
	$new_option_images_array[$j]=$option_images_array[$k];
	$j++;
	}
	}
	}else{
	for($k=0;$k<count($new_option_array);$k++){
	if($new_option_array[$k]=='' && $option_images_array[$k]==''){
	
	}else{
	$option_array[$j]=$new_option_array[$k];
	$new_option_images_array[$j]=$option_images_array[$k];
	$j++;
	}
	}
	}
	}
//print_r($new_option_images_array);print_r($option_array);
	$answer_array="";
	$answer_key_array="";
	$i=0;
	$optioncheck= $_POST['optioncheck'];
	if($_POST['lstexam']==-1){
	$strERR=$exam_id_empty;
	}
	if($_POST['txtquestion']==""){
	$strERR=$question_empty;
	}
	if($_POST['lstquestionstatuses']==-1){
	$strERR=$ques_stat_id_empty;
	}
	if($strERR!=""){
	$_SESSION[SESSION_TITLE.'flash'] = $strERR;
	$myquestion->id = $_POST["h_id"];
	$data=$myquestion->get_detail(); 
	}else{

	if(isset($_POST['optioncheck'])){
	foreach ($optioncheck as $key => $value)
	{	if($option_array[$value-1]!=''){
		$answer_array[$i]=$option_array[$value-1];
		$answer_key_array[$i]=$value;
		$i++;
		}
	}
	}
	if($_POST['h_id']==gINVALID){
	$option_images="";
	for ($option_image_index = 0; $option_image_index < count($option_image_file_name); $option_image_index++)
	{	
		$option_images.=$option_image_file_name[$option_image_index];
		if($option_image_index < count($option_image_file_name)-1){
		$option_images.=DEFAULT_OPTION_DELIMITER;
		}
		
	}
	}else{

	$option_images="";
	for ($option_image_index = 0; $option_image_index < count($new_option_images_array); $option_image_index++)
	{	
		$option_images.=$new_option_images_array[$option_image_index];
		if($option_image_index < count($new_option_images_array)-1){
		$option_images.=DEFAULT_OPTION_DELIMITER;
		}
		
	}


	}
	for ($option_index = 0; $option_index < count($option_array); $option_index++)
	{	
		$options.=$option_array[$option_index];
		if($option_index < count($option_array)-1){
		$options.=DEFAULT_OPTION_DELIMITER;
		}
		
		
		
	}
	for ($answer_index = 0; $answer_index < count($answer_array) ; $answer_index++)
	{	
		
		$answers.=$answer_array[$answer_index];
		if($answer_index < count($answer_array)-1){
		$answers.=DEFAULT_OPTION_DELIMITER;
		}
		
	}
	for ($answer_key_index = 0; $answer_key_index < count($answer_key_array) ; $answer_key_index++)
	{
		$answer_keys.=$answer_key_array[$answer_key_index];
		if($answer_key_index < count($answer_key_array)-1){
		$answer_keys.=DEFAULT_ANSWER_KEY_DELIMITER;
		}
	}
	
	
	//$sl=($Mypagination->page_num*$Mypagination->max_records);
	$myquestion->question = trim($_POST['txtquestion']);
	if(isset($image)){
	$myquestion->image=trim($image);	
	}
	$myquestion->exam_id =trim($_POST['lstexam']);
	$myquestion->subject_id=trim($_POST['lstsubject']);
	$myquestion->section_id=trim($_POST['lstsection']);
	$myquestion->difficulty_level_id=trim($_POST['lstdifficultylevel']);
	$myquestion->language_id=trim($_POST['lstlangauge']);
	$myquestion->question_status_id=trim($_POST['lstquestionstatuses']);
	$myquestion->options=trim($options);
	$myquestion->question_group_key=$_POST['txtgroup_key_col'];
	$myquestion->option_images=trim($option_images);
	
	$myquestion->answers=trim($answers);
	$myquestion->share=trim($_POST['lstshare']);
	$myquestion->id  =trim($_POST['h_id']); 
	
	if(isset($_POST['reflect_review'])){
	$myquestion->updated=trim(date("Y/m/d H.i:s<br>",time()));
	}
	$myquestion->answer_keys=trim($answer_keys);
	if(count($answer_key_array)>1){
	 $myquestion->question_type_id=QUESTION_TYPE_MULTIPLE_ANSWERS;
	}else{
	$myquestion->question_type_id=QUESTION_TYPE_SINGLE_ANSWER;
	}
	if($myquestion->question_group_key!=''){
	$mygroups->question_group_key=$myquestion->question_group_key;
	$myquestion->question_group_id=$mygroups->select_group_id();
	}
	$myquestion->update();	
	$question_id=$myquestion->id;
	$uploads_dir = ROOT_PATH.'images/questions/'.$question_id;
	if(!is_dir($uploads_dir)){
	mkdir($uploads_dir, 0755); 
	}
	move_uploaded_file($question_image_temp_name, $uploads_dir.'/'.$question_image_file_name);
	if(isset($old_questoin_image_file)){
	$old_question_image_file_path=ROOT_PATH.'images/questions/'.$myquestion->id.'/'.$old_questoin_image_file;
	if (file_exists($old_question_image_file_path)) {
		unlink($old_question_image_file_path);
	}
	}
	for($i=0;$i<count($option_image_tmp_name);$i++){
	move_uploaded_file($option_image_tmp_name[$i], $uploads_dir.'/'.$option_image_file_name[$i]);
   //	echo $option_image_tmp_name[$i];
	//echo $option_image_file_name[$i];
	}
	$_SESSION[SESSION_TITLE.'flash'] = "Question Updated.";
	//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $_POST["h_return_url"];
	header( "Location:questions.php");
	exit();
}
}	
?>
