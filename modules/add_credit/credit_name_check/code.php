<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$name = $_REQUEST["name"];

$mycreditplan = new CreditPlan();
    $mycreditplan->connection = $myconnection;
    $mycreditplan->name = $name;
    //check user exist or not
    $chk = $mycreditplan->exist();
    if ( $chk == true ){
        echo 0;
    }else{
   		echo 1;
	}
?>
