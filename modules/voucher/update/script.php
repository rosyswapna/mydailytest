<!--

var current_url = "<?php echo $current_url; ?>";

$(document).ready(function(){


$('.agentclass').change(function(){
var agent_id=$('.agentclass').val();
//var agent_id=$("input[name='lstagent']").val(); alert(agent_id);
if(agent_id!=-1){
var agent_det = $.post(current_url,{agent_id:agent_id });
			agent_det.done(function(data){
				var details=data.split(',');
				$('#txtname').val(details[0]);
				$('#txtemail').val(details[1]);
				$('#txtaddress').val(details[2]);
				$('#txtphone').val(details[3]);

				
			});
	}else{
		$('#txtname').val("");
		$('#txtemail').val("");
		$('#txtaddress').val("");
		$('#txtphone').val("");
	}
});
   /*
     var d=new Date();
     var dat=d.getDate();
     var mon=d.getMonth()+1;
     var year=d.getFullYear();
     var todayDate = dat+"/"+mon+"/"+year;
	$('#txtvalidfrom').val(todayDate);
	var date = new Date();
	date.setDate(date.getDate() + 40);
	date.setMonth(date.getMonth()+1);
	var futDate=date.getDate() + "/" + date.getMonth() + "/" + date.getFullYear();
	$('#txtvalidto').val(futDate);
    */ 



	$( document ).on( "blur", ".txtnumberofvouchers", function() {
	var item_id=$(this).attr('item_id');
	if($('#txtamount'+item_id).val()>0){
	var totamount=($('#txtamount'+item_id).val())*($('#txtnumberofvouchers'+item_id).val());
	totbillamount=Number(totamount)+Number($('#txtbilltotamount').val());
	$('#txttotamount'+item_id).val(totamount);
	}else{
	alert("Please fill the amount");
	}
	
	if($('#txtcommision'+item_id).val()>0){
	var totcommision=(($('#txttotamount'+item_id).val())*($('#txtcommision'+item_id).val()))/100;
	$('#txtamountaftrercommision'+item_id).val($('#txttotamount'+item_id).val()-totcommision);
	}
	
	var totbillamount=0;
	var values_totamount = $('input[name="txttotamount[]"]').map(function(){
       return this.value
   	}).get()
	var values_commision = $('input[name="txtcommision[]"]').map(function(){
       return this.value
   	}).get()
  	var values_amount_after_commision = $('input[name="txtamountaftrercommision[]"]').map(function(){
       return this.value
   	}).get()
	for(i=0;i<values_totamount.length;i++){
	if(values_commision[i]!=''){
	totbillamount=Number(totbillamount)+Number(values_amount_after_commision[i]);
	}else{
	totbillamount=Number(totbillamount)+Number(values_totamount[i]);
	}
	}


	if($('.txtdiscount').val()>0){
	totbillamount=totbillamount-Number($('.txtdiscount').val());
	}
	$('.billtotamount').html(totbillamount);
	//alert(totbillamount);
	$('#txtbilltotamount').val(totbillamount);
	
	}); 

	//update bill with change of amount

	$( document ).on( "blur", ".txtamount", function() {
	var item_id=$(this).attr('item_id');
	if($('#txtnumberofvouchers'+item_id).val()>0){
	$('#txttotamount'+item_id).val(($('#txtamount'+item_id).val())*($('#txtnumberofvouchers'+item_id).val()));
	}else{
	
	}
	if($('#txtcommision'+item_id).val()>0){
	var totcommision=(($('#txttotamount'+item_id).val())*($('#txtcommision'+item_id).val()))/100;
	$('#txtamountaftrercommision'+item_id).val($('#txttotamount'+item_id).val()-totcommision);
	}else{
	
	}
	
	var totbillamount=0;
	var values_totamount = $('input[name="txttotamount[]"]').map(function(){
       return this.value
   	}).get()
	var values_commision = $('input[name="txtcommision[]"]').map(function(){
       return this.value
   	}).get()
  	var values_amount_after_commision = $('input[name="txtamountaftrercommision[]"]').map(function(){
       return this.value
   	}).get()
	for(i=0;i<values_totamount.length;i++){
	if(values_commision[i]!=''){
	totbillamount=Number(totbillamount)+Number(values_amount_after_commision[i]);
	}else{
	totbillamount=Number(totbillamount)+Number(values_totamount[i]);
	}
	}


	if($('.txtdiscount').val()>0){
	totbillamount=totbillamount-Number($('.txtdiscount').val());
	}
	$('.billtotamount').html(totbillamount);
	//alert(totbillamount);
	$('#txtbilltotamount').val(totbillamount);
	
	});
	

	//update bill with change of discount

	$( document ).on( "blur", ".txtdiscount", function() {
	
	var totbillamount=0;
	var values_totamount = $('input[name="txttotamount[]"]').map(function(){
       return this.value
   	}).get()
	var values_commision = $('input[name="txtcommision[]"]').map(function(){
       return this.value
   	}).get()
  	var values_amount_after_commision = $('input[name="txtamountaftrercommision[]"]').map(function(){
       return this.value
   	}).get()
	for(i=0;i<values_totamount.length;i++){
	if(values_commision[i]!=''){
	totbillamount=Number(totbillamount)+Number(values_amount_after_commision[i]);
	}else{
	totbillamount=Number(totbillamount)+Number(values_totamount[i]);
	}
	}

	if($('.txtdiscount').val()>0){
	totbillamount=totbillamount-Number($('.txtdiscount').val());
	}
	$('.billtotamount').html(totbillamount);
	$('#txtbilltotamount').val(totbillamount);
	});



	$( document ).on( "blur", ".txtcommision", function() {
	var item_id=$(this).attr('item_id');
	if($('#txttotamount'+item_id).val()!=''){
	var totcommision=(($('#txttotamount'+item_id).val())*($('#txtcommision'+item_id).val()))/100;
	$('#txtamountaftrercommision'+item_id).val($('#txttotamount'+item_id).val()-totcommision);
	}else{
	
	}
	var totbillamount=0;
	var values_totamount = $('input[name="txttotamount[]"]').map(function(){
       return this.value
   	}).get()
	var values_commision = $('input[name="txtcommision[]"]').map(function(){
       return this.value
   	}).get()
  	var values_amount_after_commision = $('input[name="txtamountaftrercommision[]"]').map(function(){
       return this.value
   	}).get()
	for(i=0;i<values_totamount.length;i++){
	if(values_commision[i]!=''){
	totbillamount=Number(totbillamount)+Number(values_amount_after_commision[i]);
	}else{
	totbillamount=Number(totbillamount)+Number(values_totamount[i]);
	}
	}

	
	if($('.txtdiscount').val()>0){
	totbillamount=totbillamount-Number($('.txtdiscount').val());
	}
	
	$('.billtotamount').html(totbillamount);
	
	$('#txtbilltotamount').val(totbillamount);
	});
	

$( document ).on( "click", ".addmore", function() {
var item_id=$(this).attr('item_id');
item_id++;
var para_content='<input type="button" class="addmore" item_id='+item_id+' value="Add more">';
$('.addmore_p').html('');
$('.addmore_p').append(para_content);
var div_content='<tr><td colspan="8" class="page_caption">Item '+item_id+'</td></tr><tr><td>Amount</td><td><input class="txtamount" type="text" name="txtamount[]" id="txtamount'+item_id+'" item_id="'+item_id+'" ></td><td>Credit :</td><td><input class="txtcredit" type="text" name="txtcredit[]" id="txcredit'+item_id+'" item_id="'+item_id+'"></td></tr><tr><td>No of vouchers :</td><td><input class="txtnumberofvouchers" type="text" name="txtnumberofvouchers[]" id="txtnumberofvouchers'+item_id+'" item_id="'+item_id+'"><input type="hidden" name="txtnumberofvouchers_check[]" id="txtnumberofvouchers_check'+item_id+'" item_id="'+item_id+'" class="txtnumberofvouchers_check"></td><td>Total Amount</td><td><input class="txttotamount" type="text" name="txttotamount[]" id="txttotamount'+item_id+'" item_id="'+item_id+'"></td></tr><tr><td>Commision :</td><td><input class="txtcommision" type="text" name="txtcommision[]" id="txtcommision'+item_id+'" item_id="'+item_id+'"></td><td>Amount Aftrer commision</td><td><input class="txtamountaftrercommision" type="text" name="txtamountaftrercommision[]" id="txtamountaftrercommision'+item_id+'" item_id="'+item_id+'"></td></tr><tr><td>Valid from</td><td><input class="txtvalidfrom" type="text" name="txtvalidfrom[]" id="txtvalidfrom'+item_id+'" item_id="'+item_id+'"></td><td>Valid to :</td>  <td><input  class="txtvalidto" type="text" name="txtvalidto[]" id="txtvalidto'+item_id+'" item_id="'+item_id+'"></td></tr>';
$('.new_item').append(div_content);
});

});

 -->
