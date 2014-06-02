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


function validate_member_update(frm){
    error = "";

    frm = document.getElementById("frmupdate");


    if(frm.txtemail.value==""){
       /* error = "Empty Email\n";*/
    }else{
	    pattern = /\w+@\w+\.\w+/;
	     //pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtemail.value));
	    if( result == false) {
	       error = "Invalid Email\n";
	    }
	}


    if ( error == "" )
        return true;
    else
    alert(error);
        return false;
}





 -->
