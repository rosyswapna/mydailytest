<?php
header('Content-type: text/html; charset=utf-8');

//timezone
date_default_timezone_set('Asia/Kolkata');
define("CURRENT_DATETIME",date('Y-m-d H:i:s'));
define("CURRENT_DATE",date('Y-m-d'));
define("CURRENT_TIME",date('H:i:s'));


//User Types
define("ADMINISTRATOR", 999);

define("REGISTERED_USER", 1);
define("REGISTERED_USER_UNVERIFIED", 2);

define("REGISTERED_ORGANISATION", 100);
define("REGISTERED_AGENT", 200);


//User Status
define("USERSTATUS_ACTIVE", 1);
define("USERSTATUS_WAITING_EMAIL_ACTIVATION", 2);
define("USERSTATUS_SUSPENDED", 3);
define("USERSTATUS_DISABLED", 4);
define("USERSTATUS_IMPORTED", 5);
define("USERSTATUS_MOBILE_REGISTRATION", 6);



// Status
define("STATUS_ACTIVE", 1);
define("STATUS_INACTIVE", 2);

// quiz_type
define("REAL_QUIZ", 1);
define("DEMO_QUIZ", 2);

//number of questions
define("REAL_QUIZ_LIMIT", 25);

$g_ARRAY_quiz_types = array();
$g_ARRAY_quiz_types[1]["name"] = "Real Quiz";
$g_ARRAY_quiz_types[2]["name"] = "Demo Quiz";
//Language Publish
$g_ARRAY_language_status = array();
$g_ARRAY_language_status[0] = "UnPublished";
$g_ARRAY_language_status[1] = "Published";





// test_statuses
define("TEST_STARTED", 1);
define("TEST_ENDED", 2);
define("TEST_PAUSED", 3);
define("TEST_CANCELLED", 4);

$g_ARRAY_test_statuses = array();
$g_ARRAY_test_statuses[1]["name"] = "Test Started";
$g_ARRAY_test_statusess[2]["name"] = "Test Ended";
$g_ARRAY_test_statuses[3]["name"] = "Test Paused";
$g_ARRAY_test_statuses[4]["name"] = "Test Cancelled";

$g_ARRAY_record_per_page = array();
$g_ARRAY_record_per_page[0]["no_of_records"] = "10";
$g_ARRAY_record_per_page[1]["no_of_records"] = "20";
$g_ARRAY_record_per_page[2]["no_of_records"] = "50";
$g_ARRAY_record_per_page[3]["no_of_records"] = "100";

//Question FB share
$g_ARRAY_question_share = array();
$g_ARRAY_question_share[0]["description"] = "Not allowed";
$g_ARRAY_question_share[1]["description"] = "Allowed";
$g_ARRAY_question_share[0]["value"] = "0";
$g_ARRAY_question_share[1]["value"] = "1";

define("FB_SHARE_NOT_ALLOWED", 0);
define("FB_SHARE_ALLOWED", 1);


//timer arrays
$g_ARRAY_hours 		= array();
$g_ARRAY_minutes	= array();
$g_ARRAY_seconds	= array();
for($i=0; $i <= 5; $i++){
	$g_ARRAY_hours[$i]['hour'] = sprintf("%02s", $i);
}
for($i=0; $i < 60; $i++){
	$g_ARRAY_minutes[$i]['minute'] = sprintf("%02s", $i);
	$g_ARRAY_seconds[$i]['second'] = sprintf("%02s", $i);
}


GLOBAL $g_msg_unauthorized_request;
$g_msg_unauthorized_request = "<strong>Unauthorized Page Request</strong><br/> <br/> You are not authorized to access this page. This attempt will be reported to the system Administrator. ";

GLOBAL $g_msg_unauthorized_request_redirect_page;
$g_msg_unauthorized_request_redirect_page = "index.php";

GLOBAL $g_obj_select_default_text;
$g_obj_select_default_text = "Choose from list..";


//Email
define("EMAIL_FEEDBACK", "feedback@mydailytest.com");
define("EMAIL_NO_REPLY", "noreply@my_daily_test.local");
define("EMAIL_INFO", "noreply@my_daily_test.local");
define("EMAIL_SUPPORT", "noreply@my_daily_test.local");


define("WEB_URL", "http://my_daily_test.local");
define("ADMIN_URL", "http://my_daily_test.local/admin");
define("WEB_NAME", "my_daily_test.local");
define("ORG_NAME", "My Daily Test");
define("TEST_DURATION","00:05:00");




//credit types
define("CREDIT_TYPE_PAYMENT", '1');
define("CREDIT_TYPE_TEST", '2');
define("CREDIT_TYPE_OFFER", '3');
define("CREDIT_TYPE_REPORT", '4');
define("CREDIT_TYPE_ORGANIZATION_CREDIT", '5');
define("CREDIT_TYPE_VOUCHER", '6');

//payment online
define("PAYMENT_ONLINE",'1');
define("PAYMENT_OFFLINE", '0');

//payment type
define("PAYMENT_TYPE_IIPAY", '1');
define("PAYMENT_TYPE_CCAVENUE", '2');
define("PAYMENT_TYPE_CHEQUE", '3');
define("PAYMENT_TYPE_CASH", '4');

// question Status
define("QUESTION_STATUS_ACTIVE", 1);
define("QUESTION_STATUS_INACTIVE", 2);

// question Types
define("QUESTION_TYPE_SINGLE_ANSWER", 1);
define("QUESTION_TYPE_MULTIPLE_ANSWERS", 2);



//import default delimiter
define("DEFAULT_IMPORT_DELIMITER", ',');
define("DEFAULT_OPTION_DELIMITER", '#!@$&');
define("DEFAULT_ANSWER_KEY_DELIMITER", ',');
define("DEFAULT_IDS_DELIMITER", ',');

?>
