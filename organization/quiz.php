<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "my_daily_test";	// page Title
	$page->page_name = 'add_quiz';		// page name for menu and other purpose
	$page->layout = 'default.html';			// layout name

    
    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");
	$page->function_list = array("functions.php", "functions_forum.php");
	$page->class_list = array("class_quiz.php","class_quiz_detail.php","class_exam.php","class_subject.php","class_section.php","class_language.php","class_difficulty_level.php","class_user_test_details.php","class_organization.php");

    $page->style_list = array("jquery1.9.1/redmond/jquery-ui-1.10.2.custom.css");
    $page->script_list_link  = array("jquery1.9.1/jquery-1.9.1.js","jquery1.9.1/jquery-ui-1.10.2.custom.js","jquery-ui-timepicker/jquery-ui-timepicker-addon.js","jquery-ui-functions.js");

	$page->access_list = array("REGISTERED_ORGANISATION");

   $index=0;
    $content_list[$index]['file_name']='inc_top_menu.php';
    $content_list[$index]['var_name']='top_menu';
    $index++;
    $content_list[$index]['file_name']='organization/inc_menu.php';
    $content_list[$index]['var_name']='menu';
    $index++;
    $content_list[$index]['file_name']='inc_footer.php';
    $content_list[$index]['var_name']='footer';
    $index++;

    
	$page->content_list = $content_list;

     $page->module_path = 'modules/quiz/'; 
     $page->module = 'update_organization';

	$page->display(); //completed page with dynamic cintent will be displayed
?>
