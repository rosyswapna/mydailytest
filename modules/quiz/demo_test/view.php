<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/demo_test.php">Demo Test</a>'; ?>
<form  target="_self" method="post" action="<?php echo $current_url?>" name="frm_examination" id="frm_examination">
	<div class="innercontainer-blk">
		<p class="heading">
            <span class="fleft">Demo Test</span>
            <span class="pagination fright">
                 <?php if(isset($chk_flag)){?>
	            <input type="button" name="submit_link" value="Back to test" class="button" />&nbsp;&nbsp;
	            <?php }else{?>
	            <input type="submit" value="Display Flagged questions" name="submit" id="search" class="button"/>
	            <?php }?>
                <span class="s-14 familyTahoma">Question per page</span> <?php 
                        if(isset($_REQUEST['lstrecord_per_page'])){
                            $no_of_records = $_REQUEST['lstrecord_per_page'];
                        }
                        else{
                           $no_of_records = 10;
                        }                                  
                        populate_list_array("lstrecord_per_page", $g_ARRAY_record_per_page, "no_of_records", "no_of_records",$no_of_records ,false,false,'style="width:50px;"'); 
                        ?>
            </span>
        </p>
        <input type="submit" name="submit" id="HD_submit" style="display:none;" />

		<div class="two-thirds column mright8 bottom-1">
			<div class="inner-box">
				<?php if($current_qns_list == false){
					echo "No Records Found";
				 }
				 else{
					$i = 0;$question_group_id = "";
					while($count_data > $i)
					{
						if($current_qns_list[$i]['question_group_id'] > 0)
                        {
                            if($current_qns_list[$i]['question_group_id'] != $question_group_id){
                                $question_group_id = $current_qns_list[$i]['question_group_id'];
                                echo '<p id="passage"><span class="txt">'.$current_qns_list[$i]['passage'].'</span></p>';
                            }
                        } 

				?>
					<p class="test-head">
						<span class="number"><?php echo $current_qns_list[$i]['slno'];  ?> </span>
						<span class="txt">
							<?php
                                if($current_qns_list[$i]['image'] != ""){
                                    $question_description = $current_qns_list[$i]['question'];
                                    $img_path = $current_qns_list[$i]['question_id']."/".$current_qns_list[$i]['image'];
                                    echo '<img src="images/questions/'.$img_path.'"  alt="'. $question_description.'"/>';
                                }else{
                                    echo $current_qns_list[$i]['question']; 
                                }
                            ?>
						</span>
						<span class="flag">
						<?php 
							$img_id = "flag_". $current_qns_list[$i]['id']."_".$current_qns_list[$i]['flag'];
							if($current_qns_list[$i]['flag']==0){

						?>
						<img src="images/flag.png" title="Flag this question and answer later" alt="Flag Active" class="flag" id="<?php echo $img_id; ?>"/>
						<?php }else if($current_qns_list[$i]['flag']==1){?>
						<img src="images/flag-active.png" title="This question is flagged" alt="Flag Active" class="flag" id="<?php echo $img_id; ?>"/>
						<?php }?>
						</span>
					</p>
					<div style="clear:both;"></div>
					<?php  

					echo answer_options($current_qns_list[$i]['id'],$current_qns_list[$i]['options'],$current_qns_list[$i]['user_keys'],$current_qns_list[$i]['option_images'], $current_qns_list[$i]['question_id']); 
						$i++;
					}
				}
			?> 
			</div>
		</div> 

		<div class="one-third column mright8 bottom-1">
            <div class="inner-box">
                <div class="timer">
                    <span class="s-45" id="clock"></span>
                    <span class="s-20">time left</span>
                    <span>
                        <input type="button" value="Pause" class="button gray" id="pause_button" name="submit"/>

                    </span>
                </div>
            </div>  

			<div class="inner-box">
				<div class="timer free-mock toprel">
					<span class="s-16">Sign up to take unlimited mock tests</span>
					<span><a href="/sign_up.php" ><input type="button" value="Sign Up" class="button" /></a></span>
				</div>
			</div>
        </div>

		<div class="sixteen columns bottom-1">
			<span class="fleft">
				<?php if ($Mypagination->page_num > 0) { // Show if not first page ?>
                    <input value="First" type="button" name="submit_link"  id="submit_first"  class ="button"/>&nbsp;&nbsp;
                    <?php }?>

                    <?php if ($Mypagination->page_num > 0) { // Show if not first page ?>
                    <input value="Previous" type="button" name="submit_link"  id="submit_previous" class ="button" />&nbsp;&nbsp;
                    <?php }?>

                    <?php if ($Mypagination->page_num < $Mypagination->total_pages) { // Show if not last page ?>&nbsp;&nbsp;
                    <input value="Next" type="button" name="submit_link"  id="submit_next" class ="button" />
                    <?php }?>

                    <?php if ($Mypagination->page_num < $Mypagination->total_pages) { // Show if not last page ?>&nbsp;&nbsp;
                    <input value="Last" type="button" name="submit_link"  id="submit_last" class ="button" />
                    <?php }?>
				<input value="Finish" class="button show-result"  type="submit" name="submit"  />
				<input value="Quit" type="button" name="submit" class="button gray" id="demo_quit"/>
				<input value="Quit" type="submit" name="submit" style="display:none;" id="hd_quit" />
			</span> 
			<span class="fright">
	            <?php if(isset($chk_flag)){?>
	            <input type="button" name="submit_link" value="Back to test" class="button" />&nbsp;&nbsp;
	            <?php }else{?>
	            <input type="submit" value="Display Flagged questions" name="submit" id="search" class="button"/>
	            <?php }?>
	            
	        </span>
		</div>

	</div>
</form>
<?php
ob_start();
?>
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['L@tEx','L@tEx'],['$$$','$$$']],
      processEscapes: true }});
</script>
<script type="text/javascript"
  src="script/MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<?php
$mathsjs .= ob_get_contents();
ob_end_clean();
?>
