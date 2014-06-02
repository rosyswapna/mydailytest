<form  target="_self" method="post" action="<?php echo $current_url?>" name="frm">

		<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2" class="page_caption">Quiz</td>
		</tr>
		<tr>
				<td colspan="2" align="right"><a href="quizzes.php">List All</a> &nbsp; </td></tr>		
		<tr>
				<td >Name <span style="color:red;">*</span>&nbsp; </td>	
				<td><input type="text" name="txtname" id="txtname" value="<?php echo $myquiz->name;?>"></td>	
		</tr>
		<tr>
				<td >Description <span style="color:red;">*</span>&nbsp; </td>	
				<td><textarea  name="txtdescription" id="txtdescription"><?php echo $myquiz->description;?></textarea></td>	
		</tr>
		<tr>
				<td >Credit &nbsp;</td>	
				<td><input type="text" name="txtcredit" id="txtcredit" value="<?php echo $myquiz->credit;?>"></td>	
		</tr>
		<tr>
				<td >Organization &nbsp;</td>	
				<td><?php populate_list_array("lstorganization", $my_organizations, "id", "name", $myquiz->organization_id,$disable=false); ?></td>	
		</tr>
		<tr>
				<td >Exam <span style="color:red;">*</span>&nbsp; </td>	
				<td><?php populate_list_array("lstexamination", $my_exams, "id", "name", $myquiz->exam_id,$disable=false); ?></td>	
		</tr>

		<tr>
				<td >Time <span style="color:red;">*</span>&nbsp; </td>	
				<td>
				<?php populate_list_array("lsthour", $g_ARRAY_hours, "hour", "hour", $myquiz->hour,false,false); ?>:
				<?php populate_list_array("lstminute", $g_ARRAY_minutes, "minute", "minute", $myquiz->minute,false, false); ?>:
				<?php populate_list_array("lstsecond", $g_ARRAY_seconds, "second", "second", $myquiz->second,false, false); ?>
				</td>	
		</tr>
		
		
		<tr>
		
			<td valign="top">Type <span style="color:red;">*</span>&nbsp; </td>	
			
			<td><?php populate_list_array("lstquiz_type", $my_quiz_types, "id", "name", $myquiz->quiz_type_id,$disable=false); ?></td>
				
		</tr>
		
		
		
		<tr id="tr_q_nos">
		
		
				<td valign="top">Questions <span style="color:red;">*</span> &nbsp;</td>	
				<td>
					
					<textarea name="txtquestions" cols="45" rows="5" id="txtquestions"><?php echo $myquiz->question_ids;?></textarea>
				</td>
				
		</tr>
		<tr id="tr_qg_nos">
				<td valign="top">Passages <span style="color:red;">*</span> &nbsp;</td>	
				<td>
					<textarea name="txtquestiongroups" cols="45" rows="5" id="txtquestiongroups"><?php echo $myquiz->question_group_ids;?></textarea><br/><br/>
					<input type="checkbox" value="1" name="chk_specialdemo"  <?php if($myquiz->special_demo==SPECIAL_DEMO_TRUE){?> checked <?php } ?>/>&nbsp;&nbsp;Special Demo
				</td>		
		</tr>

		<tr id="tr_real1">
			<td valign="top">Date From</td>	
			<td>
				&nbsp;<input type="text" name="date_from" value="<?php echo $myquiz->period_from;?>" class="datepicker"/>
				To <input type="text" name="date_to" value="<?php echo $myquiz->period_to;?>" class="datepicker"/>
				
			</td>
				
		</tr>

		<tr id="tr_real2">
			<td valign="top">Time From </td>	
			<td>
				 &nbsp;<input type="text" name="time_from" value="<?php echo $myquiz->time_from;?>" class="timepicker"/>
				To <input type="text" name="time_to" value="<?php echo $myquiz->time_to;?>" class="timepicker"/>
			</td>
				
		</tr>

		<tr id="tr_real">
			<td colspan="2">
			<div id ="real_quiz_dtls">
			
			<?php 
				$i=0;
				if($myquiz_details == false)
				{
			?>
			<div id="<?php echo 'real_quiz_dtls1'; ?>">
				<table border="0" cellspacing="4" width="100%" cellpadding="2" id="real_qns_list">
					<tr>
						<td>Quiz Rule 1  :   </td>
						<td >

							<p id="msg_validate_1">Not Validated</p> 
							<input type="hidden" name ="h_validate_1" value="-1" /> 
							<div id="top_rule">
								<input type="button" value="close" id="1" class="real_quiz_hide"/> 
								<input type="button" value="Validate Rule" rule_id="1" class="button_validate_rule" name="button_validate_rule[]" onClick = "check_rule(this);" />  
							</div>
						</td>
					</tr>
					<tr><td width="25%">Rule Description<span style="color:red;">*</span> </td><td width="49%"><textarea name="ruledescription[]" cols="45" rows="5" id="ruledescription[]"></textarea></td></tr>
					
					<tr><td width="25%">Question Ids</td><td width="49%"><textarea name="rulequestionids[]" cols="45" rows="5" id="rulequestionids[]"></textarea>
					</td></tr>

					<tr><td></td><td align="right">
						<input type="button" class="btn_get_questionids" name="get_questionids[]" id="get_questionids[]" value = "Get Question Ids" rule_id="1"/>
					</td>
					</tr>

					<tr>
						<td width="25%">
							From Passage&nbsp;<input type="checkbox" value="1" name="chk_passage[]" id="chk_passage[]" />
						</td>
						<td width="49%">
							<div id="div_grp1" style="display:none;">&nbsp;&nbsp;Number of Question Groups<span style="color:red;">*</span> <input type="text" style="width:110px;" name="no_question_groups[]" value =""/></div>
						</td>
					</tr>

					<tr><td width="25%">Exam<span style="color:red;">*</span> </td><td width="49%"><?php populate_list_array("lstexam[]", $my_exams, "id", "name", gINVALID,false); ?></td></tr>

					<tr><td width="49%">Subject </td><td width="49%"><?php populate_list_array("lstsubject[]", $my_subjects, "id", "name", gINVALID,false); ?></td></tr>

					<tr><td width="25%">Section </td><td width="49%"><?php populate_list_array("lstsection[]", $my_sections, "id", "name", gINVALID, false); ?></td></tr>

					<tr><td width="49%">Language </td><td width="49%"><?php populate_list_array("lstlanguage[]", $my_languages, "id", "name", gINVALID, false); ?></td></tr>

					<tr><td width="25%">Difficulty Level </td><td width="49%"><?php populate_list_array("lstdifficultylevel[]", $my_difficulty_levels, "id", "name", gINVALID, false); ?></td></tr>

					<tr><td width="49%">Number Of Questions<span style="color:red;">*</span></td><td width="49%"><input type="text" name="no_questions[]" value =""/></td></tr>

					<tr><td width="49%">Total Mark<span style="color:red;">*</span></td><td width="49%"><input type="text" name="total_mark[]" value =""/></td></tr>

					<tr>
						<td width="49%">
							Negative Mark <input type="text" name="negative_mark[]" value =0  style="width:50px;"/>
						</td>
						<td width="49%">
							For	<input type="text" name="wrong_answer_count[]" value =0 style="width:50px;"/> Wrong Answers
						</td>
					</tr>
						
				</table>
			</div>
			<?php
				$i++;
			}
			else
			{
				while(count($myquiz_details) > $i)
				{
					$j=$i+1;

			?>
				<div id="<?php echo 'real_quiz_dtls'.$j;?>">
				<table border="0" cellspacing="4" width="100%" cellpadding="2" id="real_qns_list">
					<tr>
						<td>
							Quiz Rule <?php echo $j;?>  : </td><td align="right"> 
<?php if($myquiz_details[$i]['id'] > 0){ ?>
 	<p id="msg_validate_<?php echo $j; ?>">Validated</p> <input type="hidden"  name ="h_validate_<?php echo $j; ?>" value="1" />
<?php }else{ ?>
	<p id="msg_validate_<?php echo $j; ?>">Not Validated</p> <input type="hidden"  name ="h_validate_<?php echo $j; ?>" value="-1" />
<?php } ?>
 <div><input type="button" value="close" id="<?php echo $j; ?>" class="real_quiz_hide"/> <input type="button" value="Validate Rule" name="button_validate_rule[]" rule_id="<?php echo $j; ?>" class="button_validate_rule" onClick = "check_rule(this);" /> </div>
						</td>
					</tr>

					<tr><td width="25%">Rule Description<span style="color:red;">*</span> </td><td width="49%"><textarea name="ruledescription[]" cols="45" rows="5" id="ruledescription[]"><?php echo $myquiz_details[$i]['description']?></textarea></td></tr>

					<tr><td width="25%">Question Ids</td><td width="49%"><textarea name="rulequestionids[]" cols="45" rows="5" id="rulequestionids[]"><?php echo $myquiz_details[$i]['question_ids']?></textarea>
					</td></tr>

					<tr><td></td><td align="right">
						<input type="button" name="get_questionids[]" class="btn_get_questionids" id="get_questionids[]" value = "Get Question Ids" rule_id="<?php echo $j; ?>" />
					</td>
					</tr>
					<?php 
						if($myquiz_details[$i]['question_group'] == QUESTION_GROUP_TRUE){
								$checked = "checked";
								$style = 'style="display:block"';
						}else{
							$checked = "";
							$style = 'style="display:none"';
						}
					?>

					<tr>
						<td width="25%">
							From Passage&nbsp;<input type="checkbox" value="<?php echo $j; ?>" name="chk_passage[]" id="chk_passage[]" <?php echo $checked; ?>/>
						</td>
						<td width="49%">
							<div id="div_grp<?php echo $j; ?>" <?php echo $style; ?>>&nbsp;&nbsp;Number of Question Groups<span style="color:red;">*</span> <input type="text" style="width:110px;" name="no_question_groups[]" value ="<?php echo $myquiz_details[$i]['number_of_question_groups']?>"/></div>
						</td>
					</tr>

					<tr><td>Exam<span style="color:red;">*</span> </td><td><?php populate_list_array("lstexam[]", $my_exams, "id", "name", $myquiz_details[$i]['exam_id'],false); ?></td></tr>

					<tr><td>Subject </td><td ><?php populate_list_array("lstsubject[]", $my_subjects, "id", "name", $myquiz_details[$i]['subject_id'],false); ?></td></tr>

					<tr><td>Section </td><td><?php populate_list_array("lstsection[]", $my_sections, "id", "name", $myquiz_details[$i]['section_id'], false); ?></td></tr>

					<tr><td>Language </td><td><?php populate_list_array("lstlanguage[]", $my_languages, "id", "name", $myquiz_details[$i]['language_id'], false); ?></td></tr>

					<tr><td>Difficulty Level </td><td><?php populate_list_array("lstdifficultylevel[]", $my_difficulty_levels, "id", "name", $myquiz_details[$i]['diffilulty_level_id'], false); ?></td></tr>

					<tr><td>Number Of Questions<span style="color:red;">*</span></td><td ><input type="text" name="no_questions[]" value ="<?php echo $myquiz_details[$i]['number_of_questions']; ?>"/></td></tr>

					<tr><td width="49%">Total Marks<span style="color:red;">*</span></td><td width="49%"><input type="text" name="total_mark[]" value ="<?php echo $myquiz_details[$i]['total_mark']; ?>"/></td></tr>

					<tr>
						<td width="49%">
							Negative Mark <input type="text" name="negative_mark[]" value ="<?php echo $myquiz_details[$i]['negative_mark']; ?>"  style="width:50px;"/>
						</td>
						<td width="49%">
							For	<input type="text" name="wrong_answer_count[]" value ="<?php echo $myquiz_details[$i]['wrong_answer_count']; ?>" style="width:50px;"/> Wrong Answers
						</td>
					</tr>

			
					
				</table>
				</div>

			<?php

					$i++;
				}
			}
			?>
				
			</div>
			<div id="add_more_quiz">
					<input type="button" name="add_more" value="Add More" id="add_more"/>
					<input type="hidden" name="cnt" value="<?php echo $i; ?>" id="cnt">
			</div>
				
			</td>
		</tr>

		

		<tr><td colspan="2">&nbsp;</td></tr>
			
		<tr>
			<td></td>
			<td>
				<input name="submit" type="submit" value="submit" id="submit"/>
				<input type="hidden" name="h_id" id="h_id" value="<?php echo $myquiz->id; ?>" >
			</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
</table>

</form>
