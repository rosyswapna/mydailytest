<!--
$(document).ready(function(){
	
	


	$('select[name=lstcreditplans]').change(function(){
		var plan_id = $(this).val();
		if(plan_id == -1)
		{
			$("#plan_details").text("");
		}
		else
		{
			var success_post = $.post('<?php echo $current_url?>',
	        {
	          plan_id:plan_id,
	        });
	        success_post.done(function (data) {
	      		if(data){
					$("#plan_details").text(data);
	      		}
	       });
	    }
    
	});

	$("#payment").click(function(){
		var planid = $('select[name=lstcreditplans]').val();
		var paymenttypeid = $('select[name=lstpaymenttypes]').val();
		var error = "";
		if(planid == "" || planid == -1){
			error +="Select credit plan \n";
		}
		if(paymenttypeid == "" || paymenttypeid == -1){
			error +="Select payment type";
		}
		if(error == ""){
			return true;
		}
		else{
			popup_alert(error,"","","OK");
			return false;
		}
	});

	$("#recharge").click(function(){
		var voucher = $("#txtvoucher").val();
		if(voucher == ""){
			popup_alert("Enter voucher number","","","OK");
			return false;
		}
		else{
			return true;
		}
	});

	
});




-->