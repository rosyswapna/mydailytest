<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

?>


<form name="frmupdate" id="frmupdate" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="2" class="page_caption">
   Update Groups to DB
    </td>
</tr>
    <tr>
      <td>Import Id :</td> <td><?php echo $mygroupsimports->id; ?>
     <input type="hidden" name="txtimport_id" value="<?php if(isset($_POST['txtimport_id'])){echo $_POST['txtimport_id'];}else if(isset($_GET['importid'])){echo $_GET['importid'];} ?>"></td>
</tr>
<tr>
	
	<td>Created :</td>
      <td><?php echo $mygroupsimports->created?></td>
</tr>
<tr>
<td>Csv File :</td>
      <td><?php echo $mygroupsimports->csv_file?></td>
    </tr> 
<tr>
<tr>
<td>Date Of Import :</td>
      <td><?php echo $mygroupsimports->date?></td>
    </tr> 
<tr>
	
	<td>Total Passages :</td>
      <td><?php echo $mygroupsimports->total_passages?></td>
</tr>
<tr>
<td>Verified Passages : </td>
      <td><?php echo $mygroupsimports->total_verified_passage?></td>
    </tr> 


</table>
<br />
 <input name="submit" value="submit" type="submit">
 <?php if($chk_existence!=true) { ?><input name="delete" value="delete" type="submit"> <?php  } ?>
 </form>
























