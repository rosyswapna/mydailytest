<?php $breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/agent/dashboard.php">Dashboard</a>&raquo; <a href="/agent/vouchers.php">Vouchers</a>'; ?>

<div class="innercontainer-blk">
	<p class="heading">
		<span class="fleft">Vouchers</span>
		<span class="pagination fright">
			<?php  $Mypagination->pagination_style_number_with_button();?>		
		</span>
	</p>
	<div class="sixteen columns mright8 bottom-1">
		<div class="tablestyle">
			<table>
				<thead>
				<tr>
					<th>Sl No.</th>
					<th>Voucher</th>
					<th>Amount</th>
					<th>Credit</th>
					<th>Valid From</th>
					<th>Valid To</th>
					<th>Status</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<?php if($my_vouchers == false){?>
					<tr>
						<td>No Records Found</td>
					</tr>
				<?php }else{
					$slno=($Mypagination->page_num*$Mypagination->max_records)+1;
					foreach($my_vouchers as $voucher)
					{
				?>
					<tr>
						<td><?php echo $slno; ?></td>
						<td><?php echo $voucher['voucher']; ?></td>
						<td><?php echo $voucher['amount']; ?></td>
						<td><?php echo $voucher['credit']; ?></td>
						<td><?php echo (strtotime($voucher['valid_from'])!="")?$voucher['valid_from']:"-"; ?></td>
						<td><?php echo (strtotime($voucher['valid_to'])!="")?$voucher['valid_to']:"-"; ?></td>
						<td>
						<?php 
							if($voucher['status_id'] == STATUS_ACTIVE){
								echo "Active";
							}else{
								echo "Inactive";
							}
						?>
						</td>
						<td>
						<?php
							if($voucher['used'] == VOUCHER_USED){
								echo "Used";
							}else{
								echo "Not Used";
							}
						?>
						</td>
					</tr>
				<?php
						$slno++;
					}
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>