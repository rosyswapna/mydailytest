

<h1>Quizzes</h1>
<form name="frmsearch" id="frmsearch" method="GET" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="2" class="page_caption">
   Search
  
    </td>
</tr>
    <tr>
      <td>Quiz name</td>
      <td><input   name="txtquizname" value="<?php if(isset($_GET['txtquizname'])){
	  
	  echo $_GET['txtquizname'];
	  }
		  ?>"></td>
</tr>
 


</table>
<br />
 <input name="submit" value="submit" type="submit">
 </form>
<?php if($count_data > 0){ ?>
<table>

	<tr>	<th class="slno">Sl No</th>
			<th>Name</th>
			<th>Quiz Type</th>
			<th></th>
	</tr>
	<?php          
	$style = "row_lite"; $index=0; $slno=($Mypagination->page_num*$Mypagination->max_records)+1;
	while($count_data > $index){ 
		 if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }
		
	?>
			<tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
			<td class="slno"><?php echo $slno; ?></td>	
			<td><?php echo $data[$index]["name"]; ?></td>
			<td><?php echo $g_ARRAY_quiz_types[$data[$index]["quiz_type_id"]]["name"]; ?></td>
			<td><a href="quiz.php?id=<?php echo $data[$index]["id"]; ?>">Edit</a></td>
			
	</tr>
	
<?php 
	$slno++;
	$index++;
	} ?>

</table>
<?php  $Mypagination->pagination_style2();?>
<?php }else{?>

No Records Found.

<?php } ?>