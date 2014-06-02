<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$mytempquestion = new Temp_question($myconnection);
$mytempquestion->connection = $myconnection;

$mytempquestion->id = trim($_POST["id"]);
$mytempquestion->question=trim($_POST["question"]);
$mytempquestion->options=trim($_POST["options"]);
$mytempquestion->answers=trim($_POST["answers"]);
$mytempquestion->answer_keys=trim($_POST["answer_keys"]);
$mytempquestion->question_type_id=trim($_POST["question_type_id"]);
$mytempquestion->exam_id=trim($_POST["exam_id"]);
$mytempquestion->subject_id=trim($_POST["subject_id"]);
if($mytempquestion->exam_id==gINVALID || $mytempquestion->subject_id==gINVALID){
$mytempquestion->question_status_id=QUESTION_STATUS_INACTIVE;
}
$chk=$mytempquestion->update();
if($chk==true){
	$myexam = new Exam($myconnection);
	$myexam->connection = $myconnection;
	$exams = $myexam->get_array(); 
	 

	$mysubject = new Subject($myconnection);
	$mysubject->connection = $myconnection;
	$subjects = $mysubject->get_array();	
	
	$question=$mytempquestion->get_detail();
	$index=0;	
	$div_content='<table <td width="100%">
				<tbody>
				 <tr>
          <td >';
        $div_content.= $question[$index]['slno'].":"; 
         $div_content.= '</td>
            <td>';
	$div_content.=$question[$index]['question'];
	$div_content.='</td><td></td></tr>';
        
	 $options=explode(DEFAULT_OPTION_DELIMITER, $question[$index]["options"]);
	$images=explode(DEFAULT_OPTION_DELIMITER, $question[$index]["option_images"]);
	$option_count=count($options);$serl_numbr=1;
	$option_index=0;
	while($option_count > $option_index){ 
	$div_content.='<tr>
		<td></td>
            <td><label>';
	$div_content.= $serl_numbr." : ";
	$div_content.= $options[$option_index];

 
if(isset($images[$option_index])  && $images[$option_index]!=''){
	$div_content.= '</label></td><td width="30%"><img class="img" src="/images/temp_question/'.$question[$index]["question_import_id"].'/'.$images[$option_index];
	$div_content.='" alt="File not found" height="45" width="100" onmouseover="this.width="200"; this.height="200"" onmouseout="this.width="100"; this.height="45" border="3"></td>';
	
 } else {
	 	$div_content.='</label></td><td><img src="/images/noimage.png" alt="File not found" height="50" width="100" border="3"></td></tr>'; 
	} 


		$serl_numbr++;$option_index++;  
		$div_content.='</tr>';
	
}

	$div_content.='</td>    
        </tr>
	<tr>
		<td>
          
            </td>
            <td><label> Ans : ';
	$div_content.= str_replace(DEFAULT_OPTION_DELIMITER,DEFAULT_ANSWER_KEY_DELIMITER, $question[$index]["answers"]);
	$div_content.='('.$question[$index]["answer_keys"].')';
	$div_content.='Subject :'.$subjects[$question[$index]["subject_id"]].".";
	$div_content.='Exam :'.$exams[$question[$index]["exam_id"]].".";
	$div_content.='</label></td><td></td></tr><tr><td></td><td></td><td><div style="float:left;" class="edit_verify_div"><a href="#" class="edit_link" question_id="';
	$div_content.=$question[$index]['id'].'"><label>Edit</label></a>';
	
	if($question[$index]["answer_keys"]!="" && $question[$index]["subject_id"]!=gINVALID && $question[$index]["exam_id"]!=gINVALID) {
	$div_content.= '<input type="checkbox" name="verify[]" id="verify"';
	if($question[$index]['question_status_id']==QUESTION_STATUS_ACTIVE) {
	$div_content.=' checked';
	} 
	$div_content.=' value="';
	$div_content.=$question[$index]['id'].'" /><label>verify</label>';
	}
	$div_content.='</div></td>    
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td><input name="" type="hidden" value="" />
        </tr>
	</tbody>
	</table>';


echo $div_content;



}else{
	echo 1;
}

?>


