<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

?>


<form name="frmupdate" id="frmupdate" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="8" class="page_caption">
  Generate Bill
  <p style="float:right;"><input type="checkbox" name="paylater">Pay Later.</p></td>
</tr>
   
<tr>
	
	<td>Agent  :</td>
      <td><?php populate_array("lstagent",$agents,$myagent->id,$disable=false,"Select Agent",$options='class = "select agentclass styled hasCustomSelect" '); ?></td>
      <td>Total Amount :<p style="float:right;" class="billtotamount">0</p><input type="hidden" name="txtbilltotamount" id="txtbilltotamount"></td>
	
</tr>
<tr><td>OR Name  :</td>
      <td><input type="text" name="txtname" id="txtname" ></td><td>Discount :</td><td><input type="text" name="txtdiscount" id="txtdiscount" class="txtdiscount" item_id="1" ></td>
</tr>
<tr>
<td>Address :</td>
      <td><input type="text" name="txtaddress" id="txtaddress"></td>

    </tr> 

<tr>
<td>Phone :</td>
      <td><input type="text" name="txtphone" id="txtphone"></td>

    </tr> 
<tr>
<td>Email :</td>
      <td><input type="text" name="txtemail" id="txtemail"></td>

    </tr> 

    <td colspan="8" class="page_caption">
 Allocate vouchers
  <p style="float:right;"> Total vouchers available :<?php echo $myvoucher->total_vouchers_inactive;  ?></p></td>
</tr>
 <tr>
    <td >
<br><br>
 </td>
</tr> 
<tr>
    <td colspan="8" class="page_caption">
 Item 1
 <p style="float:right;" class="addmore_p"><input type="button" class="addmore" item_id="1" value="Add more"></p></td>
</tr> 
<tr>
	
	<td>Amount</td>
      <td><input type="text" name="txtamount[]" id="txtamount1" item_id="1" class="txtamount"></td>

<td>Credit :</td>
      <td><input type="text" name="txtcredit[]" id="txcredit1" item_id="1" class="txcredit"></td>

    </tr> 

<tr>
<td>No of vouchers :</td>
      <td><input type="text" name="txtnumberofvouchers[]" id="txtnumberofvouchers1" item_id="1" class="txtnumberofvouchers"><input type="hidden" name="txtnumberofvouchers_check[]" id="txtnumberofvouchers_check1" item_id="1" class="txtnumberofvouchers_check"></td>

<td>Total Amount</td>
      <td><input type="text" name="txttotamount[]" id="txttotamount1" item_id="1" class="txttotamount"></td>

    </tr> 

<tr>
<td>Commision(%)  :</td>
      <td><input type="text" name="txtcommision[]" id="txtcommision1" item_id="1" class="txtcommision"></td>


<td>Amount Aftrer commision</td>
      <td><input type="text" name="txtamountaftrercommision[]" id="txtamountaftrercommision1" item_id="1" class="txtamountaftrercommision"></td>

    </tr> 
<tr>
<td>Valid from</td>
      <td><input type="text" name="txtvalidfrom[]" id="txtvalidfrom1" item_id="1" class="txtvalidfrom"></td>
<td>Valid to :</td>
      <td><input type="text" name="txtvalidto[]" id="txtvalidto1" item_id="1" class="txtvalidto"></td>

    </tr> 

</table>
<table>
<tr>
<td>
<div name="new_item" class="new_item"></div>
</td>
</tr>
</table>
<br />
 <input name="submit" value="Generate Bill" type="submit">

 </form>
























