$(document).ready(function(){

	$(".button_take_test").click(function(){
		credit = $(this).attr( "credit" );
		quiz_name = $(this).attr( "quiz_name" );
		quiz_id = $(this).attr( "quiz_id" );
		current_test_id = $("#h_current_test_id").val();
		url = $(this).attr( "url" );
		if(current_test_id > 0){
			url = url+"/test.php";
			message = 'You have\'nt finished the Test, Please Pause/Quit test and Continue ?';
		}else{
			
			url = url+"/test.php?id="+quiz_id;
			message = 'Credit '+credit+' used for taking test on "'+quiz_name+'", Continue ?';
		}
		if (confirm(message)) {
			// redirect it!
				window.location.href = url;
		} else {
			// Do nothing!
		}
	});

	
});
