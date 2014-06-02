<?php if($data > 0){ ?>
<form name="frmsearch" id="frmsearch" method="GET" action="<?php echo $current_url;?>">
<table>
	   <tr><td colspan="2" class="page_caption">  Credit Plan  </td>  </tr>
	    <tr>
				<td colspan="6"></td>
		</tr>
	   <tr><td><a style="float:right; color:#000"  href="add_credit.php">Add Credits</a><br /> Search &nbsp;<input  name="txtcreditname" value="<?php if(isset($_GET['txtcreditname'])){
	  
	  echo $_GET['txtcreditname'];
	  }
		  ?>"> <input name="submit" type="submit" value="submit" /></td><tr>
		
</table>
</form>
<table>
		<tr>
			
				<th>Sl</th>
				<th>Name</th>
				<th>Update</th>
				<th>Delete</th>
		</tr>
		<?php		
						$style = "row_lite";
						$sl=1;
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
        		<td align="center"><?php echo $sl; ?></td>
				<td align="center"><?php echo $data[$index]["name"]; if($data[$index]["id"]==$dafault_credit_plan_id){ echo "  ( Default ) "; } ?></td>
				<td align="center"><a href="add_credit.php?id=<?php echo $data[$index]["id"]; ?>">edit</a></td>
				<td align="center"><a href="add_credit.php?delid=<?php echo $data[$index]["id"]; ?>">delete</a></td>
				
		</tr>
		<?php
						$index++;
						$sl++;
						}
		?>
	
</table>
<?php  $Mypagination->pagination_style2();

}else{?>

No Records Found.

<?php } ?>
