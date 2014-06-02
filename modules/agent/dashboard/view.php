<?php $breadcrumb='<a href="/agent/index.php">Home</a> &raquo; <a href="/agent/dashboard.php">Dashboard</a>'; ?>

<div class="innercontainer-blk">
	<p class="heading">Dashboard</p>

	<div class="two-thirds column mright8 bottom-1">
		<p class="head">Transaction Details</p>			
		<div class="innercontainer-blk">
			
			<div class="tablestyle">
				<table>
					<thead>
						<tr>
							<th>Sl No.</th>
							<th>Bill No</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Vouchers</th>
						</tr>
					</thead>
					<tbody>
					<?php if($my_voucher_bills == false){?>
						<tr>
							<td colspan="6">No Records Found</td>
						</tr>
					<?php }else{ 
						$slno=1;
						foreach($my_voucher_bills as $voucher_bill)
						{
					?>
						<tr>
							<td><?php echo $slno; ?></td>
							<td><a href="voucher_bill.php?slno=<?php echo $voucher_bill['id']; ?>"><?php echo $voucher_bill['id']; ?></a></td>
							<td><?php echo $voucher_bill['date']; ?></td>
							<td><?php echo $voucher_bill['amount']; ?></td>
							<td><?php echo bill_status_description($voucher_bill['bill_status_id']); ?></td>
							<td><a href="vouchers.php?slno=<?php echo $voucher_bill['id']; ?>">View</a></td>
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


	<div class="four columns mright8 bottom-1">
		<p class="head">Vouchers</p>
		<div class="other-blk">
			<div class="dblk">
				<p class="head"><?php echo $myvoucher->total_vouchers;?></p>
				<p>Total</p>
			</div>
			<div class="dblk">
				<p class="head"><?php echo $myvoucher->total_vouchers_active;?></p>
				<p>Active</p>
			</div>
			<div class="dblk no-border">
				<p class="head"><?php echo $myvoucher->total_vouchers_used;?></p>
				<p>Used</p>
			</div>
		</div>
	</div>

</div>





