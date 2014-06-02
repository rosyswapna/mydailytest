<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

?>


    <?php   /*
    This forms most of the HTML contents of User Login page
    On clicking the Login Button
    the page is called by itself
    If successful user is redirected to the concerned Logged in page
    Else
    Invalid Login information is displayed
    */

    ?>
<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/demo_test_start.php">Demo Test Start</a>';?>
<div class="innercontainer-blk">
					<p class="heading"><?php echo "Verify Before Demo Test";?></p>
					<div class="one-third column">
							<div class="form-box">
										
							</div><!-- End Box -->
						</div><div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
							<label>Total questions : <?php echo $tot_questions;?><br>Total time : <?php echo $myquiz->total_time; ?><br />Description :  <?php echo $myquiz->description; ?></label>			
							</div><!-- End Box -->
						</div>
						
<form  target="_self" method="post" action="<?php echo $current_url?>" name="frm">
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">

								<label><?php echo $CAP_captcha; ?> <small>*</small></label>
								<div name="captcha_div" id="captcha_div"><img id="captcha_id" src="/captcha.php"/></div>
								<input type="button" name="captcha_refresh" id="captcha_refresh" value="Refresh" class="button"/>
								<br> <br>
								<input type="text" class="text" name="txtcaptcha" id="txtcaptcha"  value=""/>

								

							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
							<div class="form-box">
							<input value="start test" type="submit" class="button" name="test_start" id="test_start" />
							<input type="submit" name="hd_submit" id="hd_submit" style="display:none;" />
								<input type="reset" class="button gray" value="Cancel">
								<input type="hidden" value="<?php echo $_REQUEST['id']; ?>" name="id"/>			
							</div>
						</div>
					</form>
				</div>
				


            <!-- form end-->
    
