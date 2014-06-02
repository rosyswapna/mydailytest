<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

?>


<form name="frmupdate" id="frmupdate" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="2" class="page_caption">
   Update Questions to DB
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
	
	<td>Total Question :</td>
      <td><?php echo $myquestionimports->total_questions?></td>
</tr>
<tr>
<td>Verified Question </td>
      <td><?php echo $myquestionimports->total_verified_questions?></td>
    </tr> 


</table>
<br />
 <input name="submit" value="submit" type="submit">
 <?php if($chk_existence!=true) { ?><input name="delete" value="delete" type="submit"> <?php  } ?>
 </form>
























