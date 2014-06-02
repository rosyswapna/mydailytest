

<h1><?php echo $CAP_organization_credits; ?></h1>
<?php if(trim($organization_name) != ""){?>
<div>
	
	<div>Credit Balance : <?php echo $myorganizationcredit->total_credit; ?>
		<?php if(isset($_SESSION[SESSION_TITLE.'organizationid']) ){ ?>
		<a href="get_credit.php"><input type="button" value="Get Credit"/></a>
		<?php }else if(isset($_SESSION[SESSION_TITLE.'admin_organizationid']) ){ ?>
		<a href="set_credit.php?id=<?php echo $myorganization->id; ?>"><input type="button" value="Add Credit"/></a>
		<?php }?>
	</div>
<div>
<?php }?>

<?php if($my_organization_credits == false){?>
<p>No Records found;</p>
<?php }else{
?>
		<form action="<?php echo $current_url; ?>" method="post"/>
		Organization :<?php populate_list_array("lstorganization", $my_organizations, "id", "name", $myorganization->id,$disable=false); ?>
		<input type="submit" name="submit" id="submit" value="Search"/>
		</form>

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
			<?php echo $my_organization_credits[$i]['credit_type'];
				if($my_organization_credits[$i]['credit_type_id'] == CREDIT_TYPE_PAYMENT){
					echo " (".$my_organization_credits[$i]['payment_type'].")";
				}
				else if($my_organization_credits[$i]['credit_type_id'] == CREDIT_TYPE_TEST) {
					//do nothing
				}
				else if($my_organization_credits[$i]['credit_type_id'] == CREDIT_TYPE_OFFER) {
					echo " (".$my_organization_credits[$i]['offer_note'].")";
				}
			?>
		</td>
		<td><?php echo ($my_organization_credits[$i]['credit_plan']!="")?$my_organization_credits[$i]['credit_plan']:"-"; ?></td>
		<td><?php echo abs($my_organization_credits[$i]['credit']);?></td>
		<td><?php echo $my_organization_credits[$i]['date'];?></td>	
	</tr>
	<?php
			$i++;
		}
	?>

</table>
<?php $Mypagination->pagination_style2(); ?>



<?php }?>
