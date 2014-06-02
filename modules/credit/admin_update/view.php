<?php

// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
} 
?>


<div id="credit">
	<div id="credit_info">

		<h3>Payment/Credit Details</h3>
		<p>User : <?php echo $myuser->first_name." ".$myuser->last_name; ?>
</p>
		<p>Credit Balance : <?php echo ($myusercredit->total_records > 0)?$myusercredit->total_credit:0; ?></p>
		<table border="0" cellpadding="2" cellspacing="2">
			<tr>
				<td><label>#<label></td>
				<td><label>Credit Type<label></td>
				<td><label>Credit Plan<label></td>
				<td><label>Credit<label></td>
				<td><label>Transaction Id<label></td>
				<td><label>Transaction Date<label></td>
				<td></td>
			</tr>
			<?php if($my_user_credits == false){?>
			<tr>
				<td colspan="6">
					&nbsp; Your mydailytest credit is zero
				</td>
			</tr>
			<?php }
			else{
				$i = 0;
				while($count_data > $i)
				{
			?>
			<tr>
				<td class="blackfont_small"><?php echo $i+1; ?></td>
				<td class="blackfont_small">
				<?php 
				if ($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_PAYMENT){ ?>
					<a href="payment_invoice.php?slno=<?php echo $my_user_credits[$i]['payment_id'];?>">
						<?php echo $my_user_credits[$i]['credit_type'];?>
					</a>
				<?php echo " (".$my_user_credits[$i]['payment_type'].")";
				} 
				else if($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_TEST) {
					$quiz_name = get_quiz_name(1);
					if($quiz_name == false){
					}
					else{
						echo $my_user_credits[$i]['credit_type']." (".$quiz_name.")";
					}
				}
				else if($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_OFFER && $my_user_credits[$i]['offer_note']!="") {
					echo $my_user_credits[$i]['credit_type']."<br/>(".$my_user_credits[$i]['offer_note'].")";
				}
				else {
					echo $my_user_credits[$i]['credit_type'];
				}
				?>
				</td>
				<td class="blackfont_small"><?php echo $my_user_credits[$i]['credit_plan'];?></td>
				<td class="blackfont_small"><?php echo abs($my_user_credits[$i]['credit']);?></td>
				<td class="blackfont_small">
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
				<td class="blackfont_small"><?php echo $my_user_credits[$i]['date'];?></td>
				<td class="blackfont_small">
					<?php if($my_user_credits[$i]['online'] == PAYMENT_OFFLINE){ ?>
						<a href="set_credit.php?id=<?php echo $myuser->id; ?>&slno=<?php echo $my_user_credits[$i]['id'];?>" >Edit</a></div> 	
					<?php }?>
				</td>
			</tr>
			<?php
				$i++;
				}
			 }
			?>

		</table>
		<?php if($myusercredit->total_records > LIMIT_CREDITS){ ?>
		<div id="more"><a href="user_credits.php?id=<?php echo $myusercredit->user_id;?>">More >></a></div>
		<?php }?>
	</div>
	<div id="credit_form">
		
		<form action="<?php echo $current_url; ?>" method="post" id="formpayment" name="formpayment">
		<input type="hidden" value="<?php echo $myuser->id; ?>" name="user_id"/>
		<input type="hidden" value="<?php echo $myusercredit->payment_id; ?>" name="txtpaymentid"/>
		<input type="hidden" value="<?php echo $myusercredit->id; ?>" name="txtusercreditid"/>
		<input type="hidden" value="<?php echo $myusercredit->total_credit; ?>" name="txttotalcredit"/>
		
			<table  cellpadding="2" border="0" bgcolor="#ccc">
				<tr>
					<td colspan="3" class="form_head" align="left">
					<?php
					if(isset($_GET['slno'])){
						echo $CAP_credit_edit;
					}
					else{
						echo $CAP_credit_set;
					}
					?>	
					</td>
				</tr>
				<tr>
					<td><label>Credit Plans</label><span>*</span></td>
					<td><label>:</label></td>
					<td>
					<?php populate_list_array("lstcreditplans", $my_credit_plans, "id", "name", $myusercredit->credit_plan_id,$disable=false); ?><br/>
					<span id="plan_details">
						<?php if(isset($_GET['slno'])){
							echo "Rs/-".$mypayment->amount;
						}
						?>
					</span>
					</td>
				</tr>
				<tr>
					<td><label>Payment Through</label><span>*</span></td>
					<td><label>:</label></td>
					<td><?php populate_list_array("lstpaymenttypes", $my_payment_types, "id", "name",$mypayment->payment_type_id,$disable=false); ?></td>
				</tr>


				<tr id="hide_row1">
					<td><label>Check Number</label><span>*</span></td>
					<td><label>:</label></td>
					<td><input type="text" value="<?php echo $mypayment->cheque_number?>" name="txtchequenumber" id="txtchequenumber"/></td>
				</tr>
				<tr id="hide_row2">
					<td><label>Bank</label><span>*</span></td>
					<td><label>:</label></td>
					<td><input type="text" value="<?php echo $mypayment->bank?>" name="txtbank" id="txtbank"/></td>
				</tr>
				

				<tr>
					<td colspan="3" align="center">
						<?php if(isset($_GET['slno'])){ ?>
						<input type="submit" value ="Update" name="payment" id="payment"/>
						<?php }else{?>
						<input type="submit" value ="Pay" name="payment" id="payment"/>
						<?php }?>
					</td>
				</tr>
			</table><br/>

			<?php if(!isset($_GET['slno'])){?>
			<table  cellpadding="2" border="0"  bgcolor="#ccc">
				<tr>
					<td colspan="3" class="form_head">Offer</td>
				</tr>

				<tr>
					<td><label>Credit</label><span>*</span></td>
					<td><label>:</label></td>
					<td>
						
						<input type="text" value="<?php echo $myusercredit->credit; ?>" name="txtcredit" id="txtcredit" />
						
					</td>
				</tr>

				<tr>
					<td><label>Offer Note </label></td>
					<td><label>:</label></td>
					<td>
						
						<textarea name="txtoffernote" id="txtoffernote"><?php echo $myusercredit->offer_note; ?></textarea>
						
					</td>
				</tr>

				<tr>
					<td colspan="3" align="center">
						<input type="submit" value ="Add" name="addcredit" id="addcredit"/>
					</td>
				</tr>
			</table>

			<?php }?>
		</form>
	</div>
</div>