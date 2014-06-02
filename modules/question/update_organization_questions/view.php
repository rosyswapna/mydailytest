

<?php

$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/question.php">Add question</a>';
 if(isset(  $myquestion->error_description)) $_SESSION[SESSION_TITLE.'flash'] = $myquestion->error_description; 
?>

<div class="two-thirds column mright8 bottom-1">            
                    <div class="innercontainer-blk">
                        <p class="heading">Add Question</p>
                       <form  target="_self" method="post" enctype="multipart/form-data" action="<?php echo $current_url?>" name="frm" onsubmit="val_name()">
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>Question<small>*</small></label>
                                <textarea  class="text" name="txtquestion" cols="45" rows="5" id="txtquestion"><?php echo $myquestion->question;?></textarea>
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box"><label><br></label>
                                <?php if($myquestion->image==''){ ?><img  src="/images/noimage.png" alt="File not found" height="70" width="270" border="3" > <?php }else{ ?><input name="h_image" type='hidden' value='<?php  echo $myquestion->image;?>' ><img  src="/images/questions/<?php echo $myquestion->id.'/'.$myquestion->image; ?>" alt="File not found" height="80" width="200" border="3" ><?php } ?><input type="file" name="question_image" class="text"/>
                            </div><!-- End Box -->
                        </div>
                        <div class="clear"></div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>Exam id :<small>*</small></label>
                                <?php populate_list_array("lstexam",  $my_exams, "id", "name", $myquestion->exam_id,$disable=false); ?> 
                            </div><!-- End Box -->
                        </div>
                        
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>Subject : </label>
                                <?php populate_list_array("lstsubject", $my_subjects, "id", "name", $myquestion->subject_id,$disable=false); ?>
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>Section :</label>
                                <?php populate_list_array("lstsection",  $my_sections, "id", "name",$myquestion->section_id,$disable=false); ?>
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>Difficulty Level :</label>
                                <?php populate_list_array("lstdifficultylevel", $my_difficulty_levels, "id", "name",$myquestion->difficulty_level_id,$disable=false); ?> 
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>Language :</label>
                                <?php populate_list_array("lstlangauge", $my_languages, "id", "name",$myquestion->language_id, $disable=false); ?> 
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>Facebook Share :</label>
                                <?php populate_list_array("lstshare", $g_ARRAY_question_share, "value", "description", $myquestion->share,false); ?>
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>Question Statuses :<small>*</small></label>
                                <?php populate_list_array("lstquestionstatuses", $my_question_statuses, "id", "name",$myquestion->question_status_id, $disable=false); ?> 
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box big">
                                <label>Group key :</label>
                                <input type="text" name="txtgroup_key_col" class="text" value="<?php if(isset($myquestion->question_group_key)){ echo $myquestion->question_group_key; } ?>">
                            </div><!-- End Box -->
                        </div>
						 
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
					<div class="sixteen columns">
					<div class="one-third column mright4">
                            <div class="form-box">
                                <label><?php if($option_index==0){echo "Options :";}?></label><p class="exam_checkboxs"><input class="classcheck" type="checkbox" id="optioncheck_<?php echo $myquestion->id;?>" name="optioncheck[]" value="<?php echo $option_index+1;?>" <?php if(isset($_GET['id']) || isset($_POST['h_id'])){ echo $checked; } ?>></p>
                                <input type="text" class="text" id="txtoptions_<?php echo $option_index+1;?>" name="txtoptions[]" value="<?php if(isset($options[$option_index])){ echo $options[$option_index]; }?>">
                            	<?php if($option_index==$option_or_image_count-1){?><div id="addtextbox_div" class="addtextbox_div"><br><input type="button"  value="Add Option" question_id="<?php echo $myquestion->id; ?>" option_id="<?php echo $option_index+1; ?>" class="addtextbox button" id="addtextbox_<?php echo $option_index+1; ?>"></div><?php } ?>
                            </div> </div><!-- End Box -->
                       
                        <div class="one-third column mright4">
                            <div class="form-box big"><label></label><label></label><label></label><br>
                                <?php if(isset($images[$option_index]) && $images[$option_index]!=''){  ?><img class="img" src="/images/questions/<?php echo $myquestion->id.'/'.$images[$option_index]; ?>" alt="File not found" height="50" width="100" border="3" ><?php if(isset($_GET['id']) || isset($_POST['h_id'])){ if($_GET['id']!=''){$id=$_GET['id']; }else{ $id=$_POST['h_id']; } ?> <a class="option_image_edit" href="option_image_edit.php?option_position=<?php echo $option_index.'&&id='.$id.'&&image='.$images[$option_index]; ?>" ><label>Edit</label></a></div> <?php } } else {  if(isset($_GET['id']) || isset($_POST['h_id'])){ if($_GET['id']!=''){$id=$_GET['id']; }else{$id=$_POST['h_id'];} $image='';?><img  src="/images/noimage.png" alt="File not found"  alt="File not found" height="50" width="100" border="3" > <a class="option_image_edit" href="option_image_edit.php?option_position=<?php echo $option_index.'&&id='.$id.'&&image='.$image; ?>" ><label>Add</label></a></div><?php }else { ?><input class="text" type="file" name="image[]" multiple /></div> <?php } } ?>

                            </div></div><!-- End Box -->
                       <?php $option_index++; } ?>
						<div class="sixteen columns">
                       <div class="one-third column mright4">
                       <div class="form-box newoption_div" id="newoption_div">
                               
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box big newfile_div" id="newfile_div">
                               
                            </div><!-- End Box -->
                        </div>
						</div>
                        <?php $answer_index=0;?>
                        <div class="one-third column mright4">
                            <div class="form-box big">
                            	<label>Answers Selected :</label>
                                <p id="answer_paragraph" class="answer_paragraph"><?php if(isset($_GET['id']) || isset($_POST['h_id'])){  while($answer_index<$answer_count){  echo $answer_index+1 ." : ".$answers[$answer_index];?></br><?php $answer_index++; } } ?></p>
                            </div><!-- End Box -->
                        </div>
						<div class="one-third column mright4">
						       <div class="form-box big">
						       
						<p class="exam_checkboxs"> <?php if(isset($_GET['id']) || isset($_POST['h_id'])){ ?><input type="checkbox" name="reflect_review" checked><label>Reflect In Review</label><?php } ?></p>
                        </div><!-- End Box -->
                        </div>
                        <div class="clear"></div>
                        <div class="one-third column mright4">
                            <div class="form-box">
			 <input name="submit" type="submit" value="submit" onclick=" return validate();" class="button" />
			<input type="hidden" name="h_id" id="h_id" value="<?php if(isset($myquestion->id)){ echo $myquestion->id;}else{ echo gINVALID; } ?>" >
			<input type="hidden" name="h_return_url" id="h_return_url" value="<?php  if(isset($_SERVER["HTTP_REFERER"])){echo $_SERVER["HTTP_REFERER"];} else{echo $current_url; }?>" >
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
</div>
</div>












	
