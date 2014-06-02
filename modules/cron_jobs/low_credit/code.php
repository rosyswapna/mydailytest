<?php


$myusercredit = new UserCredit($myconnection);
$myusercredit->connection = $myconnection;

$myuser = new User($myconnection);
$myuser->connection = $myconnection;

$myemail = new Email;




$limit= 10;
$my_user_credits = $myusercredit->get_low_credit_users($limit);		//low credit users
if($my_user_credits == false){
	//no users with low credit
}
else
{
	$i=0;$user_credit=array();$users = "(";
	while(count($my_user_credits) > $i)
	{
		$key = $my_user_credits[$i]['user_id'];
		$value = $my_user_credits[$i]['total_credit'];
		$user_credit[$key] = $value;
		$users .= $key.",";
		$i++;
	}
	$users = substr($users, 0,-1).")";
	$filter = "user_status_id = '".USERSTATUS_ACTIVE."' AND id IN ".$users;
	$my_users = $myuser->get_list_array_filter($filter);
	
	if($my_users == false)
	{
		//do nothing
	}
	else
	{
		$count_data = count($my_users);
		$i=0;
		while($i < $count_data)
		{
			$myemail->to_email = $my_users[$i]['email'];
			$myemail->subject = "Low Credit";
			$myemail->message = "You have low credit balance in your my daily test account";
			$myemail->from_email = EMAIL_NO_REPLY;
			//echo $my_users[$i]['email']."<br/>";
			$myemail->send_mail();
			$i++;
		}
	}
}
?>
