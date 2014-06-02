<?php if($data > 0){ ?>
<form name="frmsearch" id="frmsearch" method="GET" action="<?php echo $current_url;?>">
<table>
	   <tr><td colspan="2" class="page_caption">  Difficulty Level  </td>  </tr>
	    <tr>
				<td colspan="6"></td>
		</tr>
	   <tr><td>
	  <a style="float:right; color:#000"   href="difficulty_level.php">Add Level</a> <br /> Search
	   <input  name="txtdifflevel"  value="<?php if(isset($_GET['txtdifflevel'])){
	  echo $_GET['txtdifflevel'];
	  }
		  ?>"   ><input name="submit" type="submit" value="submit" /></td><tr>
</table>
</form>


<table  border="0" cellpadding="1px" cellspacing="1px">
    	 <tr>
			
				<th width="81" align="center">Sl</th>
				<th width="81" align="center">Name</th>
				<th width="81" align="center">Edit</th>
				<th width="81" align="center">Delete</th>
		</tr>
		<?php			$style = "row_lite";
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
				<td align="center"><?php echo $data[$index]["name"]; ?></td>
				<td align="center"><a href="difficulty_level.php?id=<?php echo $data[$index]["id"]; ?>">edit</a></td>
				<td align="center"><a href="difficulty_level.php?delid=<?php echo $data[$index]["id"]; ?>">delete</a></td>
				
		</tr>
		<?php
						$index++;
						$sl++;
						}
		?>
	
</table>
<?php
$Mypagination->pagination_style2();
}else{?>

No Records Found.

<?php } ?>
