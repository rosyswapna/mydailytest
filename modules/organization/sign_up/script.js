

function confirmPassword()
{
	var frm = document.getElementById("frmupdate");
	var password = frm.txtpassword.value;
	var c_password = frm.txtconfirm.value;
	if(password==c_password){
		document.getElementById('error_pass').innerHTML="";
	}
	else{
		document.getElementById('error_pass').innerHTML="Mismatch! Re-Enter Password";
		frm.txtpassword.value = "";
		frm.txtconfirm.value = "";
		frm.txtpassword.focus();
	}
}


function validate_signup()
{
    error = "";
var frm = document.getElementById("frmupdate");
    

    if(frm.txtorganizationusername.value==""){
        error = "User Name Empty \n";
    }else{
	    pattern = /\w+@\w+\.\w+/;
	     //pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtorganizationusername.value));
	    if( result == false) {
	       error = error+"Invalid User Name\n";
	    }
	}

    if(frm.txtname.value==""){
        error = error+"Organization Name Empty\n";
    }

  
/*
    if(frm.txtaddress.value==""){
        error = error+"Address Empty\n";
    }

    if(frm.txtoccupation.value==""){
        error = error+"Occupation Empty\n";
    }
	*/

    if(frm.txtemail.value!=""){
	    pattern = /\w+@\w+\.\w+/;
	     //pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtpresident_emailid.value));
	    if( result == false) {
	       error = error+"Invalid Email\n";
	    }
	}

    if ( error == "" )
        return true;
    else
    alert(error);
        return false;

}

$(document).ready(function(){
	 var checking_html = 'Checking...';
	 $('#check_availability').click(function(){ 
	var res=validate_username();
if(res==true)
{
                $('#username_availability_result').html(checking_html);  
                check_availability();  
}
             
   }); 


//function for check email id

function validate_username(){
 var error = "";
var username = $('#txtusername').val();  
    if(username==""){
        error = "Empty Username\n";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(username);
	    if( result == false) {
	       error = "Username must be an emailid\n";
	    }
	}
 if ( error != "" ){
       $('#username_availability_result').html(error);
return false;
    }else{
return true;
}
}







//function to check username availability  
function check_availability(){  


  
        //get the username  
       var username = $('#txtusername').val();  
        //use ajax to run the check  
        $.post("organization_check.php", { username: username },  
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
