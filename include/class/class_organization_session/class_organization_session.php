<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Organization_session {
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
          $strSQL = "SELECT O.* FROM organizations O WHERE O.username = '".mysql_real_escape_string($this->username);
          $strSQL .= "' AND O.password='".$this->password."' AND (O.organization_status_id = '".USERSTATUS_ACTIVE."' OR O.organization_status_id = '".USERSTATUS_IMPORTED."')";
		//echo $strSQL;exit();
          $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
          if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->username = mysql_result($rsRES,0,'username');
                $this->email = mysql_result($rsRES,0,'email');
                $this->name = mysql_result($rsRES,0,'name');
                $this->type = mysql_result($rsRES,0,'organization_type_id');
		$this->organization_status_id=mysql_result($rsRES,0,'organization_status_id');
		$_SESSION[SESSION_TITLE.'organization_status_id'] = $this->organization_status_id;
		$_SESSION[SESSION_TITLE.'userid'] = $this->id;
                $_SESSION[SESSION_TITLE.'name'] = $this->name;
          	$_SESSION[SESSION_TITLE.'username'] = $this->username;
		if($_SESSION[SESSION_TITLE.'organization_status_id']==USERSTATUS_IMPORTED){
		$_SESSION[SESSION_TITLE.'user_type'] = REGISTERED_USER_UNVERIFIED;
		}else{				
		$_SESSION[SESSION_TITLE.'user_type'] = REGISTERED_ORGANISATION;
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
