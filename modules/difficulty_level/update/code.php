<?php
$mydifficultylevel = new DifficultyLevel($myconnection);
$mydifficultylevel->connection = $myconnection;
	if(isset($_POST["submit"]) && $_POST["submit"] == "submit"   )
		{	
				$mydifficultylevel->name= $_POST["txtdiff"]; 
				$mydifficultylevel->id  = $_POST['h_id']; 
				$mydifficultylevel->update();
				$_SESSION[SESSION_TITLE.'flash'] = "Difficulty Level Updated.";
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "difficulty_levels.php";
				header( "Location: difficulty_levels.php");
				exit();
				
		}
	if(isset($_GET["id"]) && $_GET["id"] > 0   ){
		$mydifficultylevel->id = $_GET["id"];
		$mydifficultylevel->get_detail(); 
	}
	if(isset($_GET["delid"]) && $_GET["delid"] > 0   ){
			$mydifficultylevel->id = $_GET["delid"];
			$mydifficultylevel->delete(); 
			header('location:difficulty_levels.php');
  		}
?>