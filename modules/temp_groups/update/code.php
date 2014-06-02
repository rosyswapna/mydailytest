<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$mytempgroups = new Temp_groups($myconnection);
$mytempgroups->connection = $myconnection;
$mytempgroups->id = trim($_POST["id"]);
$mytempgroups->passage=trim($_POST["passage"]);
$mytempgroups->exam_id=trim($_POST["exam_id"]);
$mytempgroups->subject_id=trim($_POST["subject_id"]);
if($mytempgroups->exam_id==gINVALID || $mytempgroups->subject_id==gINVALID || $mytempgroups->passage==''){
$mytempgroups->question_group_status_id=STATUS_INACTIVE;
}
$chk=$mytempgroups->update();
if($chk==true){
	$myexam = new Exam($myconnection);
	$myexam->connection = $myconnection;
	$exams = $myexam->get_array(); 
	 

	$mysubject = new Subject($myconnection);
	$mysubject->connection = $myconnection;
	$subjects = $mysubject->get_array();	
	
	$groups=$mytempgroups->get_detail();
	$index=0;	
	$div_content='<table>
        <tr>
          <td height="30" valign="middle" align="center">';
        $div_content.= $groups[$index]['slno'].":"; 
         $div_content.= '</td>
            <td valign="middle" style="text-align:left;line-height:20px;">';
	$div_content.=$groups[$index]['passage'];
	$div_content.='</td><tr><td></td><td style="float:left;line-height:20px;"><img class="img" src="/images/temp_passages/';
	$div_content.=$groups[$index]['question_group_import_id'].'/'.$groups[$index]['image'].'" alt="File not found" height="50" width="100" border="3" ></td>';
	$div_content.='<tr><td></td><td>Subject :';
	if($groups[$index]["subject_id"]!=gINVALID){
	$div_content.=$subjects[$groups[$index]["subject_id"]].".";
	}
	$div_content.='Exam :'.$exams[$groups[$index]["exam_id"]].".";
	$div_content.='</td></tr><tr><td></td><td><div class="edit_verify_div"><a href="#" class="edit_link" passage_id="';
	$div_content.=$groups[$index]['id'].'">Edit</a>';
	
	if($groups[$index]["subject_id"]!=gINVALID && $groups[$index]["exam_id"]!=gINVALID) {
	$div_content.= '<input type="checkbox" name="verify[]" id="verify"';
	if($groups[$index]['question_group_status_id']==STATUS_ACTIVE) {
	$div_content.=' checked';
	} 
	$div_content.=' value="';
	$div_content.=$groups[$index]['id'].'" />verify';
	}
	$div_content.='</div></td>    
        </tr>
        <tr>
          <td></td>
          <td height="20" valign="middle" >&nbsp;</td><input name="" type="hidden" value="" />
        </tr>
	</table>';


echo $div_content;



}else{
	echo 1;
}

?>


