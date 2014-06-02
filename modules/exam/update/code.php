<?php
$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
   if(isset($_POST["submit"]) && $_POST["submit"] == "submit"   )
	{	
		$myexam->name= $_POST["txtexam"]; 
				$myexam->id  = $_POST['h_id']; 
				$myexam->update();
		$_SESSION[SESSION_TITLE.'flash'] = "Exam Updated.";
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "exams.php";
		header( "Location: exams.php");
		exit();
				
	}
  if(isset($_GET["id"]) && $_GET["id"] > 0   ){
		$myexam->id = $_GET["id"];
		$myexam->get_detail(); 
  }
  
    if(isset($_GET["delid"]) && $_GET["delid"] > 0   ){ echo "deleted";
		$myexam->id = $_GET["delid"];
		$myexam->delete(); 
		header('location:exams.php');
  }
?>