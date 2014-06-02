<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>

<h1>Imported groups</h1>
<form name="frmsearch" id="frmsearch" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="5" class="page_caption">
   Search
    </td>
</tr>
    <tr>
      <td>Passage</td>
      <td><input  style="width: 210px; height:22;"  maxlength="100" size="35" name="txtpassage"  ><input type="hidden" name="txtimport_id" value="<?php if(isset($_POST['txtimport_id'])){echo $_POST['txtimport_id'];}else{ echo $mytempgroups->question_group_import_id;} ?>"></td><td>Created :<?php echo $mygroupimports->created; ?></td>
</tr>
<tr>
	
	<td>Subject</td>
      <td><?php populate_array("lstsubject", $subjects,$mytempgroups->subject_id,$disable=false); ?></td><td>Csv File :<?php echo $mygroupimports->csv_file?></td>
</tr>
<tr>
<td>Exam</td>
      <td><?php populate_array("lstexam", $exams,$mytempgroups->exam_id,$disable=false); ?></td><td>Date :<?php echo $mygroupimports->date?></td>
    </tr> 
<tr><td></td><td></td>
<td>Total Passages :<?php echo $mygroupimports->total_passages?>&nbsp;&nbsp;Verified Passages :<?php echo $mygroupimports->total_verified_passage?></td>

</table>
<br />
 <input name="submit" value="submit" type="submit">
 </form>


<?php //new-------------->?>

<form  target="_self" method="post" action="<?php echo $current_url;?>" name="frm_examination" id="frm_examination">
        <table id="tab" width="600" border="0" cellpadding="0" cellspacing="2"  >
        <tr>
            <td colspan="5" class="page_caption" >Temp Groups  <span style="float:right;"><input name="checkall" id="checkall" type="checkbox">Verify All</span></td> 
        </tr>

	<tr>
	<td>	
	<?php if($data_bylimit > 0){ 
				$index = 0;
				$current_passage_no = 0;
				while($count_data_bylimit > $index)
				{
					//$current_passage_no++;
			
		$highlight_div_style=' style="margin-top:5px;"';
		 if($data_bylimit[$index]["passage"]!="" && $data_bylimit[$index]["subject_id"]!=gINVALID && $data_bylimit[$index]["exam_id"]!=gINVALID) {}else{
		$highlight_div_style=' style="border:2px solid red; diplay:inline-block;"';
}
		?>
	<div <?php echo $highlight_div_style; ?> id="passage_div_<?php echo $data_bylimit[$index]['id'];?>">
	<table>
        <tr>
          <td height="30" valign="middle" align="center">
           <?php  echo $data_bylimit[$index]['slno'];  //echo $current_passage_no;?>: 
            </td>
            <td valign="middle" style="text-align:left;line-height:20px;"><?php echo $data_bylimit[$index]['passage']; ?>
			 
            
        </tr>
        <tr>
          
        <?php if($data_bylimit[$index]['image']!=''){ ?><td height="30" valign="middle" align="center">
             </td>
            <td style="float:left;line-height:20px;"><img class="img" src="/images/temp_passages/<?php echo $mygroupimports->id.'/'.$data_bylimit[$index]['image']; ?>" alt="File not found" height="50" width="100" border="3" ></td>
         <?php } else { ?><td height="30" valign="middle" align="center">
             </td>
            <td style="float:left;line-height:20px;"><img  src="/images/noimage.png" alt="File not found" height="50" width="100" border="3" ></td>
         <?php } ?>
         </tr>
        <tr>
        <td height="30" valign="middle">
          
            </td>
            <td colspan="3" align="left" valign="top" style="text-align:left;line-height:20px;">
		Subject :<?php if($data_bylimit[$index]["subject_id"]!=gINVALID){echo $subjects[$data_bylimit[$index]["subject_id"]].".";} ?>   Exam :<?php echo  $exams[$data_bylimit[$index]["exam_id"]].".";?>
			
          </td>    
        </tr>
        <tr>
          <td></td><td><div class="edit_verify_div"><a href="#" class="edit_link" passage_id="<?php echo $data_bylimit[$index]['id']; ?>">Edit</a><?php if($data_bylimit[$index]["passage"]!="" && $data_bylimit[$index]["subject_id"]!=gINVALID && $data_bylimit[$index]["exam_id"]!=gINVALID) {?> <input type="checkbox" name="verify[]" id="verify" <?php if($data_bylimit[$index]['question_group_status_id']==STATUS_ACTIVE) { ?>checked<?php } ?> value="<?php echo $data_bylimit[$index]['id']; ?>">verify<?php }else{?> <?php } ?></div></td>
        
        </tr>
	</table>
	 </div>
	<div class="popup_form" id="popup_form_<?php echo $data_bylimit[$index]['id'];?>">
<form name="poup_frm_<?php echo $data_bylimit[$index]['id'];?>">
<table >
<tr>
<td>Passage :</td><td><textarea id="txtpassage_<?php echo $data_bylimit[$index]['id'];?>"  cols="45" rows="5"><?php echo $data_bylimit[$index]['passage']; ?></textarea><input type="hidden" id="txtid_<?php echo $data_bylimit[$index]['id'];?>" value="<?php echo $data_bylimit[$index]['id']; ?>"></td>
</tr>
<tr>
<td>Exam :</td>
      <td><?php populate_array("lstexam_".$data_bylimit[$index]['id'], $exams,$data_bylimit[$index]["exam_id"],$disable=false); ?></td>
    </tr>
<tr>
<tr>
	<td>Subject :</td>
	
      <td><?php  populate_array("lstsubject_".$data_bylimit[$index]['id'], $subjects,$data_bylimit[$index]["subject_id"],$disable=false); ?></td>
</tr>

<td></td>
<td><input value="Update" type="button" id="<?php echo $data_bylimit[$index]['id'];?>" passage_id="<?php echo $data_bylimit[$index]['id']; ?>" class="update_button" /></td>
</tr>
</table>
</form>
</div>
        <?php
				$index++;
				}
		 }else{?>

No Records Found.

<?php } ?>  
       
	</td>
	</tr>
        <tr>
          <td height="50" colspan="2" align="center" style="text-align:center;">
       <?php if($data_bylimit > 0){ ?>   <input type="hidden" name="txtimport_id" value="<?php echo $mytempgroups->question_group_import_id; ?>"><input value="Update" type="submit" name="update"  /><?php }else{ ?><a href='#' class='back'>Go Back</a><?php } ?>
          </td>
          </tr>
        </table>
                
</form>


























