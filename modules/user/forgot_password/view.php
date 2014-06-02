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
<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/forgot_password.php">Forgot Password</a>';?>
<div class="innercontainer-blk">
					<p class="heading"><?php echo $CAP_page_caption?> &nbsp;&nbsp; <?php if(isset($myuser)) { echo $myuser->error_description; echo $passwd_error ; }?></p>
					<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmforgot_passwd" id="frmforgot_passwd" >
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_username ?><small>*</small></label>
								<input type="text" name="username" id="username" class="text" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" >
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_captcha; ?> <small>*</small></label><div name="captcha_div" id="captcha_div"><img id="captcha_id" src="/captcha.php"/></div><input type="button" name="captcha_refresh" id="captcha_refresh" value="Refresh" class="button"/><br> <br><input type="text" class="text" name="txtcaptcha" id="txtcaptcha"  value="">
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
							<div class="form-box">
							<input value="<?php echo $CAP_reset; ?>" type="button" class="button" name="submit" id="submit"  /><input type="hidden"  name="h_validate_username" id="h_validate_username"  value="false"><input  type="submit" class="button" name="hd_submit" id="hd_submit" style="display:none;" />
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					</form>
				</div>
				


            <!-- form end-->
    <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("username").focus();
   //-->
    </script>
