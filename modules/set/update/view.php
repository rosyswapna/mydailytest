
<form  target="_self" method="post" action="<?php echo $current_url?>" name="frm">

		<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2" class="page_caption">SET</td>
		</tr>
		<tr>
				<td colspan="2" align="right"><a href="sets.php">List All</a> &nbsp;</td>
		</tr>
		<tr>
				<td colspan="2"></td></tr>		
		
		
		<tr>
		<td valign="top">Set <span style="color:red;">*</span> &nbsp;</td>	
		<td><input name="txtset" type="text" id="txtset"  value="<?php echo $myset->name; ?>"/></td>
        <td>	</td>	
        <tr>
       <td colspan="2" align="center">
			<input name="submit" type="submit" value="submit" onclick="return validate();" />
			<input type="hidden" name="h_id" id="h_id" value="<?php echo $myset->id;?>" >
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