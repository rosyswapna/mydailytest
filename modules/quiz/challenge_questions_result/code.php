<?php
if(isset($_POST["h_id"]) && $_POST["h_id"] > 0) {
	$myquiz = new Quiz($myconnection);
	$myquiz->connection = $myconnection;
	
	$myquestion = new Question($myconnection);
	$myquestion->connection = $myconnection;
	$myquestion->id=$_POST["h_id"];	
	$check = $myquestion->get_detail();
	
	
	if($check != false){

		$correct_answer = $myquestion->answer_keys;
		$user_answer="";
		if(isset($_POST["ans_".$myquestion->id])){
			$user_answer=$_POST["ans_".$myquestion->id];
		}
			switch($user_answer)
			{
				case 1:
					$user_answer = "A";
				break;
				case 2:
					$user_answer = "B";
				break;
				case 3:
					$user_answer = "C";
				break;
				case 4:
					$user_answer = "D";
				break;
				case 5:
					$user_answer = "E";
				break;
				case 6:
					$user_answer = "F";
				break;
				case 7:
					$user_answer = "G";
				break;	
																							
				default:
					$user_answer = "";	
				break;
			}
			switch($correct_answer)
			{
				case 1:
					$correct_answer = "A";
				break;
				case 2:
					$correct_answer = "B";
				break;
				case 3:
					$correct_answer = "C";
				break;
				case 4:
					$correct_answer = "D";
				break;
				case 5:
					$correct_answer = "E";
				break;
				case 6:
					$correct_answer = "F";
				break;
				case 7:
					$correct_answer = "G";
				break;	
																							
				default:
					$correct_answer = "";	
				break;
			}			
		
		if(trim($user_answer) == trim($correct_answer)){
			
			$result =  "<p><strong>You Marked - ".$user_answer."</strong></p>";
			$result .= "<p><strong>The Correct Answer is - ".$correct_answer. "</strong></p>"; 
			$result .= "<p><strong>Entered Anwser is Correct.</strong></p>";
		}else{
			
			$result ="<p><strong>You Marked - ".$user_answer."</strong></p>";
			$result .= "<p><strong> The Correct Answer is - ".$correct_answer. "</strong></p>"; 
		}

	}else{
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
