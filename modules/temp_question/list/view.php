<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>

<h1>Imported Questions</h1>
<form name="frmsearch" id="frmsearch" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="5" class="page_caption">
   Search
    </td>
</tr>
    <tr>
      <td>Questions</td>
      <td><input  style="width: 210px; height:22;"  maxlength="100" size="35" name="txtquestions"  ><input type="hidden" name="txtimport_id" value="<?php if(isset($_POST['txtimport_id'])){echo $_POST['txtimport_id'];}else{ echo $mytempquestion->question_import_id;} ?>"></td><td>Created :<?php echo $myquestionimports->created?></td>
</tr>
<tr>
	
	<td>Subject</td>
      <td><?php populate_array("lstsubject", $subjects,$mytempquestion->subject_id,$disable=false); ?></td><td>Csv File :<?php echo $myquestionimports->csv_file?></td>
</tr>
<tr>
<td>Exam</td>
      <td><?php populate_array("lstexam", $exams,$mytempquestion->exam_id,$disable=false); ?></td><td>Date :<?php echo $myquestionimports->date?></td>
    </tr> 
<tr><td></td><td></td>
<td>Total Question :<?php echo $myquestionimports->total_questions?>&nbsp;&nbsp;Verified Question :<?php echo $myquestionimports->total_verified_questions?></td>

</table>
<br />
 <input name="submit" value="submit" type="submit">
 </form>


<?php //new-------------->?>

<form  target="_self" method="post" action="<?php echo $current_url;?>" name="frm_examination" id="frm_examination">
        <table id="tab" width="600" border="0" cellpadding="0" cellspacing="2"  >
        <tr>
            <td colspan="5" class="page_caption" >Temp Questions  <span style="float:right;"><input name="checkall" id="checkall" type="checkbox">Verify All</span></td> 
        </tr>

	<tr>
	<td>	
	<?php if($data_bylimit > 0){ 
				$index = 0;
				$current_question_no = 0;
				while($count_data_bylimit > $index)
				{
					$current_question_no++;
			
		//$highlight_div_style=' style="margin-top:5px;"';
		 if($data_bylimit[$index]["answer_keys"]!="" && $data_bylimit[$index]["subject_id"]!=gINVALID && $data_bylimit[$index]["exam_id"]!=gINVALID) {}else{
		//$highlight_div_style=' style="border:2px solid red; diplay:inline-block;"';
}
		?>
	<div id="question_div_<?php echo $data_bylimit[$index]['id'];?>"> 
	<table>
        <tr>
          <td height="30" valign="middle" align="center">
           <?php echo $data_bylimit[$index]['slno'];  ?>: 
            </td>
            <td valign="middle" style="text-align:left;line-height:20px;"><?php echo $data_bylimit[$index]['question']; ?>
			 </td>
         </tr>
		<tr>
          
        <?php if($data_bylimit[$index]['image']!=''){ ?><td height="30" valign="middle" align="center">
             </td>
            <td style="float:left;line-height:20px;"><img class="img" src="/images/temp_question/<?php echo $myquestionimports->id.'/'.$data_bylimit[$index]['image']; ?>" alt="File not found" height="50" width="100" border="3" ></td>
         </tr><?php } ?>
		 
		<?php $options=explode(DEFAULT_OPTION_DELIMITER, $data_bylimit[$index]["options"]);
	$images=explode(DEFAULT_OPTION_DELIMITER, $data_bylimit[$index]["option_images"]);
	$option_count=count($options);$serl_numbr=1;
	$option_index=0;
	while($option_count > $option_index){ 
	?>
	<tr>
		<td height="30" valign="middle">
          
            </td>
            <td colspan="2"  valign="top" style="text-align:left;line-height:20px;">
	<?php
	echo $serl_numbr." : ";
	echo $options[$option_index]; ?><?php if(isset($images[$option_index])  && $images[$option_index]!=''){?><img class="img" src="/images/temp_question/<?php echo $myquestionimports->id.'/'.$images[$option_index]; ?>" alt="File not found" height="50" width="100" border="3" ><?php } else { ?> <img src="/images/noimage.png" alt="File not found" height="50" width="100" border="3"></td> <?php }
	$serl_numbr++;$option_index++;?> 
        </tr> <?php  } ?>
	<tr>
		<td height="30" valign="middle">
          
            </td>
            <td colspan="3" align="left" valign="top" style="text-align:left;line-height:20px;">
		 <?php  echo "Ans : "; echo $answers=str_replace(DEFAULT_OPTION_DELIMITER,DEFAULT_ANSWER_KEY_DELIMITER, $data_bylimit[$index]["answers"]); ?>( <?php echo $data_bylimit[$index]["answer_keys"]; ?>)   Subject :<?php if($data_bylimit[$index]["subject_id"]!=gINVALID){echo $subjects[$data_bylimit[$index]["subject_id"]].".";} ?>   Exam :<?php echo  $exams[$data_bylimit[$index]["exam_id"]].".";?>
			
          </td>    
        </tr>
        <tr>
         <td  clospan="3"></td> <td></td><td><div class="edit_verify_div"><a href="#" class="edit_link" question_id="<?php echo $data_bylimit[$index]['id']; ?>">Edit</a><?php if($data_bylimit[$index]["answer_keys"]!="" && $data_bylimit[$index]["subject_id"]!=gINVALID && $data_bylimit[$index]["exam_id"]!=gINVALID) {?> <input type="checkbox" name="verify[]" id="verify" <?php if($data_bylimit[$index]['question_status_id']==QUESTION_STATUS_ACTIVE) { ?>checked<?php } ?> value="<?php echo $data_bylimit[$index]['id']; ?>">verify<?php }else{?> <?php } ?></div></td>
          
        </tr>
	</table>
	</div>
	<div class="popup_form" id="popup_form_<?php echo $data_bylimit[$index]['id'];?>">
<form name="poup_frm_<?php echo $data_bylimit[$index]['id'];?>">
<table >
<tr>
<td>Questions :</td><td><textarea id="txtquestion_<?php echo $data_bylimit[$index]['id'];?>"  cols="45" rows="5"><?php echo $data_bylimit[$index]['question']; ?></textarea><input type="hidden" id="txtid_<?php echo $data_bylimit[$index]['id'];?>" value="<?php echo $data_bylimit[$index]['id']; ?>"></td>
</tr>
<tr><td></td><td>Tick checkbox for answers.</td></tr>
<?php $options=explode(DEFAULT_OPTION_DELIMITER,$data_bylimit[$index]['options']);
$option_count=count($options);
$option_index=0;
$answers=explode(DEFAULT_OPTION_DELIMITER,$data_bylimit[$index]['answers']);
$answer_count=count($answers);
$answer_keys=explode(DEFAULT_ANSWER_KEY_DELIMITER,$data_bylimit[$index]["answer_keys"]);
while($option_index<$option_count){
(in_array($option_index+1, $answer_keys))?$checked="checked":$checked="";
?>
<tr><td><?php if($option_index==0){echo "Options :";}?></td><td><input class="classcheck" type="checkbox" id="optioncheck_<?php echo $data_bylimit[$index]['id'];?>" name="optioncheck_<?php echo $data_bylimit[$index]['id'].'[]';?>" value="<?php echo $option_index+1;?>" question_id="<?php echo $data_bylimit[$index]['id']; ?>" <?php echo $checked; ?>>
<input type="text" id="txtoptions_<?php echo $data_bylimit[$index]['id'].'_';echo $option_index+1;?>" name="txtoptions_<?php echo $data_bylimit[$index]['id'].'[]';?>" value="<?php echo $options[$option_index]; ?>">
</td>
</tr>
<?php $option_index++; } 
$answer_index=0;
?>
<tr>
<td>Answers Selected :</td><td><br>
<p id="answer_paragraph_<?php echo $data_bylimit[$index]['id'];?>"><?php while($answer_index<$answer_count){  echo $answer_index+1 ." : ".$answers[$answer_index];?></br><?php $answer_index++; } ?></p>
</td>
</tr>
<tr>
<td>Exam :</td>
      <td><?php populate_array("lstexam_".$data_bylimit[$index]['id'], $exams,$data_bylimit[$index]["exam_id"],$disable=false); ?></td>
    </tr>
<tr>
<tr>
	<td>Subject :</td>
	
      <td><?php  populate_array("lstsubject_".$data_bylimit[$index]['id'], $subjects,$data_bylimit[$index]["subject_id"],$disable=false); ?></td>
</tr>

<td></td>
<td><input value="Update" type="button" id="<?php echo $data_bylimit[$index]['id'];?>" question_id="<?php echo $data_bylimit[$index]['id']; ?>" class="update_button" /></td>
</tr>
</table>
</form>
</div>
        <?php
				$index++;
				}
		 }else{?>

No Records Found.

<?php } ?>  
       
	</td>
	</tr>
        <tr>
          <td height="50" colspan="2" align="center" style="text-align:center;">
       <?php if($data_bylimit > 0){ ?>   <input type="hidden" name="txtimport_id" value="<?php echo $mytempquestion->question_import_id; ?>"><input value="Update" type="submit" name="update"  /><?php }else{ ?><a href='#' class='back'>Go Back</a><?php } ?>
          </td>
          </tr>
        </table>
                
</form>


























