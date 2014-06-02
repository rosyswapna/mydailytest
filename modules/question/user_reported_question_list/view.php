

<h1>Reported Questions</h1>
<form name="frmsearch" id="frmsearch" method="GET" action="<?php echo $current_url;?>">
<table align="center" cellpadding="2">
<tr>
    <td colspan="2" class="page_caption">
   Search
  
    </td>
</tr>

   <tr>
      <td>Reported Question Id</td>
      <td><input  style= maxlength="100" size="35" name="txtreportedquestion_id" id="txtreportedquestion_id" value="<?php if(isset($_GET['txtreportedquestion_id'])){
	  
	  echo $_GET['txtreportedquestion_id'];
	  }
		  ?>"></td>
</tr>
   

<tr>	
<td>Reported Question Status</td>
      <td><?php populate_array("lstreportedquestionstatuses", $myreported_question_status_ids, $myreportedquestion->status_id,$disable=false); ?></td>
</tr>

</table>
<br />
 <input name="submit" value="submit" type="submit">
 </form>
<br />

<?php if($data_bylimit > 0){ ?> 
 <table>

	<tr>	<th class="slno">Sl No</th>
			<th>Reported Question id</th>
			<th>Question Id</th>
            <th>User Id</th>
			<th>Description</th>
			<th>Status</th>
			<th>Action</th>
			
          
	</tr>
	<?php         
	 
     $style = "row_lite";
	$status=0;$index=0; $sl=($Mypagination->page_num*$Mypagination->max_records)+1;
	while($count_data_bylimit > $index){ 
	 if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }
	?> <tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
		<td class="slno"><?php echo $sl; ?></td>	
			<td><?php echo $data_bylimit[$index]["id"]; ?></td>
			<td><?php echo  $data_bylimit[$index]["question_id"]; ?></td>	
			<td><?php echo $data_bylimit[$index]["user_id"]; ?></td>
			<td><?php echo $data_bylimit[$index]["description"];  ?></td>
			<!--<td> <?php// if($data_bylimit[$index]["status_id"]>0)  echo $reported_question_statuses[$data_bylimit[$index]["status_id"]]; ?></td>-->
			
			<td><?php if($data_bylimit[$index]["status_id"]==STATUS_ACTIVE){?><a href="reported_question.php?delid=<?php echo $data_bylimit[$index]["id"]; ?>" >Active</a>
			<?php } else echo "Inactive";?> 
			 </td>
			 
			<td><a href="question.php?id=<?php echo $data_bylimit[$index]["question_id"]; ?>">Edit</a></td>
           
	</tr>
<?php 
	$sl++;
	$index++;
	} ?>

</table>
<br />
<div align="center">
<?php  $Mypagination->pagination_style1();?><br />
<?php  $Mypagination->pagination_style2();?>
</div>
<?php }else{?>

No Records Found.

<?php } ?>
<br /><br />