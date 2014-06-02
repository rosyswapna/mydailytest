<?php $breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/users.php">Users</a>&raquo; <a href="/organization/get_credit_from_org.php?slno='.$myusercredit ->user_id.'">Payment/Credit Details</a>'; ?>

<div class="two-thirds column mright8 bottom-1">			
	<div class="innercontainer-blk">
		<p class="heading">Payment/Credit Details</p>
		<div class="tablestyle">
		<?php
		if($my_user_credits == false){ ?>
			 <div style="margin-bottom:80px; padding-bottom:5px; margin-top:50px;" align="center";>
			 <?php echo "User does not have any credits in his account."; ?></div><?php
		}
		else{
		?>
			<table>
				<thead>
					<tr>
						<th>Sl No.</th>
						<th>Credit type</th>
						<th>Credit</th>
						<th>Transaction ID</th>
						<th>Transaction Date</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				while($count_data > $i)
				{
				?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<td>
							<?php if ($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_PAYMENT){ ?>
								<a href="payment_invoice.php?slno=<?php echo $my_user_credits[$i]['payment_id'];?>">
									<?php echo $my_user_credits[$i]['credit_type'];?>
								</a>
							<?php } 
							else if($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_TEST) {
								$quiz_name = get_quiz_name(1);
								if($quiz_name == false){
									echo $my_user_credits[$i]['credit_type'];
								}
								else{
									echo $my_user_credits[$i]['credit_type']." (".$quiz_name.")";
								}
							}
							else if($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_OFFER && $my_user_credits[$i]['offer_note']!="") {
								echo $my_user_credits[$i]['credit_type']."<br/>(".$my_user_credits[$i]['offer_note'].")";
							}
							else{		
							 	echo $my_user_credits[$i]['credit_type'];
							}
						?>
						</td>
						<td><?php echo abs($my_user_credits[$i]['credit']);?></td>
						<td>
							<?php
								if($my_user_credits[$i]['online'] == PAYMENT_ONLINE)
								{
									if($my_user_credits[$i]['payment_type_id'] == PAYMENT_TYPE_IIPAY)
										echo $my_user_credits[$i]['iipay_transaction_number'];
									if($my_user_credits[$i]['payment_type_id'] == PAYMENT_TYPE_CCAVENUE)
										echo $my_user_credits[$i]['cc_avanue_transaction_number'];
								}
								else{
									echo "-";
								}
							?>
						</td>
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
					   <span class="pagination fright  bottom-1">
						<?php  $Mypagination->pagination_style_number_with_button();?>	
						</span>		
	</div>
</div>

<div class="one-third column mright8 bottom-1">
	<div class="credit-balance">
		<p class="head">User Credit Balance:</p>
		<div class="dblk">
			<p class="fleft"><?php echo ($myusercredit->total_records > 0)?$myusercredit->total_credit:0; ?></p>
			<p class="fright">
				<a href="user_credits_org.php?slno=<?php echo $myusercredit->user_id;?>"><input type="submit" class="button" value="Credit History"></a>	
			</p>
		</div>
	</div>
	<div class="history-blk">
	<form action="<?php echo $current_url; ?>" method="post" id="formpayment" name="formpayment">
		<p class="head bottom-1">Add Credit</p>
		<p class="description bottom-1">
			Available Credit : <?php echo ($myorganizationcredit->total_records > 0)?$myorganizationcredit->total_credit:0; ?>	
		</p>

		<p class="description bottom-1">
			Enter Credit <span style="color:red;">*</span><br/>
			<input type="text" name="txtcredit" id="txtcredit" value=""/> 	
		</p>
		<p class="description bottom-1">
			<input type="hidden" name="hd_userid" value="<?php echo $myusercredit ->user_id; ?>" />
			<input type="submit" class="button" value ="Add" name="submit" id="submit"/>
		</p>
	</form>
	</div>
</div>
