<?php
function answer_options($q_no,$options)
{
	$array_options = array();
	if ($options != "") {
		$array_options = explode(DEFAULT_OPTION_DELIMITER, $options );
		$count_options =count($array_options); 
	}

	if ( $count_options > 0){
		echo '<ul class="list">';
		for ($i = 0; $i < $count_options ; $i++){	
			echo '<li><span>'.$array_options[$i].'</span></li>';
		}
		echo '</ul>';
	}
}


?>
