<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Agent_session {
    var $connection;
    var $id = gINVALID;
    var $username	= "" ;
    var $password	= "";
	var $first_name 	= "";
    var $last_name		= "";
    var $email			= "";
    var $address		= "";
    var $occupation 	= "";
    var $agent_status_id	= "";
    

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
          $strSQL = "SELECT O.* FROM agents O WHERE O.username = '".mysql_real_escape_string($this->username);
          $strSQL .= "' AND O.password='".$this->password."' AND (O.agent_status_id = '".USERSTATUS_ACTIVE."')";
		//echo $strSQL;exit();
          $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
          if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->username = mysql_result($rsRES,0,'username');
                $this->email = mysql_result($rsRES,0,'email');
                $this->name = mysql_result($rsRES,0,'name');
                
		$this->agent_status_id=mysql_result($rsRES,0,'agent_status_id');
		$_SESSION[SESSION_TITLE.'user_status_id'] = $this->agent_status_id;
		$_SESSION[SESSION_TITLE.'userid'] = $this->id;
                $_SESSION[SESSION_TITLE.'name'] = $this->name;
          	$_SESSION[SESSION_TITLE.'username'] = $this->username;
			$_SESSION[SESSION_TITLE.'user_type'] = REGISTERED_AGENT;
		
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
