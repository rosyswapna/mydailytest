<?php
$mycreditplan = new CreditPlan($myconnection);
$mycreditplan->connection = $myconnection;
		$credit_plan_status = new CreditPlanStatuses($myconnection);
		$credit_plan_status->connection = $myconnection;
		$credit_plan_statuses = $credit_plan_status->get_array(); 
   if(isset($_POST["submit"]) && $_POST["submit"] == "submit"   )
	{	
		$mycreditplan->name= $_POST["txtcreditname"]; 
		$chk=$mycreditplan->exist();
		if($chk==false){
		$mycreditplan->amount= $_POST["txtcreditamount"]; 
		$mycreditplan->credit= $_POST["txtcredits"]; 
		$mycreditplan->credit_plan_status_id= $_POST["lstcreditplanstatus"]; 
				$mycreditplan->id  = $_POST['h_id'];
				if(isset($_POST['default_credit'])){
				$mycreditplan->change_default_plan();
				$mycreditplan->default_plan=true;
				
				} 
				$status=$mycreditplan->update(); 
		$_SESSION[SESSION_TITLE.'flash'] = "Credit Plan Updated.";
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "add_credit.php";
		header( "Location: add_credits.php");
		exit();
				
	}
	else{
	$_SESSION[SESSION_TITLE.'flash'] = "Plan already exist.";
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "add_credit.php";
		header( "Location: add_credits.php");
		exit();	
	}
	}
  if(isset($_GET["id"]) && $_GET["id"] > 0   ){
		$mycreditplan->id = $_GET["id"];
		$mycreditplan->get_detail(); 
  }
  
    if(isset($_GET["delid"]) && $_GET["delid"] > 0   ){ echo "deleted";
		$mycreditplan->id = $_GET["delid"];
		$mycreditplan->delete(); 
		header('location:add_credits.php');
  }
?>