<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/temp_questions.php?importid='.$mytempquestion->question_import_id.'">Temp Questions</a>';
?>



<div class="innercontainer-blk">
					<p class="heading">Search</p>
					<form name="frmsearch" id="frmsearch" method="POST" action="<?php echo $current_url;?>">
<div class="sixteen columns">
						
						
						<div class="one-third column">
							<div class="form-box">
								<label>Questions :</label>
								<input  style="width: 210px; height:22;"  maxlength="100" size="35" class="text" name="txtquestions"  ><input type="hidden" name="txtimport_id" value="<?php if(isset($_POST['txtimport_id'])){echo $_POST['txtimport_id'];}else{ echo $mytempquestion->question_import_id;} ?>">
							</div><!-- End Box -->
						</div>
						
						<div class="one-third column">
							<div class="form-box"><br><br><br>
								<label>Created :<?php echo $myquestionimports->created?></label>
								<label>Csv File :<?php echo $myquestionimports->csv_file?></label>
									
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>Exam :</label>
								<?php populate_array("lstexam", $exams,$mytempquestion->exam_id,$disable=false); ?>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box"><br><br>
								<label>Date :<?php echo $myquestionimports->date?></label>
								<label>Total Question :<?php echo $myquestionimports->total_questions?>&nbsp;&nbsp;Verified Question :<?php echo $myquestionimports->total_verified_questions?></label>
								
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>Subject :</label>
								<?php populate_array("lstsubject", $subjects,$mytempquestion->subject_id,$disable=false); ?>
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
							<div class="form-box">
								<input name="submit" value="submit" type="submit" class="button" >
								
							</div>
						</div>
					
						</div>
					</form>
				</div>




<br><br>


<div class="innercontainer-blk">

<form  target="_self" method="post" action="<?php echo $current_url;?>" name="frm_verify" id="frm_verify">
	<p class="heading">
		<span class="fleft">Temp Questions  </span>
		<span class="pagination fright">
			
		</span><span style="float:right;"><input name="checkall" id="checkall" class="checkall"type="checkbox">Verify All</span>
	</p>

	<div class="sixteen columns mright8 bottom-1">
	
	
		<div class="tablestyle">
		<?php if($data_bylimit <= 0){ ?> 
		<div style="margin-bottom:80px; padding-bottom:5px; margin-top:50px;" align="center";>
			No Records found. <a href='#' class='back'>Go Back</a>
		</div>	
		<?php }else{
				
				$index = 0;
				$current_question_no = 0;
				while($count_data_bylimit > $index)
				{
					$current_question_no++;
			
		?>
		<table >
        <tr>
            <td colspan="5"></td> 
        </tr>

		<tr>
		<td>
			<div id="question_div_<?php echo $data_bylimit[$index]['id'];?>"> 
			<table width="100%">
				<tbody>
				 <tr>
          <td >
           <?php echo $data_bylimit[$index]['slno'];  ?>: 
            </td>
			<td  style="text-align:left;"><label><?php echo $data_bylimit[$index]['question']; ?></label></td><td>
			 
        <?php if($data_bylimit[$index]['image']!=''){ ?>
           <img class="img" src="/images/temp_question/<?php echo $myquestionimports->id.'/'.$data_bylimit[$index]['image']; ?>" alt="File not found" height="50" width="100" border="3" ></td>
        <?php } ?> </tr>
		<?php $options=explode(DEFAULT_OPTION_DELIMITER, $data_bylimit[$index]["options"]);
	$images=explode(DEFAULT_OPTION_DELIMITER, $data_bylimit[$index]["option_images"]);
	$option_count=count($options);$serl_numbr=1;
	$option_index=0;
	
	while($option_count > $option_index){ 
		
	?>
	<tr>
		<td></td>
        <td style="text-align:left;"><label>
	<?php
	echo $serl_numbr." : ";
	echo $options[$option_index]; ?></label></td><?php if(isset($images[$option_index])  && $images[$option_index]!=''){?><td  width="30%"><img class="img" src="/images/temp_question/<?php echo $myquestionimports->id.'/'.$images[$option_index]; ?>" alt="File not found" height="50" width="100" border="3" ></td> <?php } else { ?><td width="30%"> <img src="/images/noimage.png" alt="File not found" height="50" width="100" border="3"></td> <?php }
	$serl_numbr++;$option_index++;?> 
        </tr> <?php  } ?>
	<tr>
		<td height="30" valign="middle">
          
            </td>
            <td colspan="3" align="left" valign="top" style="text-align:left;line-height:20px;"><label>
		 <?php  echo "Ans : "; echo $answers=str_replace(DEFAULT_OPTION_DELIMITER,DEFAULT_ANSWER_KEY_DELIMITER, $data_bylimit[$index]["answers"]); ?>( <?php echo $data_bylimit[$index]["answer_keys"]; ?>)   Subject :<?php if($data_bylimit[$index]["subject_id"]!=gINVALID){echo $subjects[$data_bylimit[$index]["subject_id"]].".";} ?>   Exam :<?php echo  $exams[$data_bylimit[$index]["exam_id"]].".";?>
			</label>
          </td>    
        </tr>
        <tr>
          <td></td><td></td><td style="text-align:left;"><div style="float:left;" class="edit_verify_div"><a href="#" class="edit_link" question_id="<?php echo $data_bylimit[$index]['id']; ?>"><label>Edit</label></a><?php if($data_bylimit[$index]["answer_keys"]!="" && $data_bylimit[$index]["subject_id"]!=gINVALID && $data_bylimit[$index]["exam_id"]!=gINVALID) {?> <input type="checkbox" name="verify[]" id="verify" <?php if($data_bylimit[$index]['question_status_id']==QUESTION_STATUS_ACTIVE) { ?>checked<?php } ?> value="<?php echo $data_bylimit[$index]['id']; ?>"><label>verify</label><?php }else{?> <?php } ?></div></td>
          
        </tr>
		</tbody>
	</table>
	</div>

	<div class="popup_form" id="popup_form_<?php echo $data_bylimit[$index]['id'];?>">
<form name="poup_frm_<?php echo $data_bylimit[$index]['id'];?>">
<table width="100%" >
<tbody>
<tr>
<td width="20%">Questions :</td><td><textarea id="txtquestion_<?php echo $data_bylimit[$index]['id'];?>"  cols="45" rows="5"><?php echo $data_bylimit[$index]['question']; ?></textarea><input type="hidden" id="txtid_<?php echo $data_bylimit[$index]['id'];?>" value="<?php echo $data_bylimit[$index]['id']; ?>"></td>
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
<tr><td width="20%"><?php if($option_index==0){echo "Options :";}?></td><td><input class="classcheck" type="checkbox" id="optioncheck_<?php echo $data_bylimit[$index]['id'];?>" name="optioncheck_<?php echo $data_bylimit[$index]['id'].'[]';?>" value="<?php echo $option_index+1;?>" question_id="<?php echo $data_bylimit[$index]['id']; ?>" <?php echo $checked; ?>>
<input type="text" id="txtoptions_<?php echo $data_bylimit[$index]['id'].'_';echo $option_index+1;?>" class="text" name="txtoptions_<?php echo $data_bylimit[$index]['id'].'[]';?>" value="<?php echo $options[$option_index]; ?>">
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
<td><input value="Update" class="button update_button" type="button" id="<?php echo $data_bylimit[$index]['id'];?>" question_id="<?php echo $data_bylimit[$index]['id']; ?>"  /></td>
</tr>
</tbody>
</table>
</form>
</div>
</td>
</tr>				
<?php 
	
	$index++;
	} ?>


<tr>
<td>
<div align="center">
  <?php if($data_bylimit > 0){ ?>   <input type="hidden"  name="txtimport_id" value="<?php echo $mytempquestion->question_import_id; ?>"><input value="Update" type="submit" class="button" name="update"  /><?php } ?>
</form>
</div>
</td>
</tr>
</table>  
<br />


<?php } ?>
				
	</div>
		</div>	
	</div>




























