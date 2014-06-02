<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/demo.php">Demo Exam </a>'; ?>

<div class="innercontainer-blk">
	<p class="heading">
		<span class="fleft">Mock Tests - Demo</span>
		<span class="pagination fright">
		<?php  $Mypagination->pagination_style_number_with_button();?>		
		</span>
	</p>
	<div class="two-thirds column mright8 bottom-1">
		<div class="inner-box">
<!--			<p class="sub-heading bottom-1">Demo Quizzes</p>
-->			<?php if ( $data_demo_quiz == false ){
					echo $mesg_demo_quiz;
				}
				else{ 
					$index = 0;
					
					$new_exam = "";
					$slno = 1;
					while ( $count_demo_quiz > $index ){
						$link = "/demo_test_start.php?id=".$data_demo_quiz[$index]["id"];
						if($new_exam != $data_demo_quiz[$index]["exam_name"]){
							$new_exam = $data_demo_quiz[$index]["exam_name"];
						//	echo  '<p class="description"><strong>'.$data_demo_quiz[$index]["exam_name"].'</p>';
							//$slno = 1;
						}
			?>


			<p class="bottom-1 description">
				<?php echo $slno; ?> :  <?php echo $data_demo_quiz[$index]["name"]; ?> ( <?php echo $data_demo_quiz[$index]["credit"]; ?> Credits )<br> <a href="<?php echo $link; ?>"><input type="submit" class="button" value="TAKE TEST" name="submit"></a> </p>
				
								
			<?php 

						$slno++;
						$index++;
					}
				} 

			?>


		</div>	
	</div>
	<div class="one-third column mright8 bottom-1">
		<div class="inner-box">
			<div class="credit-balance">
				<p class="head">Credit Balance:</p>
				<div class="dblk">
					<p class="fleft">0</p>
					<p class="fright"> <a href="/sign_up.php"><input type="submit" class="button" value="Sign Up"></a></p>
				</div>
			</div>
			
			
		</div>	
	</div>
	<div class="sixteen columns bottom-1">
		<span class="pagination fright">
			<?php  $Mypagination->pagination_style_number_with_button();?>		
		</span>
	</div>
</div>

