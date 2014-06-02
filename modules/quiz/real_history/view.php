<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/user_test_history.php">User Test History</a>'; ?>
<div class="innercontainer-blk">
					<p class="heading">
						<span class="fleft">User Test History</span>
						<span class="pagination fright">
<?php  $Mypagination->pagination_style_number_with_button();?>		
						</span>
					</p>
					<div class="sixteen columns mright8 bottom-1">
						<div class="tablestyle">
<?php if($data_bylimit > 0){ ?>						
							<table>
								<thead>
								<tr>
									<th>Sl No.</th>
									<th>Name</th>
									<th>Start Date</th>
									<th>Quiz type</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
		<?php
	$sl=($Mypagination->page_num*$Mypagination->max_records)+1;
	$index=0;
	while($counts > $index){
		
?>
		<tr>	
				<td><?php echo $sl; ?></td>	
				<td><?php echo $data_bylimit[$index]["quiz_name"]; ?></td>	
				<td><?php echo $data_bylimit[$index]["start_time_formated"]; ?></td>
				<td><?php echo $data_bylimit[$index]["quiz_type_name"]."<br>";?></td>
				<td><?php if ( $data_bylimit[$index]["test_status_id"] == TEST_STATUS_PAUSED ){?>
		 <u> <a href="resume.php?id=<?php echo $data_bylimit[$index]["id"]; ?>"> Resume </a></u>
	   <?php }
		elseif ( $data_bylimit[$index]["test_status_id"] ==  TEST_STATUS_STARTED ) { ?>
		 <u> <a href="resume.php?id=<?php echo $data_bylimit[$index]["id"]; ?>"> Continue </a></u>
	   <?php }
		elseif ( $data_bylimit[$index]["test_status_id"] ==  TEST_STATUS_FINISHED ) { ?>
		<u>  <a href="result.php?id=<?php echo $data_bylimit[$index]["id"]; ?>"> View Result </a></u>
	   <?php }
	  ?>
	</td>
		</tr>
<?php 
	$sl++;
	$index++;
	}?>
</table>

<?php }else{?>
<div style="margin-bottom:80px; padding-bottom:5px; margin-top:50px;" align="center";>
No Records Found.
</div>
<?php } ?>
					   </div>	
					</div>
					
					<div class="sixteen columns bottom-1">
						<span class="pagination fright">

<?php  $Mypagination->pagination_style_number_with_button();?>							
							
						</span>
					</div>
				</div>