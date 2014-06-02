<?php 
 $breadcrumb = '<a href="/index.php">Home</a> &raquo; <a href="/get_credit.php">Payment/Credit Details</a>';
 ?> 

<div class="two-thirds column mright8 bottom-1">			
	<div class="innercontainer-blk">
		<p class="heading">Payment/Credit Details</p>
		<div class="tablestyle">
		<?php
		if($my_user_credits == false){ ?>
			 <div style="margin-bottom:80px; padding-bottom:5px; margin-top:50px;" align="center";>
			 <?php echo "You dont have any credits in your account. Please recharge your account to take the tests."; ?></div><?php
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

<form action="<?php echo $current_url; ?>" method="post" id="formpayment" name="formpayment">
<div class="one-third column mright8 bottom-1">

	<div class="credit-balance">
		<p class="head">Credit Balance:</p>
		<div class="dblk">
			<p class="fleft"><?php echo ($myusercredit->total_records > 0)?$myusercredit->total_credit:0; ?></p>
			<p class="fright">
				<a href="/user_credits.php"><input type="button" class="button" value="Credit History"></a>
			</p>
		</div>
	</div>

	<div class="history-blk">
		<p class="head bottom-1">Get Credit</p>
		<span id="plan_details"></span>
		<p class="description bottom-1">
			Credit Plans <small>*</small> <br/>
			<?php populate_list_array("lstcreditplans", $my_credit_plans, "id", "name", "",$disable=false,$default_message = true); ?>	
		</p>

		<p class="description bottom-1">
			Payment Through <small>*</small> <br/>
			<?php populate_list_array("lstpaymenttypes", $my_payment_types, "id", "name", "",$disable=false,$default_message = true); ?> 	
		</p>
		<p class="fright">
			<input type="submit" class="button" value ="PAY" name="payment" id="payment"/>
		</p>
	</div>

	<div class="history-blk">
		<p class="description bottom-1">
			Voucher Number <small>*</small> <input type="text" name="txtvoucher" id="txtvoucher" />
			<p class="fright">
				<input type="submit" class="button" value ="Recharge" name="recharge" id="recharge"/>
			</p>
		</p>
	</div>

</div>
</form>
