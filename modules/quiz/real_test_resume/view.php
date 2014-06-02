
<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/resume.php?id='.$usertest->id.'">Test Details</a>';?>
<?php if($view_flag == 1){ ?>
<form  target="_self" method="post" action="" name="frm_real_test_resume" id="frm_real_test_resume">	
<div class="innercontainer-blk">
	<p class="heading">Test Details</p>

	<div class="inner-box">
		<p class="sub-heading bottom-2">
			Currently you are running on another test , <?php echo $usertest->get_quiz_name_with_usertestid($_SESSION[SESSION_TITLE.'usertestid']); ?>
		</p>
		<input type="hidden" value="<?php echo $_GET["id"]; ?>" name="hd_resume_id" />
		<input type="submit" name="submit" value="Pause and Start" class="button"/> 
		<input type="submit" name="submit" value="Continue" class="button" />
		<input type="submit" name="submit" value="Cancel" class="button" />
	</div>

</div>
</form>
<?php }?>