<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
 $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/reset_password.php">Reset Password</a>';
if(isset($myuser)) { $_SESSION[SESSION_TITLE.'flash']= $myuser->error_description; echo $passwd_error ; }?>
				<div class="innercontainer-blk">
					<p class="heading"><?php echo $CAP_page_caption?></p>
					
					<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmreset_passwd" id="ajax-contact-form">	
						
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_newpassword ?> <small>*</small></label>
								<input type="password" class="text" name="new_password" id="new_password" value="">
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_confirmnewpassword ?> <small>*</small></label>
								<input type="password" class="text" name="confirm_new_password" id="confirm_new_password" value="">
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<input  type="hidden" name="password_token" value="<?php echo $password_token; ?>" id="password_token" >
								<input type="submit" class="button" value="<?php echo $CAP_reset; ?>" name="submit" onClick="return confirmPassword();">
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					</form>
				</div>
           <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("newpassword").focus();
   //-->
    </script>
