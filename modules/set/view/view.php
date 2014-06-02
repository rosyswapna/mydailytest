<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmchange_passwd">
<table>
	   <tr><td colspan="2" class="page_caption">  SET  </td>  </tr>
	   <tr><td><input  name="txtset" > <input name="submit" type="submit" value="submit" /></td><tr>
		
</table>
</form>
<table width="0" border="1" cellspacing="0" cellpadding="0" align="center">
		<tr>
			
				<td width="81" align="center">Sl</td>
				<td width="81" align="center">Name</td>
				<td width="81" align="center">Update</td>
				<td width="81" align="center">Delete</td>
		</tr>
		<?php			$sl=1;
						$index=0;
						while($counts > $index){ ?>
		<tr>
        		<td align="center"><?php echo $sl; ?></td>
				<td align="center"><?php echo $data[$index]["name"]; ?></td>
				<td align="center"><a href="set.php?id=<?php echo $data[$index]["id"]; ?>">edit</a></td>
				<td align="center"><a href="sets.php?delid=<?php echo $data[$index]["id"]; ?>">delete</a></td>
				
		</tr>
		<?php
						$index++;
						$sl++;
						}
		?>
	
</table>

