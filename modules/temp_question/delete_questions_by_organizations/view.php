<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

?>


<form name="frmupdate" id="frmupdate" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="2" class="page_caption">
   Delete Questions From DB
    </td>
</tr>
    <tr>
      <td>Import Id :</td> <td><?php echo $myquestionimports->id; ?>
     <input type="hidden" name="txtimport_id" value="<?php if(isset($_POST['txtimport_id'])){echo $_POST['txtimport_id'];}else if(isset($_GET['importid'])){echo $_GET['importid'];} ?>"></td>
</tr>
<tr>
	
	<td>Created :</td>
      <td><?php echo $myquestionimports->created?></td>
</tr>
<tr>
<td>Csv File :</td>
      <td><?php echo $myquestionimports->csv_file?></td>
    </tr> 
<tr>
<tr>
<td>Date Of Import :</td>
      <td><?php echo $myquestionimports->date?></td>
    </tr> 
<tr>
	
	<td>Total Temp Questions :</td>
      <td><?php echo $myquestionimports->total_questions?></td>
</tr>
<tr>
<td>Verified Questions : </td>
      <td><?php echo $myquestionimports->total_verified_questions?></td>
    </tr> 
<tr>
<td><input type="checkbox" name="delete_temp_questions"> </td>
      <td>Delete Temp Questions</td>
    </tr>
<tr>
<tr>
	
	<td>Total Question in main DB :</td>
      <td><?php echo $myquestion->total_questions?></td>
</tr>
<td><input type="checkbox" name="delete_main_questions"></td>
      <td>Delete Main DB Questions</td>
    </tr>


</table>
<br />
<input type="hidden" name="h_return_url" id="h_return_url" value="<?php  if(isset($_SERVER['HTTP_REFERER'])){echo $_SERVER['HTTP_REFERER'];} else{echo $current_url; }?>" > <input name="submit" value="Delete" type="submit">
 </form>
























