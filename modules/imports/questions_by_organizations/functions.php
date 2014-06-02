<?php
function get_question($data, $question_start_col) {
   $question=$data[$question_start_col];
    return $question;
}

function get_image($data,$question_image_start_col){
	$image=$data[$question_image_start_col];
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



function get_options($data,$option_start_col,$number_of_option_or_delimitter,$image_start_col,$number_of_image_or_delimiter,$answer_start_col,$answer,$shuffle=true) {
	$option_answerkey_array=Array();
	$options_string="";
	$image_string="";
	$answer_keys="";
	$answers=explode(DEFAULT_OPTION_DELIMITER , $answer);
	$number_of_answer=count($answers);
		
//extract option images

	if (is_numeric($number_of_image_or_delimiter)){
		$number_of_image=$number_of_image_or_delimiter;
		
		for ($image_index = 0; $image_index < $number_of_image; $image_index++)
		{
			$images[$image_index]=$data[$image_start_col+$image_index];
			
		}
		}
		else{
		$delimiter=$number_of_image_or_delimiter;
		$images=explode($delimiter , $data[$image_start_col]);
		}

		
//end-option images

	if (is_numeric($number_of_option_or_delimitter)){
			$number_of_option=$number_of_option_or_delimitter;
			$keys=1;
			for ($option_index = 0; $option_index < $number_of_option; $option_index++)
			{
				$options[$option_index]=$data[$option_start_col+$option_index];
			
			}
			for ($k = 0; $k < $number_of_option; $k++){	
		
				$options_and_images_for_shuffle[$k]=$options[$k].DEFAULT_OPTION_DELIMITER.$images[$k];		
		
			}				
		
			if($shuffle==true){
			shuffle($options_and_images_for_shuffle);
			}

			for ($k = 0; $k < $number_of_option; $k++){	
		
				$exploded_option_and_images=explode(DEFAULT_OPTION_DELIMITER,$options_and_images_for_shuffle[$k]);		
				$i = 0; 	
				$options[$k]=$exploded_option_and_images[$i];
				$i++;
				$images[$k]=$exploded_option_and_images[$i];
			
				
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
				for ($k = 0; $k < count($options); $k++){	
		
					$options_and_images_for_shuffle[$k]=$options[$k].DEFAULT_OPTION_DELIMITER.$images[$k];		
		
				}				
		
				if($shuffle==true){
				shuffle($options_and_images_for_shuffle);
				}

				for ($k = 0; $k < count($options); $k++){	
		
					$exploded_option_and_images=explode(DEFAULT_OPTION_DELIMITER,$options_and_images_for_shuffle[$k]);		
					$i = 0; 	
					$options[$k]=$exploded_option_and_images[$i];
					$i++;
					$images[$k]=$exploded_option_and_images[$i];
			
				
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
		
		for ($k = 0; $k < count($images); $k++){
			$image_string.=$images[$k];
			if($k<(count($images)-1)){
						$image_string.=DEFAULT_OPTION_DELIMITER;
			}
		}

	
$option_answerkey_images_array['options']=$options_string;
$option_answerkey_images_array['answer_keys']=$answer_keys;
$option_answerkey_images_array['images']=$image_string;
return $option_answerkey_images_array;

}
?>
