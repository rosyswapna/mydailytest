<?php
//$myset = new Set($myconnection);
//$myset->connection = $myconnection;
//$data=$myset->get_detail_all(); 
//$counts=count($data);
?>
<?php
$myset = new Set($myconnection);
$myset->connection = $myconnection;
$Mypagination = new Pagination(100);
$data=$myset->get_list_array_bylimit(); 
$counts=count($data);

 if(isset($_POST["submit"])){	
	$myset->name=$_POST['txtset'];// echo $vs;
	$data=$myset->get_list_array_bylimit();  //print_r($data_bylimit); exit();
	if ( $data == false ){
	$mesg = "No records found";
	}else{
	$counts=count($data);
	$Mypagination->total_records = $myset->total_records;
	$Mypagination->paginate();
	}
	//print_r($data_bylimit);
	}
?>