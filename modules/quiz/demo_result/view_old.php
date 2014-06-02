
				<div class="innercontainer-blk">
					<p class="heading">
						<span class="fleft">Result : DEMO QUIZ</span>
					</p>
					<div class="sixteen columns mright8 bottom-4" style="border-bottom:1px solid #ccc">
						<div class="inner-box">
							<p class="description ">Total No. of Quesions : <strong><?php echo $total_questions; ?></strong>  |  No. of Quesions Answered: <strong><?php echo $attempted; ?></strong>  |  No. of Correct Answers : <strong><?php echo $correct_ans; ?></strong></p>
							<p class="description bottom-1">|  No. of Wrong Answers : <strong><?php echo $wrong_ans; ?></strong></p>
							<p class="description fright">
							
	 <form  target="_self" method="post" action="/demo_review.php" name="frm_examination" id="frm_examination">						
<?php	
/*foreach ($question_ids as $question_id){
		if (isset($_POST["ans_".$question_id])){*/
?>	
			<input name="h_answer_keys[<?php echo $question_id; ?>]" type="hidden" value="<?php echo $_POST["ans_".$question_id]; ?>" />
<?php
		//}
	//}							
?>	
<input name="h_quiz_id" type="hidden" value=<?php //echo $_POST["h_id"]; ?> />
 <input value="Review" type="submit" name="finish" class="button"/>						
 </form>									
							
							
							
							
							
							 
							 
							 
							 
							 
							 
							 
							 
						
						</div>	
					
					</div>
					<div>
	<span class="description fright">				
For detailed reports, reviews please</font> <a href="sign_up.php" class="sign_up"><input type="submit" class="button" value="REGISTER"></a>&nbsp;&nbsp;&nbsp;
</span><p class="description fright">&nbsp;&nbsp;&nbsp;</p> 
				</div>
			