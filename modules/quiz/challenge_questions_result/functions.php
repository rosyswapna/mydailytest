<?php
function answer_options($q_no,$options, $userkey = "", $answer = "")
{
	$array_options = array();
	$class_wrong = '"';
	$class_right = '"';
	$class = "";
	if ($options != "") {
		$array_options = explode(DEFAULT_OPTION_DELIMITER, $options );
		$count_options =count($array_options); 
	}
	if ( $count_options > 0)
	{
		echo '<ul class="list">';
		for ($i = 0; $i < $count_options ; $i++)
		{
			$option_value = $i+1;$user_checked_answer = "";
			if($userkey == "" || $userkey == gINVALID)
			{
				if($option_value == $answer){
					$class = $class_right;
				}
				else{
					$class = "";
				}
			}
			else
			{
				if($option_value == $userkey)
				{
					$user_checked_answer = '';
					if($userkey == $answer){
						$class = $class_right;
					}
					else{
						$class = $class_wrong;
					}
				}
				elseif ($option_value == $answer) {
					$class = $class_right;
				}
				else {
					$class = "";
				}
			}
			echo '<li '.$class.'><span>'.$array_options[$i].$user_checked_answer.'</span></li>';
						
		}
		echo '</ul>';
	}
}


?>
