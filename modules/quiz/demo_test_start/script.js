
$(document).ready(function(){

	//refresh captcha string
	$('#captcha_refresh').click(function () {
		$('#captcha_id').attr('src',$('#captcha_id').attr('src')+'?'+Math.random());
	});
/*
	$('#submit').click(function () {

		var error = "";
		var post_captcha = $.post(current_url,{captcha:1});
		post_captcha.done(function(data){
			var session_captcha = data;
			var captcha = $("#txtcaptcha").val();
			if(captcha!=''){
	     		if(captcha.trim() != session_captcha.trim()){
	        		error += "Captcha Mismatch\n";
	        		popup_alert(error,"","","Close");
	        		return false;
	        	}
	        	else{
	        		error += quiz_name;
	        		popup_alert(error,"#","Start Now","false");
	        		return true;
	        	}
	   		}else{
		 		error += "Captcha Empty\n";
		 		popup_alert(error,"","","Close");
	        	return false;
			}
		});
		
	});


	//start test on click popup ok button
	$('#popup_alert_button_ok').click(function(){
		var post_start_test = $.post(current_url,{test_start:1});
		post_start_test.done(function(data){
			if(data == '1'){
				window.location.href = "demo_test.php";
			}
			else{
				popup_alert("Try Again","","","Ok");
			}
		});
	});




	$(document).keypress(function(e) {
	 if(e.which == 13) {
	   $("#submit").trigger("click");
	 }
	});

*/


var global_idle="";
function refresh() {
      popup_alert ("Please register to take real tests","sign_up.php","Signup","close");
  	global_idle="false";
}

var timer;
function start() {
 timer = setTimeout(function(){refresh()}, 30000);
}


 
	 //custom number of questions per page
    $('#lstrecord_per_page').change(function(){
		$( "#hd_submit" ).trigger("click");		
    });
start();
       $("body").mousemove(function( event ) {
               if(global_idle==""){
		clearTimeout(timer);
               start(); 
	}
     
       });
$(document).scroll(function() {
 if(global_idle==""){
clearTimeout(timer);
 start();
}
});

$(document).keypress(function(e) {
	 if(global_idle==""){
               clearTimeout(timer);
               start();
	}
       });

	
});
