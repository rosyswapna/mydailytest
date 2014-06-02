<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
  
	$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/reset_password.php">Reset Password</a>';
    if(isset($myorganization)) { $_SESSION[SESSION_TITLE.'flash'] =$myorganization->error_description.$passwd_error ; }?>
			
			<div class="innercontainer-blk">
					<p class="heading"><?php echo $CAP_page_caption?></p>
					<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmreset_passwd" id="ajax-contact-form">
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_newpassword ?><small>*</small></label>
								<input type="password" name="new_password" id="new_password" value="" class="text">
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_confirmnewpassword ?><small>*</small></label><input  type="hidden" name="password_token" value="<?php echo $password_token; ?>" id="password_token" >
								<input type="password" name="confirm_new_password" id="confirm_new_password" value="" class="text">
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
							<div class="form-box">
								<input value="<?php echo $CAP_reset; ?>"  class="button"     type="submit" name="submit" >
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




            
                
