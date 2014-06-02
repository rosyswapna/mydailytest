
<form  target="_self" method="post" enctype="multipart/form-data" action="<?php echo $current_url?>" name="frm" onsubmit="val_name()">
		<table width="0" border="0" align="center" cellpadding="2" cellspacing="1">
		<tr>
			<td colspan="6" class="page_caption">Add Questions</td>
		</tr>
		<tr>
				<td colspan="2"></td><td><?php echo $myquestion->error_description; ?></td></tr>		
		
		
		<tr>
		<td valign="top">Questions <span style="color:red;">*</span> &nbsp;</td>	<td><textarea name="txtquestion" cols="45" rows="5" id="txtquestion"><?php echo $myquestion->question;?></textarea></td><td></td><td style="float:left;line-height:20px;"><?php if($myquestion->image==''){ ?><img  src="/images/noimage.png" alt="File not found" height="80" width="200" border="3" > <?php }else{ ?><input name="h_image" type='hidden' value='<?php  echo $myquestion->image;?>' ><img  src="/images/questions/<?php echo $myquestion->id.'/'.$myquestion->image; ?>" alt="File not found" height="80" width="200" border="3" ><?php } ?></td> 
		</tr>
		<tr>
		<td valign="top"></td>	<td></td><td></td><td style="float:left;line-height:20px;"><input type="file" name="question_image"/> </td> 
		</tr>
		<tr>
		<td valign="top">Exam id<span style="color:red;"> *</span> &nbsp;</td>	<td><?php populate_list_array("lstexam", $my_exams, "id", "name", $myquestion->exam_id,$disable=false); ?></td>
		</tr>
		<tr>
		<td valign="top">Subject id <span style="color:red;"></span> &nbsp;</td>	<td><?php populate_list_array("lstsubject", $my_subjects, "id", "name",$myquestion->subject_id,$disable=false); ?></td>
		</tr>
		<tr>
		<td valign="top">Section id&nbsp;</td>	<td><?php populate_list_array("lstsection", $my_sections, "id", "name",$myquestion->section_id,$disable=false); ?></td>
		</tr>
		<tr>
		<td valign="top">Difficulty Level&nbsp;</td>	<td><?php populate_list_array("lstdifficultylevel", $my_difficulty_levels, "id", "name",$myquestion->difficulty_level_id, 				$disable=false); ?></td>
		</tr>
		<tr>
	<td valign="top">Language id&nbsp;</td>	<td><?php populate_list_array("lstlangauge", $my_languages, "id", "name",$myquestion->language_id, $disable=false); ?></td>
		</tr>
		<tr>
	<td valign="top">Facebook Share&nbsp;</td>	<td><?php populate_list_array("lstshare", $g_ARRAY_question_share, "value", "description", $myquestion->share,false); ?></td>
		</tr>
		<tr>
	<td valign="top">Question Statuses id <span style="color:red;"> *</span>&nbsp;</td>	<td><?php populate_list_array("lstquestionstatuses", $my_question_statuses, "id", "name",$myquestion->question_status_id, $disable=false); ?></td>
		</tr>
		<tr>
	<td valign="top">Question group key <span style="color:red;"> </span>&nbsp;</td>	<td><input type="text" name="txtgroup_key_col" value="<?php if(isset($myquestion->question_group_key)) echo $myquestion->question_group_key;?>"></td>
		</tr>
<?php $options=explode(DEFAULT_OPTION_DELIMITER,$myquestion->options);
$images=explode(DEFAULT_OPTION_DELIMITER, $myquestion->option_images);
$option_count=count($options);
$image_count=count($images);
if($option_count>$image_count){
$option_or_image_count=$option_count;
}else{
$option_or_image_count=$image_count;
}
$option_index=0;
$answers=explode(DEFAULT_OPTION_DELIMITER,$myquestion->answers);
$answer_count=count($answers);
$answer_keys=explode(DEFAULT_ANSWER_KEY_DELIMITER,$myquestion->answer_keys);
while($option_index<$option_or_image_count){

(in_array($option_index+1, $answer_keys))?$checked="checked":$checked="";
?>		

<tr><td valign="top"><?php if($option_index==0){echo "Options :";}?></td><td><input class="classcheck" type="checkbox" id="optioncheck_<?php echo $myquestion->id;?>" name="optioncheck[]" value="<?php echo $option_index+1;?>" <?php if(isset($_GET['id']) || isset($_POST['h_id'])){ echo $checked; } ?>>
<input type="text" id="txtoptions_<?php echo $option_index+1;?>" name="txtoptions[]" value="<?php if(isset($options[$option_index])){ echo $options[$option_index]; }?>" style="height:30px; width:200px;">
</td><td><?php if($option_index==$option_or_image_count-1){?><div id="addtextbox_div" class="addtextbox_div"><input type="button" value="Add Option" question_id="<?php echo $myquestion->id; ?>" option_id="<?php echo $option_index+1; ?>" class="addtextbox" id="addtextbox_<?php echo $option_index+1; ?>"></div><?php } ?></td><td><?php if(isset($images[$option_index]) && $images[$option_index]!=''){  ?><img class="img" src="/images/questions/<?php echo $myquestion->id.'/'.$images[$option_index]; ?>" alt="File not found" height="50" width="100" border="3" ><?php if(isset($_GET['id']) || isset($_POST['h_id'])){ if($_GET['id']!=''){$id=$_GET['id']; }else{ $id=$_POST['h_id']; } ?> <a class="option_image_edit" href="option_image_edit.php?option_position=<?php echo $option_index.'&&id='.$id.'&&image='.$images[$option_index]; ?>" >Edit</a><?php } } else {  if(isset($_GET['id']) || isset($_POST['h_id'])){ if($_GET['id']!=''){$id=$_GET['id']; }else{$id=$_POST['h_id'];} $image='';?> <a class="option_image_edit" href="option_image_edit.php?option_position=<?php echo $option_index.'&&id='.$id.'&&image='.$image; ?>" >Add</a><img  src="/images/noimage.png" alt="File not found"  alt="File not found" height="50" width="100" border="3" ><?php }else { ?><input type="file" name="image[]" multiple /></td> <?php } } ?></td>
</tr>
<?php $option_index++; } ?>
<tr><td></td><td>
<div id="newoption_div" class="newoption_div"></div></td><td></td><td><div id="newfile_div" class="newfile_div"></div>
</td></tr>
<?php $answer_index=0;?>
		<tr>
<td valign="top">Answers Selected :</td><td>
<p id="answer_paragraph" class="answer_paragraph"><?php if(isset($_GET['id']) || isset($_POST['h_id'])){  while($answer_index<$answer_count){  echo $answer_index+1 ." : ".$answers[$answer_index];?></br><?php $answer_index++; } } ?></p>
</td>
</tr>
		<tr>
		<td valign="top"><?php if(isset($_GET['id']) || isset($_POST['h_id'])){ ?><input type="checkbox" name="reflect_review" checked></td><td>Reflect In Review<?php } ?></td>
		</tr>
		
		
			<td>	</td>	<td >
			<input name="submit" type="submit" value="submit" onclick=" return validate();" />
			<input type="hidden" name="h_id" id="h_id" value="<?php if(isset($myquestion->id)){ echo $myquestion->id;}else{ echo gINVALID; } ?>" >
			<input type="hidden" name="h_return_url" id="h_return_url" value="<?php  if(isset($_SERVER["HTTP_REFERER"])){echo $_SERVER["HTTP_REFERER"];} else{echo $current_url; }?>" >
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
</table>

</form>
