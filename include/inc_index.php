<?php
	$myquiz = new Quiz($myconnection);
	$myquiz->connection = $myconnection;
	$Mypagination = new Pagination(50);
	$data_bylimit = $myquiz->get_list_array_bylimit("",DEMO_QUIZ,$Mypagination->start_record,$Mypagination->max_records);
	if ( $data_bylimit == false ){
			$mesg_sample_quiz = "No records found";
	}else{
		$count_data_bylimit=count($data_bylimit);
	}
?>

<div id="index_content" >
<h1>Online test<h1>

</div>

<div id="demo_tests">

<h3>Demo Quizes</h3>
<?php if ( $data_bylimit == false ){ 
}else{ 





	$index = 0;
	$slno = 1;
	while ( $count_data_bylimit > $index ){
?>
	<p><?php echo $slno; ?>. <a href="demo.php?id=<?php echo $data_bylimit[$index]["id"]; ?>" ><?php echo $data_bylimit[$index]["name"]; ?></a></p>
<?php 
	$slno++;
	$index++;
		} ?>

<?php } ?>




</div>
