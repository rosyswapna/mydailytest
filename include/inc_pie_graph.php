<?php 
//////////////////////NEW PIECHART/////////////////////////////////////

$values = array(array($_GET['v'][0]),array($_GET['v'][1]),array($_GET['v'][2]) );
$text = array(array($_GET['t'][0]),array($_GET['t'][1]),array($_GET['t'][2]) );
//print_r($values);



$MyData = new pData();   
$MyData->addPoints(array($_GET['v'][0],$_GET['v'][1],$_GET['v'][2]),"ScoreA");  
$MyData->setSerieDescription("ScoreA","Application A");
 
/* Define the absissa serie */
$MyData->addPoints(array($_GET['t'][0],$_GET['t'][1],$_GET['t'][2]),"Labels");
$MyData->setAbscissa("Labels");
 
/* Create the pChart object */
$myPicture = new pImage(340,400,$MyData,TRUE);
 
/* Draw a solid background */
$Settings = array("R"=>255, "G"=>255, "B"=>255, "Dash"=>0, "DashR"=>0, "DashG"=>0, "DashB"=>0);
$myPicture->drawFilledRectangle(0,0,700,230,$Settings);
 
/* Draw a gradient overlay */
//$Settings = array("StartR"=>209, "StartG"=>150, "StartB"=>231, "EndR"=>111, "EndG"=>3, "EndB"=>138, "Alpha"=>50);
//$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
//$myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));
 
/* Add a border to the picture */
$myPicture->drawRectangle(0,0,699,229,array("R"=>255,"G"=>255,"B"=>255));
 
/* Write the picture title */ 
$myPicture->setFontProperties(array("FontName"=>ROOT_PATH."files/fonts/graph/Silkscreen.ttf","FontSize"=>6));
$myPicture->drawText(10,13,"",array("R"=>255,"G"=>255,"B"=>255));
 
/* Set the default font properties */ 
$myPicture->setFontProperties(array("FontName"=>ROOT_PATH."files/fonts/graph/arial.ttf","FontSize"=>12,"R"=>80,"G"=>80,"B"=>80)); //percentage font
 
/* Create the pPie object */ 
$PieChart = new pPie($myPicture,$MyData);
 
/* Define the slice color */
$PieChart->setSliceColor(0,array("R"=>240,"G"=>197,"B"=>0));
$PieChart->setSliceColor(1,array("R"=>200,"G"=>10,"B"=>10));
$PieChart->setSliceColor(2,array("R"=>23,"G"=>200,"B"=>100));
 
/* Draw a simple pie chart */ 

 
/* Draw an AA pie chart */ 

 
/* Enable shadow computing */ 
$myPicture->setShadow(TRUE,array("X"=>3,"Y"=>3,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>0));
 
/* Draw a splitted pie chart */ 
$PieChart->draw3DPie(100,125,array("WriteValues"=>TRUE,"DataGapAngle"=>10,"DataGapRadius"=>6,"Border"=>TRUE));
 
/* Write the legend */
$myPicture->setFontProperties(array("FontName"=>ROOT_PATH."files/fonts/graph/pf_arma_five.ttf","FontSize"=>6));
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>0));
//$myPicture->drawText(90,200,"Exam Result",array("DrawBox"=>TRUE,"BoxRounded"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Align"=>TEXT_ALIGN_TOPMIDDLE));
 
/* Write the legend box */ 
$myPicture->setFontProperties(array("FontName"=>ROOT_PATH."files/fonts/graph/Silkscreen.ttf","FontSize"=>6,"R"=>0,"G"=>0,"B"=>0)); // titles on top
$PieChart->drawPieLegend(10,8,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));
 
/* Render the picture (choose the best way) */
$filename=ROOT_PATH."files/temp/example.draw3DPie.png";
$myPicture->autoOutput($filename);
?>
						