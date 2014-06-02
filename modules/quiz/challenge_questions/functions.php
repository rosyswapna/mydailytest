<?php
function answer_options($q_no,$options, $selected = "")
{
	$array_options = array();
	$option_selected = "";
	if ($options != "") {
		$array_options = explode(DEFAULT_OPTION_DELIMITER, $options );
		$count_options =count($array_options); 
	}
	if ( $count_options > 0){
		echo '<ol class="options_list" type="A">';
		for ($i = 0; $i < $count_options ; $i++)
		{	
			$option_value = $i+1;
			if($selected == "" || $selected == -1){
				$option_selected = "";
			}else{
				if($selected == $i){
					$option_selected = 'checked ="checked"'; 
				}else{
					$option_selected = "";
				}
			}
		$name="ans_".$q_no;		$id="ans_".$q_no."_".$option_value;
		echo '<li><span>
				<input type="radio" class="answer_options" id="'.$id.'" name="'.$name.'"  value="'.$option_value.'" '.$option_selected.' > '.$array_options[$i].
			'</span>
			</li>';
			
		}
		echo '</ol>';
	}
}
?>
