<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/questions.php">Questions</a>'; 
?>


<div class="innercontainer-blk">
					<p class="heading">Search</p>
					<form name="frmsearch" id="frmsearch" method="GET" action="<?php echo $current_url;?>">
<div class="sixteen columns">
						<div class="one-third column">
							<div class="form-box">
								<label>Question Id :</label>
								<input  style= maxlength="100" size="35" name="txtquestion_id" id="txtquestion_id" value="<?php if(isset($_GET['txtquestion_id'])){
	  
	  echo $_GET['txtquestion_id'];
	  }
		  ?>" class="text" >
							</div><!-- End Box -->
						</div>
						
						<div class="one-third column">
							<div class="form-box">
								<label>Questions :</label>
								<input  style="width: 210px; height:22;"  maxlength="100" size="35" name="txtquestions" value="<?php if(isset($_GET['txtquestions'])){
	  
	  echo $_GET['txtquestions'];
	  }
		  ?>" class="text">
							</div><!-- End Box -->
						</div>
						
						<div class="one-third column">
							<div class="form-box">
								<label>Exam :</label>
								<?php populate_array("lstexam", $exams, $myquestion->exam_id,$disable=false); ?>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>Subject :</label>
								<?php populate_array("lstsubject", $subjects, $myquestion->subject_id,$disable=false); ?>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>Section :</label>
								<?php populate_array("lstsection", $sections, $myquestion->section_id,$disable=false); ?>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>Difficulty Level :</label>
								<?php populate_array("lstdifficultylevel", $difficulty_levels, $myquestion->difficulty_level_id,$disable=false); ?>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>Question Status :</label>
								<?php populate_array("lstquestionstatuses", $myquestion_status_ids, $myquestion->question_status_id,$disable=false); ?>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>Facebook Share :</label>
								<?php populate_list_array("lstshare", $g_ARRAY_question_share, "value", "description", $myquestion->share,$disable=false); ?>
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


	<p class="heading">
		<span class="fleft">Questions</span>
		<span class="pagination fright">
			<?php  $Mypagination->pagination_style_number_with_button();?>		
		</span>
	</p>
	<div class="sixteen columns mright8 bottom-1">
	
		<div class="tablestyle">
		<?php if($data_bylimit <= 0){ ?> 
		<div style="margin-bottom:80px; padding-bottom:5px; margin-top:50px;" align="center";>
			No Records found.
		</div>	
		<?php }else{?>
			<table>
				<thead>
				<tr>
			
			<th class="slno">Sl No</th>
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
				</thead>
				<tbody>
				<?php         
	 
   
	$status=0;$index=0; $sl=($Mypagination->page_num*$Mypagination->max_records)+1;
	while($count_data_bylimit > $index){ 
	 
	?> <tr >
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
<?php } ?>
				</tbody>
			</table>
	
		</div>	
	</div>
					
	<div class="sixteen columns bottom-1">
		<span class="pagination fright">
			<?php  $Mypagination->pagination_style_number_with_button();?>							
		</span>
	</div>
</div>

