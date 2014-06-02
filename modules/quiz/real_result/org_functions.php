<?php

function array_avg_by_key(){
	$args = func_get_args();
	$arr = array_shift($args);
	$to_avg = is_array($args[0]) ? $args[0] : $args;
	$avg = 0;
	$count=0;
	if(is_array($arr) && count($arr) > 0){
		foreach ( $arr as $k ) {
			$avg = $avg+$k[$to_avg[0]];
			$count++;
		}

		if($count > 0){
			return $avg/$count;
		}else{
			return 0;
		}
	}else{
		return 0;
	}
}



function answer_options($q_no,$options, $selected = "", $answer ="")
{
	$array_options = array();
	$style_wrong_answer = ' style = "color:red" ';
	$style_right_answer = ' style = "color:green" ';
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
			if($selected == "" or $selected == -1){
				$option_selected = "";
					if($answer == $i){
						$style_answer = $style_right_answer;
					}
			}else{
				if($selected == $i){
					$option_selected = 'checked ="checked"'  ; 
						if($selected==$answer){ 
							$style_answer = $style_right_answer;
						}else{
							$style_answer = $style_wrong_answer;	
						}
				}else{
					$option_selected = "";
					if($answer == $i){
						$style_answer = $style_right_answer;
					}
				}
			}
		
		$name="ans_".$q_no;		$id="ans_".$q_no."_".$i;
		echo '<li'.$style_answer.'>'.$array_options[$i].'</li>';
			
			//options with radio buttons
			/*echo '<li'.$style_answer.'>
				<input type="radio"  disabled="disabled" class="answer_options" id="'.$id.'" name="'.$name.'"  value="'.$i.'" '.$option_selected.' > '.$array_options[$i].
			'</li>';*/
			
		}
		echo '</ol>';
	}
}



?>
