<?php
	
	$myquiz = new Quiz($myconnection);
	$myquiz->connection = $myconnection;
	
	
    $Mypagination = new Pagination(10);
    $name="";$quiz_type_id="";
     if(isset($_GET["txtquizname"])){
    	$name = $_GET["txtquizname"];
    }
    $count_data=""; 
    if(isset($_SESSION[SESSION_TITLE.'user_type']) and  $_SESSION[SESSION_TITLE.'user_type']== REGISTERED_ORGANISATION)
    {
        $myquiz->organization_id = $_SESSION[SESSION_TITLE.'userid'];
    }
    $data = $myquiz->get_list($name,$Mypagination->start_record,$Mypagination->max_records);
    if ( $data == false ){
        $mesg = "No records found";
    }else{
        $count_data=count($data);
        $Mypagination->total_records = $myquiz->total_records;
        $Mypagination->paginate();

    }


?>
