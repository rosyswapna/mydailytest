<?php
		$mydifficultylevel = new DifficultyLevel($myconnection);
		$mydifficultylevel->connection = $myconnection;
		$Mypagination = new Pagination(2);
		$data=$mydifficultylevel->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
		
		        if ( $data == false ){
            $mesg = "No records found";
        }else{
            $counts=count($data);
	    
            $Mypagination->total_records = $mydifficultylevel->total_records;
            $Mypagination->paginate();

        }
	
		if(isset($_GET["submit"])){	
			$mydifficultylevel->name=$_GET['txtdifflevel'];// echo $vs;
			$data=$mydifficultylevel->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
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