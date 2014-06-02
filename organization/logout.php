<?php
session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/conf/conf.php');
require(ROOT_PATH.'include/class/class_organization_session/class_organization_session.php');
 

$myorganization = new Organization_session("","","");
$chk = $myorganization->logout();
if ($chk == true){
    header("Location: ../index.php");
    exit();
}
?>
