<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

 $myuser = new User($myconnection);
 $myuser->connection = $myconnection;
 //$chk_user = $myuser->get_list_array();



//for pagination
	$Mypagination = new Pagination(10);
	
	

        $data_bylimit = $myuser->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
        $user_statuses=$myuser->get_array_userstatus();
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
	    
            $Mypagination->total_records = $myuser->total_records;
            $Mypagination->paginate();

        }


if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_submit ) {



    $myuser = new User();
    $myuser->connection = $myconnection;
	if($_POST['txtid']==-1){
		$myuser->id ='';
		}else{
	$val=$myuser->id = $_POST['txtid'];}
	if($_POST['txtusername']!=''){
   	$myuser->username = $_POST['txtusername'];
	}
	if($_POST['txtemail']!=''){
	$myuser->email = $_POST['txtemail'];
	}
	if($_POST['txtname']!=''){
	$myuser->name = $_POST['txtname'];
	}
	$myuser->phone = $_POST['txtphone'];

if($_POST['txtuserstatus']==-1){
	$myuser->user_status_id ='';
}else{
$myuser->user_status_id = $_POST['txtuserstatus'];}
  //check user exist or not
    //$chk = $myuser->exist();
	
	$data_bylimit = $myuser->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
	if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $myuser->total_records;
	 $Mypagination->paginate();
            $Mypagination->paginate();

        }
			

}
?>
