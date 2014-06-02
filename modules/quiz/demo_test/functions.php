<?php
function answer_options($q_no,$options, $selected = "", $option_images = "", $question_id)
{	
	$array_options = array();$count_options=0;
	$array_option_images = array();$count_option_images=0;
	$option_selected = "";
	if ($options != "") {
		$array_options = explode(DEFAULT_OPTION_DELIMITER, $options );
		$count_options =count($array_options); 
	}

	if ($option_images != "") {
		$array_option_images = explode(DEFAULT_OPTION_DELIMITER, $option_images );
		$count_option_images =count($array_option_images); 
	}

	$total_options = max($count_options,$count_option_images);

	if($total_options > 0 ){
		echo '<ul class="list">';
		for ($i = 0; $i < $total_options ; $i++){
			
			$option_value = $i+1;	
			if($selected == "" || $selected == -1){
				$option_selected = "";
			}
			else{
				if($selected == $option_value){
					$option_selected = 'checked ="checked"'; 
				}else{
					$option_selected = "";
				}
			}
			$name="ans_".$q_no;		$id="ans_".$q_no."_".$option_value;

			if(array_key_exists($i,$array_option_images) and $array_option_images[$i] != ""){
				if(array_key_exists($i, $array_options)){
					$alt_image = $array_options[$i];
				}else{
					$alt_image = "";
				}
				echo '<li><input type="radio" class="answer_options" id="'.$id.'" name="'.$name.'"  value="'.$option_value.'" '.$option_selected.'/>
				 <span><img src="images/questions/'.$question_id."/".$array_option_images[$i].'"  alt="'.$alt_image.'" title="'.$alt_image.'"/>
				 </span>
				 </li>';
			}
			elseif(array_key_exists($i,$array_options) and $array_options[$i] != ""){

			
				echo '<li><input type="radio" class="answer_options" id="'.$id.'" name="'.$name.'"  value="'.$option_value.'" '.$option_selected.'/>
				 <span>'.$array_options[$i].'</span>
				 </li>';
			}
			else{
				//do nothing
			}			
		}
		echo '</ul>';
	}
}

function answer_options_multiple($q_no,$options, $userkeys = "", $option_images = "",$question_id)
{
	$array_options = array();$count_options=0;
	$array_option_images = array();$count_option_images=0;
	$attributes = "";
	if ($options != "") {
		$array_options = explode(DEFAULT_OPTION_DELIMITER, $options );
		$count_options =count($array_options); 
	}

	if ($option_images != "") {
		$array_option_images = explode(DEFAULT_OPTION_DELIMITER, $option_images );
		$count_option_images =count($array_option_images); 
	}
	$total_options = max($count_options,$count_option_images);

	if($userkeys != ""){
		$user_checked = explode(DEFAULT_ANSWER_KEY_DELIMITER, $userkeys );
	}

	//print options
	if($total_options > 0){
		echo '<ul class="list">';		
		$i=0;
		while($count_options > $i)
		{
			$check_value=$i+1;
			if(in_array($check_value, $user_checked)){
				$attributes = 'checked="checked"';
			}
			else{
				$attributes = "";
			}
			$attributes .= 'name = "ans_'.$q_no.'[]" class = "answer_options_multiple"';

			if(array_key_exists($i,$array_option_images) and $array_option_images[$i] != ""){
				if(array_key_exists($i, $array_options)){
					$alt_image = $array_options[$i];
				}else{
					$alt_image = "";
				}
				echo '<li><input type="checkbox" value="'.$check_value.'" '.$attributes.'/> <span>
				<img src="images/questions/'.$question_id."/".$array_option_images[$i].'"  alt="'.$alt_image.'" title="'.$alt_image.'"/>
				</span></li>';
			}
			elseif(array_key_exists($i,$array_options) and $array_options[$i] != ""){
				echo '<li><input type="checkbox" value="'.$check_value.'" '.$attributes.'/> <span>'.$array_options[$i].'</span></li>';
			}else{
				//do nothing
			}

			$i++;
		}
		echo '</ul>';
	}
}


function get_user_key_data_array($post)
{
	$dataArray = array();
	if(count($post) > 0)
	{
		foreach ($post as $key => $value) //search for user key checked
		{
			if(substr_count($key, "ans_") > 0)
			{
				$list = explode("_", $key);$user_key="";
				$index = $list[1];
				if(is_array($value)){
					foreach ($value as $key1 => $value2) {
						$user_key .= $value2."," ;
					}
					$user_key = substr($user_key, 0, -1);
				}
				else{
					$user_key = $value;
				}
				$dataArray[$index] = $user_key;			
			}
		}
	}
	return $dataArray;
}
?>
