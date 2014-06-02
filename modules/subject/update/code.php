<?php
$mysubject = new Subject($myconnection);
$mysubject->connection = $myconnection;
if(isset($_POST["submit"]) && $_POST["submit"] == "submit"   )
{	
		$mysubject->name= $_POST["txtsubject"]; 
		
					
				
				$mysubject->id  = $_POST['h_id']; 
				$mysubject->update();
		$_SESSION[SESSION_TITLE.'flash'] = "Subject Updated.";
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "subjects.php";
		
		header( "Location:" .$current_url);
		exit();
				
}
if(isset($_GET["id"]) && $_GET["id"] > 0   ){
$mysubject->id = $_GET["id"];
$mysubject->get_detail();
}
 		if(isset($_GET["delid"]) && $_GET["delid"] > 0   ){
			$mysubject->id = $_GET["delid"];
			$mysubject->delete(); 
			header('location:subjects.php');
  		}
?>