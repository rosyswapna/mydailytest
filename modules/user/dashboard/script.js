function Trim(strInput) {
    while (true) {
        if (strInput.substring(0, 1) != " ")
            break;
        strInput = strInput.substring(1, strInput.length);
    }
    while (true) {
        if (strInput.substring(strInput.length - 1, strInput.length) != " ")
            break;
        strInput = strInput.substring(0, strInput.length - 1);
    }
   return strInput;
}

$(document).ready(function(){

	$(".button_take_test").click(function(){
		credit = $(this).attr( "credit" );
		quiz_name = $(this).attr( "quiz_name" );
		quiz_id = $(this).attr( "quiz_id" );
		current_test_id = $("#h_current_test_id").val();
		url = $(this).attr( "url" );
		if(current_test_id > 0){
			message = 'Do u want to pause current test and continue next ?';
		}else{
			
			url = url+"/test.php?id="+quiz_id;
			message = 'Credit '+credit+' used for taking test on "'+quiz_name+'", Continue ?';
		}
		if (confirm(message)) {
			// redirect it!
			url = url+"/pause.php?id="+quiz_id;
		} else {
			url = url+"/test.php?id="+quiz_id;
		}
		window.location.href = url;
	});

	$(document).on("blur", "#txtusername", function() {
	if($('#txtusername').val()!=''){
		check_availability_validation();
	 }
	});
	
	

	$(".exam_checkboxs").click(function(){
	
	$("#update_exam").trigger("click");
	});

$("#getcredit").click(function(){
if(privilege=='NO'){
var overlay_panel_content='<table><tr><td><label>Username(Email)<small>*</small></label></td><td><input type="text" name="txtusername" id="txtusername"></td></tr><tr><td><label>Phone</label> </td><td><input type="text" name="txtphone" id="txtphone"><input type="hidden"  name="h_validate_username" id="h_validate_username"  value="false"></td></tr></table>';
popup_alert(overlay_panel_content,"#","Update","");
}else{
window.location.href ='/get_credit.php';
}
});

$('#popup_alert_button_ok').click(function () {
	
var username = $("#txtusername").val();  
var phone = $('#txtphone').val();  

var  error="";
 
    if(Trim(username)==""){
        error += "Empty Username<br/>";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(username);
	    if( result == false) {
	       error += "Username must be an emailid<br/>";
	    }
	}
	if($("#h_validate_username").val()!='false'){
	error=error+'user name is not available<br/>';
	}
	
	var phone = $('#txtphone').val();  
    if(Trim(phone)==""){
        
    }else{
	if (/^\d{10}$/.test(phone)) {
 	
       }else{
	error += "Invalid Phone number<br/>"; 
	}
	}
if(error!='')
{popup_alert(error,"","","close");
return false;
}else{

$.post(current_url,{
	username:username,
	phone:phone
	},function(data){
	if(data!=''){
	window.location.href ='/get_credit.php';
	
	}
	});
}	
} );

	
});


function check_availability_validation(){
 var username = $('#txtusername').val();  
var error='';
$.post("user_check.php", { username: username },  
            function(result){ 
		
                //if the result is 1  
                if(result == 1){  
                  $("#h_validate_username").attr("value",'false');   
                }else{ 
		
                  $("#h_validate_username").attr("value",username); 
		
                }  
		
		
        });
}
