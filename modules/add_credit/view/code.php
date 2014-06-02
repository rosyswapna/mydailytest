<?php
		$mycreditplan = new CreditPlan($myconnection);
		$mycreditplan->connection = $myconnection;
		$Mypagination = new Pagination(100);
		$data=$mycreditplan->get_list_array_bylimit();
		$dafault_credit_plan_id=$mycreditplan->get_default_credit_plan_id(); 
		$counts=count($data);
		

if(isset($_GET["submit"])){	
			$mycreditplan->name=$_GET['txtcreditname'];// echo $vs;
			$data=$mycreditplan->get_list_array_bylimit(); 
			$dafault_credit_plan_id=$mycreditplan->get_default_credit_plan_id(); 
			$counts=count($data); 
			if ($data == false ){
			$mesg = "No records found";
			}
		else{
		}
		}
?>
