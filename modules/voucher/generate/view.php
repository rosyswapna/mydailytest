<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

?>


<form name="frmupdate" id="frmupdate" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="2" class="page_caption">
  Generate vouchers
    </td>
</tr>
    <tr>
      <td>Total vouchers :</td> <td><?php echo $myvoucher->total_vouchers; ?>
     </td>
</tr>
<tr>
	
	<td>Total vouchers active :</td>
      <td><?php echo $myvoucher->total_vouchers_active?></td>
</tr>
<tr>
<td>Total vouchers inactive :</td>
      <td><?php echo $myvoucher->total_vouchers_inactive?></td>
    </tr> 
<tr>
<tr>
<td>Total vouchers used :</td>
      <td><?php echo $myvoucher->total_vouchers_used?></td>
    </tr> 
<tr>
<td>No of vouchers to be generated :</td>
      <td><input type="text" name="txtnumberofvoucher"></td>
    </tr> 
</table>
<br />
 <input name="submit" value="submit" type="submit">

 </form>
























