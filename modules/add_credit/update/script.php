<!-- 
$(document).ready(function(){

	var checking_html = 'Checking...';
	$('#check_availability').click(function(){ 
	
		
			$('#username_availability_result').html(checking_html);  
			check_availability();  
				 
   }); 
   
function validate(){
 var error = "";
var name = $('#txtcreditname').val();  
    if(name==""){
        error = "<br>Empty Credit name\n";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(name);
	    if( result == false) {
	       error = "<br>Username must be an emailid\n";
	    }
	}
 if ( error != "" ){
       $('#username_availability_result').html(error);
return false;
    }else{
return true;
}

}  
   

function check_availability(){  
  
        //get the username  
       var name = $('#txtcreditname').val();  
        //use ajax to run the check  
        $.post("credit_name_check.php", { name: name },  
            function(result){ 

                //if the result is 1  
                if(result == 1){  
                    //show that the username is available  
                    $('#username_availability_result').html(name + ' is Available');  
                }else{  
				
                    //show that the username is NOT available  
                    $('#username_availability_result').html(name + ' is not Available');  
                }  
        });  
}

});
-->

