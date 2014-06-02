<?php
$myemail = new Email($myconnection);
$myemail->connection = $myconnection;

if(isset($_POST["submit_hidden"]))
{
	
	
				$myemail->to_email = EMAIL_FEEDBACK;
				$myemail->subject = "Feedback From ".$_POST["txtname"];
				$myemail->from_email = $_POST["txtemail"];
				$myemail->message = $_POST["txtmessage"];
				$myemail->send_mail();
				$_SESSION[SESSION_TITLE.'flash'] = " Thank you for your feedback. We will make use of these inputs to give you a better user experience.MDT Team.";
	header('Location:index.php');
	exit();
}
if (isset($_POST['captcha'])) {
	
		print $_SESSION[SESSION_TITLE.'security_code'];exit();
	
}

?>
