<?php
$mysection = new Section($myconnection);
$mysection->connection = $myconnection;
if(isset($_POST["submit"]) && $_POST["submit"] == "submit"   )
{	
		$mysection->name= $_POST["txtsection"]; 
		$mysection->id  = $_POST['h_id']; 
		$mysection->update();
		$_SESSION[SESSION_TITLE.'flash'] = "Section Updated.";
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "sections.php";
		header( "Location: sections.php");
		exit();
				
}
if(isset($_GET["id"]) && $_GET["id"] > 0   ){
$mysection->id = $_GET["id"];
$mysection->get_detail();
}
    if(isset($_GET["delid"]) && $_GET["delid"] > 0   ){
		$mysection->id = $_GET["delid"];
		$mysection->delete(); 
		header('location:sections.php');
  }
?>