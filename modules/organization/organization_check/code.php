<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$username = mysql_real_escape_string($_POST['username']);

$myorganization = new Organization();
    $myorganization->connection = $myconnection;
    $myorganization->username = $username;
    //check user exist or not
    $chk = $myorganization->exist();
    if ( $chk == true ){
         echo 0;
    }else{
   echo 1;
	}
?>
