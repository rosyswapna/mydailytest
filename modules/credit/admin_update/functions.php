<?php

function get_quiz_name($usertestid)
{
	$sql = "SELECT QZ.name FROM user_tests UT LEFT JOIN quizzes QZ ON QZ.id = UT.quiz_id WHERE UT.id = '".$usertestid."' ";
	$result = mysql_query($sql) or die(mysql_error().$sql);
	$row = mysql_fetch_assoc($result);
	if(mysql_num_rows($result) > 0){
		return $row['name'];
	}
	else{
		return false;
	}

}

?>