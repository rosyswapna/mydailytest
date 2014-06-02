<?php

$myquestion = new Question($myconnection);
$myquestion->connection = $myconnection;
$myquestion->id=$_GET["id"];
if(isset($_GET["id"]) && $_GET["id"] > 0) {
		$check = $myquestion->get_detail();
		
		if($check != false && $myquestion->share==1) {
			// do noting
			
		}else  {
			$_SESSION[SESSION_TITLE.'flash'] = "Invalid Quiz.</br>Please choose Demo Quiz from list.";
			header( "Location: index.php");
			exit();
			}

}else{
		$_SESSION[SESSION_TITLE.'flash'] = "Please choose Demo Quiz from list.";
		header( "Location: index.php");
		exit();
}







?>
