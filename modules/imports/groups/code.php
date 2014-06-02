<?php  
 // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
	$strERR="";
	$mytempgroups = new Temp_groups($myconnection);
	$mytempgroups->connection = $myconnection;
	$mygroupimports=new Groups_import();
	$mygroupimports->connection = $myconnection;
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

 if ( trim($_POST['txtpassagestartcol']) == "" ){
      $strERR .= "<br/>".$MSG_empty_passagestartcol;
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
	if(isset($_FILES["zip"]["size"]) && $_FILES["zip"]["size"] > 0) { 
	 if ( trim($_POST['txtpassageimagestartcol']) == "" ){
	      $strERR .= "<br/>".$MSG_empty_imagestartcol;
	 }
	 }		

 $mytempgroups->error_description=$strERR;
    if($strERR==""){
	  $csvfile_name=$_FILES["csv"]["name"]; 
	$csvfile=$_FILES["csv"]["tmp_name"];
    $passage_start_col=$_POST['txtpassagestartcol']-1;
    $passage_image_start_col=$_POST['txtpassageimagestartcol']-1;
    $delimiter= $_POST['txtdelimiter'];
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
    $mygroupimports->created= $_POST['txtcreated'];
    $mygroupimports->description=$_POST['txtdescription'] ;
	if($_POST['txtorganizationid']==-1){
	$mytempgroups->organization_id="";
   	}else{
	$mytempgroups->organization_id=$_POST['txtorganizationid'];
	}
	$mygroupimports->csv_file=$csvfile_name;
	$mygroupimports->image_zipped_file=$_FILES["zip"]["name"];
	$mytempgroups->exam_id=trim($_POST['txtexam']);
	$mygroupimports->exam_id=trim($_POST['txtexam']);
	$chk_import=$mygroupimports->update();
	
	if(isset($_FILES["zip"]["size"]) && $_FILES["zip"]["size"] > 0) { 
 
		$zip = new ZipArchive;
		$folder_name=$mygroupimports->id;
		mkdir(ROOT_PATH.'images/temp_passages/'.$folder_name, 0777);
		$zipfile=$_FILES["zip"]["tmp_name"];
		if ($zip->open($zipfile) === TRUE) {
			$zip->extractTo(ROOT_PATH.'images/temp_passages/'.$folder_name);
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
	
    $data=explode($delimiter,$line);
	 $mytempgroups->passage=get_passage($data,$passage_start_col);
	$mytempgroups->image=get_image($data,$passage_image_start_col);
	$mytempgroups->exam_id="";
	if($_POST['txtexam']== -1 && $exam_start_col!="" && $data[$exam_start_col]!=""){
		$index=0;  while ($examcount > $index ){ 
    	if(strcasecmp(trim($data[$exam_start_col]),trim($exam[$index]["name"]))== 0){
 		 $mytempgroups->exam_id=$exam[$index]["id"];
      		}$index++;
        	}
		if($mytempgroups->exam_id==""){
		$myexam->name= trim($data[$exam_start_col]);
		$myexam->update();
		$mytempgroups->exam_id=$myexam->id;
		$myexam->id="";
		}
	}else{
		$mytempgroups->exam_id=trim($_POST['txtexam']);
		}
		$mytempgroups->subject_id="";
	if($_POST['txtsubject'] == -1 && $subject_start_col!="" && $data[$subject_start_col]!=""){
		$index1=0;  while ($subjectcount > $index1 ){ 
    	if(strcasecmp(trim($data[$subject_start_col]),trim($subject[$index1]["name"]))== 0){
 		$mytempgroups->subject_id=trim($subject[$index1]["id"]);
      		}$index1++;
        	}
		if($mytempgroups->subject_id==""){
		$mysubject->name= trim($data[$subject_start_col]);
		$mysubject->update();
		$mytempgroups->subject_id=trim($mysubject->id);
		$mysubject->id="";
		$mysubject->name="";
		}
	}else{
		 $mytempgroups->subject_id=trim($_POST['txtsubject']);
	}

	$mytempgroups->difficulty_level_id="";
	if($_POST['txtdifficultylevel']== -1 && $difficulty_col!="" && $data[$difficulty_col]!=""){
		$index=0;  while ($difficulty_level_count > $index ){ 
    	if(strcasecmp(trim($data[$difficulty_col]),trim($difficulty_levels[$index]["name"]))== 0){
 		 $mytempgroups->difficulty_level_id=trim($difficulty_levels[$index]["id"]);
      		}$index++;
        	}
		if($mytempgroups->difficulty_level_id==""){
		$mydifficultylevel->name= trim($data[$difficulty_col]);
		$mydifficultylevel->update();
		$mytempgroups->difficulty_level_id=trim($mydifficultylevel->id);
		$mydifficultylevel->id="";
		}
	}else{
		 $mytempgroups->difficulty_level_id=trim($_POST['txtdifficultylevel']);
	}

	$mytempgroups->section_id="";
	if($_POST['txtsection']== -1 && $section_col!="" && $data[$section_col]!=""){
		$index=0;  while ($section_count > $index ){ 
    	if(strcasecmp(trim($data[$section_col]),trim($sections[$index]["name"]))== 0){
 		 $mytempgroups->section_id=trim($sections[$index]["id"]);
      		}$index++;
        	}
		if($mytempgroups->section_id==""){
		$mysection->name= trim($data[$section_col]);
		$mysection->update();
		$mytempgroups->section_id=trim($mysection->id);
		$mysection->id="";
		}
	}else{
		 $mytempgroups->section_id=trim($_POST['txtsection']);
	}

	$mytempgroups->language_id="";
	if($_POST['txtlangauge']== -1 && $language_col!="" && $data[$language_col]!=""){
		$index=0;  while ($language_count > $index ){ 
    	if(strcasecmp(trim($data[$language_col]),trim($languages[$index]["name"]))== 0){
 		 $mytempgroups->language_id=trim($languages[$index]["id"]);
      		}$index++;
        	}
		if($mytempgroups->language_id==""){
		$mylanguage->language= trim($data[$language_col]);
		$mylanguage->update();
		$mytempgroups->language_id=trim($mylanguage->id);
		$mylanguage->id="";
		}
	}else{
		$mytempgroups->language_id=trim($_POST['txtlangauge']);
	}
	$mytempgroups->question_group_import_id=trim($mygroupimports->id);
	$mytempgroups->slno=trim($slno);
	if($group_col!=""){
	$mytempgroups->question_group_key=trim($data[$group_col]);
	}else{
	$mytempgroups->question_group_key="";
	}
	$chk=$mytempgroups->update();
	
	$answers="";
	$options="";
	$mytempgroups->group_key="";
	$mytempgroups->language_id="";
	$mytempgroups->difficulty_level_id="";
	$mytempgroups->section_id="";
	$slno++;
	
   }
if($chk==true){
		
	$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_success;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "temp_questions.php?importid=".$mygroupimports->id;
		header( "Location: temp_groups.php?importid=".$mygroupimports->id);
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
