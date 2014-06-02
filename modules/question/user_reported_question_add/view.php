<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>

<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/update_password.php">Change Password</a>';?>
<form  target="_self" method="post" action="<?php echo $current_url?>" >
	<div class="innercontainer-blk">
		<p class="heading"><span class="fleft">Report Question</span></p>
		<div class="inner-box">
		<p class="test-head"><span class="txt"><?php echo $myquestion->question; ?></span></p>
		<div style="clear:both;" ><div>
		<?php echo answer_options($myquestion->id,$myquestion->options)?>				
			<div class="one-third column">
				<div class="form-box">
					<label>Please type here the issue found :<small></small></label>
					<textarea name="txtdescription"></textarea><br/>
					<input type="submit" class="button" value="submit" name="submit"/>
					<input type="hidden" value="<?php echo $usertest->id;?>" name="hd_utid"/>
					<input type="hidden" value="<?php echo $myuser->id;?>" name="hd_userid"/>
					<input type="hidden" value="<?php echo $myquestion->id;?>" name="hd_questionid"/>
				</div>
			</div>

	</div>
	</div>
</form>
 
