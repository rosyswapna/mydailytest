<?php 
	$breadcrumb = '<a href="'.WEB_URL.'/index.php">Home</a>';
	$challenge_question_title='Challenge Question Result';

?>
<div class="innercontainer-blk">
	<p class="heading">	<span class="fleft">Result : Challenge Question</span>	</p>

	<div class="sixteen columns mright8">
	<div class="inner-box review">

	<?php 

		if(trim($user_answer) == trim($correct_answer)){
			$image = '<img src="images/right.png" alt="Right" title="Correct Answer" />';
		}else{
			$image = '<img src="images/wrong.png" alt="Wrong" title="Incorrect Answer" />';
		}
		   
	?>
	
			<p class="test-head">
				<span class="number">1</span> 
				<span class="txt"><?php echo $myquestion->question; ?></span> 
				<span class="ans"><?php echo $image; ?></span> 
			</p>
			<div style="clear:both;"></div>
			<ul><?php  echo answer_options($myquestion->id,$myquestion->options,$user_answer,$correct_answer); ?> </ul>
				<?php echo $result; ?> 	
			<br/>
			<p class="description fright">For More Questions and Tests, Please </font> <a href="sign_up.php" class="sign_up"><input type="submit" class="button" value="Sign Up"></a></p>
		</div>

	
	</div>	
	

			
	

</div>
			

