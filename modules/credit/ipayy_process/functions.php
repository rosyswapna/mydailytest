<?php 

function build_html($prms)
{
	$name = $prms['name'];
	$address = $prms['address'];
	$email = $prms['email'];
	$phone = $prms['phone'];
	$payment_id = $prms['payment_id'];
	$payment_date = $prms['payment_date'];
	$amount = $prms['amount'];
	$transaction_no = $prms['transaction_no'];
	$payment_status = $prms['payment_status'];
	$userid = $prms['userid'];
	$creditplan = $prms['credit_plan'];
	$credit = $prms['credit'];



	$html ='
	<div class="inner-box" id="print_div_content">
							<table width="100%" class="table-css">
  <tr>
    <td colspan="2" align="center" valign="top">Tranform Learning and Assessment LLP<br />
    <br />
    E1, Fact Nagar, Tripunithara Bypass Road<br />
    Maradu PO, Kochi - 682301<br />
    Kerala, India<br />
    Contact No: +91 8136 800 800<br />
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
        <td width="71%" align="left" valign="top">'.$name.'</td>
      </tr>
      <tr>
        <td align="left" valign="top">Address:</td>
        <td align="left" valign="top">'.$address.'</td>
      </tr>
      <tr>
        <td align="left" valign="top">Email:</td>
        <td align="left" valign="top">'.$email.'</td>
      </tr>
      <tr>
        <td align="left" valign="top">Mobile: </td>
        <td align="left" valign="top">'.$phone.'</td>
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
            <td width="50%" align="left" valign="top">Invoice Number: '.$payment_id.'</td>
            <td width="50%" align="left" valign="top">Invoice Date: '.$payment_date.'</td>
          </tr>
          <tr>
            <td align="left" valign="top">Transaction ID: '.$transaction_no.'</td>
            <td align="left" valign="top">Status: '.$payment_status.'</td>
          </tr>
          <tr>
            <td align="left" valign="top">Total Amount: '.$amount.'</td>
            <td align="left" valign="top">Account Type </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top" height="20" style="padding:0"></td>
      </tr>
      <tr>
        <td align="left" valign="top">Registration ID: '.$userid.'</td>
      </tr>
      <tr>
        <td align="left" valign="top">Account Plan: '.$creditplan.' </td>
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
        <td align="left" valign="top">'.$creditplan.'</td>
        <td align="center" valign="top">'.$credit.'</td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">Rs.'.$amount.'</td>
      </tr>
      
      <tr>
        <td colspan="4" align="right" valign="top">Total Amount </td>
        <td align="center" valign="top">Rs.'.$amount.'</td>
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
    2. Subject Hight Court of Kerala Jurisdiction only<br />
    3. The invoice shows the actual price of the goods described and that all particulars are true correct<br />
    4. This is a computer generated Invoice
</p>
      </td>
  </tr>
</table>													
</div>
	';

	return $html;

}