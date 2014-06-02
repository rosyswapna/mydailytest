<?php
//$total=$_GET['total'];
//$correct_ans=$_GET['correct_ans'];
//$wrong_ans=$_GET['wrongs_ans'];
//$questions=$_GET['questions_attempted'];
//$values = array(array($questions), array($wrong_ans), array($correct_ans), array($total)); //First Array Light Yellow, Second Red, Third Green Fourth Teal
$values = array(array($_GET['v'][0]),array($_GET['v'][1]),array($_GET['v'][2]) ); //First Array Light Yellow, Second Red, Third Green Fourth Teal
 // Create labels for each value
 $labels = array('Result');
 // Distance between tick marks on y-axis
 $interval = 2;
 // Color to display bars in.  
 // The number of colors must match the number of data sets
 $bar_color1 = array(255,191,0); // light yellow
 $bar_color2 = array(194,70,66); // dark red
 $bar_color3 = array(0, 128, 0); //green
 $bc = array($bar_color3, $bar_color2, $bar_color1);

 // Create the graph object
 // bar_graph( int width, int height, string x-axis label, string y-axis label,
 //            array bar-grouping labels, int space between tick marks,
 //            int space between bars, array data set(s) )
 $bg = new bar_graph(370, 400, '', 'Analysis', $labels, $interval, 5, $values);
 // Set up the graph
 $bg->set_font_size(8);
 $bg->set_bg_color(array(255,255,255));
 $bg->set_font_color(array(0,0,0));
 $bg->set_bar_color($bc);
 // Create a key.  
 // The number of key labels must match the number of data sets.
 // The first label will be assigned to the first data set etc...
// $bg->key(array(($_GET['t'][0])."=". $_GET['v'][0], ($_GET['t'][1]."=". $_GET['v'][1]),($_GET['t'][2]."=". $_GET['v'][2]))); //BOX VALUES ON RIGHT TOP
//$bg->key($_GET['t']);
$bg->graph();

?>

