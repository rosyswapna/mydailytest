

function confirmPassword()
{
	var frm = document.getElementById("frmreset_passwd");
	var password = frm.new_password.value;
	var c_password = frm.confirm_new_password.value;
	if(password!=c_password){
	
		alert("Mismatch! Re-Enter Password");
		frm.new_password.value = "";
		frm.confirm_new_password.value = "";
		frm.new_password.focus();
	}
}



