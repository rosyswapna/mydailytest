<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
if(isset($myagent)) { echo $myagent->error_description; echo $passwd_error ; }
$breadcrumb='<a href="/agent/index.php">Home</a> &raquo; <a href="/agent/forgot_password.php">Forgot Password</a>'; ?>
	
			<div class="innercontainer-blk">
					<p class="heading"><?php echo $CAP_page_caption?></p>
					<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmforgot_passwd" id="ajax-contact-form">
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_username ?> <small>*</small></label>
								<input type="text" name="username" id="username" class="text">
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
								<input value="<?php echo $CAP_reset; ?>" type="button"  class="button submit"><div style="overflow:hidden;display:none;"><input value="<?php echo $CAP_reset; ?>" type="submit" name="submit"  class="submit_reset"></div>
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					</form>
				</div>



<script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("username").focus();
   //-->
    </script>



