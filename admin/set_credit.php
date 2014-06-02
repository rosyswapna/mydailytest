<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "my_daily_test";	// page Title
	$page->page_name = 'credit_all';		// page name for menu and other purpose
	$page->layout = 'admin_default.html';		// layout name

    
    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");
	$page->function_list = array("functions.php");
	$page->class_list = array("class_credit_plan.php","class_payment_type.php","class_user_credit.php","class_payment.php","class_user.php");

	$page->style_list = array("credit.css");
	$page->script_list_link  = array("jquery.min.js" );

	$page->access_list = array("ADMINISTRATOR");

    $index=0;
    $content_list[$index]['file_name']='administrator/inc_menu.php';
    $content_list[$index]['var_name']='menu';
    $index++;

    $content_list[$index]['file_name']='administrator/inc_left_menu.php';
    $content_list[$index]['var_name']='left_menu';
    $index++;


	$page->content_list = $content_list;

    $page->module_path = 'modules/credit/'; 
     $page->module = 'admin_update';

	$page->display(); //completed page with dynamic cintent will be displayed
?>
