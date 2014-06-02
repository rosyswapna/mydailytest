<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>

<form name="frmsearch" id="frmsearch" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="2" class="page_caption">
    <?php echo $CAP_page_caption?>
    </td>
</tr>
<tr>
	<td><?php echo $CAP_id ?></td>
      <td><input name="txtid" value="<?php if(isset($_POST['txtid'])){echo $_POST['txtid'];}?>" ></td>
</tr>
    <tr>
      <td><?php echo $CAP_name ?></td>
      <td><input name="txtname" value="<?php if(isset($_POST['txtname'])){echo $_POST['txtname'];}?>" /></td>
</tr>
<tr>
	<td><?php echo $CAP_agent ?></td>
      <td><?php populate_array("lstagent",$agents,$myagent->id,$disable=false); ?></td>
</tr>
<tr>
	<td><?php echo $CAP_bill_date ?></td>
      <td><input name="txtdate"  value="<?php if(isset($_POST['txtdate'])){echo $_POST['txtdate'];}?>"></td>
</tr>
<tr>
                    <td>
                        <?php echo $CAP_bill_status_id?>
                    </td>   
                    <td><?php populate_array("lstbillstatus", $bill_statuses,$myvoucherbill->bill_status_id,$disable=false); ?> 
                    </td>
                </tr>
 <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;</td>
      <td><input name="submit" value="<?php echo $CAP_submit?>" type="submit"></td>
    </tr>
</table>
</form>

<table  border="0" cellpadding="1px" cellspacing="1px">
     <tr><td colspan="6">&nbsp;</td></tr>
    <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="6">&nbsp;</td></tr>
     <tr><td colspan="6" align="center" class="message" ><?php echo $MSG_mesg ?></td></tr>
     <tr><td colspan="6">&nbsp;</td></tr>
 </table>
    <?php
     }
     else{?>
    <tr>
        <th class="slno">Slno</th>
        <th><?php echo $CAP_id?></th>
        <th><?php echo $CAP_bill_date?></th>
        <th><?php echo $CAP_name?></th>
	 <th><?php echo $CAP_bill_status_id?></th>
	<th><?php echo $CAP_payment_id?></th>
        <th><?php echo $CAP_amount?></th>
	<th><?php echo $CAP_commision?></th>
        <th><?php echo $CAP_edit?></th>
	   
    </tr>

     <?php
     //to number each record in a page
    
     $style = "row_lite";
     $index = 0;
     $slno = ($Mypagination->page_num*$Mypagination->max_records)+1;

     while ( $count_data_bylimit > $index ){
        $link = "bill.php?voucher_bill_id=".$data_bylimit[$index]["id"]."";
	        if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }

        ?>
    <tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $slno++ ?></td>
        <td><a href="<?php //echo $link; ?>#"><?php echo $data_bylimit[$index]["id"]; ?></a></td>
        <td><?php echo date("d/m/Y",strtotime($data_bylimit[$index]["date"])); ?></td>
        <td><?php echo $data_bylimit[$index]["name"]; ?></td>
	
	<td><?php echo $bill_statuses[$data_bylimit[$index]["bill_status_id"]]; ?></td>
	<td><?php echo $data_bylimit[$index]["payment_id"]; ?></td>
    <td><?php echo $data_bylimit[$index]["amount"]; ?></td>
	<td><?php echo $data_bylimit[$index]["commision"]; ?></td>
        <td><a href="<?php //echo $link; ?>#">Edit</a></td>
	    </tr><?php
         $index++;
    }
    ?>
    <tr><td colspan="5">&nbsp;</td></tr>
  </table>

        <!--For pagination. we can create a  diff style  & use-->
        <?php $Mypagination->pagination_style2(); ?>

      <?php } ?>


<div align="center">* You can Click on a user name to "Update" or"Delete"</div>
