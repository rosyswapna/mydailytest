<?php
	$myexam = new Exam($myconnection);
	$myexam->connection = $myconnection;
	$exams=$myexam->get_array(); 
?>

<?php //Get Quiz Count
	$usertest = new UserTest($myconnection);
	$usertest->connection = $myconnection;
	$Mypagination = new Pagination(2000);
	$data_bylimit = $usertest->get_list_array_bylimit($_SESSION[SESSION_TITLE.'userid'],$Mypagination->start_record,$Mypagination->max_records);
	if($data_bylimit==false){ 
	$total_quiz_number=0;
	$total_finished_quiz_number=0;
	}
	else{
	$total_quiz_number=count($data_bylimit); 
	$usertest->test_status_id=TEST_ENDED;
	$data_bylimit = $usertest->get_list_array_bylimit($_SESSION[SESSION_TITLE.'userid'],$Mypagination->start_record,$Mypagination->max_records);
	$total_finished_quiz_number=count($data_bylimit); 

	}
?>


<?php //Exam Prefernces
$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$my_exams = $myexam->get_detail_all();
$user_id =$_SESSION[SESSION_TITLE.'userid'];
$user_name=$_SESSION[SESSION_TITLE.'username'];
 $myuser = new User($myconnection);
 $myuser->connection = $myconnection;
 $myuser->id = $user_id;
 $chk_user = $myuser->get_detail();
?>


<?php //DASHBOARD

	$myusercredit = new UserCredit($myconnection);
	$myusercredit->connection = $myconnection;
	$myusercredit->user_id = $_SESSION[SESSION_TITLE.'userid'];
	$myusercredit->get_user_total_credit();

	// move this to login + credit update
	$_SESSION[SESSION_TITLE.'user_credit']=($myusercredit->total_records > 0)?$myusercredit->total_credit:0;

	$myquiz = new Quiz($myconnection);
	$myquiz->connection = $myconnection;
	$Mypagination = new Pagination(10000);


	if(trim($_SESSION[SESSION_TITLE.'exam_ids'])!=""){
		$filter = " AND exam_id IN(".$_SESSION[SESSION_TITLE.'exam_ids'].")";
	}
	else{
		$filter = "";
		$_SESSION[SESSION_TITLE.'flash'] = " Choose exam preferences to attempt a test";
	//	header( "Location: dashboard.php");
	//	exit();
	}
	$data_real_quiz = $myquiz->get_list_array_bylimit("",REAL_QUIZ,$Mypagination->start_record,$Mypagination->max_records,$filter); //print_r($data_real_quiz);
	if ( $data_real_quiz == false ){
			$count_real_quiz=0;
			$mesg_real_quiz = "No records found";
	}else{
		$count_real_quiz=count($data_real_quiz);
	}



?>
<?php //exam prefernces
 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
		$myuser = new User($myconnection);
        	$myuser->connection = $myconnection;
		$myuser->id = $user_id;
		$myuser->get_detail();
		$exam_ids=""; 
		if(isset($_POST['chk_exam']))
		{
			foreach ($_POST['chk_exam'] as $exam) {
				$exam_ids .= $exam.DEFAULT_IDS_DELIMITER;
			}
			if($exam_ids!=""){
				$myuser->exam_ids = substr($exam_ids,0,-1);
			}
		}
		
		$chk = $myuser->update();	
	if ( $chk == true ){
			$myuser->get_detail();
			$_SESSION[SESSION_TITLE.'exam_ids'] = $myuser->exam_ids;
			$_SESSION[SESSION_TITLE.'flash'] = $MSG_update_success;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] ="dashboard.php";
			header( "Location: dashboard.php");
			exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $myuser->error_description;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
			header( "Location:".$current_url );

			exit();
		}
	
	
}


 if ( isset($_POST['username'])){
$myuser = new User($myconnection);
$myuser->connection = $myconnection;

$myuser->phone =$_POST['phone'];
$myuser->id = $_SESSION[SESSION_TITLE.'userid'];
$myuser->get_detail();
$myuser->username =$_POST['username'];
$chk=$myuser->update();
if($chk==true){
$_SESSION[SESSION_TITLE.'flash'] = "User details updated.";
$_SESSION[SESSION_TITLE.'privilege']="YES";
$_SESSION[SESSION_TITLE.'username']=$myuser->username;
echo "1";exit();
}else{
exit();
}
}
?>
