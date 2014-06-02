<?php
session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/conf/conf.php');
require(ROOT_PATH.'include/conf/system_conf.php');
require(ROOT_PATH.'include/connection/connection.php');
require(ROOT_PATH.'include/class/class_user_test/class_user_test.php');
require(ROOT_PATH.'include/class/class_user_test/class_user_test_conf.php');
require(ROOT_PATH.'include/class/class_user_test_details/class_user_test_details.php');
require(ROOT_PATH.'include/class/class_user_test_report_subject_wise/class_user_test_report_subject_wise.php');

 

 //user test
$usertest = new UserTest($myconnecion);
$usertest->connection 	= $myconnection;

//user test details
$usertestdetails = new UserTestDetails($myconnection);
$usertestdetails->connection 	= $myconnection;

//user test report subject wise
$usertestreportsubjectwise = new UserTestReportSubjectWise($myconnecion);
$usertestreportsubjectwise->connection 	= $myconnection;

$message = "";
if(isset($_POST['submit'])){
	$empty = $usertestreportsubjectwise->empty_table();
	if($empty == true){
		$usertest->test_status_id = TEST_STATUS_FINISHED;
		$usertestids = $usertest->get_all_ids();
		if($usertestids == false){
			$message = "No User test Ids exists";
		}
		else{
			$i = 0;
			foreach($usertestids as $user_test_id){
				//generate data array for subject wise report table
				$usertestdetails->user_test_id = $user_test_id;
				$dataArray = $usertestdetails->get_list_array_for_report_subject_wise();
				//insert into report table
				$usertestreportsubjectwise->user_test_id = $user_test_id;
				$usertestreportsubjectwise->update_batch($dataArray);
				$i++;
			}
			$message = "Report table updated";
		}
	}else{echo "n empty";exit();
		$message = "Report table content could not deleted";
	}
}



?>
<h4>Update Table "user_test_report_subject_wise"</h4>
<form action="" method="post">
	<div><?php echo $message;?></div>
	click <input type="submit" value="here" name="submit"/> to update
</form>
