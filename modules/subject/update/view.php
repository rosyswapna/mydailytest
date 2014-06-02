
<form  target="_self" method="post" action="<?php echo $current_url?>" name="frm">

		<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2" class="page_caption">Subject</td>
		</tr>
		<tr>
				<td colspan="2" align="right"><a href="subjects.php">List All</a> &nbsp;</td>
		</tr>
		
		<tr>
				<td colspan="2"></td></tr>		
		
		
		<tr>
		<td valign="top">Subject <span style="color:red;">*</span> &nbsp;</td>	
		<td><input name="txtsubject" type="text" id="txtsubject"  value="<?php echo $mysubject->name; ?>"/></td>
        <td>	</td>	
        <tr>
        <td colspan="2" align="center">
			<input name="submit" type="submit" value="submit" onclick="return validate();"/>
			<input type="hidden" name="h_id" id="h_id" value="<?php echo $mysubject->id;?>" >
			</td>
         </tr>   
		</tr>
		<tr>
		
</table>

</form>
    <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("txtsubject").focus();
   //-->
    </script>