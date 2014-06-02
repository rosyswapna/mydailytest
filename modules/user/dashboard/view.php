<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/dashboard.php">Dashboard</a>'; ?>

<div class="innercontainer-blk">
					<p class="heading">
					
						<span class="fleft">Dashboard</span>
						<span class="pagination fright">
						<?php  $Mypagination->pagination_style_number_with_button();?>		
						</span>
					</p>
					<div class="four columns mright8 bottom-1">
						<div class="inner-box">
							<p class="sub-heading bottom-1">Exams</p>
							<form  name="frmupdate" id="frmupdate" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">
							  <?php 
                if($my_exams== false){
                    echo "No Records found";
                }
                else{
                     $i=0;
                     $user_exam_preferences = explode(DEFAULT_IDS_DELIMITER, $myuser->exam_ids);
                     while(count($my_exams) > $i){
                        (in_array($my_exams[$i]['id'], $user_exam_preferences))?$checked="checked":$checked="";
                    ?>
                    <p class="exam_checkboxs">
                     <input type="checkbox" value="<?php echo $my_exams[$i]['id'];?>" name="chk_exam[]" <?php echo $checked; ?> id="chk_exam">
					 
                        <?php echo $my_exams[$i]['name'];?>
                    </p>
                    <?php
                        $i++;
                     }
                 }
                ?><br />
				<div style="width:0px;hieght:0px;overflow:hidden;"> <input type="submit" name="submit" class="button" value="<?php echo $CAP_update?>" id="update_exam"></div>
				 </form>
						</div>	
					</div>
											<div class="eight columns mright8 bottom-1">
											<div class="inner-box">
											<p class="sub-heading bottom-1">Quizzes</p>
											<Div align="justify"><font size="2" color="#FF0000">Each time you take any tests below, you will be given a new set of Questions.  You can review each test that you have taken later in TEST HISTORY</font></Div>
							<?php if ( $data_real_quiz == false ){?>
								<?php }else{ 
		$index = 0;
		$new_exam = "";
		$slno = 1;
		$examid= "";
		while ($count_real_quiz > $index ){	
			$link = "/test_start.php?id=".$data_real_quiz[$index]["id"];

			if($new_exam != $data_real_quiz[$index]["exam_id"]){
				$new_exam = $data_real_quiz[$index]["exam_id"];
				if($slno > 1){
				?>
				<p class="bottom-2 description" style="text-align:right"><a href="/dashboard_more.php?id=<?php echo $examid; ?>"><strong>List all Quizzes</strong></a></span></p><?php 
				}
				echo  '<p class="description"><strong>' .$exams[$data_real_quiz[$index]["exam_id"]].'</p>'; 
				$slno = 1; 
				
			}	?>
				<?php if($slno < 4){?>
			<p class="bottom-1 description"><?php echo $slno; ?> :  <?php echo $data_real_quiz[$index]["name"]; ?> 
			
			( <?php echo $data_real_quiz[$index]["credit"]; ?> Credits )<br /><a href="<?php echo $link; ?>"><input type="submit" class="button" value="TAKE TEST"></a></p>														
			<?php }?>				
							<?php 
		$examid= $data_real_quiz[$index]["exam_id"];						
		$slno++; 
		$index++;
			}
			if($slno > 1){
				?>
				<p class="bottom-2 description" style="text-align:right"><a href="/dashboard_more.php?id=<?php echo $examid; ?>"><strong>List all Quizzes</strong></a></span></p><?php 
				}
			
		 } ?>		
		 
					</div>	
					</div>
					
			

		
			
			<div class="four columns mright8 bottom-1">
						<div class="inner-box">
							<div class="credit-balance">
								<p class="head">Credit Balance:</p>
								<div class="dblk">
									<p class="fleft"><?php if(isset($_SESSION[SESSION_TITLE.'user_credit'])) echo $_SESSION[SESSION_TITLE.'user_credit']; ?></p>
									<p class="fright"><a href="/get_credit.php"><input type="button" class="button" value="Get Credit"></a></p>
								</div>
							</div>
			
			
			
			
			
			
								<div class="other-blk">
								<div class="dblk">
									<p class="head"><?php echo $total_quiz_number;?></p>
									<p>Quiz attempted</p>
								</div>
								
								<div class="dblk no-border">
									<p class="head"><?php echo $total_finished_quiz_number;?></p>
									<p>Quiz completed so far</p>
								</div>
			
						</div>	
					</div>
					<div class="sixteen columns bottom-1">
						<span class="pagination fright">
							<?php  $Mypagination->pagination_style_number_with_button();?>		
						</span>
					</div>
				</div>

