<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$strERR = "";
 


 if ( isset($_GET['mobile']) && isset($_GET['message']) ){

	 if ( trim($_GET['mobile']) == "" ){
	      $strERR .= $MSG_empty_mobile;
	 }

	 if ( trim($_GET['message']) == "" ){
	      $strERR .= $MSG_empty_msg;
	 }
	if ( trim($strERR) != "" ){
	      echo $strERR;  exit();
	 }else{
	//do nothing
	}
}else{
	exit();
}
$myuser= new User();
$myuser->connection = $myconnection;
$myuser->username=$_GET['mobile'];
$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$my_exams = $myexam->get_detail_all();
$my_exam_count=count($my_exams);
switch (strtoupper($_GET['message']))
{
	case 'MDT REGISTER':
						$myuser= new User();
						$myuser->connection = $myconnection;
						$myuser->username = $_GET['mobile'];
						//check user exist or not
						$chk = $myuser->exist();
						if ( $chk == true ){
						$myuser->get_detail_by_username();
						$pass=md5(time());
						$pass=substr($pass,0,5);
						$myuser->password = md5($pass);
						$chk_update = $myuser->update();
						if ( $chk_update == true ){
							$mysms = new Sms();
							$mysms->mobile = $myuser->username;
							$chk_sms=$mysms->user_password_reset_sms($pass);
							if($chk_sms==true){
								
								echo $RD_MSG_signup;
								
								exit();
							}else{
								echo $RD_MSG_attempt_failed;
								exit();
							}		
	
						}
						}else{	$pass=md5(time());
							$pass=substr($pass,0,5);
							$myuser->password = $pass;
							$chk = $myuser->insert_mobile_registration();
							if ( $chk == true ){
								$myuser_credits=new UserCredit();
								$myuser_credits->connection = $myconnection;
								$myuser_credits->credit_type_id=CREDIT_TYPE_OFFER;
								$myuser_credits->user_id=$myuser->id;
								$myuser_credits->credit=DEFAULT_NEW_USER_CREDITS;
								$myuser_credits->update();			

								$mysms = new Sms();
								$mysms->mobile = $myuser->username;
								$chk_sms=$mysms->user_account_activation_sms($myuser->username,$pass);
								if($chk_sms==true){
									
									
									echo $RD_MSG_signup;
									exit();
								}else{
									echo $RD_MSG_attempt_failed;
									exit();
								}		
							}else{
								echo $RD_MSG_attempt_failed;
									exit();
							}
						}
	
						break;


case 'MDT KERALA LDC':	$flag=true;
						$chk_examid=$myuser->get_detail_by_username();
						if($chk_examid==true){
						$data=explode(DEFAULT_IDS_DELIMITER,$myuser->exam_ids);
						$datacount=count($data);
						for ($index_exam = 0; $index_exam < $my_exam_count; $index_exam++)
						{
						if(strcasecmp($my_exams[$index_exam]['name'],"KERALA LDC")==0){	
							$exam_id=$my_exams[$index_exam]['id'];
						for ($data_index = 0; $data_index < $datacount ; $data_index++)
						{
							if($data[$data_index]==$exam_id){
							$flag=false;
							}
							
						}
						}
						}
						
						if($flag==true){
						if($myuser->exam_ids!=""){
						echo $myuser->exam_ids.=DEFAULT_IDS_DELIMITER.$exam_id;
						}else{
						echo $myuser->exam_ids=$exam_id;
						}
						}
						$chk=$myuser->update();
						if($chk==true){
						$mysms = new Sms();
						$mysms->mobile = $myuser->username;
						$mysms->user_exam_preference_update_sms();
						}
						}
					break;
case 'MDT PSC':			$flag=true;
						$chk_examid=$myuser->get_detail_by_username();
						if($chk_examid==true){
						$data=explode(DEFAULT_IDS_DELIMITER,$myuser->exam_ids);
						$datacount=count($data);
						for ($index_exam = 0; $index_exam < $my_exam_count; $index_exam++)
						{
						if(strcasecmp($my_exams[$index_exam]['name'],"PSC")==0){	
							$exam_id=$my_exams[$index_exam]['id'];
						for ($data_index = 0; $data_index < $datacount ; $data_index++)
						{
							if($data[$data_index]==$exam_id){
							$flag=false;
							}
							
						}
						
						}
						}
						if($flag==true){
						if($myuser->exam_ids!=""){
						$myuser->exam_ids.=DEFAULT_IDS_DELIMITER.$exam_id;
						}else{
						$myuser->exam_ids=$exam_id;
						}
						}
						$chk=$myuser->update();
						if($chk==true){
						$mysms = new Sms();
						$mysms->mobile = $myuser->username;
						$mysms->user_exam_preference_update_sms();
						}
						}
					break;
case 'MDT IBPS CLERK':$flag=true;
						$chk_examid=$myuser->get_detail_by_username();
						if($chk_examid==true){
						$data=explode(DEFAULT_IDS_DELIMITER,$myuser->exam_ids);
						$datacount=count($data);
						for ($index_exam = 0; $index_exam < $my_exam_count; $index_exam++)
						{
						if(strcasecmp($my_exams[$index_exam]['name'],"IBPS CLERK")==0){	
						$exam_id=$my_exams[$index_exam]['id'];
						for ($data_index = 0; $data_index < $datacount ; $data_index++)
						{
							if($data[$data_index]==$exam_id){
							$flag=false;
							}
							
						}
						
						}
						}				
						$exam_id;
						if($flag==true){
						if($myuser->exam_ids!=""){
						$myuser->exam_ids.=DEFAULT_IDS_DELIMITER.$exam_id;
						}else{
						$myuser->exam_ids=$exam_id;
						}
						}
						$chk=$myuser->update();
						if($chk==true){
						$mysms = new Sms();
						$mysms->mobile = $myuser->username;
						$mysms->user_exam_preference_update_sms();
						}
						}
					break;
case 'MDT ENGINEERING':$flag=true;
						$chk_examid=$myuser->get_detail_by_username();
						if($chk_examid==true){
						$data=explode(DEFAULT_IDS_DELIMITER,$myuser->exam_ids);
						$datacount=count($data);
						for ($index_exam = 0; $index_exam < $my_exam_count; $index_exam++)
						{
						if(strcasecmp($my_exams[$index_exam]['name'],"ENGINEERING")==0){	
							$exam_id=$my_exams[$index_exam]['id'];
						for ($data_index = 0; $data_index < $datacount ; $data_index++)
						{
							if($data[$data_index]==$exam_id){
							$flag=false;
							}
							
						}
						
						}
						}
						if($flag==true){
						if($myuser->exam_ids!=""){
						echo $myuser->exam_ids.=DEFAULT_IDS_DELIMITER.$exam_id;
						}else{
						echo $myuser->exam_ids=$exam_id;
						}
						}
						$chk=$myuser->update();
						if($chk==true){
						$mysms = new Sms();
						$mysms->mobile = $myuser->username;
						$mysms->user_exam_preference_update_sms();
						}
						}
					break;
}
 


   
 


 
?>
