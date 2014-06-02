<?php
class Timer
{
var  $hours = 0;  # Enter hours
var  $minutes = 0;  # Enter minutes
var  $seconds = 60;  # Enter seconds
var  $hours_in_seconds; 
var  $minutes_in_seconds;
var  $duration;

	public function __construct(){
	}
	
	function initialize_timer_variables()
	{
		
		if(!isset($_SESSION[SESSION_TITLE."duration"])){
			$_SESSION[SESSION_TITLE."duration"] = $this->duration;
			$_SESSION[SESSION_TITLE."start_time"] = mktime(date('G'),date('i'),date('s'),date('m'),date('d'),date('Y'));
			$_SESSION[SESSION_TITLE."end_time"] = mktime(date('G'),date('i'),date('s'),date('m'),date('d'),date('Y')) + $_SESSION[SESSION_TITLE."duration"];
		} 
		else{
			$current_time = mktime(date('G'),date('i'),date('s'),date('m'),date('d'),date('Y'));
			$_SESSION[SESSION_TITLE."duration"] = $_SESSION[SESSION_TITLE."end_time"] - $current_time;
		}
		
	}
		
	public function checkingTime()
	{
			$current_time = mktime(date('G'),date('i'),date('s'),date('m'),date('d'),date('Y'));
			if($current_time == $_SESSION[SESSION_TITLE."end_time"]){
				return true;
			}
			else{
				return false;
			}
	}
	
	


		
	function stop(){
		$_SESSION[SESSION_TITLE."duration"] = "";
		unset($_SESSION[SESSION_TITLE."duration"]);

		$_SESSION[SESSION_TITLE."start_time"] = "";
		unset($_SESSION[SESSION_TITLE."start_time"]);

		$_SESSION[SESSION_TITLE."end_time"] = "";
		unset($_SESSION[SESSION_TITLE."end_time"]);
	}
}
?>