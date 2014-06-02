<?php
		$mysection = new Section($myconnection);
		$mysection->connection = $myconnection;
		$Mypagination = new Pagination(4);
		$data=$mysection->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
		
		        if ( $data == false ){
            $mesg = "No records found";
        }else{
            $counts=count($data);
	    
            $Mypagination->total_records = $mysection->total_records;
            $Mypagination->paginate();

        }
	
		if(isset($_GET["submit"])){	
			$mysection->name=$_GET['txtsection'];// echo $vs;
			$data=$mysection->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records); 
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