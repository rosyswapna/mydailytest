

<h1>
	<?php 
	if(isset($_SESSION[SESSION_TITLE.'userid']) ){ 
		echo $CAP_user_credits;
	}else{
		echo $CAP_admin_user_credits;
	}
	?>
</h1>
<?php if(trim($user_name) != ""){?>
<div>
	<div>User : <?php echo $user_name;?></div>
	<div>Credit Balance : <?php echo $myusercredit->total_credit; ?>
		<?php if(isset($_SESSION[SESSION_TITLE.'userid']) ){ ?>
		<a href="get_credit.php"><input type="button" value="Get Credit"/></a>
		<?php }else if(isset($_SESSION[SESSION_TITLE.'admin_userid']) ){ ?>
		<a href="set_credit.php?id=<?php echo $myuser->id; ?>"><input type="button" value="Add Credit"/></a>
		<?php }?>
	</div>
<div>
<?php }?>

<?php if($my_user_credits == false){?>
<p>No Records found;</p>
<?php }else{

	if(isset($_SESSION[SESSION_TITLE.'admin_userid']))
	{
?>
		<form action="<?php echo $current_url; ?>" method="post"/>
		Users :<?php populate_list_array("lstuser", $my_users, "id", "username", $myuser->id,$disable=false); ?>
		<input type="submit" name="submit" id="submit" value="Search"/>
		</form>
<?php
	}
?>




<table width="0" border="1" align="center" cellpadding="0" cellspacing="0">
	<tr>	
		<th class="slno">Sl No</th>
		<th>Credit Type</th>
		<th>Credit Plan</th>
		<th>Credit</th>
		<th>Transaction Date</th>	
	</tr>
    <?php
   		$i = 0;
    	while($count_data > $i)
    	{
    		$slno = ($Mypagination->page_num*$record_per_page)+($i+1);
    ?>    
	
	<tr>	
		<td class="slno"><?php echo $slno; ?></td>	
		<td>
			<?php echo $my_user_credits[$i]['credit_type'];
				if($my_user_credits[$i]['credit_type_id'] == CREDIT_TYPE_PAYMENT){
					echo " (".$my_user_credits[$i]['payment_type'].")";
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

</table>
<?php $Mypagination->pagination_style2(); ?>



<?php }?>
