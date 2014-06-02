<?php
		$myexam = new Exam($myconnection);
		$myexam->connection = $myconnection;
		$Mypagination = new Pagination(3);
		$data=$myexam->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
		
		        if ( $data == false ){
            $mesg = "No records found";
        }else{
            $counts=count($data);
	    
            $Mypagination->total_records = $myexam->total_records;
            $Mypagination->paginate();

        }
	
		if(isset($_GET["submit"])){	
			$myexam->name=$_GET['txtexam'];// echo $vs;
			$data=$myexam->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
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