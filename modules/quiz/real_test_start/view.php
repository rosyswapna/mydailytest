
<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/test_start.php?id='.$myquiz->id.'">Test Details</a>';?>
<form method="post" action="">	
<input type="hidden" name="hd_balancetime" value="<?php if(isset($balance))echo $balance;?>"/>
<div class="innercontainer-blk">
	<p class="heading">Test Details</p>

	<div class="inner-box">
		<p >
			You are about to start '<?php echo $myquiz->name; ?>' Test and your account will be debited by <?php echo $myquiz->credit; ?> Credits.
		</p>

		<?php if($test_end != ""){?>
		<p>Test End Time :<?php echo $test_end;?></p>
		<?php }?>

		<?php if($short_time != ""){?>
		<p>Availabe Time :<?php echo $short_time;?></p>
		<?php }?>
		<p >
			Total number of questions :<?php  echo $myquizdetail->quiz_total_questions; ?> 
		</p>
		<?php if(trim($myquiz->description) != ""){?>
		<p style="text-decoration:underline;">
			<?php echo nl2br($myquiz->description); ?>
		</p>
		
		<?php if($my_quiz_details == false){

		}else{
				$i=0;

				while(count($my_quiz_details) > $i){
					$slno = $i+1;

					echo "<p>".$my_quiz_details[$i]['description']."</p>";
					$i++;
				}
			?>
		<?php }?>
		<?php }else{
			echo "<p>Test Duration : ".$myquiz->total_time."</p>";
		}?>
		
		<br>
	
		<input type="hidden" value="<?php echo $myquiz->id; ?>" name="hd_quizid"/>
		<?php if(isset($_SESSION[SESSION_TITLE.'usertestid'])){?>
			<p class="sub-heading bottom-2"><?php echo $current_quiz ; ?></p>
			<input type="submit" name="submit" value="Pause and Start Next" class="button" />&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="submit" value="Continue" class="button"/>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="hidden" value="pause" name="hd_mode"/>
		<?php }else{?>
		<input type="submit" name="submit" value="Start Now" class="button"/>
		<input type="hidden" value="start" name="hd_mode"/>
		<?php }?>
		<input type="submit" name="submit" value="Cancel" class="button"/>
	</div>

</div>
</form>
