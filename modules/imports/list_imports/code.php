<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

 $myquestionimports = new Question_import($myconnection);
 $myquestionimports->connection = $myconnection;





//for pagination
	$Mypagination = new Pagination(10);
	
	

        $data_bylimit = $myquestionimports->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
	    $Mypagination->total_records = $myquestionimports->total_records;
            $Mypagination->paginate();

        }


if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_submit ) {

	

	if($_POST['txtcreated']!=''){
   	$myquestionimports->created = $_POST['txtcreated'];
	}
	if($_POST['txtcsvfile']!=''){
	$myquestionimports->csvfile = $_POST['txtcsvfile'];
	}
	
  //check user exist or not
    //$chk = $myquestionimports->exist();
	
	$data_bylimit = $myquestionimports->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
	if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $myquestionimports->total_records;
	 $Mypagination->paginate();
            $Mypagination->paginate();

        }
			

}
?>
