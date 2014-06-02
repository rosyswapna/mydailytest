<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

?>


<form name="frmupdate" id="frmupdate" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="2" class="page_caption">
   Delete Passages From DB
    </td>
</tr>
    <tr>
      <td>Import Id :</td> <td><?php echo $mygroupimports->id; ?>
     <input type="hidden" name="txtimport_id" value="<?php if(isset($_POST['txtimport_id'])){echo $_POST['txtimport_id'];}else if(isset($_GET['importid'])){echo $_GET['importid'];} ?>"></td>
</tr>
<tr>
	
	<td>Created :</td>
      <td><?php echo $mygroupimports->created?></td>
</tr>
<tr>
<td>Csv File :</td>
      <td><?php echo $mygroupimports->csv_file?></td>
    </tr> 
<tr>
<tr>
<td>Date Of Import :</td>
      <td><?php echo $mygroupimports->date?></td>
    </tr> 
<tr>
	
	<td>Total Temp Passages :</td>
      <td><?php echo $mygroupimports->total_passages?></td>
</tr>
<tr>
<td>Verified Passages : </td>
      <td><?php echo $mygroupimports->total_verified_passage?></td>
    </tr> 
<tr>
<td><input type="checkbox" name="delete_temp_passages"> </td>
      <td>Delete Temp Passages</td>
    </tr>
<tr>
<tr>
	
	<td>Total Passages in main DB :</td>
      <td><?php echo $mygroup->total_passages?></td>
</tr>
<td><input type="checkbox" name="delete_main_passages"></td>
      <td>Delete Main DB Passages</td>
    </tr>


</table>
<br />
<input type="hidden" name="h_return_url" id="h_return_url" value="<?php  if(isset($_SERVER['HTTP_REFERER'])){echo $_SERVER['HTTP_REFERER'];} else{echo $current_url; }?>" > <input name="submit" value="Delete" type="submit">
 </form>
























