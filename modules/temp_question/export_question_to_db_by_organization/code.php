<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$mygroups=new Groups();
$mygroups->connection = $myconnection;

$myquestionimports = new Question_import($myconnection);
 	$myquestionimports->connection = $myconnection;

 	$mytempquestion = new Temp_question();
   	 $mytempquestion->connection = $myconnection;

if(isset($_GET['importid'])){
$question_import_id ="";
$question_import_id = $_GET['importid'];
$myquestionimports->id= $question_import_id;
$myquestionimports->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	 $myquestionimports->get_count_questions();
	$mytempquestion->question_import_id=$_GET['importid'];
	$mytempquestion->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	$chk_org_existence=$mytempquestion->organization_existence();
	if($chk_org_existence==false){
	
	$_SESSION[SESSION_TITLE.'flash'] ="You have not authorized access this content.";
		
		header( "Location: index.php");
		exit();
	
	}
	$myquestionimports->get_detail();
	$chk_existence=$myquestionimports->get_existence_in_main_db();
	
}

    //check user exist or not
	
	if(isset($_POST['delete'])){
	$myquestionimports->id =$_POST['txtimport_id'];
	$chk_delete=$myquestionimports->delete();
	if($chk_delete==true){
		$msg="Import deleted successfully.";
	}else{
		$msg="Import Deletion failed.";
	}
	$_SESSION[SESSION_TITLE.'flash'] =$msg ;
	header( "Location: imports.php");
	exit();
	
	}
    
if(isset($_POST['submit'])){
	$mytempquestion = new Temp_question();
   	 $mytempquestion->connection = $myconnection;
	 $mytempquestion->question_import_id =$_POST['txtimport_id'];
	$mytempquestion->organization_id=$_SESSION[SESSION_TITLE.'userid'];
	$import_id= $mytempquestion->question_import_id;
	$data = $mytempquestion->get_all_verified_questions();
	if($data!=''){
	$myquestion = new Question($myconnection);
	$myquestion->connection = $myconnection; 
	$question_index=0;
	while($question_index<count($data)){
	$myquestion->set_defaults();
	$myquestion->organization_id=$data[$question_index]['organization_id'];
	$myquestion->question = $data[$question_index]['question'];	
	$myquestion->exam_id =$data[$question_index]['exam_id'];
	$myquestion->subject_id=$data[$question_index]['subject_id'];
	$myquestion->question_status_id=$data[$question_index]['question_status_id'];
	$myquestion->question_import_id=$data[$question_index]['question_import_id'];
	$myquestion->question_type_id=$data[$question_index]['question_type_id'];
	$myquestion->import_slno=$data[$question_index]['slno'];
	$myquestion->option_images=$data[$question_index]['option_images'];
	$myquestion->image=$data[$question_index]['image'];
	$myquestion->options=$data[$question_index]['options'];
	$myquestion->answers=$data[$question_index]['answers'];
	$myquestion->answer_keys=$data[$question_index]['answer_keys'];
	$myquestion->difficulty_level_id=$data[$question_index]['difficulty_level_id'];
	$myquestion->language_id=$data[$question_index]['language_id'];
	$myquestion->section_id=$data[$question_index]['section_id'];
	$myquestion->question_group_key=$data[$question_index]['question_group_key'];
	if($myquestion->question_group_key!=gINVALID){
		$mygroups->question_group_key=$myquestion->question_group_key;
		$group_id=$mygroups->select_group_id();
		$myquestion->question_group_id=$group_id;	
	}
	$chk=$myquestion->update();
	$option_images_array[$myquestion->id]=$myquestion->option_images;
	$question_image_array[$myquestion->id]=$myquestion->image;
	$myquestion->id=gINVALID;
	if ( $chk == true ){
      	$mytempquestion->id=$data[$question_index]['id'];
		$mytempquestion->delete(); 
    }
	$question_index++;
}
if($chk==true){
		$error_option_images=move_option_images_to_main_folder($option_images_array,$import_id);
		$error_question_image=move_question_images_to_main_folder($question_image_array,$import_id);
		if(!empty($error_option_images) || !empty($error_question_image)){
		$myquestionimports->id=$import_id;
		$myquestionimports->get_detail();
		$date=date("Y/m/d H.i:s<br>", time());
		$myquestionimports->description.='Error Log of question update to main DB on'.$date.'--------------------.';
		for($k=0;$k<count($error_option_images);$k++){
		$myquestionimports->description.=$error_option_images[$k];
		}
		
		for($k=0;$k<count($error_question_image);$k++){
		$myquestionimports->description.=$error_question_image[$k];
		}
		$myquestionimports->description.='End -error log of question update to main DB on'.$date.'----------------.';
				
		$myquestionimports->update();
		$RD_MSG_attempt_success_with_image_error="Questions Updated To DB.Some image files are  missing.Please check the error log.";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success_with_image_error;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: imports.php");
		exit();	
		}else{
		$RD_MSG_attempt_success="Questions Updated To DB";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: imports.php");
		exit();	
		}
		
}else{
		$RD_MSG_attempt_failed="Questions Updation Failed";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: imports.php");
		exit();

}
}else{
		$RD_MSG_attempt_failed="No Active Records Found";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: imports.php");
		exit();

}
}
?>
