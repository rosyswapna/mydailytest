<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');   // new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;    
    $page->current_url = $current_url;  // current url for pages
    $page->title = "Administrator - Demo Test";   // page Title
    $page->page_name = 'demo_test';     // page name for menu and other purpose
    $page->layout = 'admin_default.html';     // layout name
    
	#$page->use_dynamic_content = true;                 // enable Dynamic Web Content Module

    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
    $page->connection_list = array("connection.php");
    $page->function_list = array("functions.php");

	$page->style_list = array("form_table.css","jquery1.9.1/redmond/jquery-ui-1.10.2.custom.css");
	$page->access_list = array("ADMINISTRATOR");
	$page->class_list = array("class_quiz.php","class_quiz_detail.php","class_exam.php","class_subject.php","class_section.php","class_language.php","class_difficulty_level.php","class_user_test_details.php","class_organization.php");
	$page->script_list_link  = array("jquery1.9.1/jquery-1.9.1.js","jquery1.9.1/jquery-ui-1.10.2.custom.js","jquery-ui-timepicker/jquery-ui-timepicker-addon.js","jquery-ui-functions.js");
	
    $index=0;
    $content_list[$index]['file_name']='administrator/inc_menu.php';
    $content_list[$index]['var_name']='menu';


    $page->content_list = $content_list;

    $page->module_path = 'modules/quiz/'; 
    $page->module = 'update';

    $page->display(); //completed pluggin with dynamic content will be displayed
?>
