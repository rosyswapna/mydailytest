
<form  target="_self" method="post" action="<?php echo $current_url?>" name="frm">

		<table>
		<tr>
			<td colspan="2" class="page_caption">Exam</td>
		</tr>
		<tr>
				<td colspan="2" align="right"><a style="float:right; color:#000"; href="exams.php">List All</a> &nbsp;</td>
		</tr>
		<tr>
				<td colspan="2"></td></tr>		
		<tr>
		<td valign="top">Exam <span style="color:red;">*</span> &nbsp;</td>	
		<td><input name="txtexam" type="text" id="txtset"  value="<?php echo $myexam->name; ?>"/></td>
        <td>	</td>	
        <tr>
       <td colspan="2" align="center">
			<input name="submit" type="submit" value="submit" onclick="return validate();" />
			<input type="hidden" name="h_id" id="h_id" value="<?php echo $myexam->id;?>" >
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