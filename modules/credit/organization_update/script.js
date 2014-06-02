$(document).ready(function(){
	//----------------validation start here----------------
	$("#submit").click(function(){

		var txtcredit = $("#txtcredit").val();
		if(txtcredit == ""){
			popup_alert("Enter credit","","","ok");
			return false;
		}
		else{
			if($.isNumeric(txtcredit)){
				if(txtcredit > organization_credit){
					popup_alert("Please check your available credit","","","ok");
					return false;
				}
				else{
					return true;
				}
			}
			else{
				popup_alert("Invalid credit","","","ok");
				return false;
			}
		}
	});
	//----------------validation ends here----------------
});