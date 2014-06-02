<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/result.php?id='.$user_test_id.'">Results</a>'; ?>
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
				indexLabelFontSize: 7,
				indexLabelFontWeight: "bolder",
				startAngle:0,
				indexLabelFontColor: "black",       
				indexLabelLineColor: "darkgrey", 
				indexLabelPlacement: "inside", 
				toolTipContent: "{name}: {y}",
				showInLegend: true,
				dataPoints: [
				{  y: <?php echo $notattempted?>, <?php if ($notattempted==0) { ?>indexLabel: "" , name: " "}, <?php } else {?> indexLabel: "  <?php echo round($notattempted/$total_questions*100)?> %" , name: " "},<?php }?>
				{  y: <?php echo $total_wrong_answers?>, <?php if ($total_wrong_answers==0) { ?>indexLabel: "" , name: " "}, <?php } else {?> indexLabel: "  <?php echo round($total_wrong_answers/$total_questions*100)?> %", name: " "},  <?php }?>
				{  y: <?php echo $total_correct_answers?>,<?php if ($total_correct_answers==0) { ?>indexLabel: "" , name: " "}, <?php } else {?>  indexLabel: "  <?php echo round($total_correct_answers/$total_questions*100)?> %", name: " "} <?php }?>
				
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
						<span class="fleft"><?php echo $quiz->name;?> : Result</span>
						<span class="fright"><a href="/user_test_history.php"><input value="Back to Test History" class="button" type="button"/></a></span>
					</p>
					<div class="two-thirds column mright8 ">
						<div class="inner-box">
							<p class="description ">Total No. of Questions : <strong><?php echo $total_questions; ?></strong>  |  No. of Questions Answered: <strong><?php echo $attempted; ?></strong>  |  No. of Correct Answers : <strong><?php echo $total_correct_answers; ?></strong></p>
							<p class="description bottom-1">No. of Wrong Answers : <strong><?php echo $total_wrong_answers; ?></strong>  </p>
							<br />
							<br />
							<br />
							<p class="description bottom-1" align="right"><a href="/review.php?id=<?php echo $user_test_id; ?>"><input value="Detailed Analysis" class="button" type="button"/></a></p>
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
										<td><font face="Tahoma" size="1">&nbsp;&nbsp;Unanswered</font> &nbsp;&nbsp; </td>
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
<input type="hidden" name="hd_usertestid" id="hd_usertestid" value="<?php echo $usertestdetails->user_test_id; ?>"/>
<input type="submit" style="display:none" id="hd_submit"/>
          <p class="heading">
            <span class="fleft"><?php echo $quiz->name; ?> : Review</span>
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
          <div class="sixteen columns mright8 bottom-1">
            <div class="inner-box review">

              <?php 
              if($current_qns_list == false){
                  echo $mesg;
              }
              else{
                  $i = 0;
				          $question_group_id = "";
                  while($count_data > $i)
                  {
                    if($current_qns_list[$i]['user_keys'] == "" || $current_qns_list[$i]['user_keys'] == gINVALID){
                        $image = '<img src="images/notattempted.png" alt="Not Attempted" title="Not Answered" />';
                    }
                    else{
                      if($current_qns_list[$i]['user_keys'] == $current_qns_list[$i]['answer_keys']){
                        $image = '<img src="images/right.png" alt="Right" title="Correct Answer" />';
                      }
                      else{
                        $image = '<img src="images/wrong.png" alt="Wrong" title="Incorrect Answer" />';
                      }
                    }

                    //check question  modified after test started
                    if(strtotime($current_qns_list[$i]['updated']) > strtotime($usertest->start_time)){
                      $note = "[Note : This question has been modified by the administrator on ".$current_qns_list[$i]['updated']."]";
                    }
                    else{
                      $note = ""; 
                    }

                    if($current_qns_list[$i]['question_group_id'] > 0)
                    {
                        if($current_qns_list[$i]['question_group_id'] != $question_group_id){
                            $question_group_id = $current_qns_list[$i]['question_group_id'];
                            echo '<p id="passage"><span class="txt">'.$current_qns_list[$i]['passage'].'</span></p>';
                        }
                    } 

              ?>
              
              <p class="test-head"><span class="number"><?php echo $current_qns_list[$i]['slno'];?></span>
                <span class="txt" style="width: 81% !important;">
                  <?php if($current_qns_list[$i]['image'] != ""){
                            $question_description = $current_qns_list[$i]['question'];
                            $img_path = $current_qns_list[$i]['question_id']."/".$current_qns_list[$i]['image'];
                            echo '<img src="images/questions/'.$img_path.'"  alt="'. $question_description.'"/>';
                        }else{
                            echo $current_qns_list[$i]['question']; 
                        }
                  ?>
                </span>
                <span class="ans">
                  <a href="/report_question.php?id=<?php echo $current_qns_list[$i]['id'];?>">
                    <img src="images/report_question.png" alt="Report Question" title="Report Question" />
                  </a>
                </span>
		        <span class="ans"><?php echo $image; ?></span>
                <a target="_new" style="float:right" href="https://www.facebook.com/sharer/sharer.php?u=http://mydailytest.com/challenge_questions.php?id=<?php echo $current_qns_list[$i]['question_id']?>">    
                  <img src="/images/button-fshare.gif" title="Discuss on Facebook"/>
                </a><br>
                <font class="note"><?php echo $note; ?></font>
              </p>
<div style="clear:both;"></div>
              <?php

                  if($current_qns_list[$i]['question_type_id'] == QUESTION_TYPE_SINGLE_ANSWER) {
                      echo answer_options($current_qns_list[$i]['id'],$current_qns_list[$i]['options'],$current_qns_list[$i]['user_keys'],$current_qns_list[$i]['answer_keys'],$current_qns_list[$i]['option_images'], $current_qns_list[$i]['question_id']); 
                  }
                  elseif ($current_qns_list[$i]['question_type_id'] == QUESTION_TYPE_MULTIPLE_ANSWERS) {  
                      echo answer_options_multiple($current_qns_list[$i]['id'],$current_qns_list[$i]['options'], $current_qns_list[$i]['user_keys'],$current_qns_list[$i]['answer_keys'],$current_qns_list[$i]['option_images'], $current_qns_list[$i]['question_id']); 
                  }
                  $i++;
                } 
              }
              ?>
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
