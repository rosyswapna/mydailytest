
var pay_type = -1;

$(document).ready(function(){
	pay_type = $('select[name=lstpaymenttypes]').val();
	if(pay_type == cash ){
		$('tr#hide_row1').hide();
		$('tr#hide_row2').hide();
	}
	else if (pay_type == cheque) {
		$('tr#hide_row1').show();
		$('tr#hide_row2').show();
	}
	else{
		$('tr#hide_row1').hide();
		$('tr#hide_row2').hide();
	}

	//dispaly rows on change payment type
	$('select[name=lstpaymenttypes]').change(function(){
		pay_type = $(this).val();
		if(pay_type==cash)
		{
			$('tr#hide_row1').hide();
			$('tr#hide_row2').hide();
		}
		else if(pay_type == cheque)
		{
			$('tr#hide_row1').show();
			$('tr#hide_row2').show();
		}
		else{
			$('tr#hide_row1').hide();
			$('tr#hide_row2').hide();
		}
	});


	//set amount in amount text box
	$('select[name=lstcreditplans]').change(function(){
		var plan_id = $(this).val();
		if(plan_id == -1)
		{
			$('#plan_details').text("");
			$('#hdamount').val("");
			$('#txtcredit').val("");
			$('#txtcredit').attr('readonly',false);
		}
		else
		{
			var post_plan = $.post(current_url,{credit_plan:plan_id });
			post_plan.done(function(data){
				var list = data.split("_");
				$('#plan_details').text('Rs/-'+list[0]+' For '+list[1]+' credits');
				$('#txtcredit').val(list[1]);
				$('#hdcredit').val(list[1]);
				$('#hdamount').val(list[0]);
				$('#txtcredit').attr('readonly',true);
			});
		}
		
	});


	


	//form validation
	$("#payment").click(function(){
		var error = "";
	});



});



