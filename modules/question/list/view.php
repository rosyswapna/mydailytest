

<h1>Questions</h1>
<form name="frmsearch" id="frmsearch" method="GET" action="<?php echo $current_url;?>">
<table align="center" cellpadding="2">
<tr>
    <td colspan="2" class="page_caption">
   Search
  
    </td>
</tr>

   <tr>
      <td>Question Id</td>
      <td><input  style= maxlength="100" size="35" name="txtquestion_id" id="txtquestion_id" value="<?php if(isset($_GET['txtquestion_id'])){
	  
	  echo $_GET['txtquestion_id'];
	  }
		  ?>"></td>
</tr>
    <tr>
      <td>Questions</td>
      <td><input  style="width: 210px; height:22;"  maxlength="100" size="35" name="txtquestions" value="<?php if(isset($_GET['txtquestions'])){
	  
	  echo $_GET['txtquestions'];
	  }
		  ?>"></td>
</tr>
	  <td>Exam</td>
      <td><?php populate_array("lstexam", $exams, $myquestion->exam_id,$disable=false); ?></td>
    </tr> 
<tr>
	<td>Subject</td>
      <td><?php populate_array("lstsubject", $subjects, $myquestion->subject_id,$disable=false); ?></td>
</tr>	
<tr>
	<td>Section</td>
      <td><?php populate_array("lstsection", $sections, $myquestion->section_id,$disable=false); ?></td>
</tr>	

<tr>	
	<td>Difficulty Level</td>
      <td><?php populate_array("lstdifficultylevel", $difficulty_levels, $myquestion->difficulty_level_id,$disable=false); ?></td>
</tr>
<tr>
	<td>Question Status</td>
      <td><?php populate_array("lstquestionstatuses", $myquestion_status_ids, $myquestion->question_status_id,$disable=false); ?></td>
</tr>
<tr>
	<td>Facebook Share</td>
      <td><?php populate_list_array("lstshare", $g_ARRAY_question_share, "value", "description", $myquestion->share,$disable=false); ?></td>
</tr>

<tr>

	


</table>
<br />
 <input name="submit" value="submit" type="submit">
 </form>
<br />








<?php if($data_bylimit > 0){ ?> 
 <table>

	<tr>	<th class="slno">Sl No</th>
			<th>Question</th>
			<th>Question Id</th>
			<th>Answer</th>
			<th>Exam</th>
			<th>Subject</th>
			<th>Section</th>
			<th>Difficulty Level</th>
			<th>Status</th>	
			<th>FB Share</th>
			<th>Action</th>	
          
	</tr>
	<?php         
	 
     $style = "row_lite";
	$status=0;$index=0; $sl=($Mypagination->page_num*$Mypagination->max_records)+1;
	while($count_data_bylimit > $index){ 
	 if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }
	?> <tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
		<td class="slno"><?php echo $sl; ?></td>	
			<td><?php echo $data_bylimit[$index]["question"]; ?></td>
			<td><?php echo  $data_bylimit[$index]["id"]; ?></td>	
			<td><?php echo $data_bylimit[$index]["answers"]; ?></td>
			<td><?php if($data_bylimit[$index]["exam_id"]>0) echo $exams[$data_bylimit[$index]["exam_id"]];  ?></td>
			<td> <?php  if($data_bylimit[$index]["subject_id"]>0)echo $subjects[$data_bylimit[$index]["subject_id"]]; ?></td>
			<td> <?php if($data_bylimit[$index]["section_id"]>0)  echo $sections[$data_bylimit[$index]["section_id"]]; ?></td>
			<td><?php if($data_bylimit[$index]["difficulty_level_id"]>0) echo $difficulty_levels[$data_bylimit[$index]["difficulty_level_id"]]; ?></td>
			<td><?php if($data_bylimit[$index]["question_status_id"]==1){?><a href="question.php?delid=<?php echo $data_bylimit[$index]["id"]; ?>" >Active</a>
			<?php } else echo "Inactive";?> 
			 </td>
			<td>
			<?php $status = $data_bylimit[$index]["share"]; 
			if($status == 1){ ?><a style="color:#FFF" href="https://www.facebook.com/sharer/sharer.php?u=http://mydailytest.com/challenge_questions.php?id=<?php echo $data_bylimit[$index]["id"];?>" target="_blank">
  				<b>Allowed</b> </a> 
			<?php }else { echo $Not_allowed;}?>  
   				 
			</td>
			<td><a href="question.php?id=<?php echo $data_bylimit[$index]["id"]; ?>">Edit</a></td>
           
	</tr>
<?php 
	$sl++;
	$index++;
	} ?>

</table>
<br />
<div align="center">
<?php  $Mypagination->pagination_style1();?><br />
<?php  $Mypagination->pagination_style2();?>
</div>
<?php }else{?>

No Records Found.

<?php } ?>
<br /><br />