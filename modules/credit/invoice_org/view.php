<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/get_credit.php">Payment/Credit Details</a> &raquo; <a href="/invoice.php">invoice</a>';?>

<form action="" method="post">
<input type="hidden" name="hd_ocid" value="<?php echo $myorganizationcredit->id; ?>"/>
<div class="innercontainer-blk">
					<p class="heading">
						<span class="fleft">Invoice 
            <!--<input type="submit" class="button" value="Email" id="email_div" name="submit">-->
            </span>
						<span class="fright"><input type="submit" class="button" value="Print" id="print_div"></span>
					</p>
					<div class="sixteen columns mright8">
						<div class="inner-box" id="print_div_content">
							<table width="100%" class="table-css">
                <tr>
                  <td colspan="2" align="center" valign="top">Transform Learning and Assessment LLP<br />
                  <br />
                  E1, Fact Nagar, Tripunithura Bypass Road<br />
                  Maradu PO, Kochi - 682301<br />
                  Kerala, India<br />
                  Contact No: <span lang="EN-US" xml:lang="EN-US">+91 91882 31779</span><br />
                  Email: support@mydailytest.com</td>
                </tr>
                <tr>
                  <td height="20" colspan="2" align="left" valign="top" style="padding:0"></td>
                </tr>
                <tr>
                  <td colspan="2" align="center" valign="top">INVOICE</td>
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
                      <td width="71%" align="left" valign="top"><?php  echo $myorganization->name;?></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">Address:</td>
                      <td align="left" valign="top"><?php echo $myorganization->address;?></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">Email:</td>
                      <td align="left" valign="top"><?php  echo $myorganization->email;?></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">Mobile: </td>
                      <td align="left" valign="top"><?php echo $myorganization->phone;?></td>
                    </tr>
                  </table></td>
                  <td width="50%" align="left" valign="top"><table width="100%" >
                    <tr>
                      <td align="left" valign="top">Invoice Details </td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" height="20" style="padding:0"></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><table width="100%" >
                        <tr>
                          <td width="50%" align="left" valign="top">Invoice Number: <?php echo $mypayment->id; ?></td>
                          <td width="50%" align="left" valign="top">Invoice Date: <?php echo $mypayment->date; ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">Transaction ID: <?php if($mypaymenttype->online == PAYMENT_ONLINE){ echo $transaction_number;}?></td>
                          <td align="left" valign="top">Status: <?php echo $mypaymentstatus->name; ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">Total Amount: Rs.<?php echo $mypayment->amount; ?></td>
                          <td align="left" valign="top">Account Type </td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" height="20" style="padding:0"></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">Registration ID: <?php echo $myorganization->id;?></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">Account Plan: <?php echo $mycreditplan->name; ?> </td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2" align="center" valign="top" height="20" style="padding:0">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center" valign="top"><table width="100%" >
                    <tr>
                      <td align="center" valign="top">SL No </td>
                      <td align="left" valign="top">Product Description </td>
                      <td align="center" valign="top">Credits</td>
                      <td align="center" valign="top">TAX % </td>
                      <td align="center" valign="top">Amount</td>
                    </tr>
                    <tr>
                      <td align="center" valign="top">1</td>
                      <td align="left" valign="top"><?php echo $mycreditplan->name; ?></td>
                      <td align="center" valign="top"><?php echo $mycreditplan->credit; ?></td>
                      <td align="center" valign="top">&nbsp;</td>
                      <td align="center" valign="top">Rs.<?php echo $mycreditplan->amount; ?></td>
                    </tr>
                    
                    <tr>
                      <td colspan="4" align="right" valign="top">Total Amount </td>
                      <td align="center" valign="top">Rs.<?php echo $mycreditplan->amount; ?></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="20" colspan="2" align="left" valign="top" style="padding:0"></td>
                </tr>
                <tr>
                  <td colspan="2" align="left" valign="top"><p>E &amp; OE<br />
                    1. Payments once made will not be reversed
                        <br />
                  2. Subject to Hight Court of Kerala Jurisdiction only<br />
                  3. The invoice shows the actual price of the goods described and that all particulars are true correct<br />
                  4. This is a computer generated Invoice
              </p>
                    </td>
                </tr>
              </table>													
						</div>	
					</div>
					
					
				</div>

</form>



