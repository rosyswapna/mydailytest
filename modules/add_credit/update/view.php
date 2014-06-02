
<form  target="_self" method="post" action="<?php echo $current_url?>" name="frm">

		<table>
		<tr>
			<td colspan="2" class="page_caption">Add Credit Plan</td>
		</tr>
		<tr>
				<td colspan="2" align="right"><a style="float:right; color:#000"; href="add_credits.php">List All</a> &nbsp;</td>
		</tr>
		<tr>
				<td colspan="2"></td></tr>		
		<tr>
		<td valign="top">Credit Name <span style="color:red;">*</span> &nbsp;</td>	
		<td><input name="txtcreditname" type="text" id="txtcreditname"  value="<?php echo $mycreditplan->name; ?>"/>
				<br /><div id='username_availability_result'></div>
										<label>&nbsp;</label>
								<input type="button" class="button" name="check_availability" id="check_availability" value="Check availability" />
		</td>
		</tr>
		<tr>
		<td valign="top">Credit Amount <span style="color:red;">*</span> &nbsp;</td>	
		<td><input name="txtcreditamount" type="text" id="txtcreditamount"  value="<?php echo $mycreditplan->amount; ?>"/>

		</td>
		</tr>
		<tr>
		<td valign="top">Credits <span style="color:red;">*</span> &nbsp;</td>	
		<td><input name="txtcredits" type="text" id="txtcredits"  value="<?php echo $mycreditplan->credit; ?>"/></td>
		</tr>
		<tr>
		<td valign="top">Credit Plan Status <span style="color:red;">*</span> &nbsp;</td>	
		<td><?php populate_array("lstcreditplanstatus", $credit_plan_statuses, $mycreditplan->credit_plan_status_id,false,false); ?></td>
		</tr>
        <tr>
		<td valign="top"><input type="checkbox" name="default_credit" id="default_credit" <?php if($mycreditplan->default_plan==true){ echo "checked"; } ?>  />&nbsp;</td>	
		<td>Default plan.</td>
		</tr>				
         <tr>
       <td></td><td><br /></td></tr>
        <tr>
       <td></td><td>
			<input name="submit" type="submit" value="submit" onclick="return validate();" />
			<input type="hidden" name="h_id" id="h_id" value="<?php echo $mycreditplan->id;?>" >
			</td>
         </tr>   
		</tr>
		<tr>
		
</table>

</form>
    <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("txtset").focus();
   //-->
    </script>