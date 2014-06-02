<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$myvoucher=new Voucher();
$myvoucher->connection = $myconnection;

$myvoucher->get_counts();

if(isset($_POST['submit'])){
$number_of_voucher=$_POST['txtnumberofvoucher'];
if($number_of_voucher>0){
for($i=0;$i<$number_of_voucher;$i++){
$voucher=$myvoucher->generate_voucher();
$chk=$myvoucher->check_voucher($voucher);
if($chk==true){
$myvoucher->set_defaults();
$myvoucher->voucher=$voucher;
$myvoucher->update();
$myvoucher->id='';
}else{
$i--;
}
}
}
}

?>
