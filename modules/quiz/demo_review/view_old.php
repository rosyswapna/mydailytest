				<div class="innercontainer-blk">
					<p class="heading">
						<span class="fleft">Review :  DEMO</span>
						<span class="pagination fright">
							<input type="submit" class="button" value="Back to result" />&nbsp;
							<span class="s-14 familyTahoma">Question per page</span> <select>
												  <option value="10" selected="selected">10</option>
												  <option value="20">20</option>
												  <option value="30">30</option>
												  <option value="40">40</option>
												</select> 
						</span>
					</p>
					<div class="two-thirds column mright8 bottom-1">
						<div class="inner-box review">
						<?php 
						
						if($result == false){
                  echo "";
              } else{
                  $i = 0;
						while($counts > $i)
						{
							if( isset ($_POST["h_answer_keys"][$result[$i]['id']])){
								$user_answer_keys=$_POST["h_answer_keys"][$result[$i]['id']];	
							}else{
								$user_answer_keys="";		
							}
							
							
							if($result[$i]['answers'] == "" || $result[$i]['answers'] == gINVALID){
                        		$image = '';
                    		}else{
								  if($result[$i]['answer_keys']== $user_answer_keys){
									$image = '<img src="images/right.png" alt="Right" />';
										
								   }else{
                       				 $image = '<img src="images/wrong.png" alt="Wrong" />';
						
                      				}
                    		}
				?>
					<p class="test-head"><span class="ans"><?php echo $image; ?></span><a target="_new" style="float:right" href="https://www.facebook.com/sharer/sharer.php?u=http://mydailytest.com/challenge_questions.php?id=<?php echo  $result[$i]['id']?>">    
					 <img src="/images/button-fshare.gif"/></a> 		
					<span class="txt"><?php echo $result[$i]['question']; ?></span></p>						
					<ul class="list">		
					<?php  
					
					echo answer_options($result[$i]['id'],$result[$i]['options'],$result[$i]['answer_keys'],$user_answer_keys); ?>
					 </ul><?php
					 $i++;
                } 
              }
              ?>
						</div>	
					</div>
					<div class="one-third column mright8 bottom-1">
						<div class="inner-box">
							
						</div>	
					</div>
				
					
				</div>

