<?php
		$mysubject = new Subject($myconnection);
		$mysubject->connection = $myconnection;
		$Mypagination = new Pagination(7);
		$data=$mysubject->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
		
		        if ( $data == false ){
            $mesg = "No records found";
        }else{
            $counts=count($data);
	    
            $Mypagination->total_records = $mysubject->total_records;
            $Mypagination->paginate();

        }
	
		if(isset($_GET["submit"])){	
			$mysubject->name=$_GET['txtsubject'];// echo $vs;
			$data=$mysubject->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
			$counts=count($data); 
			if ($data == false ){
			$mesg = "No records found";
			}
		else{
			$counts=count($data); 
			$Mypagination->total_records = $counts;
			$Mypagination->paginate();
		}
		}
?>
