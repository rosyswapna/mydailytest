<?php if($data_bylimit > 0){ ?>
<h2>User Report Details</h2>
<table>
		
		<tr>	<th class="slno">Sl No</th>
				<th align="center">Name</th>
				<th>Start Date</th>
				<th>Quiz Type </th>
				<th>Quiz Name </th>
				
				
		</tr>
		<?php
	$style = "row_lite";
	$sl=($Mypagination->page_num*$Mypagination->max_records)+1;
	$index=0;
	while($counts > $index){
		if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }
?>
		<tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >	
				<td><?php echo $sl; ?></td>	
				<td><?php echo $data_bylimit[$index]["username"]; ?></td>	
				<td><?php echo $data_bylimit[$index]["start_time_formated"]; ?></td>
				<td><?php echo $data_bylimit[$index]["quiz_type_name"]."<br>";?></td>
				<td><?php echo $data_bylimit[$index]["quiz_name"]."<br>";?></td>
		</tr>
<?php 
	$sl++;
	$index++;
	}?>
</table>
<div align="center">
<?php  $Mypagination->pagination_style2();?>
</div>
<?php }else{?>

No Records Found.

<?php } ?>
<div id="credit_holder">
Credit Balance : <?php if(isset($_SESSION[SESSION_TITLE.'user_credit'])) echo $_SESSION[SESSION_TITLE.'user_credit']; ?>
</div>