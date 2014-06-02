<?php
	
	$myquiz = new Quiz($myconnection);
	$myquiz->connection = $myconnection;
	
	
    $Mypagination = new Pagination(10);
    $name="";$quiz_type_id="";
     if(isset($_GET["txtquizname"])){
    	$name = $_GET["txtquizname"];
    }
    $count_data=""; 
   
    $data = $myquiz->get_list($name,$Mypagination->start_record,$Mypagination->max_records);
    if ( $data == false ){
        $mesg = "No records found";
    }else{
        $count_data=count($data);
        $Mypagination->total_records = $myquiz->total_records;
        $Mypagination->paginate();

    }


?>
