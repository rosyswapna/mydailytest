<?php
function get_passage($data, $passage_start_col) {
   $passage=$data[$passage_start_col];
    return $passage;
}
function get_image($data,$passage_image_start_col){
	$image=$data[$passage_image_start_col];
    return $image;
}


function get_answer($data, $answer_start_col,$no_of_answer_or_delimitter) {
	$answer_array=Array();
	$answer="";
	$number_of_answer=0;
	if (is_numeric($no_of_answer_or_delimitter)){

		$number_of_answer=$no_of_answer_or_delimitter;

		for ($i = 0; $i < $number_of_answer; $i++){
			$answer.=$data[$answer_start_col+$i];
			if($i< ($number_of_answer-1)){
				$answer.=DEFAULT_OPTION_DELIMITER;
			}
		}
		
	}else{
		$delimiter=$no_of_answer_or_delimitter;
		$answers=explode($delimitter, $data[$answer_start_col]);//by using answer delimitter
		$number_of_answer=count($answers);
		for ($i = 0; $i < $number_of_answer ; $i++){	
			$answer.=$answers[$i];
			if($i<count($answers)-1){
				$answer.=DEFAULT_OPTION_DELIMITER;
			}
		}
	}

	$answer_array['answer']=$answer;
	$answer_array['number_of_answer']=$number_of_answer;
    return $answer_array;
}



function get_options($data,$option_start_col,$number_of_option_or_delimitter,$answer_start_col,$answer,$shuffle=true) {
	$option_answerkey_array=Array();
	$options_string="";
	$answer_keys="";
	$answers=explode(DEFAULT_OPTION_DELIMITER , $answer);
	$number_of_answer=count($answers);
	if (is_numeric($number_of_option_or_delimitter)){
		$number_of_option=$number_of_option_or_delimitter;
		$keys=1;
		for ($option_index = 0; $option_index < $number_of_option; $option_index++)
		{
			$options[$option_index]=$data[$option_start_col+$option_index];
			
		}
		if($shuffle==true){
		shuffle($options);
		}
		for ($i = 0; $i <$number_of_option ; $i++)
		{	
			if($number_of_answer==1){
			if(trim($options[$i])==trim($data[$answer_start_col])){
				$answer_key_index=$i;
				$answer_keys=++$answer_key_index;
			}
			}else{
				for ($k = 0; $k < $number_of_answer; $k++){
					if(trim($options[$i])==trim($answers[$k])){
						$answer_key_index=$i;
						$answer_keys.=++$answer_key_index;
						if($i < ($number_of_option-1) && $keys < $number_of_answer){
						$answer_keys.=DEFAULT_ANSWER_KEY_DELIMITER;
						$keys++;
						}	
					}
					}
			}
			$options_string.=$options[$i];
			if($i<($number_of_option-1)){
				$options_string.=DEFAULT_OPTION_DELIMITER;
			}
		}
			
		}
		else{
		$keys=1;
		$delimiter=$number_of_option_or_delimitter;
		$options=explode($delimiter , $data[$option_start_col]);
		if($shuffle==true){
		shuffle($options);
		}
		for ($i = 0; $i <count($options); $i++)
		{	
			if($number_of_answer==1){
			if(trim($options[$i])==trim($data[$answer_start_col])){
			$answer_key_index=$i;
			$answer_keys=++$answer_key_index;
			}
			}else{			
			for ($k = 0; $k < $number_of_answer; $k++)
			{
			if(trim($options[$i])==trim($answers[$k])){
			$answer_key_index=$i;
			$answer_keys.=++$answer_key_index;
			if($i<(count($options)-1) && $keys<$number_of_answer){
			$answer_keys.=DEFAULT_ANSWER_KEY_DELIMITER;
			$keys++;
			}	
			}
			}
			}
			$options_string.=$options[$i];
			if($i<(count($options)-1)){
			$options_string.=DEFAULT_OPTION_DELIMITER;
			}
		
		}
		}
$option_answerkey_array['options']=$options_string;
$option_answerkey_array['answer_keys']=$answer_keys;
return $option_answerkey_array;

}
?>
