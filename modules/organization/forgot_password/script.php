 <!--

function validate_email()
{
    error = "";
var frm = document.getElementById("frmforgot_passwd");
  
if(frm.username.value==""){
        error = error+"Email Empty\n";
    }else{
	   // pattern = /\w+@\w+\.\w+/;
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	  result = pattern.test(Trim(frm.email.value));
	   if( result == false) {
	      error = error+"Invalid Email\n";
	    }
	}

	var randome_hidden = <?php echo $_SESSION[SESSION_TITLE.'captcha'];?>;
	var randome_expression = $('#randome_expression').val();

    if(Trim(randome_hidden) != Trim(randome_expression)){
        error += "Invalid Answer\n";
    }


	if ( error != "" ){
		   alert(error);
			return false;
	}else{
		return true;
	}

    if ( error != "" )
        {  alert(error);
        return false;
	}
	


}
 -->
