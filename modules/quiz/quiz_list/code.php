<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

// for quiz

 $myquiz = new Quiz($myconnection);
 $myquiz->connection = $myconnection;

//for pagination
	$Mypagination = new Pagination(10);
// for message
$mesg ="";
$name ="";
$quiz_type_id = REAL_QUIZ;


if(isset($_GET["txtname"])){
	$name = $_GET["txtname"];
}

    $data_bylimit = $myquiz->get_list_array_bylimit($name,$quiz_type_id, $Mypagination->start_record,$Mypagination->max_records);
    if ( $data_bylimit == false ){
        $mesg = "No records found";
    }else{
        $count_data_bylimit=count($data_bylimit);
        $Mypagination->total_records = $myquiz->total_records;
        $Mypagination->paginate();

    }


?>
