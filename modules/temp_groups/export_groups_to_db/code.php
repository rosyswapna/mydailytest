<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$mygroupsimports = new Groups_import($myconnection);
 	$mygroupsimports->connection = $myconnection;

 	$mytempgroups = new Temp_groups();
   	 $mytempgroups->connection = $myconnection;

if(isset($_GET['importid'])){
	$chk_existence=intval(false);
$question_group_import_id ="";
$question_group_import_id = $_GET['importid'];
$mygroupsimports->id= $question_group_import_id;
	 $mygroupsimports->get_count_passages();
	$mygroupsimports->get_detail();
	$chk_existence=$mygroupsimports->get_existence_in_main_db();
	
}

   if(isset($_POST['delete'])){
	$mygroupsimports->id =$_POST['txtimport_id'];
	$chk_delete=$mygroupsimports->delete();
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
	$mytempgroups = new Temp_groups();
   	 $mytempgroups->connection = $myconnection;
	 $mytempgroups->question_group_import_id =$_POST['txtimport_id'];
	$import_id= $mytempgroups->question_group_import_id;
	$data = $mytempgroups->get_all_verified_passages();

	if($data!=''){
	$mygroups = new Groups($myconnection);
	$mygroups->connection = $myconnection; 
	$group_index=0;
	while($group_index<count($data)){
	$mygroups->set_defaults();
	$mygroups->passage = $data[$group_index]['passage'];	
	$mygroups->image = $data[$group_index]['image'];	
	$mygroups->exam_id =$data[$group_index]['exam_id'];
	$mygroups->subject_id=$data[$group_index]['subject_id'];
	$mygroups->question_group_status_id=$data[$group_index]['question_group_status_id'];
	$mygroups->question_group_import_id=$data[$group_index]['question_group_import_id'];
	$mygroups->import_slno=$data[$group_index]['slno'];
	$mygroups->difficulty_level_id=$data[$group_index]['difficulty_level_id'];
	$mygroups->language_id=$data[$group_index]['language_id'];
	$mygroups->section_id=$data[$group_index]['section_id'];
	$mygroups->question_group_key=$data[$group_index]['question_group_key'];
	$mygroups->id=gINVALID;
	$chk=$mygroups->update();
	$passage_image_array[$mygroups->id]=$mygroups->image;
	if ( $chk == true ){
      	$mytempgroups->id=$data[$group_index]['id'];
		$mytempgroups->delete(); 
    }
	$group_index++;
}
if($chk==true){	
		$error_passage_image=move_passage_images_to_main_folder($passage_image_array,$import_id);
		if(!isset($error_passage_image)){
		$mygroupsimports->id=$import_id;
		$mygroupsimports->get_detail();
		$date=date("Y/m/d H.i:s<br>", time());
		$mygroupsimports->description.='Error Log of passage update to main DB on'.$date.'--------------------.';
		for($k=0;$k<count($error_passage_image);$k++){
		$mygroupsimports->description.=$error_passage_image[$k];
		}
		$mygroupsimports->description.='End -error log of question update to main DB on'.$date.'----------------.';
				
		$mygroupsimports->update();
		$RD_MSG_attempt_success_with_image_error="Groups Updated To DB.Some image files are  missing.Please check the error log.";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success_with_image_error;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: imports.php");
		exit();	
		}else{
		$RD_MSG_attempt_success="Groups Updated To DB";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: imports.php");
		exit();	
		}
		$RD_MSG_attempt_success="Groups Updated To DB";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: import_groups.php");
		exit();
}else{
		$RD_MSG_attempt_failed="Groupsns Updation Failed";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: import_groups.php");
		exit();

}
}else{
		$RD_MSG_attempt_failed="No Active Records Found";
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "imports.php";
		header( "Location: import_groups.php");
		exit();

}
}
?>
