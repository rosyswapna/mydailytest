<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

    $page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "My Daily Test";	// page Title
	$page->page_name = 'quiz_rule_check';		// page name for menu and other purpose
	$page->layout = 'null.html';		// layout name

	$page->access_list = array("ADMINISTRATOR","REGISTERED_ORGANISATION");
    
    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");
	$page->function_list = array("functions.php");

	$page->class_list = array("class_quiz_detail.php");
	


	$page->module_path 	= '/modules/quiz/';
	$page->module		= 'quiz_rule_check';



	$page->display(); //completed page with dynamic cintent will be displayed
?>
