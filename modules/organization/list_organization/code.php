<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

 $myorganization = new Organization($myconnection);
 $myorganization->connection = $myconnection;
 //$chk_user = $myorganization->get_list_array();



//for pagination
	$Mypagination = new Pagination(10);
	
	

        $data_bylimit = $myorganization->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
        $organization_statuses=$myorganization->get_list_array_organization_statuses();
	$organization_types=$myorganization->get_list_array_organization_types();
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
	    $Mypagination->total_records = $myorganization->total_records;
            $Mypagination->paginate();

        }


if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_submit ) {



    $myorganization = new Organization();
    $myorganization->connection = $myconnection;
	if($_POST['txtusername']!=''){
   	$myorganization->username = $_POST['txtusername'];
	}
	if($_POST['txtemail']!=''){
	$myorganization->email = $_POST['txtemail'];
	}
	if($_POST['txtname']!=''){
	$myorganization->name = $_POST['txtname'];
	}
	$myorganization->phone = $_POST['txtphone'];

if($_POST['txtorganization_status']==-1){
	$myorganization->organization_status_id ='';
}else{
$myorganization->organization_status_id = $_POST['txtorganization_status'];}
if($_POST['txtorganizationtype']==-1){
	$myorganization->organization_type_id ='';
}else{
$myorganization->organization_type_id = $_POST['txtorganizationtype'];
}

  //check user exist or not
    //$chk = $myorganization->exist();
	
	$data_bylimit = $myorganization->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
	if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $myorganization->total_records;
            $Mypagination->paginate();

        }
			

}
?>
