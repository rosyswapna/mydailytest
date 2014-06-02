<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	
	$page->current_url = $current_url;	// current url for pages
	$page->title = "Acube MVC";	// page Title
	$page->page_name = 'Pie Graph';		// page name for menu and other purpose
	$page->layout = 'null.html';		// layout name

	$page->access_list = array("REGISTERED_USER");
    
    $page->conf_list = array("conf.php");
	$page->function_list = array("functions.php");
	$page->class_list = array("class_pData.php","class_pDraw.php","class_pImage.php","class_pPie.php");



    $index=0;
    $content_list[$index]['file_name']='inc_pie_graph.php';
    $content_list[$index]['var_name']='content';
    $index++;

	$page->content_list = $content_list;





	$page->display(); //completed page with dynamic cintent will be displayed
?>
