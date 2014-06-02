<!--
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
	 
	 $('.edit_link').click(function(){ 
	alert("hi");

   }); 










//function to check username availability  
function check_availability(){  


  
        //get the username  
       var username = $('#txtusername').val();  
        //use ajax to run the check  
        $.post("user_check.php", { username: username },  
            function(result){ 

                //if the result is 1  
                if(result == 1){  
                    //show that the username is available  
                    $('#username_availability_result').html(username + ' is Available');  
                }else{  
                    //show that the username is NOT available  
                    $('#username_availability_result').html(username + ' is not Available');  
                }  
        });  
}

});

 -->
