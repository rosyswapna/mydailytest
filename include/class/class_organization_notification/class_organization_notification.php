<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Organization_notification {
    var $connection;
    var $to 			= "";
    var $subject		= "";
    var $message		= "";
    var $username		= "";
    var $password		= "";
    


    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";
	var $from 	= "my_daily_test@acube.co";





function organization_password_reset(){
	$strSQL = "SELECT email FROM organizations WHERE username = '".$this->username."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
	$this->to = mysql_result($rsRES,0,'email');
    $strFrom=EMAIL_NO_REPLY;
    $strTo=$this->username;
	//     To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
//     Additional headers
    $headers .= 'From: ".ORG_NAME." Registration <'.$strFrom.'>'."\r\n";
    $headers .= 'Reply-To: <'.$strFrom.'>'."\r\n";
	$strSubject = "Password Reset email";
	$strMailbody = "Hi " . $this->username . ",<br /><br />";
	$strMailbody .= "You Are Requested For a Passwoed Reset Link.";
	$strMailbody .= "<a href='".WEB_URL."/organization/reset_password.php?password_token=";
        $strMailbody .= $this->password_token;
	$strMailbody .= "'>Click Here To Reset Your Password</a>Thanks,<br />
    	".WEB_NAME."<br /><br />";
	$strMailbody .="If clicking the link does not work, just copy and paste the entire link into your browser. If you are still having problems, simply forward this email to ".EMAIL_SUPPORT." and we will do our best to help you.";
mail($strTo,$strSubject,$strMailbody,$headers);	
return true;
	}


}



function organization_account_activation(){
		// function used to mail to user and admin (user info and password)
    $strFrom=EMAIL_NO_REPLY;
    $strTo = $this->username;

    $strSubject="Activate your '".ORG_NAME."' account";
//     To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
//     Additional headers
    $headers .= 'From: ".ORG_NAME." Registration <'.$strFrom.'>'."\r\n";
    $headers .= 'Reply-To: <'.$strFrom.'>'."\r\n";

    $strMailbody = "Hi " . $this->username . ",<br /><br />";
    $strMailbody .="Thanks for registering with us at ".WEB_NAME.". We look forward to seeing you around the site.<br />";
    $strMailbody .="To complete your registration, you need to confirm that you received this email. To do simply click the link below:<br />";
    $strMailbody .="<a href='".WEB_URL."/organization/account_activation.php?activation_token=".$this->activation_token."'\" target='_blank'>click here to activate your account</a>";
    $strMailbody .="<br />Here is your password for ".WEB_URL." Site .<br> You can change it after you log into the site.<br /><br />";
   
    
    $strMailbody .="Your Username :". $this->username ."<br />";
    $strMailbody .="Your Password :". $this->password . "<br /><br /><br /><br /><br />
    Thanks,<br />
    ".WEB_NAME."<br /><br />";
    $strMailbody .="If clicking the link does not work, just copy and paste the entire link into your browser. If you are still having problems, simply forward this email to ".EMAIL_SUPPORT." and we will do our best to help you. <br/> <br/>
    Welcome to ".WEB_NAME."!";
    
    //Send the mail to the Registered User with activation link
    mail($strTo,$strSubject,$strMailbody,$headers);
	return true;

}




function organization_password_reset_by_admin($pass){
	$strSQL = "SELECT username,email FROM organizations WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        	$this->to = mysql_result($rsRES,0,'email');
        	$this->username = mysql_result($rsRES,0,'username');
		$strFrom=EMAIL_NO_REPLY;            	
		$strTo=$this->username;
		//     To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
//     Additional headers
    $headers .= 'From: ".ORG_NAME." Registration <'.$strFrom.'>'."\r\n";
    $headers .= 'Reply-To: <'.$strFrom.'>'."\r\n";        	
		$strSubject = "Password Reset By Admin";
        	$strMailbody = "Dear " . $this->username . ",<br /><br />";
        	$strMailbody .= "<br>Your Password Is reset By Admin.You Can Now login with your New password Mentioned Below<br />Password :";
        	$strMailbody .= $pass;
        	$strMailbody .= "<br />Thankyou.";
		$strMailbody .=	"<br />".WEB_NAME."<br /><br />";
        	mail($strTo,$strSubject,$strMailbody,$headers);
	return true;
        }
}
}
