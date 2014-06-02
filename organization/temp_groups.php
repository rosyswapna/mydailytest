<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');   // new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;    
    $page->current_url = $current_url;  // current url for pages
    $page->title = "Temp groups";   // page Title
    $page->page_name = 'Temp groups';     // page name for menu and other purpose
    $page->layout = 'admin_default.html';     // layout name
    
	#$page->use_dynamic_content = true;                 // enable Dynamic Web Content Module

    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
    $page->connection_list = array("connection.php");
    $page->function_list = array("functions.php");

	$page->style_list = array("form_table.css","report_table.css");
	
	$page->class_list = array("class_pagination.php","class_subject.php","class_difficulty_level.php","class_groups_import.php","class_exam.php","class_temp_groups.php");
	$page->script_list = array("jquery.min.js");
	
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

    $page->module_path = 'modules/temp_groups/'; 
    $page->module = 'list_by_organizations';

    $page->display(); //completed pluggin with dynamic content will be displayed
?>
