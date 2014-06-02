<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/user_credits.php">Credit History</a>'; ?>

<div class="innercontainer-blk">


	<div class="credit-balance">
		<p class="head">Credit Balance:</p>
		<div class="dblk">
			<p class="fleft"><?php echo ($myusercredit->total_records > 0)?$myusercredit->total_credit:0; ?></p>
			<p class="fright">
				<a href="get_credit.php"><input type="button" value="Get Credit" class="button" /></a>
			</p>
		</div>
	</div>

	<p class="heading">
		<span class="fleft">Credit History</span>
		<span class="pagination fright">
			<?php  $Mypagination->pagination_style_number_with_button();?>		
		</span>
	</p>
	<div class="sixteen columns mright8 bottom-1">
	
		<div class="tablestyle">
		<?php if($my_user_credits == false){?>
		<div style="margin-bottom:80px; padding-bottom:5px; margin-top:50px;" align="center";>
			No Records found;
		</div>	
		<?php }else{?>
			<table>
				<thead>
				<tr>
					<th>Sl No.</th>
					<th>Credit Type</th>
					<th>Credit Plan</th>
					<th>Credit</th>
					<th>Transaction Date</th>
				</tr>
				</thead>
				<tbody>
				<?php
			   		$i = 0;
			    	while($count_data > $i)
			    	{
			    		$slno = ($Mypagination->page_num*$record_per_page)+($i+1);
			    ?>   
				<tr>
					<td><?php echo $slno; ?></td>
					<td>
						<?php echo $my_user_credits[$i]['credit_type'];
						if($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_PAYMENT){
							echo " (".$my_user_credits[$i]['payment_type'].")";
							if($my_user_credits[$i]['payment_type'] == PAYMENT_TYPE_IIPAY){
								echo "<br/>Request Id:".substr(md5($my_user_credits[$i]['payment_id']),0,7).$my_user_credits[$i]['payment_id'];
							}
						}
						else if($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_TEST) {
							$quiz_name = get_quiz_name(1);
							if($quiz_name == false){
							}
							else{
								echo " (".$quiz_name.")";
							}
						}
						else if($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_OFFER) {
							echo " (".$my_user_credits[$i]['offer_note'].")";
						}
					?>
					</td>
					<td><?php echo ($my_user_credits[$i]['credit_plan']!="")?$my_user_credits[$i]['credit_plan']:"-"; ?></td>
					<td><?php echo abs($my_user_credits[$i]['credit']);?></td>
					<td><?php echo $my_user_credits[$i]['date'];?></td>	
				</tr>
					<?php
						$i++;
					}
				?>
				</tbody>
			</table>
		<?php }?>
		</div>	
	</div>
					
	<div class="sixteen columns bottom-1">
		<span class="pagination fright">
			<?php  $Mypagination->pagination_style_number_with_button();?>							
		</span>
	</div>
</div>