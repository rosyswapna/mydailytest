<?php $breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/agent/dashboard.php">Dashboard</a>&raquo; <a href="/agent/vouchers.php">Vouchers</a>&raquo; <a href="/agent/voucher_bill.php">Voucher Bill</a>'; ?>

<form name="frmupdate" id="frmupdate" method="POST" action="<?php echo $current_url;?>">
<div class="innercontainer-blk">
  <p class="heading">
    <span class="fleft">Voucher Bill</span>
  </p>
  <div class="sixteen columns mright8">
    <div class="inner-box">
      <table width="100%" class="table-css">
        <tr>
          <td colspan="2" align="center" valign="top">Transform Learning and Assessment LLP<br />
            <br />
            E1, Fact Nagar, Tripunithura Bypass Road<br />
            Maradu PO, Kochi - 682301<br />
            Kerala, India<br />
            Contact No: <span lang="EN-US" xml:lang="EN-US">+91 91882 31779</span><br />
            Email: support@mydailytest.com
          </td>
        </tr>
        <tr>
          <td height="20" colspan="2" align="left" valign="top" style="padding:0"></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top">VOUCHER BILL</td>
        </tr>
        <tr>
          <td height="20" colspan="2" align="left" valign="top" style="padding:0"></td>
        </tr>
        <tr>
          <td width="50%" align="left" valign="top"><table width="100%" >
            <tr>
              <td colspan="2" align="left" valign="top">Customer Details </td>
            </tr>
            <tr>
              <td height="20" colspan="2" align="left" valign="top" style="padding:0"></td>
            </tr>
            <tr>
              <td width="29%" align="left" valign="top">Name:</td>
              <td width="71%" align="left" valign="top"><?php  echo $myvoucherbill->name;?></td>
            </tr>
            <tr>
              <td align="left" valign="top">Address:</td>
              <td align="left" valign="top"><?php echo $myvoucherbill->address;?></td>
            </tr>
            <tr>
              <td align="left" valign="top">Email:</td>
              <td align="left" valign="top"><?php  echo $myvoucherbill->email;?></td>
            </tr>
            <tr>
              <td align="left" valign="top">Mobile: </td>
              <td align="left" valign="top"><?php echo $myvoucherbill->phone;?></td>
            </tr>
          </table></td>
          <td width="50%" align="left" valign="top"><table width="100%" >
            <tr>
              <td align="left" valign="top">Voucher Bill Details </td>
            </tr>
            <tr>
              <td align="left" valign="top" height="20" style="padding:0"></td>
            </tr>
            <tr>
              <td align="left" valign="top"><table width="100%" >
                <tr>
                  <td width="50%" align="left" valign="top">Bill Number: <?php echo $myvoucherbill->id; ?></td>
                  <td width="50%" align="left" valign="top">Bill Date: <?php echo date("d/m/Y",strtotime($myvoucherbill->date)); ?></td>
                </tr>
                <tr>
                  <td align="left" valign="top">Payment ID: <?php echo $myvoucherbill->payment_id;?></td>
                  <td align="left" valign="top">Bill Status: </td>
                </tr>
               
              </table></td>
            </tr>
           
          </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top" height="20" style="padding:0">&nbsp;</td>
        </tr><table style="border:2px dashed black;">
        <tr>
          <td colspan="2" align="center" valign="top"><table width="100%" >
          <tr><td align="center" valign="top">   </td>
          <td align="center" valign="top">SL No </td>
          <td align="left" valign="top">Product Description </td>
          <td align="center" valign="top">Number of Vouchers</td>
          <td align="center" valign="top">Amount</td>
          <td align="center" valign="top">Credits </td>
          <td align="center" valign="top">Commision</td>
          <td align="center" valign="top">Item status</td>
          <td align="center" valign="top">Valid From </td>
          <td align="center" valign="top">Valid To</td>

        </tr>
        <?php $slno=1; $index_items=0;
        while($index_items<count($data)) { 
          if($data[$index_items]["voucher_bill_item_status_id"]==VOUCHER_BILL_ITEM_ACTIVE){ 
              $checked='checked'; }
          else{ $checked=''; } 
        ?>
        <tr>
          <td align="center" valign="top"><?php if($myvoucherbill->bill_status_id==VOUCHER_BILL_UNPAID){ ?><input type="checkbox" name="cancel_chk[]" value="<?php echo $data[$index_items]['id']; ?>" id="cancel_chk"<?php echo $slno; echo ' '.$checked;?> > <?php  } ?>
          </td>
          <td align="center" valign="top"><?php echo $slno++.'.';?></td>
          <td align="left" valign="top"><?php echo $data[$index_items]['description']; ?></td>
          <td align="center" valign="top"><?php echo $data[$index_items]['number_of_vouchers']; ?></td>
          <td align="center" valign="top">Rs.<?php echo $data[$index_items]['amount']; ?></td>
          <td align="center" valign="top"><?php echo $data[$index_items]['credit']; ?></td>
          <td align="center" valign="top"><?php echo $data[$index_items]['commision']; ?>%</td>
          <td align="center" valign="top">
            <?php 
              if($data[$index_items]['voucher_bill_item_status_id'] == VOUCHER_BILL_ITEM_ACTIVE){
                echo "Active";
              }elseif($data[$index_items]['voucher_bill_item_status_id'] == VOUCHER_BILL_ITEM_CANCELLED){
                echo "Cancelled";
              }
            ?>
          </td>
          <td align="center" valign="top"><?php if(strtotime($data[$index_items]['valid_from'])!=''){ echo date("d/m/Y",strtotime($data[$index_items]['valid_from']));}else{ echo "UNLIMITED"; } ?>
          </td>
          <td align="center" valign="top"><?php if(strtotime($data[$index_items]['valid_to'])!=''){ echo date("d/m/Y",strtotime($data[$index_items]['valid_to'])); }else{echo "UNLIMITED"; } ?>
          </td>
        </tr>
        <?php 
          $index_items++; 
        } 
        ?>
        <tr>
          <td colspan="4" align="right" valign="top">Total Amount :</td>
          <td align="left" valign="top">Rs.<?php echo $myvoucherbill->amount; ?></td>
        </tr>
        <tr>
          <td colspan="4" align="right" valign="top">Commision :</td>
          <td align="left" valign="top">Rs.<?php echo $myvoucherbill->commision; ?></td>
        </tr>
        <tr>
          <td colspan="4" align="right" valign="top">Discount :</td>
          <td align="left" valign="top">Rs.<?php if(isset($myvoucherbill->discount)){ echo $myvoucherbill->discount; }else{ echo '0'; } ?></td>
        </tr>
        <tr>
          <td colspan="4" align="right" valign="top">Amount to be paid :</td>
          <td align="left" valign="top">Rs.<?php $to_be_paid=$myvoucherbill->amount-($myvoucherbill->commision+$myvoucherbill->discount); echo $to_be_paid ; ?></td>
        </tr>
      </table>
          </table></td>
        </tr><table>
        <tr>
          <td height="20" colspan="2" align="left" valign="top" style="padding:0"><br><br></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"><p>E &amp; OE<br />
            1. Payments once made will not be reversed.
                <br />
          2. Subject to Hight Court of Kerala Jurisdiction only.<br />
          3. The Bill shows the actual price of the items described and that all particulars are true correct.<br />
          4. This is a computer generated Bill.
      </p>
            </td>
        </tr>
      <tr><td><br><br></td><td><input type="submit" name="submit" value="Update" style="float:right;"><a href="voucher_bill_print.php?voucher_bill_id=<?php echo $myvoucherbill->id; ?>"><input type="submit" class="button" value="Print" id="print_div" style="float:right;"></a></td></tr>
      </table>													
						</div>	
					</div>
					
					
				</div>

</form>



