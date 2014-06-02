<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/demo_result.php?id='.$demotest->id.'">Demo Result </a>'; ?>
<script type="text/javascript">
	window.onload = function () {
		
		
		
		
		var chart = new CanvasJS.Chart("chartContainer",
		{
			title:{
				text: "",
				fontFamily: ""

			},
			legend: {
				verticalAlign: "bottom",
				horizontalAlign: "center"
			},
			toolTip:{
				enabled: true
			},
			theme: "theme1",
			data: [
			{        
				type: "pie",
				indexLabelFontFamily: "",       
				indexLabelFontSize: 11,
				indexLabelFontWeight: "bold",
				startAngle:0,
				indexLabelFontColor: "black",       
				indexLabelLineColor: "darkgrey", 
				indexLabelPlacement: "inside", 
				toolTipContent: "{name}: {y}",
				showInLegend: true,
				dataPoints: [
				{  y: <?php echo $notattempted?>, <?php if ($notattempted==0) { ?>indexLabel: "" , name: " "}, <?php } else {?> indexLabel: "  <?php echo round($notattempted/$total_questions*100)?> %" , name: " "},<?php }?>
				{  y: <?php echo $wrong_ans?>, <?php if ($wrong_ans==0) { ?>indexLabel: "" , name: " "}, <?php } else {?> indexLabel: "  <?php echo round($wrong_ans/$total_questions*100)?> %", name: " "},  <?php }?>
				{  y: <?php echo $correct_ans?>,<?php if ($correct_ans==0) { ?>indexLabel: "" , name: " "}, <?php } else {?>  indexLabel: "  <?php echo round($correct_ans/$total_questions*100)?> %", name: " "} <?php }?>
				
				]
			}
			]
		});

		chart.render();
	}
	</script>
	<script type="text/javascript" src="script/canvasjs.min.js"></script>



<div class="innercontainer-blk bottom-2" style="height:260px;">
					<p class="heading">
						<span class="fleft"><?php echo $myquiz->name;?> : Result</span>
					<!--	<span class="fright"><input type="submit" class="button" value="Back to test history"></span>-->
					</p>
					<div class="two-thirds column mright8 ">
						<div class="inner-box">
							<p class="description ">Total No. of Questions : <strong><?php echo $total_questions; ?></strong>  |  No. of Questions Answered: <strong><?php echo $attempted; ?></strong>  |  No. of Correct Answers : <strong><?php echo $correct_ans; ?></strong></p>
							<p class="description bottom-1">No. of Wrong Answers : <strong><?php echo $wrong_ans; ?></strong>  </p>
							<br />
							<br />
							<br />
							<p class="description bottom-1" align="right"><a href="demo_detailed_analysis.php?id=<?php echo $demotest->id; ?>"><input type="submit" class="button" value="Detailed Analysis"></a></p>
						</div>	
					</div>		
					<div class="one-third column mright8 bottom-1">
						<div class="inner-box">
					<div align="right" style="margin-right:15px;">
					<table  width="0" border="0" cellspacing="0" cellpadding="0">
								<tr>

										<td> &nbsp;&nbsp;<font face="Tahoma" size="1">Correct</font> &nbsp;&nbsp; </td>
										<td width="5" bgcolor="#008000">&nbsp;</td>
										<td> &nbsp;&nbsp;<font face="Tahoma" size="1">Incorrect</font> &nbsp;&nbsp;</td>				
										<td width="5" bgcolor="#C24642">&nbsp;</td>
										<td><font face="Tahoma" size="1">Unaswered</font> &nbsp;&nbsp; </td>
										<td width="5" bgcolor="#FFBF00">&nbsp;</td>										
								</tr>
								
						</table>				
					</div>							
							<div id="chartContainer" style="height: 200px; display:inline-block; position:relative; width: 300px;"></div>
							<!--<img src="images/graph1.png" alt="" />-->
						</div>
					</div>
				
				</div>				
	
				<div class="innercontainer-blk">
							<form  target="_self" method="get" action="<?php echo $current_url?>" name="frm_examination" id="frm_examination" >
			<input type="hidden" name="id" id="id" value="<?php echo $demotest->id; ?>"/>
			<input type="submit" style="display:none" id="hd_submit"/>
					  <p class="heading">
						<span class="fleft"><a name="review"><?php echo $myquiz->name; ?> : Review</a></span>
						<span class="pagination fright">
						 &nbsp;
						  <span class="s-14 familyTahoma">Question per page</span> 
						  <?php 
							if(isset($_REQUEST['lstrecord_per_page'])){
								$no_of_records = $_REQUEST['lstrecord_per_page'];
							}
							else{
							   $no_of_records = $record_per_page;
							} 
							populate_list_array("lstrecord_per_page", $g_ARRAY_record_per_page, "no_of_records", "no_of_records",$no_of_records ,false,false,'style="width:50px;"'); 
						?> 
						</span>
					  </p>				
					<div class="sixteen columns mright8">
						<div class="inner-box review">

							<?php 
              				if($current_qns_list == false){
                  				echo "No records found";
              				}
              				else{
	                  			$i = 0;$question_group_id ="";
								while($count_data > $i)
								{
									
									if($current_qns_list[$i]['user_keys'] == "" || $current_qns_list[$i]['user_keys'] == gINVALID){
				                       $image = '<img src="images/notattempted.png" alt="Right" title="Not Answered" />';
				                    }
				                    else{
				                      if($current_qns_list[$i]['user_keys'] == $current_qns_list[$i]['answer_keys']){
				                        $image = '<img src="images/right.png" alt="Right" title="Correct Answer" />';
				                      }
				                      else{
				                        $image = '<img src="images/wrong.png" alt="Wrong" title="Incorrect Answer" />';
				                      }
				                    }

				                    if($current_qns_list[$i]['question_group_id'] > 0)
				                    {
				                        if($current_qns_list[$i]['question_group_id'] != $question_group_id){
				                            $question_group_id = $current_qns_list[$i]['question_group_id'];
				                            echo '<p id="passage"><span class="txt">'.$current_qns_list[$i]['passage'].'</span></p>';
				                        }
				                    } 
							?>

							<p class="test-head">
								<span class="number"><?php echo $current_qns_list[$i]['slno']; ?></span> 
								<span class="txt">
									<?php if($current_qns_list[$i]['image'] != ""){
				                            $question_description = $current_qns_list[$i]['question'];
				                            $img_path = $current_qns_list[$i]['question_id']."/".$current_qns_list[$i]['image'];
				                            echo '<img src="images/questions/'.$img_path.'"  alt="'. $question_description.'"/>';
				                        }else{
				                            echo $current_qns_list[$i]['question']; 
				                        }
				                  ?>
								</span> 
								<span class="ans"><?php echo $image; ?></span> 
								<span class="facebook-share">
									<a target="_new" style="float:right" href="https://www.facebook.com/sharer/sharer.php?u=http://mydailytest.com/challenge_questions.php?id=<?php echo  $current_qns_list[$i]['question_id']?>"><img src="images/facebook_button.png" alt="post of facebook" title="Discuss on Facebook" /></a>
								</span>
							</p>
							<div style="clear:both;"></div>
							<?php echo answer_options($current_qns_list[$i]['id'],$current_qns_list[$i]['options'],$current_qns_list[$i]['user_keys'],$current_qns_list[$i]['answer_keys'],$current_qns_list[$i]['option_images'], $current_qns_list[$i]['question_id']); ?>
							<?php
									$i++;
                				} 
              				}
              				?>
							
						</div>	
					</div>
					
			<div class="inner-box">
				<div class="timer free-mock toprel">
					<span class="s-16">Sign up to take unlimited mock tests</span>
					<span><a href="/sign_up.php" ><input type="button" value="Sign Up" class="button" /></a></span>
				</div>
			</div>
					
          <div class="sixteen columns bottom-1">
			<span class="fleft">
				<?php if ($Mypagination->page_num > 0) { // Show if not first page ?>
                    <input value="First" type="button" name="submit"  id="submit_first"  class ="button button_pagination"/>
                    <?php }?>

                    <?php if ($Mypagination->page_num > 0) { // Show if not first page ?>
                    <input value="Previous" type="button" name="submit"  id="submit_previous" class ="button button_pagination"/>
                    <?php }?>

                    <?php if ($Mypagination->page_num < $Mypagination->total_pages) { // Show if not last page ?>
                    <input value="Next" type="button" name="submit"  id="submit_next" class ="button button_pagination"/>
                    <?php }?>

                    <?php if ($Mypagination->page_num < $Mypagination->total_pages) { // Show if not last page ?>
                    <input value="Last" type="button" name="submit"  id="submit_last" class ="button button_pagination"/>
                    <?php }?>

			</span> 
            <span class="fright">
            </span>
          </div>
        
          
       

</form>

