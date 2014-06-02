<!--
var current_url = "<?php echo $current_url; ?>";
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
 
 $('#captcha_refresh').click(function () {

	
	$('#captcha_id').attr('src',$('#captcha_id').attr('src')+'?'+Math.random());

});

 $('#submit').click(function () {

	var post_captcha = $.post(current_url,{captcha:1});
	post_captcha.done(function(data){
			var session_captcha=data;
			var captcha = $("#txtcaptcha").val();
	var error = "";
	if(captcha!=''){ 
     if(captcha!=session_captcha){
        error += "Captcha Mismatch<br/>";
    }
    }else{
	 error += "Captcha Empty<br/>";
	}
name=$("#txtname").val();
email=$("#txtemail").val();
message=$("#txtmessage").val();
if(name==""){
error+="Name Empty<br/>";
}
if(email==""){
error+="Email Empty<br/>";
}else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(email);
	    if( result == false) {
	       error += "emailid not valid<br>";
	    }
	}
if(message==""){
error += "Message empty";
}
if ( error != "" )
        {  popup_alert(error,"","","close");
        return false;
	}else{
	$("#submit_hidden").trigger("click");
	}
	});

	});  
});



-->
