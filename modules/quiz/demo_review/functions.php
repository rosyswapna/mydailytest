<?php
function answer_options($q_no,$options, $answer_keys, $user_answer_key="" )
{
	$array_options = array();

	$class_wrong = ' 	class="wrong" ';
	$class_right = ' class="right" ';

	$style_answer = "";
	$option_selected = "";
	if ($options != "") {
		$array_options = explode(DEFAULT_OPTION_DELIMITER, $options );
		$count_options =count($array_options); 
	}


	if ( $count_options > 0){
		echo '<ol class="options_list" type="A">';
		for ($i = 0; $i < $count_options ; $i++){
			$style_answer = "";	
			if($i+1 == $answer_keys ){
				$style_answer = $class_right;
			}
		
			if( trim($user_answer_key) !="" &&  $i+1 == $user_answer_key && $user_answer_key != $answer_keys ){
				$style_answer = $class_wrong;
			}		

		
		$name="ans_".$q_no;		$id="ans_".$q_no."_".$i;
		echo '<li'.$style_answer.'>'.$array_options[$i].'</li>';
		}
		echo '</ol>';
	}
}


?>
