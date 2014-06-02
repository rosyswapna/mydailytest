<!--
 
 var organization_credit = <?php echo $myorganizationcredit->total_credit;?>

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

    if(frm.txtusername.value==""){
        error = "<?php echo $MSG_empty_username ?>\n";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtusername.value));
	    if( result == false) {
	       error = "<?php echo $MSG_invalid_username?>\n";
	    }
	}
 if ( error != "" ){
       alert(error);
return false;
    }


    if(frm.txtemail.value!=""){
            //pattern = /\w+@\w+\.\w+/;
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtemail.value));
	    if( result == false) {
	       error = "<?php echo $MSG_invalid_email?>\n";
	    }
	}

     if(frm.txtcredit.value!=""){
        var txtcredit = frm.txtcredit.value;
        if(isNaN(txtcredit)){
            error = "<?php echo $MSG_invalid_credit?>\n";
        }
        else if(txtcredit > organization_credit){
                error = "<?php echo $MSG_low_credit?>\n";
        }
    }
    
if ( error != "" ){
       alert(error);
return false;
    }


		if (Trim(frm.txtpassword.value) == "" && Trim(frm.txtrepassword.value) == "" ) {
		    error += "<?php echo $MSG_empty_password ?>\n";
		}
		else if( Trim(frm.txtpassword.value) != Trim(frm.txtrepassword.value) ){
		        error += "<?php echo $MSG_unmatching_passwords ?>\n";
		}
		else{
		         pattern = /[a-zA-Z0-9_-]{5,}/;
		         result = pattern.test(Trim(frm.txtrepassword.value));
		         if(result == false)
		         error += "<?php echo $MSG_length_password ?>\n" ;
		}

        if (Trim(frm.txtcredit.value) != "")
        {
    
        }


  if ( error != "" ){
       alert(error);
return false;
    }
 

/*
 if(frm.txtphone.value==""){
            error += "<?php echo $MSG_empty_phone ?>\n";
        }
*/


    if ( Trim(frm.txtuserstatus.value) == -1 ) {
        error+= "<?php echo $MSG_empty_userstatus?>\n";
    }
    if ( error == "" )
        return true;
    else
    alert(error);
        return false; 
}


function delete_member(){
    var ans = confirm("This will delete User Permanently");
    if ( ans == true ){
    	return true;
    }else{
        return false;
    }

}


$(document).ready(function(){

    $("#txtcredit").keyup(function(){
        var txtcredit = $(this).val();
        check_credit(txtcredit);
    });
    $("#txtcredit").focusout(function(){
        var txtcredit = $(this).val();
        check_credit(txtcredit);
    });


$(".delete").click(function(){
popup_alert("Are you sure to want to delete this user..?","#","","");

});

$('#popup_alert_button_ok').click(function () {
$('.deleteuser').trigger('click');

});

	 var checking_html = 'Checking...';
	 $('#check_availability').click(function(){ 
	var res=validate_username();
if(res==true)
{
                $('#username_availability_result').html(checking_html);  
                check_availability();  
}
             
   });


   function check_credit(txtcredit)
   {
        if(txtcredit <= organization_credit){
            $("#sp_org_credit").removeClass("clr_red").addClass("clr_green");
        }else{
            $("#sp_org_credit").addClass("clr_red");
        }
        $("#sp_org_credit").text("Available Credit : "+organization_credit);
   } 


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
