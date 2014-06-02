<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	
	$page->layout = 'null.html';		// layout name


	$page->class_list = array("class_bar_graph.php");

	


    $index=0;
    $content_list[$index]['file_name']='inc_bar_graph.php';
    $content_list[$index]['var_name']='content';

    

    

	$page->content_list = $content_list;



	$page->display(); //completed page with dynamic cintent will be displayed
?>
