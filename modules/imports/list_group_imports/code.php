<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

 $mygroupimports = new Groups_import($myconnection);
 $mygroupimports->connection = $myconnection;





//for pagination
	$Mypagination = new Pagination(10);
	$data_bylimit = $mygroupimports->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
	    $Mypagination->total_records = $mygroupimports->total_records;
            $Mypagination->paginate();

        }


if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_submit ) {

	

	if($_POST['txtcreated']!=''){
   	$mygroupimports->created = $_POST['txtcreated'];
	}
	if($_POST['txtcsvfile']!=''){
	$mygroupimports->csvfile = $_POST['txtcsvfile'];
	}
	
	
	$data_bylimit = $mygroupimports->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
	if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $mygroupimports->total_records;
	 $Mypagination->paginate();
            $Mypagination->paginate();

     }
			

}
?>
