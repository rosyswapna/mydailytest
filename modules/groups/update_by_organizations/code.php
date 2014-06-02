<?php
$mygroups = new Groups($myconnection);
$mygroups->connection = $myconnection;

$myquestion = new Question($myconnection);
$myquestion->connection = $myconnection;
if(isset($_GET["id"]) && $_GET["id"] > 0   ){
	$mygroups->id = $_GET["id"];
	$mygroups->get_detail(); 
	$myquestion->question_group_id= $_GET["id"];
	$data_question=$myquestion->get_details_by_group_id();
	$count_data=count($data_question);
}
$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$my_exams=$myexam->get_array();

$mysubject = new Subject($myconnection);
$mysubject->connection = $myconnection;
$my_subjects=$mysubject->get_array();

$mysection = new Section($myconnection);
$mysection->connection = $myconnection;
$my_sections=$mysection->get_array();


$mydifficultylevel = new DifficultyLevel($myconnection);
$mydifficultylevel->connection = $myconnection;
$my_difficulty_levels=$mydifficultylevel->get_array();

$mylanguage = new Language($myconnection);
$mylanguage->connection = $myconnection;
$my_languages=$mylanguage->get_array_lang();

$mygroupsstatuses = new QuestionStatuses($myconnection);
$mygroupsstatuses->connection = $myconnection;
$my_question_statuses=$mygroupsstatuses->get_array();


if(isset($_GET["id"]) && $_GET["id"] > 0){
	$mygroups->id = $_GET["id"];
	$data=$mygroups->get_detail(); 
	//print_r($data);
}

//shoud be change-------------------


if(isset($_GET["delid"]) && $_GET["delid"] > 0   ){
		$mygroups->id = $_GET["delid"];
		$mygroups->update_group_status_id(); 
		header('location:groups.php');
}

//shoud be change-------------------

if(isset($_POST["submit"]) && $_POST["submit"] == "submit"   )
{	$strERR="";
	if(trim($_POST['h_id'])==gINVALID){
		$mygroups->set_defaults();
	}else{ //do nothing
	}
//print_r($_FILES);
	
	
	$image="";
	if(isset($_POST['h_image'])){
	$old_passage_image_file=$_POST['h_image'];
	}
	$passage_image_file_name='';
	$passage_image_temp_name='';
	if(isset($_FILES["passage_image"]["size"]) && $_FILES["passage_image"]["size"] > 0) { 
 		
		$passage_image_temp_name=$_FILES["passage_image"]["tmp_name"];
		$passage_image_file_name=$_FILES["passage_image"]["name"];
		
	}
	$i=0;
	$image=$passage_image_file_name;
	
	
//print_r($new_option_images_array);print_r($option_array);
	
	if($_POST['lstexam']==-1){
	$strERR=$exam_id_empty;
	}
	if($_POST['txtpassage']==""){
	$strERR=$question_empty;
	}
	if($_POST['lstpassagestatuses']==-1){
	$strERR=$ques_stat_id_empty;
	}
	if($strERR!=""){
	$_SESSION[SESSION_TITLE.'flash'] = $strERR;
	$mygroups->id = $_POST["h_id"];
	$data=$mygroups->get_detail(); 
	}else{

	
	//$sl=($Mypagination->page_num*$Mypagination->max_records);
	$mygroups->passage = trim($_POST['txtpassage']);
	if(isset($image)){
	$mygroups->image=trim($image);	
	}
	$mygroups->exam_id =trim($_POST['lstexam']);
	$mygroups->subject_id=trim($_POST['lstsubject']);
	$mygroups->section_id=trim($_POST['lstsection']);
	$mygroups->difficulty_level_id=trim($_POST['lstdifficultylevel']);
	$mygroups->language_id=trim($_POST['lstlangauge']);
	$mygroups->question_group_status_id=trim($_POST['lstpassagestatuses']);
	
	$mygroups->id  =trim($_POST['h_id']); 
	
	if(isset($_POST['reflect_review'])){
	$mygroups->updated=trim(date("Y/m/d H.i:s<br>",time()));
	}
	$mygroups->update();
	$passage_id=$mygroups->id;
	$uploads_dir = ROOT_PATH.'images/passages/'.$passage_id;
	if(!is_dir($uploads_dir)){
	mkdir($uploads_dir, 0755); 
	}
	move_uploaded_file($passage_image_temp_name, $uploads_dir.'/'.$passage_image_file_name);
	if(isset($old_passage_image_file) && $passage_image_file_name!=''){
	$old_question_image_file_path=ROOT_PATH.'images/passages/'.$mygroups->id.'/'.$old_passage_image_file;
	if (file_exists($old_question_image_file_path)) {
		unlink($old_question_image_file_path);
	}
	}
	$_SESSION[SESSION_TITLE.'flash'] = "Question Updated.";
	//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $_POST["h_return_url"];
	header( "Location:groups.php");
	exit();
}
}	
?>
