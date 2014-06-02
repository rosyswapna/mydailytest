<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	
	$page->current_url = $current_url;	// current url for pages
	$page->title = "Acube MVC";	// page Title
	$page->page_name = 'flash';		// page name for menu and other purpose

	$page->layout = 'null.html';		// layout name

	$content_list[$index]['file_name']='inc_flash.php';
	$content_list[$index]['var_name']='content';
	$index++;

	$page->content_list = $content_list;


	$page->display(); //completed page with dynamic content will be displayed
?>
