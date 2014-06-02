<?php 
 $breadcrumb = '<a href="/index.php">Home</a> &raquo; <a href="/test.php">Online Test</a>';
 ?>               
 <form  target="_self" method="post" action="<?php echo $current_url?>" name="frm_examination" id="frm_examination">
                <div class="innercontainer-blk">
                    <p class="heading">
                        <span class="fleft"><?php echo $usertest->quiz_name; ?></span>
                        <span class="pagination fright">
                            <?php if(isset($chk_flag)){?>
                            <input type="button" name="submit_link" value="Back to test" class="button" id="bt_back_to_test"/>&nbsp;&nbsp;
                            <?php }else{?>
                            <input type="submit" value="Display Flagged questions" name="submit" id="search" class="button"/>
                            <?php }?>
                            &nbsp;

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

                            <?php if($current_qns_list == false){?>
                            <?php echo $mesg; ?>
                            <?php }else{
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
                            
                                <span class="number"><?php echo $current_qns_list[$i]['slno'];?></span>
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
                            <div style="clear:both;" ></div>
                            <?php
                        
                                        if($current_qns_list[$i]['question_type_id'] == QUESTION_TYPE_SINGLE_ANSWER) {
                                            echo answer_options($current_qns_list[$i]['id'],$current_qns_list[$i]['options'],$current_qns_list[$i]['user_keys'], $current_qns_list[$i]['option_images'], $current_qns_list[$i]['question_id']); 
                                        }
                                        elseif ($current_qns_list[$i]['question_type_id'] == QUESTION_TYPE_MULTIPLE_ANSWERS) { 
                                           echo answer_options_multiple($current_qns_list[$i]['id'],$current_qns_list[$i]['options'], $current_qns_list[$i]['user_keys'], $current_qns_list[$i]['option_images'], $current_qns_list[$i]['question_id']);
                                        }                        
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

                            <input value="Finish" type="submit" name="submit" id="submit_finish" class ="button" />
                            <input type="submit" name="hd_quit" style="display:none" id="hd_quit"/>
                            <input value="Quit" type="button" name="submit" class="button gray" id="real_quit"/>
                        </span>
                        <span class="fright">
                            <?php if(isset($chk_flag)){?>
                            <input type="button" name="submit_link" value="Back to test" class="button" id="bt_back_to_test"/>&nbsp;&nbsp;
                            <?php }else{?>
                            <input type="submit" value="Display Flagged questions" name="submit" id="search" class="button"/>
                            <?php }?>
                        </span>
                    </div>
                    
                </div>

</form>
