<?php
$myset = new Set($myconnection);
$myset->connection = $myconnection;
   if(isset($_POST["submit"]) && $_POST["submit"] == "submit"   )
	{	
		$myset->name= $_POST["txtset"]; 
				$myset->id  = $_POST['h_id']; 
				$myset->update();
		$_SESSION[SESSION_TITLE.'flash'] = "Set Updated.";
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "set.php";
		header( "Location: set.php");
		exit();
				
	}
  if(isset($_GET["id"]) && $_GET["id"] > 0   ){
		$myset->id = $_GET["id"];
		$myset->get_detail(); 
  }
  
    if(isset($_GET["delid"]) && $_GET["delid"] > 0   ){
		$myset->id = $_GET["delid"];
		$myset->delete(); 
		header('location:sets.php');
  }
?>