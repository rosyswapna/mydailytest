<form  target="_self" method="post" action="<?php echo $current_url?>" name="frm">
<div class="innercontainer-blk">
	<p class="heading">
		<span class="fleft">Quiz</span>
		<span class="pagination fright">
			 <a class="current" href="quizzes.php">List All</a>
		</span>
	</p>
	
	
	<div class="one-third column">
		<div class="form-box">
			<label><?php echo$CAP_name; ?> <small>*</small></label>
			<input type="text" name="txtname" id="txtname" value="<?php echo $myquiz->name;?>"/>
		</div><!-- End Box -->
	</div>

	
	<div class="one-third column">
		<div class="form-box">
			<label><?php echo$CAP_description; ?> <small>*</small></label>
			<textarea  name="txtdescription" id="txtdescription"><?php echo $myquiz->description;?></textarea>
		</div><!-- End Box -->
	</div>

	
	<div class="one-third column">
		<div class="form-box">
			<label><?php echo$CAP_credit; ?> </label>
			<input type="text" name="txtcredit" id="txtcredit" value="<?php echo $myquiz->credit;?>"/>
		</div><!-- End Box -->
	</div>

	
	<div class="one-third column">
		<div class="form-box">
			<label><?php echo$CAP_exam; ?> <small>*</small></label>
			<?php populate_list_array("lstexamination", $my_exams, "id", "name", $myquiz->exam_id,$disable=false); ?>
		</div><!-- End Box -->
	</div>

	
	<div class="one-third column">
		<div class="form-box">
			<label><?php echo$CAP_time; ?> <small>*</small></label>
			<?php populate_list_array("lsthour", $g_ARRAY_hours, "hour", "hour", $myquiz->hour,false,false); ?>:
			<?php populate_list_array("lstminute", $g_ARRAY_minutes, "minute", "minute", $myquiz->minute,false, false); ?>:
			<?php populate_list_array("lstsecond", $g_ARRAY_seconds, "second", "second", $myquiz->second,false, false); ?>
		</div><!-- End Box -->
	</div>

	
	<div class="one-third column">
		<div class="form-box">
			<label><?php echo$CAP_type; ?> <small>*</small></label>
			<?php populate_list_array("lstquiz_type", $my_quiz_types, "id", "name", $myquiz->quiz_type_id,$disable=false); ?>
		</div><!-- End Box -->
	</div>

	<div class="sixteen columns"></div>

	<div class="one-third column" id="div_q_nos">
		<div class="form-box">
			<label><?php echo$CAP_questionids; ?> <small>*</small></label>
			<textarea name="txtquestions" cols="45" rows="5" id="txtquestions"><?php echo $myquiz->question_ids;?></textarea>
			<br/><br/>
			<input type="checkbox" value="1" name="chk_specialdemo"  <?php if($myquiz->special_demo==SPECIAL_DEMO_TRUE){?> checked <?php } ?>/>&nbsp;&nbsp;Special Demo
		</div><!-- End Box -->
	</div>
	<div class="sixteen columns"></div>

	<div class="one-third column" id="div_real1">
		<div class="form-box">
			<label><?php echo $CAP_date ?> <small>*</small></label>
			<?php echo $CAP_from; ?> <input type="text" name="date_from" value="<?php echo $myquiz->period_from;?>" class="datepicker"/><br/>
			<?php echo $CAP_to; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="date_to" value="<?php echo $myquiz->period_to;?>" class="datepicker"/>
		</div><!-- End Box -->
	</div>


	<div class="one-third column" id="div_real2">
		<div class="form-box">
			<label><?php echo $CAP_time; ?> <small>*</small></label>
			<?php echo $CAP_from; ?> <input type="text" name="time_from" value="<?php echo $myquiz->time_from;?>" class="timepicker"/><br/>
			<?php echo $CAP_to; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="time_to" value="<?php echo $myquiz->time_to;?>" class="timepicker"/>
		</div><!-- End Box -->
	</div>

	<div id= "div_real">
	
			<div id ="real_quiz_dtls" >
			
			<?php 
				$i=0;
				if($myquiz_details == false)
				{
			?>
			<div id="real_quiz_dtls1" class="grey_body">

				<div class="sixteen columns">
					<div class="form-box">
						<div class="top_left">
							<p>Quiz Rule 1  : </p>
							<input type="hidden" name ="h_validate_1" value="-1" />
						</div>
						<div class="top_rule">
							<p id="msg_validate_1">Not Validated &nbsp;</p> 
							<input type="button" value="close" id="1" class="real_quiz_hide" /> 
							<input type="button" value="Validate Rule" rule_id="1" class="button_validate_rule" name="button_validate_rule[]" onClick = "check_rule(this);" />&nbsp;&nbsp;  
						</div>
					</div>
				</div>

				<div class="sixteen columns"></div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_ruledescription; ?> <small>*</small></label>
						<textarea name="ruledescription[]" cols="45" rows="5" id="ruledescription[]"></textarea>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_subject; ?> </label>
						<?php populate_list_array("lstsubject[]", $my_subjects, "id", "name", gINVALID,false); ?>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_section; ?> </label>
						<?php populate_list_array("lstsection[]", $my_sections, "id", "name", gINVALID, false); ?>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_language; ?> </label>
						<?php populate_list_array("lstlanguage[]", $my_languages, "id", "name", gINVALID, false); ?>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_difficultylevel; ?> </label>
						<?php populate_list_array("lstdifficultylevel[]", $my_difficulty_levels, "id", "name", gINVALID, false); ?>
					</div>
				</div>

				<div class="sixteen columns"></div>
				
				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_exam; ?> <small>*</small></label>
						<?php populate_list_array("lstexam[]", $my_exams, "id", "name", gINVALID,false); ?>
					</div>
				</div>


				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_totalmark; ?> <small>*</small></label>
						<input type="text" name="total_mark[]" value =""/>
					</div>
				</div>

				<div class="sixteen columns"></div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_questionids; ?></label>
						<textarea name="rulequestionids[]" cols="45" rows="5" id="rulequestionids[]"></textarea>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label>From Passage </label><input type="checkbox" value="1" name="chk_passage[]" id="chk_passage[]" group="0"/>
						<div id="div_grp1" style="display:none;">
							<label><?php echo $CAP_numberofquestiongroups; ?><small>*</small></label>
							<input type="text" style="width:110px;" name="no_question_groups[]" value =""/>
						</div>
						<div id="div_non_grp1" style="display:block;">
							<label><?php echo $CAP_numberofquestions; ?><small>*</small></label>
							<input type="text" name="no_questions[]" value =""/>
						</div>
					</div>
				</div>


				<div class="one-third column" id="div_questionids">
					<div class="form-box">
						<input type="button" class="btn_get_questionids" name="get_questionids[]" id="get_questionids1"  value = "Get Question Ids" rule_id="1"/>&nbsp;&nbsp;
					</div>
				</div>
				<div class="sixteen columns"></div>
				
				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_negativemark; ?> <small>*</small></label>
						<input type="text" name="negative_mark[]" value =0  style="width:50px;"/>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_wronganswercount; ?> <small>*</small></label>
						<input type="text" name="negative_mark[]" value ="0"  style="width:50px;"/>
					</div>
				</div>

			</div>
			<?php
				$i++;
			}
			else
			{
				while(count($myquiz_details) > $i)
				{
					$j=$i+1;
					if($j%2 == 0){
						$class = "white_body";
					}else{
						$class = "grey_body";
					}

			?>
				<div id="<?php echo 'real_quiz_dtls'.$j;?>" class="<?php echo $class;?>">

				<div class="sixteen columns">
					<div class="form-box">
						<div class="top_left">
							<p>Quiz Rule <?php echo $j;?>  : </p>
							<input type="hidden" name ="h_validate_1" value="-1" />
						</div>
						<div class="top_rule">
							<?php if($myquiz_details[$i]['id'] > 0){ ?>
 								<p id="msg_validate_<?php echo $j; ?>">Validated</p> 
 								<input type="hidden"  name ="h_validate_<?php echo $j; ?>" value="1" />
							<?php }else{ ?>
								<p id="msg_validate_<?php echo $j; ?>">Not Validated</p> 
								<input type="hidden"  name ="h_validate_<?php echo $j; ?>" value="-1" />
							<?php } ?>
							<input type="button" value="close" id="<?php echo $j; ?>" class="real_quiz_hide" /> 
								<input type="button" value="Validate Rule" rule_id="<?php echo $j; ?>" class="button_validate_rule" name="button_validate_rule[]" onClick = "check_rule(this);" />&nbsp;&nbsp;  
						</div>
					</div>
				</div>

				<div class="sixteen columns"></div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_ruledescription; ?> <small>*</small></label>
						<textarea name="ruledescription[]" cols="45" rows="5" id="ruledescription[]"><?php echo $myquiz_details[$i]['description']?></textarea>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_subject; ?> </label>
						<?php populate_list_array("lstsubject[]", $my_subjects, "id", "name", $myquiz_details[$i]['subject_id'],false); ?>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_section; ?> </label>
						<?php populate_list_array("lstsection[]", $my_sections, "id", "name", $myquiz_details[$i]['section_id'], false); ?>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_language; ?> </label>
						<?php populate_list_array("lstlanguage[]", $my_languages, "id", "name", $myquiz_details[$i]['language_id'], false); ?>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_difficultylevel; ?> </label>
						<?php populate_list_array("lstdifficultylevel[]", $my_difficulty_levels, "id", "name", $myquiz_details[$i]['diffilulty_level_id'], false); ?>
					</div>
				</div>

				<div class="sixteen columns"></div>
				
				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_exam; ?> <small>*</small></label>
						<?php populate_list_array("lstexam[]", $my_exams, "id", "name", $myquiz_details[$i]['exam_id'],false); ?>
					</div>
				</div>


				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_totalmark; ?> <small>*</small></label>
						<input type="text" name="total_mark[]" value ="<?php echo $myquiz_details[$i]['total_mark']; ?>"/>
					</div>
				</div>

				<div class="sixteen columns"></div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_questionids; ?></label>
						<textarea name="rulequestionids[]" cols="45" rows="5" id="rulequestionids[]"><?php echo $myquiz_details[$i]['question_ids']?></textarea>
					</div>
				</div>


				<div class="one-third column">
					<div class="form-box">
						<label>From Passage </label><input type="checkbox" group ="<?php echo $myquiz_details[$i]['question_group']; ?>" value="<?php echo $j; ?>" name="chk_passage[]" id="chk_passage[]" />
						
						<div id="div_grp<?php echo $j; ?>">
							<label><?php echo $CAP_numberofquestiongroups; ?><small>*</small></label>
							<input type="text" style="width:110px;" name="no_question_groups[]" value ="<?php echo $myquiz_details[$i]['number_of_question_groups']?>"/>
						</div>
						
						<div id="div_non_grp<?php echo $j; ?>">
							<label><?php echo $CAP_numberofquestions; ?><small>*</small></label>
							<input type="text" name="no_questions[]" value ="<?php echo $myquiz_details[$i]['number_of_questions']; ?>"/>
						</div>
						
					</div>
				</div>


				<div class="one-third column" id="div_questionids">
					<div class="form-box">
						<input type="button" class="btn_get_questionids" name="get_questionids[]" id="get_questionids[]" value = "Get Question Ids" rule_id="<?php echo $j; ?>"/>&nbsp;&nbsp;
					</div>
				</div>
				<div class="sixteen columns"></div>
				
				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_negativemark; ?> <small>*</small></label>
						<input type="text" name="negative_mark[]" value ="<?php echo $myquiz_details[$i]['negative_mark']; ?>"  style="width:50px;"/>
					</div>
				</div>

				<div class="one-third column">
					<div class="form-box">
						<label><?php echo $CAP_wronganswercount; ?> <small>*</small></label>
						<input type="text" name="negative_mark[]" value ="<?php echo $myquiz_details[$i]['wrong_answer_count']; ?>"  style="width:50px;"/>
					</div>
				</div>

			</div>

			<?php

					$i++;
				}
			}
			?>
				
			</div>

			<div class="sixteen columns" id="add_more_quiz">
				<div class="form-box">
					<input type="button" name="add_more" value="Add More" id="add_more" class="button"/>
				</div>
			</div>

	</div><!--real div ends here-->

	<div class="sixteen columns">
		<div class="form-box">
			<input name="submit" type="submit" value="submit" id="submit" class="button"/>
			<input type="hidden" name="h_id" id="h_id" value="<?php echo $myquiz->id; ?>" >
		</div>
	</div>



</div>


</form>


