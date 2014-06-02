<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

    $page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "My Daily Test";	// page Title
	$page->page_name = 'recieve_sms';		// page name for menu and other purpose
	$page->layout = 'null.html';		// layout name

	//$page->access_list = array("REGISTERED_USER");
    
    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");
	$page->function_list = array("functions.php");
	
	$page->class_list = array("class_sms.php","class_user.php","class_user_credit.php","class_exam.php");


    

	$page->module_path 	= '/modules/sms/';
	$page->module		= 'recieve';



	$page->display(); //completed page with dynamic cintent will be displayed
?>
