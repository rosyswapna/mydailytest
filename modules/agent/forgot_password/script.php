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



$('.submit').click(function () {


	var error = "";


	var post_captcha = $.post(current_url,{captcha:1});
			post_captcha.done(function(data){
			var session_captcha=data;
	
	var captcha = $("#txtcaptcha").val();
	if(captcha!=''){ 
     if(Trim(captcha)!=Trim(session_captcha)){
        error += "The characters didn't match the picture. Please try again.<br/>";
    }
    }else{
	 error += "The characters filed must not be blank.<br/>";
	}


	var username = $('#username').val();  
    if(Trim(username)==""){
        error += "Empty Username.<br/>";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(username);
	    if( result == false) {
	       error += "Username must be an emailid.<br/>";
	    }
	}
if ( error != "" ){
	popup_alert(error,"","","close");
			return false;
	}else{alert("hi");
	$(".submit_reset").trigger("click");

	}
});
});
});
 -->
