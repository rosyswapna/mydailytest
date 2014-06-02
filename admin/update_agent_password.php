<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

    $page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "My Daily Test";	// page Title
	$page->page_name = 'change agent Password';		// page name for menu and other purpose
	$page->layout = 'admin_default.html';		// layout name

	$page->access_list = array("ADMINISTRATOR");
    
    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");
	$page->function_list = array("functions.php");
	$page->style_list = array("form_table.css" );
	$page->class_list = array("class_agent.php","class_agent_notification.php");


    $index=0;
   $content_list[$index]['file_name']='administrator/inc_menu.php';
    $content_list[$index]['var_name']='menu';
	$index++;

	//$content_list[$index]['file_name']='inc_dashboard.php';
	//$content_list[$index]['var_name']='content';
    $content_list[$index]['file_name']='administrator/inc_left_menu.php';
    $content_list[$index]['var_name']='left_menu';
    $index++;

    

	$page->content_list = $content_list;
	$page->module_path 	= '/modules/agent/';
	$page->module		= 'update_agent_password_by_admin';



	$page->display(); //completed page with dynamic cintent will be displayed
?>
