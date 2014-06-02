

<h1>Passages</h1>
<form name="frmsearch" id="frmsearch" method="GET" action="<?php echo $current_url;?>">
<table align="center" cellpadding="2">
<tr>
    <td colspan="2" class="page_caption">
   Search
  
    </td>
</tr>

   <tr>
      <td>Passage Id</td>
      <td><input  style= maxlength="100" size="35" name="txtpassage_id" id="txtpassage_id" value="<?php if(isset($_GET['txtpassage_id'])){ echo $_GET['txtpassage_id']; } ?>"></td>
</tr>
    <tr>
      <td>Passage</td>
      <td><input  style="width: 210px; height:22;"  maxlength="100" size="35" name="txtpassage" value="<?php if(isset($_GET['txtpassage'])){
	  
	  echo $_GET['txtpassage'];
	  }
		  ?>"></td>
</tr>
	  <td>Exam</td>
      <td><?php populate_array("lstexam", $exams, $mygroups->exam_id,$disable=false); ?></td>
    </tr> 
<tr>
	<td>Subject</td>
      <td><?php populate_array("lstsubject", $subjects, $mygroups->subject_id,$disable=false); ?></td>
</tr>	
<tr>
	<td>Section</td>
      <td><?php populate_array("lstsection", $sections, $mygroups->section_id,$disable=false); ?></td>
</tr>	

<tr>	
	<td>Difficulty Level</td>
      <td><?php populate_array("lstdifficultylevel", $difficulty_levels, $mygroups->difficulty_level_id,$disable=false); ?></td>
</tr>
<tr>
	<td>Question Status</td>
      <td><?php populate_array("lstquestionstatuses", $mygroups_status_ids, $mygroups->question_group_status_id,$disable=false); ?></td>
</tr>
</table>
<br />
 <input name="submit" value="submit" type="submit">
 </form>
<br />

<?php if($data_bylimit > 0){ ?> 
 <table>

	<tr>	<th class="slno">Sl No</th>
			<th>Passage</th>
			<th>Passage Id</th>
			<th>Exam</th>
			<th>Subject</th>
			<th>Section</th>
			<th>Difficulty Level</th>
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
			<td><?php echo $data_bylimit[$index]["passage"]; ?></td>
			<td><?php echo  $data_bylimit[$index]["id"]; ?></td>	
			<td><?php if($data_bylimit[$index]["exam_id"]>0) echo $exams[$data_bylimit[$index]["exam_id"]];  ?></td>
			<td> <?php  if($data_bylimit[$index]["subject_id"]>0)echo $subjects[$data_bylimit[$index]["subject_id"]]; ?></td>
			<td> <?php if($data_bylimit[$index]["section_id"]>0)  echo $sections[$data_bylimit[$index]["section_id"]]; ?></td>
			<td><?php if($data_bylimit[$index]["difficulty_level_id"]>0) echo $difficulty_levels[$data_bylimit[$index]["difficulty_level_id"]]; ?></td>
			<td><?php if($data_bylimit[$index]["question_group_status_id"]==1){?><a href="group.php?delid=<?php echo $data_bylimit[$index]["id"]; ?>" >Active</a>
			<?php } else echo "Inactive";?> 
			 </td>
			<td><a href="group.php?id=<?php echo $data_bylimit[$index]["id"]; ?>">Edit</a></td>
           
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
