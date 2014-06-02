<form name="frmsearch" id="frmsearch" method="GET" action="<?php echo $current_url;?>">

<div class="innercontainer-blk">
	<p class="heading">
		<span class="fleft">Quizzes</span>
		<span class="pagination fright">
			 <?php $Mypagination->pagination_style_number_with_button(); ?>
		</span>
	</p>

	<div class="sixteen columns mright8 bottom-1">
		<div class="tablestyle">
			<table>
				<thead>
				<tr>	
					<th>Slno</th>
					<th><?php echo $CAP_name?></th>
					<th><?php echo $CAP_quiztype?></th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<?php 
				if($count_data > 0){ 
					$index=0; $slno=($Mypagination->page_num*$Mypagination->max_records)+1;
					while($count_data > $index){
				?>
				<tr>
					<td class="slno"><?php echo $slno; ?></td>	
					<td><?php echo $data[$index]["name"]; ?></td>
					<td><?php echo $g_ARRAY_quiz_types[$data[$index]["quiz_type_id"]]["name"]; ?></td>
					<td><a href="quiz.php?id=<?php echo $data[$index]["id"]; ?>">Edit</a></td>
				</tr>

				<?php
						$index++;$slno++;
					 }
				 }else{?>
				 <tr><td colspan="4">No Records found</td></tr>
				 <?php }?>
				</tbody>
			</table>
		</div>
	</div>

</div>





