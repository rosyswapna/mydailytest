<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Organization {
    var $connection;
    var $id 			= gINVALID;
    var $username		= "";
    var $password		= "";
    var $organization_name 	= "";
    var $email			= "";
    var $address		= "";
    var $organization_type_id 	= "";
    var $organization_status_id	= "";
    var $password_token="" ; 
	var $activation_token="" ; 
    var $newpasswd=""; 
	var $web_url="";
	var $name 	= "";
	var $phone	= "";	
	var $action = "";
	var $handle = "";	 

    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";


    function __construct()
    {

    }

    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
		
              $strSQL = "INSERT INTO organizations(username,password,name,email,phone,address,web_url,organization_type_id,organization_status_id,activation_token) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->username))."','";
              $strSQL .= md5(addslashes(trim($this->password)))."','";
              $strSQL .= addslashes(trim($this->name))."','";
              $strSQL .= addslashes(trim($this->email))."','";
	      $strSQL .= addslashes(trim($this->phone))."','";
              $strSQL .= addslashes(trim($this->address))."','";
              $strSQL .= addslashes(trim($this->web_url))."','";
	      $strSQL .= addslashes(trim($this->organization_type_id))."','";
              $strSQL .= addslashes(trim($this->organization_status_id))."','";
	      $strSQL .= addslashes(trim($this->activation_token))."')";
	      $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();
		    $this->error_description = "Registration Successfull.Check Your Email For Account Activaton Link.If You Do NOt Recieve Any Email Please Contact Our Server Administrator.Thank You.";
                    return true;
              }
              else{
                $this->error_description = "Registration Unsuccessfull.Please Try Again.";
                return false;
              }

        }
        elseif($this->id > 0 ) {
            $strSQL = "UPDATE organizations SET ";
	    if($this->username!=''){
	    $strSQL .= "username = '".addslashes(trim($this->username))."',";
	    }
            $strSQL .= "name = '".addslashes(trim($this->name))."',";
            $strSQL .= "organization_type_id = '".addslashes(trim($this->organization_type_id))."',";
	    if($this->password!=''){	    
	    $strSQL .= "password = '".addslashes(trim($this->password))."',";
	    }
	    if($this->organization_status_id!=''){
	    if($this->organization_status_id==USERSTATUS_IMPORTED){
	    $strSQL .= "organization_status_id = '".USERSTATUS_ACTIVE."',";
	    }else{
            $strSQL .= "organization_status_id = '".addslashes(trim($this->organization_status_id))."',";
	    }
	    }
	    $strSQL .= "web_url = '".addslashes(trim($this->web_url))."',";
            $strSQL .= "phone = '".addslashes(trim($this->phone))."',";
            $strSQL .= "email = '".addslashes(trim($this->email))."',";
            $strSQL .= "contact_phone = '".addslashes(trim($this->contact_phone))."',";
            $strSQL .= "address = '".addslashes(trim($this->address))."'";
	    $strSQL .= " WHERE id = ".$this->id;
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
		$this->error_description = "Updated data Successfuly";                    
		return true;
            }
            else{
                $this->error_description = "Update data Failed";
                return false;
            }
        }

    }



    function change_password($newpasswd,$oldpasswd){
                    $strSQL3 = "UPDATE organizations SET ";
                    $strSQL3 .= "password = NULL";
                    $strSQL3 .= " WHERE id = '" . $this->id ."' AND password = '".mysql_real_escape_string($oldpasswd)."'";
		    $rsRES3 = mysql_query($strSQL3,$this->connection) or die(mysql_error(). $strSQL3 );
		    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL = "UPDATE organizations SET ";
                    $strSQL .= "password = '" .mysql_real_escape_string($newpasswd). "' ";
                    $strSQL .= "WHERE id = '" . $this->id . "'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
                        return true;
                    }
                    else{
                        return false;
                        $this->error_description = "Incorrect password";
                    }
    }
}
    function exist(){
        $strSQL = "SELECT 1 FROM organizations WHERE username = '".$this->username."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            return true;
        }
        else{
            return false;
        }
    }



    function get_detail(){
        $strSQL = "SELECT * FROM organizations WHERE id = ".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->username = mysql_result($rsRES,0,'username');
                $this->name = mysql_result($rsRES,0,'name');
                $this->organization_type_id= mysql_result($rsRES,0,'organization_type_id');
		$this->password = md5(mysql_result($rsRES,0,'password'));
                $this->organization_status_id= mysql_result($rsRES,0,'organization_status_id');
                $this->email = mysql_result($rsRES,0,'email');
                $this->phone = mysql_result($rsRES,0,'phone');
		$this->contact_phone = mysql_result($rsRES,0,'contact_phone');
                $this->address = mysql_result($rsRES,0,'address');
                $this->web_url = mysql_result($rsRES,0,'web_url');
                return true;
        }
        else{
            return false;
        }
    }




function get_array(){
        $organizations = array();
        $strSQL = "SELECT id,username FROM organizations ORDER BY username";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$username) = mysql_fetch_row($rsRES) ){
          $organizations[$id]["name"] = $username;
        }
        return $organizations;
        }
        else{
        $this->error_number = 4;
        $this->error_description="Can't list users";
        return false;
        }
}







function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,username,name,organization_type_id,organization_status_id,email,phone FROM organizations";
	if($this->username!=''|| $this->email!='' || $this->name!='' ||	$this->phone!=''|| $this->organization_status_id!=''|| $this->organization_type_id!=''){
	$strSQL .= " WHERE";
	
	if($this->username!=''){
            $strSQL .= " username LIKE '%".addslashes(trim($this->username))."%'";
	}
	if($this->email!='' && $this->username!='' ){
		    $strSQL .= " AND email LIKE '%".addslashes(trim($this->email))."%'";
	}else{
	if($this->email!=''){
		    $strSQL .= " email LIKE '%".addslashes(trim($this->email))."%'";
	}
	}
	if($this->name!='' && ($this->email!='' || $this->username!='')){
		    $strSQL .= " AND name LIKE '%".addslashes(trim($this->name))."%'";
	 }else{
	if($this->name!=''){
		    $strSQL .= " name LIKE '%".addslashes(trim($this->name))."%'";
	}
	}
	if($this->phone!='' &&($this->name!='' || $this->email!='' || $this->username!='')){
		    $strSQL .= " AND phone LIKE '%".addslashes(trim($this->phone))."%'";
	 }else{
	if($this->phone!=''){
		    $strSQL .= " phone LIKE '%".addslashes(trim($this->phone))."%'";
	}
	}
	if($this->organization_type_id!='' && ($this->phone!='' || $this->name!='' || $this->email!='' || $this->username!='')){
		    $strSQL .= " AND organization_type_id = '".addslashes(trim($this->organization_type_id))."'";
	 }else{
	if($this->organization_type_id!=''){
		    $strSQL .= " organization_type_id = '".addslashes(trim($this->organization_type_id))."'";
	}
	}
	if($this->organization_status_id!='' && ($this->organization_type_id!='' || $this->phone!='' || $this->name!='' || $this->email!='' || $this->username!=''))	{
		    $strSQL .= " AND organization_status_id = '".addslashes(trim($this->organization_status_id))."'";
	 }else{
	if($this->organization_status_id!=''){
		    $strSQL .= " organization_status_id = '".addslashes(trim($this->organization_status_id))."'";
	}
	}
	
         $strSQL .= " ORDER BY username";
	}

		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
				
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }



		    while ( list ($id,$username,$name,$organization_type_id,$organization_status_id,$email,$phone) = mysql_fetch_row($rsRES) ){
		          $limited_data[$i]["id"] = $id;
		          $limited_data[$i]["username"] = $username;
		          $limited_data[$i]["name"] = $name;
		          $limited_data[$i]["organization_type_id"] = $organization_type_id;
			  $limited_data[$i]["organization_status_id"] = $organization_status_id;
		          $limited_data[$i]["email"] = $email;
			  $limited_data[$i]["phone"]=$phone;
		          $i++;
		    }
        	return $limited_data;
        }
        else{
        	return false;
        }
    }






function get_list_array_organization_types(){
        $types = array();
        $strSQL = "SELECT id,name FROM organization_types ORDER BY name";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
              $types[$id] = $name;
        }
        return $types;
        }
        else{
        $this->error_number = 4;
      //  $this->error_description="Can't list types";
        return false;
        }
}

function get_list_array_organization_statuses(){
        $organization_statuses = array();
        $strSQL = "SELECT id,name FROM organization_statuses ORDER BY name";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
              $organization_statuses[$id] = $name;
          }
        return $organization_statuses;
        }
        else{
        $this->error_number = 4;
        //$this->error_description="Can't list statuses";
        return false;
        }
}


	

function get_list_array_organizations(){
        $organizations = array();$i=0;
        $strSQL = "SELECT id,name FROM organizations ORDER BY name";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
              $organizations[$i]["id"] = $id;
             $organizations[$i]["name"] = $name;
              $i++;

        }
        return $organizations;
        }
        else{
        $this->error_number = 4;
        //$this->error_description="Can't list statuses";
        return false;
        }
}





    
function delete(){
    if($this->id > 0 ) {
        $strSQL = " DELETE FROM organizations WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't delete this User";
            return  false;
        }
    }
}



function check_email(){
	$strSQL = "SELECT id FROM organizations WHERE username = '".$this->username."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		$password_token=md5(time());
		$strSQL = "UPDATE organizations SET ";
                    $strSQL .= "password_token = '$password_token'";
                    $strSQL .= "WHERE username = '" . $this->username. "'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		    return $password_token;
        }
        else{
            return false;
        }

}

function reset_password($newpasswd,$password_token){
		    $strSQL1 = "SELECT id FROM organizations WHERE password_token ='".$password_token."'";
		    $rsRES1 = mysql_query($strSQL1,$this->connection) or die(mysql_error(). $strSQL1 );
		    if ( mysql_num_rows($rsRES1) > 0 ){
                    $this->id = mysql_result($rsRES1,0,'id');
                    $strSQL3 = "UPDATE organizations SET ";
                    $strSQL3 .= "password = NULL";
                    $strSQL3 .= " WHERE id = '" . $this->id ."'";
		    $rsRES3 = mysql_query($strSQL3,$this->connection) or die(mysql_error(). $strSQL3 );
		    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL = "UPDATE organizations SET ";
                    $strSQL .= "password = '" .mysql_real_escape_string($newpasswd). "' ";
                    $strSQL .= "WHERE password_token = '" . $password_token . "'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL2 = "UPDATE organizations SET ";
                    $strSQL2 .= "password_token = 'NULL' ";
                    $strSQL2 .= "WHERE id = '" . $this->id . "'";
                    $rsRES2 = mysql_query($strSQL2,$this->connection) or die(mysql_error(). $strSQL2 );
                    return true;

                    }
                    else{
                        return false;
                        $this->error_description = "Incorrect Token";
                    }
		 }
		else{
			return false;
               		$this->error_description = "Incorrect Token";


		}
		}else{
			return false;
               		$this->error_description = "Incorrect Token";


		}	
    }






function activate_account($activation_token){
		    $strSQL1 = "SELECT id FROM organizations WHERE activation_token ='".$activation_token."'";
		    $rsRES1 = mysql_query($strSQL1,$this->connection) or die(mysql_error(). $strSQL1 );
		    if ( mysql_num_rows($rsRES1) > 0 ){
                    $this->id = mysql_result($rsRES1,0,'id');
                    $strSQL = "UPDATE organizations SET ";
                    $strSQL .= "organization_status_id = '".USERSTATUS_ACTIVE."' ";
                    $strSQL .= "WHERE activation_token = '" .$activation_token. "'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL2 = "UPDATE organizations SET ";
                    $strSQL2 .= "activation_token = 'NULL' ";
                    $strSQL2 .= "WHERE id = '" . $this->id . "'";
                    $rsRES2 = mysql_query($strSQL2,$this->connection) or die(mysql_error(). $strSQL2 ); 
                    return true;

                    }
                    else{
                        return false;
                        $this->error_description = "Incorrect Token";
                    }
		 }
		else{
			return false;
			$this->error_description = "Incorrect Token";
		}

}



function change_organization_password(){
                    $strSQL3 = "UPDATE organizations SET ";
                    $strSQL3 .= "password = NULL";
                    $strSQL3 .= " WHERE id = '" . $this->id ."'";
		    $rsRES3 = mysql_query($strSQL3,$this->connection) or die(mysql_error(). $strSQL3 );
		    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL = "UPDATE organizations SET ";
                    $strSQL .= "password = '" .mysql_real_escape_string($this->password). "'";
                    $strSQL .= " WHERE id = '" . $this->id ."'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
                        return true;
                    }
                    else{
                        return false;
                        $this->error_description = "Not Changed";
                    }
   		   }else{
                        return false;
                        $this->error_description = "Not Changed";
                    }
}




function import_user_csv(){

do { 
        if ($data[0]) { 
            mysql_query("INSERT INTO users (username, password,first_name, last_name,email,phone,address, occupation, user_status_id,activation_token) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".md5(addslashes($data[1]))."', 
                    '','','','','','','".USERSTATUS_IMPORTED."','' 
                ) 
            "); 
        } 
    } while ($data = fgetcsv($this->handle,1000,",","'")); 

return true;
}


    function get_list_array()
    {
        $organization = array();$i=0;
        
        $strSQL = "SELECT  * FROM organizations";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $organization[$i]["id"] = $row["id"];
                $organization[$i]["name"] = $row["name"];
                $i++;
            }
            return $organization;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Organizations";
        return false;
        }
    }

    function get_organizations()
    {
        $organizations = array();$i=0;
        
        $strSQL = "SELECT id,name FROM organizations ORDER BY id DESC";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $organizations[$i]["id"] = $row["id"];
                $organizations[$i]["name"] = $row["name"];
                $i++;
            }
            return $organizations;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list organizations";
        return false;
        }
    }



}

?>
