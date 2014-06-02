
<form  target="_self" method="post" enctype="multipart/form-data" action="<?php echo $current_url?>" name="frm" onsubmit="val_name()">
		<table width="0" border="0" align="center" cellpadding="2" cellspacing="1">
		<tr>
			<td colspan="6" class="page_caption">Add Passages</td>
		</tr>
		<tr>
				<td colspan="2"></td><td><?php echo $mygroups->error_description; ?></td></tr>		
		
		
		<tr>
		<td valign="top">Passages <span style="color:red;">*</span> &nbsp;</td>	<td><textarea name="txtpassage" cols="45" rows="5" id="txtpassage"><?php echo $mygroups->passage;?></textarea></td><td></td><td style="float:left;line-height:20px;"><?php if($mygroups->image==''){ ?><img  src="/images/noimage.png" alt="File not found" height="80" width="200" border="3" > <?php }else{ ?><input name="h_image" type='hidden' value="<?php  echo $mygroups->image; ?>" ><img  src="/images/passages/<?php echo $mygroups->id.'/'.$mygroups->image; ?>" alt="File not found" height="80" width="200" border="3" ><?php } ?></td> 
		</tr>
		<tr>
		<td valign="top"></td>	<td></td><td></td><td style="float:left;line-height:20px;"><input type="file" name="passage_image"/> </td> 
		</tr>
		<tr>
		<td valign="top">Exam : <span style="color:red;"> *</span> &nbsp;</td>	<td><?php populate_array("lstexam", $my_exams,$mygroups->exam_id,$disable=false); ?></td>
		</tr>
		<tr>
		<td valign="top">Subject : <span style="color:red;"></span> &nbsp;</td>	<td><?php populate_array("lstsubject", $my_subjects,$mygroups->subject_id,$disable=false); ?></td>
		</tr>
		<tr>
		<td valign="top">Section :&nbsp;</td>	<td><?php populate_array("lstsection", $my_sections,$mygroups->section_id,$disable=false); ?></td>
		</tr>
		<tr>
		<td valign="top">Difficulty Level :&nbsp;</td>	<td><?php populate_array("lstdifficultylevel", $my_difficulty_levels, $mygroups->difficulty_level_id, 				$disable=false); ?></td>
		</tr>
		<tr>
	<td valign="top">Language : &nbsp;</td>	<td><?php populate_array("lstlangauge", $my_languages,$mygroups->language_id, $disable=false); ?></td>
		</tr>
		<tr>
	<td valign="top">Question Statuses :<span style="color:red;"> *</span>&nbsp;</td>	<td><?php populate_array("lstpassagestatuses", $my_question_statuses,$mygroups->question_group_status_id, $disable=false); ?></td>
		</tr>
		<?php if($mygroups->id>gINVALID){ 
			 if($data_question > 0){ 
				$index = 0;
				while($count_data > $index)
				{ ?>
		<tr>
		<td valign="top">Questions &nbsp;</td><td><textarea readonly name="txtquestion" cols="45" rows="5" id="txtquestion"><?php echo $data_question[$index]['question'];?></textarea></td><td></td><td style="float:left;line-height:20px;"><?php if($data_question[$index]['image']==''){ ?><img  src="/images/noimage.png" alt="File not found" height="80" width="200" border="3" > <?php }else{ ?><img  src="/images/questions/<?php echo $data_question[$index]['id'].'/'.$data_question[$index]['image']; ?>" alt="File not found" height="80" width="200" border="3" ><?php } ?></td><td><a href="question.php?id=<?php echo $data_question[$index]["id"]; ?>">Edit</a></td> 
		</tr>
		
		<tr>
		<td valign="top">Exam : &nbsp;</td>	<td><?php if($data_question[$index]['exam_id']!=gINVALID){ echo $my_exams[$data_question[$index]['exam_id']]; } ?></td>
		</tr>
		<tr>
		<td valign="top">Subject : &nbsp;</td>	<td><?php if($data_question[$index]['subject_id']!=gINVALID){  echo $my_subjects[$data_question[$index]['subject_id']]; } ?></td>
		</tr>
		<tr>
		<td valign="top">Section :&nbsp;</td>	<td><?php if($data_question[$index]['section_id']!=gINVALID){  echo $my_sections[$data_question[$index]['section_id']]; } ?></td>
		</tr>
		<tr>
		<td valign="top">Difficulty Level :&nbsp;</td>	<td><?php if($data_question[$index]['difficulty_level_id']!=gINVALID){ echo $my_difficulty_levels[$data_question[$index]['difficulty_level_id']]; } ?></td>
		</tr>
		<tr>
	<td valign="top">Language : &nbsp;</td>	<td><?php  if($data_question[$index]['language_id']!=gINVALID){  echo $my_languages[$data_question[$index]['language_id']]; } ?></td>
		</tr>
		<tr>
	<td valign="top">Question Statuses :&nbsp;</td><td><?php  if($data_question[$index]['question_status_id']!=gINVALID){  echo $my_question_statuses[$data_question[$index]['question_status_id']]; } ?></td>
		</tr>
<?php  $options=explode(DEFAULT_OPTION_DELIMITER,$data_question[$index]['options']);
$images=explode(DEFAULT_OPTION_DELIMITER, $data_question[$index]['option_images']);
$option_count=count($options);
$image_count=count($images);
if($option_count>$image_count){
$option_or_image_count=$option_count;
}else{
$option_or_image_count=$image_count;
}
$option_index=0;
$answers=explode(DEFAULT_OPTION_DELIMITER,$data_question[$index]['answers']);
$answer_count=count($answers);
$answer_keys=explode(DEFAULT_ANSWER_KEY_DELIMITER,$data_question[$index]['answer_keys']);
while($option_index<$option_or_image_count){

(in_array($option_index+1, $answer_keys))?$checked="checked":$checked="";
?>		

<tr><td valign="top"><?php if($option_index==0){echo "Options :";}?></td><td>
<input type="text" id="txtoptions_<?php echo $option_index+1;?>" name="txtoptions[]" readonly value="<?php if(isset($options[$option_index])){ echo $options[$option_index]; }?>" style="height:30px; width:200px;">
</td><td><?php if(isset($images[$option_index]) && $images[$option_index]!=''){  ?><img class="img" src="/images/questions/<?php echo $data_question[$index]['id'].'/'.$images[$option_index]; ?>" alt="File not found" height="50" width="100" border="3" ><?php }else{?><img  src="/images/noimage.png" alt="File not found"  alt="File not found" height="50" width="100" border="3" > <?php } ?></td>
</tr>
<?php $option_index++; } ?>
<?php $answer_index=0;?>
		<tr>
<td valign="top">Answers:</td><td>
<p id="answer_paragraph" class="answer_paragraph"><?php if(isset($_GET['id']) || isset($_POST['h_id'])){  while($answer_index<$answer_count){  echo $answer_index+1 ." : ".$answers[$answer_index];?></br><?php $answer_index++; } } ?></p>
</td>
</tr>
<?php $index++;
		}
		}

	 }else{ ?>
		


		<?php  }?>

		<tr>
		<td valign="top"><?php if(isset($_GET['id']) || isset($_POST['h_id'])){ ?><input type="checkbox" name="reflect_review" checked></td><td>Reflect In Review<?php } ?></td>
		</tr>
		<tr>		
			<td>	</td>	<td >
			<input name="submit" type="submit" value="submit" onclick=" return validate();" />
			<input type="hidden" name="h_id" id="h_id" value="<?php if(isset($mygroups->id)){ echo $mygroups->id;}else{ echo gINVALID; } ?>" >
			<input type="hidden" name="h_return_url" id="h_return_url" value="<?php  if(isset($_SERVER["HTTP_REFERER"])){echo $_SERVER["HTTP_REFERER"];} else{echo $current_url; }?>" >
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
</table>

</form>
