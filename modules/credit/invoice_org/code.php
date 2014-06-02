<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}


$myorganization = new Organization($myconnection);
$myorganization->connection = $myconnection;

$myorganizationcredit = new OrganizationCredit($myconnection);
$myorganizationcredit->connection = $myconnection;

$mypayment = new Payment($myconnection);
$mypayment->connection = $myconnection;

$mypaymentstatus = new PaymentStatus($myconnection);
$mypaymentstatus->connection = $myconnection;

$mypaymenttype = new PaymentType($myconnection);
$mypaymenttype->connection = $myconnection;

$mycreditplan = new CreditPlan($myconnection);
$mycreditplan->connection = $myconnection;


if(isset($_GET['slno'])){
  
	$myorganizationcredit->id = $_GET['slno'];
	$myorganizationcredit->get_detail(); 

  $mypayment->id = $myorganizationcredit->payment_id;
  $mypayment->get_detail();

	$myorganization->id = $myorganizationcredit->organization_id;
	$myorganization->get_detail();

	$mycreditplan->id = $mypayment->credit_plan_id;
	$mycreditplan->get_detail();

	$mypaymentstatus->id = $mypayment->payment_status_id;
	$mypaymentstatus->get_detail();

	$mypaymenttype->id=$mypayment->payment_type_id;
	$mypaymenttype->get_detail();

	$transaction_number = "";
	if($mypayment->payment_type_id == PAYMENT_TYPE_IIPAY){
		$transaction_number = $mypayment->iipay_transaction_number; 
	}
	else{
		$transaction_number = $mypayment->cc_avanue_transaction_number;
	}
}
else
{
	//do nothing
}



if(isset($_POST['submit']) && $_POST['submit'] == 'Email')
{
	$myorganizationcredit->id = $_POST['hd_ocid'];;
  $myorganizationcredit->get_detail(); 

  $myorganization->id = $myorganizationcredit->organization_id;
  $myorganization->get_detail();

  $mypayment->id = $myorganizationcredit->payment_id;
  $mypayment->get_detail();

  $mycreditplan->id = $mypayment->credit_plan_id;
  $mycreditplan->get_detail();

  $mypaymentstatus->id = $mypayment->payment_status_id;
  $mypaymentstatus->get_detail();
	



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
        <td width="71%" align="left" valign="top">'.$myorganization->name.'</td>
      </tr>
      <tr>
        <td align="left" valign="top">Address:</td>
        <td align="left" valign="top">'.$myorganization->address.'</td>
      </tr>
      <tr>
        <td align="left" valign="top">Email:</td>
        <td align="left" valign="top">'.$myorganization->email.'</td>
      </tr>
      <tr>
        <td align="left" valign="top">Mobile: </td>
        <td align="left" valign="top">'.$myorganization->phone.'</td>
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
            <td width="50%" align="left" valign="top">Invoice Number: '.$mypayment->id.'</td>
            <td width="50%" align="left" valign="top">Invoice Date: '.$mypayment->date.'</td>
          </tr>
          <tr>
            <td align="left" valign="top">Transaction ID: '.$transaction_number.'</td>
            <td align="left" valign="top">Status: '.$mypaymentstatus->name.'</td>
          </tr>
          <tr>
            <td align="left" valign="top">Total Amount: '.$mypayment->amount.'</td>
            <td align="left" valign="top">Account Type </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top" height="20" style="padding:0"></td>
      </tr>
      <tr>
        <td align="left" valign="top">Registration ID: '.$myorganization->id.'</td>
      </tr>
      <tr>
        <td align="left" valign="top">Account Plan: '.$mycreditplan->name.' </td>
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
        <td align="left" valign="top">'.$mycreditplan->name.'</td>
        <td align="center" valign="top">'.$mycreditplan->credit.'</td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">Rs.'.$mycreditplan->amount.'</td>
      </tr>
      
      <tr>
        <td colspan="4" align="right" valign="top">Total Amount </td>
        <td align="center" valign="top">Rs.'.$mycreditplan->amount.'</td>
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

	//echo $html;exit();


		$myemail = new Email();
		$myemail->to_email = $myorganization->email;
		$myemail->from_email = EMAIL_NO_REPLY;
		$myemail->subject = "Payment invoice";
		$myemail->message = $html;
		$myemail->send_mail();

		$_SESSION[SESSION_TITLE.'flash'] = $myemail->error_description;
	    header( "Location: payment_invoice.php?slno=".$id);
	    exit();
	  
	
}

?>
