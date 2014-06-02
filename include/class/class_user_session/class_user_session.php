<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserSession {
    var $connection;
    var $id = gINVALID;
    var $username	= "" ;
    var $password	= "";
	var $first_name 	= "";
    var $last_name		= "";
    var $email			= "";
    var $address		= "";
    var $occupation 	= "";
    var $user_status_id	= "";
    var $exam_ids       = "";
    

    var $error = false;
    var $error_number=gINVALID;
    var $error_description="";


    function __construct($username,$password,$connection)
    {
			$this->username =$username;
			$this->password =$password;
			$this->connection =$connection;
    }

    function login(){
          $strSQL = "SELECT U.* FROM users U WHERE U.username = '".mysql_real_escape_string($this->username);
          $strSQL .= "' AND U.password='".$this->password."' AND (U.user_status_id = '".USERSTATUS_ACTIVE."' OR U.user_status_id = '".USERSTATUS_IMPORTED."' OR U.user_status_id = '".USERSTATUS_MOBILE_REGISTRATION."')";
		//echo $strSQL;exit();
          $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
          if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->username = mysql_result($rsRES,0,'username');
                $this->email = mysql_result($rsRES,0,'email');
                $this->first_name = mysql_result($rsRES,0,'first_name');
                $this->last_name = mysql_result($rsRES,0,'last_name');
                $this->exam_ids = mysql_result($rsRES,0,'exam_ids');
		$this->user_status_id=mysql_result($rsRES,0,'user_status_id');
		$_SESSION[SESSION_TITLE.'user_status_id'] = $this->user_status_id;
		$_SESSION[SESSION_TITLE.'userid'] = $this->id;
                $_SESSION[SESSION_TITLE.'name'] = $this->first_name." ".$this->last_name;
          	$_SESSION[SESSION_TITLE.'username'] = $this->username;
                $_SESSION[SESSION_TITLE.'exam_ids'] = $this->exam_ids;
		$_SESSION[SESSION_TITLE.'user_type'] = REGISTERED_USER;
		if (!filter_var($this->username, FILTER_VALIDATE_EMAIL) && !is_numeric($this->username)){
		$_SESSION[SESSION_TITLE.'privilege'] ="NO";
		}
		return true;
          }
          else{
                $this->error_description = "Login Failed";
                return false;
          }
    }
	
	
    function check_login(){
		if ( isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0 && $this->id == $_SESSION[SESSION_TITLE.'userid'] && $_SESSION[SESSION_TITLE.'user_type'] == REGISTERED_USER ) {
			return true;
		}else{
			return false;
		}
    
	}

    function logout(){
        $chk = session_destroy();
        if ($chk == true){
            return true;
        }
        else{
                return false;
        }
    }


}
 
?>
