<?php
function answer_options($q_no,$options, $userkey = "", $answer = "", $option_images = "", $question_id)
{
	$array_options = array();$count_options=0;
	$array_option_images = array();$count_option_images=0;
	$class_wrong = 'class="wrong"';
	$class_right = 'class="right"';
	$class = "";
	if ($options != "") {
		$array_options = explode(DEFAULT_OPTION_DELIMITER, $options );
		$count_options =count($array_options); 
	}
	if ($option_images != "") {
		$array_option_images = explode(DEFAULT_OPTION_DELIMITER, $option_images );
		$count_option_images =count($array_option_images); 
	}

	$total_options = max($count_options,$count_option_images);

	if($total_options > 0 )
	{
		echo '<ul class="list">';
		for ($i = 0; $i < $total_options ; $i++)
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
					$user_checked_answer = ' <img src="images/selected.png" alt="Selected" title="You have selected this option"/>';
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
			if(array_key_exists($i,$array_option_images) and $array_option_images[$i] != ""){
				if(array_key_exists($i, $array_options)){
					$alt_image = $array_options[$i];
				}else{
					$alt_image = "";
				}
				echo '<li '.$class.'><span><img src="images/questions/'.$question_id."/".$array_option_images[$i].'"  alt="'.$alt_image.'" title="'.$alt_image.'"/>'.$user_checked_answer.'</span></li>';

			}
			elseif(array_key_exists($i,$array_options) and $array_options[$i] != ""){
				echo '<li '.$class.'><span>'.$array_options[$i].$user_checked_answer.'</span></li>';
			}else{
				//do nothing
			}
						
		}
		echo '</ul>';
	}
}



function answer_options_multiple($q_no,$options, $userkeys = "",$answerkeys="")
{
	$array_options = array();
	$class_wrong = 'class="wrong"';
	$class_right = 'class="right"';
	$class = "";
	if ($options != "") {
		$array_options = explode(DEFAULT_OPTION_DELIMITER, $options );
		$count_options =count($array_options); 
	}

	if($userkeys != ""){
		$user_checked = explode(DEFAULT_ANSWER_KEY_DELIMITER, $userkeys );
	}
	if($answerkeys != ""){
		$answers = explode(DEFAULT_ANSWER_KEY_DELIMITER, $answerkeys );
	}
	if ( $count_options > 0)
	{
		echo '<ul class="list">';
		for ($i = 0; $i < $count_options ; $i++)
		{
			$option_value = $i+1;$user_checked_answer="";
			if(count($user_checked)==0 || $user_checked[0] == gINVALID)//not attempted questions
			{
				if(in_array($option_value, $answers)){
					$class = $class_right;
				}
				else{
					$class = "";
				}
			}
			else
			{
				if(in_array($option_value,$user_checked)){
					$user_checked_answer = ' <img src="images/user_mark.png" alt="Selected" title="You have selected this option"/>';
					if(in_array($option_value,$answers)){
						$class = $class_right;
					}
					else{
						$class = $class_wrong;
					}
				}
				elseif(in_array($option_value,$answers)){
					$class = $class_right;	
				}
				else{
					$class = "";
				}	
			}
			echo '<li '.$class.'><span>'.$array_options[$i].$user_checked_answer.'</span></li>';
		}
		echo '</ul>';
	}


	
}

?>
