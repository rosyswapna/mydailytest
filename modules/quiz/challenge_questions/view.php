<?php 
 $breadcrumb = '<a href="'.WEB_URL.'/index.php">Home</a> &raquo; <a href="'.WEB_URL.'/challenge_questions.php?id='.$_GET["id"].'">Challenge Questions</a>';
 ?> 
<?php
$str_options="";
$index=1;
$options=explode(DEFAULT_OPTION_DELIMITER,$myquestion->options);
foreach($options as $option){ 
	$str_options.=" ".$index.") ".$option;
	$index++;
}
ob_start();
?>
<meta name="description" content="<?php echo htmlspecialchars($str_options); ?>">
<meta property="og:url" content="http://mydailytest.com<?php echo $current_url; ?>?id=<?php echo $_GET["id"]; ?>" />
<meta property="og:title" content="<?php echo htmlspecialchars($myquestion->question); ?>" />
<meta property="og:image" content="http://mydailytest.com/images/mdtlogo.png" />
<meta property="og:description" content="<?php echo htmlspecialchars($str_options); ?>"  /> 

<?php
$challenge_question_meta=ob_get_contents();
$challenge_question_title='Challenge Question';

ob_end_clean();
?>

<form  target="_self" method="post" action="<?php echo WEB_URL; ?>/challenge_question_result.php" name="frm_examination" id="frm_examination">
	<input name="h_id" type="hidden" value="<?php echo $_GET["id"];?>" />
<div class="innercontainer-blk">
	<p class="heading">Challenge Questions</p>
	<div class="two-thirds column mright8 bottom-1">
		<div class="inner-box">
			<p class="test-head"><span class="number">Q</span> <span class="txt">
<?php echo $myquestion->question; // Facebook Share Title Display</span> </p> ?>
			<div style="clear:both;"></div>
			<ul class="list"><?php  echo answer_options($myquestion->id,$myquestion->options,""); ?> </ul>
			<input value="Check Answer" type="submit" name="finish" class="button"  />	
		</div>	  
	</div>	
</div>
</form>

